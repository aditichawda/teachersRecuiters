<?php
    Theme::asset()->container('footer')->scriptUsingPath('jquery.dataTables', 'plugins/js/jquery.dataTables.min.js');
    Theme::asset()->container('footer')->scriptUsingPath('datatables-js', 'plugins/js/dataTables.bootstrap5.min.js');
    Theme::asset()->styleUsingPath('dataTables-css', 'plugins/css/dataTables.bootstrap5.min.css');
?>



<?php $__env->startSection('content'); ?>
<style>
    .saved-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .saved-page-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .saved-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .saved-count-badge {
        background: #e8f4fc;
        color: #0073d1;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    .saved-job-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .saved-job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .saved-job-body {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .saved-job-logo {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 10px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .saved-job-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .saved-job-info {
        flex: 1;
    }
    .saved-job-info h5 {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0 0 3px 0;
    }
    .saved-job-info h5 a {
        color: #333;
        text-decoration: none;
    }
    .saved-job-info h5 a:hover {
        color: #0073d1;
    }
    .saved-job-company {
        font-size: 13px;
        color: #0073d1;
        margin: 0 0 4px 0;
    }
    .saved-job-company a {
        color: #0073d1;
        text-decoration: none;
    }
    .saved-job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
    .saved-job-meta span {
        font-size: 12px;
        color: #888;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .saved-job-meta span i {
        font-size: 11px;
    }
    .saved-job-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .saved-job-actions .btn-view {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0e0e0;
        background: #fff;
        color: #0073d1;
        text-decoration: none;
        transition: all 0.2s;
    }
    .saved-job-actions .btn-view:hover {
        background: #0073d1;
        color: #fff;
        border-color: #0073d1;
    }
    .saved-empty {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .saved-empty i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 16px;
    }
    .saved-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .saved-empty p {
        color: #999;
        font-size: 14px;
    }
    @media (max-width: 576px) {
        .saved-job-body {
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
        }
        .saved-job-actions {
            align-self: flex-end;
        }
    }
</style>

<div class="saved-page-header">
    <h3><i class="fa fa-bookmark"></i><?php echo e(__('Saved Jobs')); ?></h3>
    <?php if($jobs->isNotEmpty()): ?>
        <span class="saved-count-badge"><?php echo e($jobs->count()); ?> <?php echo e(__('saved')); ?></span>
    <?php endif; ?>
</div>

<?php if($jobs->isNotEmpty()): ?>
    <?php $__currentLoopData = $jobs->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="saved-job-card">
            <div class="saved-job-body">
                <div class="saved-job-logo">
                    <?php if(!$job->hide_company && $job->company): ?>
                        <a href="<?php echo e($job->company->url); ?>">
                            <img src="<?php echo e($job->company->logo_thumb); ?>" alt="<?php echo e($job->company->name); ?>">
                        </a>
                    <?php elseif(Theme::getLogo()): ?>
                        <?php echo Theme::getLogoImage([], 'logo', 44); ?>

                    <?php endif; ?>
                </div>
                <div class="saved-job-info">
                    <h5><a href="<?php echo e($job->url); ?>"><?php echo e($job->name); ?></a></h5>
                    <?php if(!$job->hide_company && $job->company): ?>
                        <p class="saved-job-company"><a href="<?php echo e($job->company->url); ?>"><?php echo e($job->company->name); ?></a></p>
                    <?php endif; ?>
                    <div class="saved-job-meta">
                        <span><i class="fa fa-money-bill-wave"></i> <?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view') : $job->salary_text); ?></span>
                        <?php if($job->expire_date): ?>
                            <span><i class="fa fa-clock"></i> <?php echo e(__('Expires')); ?>: <?php echo e($job->expire_date); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="saved-job-actions">
                    <a href="<?php echo e($job->url); ?>" class="btn-view" title="<?php echo e(__('View Job')); ?>">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="saved-empty">
        <i class="fa fa-bookmark"></i>
        <h5><?php echo e(__('No Saved Jobs Yet')); ?></h5>
        <p><?php echo e(__('Save jobs you\'re interested in to review them later')); ?></p>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/jobs/saved.blade.php ENDPATH**/ ?>