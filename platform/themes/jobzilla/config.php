<?php

use Botble\JobBoard\Forms\Fronts\ExternalJobApplicationForm;
use Botble\JobBoard\Forms\Fronts\InternalJobApplicationForm;
use Botble\JobBoard\Models\Account;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these events can be overridden by package config.
    |
    */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme): void {
            // You can remove this line anytime.
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme): void {
            // Partial composer.
            $theme->partialComposer('footer', function ($view): void {
                $internalJobApplicationForm = null;
                $externalJobApplicationForm = null;
                $account = null;

                if (is_plugin_active('job-board')) {
                    $account = auth('account')->check() ? auth('account')->user() : new Account();
                    $internalJobApplicationForm = InternalJobApplicationForm::create();
                    $externalJobApplicationForm = ExternalJobApplicationForm::create();
                }

                $view->with('account', $account)
                    ->with('internalJobApplicationForm', $internalJobApplicationForm)
                    ->with('externalJobApplicationForm', $externalJobApplicationForm);
            });

            // Add timestamp to bust cache
            $version = get_cms_version() . '.' . time();

            $stylePrefix = 'plugins/css/';
            $scriptPrefix = 'plugins/js/';

            $theme->asset()->styleUsingPath('bootstrap', $stylePrefix . 'bootstrap.min.css');
            $theme->asset()->styleUsingPath('font-awesome', $stylePrefix . 'font-awesome.min.css');
            $theme->asset()->styleUsingPath('feather', $stylePrefix . 'feather.css');
            $theme->asset()->styleUsingPath('owl.carousel-css', $stylePrefix . 'owl.carousel.min.css');
            $theme->asset()->styleUsingPath('swiper-bundle-css', $stylePrefix . 'swiper-bundle.min.css');
            $theme->asset()->styleUsingPath('magnific-popup-css', $stylePrefix . 'magnific-popup.min.css');
            $theme->asset()->styleUsingPath('lc_lightbox-css', $stylePrefix . 'lc_lightbox.css');
            $theme->asset()->styleUsingPath('dropzone', $stylePrefix . 'dropzone.css');
            $theme->asset()->styleUsingPath('scrollbar', $stylePrefix . 'scrollbar.css');
            $theme->asset()->styleUsingPath('datepicker', $stylePrefix . 'datepicker.css');
            $theme->asset()->styleUsingPath('flaticon', $stylePrefix . 'flaticon.css');
            $theme->asset()->styleUsingPath('select2-css', 'plugins/select2/css/select2.min.css');

            // Add cache busting query parameter
            $cacheBuster = '?v=' . time();
            $theme->asset()->styleUsingPath('main', 'css/main.css' . $cacheBuster);
            $theme->asset()->container('footer')->usePath()->add('style', 'css/style.css' . $cacheBuster, [], [], $version);

            $theme->asset()->container('footer')->scriptUsingPath('jquery', $scriptPrefix . 'jquery-3.6.0.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('popper', $scriptPrefix . 'popper.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('bootstrap', $scriptPrefix . 'bootstrap.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('magnific-popup-js', $scriptPrefix . 'magnific-popup.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('waypoints.min', $scriptPrefix . 'waypoints.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('counterup.min', $scriptPrefix . 'counterup.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('waypoints-sticky.min', $scriptPrefix . 'waypoints-sticky.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('isotope.pkgd.min', $scriptPrefix . 'isotope.pkgd.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('imagesloaded.pkgd.min', $scriptPrefix . 'imagesloaded.pkgd.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('owl.carousel-js', $scriptPrefix . 'owl.carousel.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('swiper-bundle-js', $scriptPrefix . 'swiper-bundle.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('jquery.owl-filter-js', $scriptPrefix . 'jquery.owl-filter.js');
            $theme->asset()->container('footer')->scriptUsingPath('theia-sticky-sidebar', $scriptPrefix . 'theia-sticky-sidebar.js');
            $theme->asset()->container('footer')->scriptUsingPath('lc_lightbox-js', $scriptPrefix . 'lc_lightbox.lite.js');
            $theme->asset()->container('footer')->scriptUsingPath('dropzone', $scriptPrefix . 'dropzone.js');
            $theme->asset()->container('footer')->scriptUsingPath('jquery.scrollbar', $scriptPrefix . 'jquery.scrollbar.js');
            $theme->asset()->container('footer')->scriptUsingPath('bootstrap-datepicker', $scriptPrefix . 'bootstrap-datepicker.js');
            $theme->asset()->container('footer')->scriptUsingPath('chart', $scriptPrefix . 'chart.js');
            $theme->asset()->container('footer')->scriptUsingPath('bootstrap-slider', $scriptPrefix . 'bootstrap-slider.min.js');
            $theme->asset()->container('footer')->scriptUsingPath('anm', $scriptPrefix . 'anm.js');
            $theme->asset()->container('footer')->scriptUsingPath('select2-js', 'plugins/select2/js/select2.min.js');

            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js', ['swiper-js', 'datatables-js'], [], $version);
            $theme->asset()->container('footer')->usePath()->add('script', 'js/script.js', [], [], $version);

            if (function_exists('shortcode')) {
                $theme->composer([
                    'page',
                    'post',
                    'job-board.candidate',
                    'job-board.company',
                    'job-board.job',
                    'job-board.job-category',
                    'job-board.job-tag',
                ], function (View $view): void {
                    $view->withShortcodes();
                });
            }
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [

            'default' => function ($theme): void {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            },
        ],
    ],
];
