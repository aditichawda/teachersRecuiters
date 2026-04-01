<!-- Testimonial START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-page8-wrap">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
        </div>
        <!-- TITLE END-->
        <div class="twm-testimonial-page8-section">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="twm-testimonial-page8-left">
                        @if ($shortcode->banner_image)
                        <div class="twm-media bounce2">
                            <img src="{{ RvMedia::getImageUrl($shortcode->banner_image) }}" alt="{{ $shortcode->title }}">
                        </div>
                        @endif
                        <div class="testimonial-outline-text-small">
                            @if ($shortcode->testimonial_outline_text)
                                <span>{!! BaseHelper::clean($shortcode->testimonial_outline_text) !!}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="twm-testimonial-page8-right">
                        <div class="testimonial-thumb-1-wrap">
                            <div class="swiper testimonial-thumb-1">
                                <div class="swiper-wrapper">
                                    @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="twm-testi-content">
                                            <div class="t-testimonial-top">
                                                <div class="t-quote"><i class="fa fa-quote-left"></i></div>
                                            </div>
                                            <div class="t-discription">{!! BaseHelper::clean($testimonial->content) !!}</div>
                                            <div class="twm-testi-detail">
                                                <div class="twm-testi-name">{{ $testimonial->name }}</div>
                                                <div class="twm-testi-position">S{{ $testimonial->company }}z</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <div thumbsSlider="" class="swiper testimonial-thumbpic-1">
                                <div class="swiper-wrapper">
                                    @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="twm-testi-media">
                                            <img src="{{ RvMedia::getImageUrl($testimonial->image) }}" alt="{{ $testimonial->name }}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- Testimonial END -->
