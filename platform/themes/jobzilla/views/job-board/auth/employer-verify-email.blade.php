@php
    Theme::layout('without-navbar');
@endphp

<style>
    .employer-verify-wrapper {
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

    .employer-verify-container {
        width: 100%;
        max-width: 450px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .employer-verify-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 20px 30px;
        text-align: center;
    }

    .employer-verify-header h2 {
        color: #ffffff;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .employer-verify-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        margin: 0;
    }

    .employer-verify-body {
        padding: 25px 30px;
        text-align: center;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin: 20px 0;
    }

    .otp-inputs input {
        width: 42px;
        height: 48px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        color: #434343;
        transition: all 0.3s ease;
    }

    .otp-inputs input:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 2px rgba(0, 115, 209, 0.1);
        outline: none;
    }

    .verify-btn {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 5px;
        font-size: 14px;
        font-weight: 600;
        width: 100%;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .verify-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .verify-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .email-display {
        background: #f8f9fa;
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        color: #434343;
        font-size: 13px;
    }

    .email-display strong {
        color: #0073d1;
    }

    .employer-verify-inline-success {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 20px;
        text-align: left;
    }
    .employer-verify-inline-success .msg-icon { color: #059669; font-size: 20px; flex-shrink: 0; }
    .employer-verify-inline-success .msg-text { color: #047857; font-size: 14px; line-height: 1.5; margin: 0; flex: 1; }
    .employer-verify-inline-success .msg-close { background: none; border: none; color: #059669; cursor: pointer; padding: 0 4px; font-size: 18px; opacity: 0.8; }
    .employer-verify-inline-success .msg-close:hover { opacity: 1; }

    .resend-link {
        color: #0073d1;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
    }

    .resend-link:hover {
        text-decoration: underline;
    }

    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #999;
        font-size: 11px;
        white-space: nowrap;
    }

    .step.active {
        color: #0073d1;
        font-weight: 600;
    }

    .step.completed {
        color: #28a745;
    }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #28a745;
        color: #fff;
    }

    @media (max-width: 480px) {
        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }
</style>

<div class="employer-verify-wrapper">
    <div class="employer-verify-container">
        <div class="employer-verify-header">
            @if(!empty($isWhatsappAvailable) && !empty($phone))
                <h2><i class="ti ti-mail-check me-2"></i>Verify Your Account</h2>
                <p>Step 2 of 4 - WhatsApp & Email Verification</p>
            @else
                <h2><i class="ti ti-mail-check me-2"></i>Verify Your Email</h2>
                <p>Step 2 of 4 - Email Verification</p>
            @endif
        </div>
        
        <div class="employer-verify-body">
            <!-- Step Indicator -->
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
                        <span>Institution Details</span>
                    </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <!-- Success message form ke andar (toast upar alag nahi) -->
            <div id="employer-verify-form-success-msg" class="employer-verify-inline-success" style="display: none;" role="alert">
                <span class="msg-icon"><i class="ti ti-circle-check" style="font-size: 22px;"></i></span>
                <p class="msg-text" id="employer-verify-form-success-text"></p>
                <button type="button" class="msg-close" id="employer-verify-form-success-close" aria-label="Close">&times;</button>
            </div>

            <!-- Verification Code Sent To -->
            @if(!empty($isWhatsappAvailable) && !empty($phone))
                <div class="email-display">
                    Verification code sent to: <i class="ti ti-brand-whatsapp" style="color: #25D366; font-size: 15px; vertical-align: middle;"></i> <strong>{{ $phone }}</strong> & <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong>{{ $email }}</strong>
                </div>
                <p class="text-muted mb-4">Enter the 6-digit code sent to your WhatsApp & Email</p>
            @else
                <div class="email-display">
                    Verification code sent to: <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong>{{ $email }}</strong>
                </div>
                <p class="text-muted mb-4">Enter the 6-digit code we sent to your email</p>
            @endif

            <form id="otp-form">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div class="otp-inputs">
                    <input type="text" maxlength="1" class="otp-digit" data-index="0" autofocus>
                    <input type="text" maxlength="1" class="otp-digit" data-index="1">
                    <input type="text" maxlength="1" class="otp-digit" data-index="2">
                    <input type="text" maxlength="1" class="otp-digit" data-index="3">
                    <input type="text" maxlength="1" class="otp-digit" data-index="4">
                    <input type="text" maxlength="1" class="otp-digit" data-index="5">
                </div>
                <input type="hidden" name="code" id="full-code">

                <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                <button type="submit" class="verify-btn" id="verify-btn">
                    Verify & Continue
                </button>
            </form>

            <p class="mt-4 text-muted">
                @if(!empty($isWhatsappAvailable) && !empty($phone))
                    Didn't receive the code on WhatsApp or Email?
                @else
                    Didn't receive the code?
                @endif
                <button type="button" class="resend-link btn-link p-0 border-0 bg-transparent" id="employer-resend-btn">Resend</button>
                <span id="employer-resend-timer" style="display:none;color:#94a3b8;">Resend in <span id="employer-timer-count">60</span>s</span>
            </p>

            <p class="mt-3">
                <a href="{{ route('public.account.register.employer') }}" class="text-muted">
                    <i class="ti ti-arrow-left"></i> Back to Registration
                </a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-digit');
    const fullCodeInput = document.getElementById('full-code');
    const form = document.getElementById('otp-form');
    const verifyBtn = document.getElementById('verify-btn');
    const errorMessage = document.getElementById('error-message');

    // Handle OTP input
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            if (value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            
            updateFullCode();
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').slice(0, 6);
            pastedData.split('').forEach((char, i) => {
                if (otpInputs[i]) {
                    otpInputs[i].value = char;
                }
            });
            updateFullCode();
            if (pastedData.length === 6) {
                otpInputs[5].focus();
            }
        });
    });

    function updateFullCode() {
        let code = '';
        otpInputs.forEach(input => {
            code += input.value;
        });
        fullCodeInput.value = code;
    }

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const code = fullCodeInput.value;
        if (code.length !== 6) {
            showError('Please enter all 6 digits');
            return;
        }

        verifyBtn.disabled = true;
        verifyBtn.innerHTML = 'Verifying...';
        errorMessage.style.display = 'none';

        fetch('{{ route("public.account.register.employer.verifyEmailCode") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: '{{ $email }}',
                code: code
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                showError(data.message);
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = 'Verify & Continue';
            } else {
                window.location.href = data.next_url || '{{ route("public.account.register.employer.institutionTypePage") }}';
            }
        })
        .catch(error => {
            showError('An error occurred. Please try again.');
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = 'Verify & Continue';
        });
    });

    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.style.display = 'block';
    }
});

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
document.addEventListener('DOMContentLoaded', function() {
    var resendBtn = document.getElementById('employer-resend-btn');
    var timerEl = document.getElementById('employer-resend-timer');
    var countEl = document.getElementById('employer-timer-count');
    if (resendBtn && timerEl && countEl) {
        resendBtn.addEventListener('click', function() {
            resendBtn.disabled = true;
            fetch('{{ route("public.account.register.employer.resendVerificationCode") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (!data.error) {
                    @if(!empty($isWhatsappAvailable) && !empty($phone))
                        showToast('text-success', 'Verification code resent to your WhatsApp ({{ $phone }}) and Email ({{ $email }})!');
                    @else
                        showToast('text-success', 'Verification code resent to your Email ({{ $email }})!');
                    @endif
                    resendBtn.style.display = 'none';
                    timerEl.style.display = 'inline';
                    var seconds = 60;
                    var interval = setInterval(function() {
                        seconds--;
                        countEl.textContent = seconds;
                        if (seconds <= 0) {
                            clearInterval(interval);
                            timerEl.style.display = 'none';
                            resendBtn.style.display = 'inline';
                            resendBtn.disabled = false;
                        }
                    }, 1000);
                } else {
                    showToast('text-danger', data.message || 'Failed to resend code');
                    resendBtn.disabled = false;
                }
            })
            .catch(function() {
                showToast('text-danger', 'Failed to resend code');
                resendBtn.disabled = false;
            });
        });
    }
    var successMsgEl = document.getElementById('employer-verify-form-success-msg');
    var successTextEl = document.getElementById('employer-verify-form-success-text');
    var successCloseBtn = document.getElementById('employer-verify-form-success-close');
    @if(!empty($isWhatsappAvailable) && !empty($phone))
        successTextEl.textContent = 'Verification code sent to your WhatsApp & Email. Please enter the 6-digit code below.';
    @else
        successTextEl.textContent = 'Verification code sent to your email. Please enter the 6-digit code below.';
    @endif
    successMsgEl.style.display = 'flex';
    successCloseBtn.addEventListener('click', function() { successMsgEl.style.display = 'none'; });
});
</script>
