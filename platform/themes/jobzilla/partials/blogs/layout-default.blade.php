@php
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
@endphp

{!! Theme::partial('page-header') !!}

<div class="section-full p-t120  p-b90 site-bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                {!! Theme::partial('blogs.blog', compact('posts')) !!}
                {!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="side-bar">
                    {!! dynamic_sidebar('blog_sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</div>
