<!-- ABOUT SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-gray twm-about-1-area">
    <div class="container">
        <div class="twm-about-1-section-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="twm-about-1-section">
                        <div class="twm-media">
                            <img src="images/home-4/about/ab-1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="twm-about-1-section-right">
                        <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <div class="wt-small-separator site-text-primary">
                                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                            </div>
                            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>

                        </div>
                       
                        @if ($shortcode->check_list && $list = array_filter(explode(';', $shortcode->check_list)))
                            <ul class="description-list">
                                @foreach ($list as $item)
                                    <li><i class="feather-check"></i>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="twm-about-1-bottom-wrap">
            <div class="row">
                @foreach ($tabs as $tab)
                    <div class="col-lg-4 col-md-6">
                        <div class="twm-card-blocks">
                            <div class="twm-icon pink">
                                <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                            </div>
                            <div class="twm-content">
                                <div class="tw-count-number text-clr-pink">
                                    <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                                </div>
                                <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-4 col-md-6">
                    <!--icon-block-2-->
                    <div class="twm-card-blocks-2">
                        <div class="twm-pics">
                            <span><img src="images/main-slider/slider2/user/u-1.jpg" alt=""></span>
                            <span><img src="images/main-slider/slider2/user/u-2.jpg" alt=""></span>
                            <span><img src="images/main-slider/slider2/user/u-3.jpg" alt=""></span>
                            <span><img src="images/main-slider/slider2/user/u-4.jpg" alt=""></span>
                            <span><img src="images/main-slider/slider2/user/u-5.jpg" alt=""></span>
                            <span><img src="images/main-slider/slider2/user/u-6.jpg" alt=""></span>
                        </div>
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-green">
                                <span class="counter">3</span>K+
                            </div>
                            <p class="icon-content-info">Jobs Done</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <!--icon-block-3-->
                    <div class="twm-card-blocks">
                        <div class="twm-icon">
                            <img src="images/main-slider/slider2/icon-1.png" alt="">
                        </div>
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-sky">
                                <span class="counter">12</span>K+
                            </div>
                            <p class="icon-content-info">companies Jobs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT SECTION END -->
