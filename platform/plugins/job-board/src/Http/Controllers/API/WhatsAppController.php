<?php

namespace Botble\JobBoard\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

/**
 * WhatsApp Template Testing Controller
 * 
 * This controller helps test and find correct WhatsApp template names
 */
class WhatsAppController extends Controller
{
    /**
     * Test a specific template name
     * 
     * GET /api/v1/whatsapp/test-template/{templateName}
     * Example: /api/v1/whatsapp/test-template/job_application_alert
     */
    public function testTemplate(Request $request, $templateName = null)
    {
        $templateName = $templateName ?: $request->input('template', env('WHATSAPP_JOB_APPLICATION_TEMPLATE', 'job_application_alert'));
        $testPhone = $request->input('phone', '919039632383'); // Default test phone
        
        $apiUrl = config('services.msgclub.url', env('MSGCLUB_WHATSAPP_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
        $authKey = config('services.msgclub.key', env('MSGCLUB_AUTH_KEY', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
        
        // Clean phone number
        $phone = preg_replace('/[^0-9]/', '', $testPhone);
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            $phone = substr($phone, 2);
        } elseif (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }
        
        $requestBody = [
            'mobileNumbers' => $phone,
            'senderId' => $senderId,
            'component' => [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'type' => 'template',
                'template' => [
                    'name' => $templateName,
                    'language' => ['code' => 'en'],
                    'components' => [
                        [
                            'type' => 'body',
                            'index' => 0,
                            'parameters' => [
                                ['type' => 'text', 'text' => 'Test Job Title'],
                                ['type' => 'text', 'text' => 'Test Candidate Name'],
                                ['type' => 'text', 'text' => 'test@example.com'],
                                ['type' => 'text', 'text' => '1234567890'],
                            ]
                        ]
                    ]
                ]
            ],
            'qrImageUrl' => false,
            'qrLinkUrl' => false,
            'to' => $phone
        ];
        
        try {
            // Increased timeout and retry mechanism for better reliability (same as SendEmployerApplicationNotificationJob)
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])
            ->timeout(90) // Increased timeout to 90 seconds
            ->retry(3, 2000, function ($exception, $request) {
                // Retry on timeout or connection errors
                return $exception instanceof \Illuminate\Http\Client\ConnectionException 
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);
            
            $responseData = $response->json();
            
            $isSuccess = false;
            $message = '';
            
            if ($response->successful()) {
                if (isset($responseData['responseCode'])) {
                    if ($responseData['responseCode'] == '3001' || $responseData['responseCode'] == '200') {
                        $isSuccess = true;
                        $message = 'Template exists and is valid!';
                    } elseif ($responseData['responseCode'] == '3017') {
                        $message = 'Template does not exist!';
                    } else {
                        $message = $responseData['response'] ?? 'Unknown response';
                    }
                } else {
                    $message = 'Unexpected response format';
                }
            } else {
                $message = 'API request failed';
            }
            
            return response()->json([
                'success' => $isSuccess,
                'template_name' => $templateName,
                'message' => $message,
                'response_code' => $responseData['responseCode'] ?? null,
                'response' => $responseData,
                'status_code' => $response->status(),
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'template_name' => $templateName,
                'message' => 'Error: ' . $e->getMessage(),
                'error' => $e->getTraceAsString(),
            ], 500);
        }
    }
    
    /**
     * Send actual WhatsApp message using stored template
     * 
     * GET /whatsapp-test/send-test-message?phone=919039632383
     */
    public function sendTestMessage(Request $request)
    {
        $testPhone = $request->input('phone', '919109459959');
        $useWorkingTemplate = $request->input('use_working_template', false); // Option to use otp_signup_login for testing
        
        // Get template from local database
        $template = \Botble\JobBoard\Models\WhatsAppTemplate::getActiveByName('job_application_alert');
        
        // Default: Use job_application_alert template from local database
        // If use_working_template=1, then use otp_signup_login (for testing)
        $templateName = 'job_application_alert';
        $templateFromDb = $template;
        
        if ($useWorkingTemplate) {
            // User explicitly wants to use working template
            $templateName = 'otp_signup_login';
            $templateFromDb = null; // OTP template is not in our local DB
            Log::info('[WHATSAPP_TEST] Using working template (otp_signup_login) for testing', [
                'template_name' => $templateName,
            ]);
        } elseif ($template) {
            // Use template from local database
            $templateName = $template->name;
            Log::info('[WHATSAPP_TEST] Using template from local database', [
                'template_name' => $templateName,
                'template_id' => $template->id,
            ]);
        } else {
            // Template not found in local database, but still try with default name
            Log::warning('[WHATSAPP_TEST] Template not found in local database, using default name', [
                'template_name' => $templateName,
            ]);
        }
        
        $apiUrl = config('services.msgclub.url', env('MSGCLUB_WHATSAPP_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
        $authKey = config('services.msgclub.key', env('MSGCLUB_AUTH_KEY', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0')));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
        
        // Clean phone number
        $phone = preg_replace('/[^0-9]/', '', $testPhone);
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            $phone = substr($phone, 2);
        } elseif (strlen($phone) > 10) {
            $phone = substr($phone, -10);
        }
        
        // Test data
        $testData = [
            'job_title' => 'Mathematics Teacher',
            'candidate_name' => 'John Doe',
            'candidate_email' => 'john.doe@example.com',
            'candidate_phone' => '9876543210',
        ];
        
        // Build parameters array based on template
        $components = [];
        if ($templateName === 'otp_signup_login') {
            // OTP template uses different structure - body + button components
            // Same structure as LoginController::sendWhatsAppMessage
            $testOtp = '123456';
            $components = [
                [
                    'type' => 'body',
                    'index' => 0,
                    'parameters' => [
                        [
                            'type' => 'text',
                            'text' => $testOtp
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
                            'text' => $testOtp
                        ]
                    ]
                ]
            ];
        } else {
            // Job application template - use 4 parameters in body component only
            $bodyParameters = [];
            if ($template && is_array($template->parameters)) {
                foreach ($template->parameters as $param) {
                    $paramName = $param['name'] ?? '';
                    $paramValue = $testData[$paramName] ?? 'N/A';
                    $bodyParameters[] = ['type' => 'text', 'text' => $paramValue];
                }
            } else {
                // Fallback: use default 4 parameters
                $bodyParameters = [
                    ['type' => 'text', 'text' => $testData['job_title']],
                    ['type' => 'text', 'text' => $testData['candidate_name']],
                    ['type' => 'text', 'text' => $testData['candidate_email']],
                    ['type' => 'text', 'text' => $testData['candidate_phone']],
                ];
            }
            
            $components = [
                [
                    'type' => 'body',
                    'index' => 0,
                    'parameters' => $bodyParameters
                ]
            ];
        }
        
        $requestBody = [
            'mobileNumbers' => $phone,
            'senderId' => $senderId,
            'component' => [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'type' => 'template',
                'template' => [
                    'name' => $templateName,
                    'language' => ['code' => $template ? ($template->language_code ?? 'en') : 'en'],
                    'components' => $components
                ]
            ],
            'qrImageUrl' => false,
            'qrLinkUrl' => false,
            'to' => $phone
        ];
        
        // Log the payload for debugging
        Log::info('[WHATSAPP_TEST] Payload being sent', [
            'template_name' => $templateName,
            'phone' => $phone,
            'payload' => $requestBody,
        ]);
        
        try {
            // Make API call with increased timeout and retry mechanism
            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                ])
                ->timeout(120) // Increased to 120 seconds for slow API responses
                ->retry(3, 3000, function ($exception, $request) {
                    // Retry on timeout or connection errors
                    return $exception instanceof \Illuminate\Http\Client\ConnectionException 
                        || $exception instanceof \GuzzleHttp\Exception\ConnectException
                        || $exception instanceof \GuzzleHttp\Exception\RequestException
                        || $exception instanceof \GuzzleHttp\Exception\TransferException;
                })
                ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                // Handle connection timeout specifically
                Log::error('[WHATSAPP_TEST] Connection timeout after retries', [
                    'phone' => $phone,
                    'template_name' => $templateName,
                    'error' => $e->getMessage(),
                    'timeout' => 120,
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Connection timeout: API server is not responding. Please try again later.',
                    'template' => [
                        'name' => $templateName,
                        'display_name' => $templateFromDb ? $templateFromDb->display_name : 'N/A',
                    ],
                    'phone' => $phone,
                    'error_type' => 'connection_timeout',
                ], 500);
            } catch (\Exception $e) {
                // Handle other exceptions
                Log::error('[WHATSAPP_TEST] API request exception', [
                    'phone' => $phone,
                    'template_name' => $templateName,
                    'error' => $e->getMessage(),
                    'error_type' => get_class($e),
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                    'template' => [
                        'name' => $templateName,
                        'display_name' => $templateFromDb ? $templateFromDb->display_name : 'N/A',
                    ],
                    'phone' => $phone,
                    'error_type' => get_class($e),
                ], 500);
            }
            
            // Check if request was successful
            $responseData = $response->json();
            
            $isSuccess = false;
            $message = '';
            
            if ($response->successful()) {
                if (isset($responseData['responseCode'])) {
                    if ($responseData['responseCode'] == '3001' || $responseData['responseCode'] == '200') {
                        $isSuccess = true;
                        $message = 'WhatsApp message sent successfully! Check your WhatsApp.';
                    } elseif ($responseData['responseCode'] == '3017') {
                        $message = 'Template does not exist in MSG Club panel!';
                    } else {
                        $message = $responseData['response'] ?? 'Unknown response';
                    }
                } else {
                    $message = 'Unexpected response format';
                }
            } else {
                $message = 'API request failed';
            }
            
            return response()->json([
                'success' => $isSuccess,
                'message' => $message,
                'template' => [
                    'name' => $templateName,
                    'display_name' => $templateFromDb ? $templateFromDb->display_name : ($templateName === 'otp_signup_login' ? 'OTP Template (Working)' : 'Job Application Alert'),
                    'parameters_count' => count($parameters),
                    'is_working_template' => $templateName === 'otp_signup_login',
                ],
                'test_data' => $testData,
                'phone' => $phone,
                'response_code' => $responseData['responseCode'] ?? null,
                'response' => $responseData,
                'status_code' => $response->status(),
                'note' => $templateName === 'otp_signup_login' 
                    ? 'Using working template (otp_signup_login) for testing. For job_application_alert, template must exist in MSG Club panel.' 
                    : 'Using job_application_alert template. If it fails, template needs to be created in MSG Club panel.',
            ]);
            
        } catch (\Exception $e) {
            // This catch block handles any other unexpected exceptions
            Log::error('[WHATSAPP_TEST] Unexpected exception', [
                'phone' => $phone ?? 'unknown',
                'template_name' => $templateName ?? 'unknown',
                'error' => $e->getMessage(),
                'error_type' => get_class($e),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'template' => [
                    'name' => $templateName ?? 'unknown',
                ],
                'phone' => $phone ?? 'unknown',
                'error_type' => get_class($e),
            ], 500);
        }
    }
    
    /**
     * Test multiple common template names
     * 
     * GET /api/v1/whatsapp/test-all-templates
     */
    public function testAllTemplates(Request $request)
    {
        $testPhone = $request->input('phone', '919039632383');
        
        // Common template names to test
        $templateNames = [
            'job_application_alert',
            'job_application_notification',
            'job_alert',
            'application_notification',
            'job_application',
            'application_alert',
            'job_notification',
            'new_job_application',
            'job_apply_alert',
            'otp_signup_login', // This one we know works
        ];
        
        $results = [];
        
        foreach ($templateNames as $templateName) {
            $result = $this->testTemplate($request, $templateName);
            $resultData = json_decode($result->getContent(), true);
            $results[] = [
                'template_name' => $templateName,
                'exists' => $resultData['success'] ?? false,
                'message' => $resultData['message'] ?? 'Unknown',
                'response_code' => $resultData['response_code'] ?? null,
            ];
            
            // Small delay to avoid rate limiting
            usleep(500000); // 0.5 seconds
        }
        
        $workingTemplates = array_filter($results, function($r) {
            return $r['exists'] === true;
        });
        
        return response()->json([
            'total_tested' => count($templateNames),
            'working_templates' => count($workingTemplates),
            'results' => $results,
            'recommended_template' => !empty($workingTemplates) ? array_values($workingTemplates)[0]['template_name'] : null,
        ]);
    }
}
