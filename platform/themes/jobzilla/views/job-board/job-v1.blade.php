<style>
/* ===== Job Detail Hero ===== */
.jd-hero {
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 60%, #bae6fd 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}
.jd-hero::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -100px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(14,165,233,.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.jd-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 13px;
}
.jd-breadcrumb a {
    color: #0369a1;
    text-decoration: none;
    font-weight: 500;
}
.jd-breadcrumb a:hover { color: #0c4a6e; }
.jd-breadcrumb span { color: #94a3b8; }
.jd-hero-content {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.jd-hero-logo {
    width: 72px;
    height: 72px;
    border-radius: 16px;
    background: #fff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.jd-hero-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 8px;
}
.jd-hero-info { flex: 1; min-width: 0; }
.jd-hero-info h1 {
    font-size: 30px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 10px;
    line-height: 1.3;
}
.jd-hero-meta {
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.jd-hero-meta span,
.jd-hero-meta a {
    font-size: 14px;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 5px;
}
.jd-hero-meta a {
    color: #0ea5e9;
    text-decoration: none;
    font-weight: 600;
}
.jd-hero-meta a:hover { color: #0369a1; }
.jd-hero-meta i { font-size: 14px; color: #94a3b8; }
.jd-hero-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}
.jd-hero-tag {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 14px;
    border-radius: 50px;
    background: #f0fdf4;
    color: #16a34a;
    border: 1px solid #bbf7d0;
}
.jd-hero-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}
.jd-apply-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    color: #fff;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    transition: all .25s;
    border: none;
    cursor: pointer;
}
.jd-apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(14,165,233,.3);
    color: #fff;
}
.jd-apply-btn.disabled {
    background: #94a3b8;
    cursor: not-allowed;
    pointer-events: none;
}
.jd-save-btn {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 18px;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
}
.jd-save-btn:hover { border-color: #f43f5e; color: #f43f5e; }
.jd-save-btn.active { background: #fff1f2; border-color: #f43f5e; color: #f43f5e; }
.jd-hero-salary {
    font-size: 20px;
    font-weight: 800;
    color: #0369a1;
}
.jd-hero-expires {
    font-size: 13px;
    color: #64748b;
    background: #fff;
    padding: 6px 14px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

/* ===== Main Content Area ===== */
.jd-main {
    padding: 40px 0 80px;
    background: #f8fafc;
}
.jd-content-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 36px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.jd-content-card h4.jd-section-title {
    font-size: 20px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    position: relative;
}
.jd-content-card h4.jd-section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    border-radius: 2px;
}
.jd-content-card .ck-content {
    font-size: 15px;
    line-height: 1.8;
    color: #334155;
}
.jd-content-card .ck-content h2,
.jd-content-card .ck-content h3,
.jd-content-card .ck-content h4 {
    color: #0c1e3c;
    margin-top: 24px;
    margin-bottom: 12px;
}
.jd-content-card .ck-content ul,
.jd-content-card .ck-content ol {
    padding-left: 20px;
    margin-bottom: 16px;
}
.jd-content-card .ck-content li {
    margin-bottom: 8px;
    line-height: 1.7;
}

/* ===== Share Section ===== */
.jd-share {
    margin-top: 35px;
    padding: 25px 30px;
    background: #f8fafc;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    margin-bottom: 24px;
}
.jd-share h4 {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
}
.jd-share-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.jd-share-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #fff;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s;
}
.jd-share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-decoration: none;
}
.jd-share-btn.facebook:hover { background: #1877F2; color: #fff; border-color: #1877F2; }
.jd-share-btn.twitter:hover { background: #1DA1F2; color: #fff; border-color: #1DA1F2; }
.jd-share-btn.linkedin:hover { background: #0A66C2; color: #fff; border-color: #0A66C2; }
.jd-share-btn.whatsapp:hover { background: #25D366; color: #fff; border-color: #25D366; }
.jd-share-btn.copy-link:hover { background: #0ea5e9; color: #fff; border-color: #0ea5e9; }

/* ===== Sidebar ===== */
.jd-sidebar-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.jd-sidebar-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}
.jd-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.jd-info-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.jd-info-list li:last-child { border-bottom: none; }
.jd-info-list .jd-info-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f0f9ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0ea5e9;
    font-size: 14px;
    flex-shrink: 0;
}
.jd-info-list .jd-info-text {
    flex: 1;
}
.jd-info-list .jd-info-label {
    font-size: 12px;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: .3px;
    font-weight: 600;
    margin-bottom: 2px;
}
.jd-info-list .jd-info-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
}
.jd-skills-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.jd-skill-tag {
    font-size: 12px;
    font-weight: 600;
    padding: 5px 14px;
    border-radius: 50px;
    background: #f0f9ff;
    color: #0369a1;
    border: 1px solid #bae6fd;
    transition: all .2s;
}
.jd-skill-tag:hover {
    background: #0ea5e9;
    color: #fff;
    border-color: #0ea5e9;
}

/* ===== Company Card ===== */
.jd-company-card {
    text-align: center;
}
.jd-company-logo {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin: 0 auto 12px;
    border: 1px solid #e2e8f0;
}
.jd-company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 6px;
}
.jd-company-name {
    font-size: 16px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 16px;
}
.jd-company-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    color: #fff;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.jd-company-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(14,165,233,.3);
    color: #fff;
}

/* ===== Back Button ===== */
.jd-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #0369a1;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 20px;
    transition: all .2s;
}
.jd-back-btn:hover { color: #0c4a6e; gap: 8px; }

/* ===== Map Container ===== */
.jd-content-card .job-board-street-map-container {
    padding-bottom: 0 !important;
    position: relative !important;
}
.jd-content-card .job-board-street-map-container .job-board-street-map {
    position: relative !important;
    width: 100% !important;
    height: 400px !important;
    min-height: 400px !important;
}

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .jd-hero { padding: 90px 0 40px; }
    .jd-hero-info h1 { font-size: 24px; }
    .jd-content-card { padding: 24px; }
    .jd-hero-salary { font-size: 18px; }
}
@media(max-width: 767px) {
    .jd-hero { padding: 80px 15px 30px; }
    .jd-hero-content { flex-direction: column; gap: 14px; }
    .jd-hero-logo { width: 56px; height: 56px; }
    .jd-hero-info h1 { font-size: 22px; }
    .jd-hero-meta { gap: 10px; }
    .jd-hero-meta span, .jd-hero-meta a { font-size: 13px; }
    .jd-hero-actions { flex-direction: column; align-items: flex-start; }
    .jd-content-card { padding: 20px; border-radius: 12px; }
    .jd-sidebar-card { padding: 20px; }
    .jd-main { padding: 25px 0 50px; }
    .jd-share { padding: 20px; }
}
@media(max-width: 480px) {
    .jd-hero { padding: 75px 10px 25px; }
    .jd-hero-info h1 { font-size: 20px; }
    .jd-hero-salary { font-size: 16px; }
}
</style>

{{-- Hero Section --}}
<section class="jd-hero">
    <div class="container">
        <div class="jd-breadcrumb">
            <a href="/">{{ __('Home') }}</a>
            <span>→</span>
            <a href="{{ JobBoardHelper::getJobsPageURL() }}">{{ __('Jobs') }}</a>
            <span>→</span>
            <span style="color: #475569;">{{ Str::limit($job->name, 40) }}</span>
        </div>

        <div class="jd-hero-content">
            <div class="jd-hero-logo">
                @if (! $job->hide_company && $company->id)
                    <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
                @else
                    @if (Theme::getLogo('default_company_logo') || Theme::getLogo())
                        {!! Theme::getLogoImage([], 'default_company_logo', 44) ?: Theme::getLogoImage([], 'logo', 44) !!}
                    @endif
                @endif
            </div>

            <div class="jd-hero-info">
                <h1>{{ $job->name }}</h1>

                <div class="jd-hero-meta">
                    @if (! $job->hide_company && $company->id)
                        <a href="{{ $company->url }}">
                            <i class="feather-briefcase"></i> {{ $company->name }} {!! $company->badge !!}
                        </a>
                    @endif
                    <span><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</span>
                    <span><i class="feather-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                </div>

                <div class="jd-hero-tags">
                    @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
                        @php $jobType->background_color = $jobType->getMetaData('background_color', true); @endphp
                        <span class="jd-hero-tag" @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}20; color: {{ $jobType->background_color }}; border-color: {{ $jobType->background_color }}40;" @endif>{{ $jobType->name }}</span>
                    @endforeach
                </div>

                <div class="d-flex align-items-center gap-3 flex-wrap mb-3">
                    <div class="jd-hero-salary">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                    @php
                        // Use application_closing_date if available, otherwise use expire_date
                        // application_closing_date is the date when applications close
                        // expire_date is when the job posting expires
                        $closingDate = null;
                        if ($job->application_closing_date) {
                            $closingDate = $job->application_closing_date;
                        } elseif ($job->expire_date && !$job->never_expired) {
                            $closingDate = $job->expire_date;
                        }
                    @endphp
                    @if ($closingDate)
                        <span class="jd-hero-expires">
                            <i class="feather-calendar"></i> {{ __('Expires') }}: {{ Theme::formatDate($closingDate) }}
                        </span>
                    @endif
                </div>

                <div class="jd-hero-actions">
                    @if ($job->canShowApplyJob())
                        @if ($job->is_applied)
                            <span class="jd-apply-btn disabled">{{ __('Applied') }}</span>
                        @elseif (! auth('account')->check())
                            <a href="#signupLoginModal" data-bs-toggle="modal" class="jd-apply-btn">{{ __('Apply Now') }} →</a>
                        @else
                            @if ($job->apply_url && $job->shouldOpenExternalApplyUrlDirectly())
                                <a href="{{ $job->apply_url }}" target="{{ $job->getExternalApplyUrlTarget() }}" class="jd-apply-btn">{{ __('Apply Now') }} →</a>
                            @else
                                <a @if ($job->apply_url) href="#applyExternalJob" @else href="#applyNow" @endif data-bs-toggle="modal"
                                    class="jd-apply-btn" data-job-name="{{ $job->name }}" data-job-id="{{ $job->id }}">
                                    {{ __('Apply Now') }} →
                                </a>
                            @endif
                        @endif
                    @elseif ($job->is_applied && ! auth('account')->user()->isEmployer())
                        <span class="jd-apply-btn disabled">{{ __('Applied') }}</span>
                    @else
                        <span class="jd-apply-btn disabled">{{ __('Apply Now') }}</span>
                    @endif

                    @if ($job->canShowSavedJob())
                        <a class="jd-save-btn job-bookmark-action @if ($job->is_saved) active @endif"
                           data-job-id="{{ $job->id }}"
                           href="{{ route('public.account.jobs.saved.action') }}"
                           title="{{ __('Save Job') }}">
                            <x-core::icon name="ti ti-heart" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // If job can't be applied (expired/closed/limit), show a clear message on click.
    document.body.addEventListener('click', function(e) {
        var el = e.target && e.target.closest ? e.target.closest('.jd-apply-btn.disabled') : null;
        if (!el) return;
        // Only when it's the disabled "Apply Now" state (not the "Applied" one)
        if ((el.textContent || '').toLowerCase().indexOf('apply') === -1) return;
        e.preventDefault();
        e.stopPropagation();
        if (typeof window.showDialogAlert === 'function') {
            window.showDialogAlert('warning', '{{ __("This job is expired or no longer accepting applications.") }}', '{{ __("Job expired") }}');
        } else {
            alert('{{ __("This job is expired or no longer accepting applications.") }}');
        }
    }, true);
});
</script>

{{-- Main Content --}}
<div class="jd-main">
    <div class="container">
        <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="jd-back-btn">← {{ __('Back to Jobs') }}</a>

        {{-- Job Detail Top Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $topAds = render_page_ads('job-detail', 'top'); @endphp
            @if (!empty($topAds))
                <div class="job-detail-ads-top" style="margin: 20px 0;">
                    {!! $topAds !!}
                </div>
            @endif
        @endif

        <div class="row">
            {{-- Left: Job Content --}}
            <div class="col-lg-8 col-md-12">
                @if ($job->description)
                    <div class="jd-content-card">
                        <h4 class="jd-section-title">{{ __('Job Description') }}</h4>
                        <p style="font-size: 15px; color: #475569; line-height: 1.8;">{{ $job->description }}</p>
                    </div>
                @endif

                {{-- Job Details Section --}}
                <div class="jd-content-card">
                    <h4 class="jd-section-title">{{ __('Job Details') }}</h4>
                    
                    @if ($job->content)
                        <div class="ck-content" style="margin-bottom: 30px;">
                            {!! BaseHelper::clean($job->content) !!}
                        </div>
                    @endif

                    {{-- Additional Job Details from Database --}}
                    <div class="job-details-list" style="display: grid; gap: 20px;">
                        @if ($job->number_of_positions)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Number of Positions') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->number_of_positions }}</span>
                            </div>
                        @endif

                        @if ($job->jobShift && $job->jobShift->name)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Job Shift') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->jobShift->name }}</span>
                            </div>
                        @endif

                        @if ($job->functionalArea && $job->functionalArea->name)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Functional Area') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->functionalArea->name }}</span>
                            </div>
                        @endif

                        @if ($job->degreeLevel && $job->degreeLevel->name)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Degree Level') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->degreeLevel->name }}</span>
                            </div>
                        @endif

                        @if ($job->required_certifications)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Required Certifications') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                        $certifications = is_array($job->required_certifications) 
                                            ? $job->required_certifications 
                                            : (is_string($job->required_certifications) ? json_decode($job->required_certifications, true) : [$job->required_certifications]);
                                        $certifications = array_filter((array)$certifications);
                                    @endphp
                                    @if (!empty($certifications))
                                        {{ implode(', ', array_map('trim', $certifications)) }}
                                    @else
                                        {{ $job->required_certifications }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($job->gender_preference)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Gender Preference') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ ucfirst(str_replace('_', ' ', $job->gender_preference)) }}</span>
                            </div>
                        @endif

                        @if ($job->marital_status_preference)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Marital Status Preference') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ ucfirst(str_replace('_', ' ', $job->marital_status_preference)) }}</span>
                            </div>
                        @endif

                        @if ($job->language_proficiency)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Language Proficiency') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                        $languages = is_array($job->language_proficiency) 
                                            ? $job->language_proficiency 
                                            : (is_string($job->language_proficiency) ? json_decode($job->language_proficiency, true) : [$job->language_proficiency]);
                                        $languages = array_filter((array)$languages);
                                    @endphp
                                    @if (!empty($languages))
                                        {{ implode(', ', array_map('trim', $languages)) }}
                                    @else
                                        {{ $job->language_proficiency }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($job->address)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Address') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->address }}</span>
                            </div>
                        @endif

                        @if ($job->zip_code)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Zip Code') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->zip_code }}</span>
                            </div>
                        @endif

                        @if ($job->is_remote)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Work Type') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ __('Remote') }}</span>
                            </div>
                        @endif

                        @if ($job->is_freelance)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Job Type') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ __('Freelance') }}</span>
                            </div>
                        @endif

                        @if ($job->start_date)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Start Date') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ Theme::formatDate($job->start_date) }}</span>
                            </div>
                        @endif

                        @if ($job->application_closing_date)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Application Closing Date') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ Theme::formatDate($job->application_closing_date) }}</span>
                            </div>
                        @endif

                        @if ($job->application_location_type)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Application Location Type') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ ucfirst(str_replace('_', ' ', $job->application_location_type)) }}</span>
                            </div>
                        @endif

                        @if ($job->application_locations)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Application Locations') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    @php
                                        $locations = is_array($job->application_locations) 
                                            ? $job->application_locations 
                                            : (is_string($job->application_locations) ? json_decode($job->application_locations, true) : [$job->application_locations]);
                                        $locations = array_filter((array)$locations);
                                    @endphp
                                    @if (!empty($locations))
                                        {{ implode(', ', array_map('trim', $locations)) }}
                                    @else
                                        {{ $job->application_locations }}
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if ($job->job_type_category)
                            <div class="job-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;">{{ __('Job Type Category') }}:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">{{ $job->job_type_category }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Share Section --}}
                <div class="jd-share">
                    <h4>{{ __('Share this Job') }}</h4>
                    <div class="jd-share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($job->url) }}" target="_blank" rel="noopener" class="jd-share-btn facebook" title="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($job->url) }}&text={{ urlencode($job->name) }}" target="_blank" rel="noopener" class="jd-share-btn twitter" title="Share on Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($job->url) }}&title={{ urlencode($job->name) }}" target="_blank" rel="noopener" class="jd-share-btn linkedin" title="Share on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($job->name . ' ' . $job->url) }}" target="_blank" rel="noopener" class="jd-share-btn whatsapp" title="Share on WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="navigator.clipboard.writeText('{{ $job->url }}');this.title='Copied!';setTimeout(()=>this.title='Copy Link',2000);" class="jd-share-btn copy-link" title="Copy Link">
                            <i class="fas fa-link"></i>
                        </a>
                    </div>
                </div>

                {{-- Comments --}}
                <div class="mt-2">
                    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $job) !!}
                </div>

                @include(Theme::getThemeNamespace('views.job-board.partials.street-map'))
            </div>

            {{-- Right: Sidebar --}}
            <div class="col-lg-4 col-md-12">
                {{-- Sidebar Top Ads --}}
                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarTopAds = render_page_ads('job-detail', 'sidebar-top'); @endphp
                    @if (!empty($sidebarTopAds))
                        <div class="jd-sidebar-card" style="margin-bottom: 20px;">
                            {!! $sidebarTopAds !!}
                        </div>
                    @endif
                @endif

                {{-- Job Information --}}
                <div class="jd-sidebar-card">
                    <h4>{{ __('Job Information') }}</h4>
                    <ul class="jd-info-list">
                        <li>
                            <span class="jd-info-icon"><i class="fas fa-eye"></i></span>
                            <div class="jd-info-text">
                                <div class="jd-info-label">{{ __('Views') }}</div>
                                <div class="jd-info-value">{{ number_format($job->views) }}</div>
                            </div>
                        </li>
                        <li>
                            <span class="jd-info-icon"><i class="fas fa-file-signature"></i></span>
                            <div class="jd-info-text">
                                <div class="jd-info-label">{{ __('Applicants') }}</div>
                                <div class="jd-info-value">{{ $job->number_of_applied ?? $job->applicants_count ?? 0 }}</div>
                            </div>
                        </li>
                        <li>
                            <span class="jd-info-icon"><i class="fas fa-calendar-alt"></i></span>
                            <div class="jd-info-text">
                                <div class="jd-info-label">{{ __('Date Posted') }}</div>
                                <div class="jd-info-value">{{ Theme::formatDate($job->created_at) }}</div>
                            </div>
                        </li>
                        @if ($job->full_address)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Location') }}</div>
                                    <div class="jd-info-value">{{ $job->full_address }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->categories->count())
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-user-tie"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Industry') }}</div>
                                    <div class="jd-info-value">
                                        @foreach ($job->categories as $category)
                                            {{ $category->name }}@if (!$loop->last), @endif
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if ($job->jobExperience->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-clock"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Experience') }}</div>
                                    <div class="jd-info-value">{{ $job->jobExperience->name }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->careerLevel->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-suitcase"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Qualification') }}</div>
                                    <div class="jd-info-value">{{ $job->careerLevel->name }}</div>
                                </div>
                            </li>
                        @endif
                        <li>
                            <span class="jd-info-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <div class="jd-info-text">
                                <div class="jd-info-label">{{ __('Offered Salary') }}</div>
                                <div class="jd-info-value">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                            </div>
                        </li>
                        @foreach ($job->customFields as $customField)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-check-circle"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{!! BaseHelper::clean($customField->name) !!}</div>
                                    <div class="jd-info-value">{!! BaseHelper::clean($customField->value) !!}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Skills --}}
                @if ($job->skills->count() > 0)
                    <div class="jd-sidebar-card">
                        <h4>{{ __('Job Skills') }}</h4>
                        <div class="jd-skills-wrap">
                            @foreach ($job->skills as $skill)
                                <span class="jd-skill-tag">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Tags --}}
                @if ($job->tags->count() > 0)
                    <div class="jd-sidebar-card">
                        <h4>{{ __('Job Tags') }}</h4>
                        <div class="jd-skills-wrap">
                            @foreach ($job->tags as $tag)
                                <a href="{{ $tag->url }}" class="jd-skill-tag" style="text-decoration:none;">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Sidebar Middle Ads --}}
                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarMiddleAds = render_page_ads('job-detail', 'sidebar-middle'); @endphp
                    @if (!empty($sidebarMiddleAds))
                        <div class="jd-sidebar-card" style="margin-top: 20px;">
                            {!! $sidebarMiddleAds !!}
                        </div>
                    @endif
                @endif

                {{-- Company Info --}}
                @if (! $job->hide_company && $company->id)
                    <div class="jd-sidebar-card jd-company-card">
                        <div class="jd-company-logo">
                            <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
                        </div>
                        <div class="jd-company-name">{{ $company->name }}</div>
                        <ul class="jd-info-list" style="text-align:left;">
                            @if ($company->year_founded)
                                <li>
                                    <span class="jd-info-icon"><i class="fas fa-building"></i></span>
                                    <div class="jd-info-text">
                                        <div class="jd-info-label">{{ __('Year founded') }}</div>
                                        <div class="jd-info-value">{{ $company->year_founded }}</div>
                                    </div>
                                </li>
                            @endif
                            @if ($company->phone)
                                <li>
                                    <span class="jd-info-icon"><i class="fas fa-mobile-alt"></i></span>
                                    <div class="jd-info-text">
                                        <div class="jd-info-label">{{ __('Phone') }}</div>
                                        <div class="jd-info-value">{{ $company->phone }}</div>
                                    </div>
                                </li>
                            @endif
                            @if ($company->email)
                                <li>
                                    <span class="jd-info-icon"><i class="fas fa-at"></i></span>
                                    <div class="jd-info-text">
                                        <div class="jd-info-label">{{ __('Email') }}</div>
                                        <div class="jd-info-value">{{ $company->email }}</div>
                                    </div>
                                </li>
                            @endif
                            @if ($company->website)
                                <li>
                                    <span class="jd-info-icon"><i class="fas fa-desktop"></i></span>
                                    <div class="jd-info-text">
                                        <div class="jd-info-label">{{ __('Website') }}</div>
                                        <div class="jd-info-value">{{ $company->website }}</div>
                                    </div>
                                </li>
                            @endif
                            @if ($company->full_address)
                                <li>
                                    <span class="jd-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <div class="jd-info-text">
                                        <div class="jd-info-label">{{ __('Address') }}</div>
                                        <div class="jd-info-value">{{ $company->full_address }}</div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="mt-3">
                            <a href="{{ $company->url }}" class="jd-company-btn">{{ __('View Profile') }} →</a>
                        </div>
                    </div>
                @endif

                {{-- Sidebar Bottom Ads --}}
                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarBottomAds = render_page_ads('job-detail', 'sidebar-bottom'); @endphp
                    @if (!empty($sidebarBottomAds))
                        <div class="jd-sidebar-card" style="margin-top: 20px;">
                            {!! $sidebarBottomAds !!}
                        </div>
                    @endif
                @endif

                {{-- Legacy Sidebar Right Ads (for backward compatibility) --}}
                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarAds = render_page_ads('job-detail', 'sidebar-right'); @endphp
                    @if (!empty($sidebarAds))
                        <div class="jd-sidebar-card" style="margin-top: 20px;">
                            {!! $sidebarAds !!}
                        </div>
                    @endif
                @endif

                {!! dynamic_sidebar('job_board_sidebar') !!}
            </div>
        </div>

        {{-- Job Detail Bottom Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $bottomAds = render_page_ads('job-detail', 'bottom'); @endphp
            @if (!empty($bottomAds))
                <div class="job-detail-ads-bottom" style="margin: 30px 0;">
                    {!! $bottomAds !!}
                </div>
            @endif
        @endif
    </div>
</div>
