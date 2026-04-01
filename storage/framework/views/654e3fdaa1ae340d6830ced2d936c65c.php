<?php
    $companies->loadMissing(['country', 'state']);
?>

<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="company-card-grid">
                <?php if($company->effective_is_featured): ?>
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
                        <?php
                            $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
                            $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
                            $institutionTypeGroups = file_exists($pluginGroupsPath)
                                ? include $pluginGroupsPath
                                : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
                            $instLabelMap = [];
                            foreach ($institutionTypeGroups as $g) {
                                $instLabelMap = array_merge($instLabelMap, $g['options'] ?? []);
                            }
                            $raw = $company->institution_type;
                            $values = is_array($raw) ? $raw : (is_string($raw) ? preg_split('/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY) : [$raw]);
                            $values = array_values(array_filter(array_map(function ($v) {
                                $v = str_replace('_', '-', trim((string) $v));
                                return $v === 'icse-school' ? 'cicse-school' : $v;
                            }, (array) $values)));
                            $labels = array_values(array_filter(array_map(function ($v) use ($instLabelMap) {
                                if ($v === '') return null;
                                return $instLabelMap[$v] ?? ucfirst(str_replace('-', ' ', $v));
                            }, $values)));
                        ?>
                        <span class="ccg-type"><?php echo e(implode(', ', $labels)); ?></span>
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
            <div class="no-schools-message" style="text-align: center; padding: 60px 20px; color: #64748b;">
                <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5; display: block;"></i>
                <h4 style="color: #334155; margin-bottom: 10px;"><?php echo e(__('No schools available currently')); ?></h4>
                <p style="color: #94a3b8; font-size: 14px;"><?php echo e(__('Please try another category or check back later.')); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/companies/company-grid.blade.php ENDPATH**/ ?>