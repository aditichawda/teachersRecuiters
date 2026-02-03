<?php

use Botble\Media\Facades\RvMedia;
use Botble\Newsletter\Facades\Newsletter;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;

register_page_template([
    'default' => __('Default'),
    'homepage' => __('Homepage'),
    'static' => __('Static'),
    'coming-soon' => __('Coming soon'),
]);

register_sidebar([
    'id' => 'pre_footer_sidebar',
    'name' => __('Pre footer sidebar'),
    'description' => __('Widgets at the bottom of the page.'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Widgets in footer of page'),
]);

app()->booted(function (): void {
    RvMedia::addSize('small', 500, 300)->addSize('medium', 740, 416);

    ThemeSupport::registerSiteLogoHeight(70);
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerSocialSharing();
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerDateFormatOption();
    ThemeSupport::registerPreloader();

    Theme::typography()
        ->registerFontFamilies([
            new TypographyItem('primary', __('Primary'), theme_option('primary_font', 'Inter')),
        ]);

    if (is_plugin_active('newsletter')) {
        Newsletter::registerNewsletterPopup();
    }

    add_filter('ads_locations', function (array $locations) {
        return [
            ...$locations,
            'header_before' => __('Header (before)'),
            'header_after' => __('Header (after)'),
            'footer_before' => __('Footer (before)'),
            'footer_after' => __('Footer (after)'),
            'job_list_before' => __('Job List (before)'),
            'job_list_after' => __('Job List (after)'),
            'job_detail_before' => __('Job Detail (before)'),
            'job_detail_after' => __('Job Detail (after)'),
            'job_detail_sidebar_before' => __('Job Detail Sidebar (before)'),
            'job_detail_sidebar_after' => __('Job Detail Sidebar (after)'),
            'blog_list_before' => __('Blog List (before)'),
            'blog_list_after' => __('Blog List (after)'),
            'blog_sidebar_before' => __('Blog Sidebar (before)'),
            'blog_sidebar_after' => __('Blog Sidebar (after)'),
            'post_detail_before' => __('Post Detail (before)'),
            'post_detail_after' => __('Post Detail (after)'),
        ];
    }, 128);

    add_filter('theme_preloader_versions', function (array $versions): array {
        return [
            ...$versions,
            'v2' => __('Theme built-in'),
        ];
    }, 999);

    add_filter('theme_preloader', function (?string $html): ?string {
        if (theme_option('preloader_version', 'v1') === 'v2') {
            return $html . Theme::partial('preloader');
        }

        return $html;
    }, 999);
});
