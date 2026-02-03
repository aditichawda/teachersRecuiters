<ul>
    @forelse($jobs as $job)
        <li>
            {!! Theme::partial('jobs.style-1', compact('job')) !!}
        </li>
    @empty
    @endforelse
</ul>

@if($jobs instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    {{ $jobs->links(Theme::getThemeNamespace('partials.pagination')) }}
@endif
