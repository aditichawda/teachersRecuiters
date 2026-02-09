<div class="twm-home3-banner-section site-bg-white bg-cover"
    @if ($shortcode->bg_image_1) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }})" @endif>
    <div class="twm-home3-inner-section">
        <div class="twm-bnr-mid-section">

            {{-- 1. Title --}}
            <div class="twm-bnr-title-large">{!! BaseHelper::clean($shortcode->title) !!}</div>

            {{-- 2. Subtitle (right below title) --}}
            <div class="twm-bnr-title-light">{!! BaseHelper::clean($shortcode->subtitle) !!}</div>

            {{-- 2.5 Description (if set) --}}
            @if ($shortcode->description)
                <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>
            @endif

            {{-- 3. Search Bar --}}
            @if (is_plugin_active('job-board'))
                {!! Theme::partial('shortcodes.search-bar.form') !!}

                {{-- 4. Popular Searches (teaching-related keywords) --}}
                {!! Theme::partial('shortcodes.search-bar.popular-search', [
                    'popular_searches' => 'Math Teacher;Science Teacher;English Teacher;PRT;TGT;PGT;Principal;Computer Teacher'
                ]) !!}
            @endif

            {{-- 5. CTA Button --}}
            @if (auth('account')->check())
                <a href="{{ url('/how-it-works') }}" class="site-button">{{ $shortcode->button_name ?: __('Get Started') }}</a>
            @else
                <a href="{{ route('public.account.register') }}" class="site-button">{{ $shortcode->button_name ?: __('Get Started') }}</a>
            @endif

        </div>
        <!-- <div class="twm-bnr-bottom-section">
            @if ($shortcode->gradient_text)
                <div class="twm-browse-jobs">{{ $shortcode->gradient_text }}</div>
            @endif
            <div class="twm-bnr-blocks-wrap">
                @foreach ($tabs as $tab)
                    <div class="twm-bnr-blocks twm-bnr-blocks-position-{{ $loop->iteration }}">
                        @if ($img = Arr::get($tab, 'image'))
                            <div class="twm-icon">
                                <img src="{{ RvMedia::getImageUrl($img) }}" alt="{{ Arr::get($tab, 'title') }}">
                            </div>
                        @endif
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-{{ Arr::random(['pink', 'yellow', 'green'])}}">
                                <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                            </div>
                            <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> -->
    </div>
</div>
