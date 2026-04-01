@php
    AdminBar::setIsDisplay(false);
@endphp
<div class="section-full site-bg-gray twm-c-soon-area"
    @if ($shortcode->bg_image)
        style="background-image:url({{ RvMedia::getImageUrl($shortcode->bg_image) }})"
    @endif>
    <div class="twm-c-soon-wrap">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="twm-c-soon-content">
                    <h2 class="twm-c-soon-title">
                        <span class="site-text-primary">{!! BaseHelper::clean($shortcode->title) !!}</span>
                        {!! BaseHelper::clean($shortcode->subtitle) !!}
                    </h2>

                    @if (is_plugin_active('newsletter') && $shortcode->show_newsletter != 'no')
                        <p class="twm-c-soon-title2">{!! BaseHelper::clean($shortcode->description) !!}</p>
                        {!!
                            Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                ->formClass('newsletter-form')
                                ->modify('wrapper_before', 'html', \Botble\Base\Forms\FieldOptions\HtmlFieldOption::make()->content('<div class="cs-nw-form">')->toArray())
                                ->modify(
                                    'submit',
                                    'submit',
                                    Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                        ->label(__('Notify Me'))
                                        ->cssClass('cs-subcribe-btn')
                                        ->toArray(),
                                )
                                ->setFormEndKey('wrapper_after_after')
                                ->renderForm()
                        !!}
                    @endif

                    @if ($socialLinks = Theme::getSocialLinks())
                        <ul class="social-icons">
                            @foreach($socialLinks as $socialLink)
                                @continue(! $socialLink->getUrl() || ! $socialLink->getIconHtml())

                                <li>
                                    <a {!! $socialLink->getAttributes(['class' => 'd-block']) !!}>{{ $socialLink->getIconHtml() }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="twm-countdown-wrap">
                        @if ($shortcode->date && $shortcode->time)
                            @php
                                $date = $shortcode->date . ' ' . (Str::length($shortcode->time) == 5 ? ($shortcode->time . ':00') : $shortcode->time);
                                $date = Carbon\Carbon::createFromFormat(config('core.base.general.date_format.date_time'), $date);
                            @endphp
                            @if ($date)
                                <div id="timer" class="d-none" data-endtime="{{ $date }}">
                                    <span id="days">
                                        <time>0</time>
                                        <span>{{ __('Days') }}</span>
                                    </span>
                                    <span id="hours">
                                        <time>0</time>
                                        <span>{{ __('Hrs') }}</span>
                                    </span>
                                    <span id="minutes">
                                        <time>0</time>
                                        <span>{{ __('Mins') }}</span>
                                    </span>
                                    <span id="seconds">
                                        <time>0</time>
                                        <span>{{ __('Secs') }}</span>
                                    </span>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
