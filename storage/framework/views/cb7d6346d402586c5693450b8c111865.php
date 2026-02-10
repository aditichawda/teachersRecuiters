<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['col-md-12 m-b30', $class ?? 'col-lg-6']); ?>">
            <?php echo Theme::partial("jobs.style-$style", compact('job')); ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <?php endif; ?>
</div>

<?php if($jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
    <?php echo e($jobs->links(Theme::getThemeNamespace('partials.pagination'))); ?>

<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/jobs/grid.blade.php ENDPATH**/ ?>