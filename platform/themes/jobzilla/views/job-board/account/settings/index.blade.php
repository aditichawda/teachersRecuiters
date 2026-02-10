@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
<!-- TomSelect CSS -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">

<style>
    .profile-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        overflow: visible;
    }
    .profile-section-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 600;
    }
    .profile-section-header i {
        margin-right: 10px;
    }
    .profile-section-body {
        padding: 20px;
    }
    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
        font-size: 14px;
    }
    .form-label .required {
        color: #dc3545;
    }
    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .form-check-input:checked {
        background-color: #0073d1;
        border-color: #0073d1;
    }
    .form-text {
        font-size: 12px;
        color: #64748b;
    }
    .btn-save {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
    }
    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    }
    .add-more-btn {
        background: #f0f7ff;
        color: #0073d1;
        border: 1px dashed #0073d1;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
    }
    .add-more-btn:hover {
        background: #e0efff;
    }
    .removable-item {
        position: relative;
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .remove-item-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #fee2e2;
        color: #dc3545;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        font-size: 12px;
        cursor: pointer;
    }
    .priority-badge {
        background: #0073d1;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
    }
    .password-toggle-section {
        background: #f8fafc;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    /* TomSelect Custom Styles */
    .ts-wrapper {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        background: #fff;
    }
    .ts-wrapper.focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .ts-wrapper .ts-control {
        border: 1.5px solid #e2e8f0;
        padding: 8px 12px;
        min-height: 44px;
        border-radius: 8px;
        background: #fff;
    }
    .ts-wrapper .ts-control input {
        font-size: 14px;
    }
    .ts-wrapper .ts-control .item {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 500;
        margin: 2px 4px 2px 0;
    }
    .ts-wrapper .ts-control .item .remove {
        color: rgba(255,255,255,0.8);
        border-left: 1px solid rgba(255,255,255,0.3);
        margin-left: 6px;
        padding-left: 6px;
        font-size: 14px;
    }
    .ts-wrapper .ts-control .item .remove:hover {
        color: #fff;
    }
    .ts-dropdown {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        z-index: 9999;
        margin-top: 4px;
    }
    .ts-dropdown .optgroup-header {
        background: #f0f7ff;
        color: #0073d1;
        font-weight: 600;
        font-size: 12px;
        padding: 8px 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .ts-dropdown .option {
        padding: 10px 14px;
        font-size: 14px;
        color: #333;
    }
    .ts-dropdown .option:hover,
    .ts-dropdown .option.active {
        background: #f0f7ff;
        color: #0073d1;
    }
    .ts-dropdown .option.selected {
        background: #e8f4fd;
        color: #005bb5;
    }
    .ts-dropdown .no-results {
        padding: 12px 14px;
        color: #999;
        font-size: 13px;
    }
    .ts-max-info {
        font-size: 12px;
        color: #64748b;
        margin-top: 4px;
    }
    .ts-max-info .count {
        color: #0073d1;
        font-weight: 600;
    }
    .profile-section-header {
        border-radius: 12px 12px 0 0;
    }
    .profile-section-body {
        overflow: visible;
    }

    /* Mobile Responsive for TomSelect */
    @media (max-width: 768px) {
        .ts-wrapper .ts-control {
            min-height: 42px;
            padding: 6px 10px;
        }
        .ts-wrapper .ts-control .item {
            font-size: 11px;
            padding: 3px 8px;
        }
        .ts-dropdown .option {
            padding: 12px 14px;
            font-size: 14px;
        }
        .ts-dropdown .optgroup-header {
            padding: 8px 14px;
        }
    }

    /* Profile Photo Section */
    .profile-photo-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        padding: 25px;
        overflow: visible;
    }
    .profile-photo-wrapper {
        display: flex;
        align-items: center;
        gap: 25px;
    }
    .profile-photo-img {
        position: relative;
        flex-shrink: 0;
    }
    .profile-photo-img img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e2e8f0;
        transition: all 0.3s;
    }
    .profile-photo-img:hover img {
        border-color: #0073d1;
    }
    .profile-photo-badge {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 30px;
        height: 30px;
        background: #0073d1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 13px;
        border: 2px solid #fff;
        cursor: pointer;
        transition: all 0.2s;
    }
    .profile-photo-badge:hover {
        background: #005bb5;
        transform: scale(1.1);
    }
    .profile-photo-info {
        flex: 1;
    }
    .profile-photo-info h5 {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 5px 0;
    }
    .profile-photo-info p {
        font-size: 13px;
        color: #64748b;
        margin: 0 0 12px 0;
    }
    .profile-photo-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-change-photo {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-change-photo:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,115,209,0.3);
        color: #fff;
    }
    .btn-remove-photo {
        background: #fff;
        color: #dc3545;
        border: 1px solid #fecaca;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-remove-photo:hover {
        background: #fef2f2;
        border-color: #dc3545;
    }

    @media (max-width: 480px) {
        .profile-photo-wrapper {
            flex-direction: column;
            text-align: center;
        }
        .profile-photo-info {
            text-align: center;
        }
        .profile-photo-actions {
            justify-content: center;
        }
    }

    /* Speech to Text Button */
    .speech-to-text-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0f7ff;
        color: #0073d1;
        border: 1px solid #0073d1;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 8px;
    }
    .speech-to-text-btn:hover {
        background: #0073d1;
        color: #fff;
    }
    .speech-to-text-btn.recording {
        background: #dc3545;
        color: #fff;
        border-color: #dc3545;
        animation: pulse-recording 1.5s infinite;
    }
    @keyframes pulse-recording {
        0%, 100% { box-shadow: 0 0 0 0 rgba(220,53,69,0.4); }
        50% { box-shadow: 0 0 0 8px rgba(220,53,69,0); }
    }
    .speech-status {
        font-size: 12px;
        color: #64748b;
        margin-left: 8px;
        display: none;
    }
    .speech-status.active {
        display: inline;
        color: #dc3545;
        font-weight: 500;
    }

    /* Voice Recorder Styles */
    .voice-recorder-wrapper {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        background: #f8fafc;
        margin-top: 8px;
    }
    .voice-recorder-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .btn-record {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-record:hover { background: #c82333; }
    .btn-record.recording {
        animation: pulse-recording 1.5s infinite;
    }
    .btn-record-stop {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #333;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
    }
    .recording-timer {
        font-size: 14px;
        font-weight: 600;
        color: #dc3545;
        font-family: monospace;
    }
    .recorded-audio-preview {
        margin-top: 10px;
        display: none;
    }
    .recorded-audio-preview audio {
        width: 100%;
        max-width: 400px;
    }
    .recorded-audio-actions {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }

    /* Autocomplete Styles for Specialization */
    .specialization-autocomplete-wrapper {
        position: relative;
    }
    .specialization-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: none;
    }
    .specialization-suggestions.active {
        display: block;
    }
    .specialization-suggestion-item {
        padding: 8px 14px;
        font-size: 13px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
    }
    .specialization-suggestion-item:hover,
    .specialization-suggestion-item.highlighted {
        background: #f0f7ff;
        color: #0073d1;
    }
    .specialization-suggestion-item:last-child {
        border-bottom: none;
    }
</style>

    <!-- Page Header -->
    <div class="js-page-header">
        <h2>{{ __('My Profile') }}</h2>
        <a href="{{ url('/') }}">GO TO HOMEPAGE →</a>
    </div>

    <!-- Profile Photo Section -->
    <div class="profile-photo-section">
        <div class="profile-photo-wrapper">
            <div class="profile-photo-img avatar-view">
                <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" id="profile-photo-display">
                <div class="profile-photo-badge" title="{{ __('Change Photo') }}">
                    <i class="fa fa-camera"></i>
                </div>
            </div>
            <div class="profile-photo-info">
                <h5>{{ __('Profile Photo') }}</h5>
                <p>{{ __('JPG, PNG or GIF. Max size 2MB. A clear face photo helps schools recognize you.') }}</p>
                <div class="profile-photo-actions">
                    <button type="button" class="btn-change-photo" data-bs-toggle="modal" data-bs-target="#avatar-modal">
                        <i class="fa fa-upload me-1"></i> {{ __('Change Photo') }}
                    </button>
                    @if($account->avatar_id)
                        <button type="button" class="btn-remove-photo" id="remove-avatar-btn">
                            <i class="fa fa-trash me-1"></i> {{ __('Remove') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true, 'id' => 'profile-form']) !!}

    <!-- Section 1: Personal Details -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-user"></i> {{ __('Personal Details') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 1. Full Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Full Name') }} <span class="required">*</span></label>
                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $account->first_name) }}" placeholder="{{ __('Enter your full name') }}" required>
                </div>

                <!-- 2. Email Address -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email Address') }} <span class="required">*</span></label>
                    <input type="email" class="form-control" value="{{ $account->email }}" disabled>
                    <small class="form-text">{{ __('Email cannot be changed') }}</small>
                </div>

                <!-- 3. Mobile Number -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Mobile Number') }} <span class="required">*</span></label>
                    <input type="tel" class="form-control" name="phone" value="{{ old('phone', $account->phone) }}" placeholder="{{ __('Enter mobile number with country code') }}">
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_whatsapp_available" value="1" id="is_whatsapp_available" @checked(old('is_whatsapp_available', $account->is_whatsapp_available))>
                        <label class="form-check-label" for="is_whatsapp_available">{{ __('This number is available on WhatsApp') }}</label>
                    </div>
                </div>

                <!-- Password Change Toggle -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <div class="password-toggle-section">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="change_password_toggle">
                            <label class="form-check-label" for="change_password_toggle">{{ __('Click to change password') }}</label>
                        </div>
                        <div id="password_fields" style="display: none;" class="mt-3">
                            <input type="password" class="form-control mb-2" name="new_password" placeholder="{{ __('New Password') }}">
                            <input type="password" class="form-control" name="new_password_confirmation" placeholder="{{ __('Confirm New Password') }}">
                        </div>
                    </div>
                </div>

                <!-- 4. Alternate Contact -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Alternate Contact') }}</label>
                    <input type="tel" class="form-control" name="alternate_phone" value="{{ old('alternate_phone', $account->alternate_phone ?? '') }}" placeholder="{{ __('Alternate phone number') }}">
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_alternate_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_alternate_whatsapp_available" value="1" id="is_alternate_whatsapp_available" @checked(old('is_alternate_whatsapp_available', $account->is_alternate_whatsapp_available ?? false))>
                        <label class="form-check-label" for="is_alternate_whatsapp_available">{{ __('This number is available on WhatsApp') }}</label>
                    </div>
                </div>

                <!-- 5. Gender -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Gender') }} <span class="required">*</span></label>
                    <div class="d-flex gap-3 mt-2">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="male" id="gender_male" @checked(old('gender', $account->gender) == 'male')>
                            <label class="form-check-label" for="gender_male">{{ __('Male') }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="gender" value="female" id="gender_female" @checked(old('gender', $account->gender) == 'female')>
                            <label class="form-check-label" for="gender_female">{{ __('Female') }}</label>
                        </div>
                    </div>
                </div>

                <!-- 6. Marital Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Marital Status') }}</label>
                    <div class="d-flex gap-3 flex-wrap mt-2">
                        @foreach(['single' => 'Single', 'married' => 'Married', 'separated' => 'Separated', 'others' => 'Others'] as $value => $label)
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="marital_status" value="{{ $value }}" id="marital_{{ $value }}" @checked(old('marital_status', $account->marital_status ?? '') == $value)>
                                <label class="form-check-label" for="marital_{{ $value }}">{{ __($label) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 7. DOB -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Date of Birth') }} <span class="required">*</span></label>
                    <input type="date" class="form-control" name="dob" value="{{ old('dob', $account->dob ? $account->dob->format('Y-m-d') : '') }}" max="{{ now()->subYears(16)->format('Y-m-d') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Profile Visibility & Work Status -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-eye"></i> {{ __('Profile Visibility & Work Status') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 9. Profile Visibility -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Profile Visibility (Open for School View)') }} <span class="required">*</span></label>
                    <select class="form-select" name="profile_visibility">
                        <option value="1" @selected(old('profile_visibility', $account->profile_visibility ?? 1) == 1)>{{ __('Yes - Schools can view my profile') }}</option>
                        <option value="0" @selected(old('profile_visibility', $account->profile_visibility ?? 1) == 0)>{{ __('No - Hide my profile') }}</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Additional Privacy Options') }}</label>
                    <div class="form-check mb-2">
                        <input type="hidden" name="hide_resume" value="0">
                        <input type="checkbox" class="form-check-input" name="hide_resume" value="1" id="hide_resume" @checked(old('hide_resume', $account->hide_resume ?? false))>
                        <label class="form-check-label" for="hide_resume">{{ __('Hide Resume') }}</label>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="hide_name_for_employer" value="0">
                        <input type="checkbox" class="form-check-input" name="hide_name_for_employer" value="1" id="hide_name_for_employer" @checked(old('hide_name_for_employer', $account->hide_name_for_employer ?? false))>
                        <label class="form-check-label" for="hide_name_for_employer">{{ __('Hide only name for Employer/School') }}</label>
                    </div>
                </div>

                <!-- 10. Current Work Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Current Work Status') }} <span class="required">*</span></label>
                    <select class="form-select" name="current_work_status" id="current_work_status">
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="not_working" @selected(old('current_work_status', $account->current_work_status ?? '') == 'not_working')>{{ __('Not Working Now - Immediate Joiner') }}</option>
                        <option value="working" @selected(old('current_work_status', $account->current_work_status ?? '') == 'working')>{{ __('Working Now') }}</option>
                    </select>
                </div>

                <!-- 11. Notice Period (shown if working) -->
                <div class="col-md-6 mb-3" id="notice_period_wrapper" style="display: none;">
                    <label class="form-label">{{ __('Notice Period') }}</label>
                    <select class="form-select" name="notice_period">
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="7_days" @selected(old('notice_period', $account->notice_period ?? '') == '7_days')>{{ __('7 Days') }}</option>
                        <option value="15_days" @selected(old('notice_period', $account->notice_period ?? '') == '15_days')>{{ __('15 Days') }}</option>
                        <option value="1_month" @selected(old('notice_period', $account->notice_period ?? '') == '1_month')>{{ __('1 Month') }}</option>
                        <option value="2_months" @selected(old('notice_period', $account->notice_period ?? '') == '2_months')>{{ __('2 Months') }}</option>
                        <option value="3_months" @selected(old('notice_period', $account->notice_period ?? '') == '3_months')>{{ __('3 Months') }}</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-check mt-4">
                        <input type="hidden" name="available_for_immediate_joining" value="0">
                        <input type="checkbox" class="form-check-input" name="available_for_immediate_joining" value="1" id="available_for_immediate_joining" @checked(old('available_for_immediate_joining', $account->available_for_immediate_joining ?? false))>
                        <label class="form-check-label" for="available_for_immediate_joining">{{ __('Available for Immediate Joining') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: About / Bio -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-info-circle"></i> {{ __('About / Bio / Career Aspiration') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 12. Bio -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('About / Bio / Career Aspiration') }}</label>
                    <div class="mb-2">
                        <button type="button" class="speech-to-text-btn" id="bio-speech-btn" onclick="toggleSpeechToText()">
                            <i class="fa fa-microphone"></i> <span id="speech-btn-text">{{ __('Speech to Text') }}</span>
                        </button>
                        <span class="speech-status" id="speech-status">🔴 {{ __('Listening...') }}</span>
                    </div>
                    {!! Form::customEditor('bio', old('bio', $account->bio)) !!}
                    <small class="form-text">{{ __('Tell schools about yourself, your teaching philosophy, and career goals') }}</small>
                </div>
            </div>
        </div>
    </div>
    <!-- Section 7: Job Preferences -->
    <div class="profile-section">
            <div class="profile-section-header">
                <i class="fa fa-briefcase"></i> {{ __('Job Preferences') }}
            </div>
            <div class="profile-section-body">
                <div class="row">
                    <!-- 23. Institution Type Preferences -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Looking job for which type of Educational Institutions') }} <span class="required">*</span></label>
                        <select id="ts-institution-types" name="institution_types[]" multiple placeholder="{{ __('Search & select up to 3...') }}">
                            @php $instTypes = old('institution_types', $account->institution_types ?? []); @endphp
                            <optgroup label="School">
                                @foreach(['cbse_school' => 'CBSE School', 'icse_school' => 'ICSE School', 'cambridge_school' => 'Cambridge School', 'ib_school' => 'IB School', 'state_board_school' => 'State Board School', 'play_school' => 'Play School'] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, $instTypes))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="College">
                                @foreach(['engineering_college' => 'Engineering College', 'medical_college' => 'Medical College', 'nursing_college' => 'Nursing College'] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, $instTypes))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Others">
                                @foreach(['edtech_company' => 'EdTech Company', 'coaching_institute' => 'Coaching Institute', 'university' => 'University'] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, $instTypes))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="ts-max-info"><span class="count" id="inst-count">0</span>/3 {{ __('selected') }}</div>
                    </div>

                    <!-- 24. Position Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Looking for which position?') }} <span class="required">*</span></label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="teaching" id="position_teaching" @checked(str_contains(old('position_type', $account->position_type ?? ''), 'teaching'))>
                                <label class="form-check-label" for="position_teaching">{{ __('Teaching') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="non_teaching" id="position_non_teaching" @checked(str_contains(old('position_type', $account->position_type ?? ''), 'non_teaching'))>
                                <label class="form-check-label" for="position_non_teaching">{{ __('Non-Teaching') }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- 25. Teaching Subjects (shown when Teaching is selected) -->
                    <div class="col-md-12 mb-3" id="teaching_subjects_wrapper">
                        <label class="form-label">{{ __('Teaching Subjects / Post') }} ({{ __('Select up to 3') }}) <span class="required">*</span></label>
                        <select id="ts-teaching-subjects" name="teaching_subjects[]" multiple placeholder="{{ __('Search & select up to 3 subjects...') }}">
                            @php $teachingSubjects = old('teaching_subjects', $account->teaching_subjects ?? []); @endphp
                            <optgroup label="Primary Level">
                                @foreach([
                                    'english_primary' => 'English (Primary)',
                                    'hindi_primary' => 'Hindi (Primary)',
                                    'mathematics_primary' => 'Mathematics (Primary)',
                                    'evs_primary' => 'EVS (Primary)',
                                    'social_studies_primary' => 'Social Studies (Primary)',
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, (array)$teachingSubjects))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Upper Primary Level">
                                @foreach([
                                    'english_upper_primary' => 'English (Upper Primary)',
                                    'hindi_upper_primary' => 'Hindi (Upper Primary)',
                                    'mathematics_upper_primary' => 'Mathematics (Upper Primary)',
                                    'science_upper_primary' => 'Science (Upper Primary)',
                                    'social_science_upper_primary' => 'Social Science (Upper Primary)',
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, (array)$teachingSubjects))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Secondary Level">
                                @foreach([
                                    'physics_secondary' => 'Physics (Secondary)',
                                    'chemistry_secondary' => 'Chemistry (Secondary)',
                                    'biology_secondary' => 'Biology (Secondary)',
                                    'mathematics_secondary' => 'Mathematics (Secondary)',
                                    'english_secondary' => 'English (Secondary)',
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, (array)$teachingSubjects))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Higher Secondary Level">
                                @foreach([
                                    'physics_higher_secondary' => 'Physics (Higher Secondary)',
                                    'chemistry_higher_secondary' => 'Chemistry (Higher Secondary)',
                                    'biology_higher_secondary' => 'Biology (Higher Secondary)',
                                    'mathematics_higher_secondary' => 'Mathematics (Higher Secondary)',
                                    'commerce_higher_secondary' => 'Commerce (Higher Secondary)',
                                    'accountancy_higher_secondary' => 'Accountancy (Higher Secondary)',
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, (array)$teachingSubjects))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="College Level">
                                @foreach([
                                    'english_degree' => 'English (Degree College)',
                                    'zoology_degree' => 'Zoology (Degree College)',
                                    'botany_degree' => 'Botany (Degree College)',
                                    'physics_degree' => 'Physics (Degree College)',
                                    'chemistry_degree' => 'Chemistry (Degree College)',
                                    'mechanics_engineering' => 'Mechanics (Engineering College)',
                                ] as $val => $lbl)
                                    <option value="{{ $val }}" @selected(in_array($val, (array)$teachingSubjects))>{{ $lbl }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="ts-max-info"><span class="count" id="subj-count">0</span>/3 {{ __('selected') }}</div>
                    </div>

                    <!-- Non-Teaching Positions (shown when Non-Teaching is selected) -->
                    <div class="col-md-12 mb-3" id="non_teaching_positions_wrapper" style="display: none;">
                        <label class="form-label">{{ __('Non-Teaching Positions') }} ({{ __('Select up to 3') }}) <span class="required">*</span></label>
                        <select id="ts-non-teaching" name="non_teaching_positions[]" multiple placeholder="{{ __('Search & select up to 3 positions...') }}">
                            @php $nonTeachingPositions = old('non_teaching_positions', $account->non_teaching_positions ?? []); @endphp
                            @foreach([
                                'principal' => 'School Principal',
                                'vice_principal' => 'Vice Principal',
                                'administrator' => 'Administrator',
                                'hr' => 'HR',
                                'hostel_warden' => 'Hostel Warden',
                                'counselor' => 'Counselor',
                                'academic_coordinator' => 'Academic Coordinator',
                                'librarian' => 'Librarian',
                                'lab_assistant' => 'Lab Assistant',
                                'office_staff' => 'Office Staff',
                            ] as $val => $lbl)
                                <option value="{{ $val }}" @selected(in_array($val, (array)$nonTeachingPositions))>{{ $lbl }}</option>
                            @endforeach
                        </select>
                        <div class="ts-max-info"><span class="count" id="nt-count">0</span>/3 {{ __('selected') }}</div>
                    </div>

                    <!-- 26. Job Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Job Type') }} <span class="required">*</span></label>
                        <select id="ts-job-type" name="job_type_preferences[]" multiple placeholder="{{ __('Select job types...') }}">
                            @php $jobTypes = old('job_type_preferences', $account->job_type_preferences ?? []); @endphp
                            @foreach(['full_time' => 'Full-Time', 'part_time' => 'Part-Time', 'internship' => 'Internship', 'freelance' => 'Freelance', 'contract' => 'Contract', 'remote' => 'Remote'] as $val => $lbl)
                                <option value="{{ $val }}" @selected(in_array($val, (array)$jobTypes))>{{ $lbl }}</option>
                            @endforeach
                        </select>
                        <div class="form-check mt-2">
                            <input type="hidden" name="remote_only" value="0">
                            <input type="checkbox" class="form-check-input" name="remote_only" value="1" id="remote_only" @checked(old('remote_only', $account->remote_only ?? false))>
                            <label class="form-check-label" for="remote_only">{{ __('Available only for Remote jobs') }}</label>
                        </div>
                    </div>

                    <!-- Salary (moved from Personal Details) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Current Salary') }} <span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="current_salary" value="{{ old('current_salary', $account->current_salary ?? '') }}" placeholder="0">
                            <select class="form-select" name="current_salary_period" style="max-width: 120px;">
                                <option value="month" @selected(old('current_salary_period', $account->current_salary_period ?? 'month') == 'month')>/ Month</option>
                                <option value="hour" @selected(old('current_salary_period', $account->current_salary_period ?? 'month') == 'hour')>/ Hour</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Expected Salary') }} <span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="expected_salary" value="{{ old('expected_salary', $account->expected_salary ?? '') }}" placeholder="0">
                            <select class="form-select" name="expected_salary_period" style="max-width: 120px;">
                                <option value="month" @selected(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'month')>/ Month</option>
                                <option value="hour" @selected(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'hour')>/ Hour</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

    <!-- Section 5: Location -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-map-marker-alt"></i> {{ __('Location') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 18. Current Location -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Location Type') }}</label>
                    <select class="form-select" name="location_type">
                        <option value="current" @selected(old('location_type', $account->location_type ?? '') == 'current')>{{ __('Current Location') }}</option>
                        <option value="native" @selected(old('location_type', $account->location_type ?? '') == 'native')>{{ __('Native Location') }}</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Address') }}</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $account->address) }}" placeholder="{{ __('Enter your address') }}">
                </div>

                <!-- 19. Ready for Relocation -->
                <div class="col-md-6 mb-3">
                    <div class="form-check mt-3">
                        <input type="hidden" name="ready_for_relocation" value="0">
                        <input type="checkbox" class="form-check-input" name="ready_for_relocation" value="1" id="ready_for_relocation" @checked(old('ready_for_relocation', $account->ready_for_relocation ?? false))>
                        <label class="form-check-label" for="ready_for_relocation">{{ __('Are you ready for relocation?') }}</label>
                    </div>
                </div>

                <!-- 20. Work Location Preferences (shown when ready for relocation) -->
                <div class="col-12 mb-3" id="work_location_preferences_wrapper" style="display: none;">
                    <label class="form-label">{{ __('Work Location Preferences') }} ({{ __('Max 3, set priority') }})</label>
                    <div id="work-locations-container">
                        @php $workLocations = old('work_location_preferences', $account->work_location_preferences ?? [['state' => '', 'city' => '']]); @endphp
                        @foreach(array_slice($workLocations, 0, 3) as $index => $loc)
                        <div class="removable-item work-location-item">
                            @if($index > 0)<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>@endif
                            <div class="row">
                                <div class="col-md-1 d-flex align-items-center">
                                    <span class="priority-badge">{{ $index + 1 }}</span>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" class="form-control" name="work_location_preferences[{{ $index }}][state]" value="{{ $loc['state'] ?? '' }}" placeholder="{{ __('State') }}">
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" class="form-control" name="work_location_preferences[{{ $index }}][city]" value="{{ $loc['city'] ?? '' }}" placeholder="{{ __('City') }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-more-btn" onclick="addWorkLocation()" id="add-work-location-btn">+ {{ __('Add Location Preference') }}</button>
                </div>
            </div>
        </div>
    </div>
                <!-- Section 4: Qualifications & Experience -->
                <div class="profile-section">
                        <div class="profile-section-header">
                            <i class="fa fa-graduation-cap"></i> {{ __('Qualifications, Certifications & Experience') }}
                        </div>
                        <div class="profile-section-body">
                            <div class="row">
                                <!-- 14. Qualifications (JSON array) -->
                                <div class="col-12 mb-4">
                                    <label class="form-label">{{ __('Educational Qualifications') }} <span class="required">*</span></label>
                                    <div id="qualifications-container">
                                        @php $qualifications = old('qualifications', $account->qualifications ?? [['level' => '', 'specialization' => '']]); @endphp
                                        @foreach($qualifications as $index => $qual)
                                        <div class="removable-item qualification-item">
                                            @if($index > 0)<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>@endif
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <select class="form-select" name="qualifications[{{ $index }}][level]">
                                                        <option value="">{{ __('Select Level') }}</option>
                                                        @foreach(['diploma' => 'Diploma', 'bachelors' => 'Bachelors', 'masters' => 'Masters', 'doctorate' => 'Doctorate'] as $val => $lbl)
                                                            <option value="{{ $val }}" @selected(($qual['level'] ?? '') == $val)>{{ $lbl }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <div class="specialization-autocomplete-wrapper">
                                                        <input type="text" class="form-control specialization-input" name="qualifications[{{ $index }}][specialization]" value="{{ $qual['specialization'] ?? '' }}" placeholder="{{ __('Specialization/Subject') }}" autocomplete="off">
                                                        <div class="specialization-suggestions"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" class="form-control" name="qualifications[{{ $index }}][institution]" value="{{ $qual['institution'] ?? '' }}" placeholder="{{ __('Institution Name') }}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="add-more-btn" onclick="addQualification()">+ {{ __('Add More Qualification') }}</button>
                                </div>

                                <!-- 15. Teaching Certifications -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Teaching Certifications') }} <span class="required">*</span></label>
                                    <select id="ts-teaching-certifications" name="teaching_certifications[]" multiple placeholder="{{ __('Search & select certifications...') }}">
                                        @php $certs = old('teaching_certifications', $account->teaching_certifications ?? []); @endphp
                                        @foreach(['b_ed' => 'B.Ed', 'm_ed' => 'M.Ed', 'ctet' => 'CTET', 'tet' => 'TET', 'ntt' => 'NTT', 'montessori' => 'Montessori', 'teacher_training' => 'Teacher Training Course', 'net' => 'NET', 'set' => 'SET', 'gate' => 'GATE'] as $val => $lbl)
                                            <option value="{{ $val }}" @selected(in_array($val, $certs))>{{ $lbl }}</option>
                                        @endforeach
                                    </select>
                                    <div class="ts-max-info">{{ __('Select all applicable certifications') }}</div>
                                </div>

                                <!-- 17. Total Experience -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Total Experience') }} <span class="required">*</span></label>
                                    <select class="form-select" name="total_experience">
                                        <option value="">{{ __('-- Select --') }}</option>
                                        <option value="fresher" @selected(old('total_experience', $account->total_experience ?? '') == 'fresher')>{{ __('Fresher') }}</option>
                                        <option value="intern" @selected(old('total_experience', $account->total_experience ?? '') == 'intern')>{{ __('Intern') }}</option>
                                        @for($i = 1; $i <= 15; $i++)
                                            <option value="{{ $i }}_years" @selected(old('total_experience', $account->total_experience ?? '') == "{$i}_years")>{{ $i }} {{ __('Year(s)') }}</option>
                                        @endfor
                                        <option value="15+_years" @selected(old('total_experience', $account->total_experience ?? '') == '15+_years')>{{ __('15+ Years') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- Section 6: Skills & Languages -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-language"></i> {{ __('Skills & Languages') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 21. Languages -->
                <div class="col-12 mb-4">
                    <label class="form-label">{{ __('Languages') }} ({{ __('Max 3') }}) <span class="required">*</span></label>
                    <div id="languages-container">
                        @php $languages = old('languages', $account->languages ?? [['language' => '', 'proficiency' => '']]); @endphp
                        @foreach(array_slice($languages, 0, 3) as $index => $lang)
                        <div class="removable-item language-item">
                            @if($index > 0)<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>@endif
                            <div class="row">
                                <div class="col-md-1 d-flex align-items-center">
                                    <span class="priority-badge">{{ $index + 1 }}</span>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" class="form-control" name="languages[{{ $index }}][language]" value="{{ $lang['language'] ?? '' }}" placeholder="{{ __('Language (e.g., English)') }}">
                                </div>
                                <div class="col-md-5 mb-2">
                                    <select class="form-select" name="languages[{{ $index }}][proficiency]">
                                        <option value="">{{ __('Proficiency') }}</option>
                                        @foreach(['basic' => 'Basic', 'intermediate' => 'Intermediate', 'fluent' => 'Fluent', 'native' => 'Native'] as $val => $lbl)
                                            <option value="{{ $val }}" @selected(($lang['proficiency'] ?? '') == $val)>{{ $lbl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="add-more-btn" onclick="addLanguage()" id="add-language-btn">+ {{ __('Add Language') }}</button>
                </div>

                <!-- 22. Skills -->
                @if ($account->isJobSeeker() && (count($jobSkills ?? []) || count($selectedJobSkills ?? [])))
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Skills') }}</label>
                    <input type="text" class="tags form-control list-tagify" id="favorite_skills" name="favorite_skills" value="{{ implode(',', $selectedJobSkills ?? []) }}" data-keep-invalid-tags="false" data-list="{{ $jobSkills ?? '' }}" data-user-input="false" placeholder="{{ __('Select from the list') }}"/>
                </div>
                @endif
            </div>
        </div>
    </div>

   

    <!-- Section 8: Resume & Documents -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-file-alt"></i> {{ __('Resume & Documents') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                <!-- 27. Resume -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Upload Resume') }} <span class="required">*</span></label>
                    <input type="file" class="form-control" name="resume" accept=".pdf,.doc,.docx">
                    @if ($account->resume)
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="{{ RvMedia::url($account->resume) }}" target="_blank">{{ __('View Current Resume') }}</a>
                        </small>
                    @endif
                    <small class="form-text d-block">{{ __('PDF/Word files only. Max 2MB') }}</small>
                    <div class="form-check mt-2">
                        <input type="hidden" name="resume_parsing_allowed" value="0">
                        <input type="checkbox" class="form-check-input" name="resume_parsing_allowed" value="1" id="resume_parsing_allowed" @checked(old('resume_parsing_allowed', $account->resume_parsing_allowed ?? false))>
                        <label class="form-check-label" for="resume_parsing_allowed">{{ __('Allow resume parsing to auto-fill profile') }}</label>
                    </div>
                </div>

                <!-- 28. Cover Letter -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Upload Cover Letter') }}</label>
                    <input type="file" class="form-control" name="cover_letter" accept=".pdf,.doc,.docx">
                    @if ($account->cover_letter)
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="{{ RvMedia::url($account->cover_letter) }}" target="_blank">{{ __('View Current Cover Letter') }}</a>
                        </small>
                    @endif
                </div>

                <!-- 13. Introductory Audio -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Introductory Audio') }}</label>
                    <input type="file" class="form-control" name="introductory_audio" id="introductory_audio_file" accept="audio/*">
                    <small class="form-text">{{ __('Upload an audio file OR record directly below (max 2 minutes).') }}</small>

                    <!-- Voice Recorder -->
                    <div class="voice-recorder-wrapper mt-2">
                        <label class="form-label" style="font-size:13px; margin-bottom:8px;">
                            <i class="fa fa-microphone me-1 text-danger"></i> {{ __('Or Record Your Voice') }}
                        </label>
                        <div class="voice-recorder-controls">
                            <button type="button" class="btn-record" id="btn-start-recording" onclick="startAudioRecording()">
                                <i class="fa fa-circle"></i> {{ __('Record') }}
                            </button>
                            <button type="button" class="btn-record-stop" id="btn-stop-recording" style="display:none;" onclick="stopAudioRecording()">
                                <i class="fa fa-stop"></i> {{ __('Stop') }}
                            </button>
                            <span class="recording-timer" id="recording-timer" style="display:none;">00:00</span>
                        </div>
                        <div class="recorded-audio-preview" id="recorded-audio-preview">
                            <audio controls id="recorded-audio-player"></audio>
                            <div class="recorded-audio-actions">
                                <button type="button" class="add-more-btn" onclick="useRecordedAudio()">
                                    <i class="fa fa-check me-1"></i> {{ __('Use This Recording') }}
                                </button>
                                <button type="button" class="btn-remove-photo" style="padding:6px 12px; font-size:12px;" onclick="discardRecording()">
                                    <i class="fa fa-trash me-1"></i> {{ __('Discard') }}
                                </button>
                            </div>
                        </div>
                        <small class="form-text mt-1">{{ __('Include: qualifications, experience, teaching style. Max 2 minutes.') }}</small>
                    </div>
                </div>

                <!-- 30. Introductory Video Link -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Introductory YouTube Video Link') }}</label>
                    <input type="url" class="form-control" name="introductory_video_url" value="{{ old('introductory_video_url', $account->introductory_video_url ?? '') }}" placeholder="https://youtube.com/watch?v=...">
                </div>
            </div>
        </div>
    </div>

    <!-- Section 9: Social Links -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-link"></i> {{ __('Social Links') }}
        </div>
        <div class="profile-section-body">
            <div class="row">
                @php $social = old('social_links', $account->social_links ?? []); @endphp
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-primary me-2"></i>{{ __('LinkedIn') }}</label>
                    <input type="url" class="form-control" name="social_links[linkedin]" value="{{ $social['linkedin'] ?? '' }}" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary me-2"></i>{{ __('Facebook') }}</label>
                    <input type="url" class="form-control" name="social_links[facebook]" value="{{ $social['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-twitter text-info me-2"></i>{{ __('Twitter') }}</label>
                    <input type="url" class="form-control" name="social_links[twitter]" value="{{ $social['twitter'] ?? '' }}" placeholder="https://twitter.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-instagram text-danger me-2"></i>{{ __('Instagram') }}</label>
                    <input type="url" class="form-control" name="social_links[instagram]" value="{{ $social['instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-youtube text-danger me-2"></i>{{ __('YouTube') }}</label>
                    <input type="url" class="form-control" name="social_links[youtube]" value="{{ $social['youtube'] ?? '' }}" placeholder="https://youtube.com/@...">
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-center mb-4">
        <button type="submit" class="btn btn-primary btn-save">
            <i class="fa fa-save me-2"></i>{{ __('Save Profile') }}
        </button>
    </div>

    {!! Form::close() !!}

<!-- TomSelect JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==========================================
    // TomSelect Dropdowns Initialization
    // ==========================================

    // Teaching Certifications (unlimited)
    if (document.getElementById('ts-teaching-certifications')) {
        new TomSelect('#ts-teaching-certifications', {
            plugins: ['remove_button'],
            maxItems: null,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No certifications found</div>'; }
            }
        });
    }

    // Institution Types (max 3)
    if (document.getElementById('ts-institution-types')) {
        var tsInst = new TomSelect('#ts-institution-types', {
            plugins: ['remove_button', 'optgroup_columns'],
            maxItems: 3,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No institution type found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('inst-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var ic = document.getElementById('inst-count');
        if (ic) ic.textContent = tsInst.items.length;
    }

    // Teaching Subjects (max 3)
    var tsSubjectsInstance = null;
    if (document.getElementById('ts-teaching-subjects')) {
        tsSubjectsInstance = new TomSelect('#ts-teaching-subjects', {
            plugins: ['remove_button', 'optgroup_columns'],
            maxItems: 3,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No subject found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('subj-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var sc = document.getElementById('subj-count');
        if (sc) sc.textContent = tsSubjectsInstance.items.length;
    }

    // Non-Teaching Positions (max 3)
    var tsNonTeachingInstance = null;
    if (document.getElementById('ts-non-teaching')) {
        tsNonTeachingInstance = new TomSelect('#ts-non-teaching', {
            plugins: ['remove_button'],
            maxItems: 3,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No position found</div>'; }
            },
            onChange: function() {
                var c = document.getElementById('nt-count');
                if (c) c.textContent = this.items.length;
            }
        });
        var nc = document.getElementById('nt-count');
        if (nc) nc.textContent = tsNonTeachingInstance.items.length;
    }

    // Job Type (max 2)
    if (document.getElementById('ts-job-type')) {
        new TomSelect('#ts-job-type', {
            plugins: ['remove_button'],
            maxItems: 2,
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No job type found</div>'; }
            }
        });
    }

    // ==========================================
    // Toggle Logic
    // ==========================================

    // Password toggle
    document.getElementById('change_password_toggle').addEventListener('change', function() {
        document.getElementById('password_fields').style.display = this.checked ? 'block' : 'none';
    });

    // Work status toggle for notice period
    const workStatus = document.getElementById('current_work_status');
    const noticePeriod = document.getElementById('notice_period_wrapper');
    
    function toggleNoticePeriod() {
        noticePeriod.style.display = workStatus.value === 'working' ? 'block' : 'none';
    }
    workStatus.addEventListener('change', toggleNoticePeriod);
    toggleNoticePeriod();

    // Position type toggle for teaching subjects / non-teaching positions
    const teachingCheck = document.getElementById('position_teaching');
    const nonTeachingCheck = document.getElementById('position_non_teaching');
    const teachingSubjectsWrapper = document.getElementById('teaching_subjects_wrapper');
    const nonTeachingPositionsWrapper = document.getElementById('non_teaching_positions_wrapper');

    function togglePositionFields() {
        if (teachingSubjectsWrapper) {
            teachingSubjectsWrapper.style.display = teachingCheck.checked ? 'block' : 'none';
        }
        if (nonTeachingPositionsWrapper) {
            nonTeachingPositionsWrapper.style.display = nonTeachingCheck.checked ? 'block' : 'none';
        }
    }

    if (teachingCheck) teachingCheck.addEventListener('change', togglePositionFields);
    if (nonTeachingCheck) nonTeachingCheck.addEventListener('change', togglePositionFields);
    togglePositionFields();

    // Relocation toggle for work location preferences
    const relocationCheck = document.getElementById('ready_for_relocation');
    const workLocationWrapper = document.getElementById('work_location_preferences_wrapper');

    function toggleWorkLocationPreferences() {
        if (workLocationWrapper) {
            workLocationWrapper.style.display = relocationCheck.checked ? 'block' : 'none';
        }
    }

    if (relocationCheck) {
        relocationCheck.addEventListener('change', toggleWorkLocationPreferences);
        toggleWorkLocationPreferences();
    }
});

// Add qualification
let qualificationIndex = {{ count($qualifications ?? [1]) }};
function addQualification() {
    const container = document.getElementById('qualifications-container');
    const html = `
        <div class="removable-item qualification-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <select class="form-select" name="qualifications[${qualificationIndex}][level]">
                        <option value="">Select Level</option>
                        <option value="diploma">Diploma</option>
                        <option value="bachelors">Bachelors</option>
                        <option value="masters">Masters</option>
                        <option value="doctorate">Doctorate</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="specialization-autocomplete-wrapper">
                        <input type="text" class="form-control specialization-input" name="qualifications[${qualificationIndex}][specialization]" placeholder="Specialization/Subject" autocomplete="off">
                        <div class="specialization-suggestions"></div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="qualifications[${qualificationIndex}][institution]" placeholder="Institution Name">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    qualificationIndex++;
}

// Add language (max 3)
let languageIndex = {{ count($languages ?? [1]) }};
function addLanguage() {
    if (document.querySelectorAll('.language-item').length >= 3) {
        alert('Maximum 3 languages allowed');
        return;
    }
    const container = document.getElementById('languages-container');
    const html = `
        <div class="removable-item language-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-1 d-flex align-items-center">
                    <span class="priority-badge">${languageIndex + 1}</span>
                </div>
                <div class="col-md-5 mb-2">
                    <input type="text" class="form-control" name="languages[${languageIndex}][language]" placeholder="Language (e.g., English)">
                </div>
                <div class="col-md-5 mb-2">
                    <select class="form-select" name="languages[${languageIndex}][proficiency]">
                        <option value="">Proficiency</option>
                        <option value="basic">Basic</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="fluent">Fluent</option>
                        <option value="native">Native</option>
                    </select>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    languageIndex++;
}

// Add work location preference (max 3)
let workLocationIndex = {{ count($workLocations ?? [1]) }};
function addWorkLocation() {
    if (document.querySelectorAll('.work-location-item').length >= 3) {
        alert('Maximum 3 location preferences allowed');
        return;
    }
    const container = document.getElementById('work-locations-container');
    const html = `
        <div class="removable-item work-location-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-1 d-flex align-items-center">
                    <span class="priority-badge">${workLocationIndex + 1}</span>
                </div>
                <div class="col-md-5 mb-2">
                    <input type="text" class="form-control" name="work_location_preferences[${workLocationIndex}][state]" placeholder="State">
                </div>
                <div class="col-md-5 mb-2">
                    <input type="text" class="form-control" name="work_location_preferences[${workLocationIndex}][city]" placeholder="City">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    workLocationIndex++;
}

// Remove Avatar
document.addEventListener('DOMContentLoaded', function() {
    var removeBtn = document.getElementById('remove-avatar-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            if (!confirm('{{ __("Are you sure you want to remove your profile photo?") }}')) return;

            fetch('{{ route("public.account.avatar.destroy") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (!data.error) {
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to remove photo');
                }
            })
            .catch(function() {
                alert('Something went wrong. Please try again.');
            });
        });
    }

    // Sync sidebar avatar when avatar modal saves
    var avatarModal = document.getElementById('avatar-modal');
    if (avatarModal) {
        avatarModal.addEventListener('hidden.bs.modal', function() {
            var profileImg = document.getElementById('profile-photo-display');
            if (profileImg) {
                var sidebarAvatar = document.querySelector('.js-profile-avatar');
                if (sidebarAvatar) {
                    sidebarAvatar.src = profileImg.src;
                }
            }
        });
    }

    // Initialize specialization autocomplete for existing fields
    initSpecializationAutocomplete();
});

// ==========================================
// Speech-to-Text for Bio Editor
// ==========================================
var speechRecognition = null;
var isSpeechActive = false;

function toggleSpeechToText() {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        alert('{{ __("Speech-to-Text is not supported in your browser. Please use Chrome or Edge.") }}');
        return;
    }

    if (isSpeechActive) {
        stopSpeechToText();
    } else {
        startSpeechToText();
    }
}

function startSpeechToText() {
    var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    speechRecognition = new SpeechRecognition();
    speechRecognition.continuous = true;
    speechRecognition.interimResults = true;
    speechRecognition.lang = 'en-IN'; // English (India) - supports Hindi too

    var btn = document.getElementById('bio-speech-btn');
    var btnText = document.getElementById('speech-btn-text');
    var status = document.getElementById('speech-status');

    speechRecognition.onstart = function() {
        isSpeechActive = true;
        btn.classList.add('recording');
        btn.querySelector('i').className = 'fa fa-stop';
        btnText.textContent = '{{ __("Stop Listening") }}';
        status.classList.add('active');
    };

    speechRecognition.onresult = function(event) {
        var finalTranscript = '';
        for (var i = event.resultIndex; i < event.results.length; i++) {
            if (event.results[i].isFinal) {
                finalTranscript += event.results[i][0].transcript;
            }
        }
        if (finalTranscript) {
            insertTextIntoEditor(finalTranscript);
        }
    };

    speechRecognition.onerror = function(event) {
        console.error('Speech recognition error:', event.error);
        if (event.error === 'not-allowed') {
            alert('{{ __("Microphone access was denied. Please allow microphone access in your browser settings.") }}');
        }
        stopSpeechToText();
    };

    speechRecognition.onend = function() {
        if (isSpeechActive) {
            // Restart if still active (auto-stop protection)
            try { speechRecognition.start(); } catch(e) { stopSpeechToText(); }
        }
    };

    try {
        speechRecognition.start();
    } catch(e) {
        alert('{{ __("Could not start speech recognition. Please try again.") }}');
    }
}

function stopSpeechToText() {
    isSpeechActive = false;
    if (speechRecognition) {
        speechRecognition.stop();
        speechRecognition = null;
    }
    var btn = document.getElementById('bio-speech-btn');
    var btnText = document.getElementById('speech-btn-text');
    var status = document.getElementById('speech-status');
    btn.classList.remove('recording');
    btn.querySelector('i').className = 'fa fa-microphone';
    btnText.textContent = '{{ __("Speech to Text") }}';
    status.classList.remove('active');
}

function insertTextIntoEditor(text) {
    // Try CKEditor first
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances && CKEDITOR.instances.bio) {
        CKEDITOR.instances.bio.model.change(function(writer) {
            var root = CKEDITOR.instances.bio.model.document.getRoot();
            writer.insertText(text, root, 'end');
        });
        return;
    }

    // Try window.editor (CKEditor 5)
    if (typeof window.editorManagement !== 'undefined' && window.editorManagement.CKEDITOR && window.editorManagement.CKEDITOR.bio) {
        var editor = window.editorManagement.CKEDITOR.bio;
        editor.model.change(function(writer) {
            var insertPosition = editor.model.document.selection.getLastPosition();
            writer.insertText(' ' + text, insertPosition);
        });
        return;
    }

    // Fallback: append to textarea
    var textarea = document.getElementById('bio');
    if (textarea) {
        textarea.value += ' ' + text;
        // Trigger change event
        textarea.dispatchEvent(new Event('change'));
    }
}

// ==========================================
// Specialization/Subject Autocomplete
// ==========================================
var specializationsList = [
    // Sciences
    'Physics', 'Chemistry', 'Biology', 'Mathematics', 'Computer Science',
    'Environmental Science', 'Biotechnology', 'Microbiology', 'Zoology', 'Botany',
    'Geology', 'Astronomy', 'Statistics', 'Biochemistry',
    // Arts & Humanities
    'English', 'Hindi', 'Sanskrit', 'History', 'Geography', 'Political Science',
    'Economics', 'Sociology', 'Psychology', 'Philosophy', 'Music', 'Fine Arts',
    'Performing Arts', 'Journalism', 'Mass Communication', 'Library Science',
    // Commerce & Management
    'Commerce', 'Accountancy', 'Business Studies', 'Management', 'Finance',
    'Marketing', 'Human Resource Management', 'Banking', 'Insurance',
    // Engineering & Technology
    'Mechanical Engineering', 'Civil Engineering', 'Electrical Engineering',
    'Electronics Engineering', 'Computer Engineering', 'Chemical Engineering',
    'Information Technology', 'Automobile Engineering', 'Aeronautical Engineering',
    // Education
    'Education (B.Ed)', 'Special Education', 'Physical Education', 'Montessori Education',
    'Early Childhood Education', 'Curriculum Development',
    // Medical & Health
    'Medicine', 'Nursing', 'Pharmacy', 'Physiotherapy', 'Dental Science',
    'Ayurveda', 'Homeopathy', 'Public Health', 'Nutrition & Dietetics',
    // Law
    'Law', 'Criminal Law', 'Corporate Law', 'International Law',
    // Languages
    'Tamil', 'Telugu', 'Kannada', 'Malayalam', 'Marathi', 'Bengali', 'Gujarati',
    'Punjabi', 'Urdu', 'French', 'German', 'Spanish', 'Japanese', 'Chinese',
    // Others
    'Yoga', 'Sports Science', 'Agriculture', 'Veterinary Science',
    'Hotel Management', 'Fashion Design', 'Interior Design', 'Architecture',
    'Social Work', 'Defense Studies', 'Home Science'
];

function initSpecializationAutocomplete() {
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('specialization-input')) {
            handleSpecializationInput(e.target);
        }
    });

    document.addEventListener('click', function(e) {
        // Close all dropdowns when clicking outside
        if (!e.target.classList.contains('specialization-input') && !e.target.classList.contains('specialization-suggestion-item')) {
            document.querySelectorAll('.specialization-suggestions').forEach(function(el) {
                el.classList.remove('active');
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.target.classList.contains('specialization-input')) {
            handleSpecializationKeydown(e);
        }
    });
}

function handleSpecializationInput(input) {
    var query = input.value.trim().toLowerCase();
    var suggestionsDiv = input.parentElement.querySelector('.specialization-suggestions');

    if (query.length < 1) {
        suggestionsDiv.classList.remove('active');
        return;
    }

    var matches = specializationsList.filter(function(item) {
        return item.toLowerCase().indexOf(query) !== -1;
    }).slice(0, 8);

    if (matches.length === 0) {
        suggestionsDiv.classList.remove('active');
        return;
    }

    var html = '';
    matches.forEach(function(item, idx) {
        var highlighted = item.replace(new RegExp('(' + query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi'), '<strong>$1</strong>');
        html += '<div class="specialization-suggestion-item' + (idx === 0 ? ' highlighted' : '') + '" data-value="' + item + '">' + highlighted + '</div>';
    });

    suggestionsDiv.innerHTML = html;
    suggestionsDiv.classList.add('active');

    // Add click handlers
    suggestionsDiv.querySelectorAll('.specialization-suggestion-item').forEach(function(item) {
        item.addEventListener('click', function() {
            input.value = this.getAttribute('data-value');
            suggestionsDiv.classList.remove('active');
            input.focus();
        });
    });
}

function handleSpecializationKeydown(e) {
    var suggestionsDiv = e.target.parentElement.querySelector('.specialization-suggestions');
    if (!suggestionsDiv.classList.contains('active')) return;

    var items = suggestionsDiv.querySelectorAll('.specialization-suggestion-item');
    var current = suggestionsDiv.querySelector('.highlighted');
    var currentIdx = -1;
    items.forEach(function(item, idx) { if (item === current) currentIdx = idx; });

    if (e.key === 'ArrowDown') {
        e.preventDefault();
        if (current) current.classList.remove('highlighted');
        var next = (currentIdx + 1) % items.length;
        items[next].classList.add('highlighted');
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (current) current.classList.remove('highlighted');
        var prev = (currentIdx - 1 + items.length) % items.length;
        items[prev].classList.add('highlighted');
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (current) {
            e.target.value = current.getAttribute('data-value');
            suggestionsDiv.classList.remove('active');
        }
    } else if (e.key === 'Escape') {
        suggestionsDiv.classList.remove('active');
    }
}

// ==========================================
// Voice Recording for Introductory Audio
// ==========================================
var mediaRecorder = null;
var audioChunks = [];
var recordedBlob = null;
var recordingTimerInterval = null;
var recordingSeconds = 0;
var maxRecordingSeconds = 120; // 2 minutes

function startAudioRecording() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        alert('{{ __("Audio recording is not supported in your browser.") }}');
        return;
    }

    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function(stream) {
            audioChunks = [];
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = function(e) {
                if (e.data.size > 0) audioChunks.push(e.data);
            };

            mediaRecorder.onstop = function() {
                stream.getTracks().forEach(function(track) { track.stop(); });
                recordedBlob = new Blob(audioChunks, { type: 'audio/webm' });
                var audioUrl = URL.createObjectURL(recordedBlob);
                var audioPlayer = document.getElementById('recorded-audio-player');
                audioPlayer.src = audioUrl;
                document.getElementById('recorded-audio-preview').style.display = 'block';
            };

            mediaRecorder.start();

            // UI Updates
            document.getElementById('btn-start-recording').style.display = 'none';
            document.getElementById('btn-stop-recording').style.display = 'inline-flex';
            document.getElementById('recording-timer').style.display = 'inline';
            document.getElementById('btn-start-recording').classList.add('recording');

            // Start timer
            recordingSeconds = 0;
            updateRecordingTimer();
            recordingTimerInterval = setInterval(function() {
                recordingSeconds++;
                updateRecordingTimer();
                if (recordingSeconds >= maxRecordingSeconds) {
                    stopAudioRecording();
                }
            }, 1000);
        })
        .catch(function(err) {
            console.error('Microphone access error:', err);
            alert('{{ __("Could not access microphone. Please allow microphone access.") }}');
        });
}

function stopAudioRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();
    }
    clearInterval(recordingTimerInterval);

    // UI Updates
    document.getElementById('btn-start-recording').style.display = 'inline-flex';
    document.getElementById('btn-start-recording').classList.remove('recording');
    document.getElementById('btn-stop-recording').style.display = 'none';
    document.getElementById('recording-timer').style.display = 'none';
}

function updateRecordingTimer() {
    var mins = Math.floor(recordingSeconds / 60).toString().padStart(2, '0');
    var secs = (recordingSeconds % 60).toString().padStart(2, '0');
    document.getElementById('recording-timer').textContent = mins + ':' + secs;
}

function useRecordedAudio() {
    if (!recordedBlob) return;

    // Create a File from the Blob and assign to the file input
    var file = new File([recordedBlob], 'introductory-audio-recording.webm', { type: 'audio/webm' });
    var dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    document.getElementById('introductory_audio_file').files = dataTransfer.files;

    // Show confirmation
    document.getElementById('recorded-audio-preview').innerHTML = 
        '<div style="background:#e8f5e9;padding:10px;border-radius:8px;color:#2e7d32;font-size:13px;">' +
        '<i class="fa fa-check-circle me-1"></i> {{ __("Recording attached! It will be uploaded when you save your profile.") }}' +
        '</div>';
    document.getElementById('recorded-audio-preview').style.display = 'block';
}

function discardRecording() {
    recordedBlob = null;
    document.getElementById('recorded-audio-preview').style.display = 'none';
    document.getElementById('recorded-audio-player').src = '';
}
</script>
@endsection
