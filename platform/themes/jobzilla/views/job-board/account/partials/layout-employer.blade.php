@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    
    $account = auth('account')->user();
    $company = $account->companies()->with('slugable')->first();
    $companySlugKey = $company && $company->slugable ? $company->slugable->key : null;
    if ($company && !$companySlugKey) {
        try {
            $slugModel = \Botble\Slug\Facades\SlugHelper::getSlug(null, \Botble\Slug\Facades\SlugHelper::getPrefix(\Botble\JobBoard\Models\Company::class), \Botble\JobBoard\Models\Company::class, $company->id);
            $companySlugKey = $slugModel?->key ?? null;
        } catch (\Throwable $e) {
            $companySlugKey = null;
        }
    }
    if ($company && !$companySlugKey && \Botble\Slug\Facades\SlugHelper::isSupportedModel(\Botble\JobBoard\Models\Company::class) && !empty($company->name)) {
        try {
            \Botble\Slug\Facades\SlugHelper::createSlug($company);
            $company->load('slugable');
            $companySlugKey = $company->slugable?->key ?? null;
        } catch (\Throwable $e) {
            $companySlugKey = null;
        }
    }
    $employerPublicProfileUrl = $companySlugKey ? route('public.company', $companySlugKey) : null;
    
    // Profile completion with per-field tracking
    $profileFields = [
        ['field' => 'name', 'label' => 'Institution Name', 'points' => 15, 'filled' => !empty($company->name)],
        ['field' => 'email', 'label' => 'Institution Email', 'points' => 10, 'filled' => !empty($company->email)],
        ['field' => 'phone', 'label' => 'Institution Phone', 'points' => 10, 'filled' => !empty($company->phone)],
        ['field' => 'logo', 'label' => 'Institution Logo', 'points' => 15, 'filled' => !empty($company->logo)],
        ['field' => 'description', 'label' => 'About Us', 'points' => 10, 'filled' => !empty($company->description)],
        ['field' => 'address', 'label' => 'Address', 'points' => 10, 'filled' => !empty($company->address)],
        ['field' => 'institution_type', 'label' => 'Institution Type', 'points' => 10, 'filled' => !empty($company->institution_type)],
        ['field' => 'year_founded', 'label' => 'Established Year', 'points' => 5, 'filled' => !empty($company->year_founded)],
        ['field' => 'campus_type', 'label' => 'Campus Type', 'points' => 5, 'filled' => !empty($company->campus_type)],
        ['field' => 'standard_level', 'label' => 'Standard Level', 'points' => 5, 'filled' => !empty($company->standard_level)],
        ['field' => 'staff_facilities', 'label' => 'Staff Facilities', 'points' => 5, 'filled' => !empty($company->staff_facilities)],
    ];
    $totalPoints = array_sum(array_column($profileFields, 'points'));
    $earnedPoints = 0;
    foreach ($profileFields as $pf) {
        if ($pf['filled']) $earnedPoints += $pf['points'];
    }
    $completion = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
    $completion = min($completion, 100);
@endphp

<style>
.emp-settings-page {
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
    margin-top: 20px;
    padding-top: 75px;
}

/* Profile Sidebar */
.emp-profile-sidebar {
    background: #fff;
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    position: sticky;
    top: 20px;
}

.emp-avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.emp-profile-sidebar .emp-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    transition: border-color 0.3s;
}

.emp-avatar-wrapper:hover .emp-avatar {
    border-color: #0073d1;
}

.emp-avatar-camera {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 28px;
    height: 28px;
    background: #0073d1;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    text-decoration: none;
    border: 2px solid #fff;
    cursor: pointer;
    transition: all 0.2s;
}
.emp-avatar-camera:hover {
    background: #005bb5;
    transform: scale(1.1);
    color: #fff;
}

.emp-profile-sidebar .emp-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.emp-profile-sidebar .emp-date {
    font-size: 13px;
    color: #888;
    margin: 0 0 3px 0;
}

.emp-profile-sidebar .emp-updated {
    font-size: 12px;
    color: #aaa;
    margin: 0 0 15px 0;
}

.emp-profile-sidebar .emp-type {
    font-size: 12px;
    color: #0073d1;
    margin: 0 0 15px 0;
    font-weight: 500;
}

.emp-view-profile-btn {
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
    border: none;
    cursor: pointer;
}

.emp-view-profile-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    color: #fff;
}

.emp-view-profile-btn i {
    margin-right: 5px;
}

/* Credits Badge */
.emp-credits-badge {
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

.emp-credits-badge i { font-size: 16px; }
.emp-credits-points { font-size: 18px; font-weight: 700; }

.emp-profile-completion {
    margin-bottom: 25px;
}

.emp-profile-completion h6 {
    font-size: 13px;
    font-weight: 500;
    color: #666;
    margin: 0 0 8px 0;
}

.emp-completion-bar {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
}

.emp-completion-fill {
    height: 100%;
    background: #0073d1;
    border-radius: 3px;
    transition: width 0.4s ease;
}

.emp-completion-text {
    font-size: 12px;
    color: #0073d1;
    margin-top: 5px;
    cursor: pointer;
}

.emp-sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.emp-sidebar-nav li {
    margin-bottom: 5px;
}

.emp-sidebar-nav li a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    border-radius: 8px;
    color: #333;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
}

.emp-sidebar-nav li a:hover,
.emp-sidebar-nav li a.active {
    background: #e8f4fc;
    color: #0073d1;
}

.emp-sidebar-nav li a.active {
    border-left: 3px solid #0073d1;
}

.emp-sidebar-nav li a i {
    width: 20px;
    text-align: center;
    font-size: 16px;
}

.emp-sidebar-nav li a.emp-nav-locked {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: #fff !important;
}
.emp-sidebar-nav li a.emp-nav-locked:hover {
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    color: #fff !important;
}
.emp-sidebar-nav li a .emp-nav-lock-icon {
    width: 26px; height: 26px; min-width: 26px;
    display: inline-flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.25); border-radius: 6px;
    margin-right: 4px;
}
.emp-sidebar-nav li a .emp-nav-lock-icon i { font-size: 13px; }

.emp-main-content {
    padding: 0 0 40px 0px;
}

/* Profile Modal */
.emp-pm-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: empPmFadeIn 0.25s ease;
}
@keyframes empPmFadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes empPmSlideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.emp-pm-modal {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 400px;
    max-height: 85vh;
    overflow-y: auto;
    padding: 25px 20px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: empPmSlideUp 0.3s ease;
}
.emp-pm-modal::-webkit-scrollbar { width: 4px; }
.emp-pm-modal::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }

.emp-pm-close {
    position: absolute; top: 10px; right: 14px;
    background: none; border: none; font-size: 28px; color: #999; cursor: pointer; line-height: 1; z-index: 10; transition: color 0.2s;
}
.emp-pm-close:hover { color: #333; }

.emp-pm-badge {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: #fff; border-radius: 30px; padding: 12px 22px;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    font-size: 15px; font-weight: 600; margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}
.emp-pm-badge i { font-size: 18px; }
.emp-pm-badge-points { font-size: 22px; font-weight: 800; }

.emp-pm-completion { margin-bottom: 18px; }
.emp-pm-completion-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 8px; }
.emp-pm-progress-bar { height: 10px; background: #e9ecef; border-radius: 10px; overflow: hidden; margin-bottom: 6px; }
.emp-pm-progress-fill { height: 100%; background: linear-gradient(90deg, #0073d1, #00b4d8); border-radius: 10px; transition: width 0.6s ease; }
.emp-pm-completion-text { font-size: 13px; font-weight: 600; color: #0073d1; text-decoration: underline; }

.emp-pm-field-list { margin-top: 15px; }
.emp-pm-field-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 12px; border-radius: 8px; margin-bottom: 6px; background: #f8f9fa; transition: background 0.2s;
}
.emp-pm-field-item:hover { background: #f0f4f8; }
.emp-pm-field-name { display: flex; align-items: center; font-size: 14px; font-weight: 500; color: #333; }
.emp-pm-field-points { font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 12px; white-space: nowrap; }
.emp-pm-field-points.earned { background: #d4edda; color: #28a745; }
.emp-pm-field-points.pending { background: #fff3cd; color: #856404; }

.emp-pm-complete-btn {
    display: block; text-align: center; margin-top: 18px; padding: 12px;
    background: linear-gradient(135deg, #0073d1, #00b4d8); color: #fff !important;
    border-radius: 10px; font-weight: 600; font-size: 14px; text-decoration: none !important;
    transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 4px 15px rgba(0, 115, 209, 0.3);
}
.emp-pm-complete-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 115, 209, 0.4); color: #fff !important; }
.emp-pm-complete-btn i { margin-right: 6px; }

.emp-pm-congrats {
    display: flex; align-items: center; gap: 10px; padding: 14px;
    background: #fff8e1; border-radius: 10px; margin-top: 18px; font-size: 13px; font-weight: 600; color: #333;
}

/* Responsive */
@media (max-width: 991px) {
    .emp-profile-sidebar {
        padding: 20px;
    }
    .emp-main-content {
        padding: 20px 0 0 0;
    }
}

@media (max-width: 768px) {
    .emp-settings-page {
        padding-top: 30px;
    }
    .emp-profile-sidebar {
        display: none;
    }
    .emp-main-content {
        padding: 15px 0;
    }
}

@media (max-width: 480px) {
    .emp-pm-modal { padding: 20px 15px; max-height: 90vh; border-radius: 12px; }
    .emp-pm-badge { font-size: 14px; padding: 10px 18px; }
    .emp-pm-badge-points { font-size: 20px; }
}

/* ===== LOGOUT MODAL (Same as Employer Dashboard Body) ===== */
.enl-logout-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 24px;
}
.enl-logout-modal-box {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.04);
    max-width: 400px;
    width: 100%;
    overflow: hidden;
    text-align: center;
}
.enl-logout-modal-body { padding: 36px 28px 20px; }
.enl-logout-modal-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #93c5fd;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.enl-logout-modal-icon { color: #fff; }
.enl-logout-modal-title {
    margin: 0 0 8px;
    font-size: 22px;
    font-weight: 700;
    color: #111827;
}
.enl-logout-modal-text {
    margin: 0;
    font-size: 15px;
    color: #6b7280;
    line-height: 1.5;
}
.enl-logout-modal-actions {
    padding: 0 32px 32px 32px;
    display: flex;
    justify-content: space-between;
    gap: 12px;
    position: relative;
    z-index: 2;
}
.enl-logout-btn-secondary {
    background: transparent;
    border: none;
    color: #3b82f6;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 8px;
    order: 1;
}
.enl-logout-btn-secondary:hover { color: #2563eb; background: #eff6ff; }
.enl-logout-btn-primary {
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    padding: 10px 24px;
    order: 2;
}
.enl-logout-btn-primary:hover { background: #2563eb; }
</style>

<div class="emp-settings-page crop-avatar">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="emp-profile-sidebar">
                    <div class="text-center">
                        <div class="emp-avatar-wrapper avatar-view">
                            <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="emp-avatar js-profile-avatar" id="emp-sidebar-avatar">
                            <a href="#" class="emp-avatar-camera" title="{{ __('Change profile photo') }}" data-bs-toggle="modal" data-bs-target="#avatar-modal">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <h5 class="emp-name">Hello, {{ $account->first_name ?? $account->name }}</h5>
                        <p class="emp-date">Joined {{ $account->created_at->format('M d, Y') }}</p>
                        <p class="emp-updated">Last Updated: {{ $account->updated_at->format('M d, Y') }}</p>
                        <a href="{{ $employerPublicProfileUrl ?? route('public.account.companies.index') }}" {{ $employerPublicProfileUrl ? 'target="_blank" rel="noopener"' : '' }} class="emp-view-profile-btn" style="display:inline-block;text-decoration:none;">
                            <i class="fa fa-eye"></i> {{ __('View Profile') }}
                        </a>
                    </div>
                    
                    <!-- Credits Badge (click opens profile completion modal) -->
                    <div class="emp-credits-badge" onclick="document.getElementById('empProfileModal').style.display='flex'" style="cursor:pointer;">
                        <i class="fa fa-coins"></i>
                        <span>Credits:</span>
                        <span class="emp-credits-points">{{ $account->credits ?? 0 }}</span>
                    </div>

                    <!-- Profile Completion -->
                    <div class="emp-profile-completion">
                        <h6>Profile Completion</h6>
                        <div class="emp-completion-bar">
                            <div class="emp-completion-fill" style="width: {{ $completion }}%"></div>
                        </div>
                        <span class="emp-completion-text" onclick="document.getElementById('empProfileModal').style.display='flex'" style="cursor:pointer;">{{ $completion }}% Complete</span>
                    </div>
                    
                    <!-- Navigation -->
                    @php
                        $currentUrl = url()->current();
                        $packageContext = null;
                        $canPost = false;
                        try {
                            $packageContext = \Botble\JobBoard\Supports\PackageContext::forAccount($account);
                            $hasPurchasedPackage = false;
                            if (JobBoardHelper::isEnabledCreditsSystem() && $account->isEmployer()) {
                                $hasPurchasedPackage = \Botble\JobBoard\Models\Transaction::query()
                                    ->where('account_id', $account->getKey())
                                    ->where(function ($q): void {
                                        $q->whereNull('type')->orWhere('type', '!=', 'deduct');
                                    })
                                    ->whereNotNull('payment_id')
                                    ->whereNotNull('package_id')
                                    ->exists();
                            }
                            $canPost = !JobBoardHelper::isEnabledCreditsSystem() || ($hasPurchasedPackage && $packageContext && $packageContext->canPostJob($account));
                        } catch (\Throwable $e) {
                            $canPost = false;
                        }
                        $jobPostCreditsRequired = 0;
                        if ($account->isEmployer() && JobBoardHelper::isEnabledCreditsSystem()) {
                            try {
                                $jobPostCreditsRequired = (int) \Botble\JobBoard\Models\CreditConsumption::getCreditsForFeature('employer', \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING, 600);
                            } catch (\Throwable $e) {
                                $jobPostCreditsRequired = 600;
                            }
                        }
                    @endphp
                    <ul class="emp-sidebar-nav">
                        <li><a href="{{ route('public.account.dashboard') }}" @class(['active' => $currentUrl == route('public.account.dashboard')])><i class="fa fa-home"></i> {{ __('Dashboard') }}</a></li>
                        <li><a href="#" @class(['emp-postjob-choice-trigger' => true, 'emp-nav-locked' => !$canPost, 'active' => $currentUrl == route('public.account.jobs.create')]) data-wallet-url="{{ route('public.account.wallet') }}" data-job-create-url="{{ route('public.account.jobs.create') }}" data-purchase-url="{{ route('public.account.wallet.purchase_job_post_slot') }}" data-credits-required="{{ $jobPostCreditsRequired }}" data-can-post="{{ $canPost ? '1' : '0' }}" title="{{ __('Choose how to post job') }}">@if(!$canPost)<span class="emp-nav-lock-icon"><i class="fa fa-lock"></i></span>@else<i class="fa fa-plus-circle"></i>@endif {{ __('Post Job') }}</a></li>
                        <li><a href="{{ route('public.account.employer.settings.edit') }}" @class(['active' => $currentUrl == route('public.account.employer.settings.edit')])><i class="fa fa-building"></i> {{ __('Settings') }}</a></li>
                        <li><a href="{{ route('public.account.jobs.index') }}" @class(['active' => str_contains($currentUrl, '/jobs') && !str_contains($currentUrl, '/create')])><i class="fa fa-briefcase"></i> {{ __('Jobs') }}</a></li>
                        <li><a href="{{ $canPost ? route('public.account.admission.edit') : route('public.account.wallet') }}" @class(['active' => $canPost && str_contains($currentUrl, 'admission'), 'emp-nav-locked' => !$canPost]) @if(!$canPost) title="{{ trans('plugins/job-board::messages.insufficient_credits') }}" @endif>@if(!$canPost)<span class="emp-nav-lock-icon"><i class="fa fa-lock"></i></span>@else<i class="fa fa-graduation-cap"></i>@endif {{ __('Admission') }}</a></li>
                        <li><a href="{{ route('public.account.companies.index') }}" @class(['active' => str_contains($currentUrl, 'companies')])><i class="fa fa-university"></i> {{ __('Institution') }}</a></li>
                        @if(JobBoardHelper::isEnabledReview())
                        <li><a href="{{ route('public.account.reviews.index') }}" @class(['active' => str_contains($currentUrl, 'reviews')])><i class="fa fa-star"></i> {{ __('Reviews') }}</a></li>
                        @endif
                        <li><a href="{{ route('public.account.applicants.index') }}" @class(['active' => str_contains($currentUrl, 'applicants')])><i class="fa fa-users"></i> {{ __('Applicants') }}</a></li>
                        <li><a href="/candidates" @class(['active' => str_contains($currentUrl, 'candidates')])><i class="fa fa-user-circle"></i> {{ __('All Candidates') }}</a></li>
                        @if(JobBoardHelper::isEnabledCreditsSystem())
                        <li><a href="{{ route('public.account.packages') }}" @class(['active' => str_contains($currentUrl, 'packages')])><i class="fa fa-box"></i> {{ __('Packages') }} <span style="background:#f59e0b;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ $account->credits ?? 0 }}</span></a></li>
                        <li><a href="{{ route('public.account.wallet') }}" @class(['active' => str_contains($currentUrl, 'wallet')])><i class="fa fa-wallet"></i> {{ __('Wallet') }}</a></li>
                        <li><a href="{{ route('public.account.team-members.index') }}" @class(['active' => str_contains($currentUrl, 'team-members')])><i class="fa fa-users-cog"></i> {{ __('Team / Staff') }}</a></li>
                        @endif
                        <li><a href="{{ route('public.account.invoices.index') }}" @class(['active' => str_contains($currentUrl, 'invoices')])><i class="fa fa-file-invoice"></i> {{ __('Invoices') }}</a></li>
                        <li><a href="{{ route('public.account.security') }}" @class(['active' => $currentUrl == route('public.account.security')])><i class="fa fa-lock"></i> {{ __('Security') }}</a></li>
                        <li><a href="{{ route('public.account.logout') }}" id="logout-link-emp" class="emp-logout-link" onclick="event.preventDefault(); if (confirm('Are you sure you want to logout?')) { var f = document.getElementById('logout-form-emp'); if (f) f.submit(); } return false;"><i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="emp-main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Avatar/Logo Modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="{{ route('public.account.avatar') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label">
                            <strong>{{ __('Profile Image') }}</strong>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label class="avatar-file" for="avatarInput">{{ __('Choose image') }}</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file" accept="image/*">
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button class="btn btn-outline-primary avatar-save" type="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form id="logout-form-emp" style="display:none;" action="{{ route('public.account.logout') }}" method="POST">@csrf</form>
<div id="dialog-alert-container"></div>

<!-- Logout confirmation modal (Same as Employer Dashboard Body) -->
<div id="emp-logout-modal-overlay" class="enl-logout-overlay">
    <div id="emp-logout-modal-box" class="enl-logout-modal-box">
        <div class="enl-logout-modal-body">
            <div class="enl-logout-modal-icon-wrap">
                <svg class="enl-logout-modal-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            </div>
            <h4 class="enl-logout-modal-title">Logout</h4>
            <p class="enl-logout-modal-text">Are you sure you want to logout?</p>
        </div>
        <div class="enl-logout-modal-actions">
            <button type="button" id="emp-logout-modal-confirm" class="enl-logout-btn-secondary">Logout</button>
            <button type="button" id="emp-logout-modal-cancel" class="enl-logout-btn-primary">Cancel</button>
        </div>
    </div>
</div>

@if (!isset($dialogSystemLoadedEmp))
    @php
        Theme::asset()->usePath()->add('dialog-alert-css-emp', 'css/dialog-alert.css', [], [], '1.0');
        Theme::asset()->container('footer')->usePath()->add('dialog-alert-js-emp', 'js/dialog-alert.js', ['jquery'], [], '1.0');
        $dialogSystemLoadedEmp = true;
    @endphp
@endif

<!-- Profile Completion Modal -->
<div id="empProfileModal" class="emp-pm-overlay" style="display:none;">
    <div class="emp-pm-modal">
        <button type="button" class="emp-pm-close" onclick="document.getElementById('empProfileModal').style.display='none'">&times;</button>
        
        <!-- Credits Badge -->
        <div class="emp-pm-badge">
            <i class="fa fa-coins"></i>
            <span>Credits:</span>
            <span class="emp-pm-badge-points">{{ $account->credits ?? 0 }}</span>
        </div>

        <!-- Profile Completion -->
        <div class="emp-pm-completion">
            <h6 class="emp-pm-completion-title">Profile Completion</h6>
            <div class="emp-pm-progress-bar">
                <div class="emp-pm-progress-fill" style="width: {{ $completion }}%"></div>
            </div>
            <span class="emp-pm-completion-text">{{ $completion }}% Complete</span>
        </div>

        <!-- Per-field Progress -->
        <div class="emp-pm-field-list">
            @foreach($profileFields as $pf)
                <div class="emp-pm-field-item">
                    <span class="emp-pm-field-name">
                        <i class="fa {{ $pf['filled'] ? 'fa-check-circle' : 'fa-times-circle' }}" style="color: {{ $pf['filled'] ? '#28a745' : '#dc3545' }}; margin-right: 8px;"></i>
                        {{ $pf['label'] }}
                    </span>
                    <span class="emp-pm-field-points {{ $pf['filled'] ? 'earned' : 'pending' }}">
                        {{ $pf['filled'] ? 'Done' : 'Pending' }}
                    </span>
                </div>
            @endforeach
        </div>

        @if($completion < 100)
            <a href="{{ route('public.account.employer.settings.edit') }}" class="emp-pm-complete-btn">
                <i class="fa fa-building"></i> Complete Your Profile
            </a>
        @else
            <div class="emp-pm-congrats">
                <i class="fa fa-trophy" style="color: #f59e0b; font-size: 20px;"></i>
                <span>Congratulations! Your profile is 100% complete.</span>
            </div>
        @endif
    </div>
</div>

@if($account->isEmployer())
{{-- Post Job choice popup: Need assistant (→ Wallet) or Post by self (→ Job form) --}}
<div id="empPostJobChoiceModal" class="emp-pm-overlay" style="display:none;">
    <div class="emp-pm-modal" style="max-width:420px;">
        <button type="button" class="emp-pm-close" onclick="document.getElementById('empPostJobChoiceModal').style.display='none'">&times;</button>
        <h5 style="font-size:18px;font-weight:700;color:#333;margin-bottom:12px;">
            <i class="fa fa-plus-circle" style="color:#0073d1;margin-right:8px;"></i>
            {{ __('Post Job') }}
        </h5>
        <p style="font-size:14px;color:#555;line-height:1.5;margin-bottom:20px;">{{ __('Choose how you want to post a job:') }}</p>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <button type="button" id="empPostJobChoiceNeedAssistantBtn" style="padding:12px 18px;border:1.5px solid #0073d1;border-radius:8px;background:#fff;color:#0073d1;font-size:14px;font-weight:600;cursor:pointer;text-align:left;">
                <i class="fa fa-hand-holding-heart" style="margin-right:8px;"></i> {{ __('Need assistant for job posting') }}
            </button>
            <button type="button" id="empPostJobChoiceBySelfBtn" style="padding:12px 18px;border:none;border-radius:8px;background:linear-gradient(135deg,#0073d1,#005bb5);color:#fff;font-size:14px;font-weight:600;cursor:pointer;text-align:left;">
                <i class="fa fa-edit" style="margin-right:8px;"></i> {{ __('Post a job by self') }}
            </button>
        </div>
    </div>
</div>
<script>
(function() {
    var trigger = document.querySelector('a.emp-postjob-choice-trigger');
    var choiceModal = document.getElementById('empPostJobChoiceModal');
    var needAssistantBtn = document.getElementById('empPostJobChoiceNeedAssistantBtn');
    var bySelfBtn = document.getElementById('empPostJobChoiceBySelfBtn');
    var limitOverModal = document.getElementById('empLimitOverModal');
    if (!trigger || !choiceModal) return;
    trigger.addEventListener('click', function(e) {
        e.preventDefault();
        choiceModal.style.display = 'flex';
    });
    choiceModal.addEventListener('click', function(e) {
        if (e.target === choiceModal) choiceModal.style.display = 'none';
    });
    if (needAssistantBtn) {
        needAssistantBtn.addEventListener('click', function() {
            var url = trigger.getAttribute('data-wallet-url');
            if (url) window.location.href = url;
        });
    }
    if (bySelfBtn) {
        bySelfBtn.addEventListener('click', function() {
            var canPost = trigger.getAttribute('data-can-post') === '1';
            var jobCreateUrl = trigger.getAttribute('data-job-create-url');
            if (canPost && jobCreateUrl) {
                choiceModal.style.display = 'none';
                window.location.href = jobCreateUrl;
            } else if (limitOverModal) {
                choiceModal.style.display = 'none';
                limitOverModal.style.display = 'flex';
            } else if (jobCreateUrl) {
                choiceModal.style.display = 'none';
                window.location.href = jobCreateUrl;
            }
        });
    }
})();
</script>
@endif

@if($account->isEmployer() && $jobPostCreditsRequired > 0)
<!-- Limit over popup: message + Use credits for 1 Job Post (no auto-deduct) -->
<div id="empLimitOverModal" class="emp-pm-overlay" style="display:none;">
    <div class="emp-pm-modal" style="max-width:420px;">
        <button type="button" class="emp-pm-close" onclick="document.getElementById('empLimitOverModal').style.display='none'">&times;</button>
        <h5 style="font-size:18px;font-weight:700;color:#333;margin-bottom:12px;">
            <i class="fa fa-info-circle" style="color:#0073d1;margin-right:8px;"></i>
            {{ trans('plugins/job-board::dashboard.limit_over_job_post_title') }}
        </h5>
        <p style="font-size:14px;color:#555;line-height:1.5;margin-bottom:20px;">
            {{ trans('plugins/job-board::dashboard.limit_over_job_post_message', ['credits' => $jobPostCreditsRequired]) }}
        </p>
        <div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:flex-end;">
            <a href="{{ route('public.account.wallet') }}" id="empLimitOverWalletBtn" style="padding:10px 18px;border:1.5px solid #0073d1;border-radius:8px;background:#fff;color:#0073d1;font-size:14px;font-weight:600;text-decoration:none;">{{ trans('plugins/job-board::dashboard.limit_over_go_to_wallet_btn') }}</a>
            <button type="button" id="empLimitOverUseCreditsBtn" style="padding:10px 18px;border:none;border-radius:8px;background:linear-gradient(135deg,#0073d1,#005bb5);color:#fff;font-size:14px;font-weight:600;cursor:pointer;">
                {{ trans('plugins/job-board::dashboard.limit_over_use_credits_btn', ['credits' => $jobPostCreditsRequired]) }}
            </button>
        </div>
    </div>
</div>
<script>
(function() {
    var trigger = document.querySelector('a.emp-postjob-choice-trigger[data-purchase-url]');
    var modal = document.getElementById('empLimitOverModal');
    var useCreditsBtn = document.getElementById('empLimitOverUseCreditsBtn');
    if (!trigger || !modal || !useCreditsBtn) return;
    modal.addEventListener('click', function(e) {
        if (e.target === modal) modal.style.display = 'none';
    });
    useCreditsBtn.addEventListener('click', function() {
        var url = trigger.getAttribute('data-purchase-url');
        var jobCreateUrl = trigger.getAttribute('data-job-create-url');
        var csrf = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (!url || !csrf) { alert('Something went wrong.'); return; }
        useCreditsBtn.disabled = true;
        useCreditsBtn.textContent = '...';
        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({})
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success && jobCreateUrl) {
                modal.style.display = 'none';
                window.location.href = jobCreateUrl;
            } else {
                alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
            }
        })
        .catch(function() { alert('Something went wrong.'); })
        .finally(function() {
            useCreditsBtn.disabled = false;
            useCreditsBtn.textContent = '{{ trans('plugins/job-board::dashboard.limit_over_use_credits_btn', ['credits' => $jobPostCreditsRequired]) }}';
        });
    });
})();
</script>
@endif

<script>
document.getElementById('empProfileModal').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        var modal = document.getElementById('empProfileModal');
        if (modal) modal.style.display = 'none';
    }
});

// Logout with confirmation modal (Same as Employer Dashboard Body)
(function() {
    function showEmpLogoutModal() {
        var overlay = document.getElementById('emp-logout-modal-overlay');
        if (overlay) {
            overlay.style.display = 'flex';
        }
    }
    function hideEmpLogoutModal() {
        var overlay = document.getElementById('emp-logout-modal-overlay');
        if (overlay) overlay.style.display = 'none';
    }
    
    function handleEmpLogoutClick(e) {
        e.preventDefault();
        e.stopPropagation();
        if (typeof window.showEmpLogoutModal === 'function') {
            window.showEmpLogoutModal();
        } else {
            var f = document.getElementById('logout-form-emp');
            if (f) f.submit();
        }
        return false;
    }
    
    function initEmpLogout() {
        var link = document.getElementById('logout-link-emp');
        var cancelBtn = document.getElementById('emp-logout-modal-cancel');
        var confirmBtn = document.getElementById('emp-logout-modal-confirm');
        var overlay = document.getElementById('emp-logout-modal-overlay');
        var logoutForm = document.getElementById('logout-form-emp');
        
        if (link) {
            link.removeEventListener('click', handleEmpLogoutClick);
            link.addEventListener('click', handleEmpLogoutClick);
        }
        
        if (cancelBtn && confirmBtn && overlay && logoutForm) {
            cancelBtn.onclick = hideEmpLogoutModal;
            confirmBtn.onclick = function() {
                hideEmpLogoutModal();
                logoutForm.submit();
            };
            overlay.onclick = function(e) {
                if (e.target === this) hideEmpLogoutModal();
            };
            window.showEmpLogoutModal = showEmpLogoutModal;
        }
        
        if (!link || !cancelBtn || !confirmBtn) {
            setTimeout(initEmpLogout, 150);
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() { setTimeout(initEmpLogout, 300); });
    } else {
        setTimeout(initEmpLogout, 300);
    }
    window.addEventListener('load', function() { setTimeout(initEmpLogout, 400); });
})();
</script>

@push('footer')
    <script>
        'use strict';

        var RV_MEDIA_URL = {
            base: '{{ url('') }}',
            filebrowserImageBrowseUrl: false,
            media_upload_from_editor: '{{ route('public.account.upload-from-editor') }}'
        }

        function setImageValue(file) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(file);
        }
    </script>
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="tinymce_form" action="{{ route('public.account.upload-from-editor') }}" target="form_target" method="post" enctype="multipart/form-data"
          style="width:0; height:0; overflow:hidden; display: none;">
        @csrf
        <input name="upload" id="upload_file" type="file" onchange="$('#tinymce_form').submit();this.value='';">
        <input type="hidden" value="tinymce" name="upload_type">
    </form>
@endpush
