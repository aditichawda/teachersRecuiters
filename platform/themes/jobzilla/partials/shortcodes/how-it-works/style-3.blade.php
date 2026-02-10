<!-- HOW IT WORK SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-gray twm-how-it-work-area">
    <div class="container">
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
        </div>
        <div class="twm-how-it-work-section3">
            <div class="row">
                @foreach ($tabs as $tab)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="twm-w-process-steps3">
                            <div class="twm-w-pro-top">
                                <span class="twm-large-number @if (! Arr::get($tab, 'bg_color')) text-clr-sky @endif"
                                    @if (Arr::get($tab, 'bg_color')) style="color: {{ Arr::get($tab, 'bg_color') }};" @endif>{{ $loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration }}</span>
                                <div class="twm-media @if (! Arr::get($tab, 'bg_color')) bg-clr-sky @endif"
                                    @if (Arr::get($tab, 'bg_color')) style="background-color: {{ Arr::get($tab, 'bg_color') }};" @endif>
                                    <span>
                                        <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                    </span>
                                </div>
                            </div>
                            <h4 class="twm-title">{{ Arr::get($tab, 'title') }}</h4>
                            <p>{{ Arr::get($tab, 'subtitle') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- HOW IT WORK SECTION END -->
