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

    // Get suggested jobs (based on teaching subjects / institution type preferences)
    $suggestedJobs = [];
    try {
        $suggestedJobs = \Botble\JobBoard\Models\Job::query()
            ->where('status', 'published')
            ->where(function($q) {
                $q->whereNull('expire_date')
                  ->orWhere('expire_date', '>=', now());
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();
    } catch (\Exception $e) {}

    // Get featured companies/schools
    $featuredCompanies = [];
    try {
        $featuredCompanies = \Botble\JobBoard\Models\Company::query()
            ->where('status', 'approved')
            ->latest()
            ->limit(6)
            ->get();
    } catch (\Exception $e) {}

    // Get recent blog posts
    $recentBlogs = [];
    try {
        if (is_plugin_active('blog')) {
            $recentBlogs = \Botble\Blog\Models\Post::query()
                ->where('status', 'published')
                ->latest()
                ->limit(4)
                ->get();
        }
    } catch (\Exception $e) {}

    // Profile completion with per-field reward points
    $profileFields = [
        ['field' => 'first_name', 'label' => 'Full Name', 'points' => 10, 'filled' => !empty($account->first_name)],
        ['field' => 'phone', 'label' => 'Mobile Number', 'points' => 10, 'filled' => !empty($account->phone)],
        ['field' => 'avatar', 'label' => 'Profile Photo', 'points' => 15, 'filled' => !empty($account->avatar_id)],
        ['field' => 'bio', 'label' => 'About / Bio', 'points' => 10, 'filled' => !empty($account->bio)],
        ['field' => 'resume', 'label' => 'Resume', 'points' => 20, 'filled' => !empty($account->resume)],
        ['field' => 'address', 'label' => 'Location/Address', 'points' => 10, 'filled' => !empty($account->address)],
        ['field' => 'dob', 'label' => 'Date of Birth', 'points' => 5, 'filled' => !empty($account->dob)],
        ['field' => 'gender', 'label' => 'Gender', 'points' => 5, 'filled' => !empty($account->gender)],
        ['field' => 'total_experience', 'label' => 'Total Experience', 'points' => 10, 'filled' => !empty($account->total_experience)],
        ['field' => 'current_salary', 'label' => 'Salary Details', 'points' => 5, 'filled' => !empty($account->current_salary)],
    ];
    $totalPoints = array_sum(array_column($profileFields, 'points'));
    $earnedPoints = 0;
    foreach ($profileFields as $pf) {
        if ($pf['filled']) $earnedPoints += $pf['points'];
    }
    $completion = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
    $walletPoints = $earnedPoints; // Reward points = earned points
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

.js-profile-avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.js-profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    transition: border-color 0.3s;
}

.js-profile-avatar-wrapper:hover .js-profile-avatar {
    border-color: #0073d1;
}

.js-avatar-camera-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 28px;
    height: 28px;
    background: #0073d1;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    border: 2px solid #fff;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.js-avatar-camera-btn:hover {
    background: #005bb5;
    transform: scale(1.1);
    color: #fff;
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
    margin: 0 0 3px 0;
}

.js-profile-updated {
    font-size: 12px;
    color: #aaa;
    margin: 0 0 15px 0;
}

.js-view-profile-btn {
    display: inline-block;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff;
    padding: 7px 18px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    margin-bottom: 20px;
}

.js-view-profile-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    color: #fff;
}

.js-view-profile-btn i {
    margin-right: 5px;
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

/* Wallet Badge */
.js-wallet-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #fff;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
    width: 100%;
    justify-content: center;
}

.js-wallet-badge i {
    font-size: 16px;
}

.js-wallet-points {
    font-size: 18px;
    font-weight: 700;
}

/* Profile Field Progress */
.js-field-progress {
    margin-top: 10px;
}

.js-field-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 12px;
    border-bottom: 1px solid #f5f5f5;
}

.js-field-item:last-child {
    border-bottom: none;
}

.js-field-item .field-name {
    color: #555;
    display: flex;
    align-items: center;
    gap: 6px;
}

.js-field-item .field-name i {
    font-size: 10px;
}

.js-field-item .field-name i.completed {
    color: #28a745;
}

.js-field-item .field-name i.pending {
    color: #dc3545;
}

.js-field-item .field-points {
    font-weight: 600;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
}

.js-field-item .field-points.earned {
    background: #e8f5e9;
    color: #28a745;
}

.js-field-item .field-points.available {
    background: #fff3e0;
    color: #e65100;
}

/* Reward Message */
.js-reward-message {
    background: linear-gradient(135deg, #fff3e0, #ffe0b2);
    border: 1px solid #ffcc80;
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #e65100;
    display: flex;
    align-items: center;
    gap: 8px;
}

.js-reward-message i {
    font-size: 18px;
    color: #f57c00;
}

/* Notification Item */
.js-notification-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.js-notification-item:last-child {
    border-bottom: none;
}

.js-notification-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.js-notification-icon.info { background: #e8f4fc; color: #0073d1; }
.js-notification-icon.success { background: #e8f5e9; color: #28a745; }
.js-notification-icon.warning { background: #fff3e0; color: #f57c00; }

.js-notification-text {
    flex: 1;
}

.js-notification-text p {
    font-size: 13px;
    color: #333;
    margin: 0 0 3px 0;
}

.js-notification-text small {
    font-size: 11px;
    color: #999;
}

/* Featured School Card */
.js-school-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.js-school-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    transition: all 0.2s;
    border: 1px solid #e9ecef;
}

.js-school-card:hover {
    border-color: #0073d1;
    box-shadow: 0 4px 12px rgba(0,115,209,0.1);
    transform: translateY(-2px);
}

.js-school-card img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 8px;
}

.js-school-card .school-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e8f4fc;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    color: #0073d1;
    font-size: 20px;
}

.js-school-card h6 {
    font-size: 13px;
    font-weight: 600;
    color: #333;
    margin: 0 0 3px 0;
}

.js-school-card p {
    font-size: 11px;
    color: #888;
    margin: 0;
}

/* Blog Card */
.js-blog-item {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f5f5f5;
}

.js-blog-item:last-child {
    border-bottom: none;
}

.js-blog-thumb {
    width: 60px;
    height: 45px;
    border-radius: 6px;
    object-fit: cover;
    flex-shrink: 0;
    background: #e9ecef;
}

.js-blog-info h6 {
    font-size: 13px;
    font-weight: 500;
    color: #333;
    margin: 0 0 3px 0;
    line-height: 1.3;
}

.js-blog-info h6 a {
    color: #333;
    text-decoration: none;
}

.js-blog-info h6 a:hover {
    color: #0073d1;
}

.js-blog-info p {
    font-size: 11px;
    color: #999;
    margin: 0;
}

/* Section spacing */
.js-section-gap {
    margin-top: 20px;
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
    .js-school-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .js-profile-sidebar {
        display: none;
    }
    .js-dashboard-content {
        padding: 15px 0;
    }
    .js-school-grid {
        grid-template-columns: 1fr;
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
                        <div class="js-profile-avatar-wrapper">
                            <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="js-profile-avatar">
                            <a href="{{ route('public.account.settings') }}" class="js-avatar-camera-btn" title="{{ __('Change Photo') }}">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <h5 class="js-profile-name">Hello, {{ $account->first_name ?? $account->name }}</h5>
                        <p class="js-profile-date">Joined {{ $account->created_at->format('M d, Y') }}</p>
                        <p class="js-profile-updated">Last Updated: {{ $account->updated_at->format('M d, Y') }}</p>
                        @php
                            $candidateSlug = \Botble\Slug\Models\Slug::where('reference_type', \Botble\JobBoard\Models\Account::class)
                                ->where('reference_id', $account->id)
                                ->value('key');
                        @endphp
                        @if($candidateSlug)
                            <a href="{{ url('candidates/' . $candidateSlug) }}" target="_blank" class="js-view-profile-btn">
                                <i class="fa fa-eye"></i> {{ __('View Profile') }}
                            </a>
                        @endif
                    </div>
                    
                    <!-- Wallet -->
                    <div class="js-wallet-badge">
                        <i class="fa fa-wallet"></i>
                        <span>Reward Points:</span>
                        <span class="js-wallet-points">{{ $walletPoints }}</span>
                    </div>

                    <!-- Profile Completion -->
                    <div class="js-profile-completion">
                        <h6>Profile Completion</h6>
                        <div class="js-completion-bar">
                            <div class="js-completion-fill" style="width: {{ $completion }}%"></div>
                        </div>
                        <span class="js-completion-text">{{ $completion }}% Complete</span>

                        <!-- Per-field progress -->
                        <div class="js-field-progress">
                            @foreach($profileFields as $pf)
                                <div class="js-field-item">
                                    <span class="field-name">
                                        <i class="fa {{ $pf['filled'] ? 'fa-check-circle completed' : 'fa-times-circle pending' }}"></i>
                                        {{ $pf['label'] }}
                                    </span>
                                    <span class="field-points {{ $pf['filled'] ? 'earned' : 'available' }}">
                                        {{ $pf['filled'] ? '+' . $pf['points'] . ' pts' : $pf['points'] . ' pts' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($completion < 100)
                        <div class="js-reward-message">
                            <i class="fa fa-gift"></i>
                            <span>Complete your profile and earn <strong>{{ $totalPoints - $earnedPoints }}</strong> more points!</span>
                        </div>
                    @endif
                    
                    <!-- Navigation -->
                    <ul class="js-sidebar-nav">
                        <li><a href="{{ route('public.account.jobseeker.dashboard') }}" class="active"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('public.account.settings') }}"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="{{ route('public.account.jobs.saved') }}"><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="{{ route('public.account.jobs.applied-jobs') }}"><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="{{ route('public.account.experiences.index') }}"><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="{{ route('public.account.educations.index') }}"><i class="fa fa-graduation-cap"></i> Education</a></li>
                        <li><a href="#"><i class="fa fa-wallet"></i> Wallet <span style="background:#f59e0b;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ $walletPoints }}</span></a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="js-dashboard-content">
                    <!-- Header -->
                    <div class="js-dash-header">
                        <h2>Dashboard</h2>
                    </div>
                    
                    <!-- Alert for incomplete profile with reward message -->
                    @if($completion < 100)
                    <div class="alert alert-warning d-flex align-items-center mb-4" style="border-radius: 8px; background: linear-gradient(135deg, #fff3e0, #ffe0b2); border-color: #ffcc80; color: #e65100;">
                        <i class="fa fa-gift me-2" style="font-size: 20px;"></i>
                        <span>
                            <strong>Complete your profile and earn {{ $totalPoints - $earnedPoints }} reward points!</strong><br>
                            <small>Fill in missing fields to boost your profile visibility. <a href="{{ route('public.account.settings') }}" style="color: #e65100; font-weight: 600;">Complete Profile →</a></small>
                        </span>
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
                    
                    <!-- Row 1: Suggested Jobs + Recent Jobs -->
                    <div class="js-content-row">
                        <!-- Suggested Jobs -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-lightbulb me-2" style="color: #f59e0b;"></i>Suggested Jobs</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if(count($suggestedJobs) > 0)
                                    @foreach($suggestedJobs as $job)
                                        <div class="js-application-item">
                                            <div class="js-application-icon" style="background: #fff3e0; color: #f57c00;">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="js-application-info">
                                                <h6><a href="{{ $job->url }}" style="color: #333; text-decoration: none;">{{ Str::limit($job->name, 35) }}</a></h6>
                                                <p>{{ $job->company->name ?? 'Company' }} • {{ $job->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="js-empty-state">
                                        <i class="fa fa-lightbulb"></i>
                                        <h6>No suggestions yet</h6>
                                        <p>Complete your profile for personalized job suggestions.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Jobs -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-clock me-2" style="color: #0073d1;"></i>Recent Jobs</h5>
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
                    </div>
                    
                    <!-- Row 2: My Applications + Notifications -->
                    <div class="js-content-row js-section-gap">
                        <!-- My Applications -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-file-alt me-2" style="color: #28a745;"></i>My Applications</h5>
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

                        <!-- Notifications -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-bell me-2" style="color: #dc3545;"></i>Notifications</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if($completion < 100)
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon warning">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Your profile is <strong>{{ $completion }}%</strong> complete. Fill in missing fields to earn <strong>{{ $totalPoints - $earnedPoints }}</strong> reward points!</p>
                                            <small>Profile Completion</small>
                                        </div>
                                    </div>
                                @endif
                                @if(empty($account->resume))
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon info">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Upload your resume to improve your chances of getting shortlisted by schools.</p>
                                            <small>Resume Required</small>
                                        </div>
                                    </div>
                                @endif
                                @if(empty($account->avatar_id))
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon info">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Add a profile photo to make your profile stand out to employers.</p>
                                            <small>Photo Missing</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="js-notification-item">
                                    <div class="js-notification-icon success">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="js-notification-text">
                                        <p>Welcome to TeachersRecruiter! Explore jobs and start applying.</p>
                                        <small>{{ $account->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Featured Schools/Institutions -->
                    <div class="js-section-gap">
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-school me-2" style="color: #6f42c1;"></i>Featured Schools / Institutions</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if(count($featuredCompanies) > 0)
                                    <div class="js-school-grid">
                                        @foreach($featuredCompanies as $company)
                                            <div class="js-school-card">
                                                @if($company->logo)
                                                    <img src="{{ RvMedia::getImageUrl($company->logo, 'thumb') }}" alt="{{ $company->name }}">
                                                @else
                                                    <div class="school-icon"><i class="fa fa-school"></i></div>
                                                @endif
                                                <h6>{{ Str::limit($company->name, 25) }}</h6>
                                                <p>{{ $company->state->name ?? $company->city->name ?? 'India' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="js-empty-state">
                                        <i class="fa fa-school"></i>
                                        <h6>No featured schools yet</h6>
                                        <p>Featured schools and institutions will appear here.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Row 4: Recent Blogs -->
                    <div class="js-section-gap">
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-newspaper me-2" style="color: #17a2b8;"></i>Recent Blogs & Articles</h5>
                            </div>
                            <div class="js-content-card-body">
                                @if(count($recentBlogs) > 0)
                                    @foreach($recentBlogs as $blog)
                                        <div class="js-blog-item">
                                            @if($blog->image)
                                                <img src="{{ RvMedia::getImageUrl($blog->image, 'thumb') }}" alt="{{ $blog->name }}" class="js-blog-thumb">
                                            @else
                                                <div class="js-blog-thumb" style="display:flex;align-items:center;justify-content:center;color:#ccc;"><i class="fa fa-newspaper"></i></div>
                                            @endif
                                            <div class="js-blog-info">
                                                <h6><a href="{{ $blog->url }}">{{ Str::limit($blog->name, 50) }}</a></h6>
                                                <p>{{ $blog->created_at->format('M d, Y') }} • {{ $blog->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="js-empty-state">
                                        <i class="fa fa-newspaper"></i>
                                        <h6>No blog posts yet</h6>
                                        <p>Teaching tips, career advice, and more will appear here.</p>
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
