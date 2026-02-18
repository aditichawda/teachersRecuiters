@php
    Theme::layout('without-navbar');
@endphp

<style>
    .verify-wrapper {
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

    .verify-container {
        width: 100%;
        max-width: 520px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .verify-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 24px 30px;
        text-align: center;
    }

    .verify-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .verify-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 0;
    }

    .verify-body {
        padding: 30px;
    }

    /* Step Indicator */
    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #999;
        font-size: 12px;
        white-space: nowrap;
    }

    .step.active {
        color: #0073d1;
        font-weight: 600;
    }

    .step.completed {
        color: #10b981;
    }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #666;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #10b981;
        color: #fff;
    }

    /* Email Display Box */
    .email-display-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 16px;
        text-align: center;
        margin-bottom: 20px;
    }

    .email-display-box p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .email-display-box .email {
        color: #0073d1;
        font-weight: 600;
        font-size: 14px;
    }

    /* OTP Instructions */
    .otp-instructions {
        text-align: center;
        color: #64748b;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* OTP Input */
    .otp-container {
        margin-bottom: 20px;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .otp-input {
        width: 48px;
        height: 52px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        text-align: center;
        font-size: 22px;
        font-weight: 500;
        color: black;
        background: #fff;
        transition: all 0.3s;
    }

    .otp-input:focus {
        border-color: #0073d1;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.15);
    }

    .otp-input.filled {
        border-color:rgb(111, 180, 236);
        background: #f0f7ff;
    }

    .otp-input.error {
        border-color: #dc3545;
        background: #fff5f5;
    }

    .error-text {
        color: #dc3545;
        font-size: 13px;
        margin-top: 10px;
        text-align: center;
        display: none;
    }

    .error-text.show {
        display: block;
    }

    /* In-form success message (form ke sath, upar alag toast nahi) */
    .verify-inline-success {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 20px;
    }
    .verify-inline-success .msg-icon {
        color: #059669;
        font-size: 20px;
        flex-shrink: 0;
    }
    .verify-inline-success .msg-text {
        color: #047857;
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
        flex: 1;
    }
    .verify-inline-success .msg-close {
        background: none;
        border: none;
        color: #059669;
        cursor: pointer;
        padding: 0 4px;
        font-size: 18px;
        line-height: 1;
        opacity: 0.8;
    }
    .verify-inline-success .msg-close:hover {
        opacity: 1;
    }

    /* Verify Button */
    .verify-btn {
        width: 100%;
        padding: 8px 0px;
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 20px;
    }

    .verify-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .verify-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Resend Section */
    .resend-section {
        text-align: center;
        margin-bottom: 15px;
    }

    .resend-section span {
        color: #64748b;
        font-size: 14px;
    }

    .resend-btn {
        background: none;
        border: none;
        color: #0073d1;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        padding: 0;
        margin-left: 4px;
    }

    .resend-btn:hover {
        text-decoration: underline;
    }

    .resend-btn:disabled {
        color: #94a3b8;
        cursor: not-allowed;
    }

    /* Back Link */
    .back-link {
        text-align: center;
    }

    .back-link a {
        color: #64748b;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.3s;
    }

    .back-link a:hover {
        color: #0073d1;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .verify-wrapper {
            padding: 20px 15px;
        }

        .verify-container {
            max-width: 520px;
            border-radius: 12px;
        }

        .verify-header {
            padding: 20px;
        }

        .verify-header h2 {
            font-size: 20px;
        }

        .verify-body {
            padding: 24px 20px;
        }

        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }

        .otp-input {
            width: 42px;
            height: 48px;
            font-size: 18px;
        }
    }

    @media (max-width: 450px) {
        .step span:last-child { display: none; }
    }
</style>

<div class="verify-wrapper">
    <div class="verify-container">
        <div class="verify-header">
            @if(!empty($isWhatsappAvailable) && !empty($phone))
                <h2>Verify Your Account</h2>
                <p>Step 2 of 4 - WhatsApp & Email Verification</p>
            @else
                <h2>Verify Your Email</h2>
                <p>Step 2 of 4 - Email Verification</p>
            @endif
        </div>
        
        <div class="verify-body">
            <!-- Step Indicator - 4 Steps -->
            <div class="step-indicator">
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Basic Details</span>
                </div>
                <div class="step active">
                    <span class="step-number">2</span>
                    <span>Verification</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span>Add Preferences & Resume</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <!-- Success message form ke andar (toast upar alag nahi) -->
            <div id="verify-form-success-msg" class="verify-inline-success" style="display: none;" role="alert">
                <span class="msg-icon"><i class="ti ti-circle-check" style="font-size: 22px;"></i></span>
                <p class="msg-text" id="verify-form-success-text"></p>
                <button type="button" class="msg-close" id="verify-form-success-close" aria-label="Close">&times;</button>
            </div>

            <!-- Email/WhatsApp Display Box -->
            @if(!empty($isWhatsappAvailable) && !empty($phone))
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 16px; margin-bottom: 18px; text-align: center;">
                    <p style="margin: 0; color: #555; font-size: 13px;">
                        Verification code sent to: <i class="ti ti-brand-whatsapp" style="color: #25D366; font-size: 15px; vertical-align: middle;"></i> <strong style="color: #333;">{{ $phone }}</strong> & <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong id="verification-email-display" style="color: #333;">{{ $email }}</strong>
                    </p>
                </div>
                <p class="otp-instructions">Enter the 6-digit code sent to your WhatsApp & Email</p>
            @else
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 16px; margin-bottom: 18px; text-align: center;">
                    <p style="margin: 0; color: #555; font-size: 13px;">
                        Verification code sent to: <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong id="verification-email-display" style="color: #333;">{{ $email }}</strong>
                    </p>
                </div>
                <p class="otp-instructions">Enter the 6-digit code sent to your email</p>
            @endif
            
            <!-- OTP Input -->
            <div class="otp-container">
                <div class="otp-inputs">
                    <input type="text" class="otp-input" maxlength="1" data-index="0" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    <input type="text" class="otp-input" maxlength="1" data-index="1" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    <input type="text" class="otp-input" maxlength="1" data-index="2" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    <input type="text" class="otp-input" maxlength="1" data-index="3" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    <input type="text" class="otp-input" maxlength="1" data-index="4" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                    <input type="text" class="otp-input" maxlength="1" data-index="5" inputmode="numeric" pattern="[0-9]" autocomplete="off">
                </div>
                <input type="hidden" id="verification-code-input" value="">
                <div id="verification-code-error" class="error-text"></div>
            </div>
            
            <!-- Verify Button -->
            <button type="button" class="verify-btn" id="verify-code-btn">Verify & Continue</button>
            
            <!-- Resend Section -->
            <div class="resend-section">
                @if(!empty($isWhatsappAvailable) && !empty($phone))
                    <span>Didn't receive the code on WhatsApp or Email?</span>
                @else
                    <span>Didn't receive the code?</span>
                @endif
                <button type="button" class="resend-btn" id="resend-code-btn">Resend Code</button>
                <span id="resend-timer" style="display:none;color:#94a3b8;">
                    Resend in <span id="timer-count">60</span>s
                </span>
            </div>
            
            <!-- Back Link -->
            <div class="back-link">
                <a href="{{ route('public.account.register') }}">Back to Registration</a>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    function showToast(type, msg) {
        if (typeof window.showAlert === 'function') {
            window.showAlert(type, msg);
            return;
        }
        var container = document.getElementById('alert-container');
        if (!container) {
            container = document.createElement('div');
            container.id = 'alert-container';
            container.className = 'toast-container';
            container.style.cssText = 'position:fixed;right:5px;top:20vh;z-index:9999999;';
            document.body.appendChild(container);
        }
        var id = 'toast-' + Math.floor(Math.random() * 10000);
        var icon = type === 'text-success' ? 'feather-check-circle' : 'feather-alert-triangle';
        var html = '<div class="toast align-items-center ' + type + '" id="' + id + '" role="alert">' +
            '<div class="d-flex"><div class="toast-body">' +
            '<i class="' + icon + ' message-icon"></i><span>' + (msg || '').replace(/</g, '&lt;') + '</span>' +
            '</div><button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>';
        container.insertAdjacentHTML('beforeend', html);
        var el = document.getElementById(id);
        if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
            var toast = new bootstrap.Toast(el);
            toast.show();
            el.addEventListener('hidden.bs.toast', function() { el.remove(); });
        } else {
            el.classList.add('show');
            setTimeout(function() { el.remove(); }, 5000);
        }
    }

    const email = @json($email);
    const verifyEmailCodeUrl = '{{ route("public.account.register.verifyEmailCode") }}';
    const sendVerificationCodeUrl = '{{ route("public.account.register.sendVerificationCode") }}';
    const csrfToken = '{{ csrf_token() }}';
    
    document.addEventListener('DOMContentLoaded', function() {
        const otpInputs = document.querySelectorAll('.otp-input');
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
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }
                
                updateHiddenInput();
            });
            
            input.addEventListener('keydown', function(e) {
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
                    window.location.href = '{{ route("public.account.register.institutionTypePage") }}';
                } else {
                    showError(data.message || 'Invalid verification code');
                    verifyBtn.innerHTML = 'Verify & Continue';
                    verifyBtn.disabled = false;
                    
                    otpInputs.forEach(input => {
                        input.classList.add('error');
                        setTimeout(() => input.classList.remove('error'), 1000);
                    });
                }
            })
            .catch(err => {
                showError('Verification failed. Please try again.');
                verifyBtn.innerHTML = 'Verify & Continue';
                verifyBtn.disabled = false;
            });
        });
        
        // Resend button click
        resendBtn.addEventListener('click', function() {
            resendBtn.disabled = true;
            
            const savedData = localStorage.getItem('registrationFormData');
            let formData = {};
            if (savedData) {
                try { formData = JSON.parse(savedData); } catch(e) {}
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
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: sendData
            })
            .then(res => res.json())
            .then(data => {
                if (data.error === false) {
                    successTextEl.textContent = @if(!empty($isWhatsappAvailable) && !empty($phone))
                        'Verification code resent successfully to your WhatsApp & Email. Please enter the new 6-digit code below.';
                    @else
                        'Verification code resent successfully to your Email. Please enter the new 6-digit code below.';
                    @endif
                    successMsgEl.style.display = 'flex';
                    successMsgEl.style.background = '#ecfdf5';
                    successMsgEl.style.borderColor = '#a7f3d0';
                    successTextEl.style.color = '#047857';
                    startTimer();
                } else {
                    successTextEl.textContent = data.message || 'Failed to resend code';
                    successMsgEl.style.display = 'flex';
                    successMsgEl.style.background = '#fef2f2';
                    successMsgEl.style.borderColor = '#fecaca';
                    successTextEl.style.color = '#b91c1c';
                    resendBtn.disabled = false;
                }
            })
            .catch(err => {
                successTextEl.textContent = 'Failed to resend code';
                successMsgEl.style.display = 'flex';
                successMsgEl.style.background = '#fef2f2';
                successMsgEl.style.borderColor = '#fecaca';
                successTextEl.style.color = '#b91c1c';
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

        // Success message form ke andar dikhao (toast upar alag nahi)
        var successMsgEl = document.getElementById('verify-form-success-msg');
        var successTextEl = document.getElementById('verify-form-success-text');
        var successCloseBtn = document.getElementById('verify-form-success-close');
        @if(!empty($isWhatsappAvailable) && !empty($phone))
            successTextEl.textContent = 'Verification code sent to your WhatsApp & Email. Please enter the 6-digit code below.';
        @else
            successTextEl.textContent = 'Verification code sent to your email. Please enter the 6-digit code below.';
        @endif
        successMsgEl.style.display = 'flex';
        successCloseBtn.addEventListener('click', function() {
            successMsgEl.style.display = 'none';
        });
        
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
        
        otpInputs[0].focus();
    });
})();
</script>
