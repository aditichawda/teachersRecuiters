@php
    $tabs = [];
    $quantity = max((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if ($title = $shortcode->{'title_' . $i}) {
                $tabs[] = [
                    'title' => $title,
                    'subtitle' => $shortcode->{'subtitle_' . $i},
                    'monthly_price' => $shortcode->{'monthly_price_' . $i},
                    'annual_price' => $shortcode->{'annual_price_' . $i},
                    'link' => $shortcode->{'link_' . $i},
                    'title_link'  => $shortcode->{'title_link_' . $i} ?: __('Purchase Now'),
                    'checked' => array_filter(explode(';', $shortcode->{'checked_' . $i})),
                    'uncheck' => array_filter(explode(';', $shortcode->{'uncheck_' . $i})),
                ];
            }
        }
    }
@endphp

@if (count($tabs))
    @switch($shortcode->style)
        @case('style-3')
            {!! Theme::partial('shortcodes.quotation.' . $shortcode->style, compact('shortcode', 'tabs')) !!}
            @break
        @case('style-2')
        @default
            {!! Theme::partial('shortcodes.quotation.style-1', compact('shortcode', 'tabs')) !!}
    @endswitch
@endif
