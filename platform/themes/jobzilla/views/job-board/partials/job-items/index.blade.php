@if ($jobs instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <input type="hidden" name="page" data-value="{{ $jobs->currentPage() }}">
    <input type="hidden" name="keyword" value="{{ request()->input('keyword') }}">
@endif

@php
    $layout = $layout ?? request()->input('layout');
    $layout = in_array($layout, ['grid-2', 'grid-3', 'grid-3x', 'list', 'recommend']) ? $layout : 'grid-2';
@endphp

@include(Theme::getThemeNamespace('views.job-board.partials.job-items.'. $layout))

@if ($jobs instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-lg-12 mt-4 pt-2">
            {!! $jobs->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
        </div>
    </div>
@endif
