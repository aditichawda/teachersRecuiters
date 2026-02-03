<?php

use Botble\Widget\AbstractWidget;

class SiteInfoWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Site information'),
            'logo' => '',
            'description' => __('Widget display site information'),
            'address' => theme_option('address'),
            'phone' => theme_option('hotline'),
            'email' => theme_option('email'),
        ]);
    }
}
