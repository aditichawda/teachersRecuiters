@php
    $layout = 'plugins/job-board::themes.dashboard.layouts.master';
@endphp

@extends($layout)

@section('content')
<style>
    .jp-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        padding: 28px;
        margin-bottom: 24px;
        overflow: visible; /* allow suggestion dropdowns to extend outside the card */
    }
    .jp-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
    }
    .jp-card-title i { color: #E32526; margin-right: 8px; }
    .jp-label { font-weight: 600; color: #333; margin-bottom: 6px; display: block; font-size: 14px; }
    .jp-label .required { color: #E32526; }
    .jp-label .hint { font-weight: 400; color: #888; font-size: 12px; margin-left: 4px; }
    .jp-input, .jp-select, .jp-textarea {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.2s;
        background: #fff;
    }
    .jp-input:focus, .jp-select:focus, .jp-textarea:focus {
        border-color: #E32526;
        outline: none;
        box-shadow: 0 0 0 3px rgba(227,37,38,0.08);
    }
    .jp-textarea { min-height: 120px; resize: vertical; }
    .jp-error { color: #E32526; font-size: 12px; margin-top: 4px; display: none; }
    .jp-error.show { display: block; }
    .jp-group { margin-bottom: 20px; }
    .jp-row { display: flex; gap: 20px; flex-wrap: wrap; }
    .jp-col-6 { flex: 0 0 calc(50% - 10px); max-width: calc(50% - 10px); }
    .jp-col-4 { flex: 0 0 calc(33.33% - 14px); max-width: calc(33.33% - 14px); }
    .jp-col-3 { flex: 0 0 calc(25% - 15px); max-width: calc(25% - 15px); }
    .jp-col-12 { flex: 0 0 100%; max-width: 100%; }
    @media (max-width: 768px) {
        .jp-col-6, .jp-col-4, .jp-col-3 { flex: 0 0 100%; max-width: 100%; }
    }

    /* Auto-suggest dropdown */
    .jp-suggest-wrap { position: relative; overflow: visible; }
    .jp-suggest-wrap.jp-suggest-open { z-index: 100000; }
    .jp-suggest-list {
        position: absolute; top: calc(100% + 4px); left: 0; right: 0;
        background: #fff; border: 1px solid #e0e0e0; border-radius: 8px;
        height: 240px;
        overflow-y: auto;
        z-index: 99999; /* keep above card sections and any overflow contexts */
        display: none;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        padding: 6px 0;
        min-height: 44px;
        font-size: 14px;
        line-height: 1.4;
    }
    /* IMPORTANT: show class must override display:none above */
    .jp-suggest-list.show { display: block !important; }
    .jp-suggest-item {
        padding: 10px 14px; cursor: pointer; font-size: 14px;
        border-bottom: 1px solid #f5f5f5;
    }
    .jp-suggest-item:hover, .jp-suggest-item.active { background: #fff5f5; color: #E32526; }

    /* Tag chips */
    .jp-tags-wrap { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px; }
    .jp-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: #FFF1F1; color: #E32526; border: 1px solid #E32526;
        border-radius: 20px; padding: 4px 12px; font-size: 13px;
    }
    .jp-tag .remove { cursor: pointer; font-weight: 700; font-size: 16px; line-height: 1; }

    /* Checkbox/Radio cards */
    .jp-option-cards { display: flex; flex-wrap: wrap; gap: 10px; }
    .jp-option-card {
        border: 2px solid #e0e0e0; border-radius: 10px; padding: 12px 20px;
        cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 8px;
        font-size: 14px; background: #fff;
    }
    .jp-option-card:hover { border-color: #E32526; background: #fff8f8; }
    .jp-option-card.selected { border-color: #E32526; background: #FFF1F1; color: #E32526; font-weight: 600; }
    .jp-option-card input { display: none; }

    /* Salary section */
    .jp-salary-type-tabs { display: flex; gap: 0; margin-bottom: 16px; }
    .jp-salary-tab {
        padding: 8px 20px; border: 1.5px solid #e0e0e0; cursor: pointer;
        font-size: 13px; background: #fff; transition: all 0.2s;
    }
    .jp-salary-tab:first-child { border-radius: 8px 0 0 8px; }
    .jp-salary-tab:last-child { border-radius: 0 8px 8px 0; }
    .jp-salary-tab.active { background: #E32526; color: #fff; border-color: #E32526; }

    /* Screening questions */
    .sq-item {
        background: #f9f9f9; border: 1px solid #e8e8e8; border-radius: 10px;
        padding: 20px; margin-bottom: 16px; position: relative;
    }
    .sq-remove {
        position: absolute; top: 10px; right: 10px;
        background: #E32526; color: #fff; border: none; border-radius: 50%;
        width: 28px; height: 28px; cursor: pointer; font-size: 14px;
        display: flex; align-items: center; justify-content: center;
    }
    .sq-type-options { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; }

    /* Apply type */
    .jp-apply-options { display: flex; gap: 12px; flex-wrap: wrap; }

    /* Submit button */
    .jp-submit-btn {
        background: #E32526; color: #fff; border: none; padding: 14px 40px;
        border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
        transition: all 0.2s;
    }
    .jp-submit-btn:hover { background: #c41e1f; transform: translateY(-1px); }
    .jp-submit-btn:disabled { background: #ccc; cursor: not-allowed; transform: none; }

    /* Hide salary checkbox */
    .jp-check-wrap { display: flex; align-items: center; gap: 8px; margin-top: 8px; }
    .jp-check-wrap input[type="checkbox"] { width: 18px; height: 18px; accent-color: #E32526; }

    /* AI button */
    .jp-ai-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff; border: none; padding: 6px 14px; border-radius: 6px;
        font-size: 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;
    }
    .jp-ai-btn:hover { opacity: 0.9; }

    /* Link to create company */
    .jp-create-link { color: #E32526; font-size: 13px; text-decoration: underline; cursor: pointer; }
    .jp-create-link:hover { color: #a81b1c; }

    .jp-institution-type-badge {
        display: inline-block; background: #f0f4ff; color: #4a6cf7;
        padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 500;
    }
    .jp-suggest-wrap {
    position: relative;
}

.jp-suggest-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 99999;
    
}
#job-city-suggestions {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 999999 !important;
    position: absolute !important;
}
.jp-card,
.jp-row,
.jp-group,
.tab-content,
.card,
.card-body {
    overflow: visible !important;
}
.jp-suggest-wrap {
    position: relative;
    transform: none !important;
}
.jp-suggest-wrap {
    position: relative;
    transform: none !important;
}
</style>

@if(!$canPost)
    <div class="alert alert-warning d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4" role="alert">
        <span>{{ trans('plugins/job-board::messages.insufficient_credits') }}</span>
        <a href="{{ route('public.account.wallet') }}" class="btn btn-sm btn-warning">{{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}</a>
    </div>
@endif

<form id="jobPostForm" method="POST" action="{{ route('public.account.jobs.store') }}" enctype="multipart/form-data" data-can-post="{{ $canPost ? '1' : '0' }}">
    @csrf

    {{-- ====== SECTION 1: Company & Job Title ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-building"></i> Company & Job Details</div>

        {{-- 1. Company Selection --}}
        <div class="jp-group">
            <label class="jp-label">Are you hiring for which school / institution? <span class="required">*</span></label>
            <select name="company_id" id="company_id" class="jp-select" required>
                <option value="">-- Select Company --</option>
                @foreach ($companies as $id => $name)
                    <option value="{{ $id }}" data-institution-type="{{ $companyInstitutionTypes[$id] ?? '' }}" {{ ((isset($defaultCompanyId) && $defaultCompanyId == $id) || (isset($job) && $job && $job->company_id == $id)) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Select company if already created.</small>
            <a href="{{ route('public.account.companies.create') }}" class="jp-create-link d-block mt-1">
                <i class="ti ti-plus"></i> Click here to create company / school
            </a>
            <div class="jp-error" id="err-company">Please select a company.</div>
        </div>

        {{-- 2. Institution Type (Auto from company) --}}
        <div class="jp-group">
            <label class="jp-label">Institution Type <span class="hint">(Auto-filled from company)</span></label>
            <div id="institution_type_display">
                <span class="jp-institution-type-badge" id="inst-type-badge">Select a company first</span>
            </div>
        </div>

        {{-- 3. Job Title (Auto-suggest) --}}
        <div class="jp-group">
            <label class="jp-label">Job Title <span class="required">*</span> <span class="hint">(Start typing to search)</span></label>
            <div class="jp-suggest-wrap">
                <input type="text" name="name" id="job_title" class="jp-input" placeholder="e.g. Primary English Teacher" required autocomplete="off">
                <div class="jp-suggest-list" id="job-title-suggestions"></div>
            </div>
            <div class="jp-error" id="err-title">Job title is required.</div>
        </div>

        {{-- 4. Detailed Job Description --}}
        <div class="jp-group">
            <label class="jp-label">
                Detailed Job Description <span class="required">*</span>
                <button type="button" class="jp-ai-btn ms-2" id="aiGenerateBtn" title="Generate description based on job title and institution">
                    <i class="ti ti-sparkles"></i> Generate with AI
                </button>
                <button type="button" class="jp-ai-btn jp-clear-btn ms-2" id="aiClearBtn" title="Clear AI-generated description">
                    <i class="ti ti-eraser"></i> Clear
                </button>
            </label>
            <textarea name="content" id="job_description" class="jp-textarea" rows="6" placeholder="Enter detailed job description or use AI to generate..." required></textarea>
            <div class="jp-error" id="err-description">Job description is required.</div>
        </div>

        {{-- 5. Required Skills (as per job title) --}}
        <div class="jp-group">
            <label class="jp-label">Required Skills <span class="hint">(Select multiple)</span></label>
            <div class="jp-suggest-wrap">
                <input type="text" id="skills_search" class="jp-input" placeholder="Search & add skills..." autocomplete="off">
                <div class="jp-suggest-list" id="skills-suggestions"></div>
            </div>
            <div class="jp-tags-wrap" id="selected-skills"></div>
            <div id="skills-hidden-inputs"></div>
        </div>

        {{-- 6. Job Type Category (Teaching / Non-Teaching) --}}
        <div class="jp-group">
            <label class="jp-label">Job Type <span class="required">*</span></label>
            <div class="jp-option-cards">
                <label class="jp-option-card" onclick="selectOption(this, 'job_type_category')">
                    <input type="radio" name="job_type_category" value="teaching" required>
                    <i class="ti ti-school"></i> Teaching
                </label>
                <label class="jp-option-card" onclick="selectOption(this, 'job_type_category')">
                    <input type="radio" name="job_type_category" value="non-teaching">
                    <i class="ti ti-briefcase"></i> Non-Teaching
                </label>
            </div>
            <div class="jp-error" id="err-job-type">Please select job type.</div>
        </div>
    </div>

    {{-- ====== SECTION 2: Salary ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-currency-rupee"></i> Salary Details</div>

        <div class="jp-group">
            <label class="jp-label">Salary Period <span class="required">*</span></label>
            <div class="jp-salary-type-tabs" id="salary-period-tabs">
                @foreach ($salaryRanges as $key => $label)
                    <div class="jp-salary-tab {{ $key === 'monthly' ? 'active' : '' }}" data-value="{{ $key }}" onclick="selectSalaryPeriod(this)">{{ $label }}</div>
                @endforeach
                <div class="jp-salary-tab" data-value="negotiable" onclick="selectSalaryPeriod(this)">Negotiable</div>
            </div>
            <input type="hidden" name="salary_range" id="salary_range" value="monthly">
        </div>

        <div id="salary-amount-section">
            <div class="jp-row">
                <div class="jp-col-4">
                    <div class="jp-group">
                        <label class="jp-label">Salary Type</label>
                        <div class="jp-option-cards">
                            <label class="jp-option-card selected" onclick="selectSalaryMode(this, 'range')">
                                <input type="radio" name="salary_mode" value="range" checked> Range
                            </label>
                            <label class="jp-option-card" onclick="selectSalaryMode(this, 'fixed')">
                                <input type="radio" name="salary_mode" value="fixed"> Fixed
                            </label>
                        </div>
                    </div>
                </div>
                <div class="jp-col-4">
                    <div class="jp-group">
                        <label class="jp-label">Salary From</label>
                        <input type="number" name="salary_from" id="salary_from" class="jp-input" placeholder="e.g. 25000">
                    </div>
                </div>
                <div class="jp-col-4" id="salary-to-wrap">
                    <div class="jp-group">
                        <label class="jp-label">Salary To</label>
                        <input type="number" name="salary_to" id="salary_to" class="jp-input" placeholder="e.g. 50000">
                    </div>
                </div>
            </div>
            <div class="jp-row">
                <div class="jp-col-6">
                    <div class="jp-group">
                        <label class="jp-label">Currency</label>
                        <select name="currency_id" class="jp-select">
                            @foreach ($currencies as $id => $title)
                                <option value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="jp-col-6">
                    <div class="jp-check-wrap">
                        <input type="checkbox" name="hide_salary" id="hide_salary" value="1">
                        <label for="hide_salary" style="cursor:pointer; font-size:14px;">Hide Salary on Job Posting</label>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="salary_type" id="salary_type" value="fixed">
    </div>

    {{-- ====== SECTION 3: Requirements ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-certificate"></i> Requirements</div>

        <div class="jp-row">
            {{-- 8. Required Qualification --}}
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Required Qualification Level <span class="required">*</span></label>
                    <select name="degree_level_id" id="degree_level_id" class="jp-select" required>
                        <option value="">-- Select --</option>
                        @foreach ($degreeLevels as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 10. Experience Required --}}
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Experience Required <span class="required">*</span></label>
                    <select name="job_experience_id" id="job_experience_id" class="jp-select" required>
                        <option value="">-- Select --</option>
                        @foreach ($jobExperiences as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- 9. Required Certifications --}}
        <div class="jp-group">
            <label class="jp-label">Required Teaching / Other Certifications <span class="hint">(Select multiple)</span></label>
            <div class="jp-suggest-wrap">
                <input type="text" id="cert_search" class="jp-input" placeholder="Search certifications..." autocomplete="off">
                <div class="jp-suggest-list" id="cert-suggestions"></div>
            </div>
            <div class="jp-tags-wrap" id="selected-certs"></div>
            <input type="hidden" name="required_certifications" id="required_certifications" value="">
        </div>

        {{-- 16. Language Proficiency --}}
        <div class="jp-group">
            <label class="jp-label">Language Proficiency Required <span class="hint">(Select multiple)</span></label>
            <div class="jp-suggest-wrap">
                <input type="text" id="lang_search" class="jp-input" placeholder="Search languages..." autocomplete="off">
                <div class="jp-suggest-list" id="lang-suggestions"></div>
            </div>
            <div class="jp-tags-wrap" id="selected-langs"></div>
            <input type="hidden" name="language_proficiency" id="language_proficiency" value="">
        </div>
    </div>

    {{-- ====== SECTION 4: Job Preferences ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-settings"></i> Job Preferences</div>

        <div class="jp-row">
            {{-- 11. Number of Positions --}}
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Number of Positions <span class="hint">(max. 10)</span></label>
                    <input type="number" name="number_of_positions" class="jp-input" value="1" min="1" max="10">
                </div>
            </div>

            {{-- 12. Gender Preference --}}
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Gender Preference</label>
                    <select name="gender_preference" class="jp-select">
                        <option value="">Any</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>

            {{-- 15. Marital Status --}}
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Marital Status Preference</label>
                    <select name="marital_status_preference" class="jp-select">
                        <option value="">Any</option>
                        <option value="married">Married</option>
                        <option value="single">Single</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="jp-row">
            {{-- 13. Job Shift --}}
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Job Shift</label>
                    <select name="job_shift_id" class="jp-select">
                        <option value="">-- Select --</option>
                        @foreach ($jobShifts as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 14. Employment Type --}}
            <div class="jp-col-4">
                <div class="jp-group">
                    <label class="jp-label">Employment Type</label>
                    <select name="jobTypes[]" id="employment_type" class="jp-select" multiple style="min-height: 44px;">
                        @foreach ($jobTypes as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                </div>
            </div>

            {{-- 18. Is Remote --}}
            <div class="jp-col-4">
                <div class="jp-group" style="padding-top: 28px;">
                    <div class="jp-check-wrap">
                        <input type="checkbox" name="is_remote" id="is_remote" value="1">
                        <label for="is_remote" style="cursor:pointer; font-size:14px;">This is a Remote / WFH / Online job</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ====== SECTION 5: Application Location ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-map-pin"></i> Application & Location</div>

        {{-- 14. Application accepted from which location --}}
        <div class="jp-group">
            <label class="jp-label">Application accepted from which location <span class="required">*</span></label>
            <div class="jp-option-cards">
                <label class="jp-option-card selected" onclick="selectOption(this, 'application_location_type')">
                    <input type="radio" name="application_location_type" value="nearby" checked>
                    <i class="ti ti-map-pin"></i> Nearby areas only
                </label>
                <label class="jp-option-card" onclick="selectOption(this, 'application_location_type')">
                    <input type="radio" name="application_location_type" value="specific">
                    <i class="ti ti-list"></i> Specific Locations (up to 3)
                </label>
                <label class="jp-option-card" onclick="selectOption(this, 'application_location_type')">
                    <input type="radio" name="application_location_type" value="anywhere">
                    <i class="ti ti-world"></i> Anywhere India
                </label>
            </div>
        </div>

        {{-- Specific Locations (show when specific is selected) --}}
        <div class="jp-group" id="specific-locations-wrap" style="display: none;">
            <label class="jp-label">Choose Locations <span class="hint">(up to 3)</span></label>
            <div class="jp-row">
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="1" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="2" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" class="jp-input app-location-input" placeholder="Search city..." data-index="3" autocomplete="off">
                        <div class="jp-suggest-list app-loc-suggest"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="application_locations" id="application_locations" value="">
        </div>

        {{-- 21. Job Location (auto from company) --}}
        <div class="jp-group">
            <label class="jp-label">Job Location / Address <span class="hint">(Auto-defined from company, editable)</span></label>
            <div class="jp-row">
                <div class="jp-col-6">
                    <input type="text" name="address" id="job_address" class="jp-input" placeholder="Address">
                </div>
                <div class="jp-col-6">
                    <input type="text" name="zip_code" id="job_zip_code" class="jp-input" placeholder="Pin Code">
                </div>
            </div>
            <div class="jp-row mt-2">
                <div class="jp-col-4">
                    <div class="jp-suggest-wrap">
                        <input type="text" id="job_city_search" class="jp-input" placeholder="Search city..." autocomplete="off">
                        <div class="jp-suggest-list" id="job-city-suggestions"></div>
                    </div>
                    <input type="hidden" name="city_id" id="job_city_id" value="">
                </div>
                <div class="jp-col-4">
                    <input type="text" id="job_state" class="jp-input" placeholder="State" readonly style="background:#f5f5f5;">
                    <input type="hidden" name="state_id" id="job_state_id" value="">
                </div>
                <div class="jp-col-4">
                    <input type="text" id="job_country" class="jp-input" placeholder="Country" readonly style="background:#f5f5f5;">
                    <input type="hidden" name="country_id" id="job_country_id" value="">
                </div>
            </div>
        </div>
    </div>

    {{-- ====== SECTION 6: Application Settings ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-send"></i> Application Settings</div>

        {{-- 17. Apply Type --}}
        <div class="jp-group">
            <label class="jp-label">Application received by <span class="required">*</span></label>
            <div class="jp-option-cards">
                <label class="jp-option-card selected" onclick="selectOption(this, 'apply_type')">
                    <input type="radio" name="apply_type" value="internal" checked>
                    <i class="ti ti-inbox"></i> Internal & Registered Email (Default)
                </label>
                <label class="jp-option-card" onclick="selectOption(this, 'apply_type')">
                    <input type="radio" name="apply_type" value="external">
                    <i class="ti ti-external-link"></i> External Link
                </label>
            </div>
        </div>

        {{-- External URL (show when external) --}}
        <div class="jp-group" id="external-url-wrap" style="display: none;">
            <label class="jp-label">External Apply URL</label>
            <input type="url" name="apply_url" id="apply_url" class="jp-input" placeholder="https://example.com/apply">
        </div>

        {{-- Internal emails (show when internal, up to 3) --}}
        <div class="jp-group" id="internal-emails-wrap">
            <label class="jp-label">Additional internal/registered emails <span class="hint">(optional, up to 3)</span></label>
            <div id="internal-emails-list">
                @php
                    $internalEmails = old('apply_internal_emails', []);
                    if (!is_array($internalEmails)) $internalEmails = $internalEmails ? [$internalEmails] : [];
                @endphp
                @foreach(array_slice($internalEmails, 0, 3) as $idx => $email)
                <div class="jp-internal-email-row" style="display:flex; gap:8px; margin-bottom:8px; align-items:center;">
                    <input type="email" name="apply_internal_emails[]" class="jp-input" placeholder="hiring@example.com" value="{{ is_string($email) ? $email : '' }}" style="flex:1;">
                    <button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-email" style="flex-shrink:0;" title="Remove"><i class="ti ti-x"></i></button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-internal-email-btn" style="border-radius:8px;">
                <i class="ti ti-plus"></i> Add email
            </button>
        </div>

        {{-- Internal phones (show when internal, up to 3) --}}
        <div class="jp-group" id="internal-phones-wrap">
            <label class="jp-label">Additional phone numbers to receive applications <span class="hint">(optional, up to 3)</span></label>
            <div id="internal-phones-list">
                @php
                    $internalPhones = old('apply_internal_phones', []);
                    if (!is_array($internalPhones)) $internalPhones = $internalPhones ? [$internalPhones] : [];
                @endphp
                @foreach(array_slice($internalPhones, 0, 3) as $idx => $phone)
                <div class="jp-internal-phone-row" style="display:flex; gap:8px; margin-bottom:8px; align-items:center;">
                    <input type="tel" name="apply_internal_phones[]" class="jp-input" placeholder="+91 9876543210" value="{{ is_string($phone) ? $phone : '' }}" style="flex:1;">
                    <button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-phone" style="flex-shrink:0;" title="Remove"><i class="ti ti-x"></i></button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-internal-phone-btn" style="border-radius:8px;">
                <i class="ti ti-plus"></i> Add phone
            </button>
        </div>

        <div class="jp-row">
            {{-- 19. Application Deadline --}}
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Application Deadline</label>
                    <input type="date" name="application_closing_date" class="jp-input" min="{{ date('Y-m-d') }}">
                </div>
            </div>
            {{-- Status --}}
            <div class="jp-col-6">
                <div class="jp-group">
                    <label class="jp-label">Job Status</label>
                    <select name="status" class="jp-select">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- 20. Hide Company Details --}}
        <div class="jp-group">
            <div class="jp-check-wrap">
                <input type="checkbox" name="hide_company" id="hide_company" value="1">
                <label for="hide_company" style="cursor:pointer; font-size:14px;"><i class="ti ti-eye-off" style="margin-right:4px;"></i> Hide my company details (Post as anonymously)</label>
            </div>
        </div>
    </div>

    {{-- ====== SECTION 7: Screening Questions (Select from Admin Pool) ====== --}}
    <div class="jp-card">
        <div class="jp-card-title"><i class="ti ti-clipboard-list"></i> {{ __('Job Screening Questions') }} <span class="hint" style="font-weight:400;font-size:13px;">({{ __('Select questions candidates will answer when applying') }})</span></div>

        <div id="screening-questions-container" class="mb-3">
            @forelse(($screeningQuestions ?? []) as $sq)
            <div class="sq-select-item" style="display:flex; align-items:flex-start; gap:12px; padding:14px; background:#f9f9f9; border-radius:10px; margin-bottom:10px; border:1px solid #e8e8e8;">
                <input type="checkbox" name="screening_question_ids[]" value="{{ $sq->id }}" id="sq_cb_{{ $sq->id }}" class="form-check-input mt-1">
                <label for="sq_cb_{{ $sq->id }}" style="flex:1; cursor:pointer; margin:0; font-size:14px;">
                    <strong>{{ $sq->question }}</strong>
                    @if($sq->is_required)
                    <span class="badge bg-danger ms-2" style="font-size:10px;">{{ __('Required') }}</span>
                    @endif
                    <span class="text-muted ms-2" style="font-size:12px;">({{ $sq->question_type }})</span>
                </label>
            </div>
            @empty
            <p class="text-muted small mb-0">{{ __('No screening questions available. Admin can add them in Job Board → Job Attributes → Screening Questions.') }}</p>
            @endforelse
        </div>
    </div>

    {{-- ====== SUBMIT ====== --}}
    <div class="jp-card" style="text-align: center;">
        <button type="submit" class="jp-submit-btn" id="submitJobBtn" @disabled(!$canPost)>
            <i class="ti ti-check"></i> Post Job
        </button>
        <a href="{{ route('public.account.jobs.index') }}" class="btn btn-outline-secondary ms-3" style="border-radius:8px; padding:12px 30px;">
            Cancel
        </a>
    </div>
</form>

{{-- Buy credits popup (shown when insufficient credits for Add email / Add phone) --}}
<div id="buy-credits-popup" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:12px; padding:24px; max-width:400px; margin:20px; box-shadow:0 4px 20px rgba(0,0,0,0.2);">
        <p id="buy-credits-popup-msg" class="mb-4" style="font-size:15px; color:#333;">{{ __('Insufficient credits. Please buy credits to use this feature.') }}</p>
        @php
            $creditsEnabledPopup = (bool) ($creditsEnabled ?? \Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem());
            $canRechargeWallet = $creditsEnabledPopup && (bool) ($canPost ?? false) && ((int) ($accountCredits ?? 0) <= 0);
        @endphp
        @if($creditsEnabledPopup)
            <div class="border rounded p-3 mb-3" style="background:#f8fafc;">
                <div class="mb-2" style="font-weight:600;">{{ __('Recharge Wallet') }}</div>
                <div class="d-flex gap-2 align-items-center">
                    <input
                        type="number"
                        min="100"
                        step="1"
                        class="form-control"
                        id="wallet-recharge-amount"
                        placeholder="{{ __('Enter amount (min ₹100)') }}"
                        style="max-width: 180px;"
                        @disabled(! $canRechargeWallet)
                    >
                    <form method="post" action="{{ route('public.account.wallet.recharge.start') }}" id="wallet-recharge-form" style="margin:0;">
                        @csrf
                        <input type="hidden" name="amount_inr" id="wallet-recharge-amount-hidden" value="">
                        <button type="submit" class="btn btn-success" id="wallet-recharge-btn" @disabled(! $canRechargeWallet)>
                            {{ __('Continue') }}
                        </button>
                    </form>
                </div>
                <div class="small mt-2" id="wallet-recharge-hint" style="color:#6b7280;">
                    @if(! $canPost)
                        {{ __('Wallet recharge is available only with an active hiring plan.') }}
                    @elseif(((int) ($accountCredits ?? 0)) > 0)
                        {{ __('Recharge is available when your wallet credits are exhausted.') }}
                    @else
                        {{ __('You will be redirected to Razorpay to complete the payment.') }}
                    @endif
                </div>
                <div class="small mt-1" style="color:#6b7280;">
                    {{ __('Wallet credits have unlimited validity and can be used with any active hiring plan.') }}
                </div>
                <div class="text-danger small mt-2" id="wallet-recharge-error" style="display:none;"></div>
            </div>
        @endif
        <div class="d-flex gap-2 justify-content-end">
            <button type="button" class="btn btn-secondary" id="buy-credits-popup-close">{{ __('Cancel') }}</button>
            <a href="{{ $walletUrl ?? route('public.account.wallet') }}" class="btn btn-primary" id="buy-credits-popup-wallet">{{ __('Buy credits') }}</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var walletUrl = '{{ $walletUrl ?? route("public.account.wallet") }}';
    var accountCredits = {{ (int) ($accountCredits ?? 0) }};
    var emailCreditsRequired = {{ (int) ($emailCreditsRequired ?? 100) }};
    var wpCreditsRequired = {{ (int) ($wpCreditsRequired ?? 10) }};
    var canRechargeWallet = {{ ($creditsEnabledPopup ?? false) && ($canPost ?? false) && ((int) ($accountCredits ?? 0) <= 0) ? 'true' : 'false' }};

    function showBuyCreditsPopup(msg) {
        var el = document.getElementById('buy-credits-popup');
        var msgEl = document.getElementById('buy-credits-popup-msg');
        if (el && msgEl) {
            msgEl.textContent = msg || '{{ __("Insufficient credits. Please buy credits from Wallet to use this feature.") }}';
            el.style.display = 'flex';
        }
    }
    function hideBuyCreditsPopup() {
        var el = document.getElementById('buy-credits-popup');
        if (el) el.style.display = 'none';
    }
    document.getElementById('buy-credits-popup-close')?.addEventListener('click', hideBuyCreditsPopup);
    document.getElementById('buy-credits-popup')?.addEventListener('click', function(e) {
        if (e.target === this) hideBuyCreditsPopup();
    });

    // Wallet recharge validation (min ₹100) and submit.
    var rechargeForm = document.getElementById('wallet-recharge-form');
    var rechargeAmount = document.getElementById('wallet-recharge-amount');
    var rechargeHidden = document.getElementById('wallet-recharge-amount-hidden');
    var rechargeError = document.getElementById('wallet-recharge-error');
    if (rechargeForm && rechargeAmount && rechargeHidden) {
        rechargeForm.addEventListener('submit', function(e) {
            if (!canRechargeWallet) return;
            var val = parseInt(rechargeAmount.value || '0', 10);
            if (!val || val < 100) {
                e.preventDefault();
                if (rechargeError) {
                    rechargeError.textContent = '{{ __("Minimum recharge amount is ₹100.") }}';
                    rechargeError.style.display = 'block';
                }
                rechargeAmount.focus();
                return;
            }
            if (rechargeError) rechargeError.style.display = 'none';
            rechargeHidden.value = String(val);
        });
    }

    // ===== JOB TITLES DATABASE =====
    const jobTitles = [
        'Primary English Teacher', 'Secondary Mathematics Teacher', 'School Principal',
        'Academic Coordinator', 'Higher Secondary Commerce Teacher', 'Primary Hindi Teacher',
        'Secondary Science Teacher', 'Secondary Social Studies Teacher', 'Physical Education Teacher',
        'Music Teacher', 'Art Teacher', 'Computer Science Teacher', 'Special Education Teacher',
        'Nursery Teacher', 'KG Teacher', 'Montessori Teacher', 'Librarian', 'Lab Assistant',
        'Administrative Officer', 'Accountant', 'Front Desk Executive', 'Counselor',
        'Vice Principal', 'Head of Department', 'Subject Matter Expert', 'Curriculum Designer',
        'Online Tutor', 'Academic Writer', 'Examination Controller', 'Hostel Warden',
        'Sports Coach', 'Dance Teacher', 'Sanskrit Teacher', 'French Teacher',
        'German Teacher', 'Biology Teacher', 'Chemistry Teacher', 'Physics Teacher',
        'Economics Teacher', 'Psychology Teacher', 'Sociology Teacher', 'Political Science Teacher',
        'History Teacher', 'Geography Teacher', 'Environmental Science Teacher',
        'Early Childhood Educator', 'Activity Teacher', 'Yoga Teacher',
        'IT Administrator', 'Transport Manager', 'Security Supervisor'
    ];

    // ===== CERTIFICATIONS DATABASE =====
    const certifications = [
        'B.Ed', 'M.Ed', 'NTT', 'Montessori Trained', 'ECCED', 'TET', 'CTET',
        'IB Teacher Certification', 'Cambridge Teacher Certification', 'D.El.Ed',
        'PGDM', 'PhD in Education', 'NET', 'SET', 'JRF', 'NCTE Approved',
        'CBSE Affiliation Training', 'ICSE Training Certification',
        'Special Education Certification', 'Counseling Certification',
        'Computer Teacher Certification', 'Yoga Teacher Certification'
    ];

    // ===== LANGUAGES (from jb_languages table) =====
    const languages = @json($languagesList ?? []);

    // ===== SKILLS (from DB) =====
    const allSkills = @json($skills);

    // ===== COMPANY DATA =====
    const companyData = @json($companyDetails);

    // ===== AUTO-SUGGEST HELPER =====
    function setupAutoSuggest(inputEl, listEl, items, onSelect, isObject = false) {
        function showList(val) {
            val = (val || '').toLowerCase().trim();
            listEl.innerHTML = '';
            let filtered;
            if (val.length < 1) {
                filtered = isObject ? Object.entries(items).slice(0, 15) : items.slice(0, 15);
            } else if (isObject) {
                filtered = Object.entries(items).filter(([id, name]) =>
                    name.toLowerCase().includes(val)
                ).slice(0, 15);
            } else {
                filtered = items.filter(i => i.toLowerCase().includes(val)).slice(0, 15);
            }
            if (filtered.length === 0) { listEl.classList.remove('show'); return; }
            filtered.forEach(item => {
                const div = document.createElement('div');
                div.className = 'jp-suggest-item';
                if (isObject) {
                    div.textContent = item[1];
                    div.dataset.id = item[0];
                } else {
                    div.textContent = item;
                }
                div.addEventListener('click', function() {
                    onSelect(isObject ? { id: this.dataset.id, name: this.textContent } : this.textContent);
                    inputEl.value = '';
                    listEl.classList.remove('show');
                });
                listEl.appendChild(div);
            });
            listEl.classList.add('show');
        }
        inputEl.addEventListener('input', function() { showList(this.value); });
        inputEl.addEventListener('focus', function() { showList(this.value); });
        inputEl.addEventListener('blur', function() {
            setTimeout(() => listEl.classList.remove('show'), 200);
        });
    }

    // ===== JOB TITLE AUTO-SUGGEST =====
    const titleInput = document.getElementById('job_title');
    const titleList = document.getElementById('job-title-suggestions');
    setupAutoSuggest(titleInput, titleList, jobTitles, function(title) {
        titleInput.value = title;
        autoSetJobType(title);
    });

    function autoSetJobType(title) {
        const nonTeachingKeywords = ['librarian', 'lab assistant', 'administrative', 'accountant',
            'front desk', 'counselor', 'it administrator', 'transport', 'security', 'hostel warden'];
        const lowerTitle = title.toLowerCase();
        const isNonTeaching = nonTeachingKeywords.some(k => lowerTitle.includes(k));

        document.querySelectorAll('input[name="job_type_category"]').forEach(radio => {
            const card = radio.closest('.jp-option-card');
            if (radio.value === (isNonTeaching ? 'non-teaching' : 'teaching')) {
                radio.checked = true;
                card.classList.add('selected');
            } else {
                radio.checked = false;
                card.classList.remove('selected');
            }
        });
    }

    // ===== SKILLS =====
    const selectedSkills = {};
    const skillsSearch = document.getElementById('skills_search');
    const skillsList = document.getElementById('skills-suggestions');

    setupAutoSuggest(skillsSearch, skillsList, allSkills, function(skill) {
        if (!selectedSkills[skill.id]) {
            selectedSkills[skill.id] = skill.name;
            renderSkillTags();
        }
    }, true);

    function renderSkillTags() {
        const container = document.getElementById('selected-skills');
        const hiddenContainer = document.getElementById('skills-hidden-inputs');
        container.innerHTML = '';
        hiddenContainer.innerHTML = '';
        Object.entries(selectedSkills).forEach(([id, name]) => {
            container.innerHTML += `<span class="jp-tag">${name} <span class="remove" onclick="removeSkill('${id}')">&times;</span></span>`;
            hiddenContainer.innerHTML += `<input type="hidden" name="skills[]" value="${id}">`;
        });
    }
    window.removeSkill = function(id) {
        delete selectedSkills[id];
        renderSkillTags();
    };

    // ===== CERTIFICATIONS =====
    const selectedCerts = [];
    const certSearch = document.getElementById('cert_search');
    const certList = document.getElementById('cert-suggestions');

    setupAutoSuggest(certSearch, certList, certifications, function(cert) {
        if (!selectedCerts.includes(cert)) {
            selectedCerts.push(cert);
            renderCertTags();
        }
    });

    function renderCertTags() {
        const container = document.getElementById('selected-certs');
        container.innerHTML = '';
        selectedCerts.forEach((cert, idx) => {
            container.innerHTML += `<span class="jp-tag">${cert} <span class="remove" onclick="removeCert(${idx})">&times;</span></span>`;
        });
        document.getElementById('required_certifications').value = JSON.stringify(selectedCerts);
    }
    window.removeCert = function(idx) {
        selectedCerts.splice(idx, 1);
        renderCertTags();
    };

    // ===== LANGUAGES =====
    const selectedLangs = [];
    const langSearch = document.getElementById('lang_search');
    const langList = document.getElementById('lang-suggestions');

    setupAutoSuggest(langSearch, langList, languages, function(lang) {
        if (!selectedLangs.includes(lang)) {
            selectedLangs.push(lang);
            renderLangTags();
        }
    });

    function renderLangTags() {
        const container = document.getElementById('selected-langs');
        container.innerHTML = '';
        selectedLangs.forEach((lang, idx) => {
            container.innerHTML += `<span class="jp-tag">${lang} <span class="remove" onclick="removeLang(${idx})">&times;</span></span>`;
        });
        document.getElementById('language_proficiency').value = JSON.stringify(selectedLangs);
    }
    window.removeLang = function(idx) {
        selectedLangs.splice(idx, 1);
        renderLangTags();
    };

    // ===== COMPANY SELECTION (and auto-fill Institution Type + location) =====
    const companySelectEl = document.getElementById('company_id');
    function applyCompanySelection() {
        const companyId = companySelectEl.value;
        const badge = document.getElementById('inst-type-badge');

        if (companyId && companyData[companyId]) {
            const data = companyData[companyId];
            badge.textContent = data.institution_type || 'Not specified';
            badge.style.background = data.institution_type ? '#e8f5e9' : '#fff3e0';
            badge.style.color = data.institution_type ? '#2e7d32' : '#e65100';

            // Auto-fill location from company
            if (data.address) document.getElementById('job_address').value = data.address;
            if (data.city_name) {
                document.getElementById('job_city_search').value = data.city_name;
                document.getElementById('job_city_id').value = data.city_id || '';
            }
            if (data.state_name) {
                document.getElementById('job_state').value = data.state_name;
                document.getElementById('job_state_id').value = data.state_id || '';
            }
            if (data.country_name) {
                document.getElementById('job_country').value = data.country_name;
                document.getElementById('job_country_id').value = data.country_id || '';
            }
            if (data.postal_code) document.getElementById('job_zip_code').value = data.postal_code;
        } else {
            badge.textContent = 'Select a company first';
            badge.style.background = '#f0f4ff';
            badge.style.color = '#4a6cf7';
        }
    }
    companySelectEl.addEventListener('change', applyCompanySelection);
    // On load: if a company is already selected (e.g. only one company), auto-fill Institution Type and location
    if (companySelectEl.value) {
        applyCompanySelection();
    }

    // ===== SALARY PERIOD =====
    window.selectSalaryPeriod = function(el) {
        document.querySelectorAll('.jp-salary-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        const val = el.dataset.value;

        if (val === 'negotiable') {
            document.getElementById('salary-amount-section').style.display = 'none';
            document.getElementById('salary_type').value = 'negotiable';
            document.getElementById('salary_range').value = 'monthly';
        } else {
            document.getElementById('salary-amount-section').style.display = 'block';
            document.getElementById('salary_type').value = 'fixed';
            document.getElementById('salary_range').value = val;
        }
    };

    // ===== SALARY MODE (Range/Fixed) =====
    window.selectSalaryMode = function(el, mode) {
        el.closest('.jp-option-cards').querySelectorAll('.jp-option-card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('salary-to-wrap').style.display = mode === 'fixed' ? 'none' : 'block';
    };

    // ===== RADIO/CHECKBOX OPTION CARDS =====
    window.selectOption = function(el, name) {
        const cards = el.closest('.jp-option-cards').querySelectorAll('.jp-option-card');
        cards.forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');
        el.querySelector('input').checked = true;

        // Handle conditional sections
        if (name === 'application_location_type') {
            const val = el.querySelector('input').value;
            document.getElementById('specific-locations-wrap').style.display = val === 'specific' ? 'block' : 'none';
        }
        if (name === 'apply_type') {
            const val = el.querySelector('input').value;
            document.getElementById('external-url-wrap').style.display = val === 'external' ? 'block' : 'none';
            document.getElementById('internal-emails-wrap').style.display = val === 'internal' ? 'block' : 'none';
        }
    };

    // ===== INTERNAL EMAILS (up to 3) – only add row after API deducts 100 credits; else show Buy credits popup =====
    document.getElementById('add-internal-email-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const list = document.getElementById('internal-emails-list');
        const rows = list.querySelectorAll('.jp-internal-email-row');
        if (rows.length >= 3) return;
        if (accountCredits < emailCreditsRequired) {
            showBuyCreditsPopup('{{ __("Insufficient credits. Need 100 credits (one-time) for additional email. Please buy credits from Wallet.") }}');
            return;
        }
        var btn = this;
        var deductUrl = '{{ route("public.account.jobs.deduct-additional-email") }}';
        if (!deductUrl) { showBuyCreditsPopup('{{ __("Action not available.") }}'); return; }
        btn.disabled = true;
        var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        fetch(deductUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({})
        })
        .then(function(r) { return r.json().catch(function() { return { success: false, message: 'Invalid response' }; }); })
        .then(function(data) {
            if (data && data.success === true) {
                var row = document.createElement('div');
                row.className = 'jp-internal-email-row';
                row.style.cssText = 'display:flex; gap:8px; margin-bottom:8px; align-items:center;';
                row.innerHTML = '<input type="email" name="apply_internal_emails[]" class="jp-input" placeholder="hiring@example.com" style="flex:1;">' +
                    '<button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-email" style="flex-shrink:0;" title="Remove"><i class="ti ti-x"></i></button>';
                list.appendChild(row);
                row.querySelector('.jp-remove-internal-email').addEventListener('click', function() { row.remove(); });
            } else {
                showBuyCreditsPopup(data && data.message ? data.message : '{{ __("Insufficient credits. Please buy credits from Wallet.") }}');
            }
        })
        .catch(function() { showBuyCreditsPopup('{{ __("Request failed. Please try again or buy credits from Wallet.") }}'); })
        .finally(function() { btn.disabled = false; });
    });
    document.getElementById('internal-emails-list')?.addEventListener('click', function(e) {
        if (e.target.closest('.jp-remove-internal-email')) e.target.closest('.jp-internal-email-row').remove();
    });

    // ===== INTERNAL PHONES (up to 3) – only add row after API deducts 10 credits; else show Buy credits popup =====
    document.getElementById('add-internal-phone-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const list = document.getElementById('internal-phones-list');
        const rows = list.querySelectorAll('.jp-internal-phone-row');
        if (rows.length >= 3) return;
        if (accountCredits < wpCreditsRequired) {
            showBuyCreditsPopup('{{ __("Insufficient credits. Need 10 credits per number for WhatsApp alerts. Please buy credits from Wallet.") }}');
            return;
        }
        var btn = this;
        var deductUrl = '{{ route("public.account.jobs.deduct-whatsapp-number") }}';
        if (!deductUrl) { showBuyCreditsPopup('{{ __("Action not available.") }}'); return; }
        btn.disabled = true;
        var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        fetch(deductUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify({})
        })
        .then(function(r) { return r.json().catch(function() { return { success: false, message: 'Invalid response' }; }); })
        .then(function(data) {
            if (data && data.success === true) {
                var row = document.createElement('div');
                row.className = 'jp-internal-phone-row';
                row.style.cssText = 'display:flex; gap:8px; margin-bottom:8px; align-items:center;';
                row.innerHTML = '<input type="tel" name="apply_internal_phones[]" class="jp-input" placeholder="+91 9876543210" style="flex:1;">' +
                    '<button type="button" class="btn btn-outline-danger btn-sm jp-remove-internal-phone" style="flex-shrink:0;" title="Remove"><i class="ti ti-x"></i></button>';
                list.appendChild(row);
                row.querySelector('.jp-remove-internal-phone').addEventListener('click', function() { row.remove(); });
            } else {
                showBuyCreditsPopup(data && data.message ? data.message : '{{ __("Insufficient credits. Please buy credits from Wallet.") }}');
            }
        })
        .catch(function() { showBuyCreditsPopup('{{ __("Request failed. Please try again or buy credits from Wallet.") }}'); })
        .finally(function() { btn.disabled = false; });
    });
    document.getElementById('internal-phones-list')?.addEventListener('click', function(e) {
        if (e.target.closest('.jp-remove-internal-phone')) e.target.closest('.jp-internal-phone-row').remove();
    });

    // ===== CITY SEARCH FOR JOB LOCATION (Registration-like) =====
    const cityInput = document.getElementById('job_city_search');
    const cityList = document.getElementById('job-city-suggestions');
    const cityIdEl = document.getElementById('job_city_id');
    const stateEl = document.getElementById('job_state');
    const stateIdEl = document.getElementById('job_state_id');
    const countryEl = document.getElementById('job_country');
    const countryIdEl = document.getElementById('job_country_id');
    let cityTimeout = null;

    function parseCityResults(res) {
        const raw = res && res.data;
        if (Array.isArray(raw)) return raw;
        if (raw && Array.isArray(raw.cities)) return raw.cities;
        if (raw && Array.isArray(raw.data)) return raw.data;
        return [];
    }

    function clearLocationFields() {
        if (cityIdEl) cityIdEl.value = '';
        if (stateEl) stateEl.value = '';
        if (stateIdEl) stateIdEl.value = '';
        if (countryEl) countryEl.value = '';
        if (countryIdEl) countryIdEl.value = '';
    }

    function openCityDropdown() {
        cityList.classList.add('show');
        cityList.style.display = 'block';
        cityInput.closest('.jp-suggest-wrap')?.classList.add('jp-suggest-open');
    }

    function closeCityDropdown() {
        cityList.classList.remove('show');
        cityList.style.display = 'none';
        cityInput.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
    }

    function renderCitySuggestions(list) {
    cityList.innerHTML = '';
    const wrap = cityInput.closest('.jp-suggest-wrap');

    if (!list || !list.length) {
        cityList.innerHTML = '<div class="jp-suggest-item">No cities found</div>';
        
        // 🔥 KEEP OPEN
        cityList.classList.add('show');
        wrap?.classList.add('jp-suggest-open');
        return;
    }

    list.forEach(city => {
        const div = document.createElement('div');
        div.className = 'jp-suggest-item';
        div.textContent = city.full_name || city.name;

        div.addEventListener('click', function() {
            cityInput.value = city.name;

            cityIdEl.value = city.id || '';
            stateEl.value = city.state_name || '';
            stateIdEl.value = city.state_id || '';
            countryEl.value = city.country_name || '';
            countryIdEl.value = city.country_id || '';

            cityList.classList.remove('show');
            wrap?.classList.remove('jp-suggest-open');
        });

        cityList.appendChild(div);
    });

    // 🔥 ALWAYS OPEN AFTER RENDER
    cityList.classList.add('show');
    wrap?.classList.add('jp-suggest-open');
}

    function loadCities(keyword) {
        const k = (keyword || '').trim();
        const url = '{{ route("ajax.search-cities") }}' + (k.length >= 2
            ? ('?k=' + encodeURIComponent(k))
            : '?default_country=1&page=1');

        // simple loading state
        cityList.innerHTML = '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;">Loading...</div>';
        openCityDropdown();

        fetch(url, {
            method: 'GET',
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(async (r) => {
                const text = await r.text();
                // Sometimes Laravel returns HTML error/login page; show a small snippet for debugging.
                let json = null;
                try {
                    json = JSON.parse(text);
                } catch (e) {
                    json = null;
                }

                if (!r.ok || !json) {
                    cityList.innerHTML =
                        '<div class="jp-suggest-item" style="cursor:default;color:#b91c1c;">City search failed (' + r.status + ')</div>' +
                        '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;white-space:normal;">' +
                        String(text || '').slice(0, 240) +
                        '</div>';
                    cityList.classList.add('show');
                    return null;
                }

                return json;
            })
            .then((res) => {
                if (!res) return;
                try {
                    renderCitySuggestions(parseCityResults(res));
                } catch (e) {
                    cityList.innerHTML =
                        '<div class="jp-suggest-item" style="cursor:default;color:#b91c1c;">Render error</div>' +
                        '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;white-space:normal;">' +
                        String(e && e.message ? e.message : e) +
                        '</div>';
                    cityList.classList.add('show');
                }
            })
            .catch((e) => {
                cityList.innerHTML =
                    '<div class="jp-suggest-item" style="cursor:default;color:#b91c1c;">Network error</div>' +
                    '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;white-space:normal;">' +
                    String(e && e.message ? e.message : e) +
                    '</div>';
                openCityDropdown();
            });
    }

    if (cityInput && cityList) {

        function forceOpenDropdown() {
            cityList.style.display = 'block';
            cityList.classList.add('show');
            cityInput.closest('.jp-suggest-wrap')?.classList.add('jp-suggest-open');
        }

        function forceCloseDropdown() {
            cityList.style.display = 'none';
            cityList.classList.remove('show');
            cityInput.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
        }

        let lastVal = '';

        setInterval(function () {
            const val = (cityInput.value || '').trim();

            if (val === lastVal) return;
            lastVal = val;

            // ❌ less than 2 → close
            if (val.length < 2) {
                forceCloseDropdown();
                return;
            }

            // ✅ ALWAYS OPEN
            cityList.innerHTML = '<div class="jp-suggest-item">Searching...</div>';
            forceOpenDropdown();

            loadCities(val);

        }, 200);

        // 🔥 REMOVE BLUR EFFECT COMPLETELY (IMPORTANT)
        cityInput.addEventListener('blur', function(e) {
            e.stopImmediatePropagation();
        }, true);

        // 🔥 Prevent outside click close (temporary test)
        document.addEventListener('click', function(e) {
            if (cityInput.closest('.jp-suggest-wrap').contains(e.target)) {
                forceOpenDropdown();
            }
        }, true);
    }

                document.addEventListener('click', function(e) {
                    const wrap = cityInput.closest('.jp-suggest-wrap');
                    if (wrap && !wrap.contains(e.target)) {
                        closeCityDropdown();
                    }
                });

                cityInput.addEventListener('blur', function() {
            setTimeout(() => {
                if (!cityList.matches(':hover')) {
                    cityList.classList.remove('show');
                    cityInput.closest('.jp-suggest-wrap')?.classList.remove('jp-suggest-open');
                }
            }, 200);
        });

        /**
         * Fallback: if some other script overrides/breaks input events,
         * keep dropdown behavior working by polling the input value.
         */
        (function cityDropdownPollFallback() {
            let lastVal = '';
            setInterval(function() {
                if (!document.body.contains(cityInput) || !document.body.contains(cityList)) return;
                const val = (cityInput.value || '').trim();
                if (val === lastVal) return;
                lastVal = val;

                // mark that poll is active
                cityList.setAttribute('data-city-poll', '1');

                if (!val.length) {
                    closeCityDropdown();
                    return;
                }

                if (val.length < 2) {
                    closeCityDropdown();
                    return;
                }

                cityList.innerHTML = '<div class="jp-suggest-item" style="cursor:default;color:#6b7280;">Searching...</div>';
                openCityDropdown();
                loadCities(val);
            }, 200);
        })();
    }

    // ===== APPLICATION LOCATION CITY SEARCH =====
    document.querySelectorAll('.app-location-input').forEach(function(input) {
        const suggest = input.closest('.jp-suggest-wrap').querySelector('.app-loc-suggest');
        let timer = null;

        input.addEventListener('input', function() {
            clearTimeout(timer);
            const val = this.value.trim();
            // Requirement: show results after 2 characters
            if (val.length < 2) { suggest.classList.remove('show'); return; }

            timer = setTimeout(() => {
                const url = '{{ route("ajax.search-cities") }}?k=' + encodeURIComponent(val);

                fetch(url, { headers: { 'Accept': 'application/json' } })
                    .then(r => r.json())
                    .then(res => {
                        const raw = res && res.data;
                        const data = Array.isArray(raw) ? raw : (raw && Array.isArray(raw.cities) ? raw.cities : []);
                        suggest.innerHTML = '';
                        if (!data.length) { suggest.classList.remove('show'); return; }
                        data.forEach(city => {
                            const div = document.createElement('div');
                            div.className = 'jp-suggest-item';
                            div.textContent = city.full_name || city.name;
                            div.addEventListener('click', function() {
                                input.value = city.name;
                                input.dataset.cityId = city.id;
                                suggest.classList.remove('show');
                                updateAppLocations();
                            });
                            suggest.appendChild(div);
                        });
                        suggest.classList.add('show');
                    });
            }, 200);
        });

        input.addEventListener('blur', function() {
            setTimeout(() => suggest.classList.remove('show'), 200);
        });
    });

    function updateAppLocations() {
        const locs = [];
        document.querySelectorAll('.app-location-input').forEach(input => {
            if (input.dataset.cityId) {
                locs.push({ city_id: input.dataset.cityId, name: input.value });
            }
        });
        document.getElementById('application_locations').value = JSON.stringify(locs);
    }

    // ===== AI GENERATE DESCRIPTION – only job title + institution name/type sent to AI =====
    document.getElementById('aiGenerateBtn')?.addEventListener('click', function() {
        const title = document.getElementById('job_title').value.trim();
        if (!title) { alert('Please enter a job title first.'); return; }

        var instTitle = '';
        var companySelect = document.getElementById('company_id');
        if (companySelect && companySelect.selectedOptions && companySelect.selectedOptions.length) {
            var opt = companySelect.selectedOptions[0];
            instTitle = (opt.getAttribute('data-institution-type') || opt.textContent || '').trim();
            if (!instTitle) { instTitle = opt.textContent ? opt.textContent.trim() : ''; }
        }

        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="ti ti-loader"></i> Generating...';

        const url = '{{ route("public.account.jobs.generate-description") }}';
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ title: title, institution_title: instTitle })
        })
        .then(function(res) { return res.json().then(function(data) { return { ok: res.ok, status: res.status, data: data }; }); })
        .then(function(result) {
            if (result.ok && result.data.success && result.data.description) {
                document.getElementById('job_description').value = result.data.description;
                if (result.data.fallback && result.data.api_error) {
                    console.warn('AI fallback used:', result.data.api_error);
                }
            } else {
                var msg = (result.data && result.data.message) ? result.data.message : 'Unable to generate description. Please try again or write it manually.';
                alert(msg);
            }
        })
        .catch(function() {
            alert('Network error. Please try again or write the description manually.');
        })
        .finally(function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="ti ti-sparkles"></i> Generate with AI';
        });
    });

    document.getElementById('aiClearBtn')?.addEventListener('click', function() {
        var descEl = document.getElementById('job_description');
        if (descEl) descEl.value = '';
    });

    // ===== FORM VALIDATION =====
    document.getElementById('jobPostForm')?.addEventListener('submit', function(e) {
        if (this.dataset.canPost === '0') {
            e.preventDefault();
            alert('{{ addslashes(trans('plugins/job-board::messages.insufficient_credits')) }}');
            return;
        }
        let valid = true;

        // Company
        if (!document.getElementById('company_id').value) {
            document.getElementById('err-company').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-company').classList.remove('show');
        }

        // Title
        if (!document.getElementById('job_title').value.trim()) {
            document.getElementById('err-title').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-title').classList.remove('show');
        }

        // Description
        if (!document.getElementById('job_description').value.trim()) {
            document.getElementById('err-description').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-description').classList.remove('show');
        }

        // Job type
        const jobTypeChecked = document.querySelector('input[name="job_type_category"]:checked');
        if (!jobTypeChecked) {
            document.getElementById('err-job-type').classList.add('show');
            valid = false;
        } else {
            document.getElementById('err-job-type').classList.remove('show');
        }

        if (!valid) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
});
</script>
@endsection
