@php
    Theme::set('pageTitle', __('Position Closed: :name', ['name' => $job->name]));
    Theme::set('withPageHeader', false)
@endphp

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <div class="bg-soft-danger rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="mdi mdi-close-circle-outline text-danger" style="font-size: 48px;"></i>
                            </div>
                        </div>

                        <h2 class="mb-3">{{ __('This Position is Closed') }}</h2>
                        <h4 class="text-muted mb-4">{{ $job->name }}</h4>

                        <p class="text-muted mb-4 fs-5">
                            {{ __('Sorry, this position is no longer available. The job posting has expired and we are not accepting new applications at this time.') }}
                        </p>

                        <div class="alert alert-soft-info border-0 rounded-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="mdi mdi-information-outline fs-4"></i>
                                </div>
                                <div class="text-start">
                                    <p class="mb-0">
                                        {{ __('Looking for other opportunities? Check out our current job openings to find your next career opportunity.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ $jobsUrl }}" class="btn btn-primary btn-hover">
                                <i class="mdi mdi-briefcase-search-outline me-2"></i>
                                {{ __('Browse Available Jobs') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
