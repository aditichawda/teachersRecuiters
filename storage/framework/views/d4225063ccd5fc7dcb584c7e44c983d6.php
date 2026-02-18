<?php $__env->startSection('content'); ?>
<style>
    .edu-form-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .edu-form-header {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        padding: 20px 24px;
    }
    .edu-form-header h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
        color:white;
    }
    .edu-form-header p {
        font-size: 13px;
        opacity: 0.85;
        margin: 4px 0 0 0;
    }
    .edu-form-body {
        padding: 24px;
    }
    .edu-form-body .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }
    .edu-form-body .form-label .required {
        color: #dc3545;
    }
    .edu-form-body .form-control,
    .edu-form-body .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 14px;
        height: 40px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .edu-form-body .form-control:focus,
    .edu-form-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .edu-form-body .form-check-input:checked {
        background-color: #0073d1;
        border-color: #0073d1;
    }
    .edu-form-footer {
        padding: 16px 24px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-save-edu {
        background: #0073d1;
        color: #fff;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-save-edu:hover {
        background: #005bb5;
    }
    .btn-back-edu {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-back-edu:hover {
        color: #0073d1;
    }
</style>

<div class="edu-form-card">
    <div class="edu-form-header">
        <h3><i class="fa fa-graduation-cap me-2"></i><?php echo e(__('Add Education')); ?></h3>
        <p><?php echo e(__('Add your educational qualification details')); ?></p>
    </div>
    <form action="<?php echo e(route('public.account.educations.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="edu-form-body">
            <div class="row">
                <!-- Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label"><?php echo e(__('Degree Level')); ?> <span class="required">*</span></label>
                    <select class="form-select <?php $__errorArgs = ['level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="level">
                        <option value=""><?php echo e(__('Select Level')); ?></option>
                        <?php $__currentLoopData = ['diploma' => 'Diploma', 'bachelors' => 'Bachelors', 'masters' => 'Masters', 'doctorate' => 'Doctorate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>" <?php if(old('level') == $val): echo 'selected'; endif; ?>><?php echo e($lbl); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['level'];
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

                <!-- Institution -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="school"><?php echo e(__('Institution/School Name')); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['school'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="school"
                           name="school" value="<?php echo e(old('school')); ?>" placeholder="<?php echo e(__('e.g. Delhi University')); ?>"/>
                    <?php $__errorArgs = ['school'];
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

                <!-- Specialization -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="specialized"><?php echo e(__('Specialization / Subject')); ?></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['specialized'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="specialized"
                           name="specialized" value="<?php echo e(old('specialized')); ?>" placeholder="<?php echo e(__('e.g. Mathematics, English, Education')); ?>"/>
                    <?php $__errorArgs = ['specialized'];
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

                <!-- Currently Studying -->
                <div class="col-md-6 mb-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_current" name="is_current" value="1" <?php echo e(old('is_current') ? 'checked' : ''); ?> onchange="toggleEndDate(this)">
                        <label class="form-check-label" for="is_current"><?php echo e(__('I am currently studying here')); ?></label>
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
                           name="started_at" value="<?php echo e(old('started_at')); ?>" />
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
                           name="ended_at" value="<?php echo e(old('ended_at')); ?>" />
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
unset($__errorArgs, $__bag); ?>" name="description" rows="4" placeholder="<?php echo e(__('Describe your studies, achievements, etc.')); ?>"><?php echo e(old('description')); ?></textarea>
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
        <div class="edu-form-footer">
            <a href="<?php echo e(route('public.account.educations.index')); ?>" class="btn-back-edu">
                <i class="fa fa-arrow-left"></i> <?php echo e(__('Back to List')); ?>

            </a>
            <button type="submit" class="btn-save-edu">
                <i class="fa fa-save me-1"></i> <?php echo e(__('Save Education')); ?>

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

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/educations/create.blade.php ENDPATH**/ ?>