<?php
    $standardOptions = [
        'Play Group',
        'Nursery',
        'LKG(PP-1)',
        'UKG(PP-2)',
        '1st Grade',
        '2nd Grade',
        '3rd Grade',
        '4th Grade',
        '5th Grade',
        '6th Grade',
        '7th Grade',
        '8th Grade',
        '9th Grade',
        '10th Grade',
        '11th Grade',
        'Bachelors',
        'Masters',
        'Diploma',
        'Doctorate',
    ];
?>
<form action="<?php echo e(route('public.admission.enquiry')); ?>" method="POST" class="admission-enquiry-form">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="company_id" value="<?php echo e($company->id); ?>">
    <div class="row g-2 mb-2">
        <div class="col-md-6 mb-3">
            <label class="form-label"><?php echo e(__('Student Name')); ?> <span class="text-danger">*</span></label>
            <input type="text" name="student_name" class="form-control" required maxlength="255" value="<?php echo e(old('student_name')); ?>" placeholder="<?php echo e(__('Student Name')); ?>"
                   title="<?php echo e(__('Enter student name here')); ?>">
            <?php $__errorArgs = ['student_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label"><?php echo e(__('Contact Number')); ?> <span class="text-danger">*</span></label>
            <input type="tel" name="contact_number" class="form-control" required maxlength="50" value="<?php echo e(old('contact_number')); ?>" placeholder="<?php echo e(__('Enter Parent\'s contact number')); ?>"
                   title="<?php echo e(__('Enter Parent\'s contact number')); ?>">
            <?php $__errorArgs = ['contact_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-md-6 mb-3">
            <label class="form-label"><?php echo e(__('Email Address')); ?></label>
            <input type="email" name="email" class="form-control" maxlength="255" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('Enter Parent\'s email address')); ?>"
                   title="<?php echo e(__('Enter Parent\'s email address')); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label"><?php echo e(__('Age')); ?> <span class="text-danger">*</span></label>
            <input type="text" name="age" class="form-control" required maxlength="50" value="<?php echo e(old('age')); ?>" placeholder="<?php echo e(__('Enter student age as of today\'s date')); ?>"
                   title="<?php echo e(__('Enter student age as of today\'s date')); ?>">
            <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label"><?php echo e(__('Looking admission for which standard')); ?> <span class="text-danger">*</span></label>
        <select name="admission_for_standard" class="form-select" required title="<?php echo e(__('Are you looking admission for which grade')); ?>">
            <option value=""><?php echo e(__('Select standard')); ?></option>
            <?php $__currentLoopData = $standardOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($opt); ?>" <?php echo e(old('admission_for_standard') === $opt ? 'selected' : ''); ?>><?php echo e(__($opt)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['admission_for_standard'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label class="form-label"><?php echo e(__('Address')); ?> <span class="text-danger">*</span></label>
        <textarea name="address" class="form-control" rows="2" required maxlength="500" placeholder="<?php echo e(__('Enter your current State, City, and Locality')); ?>" title="<?php echo e(__('Enter your current State, City, and Locality')); ?>"><?php echo e(old('address')); ?></textarea>
        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="mb-3">
        <label class="form-label"><?php echo e(__('Message')); ?></label>
        <textarea name="message" class="form-control" rows="3" maxlength="2000" placeholder="<?php echo e(__('Message (optional)')); ?>"><?php echo e(old('message')); ?></textarea>
        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger small"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit Enquiry')); ?></button>
</form>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/admission/partials/enquiry-form.blade.php ENDPATH**/ ?>