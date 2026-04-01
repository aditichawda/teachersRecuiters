@php
  $withCategories = $withCategories ?? true;
@endphp

<div class="job-list-header">
    {!! Form::open([
        'url' => $formUrl ?? JobBoardHelper::getJobsPageURL(),
        'method' => 'GET',
        'id' => 'jobs-filter-form',
        'data-ajax-url' => $formAjaxUrl ?? route('public.ajax.jobs'),
    ]) !!}
    <div class="row g-2">
        <div @class(['col-md-6', 'col-lg-3' => $withCategories, 'col-lg-4' => ! $withCategories])>
            <div class="filler-job-form">
                <i class="uil uil-briefcase-alt"></i>
                <input type="search" name="keyword" value="{{ BaseHelper::stringify(request()->query('keyword')) }}"
                    class="form-control filter-job-input-box" placeholder="{{ __('Job, company...') }}">
            </div>
        </div>
        @if (is_plugin_active('location'))
            <div @class(['col-md-6', 'col-lg-3' => $withCategories, 'col-lg-4' => ! $withCategories])>
                <div class="filler-job-form">
                    <i class="uil uil-location-point"></i>
                    <select
                        class="form-select filter-input-box"
                        data-trigger
                        @if (setting('job_board_search_location_by', 'city_and_state') == 'state')
                            name="location"
                            data-url="{{ route('public.ajax.locations') }}"
                        @else
                            name="city_id"
                            data-url="{{ route('public.ajax.cities') }}"
                        @endif
                        id="choices-single-location"
                        aria-label="{{ __('Location') }}"
                        data-no-results-text="{{ __('No results found.') }}"
                        data-loading-text="{{ __('Loading...') }}"
                        data-no-choices-text="{{ __('No choices to choose from') }}"
                        data-search-placeholder-value="{{ __('Enter keyword to search') }}"
                        data-placeholder-value="{{ __('Select a location') }}"
                    >
                        <option value="">{{ __('Location') }}</option>

                        @if ($cityId = (int) request()->input('city_id'))
                            @if ($cityName = Location::getCityNameById($cityId))
                                <option value="{{ $cityId }}" selected>{{ $cityName }}</option>
                            @endif
                        @endif

                        @if ($location = BaseHelper::stringify(request()->input('location')))
                            <option value="{{ $location }}" selected>{{ $location }}</option>
                        @endif
                    </select>
                </div>
            </div>
        @endif

        @if ($withCategories)
            <div class="col-lg-3 col-md-6">
                <div class="filler-job-form">
                    <i class="uil uil-clipboard-notes"></i>
                    <select
                        class="form-select filter-input-box"
                        data-trigger
                        name="job_categories[]"
                        id="choices-single-categories"
                        aria-label="{{ __('Categories') }}"
                        data-url="{{ route('public.ajax.job-categories') }}"
                        data-no-results-text="{{ __('No results found.') }}"
                        data-loading-text="{{ __('Loading...') }}"
                        data-no-choices-text="{{ __('No choices to choose from') }}"
                        data-search-placeholder-value="{{ __('Enter keyword to search') }}"
                        data-placeholder-value="{{ __('Select a category') }}"
                    >
                        <option value="">{{ __('All') }}</option>

                        @php
                            $categoryIds = array_filter((array) request()->input('job_categories', []));
                            if (!empty($categoryIds)) {
                                $selectedCategories = \Botble\JobBoard\Models\Category::query()
                                    ->whereIn('id', $categoryIds)
                                    ->pluck('name', 'id');
                            }
                        @endphp

                        @if (!empty($categoryIds) && isset($selectedCategories))
                            @foreach ($categoryIds as $categoryId)
                                @if ($categoryName = $selectedCategories[$categoryId] ?? null)
                                    <option value="{{ $categoryId }}" selected>{{ $categoryName }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        @endif

        <div @class(['col-md-6', 'col-lg-3' => $withCategories, 'col-lg-4' => ! $withCategories])>
            <div class="row g-1">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100 px-2 d-flex justify-content-center">
                        <i class="uil uil-filter"></i>&nbsp;
                        <span>{{ __('Filter') }}</span>
                    </button>
                </div>

                <div class="col-6">
                    <button class="btn btn-success w-100 px-2 d-flex justify-content-center" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#advanced-filters-right" aria-controls="advanced-filters-right">
                        <i class="uil uil-cog"></i>&nbsp;
                        <span>{{ __('Advanced') }}</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
<!--end job-list-header-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="advanced-filters-right" aria-labelledby="advanced-filters-right-label">
    <div class="offcanvas-header">
        <h2 id="advanced-filters-right-label h5">{{ __('Advanced filters') }}</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include(Theme::getThemeNamespace('views.job-board.partials.filters'))
    </div>
</div>
