@php
    $title = Theme::get('pageTitle') ?: SeoHelper::getTitle();
    $titleLower = strtolower($title);
    $hideTitle = in_array($titleLower, ['contact', 'contact us']);
    $hideBreadcrumb = in_array($titleLower, ['contact', 'contact us', 'about us', 'about-us']);
    
    // Hide entire banner for About Us, How It Works, and Contact Us pages
    $hideEntireBanner = in_array($titleLower, ['about us', 'about-us', 'how it works', 'how-it-works', 'contact', 'contact us']);
@endphp

@unless($hideEntireBanner)
<div
    class="wt-bnr-inr overlay-wraper bg-center"
    @if (Theme::get('pageCoverImage'))
        style="background-image:url('{{ RvMedia::getImageUrl(Theme::get('pageCoverImage')) }}');"
    @endif
>
    <div class="overlay-main site-bg-white opacity-01"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    @unless($hideTitle)
                        <h2 class="wt-title">{{ $title }}</h2>
                    @endunless
                </div>
            </div>

            @unless($hideBreadcrumb)
                {!! Theme::partial('breadcrumbs') !!}
            @endunless
        </div>
    </div>
</div>
@endunless
