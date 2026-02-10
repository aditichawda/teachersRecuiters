<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>

    {!! Theme::partial('theme-meta') !!}

    {!! Theme::header() !!}
</head>

    <body {!! Theme::bodyAttributes() !!}>
        {!! apply_filters(THEME_FRONT_BODY, null) !!}
        <div id="alert-container"></div>

        <div>
            <div class="main-content">
                <div class="page-content">
                    {!! Theme::content() !!}
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        {!! Theme::footer() !!}

        <script>
            'use strict';
            window.siteConfig = {
                countdown: {
                    days   : "{{ __('Days') }}",
                    hours  : "{{ __('Hours') }}",
                    minutes: "{{ __('Minutes') }}",
                    seconds: "{{ __('Seconds') }}",
                    ended  : "{{ __('The countdown has ended!') }}"
                }
            };
        </script>

        <script src="{{ Theme::asset()->url('js/coming-soon.js') }}"></script>
    </body>
</html>
