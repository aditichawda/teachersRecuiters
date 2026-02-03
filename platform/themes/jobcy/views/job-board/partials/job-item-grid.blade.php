<div class="job-box @if ($job->is_saved) bookmark-post @endif card mt-4"
    data-latitude="{{ $job->latitude }}"
    data-longitude="{{ $job->longitude }}"
    data-company_logo_thumb="{{ $job->company->logo_thumb }}"
    data-company_name="{{ $job->company_name ?: $job->name }}"
    data-map_icon="{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}"
    data-job_name="{{ $job->name }}"
    data-company_url="{{ $job->company_url }}"
    data-job_types="{{ json_encode($job->jobTypes->toArray()) }}"
    data-number_of_positions="{{ $job->number_of_positions }}"
    data-full_address="{{ $job->full_address }}">
    <div class="p-2">
        <div class="row g-2">
            <div class="col-sm-2">
                <a href="{{ $job->company_url ?: 'javascript:void(0);' }}">
                    <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->company_name ?: $job->name }}"
                        width="55" class="img-fluid rounded-3">
                </a>
            </div>
            <div class="col-sm-10">
                <div class="mt-3 mt-sm-0">
                    <h3 class="fs-17 mb-1 h5">
                        <a href="{{ $job->url }}" class="text-dark">{{ $job->name }}</a>
                    </h3>
                    <ul class="list-inline mb-0 mt-2">
                        @if ($job->has_company)
                            <li class="list-inline-item">
                                <p class="text-muted fs-14 mb-0">{{ $job->company->name }} {!! $job->company->badge !!}</p>
                            </li>
                        @endif

                        @if ($job->location)
                            <li class="list-inline-item">
                                <p class="text-muted fs-14 mb-0">
                                    <i class="mdi mdi-map-marker"></i>
                                    <span>{{ $job->location }}</span>
                                </p>
                            </li>
                        @endif
                        <li class="list-inline-item">
                            <p class="text-muted fs-14 mb-0">
                                <i class="uil uil-wallet"></i>
                                <span>{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</span>
                            </p>
                        </li>
                    </ul>
                    <div class="mt-2">
                        <div class="row">

                            @if ($job->jobTypes->isNotEmpty())
                                <div class="col-6">
                                    @foreach($job->jobTypes as $jobType)
                                        <span class="badge bg-soft-danger mt-1">{{ $jobType->name }}@if (!$loop->last), @endif</span>
                                    @endforeach
                                </div>
                            @endif

                            @if ($job->canShowSavedJob())
                                <div class="col-6 text-md-end">
                                    <div class="favorite-icon pe-2 position-static">
                                        <a class="job-bookmark-action" href="{{ route('public.account.jobs.saved.action') }}" title="{{ __('Save Job') }}" data-job-id="{{ $job->id }}">
                                            <i class="uil uil-heart-alt fs-18"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($job->applicants_count)
                        <div class="job-applied-count position-static"><i class="mdi mdi-fire text-danger"></i> <small class="fw-medium">{{ __(':count application(s)', ['count' => $job->applicants_count]) }}</small></div>
                    @endif
                </div>
            </div>
        </div>
        @if ($job->is_featured)
            <div class="featured-label">
                <span class="featured">{{ __('featured') }}</span>
            </div>
        @endif
    </div>
    <div class="p-3 bg-light">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <div>
                    <p class="text-muted mb-0">
                        <small>
                            <span class="text-dark">{{ __('Published') }}: </span>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </small>
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                @if ($job->canShowApplyJob())
                    <div class="text-md-end">
                        <small>
                            @if ($job->is_applied)
                                <a href="{{ $job->url }}" class="primary-link text-success">
                                    <span>{{ __('Applied') }}</span>
                                    <i class="uil uil-check-circle"></i>
                                </a>
                            @elseif (!auth('account')->check() && !JobBoardHelper::isGuestApplyEnabled())
                                <a href="{{ route('public.account.login') }}"
                                   class="primary-link">
                                    <span>{{ __('Apply Now') }}</span>
                                    <i class="mdi mdi-chevron-double-right"></i>
                                </a>
                            @else
                                @if ($job->apply_url)
                                    @if ($job->shouldOpenExternalApplyUrlDirectly())
                                        <a href="{{ $job->apply_url }}" target="{{ $job->getExternalApplyUrlTarget() }}" class="primary-link">
                                            <span>{{ __('Apply Now') }}</span>
                                            <i class="mdi mdi-chevron-double-right"></i>
                                        </a>
                                    @else
                                        <a href="#applyExternalJob" data-bs-toggle="modal" class="primary-link" data-job-name="{{ $job->name }}" data-job-id="{{ $job->id }}">
                                            <span>{{ __('Apply Now') }}</span>
                                            <i class="mdi mdi-chevron-double-right"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="#applyNow" data-bs-toggle="modal" class="primary-link" data-job-name="{{ $job->name }}" data-job-id="{{ $job->id }}">
                                        <span>{{ __('Apply Now') }}</span>
                                        <i class="mdi mdi-chevron-double-right"></i>
                                    </a>
                                @endif
                            @endif
                        </small>
                    </div>
                @endif
            </div>

        </div>

    </div>
</div>
<!--end job-box-->
