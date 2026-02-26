@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

@extends('core/table::table')

@section('content')
    @parent
@stop

@push('header')
<style>
/* Applicants table – UI & responsive, no overflow */
.table-wrapper {
    border-radius: 8px;
    max-width: 100%;
    width: 100%;
    min-width: 0;
    overflow: hidden;
    box-sizing: border-box;
}
.table-wrapper .card {
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    max-width: 100%;
    min-width: 0;
    overflow: hidden;
}
.table-wrapper .card-body {
    max-width: 100%;
    min-width: 0;
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
}
.table-wrapper .card-header {
    flex-wrap: wrap;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
}
.table-wrapper .table-action-buttons {
    flex-wrap: wrap;
    gap: 0.5rem;
}
.table-wrapper .table-responsive {
    overflow-x: auto !important;
    -webkit-overflow-scrolling: touch;
    margin: 0;
    max-width: 100%;
    min-width: 0;
}
.table-wrapper .dataTables_wrapper {
    min-width: 0;
    max-width: 100%;
    overflow: hidden;
}
.table-wrapper .table {
    margin-bottom: 0;
    min-width: 560px;
    width: 100%;
}
.table-wrapper .table thead th {
    white-space: nowrap;
    font-weight: 600;
    font-size: 0.8125rem;
    padding: 0.75rem 0.5rem;
    border-bottom: 1px solid rgba(0,0,0,.08);
}
.table-wrapper .table tbody td {
    padding: 0.75rem 0.5rem;
    vertical-align: middle;
    font-size: 0.875rem;
}
.table-wrapper .table thead th:nth-child(4),
.table-wrapper .table tbody td:nth-child(4) {
    max-width: 110px;
    width: 110px;
    word-break: break-all;
    overflow-wrap: break-word;
}
.table-wrapper .table .form-select.form-select-sm {
    min-width: 110px;
    font-size: 0.8125rem;
}
/* Selected row: lighter blue background, white text (including name column) */
.table-wrapper .table.dataTable tbody tr.selected td {
    background-color: #6ba3e0 !important;
    color: #fff !important;
}
.table-wrapper .table.dataTable tbody tr.selected td a,
.table-wrapper .table.dataTable tbody tr.selected td a.text-primary,
.table-wrapper .table.dataTable tbody tr.selected td a.text-decoration-none,
.table-wrapper .table.dataTable tbody tr.selected td span,
.table-wrapper .table.dataTable tbody tr.selected td .text-primary {
    color: #fff !important;
}
.table-wrapper .table.dataTable tbody tr.selected td a:hover {
    color: #e8f0f8 !important;
}
.table-wrapper .table.dataTable tbody tr.selected .form-select {
    color: #333;
    background-color: #fff;
}
@media (max-width: 991.98px) {
    .table-wrapper .card-header {
        padding: 0.875rem 1rem;
    }
    .table-wrapper .table-action-buttons .dropdown,
    .table-wrapper .table-action-buttons .btn {
        flex: 1 1 auto;
        min-width: 0;
    }
}
@media (max-width: 767.98px) {
    .table-wrapper .card-header {
        flex-direction: column;
        align-items: stretch;
    }
    .table-wrapper .card-header .d-flex {
        flex-direction: column;
    }
    .table-wrapper .table-action-buttons {
        width: 100%;
    }
    .table-wrapper .table-action-buttons .btn {
        flex: 1 1 auto;
    }
    .table-wrapper .table {
        min-width: 480px;
        font-size: 0.8125rem;
    }
    .table-wrapper .table thead th,
    .table-wrapper .table tbody td {
        padding: 0.5rem 0.35rem;
    }
}
</style>
@endpush

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('change', function(e) {
        var el = e.target;
        if (el.classList && el.classList.contains('applicant-status-select')) {
            var url = el.getAttribute('data-url');
            var status = el.value;
            if (!url) return;
            var td = el.closest('td');
            var meta = document.querySelector('meta[name="csrf-token"]');
            var token = meta ? meta.getAttribute('content') : '';
            el.disabled = true;
            el.classList.add('opacity-75');
            var loader = document.createElement('span');
            loader.className = 'applicant-status-loader ms-2 small text-muted';
            loader.textContent = 'Saving...';
            if (td) td.appendChild(loader);
            var formData = new FormData();
            formData.append('_token', token);
            formData.append('status', status);
            fetch(url, { method: 'POST', body: formData, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json().catch(function() { return {}; }); })
                .then(function(data) {
                    el.disabled = false;
                    el.classList.remove('opacity-75');
                    if (loader && loader.parentNode) loader.remove();
                    if (typeof Botble !== 'undefined') {
                        if (data && data.error === false) {
                            Botble.showSuccess(data.message || '{{ __("Updated successfully") }}');
                        } else {
                            Botble.showError((data && data.message) ? data.message : '{{ __("Update failed") }}');
                        }
                    } else {
                        if (data && data.error === false) alert('{{ __("Updated successfully") }}');
                        else alert((data && data.message) || '{{ __("Update failed") }}');
                    }
                })
                .catch(function() {
                    el.disabled = false;
                    el.classList.remove('opacity-75');
                    if (loader && loader.parentNode) loader.remove();
                    if (typeof Botble !== 'undefined') Botble.showError('{{ __("Update failed") }}');
                    else alert('{{ __("Update failed") }}');
                });
        }
    });
});
</script>
@endpush
