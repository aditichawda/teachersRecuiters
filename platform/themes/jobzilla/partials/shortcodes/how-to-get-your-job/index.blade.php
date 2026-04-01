@php
    $tabs = [];
    $quantity = max((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if (($title = $shortcode->{'title_' . $i})) {
                $bgColor = $shortcode->{'bg_color_' . $i};
                $tabs[] = [
                    'title' => $title,
                    'subtitle' => $shortcode->{'subtitle_' . $i},
                    'site_button_title' => $shortcode->{'site_button_title_' . $i},
                    'site_link_link' => $shortcode->{'site_button_link_' . $i},
                    'image' => $shortcode->{'image_' . $i},
                    'bg_color' => $bgColor
                ];
            }
        }
    }
@endphp
<div class="section-full p-t120 p-b90 site-bg-gray twm-how-t-get-wrap7">

    <div class="container">

        <div class="twm-how-t-get-section">
            <div class="row">

                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="twm-how-t-get-section-left">
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                            </div>
                            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                            <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                        </div>
                        @if ($shortcode->button_url)
                        <div class="twm-how-t-get-bottom">
                            <a href="{{ $shortcode->button_url }}" class="site-button">{!! BaseHelper::clean($shortcode->button_name) !!}</a>
                            @if ($shortcode->icon)
                            <div class="twm-left-icon-bx">
                                <div class="twm-left-icon-media site-bg-primary">
                                    <i class="{{ $shortcode->icon }} site-text-white"></i>
                                </div>
                                <div class="twm-left-icon-content">
                                    @if ($shortcode->icon_title)
                                        <h4 class="icon-title">{!! BaseHelper::clean($shortcode->icon_title) !!}</h4>
                                    @endif
                                    @if ($shortcode->icon_subtitle)
                                        <p>{!! BaseHelper::clean($shortcode->icon_subtitle) !!}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="twm-how-t-get-section-right">
                        <div class="twm-media">
                            @if ($shortcode->image)
                                <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->title }}">
                            @endif
                        </div>

                        @foreach ($tabs as $key => $tab)
                            @if (!Arr::get($tab, 'site_button_title'))
                                <div class="twm-left-img-bx bounce" @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>
                                    <div class="twm-left-img-media">
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    </div>
                                    <div class="twm-left-img-content">
                                        <h4 class="icon-title">{{ Arr::get($tab, 'title') }}</h4>
                                        <p>{{ Arr::get($tab, 'subtitle') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="twm-profile-card bounce2" @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>
                                    <div class="twm-profile-pic">
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    </div>
                                    <div class="twm-profile-info">
                                        <h4 class="twm-profile-name">
                                            {{ Arr::get($tab, 'title') }}
                                        </h4>
                                        <div class="twm-profile-position">{{ Arr::get($tab, 'subtitle') }}</div>
                                            <a class="site-button-link underline" href="{{ Arr::get($tab, 'site_button_link') }}">{{ Arr::get($tab, 'site_button_title') }}</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
