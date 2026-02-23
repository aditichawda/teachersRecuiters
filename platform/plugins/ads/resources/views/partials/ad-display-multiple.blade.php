@php
    $bannerType = $data[0]->banner_type ?? 'single';
    $bannerCount = count($data);
    $firstAd = $data[0];
    
    // Check if single ad has multiple images
    $hasMultipleImages = ($firstAd->image_2 || $firstAd->image_3) && $bannerCount === 1;
@endphp

@if($bannerType === 'single' && !$hasMultipleImages)
    @include('plugins/ads::partials.ad-display', ['data' => [$firstAd], 'attributes' => $attributes])
@elseif($hasMultipleImages)
    {{-- Single ad with multiple images --}}
    @php
        $images = [];
        $urls = [];
        if ($firstAd->image) {
            $images[] = $firstAd;
            $urls[] = $firstAd->url;
        }
        if ($firstAd->image_2) {
            $img2 = clone $firstAd;
            $img2->image = $firstAd->image_2;
            $img2->url = $firstAd->url_2 ?? $firstAd->url;
            $images[] = $img2;
        }
        if ($firstAd->image_3) {
            $img3 = clone $firstAd;
            $img3->image = $firstAd->image_3;
            $img3->url = $firstAd->url_3 ?? $firstAd->url;
            $images[] = $img3;
        }
        $imageCount = count($images);
    @endphp
    <div class="ads-container ads-{{ $imageCount === 2 ? 'double' : 'multiple' }}" {!! Html::attributes($attributes) !!}>
        <div class="row g-3">
            @foreach($images as $img)
                <div class="col-md-{{ $imageCount === 2 ? '6' : '4' }}">
                    @include('plugins/ads::partials.ad-single-item', ['item' => $img])
                </div>
            @endforeach
        </div>
    </div>
@elseif($bannerType === 'double' || $bannerCount === 2)
    <div class="ads-container ads-double" {!! Html::attributes($attributes) !!}>
        <div class="row g-3">
            @foreach($data->take(2) as $item)
                <div class="col-md-6">
                    @include('plugins/ads::partials.ad-single-item', ['item' => $item])
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="ads-container ads-multiple" {!! Html::attributes($attributes) !!}>
        <div class="row g-3">
            @foreach($data->take(3) as $item)
                <div class="col-md-4">
                    @include('plugins/ads::partials.ad-single-item', ['item' => $item])
                </div>
            @endforeach
        </div>
    </div>
@endif
