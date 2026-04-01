@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->title ?: '');
@endphp
<style>
/* Hero Banner Custom Styles */
.twm-home3-banner-section {
    position: relative;
    overflow: hidden;
    min-height: 500px;
}
.twm-home3-banner-section[style*="background-image"] {
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
}
.twm-home3-banner-section .twm-home3-inner-section {
    position: relative;
    z-index: 2;
}
.twm-home3-banner-section .twm-bnr-mid-section {
    position: relative;
    z-index: 2;
}
.twm-home3-banner-section .twm-bnr-title-large {
    color: #ffffff !important;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.4), 0 1px 5px rgba(0, 0, 0, 0.3) !important;
}
.twm-home3-banner-section .twm-bnr-title-light {
    color: rgba(255, 255, 255, 0.95) !important;
    text-shadow: 0 1px 8px rgba(0, 0, 0, 0.35), 0 1px 3px rgba(0, 0, 0, 0.25) !important;
}
.twm-home3-banner-section .twm-bnr-discription {
    color: rgba(255, 255, 255, 0.9) !important;
    text-shadow: 0 1px 6px rgba(0, 0, 0, 0.3), 0 1px 2px rgba(0, 0, 0, 0.2) !important;
}
/* Gradient overlay for image backgrounds */
.twm-home3-banner-section .banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.4) 0%, rgba(118, 75, 162, 0.3) 50%, rgba(240, 147, 251, 0.2) 100%);
    z-index: 1;
}
/* Decorative elements */
.twm-home3-banner-section .banner-decoration-1,
.twm-home3-banner-section .banner-decoration-2 {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    pointer-events: none;
}
.twm-home3-banner-section .banner-decoration-1 {
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.1);
}
.twm-home3-banner-section .banner-decoration-2 {
    bottom: -30%;
    left: -5%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.08);
    filter: blur(50px);
}
</style>
<!--Banner Start-->
<div class="twm-home3-banner-section site-bg-white bg-cover"
    @if ($shortcode->bg_image_1) 
        style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }}); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; overflow: hidden;"
    @else
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); position: relative; overflow: hidden;"
    @endif>
    @if (!$shortcode->bg_image_1)
        <!-- Decorative elements for attractive UI (only show when no image) -->
        <div class="banner-decoration-1"></div>
        <div class="banner-decoration-2"></div>
    @else
        <!-- Overlay for better text readability on image -->
        <div class="banner-overlay"></div>
    @endif
    <div class="twm-home3-inner-section">
        <div class="twm-bnr-mid-section">
            <div class="twm-bnr-title-large">{!! BaseHelper::clean($title) !!}</div>
            <div class="twm-bnr-title-light">{!! BaseHelper::clean($subtitle) !!}</div>
            <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>

            @if (is_plugin_active('job-board'))
                {!! Theme::partial('shortcodes.search-bar.form') !!}
                {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
            @endif

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
                <a href="{{ $buttonUrl }}" class="site-button mt-5">{{ $shortcode->button_name ?: __('Get Started') }}</a>
            @endif
        </div>
    </div>
</div>
<!--Banner End-->
