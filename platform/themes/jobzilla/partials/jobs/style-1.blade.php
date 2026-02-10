<div class="twm-jobs-list-style1 mb-5">
    <div class="twm-media">
        <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
    </div>
    <div class="twm-mid-content">
        <a href="{{ $job->url }}" class="twm-job-title" title="{{ $job->name }}">
            <h4 class="text-truncate">
                {!! BaseHelper::clean($job->name) !!}
                <span class="twm-job-post-duration">/ {{ $job->created_at->diffForHumans() }}</span>
            </h4>
        </a>
        <p class="twm-job-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
        @if ($job->has_company)
            <a href="{{ $job->company_url }}" class="twm-job-websites site-text-primary">{{ $job->company_name }} {!! $job->company->badge !!}</a>
        @endif
    </div>
    <div class="twm-right-content">
        <div class="twm-jobs-category">
            @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
                @php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                @endphp
                <span @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}" @else class="twm-bg-green" @endif>{{ $jobType->name }}</span>
            @endforeach
        </div>
        <div class="twm-jobs-amount">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
        <a href="{{ $job->url }}" class="twm-jobs-browse site-text-primary">{{ __('View Job') }}</a>
    </div>
</div>
