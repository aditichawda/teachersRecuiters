@php
    $tabs = [];
    $quantity = max((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if (($title = $shortcode->{'title_' . $i})) {
                $tabs[] = [
                    'title' => $title,
                    'count' => $shortcode->{'count_' . $i},
                    'image' => $shortcode->{'image_' . $i},
                    'extra' => $shortcode->{'extra_' . $i},
                ];
            }
        }
    }
    $style = in_array($shortcode->style, ['style-1', 'style-2', 'style-3', 'style-4', 'style-5']) ? $shortcode->style : 'style-1';
@endphp

{!! Theme::partial('shortcodes.explore-new-life.' . $style, compact('shortcode',  'tabs')) !!}
