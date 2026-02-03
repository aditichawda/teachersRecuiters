@php
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-white">${1}</span>', $shortcode->title ?: '');
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
@endphp

<div class="twm-home-6-banner-section">
    <div class="container">
        <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="twm-bnr-left-section">
                    @if($subtitle)
                        <div class="twm-bnr-title-small">
                            <div class="bnr-title-bedge">
                                <i class="fa fa-check"></i>
                            </div>
                            {!! BaseHelper::clean($subtitle) !!}
                        </div>
                    @endif
                    @if ($title)
                        <div class="twm-bnr-title-large">
                            {!! BaseHelper::clean($title) !!}
                        </div>
                    @endif

                    @if($description = $shortcode->description)
                        <div class="twm-bnr-discription">{!! BaseHelper::clean($description) !!}</div>
                    @endif

                    @if (is_plugin_active('job-board'))
                        {!! Theme::partial('shortcodes.search-bar.form') !!}
                        {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
                    @endif

                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-section">
                <div class="twm-bnr-right-content">
                    @if ($banner = $shortcode->banner_1)
                        <div class="bnr-media">
                            <img src="{{ RvMedia::getImageUrl($banner) }}" alt="{{ __('Banner hero')  }}">
                        </div>
                    @endif
                    <div class="bnr-bg-circle">
                        <span></span>
                    </div>
                    <div class="bnr-bg-icons">
                        <div class="icon-plus1 bounce"><i class="fa fa-plus"></i></div>
                        <div class="icon-plus2 bounce2"><i class="fa fa-plus"></i></div>
                        <div class="icon-plus3 bounce"><i class="fa fa-plus"></i></div>
                        <div class="icon-ring1 bounce2"></div>
                        <div class="icon-ring2 bounce"></div>
                        <div class="icon-ring3 bounce2"></div>

                        @foreach($tabs as $key => $value)
                            @if($value['image'] && $value['title'] && $value['count'] == null)
                                <div class="bnr-block-1 bounce">
                                    <div class="bnr-block-1-content">
                                        <div class="media"><img src="{{ RvMedia::getImageUrl($value['image']) }}" alt="{{ $value['title'] }}"></div>
                                        <h3 class="title">{!! BaseHelper::clean($value['title']) !!}</h3>
                                    </div>
                                </div>
                            @endif
                            @if($value['image'] && $value['title'] && $value['count'])
                                <div class="bnr-block-2 bounce2">
                                    <div class="bnr-block-2-content">
                                        <div class="bnr-block-2-bag">
                                            <span><img src="{{ RvMedia::getImageUrl($value['image']) }}" alt="{{ $value['title'] }}"></span>
                                        </div>
                                        <div class="bnr-block-2-content-top">
                                            <h3 class="title">{{ $value['count'] }} {{ $value['extra'] }}</h3>
                                            <div class="media"><img src="{{ Theme::asset()->url('images/graph-icon.png') }}" alt="{{ $value['title'] }}"></div>
                                        </div>
                                        <div class="bnr-block-2-content-bottom">{!! BaseHelper::clean($value['title']) !!}</div>
                                    </div>
                                </div>
                            @endif

                            @if($value['image'] && $value['title'] == null && $value['count'] == null)
                                <div class="bnr-block-3 bounce">
                                    <img src="{{ RvMedia::getImageUrl($value['image']) }}" alt="{{ $value['image'] }}">
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
