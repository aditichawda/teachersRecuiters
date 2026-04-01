@php
    Theme::asset()->container('footer')->usePath()->add('candidates-js', 'js/candidates.js');
@endphp

<style>
/* Candidates Page Styles */
.candidates-main-section {
    padding: 40px 0 80px;
    background: #f8fafc;
}

.candidates-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.candidates-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
}
.candidates-heading p {
    font-size: 15px;
    color: #64748b;
}

/* Sidebar Filters */
.candidates-sidebar-modern .side-bar-filter {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 40px);
    display: flex;
    flex-direction: column;
}

.candidates-sidebar-modern .side-bar {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.candidates-sidebar-modern .filter-header {
    background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #bae6fd;
    flex-shrink: 0;
}

.candidates-sidebar-modern .filter-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #0c4a6e;
    display: flex;
    align-items: center;
    gap: 8px;
}

.candidates-sidebar-modern .filter-header .btn-clear-all {
    background: #fff;
    color: #0c4a6e;
    border: 1px solid #bae6fd;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.candidates-sidebar-modern .filter-header .btn-clear-all:hover {
    background: #0c4a6e;
    color: #fff;
}

.candidates-sidebar-modern .sidebar-elements {
    padding: 20px;
    overflow-y: auto;
    flex: 1;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e2e8f0;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter h4 {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.candidates-sidebar-modern .twm-sidebar-ele-filter h4 i {
    font-size: 16px;
    color: #0073d1;
}

.candidates-sidebar-modern .form-group {
    margin-bottom: 12px;
}

.candidates-sidebar-modern .form-control,
.candidates-sidebar-modern select,
.candidates-sidebar-modern input[type="text"],
.candidates-sidebar-modern input[type="number"] {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    transition: all 0.2s;
}

.candidates-sidebar-modern .form-control:focus,
.candidates-sidebar-modern select:focus,
.candidates-sidebar-modern input:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1);
    background: #fff;
}

.candidates-sidebar-modern .form-check {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.candidates-sidebar-modern .form-check-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.candidates-sidebar-modern .form-check-label {
    font-size: 13px;
    color: #475569;
    cursor: pointer;
    margin: 0;
}

.candidates-sidebar-modern .btn-apply-filter {
    width: 100%;
    background: #0073d1;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.candidates-sidebar-modern .btn-apply-filter:hover {
    background: #005ba3;
}

/* Toolbar */
.candidates-toolbar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}

.candidates-toolbar .result-count {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}

.candidates-toolbar .layout-switcher {
    display: flex;
    gap: 8px;
    align-items: center;
}

.candidates-toolbar .layout-btn {
    padding: 8px 12px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
    color: #64748b;
}

.candidates-toolbar .layout-btn.active {
    background: #0073d1;
    color: #fff;
    border-color: #0073d1;
}

.candidates-toolbar .btn-open-filter {
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 14px;
    border: none;
    transition: all .2s;
    display: none;
}

.candidates-toolbar .btn-open-filter:hover {
    background: #0284c7;
}

.candidates-listing-modern {
    position: relative;
}

.candidates-sidebar-modern .backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1040;
}

.candidates-sidebar-modern .side-bar-filter.active .backdrop {
    display: block;
}

@media(max-width: 991px) {
    .candidates-sidebar-modern .side-bar-filter {
        position: relative;
        top: 0;
        max-height: none;
    }
    .candidates-sidebar-modern .side-bar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 320px;
        height: 100vh;
        background: #fff;
        z-index: 1050;
        overflow-y: auto;
        transition: left 0.3s ease;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .candidates-sidebar-modern .side-bar-filter.active .side-bar {
        left: 0;
    }
    .candidates-toolbar .btn-open-filter {
        display: block;
    }
}

body.filter-open {
    overflow: hidden;
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">
        <div class="candidates-heading">
            <h2>{{ __('All Candidates') }}</h2>
            <p>{{ __('Browse and filter candidates to find the perfect match for your institution') }}</p>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="candidates-main-section">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filters --}}
            <div class="col-lg-3 col-md-12 candidates-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="filter-header">
                            <h3>
                                <i class="feather-filter"></i>
                                {{ __('Filters') }}
                            </h3>
                            <a href="{{ route('public.account.candidates') }}" class="btn-clear-all">
                                <i class="feather-x"></i>
                                {{ __('Clear All') }}
                            </a>
                        </div>
                        <div class="sidebar-elements">
                            <form action="{{ route('public.account.candidates') }}" method="get" id="candidates-filter-form">
                                {{-- Keyword or Teaching Subject or Post --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-search"></i> {{ __('Keyword / Subject / Post') }}</h4>
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="{{ __('Search by name, subject, or post...') }}" value="{{ request('keyword') }}" autocomplete="off">
                                    </div>
                                </div>

                                {{-- Location with radius --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-map-pin"></i> {{ __('Location') }}</h4>
                                    @if(is_plugin_active('location'))
                                        <div class="form-group">
                                            <select name="city_id" class="form-control">
                                                <option value="">{{ __('Select City') }}</option>
                                                @php
                                                    $cities = \Botble\Location\Models\City::where('status', 'published')
                                                        ->orderBy('name')
                                                        ->limit(100)
                                                        ->get();
                                                @endphp
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">{{ __('Radius (km)') }}</label>
                                            <input type="number" name="radius" class="form-control" placeholder="10" value="{{ request('radius') }}" min="1" max="100">
                                        </div>
                                    @endif
                                </div>

                                {{-- Last Updated --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-clock"></i> {{ __('Last Updated') }}</h4>
                                    <div class="form-group">
                                        <select name="last_updated" class="form-control">
                                            <option value="">{{ __('Any Time') }}</option>
                                            <option value="last_24_hours" {{ request('last_updated') == 'last_24_hours' ? 'selected' : '' }}>{{ __('Last 24 Hours') }}</option>
                                            <option value="last_7_days" {{ request('last_updated') == 'last_7_days' ? 'selected' : '' }}>{{ __('Last 7 Days') }}</option>
                                            <option value="last_30_days" {{ request('last_updated') == 'last_30_days' ? 'selected' : '' }}>{{ __('Last 30 Days') }}</option>
                                            <option value="last_3_months" {{ request('last_updated') == 'last_3_months' ? 'selected' : '' }}>{{ __('Last 3 Months') }}</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Looking for Position --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-briefcase"></i> {{ __('Position Type') }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="position_type[]" value="teaching" id="filter-teaching" {{ in_array('teaching', (array)request('position_type', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-teaching">{{ __('Teaching') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="position_type[]" value="non_teaching" id="filter-non-teaching" {{ in_array('non_teaching', (array)request('position_type', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-non-teaching">{{ __('Non-Teaching') }}</label>
                                    </div>
                                </div>

                                {{-- Gender --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-user"></i> {{ __('Gender') }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gender[]" value="male" id="filter-gender-male" {{ in_array('male', (array)request('gender', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-gender-male">{{ __('Male') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gender[]" value="female" id="filter-gender-female" {{ in_array('female', (array)request('gender', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-gender-female">{{ __('Female') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gender[]" value="other" id="filter-gender-other" {{ in_array('other', (array)request('gender', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-gender-other">{{ __('Other') }}</label>
                                    </div>
                                </div>

                                {{-- Marital Status --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-heart"></i> {{ __('Marital Status') }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="marital_status[]" value="single" id="filter-marital-single" {{ in_array('single', (array)request('marital_status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-marital-single">{{ __('Single') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="marital_status[]" value="married" id="filter-marital-married" {{ in_array('married', (array)request('marital_status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-marital-married">{{ __('Married') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="marital_status[]" value="divorced" id="filter-marital-divorced" {{ in_array('divorced', (array)request('marital_status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-marital-divorced">{{ __('Divorced') }}</label>
                                    </div>
                                </div>

                                {{-- Institution Type --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-building"></i> {{ __('Institution Type') }}</h4>
                                    @php
                                        $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
                                        $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
                                        $institutionTypeGroups = file_exists($pluginGroupsPath)
                                            ? include $pluginGroupsPath
                                            : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
                                        $selectedInstTypes = (array) request('institution_types', []);
                                    @endphp
                                    @foreach($institutionTypeGroups as $groupKey => $group)
                                        @foreach($group['options'] as $key => $label)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="institution_types[]" value="{{ $key }}" id="filter-inst-{{ Str::slug($key) }}" {{ in_array($key, $selectedInstTypes, true) || in_array(str_replace('-', '_', $key), $selectedInstTypes, true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="filter-inst-{{ Str::slug($key) }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>

                                {{-- Qualification Level --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-graduation-cap"></i> {{ __('Qualification Level') }}</h4>
                                    @php
                                        $qualLevels = [
                                            'diploma' => 'Diploma',
                                            'bachelors' => "Bachelor's",
                                            'masters' => "Master's",
                                            'phd' => 'PhD',
                                            'post_graduate' => 'Post Graduate'
                                        ];
                                        $selectedQuals = (array)request('qualification_levels', []);
                                    @endphp
                                    @foreach($qualLevels as $key => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="qualification_levels[]" value="{{ $key }}" id="filter-qual-{{ $key }}" {{ in_array($key, $selectedQuals) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="filter-qual-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Certifications --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-award"></i> {{ __('Certifications') }}</h4>
                                    @php
                                        $certs = [
                                            'b_ed' => 'B.Ed',
                                            'm_ed' => 'M.Ed',
                                            'ctet' => 'CTET',
                                            'tet' => 'TET',
                                            'net' => 'NET',
                                            'set' => 'SET',
                                            'phd' => 'PhD'
                                        ];
                                        $selectedCerts = (array)request('certifications', []);
                                    @endphp
                                    @foreach($certs as $key => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="certifications[]" value="{{ $key }}" id="filter-cert-{{ $key }}" {{ in_array($key, $selectedCerts) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="filter-cert-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Experience (Min to Max) --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-briefcase"></i> {{ __('Experience') }}</h4>
                                    <div class="form-group">
                                        <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">{{ __('Min (years)') }}</label>
                                        <input type="number" name="experience_min" class="form-control" placeholder="0" value="{{ request('experience_min') }}" min="0" max="50">
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">{{ __('Max (years)') }}</label>
                                        <input type="number" name="experience_max" class="form-control" placeholder="50" value="{{ request('experience_max') }}" min="0" max="50">
                                    </div>
                                </div>

                                {{-- Salary (Min to Max) --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-dollar-sign"></i> {{ __('Expected Salary') }}</h4>
                                    <div class="form-group">
                                        <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">{{ __('Min (₹)') }}</label>
                                        <input type="number" name="salary_min" class="form-control" placeholder="0" value="{{ request('salary_min') }}" min="0">
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size: 12px; color: #64748b; margin-bottom: 4px; display: block;">{{ __('Max (₹)') }}</label>
                                        <input type="number" name="salary_max" class="form-control" placeholder="1000000" value="{{ request('salary_max') }}" min="0">
                                    </div>
                                </div>

                                {{-- Languages Known --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-globe"></i> {{ __('Languages') }}</h4>
                                    @php
                                        $languages = ['English', 'Hindi', 'Marathi', 'Gujarati', 'Tamil', 'Telugu', 'Kannada', 'Malayalam', 'Bengali', 'Punjabi', 'Urdu'];
                                        $selectedLangs = (array)request('languages', []);
                                    @endphp
                                    @foreach($languages as $lang)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" value="{{ $lang }}" id="filter-lang-{{ strtolower($lang) }}" {{ in_array($lang, $selectedLangs) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="filter-lang-{{ strtolower($lang) }}">{{ $lang }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Current Status --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-check-circle"></i> {{ __('Current Status') }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="current_status[]" value="working" id="filter-status-working" {{ in_array('working', (array)request('current_status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-status-working">{{ __('Working Now') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="current_status[]" value="not_working" id="filter-status-not-working" {{ in_array('not_working', (array)request('current_status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-status-not-working">{{ __('Not Working') }}</label>
                                    </div>
                                </div>

                                {{-- Notice Period --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-calendar"></i> {{ __('Notice Period') }}</h4>
                                    @php
                                        $noticePeriods = [
                                            'immediate' => 'Immediate',
                                            '15_days' => '15 Days',
                                            '1_month' => '1 Month',
                                            '2_months' => '2 Months',
                                            '3_months' => '3 Months',
                                            'more_than_3_months' => 'More than 3 Months'
                                        ];
                                        $selectedNotice = (array)request('notice_period', []);
                                    @endphp
                                    @foreach($noticePeriods as $key => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="notice_period[]" value="{{ $key }}" id="filter-notice-{{ $key }}" {{ in_array($key, $selectedNotice) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="filter-notice-{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Immediate Joiner --}}
                                <div class="twm-sidebar-ele-filter">
                                    <h4><i class="feather-zap"></i> {{ __('Immediate Joiner') }}</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="immediate_joiner" value="1" id="filter-immediate-joiner" {{ request('immediate_joiner') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="filter-immediate-joiner">{{ __('Available for Immediate Joining') }}</label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-3">
                                    <button type="submit" class="btn-apply-filter">
                                        <i class="feather-check"></i>
                                        {{ __('Apply Filters') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Candidates Listings --}}
            <div class="col-lg-9 col-md-12 position-relative candidates-listing-modern">
                {{-- Toolbar --}}
                <div class="candidates-toolbar">
                    <div class="result-count">
                        @if($candidates && ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator))
                            @if($candidates->total() > 0)
                                {{ __('Showing') }} {{ number_format($candidates->firstItem()) }} - {{ number_format($candidates->lastItem()) }} {{ __('of') }} {{ number_format($candidates->total()) }} {{ __('candidates') }}
                            @else
                                {{ __('No candidates found') }}
                            @endif
                        @elseif($candidates && $candidates->count() > 0)
                            {{ __('Showing') }} {{ $candidates->count() }} {{ __('candidates') }}
                        @else
                            {{ __('No candidates found') }}
                        @endif
                    </div>
                    <div class="layout-switcher">
                        <a href="{{ request()->fullUrlWithQuery(['layout' => 'list']) }}" class="layout-btn {{ ($layout ?? 'list') == 'list' ? 'active' : '' }}" title="{{ __('List View') }}">
                            <i class="feather-list"></i>
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['layout' => 'grid']) }}" class="layout-btn {{ ($layout ?? 'list') == 'grid' ? 'active' : '' }}" title="{{ __('Grid View') }}">
                            <i class="feather-grid"></i>
                        </a>
                        <button type="button" class="btn-open-filter" onclick="toggleFilterSidebar()">
                            <i class="feather-filter"></i> {{ __('Filters') }}
                        </button>
                    </div>
                </div>

                {{-- Candidates List --}}
                <div id="candidates-listing-container" style="position: relative; min-height: 400px;">
                    {!! Theme::partial('loader', ['containerId' => 'candidates-loader-overlay', 'size' => 'large', 'text' => 'Loading candidates...']) !!}
                    <div id="candidates-content">
                        @if($candidates && ($candidates->count() > 0 || ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator && $candidates->total() > 0)))
                            @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'))
                        @else
                            <div class="text-center py-5" style="padding: 60px 20px;">
                                <i class="feather-users" style="font-size: 64px; color: #cbd5e1; margin-bottom: 20px;"></i>
                                <h3 style="color: #1e293b; font-size: 24px; font-weight: 600; margin-bottom: 12px;">{{ __('No Candidates Found') }}</h3>
                                <p style="color: #64748b; font-size: 16px; margin-bottom: 24px;">{{ __('Try adjusting your filters or check back later for new candidates.') }}</p>
                                @if(isset($totalJobSeekers, $publicJobSeekers, $eligibleJobSeekers))
                                    <div style="max-width: 520px; margin: 0 auto 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 16px; text-align: left;">
                                        <div style="font-size: 13px; color: #475569; font-weight: 600; margin-bottom: 8px;">{{ __('Data status (debug)') }}</div>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 13px; color: #64748b;">
                                            <div><strong style="color:#334155;">{{ __('Total job seekers') }}:</strong> {{ $totalJobSeekers }}</div>
                                            <div><strong style="color:#334155;">{{ __('Public profiles') }}:</strong> {{ $publicJobSeekers }}</div>
                                            <div style="grid-column: 1 / -1;"><strong style="color:#334155;">{{ __('Eligible for listing') }}:</strong> {{ $eligibleJobSeekers }}</div>
                                        </div>
                                        <div style="margin-top: 10px; font-size: 12px; color: #94a3b8;">
                                            {{ __('Candidates are listed only when account type is Job Seeker and profile is public.') }}
                                        </div>
                                    </div>
                                @endif
                                <a href="{{ route('public.account.candidates') }}" class="btn btn-primary" style="background: #0073d1; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none; display: inline-block;">
                                    <i class="feather-refresh-cw"></i> {{ __('Clear Filters') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Pagination --}}
                @if($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="row">
                        <div class="col-lg-12 mt-4 pt-2">
                            {!! $candidates->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleFilterSidebar() {
    const sidebar = document.querySelector('.candidates-sidebar-modern .side-bar-filter');
    if (sidebar) {
        sidebar.classList.toggle('active');
        document.body.classList.toggle('filter-open');
    }
}

// Close sidebar when clicking backdrop
document.addEventListener('DOMContentLoaded', function() {
    const backdrop = document.querySelector('.candidates-sidebar-modern .backdrop');
    if (backdrop) {
        backdrop.addEventListener('click', function() {
            toggleFilterSidebar();
        });
    }
});
</script>
