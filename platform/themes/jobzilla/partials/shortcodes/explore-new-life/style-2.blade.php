<!-- EXPLORE NEW LIFE START -->
<div class="section-full p-t120 p-b120 site-bg-white twm-explore-area2">
    <div class="container">
        <div class="section-content">
            <div class="twm-explore-content-2">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <div class="twm-title-small">{!! BaseHelper::clean($shortcode->title) !!}</div>
                                <div class="twm-title-large">
                                    <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}r</h2>
                                    <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                                </div>
                                @if ($shortcode->button_url)
                                    <div class="twm-read-more">
                                        <a href="{{ $shortcode->button_url }}" class="site-button">{{ $shortcode->button_name ?: __('Read More') }} <i class="{{ $shortcode->button_icon }}"></i></a>
                                    </div>
                                @endif
                            </div>

                            <div class="twm-explore-bottom-section">
                                <div class="row">
                                    @foreach ($tabs as $tab)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="counter-outer-two">
                                                <div class="icon-content">
                                                    <div class="tw-count-number text-clr-{{ Arr::random(['yellow-2', 'green', 'pink']) }}">
                                                        <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                                                    </div>
                                                    <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="twm-explore-media-wrap2">
                            <div class="twm-media">
                                @if ($shortcode->image)
                                    <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->title }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- EXPLORE NEW LIFE END -->
