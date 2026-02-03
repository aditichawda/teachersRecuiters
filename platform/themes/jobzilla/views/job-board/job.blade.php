@php
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::set('pageTitle', $job->name);
    $layout = $job->getMetadata('layout', true);
    if (! in_array($layout, ['v1', 'v2'])) {
        $layout = 'v1';
    }
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'))
@endphp

@include(Theme::getThemeNamespace('views.job-board.job-' . $layout))
