<!-- TESTIMONIAL SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-1-area">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-5 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                        </div>
                        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-content">
            <div class="owl-carousel twm-testimonial-1-carousel owl-btn-bottom-center">
                @foreach ($testimonials as $testimonial)
                    <div class="item">
                        <div class="twm-testimonial-1">
                            <div class="twm-testimonial-1-content">
                                <div class="twm-testi-media">
                                    <img src="{{ RvMedia::getImageUrl($testimonial->image) }}" alt="{{ $testimonial->name }}">
                                </div>
                                <div class="twm-testi-content">
                                    <div class="twm-quote">
                                        <img src="{{ Theme::asset()->url('/images/quote-dark.png') }}" alt="{{ $testimonial->name }}">
                                    </div>
                                    <div class="twm-testi-info">{!! BaseHelper::clean($testimonial->content) !!}</div>
                                    <div class="twm-testi-detail">
                                        <div class="twm-testi-name">{{ $testimonial->name }}</div>
                                        <div class="twm-testi-position">{{ $testimonial->company }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- TESTIMONIAL SECTION END -->
