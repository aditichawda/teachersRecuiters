<?php
    Theme::layout('without-navbar');
?>

<!-- Login Section Start -->
<div class="section-full site-bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                <div class="twm-log-reg-media">
                    <div class="twm-l-media">
                        <?php if(theme_option('reset_password_page_image')): ?>
                            <img src="<?php echo e(RvMedia::getImageUrl(theme_option('reset_password_page_image'))); ?>" alt="background">
                        <?php else: ?>
                            <img src="<?php echo e(Theme::asset()->url('images/login-bg.png')); ?>" alt="background">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-7">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-inner">
                        <div class="twm-log-reg-head">
                            <div class="twm-log-reg-logo">
                                <span class="log-reg-form-title"><?php echo e(SeoHelper::getTitle()); ?></span>
                            </div>
                        </div>

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
                        <?php elseif(session()->has('auth_warning_message')): ?>
                            <div role="alert" class="alert alert-warning">
                                <?php echo e(session('auth_warning_message')); ?>

                            </div>
                        <?php endif; ?>


                        <?php echo $form
                               ->modify('submit', 'submit', [
                                    'label' => __('Send Password Reset Link'),
                                    'attr' => [
                                        'class' => 'site-button',
                                    ],
                                ], true)
                               ->renderForm(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Section End -->
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/auth/passwords/email.blade.php ENDPATH**/ ?>