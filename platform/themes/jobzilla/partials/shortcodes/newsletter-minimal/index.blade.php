<div class="section-full p-t60 site-bg-white twm-new-sub-section-wrap site-bg-cover"
     @if($bgImage = $shortcode->bg_image) style="background-image: url({{ RvMedia::getImageUrl($bgImage) }});" @endif>
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="twm-nl-map-media-wrap">
                        <div class="twm-nl-map-pointer">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="twm-nl-map-pic nw-pic{{ $i }} bounce">
                                    <img src="{{ RvMedia::getImageUrl($shortcode->{'icon_image_'. $i}) }}" alt="{{ __('Newsletter form') }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="twm-sub-2-section site-bg-cover" style="background-image: url(images/nwl-bg.png);">
                        @if($title = $shortcode->title)
                            <h3 class="twm-sub-title">{!! BaseHelper::clean($title) !!}</h3>
                        @endif

                        @if($subtitle = $shortcode->subtitle)
                            <div class="twm-sub-discription">{!! BaseHelper::clean($subtitle) !!}</div>
                        @endif
                        {!!
                            Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                ->formClass('newsletter-form newsletter-minimal-form')
                                ->modify('wrapper_before', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('<div class="ftr-nw-form">')->toArray())
                                ->modify(
                                    'submit',
                                    'submit',
                                    Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                        ->label(__('Subscribe Now'))
                                        ->cssClass('site-button twm-sub-btn white')
                                        ->toArray(),
                                )
                                ->setFormEndKey('wrapper_after_after')
                                ->renderForm()
                        !!}
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="twm-nl-map-media-wrap">
                        <div class="twm-nl-map-pointer">
                            @for($i = 5; $i <= 7; $i++)
                                <div class="twm-nl-map-pic nw-pic{{ $i }} bounce">
                                    <img src="{{ RvMedia::getImageUrl($shortcode->{'icon_image_'. $i}) }}" alt="{{ __('Newsletter form') }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
