<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendJobSeekerApplicationConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public function __construct(
        public JobApplication $application,
        public Job $job
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            $jobSeekerEmail = $this->application->email;
            
            if (!filter_var($jobSeekerEmail, FILTER_VALIDATE_EMAIL)) {
                Log::warning('Invalid email for job seeker application confirmation', [
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

            $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
                'job_name' => $this->job->name,
                'company_name' => $this->job->company->name ?? 'N/A',
                'job_url' => $jobUrl,
                'view_applications_url' => route('public.account.jobs.applied-jobs'),
            ]);

            $emailSubject = 'Application Confirmed: ' . $this->job->name;

            Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $jobSeekerEmail) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeekerEmail)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });

            Log::info('Job seeker application confirmation email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'email' => $jobSeekerEmail,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send job seeker application confirmation email', [
                'application_id' => $this->application->id,
                'job_id' => $this->job->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function buildEmailContent(array $variables): string
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
                    .success-box { background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>Application Received Successfully!</h2>
                    <p>Hello " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <div class='success-box'>
                        <p style='margin: 0; color: #155724; font-weight: bold;'>✓ Your application has been successfully submitted!</p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Application Details:</h3>
                        <p><strong>Position:</strong> " . htmlspecialchars($variables['job_name']) . "</p>
                        <p><strong>Company:</strong> " . htmlspecialchars($variables['company_name']) . "</p>
                    </div>
                    
                    <p>Thank you for your interest in this position. We have received your application and our team will review it carefully.</p>
                    
                    <p>You will be notified via email once we have reviewed your application. Please keep an eye on your inbox for updates.</p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' class='button'>View Job Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' style='color: #1967d2; text-decoration: none;'>View All My Applications</a>
                    </p>
                    
                    <p style='font-size: 12px; color: #666; text-align: center; margin-top: 30px;'>
                        Best of luck with your application!<br>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
