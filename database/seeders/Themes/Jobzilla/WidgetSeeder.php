<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\Theme\Facades\Theme;
use Botble\Widget\Database\Traits\HasWidgetSeeder;
use Botble\Widget\Models\Widget as WidgetModel;
use Illuminate\Support\Str;

class WidgetSeeder extends BaseSeeder
{
    use HasWidgetSeeder;

    public function run(): void
    {
        WidgetModel::query()->truncate();

        $widgets = [
            [
                'widget_id' => 'NewsletterWidget',
                'sidebar_id' => 'pre_footer_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'NewsletterWidget',
                    'title' => 'Get New Jobs Notification!',
                    'subtitle' => 'Join our email subscription now to get updates on new jobs and notifications.',
                ],
            ],
            [
                'widget_id' => 'SiteInfoWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'SiteInfoWidget',
                    'name' => 'Site Information',
                    'logo' => 'themes/jobzilla/general/logo-light.png',
                    'description' => 'Many desktop publishing packages and web page editors now.',
                    'address' => '65 Sunset CA 90026, USA',
                    'phone' => '555-555-1234',
                    'email' => 'example@max.com',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'For Candidate',
                    'menu_id' => Str::slug('For Candidate'),
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'For Employers',
                    'menu_id' => Str::slug('For Candidate'),
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Helpful Resources',
                    'menu_id' => Str::slug('Helpful Resources'),
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 4,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Quick Links',
                    'menu_id' => Str::slug('Quick Links'),
                ],
            ],

            [
                'widget_id' => 'BlogSearchWidget',
                'sidebar_id' => 'primary_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'BlogSearchWidget',
                    'name' => 'Search',
                ],
            ],
            [
                'widget_id' => 'BlogCategoriesWidget',
                'sidebar_id' => 'primary_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'BlogCategoriesWidget',
                    'name' => 'Categories',
                ],
            ],
            [
                'widget_id' => 'BlogPostsWidget',
                'sidebar_id' => 'primary_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'BlogPostsWidget',
                    'type' => 'popular',
                    'name' => 'Popular Posts',
                ],
            ],
            [
                'widget_id' => 'BlogTagsWidget',
                'sidebar_id' => 'primary_sidebar',
                'position' => 4,
                'data' => [
                    'id' => 'BlogTagsWidget',
                    'name' => 'Popular Tags',
                ],
            ],
            [
                'widget_id' => 'AdsWidget',
                'sidebar_id' => 'job_board_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'AdsWidget',
                    'name' => 'Ads',
                    'title' => 'Recruiting?',
                    'subtitle' => 'Get Best Matched Jobs On your Email. Add Resume NOW!',
                    'background' => 'themes/jobzilla/general/add-bg.jpg',
                    'button_name' => 'Read More',
                    'button_url' => '/',
                ],
            ],
            [
                'widget_id' => 'BlogSearchWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'BlogSearchWidget',
                ],
            ],
            [
                'widget_id' => 'BlogPopularCategoriesWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'BlogPopularCategoriesWidget',
                    'name' => __('Categories'),
                    'number_display' => 5,
                ],
            ],
            [
                'widget_id' => 'BlogPostsWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'BlogPostsWidget',
                    'name' => __('Recent Articles'),
                    'number_display' => 6,
                ],
            ],
            [
                'widget_id' => 'BlogPopularTagsWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'BlogPopularTagsWidget',
                    'name' => __('Tags'),
                    'number_display' => 5,
                ],
            ],
        ];

        $theme = Theme::getThemeName();

        foreach ($widgets as $widget) {
            $widget['theme'] = $theme;
            foreach ($widget['data'] as $key => $value) {
                if ($key == 'id') {
                    continue;
                }

                if ($key == 'menu_id') {
                    $widget['data'][$key] = Str::slug($widget['data']['name']);

                    continue;
                }

                $widget['data'][$key] = $value;
            }

            WidgetModel::query()->create($widget);
        }
    }
}
