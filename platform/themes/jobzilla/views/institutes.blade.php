@php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', true);
@endphp

<div class="container py-4">
    {!! do_shortcode('[job-companies style="grid" paginate="12"][/job-companies]') !!}
</div>

