<div class="row">
    <!-- START SIDE-BAR -->
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
                                                    value="{{ (int) request()->input('offered_salary_from') ?: '' }}" placeholder="{{ __('From...') }}"
                                                    form="jobs-filter-form">
                                            </div>
                                            <div class="col-5">
                                                <input class="form-control" type="number" name="offered_salary_to"
                                                    value="{{ (int) request()->input('offered_salary_to') ?: '' }}" placeholder="{{ __('To...') }}"
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
                </div><!-- end accordion-item -->

                <div class="accordion-item mt-4">
                    <h3 class="accordion-header h2" id="experienceOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#experience" aria-expanded="true" aria-controls="experience">
                            {{ __('Work experience') }}
                        </button>
                    </h3>
                    <div id="experience" class="accordion-collapse collapse show" aria-labelledby="experienceOne">
                        <div class="accordion-body">
                            <div class="side-title">
                                @foreach($jobExperiences as $jobExperience)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input submit-form-filter" type="checkbox"
                                            name="job_experiences[]" value="{{ $jobExperience->id }}"
                                            id="check-job-experience-{{ $jobExperience->id }}" form="jobs-filter-form"
                                            @if (in_array($jobExperience->id, (array) request()->input('job_experiences', []))) checked="checked" @endif >
                                        <label class="form-check-label ms-2 text-muted" for="check-job-experience-{{ $jobExperience->id }}">{{ $jobExperience->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- end accordion-item -->

                <div class="accordion-item mt-3">
                    <h3 class="accordion-header h2" id="jobType">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#jobtype" aria-expanded="false" aria-controls="jobType">
                            {{ __('Type of employment') }}
                        </button>
                    </h3>
                    <div id="jobtype" class="accordion-collapse collapse show" aria-labelledby="jobType">
                        <div class="accordion-body">
                            <div class="side-title">
                                <div class="form-check">
                                    <input class="form-check-input submit-form-filter" type="radio" name="job_type" id="job_type-all" value="" form="jobs-filter-form" checked />
                                    <label class="form-check-label ms-2 text-muted" for="job_type-all">
                                        {{ __('All') }}
                                    </label>
                                </div>
                                @foreach($jobTypes as $jobType)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input submit-form-filter" value="{{ $jobType->id }}"
                                            type="radio" name="job_type" id="check-job-type-{{ $jobType->id }}" form="jobs-filter-form"
                                            @if ($jobType->id == request()->input('job_type')) checked="checked" @endif>
                                        <label class="form-check-label ms-2 text-muted" for="check-job-type-{{ $jobType->id }}">
                                            {{ $jobType->name }}
                                        </label>
                                    </div>
                                @endforeach
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
                </div><!-- end accordion-item -->
                @if ($jobSkills->count())
                    <div class="accordion-item mt-3">
                        <h3 class="accordion-header h2" id="job-skills-label">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#job-skills" aria-expanded="false" aria-controls="job-skills">
                                <span>{{ __('Skills') }}</span>
                            </button>
                        </h3>
                        <div id="job-skills" class="accordion-collapse collapse show" aria-labelledby="job-skills-label">
                            <div class="accordion-body">
                                <div class="side-title">
                                    @foreach ($jobSkills as $skill)
                                        <span>
                                            <input type="checkbox" class="btn-check submit-form-filter" name="job_skills[]"
                                                id="btn-check-outlined-{{ $skill->id }}" autocomplete="off"
                                                form="jobs-filter-form" value="{{ $skill->id }}"
                                                @if (in_array($skill->id, (array) request()->input('job_skills', []))) checked="checked" @endif>
                                            <label class="badge tag-cloud fs-13 mt-2 btn btn-outline-primary" for="btn-check-outlined-{{ $skill->id }}">{{ $skill->name }}</label>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><!-- end accordion-item -->
                @endif
            </div><!--end accordion-->
        </div><!--end side-bar-->
    </div><!--end col-->
    <!-- END SIDE-BAR -->
</div>
