<?php ($companies->loadMissing(['country', 'state'])); ?>

<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="company-card-grid">
                <?php if($company->is_featured): ?>
                    <span class="ccg-featured">★ <?php echo e(__('Featured')); ?></span>
                <?php endif; ?>
                <?php if($company->is_verified): ?>
                    <span class="ccg-verified"><i class="fas fa-check-circle"></i> <?php echo e(__('Verified')); ?></span>
                <?php endif; ?>

                
                <div class="ccg-top">
                    <div class="ccg-logo">
                        <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($company->name); ?>">
                    </div>
                    <a href="<?php echo e($company->url); ?>" class="ccg-name">
                        <?php echo BaseHelper::clean($company->name); ?>

                    </a>
                    <?php if($company->institution_type): ?>
                        <span class="ccg-type"><?php echo e($company->institution_type); ?></span>
                    <?php endif; ?>
                </div>

                
                <div class="ccg-body">
                    <?php if($company->description): ?>
                        <p class="ccg-desc"><?php echo e(Str::limit(strip_tags($company->description), 90)); ?></p>
                    <?php endif; ?>

                    <div class="ccg-details">
                        <?php if($company->address || $company->state_name): ?>
                            <div class="ccg-detail">
                                <i class="feather-map-pin"></i>
                                <span><?php echo e(Str::limit($company->address ?: ($company->state->name ?? '') . ', ' . ($company->country->code ?? ''), 30)); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if($company->year_founded): ?>
                            <div class="ccg-detail">
                                <i class="feather-calendar"></i>
                                <span><?php echo e(__('Est. :year', ['year' => $company->year_founded])); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if($company->number_of_employees || $company->total_staff): ?>
                            <div class="ccg-detail">
                                <i class="feather-users"></i>
                                <span><?php echo e($company->total_staff ?: $company->number_of_employees); ?> <?php echo e(__('Employees')); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if($company->phone): ?>
                            <div class="ccg-detail">
                                <i class="feather-phone"></i>
                                <span><?php echo e($company->phone); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="ccg-footer">
                    <span class="ccg-jobs-count">
                        <?php echo Theme::partial('job-count', compact('company')); ?>

                    </span>
                    <a href="<?php echo e($company->url); ?>" class="ccg-view-btn"><?php echo e(__('View')); ?> →</a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div style="text-align:center; padding:50px; color:#94a3b8;">
                <i class="feather-briefcase" style="font-size:44px; margin-bottom:14px; display:block;"></i>
                <p style="font-size:16px; font-weight:600;"><?php echo e(__('No companies found')); ?></p>
                <p style="font-size:14px;"><?php echo e(__('Try adjusting your search filters')); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/companies/company-grid.blade.php ENDPATH**/ ?>