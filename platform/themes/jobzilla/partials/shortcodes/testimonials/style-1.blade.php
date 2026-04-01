<!-- TESTIMONIAL SECTION START -->
<style>
.twm-testimonial-1-carousel .owl-item {
    width: 100% !important;
    max-width: 100% !important;
}
.twm-testimonial-1-carousel .item {
    width: 100% !important;
    max-width: 100% !important;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var carousel = $('.twm-testimonial-1-carousel');
    if (carousel.length && carousel.data('owl.carousel')) {
        carousel.trigger('destroy.owl.carousel');
    }
    if (carousel.length) {
        carousel.owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            margin: 30,
            autoplay: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: { items: 1 },
                480: { items: 1 },
                991: { items: 1 }
            }
        });
    }
});
</script>
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
