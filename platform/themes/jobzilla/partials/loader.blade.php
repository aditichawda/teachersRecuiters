{{--
    Common Loader Component
    Usage: @include(Theme::getThemeNamespace('partials.loader'), ['size' => 'large', 'overlay' => true, 'containerId' => 'my-container'])
    
    Parameters:
    - size: 'small', 'medium', 'large' (default: 'medium')
    - overlay: true/false (default: true) - shows overlay background
    - containerId: ID of container element (optional)
    - text: Optional text to show below loader
    - fullscreen: true/false (default: false) - fullscreen loader
--}}

@php
    $size = $size ?? 'medium';
    $overlay = $overlay ?? true;
    $containerId = $containerId ?? null;
    $text = $text ?? null;
    $fullscreen = $fullscreen ?? false;
    $show = $show ?? false;
@endphp

<style>
/* Common Blue Loader Styles */
.blue-loader-overlay {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 200px !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(3px);
    display: none;
    align-items: center !important;
    justify-content: center !important;
    z-index: 9999 !important;
    border-radius: 8px;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
}

.blue-loader-overlay[style*="display: flex"],
.blue-loader-overlay.show {
    display: flex !important;
}

.blue-loader {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(0, 115, 209, 0.2);
    border-top-color: #0073d1;
    border-radius: 50%;
    animation: blue-spin 0.8s linear infinite;
    position: relative;
    margin: 0 auto;
    flex-shrink: 0;
}

.blue-loader.small {
    width: 30px;
    height: 30px;
    border-width: 3px;
}

.blue-loader.medium {
    width: 40px;
    height: 40px;
    border-width: 3.5px;
}

.blue-loader.large {
    width: 60px;
    height: 60px;
    border-width: 5px;
}

@keyframes blue-spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.blue-loader-text {
    color: #0073d1;
    font-size: 13px;
    font-weight: 500;
    margin-top: 12px;
    text-align: center;
}

.blue-loader-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Fullscreen Loader */
.blue-loader-fullscreen {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 100vh !important;
    z-index: 99999 !important;
}
</style>

@if($fullscreen)
    <div class="blue-loader-overlay blue-loader-fullscreen" id="{{ $containerId ?? 'fullscreen-loader' }}" style="{{ $show ? 'display: flex;' : 'display: none;' }}">
        <div class="blue-loader-wrapper">
            <div class="blue-loader {{ $size }}"></div>
            @if($text)
                <p class="blue-loader-text">{{ $text }}</p>
            @endif
        </div>
    </div>
@elseif($overlay)
    <div class="blue-loader-overlay" id="{{ $containerId ?? 'loader-overlay' }}" style="{{ $show ? 'display: flex;' : 'display: none;' }}">
        <div class="blue-loader-wrapper">
            <div class="blue-loader {{ $size }}"></div>
            @if($text)
                <p class="blue-loader-text">{{ $text }}</p>
            @endif
        </div>
    </div>
@else
    <div class="blue-loader-wrapper" id="{{ $containerId ?? 'loader' }}">
        <div class="blue-loader {{ $size }}"></div>
        @if($text)
            <p class="blue-loader-text">{{ $text }}</p>
        @endif
    </div>
@endif

{{-- JavaScript Helper Functions --}}
<script>
(function() {
    if (typeof window.LoaderHelper === 'undefined') {
        window.LoaderHelper = {
            show: function(containerId, options) {
                options = options || {};
                const container = document.getElementById(containerId);
                if (container) {
                    if (typeof $ !== 'undefined') {
                        $(container).css('display', 'flex').addClass('show');
                    } else {
                        container.style.display = 'flex';
                        container.classList.add('show');
                    }
                }
            },
            hide: function(containerId) {
                const container = document.getElementById(containerId);
                if (container) {
                    if (typeof $ !== 'undefined') {
                        $(container).css('display', 'none').removeClass('show');
                    } else {
                        container.style.display = 'none';
                        container.classList.remove('show');
                    }
                }
            },
            toggle: function(containerId) {
                const container = document.getElementById(containerId);
                if (container) {
                    const isVisible = container.style.display === 'flex' || container.classList.contains('show');
                    if (isVisible) {
                        this.hide(containerId);
                    } else {
                        this.show(containerId);
                    }
                }
            }
        };
    }
})();
</script>
