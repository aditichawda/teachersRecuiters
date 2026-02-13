<?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="company-card-list">
        <div class="ccl-logo">
            <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($company->name); ?>">
        </div>
        <div class="ccl-info">
            <div class="ccl-name-row">
                <a href="<?php echo e($company->url); ?>" class="ccl-name">
                    <?php echo BaseHelper::clean($company->name); ?>

                </a>
                <?php if($company->institution_type): ?>
                    <span class="ccl-type"><?php echo e($company->institution_type); ?></span>
                <?php endif; ?>
                <?php if($company->is_verified): ?>
                    <span class="ccl-verified"><i class="fas fa-check-circle"></i> <?php echo e(__('Verified')); ?></span>
                <?php endif; ?>
                <?php if($company->is_featured): ?>
                    <span class="ccl-featured-inline">★ <?php echo e(__('Featured')); ?></span>
                <?php endif; ?>
            </div>
            <?php if($company->description): ?>
                <p class="ccl-desc"><?php echo e(Str::limit(strip_tags($company->description), 100)); ?></p>
            <?php endif; ?>
            <div class="ccl-meta">
                <?php if($company->address): ?>
                    <span class="ccl-meta-item">
                        <i class="feather-map-pin"></i> <?php echo e(Str::limit($company->address, 30)); ?>

                    </span>
                <?php endif; ?>
                <?php if($company->year_founded): ?>
                    <span class="ccl-meta-item">
                        <i class="feather-calendar"></i> <?php echo e(__('Est. :year', ['year' => $company->year_founded])); ?>

                    </span>
                <?php endif; ?>
                <?php if($company->number_of_employees || $company->total_staff): ?>
                    <span class="ccl-meta-item">
                        <i class="feather-users"></i> <?php echo e($company->total_staff ?: $company->number_of_employees); ?> <?php echo e(__('Staff')); ?>

                    </span>
                <?php endif; ?>
                <?php if($company->phone): ?>
                    <span class="ccl-meta-item">
                        <i class="feather-phone"></i> <?php echo e($company->phone); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="ccl-right">
            <span class="ccl-jobs-count">
                <?php echo Theme::partial('job-count', compact('company')); ?>

            </span>
            <a href="<?php echo e($company->url); ?>" class="ccl-view-btn"><?php echo e(__('View Details')); ?> →</a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div style="text-align:center; padding:50px; color:#94a3b8;">
        <i class="feather-briefcase" style="font-size:44px; margin-bottom:14px; display:block;"></i>
        <p style="font-size:16px; font-weight:600;"><?php echo e(__('No companies found')); ?></p>
        <p style="font-size:14px;"><?php echo e(__('Try adjusting your search filters')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/company-list.blade.php ENDPATH**/ ?>