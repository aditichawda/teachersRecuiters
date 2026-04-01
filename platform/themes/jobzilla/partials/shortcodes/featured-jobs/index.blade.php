@php
    use Botble\Base\Facades\BaseHelper;
    use Botble\JobBoard\Facades\JobBoardHelper;
    use Botble\Media\Facades\RvMedia;
@endphp

{!! Theme::partial('company-card-styles') !!}

<!-- Featured Jobs SECTION START -->
<div class="section-full pt10 pb-10 site-bg-white twm-featured-jobs-wrap" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title ?: __('Featured Jobs')) !!}</div>
                        </div>
                        <h2 class="wt-title" style="color: #1e293b; font-weight: 700;">{!! BaseHelper::clean($shortcode->subtitle ?: __('Latest highlighted vacancies')) !!}</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                    @php
                        $btnLabel = $shortcode->button_label ?: __('View All Jobs');
                        $btnUrl = $shortcode->button_action ?: JobBoardHelper::getJobsPageURL();
                    @endphp
                    <a href="{{ $btnUrl }}" class="site-button" style="background: #1967d2; border: none; color: #fff; padding: 12px 28px; border-radius:40px ; font-weight: 600; transition: all 0.3s ease;">{!! BaseHelper::clean($btnLabel) !!}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="twm-featured-jobs-content">
        <div class="container">
            <div class="section-content">
                @if ($jobs->count() > 0)
                    <div class="owl-carousel featured-jobs-carousel owl-btn-vertical-center">
                        @foreach ($jobs as $job)
                            <div class="item">
                                @php
                                    $company = $job->company;
                                    $companyName = $company?->name ?: ($job->company_name ?? '');
                                    $companyUrl = $company?->url ?: ($job->company_url ?? null);
                                    $logo = $company?->logo ?: ($job->company_logo ?? null);
                                    $logoUrl = $logo ? RvMedia::getImageUrl($logo) : ($job->company_logo_thumb ?? '');
                                    $jobLocation = trim((string) ($job->location ?: ($job->city_name ?: '')));
                                    $jobLocation = $jobLocation !== '' ? $jobLocation : __('India');
                                    $postedAgo = $job->created_at ? $job->created_at->diffForHumans() : '';
                                    $instLabel = '';
                                    try {
                                        $instLabel = JobBoardHelper::institutionTypeLabel($job->hiring_institution_type);
                                    } catch (\Throwable $e) {
                                        $instLabel = '';
                                    }
                                @endphp

                                <div class="company-card-grid job-card-grid">
                                    @if (! empty($job->is_featured))
                                        <span class="ccg-featured">★ {{ __('Featured') }}</span>
                                    @endif
                                    @if ($company && ! empty($company->is_verified))
                                        <span class="ccg-verified"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
                                    @endif

                                    <div class="ccg-top">
                                        <div class="ccg-logo">
                                            @if ($logoUrl)
                                                <img src="{{ $logoUrl }}" alt="{{ $companyName ?: $job->name }}">
                                            @else
                                                <img src="{{ RvMedia::getDefaultImage() }}" alt="{{ $companyName ?: $job->name }}">
                                            @endif
                                        </div>

                                        <a href="{{ $job->url }}" class="ccg-name" title="{{ $job->name }}">
                                            {!! BaseHelper::clean($job->name) !!}
                                        </a>

                                        @if ($companyName)
                                            <span class="ccg-type">
                                                <i class="feather-briefcase" style="font-size: 12px;"></i>
                                                @if ($companyUrl)
                                                    <a href="{{ $companyUrl }}" style="color: inherit;">{!! BaseHelper::clean($companyName) !!}</a>
                                                @else
                                                    {!! BaseHelper::clean($companyName) !!}
                                                @endif
                                            </span>
                                        @endif
                                    </div>

                                    <div class="ccg-body">
                                        <div class="ccg-details">
                                            @if ($instLabel)
                                                <div class="ccg-detail">
                                                    <i class="fa fa-school"></i>
                                                    <span>{{ $instLabel }}</span>
                                                </div>
                                            @endif
                                            @if ($jobLocation)
                                                <div class="ccg-detail">
                                                    <i class="feather-map-pin"></i>
                                                    <span>{{ \Illuminate\Support\Str::limit($jobLocation, 32) }}</span>
                                                </div>
                                            @endif
                                            @if (! JobBoardHelper::isSalaryHiddenForGuests() && ! empty($job->salary_text))
                                                <div class="ccg-detail">
                                                    <i class="feather-dollar-sign"></i>
                                                    <span>{{ $job->salary_text }}</span>
                                                </div>
                                            @endif
                                            @if ($postedAgo)
                                                <div class="ccg-detail">
                                                    <i class="feather-clock"></i>
                                                    <span>{{ $postedAgo }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="ccg-footer">
                                        <span class="ccg-jobs-count">
                                            <i class="feather-clipboard"></i>
                                            <span>{{ __('Apply') }}</span>
                                        </span>
                                        <a href="{{ $job->url }}" class="ccg-view-btn">{{ __('View') }} →</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-jobs-message" style="text-align: center; padding: 60px 20px; color: #64748b;">
                        <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5; display: block;"></i>
                        <h4 style="color: #334155; margin-bottom: 10px;">{{ __('No featured jobs available') }}</h4>
                        <p style="color: #94a3b8; font-size: 14px;">{{ __('Please check back later.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
    .twm-featured-jobs-wrap { position: relative; }
    .twm-featured-jobs-wrap::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e0f2fe, transparent);
    }
    .twm-featured-jobs-content { overflow: hidden; position: relative; padding: 40px 0 60px; }
    .featured-jobs-carousel { display: block !important; visibility: visible !important; opacity: 1 !important; min-height: 420px; position: relative; }
    .featured-jobs-carousel:not(.owl-loaded) {
        display: flex !important;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
        padding: 0 15px;
        overflow: hidden;
    }
    .featured-jobs-carousel:not(.owl-loaded) .item {
        flex: 0 0 calc(33.333% - 16px);
        max-width: calc(33.333% - 16px);
        min-width: 320px;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    @media (max-width: 991px) {
        .featured-jobs-carousel:not(.owl-loaded) .item { flex: 0 0 calc(50% - 12px); max-width: calc(50% - 12px); }
    }
    @media (max-width: 768px) {
        .featured-jobs-carousel:not(.owl-loaded) .item { flex: 0 0 100%; max-width: 100%; }
    }
    .featured-jobs-carousel .owl-stage-outer { overflow: hidden !important; padding: 0 0; }
    .featured-jobs-carousel .owl-stage { display: flex; align-items: stretch; }
    .featured-jobs-carousel .owl-item { padding: 0 12px; display: flex; }
    .featured-jobs-carousel .item { height: 100%; width: 100%; }

    /* Make job cards match Featured Schools sizing */
    .featured-jobs-carousel .company-card-grid.job-card-grid {
        height: 100%;
        min-height: 420px;
        margin-bottom: 0;
        box-shadow: 0 4px 20px rgba(0, 115, 209, 0.08);
        transition: all 0.3s ease;
        width: 100%;
    }
    .featured-jobs-carousel .company-card-grid.job-card-grid:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 115, 209, 0.16);
    }
    @media (max-width: 768px) {
        .featured-jobs-carousel .company-card-grid.job-card-grid { min-height: 380px; }
    }

    /* Nav buttons match Featured Schools */
    .featured-jobs-carousel.owl-btn-vertical-center .owl-nav {
        position: absolute;
        top: 45%;
        left: 0;
        right: 0;
        display: flex;
        justify-content: space-between;
        pointer-events: none;
        transform: translateY(-50%);
    }
    .featured-jobs-carousel.owl-btn-vertical-center .owl-nav button {
        width: 44px; height: 44px;
        border-radius: 12px;
        border: 1px solid rgba(14,165,233,.25);
        background: rgba(255,255,255,.95);
        color: #0369a1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        pointer-events: auto;
        transition: all .2s ease;
        box-shadow: 0 10px 25px rgba(2, 6, 23, 0.12);
    }
    .featured-jobs-carousel.owl-btn-vertical-center .owl-nav button:hover { transform: translateY(-1px); background: #fff; }
    .featured-jobs-carousel.owl-btn-vertical-center .owl-nav button.disabled { opacity: .35; cursor: not-allowed; }
    </style>

    <script>
    (function() {
        function initFeaturedJobsCarousel() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initFeaturedJobsCarousel, 100);
                return;
            }

            var $carousel = jQuery('.featured-jobs-carousel');
            if ($carousel.length) {
                if ($carousel.hasClass('owl-loaded')) {
                    return;
                }
                if (typeof jQuery.fn.owlCarousel === 'undefined') {
                    setTimeout(initFeaturedJobsCarousel, 200);
                    return;
                }
                try {
                    $carousel.owlCarousel({
                        loop: $carousel.find('.item').length > 3,
                        margin: 24,
                        nav: true,
                        dots: false,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        stagePadding: 0,
                        responsive: {
                            0: { items: 1, loop: $carousel.find('.item').length > 1, stagePadding: 0 },
                            576: { items: 1, loop: $carousel.find('.item').length > 1, stagePadding: 0 },
                            768: { items: 2, loop: $carousel.find('.item').length > 2, stagePadding: 0 },
                            992: { items: 3, loop: $carousel.find('.item').length > 3, stagePadding: 0 },
                            1200: { items: 3, loop: $carousel.find('.item').length > 3, stagePadding: 0 }
                        },
                        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
                    });
                } catch(e) {
                    console.error('Error initializing featured jobs carousel:', e);
                }
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() { setTimeout(initFeaturedJobsCarousel, 300); });
        } else {
            setTimeout(initFeaturedJobsCarousel, 300);
        }
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function() { setTimeout(initFeaturedJobsCarousel, 300); });
            jQuery(window).on('load', function() { setTimeout(initFeaturedJobsCarousel, 100); });
        }
    })();
    </script>
</div>
<!-- Featured Jobs SECTION END -->
