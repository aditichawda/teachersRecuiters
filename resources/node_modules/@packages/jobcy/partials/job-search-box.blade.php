@if (is_plugin_active('job-board'))
    @php
        $withCategories = ! empty($withCategories);
        $colClass = $withCategories ? 'col-lg-3' : 'col-lg-4';
    @endphp
    {!! Form::open(['url' => $formUrl ?? JobBoardHelper::getJobsPageURL(), 'method' => 'GET']) !!}
        <div class="registration-form">
            <div class="row g-0">
                <div class="{{ $colClass }}">
                    <div class="filter-search-form filter-border mt-3 mt-lg-0">
                        <i class="uil uil-briefcase-alt"></i>
                        <input type="search" name="keyword" id="job-title"
                                    class="form-control filter-input-box" placeholder="{{ __('Job, Company name...') }}">
                    </div>
                </div>
                @if (is_plugin_active('location'))
                    <div class="{{ $colClass }}">
                        <div class="filter-search-form mt-3 mt-md-0">
                            <i class="uil uil-map-marker"></i>
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
                            </select>
                        </div>
                    </div>
                @endif
                @if ($withCategories)
                    <div class="{{ $colClass }}">
                        <div class="filter-search-form mt-3 mt-lg-0">
                            <i class="uil uil-clipboard-notes"></i>
                            <select class="form-select" data-trigger name="job_categories[]"
                                id="choices-single-categories" aria-label="{{ __('Select Category') }}">
                                <option value="">{{ __('All category') }}</option>
                                @foreach (Botble\JobBoard\Models\Category::query()->wherePublished()->orderBy('order')->orderByDesc('created_at')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="{{ $colClass }}">
                    <div class="mt-3 mt-lg-0 h-100">
                        <button class="btn btn-primary submit-btn w-100 h-100" type="submit">
                            <i class="uil uil-search me-1"></i>
                            <span>{{ __('Find Job') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endif
