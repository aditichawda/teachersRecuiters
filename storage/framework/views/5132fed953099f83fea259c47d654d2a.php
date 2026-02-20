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
    $displayInterests = $account->interests ?: __('e.g. Reading, Educational workshops, Student mentoring');
    $displayActivities = $account->activities ?: __('e.g. School club coordinator, Annual day organizer');
    $displayAchievements = $account->achievements ?: __('e.g. Best Teacher Award, Workshop presenter');
?>
<div style="font-family: 'Georgia', 'Times New Roman', serif; max-width: 800px; margin: 0 auto; padding: 44px 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="text-align: center; padding-bottom: 22px; border-bottom: 3px solid #1967d2; margin-bottom: 28px;">
        <h1 style="font-size: 30px; font-weight: 700; color: #1a1a1a; margin: 0 0 8px 0; letter-spacing: 1px;">
            <?php echo e(strtoupper($displayName)); ?>

        </h1>
        <?php if($account->designation): ?>
            <p style="font-size: 14px; color: #1967d2; font-weight: 600; margin: 0 0 10px 0;"><?php echo e($account->designation); ?></p>
        <?php endif; ?>
        <?php if($summaryText && strlen($summaryText) > 10): ?>
            <p style="font-size: 13px; color: #555; margin: 0 0 14px 0; font-style: italic; max-width: 640px; margin-left: auto; margin-right: auto;">
                <?php echo e(Str::limit($summaryText, 140)); ?>

            </p>
        <?php endif; ?>
        <div style="font-size: 12px; color: #666; display: flex; justify-content: center; flex-wrap: wrap; gap: 14px;">
            <span>📧 <?php echo e($displayEmail); ?></span>
            <span>📞 <?php echo e($displayPhone); ?></span>
            <span>📍 <?php echo e($displayLocation); ?></span>
        </div>
    </div>

    <!-- Professional Summary -->
    <?php if($summaryText): ?>
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Professional Summary')); ?>

        </h2>
        <p style="font-size: 13px; line-height: 1.75; color: #444; margin: 0;">
            <?php echo e($summaryText); ?>

        </p>
    </div>
    <?php endif; ?>

    <!-- Experience -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 14px 0;">
            <?php echo e(__('Work Experience')); ?>

        </h2>
        <?php $__currentLoopData = $displayExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($exp->position); ?></h3>
                <span style="font-size: 12px; color: #888;">
                    <?php echo e($exp->started_at ? $exp->started_at->format('M Y') : '—'); ?>

                    –
                    <?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : __('Present')); ?>

                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 6px 0; font-weight: 500;">
                <?php echo e($exp->company); ?>

            </p>
            <?php if(!empty($exp->description)): ?>
            <p style="font-size: 12px; color: #555; line-height: 1.65; margin: 0;">
                <?php echo e(strip_tags($exp->description)); ?>

            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Education -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 14px 0;">
            <?php echo e(__('Education')); ?>

        </h2>
        <?php $__currentLoopData = $displayEducations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($edu->specialized ?? $edu->description ?? __('Degree')); ?></h3>
                <span style="font-size: 12px; color: #888;">
                    <?php echo e($edu->started_at ? $edu->started_at->format('Y') : '—'); ?>

                    –
                    <?php echo e($edu->ended_at ? $edu->ended_at->format('Y') : __('Present')); ?>

                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0; font-weight: 500;">
                <?php echo e($edu->school); ?>

            </p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Skills -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Skills')); ?>

        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
            <?php $__currentLoopData = $displaySkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="background: #f0f4ff; color: #1967d2; padding: 5px 14px; border-radius: 16px; font-size: 12px; font-weight: 500;"><?php echo e(is_string($skill) ? $skill : $skill->name ?? ''); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Interests -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Interests')); ?>

        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;"><?php echo e($displayInterests); ?></p>
    </div>

    <!-- Activities -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Activities')); ?>

        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;"><?php echo e($displayActivities); ?></p>
    </div>

    <!-- Achievements -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Achievements')); ?>

        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;"><?php echo e($displayAchievements); ?></p>
    </div>

    <!-- Languages -->
    <?php if($account->languages && count($account->languages) > 0): ?>
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Languages')); ?>

        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 16px;">
            <?php $__currentLoopData = $account->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!empty($lang['language'])): ?>
                <span style="font-size: 13px; color: #444;">
                    <?php echo e($lang['language']); ?>

                    <?php if(!empty($lang['proficiency'])): ?>
                        <span style="color: #999;">– <?php echo e(ucfirst($lang['proficiency'])); ?></span>
                    <?php endif; ?>
                </span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Certifications -->
    <?php if($account->teaching_certifications && count($account->teaching_certifications) > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            <?php echo e(__('Certifications')); ?>

        </h2>
        <ul style="margin: 0; padding: 0 0 0 18px; font-size: 13px; color: #444; line-height: 1.8;">
            <?php $__currentLoopData = $account->teaching_certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($cert); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <div style="text-align: center; padding-top: 20px; margin-top: 20px; border-top: 1px solid #eee; font-size: 11px; color: #999;">
        <?php echo e(__('Powered by TeachersRecruiters')); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-templates/classic.blade.php ENDPATH**/ ?>