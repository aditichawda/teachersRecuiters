<?php

use Botble\Widget\AbstractWidget;

class BannerWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Site information'),
            'description' => __('Widget display site information'),
            'title' => '',
            'subtitle' => '',
            'link' => '',
            'image' => '',
        ]);
    }
}
