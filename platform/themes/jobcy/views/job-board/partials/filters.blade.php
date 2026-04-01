<div class="row"
    data-filter-url="{{ route('public.ajax.job-filters', request()->input()) }}"
    data-loading="true"
    id="job-filters-container">
    <div class="col-12">
        <div class="side-bar mt-5 mt-lg-0">
            <div class="accordion" id="accordion-sidebar-jobs">
                <div class="accordion-item">
                    <h3 class="accordion-header h2" id="offered_salary_accordion">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#offered_salary" aria-expanded="true" aria-controls="offered_salary">
                        {{ __('Offered Salary') }}
                    </button>
                    </h3>
                    <div id="offered_salary" class="accordion-collapse collapse show" aria-labelledby="offered_salary_accordion">
                        <div class="accordion-body px-0">
                            <div class="side-title">
                                <div class="mb-3">
                                    <div class="position-relative">
                                        <div class="row gx-2">
                                            <div class="col-5">
                                                <input class="form-control" type="number" name="offered_salary_from"
                                                    value="{{ BaseHelper::stringify(request()->input('offered_salary_from')) ?: '' }}" placeholder="{{ __('From...') }}"
                                                    form="jobs-filter-form">
                                            </div>
                                            <div class="col-5">
                                                <input class="form-control" type="number" name="offered_salary_to"
                                                    value="{{ BaseHelper::stringify(request()->input('offered_salary_to')) ?: '' }}" placeholder="{{ __('To...') }}"
                                                    form="jobs-filter-form">
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-primary w-100 submit-form-filter" form="jobs-filter-form" type="button">
                                                    <span class="mdi mdi-magnify"></span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item mt-4">
                    <h3 class="accordion-header h2" id="experienceOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#experience" aria-expanded="true" aria-controls="experience">
                            {{ __('Work experience') }}
                        </button>
                    </h3>
                    <div id="experience" class="accordion-collapse collapse show" aria-labelledby="experienceOne">
                        <div class="accordion-body">
                            <div class="side-title" id="job-experiences-list">
                                <div class="text-center py-3">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item mt-3">
                    <h3 class="accordion-header h2" id="jobType">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#jobtype" aria-expanded="false" aria-controls="jobType">
                            {{ __('Type of employment') }}
                        </button>
                    </h3>
                    <div id="jobtype" class="accordion-collapse collapse show" aria-labelledby="jobType">
                        <div class="accordion-body">
                            <div class="side-title" id="job-types-list">
                                <div class="text-center py-3">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion-item -->

                <div class="accordion-item mt-3">
                    <h3 class="accordion-header h2" id="datePosted">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dateposted" aria-expanded="false" aria-controls="datePosted">
                            {{ __('Date Posted') }}
                        </button>
                    </h3>
                    <div id="dateposted" class="accordion-collapse collapse show" aria-labelledby="datePosted">
                        <div class="accordion-body">
                            <div class="side-title form-check-all">
                                <div class="form-check">
                                    <input class="form-check-input submit-form-filter" type="radio" name="date_posted" id="date-posted-all" value="" form="jobs-filter-form" checked />
                                    <label class="form-check-label ms-2 text-muted" for="date-posted-all">
                                        {{ __('All') }}
                                    </label>
                                </div>
                                @foreach (JobBoardHelper::postedDateRanges() as $key => $item)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input submit-form-filter" type="radio" name="date_posted" value="{{ $key }}"
                                            id="date-posted-{{ $key }}" form="jobs-filter-form"
                                            @if ($key == request()->input('date_posted')) checked="checked" @endif >
                                        <label class="form-check-label ms-2 text-muted" for="date-posted-{{ $key }}">
                                            {{ $item['name'] }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item mt-3" id="job-skills-accordion" style="display: none;">
                    <h3 class="accordion-header h2" id="job-skills-label">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#job-skills" aria-expanded="false" aria-controls="job-skills">
                            <span>{{ __('Skills') }}</span>
                        </button>
                    </h3>
                    <div id="job-skills" class="accordion-collapse collapse show" aria-labelledby="job-skills-label">
                        <div class="accordion-body">
                            <div class="side-title" id="job-skills-list">
                                <div class="text-center py-3">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
