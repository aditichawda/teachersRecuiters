<ul>
    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li>
            <?php echo Theme::partial('jobs.style-1', compact('job')); ?>

        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
</ul>

<?php if($jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
    <?php echo e($jobs->links(Theme::getThemeNamespace('partials.pagination'))); ?>

<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/list.blade.php ENDPATH**/ ?>