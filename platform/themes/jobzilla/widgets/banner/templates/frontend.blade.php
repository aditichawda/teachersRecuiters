<section class="section-box mt-40 mb-0">
    <div class="container position-relative">
        <div class="banner-promotion" @if ($config['image']) style="background: url({{ RvMedia::getImageUrl($config['image']) }}) no-repeat top center;" @endif>
            <div class="box-banner-promotion">
                <h3 class="text-head-ads mb-15">{!! BaseHelper::clean(Arr::get($config, 'title')) !!}</h3>
                <p class="desc-ads">{!! BaseHelper::clean(nl2br(Arr::get($config, 'subtitle'))) !!}</p>
            </div>
        </div>
        @if ($config['link'])
            <a href="{{ $config['link'] }}" class="stretched-link"></a>
        @endif
    </div>
</section>
