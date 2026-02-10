@php
    Theme::set('header_css_class', 'header-full-width');
@endphp

<!-- Job Detail V.2 START -->
<div class="section-full  p-t50 p-b90 bg-white">
    <div class="container">
        <!-- BLOG SECTION START -->
        <div class="section-content">
            <div class="twm-job-self-wrap twm-job-detail-v2">
                <div class="twm-job-self-info">
                    <div class="twm-job-self-top">
                        <div class="twm-media-bg">
                            @if (! $job->hide_company && $company->id)
                                <img src="{{ $company->cover_image_url }}" alt="{{ $company->name }}">
                            @else
                                <img src="{{ RvMedia::getImageUrl(theme_option('default_company_cover_image'), null, false, RvMedia::getDefaultImage()) }}"
                                    alt="cover">
                            @endif
                            @include(Theme::getThemeNamespace('views.job-board.partials.job-types-badge'), ['jobTypes' => $job->jobTypes])

                            @include(Theme::getThemeNamespace('views.job-board.partials.apply-now-button'))
                        </div>

                        <div class="twm-mid-content">
                            <div class="text-center mb-3">
                                <div class="twm-media">
                                    @if (! $job->hide_company && $company->id)
                                        <img src="{{ $company->logo_thumb }}" alt="logo">
                                    @else
                                        @if (Theme::getLogo('default_company_logo') || Theme::getLogo())
                                            {!! Theme::getLogoImage([], 'default_company_logo', 44) ?: Theme::getLogoImage([], 'logo', 44) !!}
                                        @endif
                                    @endif
                                </div>
                                @if (! $job->hide_company && $company->id)
                                    <div class="mt-2">
                                        <a href="{{ $company->url }}" class="text-decoration-none">
                                            <h5 class="mb-0">{{ $company->name }} {!! $company->badge !!}</h5>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <h4 class="twm-job-title mb-0">{{ $job->name }}<span
                                        class="twm-job-post-duration">/ {{ $job->created_at->diffForHumans() }}</span>
                                </h4>

                                @if ($job->canShowSavedJob())
                                    <div class="favorite-icon @if ($job->is_saved) bookmark-post @endif">
                                        <a
                                            class="job-bookmark-action"
                                            data-job-id="{{ $job->id }}"
                                            href="{{ route('public.account.jobs.saved.action') }}"
                                            title="{{ __('Save Job') }}"
                                        >
                                            <x-core::icon name="ti ti-heart" />
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <p class="twm-job-address">
                                <i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}
                            </p>
                            <div class="twm-job-self-mid">
                                <div class="twm-job-self-mid-left">
                                    @if (! $job->hide_company && $company->id)
                                        <a href="{{ $company->url }}"
                                            class="twm-job-websites site-text-primary">{{ $company->name }} {!! $company->badge !!}</a>
                                    @endif
                                    <div class="twm-jobs-amount">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                                </div>
                                @if (! $job->never_expired && $job->expire_date)
                                    <div class="twm-job-apllication-area">{{ __('Application ends') }}:
                                        <span class="twm-job-apllication-date">{{ Theme::formatDate($job->expire_date) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="twm-job-detail-2-wrap">
                <div class="row d-flex justify-content-center">
                    @include(Theme::getThemeNamespace('views.job-board.partials.job-information'))

                    <div class="col-lg-8 col-md-12">
                        <!-- Candidate detail START -->
                        <div class="cabdidate-de-info">
                            @if (! $job->hide_company)
                                <h4 class="twm-s-title m-t0">{{ __('Company Description') }}:</h4>
                                <p>{{ $company->description }}</p>
                            @endif

                            @if ($job->description)
                                <h4 class="twm-s-title">{{ __('Job Description') }}:</h4>
                                <p>{{ $job->description }}</p>
                            @endif

                            <div class="ck-content">
                                {!! BaseHelper::clean($job->content) !!}
                            </div>

                            @include(Theme::getThemeNamespace('views.job-board.partials.share'))

                            <div class="mt-4">
                                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $job) !!}
                            </div>

                            @include(Theme::getThemeNamespace('views.job-board.partials.street-map'))
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Job Detail V.2 END -->

@if (! $job->hide_company && $companyJobs->count() > 0)
    <!-- Related Jobs START -->
    <div class="section-full p-t120 p-b90 site-bg-light-purple twm-related-jobs-carousel-wrap">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{{ __('Top Jobs') }}</div>
            </div>
            <h2 class="wt-title">{{ __('Related Jobs') }}</h2>
        </div>
        <!-- TITLE END-->

        <div class="container">
            <div class="section-content">
                <div class="owl-carousel twm-related-jobs-carousel owl-btn-vertical-center">
                    @foreach ($companyJobs as $companyJob)
                        <div class="item">
                            <div class="twm-jobs-grid-style2">
                                <div class="twm-media">
                                    <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->company_name ?: $job->name }}">
                                </div>
                                <span class="twm-job-post-duration">{{ $job->created_at->diffForHumans() }}</span>
                                @include(Theme::getThemeNamespace('views.job-board.partials.job-types-badge'), ['jobTypes' => $companyJob->jobTypes])
                                <div class="twm-mid-content">
                                    <a href="{{ $job->url }}" class="twm-job-title">
                                        <h4>{{ $job->name }}</h4>
                                    </a>
                                    <p class="twm-job-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
                                    @if ($job->has_company)
                                        <a href="{{ $job->company_url }}"
                                            class="twm-job-websites site-text-primary">{{ $job->company_name }}</a>
                                    @endif
                                </div>
                                <div class="twm-right-content">
                                    <div class="twm-jobs-amount">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                                    <a href="{{ $job->url }}" class="twm-jobs-browse site-text-primary">{{ __('View Job') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Related Jobs END -->
@endif
