<?php
    use Botble\JobBoard\Repositories\Interfaces\JobTypeInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $jobTypes = app(JobTypeInterface::class)
        ->advancedGet([
            'withCount' => ['jobs' => function ($query) {
                $query->where(JobBoardHelper::getJobDisplayQueryConditions());
            }],
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
?>

<div class="twm-sidebar-ele-filter job-filter-accordion">
    <!-- Desktop heading -->
    <h4 class="section-head-small mb-4 d-none d-md-block"><?php echo e(__('Job Type')); ?></h4>

    <!-- Mobile accordion header -->
    <button type="button" class="job-filter-accordion-toggle d-block d-md-none">
        <span><?php echo e(__('Job Type')); ?></span>
        <i class="feather-chevron-down"></i>
    </button>

    <div class="job-filter-accordion-body">
        <ul>
            <?php $__currentLoopData = $jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="job_types[]" id="job-types-<?php echo e($jobType->id); ?>" value="<?php echo e($jobType->id); ?>" <?php if(in_array($jobType->id, (array) request()->input('job_type', []))): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="job-types-<?php echo e($jobType->id); ?>"><?php echo e($jobType->name); ?></label>
                    </div>
                    <span class="twm-job-type-count"><?php echo e($jobType->jobs_count); ?></span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/filters/types.blade.php ENDPATH**/ ?>