<?php

namespace Theme\Jobzilla\Supports;

class ThemeHelper
{
    public static function getLayouts(): array
    {
        return [
            'list' => __('List'),
            'grid' => __('Grid'),
            'map' => __('Map'),
        ];
    }

    public static function getCurrentLayout(): string
    {
        $layout = request()->query('layout', theme_option('jobs_list_page_layout', 'list'));

        if (! in_array($layout, array_keys(static::getLayouts()))) {
            $layout = 'list';
        }

        return $layout;
    }
}
