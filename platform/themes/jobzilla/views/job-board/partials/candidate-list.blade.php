@if(request()->query('layout') === 'grid')
    @include(Theme::getThemeNamespace('views.job-board.partials.candidates.grid'))
@else
    @include(Theme::getThemeNamespace('views.job-board.partials.candidates.list'))
@endif
{{ $candidates->links(Theme::getThemeNamespace('partials.pagination')) }}
