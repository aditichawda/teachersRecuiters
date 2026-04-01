<div class="section-full p-t120 site-bg-white twm-our-comu-hpage-6-area" @if($bgImage = $shortcode->bg_image) style="background-image: url({{ RvMedia::getImageUrl($bgImage) }});" @endif>
    <div class="container">
        <div class="wt-separator-two-part content-white">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-8 col-lg-8 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        @if ($subtitle = $shortcode->subtitle)
                            <div class="wt-small-separator site-text-primary">
                                <div>{!! BaseHelper::clean($subtitle) !!}</div>
                            </div>
                        @endif
                        @if ($title = $shortcode->title)
                            <h2 class="wt-title">{!! BaseHelper::clean($title) !!}</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hpage-6-comunity-counter-wrap">
        <div class="container">
            <div class="twm-company-approch6-outer">
                <div class="twm-company-approch6">
                    <div class="row">
                        @foreach($tabs as $tab)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="counter-outer-two">
                                <div class="icon-media-wrap">
                                    <div class="icon-media site-text-white">
                                        @if ($iconImage = Arr::get($tab, 'image'))
                                            <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ Arr::get($tab, 'title') }}" width="64" height="64">
                                        @elseif ($icon = Arr::get($tab, 'icon'))
                                            <i class="{{ $icon }}"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="icon-content">
                                    <div class="tw-count-number site-text-white">
                                        <span class="counter text-clr-green">{{ Arr::get($tab, 'count') }}</span></div>
                                    <p class="icon-content-info">{!! BaseHelper::clean(Arr::get($tab, 'title')) !!}</p>
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
