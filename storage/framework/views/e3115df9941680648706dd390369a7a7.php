<div class="job-card-modern">
    <div class="jcm-logo">
        <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
    </div>
    <div class="jcm-info">
        <a href="<?php echo e($job->url); ?>" class="jcm-title" title="<?php echo e($job->name); ?>">
            <?php echo BaseHelper::clean($job->name); ?>

        </a>
        <div class="jcm-meta">
            <span><i class="feather-map-pin"></i> <?php echo e($job->location ?: 'India'); ?></span>
            <?php if($job->has_company): ?>
                <a href="<?php echo e($job->company_url); ?>"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
            <?php endif; ?>
            <span><i class="feather-clock"></i> <?php echo e($job->created_at->diffForHumans()); ?></span>
        </div>
        <div class="jcm-tags">
            <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                ?>
                <span class="jcm-tag" <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>20; color: <?php echo e($jobType->background_color); ?>; border-color: <?php echo e($jobType->background_color); ?>40;" <?php endif; ?>><?php echo e($jobType->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <span class="jcm-salary-mobile"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <span class="jcm-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
        <a href="<?php echo e($job->url); ?>" class="jcm-apply"><?php echo e(__('View Job')); ?> →</a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/style-1.blade.php ENDPATH**/ ?>