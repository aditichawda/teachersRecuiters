@php
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('pageTitle', $company->name);
    Theme::set('withPageHeader', false);
@endphp

{!! Theme::partial('company-card-styles') !!}
{!! Theme::partial('jobs-card-styles') !!}

<style>
/* ===== Company Detail Hero ===== */
.cd-hero {
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 60%, #bae6fd 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}
.cd-hero::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -100px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(0,115,209,.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.cd-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 13px;
}
.cd-breadcrumb a { color: #0073d1; text-decoration: none; font-weight: 500; }
.cd-breadcrumb a:hover { color: #0c4a6e; }
.cd-breadcrumb span { color: #94a3b8; }
.cd-hero-content {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.cd-hero-logo {
    width: 80px;
    height: 80px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.cd-hero-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}
.cd-hero-info { flex: 1; }
.cd-hero-info h1 {
    font-size: 30px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
}
.cd-hero-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.cd-hero-meta span, .cd-hero-meta a {
    font-size: 14px;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 5px;
}
.cd-hero-meta a { color: #0073d1; text-decoration: none; font-weight: 500; }
.cd-hero-meta a:hover { color: #0073d1; }
.cd-hero-meta i { color: #94a3b8; font-size: 14px; }
.cd-hero-desc {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 0;
    max-width: 600px;
}

/* ===== Main Area ===== */
.cd-main {
    padding: 40px 0 80px;
    background: #f8fafc;
}
.cd-content-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cd-content-card h4.cd-section-title {
    font-size: 20px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    position: relative;
}
.cd-content-card h4.cd-section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 2px;
}
.cd-content-card .ck-content {
    font-size: 15px;
    line-height: 1.8;
    color: #334155;
}

/* ===== Company Details Grid ===== */
.company-details-list {
    display: grid;
    grid-template-columns: 1fr;
    gap: 14px;
}
.company-details-list .company-detail-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 14px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
}
.company-details-list .company-detail-item .cdi {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #e6f0ff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #1967D2;
    margin-top: 2px;
}
.company-details-list .company-detail-item .cdi i {
    font-size: 16px;
}
.company-details-list .company-detail-item strong {
    min-width: 160px;
    font-weight: 700;
    color: #0f172a;
}
.company-details-list .company-detail-item span {
    color: #475569;
}
@media (min-width: 992px) {
    .company-details-list {
        grid-template-columns: 1fr 1fr;
    }
}

/* Social Links */
.cd-social-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.cd-social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #f1f5f9;
    color: #475569;
    text-decoration: none;
    font-size: 16px;
    transition: all .2s;
}
.cd-social-link:hover {
    transform: translateY(-2px);
    color: #fff;
}
.cd-social-link.fb:hover { background: #1877f2; }
.cd-social-link.tw:hover { background: #1da1f2; }
.cd-social-link.li:hover { background: #0a66c2; }
.cd-social-link.ig:hover { background: #e4405f; }

/* ===== Sidebar ===== */
.cd-sidebar-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cd-sidebar-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}
.cd-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cd-info-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.cd-info-list li:last-child { border-bottom: none; }
.cd-info-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f0f9ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0073d1;
    font-size: 14px;
    flex-shrink: 0;
}
.cd-info-text { flex: 1; }
.cd-info-label {
    font-size: 12px;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: .3px;
    font-weight: 600;
    margin-bottom: 2px;
}
.cd-info-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
}

/* Back Button */
.cd-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #0073d1;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 20px;
    transition: all .2s;
}
.cd-back-btn:hover { color: #0c4a6e; gap: 8px; }

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .cd-hero { padding: 90px 0 40px; }
    .cd-hero-info h1 { font-size: 24px; }
    .cd-content-card { padding: 24px; }
}
@media(max-width: 767px) {
    .cd-hero { padding: 80px 15px 30px; }
    .cd-hero-content { flex-direction: column; gap: 14px; }
    .cd-hero-logo { width: 60px; height: 60px; }
    .cd-hero-info h1 { font-size: 22px; }
    .cd-content-card { padding: 20px; border-radius: 12px; }
    .cd-sidebar-card { padding: 20px; }
    .cd-main { padding: 25px 0 50px; }
}

/* Review Avatar Size */
.review-item .avatar-md,
.review-item .rounded-circle.avatar-md {
    width: 48px !important;
    height: 48px !important;
    max-width: 48px !important;
    max-height: 48px !important;
    object-fit: cover;
}
.review-listing .review-item .flex-shrink-0 {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}

/* Masked contact info (locked) */
.cd-masked-contact {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #0ea5e9;
    font-weight: 700;
}
.cd-masked-contact .cd-masked-value {
    filter: blur(2px);
    user-select: none;
    letter-spacing: 1px;
}
</style>

{{-- Company Detail Top Ads --}}
@if (is_plugin_active('ads') && function_exists('render_page_ads'))
    @php $topAds = render_page_ads('company-detail', 'top'); @endphp
    @if (!empty($topAds))
        <div class="company-detail-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            {!! $topAds !!}
        </div>
    @endif
@endif

{{-- Hero Section --}}
<section class="cd-hero">
    <div class="container">
        <div class="cd-breadcrumb">
            
        </div>

        <div class="cd-hero-content">
            <div class="cd-hero-logo">
                <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
            </div>
            <div class="cd-hero-info">
                <h1>{{ $company->name }} {!! $company->badge !!}</h1>
                <div class="cd-hero-meta">
                    {{-- Always show address --}}
                    @if ($company->full_address)
                        <span><i class="feather-map-pin"></i> {{ $company->full_address }} ,{{ $company->zip_code }}</span>
                    @elseif ($company->address)
                        <span><i class="feather-map-pin"></i> {{ $company->address }} ,{{ $company->zip_code }}</span>
                    @endif
                    {{-- Website visible only for premium (controlled by $canViewSchoolContactInfo) --}}
                    @if (($canViewSchoolContactInfo ?? false) && $company->website && !empty(trim($company->website)))
                        <a href="{{ $company->website }}" target="_blank" rel="noopener"><i class="feather-globe"></i> {{ Str::limit($company->website, 50) }}</a>
                    @endif
                    @php
                        // Show Institution & Campus types as chips in hero
                        $heroInst = [];
                        if (!empty($company->institution_type)) {
                            $raw = is_array($company->institution_type) ? $company->institution_type : (is_string($company->institution_type) ? json_decode($company->institution_type, true) : [$company->institution_type]);
                            foreach ((array) $raw as $v) {
                                $t = is_array($v) ? ($v['title'] ?? $v['name'] ?? $v['label'] ?? '') : (string) $v;
                                $t = trim($t);
                                if ($t !== '') $heroInst[] = ucwords(strtolower(str_replace(['_', '-'], ' ', $t)));
                            }
                        }
                        $heroCampus = [];
                        if (!empty($company->campus_type)) {
                            $raw = is_array($company->campus_type) ? $company->campus_type : (is_string($company->campus_type) ? json_decode($company->campus_type, true) : [$company->campus_type]);
                            foreach ((array) $raw as $v) {
                                $t = is_array($v) ? ($v['title'] ?? $v['name'] ?? $v['label'] ?? '') : (string) $v;
                                $t = trim($t);
                                if ($t !== '') $heroCampus[] = ucwords(strtolower(str_replace(['_', '-'], ' ', $t)));
                            }
                        }
                    @endphp
                    @if (!empty($heroInst))
                        <span>
                            <i class="feather-award"></i>
                            <span class="badge rounded-pill" style="background:#e0f2fe;color:#0c4a6e;padding:6px 10px;font-weight:600;">
                                {{ implode(', ', $heroInst) }}
                            </span>
                        </span>
                    @endif
                    @if (!empty($heroCampus))
                        <span>
                            <i class="feather-home"></i>
                            <span class="badge rounded-pill" style="background:#eef2ff;color:#3730a3;padding:6px 10px;font-weight:600;">
                                {{ implode(', ', $heroCampus) }}
                            </span>
                        </span>
                    @endif
                </div>
                {{-- About text removed from hero; shown below in its own section --}}
                <div class="mt-3 d-flex align-items-center gap-2 flex-wrap">
                    @if (!empty($showAdmissionOnProfile) && $company->admission)
                        <button type="button" class="btn btn-success px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#admissionEnquiryModal" style="background: linear-gradient(135deg, #059669, #047857); border: none;">
                            <i class="fas fa-graduation-cap me-2"></i>{{ __('Admission Enquiry') }}
                        </button>
                    @endif
                    <button type="button" class="btn btn-primary px-4 py-2 rounded-pill" id="scrollToActiveJobsBtn">
                        <i class="fas fa-briefcase me-2"></i>{{ __('Active Jobs') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Main Content --}}
<div class="cd-main">
    <div class="container">
        @php
            $sidebarAdsHtml = (is_plugin_active('ads') && function_exists('render_page_ads')) ? render_page_ads('company-detail', 'sidebar-right') : '';
            $hasSidebar = (($company->latitude && $company->longitude) || !empty($sidebarAdsHtml));
        @endphp
        @if(session('success_msg'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">{{ session('success_msg') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        @endif
        @if(session('error_msg'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">{{ session('error_msg') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        @endif
        <!-- <a href="{{ JobBoardHelper::getJobcompaniesPageURL() }}" class="cd-back-btn">← {{ __('Back to companies') }}</a>
        <span class="mx-2 text-muted">|</span> -->
        <a href="{{ JobBoardHelper::getJobcompaniesPageURL() }}" class="cd-back-btn">←{{ __('Back to all institutions') }}</a>

        <div class="row">
            {{-- Left Content --}}
            <div class="{{ $hasSidebar ? 'col-lg-8 col-md-12' : 'col-12' }}">
                {{-- Company Details Section --}}
                <div class="cd-content-card">
                    <h4 class="cd-section-title">{{ __('Institution Details') }}</h4>
                    
                    {{-- Additional Company Details from Database --}}
                    <div class="company-details-list" style="display: grid; gap: 20px;">
                        @php
                            $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
                            $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
                            $institutionTypeGroups = file_exists($pluginGroupsPath)
                                ? include $pluginGroupsPath
                                : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
                            $instLabelMap = [];
                            foreach ($institutionTypeGroups as $g) {
                                $instLabelMap = array_merge($instLabelMap, $g['options'] ?? []);
                            }

                            $normalizeList = function ($raw) {
                                $items = [];
                                if (is_array($raw)) {
                                    $items = $raw;
                                } elseif (is_string($raw)) {
                                    $raw = trim($raw);
                                    if ($raw !== '') {
                                        $decoded = json_decode($raw, true);
                                        $items = json_last_error() === JSON_ERROR_NONE && is_array($decoded)
                                            ? $decoded
                                            : preg_split('/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY);
                                    }
                                } elseif ($raw !== null && $raw !== '') {
                                    $items = [$raw];
                                }

                                return array_values(array_filter(array_map(function ($item) {
                                    if (is_array($item)) {
                                        $item = $item['title'] ?? $item['name'] ?? $item['label'] ?? '';
                                    }

                                    $item = trim((string) $item);

                                    return $item !== '' ? $item : null;
                                }, (array) $items)));
                            };

                            $instValues = array_values(array_filter(array_map(function ($v) {
                                $v = str_replace('_', '-', trim((string) $v));
                                return $v === 'icse-school' ? 'cicse-school' : $v;
                            }, $normalizeList($company->institution_type))));

                            $institutionLabels = array_values(array_filter(array_map(function ($v) use ($instLabelMap) {
                                return $v !== '' ? ($instLabelMap[$v] ?? ucwords(strtolower(str_replace(['_', '-'], ' ', $v)))) : null;
                            }, $instValues)));
                        @endphp

                        @if (!empty($institutionLabels))
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-award"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Institution Type') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ implode(', ', $institutionLabels) }}</span>
                            </div>
                        @endif

                        @if ($company->campus_type)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-home"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Campus Type') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                        $campusTypes = is_array($company->campus_type) 
                                            ? $company->campus_type 
                                            : (is_string($company->campus_type) ? json_decode($company->campus_type, true) : [$company->campus_type]);
                                            $campusTypes = collect((array) $campusTypes)
                                            ->flatten()
                                            ->map(fn ($v) => is_scalar($v) ? trim((string) $v) : null)
                                            ->filter()
                                            ->values()
                                            ->all();
                                    @endphp
                                    @if (!empty($campusTypes))
                                    {{ implode(', ', array_map(fn ($x) => ucwords(strtolower(str_replace(['_', '-'], ' ', (string) $x))), $campusTypes)) }}
                                    @else
                                        {{ ucwords(strtolower(str_replace(['_', '-'], ' ', (string) $company->campus_type))) }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @php
                            $canViewContact = (bool) ($canViewSchoolContactInfo ?? false);
                        @endphp

                        @if ($company->email)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-mail"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Email') }}:</strong>
                                @if ($canViewContact)
                                    <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->email }}</span>
                                @else
                                    <span class="cd-masked-contact" style="margin-left: 10px;">
                                        <i class="fas fa-lock text-secondary" title="{{ __('Locked') }}"></i>
                                        <span class="cd-masked-value">********@******.***</span>
                                        @if (!empty($contactInfoUpgradeUrl))
                                            <a href="{{ $contactInfoUpgradeUrl }}" class="btn btn-sm btn-primary ms-2">{{ __('Upgrade') }}</a>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if ($company->phone)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-phone"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Phone') }}:</strong>
                                @if ($canViewContact)
                                    <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->phone }}</span>
                                @else
                                    <span class="cd-masked-contact" style="margin-left: 10px;">
                                        <i class="fas fa-lock text-secondary" title="{{ __('Locked') }}"></i>
                                        <span class="cd-masked-value">***-***-****</span>
                                        @if (!empty($contactInfoUpgradeUrl))
                                            <a href="{{ $contactInfoUpgradeUrl }}" class="btn btn-sm btn-primary ms-2">{{ __('Upgrade') }}</a>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if (! $canViewContact && (!empty($company->email) || !empty($company->phone)))
                            <div class="company-detail-item p-3 rounded" style="background: #f8fafc; border: 1px dashed #e2e8f0;">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <i class="fas fa-lock text-secondary"></i>
                                    <span style="color: #475569; font-size: 15px;">{{ __('plugins/job-board::messages.view_contact_info_locked') }}</span>
                                    @if (!empty($contactInfoUpgradeUrl))
                                        <a href="{{ $contactInfoUpgradeUrl }}" class="btn btn-sm btn-primary ms-2">{{ __('Upgrade') }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($company->year_founded)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-calendar"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Year Founded') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->year_founded }}</span>
                            </div>
                        @endif

                        @if ($company->ceo)
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('CEO') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->ceo }}</span>
                            </div>
                        @endif

                        @if ($company->number_of_offices)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-aperture"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Number of Offices') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->number_of_offices }}</span>
                            </div>
                        @endif

                        @if ($company->number_of_employees)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-users"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Number of Employees') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->number_of_employees }}</span>
                            </div>
                        @endif

                        @if ($company->total_staff)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-user-check"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Total Staff') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->total_staff }}</span>
                            </div>
                        @endif

                        @if ($company->annual_revenue)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="fas fa-rupee-sign"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Annual Revenue') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->annual_revenue }}</span>
                            </div>
                        @endif

                        @if ($company->tax_id)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-file-text"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Tax ID') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->tax_id }}</span>
                            </div>
                        @endif

                        @if ($company->working_days)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-calendar"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Working Days') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                        $workingDays = is_array($company->working_days) 
                                            ? $company->working_days 
                                            : (is_string($company->working_days) ? json_decode($company->working_days, true) : [$company->working_days]);
                                            $workingDays = collect((array) $workingDays)
                                            ->flatten()
                                            ->map(fn ($v) => is_scalar($v) ? trim((string) $v) : null)
                                            ->filter()
                                            ->values()
                                            ->all();
                                    @endphp
                                    @if (!empty($workingDays))
                                    {{ implode(', ', array_map(fn ($x) => ucwords(strtolower(str_replace(['_', '-'], ' ', (string) $x))), $workingDays)) }}
                                    @else
                                        {{ $company->working_days }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($company->working_hours_start && $company->working_hours_end)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-clock"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Working Hours') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $company->working_hours_start }} - {{ $company->working_hours_end }}</span>
                            </div>
                        @endif

                        @if ($company->staff_facilities)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-briefcase"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Staff Facilities') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                    $facilities = $normalizeList($company->staff_facilities);
                                    $facilities = collect((array) $facilities)
                                            ->flatten()
                                            ->map(fn ($v) => is_scalar($v) ? trim((string) $v) : null)
                                            ->filter()
                                            ->values()
                                            ->all();
                                    @endphp
                                    @if (!empty($facilities))
                                    {{ implode(', ', array_map(fn ($x) => ucwords(strtolower(str_replace(['_', '-'], ' ', (string) $x))), $facilities)) }}
                                    @else
                                        {{ $company->staff_facilities }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($company->standard_level)
                            <div class="company-detail-item">
                                <span class="cdi"><i class="feather-layers"></i></span>
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Standard Level') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                    $levelsRaw = $normalizeList($company->standard_level);
                                        $levels = [];
                                        foreach ((array) $levelsRaw as $lv) {
                                            if (is_string($lv)) {
                                                $t = trim($lv);
                                            } elseif (is_array($lv)) {
                                                $t = trim((string) ($lv['title'] ?? $lv['name'] ?? $lv['label'] ?? implode(', ', array_filter(array_map(fn ($v) => is_scalar($v) ? (string) $v : '', $lv)))));
                                            } else {
                                                $t = trim((string) $lv);
                                            }
                                            if ($t !== '') {
                                                $levels[] = ucwords(strtolower(str_replace(['_', '-'], ' ', $t)));
                                            }
                                        }
                                    @endphp
                                    @if (!empty($levels))
                                        {{ implode(', ', $levels) }}
                                    @else
                                        {{ $company->standard_level }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        

                        @if ($company->google)
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Google') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <a href="{{ $company->google }}" target="_blank" rel="noopener" style="color: #0ea5e9; text-decoration: none;">{{ __('View on Google') }}</a>
                                </span>
                            </div>
                        @endif

                        @if ($company->is_verified)
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Verification Status') }}:</strong>
                                <span style="color: #16a34a; font-size: 15px; margin-left: 10px;">
                                    <i class="fas fa-check-circle"></i> {{ __('Verified') }}
                                    @if ($company->verified_at)
                                        ({{ Theme::formatDate($company->verified_at) }})
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- About (moved below details) --}}
                @if ($company->content)
                    <div class="cd-content-card">
                        <h4 class="cd-section-title">{{ __('About Company') }}</h4>
                        <div class="ck-content" style="word-break: break-word">
                            {!! BaseHelper::clean($company->content) !!}
                        </div>
                    </div>
                @endif
                
                {{-- Affiliations, Awards & Media --}}
                @php
                    // Prepare arrays once for nice chips rendering
                    $awardsArr = [];
                    if ($company->awards) {
                        $awardsRaw = is_array($company->awards) ? $company->awards : (is_string($company->awards) ? json_decode($company->awards, true) : [$company->awards]);
                        foreach ((array) $awardsRaw as $aw) {
                            if (is_string($aw)) {
                                $t = trim($aw);
                            } elseif (is_array($aw)) {
                                $t = trim((string) ($aw['title'] ?? $aw['name'] ?? $aw['award'] ?? $aw['label'] ?? ''));
                            } else {
                                $t = trim((string) $aw);
                            }
                            if ($t !== '') $awardsArr[] = $t;
                        }
                    }
                    $affiliationsArr = [];
                    if ($company->affiliations) {
                        $affRaw = is_array($company->affiliations) ? $company->affiliations : (is_string($company->affiliations) ? json_decode($company->affiliations, true) : [$company->affiliations]);
                        foreach ((array) $affRaw as $af) {
                            if (is_string($af)) {
                                $t = trim($af);
                            } elseif (is_array($af)) {
                                $t = trim((string) ($af['title'] ?? $af['name'] ?? $af['label'] ?? ''));
                            } else {
                                $t = trim((string) $af);
                            }
                            if ($t !== '') $affiliationsArr[] = $t;
                        }
                    }
                @endphp
                @if (!empty($awardsArr) || !empty($affiliationsArr) || $company->youtube_video)
                    <div class="cd-content-card">
                        <h4 class="cd-section-title">{{ __('Affiliations, Awards & Media') }}</h4>
                        @if (!empty($affiliationsArr))
                            <div class="mb-3">
                                <div class="mb-1" style="font-weight:700;color:#0c1e3c;">{{ __('Affiliations') }}</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($affiliationsArr as $item)
                                        <span class="badge rounded-pill" style="background:#e0f2fe;color:#0c4a6e;padding:8px 12px;font-weight:600;">{{ $item }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (!empty($awardsArr))
                            <div class="mb-3">
                                <div class="mb-1" style="font-weight:700;color:#0c1e3c;">{{ __('Awards') }}</div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($awardsArr as $item)
                                        <span class="badge rounded-pill" style="background:#ecfccb;color:#365314;padding:8px 12px;font-weight:600;">🏆 {{ $item }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($company->youtube_video)
                            <div class="mt-2">
                                <a href="{{ $company->youtube_video }}" target="_blank" rel="noopener" class="btn btn-outline-danger btn-sm" style="border-radius:10px;">
                                    <i class="fab fa-youtube me-1"></i>{{ __('Watch Video') }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Social Links --}}
                @if ($company->facebook || $company->twitter || $company->linkedin || $company->instagram)
                    <div class="cd-content-card">
                        <h4 class="cd-section-title">{{ __('Social Links') }}</h4>
                        <div class="cd-social-links">
                            @if ($company->facebook)
                                <a href="{{ $company->facebook }}" class="cd-social-link fb" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($company->twitter)
                                <a href="{{ $company->twitter }}" class="cd-social-link tw" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if ($company->linkedin)
                                <a href="{{ $company->linkedin }}" class="cd-social-link li" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if ($company->instagram)
                                <a href="{{ $company->instagram }}" class="cd-social-link ig" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Available Jobs --}}
                @if (isset($jobs) && $jobs && method_exists($jobs, 'isNotEmpty') && $jobs->isNotEmpty())
                    <div class="cd-content-card" id="active-jobs">
                        <h4 class="cd-section-title">{{ __('Available Jobs') }} ({{ $jobs->count() }})</h4>
                        <div class="twm-jobs-list-wrap">
                            <ul style="list-style:none; padding:0; margin:0;">
                                @include(Theme::getThemeNamespace('views.job-board.partials.job-items'), ['jobs' => $jobs, 'layout'=> 'list'])
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Reviews --}}
                @if (JobBoardHelper::isEnabledReview())
                    <div class="cd-content-card">
                        {!! Theme::partial('companies.reviews', compact('company', 'canReviewCompany')) !!}
                    </div>
                @endif

                {{-- Admission Section: unlocked when package has "Admission Form on Profile" or credits entitlement --}}
                @if (!empty($showAdmissionOnProfile) && $company->admission)
                <div class="cd-content-card">
                    <h4 class="cd-section-title">{{ __('Get Admission with :name', ['name' => $company->name]) }}</h4>
                    <h5 class="mb-2" style="font-size: 1.1rem; font-weight: 600; color: #0c1e3c;">{{ __('About School / Institution') }}</h5>
                    <p class="text-muted small mb-2" style="font-size: 0.85rem;">{{ __('Details added by the institution for admission.') }}</p>
                    @if ($company->admission->content)
                        <div class="mb-4" style="color: #475569; line-height: 1.6;">{!! BaseHelper::clean($company->admission->content) !!}</div>
                    @endif
                    <h5 class="mb-3" style="font-size: 1rem; font-weight: 600;">{{ __('Enquiry Form') }}</h5>
                    <p class="text-muted small mb-3">{{ __('Submit your admission enquiry using the form below or use the button above.') }}</p>
                    @include(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company])
                </div>
                @elseif (!empty($admissionFormLocked))
                {{-- Admission Form Locked: show for owner with "Unlock with X credits" --}}
                <div class="cd-content-card" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                    <h4 class="cd-section-title mb-3">
                        <i class="fas fa-lock text-secondary me-2"></i>{{ __('Admission Form on Profile') }} – {{ __('Locked') }}
                    </h4>
                    <p class="text-muted mb-3">{{ __('This feature is not included in your current package. Unlock it with payment (not coins) to show the admission enquiry form on your institution profile.') }}</p>
                    @if (!empty($isOwner))
                        <p class="mb-0">
                            <a href="{{ route('public.account.packages') }}#choose-plan" class="btn btn-primary px-4 py-2 rounded-pill">
                                <i class="fas fa-credit-card me-2"></i>{{ __('Unlock with payment') }}
                            </a>
                        </p>
                    @endif
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            @if ($hasSidebar)
            <div class="col-lg-4 col-md-12">
                {{-- Company Detail Sidebar Ads --}}
                @if (!empty($sidebarAdsHtml))
                    <div class="cd-sidebar-card" style="margin-bottom: 20px;">
                        {!! $sidebarAdsHtml !!}
                    </div>
                @endif

                {{-- Map --}}
                @if ($company->latitude && $company->longitude)
                    <div class="cd-sidebar-card">
                        @include(Theme::getThemeNamespace('views.job-board.partials.company-map'), ['company' => $company])
                    </div>
                @endif

                {{-- Company Info section removed per requirement --}}
            </div>
            @endif
        </div>

        {{-- Company Detail Bottom Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $bottomAds = render_page_ads('company-detail', 'bottom'); @endphp
            @if (!empty($bottomAds))
                <div class="company-detail-ads-bottom" style="margin: 30px 0;">
                    {!! $bottomAds !!}
                </div>
            @endif
        @endif
    </div>
</div>

{{-- Admission Enquiry Modal - when admission shown on profile (package feature or open deadline) --}}
@if (!empty($showAdmissionOnProfile) && $company->admission)
<style>
#admissionEnquiryModal .modal-dialog { max-width: 520px; }
#admissionEnquiryModal .modal-body { padding: 1rem 1.25rem 1.5rem; }
#admissionEnquiryModal .admission-enquiry-form .form-label { font-weight: 600; color: #334155; margin-bottom: 6px; font-size: 0.9rem; }
#admissionEnquiryModal .admission-enquiry-form .form-control,
#admissionEnquiryModal .admission-enquiry-form .form-select { border-radius: 8px; border: 1px solid #e2e8f0; padding: 8px 12px; font-size: 0.95rem; }
#admissionEnquiryModal .admission-enquiry-form .btn-primary { border-radius: 8px; padding: 10px 20px; font-weight: 600; }
</style>
<div class="modal fade" id="admissionEnquiryModal" tabindex="-1" aria-labelledby="admissionEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title" id="admissionEnquiryModalLabel">
                    <i class="fas fa-graduation-cap me-2 text-success"></i>{{ __('Admission Enquiry') }} - {{ $company->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company])
            </div>
        </div>
    </div>
</div>
@endif

{{-- Smooth scroll for "Active Jobs" button --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('scrollToActiveJobsBtn');
    if (!btn) return;
    btn.addEventListener('click', function () {
        var target = document.getElementById('active-jobs');
        if (!target) return;
        try {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } catch (e) {
            // Fallback
            window.location.hash = '#active-jobs';
        }
    });
});
</script>