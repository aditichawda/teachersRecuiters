<!-- EXPLORE NEW LIFE START -->
<div class="section-full site-bg-light-purple twm-for-employee-4">
    <div class="container">
        <div class="section-content">
            <div class="twm-for-employee-content">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <div class="section-head left wt-small-separator-outer">
                                    <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                                    <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                                    <div class="wt-small-separator site-text-primary">
                                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                                    </div>
                                    
                                </div>
                                @if ($shortcode->button_url)
                                    <div class="twm-read-more">
                                        <a href="{{ $shortcode->button_url }}" class="site-button">{{ $shortcode->button_name ?: __('Read More') }} <i class="{{ $shortcode->button_icon }}"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="twm-explore-right-section">
                            <div class="twm-media">
                                <div class="twm-bg-circle">
                                    <img src="{{ Theme::asset()->url('images/bg-circle.png') }}" alt="bg-circle">
                                </div>
                                <div class="twm-employee-pic">
                                    @if ($shortcode->image)
                                        <img src="{{ RvMedia::getImageUrl($shortcode->image) }}" alt="{{ $shortcode->image }}">
                                    @endif
                                </div>
                                <div class="twm-shot-pic1 anm" data-speed-x="-4" data-speed-scale="-25">
                                    <img src="{{ Theme::asset()->url('images/sq-1.png') }}" alt="sq-1">
                                </div>
                                <div class="twm-shot-pic2 anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
                                    <img src="{{ Theme::asset()->url('images/triangle.png') }}" alt="triangle">
                                </div>
                                <div class="twm-shot-pic3 anm" data-speed-x="-4" data-speed-scale="-25">
                                    <img src="{{ Theme::asset()->url('images/circle.png') }}" alt="circle">
                                </div>
                            </div>

                            @php
                                $tabAttributes = [
                                    [
                                        'class' => 'one',
                                        'y' => '-2',
                                        'scale' => '15',
                                        'opacity' => '1',
                                        'color' => 'yellow-2',
                                    ],
                                    [
                                        'class' => 'two',
                                        'y' => '2',
                                        'scale' => '15',
                                        'opacity' => '5',
                                        'color' => 'green',
                                    ],
                                    [
                                        'class' => 'three',
                                        'y' => '-4',
                                        'scale' => '25',
                                        'color' => 'pink',
                                    ],
                                ];
                            @endphp
                            
                            @foreach ($tabs as $tab)
                                <div class="counter-outer-two anm {{ Arr::get($tabAttributes, $loop->index . '.class') }}"
                                    data-speed-y="{{ Arr::get($tabAttributes, $loop->index . '.y') }}"
                                    data-speed-scale="{{ Arr::get($tabAttributes, $loop->index . '.scale') }}"
                                    data-speed-opacity="{{ Arr::get($tabAttributes, $loop->index . '.opacity') }}">
                                    <div class="icon-content">
                                        <div class="tw-count-number text-clr-{{ Arr::get($tabAttributes, $loop->index . '.color') }}">
                                            <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                                        </div>
                                        <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- EXPLORE NEW LIFE END -->
