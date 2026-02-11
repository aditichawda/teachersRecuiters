<div style="font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; display: flex; background: #fff; min-height: 900px;">
    <!-- Left Sidebar -->
    <div style="width: 260px; min-width: 260px; background: linear-gradient(180deg, #0d47a1, #1967d2); color: #fff; padding: 35px 22px;">
        <!-- Avatar & Name -->
        <div style="text-align: center; margin-bottom: 25px;">
            <div style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; color: #fff; border: 3px solid rgba(255,255,255,0.4); overflow: hidden;">
                <?php if($account->avatar_url && !str_contains($account->avatar_url, 'default')): ?>
                    <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <?php echo e(strtoupper(substr($account->name ?: 'U', 0, 1))); ?>

                <?php endif; ?>
            </div>
            <h1 style="font-size: 18px; font-weight: 700; margin: 0 0 4px 0; letter-spacing: 0.5px;">
                <?php echo e($account->name ?: 'Your Name'); ?>

            </h1>
            <?php if($account->total_experience): ?>
                <p style="font-size: 11px; opacity: 0.8; margin: 0;"><?php echo e($account->total_experience); ?> Experience</p>
            <?php endif; ?>
        </div>

        <!-- Contact -->
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Contact
            </h3>
            <div style="font-size: 12px; line-height: 2;">
                <?php if($account->email): ?>
                    <div>📧 <?php echo e($account->email); ?></div>
                <?php endif; ?>
                <?php if($account->phone): ?>
                    <div>📞 <?php echo e($account->phone); ?></div>
                <?php endif; ?>
                <?php if($account->address): ?>
                    <div>📍 <?php echo e($account->address); ?></div>
                <?php elseif($account->state_name || $account->city_name): ?>
                    <div>📍 <?php echo e(implode(', ', array_filter([$account->city_name, $account->state_name]))); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Skills -->
        <?php if(count($skills) > 0): ?>
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Skills
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span style="background: rgba(255,255,255,0.15); padding: 3px 10px; border-radius: 12px; font-size: 11px;"><?php echo e($skill); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Languages -->
        <?php if($account->languages && count($account->languages) > 0): ?>
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Languages
            </h3>
            <?php $__currentLoopData = $account->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($lang['language'])): ?>
                <div style="margin-bottom: 6px;">
                    <div style="font-size: 12px; margin-bottom: 3px;"><?php echo e($lang['language']); ?></div>
                    <?php if(!empty($lang['proficiency'])): ?>
                    <div style="background: rgba(255,255,255,0.2); border-radius: 10px; height: 6px; overflow: hidden;">
                        <?php
                            $profPercent = match($lang['proficiency'] ?? '') {
                                'beginner' => 25,
                                'elementary' => 40,
                                'intermediate' => 60,
                                'advanced' => 80,
                                'native' => 100,
                                default => 50
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
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Certifications
            </h3>
            <?php $__currentLoopData = $account->teaching_certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="font-size: 11px; margin-bottom: 4px; padding-left: 12px; position: relative;">
                    <span style="position: absolute; left: 0;">•</span> <?php echo e($cert); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Right Content -->
    <div style="flex: 1; padding: 35px 30px;">
        <!-- Professional Summary -->
        <?php if($account->career_aspiration): ?>
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                About Me
            </h2>
            <p style="font-size: 13px; line-height: 1.7; color: #555; margin: 0;">
                <?php echo e(strip_tags($account->career_aspiration)); ?>

            </p>
        </div>
        <?php endif; ?>

        <!-- Experience -->
        <?php if($experiences->count() > 0): ?>
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                Experience
            </h2>
            <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-bottom: 16px; padding-left: 16px; border-left: 3px solid #1967d2;">
                <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($exp->position); ?></h3>
                    <span style="font-size: 11px; color: #999; background: #f5f5f5; padding: 2px 8px; border-radius: 10px;">
                        <?php echo e($exp->started_at ? $exp->started_at->format('M Y') : ''); ?> – <?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : 'Present'); ?>

                    </span>
                </div>
                <p style="font-size: 13px; color: #1967d2; margin: 3px 0 6px 0;"><?php echo e($exp->company); ?></p>
                <?php if($exp->description): ?>
                <p style="font-size: 12px; color: #666; line-height: 1.6; margin: 0;">
                    <?php echo e(Str::limit(strip_tags($exp->description), 200)); ?>

                </p>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <!-- Education -->
        <?php if($educations->count() > 0): ?>
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                Education
            </h2>
            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-bottom: 12px; padding-left: 16px; border-left: 3px solid #64b5f6;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($edu->specialized ?? $edu->description); ?></h3>
                <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0;"><?php echo e($edu->school); ?></p>
                <span style="font-size: 11px; color: #999;">
                    <?php echo e($edu->started_at ? $edu->started_at->format('Y') : ''); ?> – <?php echo e($edu->ended_at ? $edu->ended_at->format('Y') : 'Present'); ?>

                </span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-templates/modern.blade.php ENDPATH**/ ?>