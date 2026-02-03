<section class="section-box mt-70 shop-bottom-banner">
    <div class="container">
        <div class="box-green box-green-2 bdr-18" @if ($config['background']) style="background-image: url({{ RvMedia::getImageUrl($config['background']) }})" @endif>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h3 class="text-heading-1 color-white">{!! BaseHelper::clean(Arr::get($config, 'title')) !!}</h3>
                    <p class="text-desc-white">{!! BaseHelper::clean(Arr::get($config, 'subtitle')) !!}</p>
                </div>
            </div>
            <div class="mt-60">
                @if ($config['ios_link'])
                    <a class="mr-20" href="{{ $config['ios_link'] }}">
                        <img src="{{ $config['ios_image'] ? RvMedia::getImageUrl($config['ios_image']) :  Theme::asset()->url('apple-button.png') }}" alt="ios-image">
                    </a>
                @endif
                @if ($config['android_link'])
                    <a href="{{ $config['android_link'] }}">
                        <img src="{{ $config['android_image'] ? RvMedia::getImageUrl($config['android_image']) :  Theme::asset()->url('google-play.png') }}" alt="android-image">
                    </a>
                @endif
            </div>
            <div class="mt-10">
                @foreach (array_filter(explode(';', $config['featured'])) as $item)
                    <span class="cb-layout @if ($loop->first) mr-5 @endif">{{ $item }}</span>
                @endforeach
            </div>
            <div class="block-1 d-none d-lg-block">
                @if ($config['image_1'])
                    <img src="{{ RvMedia::getImageUrl($config['image_1']) }}" alt="image-1">
                @endif
            </div>
            <div class="block-2 d-none d-lg-block">
                @if ($config['image_2'])
                    <img src="{{ RvMedia::getImageUrl($config['image_2']) }}" alt="image-2">
                @endif
            </div>
        </div>
    </div>
</section>
