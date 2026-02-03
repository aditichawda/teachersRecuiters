@if ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <input type="hidden" name="page" data-value="{{ $candidates->currentPage() }}">
    <input type="hidden" name="keyword" value="{{ request()->input('keyword') }}">
@endif

@php
    $layout = request()->input('layout', $layout ?? 'grid');
    $layout = in_array($layout, ['grid', 'list', 'list-2', 'list-7']) ? $layout : 'grid';
@endphp

<div class="twm-candidates-list-wrap">
    <div id="page-loading" style="display: none">
        <div class="page-backdrop"></div>
        <div class="page-loading"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="candidates-content">
        @include(Theme::getThemeNamespace('views.job-board.partials.candidates.'. $layout))

        @if ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    {!! $candidates->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                </div>
            </div>
        @endif
    </div>
</div>

