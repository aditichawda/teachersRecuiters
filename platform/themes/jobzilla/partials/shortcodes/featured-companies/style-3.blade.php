<!-- TOP COMPANIES START -->
<div class="section-full p-t120 p-b90 site-bg-gray twm-companies-wrap">
    <div class="container">
        <div class="section-content">
            <div class="owl-carousel home-client-carousel4 owl-btn-vertical-center">
                @foreach ($companies as $company)
                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                                <a href="{{ $company->url }}">
                                    <img src="{{ RvMedia::getImageUrl($company->logo_thumb) }}" alt="{{ $company->name }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center m-t30">
                @if (auth('account')->check())
                    <a href="{{ url('/how-it-works') }}" class="site-button">{{ __('Get Started') }}</a>
                @else
                    <a href="{{ route('public.account.register') }}" class="site-button">{{ __('Get Started') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- TOP COMPANIES END -->
