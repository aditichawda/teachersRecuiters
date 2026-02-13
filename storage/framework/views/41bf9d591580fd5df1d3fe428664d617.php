<?php
    Theme::layout('without-navbar');
?>

<style>
    .employer-register-wrapper {
        min-height: 100vh;
        background: #f5f7fa;
        background-image: 
            radial-gradient(at 20% 30%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
            radial-gradient(at 80% 70, rgba(67, 67, 67, 0.06) 0%, transparent 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .employer-register-container {
        width: 100%;
        max-width: 580px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .employer-register-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 20px 30px;
        text-align: center;
    }

    .employer-register-header h2 {
        color: #ffffff;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .employer-register-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
        margin: 0;
    }

    .employer-register-body {
        padding: 25px 30px;
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
        font-size: 12px;
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
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
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

    .employer-register-body .form-group {
        margin-bottom: 12px;
    }

    .employer-register-body .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .employer-register-body .form-control,
    .employer-register-body .form-select {
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px;
        height: 40px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .employer-register-body .form-control:focus,
    .employer-register-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .employer-register-body .btn-primary,
    .employer-register-body button[type="submit"],
    .employer-register-body .site-button {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%) !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 14px !important;
        height: 40px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        width: 100% !important;
        margin-top: 15px !important;
        color: #fff !important;
    }

    .employer-register-body .btn-primary:hover,
    .employer-register-body button[type="submit"]:hover,
    .employer-register-body .site-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
        background: linear-gradient(135deg, #005bb5 0%, #004a94 100%) !important;
    }

    .employer-logo {
        text-align: center;
        margin-bottom: 15px;
    }

    .employer-logo a {
        font-size: 22px;
        font-weight: 700;
        color: #434343;
        text-decoration: none;
    }

    .employer-logo a span {
        color: #0073d1;
    }

    .employer-register-body .text-center a {
        color: #0073d1;
        font-weight: 600;
    }

    .employer-register-body .text-center a:hover {
        color: #005bb5;
        text-decoration: underline;
    }

    /* Phone field fix */
    .employer-register-body .iti {
        width: 100%;
    }

    .employer-register-body .iti__flag-container {
        padding: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .employer-register-container {
            margin: 20px;
        }

        .employer-register-header {
            padding: 25px 20px;
        }

        .employer-register-body {
            padding: 25px 20px;
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
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }
</style>

<div class="employer-register-wrapper">
    <div class="employer-register-container">
        <div class="employer-register-header">
            <h2><i class="ti ti-briefcase me-2"></i>Employer Registration</h2>
            <p>Step 1 of 4 - Create your account and start hiring</p>
        </div>
        
        <div class="employer-register-body">
            <!-- Step Indicator - 4 Steps -->
            <div class="step-indicator">
                <div class="step active">
                    <span class="step-number">1</span>
                    <span>Basic Details</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span>Verification</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span>Add school/institution</span>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <!-- Logo -->
            <!-- <div class="employer-logo">
                <?php if(Theme::getLogo()): ?>
                    <a href="<?php echo e(route('public.index')); ?>">
                        <?php echo Theme::getLogoImage(['class' => 'site-logo', 'style' => 'max-width: 160px;'], 'logo', 150); ?>

                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('public.index')); ?>">
                        <span>Teachers</span>Recruiter
                    </a>
                <?php endif; ?>
            </div> -->

            <?php if(session('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php echo $form->renderForm(); ?>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ti ti-loader ti-spin me-2"></i>Processing...';
            }
        });
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/auth/employer-register.blade.php ENDPATH**/ ?>