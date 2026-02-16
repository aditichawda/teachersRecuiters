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
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers, LogoutGuardTrait {
        AuthenticatesUsers::attemptLogin as baseAttemptLogin;
    }

    public string $redirectTo = '/';

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

        return Theme::scope('job-board.auth.login', ['form' => LoginForm::create()], 'plugins/job-board::themes.auth.login')->render();
    }

    protected function guard()
    {
        return auth('account');
    }

    public function login(LoginRequest $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            // Redirect based on account type
            $account = $this->guard()->user();
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
        if ($this->guard()->validate($this->credentials($request))) {
            $account = $this->guard()->getLastAttempted();

            if (setting('verify_account_email', 0) && empty($account->confirmed_at)) {
                throw ValidationException::withMessages([
                    'confirmation' => [
                        trans('plugins/job-board::account.not_confirmed', [
                            'resend_link' => route(
                                'public.account.resend_confirmation',
                                ['email' => $account->email]
                            ),
                        ]),
                    ],
                ]);
            }

            return $this->baseAttemptLogin($request);
        }

        return false;
    }

    public function logout(Request $request)
    {
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

        $this->loggedOut($request);

        return redirect()->to(route('public.index'));
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
            $whatsappSent = $this->sendWhatsAppMessage($phone, "Your Teachers Recruiter login OTP is: {$otp}. Valid for 10 minutes.");
            
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

        // Check if OTP expired
        if (Carbon::now()->isAfter($otpData['expires_at'])) {
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
            $account = Account::where('email', $otpData['email'])->first();
        } else if ($otpData['type'] === 'whatsapp') {
            $account = Account::find($otpData['account_id']);
        }

        if (!$account) {
            return response()->json([
                'error' => true,
                'message' => __('Account not found.'),
            ]);
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
     * Send WhatsApp message using configured API
     */
    protected function sendWhatsAppMessage(string $phone, string $message): bool
    {
        // Get WhatsApp API configuration from settings
        $apiUrl = setting('whatsapp_api_url', env('WHATSAPP_API_URL'));
        $apiKey = setting('whatsapp_api_key', env('WHATSAPP_API_KEY'));
        $instanceId = setting('whatsapp_instance_id', env('WHATSAPP_INSTANCE_ID'));

        if (!$apiUrl || !$apiKey) {
            // If no WhatsApp API configured, return false
            return false;
        }

        try {
            // Generic WhatsApp API format (adjust based on your provider)
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'phone' => $phone,
                'message' => $message,
                'instance_id' => $instanceId,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            \Log::error('WhatsApp API Error: ' . $e->getMessage());
            return false;
        }
    }
}
