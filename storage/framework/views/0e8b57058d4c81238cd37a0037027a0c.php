<?php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique benefits from staff_facilities (which is an array field)
    $allBenefits = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('staff_facilities')
        ->get()
        ->pluck('staff_facilities')
        ->flatten()
        ->filter()
        ->unique()
        ->sort()
        ->values();
?>

<?php if($allBenefits->count() > 0): ?>
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Benefits Offered')); ?></h4>
    <ul>
        <?php $__currentLoopData = $allBenefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="benefits[]" id="benefit-<?php echo e(md5($benefit)); ?>" value="<?php echo e($benefit); ?>" <?php if(in_array($benefit, (array) request()->query('benefits', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="benefit-<?php echo e(md5($benefit)); ?>"><?php echo e($benefit); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/filters/benefits-offered.blade.php ENDPATH**/ ?>