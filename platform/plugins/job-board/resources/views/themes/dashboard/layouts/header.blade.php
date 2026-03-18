@php
    $account = auth('account')->user();
    $dashboardCssPath = public_path('vendor/core/plugins/job-board/css/dashboard/style.css');
    $dashboardCssVersion = file_exists($dashboardCssPath) ? filemtime($dashboardCssPath) : time();
    $dashboardRtlCssPath = public_path('vendor/core/plugins/job-board/css/dashboard/style-rtl.css');
    $dashboardRtlCssVersion = file_exists($dashboardRtlCssPath) ? filemtime($dashboardRtlCssPath) : time();
@endphp

{!! SeoHelper::render() !!}

@include('plugins/job-board::themes.dashboard.layouts.header-meta')

{{-- Load critical CSS synchronously with proper attributes to prevent FOUC --}}
<link data-dashboard-css="1" href="{{ asset('vendor/core/plugins/job-board/css/dashboard/style.css') }}?v={{ $dashboardCssVersion }}" rel="stylesheet" media="all">

@if (session('locale_direction', 'ltr') == 'rtl')
    <link href="{{ asset('vendor/core/core/base/css/core.rtl.css') }}" rel="stylesheet" media="all">
    <link data-dashboard-css-rtl="1" href="{{ asset('vendor/core/plugins/job-board/css/dashboard/style-rtl.css') }}?v={{ $dashboardRtlCssVersion }}" rel="stylesheet" media="all">
@endif

@if (File::exists($styleIntegration = Theme::getStyleIntegrationPath()))
    {!! Html::style(Theme::asset()->url('css/style.integration.css?v=' . filectime($styleIntegration))) !!}
@endif

<script>
    (function () {
        // Ensure CSS is loaded properly - if not loaded after delay, reload once
        function verifyCssLoaded() {
            var mainCss = document.querySelector('link[data-dashboard-css="1"]');
            if (!mainCss) return;
            
            // Wait a bit for CSS to load
            setTimeout(function() {
                var cssLoaded = false;
                try {
                    // Check if stylesheet is accessible
                    cssLoaded = !!mainCss.sheet || mainCss.styleSheet || (mainCss.href && mainCss.href.length > 0);
                } catch(e) {
                    // Cross-origin or other error - assume loaded if href exists
                    cssLoaded = mainCss.href && mainCss.href.length > 0;
                }
                
                // If CSS still not loaded and we haven't retried, reload once
                if (!cssLoaded) {
                    var retryKey = 'dashboard_css_retry';
                    var hasRetried = sessionStorage.getItem(retryKey);
                    if (!hasRetried) {
                        sessionStorage.setItem(retryKey, '1');
                        window.location.reload();
                        return;
                    }
                } else {
                    // CSS loaded successfully, clear retry flag
                    sessionStorage.removeItem('dashboard_css_retry');
                }
            }, 300);
        }
        
        // Verify CSS loading
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', verifyCssLoaded);
        } else {
            verifyCssLoaded();
        }
        
        // Also listen for CSS load events
        var mainCss = document.querySelector('link[data-dashboard-css="1"]');
        if (mainCss) {
            mainCss.addEventListener('load', function() {
                sessionStorage.removeItem('dashboard_css_retry');
            });
            mainCss.addEventListener('error', function() {
                verifyCssLoaded();
            });
        }
    })();
</script>
