<?php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique institution types from companies
    $institutionTypes = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('institution_type')
        ->where('institution_type', '!=', '')
        ->distinct()
        ->pluck('institution_type')
        ->filter()
        ->unique()
        ->sort()
        ->values();
?>

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Institute Type')); ?></h4>
    <ul>
        <?php $__currentLoopData = $institutionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institutionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="institution_type[]" id="institution-type-<?php echo e(md5($institutionType)); ?>" value="<?php echo e($institutionType); ?>" <?php if(in_array($institutionType, (array) request()->query('institution_type', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="institution-type-<?php echo e(md5($institutionType)); ?>"><?php echo e($institutionType); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/filters/institute-type.blade.php ENDPATH**/ ?>