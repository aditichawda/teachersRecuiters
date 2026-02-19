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
        padding: 8px 14px;
        height: 40px;
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
    /* ? Help icon - hover & click both show tooltip */
    .field-help-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        cursor: help;
        margin-left: 4px;
        vertical-align: middle;
        transition: background 0.2s, color 0.2s;
    }
    .field-help-icon:hover,
    .field-help-icon:focus {
        background: #0073d1;
        color: #fff;
        outline: none;
    }
    .field-help-icon i {
        font-size: 11px;
    }
    .profile-section-header .field-help-icon {
        background: rgba(255,255,255,0.3);
        color: #fff;
    }
    .profile-section-header .field-help-icon:hover,
    .profile-section-header .field-help-icon:focus {
        background: rgba(255,255,255,0.5);
        color: #fff;
    }
    /* Tooltip - wider & mobile responsive (field-help-icon tooltips) */
    .tooltip .tooltip-inner {
        max-width: 340px;
        min-width: 200px;
        padding: 12px 16px;
        font-size: 13px;
        line-height: 1.5;
        text-align: left;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    @media (max-width: 576px) {
        .tooltip .tooltip-inner {
            max-width: min(320px, calc(100vw - 32px));
            min-width: 240px;
            padding: 14px 18px;
            font-size: 14px;
        }
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
    /* Validation: red border and error text below field */
    .profile-section .form-control.is-invalid,
    .profile-section .form-select.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }
    .profile-section .invalid-feedback,
    .profile-section .field-error-text {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
        display: block;
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
        padding: 7px 10px 0px 10px;
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
    .city-suggestion-item:hover { background: #f0f7ff; }

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
    <!-- <div class="js-page-header">
        <h2>{{ __('My Profile') }}</h2>
        <a href="{{ url('/') }}">GO TO HOMEPAGE →</a>
    </div> -->


    {!! Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true, 'id' => 'profile-form']) !!}

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <strong>{{ __('Please fix the errors below.') }}</strong>
        <ul class="mb-0 mt-2 ps-3">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Section 1: Personal Details -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-user"></i> {{ __('Personal Details') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text">{{ __('We collect these details to verify your profile, connect you with schools/institutions, and share relevant job opportunities.') }}</p>
            <div class="row">
                <!-- 1. Full Name (show first_name; fallback to full_name from registration) -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Full Name') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Help us to create your verified candidate profile and ensure accurate identification.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $account->first_name ?: $account->full_name ?? '') }}" placeholder="{{ __('Enter your full name') }}" required>
                    @error('first_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <!-- 2. Email Address -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Email Address') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Help us to send job alerts, interview updates, application status, and important notifications.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="email" class="form-control" value="{{ $account->email }}" disabled>
                </div>

                <!-- 3. Mobile Number -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Phone Number') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('For recruiters and schools to contact you directly regarding interviews and job opportunities and also help us to send you job alerts and updates on WhatsApp.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $account->phone ?? '') }}" placeholder="{{ __('Enter mobile number with country code') }}">
                    @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_whatsapp_available" value="1" id="is_whatsapp_available" @checked(old('is_whatsapp_available', $account->is_whatsapp_available))>
                        <label class="form-check-label" style="font-size: 12px;" for="is_whatsapp_available">{{ __('This number is available on WhatsApp') }}</label>
                    </div>
                </div>

                <!-- 4. Alternate Contact -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Alternate Phone Number') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('To ensure schools can reach you if your primary number is unavailable.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="tel" class="form-control" name="alternate_phone" value="{{ old('alternate_phone', $account->alternate_phone ?? '') }}" placeholder="{{ __('Alternate phone number') }}">
                    <div class="form-check mt-2">
                        <input type="hidden" name="is_alternate_whatsapp_available" value="0">
                        <input type="checkbox" class="form-check-input" name="is_alternate_whatsapp_available" value="1" id="is_alternate_whatsapp_available" @checked(old('is_alternate_whatsapp_available', $account->is_alternate_whatsapp_available ?? false))>
                        <label class="form-check-label" style="font-size: 12px;" for="is_alternate_whatsapp_available">{{ __('This number is available on WhatsApp') }}</label>
                    </div>
                </div>
                <!-- 7. DOB -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Date of Birth') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('To verify eligibility criteria, age requirements, and ensure compliance with school policies.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob', $account->dob ? $account->dob->format('Y-m-d') : '') }}" max="{{ now()->subYears(16)->format('Y-m-d') }}">
                    @error('dob')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                
                <!-- 5. Gender -->
                <div class="col-md-6 mb-3 @error('gender') is-invalid @enderror">
                    <label class="form-label">{{ __('Gender') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Some institutions may have role-specific preferences or accommodation arrangements.') }}"><i class="fa fa-question-circle"></i></span></label>
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
                    @error('gender')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <!-- 6. Marital Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Marital Status') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Certain schools (especially residential/boarding schools) may consider this for accommodation and relocation purposes.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <div class="d-flex gap-3 flex-wrap mt-2">
                        @foreach(['single' => 'Single', 'married' => 'Married', 'separated' => 'Separated', 'others' => 'Others'] as $value => $label)
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="marital_status" value="{{ $value }}" id="marital_{{ $value }}" @checked(old('marital_status', $account->marital_status ?? '') == $value)>
                                <label class="form-check-label" for="marital_{{ $value }}">{{ __($label) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

               
            </div>
        </div>
    </div>

    <!-- Section 2: Profile Visibility & Work Status -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-eye"></i> {{ __('Security Tab') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('Control who can view your profile and update your current job availability and salary to receive relevant opportunities.') }}</p>
            <div class="row">
                <!-- 9. Profile Visibility -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Profile Visibility') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Choose whether schools/recruiters can view your profile in search results.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="profile_visibility">
                        <option value="1" @selected(old('profile_visibility', $account->profile_visibility ?? 1) == 1)>{{ __('Yes - Schools can view my profile') }}</option>
                        <option value="0" @selected(old('profile_visibility', $account->profile_visibility ?? 1) == 0)>{{ __('No - Hide my profile') }}</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Additional Privacy Options') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('To give you flexibility while exploring opportunities confidentially.') }}"><i class="fa fa-question-circle"></i></span></label>
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
            </div>
        </div>
    </div>
      <!-- Section 2: Profile Visibility & Work Status -->
      <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-eye"></i> {{ __('Work Status') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('Control who can view your profile and update your current job availability and salary to receive relevant opportunities.') }}</p>
            <div class="row">
              
                <!-- 10. Current Work Status -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Current Work Status') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Recruiters prioritize candidates based on immediate availability.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="current_work_status" id="current_work_status">
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="not_working" @selected(old('current_work_status', $account->current_work_status ?? '') == 'not_working')>{{ __('Not Working Now') }}</option>
                        <option value="working" @selected(old('current_work_status', $account->current_work_status ?? '') == 'working')>{{ __('Working Now') }}</option>
                    </select>
                    <div class="form-check mt-1">
                        <input type="hidden" name="available_for_immediate_joining" value="0">
                        <input type="checkbox" class="form-check-input" name="available_for_immediate_joining" value="1" id="available_for_immediate_joining" @checked(old('available_for_immediate_joining', $account->available_for_immediate_joining ?? false))>
                        <label class="form-check-label" for="available_for_immediate_joining">{{ __('Available for Immediate Joining') }}</label>
                    </div>
                </div>

                <!-- 11. Notice Period (shown if working) -->
                <div class="col-md-6 mb-3" id="notice_period_wrapper" style="display: none;">
                    <label class="form-label">{{ __('Notice Period') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Schools/recruiters filter candidates based on urgency of hiring.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <select class="form-select" name="notice_period">
                        <option value="">{{ __('-- Select --') }}</option>
                        <option value="7_days" @selected(old('notice_period', $account->notice_period ?? '') == '7_days')>{{ __('7 Days') }}</option>
                        <option value="15_days" @selected(old('notice_period', $account->notice_period ?? '') == '15_days')>{{ __('15 Days') }}</option>
                        <option value="1_month" @selected(old('notice_period', $account->notice_period ?? '') == '1_month')>{{ __('1 Month') }}</option>
                        <option value="2_months" @selected(old('notice_period', $account->notice_period ?? '') == '2_months')>{{ __('2 Months') }}</option>
                        <option value="3_months" @selected(old('notice_period', $account->notice_period ?? '') == '3_months')>{{ __('3 Months') }}</option>
                    </select>
                </div>

                 <!-- Salary (Not required when "Not Working Now") -->
                 <div class="col-md-6 mb-3" id="current_salary_wrapper">
                        <label class="form-label">{{ __('Current Salary') }} <span class="required" id="current_salary_req">*</span><span class="text-muted small ms-1" id="current_salary_optional" style="display:none;">({{ __('Not required when not working') }})</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Helps schools/institutions understand your experience level and compensation bracket.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="current_salary" id="current_salary_input" value="{{ old('current_salary', $account->current_salary ?? '') }}" placeholder="0">
                            <select class="form-select" name="current_salary_period" style="max-width: 120px;">
                                <option value="month" @selected(old('current_salary_period', $account->current_salary_period ?? 'month') == 'month')>Month</option>
                                <option value="hour" @selected(old('current_salary_period', $account->current_salary_period ?? 'month') == 'hour')>Hour</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3" id="expected_salary_wrapper">
                        <label class="form-label">{{ __('Expected Salary') }} <span class="required" id="expected_salary_req">*</span><span class="text-muted small ms-1" id="expected_salary_optional" style="display:none;">({{ __('Not required when not working') }})</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('To ensure salary alignment before interview shortlisting.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="expected_salary" id="expected_salary_input" value="{{ old('expected_salary', $account->expected_salary ?? '') }}" placeholder="0">
                            <select class="form-select" name="expected_salary_period" style="max-width: 120px;">
                                <option value="month" @selected(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'month')>Month</option>
                                <option value="hour" @selected(old('expected_salary_period', $account->expected_salary_period ?? 'month') == 'hour')>Hour</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Section 3: About / Bio -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-info-circle"></i> {{ __('About Me') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('Write a short summary about your teaching experience, subject expertise, achievements, and career goals. Keep it clear and professional.') }}</p>
            <div class="row">
                <!-- 12. Bio -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Teaching Philosophy / Career Objective / Key Strengths') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Example: Passionate Mathematics teacher with 5+ years of experience in CBSE schools. Skilled in concept-based teaching, exam preparation strategies, and classroom management. Committed to student-centric learning and academic excellence. Seeking a progressive institution where I can contribute to board results and holistic development of students. This helps schools quickly understand: Your teaching strengths, Classroom approach & methodology, Career aspirations, Suitability for their institution. Recruiters often read this section before downloading resumes.') }}"><i class="fa fa-question-circle"></i></span></label>
                    @php
                        $bioPlaceholder = __('Passionate Mathematics teacher with 5+ years of experience in CBSE schools. Skilled in concept-based teaching, exam preparation strategies, and classroom management. Committed to student-centric learning and academic excellence. Seeking a progressive institution where I can contribute to board results and holistic development of students.');
                    @endphp
                    {!! Form::customEditor('bio', old('bio', $account->bio), ['data-placeholder' => $bioPlaceholder]) !!}
                </div>
               
                <small class="form-text text-muted">This helps schools quickly understand: Your teaching strengths, Classroom approach & methodology, Career aspirations, Suitability for their institution.
Recruiters often read this section before downloading resumes.
</small>

            </div>
        </div>
    </div>
    <!-- Section 7: Job Preferences -->
    <div class="profile-section">
            <div class="profile-section-header">
                <i class="fa fa-briefcase"></i> {{ __('Job Preferences') }}
            </div>
            <div class="profile-section-body">
                <p class="form-text mb-3">{{ __('Tell us what type of opportunities you are looking for so we can match you with relevant schools/institutions.') }}</p>
                <div class="row">
                    <!-- 23. Institution Type Preferences -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Preferred Institution Type') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('To match your profile with the right category of schools/institutions.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-institution-types" name="institution_types[]" multiple placeholder="{{ __('Search & select institution types...') }}">
                            @php
                                $instTypes = old('institution_types', $account->institution_types ?? []);
                                $instTypes = is_array($instTypes) ? $instTypes : (is_string($instTypes) ? (json_decode($instTypes, true) ?? []) : []);
                                if (is_object($instTypes)) {
                                    $instTypes = method_exists($instTypes, 'toArray') ? $instTypes->toArray() : (array)$instTypes;
                                }
                                // Show institution type selected at registration in Preferred Institution Type
                                if (empty($instTypes) && !empty($account->institution_type)) {
                                    $regType = $account->institution_type;
                                    $normalized = str_replace('-', '_', $regType);
                                    $allowedValues = ['cbse_school','icse_school','cambridge_school','ib_school','state_board_school','play_school','engineering_college','medical_college','nursing_college','edtech_company','coaching_institute','university'];
                                    $map = ['school' => 'state_board_school', 'college' => 'engineering_college', 'online_education_platform' => 'university', 'book_publishing_company' => 'university', 'non_profit_organization' => 'university'];
                                    if (in_array($normalized, $allowedValues)) {
                                        $instTypes = [$normalized];
                                    } elseif (isset($map[$normalized])) {
                                        $instTypes = [$map[$normalized]];
                                    } else {
                                        $instTypes = [$normalized];
                                    }
                                }
                                $instTypes = array_values(array_filter((array)$instTypes));
                            @endphp
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
                        <div class="ts-max-info"><span class="count" id="inst-count">0</span> {{ __('selected') }}</div>
                    </div>

                    <!-- 24. Position Type -->
                    @php
                        $positionTypeVal = old('position_type', $account->position_type ?? '');
                        $positionTypeStr = is_array($positionTypeVal) ? implode(',', $positionTypeVal) : (string)$positionTypeVal;
                    @endphp
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Role Category') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Choose the type of role you are interested in. It helps schools filter candidates by job role.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="teaching" id="position_teaching" @checked(str_contains($positionTypeStr, 'teaching'))>
                                <label class="form-check-label" for="position_teaching">{{ __('Teaching') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input position-type-check" name="position_type[]" value="non_teaching" id="position_non_teaching" @checked(str_contains($positionTypeStr, 'non_teaching'))>
                                <label class="form-check-label" for="position_non_teaching">{{ __('Non-Teaching') }}</label>
                            </div>
                        </div>
                    </div>

                    <!-- 25. Teaching Subjects (shown when Teaching is selected) -->
                    <div class="col-md-6 mb-3" id="teaching_subjects_wrapper">
                        <label class="form-label">{{ __('Preferred Teaching Subject & Level') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Select subjects you can teach. Schools filter candidates by subject and level.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-teaching-subjects" name="teaching_subjects[]" multiple placeholder="{{ __('Search & select subjects...') }}">
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
                        <div class="ts-max-info"><span class="count" id="subj-count">0</span> {{ __('selected') }}</div>
                    </div>

                    <!-- Non-Teaching Positions (shown when Non-Teaching is selected) -->
                    <div class="col-md-6 mb-3" id="non_teaching_positions_wrapper" style="display: none;">
                        <label class="form-label">{{ __('Preferred Non-Teaching Role') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Select the non-teaching roles you are interested in. It helps to match you with suitable administrative or support positions.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-non-teaching" name="non_teaching_positions[]" multiple placeholder="{{ __('Search & select positions...') }}">
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
                        <div class="ts-max-info"><span class="count" id="nt-count">0</span> {{ __('selected') }}</div>
                    </div>

                    <!-- 26. Employment Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Employment Type') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Choose your preferred working arrangement.') }}"><i class="fa fa-question-circle"></i></span></label>
                        <select id="ts-job-type" name="job_type_preferences[]" multiple placeholder="{{ __('Select employment types...') }}">
                            @php $jobTypes = old('job_type_preferences', $account->job_type_preferences ?? []); @endphp
                            @foreach(['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'temporary' => 'Temporary', 'visiting_faculty' => 'Visiting Faculty', 'ad_hoc' => 'Ad-Hoc'] as $val => $lbl)
                                <option value="{{ $val }}" @selected(in_array($val, (array)$jobTypes))>{{ $lbl }}</option>
                            @endforeach
                        </select>
                        <div class="form-check mt-2">
                            <input type="hidden" name="remote_only" value="0">
                            <input type="checkbox" class="form-check-input" name="remote_only" value="1" id="remote_only" @checked(old('remote_only', $account->remote_only ?? false))>
                            <label class="form-check-label" for="remote_only">{{ __('Available only for Remote jobs') }}</label>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
   

    <!-- Section 5: Location -->
    @php
        $countries = [];
        $currentStates = [];
        $currentCities = [];
        $nativeStates = [];
        $nativeCities = [];
        if (is_plugin_active('location')) {
            $countries = \Botble\Location\Models\Country::query()
                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();
            if (empty($countries)) {
                $countries = \Botble\Location\Models\Country::query()->orderBy('name')->pluck('name', 'id')->toArray();
            }
            $cid = old('country_id', $account->country_id);
            if ($cid) {
                $currentStates = \Botble\Location\Models\State::query()
                    ->where('country_id', $cid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $sid = old('state_id', $account->state_id);
            if ($sid) {
                $currentCities = \Botble\Location\Models\City::query()
                    ->where('state_id', $sid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $nCid = old('native_country_id', $account->native_country_id);
            if ($nCid) {
                $nativeStates = \Botble\Location\Models\State::query()
                    ->where('country_id', $nCid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
            $nSid = old('native_state_id', $account->native_state_id);
            if ($nSid) {
                $nativeCities = \Botble\Location\Models\City::query()
                    ->where('state_id', $nSid)
                    ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                    ->orderBy('name')
                    ->pluck('name', 'id')
                    ->toArray();
            }
        }
        $workLocationPreferenceType = old('work_location_preference_type', $account->work_location_preference_type ?? '');
        $workLocations = old('work_location_preferences', $account->work_location_preferences ?? []);
        if (!is_array($workLocations)) $workLocations = [];
        $workLocations = array_slice(array_values($workLocations), 0, 3);
        if (empty($workLocations)) {
            $workLocations = [['country_id' => '', 'state_id' => '', 'city_id' => '', 'locality' => '']];
        }
        $workLocationStates = [];
        $workLocationCities = [];
        if (is_plugin_active('location')) {
            foreach ($workLocations as $idx => $loc) {
                $cid = $loc['country_id'] ?? null;
                if ($cid) {
                    $workLocationStates[$idx] = \Botble\Location\Models\State::query()
                        ->where('country_id', $cid)
                        ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray();
                }
                $sid = $loc['state_id'] ?? null;
                if ($sid) {
                    $workLocationCities[$idx] = \Botble\Location\Models\City::query()
                        ->where('state_id', $sid)
                        ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray();
                }
            }
        }
        $useLocationDropdowns = is_plugin_active('location');
        $currentCountryName = old('country_name', $account->country_name ?? '');
        $currentStateName = old('state_name', $account->state_name ?? '');
        $currentCityName = old('city_name', $account->city_name ?? '');
        if (!$currentCountryName && is_plugin_active('location') && $account->country_id) {
            try { $currentCountryName = \Botble\Location\Models\Country::find($account->country_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (is_plugin_active('location')) {
            if (!$currentCountryName && $account->country_id) { try { $currentCountryName = \Botble\Location\Models\Country::find($account->country_id)->name ?? ''; } catch (\Throwable $e) {} }
            if (!$currentStateName && $account->state_id) { try { $currentStateName = \Botble\Location\Models\State::find($account->state_id)->name ?? ''; } catch (\Throwable $e) {} }
            if (!$currentCityName && $account->city_id) { try { $currentCityName = \Botble\Location\Models\City::find($account->city_id)->name ?? ''; } catch (\Throwable $e) {} }
        }
        $nativeCountryName = old('native_country_name', $account->native_country_name ?? '');
        $nativeStateName = old('native_state_name', $account->native_state_name ?? '');
        $nativeCityName = old('native_city_name', $account->native_city_name ?? '');
        if (!$nativeCountryName && is_plugin_active('location') && $account->native_country_id) {
            try { $nativeCountryName = \Botble\Location\Models\Country::find($account->native_country_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (!$nativeStateName && is_plugin_active('location') && $account->native_state_id) {
            try { $nativeStateName = \Botble\Location\Models\State::find($account->native_state_id)->name ?? ''; } catch (\Throwable $e) {}
        }
        if (!$nativeCityName && is_plugin_active('location') && $account->native_city_id) {
            try { $nativeCityName = \Botble\Location\Models\City::find($account->native_city_id)->name ?? ''; } catch (\Throwable $e) {}
        }
    @endphp
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-map-marker-alt"></i> {{ __('Location Details') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Help schools/institutions understand your current location and preferred work areas for better job matching.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="profile-section-body">
            {{-- Current Location - City, Address & Pin Code --}}
            <h6 class="mb-2 text-dark">{{ __('Current Location') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Select the city, state, and locality where you are currently residing.') }}"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('City') }}</label>
                    <div class="city-search-wrapper" style="position:relative;">
                        <input type="text" id="js-current-city-search" class="form-control" value="{{ $currentCityName }}" placeholder="{{ __('Type or select city...') }}" autocomplete="off">
                        <div id="js-current-city-suggestions" class="city-suggestions-dropdown" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:100; background:#fff; border:1px solid #dee2e6; border-radius:8px; max-height:220px; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.15);"></div>
                    </div>
                    <small class="text-muted">{{ __('Type and select city; State and Country auto-fill') }}</small>
                    <input type="hidden" name="city_id" id="js-current-city-id" value="{{ old('city_id', $account->city_id) }}">
                    <input type="hidden" name="state_id" id="js-current-state-id" value="{{ old('state_id', $account->state_id) }}">
                    <input type="hidden" name="country_id" id="js-current-country-id" value="{{ old('country_id', $account->country_id) }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('State') }}</label>
                    <input type="text" id="js-current-state-display" class="form-control" readonly placeholder="{{ __('Select city first') }}" value="{{ $currentStateName }}" style="background:#f8f9fa;">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('Country') }}</label>
                    <input type="text" id="js-current-country-display" class="form-control" readonly placeholder="{{ __('Select city first') }}" value="{{ $currentCountryName }}" style="background:#f8f9fa;">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">{{ __('Address') }}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $account->address) }}" placeholder="{{ __('Enter your address') }}">
                    @error('address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">{{ __('Pin Code') }}</label>
                    <input type="text" class="form-control" name="pin_code" value="{{ old('pin_code', $account->pin_code ?? '') }}" placeholder="{{ __('e.g. 110001') }}" maxlength="20">
                </div>
            </div>

            {{-- Permanent / Native Location - Address & Pin Code only --}}
            <h6 class="mb-2 text-dark">{{ __('Permanent / Native Location') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Enter your hometown or permanent residence location.') }}"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-1">
                <div class="col-12 mb-3">
                    <div class="form-check">
                        <input type="hidden" name="native_same_as_current" value="0">
                        <input type="checkbox" class="form-check-input" name="native_same_as_current" value="1" id="native_same_as_current" @checked(old('native_same_as_current', $account->native_same_as_current ?? false))>
                        <label class="form-check-label" for="native_same_as_current">{{ __('My Native Location is same as Current Location') }}</label>
                    </div>
                </div>
            </div>
            <div id="native_location_fields" class="row mb-4" style="{{ old('native_same_as_current', $account->native_same_as_current ?? false) ? 'display:none;' : '' }}">
                <input type="hidden" name="native_city_id" value="{{ old('native_city_id', $account->native_city_id) }}">
                <input type="hidden" name="native_state_id" value="{{ old('native_state_id', $account->native_state_id) }}">
                <input type="hidden" name="native_country_id" value="{{ old('native_country_id', $account->native_country_id) }}">
                <input type="hidden" name="native_locality" value="{{ old('native_locality', $account->native_locality ?? '') }}">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Address') }}</label>
                    <input type="text" class="form-control" name="native_address" value="{{ old('native_address', $account->native_address ?? '') }}" placeholder="{{ __('Address') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Pin Code') }}</label>
                    <input type="text" class="form-control" name="native_pin_code" value="{{ old('native_pin_code', $account->native_pin_code ?? '') }}" placeholder="{{ __('e.g. 110001') }}" maxlength="20">
                </div>
            </div>

            {{-- Preferred Work Locations --}}
            <h6 class="mb-2 text-dark">{{ __('Preferred Work Locations') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Choose the locations where you are willing to work. To show you relevant job opportunities based on your relocation preference.') }}"><i class="fa fa-question-circle"></i></span></h6>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="current_only" id="wl_current_only" @checked($workLocationPreferenceType == 'current_only' || $workLocationPreferenceType === '')>
                        <label class="form-check-label" for="wl_current_only">{{ __('Open to work only at Current Location') }}</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="relocation_india" id="wl_relocation_india" @checked($workLocationPreferenceType == 'relocation_india')>
                        <label class="form-check-label" for="wl_relocation_india">{{ __('Open for relocation across India') }} ({{ __('as per current location country') }})</label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="radio" class="form-check-input" name="work_location_preference_type" value="other" id="wl_other" @checked($workLocationPreferenceType == 'other')>
                        <label class="form-check-label" for="wl_other">{{ __('Other work location preferences') }}</label>
                    </div>
                </div>
            </div>
            <input type="hidden" id="js-default-country-id" value="{{ $account->country_id ?? '' }}">
            <input type="hidden" id="js-use-location-dropdowns" value="{{ $useLocationDropdowns ? '1' : '0' }}">
            <div id="work_location_preferences_wrapper" class="mb-3" style="display: {{ $workLocationPreferenceType == 'other' ? 'block' : 'none' }};">
                <label class="form-label">{{ __('Add preferred locations (set priority)') }}</label>
                <p class="form-text">{{ $useLocationDropdowns ? __('Default country is same as current location; you can select other countries.') : __('Enter Country, State, City and Locality for each preferred location.') }}</p>
                <div id="work-locations-container">
                    @foreach($workLocations as $index => $loc)
                    <div class="removable-item work-location-item" data-state-id="{{ $loc['state_id'] ?? '' }}" data-city-id="{{ $loc['city_id'] ?? '' }}">
                        @if($index > 0)<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>@endif
                        <div class="row align-items-end">
                            <!-- <div class="col-md-1 d-flex align-items-center mb-2">
                                <span class="priority-badge">{{ $index + 1 }}</span>
                            </div> -->
                            @if($useLocationDropdowns)
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('Country') }}</label>
                                <select class="form-select form-select-sm work-pref-country" name="work_location_preferences[{{ $index }}][country_id]" data-index="{{ $index }}">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach($countries as $id => $name)
                                        <option value="{{ $id }}" @selected(($loc['country_id'] ?? '') == $id)>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('State') }}</label>
                                <select class="form-select form-select-sm work-pref-state" name="work_location_preferences[{{ $index }}][state_id]" data-index="{{ $index }}">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach($workLocationStates[$index] ?? [] as $sid => $sname)
                                        <option value="{{ $sid }}" @selected(($loc['state_id'] ?? '') == $sid)>{{ $sname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('City') }}</label>
                                <select class="form-select form-select-sm work-pref-city" name="work_location_preferences[{{ $index }}][city_id]" data-index="{{ $index }}">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach($workLocationCities[$index] ?? [] as $cid => $cname)
                                        <option value="{{ $cid }}" @selected(($loc['city_id'] ?? '') == $cid)>{{ $cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @else
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('Country') }}</label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[{{ $index }}][country_name]" value="{{ $loc['country_name'] ?? '' }}" placeholder="{{ __('Country') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('State') }}</label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[{{ $index }}][state_name]" value="{{ $loc['state_name'] ?? '' }}" placeholder="{{ __('State') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('City') }}</label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[{{ $index }}][city_name]" value="{{ $loc['city_name'] ?? '' }}" placeholder="{{ __('City') }}">
                            </div>
                            @endif
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">{{ __('Locality') }}</label>
                                <input type="text" class="form-control form-control-sm" name="work_location_preferences[{{ $index }}][locality]" value="{{ $loc['locality'] ?? '' }}" placeholder="{{ __('Locality') }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="add-more-btn" onclick="addWorkLocation()" id="add-work-location-btn">+ {{ __('Add Location Preference') }}</button>
            </div>
        </div>
    </div>
                <!-- Section 4: Qualifications & Experience -->
                <div class="profile-section">
                        <div class="profile-section-header">
                            <i class="fa fa-graduation-cap"></i> {{ __('Qualifications, Certifications & Experience') }}
                        </div>
                        <div class="profile-section-body">
                            <p class="form-text mb-3">{{ __('Provide your academic background and professional experience to help schools / institutions evaluate your eligibility.') }}</p>
                            <div class="row">
                                <!-- 14. Qualifications (JSON array) -->
                                <div class="col-12 mb-4">
                                    <label class="form-label">{{ __('Academic Qualifications') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Schools/Institutions verify subject eligibility and minimum qualification requirements before shortlisting candidates. Include degree level, specialization, and institution name.') }}"><i class="fa fa-question-circle"></i></span></label>
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
                                                    <select class="form-select" name="qualifications[{{ $index }}][specialization]">
                                                        <option value="">{{ __('-- Select Specialization --') }}</option>
                                                        @foreach($specializationsList ?? [] as $spec)
                                                        <option value="{{ is_object($spec) ? $spec->name : $spec['name'] ?? '' }}" @selected(($qual['specialization'] ?? '') == (is_object($spec) ? $spec->name : $spec['name'] ?? ''))>{{ is_object($spec) ? $spec->name : $spec['name'] ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <input type="text" class="form-control" name="qualifications[{{ $index }}][institution]" value="{{ $qual['institution'] ?? '' }}" placeholder="{{ __('Institution Name') }}">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="add-more-btn mt-2" onclick="addQualification()">+ {{ __('Add More Qualification') }}</button>
                                </div>

                                <!-- 15. Teaching Certifications -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Professional Teaching Certification') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Select all professional certifications you have completed. Many schools require mandatory certifications (e.g., B.Ed, CTET) for eligibility.') }}"><i class="fa fa-question-circle"></i></span></label>
                                    <select id="ts-teaching-certifications" name="teaching_certifications[]" multiple placeholder="{{ __('Search & select certifications...') }}">
                                        @php
                                        $certs = old('teaching_certifications', $account->teaching_certifications ?? []);
                                        $certs = is_array($certs) ? $certs : (is_string($certs) ? (json_decode($certs, true) ?? (array)$certs) : (array)$certs);
                                    @endphp
                                        @foreach(['b_ed' => 'B.Ed', 'm_ed' => 'M.Ed', 'ctet' => 'CTET', 'tet' => 'TET', 'ntt' => 'NTT', 'montessori' => 'Montessori', 'teacher_training' => 'Teacher Training Course', 'net' => 'NET', 'set' => 'SET', 'gate' => 'GATE'] as $val => $lbl)
                                            <option value="{{ $val }}" @selected(in_array($val, $certs))>{{ $lbl }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- 17. Total Experience -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('Total Teaching / Professional Experience') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Select your total relevant experience in teaching or education sector. Recruiters filter candidates based on experience requirements.') }}"><i class="fa fa-question-circle"></i></span></label>
                                    <select class="form-select" name="total_experience" id="total_experience_select">
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

                            {{-- Experience Details (shown when 1+ years selected) --}}
                            <div id="experience_section_wrapper" class="mt-4" style="display: none;">
                                <h6 class="mb-3 text-dark">{{ __('Experience Details') }}</h6>
                                <p class="form-text mb-3">{{ __('Add your work experience below. These details will appear in your resume and help schools evaluate your profile.') }}</p>
                                <div id="inline-experiences-list">
                                    @php $expList = $experiences ?? collect(); @endphp
                                    @if($expList->isNotEmpty())
                                        @foreach($expList as $exp)
                                    <div class="removable-item mb-3" style="background:#f8fafc; padding:14px; border-radius:8px; border:1px solid #e2e8f0;">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>{!! BaseHelper::clean($exp->company) !!}</strong>
                                                @if($exp->position)<span class="text-muted ms-2">— {!! BaseHelper::clean($exp->position) !!}</span>@endif
                                                <div class="small text-muted mt-1">
                                                    {{ $exp->started_at->format('M Y') }} - @if($exp->is_current){{ __('Present') }}@else{{ $exp->ended_at ? $exp->ended_at->format('M Y') : '' }}@endif
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('public.account.experiences.edit', $exp->id) }}" class="btn btn-sm btn-outline-primary" target="_blank">{{ __('Edit') }}</a>
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-exp-delete" data-url="{{ route('public.account.experiences.destroy', $exp->id) }}" data-csrf="{{ csrf_token() }}">{{ __('Delete') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    @else
                                    <p class="text-muted small mb-2">{{ __('No experience added yet.') }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('public.account.experiences.create') }}" class="add-more-btn" target="_blank">
                                    <i class="fa fa-plus me-1"></i> {{ __('Add Experience') }}
                                </a>
                            </div>
                        </div>
                    </div>
    <!-- Section 6: Skills & Languages -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-language"></i> {{ __('Languages & Skills') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('This section helps schools/institutions understand communication ability and practical competencies.') }}</p>
            <div class="row">
                <!-- 21. Languages -->
                <div class="col-12 mb-4">
                    <label class="form-label">{{ __('Languages Known') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Add languages you can confidently use for communication and teaching. Schools often filter candidates based on communication skills.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <div id="languages-container">
                        @php $languages = old('languages', $account->languages ?? [['language' => '', 'proficiency' => '']]); @endphp
                        @foreach($languages as $index => $lang)
                        <div class="removable-item language-item">
                            @if($index > 0)<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>@endif
                            <div class="row">
                                <div class="col-md-1 d-flex align-items-center">
                                    <span class="priority-badge">{{ $index + 1 }}</span>
                                </div>
                                <div class="col-md-5 mb-2">
                                    @if(isset($languagesList))
                                    <select class="form-select" name="languages[{{ $index }}][language]">
                                        <option value="">{{ __('-- Select language --') }}</option>
                                        @foreach($languagesList as $opt)
                                        <option value="{{ $opt->name }}" @selected(($lang['language'] ?? '') == $opt->name)>{{ $opt->name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="text" class="form-control" name="languages[{{ $index }}][language]" value="{{ $lang['language'] ?? '' }}" placeholder="{{ __('Language (e.g., English)') }}">
                                    @endif
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
                    <button type="button" class="add-more-btn mt-2" onclick="addLanguage()" id="add-language-btn">+ {{ __('Add Language') }}</button>
                </div>

                <!-- 22. Skills -->
                @if ($account->isJobSeeker() && (count($jobSkills ?? []) || count($selectedJobSkills ?? [])))
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Key Skills & Competencies') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Add your core teaching or professional skills relevant to your role.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="text" class="tags form-control list-tagify" style="padding:0px;" id="favorite_skills" name="favorite_skills" value="{{ implode(',', $selectedJobSkills ?? []) }}" data-keep-invalid-tags="false" data-list="{{ $jobSkills ?? '' }}" data-user-input="false" placeholder="{{ __('Select from the list') }}"/>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Section 8: Resume & Documents -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-file-alt"></i> {{ __('Resume & Supporting Documents') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('Upload your professional documents to strengthen your profile and improve shortlisting chances.') }}</p>
            <div class="row">
                <!-- 27. Resume -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Resume / CV Upload') }} <span class="required">*</span><span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Upload your latest updated resume with complete academic and experience details. Schools review resumes before shortlisting candidates for interviews. PDF/Word files only. Max 2MB') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="file" class="form-control @error('resume') is-invalid @enderror" name="resume" accept=".pdf,.doc,.docx">
                    @error('resume')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    @if ($account->resume)
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="{{ RvMedia::url($account->resume) }}" target="_blank">{{ __('View Current Resume') }}</a>
                        </small>
                    @endif
                    <div class="form-check mt-2">
                        <input type="hidden" name="resume_parsing_allowed" value="0">
                        <input type="checkbox" class="form-check-input" name="resume_parsing_allowed" value="1" id="resume_parsing_allowed" @checked(old('resume_parsing_allowed', $account->resume_parsing_allowed ?? false))>
                        <label class="form-check-label" for="resume_parsing_allowed">{{ __('Allow resume parsing to auto-fill profile') }}</label>
                    </div>
                </div>

                <!-- 28. Cover Letter -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Cover Letter') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Upload a personalized cover letter explaining your teaching approach and career goals.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="file" class="form-control" name="cover_letter" accept=".pdf,.doc,.docx">
                    @if ($account->cover_letter)
                        <small class="form-text mt-1">
                            <i class="fa fa-file me-1"></i>
                            <a href="{{ RvMedia::url($account->cover_letter) }}" target="_blank">{{ __('View Current Cover Letter') }}</a>
                        </small>
                    @endif
                </div>

                <!-- Self Introduction Audio -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Self Introduction Audio') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Record a short introduction about yourself, your teaching experience, and subject expertise. Helps schools evaluate communication skills, fluency, and confidence before scheduling interviews. Max 1.5 MB. You can record using the button above or upload a file.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <div class="d-flex gap-2 mb-2">
                        <!-- <button type="button" class="btn btn-outline-primary btn-sm" id="record-audio-btn">
                            <i class="fa fa-microphone me-1"></i> {{ __('Record') }}
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm d-none" id="stop-record-btn">
                            <i class="fa fa-stop me-1"></i> {{ __('Stop') }}
                        </button> -->
                        <span class="text-muted small align-self-center" id="record-status"></span>
                    </div>
                    <input type="file" class="form-control @error('introductory_audio') is-invalid @enderror" name="introductory_audio" id="introductory_audio_file" accept="audio/*,.mp4,video/mp4,.webm,.mp3,.m4a,.wav,.ogg">
                    <span class="text-muted small mt-1" id="intro_audio_hint">{{ __('Upload an audio file (max 1.5 MB). Allowed: mp3, m4a, wav, ogg, webm.') }}</span>
                    @error('introductory_audio')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <!-- Teaching Demo / YouTube Link -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('YouTube Video Link') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Paste the link to your YouTube teaching demo or self-introduction video (e.g. https://www.youtube.com/watch?v=...)') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="introductory_video_url" value="{{ old('introductory_video_url', $account->introductory_video_url ?? '') }}" placeholder="https://www.youtube.com/watch?v=...">
                </div>
            </div>
            <p class="form-text text-muted mt-3 mb-0 p-3 rounded" style="background:#f8f9fa;"><i class="fa fa-lock me-2"></i>{{ __('Your documents are securely stored and shared only with schools/institutions based on your profile visibility settings.') }}</p>
        </div>
    </div>

    <!-- Section 9: Social Links -->
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="fa fa-link"></i> {{ __('Social & Professional Link') }}
        </div>
        <div class="profile-section-body">
            <p class="form-text mb-3">{{ __('Add your professional social profiles to strengthen credibility and help schools know you better.') }}</p>
            <div class="row">
                @php $social = old('social_links', $account->social_links ?? []); @endphp
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-primary me-2"></i>{{ __('LinkedIn') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Schools may review your professional network, recommendations, and career history.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="social_links[linkedin]" value="{{ $social['linkedin'] ?? '' }}" placeholder="https://linkedin.com/in/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary me-2"></i>{{ __('Facebook') }}<span class="field-help-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Some institutions review online presence for background understanding.') }}"><i class="fa fa-question-circle"></i></span></label>
                    <input type="url" class="form-control" name="social_links[facebook]" value="{{ $social['facebook'] ?? '' }}" placeholder="https://facebook.com/...">
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
    // Scroll to first validation error (field with red border)
    var firstInvalid = document.querySelector('#profile-form .form-control.is-invalid, #profile-form .form-select.is-invalid');
    if (firstInvalid) {
        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // ---------- Client-side validation before save (show errors under fields, red line) ----------
    var profileForm = document.getElementById('profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            // Remove previous client-side error messages and red border
            document.querySelectorAll('#profile-form .js-field-error').forEach(function(el) { el.remove(); });
            document.querySelectorAll('#profile-form .form-control.is-invalid, #profile-form .form-select.is-invalid').forEach(function(el) { el.classList.remove('is-invalid'); });
            var firstErrorEl = null;
            var hasError = false;

            function showFieldError(inputOrWrap, message) {
                hasError = true;
                var el = inputOrWrap;
                if (el && el.classList && el.classList.contains('form-control')) {
                    el.classList.add('is-invalid');
                    if (!firstErrorEl) firstErrorEl = el;
                }
                var wrap = el && el.closest ? el.closest('.mb-3') : (el && el.parentElement);
                if (!wrap) wrap = el && el.parentElement;
                if (wrap) {
                    var errDiv = document.createElement('div');
                    errDiv.className = 'invalid-feedback d-block js-field-error';
                    errDiv.style.color = '#dc3545';
                    errDiv.style.fontSize = '12px';
                    errDiv.style.marginTop = '4px';
                    errDiv.textContent = message;
                    wrap.appendChild(errDiv);
                    if (!firstErrorEl) firstErrorEl = wrap;
                }
            }

            var firstName = document.querySelector('#profile-form input[name="first_name"]');
            if (firstName && !String(firstName.value || '').trim()) {
                showFieldError(firstName, '{{ __("Full name is required.") }}');
            }

            var phoneInput = document.querySelector('#profile-form input[name="phone"]');
            if (phoneInput) {
                var phone = String(phoneInput.value || '').replace(/\D/g, '');
                if (phone.length === 0) {
                    showFieldError(phoneInput, '{{ __("Please enter your phone number.") }}');
                } else if (phone.length < 10) {
                    showFieldError(phoneInput, '{{ __("Please enter a valid 10-digit phone number.") }}');
                }
            }

            var dobInput = document.querySelector('#profile-form input[name="dob"]');
            if (dobInput && dobInput.hasAttribute('required') && !dobInput.value) {
                showFieldError(dobInput, '{{ __("Date of birth is required.") }}');
            }

            var genderChecked = document.querySelector('#profile-form input[name="gender"]:checked');
            if (!genderChecked) {
                var genderInput = document.querySelector('#profile-form input[name="gender"]');
                if (genderInput) showFieldError(genderInput.closest('.mb-3') || genderInput, '{{ __("Please select gender.") }}');
            }

            var audioInput = document.querySelector('#profile-form input[name="introductory_audio"]');
            if (audioInput && audioInput.files && audioInput.files.length > 0) {
                var file = audioInput.files[0];
                var allowed = ['audio/mpeg', 'audio/mp3', 'audio/mp4', 'audio/x-m4a', 'audio/m4a', 'audio/wav', 'audio/ogg', 'audio/webm', 'video/mp4', 'video/webm'];
                var ext = (file.name || '').split('.').pop().toLowerCase();
                var ok = allowed.indexOf(file.type) !== -1 || ['mp3', 'mpeg', 'mpga', 'm4a', 'wav', 'ogg', 'webm', 'mp4'].indexOf(ext) !== -1;
                if (!ok) {
                    showFieldError(audioInput, '{{ __("Allowed formats: mp4, wav, ogg, m4a, webm, mp3.") }}');
                } else if (file.size > 1.5 * 1024 * 1024) {
                    showFieldError(audioInput, '{{ __("Audio file must be 1.5 MB or less.") }}');
                }
            }

            if (hasError && firstErrorEl) {
                e.preventDefault();
                firstErrorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
        });
    }

    // Bootstrap tooltips (hover + click for mobile)
    const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (typeof bootstrap !== 'undefined' && tooltipEls.length) {
        tooltipEls.forEach(el => new bootstrap.Tooltip(el, { trigger: 'hover focus click' }));
    }

    // Experience Delete (no nested form – so main profile form stays valid)
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.btn-exp-delete');
        if (!btn) return;
        e.preventDefault();
        if (!confirm('{{ __("Are you sure?") }}')) return;
        var url = btn.getAttribute('data-url');
        var csrf = btn.getAttribute('data-csrf');
        if (!url) return;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        form.style.display = 'none';
        var tok = document.createElement('input');
        tok.type = 'hidden'; tok.name = '_token'; tok.value = csrf || '';
        form.appendChild(tok);
        var method = document.createElement('input');
        method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    });

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

    // Institution Types
    if (document.getElementById('ts-institution-types')) {
        var tsInst = new TomSelect('#ts-institution-types', {
            plugins: ['remove_button', 'optgroup_columns'],
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

    // Teaching Subjects
    var tsSubjectsInstance = null;
    if (document.getElementById('ts-teaching-subjects')) {
        tsSubjectsInstance = new TomSelect('#ts-teaching-subjects', {
            plugins: ['remove_button', 'optgroup_columns'],
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

    // Non-Teaching Positions
    var tsNonTeachingInstance = null;
    if (document.getElementById('ts-non-teaching')) {
        tsNonTeachingInstance = new TomSelect('#ts-non-teaching', {
            plugins: ['remove_button'],
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

    // Job Type
    if (document.getElementById('ts-job-type')) {
        new TomSelect('#ts-job-type', {
            plugins: ['remove_button'],
            searchField: ['text'],
            render: {
                no_results: function() { return '<div class="no-results">No job type found</div>'; }
            }
        });
    }

    // ==========================================
    // Introductory Audio - 1.5 MB validation
    // ==========================================
    const introAudioInput = document.getElementById('introductory_audio_file');
    const introAudioHint = document.getElementById('intro_audio_hint');
    const maxAudioSize = 1.5 * 1024 * 1024; // 1.5 MB
    const hintText = '{{ __("Upload an audio file (max 1.5 MB). Include: qualifications, experience, teaching style.") }}';
    const errorText = '{{ __("Audio file must be 1.5 MB or less.") }}';

    if (introAudioInput && introAudioHint) {
        introAudioInput.addEventListener('change', function() {
            introAudioHint.textContent = hintText;
            introAudioHint.classList.remove('text-danger');
            var file = this.files[0];
            if (file && file.size > maxAudioSize) {
                introAudioHint.textContent = errorText;
                introAudioHint.classList.add('text-danger');
                this.value = '';
            }
        });
    }

    var profileForm = document.getElementById('profile-form');
    if (profileForm && introAudioHint) {
        profileForm.addEventListener('submit', function(e) {
            var audioInput = document.getElementById('introductory_audio_file');
            if (audioInput && audioInput.files.length > 0 && audioInput.files[0].size > maxAudioSize) {
                e.preventDefault();
                introAudioHint.textContent = errorText;
                introAudioHint.classList.add('text-danger');
                return false;
            }
        });
    }

    // ==========================================
    // Toggle Logic
    // ==========================================

    // Work status toggle for notice period and salary required
    const workStatus = document.getElementById('current_work_status');
    const noticePeriod = document.getElementById('notice_period_wrapper');
    
    function toggleNoticePeriod() {
        noticePeriod.style.display = workStatus.value === 'working' ? 'block' : 'none';
    }
    
    // Salary: not required when "Not Working Now"
    function toggleSalaryRequired() {
        const isNotWorking = workStatus.value === 'not_working';
        const currReq = document.getElementById('current_salary_req');
        const currOpt = document.getElementById('current_salary_optional');
        const currInput = document.getElementById('current_salary_input');
        const expReq = document.getElementById('expected_salary_req');
        const expOpt = document.getElementById('expected_salary_optional');
        const expInput = document.getElementById('expected_salary_input');
        if (currReq) currReq.style.display = isNotWorking ? 'none' : 'inline';
        if (currOpt) currOpt.style.display = isNotWorking ? 'inline' : 'none';
        if (currInput) currInput.required = !isNotWorking;
        if (expReq) expReq.style.display = isNotWorking ? 'none' : 'inline';
        if (expOpt) expOpt.style.display = isNotWorking ? 'inline' : 'none';
        if (expInput) expInput.required = !isNotWorking;
    }
    
    workStatus.addEventListener('change', function() {
        toggleNoticePeriod();
        toggleSalaryRequired();
    });
    toggleNoticePeriod();
    toggleSalaryRequired();

    // Experience section: show when 1+ years selected
    const totalExpSelect = document.getElementById('total_experience_select');
    const expSectionWrapper = document.getElementById('experience_section_wrapper');
    function toggleExperienceSection() {
        if (!totalExpSelect || !expSectionWrapper) return;
        var v = totalExpSelect.value;
        var show = v && v !== 'fresher' && v !== 'intern';
        expSectionWrapper.style.display = show ? 'block' : 'none';
    }
    if (totalExpSelect) totalExpSelect.addEventListener('change', toggleExperienceSection);
    toggleExperienceSection();

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

    // Native same as current toggle
    const nativeSameCheck = document.getElementById('native_same_as_current');
    const nativeFields = document.getElementById('native_location_fields');
    if (nativeSameCheck && nativeFields) {
        function toggleNativeFields() {
            nativeFields.style.display = nativeSameCheck.checked ? 'none' : 'block';
        }
        nativeSameCheck.addEventListener('change', toggleNativeFields);
    }

    // Work location preference type: show "Other" locations only when "other" is selected
    const wlOther = document.getElementById('wl_other');
    const workLocationWrapper = document.getElementById('work_location_preferences_wrapper');
    function toggleWorkPrefWrapper() {
        if (workLocationWrapper) {
            workLocationWrapper.style.display = wlOther && wlOther.checked ? 'block' : 'none';
        }
    }
    document.querySelectorAll('input[name="work_location_preference_type"]').forEach(function(radio) {
        radio.addEventListener('change', toggleWorkPrefWrapper);
    });

    // City search: Current location - default 12 cities on focus, search on type
    (function() {
        var searchEl = document.getElementById('js-current-city-search');
        var suggestionsEl = document.getElementById('js-current-city-suggestions');
        var cityIdEl = document.getElementById('js-current-city-id');
        var stateIdEl = document.getElementById('js-current-state-id');
        var countryIdEl = document.getElementById('js-current-country-id');
        var stateDisplay = document.getElementById('js-current-state-display');
        var countryDisplay = document.getElementById('js-current-country-display');
        if (!searchEl || !suggestionsEl) return;
        function renderCities(cities) {
            if (!cities || cities.length === 0) { suggestionsEl.innerHTML = '<div class="p-2 text-muted">No cities found</div>'; return; }
            var html = '';
            cities.forEach(function(c) {
                var parts = []; if (c.state_name) parts.push(c.state_name); if (c.country_name) parts.push(c.country_name);
                html += '<div class="city-suggestion-item p-2 border-bottom" style="cursor:pointer;" data-id="' + (c.id||'') + '" data-name="' + (c.name||'') + '" data-state-id="' + (c.state_id||'') + '" data-state-name="' + (c.state_name||'') + '" data-country-id="' + (c.country_id||'') + '" data-country-name="' + (c.country_name||'') + '"><strong>' + (c.name||'') + '</strong>' + (parts.length ? ' <span class="text-muted">' + parts.join(', ') + '</span>' : '') + '</div>';
            });
            suggestionsEl.innerHTML = html;
            suggestionsEl.querySelectorAll('.city-suggestion-item').forEach(function(el) {
                el.addEventListener('click', function() {
                    searchEl.value = this.getAttribute('data-name') || '';
                    if (cityIdEl) cityIdEl.value = this.getAttribute('data-id') || '';
                    if (stateIdEl) stateIdEl.value = this.getAttribute('data-state-id') || '';
                    if (countryIdEl) countryIdEl.value = this.getAttribute('data-country-id') || '';
                    if (stateDisplay) stateDisplay.value = this.getAttribute('data-state-name') || '';
                    if (countryDisplay) countryDisplay.value = this.getAttribute('data-country-name') || '';
                    suggestionsEl.style.display = 'none';
                });
            });
        }
        function loadCities(k) {
            suggestionsEl.innerHTML = '<div class="p-2 text-muted">Loading...</div>';
            suggestionsEl.style.display = 'block';
            var url = '{{ route("ajax.search-cities") }}' + (k && k.length >= 2 ? '?k=' + encodeURIComponent(k) : '');
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(function(r) {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    var ct = r.headers.get('Content-Type') || '';
                    if (!ct.includes('application/json')) throw new Error('Invalid response');
                    return r.json();
                })
                .then(function(res) {
                    var cities = Array.isArray(res.data) ? res.data : (res.data && res.data.data) ? res.data.data : [];
                    if (!Array.isArray(cities) && res.data && !Array.isArray(res.data)) cities = [];
                    renderCities(cities);
                })
                .catch(function(err) {
                    suggestionsEl.innerHTML = '<div class="p-2 text-danger">Could not load cities. Please try again.</div>' +
                        '<div class="p-2"><button type="button" class="btn btn-sm btn-outline-primary retry-city-load">Retry</button></div>';
                    suggestionsEl.querySelector('.retry-city-load')?.addEventListener('click', function() {
                        var k = searchEl.value.trim();
                        loadCities(k);
                    });
                });
        }
        var searchTimeout = null;
        searchEl.addEventListener('focus', function() {
            if (suggestionsEl.style.display === 'block') return;
            loadCities(this.value.trim());
        });
        searchEl.addEventListener('input', function() {
            var k = this.value.trim();
            if (searchTimeout) clearTimeout(searchTimeout);
            if (!cityIdEl) return;
            cityIdEl.value = ''; if (stateIdEl) stateIdEl.value = ''; if (countryIdEl) countryIdEl.value = '';
            if (stateDisplay) stateDisplay.value = ''; if (countryDisplay) countryDisplay.value = '';
            suggestionsEl.style.display = 'none'; suggestionsEl.innerHTML = '';
            searchTimeout = setTimeout(function() { loadCities(k); }, 300);
        });
        document.addEventListener('click', function(e) {
            if (!searchEl.contains(e.target) && !suggestionsEl.contains(e.target)) suggestionsEl.style.display = 'none';
        });
    })();

    // City-first: Native location - search city then auto-fill State & Country
    (function() {
        var searchEl = document.getElementById('js-native-city-search');
        var suggestionsEl = document.getElementById('js-native-city-suggestions');
        var cityIdEl = document.getElementById('js-native-city-id');
        var stateIdEl = document.getElementById('js-native-state-id');
        var countryIdEl = document.getElementById('js-native-country-id');
        var stateDisplay = document.getElementById('js-native-state-display');
        var countryDisplay = document.getElementById('js-native-country-display');
        if (!searchEl || !suggestionsEl) return;
        var searchTimeout = null;
        searchEl.addEventListener('input', function() {
            var k = this.value.trim();
            if (searchTimeout) clearTimeout(searchTimeout);
            cityIdEl.value = ''; stateIdEl.value = ''; countryIdEl.value = '';
            if (stateDisplay) stateDisplay.value = ''; if (countryDisplay) countryDisplay.value = '';
            suggestionsEl.style.display = 'none'; suggestionsEl.innerHTML = '';
            if (k.length < 2) return;
            searchTimeout = setTimeout(function() {
                suggestionsEl.innerHTML = '<div class="p-2 text-muted">Searching...</div>';
                suggestionsEl.style.display = 'block';
                fetch('{{ route("ajax.search-cities") }}?k=' + encodeURIComponent(k))
                    .then(function(r) { return r.json(); })
                    .then(function(res) {
                        var cities = res.data || [];
                        if (cities.length === 0) { suggestionsEl.innerHTML = '<div class="p-2 text-muted">No cities found</div>'; return; }
                        var html = '';
                        cities.forEach(function(c) {
                            var parts = []; if (c.state_name) parts.push(c.state_name); if (c.country_name) parts.push(c.country_name);
                            html += '<div class="city-suggestion-item p-2 border-bottom" style="cursor:pointer;" data-id="' + c.id + '" data-name="' + (c.name || '') + '" data-state-id="' + (c.state_id || '') + '" data-state-name="' + (c.state_name || '') + '" data-country-id="' + (c.country_id || '') + '" data-country-name="' + (c.country_name || '') + '"><strong>' + (c.name || '') + '</strong>' + (parts.length ? ' <span class="text-muted">' + parts.join(', ') + '</span>' : '') + '</div>';
                        });
                        suggestionsEl.innerHTML = html;
                        suggestionsEl.querySelectorAll('.city-suggestion-item').forEach(function(el) {
                            el.addEventListener('click', function() {
                                searchEl.value = this.getAttribute('data-name');
                                cityIdEl.value = this.getAttribute('data-id');
                                stateIdEl.value = this.getAttribute('data-state-id');
                                countryIdEl.value = this.getAttribute('data-country-id');
                                if (stateDisplay) stateDisplay.value = this.getAttribute('data-state-name') || '';
                                if (countryDisplay) countryDisplay.value = this.getAttribute('data-country-name') || '';
                                suggestionsEl.style.display = 'none';
                            });
                        });
                    })
                    .catch(function() { suggestionsEl.innerHTML = '<div class="p-2 text-muted">Error</div>'; });
            }, 300);
        });
        document.addEventListener('click', function(e) {
            if (!searchEl.contains(e.target) && !suggestionsEl.contains(e.target)) suggestionsEl.style.display = 'none';
        });
    })();

    var ajaxHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
    var getStatesCities = function(data) {
        var arr = data && data.data;
        if (Array.isArray(arr)) return arr;
        if (data && Array.isArray(data)) return data;
        return [];
    };

    // Work preference rows: load states/cities for existing rows on page load
    document.querySelectorAll('.work-location-item').forEach(function(row) {
        var countrySel = row.querySelector('.work-pref-country');
        var stateSel = row.querySelector('.work-pref-state');
        var citySel = row.querySelector('.work-pref-city');
        var stateId = row.getAttribute('data-state-id');
        var cityId = row.getAttribute('data-city-id');
        if (countrySel && countrySel.value && stateSel) {
            fetch('{{ route("ajax.states-by-country") }}?country_id=' + countrySel.value, { headers: ajaxHeaders })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var list = getStatesCities(data);
                    var html = '<option value="">{{ __("Select") }}</option>';
                    list.forEach(function(s) { if (s && s.id && s.id != 0) html += '<option value="' + s.id + '"' + (s.id == stateId ? ' selected' : '') + '>' + (s.name || '') + '</option>'; });
                    stateSel.innerHTML = html;
                    if (stateId && stateSel.value && citySel) {
                        fetch('{{ route("ajax.cities-by-state") }}?state_id=' + stateSel.value, { headers: ajaxHeaders })
                            .then(function(r2) { return r2.json(); })
                            .then(function(data2) {
                                var list2 = getStatesCities(data2);
                                var html2 = '<option value="">{{ __("Select") }}</option>';
                                list2.forEach(function(c) { if (c && c.id && c.id != 0) html2 += '<option value="' + c.id + '"' + (c.id == cityId ? ' selected' : '') + '>' + (c.name || '') + '</option>'; });
                                citySel.innerHTML = html2;
                            })
                            .catch(function() {});
                    }
                })
                .catch(function() {});
        }
    });

    // Work preference: country/state change for dynamic rows
    var workLocContainer = document.getElementById('work-locations-container');
    if (workLocContainer) {
        workLocContainer.addEventListener('change', function(e) {
            if (e.target.classList.contains('work-pref-country')) {
                var row = e.target.closest('.work-location-item');
                var stateSel = row ? row.querySelector('.work-pref-state') : null;
                var citySel = row ? row.querySelector('.work-pref-city') : null;
                if (stateSel) stateSel.innerHTML = '<option value="">{{ __("Select") }}</option>';
                if (citySel) citySel.innerHTML = '<option value="">{{ __("Select") }}</option>';
                if (e.target.value && stateSel) {
                    fetch('{{ route("ajax.states-by-country") }}?country_id=' + e.target.value, { headers: ajaxHeaders })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            var list = getStatesCities(data);
                            var html = '<option value="">{{ __("Select") }}</option>';
                            list.forEach(function(s) { if (s && s.id && s.id != 0) html += '<option value="' + s.id + '">' + (s.name || '') + '</option>'; });
                            stateSel.innerHTML = html;
                        })
                        .catch(function() {});
                }
            } else if (e.target.classList.contains('work-pref-state')) {
                var row = e.target.closest('.work-location-item');
                var citySel = row ? row.querySelector('.work-pref-city') : null;
                if (citySel) citySel.innerHTML = '<option value="">{{ __("Select") }}</option>';
                if (e.target.value && citySel) {
                    fetch('{{ route("ajax.cities-by-state") }}?state_id=' + e.target.value, { headers: ajaxHeaders })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            var list = getStatesCities(data);
                            var html = '<option value="">{{ __("Select") }}</option>';
                            list.forEach(function(c) { if (c && c.id && c.id != 0) html += '<option value="' + c.id + '">' + (c.name || '') + '</option>'; });
                            citySel.innerHTML = html;
                        })
                        .catch(function() {});
                }
            }
        });
    }
});

// Add qualification (specialization always as dropdown from jb_specializations)
var specializationsListForSelect = @json(isset($specializationsList) ? $specializationsList->map(function($o) { return ['name' => $o->name]; })->values()->all() : []);
let qualificationIndex = {{ count($qualifications ?? [1]) }};
function addQualification() {
    const container = document.getElementById('qualifications-container');
    var opts = (specializationsListForSelect || []).map(function(o) { return '<option value="' + (o.name || '') + '">' + (o.name || '') + '</option>'; }).join('');
    var specializationSelectHtml = '<select class="form-select" name="qualifications[' + qualificationIndex + '][specialization]"><option value="">{{ __("-- Select Specialization --") }}</option>' + opts + '</select>';
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
                    ${specializationSelectHtml}
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

// Add language (uses dropdown from DB when languagesListOptions is set)
var languagesListOptions = @json(isset($languagesList) && $languagesList->isNotEmpty() ? $languagesList->map(fn($o) => ['value' => $o->name, 'label' => $o->name])->values() : []);
let languageIndex = {{ count($languages ?? [1]) }};
function addLanguage() {
    const container = document.getElementById('languages-container');
    var languageFieldHtml;
    if (languagesListOptions && languagesListOptions.length > 0) {
        var opts = languagesListOptions.map(function(o) { return '<option value="' + (o.value || o.label || '') + '">' + (o.label || o.value || '') + '</option>'; }).join('');
        languageFieldHtml = '<select class="form-select" name="languages[' + languageIndex + '][language]"><option value="">{{ __("-- Select language --") }}</option>' + opts + '</select>';
    } else {
        languageFieldHtml = '<input type="text" class="form-control" name="languages[' + languageIndex + '][language]" placeholder="{{ __("Language (e.g., English)") }}">';
    }
    const html = `
        <div class="removable-item language-item">
            <button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>
            <div class="row">
                <div class="col-md-1 d-flex align-items-center">
                    <span class="priority-badge">${languageIndex + 1}</span>
                </div>
                <div class="col-md-5 mb-2">` + languageFieldHtml + `</div>
                <div class="col-md-5 mb-2">
                    <select class="form-select" name="languages[${languageIndex}][proficiency]">
                        <option value="">{{ __("Proficiency") }}</option>
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

// Add work location preference
let workLocationIndex = {{ count($workLocations) }};
var defaultCountryId = document.getElementById('js-default-country-id') ? document.getElementById('js-default-country-id').value : '';
var useLocationDropdowns = document.getElementById('js-use-location-dropdowns') && document.getElementById('js-use-location-dropdowns').value === '1';
var countriesData = @json($countries ?? []);
function addWorkLocation() {
    var idx = document.querySelectorAll('.work-location-item').length;
    var html;
    if (useLocationDropdowns) {
        var countryOptionsHtml = '<option value="">{{ __("Select") }}</option>';
        for (var id in countriesData) {
            if (countriesData.hasOwnProperty(id)) {
                countryOptionsHtml += '<option value="' + id + '"' + (id == defaultCountryId ? ' selected' : '') + '>' + countriesData[id] + '</option>';
            }
        }
        html = '<div class="removable-item work-location-item">' +
            '<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>' +
            '<div class="row align-items-end">' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("Country") }}</label>' +
            '<select class="form-select form-select-sm work-pref-country" name="work_location_preferences[' + idx + '][country_id]" data-index="' + idx + '">' + countryOptionsHtml + '</select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("State") }}</label>' +
            '<select class="form-select form-select-sm work-pref-state" name="work_location_preferences[' + idx + '][state_id]" data-index="' + idx + '"><option value="">{{ __("Select") }}</option></select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("City") }}</label>' +
            '<select class="form-select form-select-sm work-pref-city" name="work_location_preferences[' + idx + '][city_id]" data-index="' + idx + '"><option value="">{{ __("Select") }}</option></select></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("Locality") }}</label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][locality]" placeholder="{{ __("Locality") }}"></div>' +
            '</div></div>';
        document.getElementById('work-locations-container').insertAdjacentHTML('beforeend', html);
        if (defaultCountryId) {
            var newRow = document.getElementById('work-locations-container').lastElementChild;
            var stateSel = newRow ? newRow.querySelector('.work-pref-state') : null;
            if (stateSel) {
                fetch('{{ route("ajax.states-by-country") }}?country_id=' + defaultCountryId, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        var list = (data && data.data) ? data.data : (Array.isArray(data) ? data : []);
                        var h = '<option value="">{{ __("Select") }}</option>';
                        list.forEach(function(s) { if (s && s.id && s.id != 0) h += '<option value="' + s.id + '">' + (s.name || '') + '</option>'; });
                        stateSel.innerHTML = h;
                    })
                    .catch(function() {});
            }
        }
    } else {
        html = '<div class="removable-item work-location-item">' +
            '<button type="button" class="remove-item-btn" onclick="this.parentElement.remove()">×</button>' +
            '<div class="row align-items-end">' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("Country") }}</label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][country_name]" placeholder="{{ __("Country") }}"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("State") }}</label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][state_name]" placeholder="{{ __("State") }}"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("City") }}</label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][city_name]" placeholder="{{ __("City") }}"></div>' +
            '<div class="col-md-3 mb-2"><label class="form-label small">{{ __("Locality") }}</label>' +
            '<input type="text" class="form-control form-control-sm" name="work_location_preferences[' + idx + '][locality]" placeholder="{{ __("Locality") }}"></div>' +
            '</div></div>';
        document.getElementById('work-locations-container').insertAdjacentHTML('beforeend', html);
    }
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
                    if (typeof window.showDialogAlert === 'function') {
                        window.showDialogAlert('error', data.message || 'Failed to remove photo', 'Error');
                    } else {
                        alert(data.message || 'Failed to remove photo');
                    }
                }
            })
            .catch(function() {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('error', 'Something went wrong. Please try again.', 'Error');
                } else {
                    alert('Something went wrong. Please try again.');
                }
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

    // Record audio for Self Introduction
    (function() {
        var recordBtn = document.getElementById('record-audio-btn');
        var stopBtn = document.getElementById('stop-record-btn');
        var statusEl = document.getElementById('record-status');
        var audioInput = document.getElementById('introductory_audio_file');
        if (!recordBtn || !stopBtn || !audioInput) return;
        var mediaRecorder = null;
        var chunks = [];
        recordBtn.addEventListener('click', function() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('{{ __("Recording is not supported in your browser. Please use Chrome or Edge and allow microphone access.") }}');
                return;
            }
            navigator.mediaDevices.getUserMedia({ audio: true }).then(function(stream) {
                mediaRecorder = new MediaRecorder(stream);
                chunks = [];
                mediaRecorder.ondataavailable = function(e) { if (e.data.size) chunks.push(e.data); };
                mediaRecorder.onstop = function() {
                    stream.getTracks().forEach(function(t) { t.stop(); });
                    if (chunks.length) {
                        var blob = new Blob(chunks, { type: mediaRecorder.mimeType || 'audio/webm' });
                        if (blob.size > 1.5 * 1024 * 1024) {
                            alert('{{ __("Recording too large (max 1.5 MB). Please record a shorter clip.") }}');
                            return;
                        }
                        var file = new File([blob], 'intro_recording.webm', { type: blob.type });
                        var dt = new DataTransfer();
                        dt.items.add(file);
                        audioInput.files = dt.files;
                        statusEl.textContent = '{{ __("Recording saved. You can save the form to upload.") }}';
                    }
                };
                mediaRecorder.start();
                recordBtn.classList.add('d-none');
                stopBtn.classList.remove('d-none');
                statusEl.textContent = '{{ __("Recording...") }}';
            }).catch(function() {
                alert('{{ __("Microphone access denied. Please allow microphone access to record.") }}');
            });
        });
        stopBtn.addEventListener('click', function() {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
            }
            recordBtn.classList.remove('d-none');
            stopBtn.classList.add('d-none');
        });
    })();
});

// ==========================================
// Speech-to-Text for Bio Editor
// ==========================================
var speechRecognition = null;
var isSpeechActive = false;

function toggleSpeechToText() {
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        if (typeof window.showDialogAlert === 'function') {
            window.showDialogAlert('error', '{{ __("Speech-to-Text is not supported in your browser. Please use Chrome or Edge.") }}', 'Browser Not Supported');
        } else {
            alert('{{ __("Speech-to-Text is not supported in your browser. Please use Chrome or Edge.") }}');
        }
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
            if (typeof window.showDialogAlert === 'function') {
                window.showDialogAlert('error', '{{ __("Microphone access was denied. Please allow microphone access in your browser settings.") }}', 'Permission Denied');
            } else {
                alert('{{ __("Microphone access was denied. Please allow microphone access in your browser settings.") }}');
            }
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
        if (typeof window.showDialogAlert === 'function') {
            window.showDialogAlert('error', '{{ __("Could not start speech recognition. Please try again.") }}', 'Error');
        } else {
            alert('{{ __("Could not start speech recognition. Please try again.") }}');
        }
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
// Specialization/Subject Autocomplete (from DB: jb_specializations)
// ==========================================
var specializationsList = @json(isset($specializationsList) ? $specializationsList->pluck('name')->values() : []);

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

</script>
@endsection
