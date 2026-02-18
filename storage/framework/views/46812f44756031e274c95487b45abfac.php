<?php
    Theme::layout('without-navbar');
    Theme::asset()->add('auth-overrides', Theme::asset()->url('css/front-auth-overrides.css'), ['auth-css']);
?>

<style>
    .jobseeker-register-wrapper {
        min-height: 100vh;
        background: #f5f7fa;
        background-image: 
            radial-gradient(at 20% 30%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
            radial-gradient(at 80% 70%, rgba(67, 67, 67, 0.06) 0%, transparent 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 15px;
    }

    .jobseeker-register-container {
        width: 100%;
        max-width: 580px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .jobseeker-register-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 20px 30px;
        text-align: center;
    }

    .jobseeker-register-header h2 {
        color: #ffffff;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .jobseeker-register-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
        margin: 0;
    }

    .jobseeker-register-body {
        padding: 25px 30px;
    }

    /* Step Indicator - 4 Steps */
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
        gap: 4px;
        color: #999;
        font-size: 11px;
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
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #10b981;
        color: #fff;
    }

    /* Welcome Text */
    .welcome-text {
        text-align: center;
        margin-bottom: 18px;
        padding: 0 10px;
    }

    .welcome-text p {
        color: #555;
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }

    /* Form Styles */
    .jobseeker-register-body .form-group {
        margin-bottom: 12px;
    }

    .jobseeker-register-body .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 5px;
        font-size: 13px;
        display: block;
    }

    .jobseeker-register-body .form-control,
    .jobseeker-register-body .form-select {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px;
        height: 40px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #434343;
        background: #fafafa;
    }

    .jobseeker-register-body .form-control:focus,
    .jobseeker-register-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
        background: #fff;
    }

    .jobseeker-register-body .form-control::placeholder {
        color: #999;
    }

    /* File Input */
    .file-hint {
        font-size: 11px;
        color: #888;
        margin-top: 4px;
    }

    /* Phone field */
    .jobseeker-register-body .iti {
        width: 100%;
    }

    /* Checkbox Styles */
    .checkbox-wrapper {
        margin: 5px 0;
    }

    .checkbox-wrapper .form-check {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .checkbox-wrapper .form-check-input {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        flex-shrink: 0;
        cursor: pointer;
    }

    .checkbox-wrapper .form-check-input:checked {
        background-color: #0073d1;
        border-color: #0073d1;
    }

    .checkbox-wrapper .form-check-label {
        font-size: 12px;
        color: #666;
        line-height: 1.4;
        cursor: pointer;
    }

    /* Buttons */
    .jobseeker-register-body .btn-primary,
    .jobseeker-register-body button[type="submit"],
    .jobseeker-register-body .site-button {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 25px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        width: 100% !important;
        margin-top: 10px !important;
        color: #fff !important;
    }

    .jobseeker-register-body .btn-primary:hover,
    .jobseeker-register-body button[type="submit"]:hover,
    .jobseeker-register-body .site-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
        background: linear-gradient(135deg, #005bb5 0%, #004a94 100%) !important;
    }

    /* Terms Text */
    .terms-text {
        text-align: center;
        font-size: 11px;
        color: #888;
        margin-top: 5px;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .terms-text a {
        color: #0073d1;
        text-decoration: none;
    }

    .terms-text a:hover {
        text-decoration: underline;
    }

    /* Login Link */
    .login-link {
        text-align: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
        font-size: 13px;
        color: #666;
    }

    .login-link a {
        color: #0073d1;
        font-weight: 600;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* Hide account type selection */
    .account-type-selection {
        display: none !important;
    }

    /* Two columns for form fields on desktop */
    .jobseeker-register-body .row {
        margin-left: -8px;
        margin-right: -8px;
    }

    .jobseeker-register-body .row > [class*="col-"] {
        padding-left: 8px;
        padding-right: 8px;
    }

    /* Responsive - Single column on mobile */
    @media (max-width: 576px) {
        .jobseeker-register-wrapper {
            padding: 15px 10px;
        }

        .jobseeker-register-container {
            border-radius: 12px;
        }

        .jobseeker-register-header {
            padding: 18px 20px;
        }

        .jobseeker-register-body {
            padding: 20px;
        }

        .step-indicator {
            gap: 6px;
        }

        .step {
            font-size: 10px;
            gap: 3px;
        }

        .step-number {
            width: 20px;
            height: 20px;
            font-size: 9px;
        }

        .jobseeker-register-body .row > [class*="col-"] {
            width: 100% !important;
            max-width: 100% !important;
            flex: none !important;
        }
    }
</style>

<div class="jobseeker-register-wrapper">
    <div class="jobseeker-register-container">
        <div class="jobseeker-register-header">
            <h2>Educator Registration</h2>
            <p id="step-subtitle">Step 1 of 4 - Create your profile and explore school jobs</p>
        </div>
        
        <div class="jobseeker-register-body">
            <!-- Step Indicator - 4 Steps -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <span class="step-number">1</span>
                    <span>Basic Details</span>
                </div>
                <div class="step" data-step="2">
                    <span class="step-number">2</span>
                    <span>Verification</span>
                </div> 
                <div class="step" data-step="3">
                    <span class="step-number">3</span>
                    <span>Add Preferences & Resume</span>
                </div>
                <div class="step" data-step="4">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <!-- Welcome Text -->
            <div class="welcome-text">
            </div>
             <?php if(session()->has('status')): ?>
                <div role="alert" class="alert alert-success" style="padding:10px;font-size:13px;border-radius:8px;margin-bottom:15px;">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php elseif(session()->has('auth_error_message')): ?>
                <div role="alert" class="alert alert-danger" style="padding:10px;font-size:13px;border-radius:8px;margin-bottom:15px;">
                                <?php echo e(session('auth_error_message')); ?>

                            </div>
                        <?php elseif(session()->has('auth_success_message')): ?>
                <div role="alert" class="alert alert-success" style="padding:10px;font-size:13px;border-radius:8px;margin-bottom:15px;">
                                <?php echo e(session('auth_success_message')); ?>

                            </div>
                        <?php elseif(session()->has('auth_warning_message')): ?>
                <div role="alert" class="alert alert-warning" style="padding:10px;font-size:13px;border-radius:8px;margin-bottom:15px;">
                                <?php echo e(session('auth_warning_message')); ?>

                            </div>
                        <?php endif; ?>

            <?php echo $form->renderForm(); ?>


            <!-- Communication Checkbox (will be moved inside form via JS) -->
            <div class="checkbox-wrapper" id="checkbox-wrapper">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accept_communication" name="accept_communication" checked>
                    <label class="form-check-label" for="accept_communication">
                        Accept communication, and receive updates, job alerts via Email, Phone, WhatsApp.
                    </label>
                </div>
                            </div>
                            
            <!-- Terms Text (will be moved inside form via JS) -->
            <div class="terms-text" id="terms-text">
                By clicking Next button you agree to the <a href="<?php echo e(url('terms-conditions')); ?>">Terms and Conditions</a> & <a href="<?php echo e(url('privacy-policy')); ?>">Privacy Policy</a> of Teachers Recruiter.
                            </div>

            
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form?.querySelector('button[type="submit"]');
    const stepSubtitle = document.getElementById('step-subtitle');
    
    // Change field labels and placeholders
    const fullNameLabel = document.querySelector('label[for="full_name"]');
    if (fullNameLabel) {
        fullNameLabel.innerHTML = 'Full Name <span class="text-danger">*</span>';
    }
    
    const fullNameInput = document.querySelector('input[name="full_name"]');
    if (fullNameInput) {
        fullNameInput.placeholder = 'Enter your full name here';
    }

    
    // Update submit button text
    if (submitBtn) {
        submitBtn.textContent = 'Next Step';
    }
    
    // Move checkbox and terms inside form, before the submit button
    const checkboxWrapper = document.getElementById('checkbox-wrapper');
    const termsText = document.getElementById('terms-text');
    if (submitBtn && checkboxWrapper && termsText) {
        const submitBtnParent = submitBtn.parentElement;
        submitBtnParent.insertBefore(checkboxWrapper, submitBtn);
        submitBtnParent.insertBefore(termsText, submitBtn);
    }
    
    // Form submission handler - AJAX submission to sendVerificationCode
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ti ti-loader ti-spin me-2"></i>Processing...';
            }
            
            // Create FormData from form
            const formData = new FormData(form);
            
            // Submit via AJAX
            fetch(form.action, {
                        method: 'POST',
                body: formData,
                        headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
                    })
                    .then(response => response.json())
                    .then(data => {
                if (data.error === false || data.error === 0) {
                    // Success - redirect to verification page
                    window.location.href = '<?php echo e(route("public.account.register.verifyEmailPage")); ?>';
                            } else {
                    // Error - show message
                    if (typeof window.showDialogAlert === 'function') {
                        window.showDialogAlert('error', data.message || 'An error occurred. Please try again.', 'Error');
                    } else {
                        alert(data.message || 'An error occurred. Please try again.');
                    }
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Next Step';
                    }
                    
                    // If there's a redirect URL (e.g., to login page)
                    if (data.next_url) {
                        window.location.href = data.next_url;
                    }
                }
                    })
                    .catch(error => {
                console.error('Error:', error);
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('error', 'An error occurred. Please try again.', 'Error');
                } else {
                    alert('An error occurred. Please try again.');
                }
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Next Step';
                }
            });
        });
    }
});
    </script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/auth/register.blade.php ENDPATH**/ ?>