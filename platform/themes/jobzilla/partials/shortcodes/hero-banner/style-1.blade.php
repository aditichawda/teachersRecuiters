@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
@endphp
<!--Banner Start-->
<div class="twm-home1-banner-section site-bg-gray bg-cover"
    @if ($shortcode->bg_image_1) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }})" @endif>
    <div class="row">
        <!--Left Section-->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="twm-bnr-left-section">
                <div class="twm-bnr-title-small">{!! BaseHelper::clean($title) !!}</div>
                <div class="twm-bnr-title-large">{!! BaseHelper::clean($subtitle) !!}</div>
                <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>
                @if (is_plugin_active('job-board'))
                    {!! Theme::partial('shortcodes.search-bar.form') !!}
                    {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
                @endif
            </div>
        </div>

        <!--right Section-->
        <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-section">
            <div class="twm-bnr-right-content">

                <div class="twm-img-bg-circle-area">
                    <div class="twm-img-bg-circle1 rotate-center"><span></span></div>
                    <div class="twm-img-bg-circle2 rotate-center-reverse"><span></span></div>
                    <div class="twm-img-bg-circle3"><span></span></div>
                </div>

                <div class="twm-bnr-right-carousel">
                    <div class="owl-carousel twm-h1-bnr-carousal">
                        @if ($shortcode->banner_1)
                            <div class="item">
                                <div class="slide-img">
                                    <img src="{{ RvMedia::getImageUrl($shortcode->banner_1) }}" alt="{{ $shortcode->banner_1 }}">
                                </div>
                            </div>
                        @endif

                        @if ($shortcode->banner_2)
                            <div class="item">
                                <div class="slide-img">
                                    <div class="slide-img">
                                        <img src="{{ RvMedia::getImageUrl($shortcode->banner_2) }}" alt="{{ $shortcode->banner_2 }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="twm-bnr-blocks-position-wrap">
                        @foreach ($tabs as $tab)
                            <div class="twm-bnr-blocks twm-bnr-blocks-position-{{ $loop->iteration }}">
                                <div class="twm-icon align-items-center d-flex">
                                    @if (Arr::get($tab, 'image'))
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image')) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    @endif
                                </div>
                                <div class="twm-content">
                                    <div class="tw-count-number text-clr-{{ Arr::random(['sky', 'pink', 'green']) }}">
                                        <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                                    </div>
                                    <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--Samll Ring Left-->
                <div class="twm-small-ring-l slide-top-animation"></div>
                <div class="twm-small-ring-2 slide-top-animation"></div>
            </div>
        </div>
    </div>
    @if ($shortcode->gradient_text)
        <div class="twm-gradient-text">{{ $shortcode->gradient_text }}</div>
    @endif
</div>
<!--Banner End-->
