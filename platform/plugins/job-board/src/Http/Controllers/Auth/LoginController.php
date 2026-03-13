<?php

namespace Botble\JobBoard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Botble\ACL\Traits\AuthenticatesUsers;
use Botble\ACL\Traits\LogoutGuardTrait;
use Botble\JobBoard\Forms\Fronts\Auth\LoginForm;
use Botble\JobBoard\Http\Requests\Fronts\Auth\LoginRequest;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Models\Account;
use Botble\JsValidation\Facades\JsValidator;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers, LogoutGuardTrait {
        AuthenticatesUsers::attemptLogin as baseAttemptLogin;
    }

    public string $redirectTo = '/';

    /**
     * Login ke baad: job seeker → job seeker dashboard, employer → employer dashboard
     */
    public function redirectTo(): string
    {
        if ($this->guard()->check()) {
            return $this->getDashboardUrlForAccount($this->guard()->user());
        }
        return $this->redirectTo;
    }

    public function showLoginForm()
    {
        SeoHelper::setTitle(trans('plugins/job-board::messages.login'));

        Theme::breadcrumb()->add(trans('plugins/job-board::messages.login'), route('public.account.register'));

        if (! session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        // Load social-login CSS early so it applies (plugin adds it in form filter, which runs after layout head)
        if (is_plugin_active('social-login')) {
            $cssPath = platform_path('plugins/social-login/public/css/social-login.css');
            $version = file_exists($cssPath) ? (string) filemtime($cssPath) : '1.2.2';
            Theme::asset()
                ->usePath(false)
                ->add('social-login-css', asset('vendor/core/plugins/social-login/css/social-login.css'), [], [], $version);
        }

        Theme::asset()->container('footer')->add('js-validation', 'vendor/core/core/js-validation/js/js-validation.js', ['jquery']);
        Theme::asset()->container('footer')
            ->writeContent('js-validation-scripts', JsValidator::formRequest(LoginRequest::class), ['jquery']);

        $showEmailOtpStep = session('show_email_otp_step', false);
        $otpEmail = session('otp_email', '');
        $showWhatsappOtpStep = session('show_whatsapp_otp_step', false);
        $otpPhone = session('otp_phone', '');

        return Theme::scope('job-board.auth.login', [
            'form' => LoginForm::create(),
            'show_email_otp_step' => $showEmailOtpStep,
            'otp_email' => $otpEmail,
            'show_whatsapp_otp_step' => $showWhatsappOtpStep,
            'otp_phone' => $otpPhone,
        ], 'plugins/job-board::themes.auth.login')->render();
    }

    protected function guard()
    {
        return auth('account');
    }

    public function login(LoginRequest $request)
    {
        // Check if WhatsApp OTP checkbox is checked
        if ($request->has('use_whatsapp_otp') && $request->input('use_whatsapp_otp')) {
            // Extract phone number from email/phone field
            $phone = preg_replace('/[^0-9]/', '', $request->input('email'));
            
            // Validate phone number
            if (strlen($phone) < 10) {
                return back()->withInput()->withErrors([
                    'email' => __('Please enter a valid phone number for WhatsApp OTP.'),
                ]);
            }
            
            // Check if account exists with this phone
            $account = Account::where('phone', 'LIKE', '%' . substr($phone, -10))->first();
            
            if (!$account) {
                return back()->withInput()->withErrors([
                    'email' => __('No account found with this phone number.'),
                ]);
            }
            
            // Generate 6-digit OTP
            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiresAt = Carbon::now()->addMinutes(10);
            
            // Store OTP in session
            $request->session()->put('login_otp', [
                'phone' => $phone,
                'account_id' => $account->id,
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'type' => 'whatsapp',
            ]);
            
            // Send OTP via WhatsApp
            try {
                $whatsappSent = $this->sendWhatsAppMessage($phone, $otp);
                
                if ($whatsappSent) {
                    return back()->withInput()->with([
                        'whatsapp_otp_sent' => true,
                        'whatsapp_phone' => $phone,
                        'message' => __('OTP sent to your WhatsApp number. Please enter the OTP to login.'),
                    ]);
                } else {
                    return back()->withInput()->withErrors([
                        'email' => __('Failed to send WhatsApp OTP. Please try again or use password login.'),
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('WhatsApp OTP Error: ' . $e->getMessage());
                return back()->withInput()->withErrors([
                    'email' => __('WhatsApp service unavailable. Please use password login.'),
                ]);
            }
        }
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $account = $this->guard()->user();
            $account = Account::find($account->id);

            // 1. Pehle email check: Email unverified → Email OTP (email se login = email OTP)
            if ($account->email_verified_at === null) {
                $this->guard()->logout();
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $expiresAt = Carbon::now()->addMinutes(10);
                $request->session()->put('login_otp', [
                    'email' => $account->email,
                    'otp' => $otp,
                    'expires_at' => $expiresAt,
                    'type' => 'email',
                ]);
                try {
                    Mail::send([], [], function ($message) use ($account, $otp) {
                        $message->to($account->email)
                            ->subject(__('Verify your email - Teachers Recruiter'))
                            ->html(
                                "<div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;'>" .
                                "<h2 style='color: #0073d1;'>" . __('Email Verification') . "</h2>" .
                                "<p>" . __('Hello') . " " . ($account->first_name ?: $account->name) . ",</p>" .
                                "<p>" . __('Please verify your email using the OTP below:') . "</p>" .
                                "<div style='background: #f5f5f5; padding: 20px; text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; margin: 20px 0;'>{$otp}</div>" .
                                "<p>" . __('This OTP is valid for 10 minutes.') . "</p>" .
                                "<p style='color: #888; font-size: 12px;'>Teachers Recruiter</p></div>"
                            );
                    });
                } catch (\Exception $e) {
                    return back()->withInput()->withErrors([
                        'email' => __('Failed to send verification OTP. Please try Email OTP login method.'),
                    ]);
                }
                return redirect()->route('public.account.login')
                    ->with('message', __('Please verify your email. We have sent an OTP to your email address.'))
                    ->with('show_email_otp_step', true)
                    ->with('otp_email', $account->email);
            }

            // 2. Email verified → direct login (WhatsApp OTP redirect nahi; verified email = dashboard)
            // Store login time for logout summary
            $request->session()->put('login_time', now());
            $request->session()->put('session_activities', []);
            
            // Send login success notification (only for employers)
            if ($account && $account->isEmployer()) {
                try {
                    $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                    $loginTime = Carbon::now()->format('d/M/Y, h:i A');
                    $notificationService->sendLoginSuccessNotification($account, $loginTime);
                } catch (\Exception $e) {
                    \Log::error('Failed to send login notification: ' . $e->getMessage());
                }
            }
            
            $this->redirectTo = $this->getDashboardUrlForAccount($account);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to log in and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse();
    }

    protected function credentials(Request $request): array
    {
        $login = $request->input('email');
        $email = $this->resolveLoginToEmail($login);

        return [
            'email' => $email,
            'password' => $request->input('password'),
        ];
    }

    /**
     * Resolve login input (email or phone) to account email for authentication.
     */
    protected function resolveLoginToEmail(string $login): string
    {
        $login = trim($login);
        if (str_contains($login, '@')) {
            return $login;
        }
        $digits = preg_replace('/[^0-9]/', '', $login);
        if ($digits === '') {
            return $login;
        }
        $last10 = strlen($digits) >= 10 ? substr($digits, -10) : $digits;
        $account = Account::where('phone', 'LIKE', '%' . $last10)->first();
        if ($account) {
            return $account->email;
        }
        return $login;
    }

    protected function attemptLogin(Request $request)
    {
        try {
            if ($this->guard()->validate($this->credentials($request))) {
                $account = $this->guard()->getLastAttempted();
                // Verification = only email_verified_at (null = not verified). Unverified handled in login() with OTP step.
                return $this->baseAttemptLogin($request);
            }
        } catch (\RuntimeException $e) {
            // Stored password not in Bcrypt format (e.g. old hash or different algorithm) – treat as invalid login
            if (str_contains($e->getMessage(), 'Bcrypt algorithm')) {
                return false;
            }
            throw $e;
        }
        return false;
    }

    public function logout(Request $request)
    {
        $account = $this->guard()->user();
        
        // Calculate session duration for logout summary
        $sessionStart = $request->session()->get('login_time', now());
        $sessionDuration = now()->diffInMinutes($sessionStart);
        $hours = floor($sessionDuration / 60);
        $minutes = $sessionDuration % 60;
        $durationText = $hours > 0 ? "{$hours} hour(s) {$minutes} minute(s)" : "{$minutes} minute(s)";
        
        // Get session activities (if tracked)
        $activities = $request->session()->get('session_activities', []);
        $activitySummary = count($activities) > 0 
            ? 'Activities: ' . implode(', ', array_slice($activities, 0, 3))
            : 'No specific activities tracked';
        
        $summary = "Session duration: {$durationText}. {$activitySummary}.";
        
        $activeGuards = 0;
        $this->guard()->logout();

        foreach (config('auth.guards', []) as $guard => $guardConfig) {
            if ($guardConfig['driver'] !== 'session') {
                continue;
            }
            if ($this->isActiveGuard($request, $guard)) {
                $activeGuards++;
            }
        }

        if (! $activeGuards) {
            $request->session()->flush();
            $request->session()->regenerate();
        }

        // Send logout summary notification (only for employers)
        if ($account && $account->isEmployer()) {
            try {
                $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                $notificationService->sendLogoutSummaryNotification($account, $summary);
            } catch (\Exception $e) {
                \Log::error('Failed to send logout notification: ' . $e->getMessage());
            }
        }

        $this->loggedOut($request);

        return redirect()->to(route('public.index'));
    }
    
    /**
     * The user has been authenticated.
     * Override to send login notification
     */
    protected function authenticated(Request $request, $account)
    {
        // Store login time for logout summary
        $request->session()->put('login_time', now());
        $request->session()->put('session_activities', []);
        
        // Send login success notification (only for employers)
        if ($account && $account->isEmployer()) {
            try {
                $notificationService = app(\Botble\JobBoard\Services\NotificationService::class);
                $loginTime = Carbon::now()->format('d/M/Y, h:i A');
                $notificationService->sendLoginSuccessNotification($account, $loginTime);
            } catch (\Exception $e) {
                \Log::error('Failed to send login notification: ' . $e->getMessage());
            }
        }
        
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Send OTP to email for login
     */
    public function sendEmailOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        
        // Check if account exists
        $account = Account::where('email', $email)->first();
        
        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => __('No account found with this email address.'),
            ]);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(10);

        // Store OTP in session
        $request->session()->put('login_otp', [
            'email' => $email,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'type' => 'email',
        ]);

        // Send OTP via email
        try {
            Mail::send([], [], function ($message) use ($email, $otp, $account) {
                $message->to($email)
                    ->subject('Your Login OTP - Teachers Recruiter')
                    ->html("
                        <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto;'>
                            <h2 style='color: #0073d1;'>Login Verification</h2>
                            <p>Hello {$account->first_name},</p>
                            <p>Your OTP for login is:</p>
                            <div style='background: #f5f5f5; padding: 20px; text-align: center; font-size: 32px; font-weight: bold; letter-spacing: 8px; margin: 20px 0;'>
                                {$otp}
                            </div>
                            <p>This OTP is valid for 10 minutes.</p>
                            <p>If you didn't request this, please ignore this email.</p>
                            <p style='color: #888; font-size: 12px;'>Teachers Recruiter</p>
                        </div>
                    ");
            });

            return response()->json([
                'error' => false,
                'message' => __('OTP sent to your email address.'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => __('Failed to send OTP. Please try again.'),
            ]);
        }
    }

    /**
     * Send OTP to WhatsApp for login
     */
    public function sendWhatsAppOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:10',
        ]);

        $phone = preg_replace('/[^0-9]/', '', $request->input('phone'));
        
        // Check if account exists with this phone
        $account = Account::where('phone', 'LIKE', '%' . substr($phone, -10))->first();
        
        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => __('No account found with this phone number.'),
            ]);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(10);

        // Store OTP in session
        $request->session()->put('login_otp', [
            'phone' => $phone,
            'account_id' => $account->id,
            'otp' => $otp,
            'expires_at' => $expiresAt,
            'type' => 'whatsapp',
        ]);

        // Send OTP via WhatsApp (using configured API)
        try {
            $whatsappSent = $this->sendWhatsAppMessage($phone, $otp);
            
            if ($whatsappSent) {
                return response()->json([
                    'error' => false,
                    'message' => __('OTP sent to your WhatsApp number.'),
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => __('Failed to send WhatsApp OTP. Please try Email OTP instead.'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => __('WhatsApp service unavailable. Please try Email OTP instead.'),
            ]);
        }
    }

    /**
     * Verify OTP and login
     */
    public function verifyOtpLogin(Request $request)
    {
        try {
            $request->validate([
                'otp' => 'required|string|size:6',
            ]);

            $otpData = $request->session()->get('login_otp');

            if (!$otpData) {
                return response()->json([
                    'error' => true,
                    'message' => __('OTP session expired. Please request a new OTP.'),
                ]);
            }

            // Validate required session data
            if (!isset($otpData['otp']) || !isset($otpData['type']) || !isset($otpData['expires_at'])) {
                \Log::error('Invalid OTP session data', ['otpData' => $otpData]);
                $request->session()->forget('login_otp');
                return response()->json([
                    'error' => true,
                    'message' => __('Invalid OTP session. Please request a new OTP.'),
                ]);
            }

            // Convert expires_at to Carbon if it's a string (session serialization issue)
            $expiresAt = $otpData['expires_at'];
            if (is_string($expiresAt)) {
                $expiresAt = Carbon::parse($expiresAt);
            } elseif (!$expiresAt instanceof Carbon) {
                $expiresAt = Carbon::parse($expiresAt);
            }

            // Check if OTP expired
            if (Carbon::now()->isAfter($expiresAt)) {
                $request->session()->forget('login_otp');
                return response()->json([
                    'error' => true,
                    'message' => __('OTP has expired. Please request a new one.'),
                ]);
            }

            // Verify OTP
            if ($otpData['otp'] !== $request->input('otp')) {
                return response()->json([
                    'error' => true,
                    'message' => __('Invalid OTP. Please try again.'),
                ]);
            }

            // Find account
            $account = null;
            if ($otpData['type'] === 'email') {
                if (!isset($otpData['email'])) {
                    \Log::error('Email missing in OTP session data', ['otpData' => $otpData]);
                    return response()->json([
                        'error' => true,
                        'message' => __('Invalid OTP session. Please request a new OTP.'),
                    ]);
                }
                $account = Account::where('email', $otpData['email'])->first();
            } else if ($otpData['type'] === 'whatsapp') {
                if (!isset($otpData['account_id'])) {
                    \Log::error('Account ID missing in WhatsApp OTP session data', ['otpData' => $otpData]);
                    return response()->json([
                        'error' => true,
                        'message' => __('Invalid OTP session. Please request a new OTP.'),
                    ]);
                }
                $account = Account::find($otpData['account_id']);
            } else {
                \Log::error('Invalid OTP type', ['type' => $otpData['type'] ?? 'missing']);
                return response()->json([
                    'error' => true,
                    'message' => __('Invalid OTP type. Please request a new OTP.'),
                ]);
            }

            if (!$account) {
                \Log::error('Account not found for OTP verification', ['otpData' => $otpData]);
                $request->session()->forget('login_otp');
                return response()->json([
                    'error' => true,
                    'message' => __('Account not found.'),
                ]);
            }

            // If email was not verified, set email_verified_at now (verify via OTP = verified)
            if ($account->email_verified_at === null) {
                $account->email_verified_at = Carbon::now();
                $account->confirmed_at = $account->confirmed_at ?? $account->email_verified_at;
                $account->save();
            }
            // If WhatsApp OTP used, set phone_verified_at
            if ($otpData['type'] === 'whatsapp') {
                $account->phone_verified_at = Carbon::now();
                $account->save();
            }

            // Clear OTP session
            $request->session()->forget('login_otp');

            // Login the user
            $this->guard()->login($account, true);

            return response()->json([
                'error' => false,
                'message' => __('Login successful!'),
                'redirect' => $this->getDashboardUrlForAccount($account),
            ]);
        } catch (\Exception $e) {
            \Log::error('OTP verification error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'otpData' => $request->session()->get('login_otp'),
            ]);
            
            return response()->json([
                'error' => true,
                'message' => __('An error occurred during OTP verification. Please try again.'),
            ], 500);
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $otpData = $request->session()->get('login_otp');

        if (!$otpData) {
            return response()->json([
                'error' => true,
                'message' => __('No active OTP session. Please start again.'),
            ]);
        }

        if ($otpData['type'] === 'email') {
            $request->merge(['email' => $otpData['email']]);
            return $this->sendEmailOtp($request);
        } else {
            $request->merge(['phone' => $otpData['phone']]);
            return $this->sendWhatsAppOtp($request);
        }
    }

    /**
     * Get the dashboard URL based on account type
     */
    protected function getDashboardUrlForAccount($account): string
    {
        if ($account && $account->isEmployer()) {
            return route('public.account.dashboard');
        }

        // Job seeker dashboard
        return route('public.account.jobseeker.dashboard');
    }

    /**
     * Send WhatsApp message using MSG Club API (Template-based)
     */
    protected function sendWhatsAppMessage(string $phone, string $otp): bool
    {
        // Get WhatsApp API configuration from settings or env
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL', 'https://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate'));
        $authKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY', '4625770ffb62853af287cedec7f50b0'));
        $senderId = setting('whatsapp_sender_id', env('WHATSAPP_SENDER_ID', '919039632383'));
        $templateName = setting('whatsapp_otp_template', env('WHATSAPP_OTP_TEMPLATE', 'otp_signup_login'));

        if (!$apiUrl || !$authKey) {
            \Log::error('WhatsApp API configuration missing');
            return false;
        }

        // Clean phone number (remove any non-numeric characters)
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Store original phone for logging
        $phoneWithCountryCode = $phone;
        $phoneWithoutCountryCode = $phone;
        
        // If phone has country code (starts with 91 and is 12 digits), extract 10 digits
        // According to API documentation, mobileNumbers and 'to' should be 10 digits without country code
        if (strlen($phone) == 12 && substr($phone, 0, 2) == '91') {
            $phoneWithoutCountryCode = substr($phone, 2); // Remove country code
            \Log::info('Extracted phone without country code for Login', [
                'with_country_code' => $phone,
                'without_country_code' => $phoneWithoutCountryCode,
            ]);
        } elseif (strlen($phone) == 10) {
            // Already 10 digits, no country code
            $phoneWithoutCountryCode = $phone;
            \Log::info('Phone is already 10 digits for Login', [
                'phone' => $phone,
            ]);
        } elseif (strlen($phone) < 10) {
            \Log::error('Phone number too short for Login', [
                'phone' => $phone,
                'length' => strlen($phone),
            ]);
            return false;
        } else {
            // If phone is longer than 12 digits or doesn't start with 91, try to extract last 10 digits
            $phoneWithoutCountryCode = substr($phone, -10);
            \Log::warning('Phone number format unexpected, using last 10 digits for Login', [
                'original' => $phone,
                'extracted' => $phoneWithoutCountryCode,
            ]);
        }
        
        // Use 10-digit phone number (without country code) for API
        $phone = $phoneWithoutCountryCode;

        try {
            // Prepare request body according to MSG Club API format
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
                                        'text' => $otp
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
                                        'text' => $otp
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

            // Make API call with AUTH_KEY as query parameter
            // Added timeout and retry mechanism for better reliability
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
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

            // Check if request was successful
            if ($response->successful()) {
                $responseData = $response->json();
                
                // Check response code (3001 seems to be success based on screenshot)
                if (isset($responseData['responseCode']) && $responseData['responseCode'] == '3001') {
                    \Log::info('WhatsApp OTP sent successfully', [
                        'phone' => $phone,
                        'response' => $responseData
                    ]);
                    return true;
                } else {
                    \Log::warning('WhatsApp API returned non-success response', [
                        'phone' => $phone,
                        'response' => $responseData
                    ]);
                    return false;
                }
            } else {
                \Log::error('WhatsApp API request failed', [
                    'phone' => $phone,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            \Log::error('WhatsApp API Error: ' . $e->getMessage(), [
                'phone' => $phone,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}