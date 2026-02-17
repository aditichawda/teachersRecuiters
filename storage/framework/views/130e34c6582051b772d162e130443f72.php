<?php
    $displayEducations = $educations->isNotEmpty() ? $educations : collect([
        (object)['school' => __('Your School / University'), 'specialized' => __('Degree e.g. B.Ed, M.A'), 'description' => null, 'started_at' => null, 'ended_at' => null],
    ]);
    $displayExperiences = $experiences->isNotEmpty() ? $experiences : collect([
        (object)['company' => __('School / Institution Name'), 'position' => __('Position e.g. Teacher'), 'description' => null, 'started_at' => null, 'ended_at' => null],
    ]);
    $displaySkills = !empty($skills) ? $skills : [__('Teaching'), __('Communication'), __('Classroom Management'), __('Add your skills in profile')];
    $summaryText = $account->career_aspiration ? strip_tags($account->career_aspiration) : ($account->description ? strip_tags($account->description) : ($account->bio ? strip_tags($account->bio) : __('Passionate educator committed to student growth. Complete your profile to personalize this summary.')));
    $displayName = $account->name ?: __('Your Name');
    $displayEmail = $account->email ?: 'your.email@example.com';
    $displayPhone = $account->phone ?: __('Your Phone');
    $displayLocation = $account->address ?: (($account->city_name || $account->state_name) ? implode(', ', array_filter([$account->city_name, $account->state_name])) : __('Your City, State'));
?>
<div style="font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; max-width: 900px; margin: 0 auto; display: flex; background: #fff; min-height: 920px; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
    <!-- Left Sidebar -->
    <div style="width: 280px; min-width: 280px; background: linear-gradient(180deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%); color: #fff; padding: 40px 24px;">
        <!-- Avatar & Name -->
        <div style="text-align: center; margin-bottom: 28px;">
            <div style="width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 700; color: #fff; border: 3px solid rgba(255,255,255,0.4); overflow: hidden;">
                <?php if($account->avatar_url && !str_contains($account->avatar_url, 'default')): ?>
                    <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($displayName); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <?php echo e(strtoupper(substr($displayName, 0, 1))); ?>

                <?php endif; ?>
            </div>
            <h1 style="font-size: 20px; font-weight: 700; margin: 0 0 6px 0; letter-spacing: 0.5px; line-height: 1.3;">
                <?php echo e($displayName); ?>

            </h1>
            <?php if($account->designation): ?>
                <p style="font-size: 12px; opacity: 0.9; margin: 0;"><?php echo e($account->designation); ?></p>
            <?php elseif($account->total_experience): ?>
                <p style="font-size: 11px; opacity: 0.85; margin: 0;"><?php echo e($account->total_experience); ?> <?php echo e(__('Experience')); ?></p>
            <?php endif; ?>
        </div>

        <!-- Contact -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                <?php echo e(__('Contact')); ?>

            </h3>
            <div style="font-size: 12px; line-height: 2.2;">
                <div>📧 <?php echo e($displayEmail); ?></div>
                <div>📞 <?php echo e($displayPhone); ?></div>
                <div>📍 <?php echo e($displayLocation); ?></div>
            </div>
        </div>

        <!-- Skills -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                <?php echo e(__('Skills')); ?>

            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php $__currentLoopData = $displaySkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 14px; font-size: 11px;"><?php echo e(is_string($skill) ? $skill : ($skill->name ?? '')); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Languages -->
        <?php if($account->languages && count($account->languages) > 0): ?>
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                <?php echo e(__('Languages')); ?>

            </h3>
            <?php $__currentLoopData = $account->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($lang['language'])): ?>
                <div style="margin-bottom: 8px;">
                    <div style="font-size: 12px; margin-bottom: 4px;"><?php echo e($lang['language']); ?></div>
                    <?php if(!empty($lang['proficiency'])): ?>
                    <div style="background: rgba(255,255,255,0.15); border-radius: 10px; height: 6px; overflow: hidden;">
                        <?php
                            $profPercent = match($lang['proficiency'] ?? '') {
                                'beginner' => 25, 'elementary' => 40, 'intermediate' => 60, 'advanced' => 80, 'native' => 100, default => 50
                            };
                        ?>
                        <div style="background: #64b5f6; height: 100%; width: <?php echo e($profPercent); ?>%; border-radius: 10px;"></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <!-- Certifications -->
        <?php if($account->teaching_certifications && count($account->teaching_certifications) > 0): ?>
        <div>
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                <?php echo e(__('Certifications')); ?>

            </h3>
            <?php $__currentLoopData = $account->teaching_certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="font-size: 11px; margin-bottom: 6px; padding-left: 14px; position: relative;">
                    <span style="position: absolute; left: 0;">•</span> <?php echo e($cert); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Right Content -->
    <div style="flex: 1; padding: 40px 36px;">
        <!-- Professional Summary -->
        <?php if($summaryText): ?>
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 12px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                <?php echo e(__('About Me')); ?>

            </h2>
            <p style="font-size: 13px; line-height: 1.75; color: #555; margin: 0;">
                <?php echo e($summaryText); ?>

            </p>
        </div>
        <?php endif; ?>

        <!-- Experience -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                <?php echo e(__('Experience')); ?>

            </h2>
            <?php $__currentLoopData = $displayExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-bottom: 18px; padding-left: 18px; border-left: 3px solid #1976d2;">
                <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($exp->position); ?></h3>
                    <span style="font-size: 11px; color: #999; background: #f5f5f5; padding: 3px 10px; border-radius: 12px;">
                        <?php echo e($exp->started_at ? $exp->started_at->format('M Y') : '—'); ?> – <?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : __('Present')); ?>

                    </span>
                </div>
                <p style="font-size: 13px; color: #1565c0; margin: 4px 0 8px 0; font-weight: 500;"><?php echo e($exp->company); ?></p>
                <?php if(!empty($exp->description)): ?>
                <p style="font-size: 12px; color: #666; line-height: 1.65; margin: 0;">
                    <?php echo e(Str::limit(strip_tags($exp->description), 220)); ?>

                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Education -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                <?php echo e(__('Education')); ?>

            </h2>
            <?php $__currentLoopData = $displayEducations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-bottom: 14px; padding-left: 18px; border-left: 3px solid #42a5f5;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($edu->specialized ?? $edu->description ?? __('Degree')); ?></h3>
                <p style="font-size: 13px; color: #1565c0; margin: 2px 0 0 0; font-weight: 500;"><?php echo e($edu->school); ?></p>
                <span style="font-size: 11px; color: #999;">
                    <?php echo e($edu->started_at ? $edu->started_at->format('Y') : '—'); ?> – <?php echo e($edu->ended_at ? $edu->ended_at->format('Y') : __('Present')); ?>

                </span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-templates/modern.blade.php ENDPATH**/ ?>