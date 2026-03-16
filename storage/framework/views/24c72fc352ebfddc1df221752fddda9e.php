<?php
    use Botble\JobBoard\Repositories\Interfaces\CompanyInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $companies = app(CompanyInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'order_by' => ['name' => 'ASC'],
        ]);
?>

<div class="form-group mb-4">
    <h4 class="section-head-small mb-4"><?php echo e(__('Institution Name')); ?></h4>
    <select name="company_id" class="wt-select-bar-large selectpicker" data-live-search="true" data-size="8">
        <option value=""><?php echo e(__('All Institutions')); ?></option>
        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($company->id); ?>" <?php if($company->id == request()->query('company_id')): echo 'selected'; endif; ?>><?php echo e($company->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/filters/institution-name.blade.php ENDPATH**/ ?>