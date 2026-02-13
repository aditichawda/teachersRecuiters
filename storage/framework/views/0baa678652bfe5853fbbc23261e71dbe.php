<div class="job-grid-modern">
    <div class="jgm-top">
        <div class="jgm-logo">
            <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
        </div>
        <span class="jgm-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
    </div>
    <div class="jgm-tags">
        <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            ?>
            <span class="jgm-tag" <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>20; color: <?php echo e($jobType->background_color); ?>; border-color: <?php echo e($jobType->background_color); ?>40;" <?php endif; ?>><?php echo e($jobType->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <a href="<?php echo e($job->url); ?>" class="jgm-title" title="<?php echo e($job->name); ?>">
        <?php echo BaseHelper::clean($job->name); ?>

    </a>
    <p class="jgm-location"><i class="feather-map-pin"></i> <?php echo e($job->location ?: 'India'); ?></p>
    <?php if($job->has_company): ?>
        <a href="<?php echo e($job->company_url); ?>" class="jgm-company"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
    <?php endif; ?>
    <div class="jgm-bottom">
        <div class="jgm-salary"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <a href="<?php echo e($job->url); ?>" class="jgm-view"><?php echo e(__('View')); ?> →</a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/style-2.blade.php ENDPATH**/ ?>