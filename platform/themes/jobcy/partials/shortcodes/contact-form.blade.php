<!-- START CONTACT-PAGE -->
<section class="section">
    <div class="container">
        <div class="row align-items-center mt-5">
            <div class="col-lg-6">
                <div class="section-title mt-4 mt-lg-0">
                    <h2 class="title">{{ $shortcode->title }}</h2>
                    <p class="text-muted">{{ $shortcode->subtitle }}</p>
                    {!!
                        $form
                            ->formClass('mt-4')
                            ->setFormInputClass('form-control')
                            ->modify('submit', 'submit', ['label' => __('Send message') . '<i class="uil uil-message ms-1"></i>', 'attr' => ['class' => 'btn btn-primary']], true)
                            ->renderForm()
                    !!}
                </div>
            </div>
            <div class="col-lg-5 ms-auto order-first order-lg-last">
                @if ($shortcode->image)
                    <div class="text-center">
                        <img
                            class="img-fluid"
                            src="{{ RvMedia::getImageUrl($shortcode->image) }}"
                            alt="image"
                        >
                    </div>
                @endif
                <div class="mt-4 pt-3">
                    @if ($shortcode->address)
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-map-marker"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">{{ $shortcode->address }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($shortcode->email)
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-envelope"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0">{{ Html::mailto($shortcode->email) }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($shortcode->phone)
                        <div class="d-flex text-muted align-items-center mt-2">
                            <div class="flex-shrink-0 fs-22 text-primary">
                                <i class="uil uil-phone-alt"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0"><a href="tel:{{ $shortcode->phone }}">{{ $shortcode->phone }}</a></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

</section>
