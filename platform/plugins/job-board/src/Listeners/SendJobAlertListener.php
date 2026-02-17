<?php

namespace Botble\JobBoard\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Events\JobPublishedEvent;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobAlert;
use Botble\JobBoard\Services\JobAlertService;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Jobs\SendJobAlertEmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendJobAlertListener
{
    public function __construct(
        protected JobAlertService $jobAlertService
    ) {
    }

    public function handle(JobPublishedEvent $event): void
    {
        try {
        $job = $event->job;
        
        // CRITICAL: Log that listener is being called
        error_log('[JOB_ALERT] ============================================');
        error_log('[JOB_ALERT] 🎯🎯🎯 SendJobAlertListener::handle() CALLED! 🎯🎯🎯');
        error_log('[JOB_ALERT] Job ID: ' . $job->id);
        error_log('[JOB_ALERT] Job Name: ' . $job->name);
        error_log('[JOB_ALERT] ============================================');
        \Log::info('🎯 SendJobAlertListener::handle() called', ['job_id' => $job->id, 'job_name' => $job->name]);
            
            // Load relationships safely
            try {
                $job->loadMissing(['skills', 'tags', 'company', 'categories', 'jobTypes', 'city', 'state', 'country', 'currency']);
            } catch (\Exception $e) {
                \Log::error('Failed to load job relationships: ' . $e->getMessage());
                error_log('[JOB_ALERT] Failed to load relationships: ' . $e->getMessage());
                // Try to load without problematic relationships
                $job->loadMissing(['skills', 'tags', 'company', 'jobTypes', 'city', 'state', 'country', 'currency']);
            }
            
            // Debug: Log that event was triggered
            $logMessage = 'JobPublishedEvent triggered for job: ' . $job->id . ' - ' . $job->name;
            \Log::info($logMessage);
            error_log('[JOB_ALERT] ' . $logMessage);
            $emailsSent = 0;
            
        // Get all active job alerts - wrapped in try-catch in case table doesn't exist
        $alerts = collect();
        try {
        $alerts = JobAlert::query()
            ->where('is_active', true)
            ->where('frequency', 'instant')
            ->with(['account', 'jobCategory', 'jobType', 'city', 'state', 'country'])
            ->get();
            error_log('[JOB_ALERT] Loaded ' . $alerts->count() . ' active job alerts');
        } catch (\Exception $e) {
            \Log::warning('Job alerts table may not exist: ' . $e->getMessage());
            error_log('[JOB_ALERT] ⚠️ Job alerts table not found or error: ' . $e->getMessage());
            error_log('[JOB_ALERT] Continuing with other alert methods...');
            // Continue execution - table might not exist
        }

        foreach ($alerts as $alert) {
            try {
            // Check if we already sent this job to this alert
            if ($alert->sentJobs()->where('job_id', $job->id)->exists()) {
                continue;
                }
            } catch (\Exception $e) {
                error_log('[JOB_ALERT] Error checking sent jobs for alert ' . $alert->id . ': ' . $e->getMessage());
                continue; // Skip this alert if we can't check
            }

            // Check if job matches this alert criteria
            $matches = true;

            // Keywords check
            if ($alert->keywords) {
                $keywords = array_filter(array_map('trim', explode(',', $alert->keywords)));
                if (!empty($keywords)) {
                    $matchesKeyword = false;
                    $jobText = strtolower($job->name . ' ' . ($job->description ?? '') . ' ' . ($job->content ?? ''));
                    foreach ($keywords as $keyword) {
                        if (stripos($jobText, strtolower($keyword)) !== false) {
                            $matchesKeyword = true;
                            break;
                        }
                    }
                    if (!$matchesKeyword) {
                        $matches = false;
                    }
                }
            }

            // Category check
            if ($matches && $alert->job_category_id) {
                $matches = $job->categories()->where('jb_categories.id', $alert->job_category_id)->exists();
            }

            // Job Type check
            if ($matches && $alert->job_type_id) {
                $matches = $job->jobTypes()->where('jb_job_types.id', $alert->job_type_id)->exists();
            }

            // Location check
            if ($matches && is_plugin_active('location')) {
                if ($alert->city_id) {
                    $matches = $job->city_id == $alert->city_id;
                } elseif ($alert->state_id) {
                    $matches = $job->state_id == $alert->state_id;
                } elseif ($alert->country_id) {
                    $matches = $job->country_id == $alert->country_id;
                }
            }

            // Salary range check
            if ($matches && ($alert->salary_from || $alert->salary_to)) {
                $salaryMatch = false;
                if ($alert->salary_from && $alert->salary_to) {
                    $salaryMatch = (!$job->salary_to || $job->salary_to >= $alert->salary_from) &&
                                   (!$job->salary_from || $job->salary_from <= $alert->salary_to);
                } elseif ($alert->salary_from) {
                    $salaryMatch = !$job->salary_to || $job->salary_to >= $alert->salary_from;
                } elseif ($alert->salary_to) {
                    $salaryMatch = !$job->salary_from || $job->salary_from <= $alert->salary_to;
                }
                $matches = $salaryMatch;
            }

            // If job matches all criteria, send email
            if ($matches) {
                try {
                    $this->sendJobAlertEmail($alert, $job);
                    $emailsSent++;
                    
                    // Mark job as sent to this alert - wrapped in try-catch in case pivot table doesn't exist
                    try {
                    $alert->sentJobs()->attach($job->id, ['sent_at' => Carbon::now()]);
                    $alert->last_sent_at = Carbon::now();
                    $alert->save();
                    } catch (\Exception $attachException) {
                        error_log('[JOB_ALERT] Could not mark job as sent (pivot table may not exist): ' . $attachException->getMessage());
                        // Continue - email was sent successfully
                    }
                    
                    error_log('[JOB_ALERT] Email sent to alert: ' . $alert->name . ' (' . $alert->account->email . ')');
                } catch (\Exception $e) {
                    error_log('[JOB_ALERT] Failed to send email to alert ' . $alert->id . ': ' . $e->getMessage());
                }
            }
        }
        
        error_log('[JOB_ALERT] Total emails sent via job alerts: ' . $emailsSent);

        // Send alerts based on user profile preferences (teaching_subjects, qualifications, etc.)
        $profileEmailsSent = $this->sendAlertsBasedOnProfilePreferences($job);
        error_log('[JOB_ALERT] Total emails sent via profile preferences: ' . $profileEmailsSent);

        // Legacy: Send alerts based on favorite tags/skills (for backward compatibility)
        $tagIds = $job->tags->pluck('id')->all();
        $skillIds = $job->skills->pluck('id')->all();

        $jobSeekerTypeValue = AccountTypeEnum::JOB_SEEKER; // Already a string constant
        $accounts = Account::query()
            ->where('type', $jobSeekerTypeValue)  // Use string value
            ->where(function ($query) use ($tagIds, $skillIds): void {
                $query
                    ->whereHas('favoriteTags', function ($query) use ($tagIds): void {
                        $query->whereIn('jb_account_favorite_tags.tag_id', $tagIds);
                    })
                    ->orWhereHas('favoriteSkills', function ($query) use ($skillIds): void {
                        $query->whereIn('jb_account_favorite_skills.skill_id', $skillIds);
                    });
            })
            ->get();

        $legacyEmailsSent = 0;
        foreach ($accounts as $account) {
            try {
            EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
                ->setVariableValues([
                    'job_name' => $job->name,
                    'job_url' => $job->url,
                        'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),
                    'account_name' => $account->name,
                ])
                ->sendUsingTemplate('job-seeker-job-alert', $account->email);
                $legacyEmailsSent++;
                error_log('[JOB_ALERT] Legacy email sent to: ' . $account->email);
            } catch (\Exception $e) {
                error_log('[JOB_ALERT] Failed to send legacy email to ' . $account->email . ': ' . $e->getMessage());
            }
        }
        error_log('[JOB_ALERT] Total legacy emails sent: ' . $legacyEmailsSent);
        
        // Send email to ALL job seekers when a new job is created
        // No limit - send to ALL job seekers
        $result = $this->sendToAllJobSeekers($job, null); // null = no limit, send to all
        $allJobSeekersEmailsSent = $result['emails_sent'];
        $jobSeekersList = $result['job_seekers_list'];
        
        error_log('[JOB_ALERT] Total emails sent to all job seekers: ' . $allJobSeekersEmailsSent . ' (sent to ALL job seekers)');
        
        // Store job seekers list in session for display in success message
        if (session()->has('job_created_email_recipients')) {
            session()->forget('job_created_email_recipients');
        }
        session()->put('job_created_email_recipients', $jobSeekersList);
        } catch (\Exception $e) {
            \Log::error('JobAlertListener error: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            error_log('[JOB_ALERT] Listener error: ' . $e->getMessage());
        }
    }


    protected function sendJobAlertEmail(JobAlert $alert, $job): void
    {
        $account = $alert->account;
        
        // Get location info
        $location = 'Any Location';
        if (is_plugin_active('location')) {
            if ($alert->city) {
                $location = $alert->city->name;
            } elseif ($alert->state) {
                $location = $alert->state->name;
            } elseif ($alert->country) {
                $location = $alert->country->name;
            }
        }

        // Get job area/category
        $jobArea = $alert->jobCategory ? $alert->jobCategory->name : 'All Categories';
        
        // Get preferred job type
        $jobType = $alert->jobType ? $alert->jobType->name : 'All Types';

        $accountName = $account->name ?? ($account->full_name ?? ($account->first_name . ' ' . $account->last_name));
        
        EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'account_name' => trim($accountName) ?: 'Job Seeker',
                'alert_name' => $alert->name,
                'job_name' => $job->name,
                'job_url' => $job->url,
                'job_description' => strip_tags($job->description ?? ''),
                'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),
                'job_area' => $jobArea,
                'job_type' => $jobType,
                'location' => $location,
                'salary_range' => $this->formatSalaryRange($job),
                'view_jobs_url' => JobBoardHelper::getJobsPageURL() ?: url('/jobs'),
                'unsubscribe_url' => route('public.account.job-alerts.edit', $alert->id),
            ])
            ->sendUsingTemplate('job-alert-notification', $account->email);
    }

    protected function sendAlertsBasedOnProfilePreferences($job): int
    {
        // Reload job with categories to ensure they're loaded
        $job->load('categories');
        
        // Get job categories names for matching
        $jobCategoryNames = $job->categories->pluck('name')->map(fn($name) => strtolower(trim($name)))->filter()->all();
        
        // Get job name and description for keyword matching
        $jobText = strtolower($job->name . ' ' . ($job->description ?? '') . ' ' . ($job->content ?? ''));

        \Log::info('Checking profile preferences for job: ' . $job->id, [
            'job_categories' => $jobCategoryNames,
            'job_categories_count' => count($jobCategoryNames),
            'job_name' => $job->name,
            'job_text_length' => strlen($jobText)
        ]);

        // If no categories, still check job text for matches
        if (empty($jobCategoryNames) && empty($jobText)) {
            \Log::warning('Job has no categories and empty text, skipping profile preference matching');
            error_log('[JOB_ALERT] Skipping profile preferences - no categories or text');
            return 0;
        }

        // Find job seekers who have profile preferences set
        $jobSeekerTypeValue = AccountTypeEnum::JOB_SEEKER; // Already a string constant
        $accounts = Account::query()
            ->where('type', $jobSeekerTypeValue)  // Use string value
            ->where(function ($query): void {
                $query->whereNotNull('teaching_subjects')
                    ->orWhereNotNull('qualifications')
                    ->orWhereNotNull('position_type');
            })
            ->get();

        \Log::info('Found ' . $accounts->count() . ' accounts with profile preferences');

        if ($accounts->isEmpty()) {
            \Log::info('No accounts with profile preferences found');
            error_log('[JOB_ALERT] No accounts with profile preferences found');
            return 0;
        }
        
        $emailsSent = 0;

        foreach ($accounts as $account) {
            $matches = false;
            $matchReason = '';

            // Check teaching subjects match with job categories or job text
            if ($account->teaching_subjects && is_array($account->teaching_subjects) && !empty($account->teaching_subjects)) {
                \Log::info('Checking teaching subjects for account: ' . $account->id, [
                    'teaching_subjects' => $account->teaching_subjects
                ]);
                
                foreach ($account->teaching_subjects as $subject) {
                    $subjectValue = is_array($subject) ? ($subject['subject'] ?? '') : (string)$subject;
                    if (empty($subjectValue)) {
                        continue;
                    }
                    
                    $subjectLower = strtolower(trim($subjectValue));
                    
                    // Check if subject matches any job category
                    foreach ($jobCategoryNames as $categoryName) {
                        if (stripos($subjectLower, $categoryName) !== false || stripos($categoryName, $subjectLower) !== false) {
                            $matches = true;
                            $matchReason = "Teaching subject '{$subjectValue}' matches category '{$categoryName}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    // Check if subject appears in job text
                    if (stripos($jobText, $subjectLower) !== false) {
                        $matches = true;
                        $matchReason = "Teaching subject '{$subjectValue}' found in job text";
                        \Log::info('Match found: ' . $matchReason);
                        break;
                    }
                }
            }

            // Check qualifications match with job requirements
            if (!$matches && $account->qualifications && is_array($account->qualifications) && !empty($account->qualifications)) {
                \Log::info('Checking qualifications for account: ' . $account->id, [
                    'qualifications' => $account->qualifications
                ]);
                
                foreach ($account->qualifications as $qualification) {
                    $specialization = is_array($qualification) ? ($qualification['specialization'] ?? '') : '';
                    if (empty($specialization)) {
                        continue;
                    }
                    
                    $specializationLower = strtolower(trim($specialization));
                    
                    // Check if specialization matches job category or job text
                    foreach ($jobCategoryNames as $categoryName) {
                        if (stripos($specializationLower, $categoryName) !== false || stripos($categoryName, $specializationLower) !== false) {
                            $matches = true;
                            $matchReason = "Qualification '{$specialization}' matches category '{$categoryName}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    if (stripos($jobText, $specializationLower) !== false) {
                        $matches = true;
                        $matchReason = "Qualification '{$specialization}' found in job text";
                        \Log::info('Match found: ' . $matchReason);
                        break;
                    }
                }
            }

            // If matches, send email
            if ($matches) {
                \Log::info('Sending email to account: ' . $account->id . ' (' . $account->email . ') - Reason: ' . $matchReason);
                error_log('[JOB_ALERT] Match found for account: ' . $account->id . ' (' . $account->email . ') - Reason: ' . $matchReason);
                try {
                    $this->sendProfileBasedJobAlert($account, $job);
                    $emailsSent++;
                    \Log::info('Email sent successfully to: ' . $account->email);
                    error_log('[JOB_ALERT] Profile-based email sent successfully to: ' . $account->email);
                } catch (\Exception $e) {
                    \Log::error('Failed to send email to ' . $account->email . ': ' . $e->getMessage());
                    error_log('[JOB_ALERT] Failed to send profile-based email to ' . $account->email . ': ' . $e->getMessage());
                }
            } else {
                \Log::info('No match for account: ' . $account->id . ' (' . $account->email . ')');
            }
        }
        
        return $emailsSent;
    }

    protected function sendProfileBasedJobAlert(Account $account, $job): void
    {
        // Get user's preferred job area from profile
        $jobArea = 'All Categories';
        if ($account->teaching_subjects && is_array($account->teaching_subjects) && !empty($account->teaching_subjects)) {
            $firstSubject = $account->teaching_subjects[0];
            $subjectValue = is_array($firstSubject) ? ($firstSubject['subject'] ?? '') : $firstSubject;
            $jobArea = ucwords(str_replace('_', ' ', $subjectValue));
        }

        // Get location from user profile or job
        $location = 'Any Location';
        if (is_plugin_active('location')) {
            if ($account->city) {
                $location = $account->city->name;
            } elseif ($account->state) {
                $location = $account->state->name;
            } elseif ($account->country) {
                $location = $account->country->name;
            } elseif ($job->city) {
                $location = $job->city->name;
            } elseif ($job->state) {
                $location = $job->state->name;
            } elseif ($job->country) {
                $location = $job->country->name;
            }
        }

        $accountName = $account->name ?? ($account->full_name ?? ($account->first_name . ' ' . $account->last_name));

        EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'account_name' => trim($accountName) ?: 'Job Seeker',
                'alert_name' => 'Based on Your Profile Preferences',
                'job_name' => $job->name,
                'job_url' => $job->url,
                'job_description' => strip_tags($job->description ?? ''),
                'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),
                'job_area' => $jobArea,
                'job_type' => $job->jobTypes->first()?->name ?? 'All Types',
                'location' => $location,
                'salary_range' => $this->formatSalaryRange($job),
                'view_jobs_url' => JobBoardHelper::getJobsPageURL() ?: url('/jobs'),
                'unsubscribe_url' => route('public.account.settings'),
            ])
            ->sendUsingTemplate('job-alert-notification', $account->email);
    }

    protected function sendToAllJobSeekers($job, $limit = null): array
    {
        try {
            // Get enum value as string (database stores 'job-seeker' as string)
            $jobSeekerTypeValue = AccountTypeEnum::JOB_SEEKER; // Already a string constant
            error_log('[JOB_ALERT] ========== STARTING JOB SEEKER QUERY ==========');
            error_log('[JOB_ALERT] Querying job seekers with type: "' . $jobSeekerTypeValue . '"');
            
            // DIRECT DATABASE QUERY: Screenshot ke according, type column mein 'job-seeker' string format mein hai
            // Database se directly type = 'job-seeker' wale accounts fetch karein
            error_log('[JOB_ALERT] 📊 Running database query...');
            error_log('[JOB_ALERT]   Searching for: type = "' . $jobSeekerTypeValue . '"');
                
            // First, let's check what types exist in database
            $allTypes = DB::table('jb_accounts')
                ->selectRaw('DISTINCT type')
                    ->get();
            error_log('[JOB_ALERT]   All types in database: ' . $allTypes->pluck('type')->implode(', '));
                
                $jobSeekerIds = DB::table('jb_accounts')
                ->where('type', $jobSeekerTypeValue)  // type = 'job-seeker' (exact match)
                    ->whereNotNull('email')
                    ->where('email', '!=', '')
                    ->where('email', 'LIKE', '%@%')
                    ->pluck('id')
                    ->toArray();
                
            error_log('[JOB_ALERT] 📊 DATABASE QUERY RESULT:');
            error_log('[JOB_ALERT]   Query: SELECT id FROM jb_accounts WHERE type = "' . $jobSeekerTypeValue . '" AND email IS NOT NULL');
            error_log('[JOB_ALERT]   Found ' . count($jobSeekerIds) . ' job seeker IDs with valid email');
                
            // Also check total count for debugging
            $totalJobSeekersInDb = DB::table('jb_accounts')
                ->where('type', $jobSeekerTypeValue)
                ->count();
            error_log('[JOB_ALERT]   Total job-seeker accounts in DB (any email): ' . $totalJobSeekersInDb);
            
            // Convert IDs to Account models
            $jobSeekers = collect();
                if (!empty($jobSeekerIds)) {
                // Apply limit only if specified (null = no limit, send to all)
                if ($limit !== null && $limit > 0 && count($jobSeekerIds) > $limit) {
                    $jobSeekerIds = array_slice($jobSeekerIds, 0, $limit);
                    error_log('[JOB_ALERT] ⚠️ Limiting to first ' . $limit . ' job seekers');
                } else {
                    error_log('[JOB_ALERT] ✅ No limit - sending to ALL ' . count($jobSeekerIds) . ' job seekers');
                }
                
                    $jobSeekers = Account::query()
                        ->whereIn('id', $jobSeekerIds)
                        ->get();
                
                error_log('[JOB_ALERT] ✅ Loaded ' . $jobSeekers->count() . ' job seeker accounts from database');
                
                // Log sample job seekers
                $sample = $jobSeekers->take(5);
                foreach ($sample as $js) {
                    $name = trim(($js->first_name ?? '') . ' ' . ($js->last_name ?? ''));
                    error_log('[JOB_ALERT]   - ID: ' . $js->id . ', Email: ' . $js->email . ', Name: ' . ($name ?: 'N/A'));
                }
            } else {
                error_log('[JOB_ALERT] ⚠️ No job seekers found in database!');
                
                // Debug: Check what's in database
                $allAccounts = DB::table('jb_accounts')
                    ->selectRaw('type, COUNT(*) as count')
                    ->groupBy('type')
                    ->get();
                
                error_log('[JOB_ALERT] Database accounts by type:');
                foreach ($allAccounts as $acc) {
                    error_log('[JOB_ALERT]   - Type: "' . ($acc->type ?? 'NULL') . '" = ' . $acc->count . ' accounts');
                }
                
                // Check specifically for job-seeker
                $totalJobSeekers = DB::table('jb_accounts')
                    ->where('type', $jobSeekerTypeValue)
                    ->count();
                
                $jobSeekersWithEmail = DB::table('jb_accounts')
                    ->where('type', $jobSeekerTypeValue)
                    ->whereNotNull('email')
                    ->where('email', '!=', '')
                    ->where('email', 'LIKE', '%@%')
                    ->count();
                
                error_log('[JOB_ALERT] Total job-seeker accounts: ' . $totalJobSeekers);
                error_log('[JOB_ALERT] Job-seeker accounts with valid email: ' . $jobSeekersWithEmail);
            }

            \Log::info('Sending new job notification to all job seekers', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'total_job_seekers' => $jobSeekers->count()
            ]);
            
            error_log('[JOB_ALERT] Starting to send emails to all job seekers. Total job seekers found: ' . $jobSeekers->count());
            
            // Debug: Log first few job seekers if any
            if ($jobSeekers->count() > 0) {
                $firstFew = $jobSeekers->take(3);
                foreach ($firstFew as $js) {
                    error_log('[JOB_ALERT] Sample job seeker - ID: ' . $js->id . ', Name: ' . ($js->name ?? $js->first_name . ' ' . $js->last_name) . ', Email: ' . $js->email);
                }
            }

            $jobSeekersList = [];
            
            if ($jobSeekers->isEmpty()) {
                \Log::info('No job seekers found to send emails');
                error_log('[JOB_ALERT] No job seekers found with valid email addresses');
                return [
                    'emails_sent' => 0,
                    'job_seekers_list' => []
                ];
            }

            $emailsQueued = 0;
            $emailsFailed = 0;
            
            // OPTIMIZATION: Dispatch emails to queue instead of sending synchronously
            // This makes job creation instant - emails will be processed in background
            $totalJobSeekers = $jobSeekers->count();
            
            \Log::info('[JOB_ALERT] Dispatching ' . $totalJobSeekers . ' email jobs to queue');

            foreach ($jobSeekers as $jobSeeker) {
                try {
                    // Validate email format before queuing
                    if (!filter_var($jobSeeker->email, FILTER_VALIDATE_EMAIL)) {
                        \Log::warning('[JOB_ALERT] Invalid email format for job seeker ' . $jobSeeker->id . ': ' . $jobSeeker->email);
                        continue;
                    }
                    
                    // Dispatch email job to queue (background processing)
                    // Note: If queue is 'sync', job executes immediately and may throw email errors
                    // We still count it as "queued" because the job was dispatched successfully
                    try {
                        SendJobAlertEmailJob::dispatch($jobSeeker, $job);
                        $emailsQueued++;
                    } catch (\Exception $e) {
                        $errorMsg = $e->getMessage();
                        
                        // Check if this is an email sending error (Gmail limit, SMTP error, etc.)
                        // vs a real dispatch error (serialization, etc.)
                        $isEmailSendingError = (
                            strpos($errorMsg, 'Daily user sending limit') !== false ||
                            strpos($errorMsg, 'Expected response code') !== false ||
                            strpos($errorMsg, 'SMTP') !== false ||
                            strpos($errorMsg, 'Connection') !== false ||
                            strpos($errorMsg, 'Mail') !== false
                        );
                        
                        if ($isEmailSendingError) {
                            // This is an email sending error - job was dispatched/executed but email failed
                            // In sync mode, this happens immediately. Still count as queued (job processed)
                            // The job will retry automatically (3 tries)
                            $emailsQueued++;
                            \Log::warning('[JOB_ALERT] ⚠️ Email sending failed (will retry): Job Seeker ' . $jobSeeker->id . ' - ' . substr($errorMsg, 0, 100));
                            error_log('[JOB_ALERT] ⚠️ Email sending failed (will retry) - Job Seeker ID: ' . $jobSeeker->id . ' - ' . substr($errorMsg, 0, 100));
                        } else {
                            // This is a real dispatch error (serialization, queue connection, etc.)
                            $emailsFailed++;
                            \Log::error('❌ FAILED to dispatch email job for job seeker ' . $jobSeeker->id . ' (' . $jobSeeker->email . '): ' . $errorMsg);
                            error_log('[JOB_ALERT] ❌ FAILED to dispatch - Job Seeker ID: ' . $jobSeeker->id . ' (' . $jobSeeker->email . ') - Error: ' . $errorMsg);
                        }
                    }
                    
                    // Add to list for display (limit to first 100 for console display)
                    if (count($jobSeekersList) < 100) {
                    $jobSeekerName = $jobSeeker->name ?? ($jobSeeker->full_name ?? ($jobSeeker->first_name . ' ' . $jobSeeker->last_name));
                    $jobSeekersList[] = [
                        'name' => trim($jobSeekerName) ?: 'Job Seeker',
                        'email' => $jobSeeker->email
                    ];
                    }
                    
                    // Log progress every 50 emails
                    if ($emailsQueued % 50 == 0) {
                        \Log::info('[JOB_ALERT] ✅ Queued ' . $emailsQueued . ' emails so far...');
                        error_log('[JOB_ALERT] ✅ Queued ' . $emailsQueued . ' emails so far...');
                    }
                } catch (\Exception $e) {
                    // Catch any other unexpected errors
                    $emailsFailed++;
                    \Log::error('❌ Unexpected error processing job seeker ' . $jobSeeker->id . ' (' . $jobSeeker->email . '): ' . $e->getMessage());
                    error_log('[JOB_ALERT] ❌ Unexpected error - Job Seeker ID: ' . $jobSeeker->id . ' (' . $jobSeeker->email . ') - Error: ' . $e->getMessage());
                }
            }

            \Log::info('Completed queuing new job notification emails', [
                'total_job_seekers' => $totalJobSeekers,
                'emails_queued' => $emailsQueued,
                'emails_failed' => $emailsFailed
            ]);

            // If more than 100 emails queued, add summary message
            if ($emailsQueued > 100 && count($jobSeekersList) >= 100) {
                $jobSeekersList[] = [
                    'name' => '... and ' . ($emailsQueued - 100) . ' more job seekers',
                    'email' => ''
                ];
            }

            return [
                'emails_sent' => $emailsQueued, // Count of queued emails
                'job_seekers_list' => $jobSeekersList
            ];
        } catch (\Exception $e) {
            \Log::error('Error in sendToAllJobSeekers: ' . $e->getMessage());
            error_log('[JOB_ALERT] Error in sendToAllJobSeekers: ' . $e->getMessage());
            return [
                'emails_sent' => 0,
                'job_seekers_list' => []
            ];
        }
    }

    protected function sendNewJobNotificationToJobSeeker(Account $jobSeeker, $job): void
    {
        // Wrap in try-catch to handle mail configuration errors gracefully
        try {
        // Get job location
        $location = 'Any Location';
        if (is_plugin_active('location')) {
            if ($job->city) {
                $location = $job->city->name;
            } elseif ($job->state) {
                $location = $job->state->name;
            } elseif ($job->country) {
                $location = $job->country->name;
            }
        }

        // Get job category
        $jobArea = 'All Categories';
        if ($job->categories && $job->categories->isNotEmpty()) {
            $jobArea = $job->categories->pluck('name')->implode(', ');
        }

        // Get job type
        $jobType = 'All Types';
        if ($job->jobTypes && $job->jobTypes->isNotEmpty()) {
            $jobType = $job->jobTypes->pluck('name')->implode(', ');
        }

        // Get account name
        $accountName = $jobSeeker->name ?? ($jobSeeker->full_name ?? ($jobSeeker->first_name . ' ' . $jobSeeker->last_name));
        $accountName = trim($accountName) ?: 'Job Seeker';

        // Prepare all email parameters/variables
        $emailVariables = [
            'account_name' => $accountName,                    // Job seeker का name
            'alert_name' => 'New Job Opportunity',             // Alert का name
            'job_name' => $job->name,                          // Job का title/name
            'job_url' => $job->url,                            // Job detail page का URL
            'job_description' => strip_tags($job->description ?? ''),  // Job की description (HTML tags removed)
            'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),  // Company का name (अगर hidden नहीं है)
            'job_area' => $jobArea,                            // Job categories (comma separated)
            'job_type' => $jobType,                            // Job types (comma separated)
            'location' => $location,                            // Job location (city/state/country)
            'salary_range' => $this->formatSalaryRange($job),  // Salary range (formatted)
            'view_jobs_url' => JobBoardHelper::getJobsPageURL() ?: url('/jobs'),           // All jobs page का URL
            'unsubscribe_url' => route('public.account.settings'),  // Settings page का URL
        ];
        
        // Log email parameters for debugging
        \Log::info('Sending email to job seeker', [
            'job_seeker_id' => $jobSeeker->id,
            'job_seeker_email' => $jobSeeker->email,
            'job_id' => $job->id,
            'email_variables' => $emailVariables
        ]);
        
        \Log::info('[JOB_ALERT] ========== STARTING EMAIL SEND ==========');
        \Log::info('[JOB_ALERT] Job Seeker ID: ' . $jobSeeker->id);
        \Log::info('[JOB_ALERT] Job Seeker Email: ' . $jobSeeker->email);
        
        // Send email using DIRECT Mail facade (immediate sending, bypasses queue)
        // This ensures emails are sent immediately even if mail driver is 'log' or queue is not running
        $mailDriver = config('mail.default');
        \Log::info('[JOB_ALERT] Mail driver: ' . $mailDriver);
        \Log::info('[JOB_ALERT] Mail host: ' . config('mail.mailers.smtp.host'));
        \Log::info('[JOB_ALERT] Mail port: ' . config('mail.mailers.smtp.port'));
        \Log::info('[JOB_ALERT] Mail from: ' . config('mail.from.address'));
        
        // Always use direct Mail::send() for immediate delivery (bypasses EmailHandler queue)
        \Log::info('[JOB_ALERT] Building email content...');
        $emailContent = $this->buildEmailContent($emailVariables);
        $emailSubject = 'New Job Alert: ' . $emailVariables['job_name'];
        \Log::info('[JOB_ALERT] Email content built. Subject: ' . $emailSubject);
        \Log::info('[JOB_ALERT] Email content length: ' . strlen($emailContent) . ' bytes');
        
        try {
            \Log::info('[JOB_ALERT] Attempting Mail::send()...');
            Mail::send([], [], function ($message) use ($jobSeeker, $emailSubject, $emailContent) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeeker->email)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });
            
            \Log::info('[JOB_ALERT] ✅✅✅ Direct Mail::send() executed successfully for: ' . $jobSeeker->email);
            \Log::info('[JOB_ALERT] ========== EMAIL SEND COMPLETE ==========');
        } catch (\Exception $mailException) {
            \Log::error('[JOB_ALERT] ❌❌❌ Direct Mail::send() FAILED: ' . $mailException->getMessage());
            \Log::error('[JOB_ALERT] Exception file: ' . $mailException->getFile() . ':' . $mailException->getLine());
            \Log::error('[JOB_ALERT] Exception trace: ' . $mailException->getTraceAsString());
            
            // Fallback to EmailHandler if direct send fails
            try {
                \Log::info('[JOB_ALERT] Trying fallback EmailHandler...');
                EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
                    ->setVariableValues($emailVariables)
                    ->sendUsingTemplate('job-alert-notification', $jobSeeker->email);
                \Log::info('[JOB_ALERT] ✅ Fallback EmailHandler used for: ' . $jobSeeker->email);
            } catch (\Exception $e) {
                \Log::error('[JOB_ALERT] ❌ Both methods failed: ' . $e->getMessage());
                throw $mailException; // Throw original exception
            }
        }
        } catch (\Exception $e) {
            // Log error but don't throw - let the caller handle it
            \Log::error('Error sending email to job seeker ' . $jobSeeker->id . ': ' . $e->getMessage());
            error_log('[JOB_ALERT] Error in sendNewJobNotificationToJobSeeker: ' . $e->getMessage());
            throw $e; // Re-throw so caller can count it as failed
        }
    }


    protected function buildEmailContent(array $emailVariables): string
    {
        // Build HTML email content with all job details
        return "
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    h2 { color: #1967d2; }
                        .job-details { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                    <h2>New Job Alert: " . htmlspecialchars($emailVariables['job_name']) . "</h2>
                    <p>Hello " . htmlspecialchars($emailVariables['account_name']) . ",</p>
                    <p>We found a new job opportunity that matches your preferences.</p>
                    
                        <div class='job-details'>
                        <p><strong>Job Title:</strong> " . htmlspecialchars($emailVariables['job_name']) . "</p>
                        " . (!empty($emailVariables['company_name']) ? "<p><strong>Company:</strong> " . htmlspecialchars($emailVariables['company_name']) . "</p>" : "") . "
                        <p><strong>Location:</strong> " . htmlspecialchars($emailVariables['location'] ?? 'Any Location') . "</p>
                        <p><strong>Job Area:</strong> " . htmlspecialchars($emailVariables['job_area'] ?? 'All Categories') . "</p>
                        <p><strong>Job Type:</strong> " . htmlspecialchars($emailVariables['job_type'] ?? 'All Types') . "</p>
                        <p><strong>Salary Range:</strong> " . htmlspecialchars($emailVariables['salary_range'] ?? 'Negotiable') . "</p>
                        </div>
                    
                    " . (!empty($emailVariables['job_description']) ? "<p><strong>Description:</strong></p><p>" . htmlspecialchars(substr($emailVariables['job_description'], 0, 200)) . (strlen($emailVariables['job_description']) > 200 ? '...' : '') . "</p>" : "") . "
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($emailVariables['job_url']) . "' class='button'>View Job Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($emailVariables['view_jobs_url']) . "' style='color: #1967d2; text-decoration: none;'>Browse All Jobs</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        To manage your job alerts, <a href='" . htmlspecialchars($emailVariables['unsubscribe_url']) . "'>click here</a>.
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center;'>
                        Thank you for using our job alert service!<br>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                    </div>
                </body>
                </html>
            ";
    }

    protected function formatSalaryRange($job): string
    {
        if ($job->hide_salary) {
            return trans('plugins/job-board::messages.attractive');
        }

        $currencySymbol = $job->currency ? $job->currency->symbol : '₹';

        if ($job->salary_from && $job->salary_to) {
            return $currencySymbol . number_format($job->salary_from) . ' - ' . $currencySymbol . number_format($job->salary_to);
        } elseif ($job->salary_from) {
            return trans('plugins/job-board::messages.from') . ' ' . $currencySymbol . number_format($job->salary_from);
        }

        return trans('plugins/job-board::messages.negotiable');
    }
}
