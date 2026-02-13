@php
    Theme::set('pageTitle', __('Dashboard'));
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-employer'))

@section('content')
<style>
/* Dashboard Header */
.emp-dash-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.emp-dash-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.emp-dash-header a {
    color: #0073d1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

.emp-dash-header a:hover {
    text-decoration: underline;
}

/* Credits Section */
.emp-credits-info {
    background: linear-gradient(135deg, #fff3e0, #ffe0b2);
    border: 1px solid #ffcc80;
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 20px;
    font-size: 13px;
    color: #e65100;
    display: flex;
    align-items: center;
    gap: 8px;
}

.emp-credits-info i {
    font-size: 20px;
    color: #f57c00;
}

.emp-credits-info a {
    color: #e65100;
    font-weight: 600;
}

/* Stat Cards */
.emp-stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.emp-stat-card {
    border-radius: 12px;
    padding: 25px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.emp-stat-card.blue { background: linear-gradient(135deg, #0073d1, #005bb5); }
.emp-stat-card.green { background: linear-gradient(135deg, #28a745, #1e7e34); }
.emp-stat-card.red { background: linear-gradient(135deg, #fd7e14, #e06600); }

.emp-stat-card h6 {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 10px 0;
    opacity: 0.9;
}

.emp-stat-card h2 {
    font-size: 36px;
    font-weight: 700;
    margin: 0;
}

.emp-stat-card .stat-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 50px;
    opacity: 0.3;
}

/* Content Cards */
.emp-content-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.emp-content-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    overflow: hidden;
}

.emp-content-card-header {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.emp-content-card-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.emp-content-card-body {
    padding: 20px;
}

/* List Items */
.emp-list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.15s;
}

.emp-list-item:last-child { border-bottom: none; }

.emp-list-item .item-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
}

.emp-list-item .item-icon.blue { background: #e8f4fc; color: #0073d1; }
.emp-list-item .item-icon.green { background: #e8f5e9; color: #28a745; }
.emp-list-item .item-icon.gray { background: #f5f5f5; color: #888; }
.emp-list-item .item-icon.orange { background: #fff3e0; color: #f57c00; }

.emp-list-item .item-info {
    flex: 1;
    min-width: 0;
}

.emp-list-item .item-info h6 {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 3px 0;
    color: #333;
}

.emp-list-item .item-info h6 a {
    color: #333;
    text-decoration: none;
}

.emp-list-item .item-info h6 a:hover { color: #0073d1; }

.emp-list-item .item-info p {
    font-size: 12px;
    color: #888;
    margin: 0;
}

.emp-list-item .item-time {
    font-size: 12px;
    color: #999;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Empty State */
.emp-empty-state {
    text-align: center;
    padding: 40px 20px;
}

.emp-empty-state i {
    font-size: 50px;
    color: #ddd;
    margin-bottom: 15px;
    display: block;
}

.emp-empty-state h6 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.emp-empty-state p {
    font-size: 13px;
    color: #888;
    margin: 0;
}

/* Section Gap */
.emp-section-gap {
    margin-top: 20px;
}

@media (max-width: 991px) {
    .emp-stats-row {
        grid-template-columns: 1fr;
    }
    .emp-content-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .emp-dash-header {
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }
}
</style>

<!-- Header -->
<div class="emp-dash-header">
    <h2>{{ __('Dashboard') }}</h2>
    <a href="{{ url('/') }}">{{ __('GO TO HOMEPAGE') }} &rarr;</a>
</div>

<!-- Alert for buy credits -->
@if(isset($account) && JobBoardHelper::isEnabledCreditsSystem() && ($account->credits ?? 0) <= 0)
<div class="emp-credits-info">
    <i class="fa fa-gift"></i>
    <span>
        <strong>{{ __('Please add your credits to create your own posts.') }}</strong><br>
        <small><a href="{{ route('public.account.packages') }}">{{ __('Buy credits') }}</a> to start posting jobs.</small>
    </span>
</div>
@endif

<!-- Stats Cards -->
<div class="emp-stats-row">
    <div class="emp-stat-card blue">
        <h6>{{ __('Jobs') }}</h6>
        <h2>{{ $totalJobs ?? 0 }}</h2>
        <i class="fa fa-briefcase stat-icon"></i>
    </div>
    <div class="emp-stat-card green">
        <h6>{{ __('Institution') }}</h6>
        <h2>{{ $totalcompanies ?? 0 }}</h2>
        <i class="fa fa-university stat-icon"></i>
    </div>
    <div class="emp-stat-card red">
        <h6>{{ __('Applicants') }}</h6>
        <h2>{{ $totalApplicants ?? 0 }}</h2>
        <i class="fa fa-users stat-icon"></i>
    </div>
</div>

<!-- Content Row: Applicants + Recent Activities -->
<div class="emp-content-row">
    <!-- New Applicants -->
    <div class="emp-content-card">
        <div class="emp-content-card-header">
            <h5><i class="fa fa-user-friends me-2" style="color: #0073d1;"></i>{{ __('New Applicants') }}</h5>
        </div>
        <div class="emp-content-card-body">
            @forelse($newApplicants ?? [] as $applicant)
                <div class="emp-list-item">
                    <div class="item-icon blue">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="item-info">
                        <h6><a href="{{ route('public.account.applicants.edit', $applicant->id) }}">{{ $applicant->full_name }}</a></h6>
                        <p>{{ $applicant->email }}</p>
                    </div>
                </div>
            @empty
                <div class="emp-empty-state">
                    <i class="fa fa-user-friends"></i>
                    <h6>{{ __('No new applicants') }}</h6>
                    <p>{{ __('There are no new applicants.') }}</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="emp-content-card">
        <div class="emp-content-card-header">
            <h5><i class="fa fa-history me-2" style="color: #28a745;"></i>{{ __('Recent Activities') }}</h5>
        </div>
        <div class="emp-content-card-body">
            @forelse($activities ?? [] as $activity)
                <div class="emp-list-item">
                    <div class="item-icon green">
                        <i class="fa fa-clock"></i>
                    </div>
                    <div class="item-info">
                        <h6>{!! BaseHelper::clean($activity->getDescription(false)) !!}</h6>
                    </div>
                    <div class="item-time">
                        <i class="fa fa-clock"></i>
                        {{ $activity->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div class="emp-empty-state">
                    <i class="fa fa-history"></i>
                    <h6>{{ __('No recent activities') }}</h6>
                    <p>{{ __('Your recent activities will appear here.') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Expiring Jobs -->
@if(isset($expiredJobs) && count($expiredJobs) > 0)
<div class="emp-section-gap">
    <div class="emp-content-card">
        <div class="emp-content-card-header">
            <h5><i class="fa fa-exclamation-triangle me-2" style="color: #dc3545;"></i>{{ __('Jobs About to Expire') }}</h5>
        </div>
        <div class="emp-content-card-body">
            @foreach($expiredJobs as $job)
                <div class="emp-list-item">
                    <div class="item-icon orange">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="item-info">
                        <h6><a href="{{ route('public.account.jobs.edit', $job->id) }}">{{ $job->name }}</a></h6>
                        <p>{{ $job->company->name ?? '' }} &bull; Expires: {{ BaseHelper::formatDate($job->expire_date) }} &bull; {{ $job->applicants_count }} applicants</p>
                    </div>
                    <div class="item-time">
                        <a href="{{ route('public.account.jobs.edit', $job->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:6px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
