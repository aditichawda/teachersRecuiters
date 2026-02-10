@php
    Theme::set('pageTitle', $candidate->name);
@endphp
<!-- START CANDIDATE-DETAILS -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card side-bar">
                    <div class="card-body p-4">
                        <div class="candidate-profile text-center">
                            <img
                                class="avatar-lg rounded-circle"
                                src="{{ $candidate->avatar_url }}"
                                alt="{{ $candidate->name }}"
                            >
                            <h6 class="fs-18 mb-0 mt-4">{{ $candidate->name }}</h6>

                            @if ($candidate->available_for_hiring)
                                <p class="mt-3 small fw-medium"><span style="width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-inline-end: 6px; background-color: rgb(22 163 74 / 1);"></span>{{ __("I'm available for hiring") }}</p>
                            @endif

                            <p class="text-muted mb-4">{!! BaseHelper::clean($candidate->description) !!}</p>
                        </div>
                    </div><!--end candidate-profile-->

                    <div class="candidate-profile-overview  card-body border-top p-4">
                        <h6 class="fs-17 fw-semibold mb-3">{{ __('Profile Overview') }}</h6>
                        <ul class="list-unstyled mb-0">
                            @if($candidate->languages->isNotEmpty())
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">{{ __('Languages') }}:</label>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($candidate->languages as $language)
                                                <span class="badge bg-soft-primary">{{ $language->language_name }} <span class="span text-dark">-</span> <span class="text-success">{{ $language->languageLevel?->name }}</span></span>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="d-flex">
                                    <label class="text-dark">{{ __('Views') }}:</label>
                                    <div>
                                        <p class="text-muted mb-0">{{ number_format($candidate->views) }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @if (JobBoardHelper::canViewCandidateInformation())
                            <div class="mt-3">
                                @if ($candidate->phone)
                                    <a
                                        class="btn btn-danger btn-hover w-100"
                                        href="tel:{{ $candidate->phone }}"
                                    >
                                        <i class="uil uil-phone"></i>&nbsp;
                                        <span>{{ __('Contact Me') }}</span>
                                    </a>
                                @endif
                                @if (!$candidate->hide_cv && $candidate->resume)
                                    <a
                                        class="btn btn-primary btn-hover w-100 mt-2"
                                        href="{{ $candidate->resumeDownloadUrl }}"
                                    >
                                        <i class="uil uil-import"></i>&nbsp;
                                        <span>{{ __('Download CV') }}</span>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div><!--candidate-profile-overview-->
                    @if (JobBoardHelper::canViewCandidateInformation())
                        <div class="candidate-contact-details card-body p-4 border-top">
                        <h6 class="fs-17 fw-semibold mb-3">{{ __('Contact Details') }}</h6>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <div class="d-flex align-items-center mt-4">
                                    <div class="icon bg-soft-primary flex-shrink-0">
                                        <i class="uil uil-envelope-alt"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fs-14 mb-1">{{ __('Email') }}</h6>
                                        <p class="text-muted mb-0">{{ $candidate->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center mt-4">
                                    <div class="icon bg-soft-primary flex-shrink-0">
                                        <i class="uil uil-map-marker"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="fs-14 mb-1">{{ __('Address') }}</h6>
                                        <p class="text-muted mb-0">{{ $candidate->address }}</p>
                                    </div>
                                </div>
                            </li>
                            @if ($candidate->phone)
                                <li>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="icon bg-soft-primary flex-shrink-0">
                                            <i class="uil uil-phone"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fs-14 mb-1">{{ __('Phone') }}</h6>
                                            <p class="text-muted mb-0">{{ $candidate->phone }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div><!--end candidate-overview-->
                    @endif
                </div><!--end card-->
            </div>

            <div class="col-lg-8">
                <div class="card candidate-details ms-lg-4 mt-4 mt-lg-0">
                    <div class="card-body p-4 candidate-personal-detail">
                        <div>
                            <h6 class="fs-17 fw-semibold mb-3">{{ __('About Me') }}</h6>

                            <div class="ck-content">
                                {!! BaseHelper::clean($candidate->bio) !!}
                            </div>

                            @if ($countEducation = $educations->count())
                                <div class="candidate-education-details mt-4 pt-3">
                                    <h4 class="fs-17 fw-bold mb-0">{{ __('Education') }}</h4>
                                    @foreach ($educations as $education)
                                        <div class="candidate-education-content mt-4 d-flex">
                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                {{ $education->specialized ? strtoupper(substr($education->specialized, 0, 1)) : 'E' }}
                                            </div>
                                            <div class="ms-4">
                                                @if ($education->specialized)
                                                    <h6 class="fs-16 mb-1">{{ $education->specialized }}</h6>
                                                @endif
                                                <p class="mb-2 text-muted">{{ $education->school }} -
                                                    ({{ $education->started_at->format('Y') }} -
                                                    {{ $education->ended_at ? $education->ended_at->format('Y') : __('Now') }})
                                                </p>
                                                <p class="text-muted">{!! BaseHelper::clean($education->description) !!}</p>
                                            </div>
                                            @if ($countEducation > 1 && !$loop->last)
                                                <span class="line"></span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if ($countExperience = $experiences->count())
                                <div class="candidate-education-details mt-4 pt-3">
                                    <h4 class="fs-17 fw-bold mb-0">{{ __('Experience') }}</h4>
                                    @foreach ($experiences as $experience)
                                        <div class="candidate-education-content mt-4 d-flex">
                                            <div class="circle flex-shrink-0 bg-soft-primary">
                                                {{ $experience->position ? strtoupper(substr($experience->position, 0, 1)) : '' }}
                                            </div>
                                            <div class="ms-4">
                                                @if ($experience->position)
                                                    <h6 class="fs-16 mb-1">{{ $experience->position }}</h6>
                                                @endif
                                                <p class="mb-2 text-muted">{{ $experience->company }} -
                                                    ({{ $experience->started_at->format('Y') }} -
                                                    {{ $experience->ended_at ? $experience->ended_at->format('Y') : __('Now') }})
                                                </p>
                                                <p class="text-muted">{!! BaseHelper::clean($experience->description) !!}</p>
                                            </div>
                                            @if ($countExperience > 1 && !$loop->last)
                                                <span class="line"></span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
        </div>
    </div>
</section>
<!-- END CANDIDATE-DETAILS -->
