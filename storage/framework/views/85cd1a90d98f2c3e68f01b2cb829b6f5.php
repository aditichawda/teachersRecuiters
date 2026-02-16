<?php
    Theme::layout('without-navbar');
    Theme::asset()->add('auth-overrides', Theme::asset()->url('css/front-auth-overrides.css'), ['auth-css']);
?>

<style>
    .register-choose-wrapper {
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
    .register-choose-container {
        width: 100%;
        max-width: 520px;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    .register-choose-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 25px 30px;
        text-align: center;
    }
    .register-choose-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .register-choose-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 0;
    }
    .register-choose-body {
        padding: 30px;
    }
    .register-choose-title {
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        color: #434343;
        margin-bottom: 20px;
    }
    .register-type-cards {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }
    .register-type-card {
        display: block;
        padding: 20px 24px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        text-decoration: none;
        color: #434343;
        transition: all 0.25s ease;
        text-align: left;
    }
    .register-type-card:hover {
        border-color: #0073d1;
        background: rgba(0, 115, 209, 0.04);
        color: #0073d1;
        box-shadow: 0 4px 12px rgba(0, 115, 209, 0.12);
    }
    .register-type-card .card-icon {
        font-size: 28px;
        margin-bottom: 10px;
        color: #0073d1;
    }
    .register-type-card .card-title {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .register-type-card .card-desc {
        font-size: 13px;
        color: #666;
        margin: 0;
    }
    .register-choose-footer {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #eee;
        margin-top: 10px;
    }
    .register-choose-footer a {
        color: #0073d1;
        font-weight: 600;
        text-decoration: none;
    }
    .register-choose-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-choose-wrapper">
    <div class="register-choose-container">
        <div class="register-choose-header">
            <h2><i class="ti ti-user-plus me-2"></i><?php echo e(trans('plugins/job-board::messages.create_account')); ?></h2>
            <p><?php echo e(trans('plugins/job-board::messages.choose_how_to_register')); ?></p>
        </div>
        <div class="register-choose-body">
            <p class="register-choose-title"><?php echo e(trans('plugins/job-board::messages.who_can_create_profile')); ?></p>
            <div class="register-type-cards">
                <a href="<?php echo e(route('public.account.register')); ?>" class="register-type-card">
                    <div class="card-icon"><i class="ti ti-school"></i></div>
                    <div class="card-title"><?php echo e(trans('plugins/job-board::messages.register_as_job_seeker')); ?></div>
                    <p class="card-desc"><?php echo e(trans('plugins/job-board::messages.register_job_seeker_desc')); ?></p>
                </a>
                <?php if($employer_enabled ?? true): ?>
                <a href="<?php echo e(route('public.account.register.employer')); ?>" class="register-type-card">
                    <div class="card-icon"><i class="ti ti-building-school"></i></div>
                    <div class="card-title"><?php echo e(trans('plugins/job-board::messages.register_as_employer')); ?></div>
                    <p class="card-desc"><?php echo e(trans('plugins/job-board::messages.register_employer_desc')); ?></p>
                </a>
                <?php endif; ?>
            </div>
            <div class="register-choose-footer">
                <?php echo e(trans('plugins/job-board::messages.already_have_account')); ?> <a href="<?php echo e(route('public.account.login')); ?>"><?php echo e(trans('plugins/job-board::messages.sign_in')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/auth/register-choose.blade.php ENDPATH**/ ?>