<?php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable']);
?>

<div class="row">
    <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cand-card-grid" style="height: 100%; display: flex; flex-direction: column;">
                <?php if($candidate->is_featured): ?>
                    <span class="cg-featured"><?php echo e(__('Featured')); ?></span>
                <?php endif; ?>
                <div class="cg-avatar">
                    <img src="<?php echo e($candidate->avatar_url); ?>" alt="<?php echo e($candidate->name); ?>">
                </div>
                <a href="<?php echo e($candidate->url); ?>" class="cg-name"><?php echo e($candidate->name); ?></a>
                
                <?php
                    $cgLabels = ['cbse_school'=>'CBSE','icse_school'=>'ICSE','cambridge_school'=>'Cambridge','ib_school'=>'IB','state_board_school'=>'State Board','play_school'=>'Play School','engineering_college'=>'Engineering','medical_college'=>'Medical','nursing_college'=>'Nursing','edtech_company'=>'EdTech','coaching_institute'=>'Coaching','university'=>'University'];
                    $cgInst = $candidate->institution_types ?? [];
                    if (empty($cgInst) && !empty($candidate->institution_type)) $cgInst = [$candidate->institution_type];
                    $cgInst = is_array($cgInst) ? array_slice(array_filter($cgInst), 0, 3) : [];
                ?>
                
                <div class="cg-info-section" style="flex: 1; padding: 0 15px;">
                    <?php if(!empty($cgInst)): ?>
                        <p class="cg-tags mb-2">
                            <?php $__currentLoopData = $cgInst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-light text-primary" style="font-size:10px; margin-right: 4px;"><?php echo e($cgLabels[$it] ?? ucwords(str_replace('_',' ', $it))); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($candidate->phone): ?>
                        <p class="cg-phone mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-phone" style="font-size: 12px;"></i>
                            <span><?php echo e($candidate->phone); ?></span>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($candidate->city_name || $candidate->state_name): ?>
                        <p class="cg-location mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-map-pin" style="font-size: 12px;"></i>
                            <span>
                                <?php if($candidate->city_name): ?>
                                    <?php echo e($candidate->city_name); ?>

                                <?php endif; ?>
                                <?php if($candidate->city_name && $candidate->state_name): ?>, <?php endif; ?>
                                <?php if($candidate->state_name): ?>
                                    <?php echo e($candidate->state_name); ?>

                                <?php endif; ?>
                            </span>
                        </p>
                    <?php elseif($candidate->address): ?>
                        <p class="cg-location mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-map-pin" style="font-size: 12px;"></i>
                            <span><?php echo e(Str::limit($candidate->address, 40)); ?></span>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($candidate->expected_salary): ?>
                        <p class="cg-salary mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-dollar-sign" style="font-size: 12px;"></i>
                            <span><?php echo e(number_format($candidate->expected_salary)); ?> 
                                <?php if($candidate->expected_salary_period): ?>
                                    / <?php echo e(ucfirst($candidate->expected_salary_period)); ?>

                                <?php endif; ?>
                            </span>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($candidate->total_experience): ?>
                        <p class="cg-experience mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-briefcase" style="font-size: 12px;"></i>
                            <span><?php echo e($candidate->total_experience); ?> <?php echo e(__('Experience')); ?></span>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0): ?>
                        <div class="cg-skills mb-2" style="display: flex; flex-wrap: wrap; gap: 4px; margin-top: 8px;">
                            <?php $__currentLoopData = $candidate->favoriteSkills->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-secondary" style="font-size: 10px; padding: 3px 8px;"><?php echo e($skill->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($candidate->favoriteSkills->count() > 3): ?>
                                <span class="badge bg-light text-muted" style="font-size: 10px; padding: 3px 8px;">+<?php echo e($candidate->favoriteSkills->count() - 3); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($candidate->teaching_subjects): ?>
                        <?php
                            $subjects = is_array($candidate->teaching_subjects) ? $candidate->teaching_subjects : json_decode($candidate->teaching_subjects, true);
                            $subjects = is_array($subjects) ? array_slice(array_filter($subjects), 0, 2) : [];
                        ?>
                        <?php if(!empty($subjects)): ?>
                            <p class="cg-subjects mb-1" style="font-size: 12px; color: #555;">
                                <i class="feather-book" style="font-size: 11px; margin-right: 4px;"></i>
                                <span><?php echo e(implode(', ', $subjects)); ?></span>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if($candidate->description): ?>
                        <p class="cg-desc mt-2" style="font-size: 12px; color: #777; line-height: 1.4;">
                            <?php echo Str::limit(BaseHelper::clean($candidate->description), 100); ?>

                        </p>
                    <?php endif; ?>
                </div>
                
                <?php if(! JobBoardHelper::isDisabledPublicProfile() && $candidate->url): ?>
                    <a href="<?php echo e($candidate->url); ?>" class="cg-view-btn" style="margin-top: auto;"><?php echo e(__('View Profile')); ?> →</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/candidates/grid.blade.php ENDPATH**/ ?>