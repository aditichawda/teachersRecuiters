<div class="row">
    @forelse($jobs as $job)
        <div @class(['col-md-12 m-b30', $class ?? 'col-lg-6'])>
            {!! Theme::partial("jobs.style-$style", compact('job')) !!}
        </div>
    @empty
    @endforelse
</div>

@if($jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    {{ $jobs->links(Theme::getThemeNamespace('partials.pagination')) }}
@endif
