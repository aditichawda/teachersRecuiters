<div class="page-next">
    <nav class="d-inline-block" aria-label="breadcrumb text-center">
        <ol class="breadcrumb justify-content-center">
            <?php $__currentLoopData = $crumbs = Theme::breadcrumb()->getCrumbs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$loop->last): ?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e($crumb['url']); ?>">
                            <?php echo BaseHelper::clean($crumb['label']); ?>

                        </a>
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo BaseHelper::clean($crumb['label']); ?>

                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/partials/breadcrumbs.blade.php ENDPATH**/ ?>