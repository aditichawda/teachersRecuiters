<?php
    /** @var Botble\Table\Abstracts\TableAbstract $table */
    $filterColumns = request('filter_columns', []);
    $filterValues = request('filter_values', []);
    $jobId = '';
    $statusVal = '';
    $dateFrom = '';
    $dateTo = '';
    if (is_array($filterColumns)) {
        foreach ($filterColumns as $idx => $col) {
            $val = $filterValues[$idx] ?? '';
            if ($col === 'job_id') { $jobId = $val; }
            elseif ($col === 'status') { $statusVal = $val; }
            elseif ($col === 'created_at_from') { $dateFrom = $val; }
            elseif ($col === 'created_at_to') { $dateTo = $val; }
        }
    }
    $jobChoices = $columns['job_id']['choices'] ?? [];
    $statusChoices = $columns['status']['choices'] ?? [];
?>
<div class="applicant-simple-filter">
    <p class="mb-2 small text-muted fw-semibold"><?php echo e(trans('core/table::table.filters')); ?></p>
    <form method="get" action="<?php echo e(request()->url()); ?>" class="filter-form applicant-filter-simple-form">
        <?php $__currentLoopData = request()->except(['filter_table_id', 'class', 'filter_columns', 'filter_operators', 'filter_values']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_array($val)): ?>
                <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="<?php echo e($key); ?>[<?php echo e($k); ?>]" value="<?php echo e($v); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($val); ?>">
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="filter_table_id" value="<?php echo e($tableId); ?>">
        <input type="hidden" name="class" value="<?php echo e($class); ?>">
        <div class="row g-2 align-items-end flex-wrap">
            <div class="col-auto">
                <label class="form-label small mb-1"><?php echo e($columns['job_id']['title'] ?? trans('plugins/job-board::dashboard.filter_by_job')); ?></label>
                <input type="hidden" name="filter_columns[]" value="job_id">
                <input type="hidden" name="filter_operators[]" value="=">
                <select name="filter_values[]" class="form-select form-select-sm" style="min-width:160px;">
                    <?php $__currentLoopData = $jobChoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optVal => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optVal); ?>" <?php echo e((string)$optVal === (string)$jobId ? 'selected' : ''); ?>><?php echo e($optLabel); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1"><?php echo e($columns['status']['title'] ?? trans('plugins/job-board::dashboard.filter_by_status')); ?></label>
                <input type="hidden" name="filter_columns[]" value="status">
                <input type="hidden" name="filter_operators[]" value="=">
                <select name="filter_values[]" class="form-select form-select-sm" style="min-width:140px;">
                    <?php $__currentLoopData = $statusChoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optVal => $optLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optVal); ?>" <?php echo e((string)$optVal === (string)$statusVal ? 'selected' : ''); ?>><?php echo e($optLabel); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1"><?php echo e($columns['created_at_from']['title'] ?? trans('plugins/job-board::dashboard.filter_date_from')); ?></label>
                <input type="hidden" name="filter_columns[]" value="created_at_from">
                <input type="hidden" name="filter_operators[]" value=">=">
                <input type="date" name="filter_values[]" class="form-control form-control-sm" value="<?php echo e($dateFrom); ?>" style="min-width:140px;">
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1"><?php echo e($columns['created_at_to']['title'] ?? trans('plugins/job-board::dashboard.filter_date_to')); ?></label>
                <input type="hidden" name="filter_columns[]" value="created_at_to">
                <input type="hidden" name="filter_operators[]" value="<=">
                <input type="date" name="filter_values[]" class="form-control form-control-sm" value="<?php echo e($dateTo); ?>" style="min-width:140px;">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary btn-sm btn-apply"><?php echo e(trans('core/table::table.apply')); ?></button>
                <button type="button" class="btn btn-outline-secondary btn-sm ms-1 applicant-filter-clear-btn" data-clear-href="<?php echo e(request()->url()); ?>"><?php echo e(trans('core/table::table.clear')); ?></button>
            </div>
        </div>
    </form>
</div>
<script>
(function() {
    var form = document.querySelector('.applicant-filter-simple-form');
    if (form) {
        form.addEventListener('click', function(e) {
            var applyBtn = e.target.closest('.btn-apply');
            if (!applyBtn) return;
            e.preventDefault();
            var url = new URL(window.location.href);
            var fd = new FormData(form);
            url.search = '';
            fd.forEach(function(value, key) {
                url.searchParams.append(key, value === null || value === undefined ? '' : value);
            });
            window.history.pushState({}, '', url.toString());
            var tableIdInput = form.querySelector('input[name="filter_table_id"]');
            var tableId = tableIdInput ? tableIdInput.value : null;
            if (!tableId) {
                var tableWrap = form.closest('.table-wrapper');
                var table = tableWrap && tableWrap.querySelector('table');
                tableId = table ? table.id : null;
            }
            if (tableId && window.LaravelDataTables && window.LaravelDataTables[tableId]) {
                window.LaravelDataTables[tableId].ajax.url(url.toString()).load(null, false);
            }
        });
    }
    if (window._applicantFilterClearBound) return;
    window._applicantFilterClearBound = true;
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.applicant-filter-clear-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        var url = btn.getAttribute('data-clear-href');
        if (url) window.location.href = url;
    });
})();
</script><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/themes/dashboard/table/applicant-filter.blade.php ENDPATH**/ ?>