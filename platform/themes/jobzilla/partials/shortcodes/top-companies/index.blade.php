<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">

        <div class="section-head center wt-small-separator-outer">
            @if ($title = $shortcode->title)
                <div class="wt-small-separator site-text-primary">
                    <div>{!! BaseHelper::clean($title) !!}</div>
                </div>
            @endif

            @if($subtitle = $shortcode->subtitle)
                <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
            @endif
        </div>

        <div class="section-content">
            <div class="twm-recruiters5-wrap">
                <div class="twm-column-5 m-b30">
                    <ul>
                        @foreach($companies as $company)
                            <li>
                                <div class="twm-recruiters5-box">
                                    <div class="twm-rec-top">
                                        <div class="twm-rec-media">
                                            <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
                                        </div>
                                        <div class="twm-rec-jobs">
                                            @include(Theme::getThemeNamespace('partials.job-count'), ['company' => $company])
                                        </div>
                                    </div>
                                    <div class="twm-rec-content">
                                        <h4 class="twm-title"><a href="{{ $company->url }}">{!! BaseHelper::clean($company->name) !!} {!! $company->badge !!}</a></h4>
                                        <div class="twm-rec-rating-wrap">
                                            <div class="twm-rec-rating">
                                               {!! Theme::partial('rating-star', ['star' => round($company->reviews_avg_star)]) !!}
                                            </div>
                                            <div class="twm-rec-rating-count">({{ $company->reviews_count }})</div>
                                        </div>
                                        <div class="twm-job-address"><i class="feather-map-pin"></i>
                                            {{ $company->state_name ? $company->state_name . ', ' : '' }} {{ $company->country->code }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if ($shortcode->button_action_label || $shortcode->button_action_url)
                    <div class="text-center m-b30">
                        <a href="{{ $shortcode->button_action_url ?: '#' }}" class="site-button">{!! BaseHelper::clean($shortcode->button_action_label ?: __('View All')) !!}</a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
