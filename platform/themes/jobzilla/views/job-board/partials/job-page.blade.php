@php
    Theme::asset()->usePath()->add('leaflet-markercluster-css', 'plugins/leaflet.markercluster/MarkerCluster.css');
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::asset()->container('footer')->usePath()->add('leaflet-markercluster-js', 'plugins/leaflet.markercluster/leaflet.markercluster.js');
    Theme::asset()->container('footer')->usePath()->add('jobs-js', 'js/jobs.js', ['leaflet-js', 'leaflet-markercluster-js'], [], get_cms_version());
    Theme::set('pageTitle', $page->name);
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    $layout = \Theme\Jobzilla\Supports\ThemeHelper::getCurrentLayout();
@endphp

{{-- Shared Job Card Styles --}}
{!! Theme::partial('jobs-card-styles') !!}

{{-- Jobs Page Specific Styles --}}
<style>
/* ===== Hero Section ===== */
.jobs-hero {
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}
.jobs-hero::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -120px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(0,115,209,.12) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.jobs-hero::after {
    content: '';
    position: absolute;
    bottom: -60px;
    left: -80px;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(0,115,209,.08) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.jobs-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0,115,209,.1);
    border: 1px solid rgba(0,115,209,.15);
    color: #0073d1;
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 14px;
}
.jobs-hero h1 {
    font-size: 38px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 10px;
    line-height: 1.2;
}
.jobs-hero p {
    font-size: 16px;
    color: #475569;
    margin-bottom: 0;
}
.jobs-hero-stats {
    display: flex;
    gap: 30px;
    margin-top: 22px;
}
.jobs-hero-stat {
    text-align: center;
}
.jobs-hero-stat .stat-num {
    display: block;
    font-size: 24px;
    font-weight: 800;
    color: #0073d1;
}
.jobs-hero-stat .stat-label {
    font-size: 12px;
    color: #64748b;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .5px;
}

/* ===== Main Content ===== */
.jobs-main-section {
    padding: 40px 0 80px;
    background: #f8fafc;
}

/* ===== Sidebar ===== */
.jobs-sidebar-modern .side-bar-filter {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.jobs-sidebar-modern .sidebar-elements {
    padding: 24px;
}
.jobs-sidebar-modern .form-group {
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid #f1f5f9;
}
.jobs-sidebar-modern .form-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.jobs-sidebar-modern .section-head-small {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 14px !important;
}
.jobs-sidebar-modern .input-group {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: all .2s;
}
.jobs-sidebar-modern .input-group:focus-within {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1);
}
.jobs-sidebar-modern .input-group .form-control {
    border: none;
    padding: 10px 14px;
    font-size: 14px;
    background: #fff;
}
.jobs-sidebar-modern .input-group .form-control:focus {
    box-shadow: none;
}
.jobs-sidebar-modern .input-group .btn {
    background: transparent;
    border: none;
    color: #64748b;
    padding: 0 12px;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.jobs-sidebar-modern .twm-sidebar-ele-filter li {
    margin-bottom: 8px;
}
.jobs-sidebar-modern .form-check-input {
    border-radius: 4px;
    border-color: #cbd5e1;
    width: 18px;
    height: 18px;
}
.jobs-sidebar-modern .form-check-input:checked {
    background-color: #0073d1;
    border-color: #0073d1;
}
.jobs-sidebar-modern .form-check-label {
    font-size: 14px;
    color: #475569;
    padding-left: 4px;
}

/* ===== Toolbar ===== */
.jobs-toolbar {
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
.jobs-toolbar .woocommerce-result-count-left {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}
.jobs-toolbar .woocommerce-ordering {
    display: flex;
    gap: 8px;
    align-items: center;
}
.jobs-toolbar .wt-select-bar-2,
.jobs-toolbar .selectpicker,
.jobs-toolbar select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 7px 12px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    cursor: pointer;
    transition: all .2s;
    -webkit-appearance: auto;
}
.jobs-toolbar select:focus {
    border-color: #0073d1;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,.1);
}
.btn-open-filter {
    background: #0073d1;
    color: #fff;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 14px;
    border: none;
    transition: all .2s;
}
.btn-open-filter:hover {
    background: #0284c7;
    color: #fff;
}

/* ===== Modern Pagination ===== */
.jobs-main-section .pagination-outer {
    margin-top: 30px;
}
.jobs-main-section .pagination-style1 .pagination {
    display: flex;
    gap: 6px;
    justify-content: center;
    flex-wrap: wrap;
}
.jobs-main-section .pagination-style1 .pagination li a,
.jobs-main-section .pagination-style1 .pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    background: #fff;
    border: 1px solid #e2e8f0;
    text-decoration: none;
    transition: all .25s;
}
.jobs-main-section .pagination-style1 .pagination li.active a {
    background: linear-gradient(135deg, #0073d1, #0073d1);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(0,115,209,.3);
}
.jobs-main-section .pagination-style1 .pagination li:not(.disabled):not(.active) a:hover {
    background: #f0f9ff;
    border-color: #bae6fd;
    color: #0073d1;
}

/* ===== Loading Spinner ===== */
.loading {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(248,250,252,.8);
    z-index: 10;
    display: none;
    border-radius: 12px;
}
.loading .spinner {
    width: 36px;
    height: 36px;
    border: 3px solid #e2e8f0;
    border-top-color: #0073d1;
    border-radius: 50%;
    animation: spin .6s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .jobs-hero { padding: 90px 0 40px; }
    .jobs-hero h1 { font-size: 28px; }
    .jobs-hero p { font-size: 14px; }
    .jobs-hero-stats { gap: 20px; }
    .jobs-hero-stat .stat-num { font-size: 20px; }
    .jobs-toolbar { padding: 12px 16px; }
}
@media(max-width: 767px) {
    .jobs-hero { padding: 80px 15px 30px; }
    .jobs-hero h1 { font-size: 24px; }
    .jobs-hero-stats { gap: 16px; }
    .jobs-hero-stat .stat-num { font-size: 18px; }
    .jobs-hero-stat .stat-label { font-size: 11px; }
    .jobs-main-section { padding: 25px 0 50px; }
    .jobs-toolbar { flex-direction: column; align-items: flex-start; }
}
@media(max-width: 480px) {
    .jobs-hero { padding: 75px 10px 25px; }
    .jobs-hero h1 { font-size: 22px; }
    .jobs-hero-badge { font-size: 12px; padding: 5px 12px; }
    .jobs-hero-stats { flex-wrap: wrap; gap: 12px; }
}
</style>

{{-- Hero Section --}}
<section class="jobs-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="jobs-hero-badge">
                    <i class="feather-briefcase"></i> {{ __('Find Your Dream Teaching Job') }}
                </span>
                <h1>{{ $page->name ?? __('Browse Jobs') }}</h1>
                <p>{{ __('Discover thousands of verified teaching opportunities across India. Filter by location, subject, experience and more.') }}</p>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="jobs-hero-stats">
                    <div class="jobs-hero-stat">
                        <span class="stat-num">10K+</span>
                        <span class="stat-label">{{ __('Active Jobs') }}</span>
                    </div>
                    <div class="jobs-hero-stat">
                        <span class="stat-num">5K+</span>
                        <span class="stat-label">{{ __('Schools') }}</span>
                    </div>
                    <div class="jobs-hero-stat">
                        <span class="stat-num">50K+</span>
                        <span class="stat-label">{{ __('Teachers') }}</span>
                    </div>
                    <div class="jobs-hero-stat">
                        <span class="stat-num">28</span>
                        <span class="stat-label">{{ __('States') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Main Content --}}
<div class="jobs-main-section jobs-container">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filters --}}
            <div class="col-lg-4 col-md-12 jobs-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter">
                                <i class="feather-x"></i>
                            </button>
                            <form action="{{ $page->url }}" method="get" id="jobs-filter-form" data-ajax-url="{{ route('public.ajax.jobs') }}">
                                {!! Theme::partial('jobs.filters.keyword') !!}

                                @if (! isset($type) || $type !== 'category')
                                    {!! Theme::partial('jobs.filters.categories') !!}
                                @endif

                                {!! Theme::partial('jobs.filters.city') !!}
                                {!! Theme::partial('jobs.filters.types') !!}
                                {!! Theme::partial('jobs.filters.date_posted') !!}
                                {!! Theme::partial('jobs.filters.experiences') !!}
                                {!! Theme::partial('jobs.filters.skills') !!}
                            </form>
                        </div>
                    </div>
                </div>
                {!! dynamic_sidebar('job_board_sidebar') !!}
            </div>

            {{-- Job Listings --}}
            <div class="col-lg-8 col-md-12 position-relative jobs-listing-modern">
                <div class="jobs-toolbar product-filter-wrap">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button type="submit" class="d-block d-md-none btn btn-open-filter">
                            <i class="feather-filter"></i>
                        </button>
                        <span class="woocommerce-result-count-left">
                        @if ($jobs->total())
                                {{ __('Showing :from – :to of :total results', [
                                    'from' => $jobs->firstItem(),
                                    'to' => $jobs->lastItem(),
                                    'total' => $jobs->total(),
                                ]) }}
                            @endif
                    </span>
                    </div>

                    <div class="woocommerce-ordering twm-filter-select gap-1">
                        <select class="wt-select-bar-2 selectpicker" name="sort_by">
                            @foreach(JobBoardHelper::getSortByParams() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker" name="per_page">
                            @foreach(JobBoardHelper::getPerPageParams() as $item)
                                <option value="{{ $item }}">{{ __('Show :number', ['number' => $item]) }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker" name="layout">
                            @foreach(\Theme\Jobzilla\Supports\ThemeHelper::getLayouts() as $key => $value)
                                <option value="{{ $key }}" @selected(request()->query('layout') === $key)>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="loading">
                    <div class="loading__inner">
                        <div class="loading__content">
                            <span class="spinner"></span>
                        </div>
                    </div>
                </div>

                <div class="twm-jobs-list-wrap jobs-listing">
                    {!! Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]) !!}
                </div>

                <div id="map" style="display: none" data-center="{{ json_encode(JobBoardHelper::getMapCenterLatLng()) }}"></div>

                <div class="job-board-street-map-container">
                    @foreach($jobs as $job)
                        <div
                            class="job-board-street-map"
                            data-job="{{ $job }}"
                            data-map-icon="{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}"
                            data-company-logo="{{ $job->company_logo_thumb }}"
                            data-full-address="{{ $job->full_address }}"
                            data-url="{{ $job->url }}"
                        ></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
