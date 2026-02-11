<?php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
?>



<?php $__env->startSection('content'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/table::table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/table/base.blade.php ENDPATH**/ ?>