<?php if($company->jobs_count === 1): ?>
    <?php echo e(__(':count Opening Job', ['count' => $company->jobs_count])); ?>

<?php elseif($company->jobs_count > 1): ?>
    <?php echo e(__(':count Opening Jobs', ['count' => $company->jobs_count])); ?>

<?php else: ?>
    <?php echo e(__('No Opening Job')); ?>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/job-count.blade.php ENDPATH**/ ?>