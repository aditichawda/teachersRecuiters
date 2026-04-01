@if ($testimonials->count())
    @switch($shortcode->style)
        @case('style-7')
            {!! Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')) !!}
            @break
        @case('style-8')
            {!! Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')) !!}
            @break
        @case('style-2')
            {!! Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')) !!}
            @break
        @case('style-3')
            {!! Theme::partial('shortcodes.testimonials.' . $shortcode->style, compact('shortcode', 'testimonials')) !!}
            @break
        @default
            {!! Theme::partial('shortcodes.testimonials.style-1', compact('shortcode', 'testimonials')) !!}
    @endswitch
@endif
