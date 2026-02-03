<div class="widget-popular-title mt-4">
    <h2 class="h6">{{ __('Featured') }}</h2>
    <ul class="list-inline">
        @foreach ($jobFeaturedCategories->where('jobs_count')->sortByDesc('jobs_count') as $item)
            <li class="list-inline-item">
                <div class="popular-box d-flex align-items-center"
                    @if (in_array($item->id, (array) request()->input('job_categories', []))) style="background-color: rgba(118, 109, 244, 0.15)" @endif>
                    <div class="number flex-shrink-0 me-2">
                        {{ $item->jobs_count }}
                    </div>
                    <a href="{{ JobBoardHelper::getJobsPageURL() }}?job_categories[]={{ $item->id }}" class="primary-link stretched-link">
                        <span class="fs-14 mb-0 h6">{{ $item->name }}</span>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
</div><!--end widget-popular-title-->
