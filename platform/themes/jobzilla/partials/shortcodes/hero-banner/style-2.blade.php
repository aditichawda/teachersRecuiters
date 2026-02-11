@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-secondry">${1}</span>', $shortcode->title ?: '');
@endphp

<div class="twm-home2-banner-section site-bg-gray bg-cover"
    @if ($shortcode->bg_image_1) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }})" @endif>
    <div class="row">
        <!--Left Section-->
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="twm-bnr-left-section">
                <div class="twm-bnr-title-small">{!! BaseHelper::clean($title) !!}</div>
                <div class="twm-bnr-title-large">{!! BaseHelper::clean($subtitle) !!}</div>
                <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>
                @if ($shortcode->button_url)
                    @php
                        $buttonUrl = $shortcode->button_url;
                        if (auth('account')->check()) {
                            $account = auth('account')->user();
                            if ($account->isEmployer()) {
                                $buttonUrl = route('public.account.dashboard');
                            } else {
                                $buttonUrl = route('public.account.jobseeker.dashboard');
                            }
                        } else {
                            $buttonUrl = route('public.account.register');
                        }
                    @endphp
                    <a href="{{ $buttonUrl }}" class="site-button">{{ $shortcode->button_name ?: __('Get Started') }}</a>
                @endif
            </div>
        </div>
        <!--right Section-->
        <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-section">
            <div class="twm-bnr2-right-content">

                <div class="twm-img-bg-circle-area2">
                    <div class="twm-outline-ring-wrap">
                        <div class="twm-outline-ring-dott-wrap">
                           <span class="outline-dot-1"></span>
                           <span class="outline-dot-2"></span>
                           <span class="outline-dot-3"></span>
                           <!--Samll Ring Left-->
                           <div class="twm-small-ring-l scale-up-center"></div>
                        </div>
                    </div>
                </div>

                <div class="twm-home-2-bnr-images">
                    @if ($shortcode->banner_1)
                        <div class="bnr-image-1">
                            <img src="{{ RvMedia::getImageUrl($shortcode->banner_1) }}" alt="{{ $shortcode->banner_1 }}">
                        </div>
                    @endif
                    @if ($shortcode->banner_2)
                        <div class="bnr-image-2">
                            <img src="{{ RvMedia::getImageUrl($shortcode->banner_2) }}" alt="{{ $shortcode->banner_2 }}">
                        </div>
                    @endif
                    <div class="twm-small-ring-2 scale-up-center"></div>
                </div>

                @foreach ($tabs as $tab)
                    <div class="@if ($loop->iteration == 3) twm-bnr-blocks-3 @else twm-bnr-blocks @endif twm-bnr-blocks-position-{{ $loop->iteration }}">
                        @if ($loop->iteration == 3)
                            <div class="twm-pics">
                                @if (Arr::get($tab, 'image'))
                                    <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image')) }}" alt="{{ Arr::get($tab, 'title') }}">
                                @endif
                            </div>
                        @else
                            <div class="twm-icon {{ Arr::get($tab, 'color') }}">
                                @if (Arr::get($tab, 'image'))
                                    <img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image')) }}" alt="{{ Arr::get($tab, 'title') }}">
                                @endif
                            </div>
                        @endif
                        <div class="twm-content">
                            <div class="tw-count-number text-clr-{{ Arr::get($tab, 'color') }}">
                                <span class="counter">{{ Arr::get($tab, 'count') }}</span>{{ Arr::get($tab, 'extra') }}
                            </div>
                            <p class="icon-content-info">{{ Arr::get($tab, 'title') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
