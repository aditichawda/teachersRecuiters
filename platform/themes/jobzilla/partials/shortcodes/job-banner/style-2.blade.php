@php
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
    $titleCompany = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title_company_slider ?: '');
@endphp

<div class="section-full site-bg-white h-page6-getjobs-wrap">
    <div class="h-page6-client-slider-outer">
        <div class="container">
            <div class="h-page6-client-slider">
                <div class="row">
                    <div class="col-xl-4 col-lg-12">
                        @if($titleCompany)
                            <div class="h-page-6-client-slide-title">{!! BaseHelper::clean($titleCompany) !!}</div>
                        @endif
                    </div>

                    <div class="col-xl-8 col-lg-12">
                        <div class="owl-carousel home-client-carousel6 owl-btn-vertical-center">
                            @foreach($companies as $company)
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                            <a href="{{ $company->url }}"><img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}"></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="h-page-6-getjobs-wrap">
            <div class="row">

                <div class="col-lg-7 col-md-12">
                    <div class="h-page-6-getjobs-left">

                        <div class="twm-media">
                            @if ($image = $shortcode->image)
                                <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('Job banner') }}">
                            @endif
                            <div class="twm-media-bg-circle"></div>
                            <div class="twm-media-bg-circle2"></div>
                            <div class="twm-media-bg-circle3">
                                <div class="rotate-center">
                                    <span class="ring1"></span>
                                    <span class="ring2"></span>
                                    <span class="ring3"></span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="h-page-6-getjobs-right">
                        <div class="section-head left wt-small-separator-outer">
                            @if ($subtitle = $shortcode->subtitle)
                                <div class="wt-small-separator site-text-primary">
                                    <div>{!! BaseHelper::clean($subtitle) !!}</div>
                                </div>
                            @endif
                            @if ($title)
                                <h2 class="wt-title">
                                    {!! BaseHelper::clean($title) !!}
                                </h2>
                            @endif
                            @if ($description = $shortcode->description)
                                {!! BaseHelper::clean($description) !!}
                            @endif
                        </div>
                        @if ($shortcode->button_primary_url || $shortcode->button_primary_label)
                            <div class="twm-read-more mt-4">
                                <a href="{{ $shortcode->button_primary_url ?: '#' }}" class="site-button">{{ $shortcode->button_primary_label ?: __('About more') }}</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
