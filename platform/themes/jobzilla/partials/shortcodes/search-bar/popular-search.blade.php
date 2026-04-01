@if (is_plugin_active('job-board') && $popular_searches && $keywords = array_map('trim', array_filter(explode(';', $popular_searches))))
    <div class="twm-bnr-popular-search">
        <div class="twm-popular-title" style="color: #000000;">{{ __('Popular Searches') }}:</div>
        <div class="twm-popular-tags" style="padding: 0rem; gap: 0px">
            @foreach ($keywords as $item)
                <a href="{{ JobBoardHelper::getJobsPageURL() }}?keyword={{ $item }}" class="twm-popular-tag">{{ $item }}</a>
            @endforeach
        </div>
    </div>
@endif
