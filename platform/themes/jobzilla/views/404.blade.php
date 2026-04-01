@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fireEventGlobalAssets();
@endphp

{!! Theme::partial('header') !!}

<div class="section-full p-t120  p-b90 site-bg-white">
    <div class="container">
        <div class="twm-error-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="twm-error-image">
                        <img src="{{ theme_option('404_page_image') ? RvMedia::getImageUrl(theme_option('404_page_image')) :Theme::asset()->url('images/error-404.png') }}"
                            alt="{{ theme_option('site_title') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="twm-error-content">
                        <h2 class="twm-error-title">{{ __('404') }}</h2>
                        <h4 class="twm-error-title2 site-text-primary">{{ __('We Are Sorry, Page Not Found') }}</h4>
                        <p>{{ __('The page you are looking for might have been removed had its name changed or is temporarily unavailable.') }}</p>
                        <a href="{{ BaseHelper::getHomepageUrl()  }}" class="site-button">{{ __('Go To Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}
