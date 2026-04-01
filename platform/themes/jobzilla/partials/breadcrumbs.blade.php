<div>
    <nav>
        <ul class="wt-breadcrumb breadcrumb-style-2">
            @foreach ($crumbs = Theme::breadcrumb()->getCrumbs() as $crumb)
                @if (! $loop->last)
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a href="{{ $crumb['url'] }}">
                            {!! BaseHelper::clean($crumb['label']) !!}
                            <meta itemprop="name" content="{{ $crumb['label'] }}" />
                        </a>
                        <meta itemprop="position" content="{{ $loop->iteration }}" />
                    </li>
                @else
                    <li aria-current="page" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        {!! BaseHelper::clean($crumb['label']) !!}
                        <meta itemprop="name" content="{{ $crumb['label'] }}" />
                        <meta itemprop="position" content="{{ $loop->iteration }}" />
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>
