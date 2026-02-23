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
                    .header { background: linear-gradient(135deg, #1967d2 0%, #4285f4 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                    h2 { color: white; margin: 0; font-size: 28px; }
                    .success-box { background: #d4edda; border: 2px solid #28a745; padding: 25px; border-radius: 8px; margin: 20px 0; text-align: center; }
                    .info-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #1967d2; }
                    .motivational-box { background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #2196f3; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 14px 28px; text-decoration: none; border-radius: 6px; margin-top: 15px; font-weight: bold; transition: background 0.3s; }
                    .button:hover { background: #1557a0; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>✅ Application Submitted Successfully! 🎉</h2>
                    </div>
                    
                    <p style='font-size: 16px; margin-top: 20px;'>Namaste " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <div class='success-box'>
                        <p style='margin: 0; color: #155724; font-weight: bold; font-size: 18px;'>✓ Aapka Application Successfully Submit Ho Gaya Hai!</p>
                        <p style='margin: 10px 0 0 0; color: #155724; font-size: 16px;'>Your application has been successfully submitted and received!</p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Application Details / आवेदन की जानकारी:</h3>
                        <p style='font-size: 15px;'><strong>Position / पद:</strong> " . htmlspecialchars($variables['job_name']) . "</p>
                        <p style='font-size: 15px;'><strong>Company / संस्था:</strong> " . htmlspecialchars($variables['company_name']) . "</p>
                    </div>
                    
                    <div class='motivational-box'>
                        <h3 style='color: #1565c0; margin-top: 0; font-size: 18px;'>🌟 Aapne Pehla Kadam Uthaya Hai! 🌟</h3>
                        <p style='margin: 10px 0; color: #1565c0; font-size: 15px;'><strong>Badhai ho!</strong> Aapne apne career mein ek important step liya hai. Aapka application ab review ke liye ready hai.</p>
                        <p style='margin: 10px 0; color: #1565c0; font-size: 15px;'>Congratulations on taking this important step in your career! Your application is now in the review process. Remember, every expert was once a beginner - you're on the right path! 🚀</p>
                        <p style='margin: 10px 0; color: #1565c0; font-size: 15px;'><strong>Stay positive and keep moving forward!</strong> / <strong>सकारात्मक रहें और आगे बढ़ते रहें!</strong></p>
                    </div>
                    
                    <p style='font-size: 15px;'>Thank you for your interest in this position. We have received your application and our team will review it carefully.</p>
                    <p style='font-size: 15px;'>इस पद में आपकी रुचि के लिए धन्यवाद। हमें आपका आवेदन प्राप्त हो गया है और हमारी टीम इसे ध्यान से समीक्षा करेगी।</p>
                    
                    <p style='font-size: 15px; color: #1967d2;'><strong>What Happens Next? / आगे क्या होगा?</strong></p>
                    <ul style='font-size: 14px; line-height: 1.8;'>
                        <li>Our team will carefully review your application</li>
                        <li>You will be notified via email about the status</li>
                        <li>Please keep an eye on your inbox for updates</li>
                        <li>Apne email aur phone notifications ko active rakhein</li>
                    </ul>
                    
                    <p style='text-align: center; margin: 25px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' class='button'>View Job Details / नौकरी की जानकारी देखें</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' style='color: #1967d2; text-decoration: none; font-size: 14px;'>View All My Applications / मेरे सभी आवेदन देखें</a>
                    </p>
                    
                    <p style='font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                        Best of luck with your application!<br>
                        Aapke application ke liye best of luck!<br><br>
                        Best regards / शुभकामनाएं,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
