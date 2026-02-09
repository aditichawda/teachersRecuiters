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
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }
    .emp-section-header i {
        margin-right: 10px;
    }
    .emp-section-body {
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
        transition: all 0.2s;
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
    
    /* Logo upload */
    .logo-upload-area {
        display: flex;
        align-items: center;
        gap: 20px;
    }
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
    .logo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Dynamic entries (awards, affiliations, team) */
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
    .dynamic-entry .btn-remove-entry:hover {
        background: #fee;
    }
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
    .btn-add-entry:hover {
        background: #e0efff;
    }
    
    /* TomSelect overrides */
    .ts-wrapper { margin-bottom: 0 !important; }
    .ts-control { border: 1.5px solid #e2e8f0 !important; border-radius: 8px !important; padding: 6px 10px !important; min-height: 42px !important; }
    .ts-control:focus, .ts-wrapper.focus .ts-control { border-color: #0073d1 !important; box-shadow: 0 0 0 3px rgba(0,115,209,0.1) !important; }
    
    @media (max-width: 768px) {
        .emp-section-body { padding: 15px; }
        .logo-upload-area { flex-direction: column; align-items: flex-start; }
    }
</style>

{{-- Validation Errors --}}
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

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success mb-4" style="border-radius: 10px;">
        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

<form id="employer-profile-form" action="{{ route('public.account.employer.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    {{-- ===== SECTION 1: Institution Logo ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-image"></i> {{ __('Institution Logo') }}
        </div>
        <div class="emp-section-body">
            <div class="logo-upload-area">
                <div class="logo-preview" id="logo-preview">
                    @if($company && $company->logo)
                        <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="Logo" id="logo-img">
                    @else
                        <i class="fa fa-camera" style="font-size: 24px; color: #ccc;"></i>
                    @endif
                </div>
                <div>
                    <input type="file" name="logo" id="logo-input" class="form-control" accept="image/*">
                    <small class="form-text text-muted">{{ __('Institution/School logo. Recommended: 200x200px. JPG, PNG. Max 2MB.') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 2: Your Details ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-user"></i> {{ __('Your Details') }}
        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- Full Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Full Name') }} <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $account->full_name ?? ($account->first_name . ' ' . $account->last_name)) }}" required placeholder="{{ __('Enter your full name') }}">
                </div>
                
                <!-- Account Email (read-only) -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Login Email') }}</label>
                    <input type="email" class="form-control" value="{{ $account->email }}" readonly disabled style="background: #f1f5f9;">
                    <small class="form-text text-muted">{{ __('This is your login email and cannot be changed here') }}</small>
                </div>
                
                <!-- Personal Mobile -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Mobile Number') }} <span class="required">*</span></label>
                    <input type="tel" name="account_phone" class="form-control" value="{{ old('account_phone', $account->phone ?? '') }}" required placeholder="{{ __('Enter your mobile number') }}">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 3: Institution Information ===== --}}
    @php
        $instType = old('institution_type', $company->institution_type ?? $account->institution_type ?? '');
    @endphp
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-building"></i> {{ __('Institution Information') }}
        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- School/Institution Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('School/Institution Name') }} <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? $account->institution_name ?? '') }}" required placeholder="{{ __('Enter institution name') }}">
                </div>
                
                <!-- Institution Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Type of Institution') }} <span class="required">*</span></label>
                    <select name="institution_type" id="institution_type" class="form-select" required>
                        <option value="">{{ __('Select type') }}</option>
                        <optgroup label="School">
                            <option value="cbse-school" @selected($instType == 'cbse-school')>CBSE School</option>
                            <option value="icse-school" @selected($instType == 'icse-school')>ICSE School</option>
                            <option value="cambridge-school" @selected($instType == 'cambridge-school')>Cambridge School</option>
                            <option value="ib-school" @selected($instType == 'ib-school')>IB School</option>
                            <option value="igcse-school" @selected($instType == 'igcse-school')>IGCSE School</option>
                            <option value="primary-school" @selected($instType == 'primary-school')>Primary School</option>
                            <option value="play-school" @selected($instType == 'play-school')>Play School</option>
                            <option value="state-board-school" @selected($instType == 'state-board-school')>State Board School</option>
                        </optgroup>
                        <optgroup label="College">
                            <option value="engineering-college" @selected($instType == 'engineering-college')>Engineering College</option>
                            <option value="medical-college" @selected($instType == 'medical-college')>Medical College</option>
                            <option value="nursing-college" @selected($instType == 'nursing-college')>Nursing College</option>
                            <option value="pharmacy-college" @selected($instType == 'pharmacy-college')>Pharmacy College</option>
                            <option value="science-college" @selected($instType == 'science-college')>Science College</option>
                            <option value="management-college" @selected($instType == 'management-college')>Management College</option>
                            <option value="degree-college" @selected($instType == 'degree-college')>Degree College</option>
                        </optgroup>
                        <optgroup label="Coaching Institute">
                            <option value="jee-neet-institute" @selected($instType == 'jee-neet-institute')>JEE & NEET Institute</option>
                            <option value="banking-institute" @selected($instType == 'banking-institute')>Banking Institute</option>
                            <option value="civil-services-institute" @selected($instType == 'civil-services-institute')>Civil Services Institute</option>
                            <option value="it-training-institute" @selected($instType == 'it-training-institute')>IT Training Institute</option>
                        </optgroup>
                        <optgroup label="EdTech & Online">
                            <option value="edtech-company" @selected($instType == 'edtech-company')>EdTech Company</option>
                            <option value="online-education-platform" @selected($instType == 'online-education-platform')>Online Education Platform</option>
                        </optgroup>
                        <optgroup label="University & Academy">
                            <option value="university" @selected($instType == 'university')>University</option>
                            <option value="sport-academy" @selected($instType == 'sport-academy')>Sport Academy</option>
                            <option value="music-academy" @selected($instType == 'music-academy')>Music Academy</option>
                        </optgroup>
                        <optgroup label="Other">
                            <option value="non-profit-organization" @selected($instType == 'non-profit-organization')>Non-Profit Organization</option>
                            <option value="book-publishing-company" @selected($instType == 'book-publishing-company')>Book Publishing Company</option>
                        </optgroup>
                    </select>
                </div>
                
                <!-- About Us -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('About Us') }} <span class="required">*</span></label>
                    <textarea name="description" class="form-control" rows="4" required placeholder="{{ __('Tell about your institution...') }}">{{ old('description', $company->description ?? '') }}</textarea>
                </div>
                
                <!-- Institution Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Institution Email') }} <span class="required">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? $account->email) }}" required placeholder="{{ __('contact@school.com') }}">
                    <small class="form-text text-muted">{{ __('This email will be used for job posting communications') }}</small>
                </div>
                
                <!-- Institution Phone -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Institution Phone') }} <span class="required">*</span></label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? $account->phone ?? '') }}" required placeholder="{{ __('Enter institution phone number') }}">
                </div>
                
                <!-- Website -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Website') }}</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}" placeholder="{{ __('https://www.yourschool.com') }}">
                </div>
                
                <!-- Established Year -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Established Year') }} <span class="required">*</span></label>
                    <input type="number" name="year_founded" class="form-control" value="{{ old('year_founded', $company->year_founded ?? '') }}" required min="1800" max="{{ date('Y') }}" placeholder="{{ __('e.g. 1995') }}">
                </div>
                
                <!-- Principal Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Principal Name') }}</label>
                    <input type="text" name="principal_name" class="form-control" value="{{ old('principal_name', $company->principal_name ?? '') }}" placeholder="{{ __('Enter principal/director name') }}">
                </div>
                
                <!-- Total Staff -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Total Number of Staff') }}</label>
                    <input type="number" name="total_staff" class="form-control" value="{{ old('total_staff', $company->total_staff ?? '') }}" min="0" max="999" placeholder="{{ __('e.g. 50') }}">
                    <small class="form-text text-muted">{{ __('Max 3 digits') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 4: Campus & Facilities ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-school"></i> {{ __('Campus & Facilities') }}
        </div>
        <div class="emp-section-body">
            <div class="row">
                <!-- Campus Type -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('Campus Type') }} <span class="required">*</span></label>
                    <select name="campus_type" class="form-select" required>
                        <option value="">{{ __('Select campus type') }}</option>
                        <option value="boarding" @selected(old('campus_type', $company->campus_type ?? '') == 'boarding')>{{ __('Boarding / Residential Campus') }}</option>
                        <option value="day" @selected(old('campus_type', $company->campus_type ?? '') == 'day')>{{ __('Non-Boarding / Day Campus') }}</option>
                        <option value="both" @selected(old('campus_type', $company->campus_type ?? '') == 'both')>{{ __('Both Boarding & Day Campus') }}</option>
                    </select>
                </div>
                
                <!-- Standard Level -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ __('School/Institution Standard Level') }} <span class="required">*</span></label>
                    @php $selectedLevels = old('standard_level', $company->standard_level ?? []); @endphp
                    <select id="ts-standard-level" name="standard_level[]" multiple placeholder="{{ __('Select levels...') }}">
                        @foreach(['pre_primary' => 'Pre-Primary', 'primary' => 'Primary', 'upper_primary' => 'Upper Primary', 'secondary' => 'Secondary', 'higher_secondary' => 'Higher Secondary', 'degree' => 'Degree College', 'post_graduate' => 'Post Graduate', 'research' => 'Research'] as $val => $lbl)
                            <option value="{{ $val }}" @selected(is_array($selectedLevels) && in_array($val, $selectedLevels))>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Staff Facilities -->
                <div class="col-12 mb-3">
                    <label class="form-label">{{ __('Facilities Available for Staff/Teacher') }} <span class="required">*</span></label>
                    @php $selectedFacilities = old('staff_facilities', $company->staff_facilities ?? []); @endphp
                    <select id="ts-staff-facilities" name="staff_facilities[]" multiple placeholder="{{ __('Select facilities...') }}">
                        @foreach(['residence' => 'Residence / Accommodation', 'food' => 'Food / Meals', 'electricity' => 'Electricity', 'pf' => 'Provident Fund (PF)', 'medical' => 'Medical / Health Insurance', 'transport' => 'Transport', 'child_education' => 'Children Education', 'gratuity' => 'Gratuity', 'bonus' => 'Annual Bonus', 'leave_encash' => 'Leave Encashment', 'wifi' => 'WiFi / Internet', 'library' => 'Library Access', 'gym' => 'Gym / Sports', 'professional_dev' => 'Professional Development'] as $val => $lbl)
                            <option value="{{ $val }}" @selected(is_array($selectedFacilities) && in_array($val, $selectedFacilities))>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 5: Location ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-map-marker-alt"></i> {{ __('Location') }}
        </div>
        <div class="emp-section-body">
            <div class="row">
                @php
                    $countries = [];
                    $states = [];
                    $cities = [];
                    if (is_plugin_active('location')) {
                        $countries = \Botble\Location\Models\Country::query()
                            ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->toArray();
                        if($company && $company->country_id) {
                            $states = \Botble\Location\Models\State::query()
                                ->where('country_id', $company->country_id)
                                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->toArray();
                        }
                        if($company && $company->state_id) {
                            $cities = \Botble\Location\Models\City::query()
                                ->where('state_id', $company->state_id)
                                ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->toArray();
                        }
                    }
                @endphp
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('Country') }} <span class="required">*</span></label>
                    <select name="country_id" id="emp-country" class="form-select" required>
                        <option value="">{{ __('Select Country') }}</option>
                        @foreach($countries as $id => $name)
                            <option value="{{ $id }}" @selected(old('country_id', $company->country_id ?? '') == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('State') }}</label>
                    <select name="state_id" id="emp-state" class="form-select">
                        <option value="">{{ __('Select State') }}</option>
                        @foreach($states as $id => $name)
                            <option value="{{ $id }}" @selected(old('state_id', $company->state_id ?? '') == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">{{ __('City') }}</label>
                    <select name="city_id" id="emp-city" class="form-select">
                        <option value="">{{ __('Select City') }}</option>
                        @foreach($cities as $id => $name)
                            <option value="{{ $id }}" @selected(old('city_id', $company->city_id ?? '') == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
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

    {{-- ===== SECTION 6: Social Links ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-share-alt"></i> {{ __('Social Links & Video') }}
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
                    <small class="form-text text-muted">{{ __('Add a YouTube video preview link for your institution') }}</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-google text-warning"></i> {{ __('Google') }}</label>
                    <input type="url" name="google" class="form-control" value="{{ old('google', $company->google ?? '') }}" placeholder="https://g.page/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-twitter text-info"></i> {{ __('Twitter') }}</label>
                    <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $company->twitter ?? '') }}" placeholder="https://twitter.com/...">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fab fa-instagram text-danger"></i> {{ __('Instagram') }}</label>
                    <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $company->instagram ?? '') }}" placeholder="https://instagram.com/...">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SECTION 7: Awards ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-trophy"></i> {{ __('Awards') }}
        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;">{{ __('Add awards received by your institution (max 5)') }}</p>
            <div id="awards-container">
                @php $awards = old('awards', $company->awards ?? []); @endphp
                @if(is_array($awards) && count($awards) > 0)
                    @foreach($awards as $i => $award)
                    <div class="dynamic-entry award-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
                        <div class="row">
                            <div class="col-md-5 mb-2">
                                <label class="form-label">{{ __('Award Title') }}</label>
                                <input type="text" name="awards[{{ $i }}][title]" class="form-control" value="{{ $award['title'] ?? '' }}" placeholder="{{ __('e.g. Best School Award') }}">
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

    {{-- ===== SECTION 8: Affiliations ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-handshake"></i> {{ __('Affiliations') }}
        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;">{{ __('Add affiliations and accreditations') }}</p>
            <div id="affiliations-container">
                @php $affiliations = old('affiliations', $company->affiliations ?? []); @endphp
                @if(is_array($affiliations) && count($affiliations) > 0)
                    @foreach($affiliations as $i => $aff)
                    <div class="dynamic-entry affiliation-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.affiliation-entry').remove();">✕</button>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ __('Affiliation Title') }}</label>
                                <input type="text" name="affiliations[{{ $i }}][title]" class="form-control" value="{{ $aff['title'] ?? '' }}" placeholder="{{ __('e.g. CBSE Affiliated') }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">{{ __('Certificate/Photo') }}</label>
                                <input type="file" name="affiliations_photos[{{ $i }}]" class="form-control" accept="image/*">
                                @if(!empty($aff['photo']))
                                    <small class="text-success">{{ __('Photo uploaded') }}</small>
                                    <input type="hidden" name="affiliations[{{ $i }}][photo]" value="{{ $aff['photo'] }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn-add-entry mt-2" onclick="addAffiliation()">
                <i class="fa fa-plus me-1"></i> {{ __('Add Affiliation') }}
            </button>
        </div>
    </div>

    {{-- ===== SECTION 9: Team Members ===== --}}
    <div class="emp-section mb-4">
        <div class="emp-section-header">
            <i class="fa fa-users"></i> {{ __('Team Members') }}
        </div>
        <div class="emp-section-body">
            <p class="text-muted mb-3" style="font-size: 13px;">{{ __('Add key team members with their details') }}</p>
            <div id="team-container">
                @php $teamMembers = old('team_members', $company->team_members ?? []); @endphp
                @if(is_array($teamMembers) && count($teamMembers) > 0)
                    @foreach($teamMembers as $i => $member)
                    <div class="dynamic-entry team-entry">
                        <button type="button" class="btn-remove-entry" onclick="this.closest('.team-entry').remove();">✕</button>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ __('Name') }}</label>
                                <input type="text" name="team_members[{{ $i }}][name]" class="form-control" value="{{ $member['name'] ?? '' }}" placeholder="{{ __('Full Name') }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ __('Designation') }}</label>
                                <input type="text" name="team_members[{{ $i }}][designation]" class="form-control" value="{{ $member['designation'] ?? '' }}" placeholder="{{ __('e.g. Vice Principal') }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label">{{ __('LinkedIn') }}</label>
                                <input type="url" name="team_members[{{ $i }}][linkedin]" class="form-control" value="{{ $member['linkedin'] ?? '' }}" placeholder="https://linkedin.com/in/...">
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn-add-entry mt-2" onclick="addTeamMember()">
                <i class="fa fa-plus me-1"></i> {{ __('Add Team Member') }}
            </button>
        </div>
    </div>

    {{-- ===== Save Button ===== --}}
    <div class="text-end mb-4">
        <button type="submit" class="btn-save-profile">
            <i class="fa fa-check me-2"></i>{{ __('Save Profile') }}
        </button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // TomSelect: Institution Type
    if (document.getElementById('institution_type')) {
        new TomSelect('#institution_type', {
            allowEmptyOption: true,
            maxItems: 1,
        });
    }

    // TomSelect: Standard Level
    if (document.getElementById('ts-standard-level')) {
        new TomSelect('#ts-standard-level', {
            plugins: ['remove_button'],
            maxItems: null,
        });
    }

    // TomSelect: Staff Facilities
    if (document.getElementById('ts-staff-facilities')) {
        new TomSelect('#ts-staff-facilities', {
            plugins: ['remove_button'],
            maxItems: null,
        });
    }

    // Logo preview
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

    // Country -> State -> City cascade
    const countrySelect = document.getElementById('emp-country');
    const stateSelect = document.getElementById('emp-state');
    const citySelect = document.getElementById('emp-city');

    if (countrySelect) {
        countrySelect.addEventListener('change', function() {
            const countryId = this.value;
            stateSelect.innerHTML = '<option value="">Loading...</option>';
            citySelect.innerHTML = '<option value="">{{ __("Select City") }}</option>';
            
            if (countryId) {
                fetch('{{ route("ajax.states-by-country") }}?country_id=' + countryId)
                    .then(r => r.json())
                    .then(data => {
                        let html = '<option value="">{{ __("Select State") }}</option>';
                        if (data.data) {
                            data.data.forEach(s => {
                                html += '<option value="' + s.id + '">' + s.name + '</option>';
                            });
                        }
                        stateSelect.innerHTML = html;
                    })
                    .catch(() => {
                        stateSelect.innerHTML = '<option value="">{{ __("Select State") }}</option>';
                    });
            }
        });
    }

    if (stateSelect) {
        stateSelect.addEventListener('change', function() {
            const stateId = this.value;
            citySelect.innerHTML = '<option value="">Loading...</option>';
            
            if (stateId) {
                fetch('{{ route("ajax.cities-by-state") }}?state_id=' + stateId)
                    .then(r => r.json())
                    .then(data => {
                        let html = '<option value="">{{ __("Select City") }}</option>';
                        if (data.data) {
                            data.data.forEach(c => {
                                html += '<option value="' + c.id + '">' + c.name + '</option>';
                            });
                        }
                        citySelect.innerHTML = html;
                    })
                    .catch(() => {
                        citySelect.innerHTML = '<option value="">{{ __("Select City") }}</option>';
                    });
            }
        });
    }
});

// Dynamic Awards
let awardIndex = {{ is_array($awards ?? []) ? count($awards ?? []) : 0 }};
function addAward() {
    const container = document.getElementById('awards-container');
    if (container.querySelectorAll('.award-entry').length >= 5) {
        alert('Maximum 5 awards allowed');
        return;
    }
    const html = `
        <div class="dynamic-entry award-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.award-entry').remove(); updateAwardCount();">✕</button>
            <div class="row">
                <div class="col-md-5 mb-2">
                    <label class="form-label">{{ __('Award Title') }}</label>
                    <input type="text" name="awards[${awardIndex}][title]" class="form-control" placeholder="{{ __('e.g. Best School Award') }}">
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
    const count = document.querySelectorAll('.award-entry').length;
    document.getElementById('award-count').textContent = count + '/5';
    if (count >= 5) document.getElementById('btn-add-award').style.display = 'none';
    else document.getElementById('btn-add-award').style.display = '';
}

// Dynamic Affiliations
let affIndex = {{ is_array($affiliations ?? []) ? count($affiliations ?? []) : 0 }};
function addAffiliation() {
    const container = document.getElementById('affiliations-container');
    const html = `
        <div class="dynamic-entry affiliation-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.affiliation-entry').remove();">✕</button>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">{{ __('Affiliation Title') }}</label>
                    <input type="text" name="affiliations[${affIndex}][title]" class="form-control" placeholder="{{ __('e.g. CBSE Affiliated') }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">{{ __('Certificate/Photo') }}</label>
                    <input type="file" name="affiliations_photos[${affIndex}]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    affIndex++;
}

// Dynamic Team Members
let teamIndex = {{ is_array($teamMembers ?? []) ? count($teamMembers ?? []) : 0 }};
function addTeamMember() {
    const container = document.getElementById('team-container');
    const html = `
        <div class="dynamic-entry team-entry">
            <button type="button" class="btn-remove-entry" onclick="this.closest('.team-entry').remove();">✕</button>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="team_members[${teamIndex}][name]" class="form-control" placeholder="{{ __('Full Name') }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('Designation') }}</label>
                    <input type="text" name="team_members[${teamIndex}][designation]" class="form-control" placeholder="{{ __('e.g. Vice Principal') }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label">{{ __('LinkedIn') }}</label>
                    <input type="url" name="team_members[${teamIndex}][linkedin]" class="form-control" placeholder="https://linkedin.com/in/...">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    teamIndex++;
}

</script>
@stop
