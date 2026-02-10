@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->add('tagify-css', 'vendor/core/core/base/libraries/tagify/tagify.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    Theme::asset()->container('footer')->add('tagify-js', 'vendor/core/core/base/libraries/tagify/tagify.js');
    Theme::asset()->container('footer')->usePath()->add('tags-js', 'js/tagify-select.js');
    
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
    $walletPoints = $earnedPoints;
@endphp

<style>
.js-settings-page {
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
    margin-top: 20px;
    padding-top: 75px;
}

/* Profile Sidebar */
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

/* Main Content Area */
.js-main-content {
    padding: 0 0 40px 0px;
}

.js-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.js-page-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-page-header a {
    color: #0073d1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

.js-page-header a:hover {
    text-decoration: underline;
}

/* Content Card */
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
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-content-card-body {
    padding: 25px;
}

/* Form Styling */
.js-content-card .form-group {
    margin-bottom: 20px;
}

.js-content-card .form-label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.js-content-card .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
}

.js-content-card .form-control:focus {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
}

.js-content-card .btn-primary {
    background: #0073d1;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 14px;
    font-weight: 500;
}

.js-content-card .btn-primary:hover {
    background: #005bb5;
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

.js-wallet-badge i { font-size: 16px; }
.js-wallet-points { font-size: 18px; font-weight: 700; }

/* Profile Field Progress */
.js-field-progress { margin-top: 10px; }

.js-field-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 12px;
    border-bottom: 1px solid #f5f5f5;
}
.js-field-item:last-child { border-bottom: none; }

.js-field-item .field-name {
    color: #555;
    display: flex;
    align-items: center;
    gap: 6px;
}
.js-field-item .field-name i { font-size: 10px; }
.js-field-item .field-name i.completed { color: #28a745; }
.js-field-item .field-name i.pending { color: #dc3545; }

.js-field-item .field-points {
    font-weight: 600;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
}
.js-field-item .field-points.earned { background: #e8f5e9; color: #28a745; }
.js-field-item .field-points.available { background: #fff3e0; color: #e65100; }

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
.js-reward-message i { font-size: 18px; color: #f57c00; }

/* Responsive */
@media (max-width: 991px) {
    .js-profile-sidebar {
        padding: 20px;
    }
    .js-main-content {
        padding: 20px 0 0 0;
    }
}

@media (max-width: 768px) {
    .js-profile-sidebar {
        display: none;
    }
    .js-main-content {
        padding: 15px 0;
    }
}
</style>

<div class="js-settings-page crop-avatar">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="js-profile-sidebar">
                    <div class="text-center">
                        <div class="js-profile-avatar-wrapper">
                            <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="js-profile-avatar">
                            <a href="#" class="js-avatar-camera-btn" data-bs-toggle="modal" data-bs-target="#avatar-modal" title="{{ __('Change Photo') }}">
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
                    @php
                        $currentUrl = url()->current();
                    @endphp
                    <ul class="js-sidebar-nav">
                        <li><a href="{{ route('public.account.jobseeker.dashboard') }}" @class(['active' => $currentUrl == route('public.account.jobseeker.dashboard')])><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ route('public.account.settings') }}" @class(['active' => $currentUrl == route('public.account.settings')])><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="{{ route('public.account.jobs.saved') }}" @class(['active' => $currentUrl == route('public.account.jobs.saved')])><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="{{ route('public.account.jobs.applied-jobs') }}" @class(['active' => $currentUrl == route('public.account.jobs.applied-jobs')])><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="{{ route('public.account.experiences.index') }}" @class(['active' => str_contains($currentUrl, 'experience')])><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="{{ route('public.account.educations.index') }}" @class(['active' => str_contains($currentUrl, 'education')])><i class="fa fa-graduation-cap"></i> Education</a></li>
                        <li><a href="#" @class(['active' => false])><i class="fa fa-wallet"></i> Wallet <span style="background:#f59e0b;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ $walletPoints }}</span></a></li>
                        <li><a href="{{ route('public.account.resume-builder') }}" @class(['active' => str_contains($currentUrl, 'resume-builder')])><i class="fa fa-file-pdf"></i> Resume Builder</a></li>
                        <li><a href="{{ route('public.account.security') }}" @class(['active' => $currentUrl == route('public.account.security')])><i class="fa fa-lock"></i> Security</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="js-main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Avatar Modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="{{ route('public.account.avatar') }}" enctype="multipart/form-data">
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
                                @csrf
                                <label for="avatarInput">{{ __('New image') }}</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <div class="loading" tabindex="-1" role="img" aria-label="{{ __('Loading') }}"></div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                    <div class="error-message text-danger" style="display: none"></div>
                                </div>
                                <div class="col-md-3 avatar-preview-wrapper">
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
