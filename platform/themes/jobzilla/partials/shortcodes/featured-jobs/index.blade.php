<div class="section-full p-t120 p-b90 site-bg-white twm-hpage-6-featured-outer">
    <div class="section-head center wt-small-separator-outer mt-5">
        @if ($title = $shortcode->title)
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($title) !!}</div>
            </div>
        @endif

        @if ($subtitle = $shortcode->subtitle)
            <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
        @endif
    </div>

    <div class="twm-hpage-6-featured-area">
        <div class="twm-hpage-6-featured-bg-warp">
            @if($image = $shortcode->image)
                <div class="twm-media">
                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('Featured Jobs') }}">
                </div>
            @endif
        </div>

        <div class="container">
            <div class="twm-hpage-6-featured-content-warp m-b30">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row">
                            @foreach($jobs as $job)
                                @if($loop->index < 2)
                                    <div class="col-lg-6 col-md-6 m-b30">
                                        {!! Theme::partial('jobs.style-4', compact('job')) !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row">
                @foreach($jobs->skip(2) as $job)
                    <div class="col-lg-4 col-md-6 m-b30">
                        {!! Theme::partial('jobs.style-4', compact('job')) !!}
                    </div>
                @endforeach
                </div>

                @if ($shortcode->button_action_label || $shortcode->button_action_url)
                    <div class="text-center job-categories-btn">
                        <a href="{{ $shortcode->button_action_url ?: '#' }}" class="site-button">{!! BaseHelper::clean($shortcode->button_action_label ?: __('View All')) !!}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
