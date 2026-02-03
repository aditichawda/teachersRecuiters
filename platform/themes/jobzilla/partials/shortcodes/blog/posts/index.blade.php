@if ($posts->count())
    @switch($shortcode->style)
        @case('style-8')
        @case('style-7')
        @case('style-4')
        @case('style-3')
        @case('style-2')
            {!! Theme::partial('shortcodes.blog.posts.' . $shortcode->style, compact('shortcode', 'posts', 'category')) !!}
            @break
        @default
            {!! Theme::partial('shortcodes.blog.posts.style-1', compact('shortcode', 'posts', 'category')) !!}
    @endswitch
@endif
