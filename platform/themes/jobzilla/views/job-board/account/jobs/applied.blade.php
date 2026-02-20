@php
    $applicationCount = $applications->count();
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<style>
    .applied-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .applied-page-header h3 {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .applied-page-header h3 i {
        color: #0073d1;
        margin-right: 10px;
    }
    .applied-filter-bar {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .applied-count-badge {
        background: #e8f4fc;
        color: #0073d1;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
    }
    .applied-filter-bar select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        color: #666;
    }
    .applied-job-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 12px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s;
        overflow: hidden;
    }
    .applied-job-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        border-color: #0073d1;
    }
    .applied-job-body {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .applied-job-logo {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 10px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .applied-job-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .applied-job-info {
        flex: 1;
    }
    .applied-job-info h5 {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        margin: 0 0 3px 0;
    }
    .applied-job-info h5 a {
        color: #333;
        text-decoration: none;
    }
    .applied-job-info h5 a:hover {
        color: #0073d1;
    }
    .applied-job-company {
        font-size: 13px;
        color: #0073d1;
        margin: 0 0 6px 0;
    }
    .applied-job-company a {
        color: #0073d1;
        text-decoration: none;
    }
    .applied-job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }
    .applied-job-meta span {
        font-size: 12px;
        color: #000;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .applied-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 24px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: capitalize;
        border: 1.5px solid transparent;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .applied-status-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.12);
    }
    .status-pending {
        background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
        color: #e65100;
        border-color: #ffb74d;
    }
    .status-hired {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        color: #1b5e20;
        border-color: #66bb6a;
    }
    .status-short_list {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        color: #0d47a1;
        border-color: #42a5f5;
    }
    .status-rejected {
        background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
        color: #b71c1c;
        border-color: #ef5350;
    }
    .status-checked {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
        color: #4a148c;
        border-color: #ab47bc;
    }
    .applied-job-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .applied-job-actions .btn-view {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0e0e0;
        background: #fff;
        color: #0073d1;
        text-decoration: none;
        transition: all 0.2s;
    }
    .applied-job-actions .btn-view:hover {
        background: #0073d1;
        color: #fff;
        border-color: #0073d1;
    }
    .applied-empty {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .applied-empty i {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 16px;
    }
    .applied-empty h5 {
        color: #666;
        margin-bottom: 8px;
    }
    .applied-empty p {
        color: #999;
        font-size: 14px;
    }
    .applied-pagination {
        margin-top: 20px;
    }
    @media (max-width: 576px) {
        .applied-page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .applied-job-body {
            flex-direction: column;
            align-items: flex-start;
            padding: 16px;
        }
        .applied-job-actions {
            align-self: flex-end;
        }
    }
</style>

<div class="applied-page-header">
    <h3><i class="fa fa-file-alt"></i>{{ __('Applied Jobs') }}</h3>
    <div class="applied-filter-bar">
        <span class="applied-count-badge">{{ $applicationCount }} {{ __('applied') }}</span>
        <form class="woocommerce-ordering apply-job-option" action="{{ URL::current() }}" method="GET">
            <select class="form-select" name="order_by" onchange="this.form.submit()">
                <option value="default" @selected(request('order_by') == 'default')>{{ __('Default') }}</option>
                <option value="newest" @selected(request('order_by') == 'newest')>{{ __('Newest') }}</option>
                <option value="oldest" @selected(request('order_by') == 'oldest')>{{ __('Oldest') }}</option>
            </select>
        </form>
    </div>
</div>

@forelse ($applications as $application)
    @if($application->job)
    <div class="applied-job-card">
        <div class="applied-job-body">
            <div class="applied-job-logo">
                @if (!$application->job->hide_company && $application->job->company)
                    <a href="{{ $application->job->company->url }}">
                        <img src="{{ $application->job->company->logo_thumb }}" alt="{{ $application->job->company->name }}">
                    </a>
                @elseif(Theme::getLogo())
                    {!! Theme::getLogoImage([], 'logo', 44) !!}
                @endif
            </div>
            <div class="applied-job-info">
                <h5><a href="{{ $application->job->url }}">{{ $application->job->name }}</a></h5>
                @if($application->job->company)
                    <p class="applied-job-company">
                        @if(!$application->job->hide_company)
                            <a href="{{ $application->job->company->url }}">{{ $application->job->company->name }}</a>
                        @else
                            <span>{{ $application->job->company->name }}</span>
                        @endif
                    </p>
                @endif
                <div class="applied-job-meta">
                    <span><i class="fa fa-calendar-alt"></i> {{ __('Applied') }}: {{ $application->created_at->format('M d, Y') }}</span>
                    @if($application->job->expire_date)
                        <span><i class="fa fa-clock"></i> {{ __('Expires') }}: {{ $application->job->expire_date }}</span>
                    @endif
                    @php
                        $statusValue = $application->status ? $application->status->getValue() : 'pending';
                        $statusIcon = match($statusValue) {
                            'hired' => 'fa-check-circle',
                            'short_list' => 'fa-star',
                            'rejected' => 'fa-times-circle',
                            'checked' => 'fa-eye',
                            default => 'fa-hourglass-half',
                        };
                    @endphp
                    <span class="applied-status-badge status-{{ $statusValue }}">
                        <i class="fa {{ $statusIcon }}"></i>
                        {{ $application->status ? $application->status->label() : __('Pending') }}
                    </span>
                </div>
            </div>
            <div class="applied-job-actions">
                <a href="{{ $application->job->url }}" class="btn-view" title="{{ __('View Job') }}">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
@empty
    <div class="applied-empty">
        <i class="fa fa-file-alt"></i>
        <h5>{{ __('No Applications Yet') }}</h5>
        <p>{{ __('Start applying for jobs to see them here') }}</p>
    </div>
@endforelse

@if($applications->hasPages())
    <div class="applied-pagination">
        {{ $applications->links(Theme::getThemeNamespace('partials.pagination')) }}
    </div>
@endif
@endsection
