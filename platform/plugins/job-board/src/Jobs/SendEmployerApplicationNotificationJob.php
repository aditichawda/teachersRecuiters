<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\Media\Facades\RvMedia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SendEmployerApplicationNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;

    public JobApplication $application;
    public Job $jobModel;

    public function __construct(
        JobApplication $application,
        Job $job
    ) {
        $this->application = $application;
        $this->jobModel = $job;
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        try {
            // Ensure author and company relationships are loaded
            if (!$this->jobModel->relationLoaded('author')) {
                $this->jobModel->load('author');
            }
            if (!$this->jobModel->relationLoaded('company')) {
                $this->jobModel->load('company');
            }

            // Get employer emails - only from job creator and job settings
            $employerEmails = array_filter($this->jobModel->employer_emails ?: []);

            // Get job creator (author) email - the employer who created this job
            // This is the primary email - the employer who posted the job
            if ($this->jobModel->author && $this->jobModel->author->email) {
                $authorEmail = $this->jobModel->author->email;
                if (filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
                    $employerEmails[] = $authorEmail;
                }
            }

            // Remove duplicates
            $employerEmails = array_values(array_unique(array_filter($employerEmails)));

            if (empty($employerEmails)) {
                Log::warning('No employer emails found for job application notification', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                    'job_author_id' => $this->jobModel->author_id ?? null,
                ]);
                return;
            }

            // Get screening questions and answers
            $screeningAnswersHtml = $this->formatScreeningAnswers();

            // Get job seeker details
            $jobSeekerName = $this->application->full_name;
            $jobSeekerEmail = $this->application->email ?? 'N/A';
            $jobSeekerPhone = $this->application->phone ?? 'N/A';
            $message = strip_tags($this->application->message ?? '');
            $resumeUrl = $this->application->resume ? RvMedia::url($this->application->resume) : null;
            $coverLetterUrl = $this->application->cover_letter ? RvMedia::url($this->application->cover_letter) : null;

            // Build email content
            $emailContent = $this->buildEmailContent([
                'job_seeker_name' => $jobSeekerName,
                'position_applied' => $this->jobModel->name,
                'job_seeker_email' => $jobSeekerEmail,
                'job_seeker_phone' => $jobSeekerPhone,
                'message' => $message,
                'resume_url' => $resumeUrl,
                'cover_letter_url' => $coverLetterUrl,
                'screening_answers_html' => $screeningAnswersHtml,
                'company_name' => $this->jobModel->company->name ?? 'N/A',
                'application_url' => route('public.account.applicants.edit', $this->application->id),
                'job_url' => $this->jobModel->url,
            ]);

            $emailSubject = $jobSeekerName . ' has applied for the job you posted: ' . $this->jobModel->name;

            // Send to job creator and other employer emails from job settings
            foreach ($employerEmails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    continue;
                }

                Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $email, $resumeUrl) {
                    $message->from(config('mail.from.address', 'noreply@example.com'), config('mail.from.name', 'TeachersRecruiter'))
                        ->to($email)
                        ->subject($emailSubject)
                        ->html($emailContent);

                    // Attach resume if available
                    if ($resumeUrl && filter_var($resumeUrl, FILTER_VALIDATE_URL)) {
                        try {
                            $message->attach($resumeUrl);
                        } catch (\Exception $e) {
                            Log::warning('Failed to attach resume to email', [
                                'resume_url' => $resumeUrl,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                });
            }

            Log::info('Employer application notification email sent', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'job_author_id' => $this->jobModel->author_id ?? null,
                'job_author_email' => $this->jobModel->author->email ?? null,
                'total_employer_emails' => count($employerEmails),
                'employer_emails' => $employerEmails,
            ]);

            // Send WhatsApp notifications to employers (only if enabled)
            // Check if column exists and is enabled
            if (isset($this->jobModel->enable_whatsapp_notifications) && $this->jobModel->enable_whatsapp_notifications) {
                $this->sendWhatsAppNotifications($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $this->jobModel->name);
            }

        } catch (\Exception $e) {
            Log::error('Failed to send employer application notification email', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function formatScreeningAnswers(): string
    {
        $screeningAnswers = $this->application->screening_answers ?? [];
        
        if (empty($screeningAnswers)) {
            return '<p style="color: #666; font-style: italic;">No screening questions answered.</p>';
        }

        $questionsMap = $this->jobModel->getAllScreeningQuestionsForApply()->keyBy('id');

        $html = '<div style="margin-top: 10px;">';

        foreach ($screeningAnswers as $questionId => $answer) {
            $q = $questionsMap->get($questionId) ?? $questionsMap->get('sq_' . $questionId);
            $questionText = $q ? $q->question : "Question #{$questionId}";
            
            // Decode JSON answers (for checkboxes, etc.)
            $decodedAnswer = json_decode($answer, true);
            if (is_array($decodedAnswer)) {
                $answer = implode(', ', $decodedAnswer);
            }

            // Check if answer is a URL (file upload)
            $isUrl = filter_var($answer, FILTER_VALIDATE_URL);
            
            $html .= '<div style="margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-left: 3px solid #1967d2;">';
            $html .= '<p style="margin: 0 0 5px 0; font-weight: bold; color: #333;">' . htmlspecialchars($questionText) . '</p>';
            
            if ($isUrl) {
                $html .= '<p style="margin: 0; color: #1967d2;"><a href="' . htmlspecialchars($answer) . '" target="_blank">View File</a></p>';
            } else {
                $html .= '<p style="margin: 0; color: #666;">' . htmlspecialchars($answer) . '</p>';
            }
            
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
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
                    .info-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
                    .info-row { margin: 8px 0; }
                    .info-label { font-weight: bold; color: #333; display: inline-block; min-width: 120px; }
                    .button { display: inline-block; background: #1967d2; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 15px; font-weight: bold; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2 style='color: #1967d2; margin-bottom: 20px;'>New Job Application</h2>
                    <p style='font-size: 16px; line-height: 1.6; margin-bottom: 20px;'>
                        <strong>" . htmlspecialchars($variables['job_seeker_name']) . "</strong> has applied for the job you posted: <strong>" . htmlspecialchars($variables['position_applied']) . "</strong>
                    </p>
                    
                    <div style='background: #e8f4f8; padding: 15px; border-radius: 8px; border-left: 4px solid #1967d2; margin: 20px 0;'>
                        <h3 style='color: #1967d2; margin-top: 0; margin-bottom: 15px; font-size: 18px;'>Here are the screening question results:</h3>
                        " . $variables['screening_answers_html'] . "
                    </div>
                    
                    <div class='info-box'>
                        <h3 style='color: #1967d2; margin-top: 0;'>Applicant Details:</h3>
                        <div class='info-row'>
                            <span class='info-label'>Name:</span>
                            <span>" . htmlspecialchars($variables['job_seeker_name']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Email:</span>
                            <span><a href='mailto:" . htmlspecialchars($variables['job_seeker_email']) . "'>" . htmlspecialchars($variables['job_seeker_email']) . "</a></span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Phone:</span>
                            <span>" . htmlspecialchars($variables['job_seeker_phone']) . "</span>
                        </div>
                        <div class='info-row'>
                            <span class='info-label'>Company:</span>
                            <span>" . htmlspecialchars($variables['company_name']) . "</span>
                        </div>
                    </div>
                    
                    " . (!empty($variables['message']) ? "<div class='info-box'><h4 style='color: #1967d2; margin-top: 0;'>Cover Letter:</h4><p>" . nl2br(htmlspecialchars($variables['message'])) . "</p></div>" : "") . "
                    
                    " . ($variables['resume_url'] ? "<div class='info-box'><p><strong>Resume:</strong> <a href='" . htmlspecialchars($variables['resume_url']) . "' target='_blank'>Download Resume</a></p></div>" : "") . "
                    
                    " . ($variables['cover_letter_url'] ? "<div class='info-box'><p><strong>Cover Letter File:</strong> <a href='" . htmlspecialchars($variables['cover_letter_url']) . "' target='_blank'>Download Cover Letter</a></p></div>" : "") . "
                    
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

    /**
     * Send WhatsApp notifications to employers about new job application
     */
    protected function sendWhatsAppNotifications(string $jobSeekerName, string $jobSeekerEmail, string $jobSeekerPhone, string $jobTitle): void
    {
        try {
            // Ensure company relationship is loaded
            if (!$this->jobModel->relationLoaded('company')) {
                $this->jobModel->load('company');
            }

            // Get employer phone numbers
            $employerPhones = [];

            // Get phone from job author (employer account)
            if ($this->jobModel->author && $this->jobModel->author->phone) {
                $authorPhone = $this->jobModel->author->phone;
                $authorPhone = preg_replace('/[^0-9]/', '', $authorPhone);
                if (strlen($authorPhone) >= 10) {
                    $employerPhones[] = $authorPhone;
                }
            }

            // Get phone from company
            if ($this->jobModel->company && $this->jobModel->company->phone) {
                $companyPhone = $this->jobModel->company->phone;
                $companyPhone = preg_replace('/[^0-9]/', '', $companyPhone);
                if (strlen($companyPhone) >= 10) {
                    $employerPhones[] = $companyPhone;
                }
            }

            // Get phones from apply_internal_phones (additional phone numbers added during job posting)
            if ($this->jobModel->apply_internal_phones && is_array($this->jobModel->apply_internal_phones)) {
                foreach ($this->jobModel->apply_internal_phones as $phone) {
                    if ($phone) {
                        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
                        if (strlen($cleanPhone) >= 10) {
                            $employerPhones[] = $cleanPhone;
                        }
                    }
                }
            }

            // Remove duplicates
            $employerPhones = array_values(array_unique($employerPhones));

            if (empty($employerPhones)) {
                Log::info('No employer phone numbers found for WhatsApp notification', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                ]);
                return;
            }

            // Build WhatsApp message
            $whatsappMessage = $this->buildWhatsAppMessage($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $jobTitle);

            // Send WhatsApp notification to each employer phone
            foreach ($employerPhones as $phone) {
                try {
                    $sent = $this->sendWhatsAppMessage($phone, $whatsappMessage);
                    if ($sent) {
                        Log::info('WhatsApp notification sent to employer', [
                            'phone' => $phone,
                            'job_id' => $this->jobModel->id,
                            'application_id' => $this->application->id,
                        ]);
                    } else {
                        Log::warning('Failed to send WhatsApp notification to employer', [
                            'phone' => $phone,
                            'job_id' => $this->jobModel->id,
                            'application_id' => $this->application->id,
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error sending WhatsApp notification to employer', [
                        'phone' => $phone,
                        'job_id' => $this->jobModel->id,
                        'application_id' => $this->application->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp notifications to employers', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'error' => $e->getMessage(),
            ]);
            // Don't throw exception - WhatsApp failure shouldn't break email notifications
        }
    }

    /**
     * Build WhatsApp message content for job application notification
     * Returns message in format suitable for template parameters
     * Format: "Job Title|Candidate Name|Email|Phone" (pipe-separated for multiple template parameters)
     * Or returns full formatted message if template uses single parameter
     */
    protected function buildWhatsAppMessage(string $jobSeekerName, string $jobSeekerEmail, string $jobSeekerPhone, string $jobTitle): string
    {
        // Build a readable message format
        $phoneDisplay = ($jobSeekerPhone && $jobSeekerPhone !== 'N/A') ? $jobSeekerPhone : 'Not provided';
        
        // Format: Pipe-separated for template with multiple parameters
        // Template parameters: {{1}} = Job Title, {{2}} = Candidate Name, {{3}} = Email, {{4}} = Phone
        // If your template uses a single parameter, it will receive: "Job Title|Name|Email|Phone"
        return $jobTitle . '|' . $jobSeekerName . '|' . $jobSeekerEmail . '|' . $phoneDisplay;
    }

    /**
     * Send WhatsApp message using MSG Club API (Template-based)
     */
    protected function sendWhatsAppMessage(string $phone, string $message): bool
    {
        // Get WhatsApp API configuration from settings or env
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
        $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0'));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
        // Use a template name for job application notifications (can be configured in settings)
        $templateName = setting('whatsapp_job_application_template', env('WHATSAPP_JOB_APPLICATION_TEMPLATE', 'job_application_notification'));

        if (!$apiUrl || !$authKey) {
            Log::error('WhatsApp API configuration missing for job application notification');
            return false;
        }

        // Clean phone number (remove any non-numeric characters)
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Extract 10-digit phone number
        $phoneWithoutCountryCode = $phone;
        
        // If phone has country code (starts with 91 and is 12 digits), extract 10 digits
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            $phoneWithoutCountryCode = substr($phone, 2);
        } elseif (strlen($phone) > 10) {
            // If phone is longer than 10 digits, use last 10 digits
            $phoneWithoutCountryCode = substr($phone, -10);
        } elseif (strlen($phone) < 10) {
            Log::error('Phone number too short for WhatsApp notification', [
                'phone' => $phone,
                'length' => strlen($phone),
            ]);
            return false;
        }
        
        // Use 10-digit phone number (without country code) for API
        $phone = $phoneWithoutCountryCode;

        try {
            // Prepare request body according to MSG Club API format (template-based)
            // Split message into parts for template parameters
            // Format: "Job Title|Candidate Name|Email|Phone"
            $messageParts = explode('|', $message);
            
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
                                'parameters' => []
                            ]
                        ]
                    ],
                    'qrImageUrl' => false,
                    'qrLinkUrl' => false,
                    'to' => $phone
                ]
            ];

            // Add message parts as template parameters
            // If template expects multiple parameters, add them
            // For now, we'll send the full message as a single parameter
            // You may need to adjust this based on your WhatsApp template structure
            if (count($messageParts) > 1) {
                // Multiple parameters
                foreach ($messageParts as $index => $part) {
                    $requestBody['component']['template']['components'][0]['parameters'][] = [
                        'type' => 'text',
                        'text' => trim($part)
                    ];
                }
            } else {
                // Single parameter - send full message
                $requestBody['component']['template']['components'][0]['parameters'][] = [
                    'type' => 'text',
                    'text' => $message
                ];
            }

            // Make API call with AUTH_KEY as query parameter
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            // Check if request was successful
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Check response code (3001 seems to be success based on OTP implementation)
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('WhatsApp notification sent successfully', [
                        'phone' => $phone,
                        'response' => $responseData
                    ]);
                    return true;
                } else {
                    Log::warning('WhatsApp API returned non-success response', [
                        'phone' => $phone,
                        'response' => $responseData
                    ]);
                    return false;
                }
            } else {
                Log::error('WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp API Error: ' . $e->getMessage(), [
                'phone' => $phone,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
