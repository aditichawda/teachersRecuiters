@if (is_plugin_active('job-board') && $popular_searches && $keywords = array_map('trim', array_filter(explode(';', $popular_searches))))
    <div class="twm-bnr-popular-search">
        <span class="twm-title">{{ __('Popular Searches') }}:</span>
        @foreach ($keywords as $item)
            <a href="{{ JobBoardHelper::getJobsPageURL() }}?keyword={{ $item }}">{{ $item }}</a> {{ ! $loop->last ? ',' : '...' }}
        @endforeach
    </div>
@endif
