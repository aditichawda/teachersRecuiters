{{-- Working Process: small label "How It Works", big "Working Process", 2+1 grid, colored cards with white icon box + white text --}}
<div class="section-full p-t80 p-b90 site-bg-white twm-how-it-work-area twm-how-it-work-working-process">
    <div class="container">
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->subtitle) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
        </div>
        <div class="twm-how-it-work-section twm-working-process-grid">
            <div class="row twm-working-process-row">
                @foreach ($tabs as $tab)
                    <div class="col-lg-6 col-md-6 twm-working-process-col">
                        <div class="twm-w-process-steps-working-process">
                            <div class="twm-w-pro-top" @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>
                                <div class="twm-media">
                                    <span>
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    </span>
                                </div>
                                <h4 class="twm-title">{{ Arr::get($tab, 'title') }}</h4>
                                <p class="twm-desc">{{ Arr::get($tab, 'subtitle') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
