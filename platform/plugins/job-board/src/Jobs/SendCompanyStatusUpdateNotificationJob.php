<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Enums\JobApplicationStatusEnum;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCompanyStatusUpdateNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public JobApplication $application,
        public Job $jobModel,
        public JobApplicationStatusEnum $oldStatus,
        public JobApplicationStatusEnum $newStatus
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            // Handle enum serialization issue - convert string to enum if needed
            if (is_string($this->oldStatus)) {
                $this->oldStatus = (new JobApplicationStatusEnum())->make($this->oldStatus);
            }
            if (is_string($this->newStatus)) {
                $this->newStatus = (new JobApplicationStatusEnum())->make($this->newStatus);
            }
            
            // Get employer emails
            $employerEmails = array_filter($this->jobModel->employer_emails ?: []);

            if (empty($employerEmails)) {
                Log::warning('No employer emails found for status update notification', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                ]);
                return;
            }

            // Get candidate details
            $candidateName = $this->application->full_name;
            $candidateEmail = $this->application->email ?? 'N/A';
            $candidatePhone = $this->application->phone ?? 'N/A';
            $status = $this->newStatus->getValue();
            $statusLabel = $this->newStatus->label();

            // Build email content
            $emailContent = $this->buildEmailContent([
                'candidate_name' => $candidateName,
                'candidate_email' => $candidateEmail,
                'candidate_phone' => $candidatePhone,
                'job_name' => $this->jobModel->name,
                'company_name' => $this->jobModel->company->name ?? 'N/A',
                'status' => $status,
                'status_label' => $statusLabel,
                'old_status' => $this->oldStatus->getValue(),
                'old_status_label' => $this->oldStatus->label(),
                'application_url' => route('public.account.applicants.edit', ['applicant' => $this->application->id]),
                'job_url' => $this->jobModel->url,
            ]);

            $emailSubject = 'Application Status Updated: ' . $candidateName . ' - ' . $this->jobModel->name . ' (' . $statusLabel . ')';

            // Send to all employer emails
            foreach ($employerEmails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $email) {
                    $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                        ->to($email)
                        ->subject($emailSubject)
                        ->html($emailContent);
                });
            }

            Log::info('Company status update notification email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'old_status' => $this->oldStatus->getValue(),
                'new_status' => $this->newStatus->getValue(),
                'employer_emails' => $employerEmails,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send company status update notification email', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function buildEmailContent(array $variables): string
    {
        $statusColor = match($variables['status']) {
            'short_list' => '#28a745',
            'rejected' => '#dc3545',
            'hired' => '#17a2b8',
            default => '#ffc107',
        };

        return "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    h2 { color: #1967d2; }
                    .status-box { background: #f8f9fa; border-left: 4px solid {$statusColor}; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .info-row { margin: 8px 0; }
                    .info-label { font-weight: bold; color: #333; display: inline-block; min-width: 140px; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Application Status Update</h2>
                    <p>Hello,</p>
                    <p>The application status for a candidate has been updated for the position: <strong>" . htmlspecialchars($variables['job_name']) . "</strong></p>
                    
                    <div class='status-box'>
                        <h3 style='margin: 0 0 10px 0; color: {$statusColor};'>Status Changed</h3>
                        <p style='margin: 0;'><strong>Previous Status:</strong> " . htmlspecialchars($variables['old_status_label']) . "</p>
                        <p style='margin: 5px 0 0 0;'><strong>New Status:</strong> <span style='color: {$statusColor}; font-weight: bold;'>" . htmlspecialchars($variables['status_label']) . "</span></p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Candidate Details:</h3>
                        <div class='info-row'>
                            <span class='info-label'>Name:</span>
                            <span>" . htmlspecialchars($variables['candidate_name']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Email:</span>
                            <span><a href='mailto:" . htmlspecialchars($variables['candidate_email']) . "'>" . htmlspecialchars($variables['candidate_email']) . "</a></span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Phone:</span>
                            <span>" . htmlspecialchars($variables['candidate_phone']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Position:</span>
                            <span>" . htmlspecialchars($variables['job_name']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Company:</span>
                            <span>" . htmlspecialchars($variables['company_name']) . "</span>
                        </div>
                    </div>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['application_url']) . "' class='button'>View Application Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' style='color: #1967d2; text-decoration: none;'>View Job Posting</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
