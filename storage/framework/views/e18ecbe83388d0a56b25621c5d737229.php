<?php
    Theme::set('pageTitle', __('Experience'));
?>



<?php $__env->startSection('content'); ?>
<style>
    .exp-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .exp-page-header h3 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .exp-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .btn-add-exp {
        background: #0073d1;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-add-exp:hover {
        background: #005bb5;
        color: #fff;
        text-decoration: none;
    }
    .exp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 16px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .exp-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .exp-card-body {
        padding: 20px 24px;
        display: flex;
        gap: 16px;
    }
    .exp-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: linear-gradient(135deg, #fbfcff, #b1c0ff);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0073d1;
        font-size: 20px;
    }
    .exp-content {
        flex: 1;
    }
    .exp-content h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 4px 0;
    }
    .exp-position {
        color: #0073d1;
        font-size: 14px;
        font-weight: 500;
        margin: 0 0 4px 0;
    }
    .exp-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 4px;
    }
    .exp-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #666;
    }
    .exp-meta-item i {
        font-size: 12px;
        color: #999;
    }
    .exp-type-badge {
        display: inline-block;
        background: #f0f0f0;
        color: #555;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    .exp-current-badge {
        display: inline-block;
        background: #e6f9ee;
        color: #1a9c4a;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        margin-left: 8px;
    }
    .exp-dates {
        color: #888;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .exp-description {
        color: #666;
        font-size: 13px;
        margin-top: 8px;
        line-height: 1.5;
    }
    .exp-actions {
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }
    .exp-actions .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0e0e0;
        background: #fff;
        color: #666;
        text-decoration: none;
        transition: all 0.2s;
        font-size: 14px;
    }
    .exp-actions .btn-action:hover {
        border-color: #0073d1;
        color: #0073d1;
        background: #f0f8ff;
    }
    .exp-actions .btn-action.btn-delete:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #fff5f5;
    }
    .exp-empty {
        text-align: center;
        /* padding: 60px 20px; */
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .exp-empty i {
        font-size: 28px;
        color: #fff;
        /* margin-bottom: 16px; */
    }
    .exp-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .exp-empty p {
        color: #999;
        font-size: 14px;
        margin-bottom: 20px;
    }
    @media (max-width: 576px) {
        .exp-page-header {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
        .exp-card-body {
            flex-direction: column;
            padding: 16px;
        }
        .exp-actions {
            justify-content: flex-end;
        }
        .exp-meta {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>

<div class="exp-page-header">
    <h3><i class="fa fa-briefcase"></i><?php echo e(__('Experience')); ?></h3>
    <a href="<?php echo e(route('public.account.experiences.create')); ?>" class="btn-add-exp">
        <i class="fa fa-plus"></i> <?php echo e(__('Add Experience')); ?>

    </a>
</div>

<?php $__empty_1 = true; $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="exp-card">
        <div class="exp-card-body">
            <div class="exp-icon">
                <i class="fa fa-briefcase"></i>
            </div>
            <div class="exp-content">
                <h5><?php echo BaseHelper::clean($experience->company); ?></h5>
                <?php if($position = $experience->position): ?>
                    <p class="exp-position"><?php echo BaseHelper::clean($position); ?></p>
                <?php endif; ?>
                <div class="exp-meta">
                    <?php if($experience->employment_type): ?>
                        <span class="exp-type-badge"><?php echo e(str_replace('_', ' ', ucfirst($experience->employment_type))); ?></span>
                    <?php endif; ?>
                    <?php if($experience->location): ?>
                        <span class="exp-meta-item"><i class="fa fa-map-marker-alt"></i> <?php echo e($experience->location); ?></span>
                    <?php endif; ?>
                </div>
                <div class="exp-dates">
                    <i class="fa fa-calendar-alt"></i>
                    <?php echo e($experience->started_at->format('M Y')); ?> -
                    <?php if($experience->is_current): ?>
                        <span><?php echo e(__('Present')); ?></span>
                        <span class="exp-current-badge"><?php echo e(__('Currently Working')); ?></span>
                    <?php else: ?>
                        <?php echo e($experience->ended_at ? $experience->ended_at->format('M Y') : __('Present')); ?>

                    <?php endif; ?>
                    <?php
                        $endDate = $experience->is_current ? now() : ($experience->ended_at ?? now());
                        $diff = $experience->started_at->diff($endDate);
                        $duration = '';
                        if($diff->y > 0) $duration .= $diff->y . ' yr' . ($diff->y > 1 ? 's' : '');
                        if($diff->m > 0) $duration .= ($duration ? ' ' : '') . $diff->m . ' mo' . ($diff->m > 1 ? 's' : '');
                        if(!$duration) $duration = '< 1 month';
                    ?>
                    <span class="exp-meta-item" style="margin-left: 8px;">(<?php echo e($duration); ?>)</span>
                </div>
                <?php if($description = $experience->description): ?>
                    <div class="exp-description">
                        <?php echo Str::limit(strip_tags($description), 200); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="exp-actions">
                <a href="<?php echo e(route('public.account.experiences.edit', $experience->id)); ?>" class="btn-action" title="<?php echo e(__('Edit')); ?>">
                    <i class="fa fa-pen"></i>
                </a>
                <form method="post" action="<?php echo e(route('public.account.experiences.destroy', $experience->id)); ?>" style="margin:0;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button onclick="return confirm('<?php echo e(__('Are you sure you want to delete this experience?')); ?>');" type="submit" class="btn-action btn-delete" title="<?php echo e(__('Delete')); ?>">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="exp-empty">
        <i class="fa fa-briefcase"></i>
        <h5><?php echo e(__('No Experience Added Yet')); ?></h5>
        <p><?php echo e(__('Add your work experience to strengthen your profile')); ?></p>
        <a href="<?php echo e(route('public.account.experiences.create')); ?>" class="btn-add-exp">
            <i class="fa fa-plus"></i> <?php echo e(__('Add Your First Experience')); ?>

        </a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/experiences/index.blade.php ENDPATH**/ ?>