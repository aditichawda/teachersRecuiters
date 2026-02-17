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
                <?php
                    $cgLabels = ['cbse_school'=>'CBSE','icse_school'=>'ICSE','cambridge_school'=>'Cambridge','ib_school'=>'IB','state_board_school'=>'State Board','play_school'=>'Play School','engineering_college'=>'Engineering','medical_college'=>'Medical','nursing_college'=>'Nursing','edtech_company'=>'EdTech','coaching_institute'=>'Coaching','university'=>'University'];
                    $cgInst = $candidate->institution_types ?? [];
                    if (empty($cgInst) && !empty($candidate->institution_type)) $cgInst = [$candidate->institution_type];
                    $cgInst = is_array($cgInst) ? array_slice(array_filter($cgInst), 0, 2) : [];
                ?>
                <?php if(!empty($cgInst)): ?>
                    <p class="cg-tags mb-1">
                        <?php $__currentLoopData = $cgInst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge bg-light text-primary" style="font-size:10px;"><?php echo e($cgLabels[$it] ?? ucwords(str_replace('_',' ', $it))); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
                <?php endif; ?>
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