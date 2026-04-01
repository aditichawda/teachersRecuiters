@php
    $page->loadMissing('metadata');
    Theme::set('header_css_class', $page->getMetaData('header_css_class', true) ?: '');
    Theme::set('pageCoverImage', $page->getMetaData('background_breadcrumb', true) ?: theme_option('background_breadcrumb_default'));
@endphp

{!! Theme::partial('header') !!}

<div class="page-content">
    <div class="container">
        <div class="how-it-works-container">
            <h1 class="text-center mb-5">{{ $page->name }}</h1>
            <div class="row">
                <div class="col-12">
                    {!! BaseHelper::clean($page->content) !!}
                </div>
            </div>
        </div>
    </div>
</div>

{!! Theme::partial('footer') !!}