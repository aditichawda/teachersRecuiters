<?php
    Theme::set('pageTitle', __('Education'));
?>



<?php $__env->startSection('content'); ?>
<style>
    .edu-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .edu-page-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .edu-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .btn-add-edu {
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
    .btn-add-edu:hover {
        background: #005bb5;
        color: #fff;
        text-decoration: none;
    }
    .edu-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 16px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .edu-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .edu-card-body {
        padding: 20px 24px;
        display: flex;
        gap: 16px;
    }
    .edu-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: linear-gradient(135deg, #e8f4fc, #d0e8f7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0073d1;
        font-size: 20px;
    }
    .edu-content {
        flex: 1;
    }
    .edu-content h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 4px 0;
    }
    .edu-badge {
        display: inline-block;
        background: #e8f4fc;
        color: #0073d1;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 6px;
    }
    .edu-specialization {
        color: #555;
        font-size: 14px;
        margin: 0 0 4px 0;
    }
    .edu-dates {
        color: #888;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .edu-dates i {
        font-size: 12px;
    }
    .edu-current-badge {
        display: inline-block;
        background: #e6f9ee;
        color: #1a9c4a;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
        margin-left: 8px;
    }
    .edu-description {
        color: #666;
        font-size: 13px;
        margin-top: 8px;
        line-height: 1.5;
    }
    .edu-actions {
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }
    .edu-actions .btn-action {
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
    .edu-actions .btn-action:hover {
        border-color: #0073d1;
        color: #0073d1;
        background: #f0f8ff;
    }
    .edu-actions .btn-action.btn-delete:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #fff5f5;
    }
    .edu-empty {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .edu-empty i {
        font-size: 14px;
        color: #ccc;
      
    }
    .edu-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .edu-empty p {
        color: #999;
        font-size: 14px;
        margin-bottom: 20px;
    }
    @media (max-width: 576px) {
        .edu-page-header {
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
        }
        .edu-card-body {
            flex-direction: column;
            padding: 16px;
        }
        .edu-actions {
            justify-content: flex-end;
        }
    }
</style>

<div class="edu-page-header">
    <h3><i class="fa fa-graduation-cap"></i><?php echo e(__('Education')); ?></h3>
    <a href="<?php echo e(route('public.account.educations.create')); ?>" class="btn-add-edu">
        <i class="fa fa-plus"></i> <?php echo e(__('Add Education')); ?>

    </a>
</div>

<?php $__empty_1 = true; $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="edu-card">
        <div class="edu-card-body">
            <div class="edu-icon">
                <i class="fa fa-graduation-cap"></i>
            </div>
            <div class="edu-content">
                <h5><?php echo BaseHelper::clean($education->school); ?></h5>
                <?php if($education->level): ?>
                    <span class="edu-badge"><?php echo e(ucfirst($education->level)); ?></span>
                <?php endif; ?>
                <?php if($specialized = $education->specialized): ?>
                    <p class="edu-specialization"><i class="fa fa-bookmark me-1"></i> <?php echo BaseHelper::clean($specialized); ?></p>
                <?php endif; ?>
                <div class="edu-dates">
                    <i class="fa fa-calendar-alt"></i>
                    <?php echo e($education->started_at->format('M Y')); ?> -
                    <?php if($education->is_current): ?>
                        <span><?php echo e(__('Present')); ?></span>
                        <span class="edu-current-badge"><?php echo e(__('Currently Studying')); ?></span>
                    <?php else: ?>
                        <?php echo e($education->ended_at ? $education->ended_at->format('M Y') : __('Present')); ?>

                    <?php endif; ?>
                </div>
                <?php if($description = $education->description): ?>
                    <div class="edu-description">
                        <?php echo Str::limit(strip_tags($description), 200); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div class="edu-actions">
                <a href="<?php echo e(route('public.account.educations.edit', $education->id)); ?>" class="btn-action" title="<?php echo e(__('Edit')); ?>">
                    <i class="fa fa-pen"></i>
                </a>
                <form method="post" action="<?php echo e(route('public.account.educations.destroy', $education->id)); ?>" style="margin:0;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button onclick="return confirm('<?php echo e(__('Are you sure you want to delete this education?')); ?>');" type="submit" class="btn-action btn-delete" title="<?php echo e(__('Delete')); ?>">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="edu-empty">
        <i class="fa fa-graduation-cap"></i>
        <h5><?php echo e(__('No Education Added Yet')); ?></h5>
        <p><?php echo e(__('Add your educational qualifications to strengthen your profile')); ?></p>
        <a href="<?php echo e(route('public.account.educations.create')); ?>" class="btn-add-edu">
            <i class="fa fa-plus"></i> <?php echo e(__('Add Your First Education')); ?>

        </a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/educations/index.blade.php ENDPATH**/ ?>