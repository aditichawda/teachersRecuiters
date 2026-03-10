<?php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique standard levels from standard_level (which is an array field)
    $allStandardLevels = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('standard_level')
        ->get()
        ->pluck('standard_level')
        ->flatten()
        ->filter()
        ->unique()
        ->sort()
        ->values();
?>

<?php if($allStandardLevels->count() > 0): ?>
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Standard Level')); ?></h4>
    <ul>
        <?php $__currentLoopData = $allStandardLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="standard_level[]" id="standard-level-<?php echo e(md5($level)); ?>" value="<?php echo e($level); ?>" <?php if(in_array($level, (array) request()->query('standard_level', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="standard-level-<?php echo e(md5($level)); ?>"><?php echo e($level); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/companies/filters/standard-level.blade.php ENDPATH**/ ?>