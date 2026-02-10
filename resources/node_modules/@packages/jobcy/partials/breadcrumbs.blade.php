<div class="page-next">
    <nav class="d-inline-block" aria-label="breadcrumb text-center">
        <ol class="breadcrumb justify-content-center">
            @foreach ($crumbs = Theme::breadcrumb()->getCrumbs() as $crumb)
                @if (!$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $crumb['url'] }}">
                            {!! BaseHelper::clean($crumb['label']) !!}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {!! BaseHelper::clean($crumb['label']) !!}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
