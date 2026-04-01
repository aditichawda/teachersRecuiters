<?php

namespace Database\Seeders\Themes\Jobcy;

use Botble\Base\Supports\BaseSeeder;
use Botble\Theme\Facades\Theme;
use Botble\Widget\Models\Widget as WidgetModel;

class WidgetSeeder extends BaseSeeder
{
    public function run(): void
    {
        WidgetModel::query()->truncate();

        $data = [
            [
                'widget_id' => 'NewsletterWidget',
                'sidebar_id' => 'pre_footer_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'NewsletterWidget',
                    'title' => 'Get New Jobs Notification!',
                    'subtitle' => 'Subscribe & get all related jobs notification.',
                    'image' => 'themes/jobcy/general/newsletter-image.png',
                ],
            ],
            [
                'widget_id' => 'SiteInfoWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'SiteInfoWidget',
                    'name' => 'Jobcy',
                    'about' => 'It is a long established fact that a reader will be of a page reader will be of at its layout.',
                    'follow_us_heading' => 'Follow us on:',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Company',
                    'menu_id' => 'company',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'For Jobs',
                    'menu_id' => 'for-jobs',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'For Candidates',
                    'menu_id' => 'for-candidates',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 4,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Support',
                    'menu_id' => 'support',
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

        ];

        $theme = Theme::getThemeName();

        foreach ($data as $item) {
            $item['theme'] = $theme;
            WidgetModel::query()->create($item);
        }
    }
}
