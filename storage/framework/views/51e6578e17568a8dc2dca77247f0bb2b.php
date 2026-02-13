<?php
    Theme::layout('without-navbar');
    Theme::asset()->add('auth-overrides', Theme::asset()->url('css/front-auth-overrides.css'), ['auth-css']);
?>

<style>
    .login-wrapper {
        min-height: 100vh;
        background: #f5f7fa;
        background-image: 
            radial-gradient(at 20% 30%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
            radial-gradient(at 80% 70%, rgba(67, 67, 67, 0.06) 0%, transparent 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .login-container {
        width: 100%;
        max-width: 500px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .login-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 25px 30px;
        text-align: center;
    }

    .login-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .login-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 0;
    }

    .login-body {
        padding: 30px;
    }

    /* Login Method Tabs */
    .login-methods {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
        background: #f5f7fa;
        padding: 6px;
        border-radius: 10px;
    }

    .login-method-btn {
        flex: 1;
        padding: 5px 5px;
        border: none;
        background: transparent;
        color: #666;
        font-size: 13px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .login-method-btn:hover {
        background: rgba(0, 115, 209, 0.1);
        color: #0073d1;
    }

    .login-method-btn.active {
        background: #0073d1;
        color: #fff;
    }

    .login-method-btn i {
        font-size: 16px;
    }

    /* Login Forms */
    .login-form-section {
        display: none;
    }

    .login-form-section.active {
        display: block;
    }

    .login-body .form-group {
        margin-bottom: 16px;
    }

    .login-body .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .login-body .form-control {
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 14px;
        height: 40px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .login-body .form-control:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .btn-login {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 15px;
        font-weight: 600;
        width: 100%;
        margin-top: 10px;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
        background: linear-gradient(135deg, #005bb5 0%, #004a94 100%);
    }

    .btn-login:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* OTP Input */
    .otp-input-group {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin: 20px 0;
    }

    .otp-input {
        width: 48px;
        height: 55px;
        text-align: center;
        font-size: 22px;
        font-weight: 700;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        outline: none;
        transition: all 0.3s ease;
    }

    .otp-input:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .otp-info {
        text-align: center;
        margin-bottom: 15px;
    }

    .otp-info p {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .otp-info .email-display {
        font-weight: 600;
        color: #0073d1;
    }

    .resend-otp {
        text-align: center;
        margin-top: 15px;
    }

    .resend-otp button {
        background: none;
        border: none;
        color: #0073d1;
        font-weight: 600;
        cursor: pointer;
    }

    .resend-otp button:disabled {
        color: #999;
        cursor: not-allowed;
    }

    /* Social Login Section */
    .social-login-divider {
        text-align: center;
        margin: 25px 0 20px;
        position: relative;
    }

    .social-login-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e0e0e0;
    }

    .social-login-divider span {
        background: #fff;
        padding: 0 15px;
        color: #888;
        font-size: 13px;
        position: relative;
    }

    .social-login-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .btn-social {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-google {
        background: #fff;
        border: 1.5px solid #e0e0e0;
        color: #434343;
    }

    .btn-google:hover {
        background: #f5f5f5;
        border-color: #ddd;
        color: #434343;
    }

    .btn-google img {
        width: 20px;
        height: 20px;
    }

    .login-footer {
        text-align: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-size: 14px;
        color: #666;
    }

    .login-footer a {
        color: #0073d1;
        font-weight: 600;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }

    /* Alert Messages */
    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Back button */
    .btn-back {
        background: none;
        border: none;
        color: #666;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 15px;
        padding: 0;
    }

    .btn-back:hover {
        color: #0073d1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-container {
            margin: 20px;
        }

        .login-header {
            padding: 20px;
        }

        .login-body {
            padding: 25px 20px;
        }

        .login-methods {
            flex-direction: column;
        }

        .otp-input {
            width: 42px;
            height: 48px;
            font-size: 18px;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-header">
            <h2><i class="ti ti-login me-2"></i>Welcome Back</h2>
            <p>Sign in to access your account</p>
        </div>
        
        <div class="login-body">
            <!-- Login Here Text -->
            <div style="text-align: center; margin-bottom: 18px;">
                <span style="font-size: 20px; font-weight: 700; color: #434343;">Login here</span>
            </div>

            <!-- Alert Messages -->
            <div id="login-alert" style="display: none;"></div>

            <?php if(session()->has('status')): ?>
                <div role="alert" class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php elseif(session()->has('auth_error_message')): ?>
                <div role="alert" class="alert alert-danger">
                    <?php echo e(session('auth_error_message')); ?>

                </div>
            <?php elseif(session()->has('auth_success_message')): ?>
                <div role="alert" class="alert alert-success">
                    <?php echo e(session('auth_success_message')); ?>

                </div>
            <?php endif; ?>

            <!-- Login Method Tabs -->
            <div class="login-methods" id="login-tabs">
                <button type="button" class="login-method-btn active" data-method="password">
                    With Password
                </button>
                <button type="button" class="login-method-btn" data-method="email-otp">
                    With Email OTP
                </button>
                <button type="button" class="login-method-btn" data-method="whatsapp-otp">
                    With WhatsApp OTP
                </button>
            </div>

            <!-- Password Login Form -->
            <div class="login-form-section active" id="password-login">
                <?php echo $form
                       ->modify('submit', 'submit', [
                            'label' => __('Sign In'),
                            'attr' => [
                                'class' => 'btn-login',
                            ],
                        ], true)
                       ->renderForm(); ?>

            </div>

            <!-- Email OTP Login Form -->
            <div class="login-form-section" id="email-otp-login">
                <div id="email-otp-step1">
                    <form id="email-otp-form">
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="otp-email" placeholder="Enter your registered email" required>
                        </div>
                        <button type="submit" class="btn-login" id="send-email-otp-btn">
                            <i class="ti ti-send me-2"></i>Send OTP to Email
                        </button>
                    </form>
                </div>

                <div id="email-otp-step2" style="display: none;">
                    <button type="button" class="btn-back" onclick="showEmailStep1()">
                        <i class="ti ti-arrow-left"></i> Change Email
                    </button>
                    <div class="otp-info">
                        <p>Enter the OTP sent to</p>
                        <span class="email-display" id="display-email"></span>
                    </div>
                    <form id="verify-email-otp-form">
                        <div class="otp-input-group">
                            <input type="text" class="otp-input" maxlength="1" data-index="0">
                            <input type="text" class="otp-input" maxlength="1" data-index="1">
                            <input type="text" class="otp-input" maxlength="1" data-index="2">
                            <input type="text" class="otp-input" maxlength="1" data-index="3">
                            <input type="text" class="otp-input" maxlength="1" data-index="4">
                            <input type="text" class="otp-input" maxlength="1" data-index="5">
                        </div>
                        <input type="hidden" name="otp" id="email-otp-value">
                        <button type="submit" class="btn-login" id="verify-email-otp-btn">
                            <i class="ti ti-check me-2"></i>Verify & Login
                        </button>
                    </form>
                    <div class="resend-otp">
                        <button type="button" id="resend-email-otp" disabled>Resend OTP in <span id="email-timer">60</span>s</button>
                    </div>
                </div>
            </div>

            <!-- WhatsApp OTP Login Form -->
            <div class="login-form-section" id="whatsapp-otp-login">
                <div id="whatsapp-otp-step1">
                    <form id="whatsapp-otp-form">
                        <div class="form-group">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="tel" class="form-control" name="phone" id="otp-phone" placeholder="Enter your registered WhatsApp number" required>
                        </div>
                        <button type="submit" class="btn-login" id="send-whatsapp-otp-btn">
                            <i class="ti ti-brand-whatsapp me-2"></i>Send OTP to WhatsApp
                        </button>
                    </form>
                </div>

                <div id="whatsapp-otp-step2" style="display: none;">
                    <button type="button" class="btn-back" onclick="showWhatsAppStep1()">
                        <i class="ti ti-arrow-left"></i> Change Number
                    </button>
                    <div class="otp-info">
                        <p>Enter the OTP sent to WhatsApp</p>
                        <span class="email-display" id="display-phone"></span>
                    </div>
                    <form id="verify-whatsapp-otp-form">
                        <div class="otp-input-group" id="whatsapp-otp-inputs">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="0">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="1">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="2">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="3">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="4">
                            <input type="text" class="otp-input wa-otp" maxlength="1" data-index="5">
                        </div>
                        <input type="hidden" name="otp" id="whatsapp-otp-value">
                        <button type="submit" class="btn-login" id="verify-whatsapp-otp-btn">
                            <i class="ti ti-check me-2"></i>Verify & Login
                        </button>
                    </form>
                    <div class="resend-otp">
                        <button type="button" id="resend-whatsapp-otp" disabled>Resend OTP in <span id="whatsapp-timer">60</span>s</button>
                    </div>
                </div>
            </div>

            <!-- Social Login -->
            <div class="social-login-divider">
                <span>or continue with</span>
            </div>

            <div class="social-login-buttons">
                
                <?php if(defined('SOCIAL_LOGIN_MODULE_SCREEN_NAME') && app(\Botble\SocialLogin\Supports\SocialService::class)->getProviderEnabled('google')): ?>
                    <a href="<?php echo e(route('auth.social', ['provider' => 'google', 'guard' => 'account', 'model' => \Botble\JobBoard\Models\Account::class])); ?>" class="btn-social btn-google">
                        <svg width="20" height="20" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/><path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/><path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/><path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/></svg>
                        Sign in with Google
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('auth.social', ['provider' => 'google'])); ?>" class="btn-social btn-google">
                        <svg width="20" height="20" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/><path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/><path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/><path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/></svg>
                        Sign in with Google
                    </a>
                <?php endif; ?>

                
                <?php if(defined('SOCIAL_LOGIN_MODULE_SCREEN_NAME') && app(\Botble\SocialLogin\Supports\SocialService::class)->getProviderEnabled('facebook')): ?>
                    <a href="<?php echo e(route('auth.social', ['provider' => 'facebook', 'guard' => 'account', 'model' => \Botble\JobBoard\Models\Account::class])); ?>" class="btn-social btn-facebook" style="background: #1877f2; color: #fff; border: none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Sign in with Facebook
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = '<?php echo e(csrf_token()); ?>';
    
    // Tab switching
    const tabs = document.querySelectorAll('.login-method-btn');
    const sections = document.querySelectorAll('.login-form-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const method = this.dataset.method;
            
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            sections.forEach(s => s.classList.remove('active'));
            
            if (method === 'password') {
                document.getElementById('password-login').classList.add('active');
            } else if (method === 'email-otp') {
                document.getElementById('email-otp-login').classList.add('active');
            } else if (method === 'whatsapp-otp') {
                document.getElementById('whatsapp-otp-login').classList.add('active');
            }
        });
    });

    // OTP Input handling
    function setupOtpInputs(inputs, hiddenInput) {
        inputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const value = e.target.value;
                if (value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateOtpValue(inputs, hiddenInput);
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const paste = (e.clipboardData || window.clipboardData).getData('text');
                const digits = paste.replace(/\D/g, '').split('').slice(0, 6);
                digits.forEach((digit, i) => {
                    if (inputs[i]) {
                        inputs[i].value = digit;
                    }
                });
                updateOtpValue(inputs, hiddenInput);
                if (digits.length > 0) {
                    inputs[Math.min(digits.length, inputs.length - 1)].focus();
                }
            });
        });
    }

    function updateOtpValue(inputs, hiddenInput) {
        const otp = Array.from(inputs).map(i => i.value).join('');
        hiddenInput.value = otp;
    }

    const emailOtpInputs = document.querySelectorAll('#email-otp-step2 .otp-input');
    setupOtpInputs(emailOtpInputs, document.getElementById('email-otp-value'));

    const whatsappOtpInputs = document.querySelectorAll('#whatsapp-otp-inputs .otp-input');
    setupOtpInputs(whatsappOtpInputs, document.getElementById('whatsapp-otp-value'));

    // Show alert
    function showAlert(message, type = 'danger') {
        const alertDiv = document.getElementById('login-alert');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        alertDiv.style.display = 'block';
        setTimeout(() => alertDiv.style.display = 'none', 5000);
    }

    // Timer function
    function startTimer(timerElement, buttonElement, seconds = 60) {
        let remaining = seconds;
        buttonElement.disabled = true;
        
        const interval = setInterval(() => {
            remaining--;
            timerElement.textContent = remaining;
            
            if (remaining <= 0) {
                clearInterval(interval);
                buttonElement.disabled = false;
                buttonElement.innerHTML = 'Resend OTP';
            }
        }, 1000);
    }

    // Email OTP Form
    document.getElementById('email-otp-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const email = document.getElementById('otp-email').value;
        const btn = document.getElementById('send-email-otp-btn');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="ti ti-loader me-2"></i>Sending...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.sendEmailOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (data.error) {
                showAlert(data.message);
            } else {
                document.getElementById('display-email').textContent = email;
                document.getElementById('email-otp-step1').style.display = 'none';
                document.getElementById('email-otp-step2').style.display = 'block';
                emailOtpInputs[0].focus();
                startTimer(document.getElementById('email-timer'), document.getElementById('resend-email-otp'));
                showAlert(data.message, 'success');
            }
        } catch (error) {
            showAlert('An error occurred. Please try again.');
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-send me-2"></i>Send OTP to Email';
    });

    // WhatsApp OTP Form
    document.getElementById('whatsapp-otp-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const phone = document.getElementById('otp-phone').value;
        const btn = document.getElementById('send-whatsapp-otp-btn');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="ti ti-loader me-2"></i>Sending...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.sendWhatsAppOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ phone })
            });

            const data = await response.json();

            if (data.error) {
                showAlert(data.message);
            } else {
                document.getElementById('display-phone').textContent = phone;
                document.getElementById('whatsapp-otp-step1').style.display = 'none';
                document.getElementById('whatsapp-otp-step2').style.display = 'block';
                whatsappOtpInputs[0].focus();
                startTimer(document.getElementById('whatsapp-timer'), document.getElementById('resend-whatsapp-otp'));
                showAlert(data.message, 'success');
            }
        } catch (error) {
            showAlert('An error occurred. Please try again.');
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-brand-whatsapp me-2"></i>Send OTP to WhatsApp';
    });

    // Verify Email OTP
    document.getElementById('verify-email-otp-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const otp = document.getElementById('email-otp-value').value;
        const btn = document.getElementById('verify-email-otp-btn');

        if (otp.length !== 6) {
            showAlert('Please enter the complete 6-digit OTP');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="ti ti-loader me-2"></i>Verifying...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.verifyOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ otp })
            });

            const data = await response.json();

            if (data.error) {
                showAlert(data.message);
            } else {
                showAlert(data.message, 'success');
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            }
        } catch (error) {
            showAlert('An error occurred. Please try again.');
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-check me-2"></i>Verify & Login';
    });

    // Verify WhatsApp OTP
    document.getElementById('verify-whatsapp-otp-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const otp = document.getElementById('whatsapp-otp-value').value;
        const btn = document.getElementById('verify-whatsapp-otp-btn');

        if (otp.length !== 6) {
            showAlert('Please enter the complete 6-digit OTP');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="ti ti-loader me-2"></i>Verifying...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.verifyOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ otp })
            });

            const data = await response.json();

            if (data.error) {
                showAlert(data.message);
            } else {
                showAlert(data.message, 'success');
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            }
        } catch (error) {
            showAlert('An error occurred. Please try again.');
        }

        btn.disabled = false;
        btn.innerHTML = '<i class="ti ti-check me-2"></i>Verify & Login';
    });

    // Resend OTP handlers
    document.getElementById('resend-email-otp').addEventListener('click', async function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = 'Sending...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.resendOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            showAlert(data.message, data.error ? 'danger' : 'success');
            
            if (!data.error) {
                startTimer(document.getElementById('email-timer'), btn);
            }
        } catch (error) {
            showAlert('Failed to resend OTP');
            btn.disabled = false;
            btn.innerHTML = 'Resend OTP';
        }
    });

    document.getElementById('resend-whatsapp-otp').addEventListener('click', async function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = 'Sending...';

        try {
            const response = await fetch('<?php echo e(route("public.account.login.resendOtp")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            showAlert(data.message, data.error ? 'danger' : 'success');
            
            if (!data.error) {
                startTimer(document.getElementById('whatsapp-timer'), btn);
            }
        } catch (error) {
            showAlert('Failed to resend OTP');
            btn.disabled = false;
            btn.innerHTML = 'Resend OTP';
        }
    });
});

// Step navigation functions
function showEmailStep1() {
    document.getElementById('email-otp-step1').style.display = 'block';
    document.getElementById('email-otp-step2').style.display = 'none';
    document.querySelectorAll('#email-otp-step2 .otp-input').forEach(i => i.value = '');
}

function showWhatsAppStep1() {
    document.getElementById('whatsapp-otp-step1').style.display = 'block';
    document.getElementById('whatsapp-otp-step2').style.display = 'none';
    document.querySelectorAll('#whatsapp-otp-inputs .otp-input').forEach(i => i.value = '');
}
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/auth/login.blade.php ENDPATH**/ ?>