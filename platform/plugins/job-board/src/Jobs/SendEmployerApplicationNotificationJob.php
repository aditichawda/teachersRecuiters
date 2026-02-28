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
        Log::info('[EMAIL_NOTIFICATION] Starting employer notification email process', [
            'application_id' => $this->application->id,
            'job_id' => $this->jobModel->id,
            'candidate_email' => $this->application->email ?? 'N/A',
            'candidate_name' => $this->application->full_name ?? 'N/A',
        ]);

        try {
            // Ensure author and company relationships are loaded
            if (!$this->jobModel->relationLoaded('author')) {
                $this->jobModel->load('author');
                Log::debug('[EMAIL_NOTIFICATION] Loaded job author relationship');
            }
            if (!$this->jobModel->relationLoaded('company')) {
                $this->jobModel->load('company');
                Log::debug('[EMAIL_NOTIFICATION] Loaded company relationship');
            }

            // Get employer emails - from job creator, company, and additional emails
            $employerEmails = [];

            // Get job creator (author) email - the employer who created this job
            // This is the primary email - the employer who posted the job
            if ($this->jobModel->author && $this->jobModel->author->email) {
                $authorEmail = $this->jobModel->author->email;
                if (filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
                    $employerEmails[] = $authorEmail;
                    Log::debug('[EMAIL_NOTIFICATION] Added job author email', ['email' => $authorEmail]);
                } else {
                    Log::warning('[EMAIL_NOTIFICATION] Invalid author email format', ['email' => $authorEmail]);
                }
            } else {
                Log::warning('[EMAIL_NOTIFICATION] No job author found or author has no email', [
                    'author_id' => $this->jobModel->author_id ?? null,
                    'author_exists' => $this->jobModel->author ? 'yes' : 'no',
                ]);
            }

            // Get additional emails from apply_internal_emails (additional emails added during job posting)
            if ($this->jobModel->apply_internal_emails && is_array($this->jobModel->apply_internal_emails)) {
                foreach ($this->jobModel->apply_internal_emails as $email) {
                    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $employerEmails[] = $email;
                        Log::debug('[EMAIL_NOTIFICATION] Added additional email from apply_internal_emails', ['email' => $email]);
                    }
                }
            }

            // Get emails from employer_colleagues if any
            if (!empty($this->jobModel->employer_colleagues)) {
                foreach ((array) $this->jobModel->employer_colleagues as $email) {
                    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $employerEmails[] = $email;
                        Log::debug('[EMAIL_NOTIFICATION] Added email from employer_colleagues', ['email' => $email]);
                    }
                }
            }

            // Remove duplicates
            $employerEmails = array_values(array_unique(array_filter($employerEmails)));

            Log::info('[EMAIL_NOTIFICATION] Final employer emails list', [
                'total_emails' => count($employerEmails),
                'emails' => $employerEmails,
                'author_email' => $this->jobModel->author->email ?? null,
                'additional_emails_count' => is_array($this->jobModel->apply_internal_emails) ? count(array_filter($this->jobModel->apply_internal_emails)) : 0,
                'apply_internal_emails' => $this->jobModel->apply_internal_emails ?? [],
            ]);

            if (empty($employerEmails)) {
                Log::warning('[EMAIL_NOTIFICATION] No employer emails found - aborting email send', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                    'job_author_id' => $this->jobModel->author_id ?? null,
                    'employer_emails_field' => $this->jobModel->employer_emails ?? null,
                ]);
                return;
            }

            // Get screening questions and answers
            Log::debug('[EMAIL_NOTIFICATION] Formatting screening answers');
            $screeningAnswersHtml = $this->formatScreeningAnswers();
            Log::debug('[EMAIL_NOTIFICATION] Screening answers formatted', [
                'html_length' => strlen($screeningAnswersHtml),
            ]);

            // Get job seeker details
            $jobSeekerName = $this->application->full_name;
            $jobSeekerEmail = $this->application->email ?? 'N/A';
            $jobSeekerPhone = $this->application->phone ?? 'N/A';
            $message = strip_tags($this->application->message ?? '');
            $resumeUrl = $this->application->resume ? RvMedia::url($this->application->resume) : null;
            $resumePath = $this->application->resume ? RvMedia::getRealPath($this->application->resume) : null;
            $coverLetterUrl = $this->application->cover_letter ? RvMedia::url($this->application->cover_letter) : null;
            $coverLetterPath = $this->application->cover_letter ? RvMedia::getRealPath($this->application->cover_letter) : null;

            // Build email content
            $emailVariables = [
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
            ];
            
            Log::debug('[EMAIL_NOTIFICATION] Email variables prepared', [
                'has_screening_answers' => !empty($screeningAnswersHtml),
                'screening_answers_length' => strlen($screeningAnswersHtml),
                'has_resume_url' => !empty($resumeUrl),
                'has_cover_letter_url' => !empty($coverLetterUrl),
                'has_message' => !empty($message),
            ]);
            
            $emailContent = $this->buildEmailContent($emailVariables);
            
            Log::debug('[EMAIL_NOTIFICATION] Email content built', [
                'content_length' => strlen($emailContent),
                'contains_screening' => strpos($emailContent, 'screening question') !== false,
                'contains_resume' => strpos($emailContent, 'Resume') !== false,
            ]);

            $emailSubject = $jobSeekerName . ' has applied for the job you posted: ' . $this->jobModel->name;

            // Send to job creator and other employer emails from job settings
            $emailsSent = 0;
            $emailsFailed = 0;
            
            foreach ($employerEmails as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Log::warning('[EMAIL_NOTIFICATION] Skipping invalid email', ['email' => $email]);
                    continue;
                }

                Log::info('[EMAIL_NOTIFICATION] Sending email to employer', [
                    'email' => $email,
                    'subject' => $emailSubject,
                ]);

                try {
                    // Log mail configuration for debugging
                    $mailDriver = config('mail.default');
                    $mailFromAddress = config('mail.from.address');
                    $mailFromName = config('mail.from.name');
                    $smtpHost = config('mail.mailers.smtp.host');
                    
                    Log::debug('[EMAIL_NOTIFICATION] Mail configuration', [
                        'mail_driver' => $mailDriver,
                        'mail_from_address' => $mailFromAddress,
                        'mail_from_name' => $mailFromName,
                        'smtp_host' => $smtpHost,
                        'smtp_port' => config('mail.mailers.smtp.port'),
                        'smtp_username' => config('mail.mailers.smtp.username') ? 'set' : 'not_set',
                    ]);
                    
                    // Warn if mail driver is 'log' - emails won't be sent, only logged
                    if ($mailDriver === 'log') {
                        Log::warning('[EMAIL_NOTIFICATION] ⚠️ Mail driver is set to "log" - emails will NOT be sent, only logged to storage/logs/laravel.log', [
                            'email' => $email,
                            'note' => 'Set MAIL_MAILER=smtp in .env file to actually send emails',
                        ]);
                    }
                    
                    Mail::send([], [], function ($message) use ($emailSubject, $emailContent, $email, $resumePath, $coverLetterPath) {
                        $fromAddress = config('mail.from.address', 'noreply@example.com');
                        $fromName = config('mail.from.name', 'TeachersRecruiter');
                        
                        $message->from($fromAddress, $fromName)
                            ->to($email)
                            ->subject($emailSubject)
                            ->html($emailContent);

                        // Attach resume if available (using local file path)
                        if ($resumePath && file_exists($resumePath)) {
                            try {
                                $message->attach($resumePath);
                                Log::debug('[EMAIL_NOTIFICATION] Resume attached to email', [
                                    'email' => $email,
                                    'resume_path' => $resumePath,
                                ]);
                            } catch (\Exception $e) {
                                Log::warning('[EMAIL_NOTIFICATION] Failed to attach resume to email', [
                                    'email' => $email,
                                    'resume_path' => $resumePath,
                                    'error' => $e->getMessage(),
                                ]);
                            }
                        } elseif ($resumePath) {
                            Log::warning('[EMAIL_NOTIFICATION] Resume file not found', [
                                'email' => $email,
                                'resume_path' => $resumePath,
                            ]);
                        }

                        // Attach cover letter if available (using local file path)
                        if ($coverLetterPath && file_exists($coverLetterPath)) {
                            try {
                                $message->attach($coverLetterPath);
                                Log::debug('[EMAIL_NOTIFICATION] Cover letter attached to email', [
                                    'email' => $email,
                                    'cover_letter_path' => $coverLetterPath,
                                ]);
                            } catch (\Exception $e) {
                                Log::warning('[EMAIL_NOTIFICATION] Failed to attach cover letter to email', [
                                    'email' => $email,
                                    'cover_letter_path' => $coverLetterPath,
                                    'error' => $e->getMessage(),
                                ]);
                            }
                        } elseif ($coverLetterPath) {
                            Log::warning('[EMAIL_NOTIFICATION] Cover letter file not found', [
                                'email' => $email,
                                'cover_letter_path' => $coverLetterPath,
                            ]);
                        }
                    });
                    
                    $emailsSent++;
                    Log::info('[EMAIL_NOTIFICATION] Email sent successfully', [
                        'email' => $email,
                        'application_id' => $this->application->id,
                        'subject' => $emailSubject,
                        'content_length' => strlen($emailContent),
                        'note' => 'Check spam folder if email not received',
                    ]);
                } catch (\Exception $e) {
                    $emailsFailed++;
                    Log::error('[EMAIL_NOTIFICATION] Failed to send email', [
                        'email' => $email,
                        'application_id' => $this->application->id,
                        'error' => $e->getMessage(),
                        'error_class' => get_class($e),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            }

            Log::info('[EMAIL_NOTIFICATION] Email sending process completed', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'job_author_id' => $this->jobModel->author_id ?? null,
                'job_author_email' => $this->jobModel->author->email ?? null,
                'total_employer_emails' => count($employerEmails),
                'emails_sent' => $emailsSent,
                'emails_failed' => $emailsFailed,
                'employer_emails' => $employerEmails,
            ]);

            // Send WhatsApp notifications to employers
            // Check if WhatsApp notifications are enabled for this job
            $whatsappEnabled = false;
            $columnExists = \Illuminate\Support\Facades\Schema::hasColumn('jb_jobs', 'enable_whatsapp_notifications');
            
            // Check if additional phones are provided - if yes, auto-enable notifications
            $hasAdditionalPhones = false;
            $additionalPhonesData = null;
            
            // Try multiple ways to get apply_internal_phones
            if ($this->jobModel->apply_internal_phones) {
                $additionalPhonesData = $this->jobModel->apply_internal_phones;
            } elseif (isset($this->jobModel->getAttributes()['apply_internal_phones'])) {
                // Try raw attribute
                $rawValue = $this->jobModel->getAttributes()['apply_internal_phones'];
                if (is_string($rawValue)) {
                    $additionalPhonesData = json_decode($rawValue, true);
                } else {
                    $additionalPhonesData = $rawValue;
                }
            }
            
            // Check if we have valid phone numbers
            if ($additionalPhonesData) {
                if (is_array($additionalPhonesData)) {
                    $hasAdditionalPhones = !empty(array_filter($additionalPhonesData));
                } elseif (is_string($additionalPhonesData) && !empty(trim($additionalPhonesData))) {
                    $hasAdditionalPhones = true;
                }
            }
            
            Log::debug('[WHATSAPP_NOTIFICATION] Checking additional phones', [
                'job_id' => $this->jobModel->id,
                'apply_internal_phones_attribute' => $this->jobModel->apply_internal_phones ?? 'not_set',
                'apply_internal_phones_type' => gettype($this->jobModel->apply_internal_phones ?? null),
                'raw_attribute_exists' => isset($this->jobModel->getAttributes()['apply_internal_phones']),
                'raw_attribute_value' => $this->jobModel->getAttributes()['apply_internal_phones'] ?? 'not_set',
                'additional_phones_data' => $additionalPhonesData,
                'has_additional_phones' => $hasAdditionalPhones,
            ]);
            
            // Check if we have any employer phones (author, company, or additional)
            $hasAuthorPhone = $this->jobModel->author && $this->jobModel->author->phone;
            $hasCompanyPhone = $this->jobModel->company && $this->jobModel->company->phone;
            $hasAnyPhone = $hasAuthorPhone || $hasCompanyPhone || $hasAdditionalPhones;
            
            if ($columnExists) {
                // Column exists, check value
                $whatsappEnabled = (bool) ($this->jobModel->enable_whatsapp_notifications ?? false);
            } else {
                // Column doesn't exist, default to true (send notifications)
                $whatsappEnabled = true;
            }
            
            // Auto-enable if any phone numbers are available (author, company, or additional)
            // This ensures notifications are sent to signin phone and additional phones
            if ($hasAnyPhone) {
                $whatsappEnabled = true;
                Log::info('[WHATSAPP_NOTIFICATION] Auto-enabling WhatsApp notifications because phone numbers are available', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                    'has_author_phone' => $hasAuthorPhone,
                    'has_company_phone' => $hasCompanyPhone,
                    'has_additional_phones' => $hasAdditionalPhones,
                    'author_phone' => $hasAuthorPhone ? $this->jobModel->author->phone : 'not_set',
                    'additional_phones' => $additionalPhonesData,
                ]);
            }
            
            Log::info('[WHATSAPP_NOTIFICATION] Checking WhatsApp notification settings', [
                'job_id' => $this->jobModel->id,
                'application_id' => $this->application->id,
                'column_exists' => $columnExists,
                'enable_whatsapp_notifications_value' => $this->jobModel->enable_whatsapp_notifications ?? 'not_set',
                'has_author_phone' => $hasAuthorPhone,
                'has_company_phone' => $hasCompanyPhone,
                'has_additional_phones' => $hasAdditionalPhones,
                'has_any_phone' => $hasAnyPhone,
                'whatsapp_enabled' => $whatsappEnabled,
            ]);
            
            if ($whatsappEnabled) {
                Log::info('[WHATSAPP_NOTIFICATION] ✓ WhatsApp notifications enabled - sending notifications', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                ]);
                $this->sendWhatsAppNotifications($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $this->jobModel->name);
            } else {
                Log::warning('[WHATSAPP_NOTIFICATION] ✗ WhatsApp notifications disabled - no phone numbers available', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                    'enable_whatsapp_notifications_value' => $this->jobModel->enable_whatsapp_notifications ?? 'not_set',
                    'has_author_phone' => $hasAuthorPhone,
                    'has_company_phone' => $hasCompanyPhone,
                    'has_additional_phones' => $hasAdditionalPhones,
                    'has_any_phone' => $hasAnyPhone,
                ]);
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
        
        Log::debug('[SCREENING_ANSWERS] Starting format process', [
            'application_id' => $this->application->id,
            'answers_count' => is_array($screeningAnswers) ? count($screeningAnswers) : 0,
            'answers_keys' => is_array($screeningAnswers) ? array_keys($screeningAnswers) : [],
        ]);
        
        if (empty($screeningAnswers) || !is_array($screeningAnswers)) {
            Log::info('[SCREENING_ANSWERS] No screening answers found', [
                'application_id' => $this->application->id,
            ]);
            return '<p style="color: #666; font-style: italic; padding: 10px;">No screening questions were answered by the candidate.</p>';
        }

        // Get all screening questions for this job (admin pool + job-specific)
        try {
            Log::debug('[SCREENING_ANSWERS] Loading screening questions for job', [
                'job_id' => $this->jobModel->id,
            ]);
            $questionsMap = $this->jobModel->getAllScreeningQuestionsForApply()->keyBy('id');
            Log::info('[SCREENING_ANSWERS] Loaded screening questions', [
                'total_questions' => $questionsMap->count(),
                'question_ids' => $questionsMap->keys()->toArray(),
            ]);
        } catch (\Exception $e) {
            Log::error('[SCREENING_ANSWERS] Failed to load screening questions', [
                'job_id' => $this->jobModel->id,
                'application_id' => $this->application->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $questionsMap = collect();
        }

        if ($questionsMap->isEmpty()) {
            Log::info('[SCREENING_ANSWERS] No screening questions configured for job', [
                'job_id' => $this->jobModel->id,
            ]);
            return '<p style="color: #666; font-style: italic; padding: 10px;">No screening questions were configured for this job.</p>';
        }

        $html = '<div style="margin-top: 15px;">';
        $hasAnswers = false;
        $processedCount = 0;

        foreach ($screeningAnswers as $questionId => $answer) {
            // Skip empty answers
            if ($answer === null || $answer === '') {
                Log::debug('[SCREENING_ANSWERS] Skipping empty answer', [
                    'question_id' => $questionId,
                ]);
                continue;
            }

            $hasAnswers = true;
            $processedCount++;
            
            Log::debug('[SCREENING_ANSWERS] Processing answer', [
                'question_id' => $questionId,
                'answer_type' => gettype($answer),
                'answer_preview' => is_string($answer) ? substr($answer, 0, 100) : 'non-string',
            ]);
            
            // Try multiple ID formats: exact match, sq_ prefix, jq_ prefix, or numeric ID
            $q = $questionsMap->get($questionId) 
                ?? $questionsMap->get('sq_' . $questionId)
                ?? $questionsMap->get('jq_' . $questionId);
            
            // If still not found, try removing prefix and searching by numeric ID
            if (!$q) {
                $numericId = preg_replace('/^(sq_|jq_)/', '', $questionId);
                $q = $questionsMap->first(function ($item) use ($numericId) {
                    return str_ends_with($item->id, '_' . $numericId) || str_ends_with($item->id, $numericId);
                });
            }
            
            if (!$q) {
                Log::warning('[SCREENING_ANSWERS] Question not found in map', [
                    'question_id' => $questionId,
                    'available_ids' => $questionsMap->keys()->toArray(),
                ]);
            }
            
            $questionText = $q ? $q->question : "Question #{$questionId}";
            $questionType = $q ? $q->question_type : 'text';
            
            Log::debug('[SCREENING_ANSWERS] Question matched', [
                'question_id' => $questionId,
                'question_text' => $questionText,
                'question_type' => $questionType,
                'found' => $q ? 'yes' : 'no',
            ]);
            
            // Format answer based on type
            $formattedAnswer = $this->formatAnswer($answer, $questionType);
            $isUrl = filter_var($formattedAnswer, FILTER_VALIDATE_URL);
            
            Log::debug('[SCREENING_ANSWERS] Answer formatted', [
                'question_id' => $questionId,
                'formatted_answer' => substr($formattedAnswer, 0, 100),
                'is_url' => $isUrl,
            ]);
            
            $html .= '<div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-left: 4px solid #1967d2; border-radius: 4px;">';
            $html .= '<p style="margin: 0 0 8px 0; font-weight: 600; color: #1967d2; font-size: 15px;">' . htmlspecialchars($questionText) . '</p>';
            
            if ($isUrl) {
                $html .= '<p style="margin: 0; color: #1967d2;"><a href="' . htmlspecialchars($formattedAnswer) . '" target="_blank" style="color: #1967d2; text-decoration: underline;">📎 View Uploaded File</a></p>';
            } else {
                $html .= '<p style="margin: 0; color: #333; line-height: 1.6;">' . nl2br(htmlspecialchars($formattedAnswer)) . '</p>';
            }
            
            // Show correct answer indicator if applicable
            if ($q && $q->correct_answer) {
                $isCorrect = $this->checkAnswerCorrectness($answer, $q->correct_answer, $questionType);
                $correctBadge = $isCorrect 
                    ? '<span style="background: #10b981; color: white; padding: 2px 8px; border-radius: 3px; font-size: 11px; margin-left: 10px;">✓ Correct</span>'
                    : '<span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 3px; font-size: 11px; margin-left: 10px;">✗ Incorrect</span>';
                $html .= '<p style="margin: 5px 0 0 0; font-size: 12px;">' . $correctBadge . '</p>';
            }
            
            $html .= '</div>';
        }

        if (!$hasAnswers) {
            Log::info('[SCREENING_ANSWERS] No valid answers found after processing', [
                'application_id' => $this->application->id,
            ]);
            return '<p style="color: #666; font-style: italic; padding: 10px;">No screening questions were answered by the candidate.</p>';
        }

        $html .= '</div>';

        Log::info('[SCREENING_ANSWERS] Formatting completed', [
            'application_id' => $this->application->id,
            'total_processed' => $processedCount,
            'html_length' => strlen($html),
        ]);

        return $html;
    }

    /**
     * Format answer based on question type
     */
    protected function formatAnswer($answer, string $questionType): string
    {
        if ($answer === null || $answer === '') {
            return '—';
        }

        // Handle JSON-encoded answers (for checkboxes, multiple selections)
        if (is_string($answer) && str_starts_with(trim($answer), '[')) {
            $decoded = json_decode($answer, true);
            if (is_array($decoded)) {
                return implode(', ', array_map('trim', $decoded));
            }
        }

        // Handle array answers
        if (is_array($answer)) {
            return implode(', ', array_map('trim', $answer));
        }

        return (string) $answer;
    }

    /**
     * Check if answer matches the correct answer
     */
    protected function checkAnswerCorrectness($answer, string $correctAnswer, string $questionType): bool
    {
        if ($answer === null || $answer === '') {
            return false;
        }

        // Handle JSON-encoded answers
        if (is_string($answer) && str_starts_with(trim($answer), '[')) {
            $decoded = json_decode($answer, true);
            if (is_array($decoded)) {
                return in_array(trim($correctAnswer), array_map('trim', $decoded));
            }
        }

        // Handle array answers
        if (is_array($answer)) {
            return in_array(trim($correctAnswer), array_map('trim', $answer));
        }

        // Simple string comparison
        return trim((string) $answer) === trim($correctAnswer);
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

            // Get phone from job author (employer account) - this is the phone from signin/registration
            // Process like OTP notification - extract 10 digits
            if ($this->jobModel->author && $this->jobModel->author->phone) {
                $originalAuthorPhone = $this->jobModel->author->phone;
                $authorPhone = preg_replace('/[^0-9]/', '', $originalAuthorPhone);
                
                Log::debug('[WHATSAPP_NOTIFICATION] Processing author phone from signin/registration', [
                    'original_phone' => $originalAuthorPhone,
                    'cleaned_phone' => $authorPhone,
                    'author_id' => $this->jobModel->author->id,
                    'author_email' => $this->jobModel->author->email ?? null,
                ]);
                
                // Extract 10 digits (same logic as OTP notification)
                // Important: API requires exactly 10 digits without country code
                if (strlen($authorPhone) == 12 && substr($authorPhone, 0, 2) == '91') {
                    $authorPhone = substr($authorPhone, 2); // Remove country code (first 2 digits)
                } elseif (strlen($authorPhone) == 11) {
                    // 11 digits - extract last 10 digits
                    $authorPhone = substr($authorPhone, -10);
                } elseif (strlen($authorPhone) > 12) {
                    // More than 12 digits - extract last 10 digits
                    $authorPhone = substr($authorPhone, -10);
                }
                // If already 10 digits, keep as is
                
                if (strlen($authorPhone) == 10) {
                    $employerPhones[] = $authorPhone;
                    Log::info('[WHATSAPP_NOTIFICATION] ✓ Added author phone (from signin/registration)', [
                        'original_phone' => $originalAuthorPhone,
                        'processed_phone' => $authorPhone,
                        'author_id' => $this->jobModel->author->id,
                    ]);
                } else {
                    Log::warning('[WHATSAPP_NOTIFICATION] ✗ Author phone invalid format', [
                        'original_phone' => $originalAuthorPhone,
                        'processed_phone' => $authorPhone,
                        'length' => strlen($authorPhone),
                        'author_id' => $this->jobModel->author->id,
                    ]);
                }
            } else {
                Log::warning('[WHATSAPP_NOTIFICATION] No author phone found', [
                    'author_exists' => $this->jobModel->author ? 'yes' : 'no',
                    'author_id' => $this->jobModel->author_id ?? null,
                    'author_phone' => $this->jobModel->author->phone ?? null,
                ]);
            }

            // Get phone from company - process like OTP notification
            if ($this->jobModel->company && $this->jobModel->company->phone) {
                $companyPhone = preg_replace('/[^0-9]/', '', $this->jobModel->company->phone);
                // Extract 10 digits (same logic as OTP notification)
                // Important: API requires exactly 10 digits without country code
                if (strlen($companyPhone) == 12 && substr($companyPhone, 0, 2) == '91') {
                    $companyPhone = substr($companyPhone, 2); // Remove country code (first 2 digits)
                } elseif (strlen($companyPhone) == 11) {
                    // 11 digits - extract last 10 digits
                    $companyPhone = substr($companyPhone, -10);
                } elseif (strlen($companyPhone) > 12) {
                    // More than 12 digits - extract last 10 digits
                    $companyPhone = substr($companyPhone, -10);
                }
                // If already 10 digits, keep as is
                
                if (strlen($companyPhone) == 10) {
                    $employerPhones[] = $companyPhone;
                    Log::debug('[WHATSAPP_NOTIFICATION] Added company phone', ['phone' => $companyPhone]);
                }
            }

            // Get phones from apply_internal_phones (additional phone numbers added during job posting)
            // These are the numbers shown in screenshot 3 - must receive notifications
            if ($this->jobModel->apply_internal_phones && is_array($this->jobModel->apply_internal_phones)) {
                foreach ($this->jobModel->apply_internal_phones as $phone) {
                    if ($phone) {
                        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
                        // Extract 10 digits (same logic as OTP notification)
                        // Important: API requires exactly 10 digits without country code
                        if (strlen($cleanPhone) == 12 && substr($cleanPhone, 0, 2) == '91') {
                            $cleanPhone = substr($cleanPhone, 2); // Remove country code (first 2 digits)
                        } elseif (strlen($cleanPhone) == 11) {
                            // 11 digits - extract last 10 digits
                            $cleanPhone = substr($cleanPhone, -10);
                        } elseif (strlen($cleanPhone) > 12) {
                            // More than 12 digits - extract last 10 digits
                            $cleanPhone = substr($cleanPhone, -10);
                        }
                        // If already 10 digits, keep as is
                        
                        if (strlen($cleanPhone) == 10) {
                            $employerPhones[] = $cleanPhone;
                            Log::debug('[WHATSAPP_NOTIFICATION] Added additional phone from apply_internal_phones', [
                                'original_phone' => $phone,
                                'cleaned_phone' => $cleanPhone
                            ]);
                        } else {
                            Log::warning('[WHATSAPP_NOTIFICATION] Skipped invalid phone from apply_internal_phones', [
                                'phone' => $phone,
                                'cleaned_length' => strlen($cleanPhone)
                            ]);
                        }
                    }
                }
            }

            // Remove duplicates
            $employerPhones = array_values(array_unique($employerPhones));

            Log::info('[WHATSAPP_NOTIFICATION] Final employer phones list', [
                'total_phones' => count($employerPhones),
                'phones' => $employerPhones,
                'author_phone' => $this->jobModel->author->phone ?? null,
                'company_phone' => $this->jobModel->company->phone ?? null,
                'additional_phones_count' => is_array($this->jobModel->apply_internal_phones) ? count(array_filter($this->jobModel->apply_internal_phones)) : 0,
                'apply_internal_phones' => $this->jobModel->apply_internal_phones ?? [],
            ]);

            if (empty($employerPhones)) {
                Log::info('[WHATSAPP_NOTIFICATION] No employer phone numbers found for WhatsApp notification', [
                    'job_id' => $this->jobModel->id,
                    'application_id' => $this->application->id,
                ]);
                return;
            }

            // Build WhatsApp message
            $whatsappMessage = $this->buildWhatsAppMessage($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $jobTitle);

            // Send WhatsApp notification to each employer phone
            // This includes: author phone, company phone, and all additional phones from apply_internal_phones
            $sentCount = 0;
            $failedCount = 0;
            
            foreach ($employerPhones as $phone) {
                try {
                    Log::info('[WHATSAPP_NOTIFICATION] Attempting to send notification', [
                        'phone' => $phone,
                        'job_id' => $this->jobModel->id,
                        'application_id' => $this->application->id,
                    ]);
                    
                    $sent = $this->sendWhatsAppMessage($phone, $whatsappMessage);
                    
                    if ($sent) {
                        $sentCount++;
                        Log::info('[WHATSAPP_NOTIFICATION] ✓ Notification sent successfully', [
                            'phone' => $phone,
                            'job_id' => $this->jobModel->id,
                            'application_id' => $this->application->id,
                            'job_title' => $this->jobModel->name,
                            'candidate_name' => $jobSeekerName,
                        ]);
                    } else {
                        $failedCount++;
                        Log::warning('[WHATSAPP_NOTIFICATION] ✗ Failed to send notification', [
                            'phone' => $phone,
                            'job_id' => $this->jobModel->id,
                            'application_id' => $this->application->id,
                        ]);
                    }
                } catch (\Exception $e) {
                    $failedCount++;
                    Log::error('[WHATSAPP_NOTIFICATION] ✗ Error sending notification', [
                        'phone' => $phone,
                        'job_id' => $this->jobModel->id,
                        'application_id' => $this->application->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            }
            
            Log::info('[WHATSAPP_NOTIFICATION] Notification sending completed', [
                'total_phones' => count($employerPhones),
                'sent_count' => $sentCount,
                'failed_count' => $failedCount,
                'job_id' => $this->jobModel->id,
                'application_id' => $this->application->id,
            ]);

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
     * 
     * CURRENT: Using OTP template structure - returns compact job application summary
     * Format: Single line message with hint that this is for job application
     * This will be sent in both body and button components (OTP template structure)
     * 
     * COMMENTED BELOW: job_application_alert template code (ready to use when template is approved in MSG Club dashboard)
     * Uncomment the commented code and comment the current code when template is approved
     */
    protected function buildWhatsAppMessage(string $jobSeekerName, string $jobSeekerEmail, string $jobSeekerPhone, string $jobTitle): string
    {
        // ============================================
        // CURRENT CODE: OTP Template (Working)
        // ============================================
        // Build a very short message optimized for OTP template
        // OTP templates typically expect short values (like 6-digit OTP)
        // We'll create a compact message that fits OTP template format
        
        // Create a simple numeric code from application ID and job ID
        // This makes it look like an OTP code but represents job application
        $applicationId = $this->application->id ?? 0;
        $jobId = $this->jobModel->id ?? 0;
        
        // Create a 6-digit code: last 3 digits of job ID + last 3 digits of application ID
        $code = str_pad($jobId % 1000, 3, '0', STR_PAD_LEFT) . str_pad($applicationId % 1000, 3, '0', STR_PAD_LEFT);
        
        // Add hint prefix to make it clear this is for job application
        // Format: "JOB{code}" - Example: "JOB123456"
        $message = "JOB" . $code;
        
        return $message;
        
        // ============================================
        // COMMENTED CODE: job_application_alert Template (Ready to use when approved)
        // ============================================
        // Uncomment below code and comment above code when job_application_alert template is approved in MSG Club dashboard
        /*
        // Build a readable message format
        $phoneDisplay = ($jobSeekerPhone && $jobSeekerPhone !== 'N/A') ? $jobSeekerPhone : 'Not provided';
        
        // Format: Pipe-separated for template with multiple parameters
        // Template parameters: {{1}} = Job Title, {{2}} = Candidate Name, {{3}} = Email, {{4}} = Phone
        // If your template uses a single parameter, it will receive: "Job Title|Name|Email|Phone"
        return $jobTitle . '|' . $jobSeekerName . '|' . $jobSeekerEmail . '|' . $phoneDisplay;
        */
    }

    /**
     * Send WhatsApp message using MSG Club API (Template-based)
     * Uses same approach as OTP notification for consistency and speed
     */
    protected function sendWhatsAppMessage(string $phone, string $message): bool
    {
        // Get WhatsApp API configuration - use config/services.php (client's structure)
        $apiUrl = config('services.msgclub.url', env('MSGCLUB_WHATSAPP_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
        $authKey = config('services.msgclub.key', env('MSGCLUB_AUTH_KEY', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
        
        // ============================================
        // CURRENT CODE: OTP Template (Working)
        // ============================================
        // Use OTP template (otp_signup_login) - which is working and tested
        $templateName = setting('whatsapp_otp_template', env('WHATSAPP_OTP_TEMPLATE', 'otp_signup_login'));
        
        Log::debug('[WHATSAPP_NOTIFICATION] Using OTP template for job application notification', [
            'template_name' => $templateName,
            'note' => 'Using working OTP template with job application details',
        ]);
        
        // ============================================
        // COMMENTED CODE: job_application_alert Template (Ready to use when approved)
        // ============================================
        // Uncomment below code and comment above code when job_application_alert template is approved in MSG Club dashboard
        /*
        // Get template name - check local database first, then env, setting, or default
        $templateName = 'job_application_alert'; // Default fallback
        
        // Try to get from local database first
        try {
            $localTemplate = \Botble\JobBoard\Models\WhatsAppTemplate::getActiveByName('job_application_alert');
            if ($localTemplate) {
                $templateName = $localTemplate->name;
                Log::debug('[WHATSAPP_NOTIFICATION] Using template from local database', [
                    'template_id' => $localTemplate->id,
                    'template_name' => $templateName,
                ]);
            } else {
                // Fallback to env/setting
                $templateName = env('WHATSAPP_JOB_APPLICATION_TEMPLATE', 
                    setting('whatsapp_job_application_template', 
                        'job_application_alert' // Default fallback
                    )
                );
                Log::debug('[WHATSAPP_NOTIFICATION] Template not found in local database, using env/setting', [
                    'template_name' => $templateName,
                ]);
            }
        } catch (\Exception $e) {
            // If table doesn't exist yet, use env/setting
            $templateName = env('WHATSAPP_JOB_APPLICATION_TEMPLATE', 
                setting('whatsapp_job_application_template', 
                    'job_application_alert' // Default fallback
                )
            );
            Log::debug('[WHATSAPP_NOTIFICATION] Local template table not available, using env/setting', [
                'template_name' => $templateName,
                'error' => $e->getMessage(),
            ]);
        }
        
        Log::debug('[WHATSAPP_NOTIFICATION] Template name configuration', [
            'template_name' => $templateName,
            'from_env' => env('WHATSAPP_JOB_APPLICATION_TEMPLATE', 'not_set'),
            'from_setting' => setting('whatsapp_job_application_template', 'not_set'),
            'final_template' => $templateName,
        ]);
        */

        if (!$apiUrl || !$authKey) {
            Log::error('[WHATSAPP_NOTIFICATION] WhatsApp API configuration missing');
            return false;
        }

        // Clean phone number (remove any non-numeric characters) - same as OTP
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Store original phone for logging
        $phoneWithCountryCode = $phone;
        $phoneWithoutCountryCode = $phone;
        
        // Extract 10-digit phone number - same logic as OTP notification
        // Important: API requires exactly 10 digits without country code
        // Logic:
        // - 12 digits starting with 91 → 91 is country code, remove it (10 digits remain)
        // - 10 digits → use as-is (even if starts with 91, it's a valid 10-digit number)
        // - 11 digits → extract last 10 digits
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            // 12 digits starting with 91 - 91 is country code, remove it
            $phoneWithoutCountryCode = substr($phone, 2); // Remove country code (first 2 digits)
            Log::debug('[WHATSAPP_NOTIFICATION] Extracted phone without country code (12 digits)', [
                'with_country_code' => $phone,
                'without_country_code' => $phoneWithoutCountryCode,
                'note' => '91 is country code, removed to get 10 digits',
            ]);
        } elseif (strlen($phone) == 10) {
            // Already 10 digits - use as-is (even if starts with 91, it's a valid 10-digit number)
            // Example: 9103493029 is a valid 10-digit number (91 is part of the number, not country code)
            $phoneWithoutCountryCode = $phone;
            Log::debug('[WHATSAPP_NOTIFICATION] Phone is already 10 digits - using as-is', [
                'phone' => $phone,
                'note' => '10-digit number used as-is (even if starts with 91, it is valid)',
            ]);
        } elseif (strlen($phone) == 11) {
            // 11 digits - extract last 10 digits
            $phoneWithoutCountryCode = substr($phone, -10);
            Log::debug('[WHATSAPP_NOTIFICATION] Phone has 11 digits, using last 10 digits', [
                'original' => $phone,
                'extracted' => $phoneWithoutCountryCode,
            ]);
        } elseif (strlen($phone) < 10) {
            Log::error('[WHATSAPP_NOTIFICATION] Phone number too short', [
                'phone' => $phone,
                'length' => strlen($phone),
            ]);
            return false;
        } else {
            // If phone is longer than 12 digits, try to extract last 10 digits
            $phoneWithoutCountryCode = substr($phone, -10);
            Log::warning('[WHATSAPP_NOTIFICATION] Phone number format unexpected, using last 10 digits', [
                'original' => $phone,
                'extracted' => $phoneWithoutCountryCode,
                'original_length' => strlen($phone),
            ]);
        }
        
        // Final validation: Ensure we have exactly 10 digits
        if (strlen($phoneWithoutCountryCode) != 10) {
            Log::error('[WHATSAPP_NOTIFICATION] Phone number extraction failed - not 10 digits', [
                'original' => $phoneWithCountryCode,
                'extracted' => $phoneWithoutCountryCode,
                'extracted_length' => strlen($phoneWithoutCountryCode),
            ]);
            return false;
        }
        
        // Use 10-digit phone number (without country code) for API
        $phone = $phoneWithoutCountryCode;

        try {
            // ============================================
            // CURRENT CODE: OTP Template Structure (Working)
            // ============================================
            // Use OTP template structure (body + button components)
            // Message contains job application details with hint
            // Same structure as LoginController::sendWhatsAppMessage for OTP
            
            // Payload structure exactly as OTP template (body + button components)
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
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $message // Job application code (format: JOB{6-digit code})
                                    ]
                                ]
                            ],
                            [
                                'type' => 'button',
                                'sub_type' => 'url',
                                'index' => 0,
                                'parameters' => [
                                    [
                                        'type' => 'text',
                                        'text' => $message // Same code in button component (OTP template structure)
                                    ]
                                ]
                            ]
                            ]
                        ]
                    ],
                    'qrImageUrl' => false,
                    'qrLinkUrl' => false,
                    'to' => $phone
            ];
            
            // ============================================
            // COMMENTED CODE: job_application_alert Template Structure (Ready to use when approved)
            // ============================================
            // Uncomment below code and comment above code when job_application_alert template is approved in MSG Club dashboard
            /*
            // Prepare request body according to client's structure (exact format from WhatsappService)
            // Split message into parts for template parameters
            // Format: "Job Title|Candidate Name|Email|Phone"
            $messageParts = explode('|', $message);
            
            // Build parameters array - client's format: {{1}} = Job Title, {{2}} = Candidate Name, {{3}} = Email, {{4}} = Phone
            $parameters = [];
            if (count($messageParts) >= 4) {
                // Multiple parameters - add each part in order
                $parameters = [
                    ['type' => 'text', 'text' => trim($messageParts[0])], // {{1}} Job Title
                    ['type' => 'text', 'text' => trim($messageParts[1])], // {{2}} Candidate Name
                    ['type' => 'text', 'text' => trim($messageParts[2])], // {{3}} Email
                    ['type' => 'text', 'text' => trim($messageParts[3])], // {{4}} Phone
                ];
            } else {
                // Fallback: if message format is different, use first part
                $parameters = [
                    ['type' => 'text', 'text' => trim($message)]
                ];
            }
            
            // Payload structure exactly as client's WhatsappService (qrImageUrl and qrLinkUrl at top level)
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
                                'parameters' => $parameters
                            ]
                        ]
                    ]
                ],
                'qrImageUrl' => false,
                'qrLinkUrl' => false,
                'to' => $phone
            ];
            */

            Log::debug('[WHATSAPP_NOTIFICATION] Sending request', [
                'phone' => $phone,
                'template' => $templateName,
                'api_url' => $apiUrl,
                'payload' => $requestBody,
            ]);

            // Make API call with AUTH_KEY as query parameter - client's format
            // Increased timeout and retry mechanism for better reliability
            try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                ])
                ->timeout(500) // Increased timeout to 90 seconds
                ->retry(3, 2000, function ($exception, $request) {
                    // Retry on timeout or connection errors
                    return $exception instanceof \Illuminate\Http\Client\ConnectionException 
                        || $exception instanceof \GuzzleHttp\Exception\ConnectException
                        || $exception instanceof \GuzzleHttp\Exception\RequestException;
                })
                ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                // Handle connection timeout specifically
                Log::error('[WHATSAPP_NOTIFICATION] Connection timeout after retries', [
                    'phone' => $phone,
                    'error' => $e->getMessage(),
                    'timeout' => 90,
                ]);
                return false;
            } catch (\Exception $e) {
                // Handle other exceptions
                Log::error('[WHATSAPP_NOTIFICATION] API request exception', [
                    'phone' => $phone,
                    'error' => $e->getMessage(),
                ]);
                return false;
            }

            // Check if request was successful
                $responseData = $response->json();
                
            Log::info('[WHATSAPP_NOTIFICATION] API Response received', [
                'phone' => $phone,
                'status_code' => $response->status(),
                'response' => $responseData,
                'response_body' => $response->body(),
            ]);
            
            if ($response->successful()) {
                // Check response code (3001 seems to be success based on OTP implementation)
                // Also check for other success indicators
                $isSuccess = false;
                
                if (isset($responseData['responseCode'])) {
                    $isSuccess = ($responseData['responseCode'] == '3001' || $responseData['responseCode'] == 3001);
                } elseif (isset($responseData['status']) && $responseData['status'] == 'success') {
                    $isSuccess = true;
                } elseif (isset($responseData['success']) && $responseData['success'] === true) {
                    $isSuccess = true;
                } elseif ($response->status() == 200 && empty($responseData['error'])) {
                    $isSuccess = true;
                }
                
                if ($isSuccess) {
                    Log::info('[WHATSAPP_NOTIFICATION] ✓ WhatsApp notification sent successfully', [
                        'phone' => $phone,
                        'response' => $responseData
                    ]);
                    return true;
                } else {
                    // Check if template doesn't exist error
                    $responseMessage = $responseData['response'] ?? $responseData['message'] ?? '';
                    $isTemplateError = (
                        ($responseData['responseCode'] ?? '') == '3017' ||
                        stripos($responseMessage, 'template') !== false && stripos($responseMessage, 'exist') !== false
                    );
                    
                    if ($isTemplateError) {
                        Log::error('[WHATSAPP_NOTIFICATION] ✗ Template does not exist in WhatsApp panel', [
                        'phone' => $phone,
                            'template_name' => $templateName,
                            'response' => $responseData,
                            'response_code' => $responseData['responseCode'] ?? 'not_set',
                            'message' => 'Please check template name in WhatsApp panel and update .env file with correct template name',
                        ]);
                    } else {
                        Log::warning('[WHATSAPP_NOTIFICATION] ✗ WhatsApp API returned non-success response', [
                            'phone' => $phone,
                            'template_name' => $templateName,
                            'response' => $responseData,
                            'response_code' => $responseData['responseCode'] ?? 'not_set',
                        ]);
                    }
                    return false;
                }
            } else {
                Log::error('[WHATSAPP_NOTIFICATION] ✗ WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'response' => $responseData
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('[WHATSAPP_NOTIFICATION] WhatsApp API Error: ' . $e->getMessage(), [
                'phone' => $phone,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
