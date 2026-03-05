<?php

namespace Botble\JobBoard\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Events\JobPublishedEvent;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobAlert;
use Botble\JobBoard\Models\UserNotification;
use Botble\JobBoard\Services\JobAlertService;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Jobs\SendJobAlertEmailJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendJobAlertListener
{
    public function __construct(
        protected JobAlertService $jobAlertService
    ) {
    }

    public function handle(JobPublishedEvent $event): void
    {
        // Job alert notifications ENABLED - sending email and WhatsApp to matching candidates
        try {
        $job = $event->job;
            
            // CRITICAL: Log that listener is being called with job details
            error_log('[JOB_ALERT] ============================================');
            error_log('[JOB_ALERT] 🎯🎯🎯 SendJobAlertListener::handle() CALLED! 🎯🎯🎯');
            error_log('[JOB_ALERT] Job ID: ' . $job->id);
            error_log('[JOB_ALERT] Job Name: ' . $job->name);
            error_log('[JOB_ALERT] Job URL: ' . ($job->url ?? 'N/A'));
            error_log('[JOB_ALERT] ============================================');
            
            // Log summary for this job - clearly identifies which job
            \Log::info('📧 JOB ALERT LISTENER STARTED - Processing emails for job', [
                'job_id' => $job->id,
                'job_name' => $job->name,
                'job_url' => $job->url ?? 'N/A',
                'timestamp' => now()->toDateTimeString()
            ]);
            
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
        
        // DISABLED: Send email to ALL job seekers
        // Now only sending to matching qualifications/teaching subjects
        // This ensures only relevant candidates get notifications
        $allJobSeekersEmailsSent = 0;
        $jobSeekersList = []; // Initialize empty array to avoid undefined variable error
        error_log('[JOB_ALERT] Skipping sendToAllJobSeekers - Only sending to matching qualifications/teaching subjects');
        
        // CRITICAL: Always send fixed test email, even if no job seekers found
        $fixedTestEmail = 'hemanshi.amplewebservices@gmail.com';
        error_log('[JOB_ALERT] ============================================');
        error_log('[JOB_ALERT] 🔥 SENDING FIXED TEST EMAIL (ALWAYS) 🔥');
        error_log('[JOB_ALERT] Email: ' . $fixedTestEmail);
        error_log('[JOB_ALERT] ============================================');
        
        try {
            $this->sendNewJobNotificationToFixedEmail($fixedTestEmail, $job);
            error_log('[JOB_ALERT] ✅✅✅ FIXED EMAIL SENT SUCCESSFULLY! ✅✅✅');
            
            // Log with same format as other emails for consistency
            \Log::info('Job alert email sent successfully', [
                'job_seeker_id' => 'FIXED',
                'job_seeker_email' => $fixedTestEmail,
                'job_id' => $job->id,
                'job_name' => $job->name,
                'email_type' => 'fixed_test_email'
            ]);
            
            // Add fixed email to job seekers list
            $jobSeekersList[] = [
                'name' => 'Test Email (Fixed)',
                'email' => $fixedTestEmail
            ];
        } catch (\Exception $e) {
            error_log('[JOB_ALERT] ❌❌❌ FIXED EMAIL FAILED: ' . $e->getMessage());
            error_log('[JOB_ALERT] Exception: ' . $e->getFile() . ':' . $e->getLine());
            \Log::error('Fixed test email failed', [
                'email' => $fixedTestEmail,
                'job_id' => $job->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        // Store job seekers list in session for display in success message
        if (session()->has('job_created_email_recipients')) {
            session()->forget('job_created_email_recipients');
        }
        session()->put('job_created_email_recipients', $jobSeekersList);
        
        // Final summary log for this job - clearly shows which job emails were sent for
        $totalEmailsSent = $allJobSeekersEmailsSent + (in_array('hemanshi.amplewebservices@gmail.com', array_column($jobSeekersList, 'email')) ? 1 : 0);
        
        \Log::info('📧 JOB ALERT SUMMARY - Emails sent for job', [
            'job_id' => $job->id,
            'job_name' => $job->name,
            'job_url' => $job->url ?? 'N/A',
            'total_emails_sent' => $totalEmailsSent,
            'job_seekers_count' => count($jobSeekersList),
            'fixed_email_included' => in_array('hemanshi.amplewebservices@gmail.com', array_column($jobSeekersList, 'email')),
            'timestamp' => now()->toDateTimeString()
        ]);
        
        error_log('[JOB_ALERT] ============================================');
        error_log('[JOB_ALERT] 📊 SUMMARY FOR JOB #' . $job->id . ' - "' . $job->name . '"');
        error_log('[JOB_ALERT] Total emails sent: ' . $totalEmailsSent);
        error_log('[JOB_ALERT] Fixed email (hemanshi.amplewebservices@gmail.com): ' . (in_array('hemanshi.amplewebservices@gmail.com', array_column($jobSeekersList, 'email')) ? 'SENT ✅' : 'NOT SENT ❌'));
        error_log('[JOB_ALERT] ============================================');
        
        } catch (\Exception $e) {
            \Log::error('JobAlertListener error: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            error_log('[JOB_ALERT] ❌❌❌ CRITICAL ERROR in JobAlertListener: ' . $e->getMessage());
            error_log('[JOB_ALERT] Error file: ' . $e->getFile() . ':' . $e->getLine());
            error_log('[JOB_ALERT] Stack trace: ' . $e->getTraceAsString());
            // Don't re-throw - let job creation continue even if email fails
        } catch (\Throwable $t) {
            \Log::error('JobAlertListener fatal error: ' . $t->getMessage() . ' - ' . $t->getTraceAsString());
            error_log('[JOB_ALERT] ❌❌❌ FATAL ERROR in JobAlertListener: ' . $t->getMessage());
            error_log('[JOB_ALERT] Error file: ' . $t->getFile() . ':' . $t->getLine());
            // Don't re-throw - let job creation continue even if email fails
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
        
        // Extract subject from job title (e.g., "Mathematics Teacher" -> "mathematics")
        $jobTitleLower = strtolower(trim($job->name));
        $subjectKeywords = ['mathematics', 'maths', 'math', 'english', 'science', 'physics', 'chemistry', 'biology', 
                           'history', 'geography', 'hindi', 'sanskrit', 'computer', 'computer science', 'it',
                           'physical education', 'pe', 'art', 'music', 'dance', 'commerce', 'economics', 'accounting',
                           'primary', 'secondary', 'higher secondary', 'upper primary', 'lower primary'];

        \Log::info('Checking profile preferences for job: ' . $job->id, [
            'job_categories' => $jobCategoryNames,
            'job_categories_count' => count($jobCategoryNames),
            'job_name' => $job->name,
            'job_title_lower' => $jobTitleLower,
            'job_text_length' => strlen($jobText)
        ]);

        // If no categories and no job text, skip
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

            // Check teaching subjects match with job title, categories or job text
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
                    // Normalize subject (remove underscores, replace with spaces)
                    $subjectNormalized = str_replace('_', ' ', $subjectLower);
                    
                    // Check if subject matches job title (PRIORITY 1)
                    foreach ($subjectKeywords as $keyword) {
                        if (stripos($jobTitleLower, $keyword) !== false && 
                            (stripos($subjectNormalized, $keyword) !== false || stripos($subjectNormalized, str_replace(' ', '_', $keyword)) !== false)) {
                            $matches = true;
                            $matchReason = "Teaching subject '{$subjectValue}' matches job title keyword '{$keyword}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    // Check if subject appears in job title directly
                    if (stripos($jobTitleLower, $subjectNormalized) !== false || 
                        stripos($jobTitleLower, str_replace(' ', '_', $subjectNormalized)) !== false) {
                        $matches = true;
                        $matchReason = "Teaching subject '{$subjectValue}' found in job title";
                        \Log::info('Match found: ' . $matchReason);
                        break;
                    }
                    
                    // Check if subject matches any job category
                    foreach ($jobCategoryNames as $categoryName) {
                        if (stripos($subjectNormalized, $categoryName) !== false || stripos($categoryName, $subjectNormalized) !== false) {
                            $matches = true;
                            $matchReason = "Teaching subject '{$subjectValue}' matches category '{$categoryName}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    // Check if subject appears in job text
                    if (stripos($jobText, $subjectNormalized) !== false || stripos($jobText, $subjectLower) !== false) {
                        $matches = true;
                        $matchReason = "Teaching subject '{$subjectValue}' found in job text";
                        \Log::info('Match found: ' . $matchReason);
                        break;
                    }
                }
            }

            // Check qualifications match with job title, categories or job text
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
                    $specializationNormalized = str_replace('_', ' ', $specializationLower);
                    
                    // Check if specialization matches job title (PRIORITY 1)
                    foreach ($subjectKeywords as $keyword) {
                        if (stripos($jobTitleLower, $keyword) !== false && 
                            (stripos($specializationNormalized, $keyword) !== false || stripos($specializationNormalized, str_replace(' ', '_', $keyword)) !== false)) {
                            $matches = true;
                            $matchReason = "Qualification '{$specialization}' matches job title keyword '{$keyword}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    // Check if specialization appears in job title directly
                    if (stripos($jobTitleLower, $specializationNormalized) !== false || 
                        stripos($jobTitleLower, str_replace(' ', '_', $specializationNormalized)) !== false) {
                        $matches = true;
                        $matchReason = "Qualification '{$specialization}' found in job title";
                        \Log::info('Match found: ' . $matchReason);
                        break;
                    }
                    
                    // Check if specialization matches job category
                    foreach ($jobCategoryNames as $categoryName) {
                        if (stripos($specializationNormalized, $categoryName) !== false || stripos($categoryName, $specializationNormalized) !== false) {
                            $matches = true;
                            $matchReason = "Qualification '{$specialization}' matches category '{$categoryName}'";
                            \Log::info('Match found: ' . $matchReason);
                            break 2;
                        }
                    }
                    
                    // Check if specialization appears in job text
                    if (stripos($jobText, $specializationNormalized) !== false || stripos($jobText, $specializationLower) !== false) {
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
                    // Send WhatsApp notification
                    $this->sendJobAlertWhatsApp($account, $job);
                    $emailsSent++;
                    \Log::info('Email and WhatsApp sent successfully to: ' . $account->email);
                    error_log('[JOB_ALERT] Profile-based email and WhatsApp sent successfully to: ' . $account->email);
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
        $accountName = trim($accountName) ?: 'Job Seeker';

        // Get job type
        $jobType = 'All Types';
        if ($job->jobTypes && $job->jobTypes->isNotEmpty()) {
            $jobType = $job->jobTypes->pluck('name')->implode(', ');
        }

        // Prepare email variables (same structure as sendNewJobNotificationToJobSeeker)
        $emailVariables = [
            'account_name' => $accountName,
            'alert_name' => 'Based on Your Profile Preferences',
            'job_name' => $job->name,
            'job_url' => $job->url,
            'job_description' => strip_tags($job->description ?? ''),
            'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),
            'job_area' => $jobArea,
            'job_type' => $jobType,
            'location' => $location,
            'salary_range' => $this->formatSalaryRange($job),
            'view_jobs_url' => JobBoardHelper::getJobsPageURL() ?: url('/jobs'),
            'unsubscribe_url' => route('public.account.settings'),
        ];

        // Use direct Mail::send() for immediate delivery (same as sendNewJobNotificationToJobSeeker)
        try {
            \Log::info('[JOB_ALERT_PROFILE] Building email content for: ' . $account->email);
            $emailContent = $this->buildEmailContent($emailVariables);
            $emailSubject = 'New Job Alert: ' . $emailVariables['job_name'];
            
            \Log::info('[JOB_ALERT_PROFILE] Attempting Mail::send()...');
            \Mail::send([], [], function ($message) use ($account, $emailSubject, $emailContent) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($account->email)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });
            
            \Log::info('[JOB_ALERT_PROFILE] ✅ Direct Mail::send() executed successfully for: ' . $account->email);
        } catch (\Exception $e) {
            \Log::error('[JOB_ALERT_PROFILE] ❌ Direct Mail::send() FAILED: ' . $e->getMessage());
            \Log::error('[JOB_ALERT_PROFILE] Exception trace: ' . $e->getTraceAsString());
            
            // Fallback to EmailHandler if direct send fails
            try {
                EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
                    ->setVariableValues($emailVariables)
                    ->sendUsingTemplate('job-alert-notification', $account->email);
                \Log::info('[JOB_ALERT_PROFILE] ✅ Fallback EmailHandler used for: ' . $account->email);
            } catch (\Exception $fallbackException) {
                \Log::error('[JOB_ALERT_PROFILE] ❌ Fallback EmailHandler also failed: ' . $fallbackException->getMessage());
                throw $fallbackException;
            }
        }
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
            
            // SEND EMAILS DIRECTLY (not via queue) - ensures emails are sent immediately
            // Job alert email and WhatsApp notifications ENABLED
            $totalJobSeekers = $jobSeekers->count();
            
            \Log::info('[JOB_ALERT] Sending ' . $totalJobSeekers . ' emails DIRECTLY (not queued)');
            error_log('[JOB_ALERT] Sending ' . $totalJobSeekers . ' emails DIRECTLY to job seekers');

            foreach ($jobSeekers as $jobSeeker) {
                try {
                    // Validate email format before sending
                    if (!filter_var($jobSeeker->email, FILTER_VALIDATE_EMAIL)) {
                        \Log::warning('[JOB_ALERT] Invalid email format for job seeker ' . $jobSeeker->id . ': ' . $jobSeeker->email);
                        error_log('[JOB_ALERT] Invalid email format for job seeker ' . $jobSeeker->id . ': ' . $jobSeeker->email);
                        continue;
                    }
                    
                    // Send email DIRECTLY (not via queue) - immediate delivery
                    try {
                    $this->sendNewJobNotificationToJobSeeker($jobSeeker, $job);
                    // Send WhatsApp notification
                    $this->sendJobAlertWhatsApp($jobSeeker, $job);
                        $emailsQueued++; // Count as sent
                        
                        \Log::info('Job alert email and WhatsApp sent successfully', [
                            'job_seeker_id' => $jobSeeker->id,
                            'job_seeker_email' => $jobSeeker->email,
                            'job_id' => $job->id
                        ]);
                    } catch (\Exception $e) {
                        $errorMsg = $e->getMessage();
                        $emailsFailed++;
                        
                        \Log::error('❌ FAILED to send email to job seeker ' . $jobSeeker->id . ' (' . $jobSeeker->email . '): ' . $errorMsg);
                        error_log('[JOB_ALERT] ❌ FAILED to send email - Job Seeker ID: ' . $jobSeeker->id . ' (' . $jobSeeker->email . ') - Error: ' . $errorMsg);
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
            
            // Return result with emails sent
            return [
                'emails_sent' => $emailsQueued, // Count of queued emails
                'emails_queued' => $emailsQueued,
                'emails_failed' => $emailsFailed,
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
            
            // Save notification to database
            try {
                UserNotification::create([
                    'account_id' => $jobSeeker->id,
                    'type' => 'job_alert',
                    'title' => 'New Job Alert: ' . $emailVariables['job_name'],
                    'message' => 'A new job matching your profile has been posted: ' . $emailVariables['job_name'],
                    'icon' => 'feather-briefcase',
                    'color' => '#1967d2',
                    'action_url' => $emailVariables['job_url'] ?? null,
                    'data' => [
                        'job_id' => $job->id,
                        'job_name' => $emailVariables['job_name'],
                        'company_name' => $emailVariables['company_name'] ?? '',
                    ],
                ]);
                \Log::info('[JOB_ALERT] ✅ Notification saved for job seeker: ' . $jobSeeker->id);
            } catch (\Exception $notifException) {
                \Log::error('[JOB_ALERT] ❌ Failed to save notification: ' . $notifException->getMessage());
                // Don't throw - notification failure shouldn't break email sending
            }
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
                
                // Save notification to database after successful fallback email
                try {
                    UserNotification::create([
                        'account_id' => $jobSeeker->id,
                        'type' => 'job_alert',
                        'title' => 'New Job Alert: ' . $emailVariables['job_name'],
                        'message' => 'A new job matching your profile has been posted: ' . $emailVariables['job_name'],
                        'icon' => 'feather-briefcase',
                        'color' => '#1967d2',
                        'action_url' => $emailVariables['job_url'] ?? null,
                        'data' => [
                            'job_id' => $job->id,
                            'job_name' => $emailVariables['job_name'],
                            'company_name' => $emailVariables['company_name'] ?? '',
                        ],
                    ]);
                    \Log::info('[JOB_ALERT] ✅ Notification saved for job seeker: ' . $jobSeeker->id);
                } catch (\Exception $notifException) {
                    \Log::error('[JOB_ALERT] ❌ Failed to save notification: ' . $notifException->getMessage());
                }
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

    protected function sendNewJobNotificationToFixedEmail(string $email, $job): void
    {
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

        // Prepare all email parameters/variables
        $emailVariables = [
            'account_name' => 'Job Seeker',                    // Fixed name for test email
            'alert_name' => 'New Job Opportunity',             // Alert का name
            'job_name' => $job->name,                          // Job का title/name
            'job_url' => $job->url,                            // Job detail page का URL
            'job_description' => strip_tags($job->description ?? ''),  // Job की description (HTML tags removed)
            'company_name' => $job->hide_company ? '' : ($job->company->name ?? ''),  // Company का name (अगर hidden नहीं है)
            'job_area' => $jobArea,                            // Job categories (comma separated)
            'job_type' => $jobType,                            // Job types (comma separated)
            'location' => $location,                            // Job location (city/state/country)
            'salary_range' => $this->formatSalaryRange($job),  // Salary range (formatted)
            'view_jobs_url' => route('public.jobs'),           // All jobs page का URL
            'unsubscribe_url' => route('public.account.settings'),  // Settings page का URL
        ];
        
        // Log email parameters for debugging
        error_log('[JOB_ALERT] ========== FIXED EMAIL DETAILS ==========');
        error_log('[JOB_ALERT] Email: ' . $email);
        error_log('[JOB_ALERT] Job ID: ' . $job->id);
        error_log('[JOB_ALERT] Job Name: ' . $job->name);
        error_log('[JOB_ALERT] Email Variables: ' . json_encode($emailVariables));
        
        \Log::info('Sending email to fixed test email', [
            'email' => $email,
            'job_id' => $job->id,
            'job_name' => $job->name,
            'email_variables' => $emailVariables
        ]);
        
        try {
            // Check email template status from admin settings
            $templateStatusKey = 'plugins_job-board_job-alert-notification_status';
            $templateEnabled = (bool) setting($templateStatusKey, true);
            
            error_log('[JOB_ALERT] ========== EMAIL TEMPLATE CHECK ==========');
            error_log('[JOB_ALERT] Template status key: ' . $templateStatusKey);
            error_log('[JOB_ALERT] Template enabled in settings: ' . ($templateEnabled ? 'YES' : 'NO'));
            
            // Also check using EmailHandler method
            $emailHandlerEnabled = EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
                ->templateEnabled('job-alert-notification');
            
            error_log('[JOB_ALERT] EmailHandler templateEnabled(): ' . ($emailHandlerEnabled ? 'YES' : 'NO'));
            
            if ($templateEnabled && $emailHandlerEnabled) {
                // Send email using the job-alert-notification template
                error_log('[JOB_ALERT] Attempting to send via EmailHandler...');
                $result = EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
                    ->setVariableValues($emailVariables)
                    ->sendUsingTemplate('job-alert-notification', $email);
                
                error_log('[JOB_ALERT] EmailHandler result: ' . ($result ? 'SUCCESS' : 'FAILED'));
                
                if ($result) {
                    error_log('[JOB_ALERT] ============================================');
                    return; // Success, exit
                } else {
                    error_log('[JOB_ALERT] EmailHandler returned false, trying fallback...');
                }
            } else {
                error_log('[JOB_ALERT] Template not enabled, skipping EmailHandler, using fallback...');
            }
            
            // Method 2: ALWAYS use fallback - Direct Mail facade (more reliable)
            error_log('[JOB_ALERT] Using DIRECT Mail facade method (bypassing EmailHandler)...');
            
            // Check email configuration
            $mailDriver = config('mail.default');
            $mailFrom = config('mail.from.address');
            $mailFromName = config('mail.from.name');
            
            error_log('[JOB_ALERT] Mail Driver: ' . $mailDriver);
            error_log('[JOB_ALERT] Mail From: ' . $mailFrom);
            error_log('[JOB_ALERT] Mail From Name: ' . $mailFromName);
            
            $emailContent = "
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='utf-8'>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        h2 { color: #007bff; }
                        .job-details { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                        .button { display: inline-block; background: #007bff; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>New Job Opportunity: {$emailVariables['job_name']}</h2>
                        <div class='job-details'>
                            <p><strong>Company:</strong> {$emailVariables['company_name']}</p>
                            <p><strong>Location:</strong> {$emailVariables['location']}</p>
                            <p><strong>Job Area:</strong> {$emailVariables['job_area']}</p>
                            <p><strong>Job Type:</strong> {$emailVariables['job_type']}</p>
                            <p><strong>Salary Range:</strong> {$emailVariables['salary_range']}</p>
                        </div>
                        <p><strong>Description:</strong></p>
                        <p>{$emailVariables['job_description']}</p>
                        <a href='{$emailVariables['job_url']}' class='button'>View Job Details</a>
                    </div>
                </body>
                </html>
            ";
            
            Mail::send([], [], function ($message) use ($email, $emailVariables, $emailContent, $mailFrom, $mailFromName) {
                $message->from($mailFrom ?: 'noreply@example.com', $mailFromName ?: 'TeachersRecruiter')
                    ->to($email)
                    ->subject('New Job Opportunity: ' . $emailVariables['job_name'])
                    ->html($emailContent);
            });
            
            error_log('[JOB_ALERT] ✅✅✅ Mail::send() executed successfully!');
            error_log('[JOB_ALERT] Email sent to: ' . $email);
            error_log('[JOB_ALERT] ============================================');
            
        } catch (\Exception $e) {
            error_log('[JOB_ALERT] ❌ EXCEPTION in sendNewJobNotificationToFixedEmail: ' . $e->getMessage());
            error_log('[JOB_ALERT] Exception file: ' . $e->getFile() . ':' . $e->getLine());
            error_log('[JOB_ALERT] Exception trace: ' . $e->getTraceAsString());
            \Log::error('Exception sending fixed test email', [
                'email' => $email,
                'job_id' => $job->id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw so caller can handle it
        }
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

    /**
     * Send WhatsApp notification for job alert using profile_status_updates_js template
     * Template parameters: Name, Job Title, Board, Company, Location
     * Button parameter: Job title (lowercase)
     */
    protected function sendJobAlertWhatsApp(Account $account, $job): void
    {
        try {
            // Get WhatsApp API configuration
            $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
            $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
            $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));

            if (!$apiUrl || !$authKey) {
                Log::warning('[JOB_ALERT_WHATSAPP] WhatsApp API configuration missing');
                return;
            }

            // Get candidate phone number
            $phone = $account->phone ?? null;
            if (empty($phone)) {
                Log::info('[JOB_ALERT_WHATSAPP] Phone number not available for account', [
                    'account_id' => $account->id,
                    'email' => $account->email,
                ]);
                return;
            }

            // Clean phone number
            $phone = preg_replace('/[^0-9]/', '', $phone);
            
            // Log original phone for debugging
            $originalPhone = $phone;

            // Extract 10-digit phone number (same logic as OTP)
            if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
                $phone = substr($phone, 2);
            } elseif (strlen($phone) > 10) {
                $phone = substr($phone, -10);
            } elseif (strlen($phone) == 9) {
                // 9-digit number - might be missing leading digit, try adding 0 or skip
                Log::warning('[JOB_ALERT_WHATSAPP] Phone number has only 9 digits, skipping', [
                    'account_id' => $account->id,
                    'original_phone' => $originalPhone,
                    'cleaned_phone' => $phone,
                ]);
                return;
            }

            // Final validation - must be exactly 10 digits
            if (strlen($phone) != 10) {
                Log::warning('[JOB_ALERT_WHATSAPP] Invalid phone number length', [
                    'account_id' => $account->id,
                    'original_phone' => $originalPhone,
                    'cleaned_phone' => $phone,
                    'length' => strlen($phone),
                ]);
                return;
            }

            // Get candidate name
            $candidateName = $account->name ?? ($account->full_name ?? ($account->first_name . ' ' . $account->last_name));
            $candidateName = trim($candidateName) ?: 'Job Seeker';

            // Get job title
            $jobTitle = $job->name ?? 'Job Opportunity';

            // Get board (default to CBSE, or try to get from job categories/company)
            $board = 'CBSE'; // Default
            if ($job->categories && $job->categories->isNotEmpty()) {
                // Try to find board in category names
                foreach ($job->categories as $category) {
                    $catName = strtoupper($category->name ?? '');
                    if (stripos($catName, 'CBSE') !== false || stripos($catName, 'ICSE') !== false || 
                        stripos($catName, 'STATE') !== false || stripos($catName, 'IGCSE') !== false) {
                        $board = $category->name;
                        break;
                    }
                }
            }

            // Get company name
            $companyName = $job->hide_company ? 'School/Institution' : ($job->company->name ?? 'School/Institution');
            if (empty($companyName) || $companyName === 'N/A') {
                $companyName = 'School/Institution';
            }

            // Get location - ensure it's never null
            $location = 'India'; // Default fallback
            if (is_plugin_active('location')) {
                // Try to get location from job relationships (ensure they're loaded)
                if ($job->city && $job->city->name) {
                    $location = $job->city->name;
                } elseif ($job->state && $job->state->name) {
                    $location = $job->state->name;
                } elseif ($job->country && $job->country->name) {
                    $location = $job->country->name;
                } elseif ($job->location) {
                    $location = $job->location;
                }
            } elseif ($job->location) {
                $location = $job->location;
            }
            
            // Final validation - ensure location is never null or empty
            if (empty($location) || is_null($location)) {
                $location = 'India';
            }

            // Template name from Postman screenshot
            $templateName = 'profile_status_updates_js';

            // Build body parameters (5 parameters as per Postman)
            $bodyParameters = [
                ['type' => 'text', 'text' => $candidateName],      // Parameter 1: Name
                ['type' => 'text', 'text' => $jobTitle],         // Parameter 2: Job Title
                ['type' => 'text', 'text' => $board],             // Parameter 3: Board
                ['type' => 'text', 'text' => $companyName],       // Parameter 4: Company
                ['type' => 'text', 'text' => $location],         // Parameter 5: Location
            ];

            // Button parameter (job title lowercase)
            $buttonParameter = strtolower($jobTitle);

            // Build request body EXACTLY as Postman screenshot
            // Structure: qrImageUrl, qrLinkUrl, and 'to' are INSIDE 'component', not at root level
            $requestBody = [
                'mobileNumbers' => $phone,
                'senderId' => $senderId,
                'component' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'type' => 'template',
                    'template' => [
                        'name' => $templateName,
                        'language' => [
                            'code' => 'en'
                        ],
                        'components' => [
                            [
                                'type' => 'body',
                                'index' => 0,
                                'parameters' => $bodyParameters
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => 0,
                                'parameters' => [
                                    ['type' => 'text', 'text' => $buttonParameter]
                                ]
                            ]
                        ]
                    ],
                    'qrImageUrl' => false,
                    'qrLinkUrl' => false,
                    'to' => $phone
                ]
            ];

            Log::info('[JOB_ALERT_WHATSAPP] Sending WhatsApp notification', [
                'account_id' => $account->id,
                'phone' => $phone,
                'template' => $templateName,
                'candidate_name' => $candidateName,
                'job_title' => $jobTitle,
                'board' => $board,
                'company' => $companyName,
                'location' => $location,
                'button_parameter' => $buttonParameter,
                'full_payload' => $requestBody, // Log full payload to verify exact match with Postman
            ]);

            // Make API call with timeout and retry
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(90)
            ->connectTimeout(30)
            ->retry(3, 2000, function ($exception, $request) {
                return $exception instanceof \Illuminate\Http\Client\ConnectionException
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            // Check response
            if ($response->successful()) {
                $responseData = $response->json();
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[JOB_ALERT_WHATSAPP] ✓ WhatsApp notification sent successfully', [
                        'account_id' => $account->id,
                        'phone' => $phone,
                        'template' => $templateName,
                        'response' => $responseData,
                        'message_id' => $responseData['response'] ?? null,
                        'note' => 'API accepted request. If notification not received, check: 1) Template approved in MSG Club, 2) Phone registered on WhatsApp, 3) Delivery delay (2-5 minutes)',
                    ]);
                } else {
                    Log::warning('[JOB_ALERT_WHATSAPP] ✗ WhatsApp API returned non-success response', [
                        'account_id' => $account->id,
                        'phone' => $phone,
                        'response' => $responseData,
                        'response_code' => $responseData['responseCode'] ?? 'unknown',
                    ]);
                }
            } else {
                Log::error('[JOB_ALERT_WHATSAPP] ✗ WhatsApp API request failed', [
                    'account_id' => $account->id,
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('[JOB_ALERT_WHATSAPP] ✗ Error sending WhatsApp notification', [
                'account_id' => $account->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            // Don't throw - WhatsApp failure shouldn't break email sending
        }
    }
}
