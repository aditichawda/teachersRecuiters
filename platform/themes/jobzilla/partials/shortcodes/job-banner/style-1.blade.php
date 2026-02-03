<div class="section-full p-t120 p-b0 site-bg-white twm-millions-1-area pos-relative">
    <div class="container">
        <div class="twm-millions-section-wrap">
            <div class="row">

                <div class="col-lg-7 col-md-12">
                    <div class="twm-millions-1-section">
                        <div class="twm-media">
                            @if($image = $shortcode->image)
                                <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('Job banner') }}">
                            @endif
                            <div class="twm-circle-jobs-wrap">
                                @php($listNumberText = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven'])
                                @foreach($companies as $company)
                                    @if($loop->index < count($listNumberText))
                                        <div class="twm-circle-jobs-box {{ $listNumberText[$loop->index] }} bounce1">
                                            <a href="{{ $company->url }}">
                                                <div class="twm-circle-job-pics">
                                                    <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="twm-bg-circle-pic">
                            <img src="{{ Theme::asset()->url('images/bg-circle.png') }}" alt="{{ __('Background') }}">
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="twm-millions-1-section-right">

                        <div class="section-head left wt-small-separator-outer">
                            @if($subtitle = $shortcode->subtitle)
                                <div class="wt-small-separator site-text-primary">
                                    <div>{!! BaseHelper::clean($subtitle) !!}</div>
                                </div>
                            @endif
                            @if ($title = $shortcode->title)
                                <h2 class="wt-title">{!! BaseHelper::clean($title) !!}</h2>
                            @endif
                            @if($description = $shortcode->description)
                                <p>{!! BaseHelper::clean($description) !!}</p>
                            @endif
                        </div>

                        @if($count = $shortcode->count_job_available)
                            <div class="twm-avail-jobs">
                                <span>{{ $count }} +</span> {{ __('Jobs Available') }}
                            </div>
                        @endif

                        <div class="twm-read-more cplumn-2">
                            @if($buttonPrimaryLabel = $shortcode->button_primary_label)
                                <a href="{{ $shortcode->button_primary_url ?: '#' }}" class="site-button">{!! BaseHelper::clean($buttonPrimaryLabel) !!}</a>
                            @endif

                            @if($buttonSecondaryLabel = $shortcode->button_secondary_label)
                                <a href="{{ $shortcode->button_secondary_url ?: '#' }}" class="site-button-link underline">{!! BaseHelper::clean($buttonSecondaryLabel) !!}</a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="twm-bg-shape5"></div>
</div>
