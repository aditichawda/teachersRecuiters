<div class="job-card-modern">
    <div class="jcm-location-logo">
        <div class="jcm-logo">
            <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
        </div>
    </div>
    <div class="jcm-info">
        <a href="{{ $job->url }}" class="jcm-title" title="{{ $job->name }}">
            {!! BaseHelper::clean($job->name) !!}
        </a>
        <div class="jcm-meta">
            @if ($job->has_company)
                <a href="{{ $job->company_url }}">{{ $job->company_name }} {!! $job->company->badge !!}</a>
            @endif
        </div>

        <span class="jcm-location"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</span>
        <span class="jcm-salary-mobile">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
        <span class="jcm-time">{{ $job->created_at->diffForHumans() }}</span>
        <div class="jcm-tags">
            @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
                @php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                @endphp
                <span class="jcm-tag" @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}20; color: {{ $jobType->background_color }}; border-color: {{ $jobType->background_color }}40;" @endif>{{ $jobType->name }}</span>
            @endforeach
        </div>
        <a href="{{ $job->url }}" class="jcm-apply">{{ __('View Job') }} →</a>
    </div>
</div>
