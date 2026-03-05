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
use Illuminate\Support\Facades\Http;

class SendJobSeekerStatusUpdateWhatsAppJob implements ShouldQueue
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
        $this->onQueue('default');
    }

    public function handle(): void
    {
        try {
            // Handle enum serialization issue FIRST - convert string to enum if needed
            // This must happen before any getValue() calls
            // Check if status is string or not an enum object
            $oldStatusValue = null;
            $newStatusValue = null;
            
            // Convert string to enum if needed - SIMPLIFIED APPROACH
            if (is_string($this->oldStatus)) {
                $oldStatusValue = $this->oldStatus;
                $enumInstance = new JobApplicationStatusEnum();
                $this->oldStatus = $enumInstance->make($oldStatusValue);
                Log::info('[WHATSAPP_STATUS_UPDATE] Converted oldStatus from string to enum', [
                    'original_value' => $oldStatusValue,
                    'converted_class' => get_class($this->oldStatus),
                ]);
            } elseif (!($this->oldStatus instanceof JobApplicationStatusEnum)) {
                // If it's an object but not an enum, try to get its value safely
                if (is_string($this->oldStatus)) {
                    $oldStatusValue = $this->oldStatus;
                } elseif (is_object($this->oldStatus)) {
                    try {
                        // Only call getValue() if it's actually an enum-like object
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
                Log::info('[WHATSAPP_STATUS_UPDATE] Converted oldStatus from object to enum', [
                    'original_value' => $oldStatusValue,
                    'original_type' => gettype($oldStatusValue),
                    'converted_class' => get_class($this->oldStatus),
                ]);
            }
            
            if (is_string($this->newStatus)) {
                $newStatusValue = $this->newStatus;
                $enumInstance = new JobApplicationStatusEnum();
                $this->newStatus = $enumInstance->make($newStatusValue);
                Log::info('[WHATSAPP_STATUS_UPDATE] Converted newStatus from string to enum', [
                    'original_value' => $newStatusValue,
                    'converted_class' => get_class($this->newStatus),
                ]);
            } elseif (!($this->newStatus instanceof JobApplicationStatusEnum)) {
                // If it's an object but not an enum, try to get its value safely
                if (is_string($this->newStatus)) {
                    $newStatusValue = $this->newStatus;
                } elseif (is_object($this->newStatus)) {
                    try {
                        // Only call getValue() if it's actually an enum-like object
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
                Log::info('[WHATSAPP_STATUS_UPDATE] Converted newStatus from object to enum', [
                    'original_value' => $newStatusValue,
                    'original_type' => gettype($newStatusValue),
                    'converted_class' => get_class($this->newStatus),
                ]);
            }
            
            // Ensure we have valid enum objects - DOUBLE CHECK
            if (!($this->newStatus instanceof JobApplicationStatusEnum)) {
                // Try one more time to convert
                if (is_string($this->newStatus)) {
                    $enumInstance = new JobApplicationStatusEnum();
                    $this->newStatus = $enumInstance->make($this->newStatus);
                    Log::info('[WHATSAPP_STATUS_UPDATE] Second attempt: Converted newStatus from string to enum');
                } else {
                    Log::error('[WHATSAPP_STATUS_UPDATE] newStatus is not an enum instance after conversion', [
                        'new_status_type' => gettype($this->newStatus),
                        'new_status_class' => is_object($this->newStatus) ? get_class($this->newStatus) : 'not_object',
                        'new_status_value' => is_string($this->newStatus) ? $this->newStatus : 'not_string',
                    ]);
                    return;
                }
            }
            
            if (!($this->oldStatus instanceof JobApplicationStatusEnum)) {
                // Try one more time to convert
                if (is_string($this->oldStatus)) {
                    $enumInstance = new JobApplicationStatusEnum();
                    $this->oldStatus = $enumInstance->make($this->oldStatus);
                    Log::info('[WHATSAPP_STATUS_UPDATE] Second attempt: Converted oldStatus from string to enum');
                } else {
                    Log::error('[WHATSAPP_STATUS_UPDATE] oldStatus is not an enum instance after conversion', [
                        'old_status_type' => gettype($this->oldStatus),
                        'old_status_class' => is_object($this->oldStatus) ? get_class($this->oldStatus) : 'not_object',
                        'old_status_value' => is_string($this->oldStatus) ? $this->oldStatus : 'not_string',
                    ]);
                    return;
                }
            }
            
            // Get status values from enum objects - with EXTRA defensive error handling
            $oldStatusValue = null;
            $newStatusValue = null;
            
            // Safely get oldStatus value
            if ($this->oldStatus instanceof JobApplicationStatusEnum) {
                try {
                    $oldStatusValue = $this->oldStatus->getValue();
                } catch (\Exception $e) {
                    Log::error('[WHATSAPP_STATUS_UPDATE] Error getting oldStatus value', [
                        'error' => $e->getMessage(),
                        'old_status_type' => gettype($this->oldStatus),
                        'old_status_class' => get_class($this->oldStatus),
                    ]);
                    return;
                }
            } else {
                Log::error('[WHATSAPP_STATUS_UPDATE] oldStatus is not an enum instance when trying to get value', [
                    'old_status_type' => gettype($this->oldStatus),
                ]);
                return;
            }
            
            // Safely get newStatus value
            if ($this->newStatus instanceof JobApplicationStatusEnum) {
                try {
                    $newStatusValue = $this->newStatus->getValue();
                } catch (\Exception $e) {
                    Log::error('[WHATSAPP_STATUS_UPDATE] Error getting newStatus value', [
                        'error' => $e->getMessage(),
                        'new_status_type' => gettype($this->newStatus),
                        'new_status_class' => get_class($this->newStatus),
                    ]);
                    return;
                }
            } else {
                Log::error('[WHATSAPP_STATUS_UPDATE] newStatus is not an enum instance when trying to get value', [
                    'new_status_type' => gettype($this->newStatus),
                ]);
                return;
            }
            
            Log::info('[WHATSAPP_STATUS_UPDATE] Job started', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'old_status_type' => get_class($this->oldStatus),
                'new_status_type' => get_class($this->newStatus),
                'old_status_value' => $oldStatusValue,
                'new_status_value' => $newStatusValue,
            ]);
            
            // Use string values to avoid enum serialization issues
            $shortListValue = 'short_list';
            $rejectedValue = 'rejected';
            
            Log::info('[WHATSAPP_STATUS_UPDATE] Status values extracted', [
                'application_id' => $this->application->id,
                'old_status' => $oldStatusValue,
                'new_status' => $newStatusValue,
                'short_list_value' => $shortListValue,
                'rejected_value' => $rejectedValue,
            ]);
            
            if ($newStatusValue !== $shortListValue && $newStatusValue !== $rejectedValue) {
                Log::info('[WHATSAPP_STATUS_UPDATE] Status not shortlisted/rejected, skipping', [
                    'application_id' => $this->application->id,
                    'new_status' => $newStatusValue,
                ]);
                return;
            }

            // CRITICAL: Get job seeker phone number DIRECTLY from jb_applications table
            // This is the phone column value from jb_applications table (screenshot shows this table)
            // Example: For application_id 96, phone is "+919109459959" from jb_applications table
            // NOT the employer's phone
            $jobSeekerPhone = $this->application->getAttribute('phone') ?? $this->application->account->phone ?? null; // Direct column access from jb_applications table
            
            // This matches the screenshot: jb_applications table has phone column
            Log::info('[WHATSAPP_STATUS_UPDATE] Phone number fetched DIRECTLY from jb_applications table', [
                'application_id' => $this->application->id,
                'table' => 'jb_applications',
                'table_column' => 'phone',
                'phone_from_jb_applications_table' => $this->application->getAttribute('phone') ?? 'not_set',
                'raw_phone_value' => $this->application->getRawOriginal('phone') ?? 'not_set',
                'phone_from_account' => $this->application->account->phone ?? 'not_set',
                'final_phone' => $jobSeekerPhone ?? 'not_set',
                'recipient_type' => 'JOB_SEEKER_CANDIDATE',
                'note' => 'Phone is from jb_applications.phone column - the candidate who applied (see screenshot)',
            ]);
            
            if (empty($jobSeekerPhone)) {
                Log::warning('[WHATSAPP_STATUS_UPDATE] Job seeker phone not available', [
                    'application_id' => $this->application->id,
                    'application_phone' => $this->application->phone ?? null,
                    'account_phone' => $this->application->account->phone ?? null,
                ]);
                return;
            }

            // Clean phone number
            $jobSeekerPhone = preg_replace('/[^0-9]/', '', $jobSeekerPhone);
            
            if (strlen($jobSeekerPhone) < 10) {
                Log::warning('[WHATSAPP_STATUS_UPDATE] Invalid phone number', [
                    'application_id' => $this->application->id,
                    'phone' => $jobSeekerPhone,
                ]);
                return;
            }

            // Extract 10-digit phone number (same logic as OTP)
            if (strlen($jobSeekerPhone) == 12 && substr($jobSeekerPhone, 0, 2) == '91') {
                $jobSeekerPhone = substr($jobSeekerPhone, 2);
            } elseif (strlen($jobSeekerPhone) > 10) {
                $jobSeekerPhone = substr($jobSeekerPhone, -10);
            }

            // Use string comparison to avoid enum serialization issues
            $isShortlisted = $newStatusValue === 'short_list';
            $isRejected = $newStatusValue === 'rejected';

            // Build message parameters
            $messageParams = $this->buildMessageParameters($isShortlisted);

            // Send WhatsApp notification
            $sendResult = $this->sendWhatsAppMessage($jobSeekerPhone, $messageParams, $isShortlisted);

            // Only log success if API call was actually successful
            if ($sendResult) {
                $statusLabel = $isShortlisted ? 'SHORTLISTED' : 'REJECTED';
                Log::info('[WHATSAPP_STATUS_UPDATE] ✓ WhatsApp notification sent successfully', [
                    'application_id' => $this->application->id,
                    'job_id' => $this->jobModel->id,
                    'status' => $newStatusValue,
                    'status_label' => $statusLabel,
                    'phone' => $jobSeekerPhone,
                    'is_shortlisted' => $isShortlisted,
                    'is_rejected' => $isRejected,
                    'template' => $isShortlisted ? 'shortlist_application_for_job' : 'application_reject_for_position',
                ]);
            } else {
                Log::error('[WHATSAPP_STATUS_UPDATE] ✗ Failed to send WhatsApp notification', [
                    'application_id' => $this->application->id,
                    'job_id' => $this->jobModel->id,
                    'status' => $newStatusValue,
                    'phone' => $jobSeekerPhone,
                    'is_shortlisted' => $isShortlisted,
                    'is_rejected' => $isRejected,
                    'template' => $isShortlisted ? 'shortlist_application_for_job' : 'application_reject_for_position',
                ]);
            }

        } catch (\Exception $e) {
            Log::error('[WHATSAPP_STATUS_UPDATE] Failed to send WhatsApp notification', [
                'application_id' => $this->application->id,
                'job_id' => $this->jobModel->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }

    protected function buildMessageParameters(bool $isShortlisted): array
    {
        // Ensure all relationships are loaded
        $relationshipsToLoad = ['company', 'city', 'state', 'country'];
        foreach ($relationshipsToLoad as $relation) {
            if (!$this->jobModel->relationLoaded($relation)) {
                $this->jobModel->load($relation);
            }
        }

        // Get job seeker name
        $jobSeekerName = $this->application->full_name ?? 'Job Seeker';

        // Get job title
        $jobTitle = $this->jobModel->name ?? 'Job Position';

        // Get company name
        $companyName = 'School/Institution';
        if ($this->jobModel->company && $this->jobModel->company->id && !empty($this->jobModel->company->name)) {
            $companyName = trim($this->jobModel->company->name);
        } elseif (method_exists($this->jobModel, 'getCompanyNameAttribute') || property_exists($this->jobModel, 'company_name')) {
            try {
                $companyNameAttr = $this->jobModel->company_name;
                if (!empty($companyNameAttr) && strlen(trim($companyNameAttr)) > 1) {
                    $companyName = trim($companyNameAttr);
                }
            } catch (\Exception $e) {
                // Ignore
            }
        }

        // Get location
        $location = 'India';
        if ($this->jobModel->city && $this->jobModel->city->id && !empty($this->jobModel->city->name)) {
            $location = trim($this->jobModel->city->name);
        } elseif (!empty($this->jobModel->city_name) && strlen(trim($this->jobModel->city_name)) > 1) {
            $location = trim($this->jobModel->city_name);
        } elseif ($this->jobModel->state && $this->jobModel->state->id && !empty($this->jobModel->state->name)) {
            $location = trim($this->jobModel->state->name);
        } elseif (!empty($this->jobModel->state_name) && strlen(trim($this->jobModel->state_name)) > 1) {
            $location = trim($this->jobModel->state_name);
        } elseif (!empty($this->jobModel->location) && strlen(trim($this->jobModel->location)) > 1) {
            $location = trim($this->jobModel->location);
        }

        // Template requires 4 body parameters (EXACT as Postman screenshot):
        // 1. Candidate Name
        // 2. Job Title
        // 3. Company Name
        // 4. Location
        return [
            'body' => [
                $jobSeekerName,   // Parameter 1: Candidate Name (e.g., "Deepak")
                $jobTitle,        // Parameter 2: Job Title (e.g., "Hindi Teacher" or "English Teacher")
                $companyName,     // Parameter 3: Company Name (e.g., "Alpha School" or "ABC School")
                $location,        // Parameter 4: Location (e.g., "Indore")
            ],
        ];
    }

    protected function sendWhatsAppMessage(string $phone, array $messageParams, bool $isShortlisted): bool
    {
        // Get WhatsApp API configuration - SAME as OTP notification
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
        $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));

        if (!$apiUrl || !$authKey) {
            Log::error('[WHATSAPP_STATUS_UPDATE] WhatsApp API configuration missing');
            return false;
        }

        // Template name based on status (EXACT as Postman screenshot)
        $templateName = $isShortlisted 
            ? 'shortlist_application_for_job'      // For shortlisted
            : 'application_reject_for_position';   // For rejected

        // Extract body parameters
        $bodyParams = $messageParams['body'] ?? [];
        
        // Build body parameters array
        $bodyParameters = [];
        foreach ($bodyParams as $param) {
            $bodyParameters[] = [
                'type' => 'text',
                'text' => (string)$param
            ];
        }

        // Payload structure EXACTLY as Postman screenshot (NO button component)
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
                        ]
                        // NO button component (as per Postman screenshot)
                    ]
                ]
            ],
            'qrImageUrl' => false,
            'qrLinkUrl' => false,
            'to' => $phone
        ];

        Log::info('[WHATSAPP_STATUS_UPDATE] Sending WhatsApp notification', [
            'template_name' => $templateName,
            'phone' => $phone,
            'body_params' => $bodyParams,
            'is_shortlisted' => $isShortlisted,
        ]);

        // Make API call - EXACT SAME as OTP notification (with timeout and retry)
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(90) // 90 seconds timeout (same as OTP)
            ->connectTimeout(30) // 30 seconds to establish connection
            ->retry(3, 2000, function ($exception, $request) {
                // Retry on timeout or connection errors
                return $exception instanceof \Illuminate\Http\Client\ConnectionException
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            // Check if request was successful - SAME as OTP
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Check response code (3001 seems to be success)
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    Log::info('[WHATSAPP_STATUS_UPDATE] ✓ WhatsApp notification sent successfully', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'template' => $templateName,
                        'message_id' => $responseData['response'] ?? null,
                    ]);
                    return true;
                } else {
                    Log::warning('[WHATSAPP_STATUS_UPDATE] ✗ WhatsApp API returned non-success response', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'response_code' => $responseData['responseCode'] ?? 'unknown',
                        'template' => $templateName,
                    ]);
                    return false;
                }
            } else {
                Log::error('[WHATSAPP_STATUS_UPDATE] ✗ WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'template' => $templateName,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('[WHATSAPP_STATUS_UPDATE] ✗ WhatsApp API Error', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'template' => $templateName,
            ]);
            return false;
        }
    }
}
