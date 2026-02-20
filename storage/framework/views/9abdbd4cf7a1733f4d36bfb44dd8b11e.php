<?php $__env->startSection('content'); ?>
<style>
    .exp-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .exp-form-header {
        background: linear-gradient(135deg, #64b5f6, #1967d2, #0d47a1);
        color: #fff;
        padding: 20px 24px;
    }
    .exp-form-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
        color:white;
    }
    .exp-form-header p {
        font-size: 13px;
        opacity: 0.85;
        margin: 4px 0 0 0;
    }
    .exp-form-body {
        padding: 24px;
    }
    .exp-form-body .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .exp-form-body .form-label .required {
        color: #dc3545;
    }
    .exp-form-body .form-control,
    .exp-form-body .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 14px;
        height: 40px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .exp-form-body .form-control:focus,
    .exp-form-body .form-select:focus {
        border-color: #e65100;
        box-shadow: 0 0 0 3px rgba(230,81,0,0.1);
    }
    .exp-form-body .form-check-input:checked {
        background-color: #e65100;
        border-color: #e65100;
    }
    .exp-form-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-save-exp {
        background: #1967d2;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-save-exp:hover {
        background: #1967d2;
    }
    .btn-back-exp {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-back-exp:hover {
        color: #e65100;
    }
</style>

<div class="exp-form-card">
    <div class="exp-form-header">
        <h3><i class="fa fa-briefcase me-2"></i><?php echo e(__('Edit Experience')); ?></h3>
        <p><?php echo e(__('Update your work experience details')); ?></p>
    </div>
    <form action="<?php echo e(route('public.account.experiences.update', $experience->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="exp-form-body">
            <div class="row">
                <!-- Company -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="company"><?php echo e(__('School / Institution / Company Name')); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="company"
                           name="company" value="<?php echo e(old('company', $experience->company)); ?>" placeholder="<?php echo e(__('e.g. DPS School, ABC College')); ?>"/>
                    <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Position -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="position"><?php echo e(__('Position / Designation')); ?></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="position"
                           name="position" value="<?php echo e(old('position', $experience->position)); ?>" placeholder="<?php echo e(__('e.g. Mathematics Teacher, Principal')); ?>"/>
                    <?php $__errorArgs = ['position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Employment Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Employment Type')); ?></label>
                    <select class="form-select <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="employment_type">
                        <option value=""><?php echo e(__('Select Type')); ?></option>
                        <?php $__currentLoopData = ['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'internship' => 'Internship', 'freelance' => 'Freelance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('employment_type', $experience->employment_type) == $val): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Location -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="location"><?php echo e(__('Location')); ?></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="location"
                           name="location" value="<?php echo e(old('location', $experience->location)); ?>" placeholder="<?php echo e(__('e.g. New Delhi, Mumbai')); ?>"/>
                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Currently Working -->
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1" <?php echo e(old('is_current', $experience->is_current) ? 'checked' : ''); ?> onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current"><?php echo e(__('I am currently working here')); ?></label>
                    </div>
                </div>

                <!-- Start Date -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="started_at"><?php echo e(__('Start Date')); ?> <span class="required">*</span></label>
                    <input type="date" class="form-control <?php $__errorArgs = ['started_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="started_at"
                           name="started_at" value="<?php echo e(old('started_at', $experience->started_at->format('Y-m-d'))); ?>" />
                    <?php $__errorArgs = ['started_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- End Date -->
                <div class="col-md-6 mb-3" id="end-date-wrapper">
                    <label class="form-label" for="ended_at"><?php echo e(__('End Date')); ?></label>
                    <input type="date" class="form-control <?php $__errorArgs = ['ended_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="ended_at"
                           name="ended_at" value="<?php echo e(old('ended_at', $experience->ended_at ? $experience->ended_at->format('Y-m-d') : '')); ?>" />
                    <?php $__errorArgs = ['ended_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label class="form-label"><?php echo e(__('Description')); ?></label>
                    <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" rows="4" placeholder="<?php echo e(__('Describe your role, responsibilities, and achievements')); ?>"><?php echo e(old('description', $experience->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
        <div class="exp-form-footer">
            <a href="<?php echo e(route('public.account.experiences.index')); ?>" class="btn-back-exp">
                <i class="fa fa-arrow-left"></i> <?php echo e(__('Back to List')); ?>

            </a>
            <button type="submit" class="btn-save-exp">
                <i class="fa fa-save me-1"></i> <?php echo e(__('Update Experience')); ?>

            </button>
        </div>
    </form>
</div>

<script>
function toggleEndDate(checkbox) {
    const wrapper = document.getElementById('end-date-wrapper');
    if (checkbox.checked) {
        wrapper.style.opacity = '0.5';
        wrapper.querySelector('input').disabled = true;
        wrapper.querySelector('input').value = '';
    } else {
        wrapper.style.opacity = '1';
        wrapper.querySelector('input').disabled = false;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    const cb = document.getElementById('is_current');
    if (cb && cb.checked) toggleEndDate(cb);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/experiences/edit.blade.php ENDPATH**/ ?>