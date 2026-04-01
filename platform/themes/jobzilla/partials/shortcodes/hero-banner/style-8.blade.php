@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
    $description = preg_replace('/\{\{(.*)\}\}/', '<span class="text-clr-pink">${1}</span>', $shortcode->description ?: '');
@endphp
<!--Banner Start-->
<div class="twm-home8-banner-section site-bg-white bg-cover" @if ($shortcode->bg_image_1) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }})" @endif>
    <div class="container">
        <div class="twm-home8-inner-section">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="twm-bnr-left-section">
                        <div class="twm-bnr-title-large">{!! BaseHelper::clean($title) !!}</div>
                        <div class="twm-bnr-title-large">{!! BaseHelper::clean($subtitle) !!}</div>
                        <div class="twm-bnr-discription">{!! BaseHelper::clean($description) !!}</div>
                        @if (is_plugin_active('job-board'))
                            {!! Theme::partial('shortcodes.search-bar.form') !!}
                        @endif

                    </div>
                </div>
                @if ($shortcode->banner_1)
                    <div class="col-lg-5 col-md-12">
                        <div class="bnr-media bounce2">
                            <img src="{{ RvMedia::getImageUrl($shortcode->banner_1) }}" alt="{{ $shortcode->banner_1 }}">
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="twm-bnr-bottom-section">
            @if ($shortcode->gradient_text)
                <div class="twm-browse-jobs">{{ $shortcode->gradient_text }}</div>
            @endif
        </div>
    </div>

</div>
<!--Banner End-->
