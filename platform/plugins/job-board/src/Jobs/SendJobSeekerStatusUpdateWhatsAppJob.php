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
        public JobApplicationStatusEnum $oldStatus,
        public JobApplicationStatusEnum $newStatus
    ) {
        $this->onQueue('default');
    }

    public function handle(): void
    {
        try {
            // Only send WhatsApp for shortlisted and rejected statuses
            $newStatusValue = $this->newStatus->getValue();
            if ($newStatusValue !== JobApplicationStatusEnum::SHORT_LIST->getValue() &&
                $newStatusValue !== JobApplicationStatusEnum::REJECTED->getValue()) {
                return;
            }

            // Get job seeker phone number
            $jobSeekerPhone = $this->application->phone ?? $this->application->account->phone ?? null;
            
            if (empty($jobSeekerPhone)) {
                Log::warning('[WHATSAPP_STATUS_UPDATE] Job seeker phone not available', [
                    'application_id' => $this->application->id,
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

            $isShortlisted = $newStatusValue === JobApplicationStatusEnum::SHORT_LIST->getValue();
            $isRejected = $newStatusValue === JobApplicationStatusEnum::REJECTED->getValue();

            // Build message parameters
            $messageParams = $this->buildMessageParameters($isShortlisted);

            // Send WhatsApp notification
            $this->sendWhatsAppMessage($jobSeekerPhone, $messageParams, $isShortlisted);

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

        // Make API call - EXACT SAME as OTP notification
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

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
