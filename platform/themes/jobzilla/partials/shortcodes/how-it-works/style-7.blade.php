<!-- HOW IT WORK SECTION START -->
<div class="section-full p-t120 p-b90 twm-how-it-work-area" @if ($shortcode->bg_image) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image) }});" @endif>

    <div class="container">

        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer  content-white">
            <div class="wt-small-separator">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>

        </div>
        <!-- TITLE END-->

        <div class="twm-how-it-work-section3">
            <div class="row">
                @foreach ($tabs as $tab)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="twm-w-process-steps-h-page-7">
                        <div class="twm-w-pro-top">
                            <div class="twm-media">
                                <span>
                                    <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image'), null, false, RvMedia::getDefaultImage()) }}" alt="{{ Arr::get($tab, 'title') }}">
                                </span>
                            </div>
                            <span class="twm-large-number @if (! Arr::get($tab, 'bg_color')) text-clr-sky @endif"
                                  @if (Arr::get($tab, 'bg_color')) style="color: {{ Arr::get($tab, 'bg_color') }};" @endif>{{ $loop->iteration < 10 ? ('0' . $loop->iteration) : $loop->iteration }}</span>
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
