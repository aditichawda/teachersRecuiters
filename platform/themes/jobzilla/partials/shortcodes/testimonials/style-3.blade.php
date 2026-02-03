@php
    Theme::asset()->container('footer')->usePath()->add('swiper-js', 'libraries/js/swiper.bundle.min');
    Theme::asset()->usePath()->add('swiper-css', 'libraries/css/swiper.bundle.min.css');
@endphp

<div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-v-area">
    <div class="container">
        <div class="section-content">
            <div class="twm-testimonial-v-section">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <div class="section-head left wt-small-separator-outer">
                                    @if ($title = $shortcode->title)
                                        <div class="wt-small-separator site-text-primary">
                                            <div>{!! BaseHelper::clean($title) !!}</div>
                                        </div>
                                    @endif
                                    @if ($subtitle = $shortcode->subtitle)
                                        <h2>{!! BaseHelper::clean($subtitle) !!}</h2>
                                    @endif
                                    @if ($description = $shortcode->description)
                                        <p>{!! BaseHelper::clean($description) !!}</p>
                                    @endif
                                </div>

                                @if ($shortcode->link || $shortcode->text_link)
                                    <div class="twm-read-more">
                                        <a href="{{ $shortcode->link ?: '#' }}" class="site-button">{{  $shortcode->text_link ?: __('Show All Quotes') }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="v-testimonial-wrap">
                            @if ($iconImage = $shortcode->icon_image)
                                <div class="v-testi-dotted-pic">
                                    <img src="{{ RvMedia::getImageUrl($iconImage)  }}" alt="{{ __('Testimonial') }}">
                                </div>
                            @endif
                            <div class="swiper-container v-testimonial-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                        <div class="testimonials-v">
                                            <div class="twm-testi-media">
                                                <img src="{{ RvMedia::getImageUrl($testimonial->image) }}" alt="{{ $testimonial->name }}">
                                            </div>
                                            <div class="testimonial-v-content">
                                                <div class="t-testimonial-top">
                                                    <div class="t-quote"><i class="fa fa-quote-left"></i></div>
                                                    <div class="t-rating">
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                    </div>
                                                </div>

                                                <div class="t-discription">{!! BaseHelper::clean($testimonial->content) !!}</div>

                                                <div class="twm-testi-detail">
                                                    <div class="twm-testi-name">{{ $testimonial->name }}</div>
                                                    <div class="twm-testi-position">{{ $testimonial->company }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
