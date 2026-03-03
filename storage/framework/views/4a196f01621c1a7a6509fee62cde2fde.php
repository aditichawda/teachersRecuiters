<?php
    Theme::layout('without-navbar');
?>

<style>
.fp-wrapper { min-height: 100vh; background: #f5f7fa; display: flex; align-items: center; justify-content: center; padding: 40px 20px; }
.fp-container { width: 100%; max-width: 500px; background: #fff; border-radius: 14px; box-shadow: 0 15px 35px -10px rgba(0,0,0,.15); overflow: hidden; }
.fp-header { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); padding: 25px 30px; text-align: center; }
.fp-header h2 { color: #fff; font-size: 24px; font-weight: 700; margin-bottom: 5px; }
.fp-header p { color: rgba(255,255,255,.9); font-size: 14px; margin: 0; }
.fp-body { padding: 30px; }
.fp-body .form-group { margin-bottom: 16px; }
.fp-body .form-label { font-weight: 600; color: #434343; margin-bottom: 6px; font-size: 14px; }
.fp-body .form-control { border: 1.5px solid #e0e0e0; border-radius: 8px; padding: 12px 14px; height: 40px; font-size: 14px; color: #000 !important; background: #fff !important; }
.fp-body .form-control::placeholder { color: #666; }
.fp-body .form-control:focus { border-color: #0073d1; box-shadow: 0 0 0 3px rgba(0,115,209,.1); }
.fp-or-divider { text-align: center; margin: 20px 0; position: relative; }
.fp-or-divider::before, .fp-or-divider::after { content: ''; position: absolute; top: 50%; width: 45%; height: 1px; background: #e0e0e0; }
.fp-or-divider::before { left: 0; }
.fp-or-divider::after { right: 0; }
.fp-or-divider span { position: relative; background: #fff; padding: 0 15px; color: #666; font-weight: 600; font-size: 14px; }
.btn-fp { background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; border-radius: 8px; padding: 12px 25px; font-size: 15px; font-weight: 600; width: 100%; color: #fff; cursor: pointer; transition: all .3s; }
.btn-fp:hover { background: linear-gradient(135deg, #005bb5 0%, #004a94 100%); transform: translateY(-1px); }
.fp-footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; font-size: 14px; color: #666; }
.fp-footer a { color: #0073d1; font-weight: 600; text-decoration: none; }
.fp-footer a:hover { text-decoration: underline; }
.alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
</style>

<div class="fp-wrapper">
    <div class="fp-container">
        <div class="fp-header">
            <h2><i class="ti ti-key me-2"></i><?php echo e(__('Forgot Password')); ?></h2>
            <p><?php echo e(__('Enter your email or phone number to receive reset link')); ?></p>
        </div>
        <div class="fp-body">
            <?php if(session()->has('status')): ?>
                <div role="alert" class="alert alert-success"><?php echo e(session('status')); ?></div>
            <?php elseif(session()->has('auth_error_message')): ?>
                <div role="alert" class="alert alert-danger"><?php echo e(session('auth_error_message')); ?></div>
            <?php elseif(session()->has('auth_success_message')): ?>
                <div role="alert" class="alert alert-success"><?php echo e(session('auth_success_message')); ?></div>
            <?php elseif(session()->has('auth_warning_message')): ?>
                <div role="alert" class="alert alert-warning"><?php echo e(session('auth_warning_message')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div role="alert" class="alert alert-danger">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($err); ?><?php if(!$loop->last): ?><br><?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php echo $form
                    ->modify('submit', 'submit', [
                        'label' => __('Send Password Reset Link'),
                        'attr' => ['class' => 'btn-fp'],
                    ], true)
                    ->renderForm(); ?>


            <div class="fp-footer">
                <a href="<?php echo e(route('public.account.login')); ?>"><i class="ti ti-arrow-left me-1"></i> <?php echo e(__('Back to Login')); ?></a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailField = document.querySelector('input[name="email"]');
    const phoneField = document.querySelector('input[name="phone"]');
    const form = emailField ? emailField.closest('form') : null;
    
    if (emailField && phoneField) {
        // When email field is filled, clear phone field
        emailField.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                phoneField.value = '';
            }
        });
        
        // When phone field is filled, clear email field
        phoneField.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                emailField.value = '';
            }
        });
        
        // Also handle on focus - clear the other field when user starts typing
        emailField.addEventListener('focus', function() {
            if (phoneField.value.trim() !== '') {
                phoneField.value = '';
            }
        });
        
        phoneField.addEventListener('focus', function() {
            if (emailField.value.trim() !== '') {
                emailField.value = '';
            }
        });
        
        // Validate on form submit - ensure only one field is filled
        if (form) {
            form.addEventListener('submit', function(e) {
                const emailValue = emailField.value.trim();
                const phoneValue = phoneField.value.trim();
                
                // If both fields are filled, prevent submission and show error
                if (emailValue !== '' && phoneValue !== '') {
                    e.preventDefault();
                    alert('Please provide either email OR phone number, not both.');
                    return false;
                }
                
                // If neither field is filled, prevent submission
                if (emailValue === '' && phoneValue === '') {
                    e.preventDefault();
                    alert('Please provide either email or phone number.');
                    return false;
                }
            });
        }
    }
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/auth/passwords/email.blade.php ENDPATH**/ ?>