<div class="twm-jobs-grid-style1">
    <div class="twm-media">
        <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
    </div>
    <span class="twm-job-post-duration"><?php echo e($job->created_at->diffForHumans()); ?></span>
    <div class="twm-jobs-category">
        <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            ?>
            <span <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>" <?php else: ?> class="twm-bg-green" <?php endif; ?>><?php echo e($jobType->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="twm-mid-content">
        <a href="<?php echo e($job->url); ?>" class="twm-job-title" title="<?php echo e($job->name); ?>">
            <h4 class="text-truncate"><?php echo BaseHelper::clean($job->name); ?></h4>
        </a>
        <p class="twm-job-address"><?php echo e($job->location); ?></p>
        <?php if($job->has_company): ?>
            <a href="<?php echo e($job->company_url); ?>" class="twm-job-websites site-text-primary"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
        <?php endif; ?>
    </div>
    <div class="twm-right-content">
        <div class="twm-jobs-amount"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <a href="<?php echo e($job->url); ?>" class="twm-jobs-browse site-text-primary"><?php echo e(__('Browse Job')); ?></a>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/style-2.blade.php ENDPATH**/ ?>