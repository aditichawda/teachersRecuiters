<?php
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $categories = app(CategoryInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
?>

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4"><?php echo e(__('Industry')); ?></h4>
    <ul>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="job_categories[]" id="job-categories-<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, (array) request()->input('job_type', []))): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="job-categories-<?php echo e($category->id); ?>"><?php echo e($category->name); ?></label>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/filters/categories.blade.php ENDPATH**/ ?>