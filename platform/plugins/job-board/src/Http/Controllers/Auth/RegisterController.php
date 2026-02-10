<?php

namespace Botble\JobBoard\Http\Controllers\Auth;

use Botble\ACL\Traits\RegistersUsers;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fronts\Auth\RegisterForm;
use Botble\JobBoard\Http\Requests\Fronts\Auth\RegisterRequest;
use Botble\JobBoard\Models\Account;
use Botble\JsValidation\Facades\JsValidator;
use Botble\Media\Facades\RvMedia;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Botble\JobBoard\Notifications\EmailVerificationNotification;

class RegisterController extends BaseController
{
    use RegistersUsers;

    protected string $redirectTo = '/';

    public function showRegistrationForm(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        // Force account type to job seeker only
        $requestedAccountType = $request->query('account_type');

        // If someone tries to open employer registration URL, show a warning and keep job-seeker
        if ($requestedAccountType === 'employer') {
            session()->flash(
                'warning',
                'Currently only Job Seeker registration is available.'
            );
        }

        // Always use job-seeker as account type on this page
        $accountType = 'job-seeker';

        // Check if email verification is pending - redirect to OTP page if not verified
        $emailVerified = session()->get('registration_email_verified', false);
        $sessionData = session()->get('registration_email_verification', []);
        $email = session()->get('verify_email_address');
        
        // If there's a verification session but email is not verified, redirect to OTP page
        if (!empty($sessionData) && !$emailVerified && $email) {
            \Log::info('showRegistrationForm: Email not verified, redirecting to OTP page', [
                'email' => $email,
                'has_session_data' => !empty($sessionData),
                'email_verified' => $emailVerified,
            ]);
            return redirect()->route('public.account.register.verifyEmailPage')
                ->with('info', 'Please verify your email address to continue registration.');
        }
        
        // Also check if there's a temp account with unverified email
        if ($email && !$emailVerified) {
            $tempAccount = Account::where('email', $email)
                ->where('is_email_verified', false)
                ->whereNotNull('verification_code')
                ->first();
            
            if ($tempAccount) {
                \Log::info('showRegistrationForm: Found unverified temp account, redirecting to OTP page', [
                    'email' => $email,
                    'temp_account_id' => $tempAccount->id,
                ]);
                return redirect()->route('public.account.register.verifyEmailPage')
                    ->with('info', 'Please verify your email address to continue registration.');
            }
        }

        SeoHelper::setTitle(trans('plugins/job-board::messages.register'));

        Theme::breadcrumb()->add(trans('plugins/job-board::messages.register'), route('public.account.register'));

        Theme::asset()->container('footer')
            ->add('js-validation', 'vendor/core/core/js-validation/js/js-validation.js', ['jquery']);
        Theme::asset()->container('footer')->writeContent(
            'js-validation-scripts',
            JsValidator::formRequest(RegisterRequest::class),
            ['jquery']
        );

        if (! session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        return Theme::scope(
            'job-board.auth.register',
            [
                'form' => RegisterForm::create(),
                'preferred_account_type' => $accountType,
            ],
            'plugins/job-board::themes.auth.register'
        )->render();
    }

    /**
     * Store email in session for verify-email page (to hide from URL).
     */
    public function storeEmailSession(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $request->session()->put('verify_email_address', $request->input('email'));

        return $this->httpResponse()->setMessage('Email stored in session.');
    }

    /**
     * Show dedicated email verification (OTP) page for job seeker registration.
     */
    public function showEmailVerificationPage(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        // Allow direct access for testing design
        if ($request->query('test')) {
            $email = $request->query('email', 'test@example.com');
            $request->session()->put('verify_email_address', $email);
            $request->session()->put('registration_email_verification', [
                'email' => $email,
                'code' => '12345',
                'expires_at' => now()->addMinutes(10),
                'form_data' => ['full_name' => 'Test User', 'email' => $email, 'account_type' => 'job-seeker'],
                'temp_account_id' => null,
            ]);
        }

        // Get email from session only (not from URL for security)
        $email = $request->session()->get('verify_email_address');
        
        // If email is in URL query parameter, redirect to clean URL (hide email from URL)
        if ($request->query('email') && !$email) {
            $emailFromUrl = $request->query('email');
            $request->session()->put('verify_email_address', $emailFromUrl);
            // Redirect to clean URL without email parameter
            return redirect()->route('public.account.register.verifyEmailPage');
        }

        if (!$email) {
            \Log::warning('showEmailVerificationPage: No email found in session, redirecting to registration');
            return redirect()->route('public.account.register')->with('error', 'Please start the registration process first.');
        }

        // Check if verification session data exists
        $sessionData = $request->session()->get('registration_email_verification');
        if (!$sessionData) {
            \Log::warning('showEmailVerificationPage: No verification session data found', [
                'email' => $email,
                'all_session_keys' => array_keys($request->session()->all())
            ]);
            return redirect()->route('public.account.register')
                ->with('error', 'Please complete the registration form first before verifying your email.');
        }

        // Email is already in session, no need to store again

        \Log::info('showEmailVerificationPage: Rendering page', [
            'email' => $email,
            'has_session_data' => !empty($sessionData),
            'session_data_keys' => array_keys($sessionData)
        ]);

        // Get phone and WhatsApp availability from session data
        $formData = $sessionData['form_data'] ?? [];
        $phone = $formData['phone'] ?? '';
        $isWhatsappAvailable = !empty($formData['is_whatsapp_available']);

        return Theme::scope(
            'job-board.auth.verify-email',
            [
                'email' => $email,
                'phone' => $phone,
                'isWhatsappAvailable' => $isWhatsappAvailable,
            ],
        )->render();
    }

    public function confirm($email, Request $request)
    {
        abort_unless(URL::hasValidSignature($request), 404);

        $account = Account::query()
            ->where('email', $email)
            ->firstOrFail();

        $account->confirmed_at = Carbon::now();
        $account->save();

        $this->guard()->login($account);

        // Redirect based on account type
        $redirectUrl = $account->isEmployer() 
            ? route('public.account.dashboard') 
            : route('public.account.jobseeker.dashboard');

        return $this
            ->httpResponse()
            ->setNextUrl($redirectUrl)
            ->setMessage(trans('plugins/job-board::account.confirmation_successful'));
    }

    protected function guard()
    {
        return auth('account');
    }

    public function resendConfirmation(Request $request)
    {
        /**
         * @var Account $account
         */
        $account = Account::query()
            ->where('email', $request->input('email'))
            ->first();

        if (! $account) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/job-board::messages.cannot_find_account'));
        }

        try {
            $account->sendEmailVerificationNotification();
        } catch (Exception $exception) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($exception->getMessage());
        }

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/job-board::account.confirmation_resent'));
    }

    /**
     * Check if email already exists in database
     */
    public function checkEmailExists(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $request->validate([
            'email' => ['required', 'email', 'max:60'],
        ]);

        $email = $request->input('email');
        
        // Check if email already exists (for both employer and job-seeker)
        $existingAccount = Account::where('email', $email)->first();
        
        if ($existingAccount) {
            // Check if email is verified - ONLY check email_verified_at (NOT NULL = verified)
            $emailVerifiedAt = $existingAccount->email_verified_at;
            $isVerified = $emailVerifiedAt !== null && $emailVerifiedAt !== '';
            
            \Log::info('Email check result:', [
                'email' => $email,
                'exists' => true,
                'email_verified_at' => $emailVerifiedAt,
                'email_verified_at_is_null' => is_null($emailVerifiedAt),
                'email_verified_at_is_empty' => empty($emailVerifiedAt),
                'is_verified' => $isVerified,
                'is_email_verified' => $existingAccount->is_email_verified
            ]);
            
            return $this
                ->httpResponse()
                ->setData([
                    'exists' => true,
                    'is_verified' => $isVerified,
                    'email_verified_at' => $emailVerifiedAt,
                    'email_verified_at_is_null' => is_null($emailVerifiedAt),
                    'account_type' => $existingAccount->type?->value ?? 'job-seeker',
                ])
                ->setMessage($isVerified 
                    ? 'This email is already registered. Please login to continue.' 
                    : 'Email exists but not verified.');
        }
        
        return $this
            ->httpResponse()
            ->setData([
                'exists' => false,
                'is_verified' => false,
            ])
            ->setMessage('Email is available.');
    }

    /**
     * Send one-time verification code to email for step-1 of registration (job seeker).
     */
    public function sendVerificationCode(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $request->validate([
            'email' => ['required', 'email', 'max:60'],
        ]);

        $email = $request->input('email');
        
        // Check if email already exists
        $existingAccount = Account::where('email', $email)->first();
        
        if ($existingAccount) {
            // Check verification status - ONLY check email_verified_at (NOT NULL = verified)
            $emailVerifiedAt = $existingAccount->email_verified_at;
            $isVerified = $emailVerifiedAt !== null && $emailVerifiedAt !== '';
            
            Log::info('sendVerificationCode - Email check:', [
                'email' => $email,
                'email_verified_at' => $emailVerifiedAt,
                'is_verified' => $isVerified
            ]);
            
            if ($isVerified) {
                // Email is already verified - redirect to login
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setNextUrl(route('public.account.login'))
                    ->setMessage('This email is already registered. Redirecting to login...');
            } else {
                // Email exists but NOT verified - delete old unverified account and allow re-registration
                Log::info('Deleting old unverified account for re-registration', ['email' => $email, 'account_id' => $existingAccount->id]);
                $existingAccount->delete();
            }
        }
        
        // Get form data - support both nested (form_data[field]) and top-level (field) formats
        $formData = $request->input('form_data', []);
        if (empty($formData)) {
            // Read from top-level request data
            $formData = [
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'phone_display' => $request->input('phone_display'),
                'phone_country_code' => $request->input('phone_country_code'),
                'password' => $request->input('password'),
                'is_whatsapp_available' => $request->input('is_whatsapp_available', false),
                'account_type' => $request->input('account_type', 'job-seeker'),
            ];
        }

        // Generate OTP code - For testing use fixed code, for production use random
        // Fixed code for testing:
        $code = '123456';
        
        // Random code for production (uncomment when ready):
        // $code = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        $expiresAt = now()->addMinutes(10);

        // Map phone_display to phone if phone is null
        $phone = $formData['phone'] ?? $formData['phone_display'] ?? '';
        $phoneCountryCode = $formData['phone_country_code'] ?? '';
        
        \Log::info('Phone data from form:', [
            'phone' => $phone,
            'phone_display' => $formData['phone_display'] ?? 'not set',
            'phone_country_code' => $phoneCountryCode,
            'form_data_keys' => array_keys($formData),
        ]);
        
        // Format phone with country code: "+919340193449" (no space)
        if ($phone && strpos($phone, '+') === 0) {
            // Phone already has country code, just clean spaces
            $phone = '+' . preg_replace('/[^0-9]/', '', $phone);
        } elseif ($phone && $phoneCountryCode) {
            // Add country code to phone
            $phoneCountryCode = preg_replace('/[^0-9]/', '', $phoneCountryCode);
            $phone = preg_replace('/[^0-9]/', '', $phone);
            $phone = '+' . $phoneCountryCode . $phone;
        } elseif ($phone) {
            // Clean phone number (remove spaces, dashes)
            $phone = preg_replace('/[^0-9]/', '', $phone);
        }
        
        \Log::info('Phone data after formatting:', [
            'phone' => $phone,
            'phone_country_code' => $phoneCountryCode,
        ]);
        
        // Create temporary account record for draft registration
        $tempAccount = Account::create([
            'email' => $email,
            'first_name' => $formData['full_name'] ?? '',
            'last_name' => '',
            'full_name' => $formData['full_name'] ?? '',
            'phone' => $phone,
            'phone_country_code' => $phoneCountryCode,
            'is_whatsapp_available' => $formData['is_whatsapp_available'] ?? false,
            'type' => $formData['account_type'] ?? 'job-seeker',
            'password' => Hash::make($formData['password'] ?? 'temp_password'),
            'is_email_verified' => false, // Mark as not verified yet
            'verification_code' => $code,
            'verification_code_expires_at' => $expiresAt,
            'email_verification_token' => Str::random(64),
            'email_verification_token_expires_at' => $expiresAt,
        ]);

        // Handle resume upload if file is provided
        if ($request->hasFile('resume')) {
            try {
                $result = RvMedia::handleUpload($request->file('resume'), 0, $tempAccount->upload_folder);
                if (!$result['error']) {
                    $tempAccount->resume = $result['data']->url;
                    $tempAccount->save();
                    \Log::info('Resume uploaded during registration:', [
                        'account_id' => $tempAccount->id,
                        'resume_url' => $result['data']->url,
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Resume upload failed during registration:', [
                    'error' => $e->getMessage(),
                ]);
            }
        }

        $request->session()->put('registration_email_verification', [
            'email' => $email,
            'code' => $code,
            'expires_at' => $expiresAt,
            'form_data' => $formData,
            'temp_account_id' => $tempAccount->id, // Store temp account ID
        ]);
        
        // Store email in session for verify-email page (to hide from URL)
        $request->session()->put('verify_email_address', $email);

        // Verify session was stored
        $storedSession = $request->session()->get('registration_email_verification');
        \Log::info('sendVerificationCode: Session stored', [
            'stored_session_keys' => $storedSession ? array_keys($storedSession) : 'null',
            'session_id' => $request->session()->getId(),
            'email' => $email,
            'has_temp_account' => isset($tempAccount->id),
            'temp_account_id' => $tempAccount->id,
            'form_data_keys' => array_keys($formData)
        ]);

        // Configure email driver from .env settings
        $mailDriver = env('MAIL_MAILER', config('mail.default', 'log'));
        
        // Prevent sendmail on Windows - only override if not SMTP
        if ($mailDriver === 'sendmail' && strpos(strtolower(PHP_OS), 'win') !== false) {
            $mailDriver = 'log';
            config(['mail.default' => 'log']);
        }
        
        // Force use .env SMTP settings if available
        if (env('MAIL_HOST') && in_array($mailDriver, ['smtp', 'log'])) {
            $mailDriver = 'smtp';
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => env('MAIL_HOST'),
                'mail.mailers.smtp.port' => env('MAIL_PORT', 587),
                'mail.mailers.smtp.username' => env('MAIL_USERNAME'),
                'mail.mailers.smtp.password' => env('MAIL_PASSWORD'),
                'mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION', 'tls'),
            ]);
            
            if (env('MAIL_FROM_ADDRESS')) {
                config([
                    'mail.from.address' => env('MAIL_FROM_ADDRESS'),
                    'mail.from.name' => env('MAIL_FROM_NAME', 'TeachersRecruiter'),
                ]);
            }
        }
        
        Log::info('Email configuration', [
            'driver' => $mailDriver,
            'from_address' => config('mail.from.address'),
            'smtp_host' => config('mail.mailers.smtp.host'),
        ]);

        // Always log the OTP code for debugging
        Log::info('OTP Code Generated', [
            'email' => $email,
            'code' => $code,
            'expires_at' => $expiresAt->toDateTimeString(),
            'mail_driver' => $mailDriver,
        ]);

        try {
            // Send verification email using Notification
            $tempAccount->notify(new EmailVerificationNotification($code));
            
            Log::info('Verification code email sent successfully', [
                'email' => $email,
                'code' => $code,
                'mail_driver' => $mailDriver,
            ]);
        } catch (\Exception $e) {
            Log::error('Email send failed: ' . $e->getMessage(), [
                'email' => $email,
                'code' => $code,
                'error' => $e->getMessage(),
                'mail_driver' => $mailDriver,
            ]);
            
            // Don't fail registration - OTP is logged, user can still verify
            return $this
                ->httpResponse()
                ->setMessage('Verification code generated. Email sending failed, please check server logs. OTP Code: ' . $code);
        }

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/job-board::messages.verification_code_sent') ?: 'Verification code sent to your email address.');
    }

    /**
     * Verify one-time email code for registration.
     */
    public function verifyEmailCode(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'regex:/^[0-9]{6}$/'], // Accept 6 digits
        ]);

        $email = $request->input('email');
        $inputCode = $request->input('code');
        
        // First check session data
        $data = $request->session()->get('registration_email_verification');
        $codeMatched = false;
        $tempAccountId = null;

        if ($data) {
            if ($data['email'] !== $email) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('This email does not match the one used for verification.');
            }

            if (now()->greaterThan($data['expires_at'])) {
                $request->session()->forget('registration_email_verification');
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Verification code has expired. Please request a new code.');
            }

            // Check code from session
            if (hash_equals($data['code'], $inputCode)) {
                $codeMatched = true;
                $tempAccountId = $data['temp_account_id'] ?? null;
            }
        }

        // Also check database (temp account) if session check failed
        if (!$codeMatched) {
            $tempAccount = Account::where('email', $email)
                ->where('is_email_verified', false)
                ->whereNotNull('verification_code')
                ->where('verification_code_expires_at', '>', now())
                ->first();

            if ($tempAccount && hash_equals($tempAccount->verification_code, $inputCode)) {
                $codeMatched = true;
                $tempAccountId = $tempAccount->id;
            }
        }

        if (!$codeMatched) {
            \Log::warning('Invalid verification code attempt', [
                'email' => $email,
                'code_entered' => $inputCode,
            ]);
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('The verification code is invalid. Please check and try again.');
        }

        // Update the temporary account to mark email as verified
        // Keep verification_code and verification_code_expires_at (don't clear them)
        if ($tempAccountId) {
            $tempAccount = Account::find($tempAccountId);
            if ($tempAccount) {
                $updateData = [
                    'email_verified_at' => now(),
                    'is_email_verified' => true,
                    // Keep verification_code and verification_code_expires_at for reference
                ];
                
                // If institution_type is provided in request, save it too
                if ($request->has('institution_type') && $request->input('institution_type')) {
                    $updateData['institution_type'] = $request->input('institution_type');
                    \Log::info('Institution type will be saved with email verification', [
                        'institution_type' => $request->input('institution_type'),
                    ]);
                }
                
                $tempAccount->update($updateData);
                \Log::info('Email verified successfully', [
                    'email' => $email,
                    'temp_account_id' => $tempAccountId,
                    'verification_code' => $tempAccount->verification_code,
                    'institution_type' => $tempAccount->institution_type ?? 'not set',
                ]);
            }
        }

        // Mark as verified in session (keep verification data until registration completes)
        $request->session()->put('registration_email_verified', true);
        
        // Don't clear session data yet - keep it for registration process
        // Session will be cleared after successful registration

        return $this
            ->httpResponse()
            ->setMessage('Email verified successfully.');
    }

    /**
     * Get stored verification data for email verification page.
     */
    public function getVerificationData(Request $request)
    {
        // Get email from session instead of query parameter
        $email = $request->session()->get('verify_email_address');

        \Log::info('getVerificationData called', [
            'email_from_session' => $email,
            'session_data' => $request->session()->get('registration_email_verification', []),
            'all_session_keys' => array_keys($request->session()->all()),
            'session_id' => $request->session()->getId(),
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);

        if (!$email) {
            \Log::error('getVerificationData: Email not found in session', [
                'all_session_keys' => array_keys($request->session()->all()),
                'referer' => $request->header('referer')
            ]);
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('Session expired. Please go back to the registration form and click "Next" to receive a verification code.');
        }

        $sessionData = $request->session()->get('registration_email_verification', []);

        // If session data is empty, try to get from database (fallback)
        if (empty($sessionData)) {
            \Log::warning('getVerificationData: No verification session data found, trying database fallback', [
                'email' => $email,
                'available_sessions' => array_keys($request->session()->all()),
            ]);
            
            // Try to get from database
            $tempAccount = Account::where('email', $email)
                ->where('is_email_verified', false)
                ->whereNotNull('verification_code')
                ->where('verification_code_expires_at', '>', now())
                ->first();
            
            if ($tempAccount) {
                // Reconstruct session data from database
                $sessionData = [
                    'email' => $tempAccount->email,
                    'code' => $tempAccount->verification_code,
                    'expires_at' => $tempAccount->verification_code_expires_at,
                    'form_data' => [
                        'full_name' => $tempAccount->full_name,
                        'email' => $tempAccount->email,
                        'phone' => $tempAccount->phone,
                        'account_type' => $tempAccount->type ?? 'job-seeker',
                    ],
                    'temp_account_id' => $tempAccount->id,
                ];
                
                // Restore session data
                $request->session()->put('registration_email_verification', $sessionData);
                $request->session()->put('verify_email_address', $email);
                
                \Log::info('getVerificationData: Restored session data from database', [
                    'email' => $email,
                    'temp_account_id' => $tempAccount->id,
                ]);
            } else {
                \Log::error('getVerificationData: No verification data found in session or database', [
                    'email' => $email,
                ]);
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Verification session expired. Please go back to the registration form and click "Next" to receive a new verification code.');
            }
        }

        if (!isset($sessionData['email']) || $sessionData['email'] !== $email) {
            \Log::error('getVerificationData: Email mismatch', [
                'session_email' => $sessionData['email'] ?? 'not set',
                'current_email' => $email,
                'session_data_keys' => array_keys($sessionData)
            ]);
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('Email verification failed. Please go back to the registration form and try again.');
        }

        // Get the temporary account data
        $tempAccount = null;
        if (isset($sessionData['temp_account_id'])) {
            $tempAccount = Account::find($sessionData['temp_account_id']);
            if (!$tempAccount) {
                \Log::error('getVerificationData: Temp account not found in database', [
                    'temp_account_id' => $sessionData['temp_account_id'],
                    'email' => $email
                ]);
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Account data not found. Please go back to the registration form and try again.');
            }
            \Log::info('getVerificationData: Found temp account', [
                'id' => $sessionData['temp_account_id'],
                'email' => $tempAccount->email,
                'is_verified' => $tempAccount->is_email_verified
            ]);
        } else {
            \Log::warning('getVerificationData: No temp account ID in session data', [
                'session_data_keys' => array_keys($sessionData)
            ]);
        }

        \Log::info('getVerificationData: Returning data successfully', [
            'email' => $email,
            'has_code' => isset($sessionData['code']),
            'has_form_data' => isset($sessionData['form_data']),
            'temp_account_found' => $tempAccount !== null,
            'code_length' => isset($sessionData['code']) ? strlen($sessionData['code']) : 0
        ]);
        
        // Get location data from temp account if exists
        $locationData = [];
        if ($tempAccount) {
            $locationData = [
                'location' => $tempAccount->location_type, // Use location_type field from database
                'country_id' => $tempAccount->country_id,
                'state_id' => $tempAccount->state_id,
                'city_id' => $tempAccount->city_id,
                'institution_type' => $tempAccount->institution_type,
            ];
        }

        return $this
            ->httpResponse()
            ->setData([
                'email' => $sessionData['email'] ?? null,
                'verification_code' => $sessionData['code'] ?? null,
                'expires_at' => $sessionData['expires_at'] ?? null,
                'form_data' => $sessionData['form_data'] ?? [],
                'temp_account' => $tempAccount ? [
                    'id' => $tempAccount->id,
                    'email' => $tempAccount->email,
                    'is_email_verified' => $tempAccount->is_email_verified,
                    'verification_code' => $tempAccount->verification_code,
                ] : null,
                // Include location data for pre-filling forms
                'location' => $locationData['location'] ?? null,
                'country_id' => $locationData['country_id'] ?? null,
                'state_id' => $locationData['state_id'] ?? null,
                'city_id' => $locationData['city_id'] ?? null,
                'institution_type' => $locationData['institution_type'] ?? null,
            ]);
    }

    /**
     * Show Step 2: Institution Type page.
     */
    public function showInstitutionTypePage(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        // Allow direct access for testing design
        if ($request->query('test')) {
            $request->session()->put('registration_email_verified', true);
        }

        // Check if email is verified
        if (! $request->session()->get('registration_email_verified')) {
            return redirect()->route('public.account.register');
        }

        SeoHelper::setTitle('Select Institution Type');

        return Theme::scope(
            'job-board.auth.institution-type',
            ['form' => RegisterForm::create()],
        )->render();
    }

    /**
     * Save institution type and subtype.
     */
    public function saveInstitutionType(Request $request)
    {
        try {
            \Log::info('=== saveInstitutionType API Called ===');
            \Log::info('Request data:', $request->all());
            
            abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

            // Check if email is verified
            $emailVerified = $request->session()->get('registration_email_verified');
            \Log::info('Email verified status:', ['verified' => $emailVerified]);
            
            if (!$emailVerified) {
                \Log::warning('Email not verified');
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Please verify your email address first.');
            }

            // Check if account is employer
            $sessionData = $request->session()->get('registration_email_verification');
            $tempAccountId = $sessionData['temp_account_id'] ?? null;
            $account = null;
            
            if ($tempAccountId) {
                $account = Account::find($tempAccountId);
            }
            
            $isEmployer = false;
            if ($account) {
                $isEmployer = ($account->type === 'employer');
            } else {
                // Try to get from form_data in session
                $formData = $sessionData['form_data'] ?? [];
                $isEmployer = (isset($formData['account_type']) && $formData['account_type'] === 'employer');
            }
            
            // Validation rules - institution_name required for employer
            $validationRules = [
                'email' => ['required', 'email'],
                'institution_type' => ['nullable', 'string'], // Primary institution type
                'institution_types' => ['nullable', 'array', 'max:3'], // Multiple institution types (for job seekers)
                'institution_types.*' => ['string'],
                'location' => ['nullable', 'string', 'max:255'],
                'country_id' => ['nullable', 'integer'],
                'state_id' => ['nullable', 'integer'],
                'city_id' => ['nullable', 'integer'],
            ];
            
            // Institution name is required for employer
            if ($isEmployer) {
                $validationRules['institution_name'] = ['required', 'string', 'max:255'];
            } else {
                $validationRules['institution_name'] = ['nullable', 'string', 'max:255'];
            }
            
            $request->validate($validationRules);

            $email = $request->input('email');
            $institutionType = $request->input('institution_type');
            $institutionTypes = $request->input('institution_types', []); // Array of selected types
            $institutionName = $request->input('institution_name');
            
            // If institution_types array is provided, use the first one as primary
            if (!empty($institutionTypes) && is_array($institutionTypes)) {
                $institutionType = $institutionTypes[0]; // First selection is primary
                \Log::info('Multiple institution types received:', [
                    'institution_types' => $institutionTypes,
                    'primary' => $institutionType
                ]);
            }
            $location = $request->input('location');
            $countryId = $request->input('country_id');
            $stateId = $request->input('state_id');
            $cityId = $request->input('city_id');
            
            \Log::info('=== Received institution_name from request ===', [
                'institution_name' => $institutionName,
                'institution_name_raw' => $request->input('institution_name'),
                'institution_name_type' => gettype($institutionName),
                'institution_name_length' => $institutionName ? strlen($institutionName) : 0,
                'institution_name_is_empty' => empty($institutionName) ? 'YES' : 'NO',
                'institution_name_is_null' => is_null($institutionName) ? 'YES' : 'NO',
                'email' => $email,
                'institution_type' => $institutionType,
                'all_request_inputs' => $request->all()
            ]);
            
            \Log::info('Looking for account with email:', ['email' => $email]);
            
            // First try to find account using temp_account_id from session (same as verifyEmailCode)
            if ($tempAccountId && !$account) {
                $account = Account::find($tempAccountId);
                \Log::info('Found account using temp_account_id from session', [
                    'temp_account_id' => $tempAccountId,
                    'account_found' => $account !== null,
                ]);
            }
            
            // If not found, try to find by email (same pattern as verifyEmailCode)
            if (!$account) {
                $account = Account::where('email', $email)
                    ->where('is_email_verified', false)
                    ->whereNotNull('verification_code')
                    ->first();
                    
                if (!$account) {
                    // Try with verified account
                    $account = Account::where('email', $email)
                        ->where('is_email_verified', true)
                        ->first();
                }
                
                if (!$account) {
                    // Last try - any account with this email
                    $account = Account::where('email', $email)->first();
                }
            }

            if (!$account) {
                \Log::warning('Account not found for institution type save', [
                    'email' => $email,
                    'temp_account_id' => $tempAccountId,
                    'all_accounts_with_email' => Account::where('email', $email)->get(['id', 'email', 'is_email_verified'])->toArray(),
                ]);
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Account not found. Please verify your email first.');
            }

            \Log::info('Account found:', [
                'account_id' => $account->id,
                'email' => $account->email,
                'is_email_verified' => $account->is_email_verified,
                'current_institution_type' => $account->institution_type,
            ]);

            // Prepare update data
            $updateData = [
                'institution_type' => $institutionType,
            ];
            
            // Save multiple institution types as JSON (for job seekers)
            if (!empty($institutionTypes) && is_array($institutionTypes)) {
                $updateData['institution_types'] = json_encode($institutionTypes);
                \Log::info('Saving institution_types as JSON:', [
                    'institution_types' => $institutionTypes,
                    'json' => json_encode($institutionTypes)
                ]);
            }
            
            // Save institution_name to institution_name column (for employer)
            // ALWAYS save if provided, even if empty string (trim it first)
            $institutionName = trim($institutionName ?? '');
            if (!empty($institutionName)) {
                $updateData['institution_name'] = $institutionName;
                \Log::info('Saving institution_name to institution_name column:', [
                    'institution_name' => $institutionName,
                    'will_save_to' => 'institution_name',
                    'update_data_keys' => array_keys($updateData)
                ]);
            } else {
                \Log::warning('Institution name is empty or not provided', [
                    'institution_name_raw' => $request->input('institution_name'),
                    'institution_name_trimmed' => $institutionName
                ]);
            }
            if ($location) {
                $updateData['location_type'] = $location;
            }
            if ($countryId) {
                $updateData['country_id'] = $countryId;
            }
            if ($stateId) {
                $updateData['state_id'] = $stateId;
            }
            if ($cityId) {
                $updateData['city_id'] = $cityId;
            }
            
            // Update account (same pattern as verifyEmailCode)
            \Log::info('=== Updating account with data ===', [
                'update_data' => $updateData,
                'institution_name_in_update_data' => $updateData['institution_name'] ?? 'NOT SET',
                'institution_name_will_be_saved_to' => 'institution_name',
                'account_id' => $account->id,
                'account_email' => $account->email
            ]);
            
            // Force update
            $updated = $account->update($updateData);
            \Log::info('Update result:', ['updated' => $updated]);
            
            // Handle resume upload (moved from location step to institution type step)
            if ($request->hasFile('resume')) {
                try {
                    $result = RvMedia::handleUpload($request->file('resume'), 0, $account->upload_folder);
                    if (!$result['error']) {
                        $account->resume = $result['data']->url;
                        $account->save();
                        \Log::info('Resume uploaded in institution type step', [
                            'account_id' => $account->id,
                            'resume_url' => $result['data']->url,
                        ]);
                    } else {
                        \Log::warning('Resume upload failed in institution type step', [
                            'error' => $result['message'] ?? 'Unknown error',
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('Resume upload exception in institution type step:', [
                        'error' => $e->getMessage(),
                    ]);
                }
            }
            
            // Verify the save
            $account->refresh();
            \Log::info('=== Account updated successfully ===', [
                'institution_type' => $account->institution_type,
                'institution_name' => $account->institution_name,
                'institution_name_expected' => $institutionName,
                'institution_name_saved' => $account->institution_name === $institutionName ? 'YES ✅' : 'NO ❌',
                'institution_name_is_null' => is_null($account->institution_name) ? 'YES ❌' : 'NO ✅',
                'resume' => $account->resume,
            ]);
            
            // Double check with fresh query
            $freshAccount = Account::find($account->id);
            \Log::info('=== Fresh account check ===', [
                'institution_name_from_fresh' => $freshAccount->institution_name,
                'matches_expected' => $freshAccount->institution_name === $institutionName ? 'YES ✅' : 'NO ❌'
            ]);

            \Log::info('=== Institution type saved successfully ===', [
                'account_id' => $account->id,
                'email' => $email,
                'institution_type' => $institutionType,
                'institution_name' => $institutionName,
                'institution_name_saved' => $account->fresh()->institution_name, // institution_name stored in institution_name column
                'location' => $location,
                'country_id' => $countryId,
                'state_id' => $stateId,
                'city_id' => $cityId,
                'updated_institution_type' => $account->fresh()->institution_type,
            ]);

            return $this
                ->httpResponse()
                ->setMessage('Institution type saved successfully.');
                
        } catch (\Exception $e) {
            \Log::error('=== saveInstitutionType ERROR ===', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
            
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('An error occurred while saving institution type: ' . $e->getMessage());
        }
    }

    /**
     * Show Step 3: Location page.
     */
    public function showLocationPage(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        // Allow direct access for testing design
        if ($request->query('test')) {
            $request->session()->put('registration_email_verified', true);
        }

        // Check if email is verified and institution type is selected
        if (! $request->session()->get('registration_email_verified')) {
            return redirect()->route('public.account.register');
        }

        SeoHelper::setTitle('Select Location');

        return Theme::scope(
            'job-board.auth.location',
            ['form' => RegisterForm::create()],
        )->render();
    }

    /**
     * Save location data.
     */
    public function saveLocation(Request $request)
    {
        try {
            \Log::info('=== saveLocation API Called ===');
            \Log::info('Request data:', $request->all());
            
            abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

            // Check if email is verified
            $emailVerified = $request->session()->get('registration_email_verified');
            \Log::info('Email verified status:', ['verified' => $emailVerified]);
            
            if (!$emailVerified) {
                \Log::warning('Email not verified');
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Please verify your email address first.');
            }

            $request->validate([
                'email' => ['required', 'email'],
                'location' => ['nullable', 'string', 'max:255'], // Nullable for job seekers
                'country_id' => ['nullable', 'integer'],
                'state_id' => ['nullable', 'integer'],
                'city_id' => ['nullable', 'integer'],
                'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            ]);

            $email = $request->input('email');
            $location = $request->input('location', ''); // Empty string if not provided
            $countryId = $request->input('country_id');
            $stateId = $request->input('state_id');
            $cityId = $request->input('city_id');
            
            \Log::info('Looking for account with email:', [
                'email' => $email, 
                'location' => $location,
                'country_id' => $countryId,
                'state_id' => $stateId,
                'city_id' => $cityId,
            ]);
            
            // Use same pattern as verifyEmailCode and saveInstitutionType - find temp account from session first
            $sessionData = $request->session()->get('registration_email_verification');
            $tempAccountId = $sessionData['temp_account_id'] ?? null;
            
            $account = null;
            
            // First try to find account using temp_account_id from session (same as verifyEmailCode)
            if ($tempAccountId) {
                $account = Account::find($tempAccountId);
                \Log::info('Found account using temp_account_id from session', [
                    'temp_account_id' => $tempAccountId,
                    'account_found' => $account !== null,
                ]);
            }
            
            // If not found, try to find by email (same pattern as verifyEmailCode)
            if (!$account) {
                $account = Account::where('email', $email)
                    ->where('is_email_verified', false)
                    ->whereNotNull('verification_code')
                    ->first();
                    
                if (!$account) {
                    // Try with verified account
                    $account = Account::where('email', $email)
                        ->where('is_email_verified', true)
                        ->first();
                }
                
                if (!$account) {
                    // Last try - any account with this email
                    $account = Account::where('email', $email)->first();
                }
            }

            if (!$account) {
                \Log::warning('Account not found for location save', [
                    'email' => $email,
                    'temp_account_id' => $tempAccountId,
                    'all_accounts_with_email' => Account::where('email', $email)->get(['id', 'email', 'is_email_verified'])->toArray(),
                ]);
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage('Account not found. Please verify your email first.');
            }

            \Log::info('Account found:', [
                'account_id' => $account->id,
                'email' => $account->email,
                'is_email_verified' => $account->is_email_verified,
            ]);

            // Update account - save location data
            $updateData = [];
            
            if (!empty($location)) {
                $updateData['location_type'] = $location;
            }
            if (!empty($countryId)) {
                $updateData['country_id'] = $countryId;
            }
            if (!empty($stateId)) {
                $updateData['state_id'] = $stateId;
            }
            if (!empty($cityId)) {
                $updateData['city_id'] = $cityId;
            }
            
            if (!empty($updateData)) {
                $account->update($updateData);
            }

            // Handle resume upload
            if ($request->hasFile('resume')) {
                $result = RvMedia::handleUpload($request->file('resume'), 0, $account->upload_folder);
                if (! $result['error']) {
                    $account->resume = $result['data']->url;
                    $account->save();
                    \Log::info('Resume uploaded successfully', [
                        'account_id' => $account->id,
                        'resume_url' => $result['data']->url,
                    ]);
                } else {
                    \Log::warning('Resume upload failed', [
                        'error' => $result['message'] ?? 'Unknown error',
                    ]);
                }
            }

            \Log::info('=== Location saved successfully ===', [
                'account_id' => $account->id,
                'email' => $email,
                'location' => $location,
                'country_id' => $countryId,
                'state_id' => $stateId,
                'city_id' => $cityId,
                'updated_location_type' => $account->fresh()->location_type,
            ]);

            // Mark registration as complete
            $request->session()->put('registration_complete', true);
            
            // Log in the user
            $this->guard()->login($account);
            
            \Log::info('User logged in after location save', [
                'account_id' => $account->id,
                'email' => $email,
            ]);

            // Redirect to appropriate dashboard based on account type
            $redirectUrl = $account->isEmployer() 
                ? route('public.account.dashboard') 
                : route('public.account.jobseeker.dashboard');

            return $this
                ->httpResponse()
                ->setMessage('Location saved successfully.')
                ->setNextUrl($redirectUrl);
                
        } catch (\Exception $e) {
            \Log::error('=== saveLocation ERROR ===', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);
            
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('An error occurred while saving location: ' . $e->getMessage());
        }
    }

    public function register(RegisterRequest $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        // Check if email is verified (should be set by verifyEmailCode API)
        if (!$request->session()->get('registration_email_verified')) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('Please verify your email address first before completing registration.');
        }
        
        $email = $request->input('email');
        
        // Check if email already exists and is verified (different from temp account)
        $sessionData = $request->session()->get('registration_email_verification', []);
        $tempAccountId = $sessionData['temp_account_id'] ?? null;
        
        $existingAccount = Account::where('email', $email)
            ->where('id', '!=', $tempAccountId) // Exclude current temp account
            ->first();
        
        if ($existingAccount) {
            // Check verification status
            $isVerified = $existingAccount->is_email_verified == 1 && $existingAccount->email_verified_at !== null;
            
            if ($isVerified) {
                // Email is already verified - redirect to login
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setNextUrl(route('public.account.login'))
                    ->setMessage('The email has already been taken. Redirecting to login...');
            } else {
                // Email exists but not verified - redirect to login
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setNextUrl(route('public.account.login'))
                    ->setMessage('This email is already registered. Redirecting to login...');
            }
        }

        // Handle account type selection - prioritize new account_type field over legacy is_employer
        if ($request->has('account_type') && setting('job_board_enabled_register_as_employer', 1)) {
            $accountType = $request->input('account_type') === 'employer'
                ? AccountTypeEnum::EMPLOYER
                : AccountTypeEnum::JOB_SEEKER;
            $request->merge(['type' => $accountType]);
        } elseif ($request->input('is_employer') && setting('job_board_enabled_register_as_employer', 1)) {
            $request->merge(['type' => AccountTypeEnum::EMPLOYER]);
        } else {
            $request->merge(['type' => AccountTypeEnum::JOB_SEEKER]);
        }

        /**
         * @var Account $account
         */
        $account = $this->create($request->input());

        // Handle resume upload after account creation
        if ($request->hasFile('resume')) {
            $result = RvMedia::handleUpload($request->file('resume'), 0, $account->upload_folder);
            if (! $result['error']) {
                $account->resume = $result['data']->url;
                $account->save();
            }
        }

        event(new Registered($account));

        $request->merge(['slug' => $account->name, 'is_slug_editable' => 1]);

        event(new CreatedContentEvent(ACCOUNT_MODULE_SCREEN_NAME, $request, $account));

        EmailHandler::setModule(JOB_BOARD_MODULE_SCREEN_NAME)
            ->setVariableValues([
                'account_type' => Str::lower($account->type->label()),
                'account_name' => $account->name,
                'account_email' => $account->email,
            ])
            ->sendUsingTemplate('account-registered', setting('email_from_address'));

        if (setting('verify_account_email', 0)) {
            $account->sendEmailVerificationNotification();

            $this->registered($request, $account);

            $message = trans('plugins/job-board::messages.verification_email_sent');

            return $this
                ->httpResponse()
                ->setNextUrl(route('public.account.login'))
                ->with(['auth_warning_message' => $message])
                ->setMessage($message);
        }

        $account->confirmed_at = Carbon::now();

        $account->is_public_profile = true;

        $account->save();

        $this->guard()->login($account);

        $this->registered($request, $account);

        // Redirect based on account type
        if ($account->isEmployer()) {
            $this->redirectTo = route('public.account.dashboard');
        } else {
            $this->redirectTo = route('public.account.jobseeker.dashboard');
        }

        return $this
            ->httpResponse()->setNextUrl($this->redirectPath());
    }

    protected function create(array $data)
    {
        // Check if there's a temporary account ID in the request data (from frontend)
        $tempAccountId = Arr::get($data, 'temp_account_id');

        // If not found in request, check session (fallback)
        if (!$tempAccountId) {
            $sessionData = session('registration_email_verification', []);
            $tempAccountId = $sessionData['temp_account_id'] ?? null;
        }

        if ($tempAccountId) {
            // Update existing temporary account
            $account = Account::find($tempAccountId);
            if ($account) {
                // Handle full_name - split into first_name and last_name for backward compatibility
                $fullName = Arr::get($data, 'full_name', '');
                $nameParts = explode(' ', $fullName, 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? $firstName;

                // Map phone_display to phone if phone is null
                $phone = Arr::get($data, 'phone') ?: Arr::get($data, 'phone_display', '');
                // Get phone_country_code from data, or preserve from existing account if not provided
                $phoneCountryCode = Arr::get($data, 'phone_country_code', '') ?: $account->phone_country_code;
                
                \Log::info('Phone data in create (update temp account):', [
                    'phone' => $phone,
                    'phone_display' => Arr::get($data, 'phone_display', 'not set'),
                    'phone_country_code_from_data' => Arr::get($data, 'phone_country_code', 'not set'),
                    'phone_country_code_from_account' => $account->phone_country_code ?? 'not set',
                    'phone_country_code_final' => $phoneCountryCode,
                ]);
                
                // Format phone with country code: "+919340193449" (no space)
                if ($phone && strpos($phone, '+') === 0) {
                    // Phone already has country code, just clean spaces
                    $phone = '+' . preg_replace('/[^0-9]/', '', $phone);
                } elseif ($phone && $phoneCountryCode) {
                    // Add country code to phone
                    $phoneCountryCode = preg_replace('/[^0-9]/', '', $phoneCountryCode);
                    $phone = preg_replace('/[^0-9]/', '', $phone);
                    $phone = '+' . $phoneCountryCode . $phone;
                } elseif ($phone) {
                    // Clean phone number (remove spaces, dashes)
                    $phone = preg_replace('/[^0-9]/', '', $phone);
                }

                $account->update([
                    'type' => $data['type'],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'full_name' => $fullName,
                    'phone' => $phone,
                    'phone_country_code' => $phoneCountryCode,
                    'is_whatsapp_available' => Arr::get($data, 'is_whatsapp_available', false),
                    'institution_type' => Arr::get($data, 'institution_type'),
                    // Map institution_name to institution_name column (for employer)
                    'institution_name' => Arr::get($data, 'institution_name') ?: Arr::get($data, 'institution_name'),
                    'country_id' => Arr::get($data, 'country_id'),
                    'state_id' => Arr::get($data, 'state_id'),
                    'city_id' => Arr::get($data, 'city_id'),
                    'location_type' => Arr::get($data, 'location_type'),
                    'password' => Hash::make($data['password']),
                    'is_public_profile' => true,
                    // Email verification fields are already set
                ]);

                return $account;
            }
        }

        // Fallback: Create new account if no temporary account exists
        // Handle full_name - split into first_name and last_name for backward compatibility
        $fullName = Arr::get($data, 'full_name', '');
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? $firstName;

        // Map phone_display to phone if phone is null
        $phone = Arr::get($data, 'phone') ?: Arr::get($data, 'phone_display', '');
        $phoneCountryCode = Arr::get($data, 'phone_country_code', '');
        
        \Log::info('Phone data in create (new account):', [
            'phone' => $phone,
            'phone_display' => Arr::get($data, 'phone_display', 'not set'),
            'phone_country_code' => $phoneCountryCode,
        ]);
        
        // Format phone with country code: "+919340193449" (no space)
        if ($phone && strpos($phone, '+') === 0) {
            // Phone already has country code, just clean spaces
            $phone = '+' . preg_replace('/[^0-9]/', '', $phone);
        } elseif ($phone && $phoneCountryCode) {
            // Add country code to phone
            $phoneCountryCode = preg_replace('/[^0-9]/', '', $phoneCountryCode);
            $phone = preg_replace('/[^0-9]/', '', $phone);
            $phone = '+' . $phoneCountryCode . $phone;
        } elseif ($phone) {
            // Clean phone number (remove spaces, dashes)
            $phone = preg_replace('/[^0-9]/', '', $phone);
        }
        
        \Log::info('Phone data after formatting (new account):', [
            'phone' => $phone,
            'phone_country_code' => $phoneCountryCode,
        ]);
        
        return Account::query()->forceCreate([
            'type' => $data['type'],
            'first_name' => $firstName,
            'last_name' => $lastName,
            'full_name' => $fullName,
            'email' => $data['email'],
            'phone' => $phone,
            'phone_country_code' => $phoneCountryCode,
            'is_whatsapp_available' => Arr::get($data, 'is_whatsapp_available', false),
            'institution_type' => Arr::get($data, 'institution_type'),
            // Map institution_name to institution_name column (for employer)
            'institution_name' => Arr::get($data, 'institution_name') ?: Arr::get($data, 'institution_name'),
            'country_id' => Arr::get($data, 'country_id'),
            'state_id' => Arr::get($data, 'state_id'),
            'city_id' => Arr::get($data, 'city_id'),
            'location_type' => Arr::get($data, 'location_type'),
            'password' => Hash::make($data['password']),
            'is_public_profile' => true,
            // Email verification fields
            'email_verified_at' => now(),
            'is_email_verified' => true,
            'verification_code' => Arr::get($data, 'verification_code'),
        ]);
    }

    /**
     * Show employer registration form
     */
    public function showEmployerRegistrationForm()
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);
        // Employer registration is always enabled for this site

        SeoHelper::setTitle('Register as Employer');

        Theme::breadcrumb()->add(__('Home'), route('public.index'))->add('Employer Registration');

        Theme::asset()->container('footer')->add('js-validation', 'vendor/core/core/js-validation/js/js-validation.js', ['jquery']);
        Theme::asset()->container('footer')
            ->writeContent('js-validation-scripts', JsValidator::formRequest(\Botble\JobBoard\Http\Requests\Fronts\Auth\EmployerRegisterRequest::class), ['jquery']);

        $form = \Botble\JobBoard\Forms\Fronts\Auth\EmployerRegisterForm::create();

        return Theme::scope('job-board.auth.employer-register', compact('form'), 'plugins/job-board::themes.auth.employer-register')->render();
    }

    /**
     * Handle employer registration Step 1 - Send OTP
     */
    public function registerEmployerStep1(\Botble\JobBoard\Http\Requests\Fronts\Auth\EmployerRegisterRequest $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $email = $request->input('email');

        // Check if email already exists and is verified
        $existingAccount = Account::where('email', $email)
            ->where('is_email_verified', true)
            ->first();
            
        if ($existingAccount) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage('This email is already registered. Please login instead.')
                ->setNextUrl(route('public.account.login'));
        }

        // Generate OTP
        $code = '123456'; // For testing, use fixed code
        // $code = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT); // For production
        $expiresAt = now()->addMinutes(10);

        // Map phone_display to phone
        $phone = $request->input('phone') ?: $request->input('phone_display', '');
        if ($phone && strpos($phone, '+') === 0) {
            $phone = '+' . preg_replace('/[^0-9]/', '', $phone);
        }

        // Parse full name
        $fullName = $request->input('full_name', '');
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? $firstName;

        // Delete any existing unverified account with this email
        Account::where('email', $email)->where('is_email_verified', false)->delete();

        // Create temp employer account
        $tempAccount = Account::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'is_whatsapp_available' => $request->input('is_whatsapp_available', false),
            'type' => AccountTypeEnum::EMPLOYER,
            'password' => Hash::make($request->input('password')),
            'is_email_verified' => false,
            'email_verification_token' => $code,
            'email_verification_token_expires_at' => $expiresAt,
        ]);

        // Store in session
        $request->session()->put('employer_registration', [
            'email' => $email,
            'code' => $code,
            'expires_at' => $expiresAt,
            'temp_account_id' => $tempAccount->id,
        ]);

        $request->session()->put('employer_verify_email', $email);

        // Configure email driver from .env settings
        if (env('MAIL_HOST')) {
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => env('MAIL_HOST'),
                'mail.mailers.smtp.port' => env('MAIL_PORT', 587),
                'mail.mailers.smtp.username' => env('MAIL_USERNAME'),
                'mail.mailers.smtp.password' => env('MAIL_PASSWORD'),
                'mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION', 'tls'),
            ]);
            if (env('MAIL_FROM_ADDRESS')) {
                config([
                    'mail.from.address' => env('MAIL_FROM_ADDRESS'),
                    'mail.from.name' => env('MAIL_FROM_NAME', 'TeachersRecruiter'),
                ]);
            }
        }

        // Send verification email using Notification
        try {
            $tempAccount->notify(new EmailVerificationNotification($code));
            Log::info('Employer verification email sent successfully', [
                'email' => $email,
                'temp_account_id' => $tempAccount->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Employer email send failed: ' . $e->getMessage(), [
                'email' => $email,
                'temp_account_id' => $tempAccount->id,
            ]);
        }

        Log::info('Employer Step 1 completed - OTP sent:', [
            'email' => $email,
            'temp_account_id' => $tempAccount->id,
        ]);

        return $this
            ->httpResponse()
            ->setMessage('Verification code sent to your email.')
            ->setNextUrl(route('public.account.register.employer.verifyEmailPage'));
    }

    /**
     * Show employer email verification page
     */
    public function showEmployerEmailVerificationPage()
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $email = session()->get('employer_verify_email');
        if (!$email) {
            return redirect()->route('public.account.register.employer')
                ->with('error', 'Please complete the registration form first.');
        }

        // Get phone and WhatsApp availability from temp account
        $phone = '';
        $isWhatsappAvailable = false;
        $sessionData = session()->get('employer_registration', []);
        $tempAccountId = $sessionData['temp_account_id'] ?? null;
        if ($tempAccountId) {
            $tempAccount = Account::find($tempAccountId);
            if ($tempAccount) {
                $phone = $tempAccount->phone ?? '';
                $isWhatsappAvailable = !empty($tempAccount->is_whatsapp_available);
            }
        }

        SeoHelper::setTitle('Verify Email - Employer Registration');
        Theme::breadcrumb()->add(__('Home'), route('public.index'))->add('Verify Email');

        return Theme::scope('job-board.auth.employer-verify-email', compact('email', 'phone', 'isWhatsappAvailable'), 'plugins/job-board::themes.auth.employer-verify-email')->render();
    }

    /**
     * Verify employer email code
     */
    public function verifyEmployerEmailCode(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'regex:/^[0-9]{6}$/'],
        ]);

        $email = $request->input('email');
        $inputCode = $request->input('code');

        $sessionData = $request->session()->get('employer_registration');

        if (!$sessionData || $sessionData['email'] !== $email) {
            return $this->httpResponse()->setError()->setMessage('Invalid session. Please try again.');
        }

        if ($sessionData['code'] !== $inputCode) {
            return $this->httpResponse()->setError()->setMessage('Invalid verification code.');
        }

        if (now()->isAfter($sessionData['expires_at'])) {
            return $this->httpResponse()->setError()->setMessage('Verification code has expired.');
        }

        // Mark email as verified
        $account = Account::find($sessionData['temp_account_id']);
        if ($account) {
            $account->update([
                'is_email_verified' => true,
                'email_verified_at' => now(),
            ]);
        }

        $request->session()->put('employer_email_verified', true);

        \Log::info('Employer email verified:', ['email' => $email]);

        return $this
            ->httpResponse()
            ->setMessage('Email verified successfully!')
            ->setNextUrl(route('public.account.register.employer.institutionTypePage'));
    }

    /**
     * Show employer institution type page
     */
    public function showEmployerInstitutionTypePage()
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        if (!session()->get('employer_email_verified')) {
            return redirect()->route('public.account.register.employer')
                ->with('error', 'Please verify your email first.');
        }

        $email = session()->get('employer_verify_email');

        SeoHelper::setTitle('Institution Details - Employer Registration');
        Theme::breadcrumb()->add(__('Home'), route('public.index'))->add('Institution Details');

        $institutionTypes = [
            'school' => 'School',
            'edtech-company' => 'Edtech Company',
            'online-education-platform' => 'Online Education Platform',
            'college' => 'College',
            'coaching-institute' => 'Coaching Institute',
            'book-publishing-company' => 'Book Publishing Company',
            'non-profit-organization' => 'Non Profit Organization',
            'university' => 'University',
            'distance-learning' => 'Distance Learning',
            'teacher-training-academy' => 'Teacher Training Academy',
            'sports-academy' => 'Sports Academy',
        ];

        return Theme::scope('job-board.auth.employer-institution-type', compact('email', 'institutionTypes'), 'plugins/job-board::themes.auth.employer-institution-type')->render();
    }

    /**
     * Save employer institution type
     */
    public function saveEmployerInstitutionType(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $sessionData = $request->session()->get('employer_registration');
        if (!$sessionData) {
            return $this->httpResponse()->setError()->setMessage('Session expired. Please try again.');
        }

        $registrationType = $request->input('registration_type', 'school_institution');

        // Validation rules differ based on registration type
        if ($registrationType === 'consultancy') {
            $request->validate([
                'registration_type' => ['required', 'string', 'in:school_institution,consultancy'],
                'institution_name' => ['required', 'string', 'max:255'],
            ]);
        } else {
            $request->validate([
                'registration_type' => ['required', 'string', 'in:school_institution,consultancy'],
                'institution_type' => ['required', 'string', 'max:100'],
                'institution_name' => ['required', 'string', 'max:255'],
            ]);
        }

        $account = Account::find($sessionData['temp_account_id']);
        if (!$account) {
            return $this->httpResponse()->setError()->setMessage('Account not found.');
        }

        $updateData = [
            'registration_type' => $registrationType,
            'institution_name' => $request->input('institution_name'),
        ];

        if ($registrationType === 'consultancy') {
            $updateData['institution_type'] = 'consultancy';
        } else {
            $updateData['institution_type'] = $request->input('institution_type');
        }

        $account->update($updateData);

        \Log::info('Employer institution type saved:', [
            'account_id' => $account->id,
            'registration_type' => $registrationType,
            'institution_type' => $updateData['institution_type'],
            'institution_name' => $request->input('institution_name'),
        ]);

        return $this
            ->httpResponse()
            ->setMessage('Institution details saved!')
            ->setNextUrl(route('public.account.register.employer.locationPage'));
    }

    /**
     * Show employer location page
     */
    public function showEmployerLocationPage()
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        if (!session()->get('employer_email_verified')) {
            return redirect()->route('public.account.register.employer')
                ->with('error', 'Please verify your email first.');
        }

        $email = session()->get('employer_verify_email');

        SeoHelper::setTitle('Location - Employer Registration');
        Theme::breadcrumb()->add(__('Home'), route('public.index'))->add('Location');

        return Theme::scope('job-board.auth.employer-location', compact('email'), 'plugins/job-board::themes.auth.employer-location')->render();
    }

    /**
     * Save employer location and complete registration
     */
    public function saveEmployerLocation(Request $request)
    {
        abort_unless(JobBoardHelper::isRegisterEnabled(), 404);

        $request->validate([
            'country_id' => ['nullable', 'integer'],
            'state_id' => ['nullable', 'integer'],
            'city_id' => ['required', 'integer'],
        ]);

        $sessionData = $request->session()->get('employer_registration');
        if (!$sessionData) {
            return $this->httpResponse()->setError()->setMessage('Session expired. Please try again.');
        }

        $account = Account::find($sessionData['temp_account_id']);
        if (!$account) {
            return $this->httpResponse()->setError()->setMessage('Account not found.');
        }

        $account->update([
            'country_id' => $request->input('country_id'),
            'state_id' => $request->input('state_id') ?: null,
            'city_id' => $request->input('city_id') ?: null,
            'is_public_profile' => true,
        ]);

        \Log::info('Employer registration completed:', [
            'account_id' => $account->id,
            'email' => $account->email,
        ]);

        // Fire registered event
        event(new Registered($account));

        // Login the employer
        $this->guard()->login($account);

        // Clear session data
        $request->session()->forget(['employer_registration', 'employer_verify_email', 'employer_email_verified']);

        return $this
            ->httpResponse()
            ->setMessage('Registration successful! Welcome to TeachersRecruiter.')
            ->setNextUrl(route('public.account.dashboard'));
    }
}