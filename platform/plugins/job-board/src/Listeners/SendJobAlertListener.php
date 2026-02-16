<?php

namespace Botble\JobBoard\Listeners;

use Botble\Base\Facades\EmailHandler;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Events\JobPublishedEvent;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\JobAlert;
use Botble\JobBoard\Services\JobAlertService;
use Carbon\Carbon;

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
        // Get all active job alerts
        $alerts = JobAlert::query()
            ->where('is_active', true)
            ->where('frequency', 'instant')
            ->with(['account', 'jobCategory', 'jobType', 'city', 'state', 'country'])
            ->get();

        foreach ($alerts as $alert) {
            // Check if we already sent this job to this alert
            if ($alert->sentJobs()->where('job_id', $job->id)->exists()) {
                continue;
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
                    
                    // Mark job as sent to this alert
                    $alert->sentJobs()->attach($job->id, ['sent_at' => Carbon::now()]);
                    $alert->last_sent_at = Carbon::now();
                    $alert->save();
                    
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

        $accounts = Account::query()
            ->where('type', AccountTypeEnum::JOB_SEEKER)
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
                'view_jobs_url' => route('public.jobs'),
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
        $accounts = Account::query()
            ->where('type', AccountTypeEnum::JOB_SEEKER)
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
                'view_jobs_url' => route('public.jobs'),
                'unsubscribe_url' => route('public.account.settings'),
            ])
            ->sendUsingTemplate('job-alert-notification', $account->email);
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
