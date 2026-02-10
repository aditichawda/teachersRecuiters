<div class="job-grid-modern">
    <div class="jgm-top">
        <div class="jgm-logo">
            <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
        </div>
        <span class="jgm-time">{{ $job->created_at->diffForHumans() }}</span>
    </div>
    <div class="jgm-tags">
        @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
            @php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            @endphp
            <span class="jgm-tag" @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}20; color: {{ $jobType->background_color }}; border-color: {{ $jobType->background_color }}40;" @endif>{{ $jobType->name }}</span>
        @endforeach
    </div>
    <a href="{{ $job->url }}" class="jgm-title" title="{{ $job->name }}">
        {!! BaseHelper::clean($job->name) !!}
    </a>
    <p class="jgm-location"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
    @if ($job->has_company)
        <a href="{{ $job->company_url }}" class="jgm-company">{{ $job->company_name }} {!! $job->company->badge !!}</a>
    @endif
    <div class="jgm-bottom">
        <div class="jgm-salary">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
        <a href="{{ $job->url }}" class="jgm-view">{{ __('View') }} →</a>
    </div>
</div>
