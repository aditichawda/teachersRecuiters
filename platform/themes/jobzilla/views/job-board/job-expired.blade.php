@php
    Theme::set('pageTitle', __('Position Closed: :name', ['name' => $job->name]));
@endphp

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center">
                    <div class="card-body p-5">
                        <div class="mb-4">
                            <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="fas fa-times-circle text-danger" style="font-size: 48px;"></i>
                            </div>
                        </div>

                        <h2 class="mb-3">{{ __('This Position is Closed') }}</h2>
                        <h4 class="text-muted mb-4">{{ $job->name }}</h4>

                        <p class="text-muted mb-4">
                            {{ __('Sorry, this position is no longer available. The job posting has expired and we are not accepting new applications at this time.') }}
                        </p>

                        <div class="alert alert-info">
                            <p class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ __('Looking for other opportunities? Check out our current job openings to find your next career opportunity.') }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ $jobsUrl }}" class="btn btn-primary">
                                <i class="fas fa-briefcase me-2"></i>
                                {{ __('Browse Available Jobs') }}
                            </a>
                        </div>
                    </div>
                </div>

                @if($job->company && !$job->hide_company)
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ __('About the Company') }}</h5>
                        <div class="d-flex align-items-center">
                            @if($job->company->logo)
                            <img src="{{ $job->company->logo_thumb }}" alt="{{ $job->company->name }}" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: contain;">
                            @endif
                            <div>
                                <h6 class="mb-1">
                                    <a href="{{ $job->company->url }}" class="text-decoration-none">{{ $job->company->name }}</a>
                                </h6>
                                @if($job->company->description)
                                <p class="text-muted mb-2 small">{{ Str::limit($job->company->description, 100) }}</p>
                                @endif
                                <a href="{{ $job->company->url }}" class="btn btn-link p-0">
                                    {{ __('View Company Profile') }} <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-4 text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('public.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-home me-1"></i> {{ __('Home') }}
                        </a>
                        <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-briefcase me-1"></i> {{ __('All Jobs') }}
                        </a>
                        <a href="{{ JobBoardHelper::getJobCompaniesPageURL() }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-building me-1"></i> {{ __('Companies') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>