<?php

use Botble\Widget\AbstractWidget;

class AppsDownloadWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Apps download'),
            'description' => __('Widget display Apps download'),
            'title' => 'You can order on App and Play store',
            'subtitle' => 'Bring the world of shopping to your phone',
            'ios_image' => '',
            'ios_link' => '#',
            'android_image' => '',
            'android_link' => '#',
            'image_1' => '',
            'image_2' => '',
            'background' => '',
            'featured' => '',
        ]);
    }
}
