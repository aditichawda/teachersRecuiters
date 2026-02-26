<?php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique campus types from companies
    $campusTypes = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('campus_type')
        ->where('campus_type', '!=', '')
        ->distinct()
        ->pluck('campus_type')
        ->filter()
        ->unique()
        ->sort()
        ->values();
?>

<?php if($campusTypes->count() > 0): ?>
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Campus Type')); ?></h4>
    <ul>
        <?php $__currentLoopData = $campusTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="campus_type[]" id="campus-type-<?php echo e(md5($campusType)); ?>" value="<?php echo e($campusType); ?>" <?php if(in_array($campusType, (array) request()->query('campus_type', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="campus-type-<?php echo e(md5($campusType)); ?>"><?php echo e($campusType); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/filters/campus-type.blade.php ENDPATH**/ ?>