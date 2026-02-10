<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center mb-4 pb-2">
                    <h2 class="title mb-3">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    <p class="text-muted">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div
                    class="swiper pb-5"
                    id="testimonial-slider"
                >
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="card testimonial-box">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <img
                                                src="{{ RvMedia::getImageUrl($testimonial->image, null, false, RvMedia::getDefaultImage()) }}"
                                                alt="{{ $testimonial->name }}"
                                                height="50"
                                            />
                                        </div>
                                        <div class="testimonial-content lead text-muted mb-4">
                                            {!! BaseHelper::clean($testimonial->content) !!}
                                        </div>
                                        <p class="mb-0 fw-bold">{{ $testimonial->name }}</p>
                                        <p class="text-muted mb-0">{{ $testimonial->company }}</p>
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
</section>
