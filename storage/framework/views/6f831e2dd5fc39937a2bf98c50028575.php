<?php
    Theme::layout('without-navbar');
?>

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
        padding: 12px 25px;
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
            <?php if(!empty($isWhatsappAvailable) && !empty($phone)): ?>
                <h2><i class="ti ti-mail-check me-2"></i>Verify Your Account</h2>
                <p>Step 2 of 4 - WhatsApp & Email Verification</p>
            <?php else: ?>
                <h2><i class="ti ti-mail-check me-2"></i>Verify Your Email</h2>
                <p>Step 2 of 4 - Email Verification</p>
            <?php endif; ?>
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

            <!-- Verification Code Sent To -->
            <?php if(!empty($isWhatsappAvailable) && !empty($phone)): ?>
                <div class="email-display">
                    Verification code sent to: <i class="ti ti-brand-whatsapp" style="color: #25D366; font-size: 15px; vertical-align: middle;"></i> <strong><?php echo e($phone); ?></strong> & <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong><?php echo e($email); ?></strong>
                </div>
                <p class="text-muted mb-4">Enter the 6-digit code sent to your WhatsApp & Email</p>
            <?php else: ?>
                <div class="email-display">
                    Verification code sent to: <i class="ti ti-mail" style="color: #0073d1; font-size: 15px; vertical-align: middle;"></i> <strong><?php echo e($email); ?></strong>
                </div>
                <p class="text-muted mb-4">Enter the 6-digit code we sent to your email</p>
            <?php endif; ?>

            <form id="otp-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                
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
                <?php if(!empty($isWhatsappAvailable) && !empty($phone)): ?>
                    Didn't receive the code on WhatsApp or Email?
                <?php else: ?>
                    Didn't receive the code?
                <?php endif; ?>
                <a href="#" class="resend-link" onclick="resendCode()">Resend</a>
            </p>

            <p class="mt-3">
                <a href="<?php echo e(route('public.account.register.employer')); ?>" class="text-muted">
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

        fetch('<?php echo e(route("public.account.register.employer.verifyEmailCode")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: '<?php echo e($email); ?>',
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
                window.location.href = data.next_url || '<?php echo e(route("public.account.register.employer.institutionTypePage")); ?>';
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

function resendCode() {
    <?php if(!empty($isWhatsappAvailable) && !empty($phone)): ?>
        alert('Verification code resent to your WhatsApp (<?php echo e($phone); ?>) and Email (<?php echo e($email); ?>)!');
    <?php else: ?>
        alert('Verification code resent to your Email (<?php echo e($email); ?>)!');
    <?php endif; ?>
}
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/auth/employer-verify-email.blade.php ENDPATH**/ ?>