<?php

namespace Botble\JobBoard\Jobs;

use Botble\JobBoard\Facades\JobBoardHelper;
<<<<<<< HEAD
use Botble\JobBoard\Facades\JobBoardHelper;
=======
>>>>>>> 37fac6c5 (10 march)
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobApplication;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
<<<<<<< HEAD
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\CreditConsumption;
=======
>>>>>>> 37fac6c5 (10 march)
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
            // Reload job model with all required relationships for fresh data
            $this->jobModel->refresh();
            
            // Ensure all required relationships are loaded
            $relationshipsToLoad = ['author', 'company', 'city', 'state', 'country'];
            foreach ($relationshipsToLoad as $relation) {
                if (!$this->jobModel->relationLoaded($relation)) {
                    $this->jobModel->load($relation);
                    Log::debug('[EMAIL_NOTIFICATION] Loaded job relationship', ['relation' => $relation]);
                }
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

<<<<<<< HEAD
            // Get additional emails from apply_internal_emails - send to all additional emails without entitlement check
            // This ensures notifications go to all additional emails provided during job posting
            $additionalEmailsData = null;
            
            // Method 1: Try raw attribute FIRST (before cast) - This is more reliable
            // The cast might return empty array even if data exists in DB
            if (isset($this->jobModel->getAttributes()['apply_internal_emails'])) {
                $rawValue = $this->jobModel->getAttributes()['apply_internal_emails'];
                Log::debug('[EMAIL_NOTIFICATION] Checking raw attribute FIRST for additional emails', [
                    'raw_value' => $rawValue,
                    'raw_value_type' => gettype($rawValue),
                    'is_string' => is_string($rawValue),
                    'is_array' => is_array($rawValue),
                    'is_null' => is_null($rawValue),
                    'raw_value_length' => is_string($rawValue) ? strlen($rawValue) : 0,
                ]);
                
                if ($rawValue !== null && $rawValue !== '') {
                if (is_string($rawValue)) {
                        $decoded = json_decode($rawValue, true);
                        Log::debug('[EMAIL_NOTIFICATION] Decoded JSON string', [
                            'decoded' => $decoded,
                            'json_error' => json_last_error(),
                            'json_error_msg' => json_last_error_msg(),
                            'is_array' => is_array($decoded),
                            'is_empty' => empty($decoded),
                            'count' => is_array($decoded) ? count($decoded) : 0,
                        ]);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                            $additionalEmailsData = $decoded;
                            Log::info('[EMAIL_NOTIFICATION] ✓ Retrieved additional emails from raw attribute (JSON string)', [
                                'count' => count($additionalEmailsData),
                                'emails' => $additionalEmailsData,
                            ]);
                        }
                    } elseif (is_array($rawValue) && !empty($rawValue)) {
                    $additionalEmailsData = $rawValue;
                        Log::info('[EMAIL_NOTIFICATION] ✓ Retrieved additional emails from raw attribute (array)', [
                            'count' => count($additionalEmailsData),
                            'emails' => $additionalEmailsData,
                        ]);
=======
            // Get additional emails from apply_internal_emails only if employer has Additional Email entitlement (one-time, valid while package)
            $authorAccount = $this->jobModel->author instanceof Account ? $this->jobModel->author : null;
            $hasAdditionalEmailEntitlement = ! JobBoardHelper::isEnabledCreditsSystem() || ($authorAccount && CreditConsumption::hasEntitlement($authorAccount, CreditConsumption::FEATURE_APPLICATION_ALERT_EMAIL));
            if ($hasAdditionalEmailEntitlement && $this->jobModel->apply_internal_emails && is_array($this->jobModel->apply_internal_emails)) {
                foreach ($this->jobModel->apply_internal_emails as $email) {
                    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $employerEmails[] = $email;
                        Log::debug('[EMAIL_NOTIFICATION] Added additional email from apply_internal_emails', ['email' => $email]);
>>>>>>> 37fac6c5 (10 march)
                    }
                }
            }
            
            // Method 2: Try to get from model attribute (with cast) - Fallback
            if (empty($additionalEmailsData)) {
                $modelValue = $this->jobModel->apply_internal_emails;
                Log::debug('[EMAIL_NOTIFICATION] Checking model value for additional emails (fallback)', [
                    'model_value' => $modelValue,
                    'model_value_type' => gettype($modelValue),
                    'is_array' => is_array($modelValue),
                    'is_empty' => empty($modelValue),
                    'count' => is_array($modelValue) ? count($modelValue) : 0,
                ]);
                
                if (!empty($modelValue) && is_array($modelValue)) {
                    $additionalEmailsData = $modelValue;
                    Log::info('[EMAIL_NOTIFICATION] ✓ Retrieved additional emails from model attribute (cast)', [
                        'count' => count($additionalEmailsData),
                        'emails' => $additionalEmailsData,
                    ]);
                }
            }
            
            // Method 3: Fallback - Direct database query
            if (empty($additionalEmailsData)) {
                try {
                    $jobData = \Illuminate\Support\Facades\DB::table('jb_jobs')
                        ->where('id', $this->jobModel->id)
                        ->select('apply_internal_emails')
                        ->first();
                    
                    if ($jobData && $jobData->apply_internal_emails !== null) {
                        if (is_string($jobData->apply_internal_emails)) {
                            $decoded = json_decode($jobData->apply_internal_emails, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                $additionalEmailsData = $decoded;
                                Log::debug('[EMAIL_NOTIFICATION] Retrieved additional emails from direct DB query (JSON string)', [
                                    'count' => count($additionalEmailsData),
                                    'emails' => $additionalEmailsData,
                                ]);
                            }
                        } elseif (is_array($jobData->apply_internal_emails) && !empty($jobData->apply_internal_emails)) {
                            $additionalEmailsData = $jobData->apply_internal_emails;
                            Log::debug('[EMAIL_NOTIFICATION] Retrieved additional emails from direct DB query (array)', [
                                'count' => count($additionalEmailsData),
                                'emails' => $additionalEmailsData,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning('[EMAIL_NOTIFICATION] Failed to get additional emails from DB', ['error' => $e->getMessage()]);
                }
            }
            
            // Process additional emails
            Log::debug('[EMAIL_NOTIFICATION] Processing additional emails', [
                'additional_emails_data' => $additionalEmailsData,
                'is_array' => is_array($additionalEmailsData),
                'is_empty' => empty($additionalEmailsData),
                'count' => is_array($additionalEmailsData) ? count($additionalEmailsData) : 0,
            ]);
            
            if (!empty($additionalEmailsData) && is_array($additionalEmailsData)) {
                    foreach ($additionalEmailsData as $email) {
                    if ($email && is_string($email)) {
                        $trimmedEmail = trim($email);
                        if (filter_var($trimmedEmail, FILTER_VALIDATE_EMAIL)) {
                            $employerEmails[] = $trimmedEmail;
                            Log::info('[EMAIL_NOTIFICATION] ✓ Added additional email from apply_internal_emails', [
                                'email' => $trimmedEmail,
                                'original' => $email,
                            ]);
                        } else {
                            Log::warning('[EMAIL_NOTIFICATION] Skipped invalid email format from apply_internal_emails', [
                                'email' => $email,
                                'trimmed' => $trimmedEmail,
                            ]);
                        }
                    } else {
                        Log::warning('[EMAIL_NOTIFICATION] Skipped non-string email from apply_internal_emails', [
                            'email' => $email,
                            'type' => gettype($email),
                        ]);
                    }
                }
            } else {
                Log::info('[EMAIL_NOTIFICATION] No additional emails found in apply_internal_emails', [
                    'job_id' => $this->jobModel->id,
                    'model_value' => $modelValue,
                    'raw_attribute_exists' => isset($this->jobModel->getAttributes()['apply_internal_emails']),
                    'additional_emails_data' => $additionalEmailsData,
                    'additional_emails_data_type' => gettype($additionalEmailsData),
                ]);
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
                'application_url' => route('public.account.applicants.edit', ['applicant' => $this->application->id]),
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
            
            foreach ($employerEmails as $index => $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Log::warning('[EMAIL_NOTIFICATION] Skipping invalid email', ['email' => $email]);
                    continue;
                }

                // Check if this is an additional email (not author email)
                $isAdditionalEmail = !empty($additionalEmailsData) && in_array($email, $additionalEmailsData);
                $isAuthorEmail = ($email === ($this->jobModel->author->email ?? null));
                
                Log::info('[EMAIL_NOTIFICATION] Sending email to employer', [
                    'email' => $email,
                    'email_index' => $index + 1,
                    'total_emails' => count($employerEmails),
                    'is_additional_email' => $isAdditionalEmail,
                    'is_author_email' => $isAuthorEmail,
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
                    
                    // Check if this is an additional email (not author email)
                    $isAdditionalEmail = !empty($additionalEmailsData) && in_array($email, $additionalEmailsData);
                    $isAuthorEmail = ($email === ($this->jobModel->author->email ?? null));
                    
                    Log::info('[EMAIL_NOTIFICATION] Email sent successfully', [
                        'email' => $email,
                        'email_index' => $index + 1,
                        'total_emails' => count($employerEmails),
                        'is_additional_email' => $isAdditionalEmail,
                        'is_author_email' => $isAuthorEmail,
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
            
            // Method 1: Try to get from model attribute (with cast)
            $modelPhoneCheckValue = $this->jobModel->apply_internal_phones;
            if (!empty($modelPhoneCheckValue) && is_array($modelPhoneCheckValue)) {
                $additionalPhonesData = $modelPhoneCheckValue;
            }
            
            // Method 2: Try raw attribute (before cast)
            if (empty($additionalPhonesData) && isset($this->jobModel->getAttributes()['apply_internal_phones'])) {
                $rawValue = $this->jobModel->getAttributes()['apply_internal_phones'];
                if ($rawValue !== null) {
                if (is_string($rawValue)) {
                        $decoded = json_decode($rawValue, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                            $additionalPhonesData = $decoded;
                        }
                    } elseif (is_array($rawValue) && !empty($rawValue)) {
                    $additionalPhonesData = $rawValue;
                    }
                }
            }
            
            // Method 3: Fallback - Direct database query
            if (empty($additionalPhonesData)) {
                try {
                    $jobData = \Illuminate\Support\Facades\DB::table('jb_jobs')
                        ->where('id', $this->jobModel->id)
                        ->select('apply_internal_phones')
                        ->first();
                    
                    if ($jobData && $jobData->apply_internal_phones !== null) {
                        if (is_string($jobData->apply_internal_phones)) {
                            $decoded = json_decode($jobData->apply_internal_phones, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                $additionalPhonesData = $decoded;
                            }
                        } elseif (is_array($jobData->apply_internal_phones) && !empty($jobData->apply_internal_phones)) {
                            $additionalPhonesData = $jobData->apply_internal_phones;
                        }
                    }
                } catch (\Exception $e) {
                    // Silent fail for this check
                }
            }
            
            // Check if we have valid phone numbers
            if (!empty($additionalPhonesData) && is_array($additionalPhonesData)) {
                    $hasAdditionalPhones = !empty(array_filter($additionalPhonesData));
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
<<<<<<< HEAD
                // WhatsApp: send only if employer has entitlement (deducted when adding phone; valid till package active)
                $shouldSendWhatsApp = true;
                
                // Check if credits system is enabled and table exists
                $creditsSystemEnabled = false;
                $creditTableExists = false;
                
                try {
                    $creditsSystemEnabled = JobBoardHelper::isEnabledCreditsSystem();
                    $creditTableExists = \Illuminate\Support\Facades\Schema::hasTable('jb_credit_consumption');
                } catch (\Exception $e) {
                    Log::warning('[WHATSAPP_NOTIFICATION] Error checking credits system', [
                        'error' => $e->getMessage(),
                    ]);
                }
                
                if ($creditsSystemEnabled && $creditTableExists && $this->jobModel->author instanceof Account) {
                    try {
                    $account = $this->jobModel->author;
                    $account->refresh();
                    if (! CreditConsumption::hasEntitlement($account, CreditConsumption::FEATURE_APPLICATION_ALERT_WP)) {
                        $shouldSendWhatsApp = false;
                        Log::warning('[WHATSAPP_NOTIFICATION] ✗ Skipping WhatsApp - no entitlement (valid till package active)', ['job_id' => $this->jobModel->id]);
                    }
                    } catch (\Exception $e) {
                        // If credit check fails, still send WhatsApp (don't block notifications)
                        Log::warning('[WHATSAPP_NOTIFICATION] Credit check failed, sending WhatsApp anyway', [
                            'error' => $e->getMessage(),
                            'job_id' => $this->jobModel->id,
                        ]);
                        $shouldSendWhatsApp = true;
                    }
                } else {
                    // Credits system disabled or table doesn't exist - send WhatsApp anyway
                    Log::info('[WHATSAPP_NOTIFICATION] Credits system disabled or table missing - sending WhatsApp without credit check', [
                        'credits_system_enabled' => $creditsSystemEnabled,
                        'credit_table_exists' => $creditTableExists,
                    ]);
                }
                
=======
                // Per-alert credit deduction: only send WhatsApp if employer has credits (New Application Alert by WhatsApp)
                $shouldSendWhatsApp = true;
                if (JobBoardHelper::isEnabledCreditsSystem() && $this->jobModel->author instanceof Account) {
                    $account = $this->jobModel->author;
                    $account->refresh();
                    $wpCredits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_APPLICATION_ALERT_WP, 10);
                    if ($account->credits < $wpCredits) {
                        $shouldSendWhatsApp = false;
                        Log::warning('[WHATSAPP_NOTIFICATION] ✗ Skipping WhatsApp - insufficient credits (per-alert)', [
                            'job_id' => $this->jobModel->id,
                            'account_credits' => $account->credits,
                            'required' => $wpCredits,
                        ]);
                    } else {
                        $ok = CreditConsumption::deductForFeature(
                            $account,
                            CreditConsumption::FEATURE_APPLICATION_ALERT_WP,
                            $wpCredits,
                            'New Application Alert by WhatsApp (per alert)',
                            ['job_id' => $this->jobModel->id, 'application_id' => $this->application->id]
                        );
                        if (! $ok) {
                            $shouldSendWhatsApp = false;
                            Log::warning('[WHATSAPP_NOTIFICATION] ✗ Skipping WhatsApp - deduct failed', ['job_id' => $this->jobModel->id]);
                        }
                    }
                }
>>>>>>> 37fac6c5 (10 march)
                if ($shouldSendWhatsApp) {
                    Log::info('[WHATSAPP_NOTIFICATION] ✓ WhatsApp notifications enabled - sending notifications', [
                        'job_id' => $this->jobModel->id,
                        'application_id' => $this->application->id,
                    ]);
<<<<<<< HEAD
                $this->sendWhatsAppNotifications($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $this->jobModel->name);
=======
                    $this->sendWhatsAppNotifications($jobSeekerName, $jobSeekerEmail, $jobSeekerPhone, $this->jobModel->name);
>>>>>>> 37fac6c5 (10 march)
                }
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
            // Ensure all required relationships are loaded for dynamic data
            $relationshipsToLoad = ['company', 'city', 'state', 'country', 'author'];
            foreach ($relationshipsToLoad as $relation) {
                if (!$this->jobModel->relationLoaded($relation)) {
                    $this->jobModel->load($relation);
                }
            }
            
            // Refresh job model to ensure latest data
            $this->jobModel->refresh();

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
            // Send to all additional phones without entitlement check
            $additionalPhonesForWhatsApp = null;
            
            // Method 1: Try raw attribute FIRST (before cast) - This is more reliable
            if (isset($this->jobModel->getAttributes()['apply_internal_phones'])) {
                $rawValue = $this->jobModel->getAttributes()['apply_internal_phones'];
                Log::debug('[WHATSAPP_NOTIFICATION] Checking raw attribute FIRST for additional phones', [
                    'raw_value' => $rawValue,
                    'raw_value_type' => gettype($rawValue),
                    'is_string' => is_string($rawValue),
                    'is_array' => is_array($rawValue),
                    'is_null' => is_null($rawValue),
                ]);
                
                if ($rawValue !== null && $rawValue !== '') {
                if (is_string($rawValue)) {
                        $decoded = json_decode($rawValue, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                            $additionalPhonesForWhatsApp = $decoded;
                            Log::info('[WHATSAPP_NOTIFICATION] ✓ Retrieved additional phones from raw attribute (JSON string)', [
                                'count' => count($additionalPhonesForWhatsApp),
                                'phones' => $additionalPhonesForWhatsApp,
                            ]);
                        }
                    } elseif (is_array($rawValue) && !empty($rawValue)) {
                    $additionalPhonesForWhatsApp = $rawValue;
                        Log::info('[WHATSAPP_NOTIFICATION] ✓ Retrieved additional phones from raw attribute (array)', [
                            'count' => count($additionalPhonesForWhatsApp),
                            'phones' => $additionalPhonesForWhatsApp,
                        ]);
                    }
                }
            }
            
            // Method 2: Try to get from model attribute (with cast) - Fallback
            if (empty($additionalPhonesForWhatsApp)) {
                $modelPhoneValue = $this->jobModel->apply_internal_phones;
                if (!empty($modelPhoneValue) && is_array($modelPhoneValue)) {
                    $additionalPhonesForWhatsApp = $modelPhoneValue;
                    Log::info('[WHATSAPP_NOTIFICATION] ✓ Retrieved additional phones from model attribute (cast)', [
                        'count' => count($additionalPhonesForWhatsApp),
                        'phones' => $additionalPhonesForWhatsApp,
                    ]);
                }
            }
            
            // Method 3: Fallback - Direct database query
            if (empty($additionalPhonesForWhatsApp)) {
                try {
                    $jobData = \Illuminate\Support\Facades\DB::table('jb_jobs')
                        ->where('id', $this->jobModel->id)
                        ->select('apply_internal_phones')
                        ->first();
                    
                    if ($jobData && $jobData->apply_internal_phones !== null) {
                        if (is_string($jobData->apply_internal_phones)) {
                            $decoded = json_decode($jobData->apply_internal_phones, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                $additionalPhonesForWhatsApp = $decoded;
                                Log::debug('[WHATSAPP_NOTIFICATION] Retrieved additional phones from direct DB query (JSON string)', [
                                    'count' => count($additionalPhonesForWhatsApp),
                                    'phones' => $additionalPhonesForWhatsApp,
                                ]);
                            }
                        } elseif (is_array($jobData->apply_internal_phones) && !empty($jobData->apply_internal_phones)) {
                            $additionalPhonesForWhatsApp = $jobData->apply_internal_phones;
                            Log::debug('[WHATSAPP_NOTIFICATION] Retrieved additional phones from direct DB query (array)', [
                                'count' => count($additionalPhonesForWhatsApp),
                                'phones' => $additionalPhonesForWhatsApp,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning('[WHATSAPP_NOTIFICATION] Failed to get additional phones from DB', ['error' => $e->getMessage()]);
                }
            }
            
            // Process additional phones
            if (!empty($additionalPhonesForWhatsApp) && is_array($additionalPhonesForWhatsApp)) {
                    foreach ($additionalPhonesForWhatsApp as $phone) {
                    if ($phone && is_string($phone) && !empty(trim($phone))) {
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
                            Log::info('[WHATSAPP_NOTIFICATION] ✓ Added additional phone from apply_internal_phones', [
                                    'original_phone' => $phone,
                                    'cleaned_phone' => $cleanPhone
                                ]);
                            } else {
                                Log::warning('[WHATSAPP_NOTIFICATION] Skipped invalid phone from apply_internal_phones', [
                                    'phone' => $phone,
                                'cleaned_phone' => $cleanPhone,
                                    'cleaned_length' => strlen($cleanPhone)
                                ]);
                            }
                        }
                    }
            } else {
                Log::info('[WHATSAPP_NOTIFICATION] No additional phones found in apply_internal_phones', [
                    'job_id' => $this->jobModel->id,
                    'model_value' => $modelPhoneValue,
                    'raw_attribute_exists' => isset($this->jobModel->getAttributes()['apply_internal_phones']),
                ]);
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
     * Build WhatsApp message parameters for job application notification
     * 
     * CURRENT: Using new_application_msg_to_school template
     * Template requires 5 body parameters + 1 button parameter:
     * Body: 1. Company Name, 2. Job Title, 3. Candidate Name, 4. Location, 5. Phone
     * Button: 1. Candidate Name (lowercase)
     * 
     * Returns array with 'body' and 'button' keys containing parameter arrays
     */
    protected function buildWhatsAppMessage(string $jobSeekerName, string $jobSeekerEmail, string $jobSeekerPhone, string $jobTitle): array
    {
        // Ensure all relationships are loaded for dynamic data - RELOAD to get fresh data
        $relationshipsToLoad = ['company', 'city', 'state', 'country'];
        foreach ($relationshipsToLoad as $relation) {
            if (!$this->jobModel->relationLoaded($relation)) {
                $this->jobModel->load($relation);
            }
        }
        
        // Reload job model to ensure we have latest data
        $this->jobModel->refresh();
        
        // ============================================
        // DYNAMIC COMPANY NAME - Get from Database
        // ============================================
        $companyName = 'School/Institution'; // Default fallback
        
        // Method 1: Use company relationship (most reliable)
        if ($this->jobModel->company && $this->jobModel->company->id && !empty($this->jobModel->company->name)) {
            $companyName = trim($this->jobModel->company->name);
            Log::debug('[WHATSAPP_NOTIFICATION] Company name from relationship', [
                'company_id' => $this->jobModel->company->id,
                'company_name' => $companyName,
            ]);
        }
        // Method 2: Use company_name accessor (getCompanyNameAttribute)
        elseif (method_exists($this->jobModel, 'getCompanyNameAttribute') || property_exists($this->jobModel, 'company_name')) {
            try {
                $companyNameAttr = $this->jobModel->company_name;
                if (!empty($companyNameAttr) && strlen(trim($companyNameAttr)) > 1) {
                    $companyName = trim($companyNameAttr);
                    Log::debug('[WHATSAPP_NOTIFICATION] Company name from accessor', [
                        'company_name' => $companyName,
                    ]);
                }
            } catch (\Exception $e) {
                Log::debug('[WHATSAPP_NOTIFICATION] Company name accessor error', ['error' => $e->getMessage()]);
            }
        }
        
        // Final validation
        if (empty($companyName) || strlen($companyName) < 2) {
            $companyName = 'School/Institution';
            Log::warning('[WHATSAPP_NOTIFICATION] Using fallback company name', [
                'job_id' => $this->jobModel->id,
                'company_id' => $this->jobModel->company_id,
                'company_loaded' => $this->jobModel->relationLoaded('company') ? 'yes' : 'no',
                'company_exists' => $this->jobModel->company ? 'yes' : 'no',
            ]);
        }
        
        // ============================================
        // DYNAMIC LOCATION - Get from Database
        // ============================================
        $location = 'India'; // Default fallback
        
        // Method 1: City from relationship (preferred)
        if ($this->jobModel->city && $this->jobModel->city->id && !empty($this->jobModel->city->name)) {
            $location = trim($this->jobModel->city->name);
            Log::debug('[WHATSAPP_NOTIFICATION] Location from city relationship', [
                'city_id' => $this->jobModel->city->id,
                'location' => $location,
            ]);
        }
        // Method 2: City name attribute
        elseif (!empty($this->jobModel->city_name) && strlen(trim($this->jobModel->city_name)) > 1) {
            $location = trim($this->jobModel->city_name);
            Log::debug('[WHATSAPP_NOTIFICATION] Location from city_name attribute', [
                'location' => $location,
            ]);
        }
        // Method 3: State from relationship
        elseif ($this->jobModel->state && $this->jobModel->state->id && !empty($this->jobModel->state->name)) {
            $location = trim($this->jobModel->state->name);
            Log::debug('[WHATSAPP_NOTIFICATION] Location from state relationship', [
                'state_id' => $this->jobModel->state->id,
                'location' => $location,
            ]);
        }
        // Method 4: State name attribute
        elseif (!empty($this->jobModel->state_name) && strlen(trim($this->jobModel->state_name)) > 1) {
            $location = trim($this->jobModel->state_name);
            Log::debug('[WHATSAPP_NOTIFICATION] Location from state_name attribute', [
                'location' => $location,
            ]);
        }
        // Method 5: Location field
        elseif (!empty($this->jobModel->location) && strlen(trim($this->jobModel->location)) > 1) {
            $location = trim($this->jobModel->location);
            Log::debug('[WHATSAPP_NOTIFICATION] Location from location field', [
                'location' => $location,
            ]);
        }
        
        // Final validation
        if (empty($location) || strlen($location) < 2) {
            $location = 'India';
            Log::warning('[WHATSAPP_NOTIFICATION] Using fallback location', [
                'job_id' => $this->jobModel->id,
                'city_id' => $this->jobModel->city_id,
                'state_id' => $this->jobModel->state_id,
                'city_loaded' => $this->jobModel->relationLoaded('city') ? 'yes' : 'no',
                'state_loaded' => $this->jobModel->relationLoaded('state') ? 'yes' : 'no',
                'city_exists' => $this->jobModel->city ? 'yes' : 'no',
                'state_exists' => $this->jobModel->state ? 'yes' : 'no',
            ]);
        }
        
        // Format phone number (remove any non-numeric characters, keep only digits)
        $phoneDisplay = preg_replace('/[^0-9]/', '', $jobSeekerPhone);
        if (empty($phoneDisplay) || $phoneDisplay === 'N/A') {
            $phoneDisplay = 'Not provided';
        }
        
        // Get job seeker profile URL for button
        $jobSeekerProfileUrl = '';
        try {
            // Load account relationship if not loaded
            if (!$this->application->relationLoaded('account')) {
                $this->application->load('account');
            }
            
            if ($this->application->account && $this->application->account->id) {
                // Get profile URL - try account->url first (if available)
                if (method_exists($this->application->account, 'getUrlAttribute') || property_exists($this->application->account, 'url')) {
                    $jobSeekerProfileUrl = $this->application->account->url ?? '';
                }
                
                // If URL not available, generate from route
                if (empty($jobSeekerProfileUrl)) {
                    try {
                        // Try to get slug from slugable relationship
                        if (!$this->application->account->relationLoaded('slugable')) {
                            $this->application->account->load('slugable');
                        }
                        
                        if ($this->application->account->slugable && $this->application->account->slugable->key) {
                            $jobSeekerProfileUrl = route('public.candidate', ['slug' => $this->application->account->slugable->key]);
                        } else {
                            // Fallback: use account ID (if route supports it)
                            $jobSeekerProfileUrl = route('public.candidate', ['slug' => $this->application->account->id]);
                        }
                    } catch (\Exception $e) {
                        Log::warning('[WHATSAPP_NOTIFICATION] Could not generate profile URL', [
                            'account_id' => $this->application->account->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('[WHATSAPP_NOTIFICATION] Error getting job seeker profile URL', [
                'application_id' => $this->application->id,
                'error' => $e->getMessage(),
            ]);
        }
        
        // If profile URL is still empty, use phone number as fallback
        $buttonParameter = !empty($jobSeekerProfileUrl) ? $jobSeekerProfileUrl : $phoneDisplay;
        
        // Log the values being used for debugging
        Log::debug('[WHATSAPP_NOTIFICATION] Building message parameters', [
            'company_name' => $companyName,
            'job_title' => $jobTitle,
            'candidate_name' => $jobSeekerName,
            'location' => $location,
            'phone' => $phoneDisplay,
            'profile_url' => $jobSeekerProfileUrl,
            'button_parameter' => $buttonParameter,
        ]);
        
        // Return parameters array for new_application_msg_to_school template
        // EXACT as Postman screenshot:
        // Body: 1. Company Name, 2. Job Title, 3. Candidate Name, 4. Location, 5. Phone
        // Button: 1. Profile URL (to view applicant profile) or Phone Number as fallback
        return [
            'body' => [
                $companyName,        // Parameter 1: Company/School Name (e.g., "Alpha School")
                $jobTitle,           // Parameter 2: Job Title (e.g., "Hindi Teacher")
                $jobSeekerName,      // Parameter 3: Candidate Name (e.g., "Deepak")
                $location,           // Parameter 4: Location (e.g., "Indore")
                $phoneDisplay,       // Parameter 5: Phone Number (e.g., "9109459959")
            ],
            'button' => [
                $buttonParameter,    // Parameter 1: Profile URL (e.g., "https://example.com/candidates/john-doe") or Phone Number as fallback
            ],
        ];
        
        // ============================================
        // COMMENTED CODE: OTP Template (Previous implementation)
        // ============================================
        /*
        // Build a very short message optimized for OTP template
        $applicationId = $this->application->id ?? 0;
        $jobId = $this->jobModel->id ?? 0;
        $code = str_pad($jobId % 1000, 3, '0', STR_PAD_LEFT) . str_pad($applicationId % 1000, 3, '0', STR_PAD_LEFT);
        $message = "JOB" . $code;
        return $message;
        */
        
        // ============================================
        // COMMENTED CODE: job_application_alert Template (Ready to use when approved)
        // ============================================
        /*
        // Build a readable message format
        $phoneDisplay = ($jobSeekerPhone && $jobSeekerPhone !== 'N/A') ? $jobSeekerPhone : 'Not provided';
        return $jobTitle . '|' . $jobSeekerName . '|' . $jobSeekerEmail . '|' . $phoneDisplay;
        */
    }

    /**
     * Send WhatsApp message using MSG Club API (Template-based)
     * Uses same approach as OTP notification in LoginController for reliability
     * Template: new_application_msg_to_school with 5 body parameters + 1 button parameter
     */
    protected function sendWhatsAppMessage(string $phone, array $messageParams): bool
    {
        // Get WhatsApp API configuration - SAME as OTP notification
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
        $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));

        if (!$apiUrl || !$authKey) {
            Log::error('[WHATSAPP_NOTIFICATION] WhatsApp API configuration missing');
            return false;
        }

        // Template name: new_application_msg_to_school (client provided, working in Postman)
        $templateName = 'new_application_msg_to_school';
        
        // Allow override via env/setting if needed
        $envTemplate = env('WHATSAPP_JOB_APPLICATION_TEMPLATE');
        $settingTemplate = setting('whatsapp_job_application_template');
        
        if ($envTemplate && $envTemplate !== 'job_application_alert') {
            $templateName = $envTemplate;
        } elseif ($settingTemplate && $settingTemplate !== 'job_application_alert') {
            $templateName = $settingTemplate;
        }
        
        Log::debug('[WHATSAPP_NOTIFICATION] Using template (same approach as OTP)', [
            'template_name' => $templateName,
            'body_params_count' => count($messageParams['body'] ?? []),
            'button_params_count' => count($messageParams['button'] ?? []),
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

        // Clean phone number (remove any non-numeric characters) - EXACT SAME as OTP
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Store original phone for logging
        $phoneWithCountryCode = $phone;
        $phoneWithoutCountryCode = $phone;
        
        // Extract 10-digit phone number - EXACT SAME LOGIC as OTP notification in LoginController
        // If phone has country code (starts with 91 and is 12 digits), extract 10 digits
        // According to API documentation, mobileNumbers and 'to' should be 10 digits without country code
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            $phoneWithoutCountryCode = substr($phone, 2); // Remove country code
            Log::info('[WHATSAPP_NOTIFICATION] Extracted phone without country code (same as OTP)', [
                'with_country_code' => $phone,
                'without_country_code' => $phoneWithoutCountryCode,
            ]);
        } elseif (strlen($phone) == 10) {
            // Already 10 digits, no country code
            $phoneWithoutCountryCode = $phone;
            Log::info('[WHATSAPP_NOTIFICATION] Phone is already 10 digits (same as OTP)', [
                'phone' => $phone,
            ]);
        } elseif (strlen($phone) < 10) {
            Log::error('[WHATSAPP_NOTIFICATION] Phone number too short (same validation as OTP)', [
                'phone' => $phone,
                'length' => strlen($phone),
            ]);
            return false;
        } else {
            // If phone is longer than 12 digits or doesn't start with 91, try to extract last 10 digits
            $phoneWithoutCountryCode = substr($phone, -10);
            Log::warning('[WHATSAPP_NOTIFICATION] Phone number format unexpected, using last 10 digits (same as OTP)', [
                'original' => $phone,
                'extracted' => $phoneWithoutCountryCode,
            ]);
        }
        
        // Use 10-digit phone number (without country code) for API - SAME as OTP
        $phone = $phoneWithoutCountryCode;

        // ============================================
        // CURRENT CODE: new_application_msg_to_school Template Structure
        // ============================================
        // Template requires 5 body parameters + 1 button parameter:
        // Body: 1. Company Name, 2. Job Title, 3. Candidate Name, 4. Location, 5. Phone
        // Button: 1. Candidate Name (lowercase)
        
        // Extract parameters from messageParams array
        $bodyParams = $messageParams['body'] ?? [];
        $buttonParams = $messageParams['button'] ?? [];
        
        // Build body parameters array
        $bodyParameters = [];
        foreach ($bodyParams as $param) {
            $bodyParameters[] = [
                'type' => 'text',
                'text' => (string)$param
            ];
        }
        
        // Build button parameters array
        $buttonParameters = [];
        foreach ($buttonParams as $param) {
            $buttonParameters[] = [
                'type' => 'text',
                'text' => (string)$param
            ];
        }
        
        // Payload structure EXACTLY as Postman (working example) - SAME STRUCTURE as OTP
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
                            'parameters' => $bodyParameters
                        ],
                        [
                            'type' => 'button',
                            'sub_type' => 'url',
                            'index' => 0,
                            'parameters' => $buttonParameters
                        ]
                            ]
                        ]
                    ],
                    'qrImageUrl' => false,
                    'qrLinkUrl' => false,
                    'to' => $phone
        ];
        
        // Log full payload for debugging (EXACT as Postman) - SAME as OTP
        Log::info('[WHATSAPP_NOTIFICATION] Sending WhatsApp notification (EXACT OTP structure)', [
            'template_name' => $templateName,
            'phone' => $phone,
            'api_url' => $apiUrl,
            'sender_id' => $senderId,
            'body_params_count' => count($bodyParams),
            'button_params_count' => count($buttonParams),
            'body_params' => $bodyParams,
            'button_params' => $buttonParams,
            'full_payload' => $requestBody,
        ]);

        // Make API call - EXACT SAME as OTP notification in LoginController
        // Added timeout and retry mechanism for better reliability
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(90) // Increased timeout to 90 seconds (same as other WhatsApp calls)
            ->retry(3, 2000, function ($exception, $request) {
                // Retry on timeout or connection errors (same as OTP and other WhatsApp calls)
                return $exception instanceof \Illuminate\Http\Client\ConnectionException
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            // Check if request was successful - SAME as OTP
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Check response code (3001 seems to be success based on OTP and Postman)
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[WHATSAPP_NOTIFICATION] ✓ WhatsApp notification sent successfully (same as OTP)', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'template' => $templateName,
                        'message_id' => $responseData['response'] ?? null,
                    ]);
                    return true;
                } else {
                    Log::warning('[WHATSAPP_NOTIFICATION] ✗ WhatsApp API returned non-success response', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'response_code' => $responseData['responseCode'] ?? 'unknown',
                        'template' => $templateName,
                    ]);
                    return false;
                }
            } else {
                Log::error('[WHATSAPP_NOTIFICATION] ✗ WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'template' => $templateName,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('[WHATSAPP_NOTIFICATION] ✗ WhatsApp API Error (same handling as OTP)', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'template' => $templateName,
            ]);
            return false;
        }
    }
}
