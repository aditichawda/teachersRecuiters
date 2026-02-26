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
    background: #ffffff !important;
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
    color: #000000 !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
    background: #ffffff !important;
}

.home-city-suggestion-item:last-child {
    border-bottom: none !important;
}

.home-city-suggestion-item:hover,
.home-city-suggestion-item.active {
    background: #f0f7ff !important;
    color: #000000 !important;
}

.home-city-suggestion-item .city-name {
    font-weight: 500 !important;
    color: #000000 !important;
    margin-bottom: 2px !important;
}

.home-city-suggestion-item:hover .city-name,
.home-city-suggestion-item.active .city-name {
    color: #000000 !important;
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
    background: #ffffff !important;
}

/* Ensure dropdown appears above other elements */
.twm-bnr-search-bar {
    position: relative;
    z-index: 1;
}

.home-city-search-wrapper {
    z-index: 1001;
}

/* Remove outline from location input field */
.home-city-search-input,
.home-city-search-input:focus,
.home-city-search-input:active,
.home-city-search-input:focus-visible,
.home-city-search-input:hover {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

.wt-search-bar-select.home-city-search-input,
.wt-search-bar-select.home-city-search-input:focus,
.wt-search-bar-select.home-city-search-input:active,
.wt-search-bar-select.home-city-search-input:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

/* Bootstrap Select Dropdown Styling - White Background, Black Text */
.wt-search-bar-select.selectpicker-keyword,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select,
.bootstrap-select.selectpicker-keyword {
    width: 100% !important;
}

/* Remove all outlines from selectpicker */
.wt-search-bar-select.selectpicker-keyword,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select *,
.bootstrap-select.selectpicker-keyword * {
    outline: none !important;
}

.wt-search-bar-select.selectpicker-keyword:focus,
.wt-search-bar-select.selectpicker-keyword:active,
.wt-search-bar-select.selectpicker-keyword:focus-visible {
    outline: none !important;
    box-shadow: none !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
}

/* Dropdown Button/Input */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle,
.bootstrap-select.selectpicker-keyword .dropdown-toggle {
    background: #ffffff !important;
    color: #000000 !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    padding: 8px 12px !important;
    font-size: 14px !important;
    height: auto !important;
    min-height: 34px !important;
    outline: none !important;
    box-shadow: none !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:focus,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:focus,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:active,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:active,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:focus-visible,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:focus-visible {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    box-shadow: none !important;
    outline: none !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle:hover,
.bootstrap-select.selectpicker-keyword .dropdown-toggle:hover {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.1) !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Selected Text */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option,
.bootstrap-select.selectpicker-keyword .filter-option {
    color: #000000 !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner,
.bootstrap-select.selectpicker-keyword .filter-option-inner {
    color: #000000 !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner-inner,
.bootstrap-select.selectpicker-keyword .filter-option-inner-inner {
    color: #000000 !important;
}

/* Dropdown Menu (List) */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu,
.bootstrap-select.selectpicker-keyword .dropdown-menu,
.bootstrap-select.selectpicker-keyword.show .dropdown-menu {
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    padding: 4px 0 !important;
    margin-top: 4px !important;
    max-height: 300px !important;
    overflow-y: auto !important;
}

/* Dropdown Menu Items */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item,
.bootstrap-select.selectpicker-keyword .dropdown-menu li a {
    background: #ffffff !important;
    color: #000000 !important;
    padding: 12px 16px !important;
    font-size: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
    transition: background 0.15s ease !important;
}

.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item:last-child,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item:last-child,
.bootstrap-select.selectpicker-keyword .dropdown-menu li:last-child a {
    border-bottom: none !important;
}

/* Hover State */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu li a:hover,
.bootstrap-select.selectpicker-keyword .dropdown-menu li:hover a {
    background: #f0f7ff !important;
    color: #000000 !important;
}

/* Active/Selected State */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-menu .dropdown-item.active,
.bootstrap-select.selectpicker-keyword .dropdown-menu .dropdown-item.active,
.bootstrap-select.selectpicker-keyword .dropdown-menu .selected a,
.bootstrap-select.selectpicker-keyword .dropdown-menu li.selected a {
    background: #f0f7ff !important;
    color: #000000 !important;
}

/* Placeholder Text */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .filter-option-inner-inner:empty::before,
.bootstrap-select.selectpicker-keyword .filter-option-inner-inner:empty::before {
    content: "Type to search..." !important;
    color: #94a3b8 !important;
}

/* Dropdown Arrow */
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .dropdown-toggle::after,
.bootstrap-select.selectpicker-keyword .dropdown-toggle::after {
    color: #000000 !important;
    border-top-color: #000000 !important;
}

/* Search Input Inside Dropdown (if present) */
.bootstrap-select.selectpicker-keyword .bs-searchbox input,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .bs-searchbox input {
    background: #ffffff !important;
    color: #000000 !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    padding: 8px 12px !important;
}

.bootstrap-select.selectpicker-keyword .bs-searchbox input:focus,
.wt-search-bar-select.selectpicker-keyword + .bootstrap-select .bs-searchbox input:focus {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: rgba(0, 0, 0, 0.2) !important;
    outline: none !important;
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
                <button type="submit" class="site-button" style="border-radius: 10px;">{{ __('Find Job') }}</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
