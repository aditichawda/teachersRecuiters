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

class SendJobSeekerStatusUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public JobApplication $application,
        public Job $job,
        public JobApplicationStatusEnum $oldStatus,
        public JobApplicationStatusEnum $newStatus
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            // Only send emails for shortlisted and rejected statuses
            if ($this->newStatus->getValue() !== JobApplicationStatusEnum::SHORTLISTED && 
                $this->newStatus->getValue() !== JobApplicationStatusEnum::REJECTED) {
                return;
            }

            $jobSeekerEmail = $this->application->email;
            
            if (!filter_var($jobSeekerEmail, FILTER_VALIDATE_EMAIL)) {
                Log::warning('Invalid email for job seeker status update', [
                    'application_id' => $this->application->id,
                    'email' => $jobSeekerEmail,
                ]);
                return;
            }

            $jobSeekerName = $this->application->full_name;
            $jobUrl = $this->job->url;
            if (!filter_var($jobUrl, FILTER_VALIDATE_URL)) {
                $jobUrl = url($jobUrl);
            }

            $isShortlisted = $this->newStatus->getValue() === JobApplicationStatusEnum::SHORTLISTED;
            $isRejected = $this->newStatus->getValue() === JobApplicationStatusEnum::REJECTED;

            $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
                'job_name' => $this->job->name,
                'company_name' => $this->job->company->name ?? 'N/A',
                'job_url' => $jobUrl,
                'is_shortlisted' => $isShortlisted,
                'is_rejected' => $isRejected,
                'view_applications_url' => route('public.account.jobs.applied-jobs'),
            ]);

            $emailSubject = $isShortlisted 
                ? 'Congratulations! You\'ve been Shortlisted - ' . $this->job->name
                : 'Update on Your Application - ' . $this->job->name;

            Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $jobSeekerEmail) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeekerEmail)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });

            Log::info('Job seeker status update email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'old_status' => $this->oldStatus->getValue(),
                'new_status' => $this->newStatus->getValue(),
                'email' => $jobSeekerEmail,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send job seeker status update email', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function buildEmailContent(array $variables): string
    {
        if ($variables['is_shortlisted']) {
            return $this->buildShortlistedEmail($variables);
        } elseif ($variables['is_rejected']) {
            return $this->buildRejectedEmail($variables);
        }

        return '';
    }

    protected function buildShortlistedEmail(array $variables): string
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
                    .success-box { background: #d4edda; border: 2px solid #28a745; padding: 20px; border-radius: 5px; margin: 15px 0; text-align: center; }
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .button { display: inline-block; background: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Congratulations! 🎉</h2>
                    <p>Hello " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <div class='success-box'>
                        <h3 style='margin: 0; color: #155724;'>You've Been Shortlisted!</h3>
                        <p style='margin: 10px 0 0 0; color: #155724; font-size: 16px;'>We are pleased to inform you that your application has been shortlisted for the next stage.</p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Position Details:</h3>
                        <p><strong>Position:</strong> " . htmlspecialchars($variables['job_name']) . "</p>
                        <p><strong>Company:</strong> " . htmlspecialchars($variables['company_name']) . "</p>
                    </div>
                    
                    <p>This is excellent news! Your qualifications and experience have impressed our hiring team. We will be in touch with you shortly to discuss the next steps in the hiring process.</p>
                    
                    <p>Please keep an eye on your email and phone for further communication from our team. We may reach out to schedule an interview or request additional information.</p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' class='button'>View Job Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' style='color: #1967d2; text-decoration: none;'>View All My Applications</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        We look forward to speaking with you soon!<br>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }

    protected function buildRejectedEmail(array $variables): string
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
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .encouragement-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 15px 0; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Update on Your Application</h2>
                    <p>Hello " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <p>Thank you for taking the time to apply for the position of <strong>" . htmlspecialchars($variables['job_name']) . "</strong> at <strong>" . htmlspecialchars($variables['company_name']) . "</strong>.</p>
                    
                    <div class='info-box'>
                        <p>After careful consideration, we regret to inform you that we have decided to move forward with other candidates whose qualifications more closely match our current needs.</p>
                    </div>
                    
                    <div class='encouragement-box'>
                        <p style='margin: 0;'><strong>Please don't be discouraged!</strong></p>
                        <p style='margin: 10px 0 0 0;'>This decision was not an easy one, and we were impressed by your application. We encourage you to continue applying for positions that align with your skills and experience.</p>
                    </div>
                    
                    <p>We appreciate your interest in joining our team and wish you the very best in your job search. We will keep your application on file and may contact you if a more suitable position becomes available in the future.</p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' class='button'>Browse More Opportunities</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        Thank you again for your interest, and we wish you success in your career journey.<br>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
