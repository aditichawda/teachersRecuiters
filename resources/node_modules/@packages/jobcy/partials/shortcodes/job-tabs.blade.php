<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title">{!! BaseHelper::clean($shortcode->title) !!}</h4>
                    <p class="text-muted mb-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <ul
                    class="job-list-menu nav nav-pills nav-justified flex-column flex-sm-row mb-4"
                    id="pills-tab"
                    role="tablist"
                >
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <button
                            class="nav-link active"
                            id="featured-jobs-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#featured-jobs"
                            type="button"
                            role="tab"
                            aria-controls="featured-jobs"
                            aria-selected="false"
                        >{{ __('Featured Jobs') }}</button>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <button
                            class="nav-link"
                            id="recent-jobs-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#recent-jobs"
                            data-tab-type="recent"
                            data-ajax-url="{{ route('public.ajax.job-tabs', ['type' => '__TYPE__']) }}"
                            type="button"
                            role="tab"
                            aria-controls="recent-jobs"
                            aria-selected="true"
                        >{{ __('Recent Jobs') }}</button>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation"
                    >
                        <button
                            class="nav-link"
                            id="popular-jobs-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#popular-jobs"
                            data-tab-type="popular"
                            data-ajax-url="{{ route('public.ajax.job-tabs', ['type' => '__TYPE__']) }}"
                            type="button"
                            role="tab"
                            aria-controls="popular-jobs"
                            aria-selected="false"
                        >{{ __('Popular Jobs') }}</button>
                    </li>
                </ul>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div
                    class="tab-content"
                    id="pills-tabContent"
                >
                    <div
                        class="tab-pane fade show active"
                        id="featured-jobs"
                        role="tabpanel"
                        aria-labelledby="featured-jobs-tab"
                        data-tab-type="featured"
                        data-ajax-url="{{ route('public.ajax.job-tabs', ['type' => '__TYPE__']) }}"
                        data-loaded="false"
                        data-jobs-url="{{ JobBoardHelper::getJobsPageURL() }}"
                        data-view-more-text="{{ __('View More') }}"
                        data-no-jobs-text="{{ __('No jobs found.') }}"
                        data-error-text="{{ __('Failed to load jobs.') }}"
                    >
                        <div class="skeleton-loading">
                            @for($i = 0; $i < 3; $i++)
                                <div class="job-box card mt-4">
                                    <div class="p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-image mx-auto" style="width: 55px; height: 55px; border-radius: 8px;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 20px; width: 80%;"></div>
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 16px; width: 70%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 90%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-badge" style="height: 24px; width: 80%; border-radius: 12px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-light">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 40%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="recent-jobs"
                        role="tabpanel"
                        aria-labelledby="recent-jobs-tab"
                        data-loaded="false"
                        data-jobs-url="{{ JobBoardHelper::getJobsPageURL() }}"
                        data-view-more-text="{{ __('View More') }}"
                        data-no-jobs-text="{{ __('No jobs found.') }}"
                        data-error-text="{{ __('Failed to load jobs.') }}"
                    >
                        <div class="skeleton-loading">
                            @for($i = 0; $i < 3; $i++)
                                <div class="job-box card mt-4">
                                    <div class="p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-image mx-auto" style="width: 55px; height: 55px; border-radius: 8px;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 20px; width: 80%;"></div>
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 16px; width: 70%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 90%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-badge" style="height: 24px; width: 80%; border-radius: 12px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-light">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 40%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div
                        class="tab-pane fade"
                        id="popular-jobs"
                        role="tabpanel"
                        aria-labelledby="freelancer-tab"
                        data-loaded="false"
                        data-jobs-url="{{ JobBoardHelper::getJobsPageURL() }}"
                        data-view-more-text="{{ __('View More') }}"
                        data-no-jobs-text="{{ __('No jobs found.') }}"
                        data-error-text="{{ __('Failed to load jobs.') }}"
                    >
                        <div class="skeleton-loading">
                            @for($i = 0; $i < 3; $i++)
                                <div class="job-box card mt-4">
                                    <div class="p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-image mx-auto" style="width: 55px; height: 55px; border-radius: 8px;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 20px; width: 80%;"></div>
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="skeleton skeleton-text mb-2" style="height: 16px; width: 70%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 90%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-badge" style="height: 24px; width: 80%; border-radius: 12px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 bg-light">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 40%;"></div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="skeleton skeleton-text" style="height: 16px; width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
