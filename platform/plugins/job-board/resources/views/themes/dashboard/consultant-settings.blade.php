@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .emp-section {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        overflow: visible;
    }
    .emp-section-header {
        display: flex;
        align-items: center;
        background: #0073d1;
        color: #fff;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }
    .emp-section-header .emp-section-icon {
        background: transparent;
        color: #fff;
        margin-right: 10px;
    }
    h5 { font-size: 15px; margin-top: 5px; }
    .emp-section-body { padding: 20px; }
    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
        font-size: 14px;
    }
    .form-label .required { color: #dc3545; }
    .form-control, .form-select {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 14px;
        height: 40px;
        font-size: 14px;
        transition: all 0.2s;
        background-color: #fff !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
    }
    .btn-save-profile {
        background: linear-gradient(135deg, #0073d1, #005bb5);
        color: #fff;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.2s;
    }
    .btn-save-profile:hover {
        background: linear-gradient(135deg, #005bb5, #003f8a);
        color: #fff;
        transform: translateY(-1px);
    }
    .logo-upload-area { display: flex; align-items: center; gap: 20px; }
    .logo-preview {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8f9fa;
    }
    .logo-preview img { width: 100%; height: 100%; object-fit: cover; }
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
    .field-help-icon:focus { background: #0073d1; color: #fff; outline: none; }
    .tooltip .tooltip-inner {
        max-width: 340px;
        min-width: 200px;
        padding: 12px 16px;
        font-size: 13px;
        line-height: 1.5;
        text-align: left;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .dynamic-entry {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 12px;
        position: relative;
    }
    .dynamic-entry .btn-remove-entry {
        position: absolute;
        top: 8px;
        right: 8px;
        background: none;
        border: none;
        color: #dc3545;
        font-size: 16px;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .dynamic-entry .btn-remove-entry:hover { background: #fee; }
    .btn-add-entry {
        background: #f0f7ff;
        color: #0073d1;
        border: 1px dashed #0073d1;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-add-entry:hover { background: #e0efff; }
    @media (max-width: 768px) {
        .emp-section-body { padding: 15px; }
        .logo-upload-area { flex-direction: column; align-items: flex-start; }
    }
</style>

@php
    /** @var \Botble\JobBoard\Models\Account $account */
    $account = auth('account')->user();
@endphp

<div class="emp-settings-header">
    <h2>{{ __('Consultant Profile') }}</h2>
    <a href="{{ route('public.account.dashboard') }}">{{ __('Dashboard') }} &rarr;</a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-4" style="border-radius: 10px;">
        <strong><i class="fa fa-exclamation-triangle me-2"></i>{{ __('Please fix the following errors:') }}</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success mb-4" style="border-radius: 10px;">
        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

<form id="employer-profile-form" action="{{ route('public.account.employer.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ===== SECTION 1: Organization Logo ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-image"></i></span>
            <h5>{{ __('Organization Logo') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Upload your consultancy logo to enhance credibility and brand visibility.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <div class="logo-upload-area">
                <div class="logo-preview" id="logo-preview">
                    @if($company && $company->logo)
                        <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="Logo" id="logo-img">
                    @else
                        <span class="text-muted">TR</span>
                    @endif
                </div>
                <div>
                    <input type="file" name="logo" id="logo-input" class="form-control" accept="image/jpeg,image/png,image/webp">
                    <small class="form-text text-muted">{{ __('Logo. Recommended: 200x200px. JPG, PNG. Max 2MB.') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 2: Profile Manage Details ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-user"></i></span>
            <h5>{{ __('Profile Manage Details') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Provide details of the authorized person managing this account.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <div class="row">
                <div class="col-md-6 mb-sm-3">
                    <label class="form-label">{{ __('Full Name') }} <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $account->full_name ?? ($account->first_name . ' ' . $account->last_name)) }}" required placeholder="{{ __('Enter your full name') }}">
                </div>

                <div class="col-md-6 mb-sm-3">
                    <label class="form-label">{{ __('Login Email') }}</label>
                    <input type="email" class="form-control" value="{{ $account->email }}" readonly disabled style="background: #f1f5f9;">
                    <small class="form-text text-muted">{{ __('This is your login email and cannot be changed here') }}</small>
                </div>

                <div class="col-md-6 mb-sm-3">
                    <label class="form-label">{{ __('Mobile Number') }} <span class="required">*</span></label>
                    <input type="tel" name="account_phone" class="form-control" value="{{ old('account_phone', $account->phone ?? '') }}" required placeholder="{{ __('Enter your mobile number') }}">
                </div>

                <div class="col-md-6 mb-sm-3">
                    <label class="form-label">{{ __('Designation') }}</label>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation', $account->designation ?? '') }}" placeholder="{{ __('e.g. HR Manager, Admin') }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 3: Organization Information  ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-building"></i></span>
            <h5>{{ __('Organization Information') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Share essential information about your consultancy to help candidates understand your services.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Organization/Consultancy Name') }} <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? $account->institution_name ?? '') }}" required placeholder="{{ __('Enter consultancy name') }}">
                </div>

                
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Organization Email') }} <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? $account->email) }}" required placeholder="{{ __('contact@consultancy.com') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Organization Phone') }} <span class="required">*</span></label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? $account->phone ?? '') }}" required placeholder="{{ __('Enter phone number') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Website') }}</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}" placeholder="{{ __('https://www.yourconsultancy.com') }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('About Consultancy') }} <span class="required">*</span></label>
                    <textarea name="description" class="form-control" rows="4" required placeholder="{{ __('Tell about your consultancy...') }}">{{ old('description', $company->description ?? '') }}</textarea>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== SECTION 4: Location ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-map-marker-alt"></i></span>
            <h5>{{ __('Location') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Provide accurate location details for better candidate reach and search visibility.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <div class="row">
                @php
                    $empCityName = old('city_search_display', $locationCityName ?? '');
                    $empStateName = old('state_display', $locationStateName ?? '');
                    $empCountryName = old('country_display', $locationCountryName ?? '');
                @endphp

                @if(is_plugin_active('location'))
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('City') }}</label>
                        <style>
                            /* Job Post-like dropdown */
                            .jp-suggest-wrap { position: relative; overflow: visible; }
                            .jp-suggest-wrap.jp-suggest-open { z-index: 100000; }
                            .jp-suggest-list {
                                position: absolute; top: calc(100% + 4px); left: 0; right: 0;
                                background: #fff; border: 1px solid #e0e0e0; border-radius: 8px;
                                max-height: 220px; overflow-y: auto;
                                z-index: 99999;
                                display: none;
                                box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                                padding: 6px 0;
                                min-height: 44px;
                                font-size: 14px;
                                line-height: 1.4;
                            }
                            .jp-suggest-list.show { display: block !important; }
                            .jp-suggest-item {
                                padding: 10px 14px; cursor: pointer; font-size: 14px;
                                border-bottom: 1px solid #f5f5f5;
                            }
                            .jp-suggest-item:last-child { border-bottom: none; }
                            .jp-suggest-item:hover, .jp-suggest-item.active { background: #fff5f5; color: #E32526; }
                            .jp-suggest-item .muted { display:block; font-size: 12px; color:#94a3b8; margin-top:2px; }
                        </style>

                        <div class="emp-city-wrapper" style="position:relative;">
                            <input type="text" id="emp-city-search" class="form-control" value="{{ $empCityName }}" placeholder="{{ __('Type city name to search...') }}" autocomplete="off">
                            <div id="emp-city-suggestions" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:1050; margin-top:2px; background:#fff; border:1px solid #dee2e6; border-radius:8px; max-height:220px; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.15);"></div>
                        </div>
                        <small class="text-muted">{{ __('Type city name to search. State and Country will auto-fill.') }}</small>
                        <input type="hidden" name="city_id" id="emp-city-id" value="{{ old('city_id', $company->city_id ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('State') }}</label>
                        <input type="text" id="emp-state-display" class="form-control" readonly value="{{ $empStateName }}" style="background:#f8f9fa;">
                        <input type="hidden" name="state_id" id="emp-state-id" value="{{ old('state_id', $company->state_id ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">{{ __('Country') }}</label>
                        <input type="text" id="emp-country-display" class="form-control" readonly value="{{ $empCountryName }}" style="background:#f8f9fa;">
                        <input type="hidden" name="country_id" id="emp-country-id" value="{{ old('country_id', $company->country_id ?? '') }}">
                    </div>
                @else
                    <input type="hidden" name="country_id" value="">
                    <input type="hidden" name="state_id" value="">
                    <input type="hidden" name="city_id" value="">
                    <div class="col-12 mb-3">
                        <p class="text-muted small">{{ __('Enable Location plugin for City / State / Country selection.') }}</p>
                    </div>
                @endif

                <div class="col-md-8 mb-3">
                    <label class="form-label">{{ __('Address') }} <span class="required">*</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $company->address ?? '') }}" required placeholder="{{ __('Full address') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Postal Code') }} <span class="required">*</span></label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $company->postal_code ?? '') }}" required placeholder="{{ __('e.g. 110001') }}" maxlength="10">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 5: Social Links & Video ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-share-alt"></i></span>
            <h5>{{ __('Social Links & Video') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Add your official social media profiles to strengthen your presence.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-facebook text-primary"></i> {{ __('Facebook') }}</label>
                    <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $company->facebook ?? '') }}" placeholder="https://facebook.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-linkedin text-info"></i> {{ __('LinkedIn') }}</label>
                    <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $company->linkedin ?? '') }}" placeholder="https://linkedin.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-youtube text-danger"></i> {{ __('YouTube') }}</label>
                    <input type="url" name="youtube_video" class="form-control" value="{{ old('youtube_video', $company->youtube_video ?? '') }}" placeholder="https://youtube.com/...">
                    <small class="form-text text-muted">{{ __('Add a YouTube video preview link') }}</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-instagram text-danger"></i> {{ __('Instagram') }}</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $company->instagram ?? '') }}" placeholder="https://instagram.com/...">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 6: Awards ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <span class="emp-section-icon blue"><i class="fa fa-trophy"></i></span>
            <h5>{{ __('Awards') }}</h5>
            <span class="field-help-icon ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover focus click" title="{{ __('Showcase awards and recognitions earned by your consultancy to build credibility and trust.') }}"><i class="fa fa-question-circle"></i></span>
        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;">{{ __('Add awards received by your consultancy (max 5)') }}</p>
            <div id="awards-container">
                @php $awards = old('awards', $company->awards ?? []); @endphp
                @if(is_array($awards) && count($awards) > 0)
                    @foreach($awards as $i => $award)
                    <div class="dynamic-entry award-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label class="form-label">{{ __('Award Title') }}</label>
                                <input type="text" name="awards[{{ $i }}][title]" class="form-control" value="{{ $award['title'] ?? '' }}" placeholder="{{ __('e.g. Best Consultancy Award') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">{{ __('Year') }}</label>
                                <input type="number" name="awards[{{ $i }}][year]" class="form-control" value="{{ $award['year'] ?? '' }}" min="1900" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ __('Photo') }}</label>
                                <input type="file" name="awards_photos[{{ $i }}]" class="form-control" accept="image/*">
                                @if(!empty($award['photo']))
                                    <small class="text-success">{{ __('Photo uploaded') }}</small>
                                    <input type="hidden" name="awards[{{ $i }}][photo]" value="{{ $award['photo'] }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn-add-entry mt-2" id="btn-add-award" onclick="addAward()">
                <i class="fa fa-plus me-1"></i> {{ __('Add Award') }}
            </button>
            <small class="form-text text-muted ms-2" id="award-count">{{ is_array($awards) ? count($awards) : 0 }}/5</small>
        </div>
    </div>

    <div class="text-end mb-4">
        <button type="submit" class="btn-save-profile">
            <i class="fa fa-check me-2"></i>{{ __('Save Profile') }}
        </button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (typeof bootstrap !== 'undefined' && tooltipEls.length) {
        tooltipEls.forEach(function(el) {
            new bootstrap.Tooltip(el, { trigger: 'hover focus click' });
        });
    }

    const logoInput = document.getElementById('logo-input');
    if (logoInput) {
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const preview = document.getElementById('logo-preview');
                    preview.innerHTML = '<img src="' + ev.target.result + '" alt="Logo" id="logo-img">';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    const empCitySearch = document.getElementById('emp-city-search');
    const empCitySuggestions = document.getElementById('emp-city-suggestions');
    const empCityId = document.getElementById('emp-city-id');
    const empStateId = document.getElementById('emp-state-id');
    const empCountryId = document.getElementById('emp-country-id');
    const empStateDisplay = document.getElementById('emp-state-display');
    const empCountryDisplay = document.getElementById('emp-country-display');

    function renderEmpCityItems(cities) {
        if (!cities || cities.length === 0) return '';
        let html = '';
        cities.forEach(function(c) {
            const parts = [];
            if (c.state_name) parts.push(c.state_name);
            if (c.country_name) parts.push(c.country_name);
            html += '<div class="emp-city-item jp-suggest-item" data-id="' + (c.id || '') + '" data-name="' + (c.name || '') + '" data-state-id="' + (c.state_id || '') + '" data-state-name="' + (c.state_name || '') + '" data-country-id="' + (c.country_id || '') + '" data-country-name="' + (c.country_name || '') + '">' +
                '<div style="font-weight:600;">' + (c.name || '') + '</div>' +
                (parts.length ? '<span class="muted">' + parts.join(', ') + '</span>' : '') +
                '</div>';
        });
        return html;
    }
    function selectEmpCity(el) {
        empCitySearch.value = el.getAttribute('data-name');
        if (empCityId) empCityId.value = el.getAttribute('data-id');
        if (empStateId) empStateId.value = el.getAttribute('data-state-id');
        if (empCountryId) empCountryId.value = el.getAttribute('data-country-id');
        if (empStateDisplay) empStateDisplay.value = el.getAttribute('data-state-name') || '';
        if (empCountryDisplay) empCountryDisplay.value = el.getAttribute('data-country-name') || '';
        empCitySuggestions.classList.remove('show');
        empCitySearch.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
    }
    function loadEmpCities(keyword, page) {
        page = page || 1;
        let url = '{{ route("ajax.search-cities") }}';
        if (keyword && keyword.length >= 2) {
            url += '?k=' + encodeURIComponent(keyword);
        } else {
            url += '?default_country=1&page=' + page;
        }
        empCitySuggestions.innerHTML = '<div class="p-2 text-muted">{{ __("Loading...") }}</div>';
        empCitySuggestions.classList.add('show');
        empCitySearch.closest('.jp-suggest-wrap')?.classList.add('jp-suggest-open');
        fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r) {
                if (!r.ok) return { data: [] };
                return r.json().catch(function() { return { data: [] }; });
            })
            .then(function(res) {
                const raw = res && res.data;
                const cities = Array.isArray(raw) ? raw : (raw && raw.cities ? raw.cities : []);
                if (cities.length === 0) {
                    empCitySuggestions.innerHTML = '<div class="p-2 text-muted">{{ __("No cities found. Add cities in Admin → Location → Cities.") }}</div>';
                    return;
                }
                empCitySuggestions.innerHTML = renderEmpCityItems(cities);
                empCitySuggestions.querySelectorAll('.emp-city-item').forEach(function(item) {
                    item.addEventListener('click', function() { selectEmpCity(this); });
                });
            })
            .catch(function() {
                empCitySuggestions.innerHTML = '<div class="p-2 text-muted">{{ __("Search unavailable. Please try again.") }}</div>';
            });
    }

    if (empCitySearch && empCitySuggestions) {
        let empSearchTimeout = null;
        empCitySearch.addEventListener('focus', function() {
            const k = this.value.trim();
            if (k.length >= 2) loadEmpCities(k);
            else loadEmpCities('', 1);
        });
        empCitySearch.addEventListener('input', function() {
            const k = this.value.trim();
            if (empSearchTimeout) clearTimeout(empSearchTimeout);
            if (empCityId) empCityId.value = '';
            if (empStateId) empStateId.value = '';
            if (empCountryId) empCountryId.value = '';
            if (empStateDisplay) empStateDisplay.value = '';
            if (empCountryDisplay) empCountryDisplay.value = '';
            empCitySuggestions.classList.remove('show');
            empCitySearch.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
            empCitySuggestions.innerHTML = '';
            if (k.length < 2) return;
            empSearchTimeout = setTimeout(function() { loadEmpCities(k); }, 300);
        });
        document.addEventListener('click', function(e) {
            const wrapper = document.querySelector('.emp-city-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                empCitySuggestions.classList.remove('show');
                empCitySearch.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
            }
        });
    }

    updateAwardCount();
});
// Dynamic Awards (Consultancy)
let awardIndex = {{ isset($awards) && is_array($awards) ? count($awards) : 0 }};
function addAward() {
    const container = document.getElementById('awards-container');
    if (!container) return;
    if (container.querySelectorAll('.award-entry').length >= 5) {
        alert('{{ __("Maximum 5 awards allowed") }}');
        return;
    }
    const html = `
        <div class="dynamic-entry award-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
            <div class="row">
                <div class="col-md-5 mb-2">
                    <label class="form-label">{{ __('Award Title') }}</label>
                    <input type="text" name="awards[${awardIndex}][title]" class="form-control" placeholder="{{ __('e.g. Best Consultancy Award') }}">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label">{{ __('Year') }}</label>
                    <input type="number" name="awards[${awardIndex}][year]" class="form-control" min="1900" max="{{ date('Y') }}" placeholder="{{ date('Y') }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('Photo') }}</label>
                    <input type="file" name="awards_photos[${awardIndex}]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    awardIndex++;
    updateAwardCount();
}
function updateAwardCount() {
    const container = document.getElementById('awards-container');
    if (!container) return;
    const count = container.querySelectorAll('.award-entry').length;
    const countEl = document.getElementById('award-count');
    const btn = document.getElementById('btn-add-award');
    if (countEl) countEl.textContent = count + '/5';
    if (btn) btn.style.display = count >= 5 ? 'none' : '';
}
</script>
@endsection

