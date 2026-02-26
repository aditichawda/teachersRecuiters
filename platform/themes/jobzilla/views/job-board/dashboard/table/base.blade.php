@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

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
    padding: 8px 5px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.table-wrapper .table thead th:nth-child(4),
.table-wrapper .table tbody td:nth-child(4) {
    max-width: 110px;
    width: 110px;
    word-break: break-all;
    overflow-wrap: break-word;
}
.table-wrapper .table tbody tr:hover {
    background: #fafbfc;
}
.table-wrapper .table .btn-link,
.table-wrapper .table a:not(.btn) {
    color: var(--primary-color, #0073d1);
    text-decoration: none;
    font-size: 14px;
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

/* Selected row: lighter blue background, white text (name + all columns) */
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
</style>

@extends('core/table::table')

@section('content')
    <div class="table-wrapper">
        @parent
    </div>
@stop
