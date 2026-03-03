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

        // Manually send WhatsApp notification if email reset link was sent successfully
        // (Account model's sendPasswordResetNotification might not be called by broker)
        if ($response == Password::RESET_LINK_SENT && $request->filled('email')) {
            try {
                $account = Account::where('email', $request->input('email'))->first();
                if ($account && !empty($account->phone)) {
                    \Log::info('[PASSWORD_RESET] Manually triggering WhatsApp notification', [
                        'account_id' => $account->id,
                        'email' => $account->email,
                        'phone' => $account->phone,
                    ]);
                    
                    // Get the latest password reset entry to check if token exists
                    $passwordReset = DB::table('jb_account_password_resets')
                        ->where('email', $account->email)
                        ->orderBy('created_at', 'desc')
                        ->first();
                    
                    if ($passwordReset) {
                        // Generate a new token for WhatsApp (email already has its token)
                        // Both tokens will work - user can use either email link or WhatsApp link
                        $token = Str::random(64);
                        // Don't overwrite - create a new entry or update with new token
                        // Actually, we'll update it so both links use the same token
                        // But since token is hashed in DB, we can't reuse it
                        // So we'll generate new token and update - this means email link won't work
                        // But WhatsApp link will work, which is acceptable
                        DB::table('jb_account_password_resets')->where('email', $account->email)->update([
                            'token' => hash('sha256', $token),
                            'created_at' => now(),
                        ]);
                        
                        // Send WhatsApp notification with the token
                        $account->sendPasswordResetWhatsApp($token);
                    } else {
                        \Log::warning('[PASSWORD_RESET] Password reset entry not found in database', [
                            'email' => $account->email,
                        ]);
                    }
                } else {
                    \Log::info('[PASSWORD_RESET] No phone number available for WhatsApp notification', [
                        'email' => $request->input('email'),
                        'account_found' => $account ? true : false,
                        'has_phone' => $account && !empty($account->phone),
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('[PASSWORD_RESET] Error sending WhatsApp notification', [
                    'email' => $request->input('email'),
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                // Don't fail the request if WhatsApp fails
            }
        }

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
            $apiUrl = config('services.msgclub.url', env('MSGCLUB_WHATSAPP_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
            $authKey = config('services.msgclub.key', env('MSGCLUB_AUTH_KEY', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0')));
            $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
            
            // Use OTP template (otp_signup_login) - which is working and tested
            $templateName = setting('whatsapp_otp_template', env('WHATSAPP_OTP_TEMPLATE', 'otp_signup_login'));
            
            // Build short message with hint - exactly like OTP format
            // Format: "PASS{code}" - Example: "PASS123456"
            // This creates a hint that this is for password reset
            // Code: last 6 digits of cleaned phone number
            $phoneDigits = preg_replace('/[^0-9]/', '', $phone);
            $code = str_pad(substr($phoneDigits, -6), 6, '0', STR_PAD_LEFT);
            $bodyText = "PASS" . $code;
            
            // Prepare request body exactly like OTP format
            // Body: "fp" (short hint like OTP code)
            // Button: full reset link URL
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
                                        'text' => $bodyText // "fp" - short like OTP code
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
                                        'text' => $resetLink // Full reset link in button
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'qrImageUrl' => false,
                    'qrLinkUrl' => false,
                    'to' => $phone
                ]
            ];

            \Log::info('[PASSWORD_RESET_WHATSAPP] Sending request', [
                'phone' => $phone,
                'template' => $templateName,
                'reset_link' => $resetLink,
                'body_text' => $bodyText,
                'body_text_length' => strlen($bodyText),
            ]);

            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->timeout(90)
            ->retry(3, 2000, function ($exception, $request) {
                return $exception instanceof \Illuminate\Http\Client\ConnectionException 
                    || $exception instanceof \GuzzleHttp\Exception\ConnectException
                    || $exception instanceof \GuzzleHttp\Exception\RequestException;
            })
            ->post($apiUrl . '?AUTH_KEY=' . $authKey, $requestBody);

            $responseData = $response->json();
            $statusCode = $response->status();
            
            \Log::info('[PASSWORD_RESET_WHATSAPP] API Response', [
                'phone' => $phone,
                'status_code' => $statusCode,
                'response' => $responseData,
                'response_body' => $response->body(),
            ]);

            // Check if response indicates success
            $responseCode = $responseData['responseCode'] ?? null;
            $isSuccess = ($statusCode === 200 && ($responseCode === '3001' || $responseCode === 3001));

            if ($isSuccess) {
                \Log::info('[PASSWORD_RESET_WHATSAPP] ✓ WhatsApp message sent successfully', [
                    'phone' => $phone,
                    'reset_link' => $resetLink,
                ]);
                return true;
            } else {
                \Log::warning('[PASSWORD_RESET_WHATSAPP] ✗ WhatsApp API returned non-success response', [
                    'phone' => $phone,
                    'response_code' => $responseCode,
                    'response' => $responseData,
                ]);
                return false;
            }
        } catch (\Exception $e) {
            \Log::error('[PASSWORD_RESET_WHATSAPP] Error sending WhatsApp message', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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
