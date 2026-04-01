<!-- How It Work START -->
<div class="section-full site-bg-primary twm-how-it-work-1-area">
    <div class="container">
        <div class="section-content">
            <div class="twm-how-it-work-1-content">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="twm-how-it-work-1-left">
                            <div class="twm-how-it-work-1-section">
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator">
                                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                                    </div>
                                    <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                                </div>
                                <div class="twm-step-section-4">
                                    <ul>
                                        @foreach ($tabs as $tab)
                                            <li>
                                                <div class="twm-step-count" @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>{{ $loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration }}</div>
                                                <div class="twm-step-content">
                                                    <h4 class="twm-title">{{ Arr::get($tab, 'title') }}</h4>
                                                    <p>{{ Arr::get($tab, 'subtitle') }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="twm-how-it-right-section">
                            <div class="twm-media">
                                <div class="twm-bg-circle">
                                    <img src="{{ Theme::asset()->url('images/bg-circle-large.png') }}" alt="bg-circle-large">
                                </div>
                                <div class="twm-block-left anm" data-speed-x="-4" data-speed-scale="-25">
                                    <img src="{{ Theme::asset()->url('images/block-left.png') }}" alt="block-left">
                                </div>
                                <div class="twm-block-right anm" data-speed-x="-4" data-speed-scale="-25">
                                    <img src="{{ Theme::asset()->url('images/block-right.png') }}" alt="block-right">
                                </div>
                                <div class="twm-main-bg anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
                                    @if ($shortcode->image)
                                        <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->image }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- How It Work END -->
