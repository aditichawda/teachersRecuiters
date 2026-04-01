<div class="job-list-header">
    {!! Form::open(['url' => JobBoardHelper::getJobsPageURL(), 'method' => 'GET', 'id' => 'jobs-filter-form', 'data-ajax-url' => route('public.ajax.jobs')]) !!}
    <div class="row g-2">
        <div class="col-lg-3 col-md-6">
            <div class="filler-job-form">
                <i class="uil uil-briefcase-alt"></i>
                <input type="search" name="keyword" value="{{ request()->input('keyword') }}"
                    class="form-control filter-job-input-box" placeholder="{{ __('Job, company...') }}">
            </div>
        </div>
        <!--end col-->
        @if (is_plugin_active('location'))
            <div class="col-lg-3 col-md-6">
                <div class="filler-job-form">
                    <i class="uil uil-location-point"></i>
                    <select class="form-select" data-trigger name="city_id" id="choices-single-location"
                        aria-label="Default select example" data-no-results-text="{{ __('No results found.') }}"
                        data-loading-text="{{ __('Loading...') }}"
                        data-no-choices-text="{{ __('No choices to choose from') }}"
                        data-search-placeholder-value="{{ __('Enter keyword to search') }}"
                        data-placeholder-value="{{ __('Select City') }}">
                        <option value="">{{ __('Select City') }}</option>
                        @if ($cityId = (int) request()->input('city_id'))
                            @if ($cityName = Location::getCityNameById($cityId))
                                <option value="{{ $cityId }}" selected>{{ $cityName }}</option>
                            @endif
                        @endif
                    </select>
                </div>
            </div>
            <!--end col-->
        @endif
        <div class="col-lg-3 col-md-6">
            <div class="filler-job-form">
                <i class="uil uil-clipboard-notes"></i>
                <select class="form-select" data-trigger name="job_categories[]" id="choices-single-categories"
                    aria-label="Default select example">
                    <option value="">{{ __('All') }}</option>
                    @foreach ($jobCategories as $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, (array)
                            request()->input('job_categories', []))) selected="selected" @endif>{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-3 col-md-6">
            <div class="row g-1">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100 px-2 d-flex justify-content-center">
                        <i class="uil uil-filter"></i>
                        <span>{{ __('Filter') }}</span>
                    </button>
                </div>
                <!--end col-->
                <div class="col-6">
                    <button class="btn btn-success w-100 px-2 d-flex justify-content-center" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#advanced-filters-right" aria-controls="advanced-filters-right">
                        <i class="uil uil-cog"></i>
                        <span>{{ __('Advanced') }}</span>
                    </button>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!--end row-->
    {!! Form::close() !!}
</div>
<!--end job-list-header-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="advanced-filters-right" aria-labelledby="advanced-filters-right-label">
    <div class="offcanvas-header">
        <h2 id="advanced-filters-right-label h5">{{ __('Advanced filters') }}</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include(Theme::getThemeNamespace('views.job-board.partials.advanced-filters'))
    </div>
</div>
