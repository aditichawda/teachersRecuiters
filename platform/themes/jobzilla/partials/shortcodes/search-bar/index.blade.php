@php
    $tabs = [];
    $quantity = min((int) $shortcode->quantity, 20);
    if ($quantity) {
        for ($i = 1; $i <= $quantity; $i++) {
            if ($image = $shortcode->{'image_' . $i}) {
                $tabs[] = [
                    'link' => $shortcode->{'link_' . $i},
                    'image' => $image,
                ];
            }
        }
    }
@endphp

<div class="twm-search-bar-2-wrap">
    <div class="container">
        <div class="twm-search-bar-2-inner">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    @switch($shortcode->type)
                        @case('mini')
                            {!! Theme::partial('shortcodes.search-bar.form-mini') !!}
                            @break
                        @default
                            {!! Theme::partial('shortcodes.search-bar.form') !!}
                    @endswitch
                </div>
                @if (count($tabs))
                    <div class="col-lg-3 col-md-12">
                        <div class="twm-trusted-by-wrap">
                            <div class="twm-trusted-by-title">{!! BaseHelper::clean($shortcode->tab_title) !!}</div>
                            <div class="owl-carousel trusted-logo owl-btn-vertical-center">
                                @foreach ($tabs as $tab)
                                    <div class="item">
                                        <div class="twm-trusted-logo">
                                            @if (($link = Arr::get($tab, 'link')) && ($image = Arr::get($tab, 'image')))
                                                <a href="{{ $link }}">
                                                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $image }}">
                                                </a>
                                            @else
                                                <a href="javascript:void(0);">
                                                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $image }}">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {!! Theme::partial('shortcodes.search-bar.popular-search', ['popular_searches' => $shortcode->popular_searches]) !!}
        </div>
    </div>
</div>
