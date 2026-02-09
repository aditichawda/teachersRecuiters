<div class="section-full mt-5 p-t5 p-b5 site-bg-gray twm-testimonial-2-area">
    <div class="section-head center wt-small-separator-outer mt-5">
        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
<div class="wt-small-separator site-text-primary">
            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
        </div>
    </div>
    <div class="container">
        <div class="section-content">
            <div class="owl-carousel twm-testimonial-2-carousel owl-btn-bottom-center">
                @foreach ($testimonials as $testimonial)
                    <div class="item">
                        <div class="twm-testimonial-2">
                            <div class="twm-testimonial-2-content">
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
