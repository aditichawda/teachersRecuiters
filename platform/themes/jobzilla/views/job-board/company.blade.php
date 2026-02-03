@php
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('pageTitle', $company->name);
@endphp

{!! Theme::partial('page-header') !!}

<div class="section-full  p-t120 p-b90 bg-white" style="transform: none;">
    <div class="container" style="transform: none;">
        <div class="section-content" style="transform: none;">
            <div class="row d-flex justify-content-center" style="transform: none;">
                <div class="col-lg-8 col-md-12">
                    <div class="cabdidate-de-info">
                        <div class="twm-employer-self-wrap">
                            <div class="twm-employer-self-info">
                                <div class="twm-employer-self-top">
                                    <div class="twm-media-bg">
                                        @if ($coverImage = $company->cover_image_url)
                                            <img src="{{ $coverImage }}" alt="{{ $company->name }}">
                                        @else
                                            <img src="{{ RvMedia::getImageUrl(theme_option('default_company_cover_image'), null, false, RvMedia::getDefaultImage()) }}"
                                                 alt="cover">
                                        @endif
                                    </div>
                                    <div class="twm-mid-content">

                                        <div class="twm-media">
                                            <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
                                        </div>

                                        <h4 class="twm-job-title">{{ $company->name }} {!! $company->badge !!}</h4>
                                        @if ($company->address)
                                            <p class="twm-employer-address"><i class="feather-map-pin"></i>{{ $company->address }}</p>
                                        @endif

                                        @if ($company->website)
                                            <i class="feather-globe"></i><a href="{{ $company->website }}" class="twm-employer-websites site-text-primary"> {{ $company->website }}</a>
                                        @endif
                                        @if ($company->description)
                                            <p class="twm-employer-address"><i class="feather-chevron-right"></i>{{ $company->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="twm-s-title">{{ __('About Company') }}</h4>

                        <div class="ck-content" style="word-break: break-word">
                            {!! BaseHelper::clean($company->content) !!}
                        </div>

                        @if ($company->facebook || $company->twitter || $company->linkedin || $company->instagram)
                            <h4 class="twm-s-title">{{ __('Social links') }}</h4>
                            <div class="twm-social-tags">
                                @if ($company->facebook)
                                    <a href="{{ $company->facebook }}" class="fb-clr">{{ __('Facebook') }}</a>
                                @endif
                                @if ($company->twitter)
                                    <a href="{{ $company->twitter }}" class="tw-clr">{{ __('Twitter') }}</a>
                                @endif
                                @if ($company->linkedin)
                                    <a href="{{ $company->linkedin }}" class="link-clr">{{ __('Linkedin') }}</a>
                                @endif
                                @if ($company->instagram)
                                    <a href="{{ $company->instagram }}" class="pinte-clr">{{ __('Instagram') }}</a>
                                @endif
                            </div>
                        @endif

                        @if ($jobs->isNotEmpty())
                            <h4 class="twm-s-title">{{ __('Available Jobs') }}</h4>
                            <div class="twm-jobs-list-wrap">
                                <ul>
                                    @include(Theme::getThemeNamespace('views.job-board.partials.job-items'), ['job' => $jobs, 'layout'=> 'list'])
                                </ul>
                            </div>
                        @endif
                    </div>
                    @if (JobBoardHelper::isEnabledReview())
                        {!! Theme::partial('companies.reviews', compact('company', 'canReviewCompany')) !!}
                    @endif
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="theiaStickySidebar">
                        <div class="side-bar-2">
                            <div class="twm-s-map mb-5">
                                @include(Theme::getThemeNamespace('views.job-board.partials.company-map'), ['company' => $company])
                            </div>

                            @if (! JobBoardHelper::hideCompanyEmailEnabled())
                                @if ($company->annual_revenue || $company->year_founded || $company->ceo || $company->phone || $company->number_of_offices || $company->number_of_employees)
                                    <div class="twm-s-info-wrap mb-5">
                                        <h4 class="section-head-small mb-4">{{ __('Company Info') }}</h4>
                                        <div class="twm-s-info">
                                            <ul>
                                                @if ($company->annual_revenue)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-money-bill-wave"></i>
                                                            <span class="twm-title">{{ __('Annual Revenue') }}</span>
                                                            <div class="twm-s-info-discription">$ {{ $company->annual_revenue }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($company->year_founded)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-clock"></i>
                                                            <span class="twm-title">{{ __('Year founded') }}</span>
                                                            <div class="twm-s-info-discription">{{ $company->year_founded }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($company->ceo)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-user-tie"></i>
                                                            <span class="twm-title">{{ __('CEO') }}</span>
                                                            <div class="twm-s-info-discription">{{ $company->ceo }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($company->phone)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-mobile-alt"></i>
                                                            <span class="twm-title">{{ __('Phone') }}</span>
                                                            <div class="twm-s-info-discription">{{ $company->phone }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($company->number_of_offices)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-sharp fa-regular fa-building"></i>
                                                            <span class="twm-title">{{ __('Number of offices') }}</span>
                                                            <div class="twm-s-info-discription">{{ $company->number_of_offices }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($company->number_of_employees)
                                                    <li>
                                                        <div class="twm-s-info-inner">
                                                            <i class="fas fa-regular fa-users"></i>
                                                            <span class="twm-title">{{ __('Number of employees') }}</span>
                                                            <div class="twm-s-info-discription">{{ $company->number_of_employees }}</div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
