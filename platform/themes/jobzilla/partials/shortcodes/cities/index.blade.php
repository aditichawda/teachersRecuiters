@switch($shortcode->style)
    @case(2)
        <div class="section-full p-t120 p-b90 site-bg-white twm-featured-city-area">
            <div class="container">
                <div class="section-head center wt-small-separator-outer mt-5">
                    <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    <div class="wt-small-separator site-text-primary">
                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                    </div>
                    
                </div>
                <div class="twm-featured-city-section">
                    <div class="row">
                        @if ($city = $cities->first())
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="twm-featured-city twm-large-block">
                                    <div class="twm-media">
                                        <img src="{{ RvMedia::getImageUrl($city->getMetadata('image', true), null, false, RvMedia::getDefaultImage()) }}" alt="{{ $city->name }}">
                                        <div class="twm-city-info">
                                            <div class="twm-city-jobs">{{ __(':count Jobs', ['count' => number_format($city->jobs_count)]) }}</div>
                                            <h4 class="twm-title">
                                                <a href="{{ JobBoardHelper::getJobsPageURL() }}?city_id={{ $city->id }}">{{ $city->name }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="row">
                                @foreach ($cities->skip(1) as $city)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="twm-featured-city">
                                            <div class="twm-media">
                                                <img src="{{ RvMedia::getImageUrl($city->getMetadata('image', true), 'large', false, RvMedia::getDefaultImage()) }}" alt="{{ $city->name }}">
                                                <div class="twm-city-info">
                                                    <div class="twm-city-jobs">{{ __(':count Jobs', ['count' => number_format($city->jobs_count)]) }}</div>
                                                    <h4 class="twm-title">
                                                        <a href="{{ JobBoardHelper::getJobsPageURL() }}?city_id={{ $city->id }}">{{ $city->name }}</a>
                                                    </h4>
                                                </div>
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
        @break
    @default
        <div class="section-full p-t120 p-b90 site-bg-white twm-featured-city-area">
            <div class="container">
                <div class="section-head center wt-small-separator-outer mt-5">
                    <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    <div class="wt-small-separator site-text-primary">
                        <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                    </div>
                    
                </div>
                <div class="twm-featured-city-section">
                    <div class="row">
                        @if ($city = $cities->first())
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="twm-featured-city twm-large-block">
                                    <div class="twm-media">
                                        <img src="{{ RvMedia::getImageUrl($city->getMetadata('image', true), null, false, RvMedia::getDefaultImage()) }}" alt="{{ $city->name }}">
                                        <div class="twm-city-info">
                                            <div class="twm-city-jobs">{{ __(':count Jobs', ['count' => number_format($city->jobs_count)]) }}</div>
                                            <h4 class="twm-title">
                                                <a href="{{ JobBoardHelper::getJobsPageURL() }}?city_id={{ $city->id }}">{{ $city->name }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="row">
                                @foreach ($cities->skip(1) as $city)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="twm-featured-city">
                                            <div class="twm-media">
                                                <img src="{{ RvMedia::getImageUrl($city->getMetadata('image', true), 'large', false, RvMedia::getDefaultImage()) }}" alt="{{ $city->name }}">
                                                <div class="twm-city-info">
                                                    <div class="twm-city-jobs">{{ __(':count Jobs', ['count' => number_format($city->jobs_count)]) }}</div>
                                                    <h4 class="twm-title">
                                                        <a href="{{ JobBoardHelper::getJobsPageURL() }}?city_id={{ $city->id }}">{{ $city->name }}</a>
                                                    </h4>
                                                </div>
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
@endswitch

