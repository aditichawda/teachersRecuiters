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
.jd-hero-stats {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px 22px;
    margin-bottom: 14px;
}
.jd-hero-stat {
    font-size: 14px;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.jd-hero-stat i { font-size: 14px; color: #94a3b8; }
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
    word-wrap: break-word;
    overflow-wrap: break-word;
}
.jd-content-card .ck-content p {
    margin: 0 0 0.85em;
}
.jd-content-card .ck-content p:last-child {
    margin-bottom: 0;
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
/* Job meta full-width: icon rows in a responsive grid (no right sidebar) */
.jd-job-meta-card .jd-info-list.jd-info-list--grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    column-gap: 24px;
}
.jd-job-meta-card .jd-info-list.jd-info-list--grid li {
    min-width: 0;
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
    .jd-hero-stats { gap: 8px 16px; }
    .jd-hero-stat { font-size: 13px; }
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

            @php
                $job->loadMissing(['country', 'state', 'city', 'jobTypes', 'jobExperience', 'careerLevel']);
                $heroAddressLine = trim((string) ($job->full_address ?? ''));
                if ($heroAddressLine === '') {
                    $heroAddressLine = $job->location ?: __('India');
                }
                $institutionTypeLabel = filled($job->hiring_institution_type)
                    ? JobBoardHelper::institutionTypeLabel($job->hiring_institution_type)
                    : JobBoardHelper::institutionTypeLabel(optional($company)->institution_type);
                if ($institutionTypeLabel) {
                    $parts = preg_split('/\s*,\s*/', (string) $institutionTypeLabel) ?: [];
                    $parts = array_values(array_filter(array_map(static fn ($v) => trim((string) $v), $parts)));
                    $parts = array_map(static fn ($v) => ucwords($v), $parts);
                    $institutionTypeLabel = implode(', ', $parts);
                }
                $heroEmployment = $job->jobTypes->isNotEmpty()
                    ? $job->jobTypes->pluck('name')->filter()->implode(', ')
                    : trim((string) ($job->job_type_category ?? ''));
                $heroExperienceName = optional($job->jobExperience)->name ?: ($job->job_experience_name_old ?? null);
                $heroQualification = optional($job->careerLevel)->name;
                $heroLanguageProficiency = null;
                $langRaw = $job->language_proficiency;
                if ($langRaw !== null && $langRaw !== '') {
                    if (is_array($langRaw)) {
                        $langArr = $langRaw;
                    } elseif (is_string($langRaw)) {
                        $langArr = json_decode($langRaw, true);
                        $langArr = is_array($langArr) ? $langArr : [$langRaw];
                    } else {
                        $langArr = [];
                    }
                    $langParts = [];
                    foreach ((array) $langArr as $item) {
                        if (is_string($item)) {
                            $t = trim($item);
                            if ($t !== '') {
                                $langParts[] = $t;
                            }
                        }
                    }
                    if ($langParts !== []) {
                        $heroLanguageProficiency = implode(', ', $langParts);
                    }
                }
            @endphp
            <div class="jd-hero-info">
                <h1>{{ $job->name }}</h1>

                <div class="jd-hero-meta">
                    @if (! $job->hide_company && $company->id)
                        <a href="{{ $company->url }}">
                            <i class="feather-briefcase"></i> {{ $company->name }} {!! $company->badge !!}
                        </a>
                    @endif
                       <!-- <span><i class="feather-map-pin"></i>{{ $company->full_address }} {{ $heroAddressLine }}</span> -->
                        @if ($company->full_address)
                    <span><i class="feather-map-pin"></i>{{ $company->full_address }} ,{{ $job->zip_code }} </span>
                    @endif
                    <span><i class="feather-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                </div>

                <div class="jd-hero-stats">
                    @if ($institutionTypeLabel)
                        <span class="jd-hero-stat"><i class="fas fa-school"></i> <span>{{ $institutionTypeLabel }}</span></span>
                    @endif
                   
                    <span class="jd-hero-stat"><i class="fas fa-eye"></i> {{ number_format($job->views) }} {{ __('Views') }}</span>
                    <span class="jd-hero-stat"><i class="fas fa-file-signature"></i> {{ (int) ($job->number_of_applied ?? $job->applicants_count ?? 0) }} {{ __('Applicants') }}</span>
                    <span class="jd-hero-stat"><i class="fas fa-calendar-alt"></i> {{ Theme::formatDate($job->created_at) }}</span>
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
                        $closingDate = $job->effectiveApplicationDeadline();
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
                            <a href="#jobApplyAuthModal" data-bs-toggle="modal" class="jd-apply-btn js-job-apply-auth-trigger">{{ __('Apply Now') }}</a>
                        @else
                            @if ($job->apply_url && $job->shouldOpenExternalApplyUrlDirectly())
                                <a href="{{ $job->apply_url }}" target="{{ $job->getExternalApplyUrlTarget() }}" class="jd-apply-btn">{{ __('Apply Now') }} </a>
                            @else
                                <a @if ($job->apply_url) href="#applyExternalJob" @else href="#applyNow" @endif data-bs-toggle="modal"
                                    class="jd-apply-btn" data-job-name="{{ $job->name }}" data-job-id="{{ $job->id }}">
                                    {{ __('Apply Now') }} 
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

@if (! auth('account')->check())
@php
    $jobApplyRedirectUrl = url()->current();
    $jobApplyLoginUrl = route('public.account.login');
    $jobApplySendEmailOtpUrl = route('public.account.login.sendEmailOtp');
    $jobApplySendWaOtpUrl = route('public.account.login.sendWhatsAppOtp');
    $jobApplyVerifyOtpUrl = route('public.account.login.verifyOtp');
    $jobApplyResendOtpUrl = route('public.account.login.resendOtp');
    $jobApplySignupUrl = route('public.account.register');
@endphp

<style>
#jobApplyAuthModal .job-apply-auth-modal-content {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 30px 70px -18px rgba(2, 6, 23, 0.25), 0 0 0 1px rgba(2, 6, 23, 0.05);
}
#jobApplyAuthModal .modal-header {
    border: none;
    padding: 1.1rem 1.25rem 0.4rem;
    background: linear-gradient(135deg, rgba(3, 105, 161, 0.10), rgba(14, 165, 233, 0.06));
}
#jobApplyAuthModal .modal-title { font-weight: 800; font-size: 1.15rem; color: #0f172a; }
#jobApplyAuthModal .modal-body { padding: 0.75rem 1.25rem 1.25rem; background: #fff; }
#jobApplyAuthModal .job-apply-auth-icon {
    width: 44px; height: 44px; border-radius: 14px;
    display: inline-flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #0369a1, #0ea5e9); color: #fff;
    flex-shrink: 0; box-shadow: 0 10px 20px rgba(14,165,233,.25);
}
#jobApplyAuthModal .job-apply-auth-top { display: flex; align-items: flex-start; gap: 0.85rem; margin-bottom: 0.75rem; }
#jobApplyAuthModal .job-apply-auth-top h6 { margin: 0; font-weight: 800; font-size: 1.05rem; color: #0f172a; }
#jobApplyAuthModal .job-apply-auth-top p { margin: 0.15rem 0 0; color: #64748b; font-size: 0.92rem; line-height: 1.45; }
#jobApplyAuthModal .job-apply-login-methods {
    display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px;
    background: #f1f5f9; padding: 6px; border-radius: 10px;
}
#jobApplyAuthModal .job-apply-login-methods button {
    flex: 1 1 30%; min-width: 0;
    border: none; background: transparent; color: #64748b;
    font-size: 12px; font-weight: 700; padding: 8px 6px; border-radius: 8px; cursor: pointer;
}
#jobApplyAuthModal .job-apply-login-methods button.active {
    background: #fff; color: #0369a1; box-shadow: 0 1px 3px rgba(0,0,0,.08);
}
#jobApplyAuthModal .job-apply-auth-panel { display: none; }
#jobApplyAuthModal .job-apply-auth-panel.active { display: block; }
#jobApplyAuthModal .job-apply-auth-actions { display: flex; gap: 0.75rem; margin-top: 0.75rem; }
#jobApplyAuthModal .job-apply-auth-actions .btn {
    flex: 1 1 50%; border-radius: 10px; font-weight: 700; padding: 0.65rem 0.85rem;
    display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem;
}
#jobApplyAuthModal .job-apply-otp-sent { font-size: 0.85rem; color: #0369a1; margin-top: 0.35rem; }
@media (max-width: 575.98px) {
    #jobApplyAuthModal .modal-dialog { margin: 0.5rem; max-width: calc(100vw - 1rem); }
    #jobApplyAuthModal .job-apply-auth-actions .btn { width: 100%; }
}
</style>

<div class="modal fade" id="jobApplyAuthModal" tabindex="-1" aria-labelledby="jobApplyAuthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content job-apply-auth-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobApplyAuthModalLabel">{{ __('Signup & Login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>
            <div class="modal-body">
                <div class="job-apply-auth-top">
                    <div class="job-apply-auth-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/></svg>
                        </div>
                    <div>
                        <h6>{{ __('Signup & Login') }}</h6>
                        <p>{{ __('Create your profile or login to apply for jobs') }}</p>
                            </div>
                            </div>

                <div id="jobApplyAuthStepChooser">
                    <div class="job-apply-auth-actions">
                        <a href="{{ $jobApplySignupUrl }}" class="btn btn-primary js-job-apply-auth-signup">
                            <span>{{ __('Signup') }}</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M13 5l7 7-7 7"/></svg>
                        </a>
                        <button type="button" class="btn btn-outline-primary js-job-apply-auth-login-open">
                            <span>{{ __('Login') }}</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M13 5l7 7-7 7"/></svg>
                        </button>
                            </div>
                            </div>

                <div id="jobApplyAuthStepLogin" style="display:none;">
                    <div class="job-apply-login-methods" role="tablist">
                        <button type="button" class="active js-job-apply-login-tab" data-panel="pwd">{{ __('Password') }}</button>
                        <button type="button" class="js-job-apply-login-tab" data-panel="email_otp">{{ __('Email OTP') }}</button>
                        <button type="button" class="js-job-apply-login-tab" data-panel="wa_otp">{{ __('WhatsApp OTP') }}</button>
                            </div>

                    {{-- Password --}}
                    <div class="job-apply-auth-panel active" id="jobApplyPanelPwd">
                        <form id="jobApplyAuthLoginForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="apply_job" value="1">
                            <input type="hidden" name="redirect" value="{{ $jobApplyRedirectUrl }}">
                            <div class="mb-2">
                                <label class="form-label small" for="jobApplyAuthLoginEmail">{{ __('Email or Phone') }}</label>
                                <input type="text" class="form-control" id="jobApplyAuthLoginEmail" name="email" autocomplete="username" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small" for="jobApplyAuthLoginPassword">{{ __('Password') }}</label>
                                <input type="password" class="form-control" id="jobApplyAuthLoginPassword" name="password" autocomplete="current-password" required>
                            </div>
                            <div class="alert alert-danger d-none mt-2 mb-0" id="jobApplyAuthLoginErr"></div>
                            <div class="job-apply-auth-actions mt-3">
                                <button type="button" class="btn btn-outline-secondary js-job-apply-auth-login-back">{{ __('Back') }}</button>
                                <button type="submit" class="btn btn-primary" id="jobApplyAuthLoginSubmitBtn">{{ __('Login') }}</button>
                            </div>
                        </form>
                            </div>

                    {{-- Email OTP --}}
                    <div class="job-apply-auth-panel" id="jobApplyPanelEmailOtp">
                        <input type="hidden" name="_token" id="jobApplyEmailOtpCsrf" value="{{ csrf_token() }}">
                        <div class="mb-2">
                            <label class="form-label small" for="jobApplyEmailOtpEmail">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="jobApplyEmailOtpEmail" autocomplete="email" placeholder="you@example.com">
                            </div>
                        <button type="button" class="btn btn-outline-primary w-100 mb-2" id="jobApplyEmailOtpSendBtn">{{ __('Send OTP to email') }}</button>
                        <div id="jobApplyEmailOtpFields" style="display:none;">
                            <label class="form-label small" for="jobApplyEmailOtpCode">{{ __('Enter OTP') }}</label>
                            <input type="text" class="form-control mb-2" id="jobApplyEmailOtpCode" maxlength="6" inputmode="numeric" pattern="[0-9]*" placeholder="000000" autocomplete="one-time-code">
                            <div class="job-apply-auth-actions">
                                <button type="button" class="btn btn-primary" id="jobApplyEmailOtpVerifyBtn">{{ __('Verify & Login') }}</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="jobApplyEmailOtpResendBtn">{{ __('Resend OTP') }}</button>
                            </div>
                            </div>
                        <div class="alert alert-danger d-none mt-2 mb-0 small" id="jobApplyEmailOtpErr"></div>
                        <div class="alert alert-success d-none mt-2 mb-0 small" id="jobApplyEmailOtpOk"></div>
                            </div>

                    {{-- WhatsApp OTP --}}
                    <div class="job-apply-auth-panel" id="jobApplyPanelWaOtp">
                        <div class="mb-2">
                            <label class="form-label small" for="jobApplyWaPhone">{{ __('Phone (WhatsApp)') }}</label>
                            <input type="tel" class="form-control" id="jobApplyWaPhone" autocomplete="tel" placeholder="10-digit mobile number">
                            </div>
                        <button type="button" class="btn btn-outline-success w-100 mb-2" id="jobApplyWaOtpSendBtn">{{ __('Send OTP on WhatsApp') }}</button>
                        <div id="jobApplyWaOtpFields" style="display:none;">
                            <label class="form-label small" for="jobApplyWaOtpCode">{{ __('Enter OTP') }}</label>
                            <input type="text" class="form-control mb-2" id="jobApplyWaOtpCode" maxlength="6" inputmode="numeric" pattern="[0-9]*" placeholder="000000" autocomplete="one-time-code">
                            <div class="job-apply-auth-actions">
                                <button type="button" class="btn btn-primary" id="jobApplyWaOtpVerifyBtn">{{ __('Verify & Login') }}</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="jobApplyWaOtpResendBtn">{{ __('Resend OTP') }}</button>
                            </div>
                            </div>
                        <div class="alert alert-danger d-none mt-2 mb-0 small" id="jobApplyWaOtpErr"></div>
                        <div class="alert alert-success d-none mt-2 mb-0 small" id="jobApplyWaOtpOk"></div>
                    </div>

                    <div class="mt-2">
                        <button type="button" class="btn btn-link btn-sm p-0 js-job-apply-auth-login-back-from-methods">{{ __('Back') }}</button>
                            </div>
                    </div>
                </div>
                    </div>
                </div>
                </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var redirectUrl = @json($jobApplyRedirectUrl);
    var loginUrl = @json($jobApplyLoginUrl);
    var sendEmailOtpUrl = @json($jobApplySendEmailOtpUrl);
    var sendWaOtpUrl = @json($jobApplySendWaOtpUrl);
    var verifyOtpUrl = @json($jobApplyVerifyOtpUrl);
    var resendOtpUrl = @json($jobApplyResendOtpUrl);
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = (csrf && csrf.getAttribute('content')) || (document.querySelector('#jobApplyAuthLoginForm input[name="_token"]') || {}).value || '';

    var storageKey = 'jb_job_apply_intent_v1';
    var chooser = document.getElementById('jobApplyAuthStepChooser');
    var loginStep = document.getElementById('jobApplyAuthStepLogin');
    var openLoginBtn = document.querySelector('.js-job-apply-auth-login-open');
    var backBtns = document.querySelectorAll('.js-job-apply-auth-login-back, .js-job-apply-auth-login-back-from-methods');
    var pwdForm = document.getElementById('jobApplyAuthLoginForm');
    var pwdErr = document.getElementById('jobApplyAuthLoginErr');
    var pwdSubmit = document.getElementById('jobApplyAuthLoginSubmitBtn');

    function setIntent() {
        try {
            localStorage.setItem(storageKey, JSON.stringify({ url: window.location.href, ts: Date.now() }));
        } catch (e) {}
    }

    document.querySelectorAll('.js-job-apply-auth-trigger').forEach(function (btn) {
        btn.addEventListener('click', function () { setIntent(); });
    });

    function showLoginStep() {
        if (chooser) chooser.style.display = 'none';
        if (loginStep) loginStep.style.display = 'block';
        if (pwdErr) { pwdErr.classList.add('d-none'); pwdErr.textContent = ''; }
        setTimeout(function () {
            var inp = document.getElementById('jobApplyAuthLoginEmail');
            if (inp) inp.focus();
        }, 50);
    }
    function showChooser() {
        if (loginStep) loginStep.style.display = 'none';
        if (chooser) chooser.style.display = 'block';
        if (pwdErr) { pwdErr.classList.add('d-none'); pwdErr.textContent = ''; }
        if (pwdSubmit) pwdSubmit.disabled = false;
    }

    if (openLoginBtn) {
        openLoginBtn.addEventListener('click', function () { setIntent(); showLoginStep(); });
    }
    backBtns.forEach(function (b) {
        b.addEventListener('click', function () { showChooser(); });
    });

    /* Tabs */
    document.querySelectorAll('.js-job-apply-login-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            var panel = tab.getAttribute('data-panel');
            document.querySelectorAll('.js-job-apply-login-tab').forEach(function (t) { t.classList.remove('active'); });
            tab.classList.add('active');
            document.querySelectorAll('#jobApplyAuthStepLogin .job-apply-auth-panel').forEach(function (p) { p.classList.remove('active'); });
            if (panel === 'pwd') document.getElementById('jobApplyPanelPwd').classList.add('active');
            if (panel === 'email_otp') {
                document.getElementById('jobApplyPanelEmailOtp').classList.add('active');
                setTimeout(function () {
                    var emInp = document.getElementById('jobApplyEmailOtpEmail');
                    if (emInp) emInp.focus();
                }, 50);
            }
            if (panel === 'wa_otp') document.getElementById('jobApplyPanelWaOtp').classList.add('active');
        });
    });

    function postJson(url, body) {
        return fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify(body)
        }).then(function (r) {
            if (r.status === 204) return { error: false, _empty: true };
            return r.json().catch(function () { return {}; });
        });
    }

    function postMultipart(url, fd) {
        return fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: fd
        }).then(function (r) {
            return r.json().catch(function () { return {}; });
        });
    }

    /* Password login */
    if (pwdForm) {
        pwdForm.addEventListener('submit', function (e) {
            e.preventDefault();
            if (pwdSubmit) pwdSubmit.disabled = true;
            if (pwdErr) { pwdErr.classList.add('d-none'); pwdErr.textContent = ''; }
            var fd = new FormData(pwdForm);
            fetch(loginUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: fd
            }).then(function (r) {
                if (r.status === 204) {
                    window.location.href = redirectUrl;
                    return null;
                }
                return r.json().catch(function () { return {}; });
            }).then(function (data) {
                if (!data) return;
                var next = data.next_url || data.redirect;
                if (data.error === false && next) {
                    window.location.href = next;
                    return;
                }
                var msg = data.message || (data.data && data.data.message) || '{{ __("Login failed. Please try again.") }}';
                if (pwdErr) { pwdErr.textContent = msg; pwdErr.classList.remove('d-none'); }
            }).catch(function () {
                if (pwdErr) { pwdErr.textContent = '{{ __("Something went wrong.") }}'; pwdErr.classList.remove('d-none'); }
            }).finally(function () { if (pwdSubmit) pwdSubmit.disabled = false; });
        });
    }

    /* Email OTP */
    var emailOtpErr = document.getElementById('jobApplyEmailOtpErr');
    var emailOtpOk = document.getElementById('jobApplyEmailOtpOk');
    var emailSendBtn = document.getElementById('jobApplyEmailOtpSendBtn');
    var emailVerifyBtn = document.getElementById('jobApplyEmailOtpVerifyBtn');
    var emailResendBtn = document.getElementById('jobApplyEmailOtpResendBtn');
    if (emailSendBtn) {
        emailSendBtn.addEventListener('click', function () {
            var em = (document.getElementById('jobApplyEmailOtpEmail') || {}).value || '';
            if (emailOtpErr) { emailOtpErr.classList.add('d-none'); }
            if (emailOtpOk) { emailOtpOk.classList.add('d-none'); }
            postJson(sendEmailOtpUrl, { email: em, redirect: redirectUrl, _token: csrfToken }).then(function (data) {
                if (!data || data.error) {
                    if (emailOtpErr) { emailOtpErr.textContent = (data && data.message) || '{{ __("Could not send OTP.") }}'; emailOtpErr.classList.remove('d-none'); }
                    return;
                }
                var wrap = document.getElementById('jobApplyEmailOtpFields');
                if (wrap) wrap.style.display = 'block';
                if (emailOtpOk) { emailOtpOk.textContent = data.message || '{{ __("OTP sent.") }}'; emailOtpOk.classList.remove('d-none'); }
            });
        });
    }
    if (emailVerifyBtn) {
        emailVerifyBtn.addEventListener('click', function () {
            var code = (document.getElementById('jobApplyEmailOtpCode') || {}).value || '';
            if (emailOtpErr) emailOtpErr.classList.add('d-none');
            postJson(verifyOtpUrl, { otp: code, redirect: redirectUrl, from_job_apply: true, _token: csrfToken }).then(function (data) {
                if (data && data.error === false && (data.next_url || data.redirect)) {
                    window.location.href = data.next_url || data.redirect;
                    return;
                }
                if (emailOtpErr) { emailOtpErr.textContent = (data && data.message) || '{{ __("Invalid OTP.") }}'; emailOtpErr.classList.remove('d-none'); }
            });
        });
    }
    if (emailResendBtn) {
        emailResendBtn.addEventListener('click', function () {
            postMultipart(resendOtpUrl, (function () { var fd = new FormData(); fd.append('_token', csrfToken); return fd; })()).then(function (data) {
                if (data && !data.error && emailOtpOk) {
                    emailOtpOk.textContent = data.message || '{{ __("OTP resent.") }}';
                    emailOtpOk.classList.remove('d-none');
                }
            });
        });
    }

    /* WhatsApp OTP */
    var waErr = document.getElementById('jobApplyWaOtpErr');
    var waOk = document.getElementById('jobApplyWaOtpOk');
    var waSend = document.getElementById('jobApplyWaOtpSendBtn');
    var waVerify = document.getElementById('jobApplyWaOtpVerifyBtn');
    var waResend = document.getElementById('jobApplyWaOtpResendBtn');
    if (waSend) {
        waSend.addEventListener('click', function () {
            var phone = (document.getElementById('jobApplyWaPhone') || {}).value || '';
            if (waErr) waErr.classList.add('d-none');
            if (waOk) waOk.classList.add('d-none');
            postJson(sendWaOtpUrl, { phone: phone, redirect: redirectUrl, _token: csrfToken }).then(function (data) {
                if (!data || data.error) {
                    if (waErr) { waErr.textContent = (data && data.message) || '{{ __("Could not send OTP.") }}'; waErr.classList.remove('d-none'); }
                    return;
                }
                var w = document.getElementById('jobApplyWaOtpFields');
                if (w) w.style.display = 'block';
                if (waOk) { waOk.textContent = data.message || '{{ __("OTP sent.") }}'; waOk.classList.remove('d-none'); }
            });
        });
    }
    if (waVerify) {
        waVerify.addEventListener('click', function () {
            var code = (document.getElementById('jobApplyWaOtpCode') || {}).value || '';
            if (waErr) waErr.classList.add('d-none');
            postJson(verifyOtpUrl, { otp: code, redirect: redirectUrl, from_job_apply: true, _token: csrfToken }).then(function (data) {
                if (data && data.error === false && (data.next_url || data.redirect)) {
                    window.location.href = data.next_url || data.redirect;
                    return;
                }
                if (waErr) { waErr.textContent = (data && data.message) || '{{ __("Invalid OTP.") }}'; waErr.classList.remove('d-none'); }
            });
        });
    }
    if (waResend) {
        waResend.addEventListener('click', function () {
            var fd = new FormData();
            fd.append('_token', csrfToken);
            postMultipart(resendOtpUrl, fd).then(function (data) {
                if (data && !data.error && waOk) {
                    waOk.textContent = data.message || '{{ __("OTP resent.") }}';
                    waOk.classList.remove('d-none');
                } else if (data && data.error && waErr) {
                    waErr.textContent = data.message || '';
                    waErr.classList.remove('d-none');
                }
            });
        });
    }
});
</script>
@endif

{{-- Main Content --}}
<div class="jd-main">
    <div class="container">
        <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="jd-back-btn">← {{ __('Back to All  Jobs') }}</a>

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
            <div class="col-12">
                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarTopAds = render_page_ads('job-detail', 'sidebar-top'); @endphp
                    @if (!empty($sidebarTopAds))
                        <div class="jd-content-card" style="margin-bottom: 20px;">
                            {!! $sidebarTopAds !!}
                        </div>
                    @endif
                @endif
                {{-- Job Information (icons): structured fields + former "Job details" rows --}}
                @php
                    $job->loadMissing([
                        'country', 'state', 'city', 'jobTypes', 'jobExperience', 'careerLevel',
                        'jobShift', 'functionalArea', 'degreeLevel', 'categories', 'customFields',
                    ]);
                    $jobDisplayFullAddress = trim((string) ($job->full_address ?? ''));
                    if ($jobDisplayFullAddress === '') {
                        $jobDisplayFullAddress = implode(', ', array_values(array_filter([
                            trim((string) ($job->address ?? '')),
                            $job->city_name ?? null,
                            $job->state_name ?? null,
                            $job->country_name ?? null,
                        ], fn ($v) => $v !== null && $v !== '')));
                    }
                    $experienceName = optional($job->jobExperience)->name ?: ($job->job_experience_name_old ?? null);
                    $jobTypeFromRelation = $job->jobTypes->isNotEmpty()
                        ? $job->jobTypes->pluck('name')->filter()->implode(', ')
                        : '';
                    $jobTypeCategoryDisplay = trim((string) ($job->job_type_category ?? ''));
                    $certificationsDisplay = null;
                    if ($job->required_certifications) {
                        $certifications = is_array($job->required_certifications)
                            ? $job->required_certifications
                            : (is_string($job->required_certifications) ? json_decode($job->required_certifications, true) : [$job->required_certifications]);
                        $certifications = array_filter((array) $certifications);
                        $certificationsDisplay = ! empty($certifications)
                            ? implode(', ', array_map('trim', $certifications))
                            : trim((string) $job->required_certifications);
                    }
                    $languageProficiencyDisplay = null;
                    $langRaw = $job->language_proficiency;
                    if ($langRaw !== null && $langRaw !== '') {
                        if (is_array($langRaw)) {
                            $langArr = $langRaw;
                        } elseif (is_string($langRaw)) {
                            $decoded = json_decode($langRaw, true);
                            $langArr = is_array($decoded) ? $decoded : [$langRaw];
                        } else {
                            $langArr = [];
                        }
                        $langParts = [];
                        foreach ((array) $langArr as $item) {
                            if (is_string($item)) {
                                $t = trim($item);
                                if ($t !== '') {
                                    $langParts[] = $t;
                                }
                            }
                        }
                        if ($langParts !== []) {
                            $languageProficiencyDisplay = implode(', ', $langParts);
                        }
                    }
                    $applicationAcceptedLocationLine = JobBoardHelper::applicationAcceptedLocationLine($job);
                @endphp
                <div class="jd-content-card jd-job-meta-card">
                    @if ($job->content)
                        <h4 class="jd-section-title">{{ __('Job description') }}</h4>
                        <div class="ck-content" style="font-size: 15px; color: #475569; line-height: 1.8;">
                            {!! JobBoardHelper::formatJobRichContent($job->content) !!}
                        </div>
                @endif

                    @if ($job->description)
                        <h4 class="jd-section-title" style="border-bottom: none; padding-bottom: 0; margin-bottom: 12px; margin-top: 18px;">{{ __('Job Description') }}</h4>
                        <div class="ck-content" style="font-size: 15px; color: #475569; line-height: 1.8; margin-bottom: 18px;">
                            {!! JobBoardHelper::formatJobRichContent($job->description) !!}
                        </div>
                    @endif
                    
                    @if ($job->description || $job->content)
                        <hr style="margin: 22px 0; border-top: 1px solid #f1f5f9;">
                    @endif
                    <h4 class="jd-section-title">{{ __('Job Details') }}</h4>
                    <ul class="jd-info-list jd-info-list--grid">
                    
                        @if ($job->jobShift && $job->jobShift->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-business-time"></i></span>
                            <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Job Shift') }}</div>
                                    <div class="jd-info-value">{{ $job->jobShift->name }}</div>
                            </div>
                        </li>
                        @endif
                        @if ($jobTypeFromRelation !== '')
                        <li>
                                <span class="jd-info-icon"><i class="fas fa-tags"></i></span>
                            <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Job Type') }}</div>
                                    <div class="jd-info-value">{{ $jobTypeFromRelation }}</div>
                            </div>
                        </li>
                        @elseif ($jobTypeCategoryDisplay !== '')
                        <li>
                                <span class="jd-info-icon"><i class="fas fa-tags"></i></span>
                            <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Job Type') }}</div>
                                    <div class="jd-info-value">{{ $jobTypeCategoryDisplay }}</div>
                            </div>
                        </li>
                        @endif
                        @if ($jobTypeFromRelation !== '' && $jobTypeCategoryDisplay !== '')
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-folder-open"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Job Type Category') }}</div>
                                    <div class="jd-info-value">{{ $jobTypeCategoryDisplay }}</div>
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
                        @if ($experienceName)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-chart-line"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Experience') }}</div>
                                    <div class="jd-info-value">{{ $experienceName }}</div>
                                </div>
                            </li>
                        @endif
                        @if (optional($job->careerLevel)->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-graduation-cap"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Qualification') }}</div>
                                    <div class="jd-info-value">{{ $job->careerLevel->name }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->number_of_positions)
                        <li>
                                <span class="jd-info-icon"><i class="fas fa-users"></i></span>
                            <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Number of Positions') }}</div>
                                    <div class="jd-info-value">{{ $job->number_of_positions }}</div>
                            </div>
                        </li>
                        @endif
                        @if ($job->functionalArea && $job->functionalArea->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-sitemap"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Functional Area') }}</div>
                                    <div class="jd-info-value">{{ $job->functionalArea->name }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->degreeLevel && $job->degreeLevel->name)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-university"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Degree Level') }}</div>
                                    <div class="jd-info-value">{{ $job->degreeLevel->name }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($certificationsDisplay)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-certificate"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Required Certifications') }}</div>
                                    <div class="jd-info-value">{{ $certificationsDisplay }}</div>
                                </div>
                            </li>
                        @endif
                        @if (filled($job->gender_preference))
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-venus-mars"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Gender Preference') }}</div>
                                    <div class="jd-info-value">{{ ucfirst(str_replace('_', ' ', $job->gender_preference)) }}</div>
                                </div>
                            </li>
                        @endif
                        @if (filled($job->marital_status_preference))
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-ring"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Marital Status Preference') }}</div>
                                    <div class="jd-info-value">{{ ucfirst(str_replace('_', ' ', $job->marital_status_preference)) }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($languageProficiencyDisplay)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-language"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Language Proficiency') }}</div>
                                    <div class="jd-info-value">{{ $languageProficiencyDisplay }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->is_remote)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-laptop-house"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Work Type') }}</div>
                                    <div class="jd-info-value">{{ __('Remote') }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->is_freelance)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-user-clock"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Freelance') }}</div>
                                    <div class="jd-info-value">{{ __('Yes') }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($job->start_date)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-play-circle"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Start Date') }}</div>
                                    <div class="jd-info-value">{{ Theme::formatDate($job->start_date) }}</div>
                                </div>
                            </li>
                        @endif
                        @if ($applicationAcceptedLocationLine)
                            <li>
                                <span class="jd-info-icon"><i class="fas fa-globe"></i></span>
                                <div class="jd-info-text">
                                    <div class="jd-info-label">{{ __('Application accepted from which location') }}</div>
                                    <div class="jd-info-value">{{ $applicationAcceptedLocationLine }}</div>
                                </div>
                            </li>
                        @endif
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

                   
                @if ($job->skills->count() > 0)
                        <hr style="margin: 22px 0; border-top: 1px solid #f1f5f9;">
                        <h4 class="jd-section-title">{{ __('Job Skills') }}</h4>
                        <div class="jd-skills-wrap">
                            @foreach ($job->skills as $skill)
                                <span class="jd-skill-tag">{{ $skill->name }}</span>
                            @endforeach
                    </div>
                @endif

                @if ($job->tags->count() > 0)
                        <hr style="margin: 22px 0; border-top: 1px solid #f1f5f9;">
                        <h4 class="jd-section-title">{{ __('Job Tags') }}</h4>
                        <div class="jd-skills-wrap">
                            @foreach ($job->tags as $tag)
                                <a href="{{ $tag->url }}" class="jd-skill-tag" style="text-decoration:none;">{{ $tag->name }}</a>
                            @endforeach
                    </div>
                @endif
                </div>

                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarMiddleAds = render_page_ads('job-detail', 'sidebar-middle'); @endphp
                    @if (!empty($sidebarMiddleAds))
                        <div class="jd-content-card" style="margin-bottom: 20px;">
                            {!! $sidebarMiddleAds !!}
                        </div>
                    @endif
                @endif

                <!-- @if (! $job->hide_company && $company->id)
                    <div class="jd-content-card jd-job-meta-card jd-company-detail-card">
                        <h4 class="jd-section-title">{{ __('Company details') }}</h4>
                        <div class="jd-company-header">
                        <div class="jd-company-logo">
                            <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
                        </div>
                            <div>
                        <div class="jd-company-name">{{ $company->name }}</div>
                                <div class="jd-company-header-meta">
                                    <a href="{{ $company->url }}" class="jd-company-btn" style="display:inline-flex;margin-top:8px;">{{ __('View Profile') }} →</a>
                                </div>
                            </div>
                        </div>
                        <ul class="jd-info-list jd-info-list--grid">
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
                                        <div class="jd-info-value">
                                            <a href="mailto:{{ e($company->email) }}">{{ $company->email }}</a>
                                        </div>
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
                            @endif -
                        </ul>
                        </div>
                @endif -->

                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarBottomAds = render_page_ads('job-detail', 'sidebar-bottom'); @endphp
                    @if (!empty($sidebarBottomAds))
                        <div class="jd-content-card" style="margin-top: 20px;">
                            {!! $sidebarBottomAds !!}
                        </div>
                    @endif
                @endif

                @if (is_plugin_active('ads') && function_exists('render_page_ads'))
                    @php $sidebarAds = render_page_ads('job-detail', 'sidebar-right'); @endphp
                    @if (!empty($sidebarAds))
                        <div class="jd-content-card" style="margin-top: 20px;">
                            {!! $sidebarAds !!}
                        </div>
                    @endif
                @endif

                <div class="mb-4">
                {!! dynamic_sidebar('job_board_sidebar') !!}
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
