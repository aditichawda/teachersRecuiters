@php
    Theme::layout('without-navbar');
@endphp

<style>
/* ===== Verify Email Page Styles ===== */
.verify-email-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4f8 0%, #e8f4fc 50%, #f5f7fa 100%);
    margin: 0;
    padding: 0;
}

.verify-email-page .container-fluid {
    padding: 0 !important;
    margin: 0 !important;
}

.tr-auth-left-panel {
    background: #0073d1 !important;
    position: relative;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    padding: 40px;
    overflow: hidden;
    min-height: 100vh;
}

.tr-auth-curve {
    position: absolute;
    right: -1px;
    top: 0;
    height: 100%;
    width: 150px;
    z-index: 10;
}

.tr-auth-left-content {
    position: relative;
    z-index: 5;
    color: #fff;
    padding-right: 80px;
}

.tr-auth-logo {
    margin-bottom: 30px;
}

.tr-auth-logo img {
    max-width: 180px;
    filter: brightness(0) invert(1);
}

.tr-auth-illustration {
    margin: 30px 0;
}

.tr-auth-illustration svg {
    width: 100%;
    max-width: 300px;
}

.tr-auth-step-info {
    margin-top: 30px;
}

.tr-auth-step-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 15px;
    color: #fff;
}

.tr-auth-step-info h3 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 10px 0;
    color: #fff;
}

.tr-auth-step-info p {
    font-size: 14px;
    opacity: 0.85;
    margin: 0;
    line-height: 1.6;
    color: #fff;
}

.tr-auth-right-panel {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 60px;
    background: #fff !important;
    min-height: 100vh;
}

.tr-auth-form-container {
    width: 100%;
    max-width: 450px;
}

.tr-auth-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.tr-verify-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #0073d1 0%, #005ba8 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.tr-verify-icon i {
    font-size: 32px;
    color: #fff;
}

.tr-auth-form-header h1 {
    color: #0073d1;
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.tr-auth-form-header p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

.tr-email-display {
    color: #0073d1 !important;
    font-weight: 600 !important;
    font-size: 16px !important;
}

/* OTP Input */
.tr-otp-container {
    margin-bottom: 25px;
}

.tr-otp-inputs {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.tr-otp-input {
    width: 55px;
    height: 60px;
    border: 2px solid #e8f4fc;
    border-radius: 12px;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    color: #0073d1;
    background: #f8fbfd;
    transition: all 0.3s;
}

.tr-otp-input:focus {
    border-color: #0073d1;
    background: #fff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,0.15);
}

.tr-otp-input.filled {
    border-color: #0073d1;
    background: #e8f4fc;
}

.tr-otp-input.error {
    border-color: #dc3545;
    background: #fff5f5;
}

.tr-error-text {
    color: #dc3545;
    font-size: 13px;
    margin-top: 10px;
    text-align: center;
    display: none;
}

.tr-error-text.show {
    display: block;
}

/* Resend Section */
.tr-resend-section {
    text-align: center;
    margin-bottom: 25px;
}

.tr-resend-text {
    color: #666;
    font-size: 14px;
}

.tr-resend-btn {
    background: none;
    border: none;
    color: #0073d1;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    padding: 0;
    margin-left: 5px;
}

.tr-resend-btn:hover {
    text-decoration: underline;
}

.tr-resend-btn:disabled {
    color: #999;
    cursor: not-allowed;
}

.tr-resend-timer {
    color: #999;
    font-size: 14px;
    margin-left: 5px;
}

/* Buttons */
.tr-form-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-top: 25px;
}

.tr-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 25px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    color: #666;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s;
    background: #fff;
}

.tr-btn-outline:hover {
    border-color: #0073d1;
    color: #0073d1;
    text-decoration: none;
}

.tr-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 30px;
    background: #0073d1;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
}

.tr-btn-primary:hover {
    background: #005ba8;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0,115,209,0.3);
}

.tr-btn-primary:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.tr-form-footer {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: #666;
}

.tr-form-footer a {
    color: #0073d1;
    font-weight: 600;
    text-decoration: none;
}

.tr-form-footer a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 991px) {
    .tr-auth-right-panel {
        padding: 30px 20px;
    }
}

@media (max-width: 767px) {
    .tr-auth-form-header h1 {
        font-size: 24px;
    }
    
    .tr-otp-input {
        width: 45px;
        height: 50px;
        font-size: 20px;
    }
    
    .tr-form-buttons {
        flex-direction: column;
    }
    
    .tr-btn-outline, .tr-btn-primary {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="section-full tr-auth-page verify-email-page" style="margin:0;padding:0;">
    <div class="container-fluid" style="padding:0;margin:0;">
        <div class="row g-0" style="min-height:100vh;">
            <!-- Left Panel - Blue with illustration -->
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-flex tr-auth-left-panel" style="background:#0073d1 !important;">
                <!-- Curve SVG -->
                <svg class="tr-auth-curve" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M100,0 L100,100 L30,100 Q-30,50 30,0 Z" fill="#ffffff"/>
                </svg>
                
                <!-- Content -->
                <div class="tr-auth-left-content">
                    @if (Theme::getLogo())
                        <div class="tr-auth-logo">
                            {!! Theme::getLogoImage(['class' => 'logo-light'], 'logo', 150) !!}
                        </div>
                    @endif
                    
                    <div class="tr-auth-illustration">
                        <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Email/Verification illustration -->
                            <rect x="80" y="80" width="240" height="160" rx="15" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                            <!-- Envelope flap -->
                            <path d="M80 80 L200 160 L320 80" stroke="rgba(255,255,255,0.4)" stroke-width="2" fill="none"/>
                            <!-- Shield/Check -->
                            <circle cx="200" cy="180" r="40" fill="rgba(255,255,255,0.3)"/>
                            <path d="M180 180 L195 195 L225 165" stroke="#fff" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            <!-- Stars -->
                            <circle cx="100" cy="60" r="5" fill="rgba(255,255,255,0.5)"/>
                            <circle cx="300" cy="70" r="4" fill="rgba(255,255,255,0.4)"/>
                            <circle cx="330" cy="120" r="3" fill="rgba(255,255,255,0.3)"/>
                        </svg>
                    </div>
                    
                    <div class="tr-auth-step-info">
                        <span class="tr-auth-step-badge">Step 1 of 3</span>
                        <h3>Verify Your Email</h3>
                        <p>We've sent a verification code to your email. Enter it below to continue.</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel - Form -->
            <div class="col-xl-7 col-lg-7 col-md-7 tr-auth-right-panel" style="background:#fff !important;">
                <div class="tr-auth-form-container">
                    <div class="tr-auth-form-header">
                        <div class="tr-verify-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <h1>Email Verification</h1>
                        <p>Enter the 6-digit code sent to</p>
                        <p class="tr-email-display" id="verification-email-display">{{ $email }}</p>
                    </div>
                    
                    <div class="tr-otp-container">
                        <!-- OTP Input Boxes -->
                        <div class="tr-otp-inputs">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="0" inputmode="numeric" pattern="[0-9]">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="1" inputmode="numeric" pattern="[0-9]">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="2" inputmode="numeric" pattern="[0-9]">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="3" inputmode="numeric" pattern="[0-9]">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="4" inputmode="numeric" pattern="[0-9]">
                            <input type="text" class="tr-otp-input" maxlength="1" data-index="5" inputmode="numeric" pattern="[0-9]">
                        </div>
                        <input type="hidden" id="verification-code-input" value="">
                        <div id="verification-code-error" class="tr-error-text"></div>
                    </div>
                    
                    <div class="tr-resend-section">
                        <span class="tr-resend-text">Didn't receive the code?</span>
                        <button type="button" class="tr-resend-btn" id="resend-code-btn">
                            Resend Code
                        </button>
                        <span class="tr-resend-timer" id="resend-timer" style="display:none;">
                            Resend in <span id="timer-count">60</span>s
                        </span>
                    </div>
                    
                    <div class="tr-form-buttons">
                        <a href="{{ route('public.account.register') }}" class="tr-btn-outline">
                            ← Back
                        </a>
                        <button type="button" class="tr-btn-primary" id="verify-code-btn">
                            Verify & Continue →
                        </button>
                    </div>
                    
                    <div class="tr-form-footer">
                        Already have an account? <a href="{{ route('public.account.login') }}">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    
    const email = @json($email);
    const verifyEmailCodeUrl = '{{ route("public.account.register.verifyEmailCode") }}';
    const sendVerificationCodeUrl = '{{ route("public.account.register.sendVerificationCode") }}';
    const csrfToken = '{{ csrf_token() }}';
    
    document.addEventListener('DOMContentLoaded', function() {
        const otpInputs = document.querySelectorAll('.tr-otp-input');
        const hiddenInput = document.getElementById('verification-code-input');
        const verifyBtn = document.getElementById('verify-code-btn');
        const resendBtn = document.getElementById('resend-code-btn');
        const errorDiv = document.getElementById('verification-code-error');
        
        // OTP Input handling
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const value = e.target.value.replace(/[^0-9]/g, '');
                e.target.value = value;
                
                if (value) {
                    e.target.classList.add('filled');
                    // Move to next input
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }
                
                // Update hidden input
                updateHiddenInput();
            });
            
            input.addEventListener('keydown', function(e) {
                // Handle backspace
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
            
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                
                for (let i = 0; i < pastedData.length && i < otpInputs.length; i++) {
                    otpInputs[i].value = pastedData[i];
                    otpInputs[i].classList.add('filled');
                }
                
                updateHiddenInput();
                
                // Focus last filled or next empty
                const lastIndex = Math.min(pastedData.length, otpInputs.length) - 1;
                if (lastIndex >= 0) {
                    otpInputs[Math.min(lastIndex + 1, otpInputs.length - 1)].focus();
                }
            });
        });
        
        function updateHiddenInput() {
            let code = '';
            otpInputs.forEach(input => {
                code += input.value;
            });
            hiddenInput.value = code;
        }
        
        // Verify button click
        verifyBtn.addEventListener('click', function() {
            const code = hiddenInput.value;
            
            if (code.length !== 6) {
                showError('Please enter a valid 6-digit code');
                return;
            }
            
            // Show loading
            verifyBtn.innerHTML = 'Verifying...';
            verifyBtn.disabled = true;
            hideError();
            
            fetch(verifyEmailCodeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    code: code
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.error === false) {
                    // Redirect to institution type page
                    window.location.href = '{{ route("public.account.register.institutionTypePage") }}';
                } else {
                    showError(data.message || 'Invalid verification code');
                    verifyBtn.innerHTML = 'Verify & Continue →';
                    verifyBtn.disabled = false;
                    
                    // Shake animation
                    otpInputs.forEach(input => {
                        input.classList.add('error');
                        setTimeout(() => input.classList.remove('error'), 1000);
                    });
                }
            })
            .catch(err => {
                console.error('Verify error:', err);
                showError('Verification failed. Please try again.');
                verifyBtn.innerHTML = 'Verify & Continue →';
                verifyBtn.disabled = false;
            });
        });
        
        // Resend button click
        resendBtn.addEventListener('click', function() {
            resendBtn.disabled = true;
            
            // Get saved form data
            const savedData = localStorage.getItem('registrationFormData');
            let formData = {};
            if (savedData) {
                try {
                    formData = JSON.parse(savedData);
                } catch(e) {}
            }
            
            const sendData = new FormData();
            sendData.append('_token', csrfToken);
            sendData.append('email', email);
            Object.keys(formData).forEach(key => {
                if (formData[key] !== null && formData[key] !== undefined) {
                    sendData.append('form_data[' + key + ']', formData[key]);
                }
            });
            
            fetch(sendVerificationCodeUrl, {
                method: 'POST',
                body: sendData
            })
            .then(res => res.json())
            .then(data => {
                if (data.error === false) {
                    alert('Verification code resent successfully!');
                    startTimer();
                } else {
                    alert(data.message || 'Failed to resend code');
                    resendBtn.disabled = false;
                }
            })
            .catch(err => {
                console.error('Resend error:', err);
                alert('Failed to resend code');
                resendBtn.disabled = false;
            });
        });
        
        function showError(msg) {
            errorDiv.textContent = msg;
            errorDiv.classList.add('show');
        }
        
        function hideError() {
            errorDiv.textContent = '';
            errorDiv.classList.remove('show');
        }
        
        function startTimer() {
            let seconds = 60;
            const timerEl = document.getElementById('resend-timer');
            const countEl = document.getElementById('timer-count');
            
            resendBtn.style.display = 'none';
            timerEl.style.display = 'inline';
            
            const interval = setInterval(() => {
                seconds--;
                countEl.textContent = seconds;
                
                if (seconds <= 0) {
                    clearInterval(interval);
                    timerEl.style.display = 'none';
                    resendBtn.style.display = 'inline';
                    resendBtn.disabled = false;
                }
            }, 1000);
        }
        
        // Focus first input on load
        otpInputs[0].focus();
    });
})();
</script>
