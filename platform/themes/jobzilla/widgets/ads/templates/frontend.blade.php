<div class="twm-advertisment" @if ($config['background']) style="background-image: url({{ RvMedia::getImageUrl($config['background']) }})" @endif>
    <div class="overlay"></div>
    <h4 class="twm-title">{!! BaseHelper::clean(Arr::get($config, 'title')) !!}</h4>
    <p>{!! BaseHelper::clean(Arr::get($config, 'subtitle')) !!}</p>
    @if ($config['button_url'])
        <a href="{{ $config['button_url'] }}" class="site-button white">{{ $config['button_name'] ?: __('Read More') }}</a>
    @endif
</div>
