<div class="row">
    <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cand-card-grid">
                <?php if($candidate->is_featured): ?>
                    <span class="cg-featured"><?php echo e(__('Featured')); ?></span>
                <?php endif; ?>
                <div class="cg-avatar">
                    <img src="<?php echo e($candidate->avatar_url); ?>" alt="<?php echo e($candidate->name); ?>">
                </div>
                <a href="<?php echo e($candidate->url); ?>" class="cg-name"><?php echo e($candidate->name); ?></a>
                <p class="cg-desc"><?php echo Str::limit(BaseHelper::clean($candidate->description), 80); ?></p>
                <?php if($candidate->address): ?>
                    <p class="cg-location">
                        <i class="feather-map-pin"></i> <?php echo e(Str::limit($candidate->address, 35)); ?>

                    </p>
                <?php endif; ?>
                <?php if(! JobBoardHelper::isDisabledPublicProfile()): ?>
                    <a href="<?php echo e($candidate->url); ?>" class="cg-view-btn"><?php echo e(__('View Profile')); ?> →</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/candidates/grid.blade.php ENDPATH**/ ?>