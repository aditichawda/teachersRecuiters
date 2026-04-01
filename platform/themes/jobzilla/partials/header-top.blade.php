<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar-offcanvas" aria-labelledby="sidebar-offcanvasLabel">
    <div class="offcanvas-header border-bottom border-primary">
        <div>
            <a href="{{ BaseHelper::getHomepageUrl() }}">
                {{ Theme::getLogoImage(['style' => 'max-height: 44px']) }}
            </a>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if ($address = theme_option('address'))
            <div class="contact-list">
                <h4>{{ __('Address') }}</h4>
                <p>{{ $address }}</p>
            </div>
        @endif

        @if ($hotline = theme_option('hotline'))
            <div class="contact-list">
                <h4>{{ __('Hotline') }}</h4>
                <p><a href="tel:{{ $hotline }}">{{ $hotline }}</a></p>
            </div>
        @endif

        @if ($email = theme_option('email'))
            <div class="contact-list">
                <h4>{{ __('Email') }}</h4>
                <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
            </div>
        @endif

        {!! Theme::partial('language-switcher') !!}

        {!! Theme::partial('currency-switcher') !!}

        @if ($socialLinks = Theme::getSocialLinks())
            <ul class="sidebar-social-icons">
                @foreach($socialLinks as $socialLink)
                    @continue(! $socialLink->getUrl() || ! $socialLink->getIconHtml())

                    <a {!! $socialLink->getAttributes(['class' => '']) !!}>{{ $socialLink->getIconHtml() }}</a>
                @endforeach
            </ul>
        @endif
    </div>
</div>
