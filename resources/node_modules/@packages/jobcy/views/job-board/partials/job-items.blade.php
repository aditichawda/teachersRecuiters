<input type="hidden" name="page" data-value="{{ $jobs->currentPage() }}">
<input type="hidden" name="keyword" value="{{ BaseHelper::stringify(request()->query('keyword')) }}">

@php
    $jobLayout = $jobLayout ?? request()->input('layout', 'list');
@endphp

<div>
    @switch($jobLayout)
        @case('grid')
            <div class="row row-cols-md-2 row-cols-1 ">
                @forelse ($jobs as $job)
                    <div class="col">
                        @include(Theme::getThemeNamespace('views.job-board.partials.job-item-grid'), ['job' => $job])
                    </div>
                @empty
                    <div class="alert alert-warning mt-2" role="alert">
                        {{ __(':total Jobs found', ['total' => 0]) }}
                    </div>
                @endforelse
            </div>
            @break
        @default
            @forelse ($jobs as $job)
                @include(Theme::getThemeNamespace('views.job-board.partials.job-item'), ['job' => $job])
            @empty
                <div class="alert alert-warning mt-2" role="alert">
                    {{ __(':total Jobs found', ['total' => 0]) }}
                </div>
            @endforelse
    @endswitch
</div>

<!-- End Job-list -->
<div class="row">
    <div class="col-lg-12 mt-4 pt-2">
        {!! $jobs->withQueryString()->onEachSide(1)->links(Theme::getThemeNamespace('partials.pagination')) !!}
    </div>
</div>
