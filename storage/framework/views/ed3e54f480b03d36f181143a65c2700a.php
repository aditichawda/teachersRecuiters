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

<div class="twm-sidebar-ele-filter job-filter-accordion">
    <!-- Desktop heading -->
    <h4 class="section-head-small mb-4 d-none d-md-block"><?php echo e(__('Job Role')); ?></h4>

    <!-- Mobile accordion header -->
    <button type="button" class="job-filter-accordion-toggle d-block d-md-none">
        <span><?php echo e(__('Job Role')); ?></span>
        <i class="feather-chevron-down"></i>
    </button>

    <div class="job-filter-accordion-body">
        <ul>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="job_categories[]" id="job-categories-<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id, (array) request()->query('job_categories', []))): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="job-categories-<?php echo e($category->id); ?>"><?php echo e($category->name); ?></label>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/filters/categories.blade.php ENDPATH**/ ?>