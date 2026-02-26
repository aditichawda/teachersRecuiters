{!! Theme::partial('header') !!}

@if (is_plugin_active('ads'))
    @php
        // Display ads at top of home page
        try {
            if (function_exists('display_ads_by_page')) {
                $topAds = display_ads_by_page('home', 'top');
            } else {
                $topAds = '';
            }
        } catch (\Exception $e) {
            $topAds = '';
        }
        
        if (empty($topAds)) {
            // Fallback to location-based system
            $topAds = \Botble\Ads\Facades\AdsManager::display('home-top', [], false);
        }
    @endphp
    @if (!empty($topAds))
        <div class="home-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            {!! $topAds !!}
        </div>
    @endif
@endif

{!! Theme::content() !!}

@if (is_plugin_active('ads') && function_exists('render_page_ads'))
    @php $bottomAds = render_page_ads('home', 'bottom'); @endphp
    @if (!empty($bottomAds))
        <div class="home-ads-bottom" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            {!! $bottomAds !!}
        </div>
    @endif
@endif

{!! Theme::partial('footer') !!}
