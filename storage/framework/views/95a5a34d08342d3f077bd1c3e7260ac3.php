<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .cp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        overflow: hidden;
        max-width: 800px;
    }
    .cp-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 20px 24px;
    }
    .cp-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }
    .cp-header p {
        font-size: 13px;
        opacity: 0.85;
        margin: 4px 0 0 0;
    }
    .cp-body {
        padding: 24px;
    }
    .cp-body .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .cp-body .form-label .required {
        color: #dc3545;
    }
    .cp-body .form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .cp-body .form-control:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .password-field-wrapper {
        position: relative;
    }
    .password-field-wrapper .toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #999;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
    }
    .password-field-wrapper .toggle-password:hover {
        color: #333;
    }
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 8px;
        background: #e9ecef;
        overflow: hidden;
    }
    .password-strength-fill {
        height: 100%;
        border-radius: 2px;
        transition: width 0.3s, background 0.3s;
        width: 0;
    }
    .strength-weak { background: #dc3545; width: 25%; }
    .strength-fair { background: #ffc107; width: 50%; }
    .strength-good { background: #0073d1; width: 75%; }
    .strength-strong { background: #1a9c4a; width: 100%; }
    .password-hint {
        font-size: 12px;
        color: #999;
        margin-top: 4px;
    }
    .security-tip {
        background: #f0f4ff;
        border: 1px solid #d0d8f0;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 20px;
    }
    .security-tip h6 {
        font-size: 14px;
        font-weight: 600;
        color: #0073d1;
        margin: 0 0 8px 0;
    }
    .security-tip ul {
        margin: 0;
        padding-left: 18px;
        list-style: none;
    }
    .security-tip ul li {
        font-size: 13px;
        color: #555;
        margin-bottom: 4px;
    }
    .security-tip ul li::before {
        content: "✓";
        color: #1a9c4a;
        font-weight: bold;
        margin-right: 8px;
    }
    .cp-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: flex-end;
    }
    .btn-save-password {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        border: none;
        padding: 10px 28px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-save-password:hover {
        background: linear-gradient(135deg, #005bb5, #003f8a);
        color: #fff;
        transform: translateY(-1px);
    }
</style>

<div class="cp-card">
    <div class="cp-header">
        <h3><i class="fa fa-lock me-2"></i><?php echo e(__('Change Password')); ?></h3>
        <p><?php echo e(__('Update your password to keep your account secure')); ?></p>
    </div>
    <?php echo Form::open(['route' => 'public.account.post.security', 'method' => 'PUT']); ?>

        <div class="cp-body">
            <div class="security-tip">
                <h6><i class="fa fa-shield-alt me-1"></i> <?php echo e(__('Password Tips')); ?></h6>
                <ul>
                    <li><?php echo e(__('Use at least 8 characters')); ?></li>
                    <li><?php echo e(__('Include uppercase & lowercase letters')); ?></li>
                    <li><?php echo e(__('Include at least one number and symbol')); ?></li>
                    <li><?php echo e(__("Don't reuse passwords from other sites")); ?></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label"><?php echo e(__('Current Password')); ?> <span class="required">*</span></label>
                    <div class="password-field-wrapper">
                        <input class="form-control <?php if($errors->has('old_password')): ?> is-invalid <?php endif; ?>" 
                               type="password" 
                               placeholder="<?php echo e(__('Enter current password')); ?>" 
                               name="old_password"
                               id="current-password-input" 
                               value="<?php echo e(old('old_password')); ?>">
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('current-password-input', this)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger" style="font-size:13px; margin-top:4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-lg-6 mb-3"></div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label"><?php echo e(__('New Password')); ?> <span class="required">*</span></label>
                    <div class="password-field-wrapper">
                        <input class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?>" 
                               type="password" 
                               placeholder="<?php echo e(__('Enter new password')); ?>" 
                               name="password"
                               id="new-password-input" 
                               value="<?php echo e(old('password')); ?>"
                               oninput="checkPasswordStrength(this.value)">
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('new-password-input', this)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-fill" id="password-strength-bar"></div>
                    </div>
                    <span class="password-hint" id="password-strength-text"></span>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger" style="font-size:13px; margin-top:4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label"><?php echo e(__('Confirm New Password')); ?> <span class="required">*</span></label>
                    <div class="password-field-wrapper">
                        <input class="form-control <?php if($errors->has('password_confirmation')): ?> is-invalid <?php endif; ?>" 
                               type="password" 
                               placeholder="<?php echo e(__('Confirm new password')); ?>" 
                               name="password_confirmation"
                               id="confirm-password-input" 
                               value="<?php echo e(old('password_confirmation')); ?>">
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility('confirm-password-input', this)">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger" style="font-size:13px; margin-top:4px;"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
        <div class="cp-footer">
            <button type="submit" class="btn-save-password">
                <i class="fa fa-key me-2"></i><?php echo e(__('Update Password')); ?>

            </button>
        </div>
    <?php echo Form::close(); ?>

</div>

<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function checkPasswordStrength(password) {
    const bar = document.getElementById('password-strength-bar');
    const text = document.getElementById('password-strength-text');
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;
    
    bar.className = 'password-strength-fill';
    
    if (password.length === 0) {
        bar.style.width = '0';
        text.textContent = '';
    } else if (strength <= 1) {
        bar.classList.add('strength-weak');
        text.textContent = '<?php echo e(__("Weak")); ?>';
        text.style.color = '#dc3545';
    } else if (strength === 2) {
        bar.classList.add('strength-fair');
        text.textContent = '<?php echo e(__("Fair")); ?>';
        text.style.color = '#ffc107';
    } else if (strength === 3) {
        bar.classList.add('strength-good');
        text.textContent = '<?php echo e(__("Good")); ?>';
        text.style.color = '#0073d1';
    } else {
        bar.classList.add('strength-strong');
        text.textContent = '<?php echo e(__("Strong")); ?>';
        text.style.color = '#1a9c4a';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/change-password.blade.php ENDPATH**/ ?>