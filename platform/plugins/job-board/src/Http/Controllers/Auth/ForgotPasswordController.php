<?php

namespace Botble\JobBoard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Botble\ACL\Traits\SendsPasswordResetEmails;
use Botble\JobBoard\Forms\Fronts\Auth\ForgotPasswordForm;
use Botble\JobBoard\Http\Requests\Fronts\Auth\ForgotPasswordRequest;
use Botble\JobBoard\Models\Account;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        SeoHelper::setTitle(trans('plugins/job-board::messages.forgot_password'));

        Theme::breadcrumb()->add(trans('plugins/job-board::messages.forgot_password'), route('public.account.register'));

        $form = ForgotPasswordForm::create();
        if (session()->has('password_reset_email')) {
            $form->setModel(['email' => session('password_reset_email')]);
        }
        if (session()->has('password_reset_phone')) {
            $form->setModel(['phone' => session('password_reset_phone')]);
        }

        return Theme::scope('job-board.auth.passwords.email', ['form' => $form], 'plugins/job-board::themes.auth.passwords.email')->render();
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        // Check if phone is provided instead of email
        if ($request->filled('phone') && !$request->filled('email')) {
            return $this->sendResetLinkViaPhone($request);
        }

        // Original email-based flow
        // Validate email if provided
        if ($request->filled('email')) {
            $this->validateEmail($request);
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkViaPhone($request)
    {
        $phone = preg_replace('/[^0-9]/', '', $request->input('phone'));
        
        // Find account by phone number
        $account = Account::where('phone', 'LIKE', '%' . substr($phone, -10))->first();
        
        if (!$account) {
            return back()
                ->withInput($request->only('phone'))
                ->withErrors(['phone' => trans('plugins/job-board::messages.user_not_found', ['default' => 'No account found with this phone number.'])]);
        }

        // Generate password reset token
        $token = Str::random(64);
        
        // Store token in password_resets table (using email as key for compatibility)
        DB::table('jb_account_password_resets')->updateOrInsert(
            ['email' => $account->email],
            [
                'token' => hash('sha256', $token),
                'created_at' => now(),
            ]
        );

        // Generate reset link
        $resetLink = route('public.account.password.reset', [
            'token' => $token,
            'email' => $account->email
        ]);

        // Send WhatsApp notification
        $phoneCleaned = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phoneCleaned) == 12 && substr($phoneCleaned, 0, 2) == '91') {
            $phoneCleaned = substr($phoneCleaned, 2);
        } elseif (strlen($phoneCleaned) > 10) {
            $phoneCleaned = substr($phoneCleaned, -10);
        }

        $message = "Your password reset link: " . $resetLink;
        $whatsappSent = $this->sendWhatsAppPasswordReset($phoneCleaned, $resetLink, $account->full_name ?? $account->first_name);

        if ($whatsappSent) {
            return back()
                ->with('status', trans('plugins/job-board::messages.password_reset_link_sent_whatsapp', ['default' => 'Password reset link has been sent to your WhatsApp number.']))
                ->with('password_reset_phone', $request->phone);
        } else {
            return back()
                ->withInput($request->only('phone'))
                ->withErrors(['phone' => trans('plugins/job-board::messages.whatsapp_send_failed', ['default' => 'Failed to send WhatsApp notification. Please try using email instead.'])]);
        }
    }

    protected function sendWhatsAppPasswordReset($phone, $resetLink, $userName = '')
    {
        try {
            // Get WhatsApp API configuration - SAME as OTP notification
            $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', config('services.msgclub.url', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate')));
            $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', config('services.msgclub.key', '4625770ffb62853af287cedec7f50b0')));
            $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
            
            if (!$apiUrl || !$authKey) {
                \Log::error('[PASSWORD_RESET_WHATSAPP] WhatsApp API configuration missing');
                return false;
            }

            // Template name: password_reset_link_from_portal (EXACT as Postman screenshot)
            $templateName = 'password_reset_link_from_portal';
            
            // Get user name (fallback to "User" if empty)
            $name = !empty($userName) ? trim($userName) : 'User';
            
            // Template requires 2 body parameters (EXACT as Postman screenshot):
            // Parameter 1: Name (e.g., "Deepak")
            // Parameter 2: Reset Link URL (e.g., "https://teachersrecruiter.in/")
            // NO button component
            
            // Build body parameters array
            $bodyParameters = [
                [
                    'type' => 'text',
                    'text' => $name  // Parameter 1: Name
                ],
                [
                    'type' => 'text',
                    'text' => $resetLink  // Parameter 2: Reset Link URL
                ]
            ];
            
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

            \Log::info('[PASSWORD_RESET_WHATSAPP] Sending WhatsApp notification (EXACT Postman structure)', [
                'phone' => $phone,
                'template' => $templateName,
                'name' => $name,
                'reset_link' => $resetLink,
                'body_params_count' => count($bodyParameters),
            ]);

            // Make API call - EXACT SAME as OTP notification
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            // Check if request was successful - SAME as OTP
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Check response code (3001 seems to be success)
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    \Log::info('[PASSWORD_RESET_WHATSAPP] ✓ WhatsApp notification sent successfully', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'template' => $templateName,
                        'message_id' => $responseData['response'] ?? null,
                    ]);
                    return true;
                } else {
                    \Log::warning('[PASSWORD_RESET_WHATSAPP] ✗ WhatsApp API returned non-success response', [
                        'phone' => $phone,
                        'response' => $responseData,
                        'response_code' => $responseData['responseCode'] ?? 'unknown',
                        'template' => $templateName,
                    ]);
                    return false;
                }
            } else {
                \Log::error('[PASSWORD_RESET_WHATSAPP] ✗ WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'template' => $templateName,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            \Log::error('[PASSWORD_RESET_WHATSAPP] ✗ WhatsApp API Error', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'template' => $templateName ?? 'not_set',
            ]);
            return false;
        }
    }

    protected function sendResetLinkResponse($request, $response)
    {
        if ($request->wantsJson()) {
            return new \Illuminate\Http\JsonResponse(['message' => trans($response)], 200);
        }

        return back()
            ->with('status', trans($response))
            ->with('password_reset_email', $request->email);
    }

    public function broker()
    {
        return Password::broker('accounts');
    }
}
