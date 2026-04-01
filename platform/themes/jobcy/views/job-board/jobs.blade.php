@php
    Theme::set('pageTitle', $pageTitle ?? __('Jobs'));
    Theme::asset()
        ->usePath()
        ->add('leaflet-css', 'libs/leaflet/leaflet.css');
    Theme::asset()
        ->container('footer')
        ->usePath()
        ->add('leaflet-js', 'libs/leaflet/leaflet.js');
    Theme::asset()
        ->container('footer')
        ->usePath()
        ->add('markercluster-src-js', 'libs/leaflet/leaflet.markercluster-src.js');

    $jobLayout = request()->input('layout', 'list');
@endphp

<section class="section">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="jobs-listing-container">
                    @include(Theme::getThemeNamespace('views.job-board.partials.job-list-header'))

                    @include(Theme::getThemeNamespace('views.job-board.partials.widget-popular'))

                    <!-- Job-list -->
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-8">
                                    <div class="showing-of-results">
                                        @if ($jobs->total())
                                            {{ __('Showing :from – :to of :total results', [
                                                'from' => number_format($jobs->firstItem()),
                                                'to' => number_format($jobs->lastItem()),
                                                'total' => number_format($jobs->total()),
                                            ]) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="d-flex justify-content-end">
                                        <div class="toggle-views">
                                            <input
                                                class="btn-check submit-form-filter"
                                                id="btn-check-outlined-list"
                                                name="layout"
                                                form="jobs-filter-form"
                                                type="radio"
                                                value="list"
                                                autocomplete="off"
                                                @if ($jobLayout != 'grid') checked="checked" @endif
                                            >
                                            <label
                                                class="btn btn-outline-primary px-2 py-1 me-1"
                                                for="btn-check-outlined-list"
                                            >
                                                <i class="uil uil-list-ul"></i>
                                            </label>
                                            <input
                                                class="btn-check submit-form-filter"
                                                id="btn-check-outlined-grid"
                                                name="layout"
                                                form="jobs-filter-form"
                                                type="radio"
                                                value="grid"
                                                autocomplete="off"
                                                @if ($jobLayout == 'grid') checked="checked" @endif
                                            >
                                            <label
                                                class="btn btn-outline-primary px-2 py-1"
                                                for="btn-check-outlined-grid"
                                            >
                                                <i class="uil uil-grid"></i>
                                            </label>
                                            <br>
                                        </div>
                                        @if (theme_option('show_map_on_jobs_page', 'yes') == 'yes')
                                            <div class="map-views ms-1 d-none d-lg-block">
                                                <button
                                                    class="btn btn-outline-info px-2 py-1 btn-toggle-map @if (Arr::get($_COOKIE, 'show_map_on_jobs_page', 1)) active @endif"
                                                    type="button"
                                                >
                                                    <i class="uil uil-map"></i>
                                                </button>
                                            </div>
                                            <div class="map-views ms-1 d-lg-none">
                                                <button
                                                    class="btn btn-outline-info px-2 py-1"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvas-jobs-map"
                                                    type="button"
                                                    aria-controls="offcanvas-jobs-map"
                                                >
                                                    <i class="uil uil-map"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="jobs-listing">
                                @include(Theme::getThemeNamespace('views.job-board.partials.job-items'), [
                                    'jobs' => $jobs,
                                    'jobLayout' => $jobLayout,
                                ])
                            </div>
                        </div>
                        @if (theme_option('show_map_on_jobs_page', 'yes') == 'yes')
                            @php
                                $latLng = json_encode(JobBoardHelper::getMapCenterLatLng());
                            @endphp

                            <div
                                class="col-lg-5 jobs-list-sidebar d-none d-lg-block @if (!Arr::get($_COOKIE, 'show_map_on_jobs_page', 1)) d-lg-none @endif"
                            >
                                <div class="right-map h-100">
                                    <div class="position-sticky sticky-top">
                                        <div
                                            class="w-100 bg-light"
                                            style="height: 100vh"
                                        >
                                            <div
                                                class="jobs-list-map h-100"
                                                data-tile-layer="{{ JobBoardHelper::getMapTileLayer() }}"
                                                data-center="{{ $latLng }}"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if (theme_option('show_map_on_jobs_page', 'yes') == 'yes')
                        <div
                            class="offcanvas offcanvas-end"
                            id="offcanvas-jobs-map"
                            aria-labelledby="offcanvas-jobs-map-label"
                            tabindex="-1"
                        >
                            <div class="offcanvas-header">
                                <h5 id="offcanvas-jobs-map-label">{{ __('Jobs map') }}</h5>
                                <button
                                    class="btn-close text-reset"
                                    data-bs-dismiss="offcanvas"
                                    type="button"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="offcanvas-body">
                                <div
                                    class="jobs-list-map h-100"
                                    data-tile-layer="{{ JobBoardHelper::getMapTileLayer() }}"
                                    data-center="{{ $latLng }}"
                                ></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@if (theme_option('show_map_on_jobs_page', 'yes') == 'yes')
    <script id="traffic-popup-map-template" type="text/x-jquery-tmpl">
        @include(Theme::getThemeNamespace('views.job-board.partials.map'))
    </script>
@endif

