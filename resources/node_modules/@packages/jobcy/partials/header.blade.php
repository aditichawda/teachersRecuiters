<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! Theme::partial('theme-meta') !!}

        {!! Theme::header() !!}

        <style>
            :root {
                --bs-primary: {{ theme_option('primary_color', '#5749cd') }};
                --bs-primary-rgb: {{ implode(', ', BaseHelper::hexToRgb(theme_option('primary_color', '#5749cd'))) }};
            }
        </style>
    </head>
    <body {!! Theme::bodyAttributes() !!}>
        {!! apply_filters(THEME_FRONT_BODY, null) !!}
        <a href="#main-content" class="visually-hidden-focusable position-absolute top-0 start-0 m-2 p-2 bg-primary text-white" style="z-index: 9999;">{{ __('Skip to main content') }}</a>
        <div id="alert-container"></div>

        @if (empty($withoutNavbar))
            {!! apply_filters('ads_render', null, 'header_before') !!}

            {!! Theme::partial('navbar') !!}

            {!! apply_filters('ads_render', null, 'header_after') !!}
        @endempty
