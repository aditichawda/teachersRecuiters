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
        public JobApplicationStatusEnum|string $oldStatus,
        public JobApplicationStatusEnum|string $newStatus
    ) {
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            // Handle enum serialization issue FIRST - convert string to enum if needed
            // This must happen before any getValue() calls
            if (is_string($this->oldStatus)) {
                $oldStatusStringValue = $this->oldStatus;
                $enumInstance = new JobApplicationStatusEnum();
                $this->oldStatus = $enumInstance->make($oldStatusStringValue);
                Log::info('[EMAIL_STATUS_UPDATE] Converted oldStatus from string to enum', [
                    'original_value' => $oldStatusStringValue,
                    'converted_type' => get_class($this->oldStatus),
                ]);
            } elseif (!($this->oldStatus instanceof JobApplicationStatusEnum)) {
                // If it's an object but not an enum, try to get its value safely
                if (is_string($this->oldStatus)) {
                    $oldStatusValue = $this->oldStatus;
                } elseif (is_object($this->oldStatus)) {
                    try {
                        if ($this->oldStatus instanceof JobApplicationStatusEnum) {
                            $oldStatusValue = $this->oldStatus->getValue();
                        } elseif (method_exists($this->oldStatus, 'getValue') && !is_string($this->oldStatus)) {
                            $oldStatusValue = $this->oldStatus->getValue();
                        } else {
                            $oldStatusValue = (string)$this->oldStatus;
                        }
                    } catch (\Exception $e) {
                        $oldStatusValue = (string)$this->oldStatus;
                    }
                } else {
                    $oldStatusValue = (string)$this->oldStatus;
                }
                $enumInstance = new JobApplicationStatusEnum();
                $this->oldStatus = $enumInstance->make($oldStatusValue);
                Log::info('[EMAIL_STATUS_UPDATE] Converted oldStatus from object to enum', [
                    'original_value' => $oldStatusValue,
                ]);
            }
            
            if (is_string($this->newStatus)) {
                $newStatusStringValue = $this->newStatus;
                $enumInstance = new JobApplicationStatusEnum();
                $this->newStatus = $enumInstance->make($newStatusStringValue);
                Log::info('[EMAIL_STATUS_UPDATE] Converted newStatus from string to enum', [
                    'original_value' => $newStatusStringValue,
                    'converted_type' => get_class($this->newStatus),
                ]);
            } elseif (!($this->newStatus instanceof JobApplicationStatusEnum)) {
                // If it's an object but not an enum, try to get its value safely
                if (is_string($this->newStatus)) {
                    $newStatusValue = $this->newStatus;
                } elseif (is_object($this->newStatus)) {
                    try {
                        if ($this->newStatus instanceof JobApplicationStatusEnum) {
                            $newStatusValue = $this->newStatus->getValue();
                        } elseif (method_exists($this->newStatus, 'getValue') && !is_string($this->newStatus)) {
                            $newStatusValue = $this->newStatus->getValue();
                        } else {
                            $newStatusValue = (string)$this->newStatus;
                        }
                    } catch (\Exception $e) {
                        $newStatusValue = (string)$this->newStatus;
                    }
                } else {
                    $newStatusValue = (string)$this->newStatus;
                }
                $enumInstance = new JobApplicationStatusEnum();
                $this->newStatus = $enumInstance->make($newStatusValue);
                Log::info('[EMAIL_STATUS_UPDATE] Converted newStatus from object to enum', [
                    'original_value' => $newStatusValue,
                ]);
            }
            
            // Ensure we have valid enum objects - DOUBLE CHECK
            if (!($this->newStatus instanceof JobApplicationStatusEnum)) {
                // Try one more time to convert
                if (is_string($this->newStatus)) {
                    $enumInstance = new JobApplicationStatusEnum();
                    $this->newStatus = $enumInstance->make($this->newStatus);
                    Log::info('[EMAIL_STATUS_UPDATE] Second attempt: Converted newStatus from string to enum');
                } else {
                    Log::error('[EMAIL_STATUS_UPDATE] newStatus is not an enum instance after conversion', [
                        'new_status_type' => gettype($this->newStatus),
                    ]);
                    return;
                }
            }
            
            if (!($this->oldStatus instanceof JobApplicationStatusEnum)) {
                // Try one more time to convert
                if (is_string($this->oldStatus)) {
                    $enumInstance = new JobApplicationStatusEnum();
                    $this->oldStatus = $enumInstance->make($this->oldStatus);
                    Log::info('[EMAIL_STATUS_UPDATE] Second attempt: Converted oldStatus from string to enum');
                } else {
                    Log::error('[EMAIL_STATUS_UPDATE] oldStatus is not an enum instance after conversion', [
                        'old_status_type' => gettype($this->oldStatus),
                    ]);
                    return;
                }
            }
            
            // Only send emails for shortlisted and rejected statuses - with EXTRA defensive error handling
            // Extract status values safely
            $oldStatusValue = null;
            $newStatusValue = null;
            
            // Extract oldStatus value - SAFE method
            $oldStatusValue = null;
            if ($this->oldStatus instanceof JobApplicationStatusEnum) {
                try {
                    $oldStatusValue = $this->oldStatus->getValue();
                } catch (\Exception $e) {
                    // If getValue() fails, try to get the value property directly
                    if (property_exists($this->oldStatus, 'value')) {
                        $oldStatusValue = $this->oldStatus->value;
                    } elseif (is_string($this->oldStatus)) {
                        $oldStatusValue = $this->oldStatus;
                    } else {
                        Log::error('[EMAIL_STATUS_UPDATE] Error getting oldStatus value', [
                            'error' => $e->getMessage(),
                            'old_status_type' => gettype($this->oldStatus),
                        ]);
                        return;
                    }
                }
            } elseif (is_string($this->oldStatus)) {
                $oldStatusValue = $this->oldStatus;
            } else {
                Log::error('[EMAIL_STATUS_UPDATE] oldStatus is not an enum instance when trying to get value', [
                    'old_status_type' => gettype($this->oldStatus),
                ]);
                return;
            }
            
            // Extract newStatus value - SAFE method
            $newStatusValue = null;
            if ($this->newStatus instanceof JobApplicationStatusEnum) {
                try {
                    $newStatusValue = $this->newStatus->getValue();
                } catch (\Exception $e) {
                    // If getValue() fails, try to get the value property directly
                    if (property_exists($this->newStatus, 'value')) {
                        $newStatusValue = $this->newStatus->value;
                    } elseif (is_string($this->newStatus)) {
                        $newStatusValue = $this->newStatus;
                    } else {
                        Log::error('[EMAIL_STATUS_UPDATE] Error getting newStatus value', [
                            'error' => $e->getMessage(),
                            'new_status_type' => gettype($this->newStatus),
                        ]);
                        return;
                    }
                }
            } elseif (is_string($this->newStatus)) {
                $newStatusValue = $this->newStatus;
            } else {
                Log::error('[EMAIL_STATUS_UPDATE] newStatus is not an enum instance when trying to get value', [
                    'new_status_type' => gettype($this->newStatus),
                ]);
                return;
            }
            
            // Only send emails for shortlisted and rejected statuses
            // Use string comparison to avoid enum serialization issues
            $shortListValue = 'short_list';
            $rejectedValue = 'rejected';
            
            if ($newStatusValue !== $shortListValue && $newStatusValue !== $rejectedValue) {
                Log::info('[EMAIL_STATUS_UPDATE] Status not shortlisted/rejected, skipping', [
                    'application_id' => $this->application->id,
                    'new_status' => $newStatusValue,
                    'short_list_value' => $shortListValue,
                    'rejected_value' => $rejectedValue,
                ]);
                return;
            }
            
            Log::info('[EMAIL_STATUS_UPDATE] Status values extracted successfully', [
                'application_id' => $this->application->id,
                'old_status' => $oldStatusValue,
                'new_status' => $newStatusValue,
            ]);

            // CRITICAL: Get job seeker email DIRECTLY from jb_applications table
            // This is the email column value from jb_applications table (screenshot shows this table)
            // Example: For application_id 96, email is "himanshivyas164@gmail.com" from jb_applications table
            // NOT the employer's email
            $jobSeekerEmail = $this->application->getAttribute('email'); // Direct column access from jb_applications table
            
            // Log email source for debugging - VERIFY it's from jb_applications table
            // This matches the screenshot: jb_applications table has email column
            Log::info('[EMAIL_STATUS_UPDATE] Email fetched DIRECTLY from jb_applications table', [
                'application_id' => $this->application->id,
                'table' => 'jb_applications',
                'table_column' => 'email',
                'email_from_jb_applications_table' => $jobSeekerEmail,
                'raw_email_value' => $this->application->getRawOriginal('email') ?? 'not_set',
                'email_from_account' => $this->application->account->email ?? 'not_set',
                'recipient_type' => 'JOB_SEEKER_CANDIDATE',
                'note' => 'Email is from jb_applications.email column - the candidate who applied (see screenshot)',
            ]);
            
            if (empty($jobSeekerEmail) || !filter_var($jobSeekerEmail, FILTER_VALIDATE_EMAIL)) {
                // Try fallback to account email if application email is not available
                $jobSeekerEmail = $this->application->account->email ?? null;
                
                if (empty($jobSeekerEmail) || !filter_var($jobSeekerEmail, FILTER_VALIDATE_EMAIL)) {
                    Log::warning('[EMAIL_STATUS_UPDATE] Invalid email for job seeker status update', [
                        'application_id' => $this->application->id,
                        'application_email_from_jb_applications' => $this->application->email ?? 'not_set',
                        'account_email' => $this->application->account->email ?? 'not_set',
                    ]);
                    return;
                }
                
                Log::info('[EMAIL_STATUS_UPDATE] Using account email as fallback', [
                    'application_id' => $this->application->id,
                    'email' => $jobSeekerEmail,
                ]);
            }
            
            // CRITICAL: Verify this is NOT employer email
            // Get employer emails for comparison
            $employerEmails = [];
            if ($this->jobModel->company && $this->jobModel->company->accounts) {
                foreach ($this->jobModel->company->accounts as $account) {
                    if ($account->email) {
                        $employerEmails[] = $account->email;
                    }
                }
            }
            
            if (in_array($jobSeekerEmail, $employerEmails)) {
                Log::error('[EMAIL_STATUS_UPDATE] ERROR: Email matches employer email! Using wrong email!', [
                    'application_id' => $this->application->id,
                    'email' => $jobSeekerEmail,
                    'employer_emails' => $employerEmails,
                    'error' => 'Email should be from jb_applications table, not employer email',
                ]);
                return;
            }
            
            Log::info('[EMAIL_STATUS_UPDATE] Email verified - NOT employer email', [
                'application_id' => $this->application->id,
                'job_seeker_email' => $jobSeekerEmail,
                'employer_emails' => $employerEmails,
            ]);

            $jobSeekerName = $this->application->full_name;
            $jobUrl = $this->jobModel->url;
            if (!filter_var($jobUrl, FILTER_VALIDATE_URL)) {
                $jobUrl = url($jobUrl);
            }

            // Use string comparison to avoid enum serialization issues
            $isShortlisted = $newStatusValue === 'short_list';
            $isRejected = $newStatusValue === 'rejected';

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
                ? 'Congratulations! You\'ve been Shortlisted - ' . $this->jobModel->name
                : 'Update on Your Application - ' . $this->jobModel->name;

            // IMPORTANT: Send email to JOB SEEKER (candidate), not employer
            // Email comes from jb_applications table (form submission email)
            Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $jobSeekerEmail) {
                $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                    ->to($jobSeekerEmail) // Job seeker's email from application form
                    ->subject($emailSubject)
                    ->html($emailContent);
            });
            
            Log::info('[EMAIL_STATUS_UPDATE] Email sent to job seeker (candidate)', [
                'application_id' => $this->application->id,
                'recipient_email' => $jobSeekerEmail,
                'recipient_type' => 'job_seeker',
                'subject' => $emailSubject,
            ]);

            Log::info('[EMAIL_STATUS_UPDATE] Job seeker status update email sent successfully', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'old_status' => $oldStatusValue ?? 'unknown',
                'new_status' => $newStatusValue,
                'email_sent_to' => $jobSeekerEmail,
                'email_source' => 'application_form',
                'job_seeker_name' => $jobSeekerName,
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
                        <h2>🎉 Congratulations! 🎉</h2>
                    </div>
                    
                    <p style='font-size: 16px; margin-top: 20px;'>Dear " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <div class='success-box'>
                        <h3 style='margin: 0; color: #155724; font-size: 22px;'>You Have Been Shortlisted! 🎊</h3>
                        <p style='margin: 10px 0 0 0; color: #155724; font-size: 16px;'>We are extremely pleased to inform you that your application has been shortlisted for the next stage of the selection process.</p>
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Position Details:</h3>
                        <p style='font-size: 15px;'><strong>Position:</strong> " . htmlspecialchars($variables['job_name']) . "</p>
                        <p style='font-size: 15px;'><strong>Company:</strong> " . htmlspecialchars($variables['company_name']) . "</p>
                    </div>
                    
                    <div class='motivational-box'>
                        <h3 style='color: #856404; margin-top: 0; font-size: 18px;'>🌟 This is Excellent News! 🌟</h3>
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
                        <a href='" . htmlspecialchars($variables['job_url']) . "' class='button'>View Job Details</a>
                    </p>
                    
                    <p style='text-align: center; margin: 20px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' style='color: #1967d2; text-decoration: none; font-size: 14px;'>View All My Applications</a>
                    </p>
                    
                    <p style='font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                        We look forward to speaking with you soon!<br><br>
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
                        <h2>Update on Your Application</h2>
                    </div>
                    
                    <p style='font-size: 16px; margin-top: 20px;'>Dear " . htmlspecialchars($variables['job_seeker_name']) . ",</p>
                    
                    <p style='font-size: 15px;'>Thank you for taking the time to apply for the position of <strong>" . htmlspecialchars($variables['job_name']) . "</strong> at <strong>" . htmlspecialchars($variables['company_name']) . "</strong>.</p>
                    
                    <div class='info-box'>
                        <p style='font-size: 15px; margin: 0;'>After careful consideration, we regret to inform you that we have decided to move forward with other candidates whose qualifications more closely match our current needs.</p>
                    </div>
                    
                    <div class='motivational-quote'>
                        <p style='margin: 0; font-size: 18px; font-style: italic; color: #1565c0; font-weight: bold;'>\"Success is not final, failure is not fatal: it is the courage to continue that counts.\"</p>
                        <p style='margin: 10px 0 0 0; font-size: 16px; color: #1565c0;'>- Winston Churchill</p>
                    </div>
                    
                    <div class='encouragement-box'>
                        <h3 style='color: #856404; margin-top: 0; font-size: 20px;'>💪 Please Don't Be Discouraged! 💪</h3>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'>This decision was not an easy one, and we were genuinely impressed by your application. Your skills and experience are valuable, and the right opportunity is waiting for you.</p>
                        <p style='margin: 10px 0; color: #856404; font-size: 15px;'><strong>Remember:</strong></p>
                        <ul style='margin: 10px 0; padding-left: 20px; color: #856404; font-size: 14px; line-height: 1.8;'>
                            <li>Every rejection is a redirection to something better</li>
                            <li>Your worth is not determined by one application</li>
                            <li>Great things take time - keep moving forward!</li>
                            <li>Keep learning and improving your skills</li>
                        </ul>
                        <p style='margin: 15px 0 0 0; color: #856404; font-size: 15px;'><strong>🌟 The perfect opportunity is waiting for you! 🌟</strong></p>
                    </div>
                    
                    <p style='font-size: 15px;'>We appreciate your interest in joining our team and wish you the very best in your job search. We will keep your application on file and may contact you if a more suitable position becomes available in the future.</p>
                    
                    <p style='font-size: 15px; color: #1967d2;'><strong>What's Next?</strong></p>
                    <ul style='font-size: 14px; line-height: 1.8;'>
                        <li>Keep applying to positions that match your skills</li>
                        <li>Update your profile and resume regularly</li>
                        <li>Stay positive and keep learning</li>
                        <li>Continue improving your skills - practice makes perfect!</li>
                    </ul>
                    
                    <p style='text-align: center; margin: 25px 0;'>
                        <a href='" . htmlspecialchars($variables['view_applications_url']) . "' class='button'>Browse More Opportunities</a>
                    </p>
                    
                    <p style='font-size: 13px; color: #666; text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd;'>
                        Thank you again for your interest, and we wish you success in your career journey.<br><br>
                        Best regards,<br>
                        <strong>TeachersRecruiter Team</strong>
                    </p>
                </div>
            </body>
            </html>
        ";
    }
}
