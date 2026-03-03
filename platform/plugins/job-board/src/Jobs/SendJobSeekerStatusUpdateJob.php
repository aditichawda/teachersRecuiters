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
        public Job $jobModel,
        public JobApplicationStatusEnum $oldStatus,
        public JobApplicationStatusEnum $newStatus
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            // Only send emails for shortlisted and rejected statuses
            $newStatusValue = $this->newStatus->getValue();
            if ($newStatusValue !== JobApplicationStatusEnum::SHORT_LIST->getValue() &&
                $newStatusValue !== JobApplicationStatusEnum::REJECTED->getValue()) {
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
            $jobUrl = $this->jobModel->url;
            if (!filter_var($jobUrl, FILTER_VALIDATE_URL)) {
                $jobUrl = url($jobUrl);
            }

            $isShortlisted = $newStatusValue === JobApplicationStatusEnum::SHORT_LIST->getValue();
            $isRejected = $newStatusValue === JobApplicationStatusEnum::REJECTED->getValue();

            $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
                'job_name' => $this->jobModel->name,
                'company_name' => $this->jobModel->company->name ?? 'N/A',
                'job_url' => $jobUrl,
                'is_shortlisted' => $isShortlisted,
                'is_rejected' => $isRejected,
                'view_applications_url' => route('public.account.jobs.applied-jobs'),
            ]);

            $emailSubject = $isShortlisted 
                ? 'Congratulations! You\'ve been Shortlisted - ' . $this->job->name
                : 'Update on Your Application - ' . $this->jobModel->name;

            Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $jobSeekerEmail) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeekerEmail)
                    ->subject($emailSubject)
                    ->html($emailContent);
            });

            Log::info('Job seeker status update email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'old_status' => $this->oldStatus->getValue(),
                'new_status' => $this->newStatus->getValue(),
                'email' => $jobSeekerEmail,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send job seeker status update email', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
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
                    .header { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
                    h2 { color: white; margin: 0; font-size: 28px; }
                    .success-box { background: #d4edda; border: 2px solid #28a745; padding: 25px; border-radius: 8px; margin: 20px 0; text-align: center; }
                    .info-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #1967d2; }
                    .motivational-box { background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107; }
                    .button { display: inline-block; background: #28a745; color: white; padding: 14px 28px; text-decoration: none; border-radius: 6px; margin-top: 15px; font-weight: bold; transition: background 0.3s; }
                    .button:hover { background: #218838; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>🎉 Congratulations! Badhai Ho! 🎉</h2>
                    </div>
                    
                    <p style='font-size: 16px; margin-top: 20px;'>Namaste " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <div class='success-box'>
                        <h3 style='margin: 0; color: #155724; font-size: 22px;'>Aap Shortlisted Ho Gaye Hain! 🎊</h3>
                        <p style='margin: 10px 0 0 0; color: #155724; font-size: 16px;'>We are extremely pleased to inform you that your application has been shortlisted for the next stage of the selection process.</p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Position Details / पद की जानकारी:</h3>
                        <p style='font-size: 15px;'><strong>Position:</strong> " . htmlspecialchars($variables['job_name']) . "</p>
                        <p style='font-size: 15px;'><strong>Company / संस्था:</strong> " . htmlspecialchars($variables['company_name']) . "</p>
                    </div>
                    
                    <div class='motivational-box'>
                        <h3 style='color: #856404; margin-top: 0; font-size: 18px;'>🌟 Aapka Safar Shuru Ho Chuka Hai! 🌟</h3>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'><strong>Yeh bahut badi baat hai!</strong> Aapke qualifications aur experience ne hiring team ko impress kiya hai. Aapka mehnat rang laaya hai!</p>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'>This is excellent news! Your hard work and dedication have paid off. The hiring team was impressed by your qualifications and experience. You've taken a significant step forward in your career journey!</p>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'><strong>Remember:</strong> Every expert was once a beginner. You're on the right path! 🚀</p>
                    </div>
                    
                    <p style='font-size: 15px;'>We will be in touch with you shortly to discuss the next steps in the hiring process. Please keep an eye on your email and phone for further communication from our team. We may reach out to schedule an interview or request additional information.</p>
                    
                    <p style='font-size: 15px; color: #1967d2;'><strong>Next Steps:</strong></p>
                    <ul style='font-size: 14px; line-height: 1.8;'>
                        <li>Keep your phone and email notifications active</li>
                        <li>Prepare for potential interview questions</li>
                        <li>Review the job requirements once more</li>
                        <li>Stay positive and confident! 💪</li>
                    </ul>
                    
                    <p style='text-align: center; margin: 25px 0;'>
                        <a href='" . htmlspecialchars($variables['job_url']) . "' class='button'>View Job Details / नौकरी की जानकारी देखें</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' style='color: #1967d2; text-decoration: none; font-size: 14px;'>View All My Applications / मेरे सभी आवेदन देखें</a>
                    </p>
                    
                    <p style='font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                        We look forward to speaking with you soon!<br>
                        Aapke saath kaam karke humein khushi hogi!<br><br>
                        Best regards / शुभकामनाएं,<br>
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
                    .header { background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white; padding: 25px; text-align: center; border-radius: 10px 10px 0 0; }
                    h2 { color: white; margin: 0; font-size: 24px; }
                    .info-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #6c757d; }
                    .encouragement-box { background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); padding: 25px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107; }
                    .motivational-quote { background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center; border: 2px solid #2196f3; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 14px 28px; text-decoration: none; border-radius: 6px; margin-top: 15px; font-weight: bold; transition: background 0.3s; }
                    .button:hover { background: #1557a0; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>Update on Your Application / आवेदन पर अपडेट</h2>
                    </div>
                    
                    <p style='font-size: 16px; margin-top: 20px;'>Namaste " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <p style='font-size: 15px;'>Thank you for taking the time to apply for the position of <strong>" . htmlspecialchars($variables['job_name']) . "</strong> at <strong>" . htmlspecialchars($variables['company_name']) . "</strong>.</p>
                    <p style='font-size: 15px;'><strong>" . htmlspecialchars($variables['job_name']) . "</strong> पद के लिए आवेदन करने के लिए धन्यवाद।</p>
                    
                    <div class='info-box'>
                        <p style='font-size: 15px; margin: 0;'>After careful consideration, we regret to inform you that we have decided to move forward with other candidates whose qualifications more closely match our current needs.</p>
                        <p style='font-size: 15px; margin: 10px 0 0 0;'>सावधानीपूर्वक विचार करने के बाद, हमें यह सूचित करते हुए खेद है कि हमने अन्य उम्मीदवारों के साथ आगे बढ़ने का निर्णय लिया है जिनकी योग्यता हमारी वर्तमान आवश्यकताओं से अधिक मेल खाती है।</p>
                    </div>
                    
                    <div class='motivational-quote'>
                        <p style='margin: 0; font-size: 18px; font-style: italic; color: #1565c0; font-weight: bold;'>\"Success is not final, failure is not fatal: it is the courage to continue that counts.\"</p>
                        <p style='margin: 10px 0 0 0; font-size: 16px; color: #1565c0;'>- Winston Churchill</p>
                    </div>
                    
                    <div class='encouragement-box'>
                        <h3 style='color: #856404; margin-top: 0; font-size: 20px;'>💪 Please Don't Be Discouraged! / निराश न हों! 💪</h3>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'><strong>Yeh koi ant nahi hai, yeh ek nayi shuruaat hai!</strong> This decision was not an easy one, and we were genuinely impressed by your application. Your skills and experience are valuable, and the right opportunity is waiting for you.</p>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'><strong>Remember:</strong></p>
                        <ul style='margin: 10px 0; padding-left: 20px; color: #856404; font-size: 14px; line-height: 1.8;'>
                            <li>Every rejection is a redirection to something better</li>
                            <li>Your worth is not determined by one application</li>
                            <li>Great things take time - keep moving forward!</li>
                            <li>Har rejection ek naya lesson hai - seekhte raho!</li>
                        </ul>
                        <p style='margin: 15px 0 0 0; color: #856404; font-size: 15px;'><strong>🌟 Aapke liye perfect opportunity zaroor milegi! 🌟</strong></p>
                    </div>
                    
                    <p style='font-size: 15px;'>We appreciate your interest in joining our team and wish you the very best in your job search. We will keep your application on file and may contact you if a more suitable position becomes available in the future.</p>
                    
                    <p style='font-size: 15px; color: #1967d2;'><strong>What's Next? / आगे क्या?</strong></p>
                    <ul style='font-size: 14px; line-height: 1.8;'>
                        <li>Keep applying to positions that match your skills</li>
                        <li>Update your profile and resume regularly</li>
                        <li>Stay positive and keep learning</li>
                        <li>Apne skills ko improve karte raho - practice makes perfect!</li>
                    </ul>
                    
                    <p style='text-align: center; margin: 25px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' class='button'>Browse More Opportunities / और अवसर देखें</a>
                    </p>
                    
                    <p style='font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                        Thank you again for your interest, and we wish you success in your career journey.<br>
                        Aapke interest ke liye dhanyawad, aur hum aapke career journey mein safalta ki kamna karte hain!<br><br>
                        Best regards / शुभकामनाएं,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
