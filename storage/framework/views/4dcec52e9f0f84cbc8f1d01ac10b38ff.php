<?php
    $applicationCount = $applications->count();
?>



<?php $__env->startSection('content'); ?>
<style>
    .applied-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .applied-page-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .applied-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .applied-filter-bar {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .applied-count-badge {
        background: #e8f4fc;
        color: #0073d1;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    .applied-filter-bar select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        color: #666;
    }
    .applied-job-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .applied-job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .applied-job-body {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .applied-job-logo {
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
    .applied-job-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .applied-job-info {
        flex: 1;
    }
    .applied-job-info h5 {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0 0 3px 0;
    }
    .applied-job-info h5 a {
        color: #333;
        text-decoration: none;
    }
    .applied-job-info h5 a:hover {
        color: #0073d1;
    }
    .applied-job-company {
        font-size: 13px;
        color: #0073d1;
        margin: 0 0 6px 0;
    }
    .applied-job-company a {
        color: #0073d1;
        text-decoration: none;
    }
    .applied-job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
    .applied-job-meta span {
        font-size: 12px;
        color: #888;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .applied-status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }
    .status-pending {
        background: #fff3e0;
        color: #e65100;
    }
    .status-approved {
        background: #e6f9ee;
        color: #1a9c4a;
    }
    .status-rejected {
        background: #ffebee;
        color: #c62828;
    }
    .applied-job-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .applied-job-actions .btn-view {
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
    .applied-job-actions .btn-view:hover {
        background: #0073d1;
        color: #fff;
        border-color: #0073d1;
    }
    .applied-empty {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .applied-empty i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 16px;
    }
    .applied-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .applied-empty p {
        color: #999;
        font-size: 14px;
    }
    .applied-pagination {
        margin-top: 20px;
    }
    @media (max-width: 576px) {
        .applied-page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .applied-job-body {
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
        }
        .applied-job-actions {
            align-self: flex-end;
        }
    }
</style>

<div class="applied-page-header">
    <h3><i class="fa fa-file-alt"></i><?php echo e(__('Applied Jobs')); ?></h3>
    <div class="applied-filter-bar">
        <span class="applied-count-badge"><?php echo e($applicationCount); ?> <?php echo e(__('applied')); ?></span>
        <form class="woocommerce-ordering apply-job-option" action="<?php echo e(URL::current()); ?>" method="GET">
            <select class="form-select" name="order_by" onchange="this.form.submit()">
                <option value="default" <?php if(request('order_by') == 'default'): echo 'selected'; endif; ?>><?php echo e(__('Default')); ?></option>
                <option value="newest" <?php if(request('order_by') == 'newest'): echo 'selected'; endif; ?>><?php echo e(__('Newest')); ?></option>
                <option value="oldest" <?php if(request('order_by') == 'oldest'): echo 'selected'; endif; ?>><?php echo e(__('Oldest')); ?></option>
            </select>
        </form>
    </div>
</div>

<?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php if($application->job): ?>
    <div class="applied-job-card">
        <div class="applied-job-body">
            <div class="applied-job-logo">
                <?php if(!$application->job->hide_company && $application->job->company): ?>
                    <a href="<?php echo e($application->job->company->url); ?>">
                        <img src="<?php echo e($application->job->company->logo_thumb); ?>" alt="<?php echo e($application->job->company->name); ?>">
                    </a>
                <?php elseif(Theme::getLogo()): ?>
                    <?php echo Theme::getLogoImage([], 'logo', 44); ?>

                <?php endif; ?>
            </div>
            <div class="applied-job-info">
                <h5><a href="<?php echo e($application->job->url); ?>"><?php echo e($application->job->name); ?></a></h5>
                <?php if(!$application->job->hide_company && $application->job->company): ?>
                    <p class="applied-job-company"><a href="<?php echo e($application->job->company->url); ?>"><?php echo e($application->job->company->name); ?></a></p>
                <?php endif; ?>
                <div class="applied-job-meta">
                    <span><i class="fa fa-calendar-alt"></i> <?php echo e(__('Applied')); ?>: <?php echo e($application->created_at->format('M d, Y')); ?></span>
                    <?php if($application->job->expire_date): ?>
                        <span><i class="fa fa-clock"></i> <?php echo e(__('Expires')); ?>: <?php echo e($application->job->expire_date); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="applied-job-actions">
                <a href="<?php echo e($application->job->url); ?>" class="btn-view" title="<?php echo e(__('View Job')); ?>">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="applied-empty">
        <i class="fa fa-file-alt"></i>
        <h5><?php echo e(__('No Applications Yet')); ?></h5>
        <p><?php echo e(__('Start applying for jobs to see them here')); ?></p>
    </div>
<?php endif; ?>

<?php if($applications->hasPages()): ?>
    <div class="applied-pagination">
        <?php echo e($applications->links(Theme::getThemeNamespace('partials.pagination'))); ?>

    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/jobs/applied.blade.php ENDPATH**/ ?>