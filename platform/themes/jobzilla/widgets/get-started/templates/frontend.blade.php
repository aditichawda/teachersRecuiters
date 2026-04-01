<div class="row">
    <div class="col-md-4 col-sm-6 text-center text-md-start">
        @if ($config['image'])
            <a href="{{ $config['image_link'] ?: BaseHelper::getHomepageUrl()  }}">
                <img alt="{{ $config['name'] }}" src="{{ RvMedia::getImageUrl($config['image']) }}">
            </a>
        @endif
    </div>
    <div class="col-md-8 col-sm-6 text-center text-md-end">
        <span class="color-gray-900 text-heading-6 mr-30 text-mb-sm-20">{{ $config['title'] }}</span>
        @if ($config['link'])
            <a class="btn btn-square" href="{{ $config['link'] }}">{{ $config['text_link'] }}</a>
        @endif
    </div>
</div>
