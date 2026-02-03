@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
@endphp
<div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-page7-wrap">
    <div class="container">

        <div class="twm-testimonial-page7-section">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="twm-testimonial-page7-left">
                        <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                                <div>{!! BaseHelper::clean($title) !!}</div>
                            </div>
                            <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
                        </div>
                        <!-- TITLE END-->
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="twm-testimonial-page7-right">
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
                                                <div class="twm-testi-position">{{ $testimonial->company }}</div>
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
            <div class="testimonial-outline-text">
                @if ($shortcode->testimonial_outline_text)
                    <span>{!! BaseHelper::clean($shortcode->testimonial_outline_text) !!}</span>
                @endif
            </div>
        </div>

    </div>

</div>
