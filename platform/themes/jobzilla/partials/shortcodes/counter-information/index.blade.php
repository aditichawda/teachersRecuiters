@php
    $tabs = [];
    $quantity = min((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            $tabs[] = [
                'title' => $shortcode->{'title_' . $i},
                'count' => $shortcode->{'count_' . $i},
                'image' => $shortcode->{'image_' . $i},
                'icon' => $shortcode->{'icon_' . $i},
                'extra' => $shortcode->{'extra_' . $i},
                'color' => Arr::random(['green', 'sky', 'pink']),
            ];
        }
    }

    $style = in_array($shortcode->style, ['style-1', 'style-2']) ? $shortcode->style : 'style-1';
@endphp


{!! Theme::partial('shortcodes.counter-information.' . $style, compact('shortcode', 'tabs')) !!}
