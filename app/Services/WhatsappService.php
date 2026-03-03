<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Botble\JobBoard\Models\WhatsAppTemplate;

class WhatsappService
{
    /**
     * Send Job Apply Alert via WhatsApp
     * 
     * @param string $mobile Phone number (10 digits without country code)
     * @param string $jobTitle Job title
     * @param string $candidateName Candidate name
     * @param string $email Candidate email
     * @param string $phone Candidate phone
     * @return array API response
     */
    public static function sendJobApplyAlert($mobile, $jobTitle, $candidateName, $email, $phone)
    {
        // Get template from local database first
        $template = WhatsAppTemplate::getActiveByName('job_application_alert');
        
        // Use template name from local database, or fallback to default
        $templateName = $template ? $template->name : 'job_application_alert';
        
        Log::info('[WHATSAPP_SERVICE] Sending job apply alert', [
            'mobile' => $mobile,
            'template_name' => $templateName,
            'template_from_db' => $template ? true : false,
        ]);
        
        // Clean phone number (ensure 10 digits)
        $mobile = preg_replace('/[^0-9]/', '', $mobile);
        if (strlen($mobile) == 12 && substr($mobile, 0, 2) == '91') {
            $mobile = substr($mobile, 2); // Remove country code
        } elseif (strlen($mobile) > 10) {
            $mobile = substr($mobile, -10); // Use last 10 digits
        }
        
        // Build payload exactly as client's structure
        $payload = [
            "mobileNumbers" => $mobile,
            "senderId"      => setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383')),
            "component"     => [
                "messaging_product" => "whatsapp",
                "recipient_type"    => "individual",
                "type"              => "template",
                "template"          => [
                    "name"     => $templateName, // Template name from local database
                    "language" => [
                        "code" => $template ? ($template->language_code ?? 'en') : 'en'
                    ],
                    "components" => [
                        [
                            "type"       => "body",
                            "index"      => 0,
                            "parameters" => [
                                ["type" => "text", "text" => $jobTitle],       // {{1}}
                                ["type" => "text", "text" => $candidateName], // {{2}}
                                ["type" => "text", "text" => $email],         // {{3}}
                                ["type" => "text", "text" => $phone],         // {{4}}
                            ]
                        ]
                    ]
                ]
            ],
            "qrImageUrl" => false,
            "qrLinkUrl"  => false,
            "to"         => $mobile
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])
            ->timeout(90) // Increased timeout
            ->retry(3, 2000, function ($exception, $request) {
                return $exception instanceof \Illuminate\Http\Client\ConnectionException 
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post(
                config('services.msgclub.url') . '?AUTH_KEY=' . config('services.msgclub.key'),
                $payload
            );

            $responseData = $response->json();
            
            Log::info('[WHATSAPP_SERVICE] API Response', [
                'mobile' => $mobile,
                'template_name' => $templateName,
                'status_code' => $response->status(),
                'response_code' => $responseData['responseCode'] ?? null,
                'response' => $responseData,
            ]);

            return $responseData;
            
        } catch (\Exception $e) {
            Log::error('[WHATSAPP_SERVICE] Error sending WhatsApp message', [
                'mobile' => $mobile,
                'template_name' => $templateName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return [
                'responseCode' => 'ERROR',
                'response' => 'Failed to send WhatsApp message: ' . $e->getMessage(),
            ];
        }
    }
}
