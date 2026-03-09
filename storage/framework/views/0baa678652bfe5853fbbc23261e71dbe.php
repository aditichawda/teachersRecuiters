<div class="job-grid-modern">
    <?php if($job->is_featured): ?>
        <span class="job-featured-badge">★ <?php echo e(__('Featured')); ?></span>
    <?php endif; ?>
    <div class="jgm-top">
        <div class="jgm-time-location-logo" style="display:block;">
        <div class="jgm-logo">
            <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
        </div>
        <p class="jgm-location"><i class="feather-map-pin"></i> <?php echo e($job->location ?: 'India'); ?></p>
        </div>
        <div class="jgm-time-location" style="display:block;">
        <span class="jgm-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
        <div class="jgm-tags">
        <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            ?>
            <span class="jgm-tag" <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>20; color: <?php echo e($jobType->background_color); ?>; border-color: <?php echo e($jobType->background_color); ?>40;" <?php endif; ?>><?php echo e($jobType->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
            
        </div>
    </div>
    
    <a href="<?php echo e($job->url); ?>" class="jgm-title" title="<?php echo e($job->name); ?>" style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
        <?php
            $jobName = BaseHelper::clean($job->name);
            $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
        ?>
        <?php echo $truncatedName; ?>

    </a>
    
    <?php if($job->has_company): ?>
        <a href="<?php echo e($job->company_url); ?>" class="jgm-company"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
    <?php endif; ?>
    <?php
        $institutionType = $job->company->institution_type ?? 'School';
        $institutionType = !empty($institutionType) ? $institutionType : 'School';
        // If company is a consultancy, show "Consultancy" instead of institution_type
        if (strtolower($institutionType) === 'consultancy' || strtolower($institutionType) === 'consulting') {
            $displayType = 'Consultancy';
        } else {
            $displayType = $institutionType;
        }
    ?>
    <span class="jgm-institution-type" style="display: block; margin-top: 5px; font-size: 13px; color: #64748b;">
        <i class="feather-briefcase" style="font-size: 12px;"></i> <?php echo e($displayType); ?>

    </span>
    <div class="jgm-salary" style="display: block; margin-top: 5px; margin-bottom: 5px; font-size: 15px; font-weight: 700; color: #0073d1;"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
    <?php if(!empty($job->gender_preference)): ?>
        <?php
            $genderLabel = ucfirst($job->gender_preference);
            $bgColor = '';
            if ($job->gender_preference == 'male') {
                $genderIcon = '♂';
                $genderLabel = __('Male Preferred');
                $bgColor = 'background-color: #e0f2fe;';
            } elseif ($job->gender_preference == 'female') {
                $genderIcon = '♀';
                $genderLabel = __('Female Preferred');
                $bgColor = 'background-color: #fce7f3;';
            } else {
                $genderIcon = '';
            }
        ?>
        <span class="jgm-gender-preference" style="display: block; margin-top: 5px; font-size: 13px; color: #64748b; padding: 4px 8px; border-radius: 4px; <?php echo e($bgColor); ?>">
            <?php if($genderIcon): ?><?php echo e($genderIcon); ?> <?php endif; ?><?php echo e($genderLabel); ?>

        </span>
    <?php endif; ?>
    <div class="jgm-bottom">
        <a href="<?php echo e($job->url); ?>" class="jgm-view"><?php echo e(__('View')); ?> →</a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/style-2.blade.php ENDPATH**/ ?>