<!-- START CTA -->
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center">
                <h2 class="title mb-4 pb-2">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                <p class="para-desc text-muted mx-auto">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                <div class="mt-4">
                    @if ($shortcode->button_1_url && ($shortcode->button_1_text || $shortcode->button_1_icon))
                        <a
                            class="btn btn-primary btn-hover mt-2"
                            href="{{ url($shortcode->button_1_url) }}"
                        >
                            @if ($shortcode->button_1_icon)
                                <i class="{{ $shortcode->button_1_icon }}"></i>
                            @endif {{ $shortcode->button_1_text }}
                        </a>
                    @endif

                    @if ($shortcode->button_2_url && ($shortcode->button_2_text || $shortcode->button_2_icon))
                        <a
                            class="btn btn-outline-primary btn-hover ms-sm-2 mt-2"
                            href="{{ url($shortcode->button_2_url) }}"
                        >
                            @if ($shortcode->button_2_icon)
                                <i class="{{ $shortcode->button_2_icon }}"></i>
                            @endif {{ $shortcode->button_2_text }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CTA -->
