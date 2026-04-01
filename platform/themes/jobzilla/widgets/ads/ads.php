<?php

use Botble\Widget\AbstractWidget;

class AdsWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Ads'),
            'description' => __('Widget display Ads'),
            'title' => __('Recruiting?'),
            'subtitle' => __('Get Best Matched Jobs On your Email. Add Resume NOW!'),
            'background' => '',
            'button_name' => __('Read More'),
            'button_url' => '/',
        ]);
    }
}
