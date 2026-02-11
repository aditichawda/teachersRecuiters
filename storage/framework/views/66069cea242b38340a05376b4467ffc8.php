<div style="font-family: 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; font-weight: 300; color: #222; margin: 0 0 8px 0; letter-spacing: -0.5px;">
            <?php echo e($account->name ?: 'Your Name'); ?>

        </h1>
        <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 13px; color: #777;">
            <?php if($account->email): ?>
                <span><?php echo e($account->email); ?></span>
            <?php endif; ?>
            <?php if($account->phone): ?>
                <span>·</span>
                <span><?php echo e($account->phone); ?></span>
            <?php endif; ?>
            <?php if($account->address): ?>
                <span>·</span>
                <span><?php echo e($account->address); ?></span>
            <?php elseif($account->state_name || $account->city_name): ?>
                <span>·</span>
                <span><?php echo e(implode(', ', array_filter([$account->city_name, $account->state_name]))); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <hr style="border: none; border-top: 1px solid #eee; margin: 0 0 25px 0;">

    <!-- Summary -->
    <?php if($account->career_aspiration): ?>
    <div style="margin-bottom: 28px;">
        <p style="font-size: 14px; line-height: 1.7; color: #555; margin: 0; font-weight: 300;">
            <?php echo e(strip_tags($account->career_aspiration)); ?>

        </p>
    </div>
    <?php endif; ?>

    <!-- Experience -->
    <?php if($experiences->count() > 0): ?>
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">
            Experience
        </h2>
        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 18px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 15px; font-weight: 500; color: #222; margin: 0; display: inline;"><?php echo e($exp->position); ?></h3>
                    <span style="font-size: 14px; color: #888; margin-left: 8px;">at <?php echo e($exp->company); ?></span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    <?php echo e($exp->started_at ? $exp->started_at->format('M Y') : ''); ?> – <?php echo e($exp->ended_at ? $exp->ended_at->format('M Y') : 'Present'); ?>

                </span>
            </div>
            <?php if($exp->description): ?>
            <p style="font-size: 13px; color: #666; line-height: 1.6; margin: 6px 0 0 0; font-weight: 300;">
                <?php echo e(strip_tags($exp->description)); ?>

            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Education -->
    <?php if($educations->count() > 0): ?>
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">
            Education
        </h2>
        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 14px; font-weight: 500; color: #222; margin: 0; display: inline;"><?php echo e($edu->specialized ?? $edu->description); ?></h3>
                    <span style="font-size: 13px; color: #888; margin-left: 8px;"><?php echo e($edu->school); ?></span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    <?php echo e($edu->started_at ? $edu->started_at->format('Y') : ''); ?> – <?php echo e($edu->ended_at ? $edu->ended_at->format('Y') : 'Present'); ?>

                </span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Skills -->
    <?php if(count($skills) > 0): ?>
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            Skills
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            <?php echo e(implode('  ·  ', $skills)); ?>

        </p>
    </div>
    <?php endif; ?>

    <!-- Languages -->
    <?php if($account->languages && count($account->languages) > 0): ?>
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            Languages
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            <?php
                $langList = [];
                foreach($account->languages as $lang) {
                    if (!empty($lang['language'])) {
                        $entry = $lang['language'];
                        if (!empty($lang['proficiency'])) $entry .= ' (' . ucfirst($lang['proficiency']) . ')';
                        $langList[] = $entry;
                    }
                }
            ?>
            <?php echo e(implode('  ·  ', $langList)); ?>

        </p>
    </div>
    <?php endif; ?>

    <!-- Certifications -->
    <?php if($account->teaching_certifications && count($account->teaching_certifications) > 0): ?>
    <div>
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            Certifications
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            <?php echo e(implode('  ·  ', $account->teaching_certifications)); ?>

        </p>
    </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/resume-templates/minimal.blade.php ENDPATH**/ ?>