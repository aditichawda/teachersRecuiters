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
}

.emp-dash-header h2 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.emp-dash-header a {
    color: #0073d1;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
}

.emp-dash-header a:hover {
    color: #005ba1;
}

/* Credits Section */
.emp-credits-info {
    background: #fff;
    border-radius: 12px;
    padding: 15px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.emp-credits-info i {
    font-size: 22px;
    color: #f59e0b;
}

.emp-credits-info .credits-text {
    font-size: 14px;
    color: #555;
}

.emp-credits-info .credits-text strong {
    color: #333;
    font-size: 18px;
}

.emp-credits-info a {
    margin-left: auto;
    color: #0073d1;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
}

/* Stat Cards */
.emp-stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.emp-stat-card {
    border-radius: 12px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.emp-stat-card.blue { background: linear-gradient(135deg, #2196F3, #1976D2); }
.emp-stat-card.green { background: linear-gradient(135deg, #4CAF50, #388E3C); }
.emp-stat-card.red { background: linear-gradient(135deg, #f44336, #c62828); }

.emp-stat-card h6 {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 8px 0;
    opacity: 0.9;
}

.emp-stat-card h2 {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
}

.emp-stat-card .stat-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    opacity: 0.2;
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
    padding: 16px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.emp-content-card-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

.emp-content-card-body {
    padding: 0;
}

/* Applicant/Activity Item */
.emp-list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.15s;
}

.emp-list-item:last-child { border-bottom: none; }
.emp-list-item:hover { background: #fafafa; }

.emp-list-item .item-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 14px;
}

.emp-list-item .item-icon.blue { background: #e3f2fd; color: #1976D2; }
.emp-list-item .item-icon.green { background: #e8f5e9; color: #388E3C; }
.emp-list-item .item-icon.gray { background: #f5f5f5; color: #888; }

.emp-list-item .item-info {
    flex: 1;
    min-width: 0;
}

.emp-list-item .item-info h6 {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 2px 0;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
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
    padding: 30px 20px;
    color: #999;
}

.emp-empty-state i {
    font-size: 32px;
    margin-bottom: 10px;
    display: block;
    opacity: 0.4;
}

.emp-empty-state h6 {
    font-size: 15px;
    color: #666;
    margin: 0 0 5px 0;
}

.emp-empty-state p {
    font-size: 13px;
    margin: 0;
}

@media (max-width: 768px) {
    .emp-stats-row {
        grid-template-columns: 1fr;
    }
    .emp-content-row {
        grid-template-columns: 1fr;
    }
    .emp-dash-header {
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }
}
</style>

<div class="emp-dash-header">
    <h2>{{ __('Dashboard') }}</h2>
    <a href="{{ url('/') }}">{{ __('GO TO HOMEPAGE') }} →</a>
</div>

@if(isset($account) && $account->credits !== null)
<div class="emp-credits-info">
    <i class="fa fa-coins"></i>
    <div class="credits-text">
        {{ __('Credits') }}<br>
        <strong>{{ $account->credits ?? 0 }}</strong>
    </div>
    @if(JobBoardHelper::isEnabledCreditsSystem())
    <a href="{{ route('public.account.packages') }}">{{ __('Buy credits') }}</a>
    @endif
</div>
@endif

<!-- Alert for buy credits -->
@if(isset($account) && JobBoardHelper::isEnabledCreditsSystem() && ($account->credits ?? 0) <= 0)
<div class="alert alert-info d-flex align-items-center mb-4" style="border-radius: 8px;">
    <i class="fa fa-info-circle me-2"></i>
    <span>{{ __('Please add your credit to create your own posts here:') }} <a href="{{ route('public.account.packages') }}">{{ __('Buy credits') }}</a> {{ $account->credits ?? 0 }}</span>
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
        <h2>{{ $totalCompanies ?? 0 }}</h2>
        <i class="fa fa-university stat-icon"></i>
    </div>
    <div class="emp-stat-card red">
        <h6>{{ __('Applicants') }}</h6>
        <h2>{{ $totalApplicants ?? 0 }}</h2>
        <i class="fa fa-users stat-icon"></i>
    </div>
</div>

<!-- Content Row -->
<div class="emp-content-row">
    <!-- New Applicants -->
    <div class="emp-content-card">
        <div class="emp-content-card-header">
            <h5>{{ __('New Applicants') }}</h5>
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
            <h5>{{ __('Recent activities') }}</h5>
        </div>
        <div class="emp-content-card-body">
            @forelse($activities ?? [] as $activity)
                <div class="emp-list-item">
                    <div class="item-icon gray">
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
<div class="emp-content-card">
    <div class="emp-content-card-header">
        <h5>{{ __('Jobs About to Expire') }}</h5>
    </div>
    <div class="emp-content-card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Job Name') }}</th>
                        <th>{{ __('Company') }}</th>
                        <th>{{ __('Expire Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Applicants') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expiredJobs as $job)
                    <tr>
                        <td><a href="{{ route('public.account.jobs.edit', $job->id) }}" class="fw-bold text-decoration-none">{{ $job->name }}</a></td>
                        <td>{{ $job->company->name ?? '' }}</td>
                        <td>{{ BaseHelper::formatDate($job->expire_date) }}</td>
                        <td>{!! $job->status->toHtml() !!}</td>
                        <td>{{ $job->applicants_count }}</td>
                        <td>
                            <a href="{{ route('public.account.jobs.edit', $job->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection
