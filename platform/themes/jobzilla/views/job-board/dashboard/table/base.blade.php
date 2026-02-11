@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

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

@extends('core/table::table')

@section('content')
    <div class="table-wrapper">
        @parent
    </div>
@stop
