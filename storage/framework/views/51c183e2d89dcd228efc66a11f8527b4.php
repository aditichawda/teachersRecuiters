<?php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    
    // Get counts
    $savedJobsCount = 0;
    $appliedJobsCount = 0;
    $profileViewsCount = 0;
    
    try {
        if (auth('account')->check() && $account->isJobSeeker()) {
            // Saved Jobs - from jb_saved_jobs pivot table
            $savedJobsCount = $account->savedJobs()->count();
            
            // Applied Jobs - from jb_job_applications table
            $appliedJobsCount = \Botble\JobBoard\Models\JobApplication::query()
                ->where('account_id', $account->id)
                ->count();

            // Profile Views - number of times profile was viewed by schools/employers
            $profileViewsCount = (int) ($account->profile_views ?? 0);
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
            ->with(['company', 'country', 'city', 'state'])
            ->where('status', 'published')
            ->where('moderation_status', 'approved')
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

    // Get suggested jobs (with company for logo & name)
    $suggestedJobs = [];
    try {
        $suggestedJobs = \Botble\JobBoard\Models\Job::query()
            ->with(['company', 'country', 'city', 'state'])
            ->where('status', 'published')
            ->where('moderation_status', 'approved')
            ->where(function($q) {
                $q->whereNull('expire_date')
                  ->orWhere('expire_date', '>=', now());
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();
    } catch (\Exception $e) {}

    // Get featured companies/schools (is_featured = true, published); fallback to latest if none featured
    $featuredcompanies = [];
    $featuredCompanyUrls = [];
    try {
        $featuredcompanies = \Botble\JobBoard\Models\Company::query()
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest('is_featured')
            ->latest()
            ->limit(6)
            ->get();
        if ($featuredcompanies->isEmpty()) {
            $featuredcompanies = \Botble\JobBoard\Models\Company::query()
                ->where('status', 'published')
                ->latest()
                ->limit(6)
                ->get();
        }
        // Build detail page URL for each company (click -> redirect to institution detail)
        $companyPrefix = \Botble\Slug\Facades\SlugHelper::getPrefix(\Botble\JobBoard\Models\Company::class, 'companies');
        foreach ($featuredcompanies as $c) {
            $slug = \Botble\Slug\Facades\SlugHelper::getSlug(null, $companyPrefix, \Botble\JobBoard\Models\Company::class, $c->id);
            $featuredCompanyUrls[$c->id] = $slug ? url(ltrim($slug->prefix . '/' . $slug->key, '/')) : null;
        }
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
?>

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
    padding: 8px 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    margin-top: 12px;
    margin-bottom: 20px;
    border: none;
    cursor: pointer;
}

.js-view-profile-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    color: #fff;
}

.js-view-profile-btn.js-view-profile-edit {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
}

.js-view-profile-btn.js-view-profile-edit:hover {
    color: #fff;
    box-shadow: 0 4px 12px rgba(71, 85, 105, 0.3);
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
    color:white;
}

.js-stat-card h2 {
    font-size: 36px;
    font-weight: 700;
    margin: 0;
    color:white;
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

/* Application List - job cards (Suggested / Recent) */
.js-application-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 12px;
    border-bottom: 1px solid #f1f5f9;
    border-radius: 10px;
    transition: background 0.2s;
}

.js-application-item:hover {
    background: #f8fafc;
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
    flex-shrink: 0;
}

/* Company logo in job cards (Suggested Jobs / Recent Jobs) */
.js-job-company-logo {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    background: #e8f4fc;
    display: flex;
    align-items: center;
    justify-content: center;
}

.js-job-company-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Default placeholder when no logo: background + initials (company/job name) */
.js-job-logo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.js-job-company-logo .js-application-icon {
    width: 100%;
    height: 100%;
}

.js-job-company-name {
    font-size: 12px;
    font-weight: 600;
    color: #0073d1 !important;
    margin: 0 0 2px 0 !important;
}

.js-job-meta {
    font-size: 11px;
    color: #888;
    margin: 0 !important;
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
    transition: all 0.2s;
}

.js-wallet-badge:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    background: linear-gradient(135deg, #f97316 0%, #f59e0b 100%);
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

/* Featured School / Institution Card - attractive UI */
.js-school-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.js-school-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.js-school-card-link:hover {
    color: inherit;
}

.js-school-card {
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 14px;
    padding: 20px 16px;
    text-align: center;
    transition: all 0.25s ease;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.js-school-card-link:hover .js-school-card {
    border-color: #0073d1;
    box-shadow: 0 8px 24px rgba(0,115,209,0.15);
    transform: translateY(-3px);
}

/* Institution logo - default image from theme when no logo */
.js-school-card-logo {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    overflow: hidden;
    margin: 0 auto 12px;
    background: linear-gradient(135deg, #e8f4fc 0%, #bbdefb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.js-school-card-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.js-school-card .school-icon {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    background: linear-gradient(135deg, #e8f4fc 0%, #bbdefb 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    color: #0073d1;
    font-size: 24px;
}

.js-school-card h6 {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 4px 0;
    line-height: 1.3;
}

.js-school-card p {
    font-size: 12px;
    color: #64748b;
    margin: 0 0 10px 0;
}

.js-school-card-view {
    font-size: 11px;
    font-weight: 600;
    color: #0073d1;
    display: inline-flex;
    align-items: center;
}

.js-school-card-link:hover .js-school-card-view {
    color: #005bb5;
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
                            <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" class="js-profile-avatar">
                            <a href="<?php echo e(route('public.account.settings')); ?>" class="js-avatar-camera-btn" title="<?php echo e(__('Change Photo')); ?>">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <h5 class="js-profile-name">Hello, <?php echo e($account->first_name ?? $account->name); ?></h5>
                        <p class="js-profile-date">Joined <?php echo e($account->created_at->format('M d, Y')); ?></p>
                        <p class="js-profile-updated">Last Updated: <?php echo e($account->updated_at->format('M d, Y')); ?></p>
                        
                        <div class="js-profile-completion">
                            <h6><?php echo e(__('Profile Completion')); ?></h6>
                            <div class="js-completion-bar">
                                <div class="js-completion-fill" style="width: <?php echo e($completion); ?>%;"></div>
                            </div>
                            <div class="js-completion-text"><?php echo e($completion); ?>% <?php echo e(__('complete')); ?></div>
                        </div>
                        <?php $myPublicProfileUrl = $account->isJobSeeker() ? $account->url : ''; ?>
                        <?php if($myPublicProfileUrl): ?>
                            <a href="<?php echo e($myPublicProfileUrl); ?>" target="_blank" class="js-view-profile-btn" title="<?php echo e(__('View your public profile as others see it')); ?>">
                                <i class="fa fa-external-link-alt"></i> <?php echo e(__('View Profile')); ?>

                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('public.account.settings')); ?>" class="js-view-profile-btn js-view-profile-edit">
                                <i class="fa fa-user-edit"></i> <?php echo e(__('Complete profile for public link')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Wallet -->
                    <div class="js-wallet-badge" onclick="document.getElementById('profileModal').style.display='flex'" style="cursor: pointer;">
                        <i class="fa fa-wallet"></i>
                        <span>Reward Points:</span>
                        <span class="js-wallet-points"><?php echo e($walletPoints); ?></span>
                    </div>

                    <!-- Navigation -->
                    <ul class="js-sidebar-nav">
                        <li><a href="<?php echo e(route('public.account.jobseeker.dashboard')); ?>" class="active"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="<?php echo e(route('public.account.settings')); ?>"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="<?php echo e(route('public.account.jobs.saved')); ?>"><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="<?php echo e(route('public.account.jobs.applied-jobs')); ?>"><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="<?php echo e(route('public.account.experiences.index')); ?>"><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="<?php echo e(route('public.account.educations.index')); ?>"><i class="fa fa-graduation-cap"></i> Education</a></li>
                        <li><a href="<?php echo e(route('public.account.interests-achievements')); ?>"><i class="fa fa-star"></i> Interests & Achievements</a></li>
                        <li><a href="#"><i class="fa fa-wallet"></i> Wallet <span style="background:#f59e0b;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;"><?php echo e($walletPoints); ?></span></a></li>
                        <li><a href="<?php echo e(route('public.account.resume-builder')); ?>"><i class="fa fa-file-pdf"></i> Resume Builder</a></li>
                        <li><a href="<?php echo e(route('public.account.security')); ?>"><i class="fa fa-lock"></i> Security</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="js-dashboard-content">
                    <!-- Header -->
                    <div class="js-dash-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <h2 class="mb-0">Dashboard</h2>
                        <?php $myPublicProfileUrl = $account->isJobSeeker() ? $account->url : ''; ?>
                        <?php if($myPublicProfileUrl): ?>
                            <a href="<?php echo e($myPublicProfileUrl); ?>" target="_blank" class="btn btn-primary btn-sm d-md-none" style="background: linear-gradient(135deg, #0073d1, #005bb5); border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600;">
                                <i class="fa fa-external-link-alt me-1"></i><?php echo e(__('View Profile')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Alert for incomplete profile with reward message -->
                    <?php if($completion < 100): ?>
                    <div class="alert alert-warning d-flex align-items-center mb-4" style="border-radius: 8px; background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-color: #90caf9;
            color: #0d47a1;">
                        <i class="fa fa-gift me-2" style="font-size: 20px;"></i>
                        <span>
                            <strong>Complete your profile and earn <?php echo e($totalPoints - $earnedPoints); ?> reward points!</strong><br>
                            <small>Fill in missing fields to boost your profile visibility. <a href="<?php echo e(route('public.account.settings')); ?>" style="color: #e65100; font-weight: 600;">Complete Profile →</a></small>
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Stats Cards -->
                    <div class="js-stats-row">
                        <div class="js-stat-card blue">
                            <h6>Saved Jobs</h6>
                            <h2><?php echo e($savedJobsCount); ?></h2>
                            <i class="fa fa-bookmark js-stat-icon"></i>
                        </div>
                        <div class="js-stat-card green">
                            <h6>Applied Jobs</h6>
                            <h2><?php echo e($appliedJobsCount); ?></h2>
                            <i class="fa fa-file-alt js-stat-icon"></i>
                        </div>
                        <div class="js-stat-card orange">
                            <h6><?php echo e(__('Profile Views')); ?></h6>
                            <h2><?php echo e($profileViewsCount); ?></h2>
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
                                <?php if(count($suggestedJobs) > 0): ?>
                                    <?php $__currentLoopData = $suggestedJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $company = $job->company;
                                            $logoPlaceholder = $company && $company->name ? strtoupper(mb_substr($company->name, 0, 2)) : strtoupper(mb_substr($job->name, 0, 2));
                                            if ($logoPlaceholder === '') { $logoPlaceholder = 'JD'; }
                                        ?>
                                        <div class="js-application-item">
                                            <div class="js-job-company-logo">
                                                <?php if($company && $company->logo): ?>
                                                    <img src="<?php echo e(RvMedia::getImageUrl($company->logo, 'thumb')); ?>" alt="<?php echo e($company->name ?? 'Company'); ?>">
                                                <?php else: ?>
                                                    <span class="js-job-logo-placeholder" title="<?php echo e($company->name ?? $job->name); ?>"><?php echo e($logoPlaceholder); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="js-application-info">
                                                <h6><a href="<?php echo e($job->url); ?>" style="color: #333; text-decoration: none;"><?php echo e(Str::limit($job->name, 35)); ?></a></h6>
                                                <p class="js-job-company-name"><?php echo e($company->name ?? __('Company')); ?></p>
                                                <p class="js-job-meta"><?php echo ($job->location ?? $job->address) ? e(Str::limit($job->location ?? $job->address ?? '', 30)) . ' • ' : ''; ?><?php echo e($job->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="js-empty-state">
                                        <i class="fa fa-lightbulb"></i>
                                        <h6>No suggestions yet</h6>
                                        <p>Complete your profile for personalized job suggestions.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Recent Jobs -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-clock me-2" style="color: #0073d1;"></i>Recent Jobs</h5>
                            </div>
                            <div class="js-content-card-body">
                                <?php if(count($recentJobs) > 0): ?>
                                    <?php $__currentLoopData = $recentJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $company = $job->company;
                                            $logoPlaceholder = $company && $company->name ? strtoupper(mb_substr($company->name, 0, 2)) : strtoupper(mb_substr($job->name, 0, 2));
                                            if ($logoPlaceholder === '') { $logoPlaceholder = 'JD'; }
                                        ?>
                                        <div class="js-application-item">
                                            <div class="js-job-company-logo">
                                                <?php if($company && $company->logo): ?>
                                                    <img src="<?php echo e(RvMedia::getImageUrl($company->logo, 'thumb')); ?>" alt="<?php echo e($company->name ?? 'Company'); ?>">
                                                <?php else: ?>
                                                    <span class="js-job-logo-placeholder" title="<?php echo e($company->name ?? $job->name); ?>"><?php echo e($logoPlaceholder); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="js-application-info">
                                                <h6><a href="<?php echo e($job->url); ?>" style="color: #333; text-decoration: none;"><?php echo e(Str::limit($job->name, 35)); ?></a></h6>
                                                <p class="js-job-company-name"><?php echo e($company->name ?? __('Company')); ?></p>
                                                <p class="js-job-meta"><?php echo ($job->location ?? $job->address) ? e(Str::limit($job->location ?? $job->address ?? '', 30)) . ' • ' : ''; ?><?php echo e($job->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="js-empty-state">
                                        <i class="fa fa-briefcase"></i>
                                        <h6>No jobs available</h6>
                                        <p>Check back later for new opportunities.</p>
                                    </div>
                                <?php endif; ?>
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
                                <?php if(count($recentApplications) > 0): ?>
                                    <?php $__currentLoopData = $recentApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="js-application-item">
                                            <div class="js-application-icon" style="background: #e8f5e9; color: #28a745;">
                                                <i class="fa fa-check-circle"></i>
                                            </div>
                                            <div class="js-application-info">
                                                <h6><?php echo e($application->job->name ?? 'Job'); ?></h6>
                                                <p>Applied <?php echo e($application->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="js-empty-state">
                                        <i class="fa fa-folder-open"></i>
                                        <h6>No applications yet</h6>
                                        <p>Start applying for jobs to see them here.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="js-content-card">
                            <div class="js-content-card-header">
                                <h5><i class="fa fa-bell me-2" style="color: #dc3545;"></i>Notifications</h5>
                            </div>
                            <div class="js-content-card-body">
                                <?php if($completion < 100): ?>
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon warning">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Your profile is <strong><?php echo e($completion); ?>%</strong> complete. Fill in missing fields to earn <strong><?php echo e($totalPoints - $earnedPoints); ?></strong> reward points!</p>
                                            <small>Profile Completion</small>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(empty($account->resume)): ?>
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon info">
                                            <i class="fa fa-upload"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Upload your resume to improve your chances of getting shortlisted by schools.</p>
                                            <small>Resume Required</small>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(empty($account->avatar_id)): ?>
                                    <div class="js-notification-item">
                                        <div class="js-notification-icon info">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                        <div class="js-notification-text">
                                            <p>Add a profile photo to make your profile stand out to employers.</p>
                                            <small>Photo Missing</small>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="js-notification-item">
                                    <div class="js-notification-icon success">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                    <div class="js-notification-text">
                                        <p>Welcome to TeachersRecruiter! Explore jobs and start applying.</p>
                                        <small><?php echo e($account->created_at->diffForHumans()); ?></small>
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
                                <?php if(count($featuredcompanies) > 0): ?>
                                    <div class="js-school-grid">
                                        <?php $__currentLoopData = $featuredcompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $companyDetailUrl = $featuredCompanyUrls[$company->id] ?? '#'; ?>
                                            <a href="<?php echo e($companyDetailUrl); ?>" class="js-school-card-link" title="<?php echo e($company->name); ?> - <?php echo e(__('View details')); ?>">
                                                <div class="js-school-card">
                                                    <div class="js-school-card-logo">
                                                        <img src="<?php echo e($company->logo_thumb); ?>" alt="<?php echo e($company->name); ?>">
                                                    </div>
                                                    <h6><?php echo e(Str::limit($company->name, 25)); ?></h6>
                                                    <p><?php echo e(isset($company->state) ? $company->state->name : (isset($company->city) ? $company->city->name : ($company->address ? Str::limit($company->address, 20) : '—'))); ?></p>
                                                    <span class="js-school-card-view"><?php echo e(__('View details')); ?> <i class="fa fa-arrow-right ms-1"></i></span>
                                                </div>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="js-empty-state">
                                        <i class="fa fa-school"></i>
                                        <h6>No featured schools yet</h6>
                                        <p>Featured schools and institutions will appear here.</p>
                                    </div>
                                <?php endif; ?>
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
                                <?php if(count($recentBlogs) > 0): ?>
                                    <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="js-blog-item">
                                            <?php if($blog->image): ?>
                                                <img src="<?php echo e(RvMedia::getImageUrl($blog->image, 'thumb')); ?>" alt="<?php echo e($blog->name); ?>" class="js-blog-thumb">
                                            <?php else: ?>
                                                <div class="js-blog-thumb" style="display:flex;align-items:center;justify-content:center;color:#ccc;"><i class="fa fa-newspaper"></i></div>
                                            <?php endif; ?>
                                            <div class="js-blog-info">
                                                <h6><a href="<?php echo e($blog->url); ?>"><?php echo e(Str::limit($blog->name, 50)); ?></a></h6>
                                                <p><?php echo e($blog->created_at->format('M d, Y')); ?> • <?php echo e($blog->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="js-empty-state">
                                        <i class="fa fa-newspaper"></i>
                                        <h6>No blog posts yet</h6>
                                        <p>Teaching tips, career advice, and more will appear here.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div id="profileModal" class="pm-overlay" style="display:none;">
    <div class="pm-modal">
        <button type="button" class="pm-close" onclick="document.getElementById('profileModal').style.display='none'">&times;</button>
        
        <!-- Reward Points Badge -->
        <div class="pm-reward-badge">
            <i class="fa fa-wallet"></i>
            <span>Reward Points:</span>
            <span class="pm-reward-points"><?php echo e($walletPoints); ?></span>
        </div>

        <!-- Profile Completion -->
        <div class="pm-completion-section">
            <h6 class="pm-completion-title">Profile Completion</h6>
            <div class="pm-progress-bar">
                <div class="pm-progress-fill" style="width: <?php echo e($completion); ?>%"></div>
            </div>
            <span class="pm-completion-text"><?php echo e($completion); ?>% Complete</span>
        </div>

        <!-- Per-field Progress -->
        <div class="pm-field-list">
            <?php $__currentLoopData = $profileFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pm-field-item">
                    <span class="pm-field-name">
                        <i class="fa <?php echo e($pf['filled'] ? 'fa-check-circle' : 'fa-times-circle'); ?>" style="color: <?php echo e($pf['filled'] ? '#28a745' : '#dc3545'); ?>; margin-right: 8px;"></i>
                        <?php echo e($pf['label']); ?>

                    </span>
                    <span class="pm-field-points <?php echo e($pf['filled'] ? 'pm-earned' : 'pm-pending'); ?>">
                        +<?php echo e($pf['points']); ?> pts
                    </span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Complete Profile Button -->
        <?php if($completion < 100): ?>
            <a href="<?php echo e(route('public.account.settings')); ?>" class="pm-complete-btn">
                <i class="fa fa-user-edit"></i> Complete Your Profile
            </a>
        <?php else: ?>
            <div class="pm-congrats">
                <i class="fa fa-trophy" style="color: #f59e0b; font-size: 20px;"></i>
                <span>Congratulations! Your profile is 100% complete.</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Profile Modal Overlay */
.pm-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: pmFadeIn 0.25s ease;
}
@keyframes pmFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes pmSlideUp {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Modal Box */
.pm-modal {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 400px;
    max-height: 85vh;
    overflow-y: auto;
    padding: 25px 20px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: pmSlideUp 0.3s ease;
}
.pm-modal::-webkit-scrollbar {
    width: 4px;
}
.pm-modal::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

/* Close Button */
.pm-close {
    position: absolute;
    top: 10px;
    right: 14px;
    background: none;
    border: none;
    font-size: 28px;
    color: #999;
    cursor: pointer;
    line-height: 1;
    z-index: 10;
    transition: color 0.2s;
}
.pm-close:hover {
    color: #333;
}

/* Reward Badge */
.pm-reward-badge {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: #fff;
    border-radius: 30px;
    padding: 12px 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}
.pm-reward-badge i {
    font-size: 18px;
}
.pm-reward-points {
    font-size: 22px;
    font-weight: 800;
}

/* Completion Section */
.pm-completion-section {
    margin-bottom: 18px;
}
.pm-completion-title {
    font-size: 15px;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
}
.pm-progress-bar {
    height: 10px;
    background: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 6px;
}
.pm-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #0073d1, #00b4d8);
    border-radius: 10px;
    transition: width 0.6s ease;
}
.pm-completion-text {
    font-size: 13px;
    font-weight: 600;
    color: #0073d1;
    text-decoration: underline;
}

/* Field List */
.pm-field-list {
    margin-top: 15px;
}
.pm-field-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 6px;
    background: #f8f9fa;
    transition: background 0.2s;
}
.pm-field-item:hover {
    background: #f0f4f8;
}
.pm-field-name {
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: 500;
    color: #333;
}
.pm-field-points {
    font-size: 12px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 12px;
    white-space: nowrap;
}
.pm-field-points.pm-earned {
    background: #d4edda;
    color: #28a745;
}
.pm-field-points.pm-pending {
    background: #fff3cd;
    color: #856404;
}

/* Complete Profile Button */
.pm-complete-btn {
    display: block;
    text-align: center;
    margin-top: 18px;
    padding: 12px;
    background: linear-gradient(135deg, #0073d1, #00b4d8);
    color: #fff !important;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none !important;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 15px rgba(0, 115, 209, 0.3);
}
.pm-complete-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 115, 209, 0.4);
    color: #fff !important;
}
.pm-complete-btn i {
    margin-right: 6px;
}

/* Congrats Message */
.pm-congrats {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px;
    background: #fff8e1;
    border-radius: 10px;
    margin-top: 18px;
    font-size: 13px;
    font-weight: 600;
    color: #333;
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .pm-modal {
        padding: 20px 15px;
        max-height: 90vh;
        border-radius: 12px;
    }
    .pm-reward-badge {
        font-size: 14px;
        padding: 10px 18px;
    }
    .pm-reward-points {
        font-size: 20px;
    }
}
</style>

<script>
// Close modal when clicking outside
document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.style.display = 'none';
    }
});
// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('profileModal').style.display = 'none';
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/dashboard.blade.php ENDPATH**/ ?>