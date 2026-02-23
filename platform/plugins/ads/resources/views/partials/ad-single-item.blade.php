@if ($item->ads_type === 'google_adsense' && $item->google_adsense_slot_id)
    <div class="ad-item ad-google-adsense">
        @include('plugins/ads::partials.google-adsense.unit-ads-slot', ['slotId' => $item->google_adsense_slot_id])
    </div>
    @return
@endif

@if (!$item->image)
    @return
@endif

@php
    $imageUrl = $item->image_url ?? RvMedia::getImageUrl($item->image);
    $tabletImageUrl = $item->tablet_image_url ?? ($item->tablet_image ? RvMedia::getImageUrl($item->tablet_image) : $imageUrl);
    $mobileImageUrl = $item->mobile_image_url ?? (($item->mobile_image ? RvMedia::getImageUrl($item->mobile_image) : null) ?? $tabletImageUrl);
    $clickUrl = $item->url ? ($item->click_url ?? $item->url) : null;
@endphp

<div class="ad-item ad-custom">
    @if ($clickUrl)
        <a href="{{ $clickUrl }}" @if ($item->open_in_new_tab) target="_blank" @endif title="{{ $item->name }}">
    @endif
    <picture>
        <source
            srcset="{{ $imageUrl }}"
            media="(min-width: 1200px)"
        />
        <source
            srcset="{{ $tabletImageUrl }}"
            media="(min-width: 768px)"
        />
        <source
            srcset="{{ $mobileImageUrl }}"
            media="(max-width: 767px)"
        />

        {{ RvMedia::image($imageUrl, $item->name, attributes: ['style' => 'width: 100%; max-width: 100%; height: auto; min-height: 100px; max-height: 400px; object-fit: contain; display: block;']) }}
    </picture>
    @if($clickUrl)
        </a>
    @endif
</div>
