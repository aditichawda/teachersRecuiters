<div class="job-card-modern">
<<<<<<< HEAD
=======
    <?php if($job->is_featured): ?>
        <span class="job-featured-badge">★ <?php echo e(__('Featured')); ?></span>
    <?php endif; ?>
>>>>>>> 7fa5ff64 (heyyyy)
    <div class="jcm-location-logo">
        <div class="jcm-logo">
            <img src="<?php echo e($job->company_logo_thumb); ?>" alt="<?php echo e($job->name); ?>">
        </div>
    </div>
    <div class="jcm-info">
<<<<<<< HEAD
        <a href="<?php echo e($job->url); ?>" class="jcm-title" title="<?php echo e($job->name); ?>">
            <?php echo BaseHelper::clean($job->name); ?>

        </a>
        <div class="jcm-meta">
            <?php if($job->has_company): ?>
                <a href="<?php echo e($job->company_url); ?>"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a>
            <?php endif; ?>
        </div>

        <span class="jcm-location"><i class="feather-map-pin"></i> <?php echo e($job->location ?: 'India'); ?></span>
        <span class="jcm-salary-mobile"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <span class="jcm-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
        <div class="jcm-tags">
=======
        <a href="<?php echo e($job->url); ?>" class="jcm-title" title="<?php echo e($job->name); ?>" style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
            <?php
                $jobName = BaseHelper::clean($job->name);
                $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
            ?>
            <?php echo $truncatedName; ?>

        </a>
        
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
        
        <div class="jcm-institution-details" style="display: flex; align-items: center; gap: 8px; margin-top: 5px; font-size: 13px; color: #64748b; flex-wrap: wrap;">
            <?php if($job->has_company): ?>
                <span><a href="<?php echo e($job->company_url); ?>" style="color: #64748b; text-decoration: none; font-weight: 400;"><?php echo e($job->company_name); ?> <?php echo $job->company->badge; ?></a></span>
                <span style="color: #cbd5e1;">|</span>
            <?php endif; ?>
            <span><?php echo e($displayType); ?></span>
            <span style="color: #cbd5e1;">|</span>
            <span><i class="feather-map-pin" style="font-size: 12px;"></i> <?php echo e($job->location ?: 'India'); ?></span>
        </div>

        <div class="jcm-tags" style="margin-top: 8px;">
>>>>>>> 7fa5ff64 (heyyyy)
            <?php $__currentLoopData = $job->jobTypes->loadMissing('metadata'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                ?>
                <span class="jcm-tag" <?php if($jobType->background_color): ?> style="background-color: <?php echo e($jobType->background_color); ?>20; color: <?php echo e($jobType->background_color); ?>; border-color: <?php echo e($jobType->background_color); ?>40;" <?php endif; ?>><?php echo e($jobType->name); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
<<<<<<< HEAD
        <a href="<?php echo e($job->url); ?>" class="jcm-apply"><?php echo e(__('View Job')); ?> →</a>
=======

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
            <span class="jcm-gender-preference" style="display: inline-block; margin-top: 5px; font-size: 13px; color: #64748b; padding: 4px 8px; border-radius: 4px; <?php echo e($bgColor); ?>">
                <?php if($genderIcon): ?><?php echo e($genderIcon); ?> <?php endif; ?><?php echo e($genderLabel); ?>

            </span>
        <?php endif; ?>

        <span class="jcm-time" style="display: block; margin-top: 8px; font-size: 12px; color: #94a3b8;"><?php echo e($job->created_at->diffForHumans()); ?></span>

        <span class="jcm-salary-mobile"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary"><?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?></div>
        <a href="<?php echo e($job->url); ?>" class="jcm-apply"><?php echo e(__('View Job')); ?> & <?php echo e(__('Apply')); ?></a>
>>>>>>> 7fa5ff64 (heyyyy)
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/jobs/style-1.blade.php ENDPATH**/ ?>