<div class="col-lg-4">
    <div class="footer-item mt-4 mt-lg-0 me-lg-5">
        <span class="text-white mb-4 h4 d-inline-block">{!! BaseHelper::clean($config['name']) !!}</span>
        <p class="text-white-50">{!! BaseHelper::clean($config['about']) !!}</p>
        @if (Arr::get($config, 'show_social_links', true) && ($socialLinks = Theme::getSocialLinks()))
            <p class="text-white mt-3">{!! BaseHelper::clean($config['follow_us_heading']) !!}</p>
            <ul class="footer-social-menu list-inline mb-0">
                @foreach($socialLinks as $socialLink)
                    @continue(! $socialLink->getUrl() || ! $socialLink->getIconHtml())

                    <li class="list-inline-item">
                        <a {!! $socialLink->getAttributes(['title' => $socialLink->getName()]) !!}>
                            {!! $socialLink->getIconHtml() !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
