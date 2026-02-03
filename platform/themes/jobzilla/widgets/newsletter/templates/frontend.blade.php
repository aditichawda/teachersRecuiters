@if (is_plugin_active('newsletter'))
    <!-- NEWS LETTER SECTION START -->
    <div class="row">
        <div class="col-md-5">
            <div class="ftr-nw-title">{!! BaseHelper::clean($config['subtitle']) !!}</div>
        </div>
        <div class="col-md-7">
            {!!
                Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                    ->formClass('newsletter-form newsletter-main-form')
                    ->modify('wrapper_before', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('<div class="ftr-nw-form position-relative">')->toArray())
                    ->modify(
                        'submit',
                        'submit',
                        Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                            ->label(__('Subscribe'))
                            ->cssClass('ftr-nw-subcribe-btn')
                            ->toArray(),
                    )
                    ->setFormEndKey('wrapper_after_after')
                    ->renderForm()
            !!}
        </div>
    </div>
    <!-- NEWS LETTER SECTION END -->
@endif

