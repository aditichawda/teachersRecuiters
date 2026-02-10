@php AdminBar::setIsDisplay(false); @endphp

<section class="bg-coming-soon bg-auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center">
                    @if ($shortcode->image)
                        <div class="mb-4 pb-3">
                            <img
                                class="mg-fluid"
                                src="{{ RvMedia::getImageUrl($shortcode->image) }}"
                                alt="image"
                                height="150"
                            >
                        </div>
                    @endif
                    <h1>{!! BaseHelper::clean($shortcode->title) !!}</h1>
                    <p class="text-muted mb-4 pb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                    @if ($date)
                        <div
                            class="d-flex"
                            id="countdown"
                            data-datetime="{{ $date }}"
                        ></div>
                    @endif
                    @if (is_plugin_active('newsletter') && $shortcode->show_newsletter != 'no')
                        {!!
                            Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                ->setFormOption('class', 'coming-soon-subscribe mt-4 newsletter-form')
                                ->setFormInputClass('form-control text-dark')
                                ->renderForm()
                        !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
