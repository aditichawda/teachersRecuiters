<div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area">
    <div class="container">
        <div class="section-head center wt-small-separator-outer mt-5">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->subtitle) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
        </div>
        <div class="twm-how-it-work-section">
            <div class="row">
                @foreach ($tabs as $tab)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps">
                            <span class="twm-large-number">{{ $loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration }}</span>
                            <div class="twm-w-pro-top" @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>
                                <div class="twm-media">
                                    <span>
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    </span>
                                </div>
                                <h4 class="twm-title">{{ Arr::get($tab, 'title') }}</h4>
                            </div>
                            <p>{{ Arr::get($tab, 'subtitle') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
