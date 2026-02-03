<div
    class="section-full p-t120 p-b120 twm-explore-area bg-cover"
    @if ($shortcode->bg_image)
        style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image) }});"
    @endif
>
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="twm-explore-media-wrap">
                        <div class="twm-media">
                            @if ($shortcode->image)
                                <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->title }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="twm-explore-content-outer">
                        <div class="twm-explore-content">
                            <div class="twm-l-line-1"></div>
                            <div class="twm-l-line-2"></div>

                            <div class="twm-r-circle-1"></div>
                            <div class="twm-r-circle-2"></div>

                            <div class="twm-title-small">{!! BaseHelper::clean($shortcode->title) !!}</div>
                            <div class="twm-title-large">
                                <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                                <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                            </div>
                            @if ($shortcode->button_url)
                                <div class="twm-upload-file">
                                    <a href="{{ $shortcode->button_url }}" class="site-button">{{ $shortcode->button_name ?: __('View more') }} <i class="{{ $shortcode->button_icon }}"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="twm-bold-circle-right"></div>
                        <div class="twm-bold-circle-left"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
