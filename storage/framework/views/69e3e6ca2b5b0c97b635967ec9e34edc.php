<?php if($company->jobs_count === 1): ?>
    <?php echo e(__(':count Job Opening ', ['count' => $company->jobs_count])); ?>

<?php elseif($company->jobs_count > 1): ?>
    <?php echo e(__(':count Job Openings', ['count' => $company->jobs_count])); ?>

<?php else: ?>
    <?php echo e(__('No Job Openings')); ?>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/job-count.blade.php ENDPATH**/ ?>