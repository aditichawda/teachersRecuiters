<!-- TOP COMPANIES START -->
<div class="section-full p-t0 p-b90 site-bg-white twm-companies-wrap twm-companies-wrap-h-page-7 pos-relative">
    <div class="twm-companies-wrap-bg-block2"></div>
    <!-- TITLE START-->
    <div class="section-head center wt-small-separator-outer content-white">
        <div class="wt-small-separator site-text-primary">
            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
        </div>
        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
    </div>
    <!-- TITLE END-->

    <div class="container  block-background-white">
        <div class="twm-companies-h-page-7">
            <div class="section-content">
                <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">
                    @foreach ($companies as $company)
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                    <a href="{{ $company->url }}"><img src="{{ RvMedia::getImageUrl($company->logo_thumb) }}" alt="{{ $company->name }}"></a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="twm-company-approch2-outer">
                <div class="twm-company-approch2">
                    <div class="row">
                        @foreach ($tabs as $tab)
                            <div class="col-lg-4 col-md-4">
                                <div class="counter-outer-two">
                                    <div class="icon-content">
                                        <div class="tw-count-number site-text-primary">
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
    </div>

</div>
<!-- TOP COMPANIES END -->
