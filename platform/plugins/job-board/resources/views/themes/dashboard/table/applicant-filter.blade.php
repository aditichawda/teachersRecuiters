@php
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
@endphp
<div class="applicant-simple-filter">
    <p class="mb-2 small text-muted fw-semibold">{{ trans('core/table::table.filters') }}</p>
    <form method="get" action="{{ request()->url() }}" class="filter-form applicant-filter-simple-form">
        @foreach(request()->except(['filter_table_id', 'class', 'filter_columns', 'filter_operators', 'filter_values']) as $key => $val)
            @if(is_array($val))
                @foreach($val as $k => $v)
                    <input type="hidden" name="{{ $key }}[{{ $k }}]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
            @endif
        @endforeach
        <input type="hidden" name="filter_table_id" value="{{ $tableId }}">
        <input type="hidden" name="class" value="{{ $class }}">
        <div class="row g-2 align-items-end flex-wrap">
            <div class="col-auto">
                <label class="form-label small mb-1">{{ $columns['job_id']['title'] ?? trans('plugins/job-board::dashboard.filter_by_job') }}</label>
                <input type="hidden" name="filter_columns[]" value="job_id">
                <input type="hidden" name="filter_operators[]" value="=">
                <select name="filter_values[]" class="form-select form-select-sm" style="min-width:160px;">
                    @foreach($jobChoices as $optVal => $optLabel)
                        <option value="{{ $optVal }}" {{ (string)$optVal === (string)$jobId ? 'selected' : '' }}>{{ $optLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1">{{ $columns['status']['title'] ?? trans('plugins/job-board::dashboard.filter_by_status') }}</label>
                <input type="hidden" name="filter_columns[]" value="status">
                <input type="hidden" name="filter_operators[]" value="=">
                <select name="filter_values[]" class="form-select form-select-sm" style="min-width:140px;">
                    @foreach($statusChoices as $optVal => $optLabel)
                        <option value="{{ $optVal }}" {{ (string)$optVal === (string)$statusVal ? 'selected' : '' }}>{{ $optLabel }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1">{{ $columns['created_at_from']['title'] ?? trans('plugins/job-board::dashboard.filter_date_from') }}</label>
                <input type="hidden" name="filter_columns[]" value="created_at_from">
                <input type="hidden" name="filter_operators[]" value=">=">
                <input type="date" name="filter_values[]" class="form-control form-control-sm" value="{{ $dateFrom }}" style="min-width:140px;">
            </div>
            <div class="col-auto">
                <label class="form-label small mb-1">{{ $columns['created_at_to']['title'] ?? trans('plugins/job-board::dashboard.filter_date_to') }}</label>
                <input type="hidden" name="filter_columns[]" value="created_at_to">
                <input type="hidden" name="filter_operators[]" value="<=">
                <input type="date" name="filter_values[]" class="form-control form-control-sm" value="{{ $dateTo }}" style="min-width:140px;">
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary btn-sm btn-apply">{{ trans('core/table::table.apply') }}</button>
                <button type="button" class="btn btn-outline-secondary btn-sm ms-1 applicant-filter-clear-btn" data-clear-href="{{ request()->url() }}">{{ trans('core/table::table.clear') }}</button>
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
</script>