<div class="col">
    <div class="widget widget_about">
        @if ($config['logo'])
            <div class="logo-footer clearfix">
                <a href="{{ BaseHelper::getHomepageUrl()  }}">
                    <img src="{{ RvMedia::getImageUrl($config['logo']) }}" alt="{{ theme_option('site_title') }}">
                </a>
            </div>
        @endif
        <p>{!! BaseHelper::clean($config['description']) !!}</p>
        <ul class="ftr-list">
            <li>
                <p><span>{{ __('Address') }} :</span>{!! BaseHelper::clean(nl2br($config['address'])) !!}</p>
            </li>
            <li>
                <p><span>{{ __('Email') }} :</span><a class="text-white" href="mailto:{{ $config['email'] }}">{{ $config['email'] }}</a></p>
            </li>
            <li>
                <p><span>{{ __('Call') }} :</span><a class="text-white" href="tel:{{ $config['phone'] }}">{{ $config['phone'] }}</a></p>
            </li>
        </ul>
    </div>
</div>
