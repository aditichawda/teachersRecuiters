<?php

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\Form;
use Botble\Base\Facades\Html;
use Botble\Base\Facades\MetaBox;
use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\JobType;
use Botble\Location\Models\City;
use Botble\Media\Facades\RvMedia;
use Botble\Newsletter\Facades\Newsletter;
use Botble\Page\Models\Page;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

register_page_template([
    'default' => __('Default'),
    'homepage' => __('Homepage'),
    'static' => __('Static'),
    'without-navbar' => __('Without navbar'),
    'coming-soon' => __('Coming soon'),
    'blog' => __('Blog'),
    'blog-sidebar' => __('Blog sidebar'),
]);

register_sidebar([
    'id' => 'pre_footer_sidebar',
    'name' => __('Pre footer sidebar'),
    'description' => __('Widgets at the bottom of the page.'),
]);

register_sidebar([
    'id' => 'blog_sidebar',
    'name' => __('Blog sidebar'),
    'description' => __('Widgets at the right of the page.'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Widgets in footer of page'),
]);

register_sidebar([
    'id' => 'job_board_sidebar',
    'name' => __('Job board sidebar'),
    'description' => __('Widgets in job board'),
]);

app()->booted(function (): void {
    RvMedia::addSize('large', 620, 380)
        ->addSize('medium', 310, 300)
        ->addSize('small', 300, 280);

    Theme::typography()
        ->registerFontFamilies([
            new TypographyItem('primary', __('Primary'), 'Rubik', ['300', '400', '500', '600', '700']),
            new TypographyItem('secondary', __('Secondary'), 'Poppins', ['300', '400', '500', '600', '700']),
        ])
        ->registerFontSizes([
            new TypographyItem('h1', __('Heading 1'), 60),
            new TypographyItem('h2', __('Heading 2'), 46),
            new TypographyItem('h3', __('Heading 3'), 22),
            new TypographyItem('h4', __('Heading 4'), 18),
            new TypographyItem('h5', __('Heading 5'), 16),
            new TypographyItem('h6', __('Heading 6'), 14),
            new TypographyItem('body', __('Body'), 15),
        ]);

    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerSocialSharing();
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerDateFormatOption();
    ThemeSupport::registerSiteLogoHeight(44);

    if (is_plugin_active('newsletter')) {
        Newsletter::registerNewsletterPopup();
    }
});

if (is_plugin_active('job-board')) {
    app()->booted(function (): void {
        JobBoardHelper::useCategoryIconImage();

        if (is_plugin_active('location')) {
            City::resolveRelationUsing('jobs', function ($model) {
                return $model->hasMany(Job::class);
            });
        }
    });

    add_filter('theme_logo_image', function ($html) {
        return new HtmlString(str_replace('data-bb-lazy="true"', '', $html));
    }, 999);

    add_action(BASE_ACTION_META_BOXES, function ($context, $object): void {
        if (get_class($object) === Page::class && $context == 'side') {
            MetaBox::addMetaBox('additional_page_fields', __('Addition Information'), function () {
                $headerCSSClass = null;
                $args = func_get_args();
                if (! empty($args[0])) {
                    $headerCSSClass = MetaBox::getMetaData($args[0], 'header_css_class', true);
                }

                return Html::tag(
                    'div',
                    Html::tag('label', __('Header style'), ['class' => 'control-label']) .
                    Form::customSelect('header_css_class', [
                        '' => __('Default'),
                        'header-style-light' => __('Header style light'),
                    ], $headerCSSClass),
                    ['class' => 'form-group']
                );
            }, get_class($object), $context);
        }

        if (get_class($object) === JobType::class && $context == 'side') {
            MetaBox::addMetaBox('additional_job_type_fields', __('Background color'), function () {
                $bgColor = null;
                $args = func_get_args();
                if (! empty($args[0])) {
                    $bgColor = MetaBox::getMetaData($args[0], 'background_color', true);
                }

                Assets::addScripts(['colorpicker'])->addStyles(['colorpicker']);

                return Form::customColor('background_color', $bgColor);
            }, get_class($object), $context);
        }

        if (get_class($object) === Job::class && $context == 'side') {
            MetaBox::addMetaBox('additional_job_fields', __('Layout'), function () {
                $layout = null;
                $args = func_get_args();
                if (! empty($args[0])) {
                    $layout = MetaBox::getMetaData($args[0], 'layout', true);
                }

                return Form::customSelect('layout', ['v1' => 'v1', 'v2' => 'v2'], $layout);
            }, get_class($object), $context);
        }
    }, 75, 2);

    add_action([BASE_ACTION_AFTER_CREATE_CONTENT, BASE_ACTION_AFTER_UPDATE_CONTENT], function ($type, $request, $object): void {
        if (get_class($object) === Page::class) {
            if ($request->has('header_css_class')) {
                MetaBox::saveMetaBoxData($object, 'header_css_class', $request->input('header_css_class'));
            }

            if ($request->has('background_breadcrumb')) {
                MetaBox::saveMetaBoxData($object, 'background_breadcrumb', $request->input('background_breadcrumb'));
            }
        }

        if (get_class($object) === JobType::class) {
            if ($request->has('background_color')) {
                MetaBox::saveMetaBoxData($object, 'background_color', $request->input('background_color'));
            }
        }

        if (get_class($object) === Job::class) {
            if ($request->has('layout') && ($layout = $request->input('layout')) && in_array($layout, ['v1', 'v2'])) {
                MetaBox::saveMetaBoxData($object, 'layout', $layout);
            }
        }
    }, 75, 3);
}

add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function (FormAbstract $form, ?Model $data) {
    if (get_class($data) == Page::class) {
        $form
            ->add('background_breadcrumb', 'mediaImage', [
                'label' => __('Background Breadcrumb'),
                'label_attr' => ['class' => 'control-label'],
                'value' => MetaBox::getMetaData($data, 'background_breadcrumb', true),
            ]);
    }

    return $form;
}, 120, 3);

// Ads Helper Functions
if (is_plugin_active('ads')) {
    if (!function_exists('display_ads_by_page')) {
        /**
         * Display ads based on page type and position
         */
        function display_ads_by_page(string $pageType, string $position, array $attributes = []): string
        {
            if (!is_plugin_active('ads')) {
                return '';
            }

            return \Botble\Ads\Facades\AdsManager::displayByPageAndPosition($pageType, $position, $attributes);
        }
    }

    if (!function_exists('render_page_ads')) {
        /**
         * Render ads for a page - returns empty string if no ads, no placeholder
         */
        function render_page_ads(string $pageType, string $position, array $attributes = []): string
        {
            if (!is_plugin_active('ads')) {
                return '';
            }

            try {
                $ads = '';
                if (function_exists('display_ads_by_page')) {
                    $ads = display_ads_by_page($pageType, $position, $attributes);
                }
                
                // Fallback to location-based system
                if (empty($ads)) {
                    // Map position to location key format
                    $locationMap = [
                        'job-detail' => [
                            'top' => 'job-detail-top',
                            'sidebar-right' => 'job-detail-sidebar',
                            'sidebar' => 'job-detail-sidebar',
                            'bottom' => 'job-detail-bottom',
                        ],
                        'jobs' => [
                            'top' => 'jobs-top',
                            'sidebar-right' => 'jobs-sidebar',
                            'sidebar' => 'jobs-sidebar',
                            'bottom' => 'jobs-bottom',
                        ],
                        'candidate-detail' => [
                            'top' => 'candidate-detail-top',
                            'sidebar-right' => 'candidate-detail-sidebar',
                            'sidebar' => 'candidate-detail-sidebar',
                            'bottom' => 'candidate-detail-bottom',
                        ],
                        'company-detail' => [
                            'top' => 'company-detail-top',
                            'sidebar-right' => 'company-detail-sidebar',
                            'sidebar' => 'company-detail-sidebar',
                            'bottom' => 'company-detail-bottom',
                        ],
                        'home' => [
                            'top' => 'home-top',
                            'sidebar' => 'home-sidebar',
                            'bottom' => 'home-bottom',
                        ],
                        'for-schools' => [
                            'top' => 'for-schools-top',
                            'sidebar' => 'for-schools-sidebar',
                            'bottom' => 'for-schools-bottom',
                        ],
                        'for-teachers' => [
                            'top' => 'for-teachers-top',
                            'sidebar' => 'for-teachers-sidebar',
                            'bottom' => 'for-teachers-bottom',
                        ],
                    ];
                    
                    $locationKey = null;
                    if (isset($locationMap[$pageType][$position])) {
                        $locationKey = $locationMap[$pageType][$position];
                    } else {
                        // Default fallback: pageType-position
                        $locationKey = $pageType . '-' . str_replace('-right', '', $position);
                    }
                    
                    if ($locationKey) {
                        $ads = \Botble\Ads\Facades\AdsManager::display($locationKey, $attributes, false);
                    }
                }
                
                // Return empty if no ads (no placeholder, no empty div)
                return $ads ?: '';
            } catch (\Exception $e) {
                return '';
            }
        }
    }
}
