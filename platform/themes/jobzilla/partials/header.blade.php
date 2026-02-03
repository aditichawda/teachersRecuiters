<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        {!! Theme::partial('header-meta') !!}
    </head>
    <body data-anm=".anm" {!! Theme::bodyAttributes() !!}>
        {!! apply_filters(THEME_FRONT_BODY, null) !!}

        <div class="toast-container" id="alert-container"></div>

        @if (theme_option('preloader_enabled', 'yes') == 'yes')
            {!! Theme::partial('preloader') !!}
        @endif

        <div class="page-wraper">
            @if (empty($withoutNavbar))
                {!! Theme::partial('navbar') !!}
            @endif

            <!-- CONTENT START -->
            <div class="page-content">
