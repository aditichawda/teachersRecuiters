<?php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
?>

<style>
/* Custom styles for account jobs table */
.table-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f1f5f9;
}
.table-header h2 {
    font-size: 24px;
    font-weight: 700;
    color: #0c1e3c;
    margin: 0;
}
</style>



<?php $__env->startSection('content'); ?>
    <div class="table-wrapper">
        <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/table::table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/dashboard/table/base.blade.php ENDPATH**/ ?>