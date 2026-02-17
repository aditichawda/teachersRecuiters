<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendJobAlertEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Account $jobSeeker,
        public Job $jobPost
    ) {
        // Set queue name for better organization
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Get job location
            $location = 'Any Location';
            if (is_plugin_active('location')) {
                if ($this->jobPost->city) {
                    $location = $this->jobPost->city->name;
                } elseif ($this->jobPost->state) {
                    $location = $this->jobPost->state->name;
                } elseif ($this->jobPost->country) {
                    $location = $this->jobPost->country->name;
                }
            }

            // Get job category
            $jobArea = 'All Categories';
            if ($this->jobPost->categories && $this->jobPost->categories->isNotEmpty()) {
                $jobArea = $this->jobPost->categories->pluck('name')->implode(', ');
            }

            // Get job type
            $jobType = 'All Types';
            if ($this->jobPost->jobTypes && $this->jobPost->jobTypes->isNotEmpty()) {
                $jobType = $this->jobPost->jobTypes->pluck('name')->implode(', ');
            }

            // Get account name
            $accountName = $this->jobSeeker->name ?? ($this->jobSeeker->full_name ?? ($this->jobSeeker->first_name . ' ' . $this->jobSeeker->last_name));
            $accountName = trim($accountName) ?: 'Job Seeker';

            // Get job URL - ensure it's absolute
            $jobUrl = $this->jobPost->url;
            // If URL is relative, make it absolute
            if (!filter_var($jobUrl, FILTER_VALIDATE_URL)) {
                $jobUrl = url($jobUrl);
            }

            // Prepare email variables
            $emailVariables = [
                'account_name' => $accountName,
                'alert_name' => 'New Job Opportunity',
                'job_name' => $this->jobPost->name,
                'job_url' => $jobUrl,
                'job_description' => strip_tags($this->jobPost->description ?? ''),
                'company_name' => $this->jobPost->hide_company ? '' : ($this->jobPost->company->name ?? ''),
                'job_area' => $jobArea,
                'job_type' => $jobType,
                'location' => $location,
                'salary_range' => $this->formatSalaryRange($this->jobPost),
                'view_jobs_url' => \Botble\JobBoard\Facades\JobBoardHelper::getJobsPageURL() ?: url('/jobs'),
                'unsubscribe_url' => route('public.account.settings'),
            ];

            // Build email content
            $emailContent = $this->buildEmailContent($emailVariables);
            $emailSubject = 'New Job Alert: ' . $emailVariables['job_name'];

            // Send email
            Mail::send([], [], function ($message) use ($emailSubject, $emailContent) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($this->jobSeeker->email)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });

            Log::info('Job alert email sent successfully', [
                'job_seeker_id' => $this->jobSeeker->id,
                'job_seeker_email' => $this->jobSeeker->email,
                'job_id' => $this->jobPost->id,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send job alert email', [
                'job_seeker_id' => $this->jobSeeker->id,
                'job_seeker_email' => $this->jobSeeker->email,
                'job_id' => $this->jobPost->id,
                'error' => $e->getMessage(),
            ]);

            throw $e; // Re-throw to trigger retry
        }
    }

    /**
     * Build HTML email content
     */
    protected function buildEmailContent(array $emailVariables): string
    {
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

    /**
     * Format salary range
     */
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
