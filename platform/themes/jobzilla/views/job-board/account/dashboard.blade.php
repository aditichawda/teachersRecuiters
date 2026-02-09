@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    
    // Get counts
    $savedJobsCount = 0;
    $appliedJobsCount = 0;
    $profileViews = 0;
    
    try {
        if (auth('account')->check() && $account->isJobSeeker()) {
            $savedJobsCount = \Botble\JobBoard\Models\JobApplication::query()
                ->where('account_id', $account->id)
                ->where('is_saved', true)
                ->count();
            
            $appliedJobsCount = \Botble\JobBoard\Models\JobApplication::query()
                ->where('account_id', $account->id)
                ->where('is_saved', false)
                ->count();
        }
    } catch (\Exception $e) {
        // Silent fail
    }
    
    // Get recent applications
    $recentApplications = [];
    try {
        $recentApplications = \Botble\JobBoard\Models\JobApplication::query()
            ->where('account_id', $account->id)
            ->where('is_saved', false)
            ->with('job')
            ->latest()
            ->limit(5)
            ->get();
    } catch (\Exception $e) {
        // Silent fail
    }
    
    // Get recent/latest jobs
    $recentJobs = [];
    try {
        $recentJobs = \Botble\JobBoard\Models\Job::query()
            ->where('status', 'published')
            ->where(function($q) {
                $q->whereNull('expire_date')
                  ->orWhere('expire_date', '>=', now());
            })
            ->latest()
            ->limit(5)
            ->get();
    } catch (\Exception $e) {
        // Silent fail
    }
@endphp

<style>
.js-dashboard {
    padding: 0;
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
    margin-top: 20px;
    padding-top: 77px;
}

.js-dashboard-content {
    padding: 0 0 40px 0px;
}

/* Profile Card - Left Sidebar */
.js-profile-sidebar {
    background: #fff;
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.js-profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 15px;
}

.js-profile-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.js-profile-date {
    font-size: 13px;
    color: #888;
    margin: 0 0 20px 0;
}

.js-profile-completion {
    margin-bottom: 25px;
}

.js-profile-completion h6 {
    font-size: 13px;
    font-weight: 500;
    color: #666;
    margin: 0 0 8px 0;
}

.js-completion-bar {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
}

.js-completion-fill {
    height: 100%;
    background: #0073d1;
    border-radius: 3px;
}

.js-completion-text {
    font-size: 12px;
    color: #0073d1;
    margin-top: 5px;
}

/* Sidebar Navigation */
.js-sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.js-sidebar-nav li {
    margin-bottom: 5px;
}

.js-sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.js-sidebar-nav a:hover,
.js-sidebar-nav a.active {
    background: #e8f4fc;
    color: #0073d1;
}

.js-sidebar-nav a.active {
    border-left: 3px solid #0073d1;
}

.js-sidebar-nav i {
    width: 20px;
    text-align: center;
    font-size: 16px;
}

/* Dashboard Header */
.js-dash-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.js-dash-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-dash-header a {
    color: #0073d1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

.js-dash-header a:hover {
    text-decoration: underline;
}

/* Stats Cards */
.js-stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.js-stat-card {
    border-radius: 12px;
    padding: 25px;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.js-stat-card.blue { background: linear-gradient(135deg, #0073d1, #005bb5); }
.js-stat-card.green { background: linear-gradient(135deg, #28a745, #1e7e34); }
.js-stat-card.orange { background: linear-gradient(135deg, #fd7e14, #e06600); }

.js-stat-card h6 {
    font-size: 14px;
    font-weight: 500;
    margin: 0 0 10px 0;
    opacity: 0.9;
}

.js-stat-card h2 {
    font-size: 36px;
    font-weight: 700;
    margin: 0;
}

.js-stat-card .js-stat-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 50px;
    opacity: 0.3;
}

/* Content Sections */
.js-content-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.js-content-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.js-content-card-header {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.js-content-card-header h5 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-content-card-body {
    padding: 20px;
}

/* Empty State */
.js-empty-state {
    text-align: center;
    padding: 40px 20px;
}

.js-empty-state i {
    font-size: 50px;
    color: #ddd;
    margin-bottom: 15px;
}

.js-empty-state h6 {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.js-empty-state p {
    font-size: 13px;
    color: #888;
    margin: 0;
}

/* Application List */
.js-application-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.js-application-item:last-child {
    border-bottom: none;
}

.js-application-icon {
    width: 40px;
    height: 40px;
    background: #e8f4fc;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0073d1;
}

.js-application-info h6 {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin: 0 0 3px 0;
}

.js-application-info p {
    font-size: 12px;
    color: #888;
    margin: 0;
}

/* Responsive */
@media (max-width: 991px) {
    .js-stats-row {
        grid-template-columns: 1fr;
    }
    .js-content-row {
        grid-template-columns: 1fr;
    }
    .js-dashboard-content {
        padding: 20px 0 0 0;
    }
}

@media (max-width: 768px) {
    .js-profile-sidebar {
        display: none;
    }
    .js-dashboard-content {
        padding: 15px 0;
    }
}
</style>

<div class="js-dashboard">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="js-profile-sidebar">
                    <div class="text-center">
                        <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="js-profile-avatar">
                        <h5 class="js-profile-name">Hello, {{ $account->first_name ?? $account->name }}</h5>
                        <p class="js-profile-date">Joined {{ $account->created_at->format('M d, Y') }}</p>
                    </div>
                    
                    <!-- Profile Completion -->
                    @php
                        $completion = 0;
                        if($account->first_name) $completion += 15;
                        if($account->phone) $completion += 15;
                        if($account->resume) $completion += 25;
                        if($account->avatar) $completion += 15;
                        if($account->bio) $completion += 15;
                        if($account->address) $completion += 15;
                        $completion = min($completion, 100);
                    @endphp
                    <div class="js-profile-completion">
                        <h6>Profile Completion</h6>
                        <div class="js-completion-bar">
                            <div class="js-completion-fill" style="width: {{ $completion }}%"></div>
                        </div>
                        <span class="js-completion-text">{{ $completion }}% Complete</span>
                    </div>
                    
                    <!-- Navigation -->
                    <ul class="js-sidebar-nav">
                        <li><a href="{{ route('public.account.jobseeker.dashboard') }}" class="active"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('public.account.settings') }}"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="{{ route('public.account.jobs.saved') }}"><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="{{ route('public.account.jobs.applied-jobs') }}"><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="{{ route('public.account.experiences.index') }}"><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="{{ route('public.account.educations.index') }}"><i class="fa fa-graduation-cap"></i> Education</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="js-dashboard-content">
                    <!-- Header -->
                    <div class="js-dash-header">
                        <h2>Dashboard</h2>
                        <a href="{{ url('/') }}">GO TO HOMEPAGE →</a>
                    </div>
                    
                    <!-- Alert for incomplete profile -->
                    @if($completion < 80)
                    <div class="alert alert-info d-flex align-items-center mb-4" style="border-radius: 8px;">
                        <i class="fa fa-info-circle me-2"></i>
                        <span>Complete your profile to get better job matches! <a href="{{ route('public.account.settings') }}">Complete Profile</a></span>
                    </div>
                    @endif
                    
                    <!-- Stats Cards -->
                    <div class="js-stats-row">
                        <div class="js-stat-card blue">
                            <h6>Saved Jobs</h6>
                            <h2>{{ $savedJobsCount }}</h2>
                            <i class="fa fa-bookmark js-stat-icon"></i>
                        </div>
                        <div class="js-stat-card green">
                            <h6>Applied Jobs</h6>
                            <h2>{{ $appliedJobsCount }}</h2>
                            <i class="fa fa-file-alt js-stat-icon"></i>
                        </div>
                        <div class="js-stat-card orange">
                            <h6>Profile Views</h6>
                            <h2>{{ $profileViews }}</h2>
                            <i class="fa fa-eye js-stat-icon"></i>
                        </div>
                    </div>
                    
                    <!-- Content Row -->
                    <div class="js-content-row">
                        <!-- Recent Jobs -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5>Recent Jobs</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if(count($recentJobs) > 0)
                                    @foreach($recentJobs as $job)
                                        <div class="js-application-item">
                                            <div class="js-application-icon">
                                                <i class="fa fa-briefcase"></i>
                                            </div>
                                            <div class="js-application-info">
                                                <h6><a href="{{ $job->url }}" style="color: #333; text-decoration: none;">{{ Str::limit($job->name, 35) }}</a></h6>
                                                <p>{{ $job->company->name ?? 'Company' }} • {{ $job->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="js-empty-state">
                                        <i class="fa fa-briefcase"></i>
                                        <h6>No jobs available</h6>
                                        <p>Check back later for new opportunities.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Recent Applications -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5>My Applications</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if(count($recentApplications) > 0)
                                    @foreach($recentApplications as $application)
                                        <div class="js-application-item">
                                            <div class="js-application-icon" style="background: #e8f5e9; color: #28a745;">
                                                <i class="fa fa-check-circle"></i>
                                            </div>
                                            <div class="js-application-info">
                                                <h6>{{ $application->job->name ?? 'Job' }}</h6>
                                                <p>Applied {{ $application->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="js-empty-state">
                                        <i class="fa fa-folder-open"></i>
                                        <h6>No applications yet</h6>
                                        <p>Start applying for jobs to see them here.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
