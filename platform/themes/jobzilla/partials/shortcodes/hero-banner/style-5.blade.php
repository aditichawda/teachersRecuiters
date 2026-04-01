@php
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
    $candidate = $tabs[0];
@endphp

<div class="twm-home5-banner-section" style="background-image: url('{{ Theme::asset()->url('images/bg-1.jpg') }}');">
    <div class="row">
        <!--Left Section-->
        <div class="col-xl-6 col-lg-6 col-md-12 btm-bdr-banner">
            <div class="twm-bnr-left-section">
                <div class="twm-bnr-title-large">{!! BaseHelper::clean($title) !!}</div>
                @if($subtitle = $shortcode->subtitle)
                    <div class="twm-bnr-discription">{!! BaseHelper::clean($subtitle) !!}</div>
                @endif
                @if (is_plugin_active('job-board'))
                    {!! Theme::partial('shortcodes.search-bar.form') !!}
                    {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
                @endif

                <div class="twm-bnr-5-blocks">
                    <span class="twm-title">{!! BaseHelper::clean($candidate['title']) !!}</span>
                    <div class="twm-bnr-5-blocks-inner">
                        <div class="twm-pics">
                            <div class="twm-icon">
                                <img src="{{ RvMedia::getImageUrl($candidate['image']) }}" alt="{{ $candidate['title'] }}">
                            </div>
                        </div>
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-green">
                                <span class="counter">{{ $candidate['count'] }}</span>{{ $candidate['extra'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--right Section-->
        <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-main">
            <div class="twm-bnr-right-section anm">
                <div class="twm-bnr-right-section-inner anm"  data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
                    @if($banner = $shortcode->banner_1)
                        <div class="twm-graphics-h5 twm-p1">
                            <img src="{{ RvMedia::getImageUrl($banner) }}" alt="{{ __('Homepage 5') }}">
                        </div>
                    @endif
                    @for($i = 1; $i <= 3; $i++)
                        @if($bgImage = $shortcode->{'bg_image_' . $i})
                            <div class="twm-graphics-h5 twm-p{{ $i + 1 }}">
                                <img src="{{ RvMedia::getImageUrl($bgImage) }}" alt="{{ __('Homepage 5') }}">
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="twm-banner-h5-r-b-info">
                @if ($titleBottom = $shortcode->title_bottom)
                    <span>{!! BaseHelper::clean($titleBottom) !!}</span>
                @endif
                @if ($subtitleBottom = $shortcode->subtitle_bottom)
                    <h3 class="twm-banner-h5-r-b-outline-text">
                        {!! BaseHelper::clean($subtitleBottom) !!}
                    </h3>
                @endif
            </div>
        </div>
    </div>

</div>
