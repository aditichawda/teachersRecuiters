@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
@endphp
<div class="twm-home4-banner-section site-bg-light-purple">
    <div class="row">
        <!--Left Section-->
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="twm-bnr-left-section">
                <div class="twm-bnr-title-large">{!! BaseHelper::clean($subtitle) !!}</div>
                <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>
                @if (is_plugin_active('job-board'))
                    {!! Theme::partial('shortcodes.search-bar.form-mini') !!}
                    {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
                @endif
            </div>
        </div>

        <!--right Section-->
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="twm-bnr-right-section anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">

                <div class="twm-graphics-h3 twm-bg-line">
                    <img src="{{ Theme::asset()->url('images/bg-line.png') }}" alt="bg-line">
                </div>

                <div class="twm-graphics-user twm-user">
                    <img src="{{ $shortcode->banner_1 ? RvMedia::getImageUrl($shortcode->banner_1) : Theme::asset()->url('images/user.png') }}" alt="user">
                </div>

                <div class="twm-graphics-h3 twm-bg-plate">
                    <img src="{{ Theme::asset()->url('images/bg-plate.png') }}" alt="bg-plate">
                </div>

                <div class="twm-graphics-h3 twm-checked-plate">
                    <img src="{{ Theme::asset()->url('images/checked-plate.png') }}" alt="checked-plate">
                </div>

                <div class="twm-graphics-h3 twm-blue-block">
                    <img src="{{ Theme::asset()->url('images/blue-block.png') }}" alt="blue-block">
                </div>

                <div class="twm-graphics-h3 twm-color-dotts">
                    <img src="{{ Theme::asset()->url('images/color-dotts.png') }}" alt="color-dotts">
                </div>

                <div class="twm-graphics-h3 twm-card-large anm" data-speed-y="-2" data-speed-scale="-15"
                    data-speed-opacity="50">
                    <img src="{{ Theme::asset()->url('images/card.png') }}" alt="card">
                </div>

                <div class="twm-graphics-h3 twm-card-s1 anm" data-speed-y="2" data-speed-scale="15"
                    data-speed-opacity="50">
                    <img src="{{ Theme::asset()->url('images/card-s1.png') }}" alt="card-s1">
                </div>

                <div class="twm-graphics-h3 twm-card-s2 anm" data-speed-x="-4" data-speed-scale="-25"
                    data-speed-opacity="50">
                    <img src="{{ Theme::asset()->url('images/card-s2.png') }}" alt="card-s2">
                </div>

                <div class="twm-graphics-h3 twm-white-dotts">
                    <img src="{{ Theme::asset()->url('images/white-dotts.png') }}" alt="white-dotts">
                </div>

                <div class="twm-graphics-h3 twm-top-shadow anm" data-speed-x="-16" data-speed-y="2"
                    data-speed-scale="50" data-speed-rotate="25">
                    <img src="{{ Theme::asset()->url('images/top-shadow.png') }}" alt="top-shadow">
                </div>

                <div class="twm-graphics-h3 twm-bottom-shadow anm" data-speed-x="16" data-speed-y="2"
                    data-speed-scale="20" data-speed-rotate="25">
                    <img src="{{ Theme::asset()->url('images/bottom-shadow.png') }}" alt="bottom-shadow">
                </div>
            </div>
        </div>
    </div>
</div>
