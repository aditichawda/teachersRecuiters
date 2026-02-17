<?php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
?>

<style>
/* Dashboard table wrapper – clean card UI */
.table-wrapper {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    border: 1px solid #eef2f6;
}
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #eef2f6;
}
.table-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #0f172a;
    margin: 0;
}
/* Table styling */
.table-wrapper .dataTables_wrapper {
    font-size: 0.9375rem;
}
.table-wrapper .table thead th {
    font-weight: 600;
    color: #475569;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    padding: 12px 14px;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}
.table-wrapper .table tbody td {
    padding: 14px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.table-wrapper .table tbody tr:hover {
    background: #fafbfc;
}
.table-wrapper .table .btn-link,
.table-wrapper .table a:not(.btn) {
    color: var(--primary-color, #0073d1);
    text-decoration: none;
}
.table-wrapper .table .btn-link:hover,
.table-wrapper .table a:not(.btn):hover {
    text-decoration: underline;
}
.table-wrapper .dataTables_filter input,
.table-wrapper .dataTables_length select {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    font-size: 0.875rem;
}
.table-wrapper .btn {
    border-radius: 8px;
    font-weight: 500;
}
.table-wrapper .dataTables_info,
.table-wrapper .dataTables_paginate {
    font-size: 0.875rem;
    color: #64748b;
}
</style>



<?php $__env->startSection('content'); ?>
    <div class="table-wrapper">
        <?php echo \Illuminate\View\Factory::parentPlaceholder('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core/table::table', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/dashboard/table/base.blade.php ENDPATH**/ ?>