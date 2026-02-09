@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    
    $account = auth('account')->user();
    $company = $account->companies()->first();
    
    // Profile completion
    $completion = 0;
    if($company) {
        if($company->name) $completion += 15;
        if($company->email) $completion += 10;
        if($company->phone) $completion += 10;
        if($company->logo) $completion += 15;
        if($company->description) $completion += 10;
        if($company->address) $completion += 10;
        if($company->institution_type) $completion += 10;
        if($company->year_founded) $completion += 5;
        if($company->campus_type) $completion += 5;
        if($company->standard_level) $completion += 5;
        if($company->staff_facilities) $completion += 5;
    }
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
}

.emp-profile-sidebar .emp-avatar {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    margin-bottom: 15px;
}

.emp-profile-sidebar .emp-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.emp-profile-sidebar .emp-type {
    font-size: 12px;
    color: #0073d1;
    margin: 0 0 20px 0;
    font-weight: 500;
}

.emp-profile-completion {
    margin-bottom: 25px;
}

.emp-profile-completion h6 {
    font-size: 13px;
    font-weight: 500;
    color: #555;
    margin: 0 0 8px 0;
}

.emp-completion-bar {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 6px;
}

.emp-completion-fill {
    height: 100%;
    background: linear-gradient(90deg, #0073d1, #00b4d8);
    border-radius: 3px;
    transition: width 0.4s ease;
}

.emp-completion-text {
    font-size: 12px;
    color: #888;
}

.emp-sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.emp-sidebar-nav li {
    margin-bottom: 4px;
}

.emp-sidebar-nav li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 8px;
    color: #555;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
}

.emp-sidebar-nav li a:hover {
    background: #f0f7ff;
    color: #0073d1;
}

.emp-sidebar-nav li a.active {
    background: #0073d1;
    color: #fff;
}

.emp-sidebar-nav li a i {
    width: 18px;
    text-align: center;
}

.emp-main-content {
    padding: 15px 0;
}

@media (max-width: 768px) {
    .emp-settings-page {
        padding-top: 30px;
    }
    .emp-main-content {
        padding: 15px 0;
    }
}
</style>

<div class="emp-settings-page crop-avatar">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="emp-profile-sidebar">
                    <div class="text-center">
                        @if($company && $company->logo)
                            <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name ?? $account->name }}" class="emp-avatar">
                        @else
                            <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="emp-avatar js-profile-avatar">
                        @endif
                        <h5 class="emp-name">{{ $company->name ?? $account->name }}</h5>
                        <p class="emp-type">Employer</p>
                    </div>
                    
                    <!-- Profile Completion -->
                    <div class="emp-profile-completion">
                        <h6>Profile Completion</h6>
                        <div class="emp-completion-bar">
                            <div class="emp-completion-fill" style="width: {{ $completion }}%"></div>
                        </div>
                        <span class="emp-completion-text">{{ $completion }}% Complete</span>
                    </div>
                    
                    <!-- Navigation -->
                    @php
                        $currentUrl = url()->current();
                    @endphp
                    <ul class="emp-sidebar-nav">
                        <li><a href="{{ route('public.account.dashboard') }}" @class(['active' => $currentUrl == route('public.account.dashboard')])><i class="fa fa-home"></i> {{ __('Dashboard') }}</a></li>
                        <li><a href="{{ route('public.account.employer.settings.edit') }}" @class(['active' => $currentUrl == route('public.account.employer.settings.edit')])><i class="fa fa-building"></i> {{ __('Profile') }}</a></li>
                        <li><a href="{{ route('public.account.jobs.index') }}" @class(['active' => str_contains($currentUrl, '/jobs')])><i class="fa fa-briefcase"></i> {{ __('Jobs') }}</a></li>
                        <li><a href="{{ route('public.account.companies.index') }}" @class(['active' => str_contains($currentUrl, 'companies')])><i class="fa fa-university"></i> {{ __('Institution') }}</a></li>
                        <li><a href="{{ route('public.account.applicants.index') }}" @class(['active' => str_contains($currentUrl, 'applicants')])><i class="fa fa-users"></i> {{ __('Applicants') }}</a></li>
                        @if(JobBoardHelper::isEnabledCreditsSystem())
                        <li><a href="{{ route('public.account.packages') }}" @class(['active' => str_contains($currentUrl, 'packages')])><i class="fa fa-box"></i> {{ __('Packages') }}</a></li>
                        @endif
                        <li><a href="{{ route('public.account.security') }}" @class(['active' => $currentUrl == route('public.account.security')])><i class="fa fa-key"></i> {{ __('Change Password') }}</a></li>
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
                            <i class="fas fa-magic"></i> {{ __('Change Logo') }}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button class="btn btn-primary avatar-save" type="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
