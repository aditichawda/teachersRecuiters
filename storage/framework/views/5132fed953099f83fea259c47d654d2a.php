<div style="font-family: 'Georgia', 'Times New Roman', serif; max-width: 800px; margin: 0 auto; padding: 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="text-align: center; padding-bottom: 20px; border-bottom: 3px solid #1967d2; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: 1px;">
            <?php echo e(strtoupper($account->name ?: 'Your Name')); ?>

        </h1>
        <?php if($account->career_aspiration): ?>
            <p style="font-size: 14px; color: #555; margin: 0 0 12px 0; font-style: italic;">
                <?php echo e(Str::limit(strip_tags($account->career_aspiration), 120)); ?>

            </p>
        <?php endif; ?>
        <div style="font-size: 12px; color: #666; display: flex; justify-content: center; flex-wrap: wrap; gap: 12px;">
            <?php if($account->email): ?>
                <span>📧 <?php echo e($account->email); ?></span>
            <?php endif; ?>
            <?php if($account->phone): ?>
                <span>📞 <?php echo e($account->phone); ?></span>
            <?php endif; ?>
            <?php if($account->address): ?>
                <span>📍 <?php echo e($account->address); ?></span>
            <?php elseif($account->state_name || $account->city_name): ?>
                <span>📍 <?php echo e(implode(', ', array_filter([$account->city_name, $account->state_name]))); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <!-- About / Career Aspiration -->
    <?php if($account->career_aspiration): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Professional Summary
        </h2>
        <p style="font-size: 13px; line-height: 1.7; color: #444; margin: 0;">
            <?php echo e(strip_tags($account->career_aspiration)); ?>

        </p>
    </div>
    <?php endif; ?>

    <!-- Experience -->
    <?php if($experiences->count() > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            Work Experience
        </h2>
        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($exp->position); ?></h3>
                <span style="font-size: 12px; color: #888;">
                    <?php echo e($exp->started_at ? $exp->started_at->format('M Y') : ''); ?>

                    –
                    <?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : 'Present'); ?>

                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 6px 0; font-weight: 500;">
                <?php echo e($exp->company); ?>

            </p>
            <?php if($exp->description): ?>
            <p style="font-size: 12px; color: #555; line-height: 1.6; margin: 0;">
                <?php echo e(strip_tags($exp->description)); ?>

            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Education -->
    <?php if($educations->count() > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            Education
        </h2>
        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;"><?php echo e($edu->specialized ?? $edu->description); ?></h3>
                <span style="font-size: 12px; color: #888;">
                    <?php echo e($edu->started_at ? $edu->started_at->format('Y') : ''); ?>

                    –
                    <?php echo e($edu->ended_at ? $edu->ended_at->format('Y') : 'Present'); ?>

                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0; font-weight: 500;">
                <?php echo e($edu->school); ?>

            </p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Skills -->
    <?php if(count($skills) > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Skills
        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span style="background: #f0f4ff; color: #1967d2; padding: 4px 12px; border-radius: 14px; font-size: 12px; font-weight: 500;"><?php echo e($skill); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Languages -->
    <?php if($account->languages && count($account->languages) > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Languages
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

    <!-- Teaching Certifications -->
    <?php if($account->teaching_certifications && count($account->teaching_certifications) > 0): ?>
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Certifications
        </h2>
        <ul style="margin: 0; padding: 0 0 0 18px; font-size: 13px; color: #444; line-height: 1.8;">
            <?php $__currentLoopData = $account->teaching_certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($cert); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-templates/classic.blade.php ENDPATH**/ ?>