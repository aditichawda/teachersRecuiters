{!! Theme::partial('page-header') !!}

<div class="section-full  p-t120 p-b90 bg-white">
    <div class="container">
        <div class="section-content">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <!-- Candidate detail START -->
                    <div class="cabdidate-de-info">
                        <div class="twm-job-self-wrap">
                            <div class="twm-job-self-info">
                                <div class="twm-job-self-top">
                                    <div class="twm-media-bg">
                                        @if (! $job->hide_company && $company->id)
                                            <img src="{{ $company->cover_image_url }}" alt="cover">
                                        @else
                                            <img src="{{ RvMedia::getImageUrl(theme_option('default_company_cover_image'), null, false, RvMedia::getDefaultImage()) }}"
                                                alt="cover">
                                        @endif
                                        @include(Theme::getThemeNamespace('views.job-board.partials.job-types-badge'), ['jobTypes' => $job->jobTypes])
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

                                        @if ($job->location)
                                            <p class="twm-job-address">
                                                <i class="feather-map-pin"></i>{{ $job->location }}
                                            </p>
                                        @endif
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
                                        @include(Theme::getThemeNamespace('views.job-board.partials.apply-now-button'))
                                    </div>
                                </div>
                            </div>
                        </div>

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

                @include(Theme::getThemeNamespace('views.job-board.partials.job-information'))
            </div>
        </div>
    </div>
</div>
