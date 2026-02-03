{!! Theme::partial('blogs.blog', compact('posts')) !!}
{!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
