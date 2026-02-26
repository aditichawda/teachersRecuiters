<div class="job-card-modern">
    <?php if($job->is_featured): ?>
        <span class="job-featured-badge">★ <?php echo e(__('Featured')); ?></span>
    <?php endif; ?>
    <?php if($job->gender_preference == 'female'): ?>
        <span class="job-female-preferred-badge">♀ <?php echo e(__('Female Preferred')); ?></span>
    <?php endif; ?>
    <div class="jcm-location-logo">
        <div class="jcm-logo">
            <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
        </div>
    </div>
    <div class="jcm-info">
        <a href="<?php echo e($job->url); ?>" class="jcm-title" title="<?php echo e($job->name); ?>" style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
            <?php
                $jobName = BaseHelper::clean($job->name);
                $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
            ?>
            <?php echo $truncatedName; ?>

        </a>
        <div class="jcm-meta">
            <?php if($job->has_company): ?>
                <a href="<?php echo e($job->company_url); ?>"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
            <?php endif; ?>
        </div>

        <?php
            $institutionType = $job->company->institution_type ?? 'School';
            $institutionType = !empty($institutionType) ? $institutionType : 'School';
            
            // Check if job is from a consultancy
            $isConsultancy = false;
            // Check company's institution_type
            if (strtolower($institutionType) === 'consultancy' || strtolower($institutionType) === 'consulting') {
                $isConsultancy = true;
            }
            // Also check author's registration_type as fallback
            if (!$isConsultancy && $job->author && method_exists($job->author, 'registration_type')) {
                $authorRegistrationType = $job->author->registration_type ?? '';
                if (strtolower($authorRegistrationType) === 'consultancy') {
                    $isConsultancy = true;
                }
            }
            
            $displayType = $isConsultancy ? 'Consultancy' : $institutionType;
        ?>
        <span class="jcm-institution-type" style="display: inline-block; margin-top: 5px; font-size: 13px; color: #64748b;">
            <i class="feather-briefcase" style="font-size: 12px;"></i> <?php echo e($displayType); ?>

        </span>

        <?php if(!empty($job->gender_preference)): ?>
            <?php
                $genderLabel = ucfirst($job->gender_preference);
                if ($job->gender_preference == 'male') {
                    $genderIcon = '♂';
                    $genderLabel = __('Male Preferred');
                } elseif ($job->gender_preference == 'female') {
                    $genderIcon = '♀';
                    $genderLabel = __('Female Preferred');
                } else {
                    $genderIcon = '';
                }
            ?>
            <span class="jcm-gender-preference" style="display: inline-block; margin-top: 5px; margin-left: 10px; font-size: 13px; color: #64748b;">
                <?php if($genderIcon): ?><?php echo e($genderIcon); ?> <?php endif; ?><?php echo e($genderLabel); ?>

            </span>
        <?php endif; ?>

        <span class="jcm-location"><i class="feather-map-pin"></i> <?php echo e($job->location ?: 'India'); ?></span>
        <span class="jcm-salary-mobile"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <span class="jcm-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
        <div class="jcm-tags">
            <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                ?>
                <span class="jcm-tag" <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>20; color: <?php echo e($jobType->background_color); ?>; border-color: <?php echo e($jobType->background_color); ?>40;" <?php endif; ?>><?php echo e($jobType->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a href="<?php echo e($job->url); ?>" class="jcm-apply"><?php echo e(__('View Job')); ?> →</a>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/style-1.blade.php ENDPATH**/ ?>