@php
    $subtitle = $shortcode->subtitle;
    if (str_contains($subtitle, '{count}')) {
        if ($shortcode->use_real_jobs_count === 'yes' && is_plugin_active('job-board')) {
            $jobsCount = number_format(count_active_jobs());
        } else {
            $jobsCount = $shortcode->jobs_count ?: '150,000+';
        }
        $subtitle = str_replace('{count}', $jobsCount, $subtitle);
    }
@endphp

@switch($shortcode->style)
    @case('style-2')
        <section
            class="bg-home"
            id="home"
        >
            <div
                class="bg-overlay"
                @if ($shortcode->image) style="background-image: url('{{ RvMedia::getImageUrl($shortcode->image) }}')" @endif
            ></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center text-white mb-5">
                            <h1 class="display-5 fw-semibold mb-3">{!! BaseHelper::clean(
                                str_replace(
                                    $shortcode->highlight_text,
                                    '<span class="text-warning fw-bold">' . $shortcode->highlight_text . '</span>',
                                    $shortcode->title,
                                ),
                            ) !!}</h1>
                            <p class="fs-17">{!! BaseHelper::clean($subtitle) !!}</p>
                        </div>
                    </div>

                </div>

                {!! Theme::partial('job-search-box', ['withCategories' => true]) !!}

                @if (is_plugin_active('job-board') &&
                        $shortcode->trending_keywords &&
                        ($keywords = array_map('trim', array_filter(explode(',', $shortcode->trending_keywords)))))
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="treding-keywords list-inline mb-0 text-white-50 mt-4 mt-lg-3 text-center">
                                <li class="list-inline-item text-white">
                                    <i class="mdi mdi-tag-multiple-outline text-warning fs-18"></i>
                                    <span>{{ __('Trending Keywords') }}:</span>
                                </li>
                                @foreach ($keywords as $item)
                                    <li class="list-inline-item">
                                        <a
                                            href="{{ JobBoardHelper::getJobsPageURL() }}?keyword={{ $item }}">{{ $item . (!$loop->last ? ',' : '') }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                @endif

            </div>

        </section>
    @break

    @case('style-3')
        <section
            class="bg-home3"
            id="home"
        >
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="mb-4 pb-3 me-lg-5">
                            <span class="sub-title mb-2">{!! BaseHelper::clean($subtitle) !!}</span>
                            <h1 class="display-5 fw-semibold mb-3">{!! BaseHelper::clean(
                                str_replace(
                                    $shortcode->highlight_text,
                                    '<span class="text-primary fw-bold">' . $shortcode->highlight_text . '</span>',
                                    $shortcode->title,
                                ),
                            ) !!}</h1>
                            <p class="fs-18 text-muted mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                        </div>
                        {!! Theme::partial('job-search-box') !!}

                        @if (is_plugin_active('job-board') &&
                            $shortcode->trending_keywords &&
                            ($keywords = array_map('trim', array_filter(explode(',', $shortcode->trending_keywords)))))
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="treding-keywords list-inline mb-0 text-white-50 mt-4 mt-lg-3 text-start">
                                        <li class="list-inline-item text-white">
                                            <i class="mdi mdi-tag-multiple-outline text-warning fs-18"></i>
                                            <span class="text-muted">{{ __('Trending Keywords') }}:</span>
                                        </li>
                                        @foreach ($keywords as $item)
                                            <li class="list-inline-item">
                                                <a
                                                    href="{{ JobBoardHelper::getJobsPageURL() }}?keyword={{ $item }}" class="text-muted">{{ $item . (!$loop->last ? ',' : '') }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        @endif
                    </div>

                    @if ($shortcode->images && ($images = array_filter(explode(',', $shortcode->images))))
                        <div class="col-lg-5">
                            <div class="mt-5 mt-lg-0 ms-xl-5">
                                <div class="quote-icon">
                                    <i class="mdi mdi-format-quote-open icon"></i>
                                    <i class="mdi mdi-format-quote-open icon-2 text-primary"></i>
                                </div>
                                <div class="swiper home-slider">

                                    <div class="swiper-wrapper">
                                        @foreach ($images as $image)
                                            <div class="swiper-slide">
                                                <div class="home-slide-box text-center">
                                                    <img
                                                        class="img-fluid rounded-3"
                                                        src="{{ RvMedia::getImageUrl($image) }}"
                                                        alt="bg"
                                                    >
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </section>
    @break

    @default
        <section
            class="bg-home2"
            @class(['bg-home2', 'bg-no-mobile-sticky' => ! theme_option('sticky_header_mobile_enabled', true)])
            id="home"
        >
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="mb-4 pb-3 me-lg-5">
                            <span class="sub-title mb-2">{!! BaseHelper::clean($subtitle) !!}</span>
                            <h1 class="display-5 fw-semibold mb-3">{!! BaseHelper::clean(
                                str_replace(
                                    $shortcode->highlight_text,
                                    '<span class="text-primary fw-bold">' . $shortcode->highlight_text . '</span>',
                                    $shortcode->title,
                                ),
                            ) !!}</h1>
                            <p class="lead text-muted mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                        </div>
                        {!! Theme::partial('job-search-box') !!}

                        @if (is_plugin_active('job-board') &&
                            $shortcode->trending_keywords &&
                            ($keywords = array_map('trim', array_filter(explode(',', $shortcode->trending_keywords)))))
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="treding-keywords list-inline mb-0 text-white-50 mt-4 mt-lg-3 text-start">
                                            <li class="list-inline-item text-white">
                                                <i class="mdi mdi-tag-multiple-outline text-warning fs-18"></i>
                                                <span class="text-muted">{{ __('Trending Keywords') }}:</span>
                                            </li>
                                            @foreach ($keywords as $item)
                                                <li class="list-inline-item">
                                                    <a
                                                        href="{{ JobBoardHelper::getJobsPageURL() }}?keyword={{ $item }}" class="text-muted">{{ $item . (!$loop->last ? ',' : '') }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                        @endif
                    </div>

                    @if ($shortcode->image)
                        <div class="col-lg-5">
                            <div class="mt-5 mt-md-0">
                                <img
                                    class="home-img"
                                    src="{{ RvMedia::getImageUrl($shortcode->image) }}"
                                    alt="process"
                                />
                            </div>
                        </div>
                    @endif
                </div>

            </div>

        </section>
    @break

@endswitch

<!-- START SHAPE -->
<div class="position-relative">
    <div class="shape">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            version="1.1"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            preserveAspectRatio="none"
            viewBox="0 0 1440 220"
        >
            <g
                mask="url(&quot;#SvgjsMask1004&quot;)"
                fill="none"
            >
                <path
                    d="M 0,213 C 288,186.4 1152,106.6 1440,80L1440 250L0 250z"
                    fill="rgba(255, 255, 255, 1)"
                ></path>
            </g>
            <defs>
                <mask id="SvgjsMask1004">
                    <rect
                        width="1440"
                        height="250"
                        fill="#ffffff"
                    ></rect>
                </mask>
            </defs>
        </svg>
    </div>
</div>

