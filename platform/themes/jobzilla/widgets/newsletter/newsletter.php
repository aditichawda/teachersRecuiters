<?php

use Botble\Widget\AbstractWidget;

class NewsletterWidget extends AbstractWidget
{
    public function __construct()
    {
        parent::__construct([
            'name' => __('Newsletter form'),
            'description' => __('Display Newsletter form on sidebar'),
            'title' => __('Get free coupons'),
            'subtitle' => __('Enter you email address and get free coupons.'),
        ]);
    }
}
