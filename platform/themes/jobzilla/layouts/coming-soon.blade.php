<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        {!! Theme::partial('header-meta') !!}
    </head>

    <body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
        <div class="toast-container" id="alert-container"></div>

        @if (theme_option('preloader_enabled', 'yes') == 'yes')
            {!! Theme::partial('preloader') !!}
        @endif

        <div class="page-wraper">
            <div class="page-content">
                {!! Theme::content() !!}
            </div>
        </div>

        {!! Theme::footer() !!}
        <script src="{{ Theme::asset()->url('js/coming-soon.js') }}"></script>
    </body>
</html>
