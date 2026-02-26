<style>
/* Home City Search Dropdown Styling */
.home-city-search-wrapper {
    position: relative;
}

.home-city-suggestions {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    background: #fff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
    z-index: 1000 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    margin-top: 0 !important;
}

.home-city-suggestion-item {
    padding: 12px 16px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #333 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #fff !important;
}

.home-city-suggestion-item:last-child {
    border-bottom: none !important;
}

.home-city-suggestion-item:hover,
.home-city-suggestion-item.active {
    background: #f0f7ff !important;
    color: #0073d1 !important;
}

.home-city-suggestion-item .city-name {
    font-weight: 500 !important;
    color: inherit !important;
    margin-bottom: 2px !important;
}

.home-city-suggestion-item .city-location {
    font-size: 12px !important;
    color: #64748b !important;
    margin-top: 2px !important;
}

.home-city-loading,
.home-city-no-results {
    padding: 12px 16px !important;
    font-size: 13px !important;
    color: #64748b !important;
    text-align: center !important;
    background: #fff !important;
}

/* Ensure dropdown appears above other elements */
.twm-bnr-search-bar {
    position: relative;
    z-index: 1;
}

.home-city-search-wrapper {
    z-index: 1001;
}
</style>

<div class="twm-bnr-search-bar">
    {!! Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET']) !!}
        <div class="row">
            <div class="form-group col-xl-4 col-lg-5 col-md-6">
                <label>{{ __('Keyword') }}</label>
                <select class="wt-search-bar-select selectpicker-keyword" name="job_categories[]">
                    <option value="">{{ __('Type to search...') }}</option>
                    @foreach (app(\Botble\JobBoard\Repositories\Interfaces\CategoryInterface::class)->allBy(['status' => \Botble\Base\Enums\BaseStatusEnum::PUBLISHED]) as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (is_plugin_active('location'))
                <div class="form-group col-xl-4 col-lg-5 col-md-6">
                    <label>{{ __('Location') }}</label>
                    <div class="home-city-search-wrapper" style="position: relative;">
                        <input type="text" name="city_search" id="home_city_search" class="wt-search-bar-select home-city-search-input" placeholder="{{ __('Select Your Location') }}" autocomplete="off" value="{{ request('city_search', '') }}" />
                        <input type="hidden" name="city_id" id="home_city_id" value="{{ request('city_id', '') }}" />
                        <div class="home-city-suggestions" id="home-city-suggestions" style="display: none;"></div>
                    </div>
                </div>
            @endif

            <div class="form-group col-xl-4 col-lg-2 col-md-12">
                <button type="submit" class="site-button">{{ __('Find Job') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
