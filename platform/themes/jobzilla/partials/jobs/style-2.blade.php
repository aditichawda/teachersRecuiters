<div class="job-grid-modern">
    @if ($job->is_featured)
        <span class="job-featured-badge">★ {{ __('Featured') }}</span>
    @endif
    <div class="jgm-top">
        <div class="jgm-time-location-logo" style="display:block;">
        <div class="jgm-logo">
            <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
        </div>
        <p class="jgm-location"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
        </div>
        <div class="jgm-time-location" style="display:block;">
        <span class="jgm-time">{{ $job->created_at->diffForHumans() }}</span>
        <div class="jgm-tags">
        @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
            @php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            @endphp
            <span class="jgm-tag" @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}20; color: {{ $jobType->background_color }}; border-color: {{ $jobType->background_color }}40;" @endif>{{ $jobType->name }}</span>
        @endforeach
    </div>
            
        </div>
    </div>
    
    <a href="{{ $job->url }}" class="jgm-title" title="{{ $job->name }}" style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
        @php
            $jobName = BaseHelper::clean($job->name);
            $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
        @endphp
        {!! $truncatedName !!}
    </a>
    
    @if ($job->has_company)
        <a href="{{ $job->company_url }}" class="jgm-company">{{ $job->company_name }} {!! $job->company->badge !!}</a>
    @endif
    @php
        $institutionType = $job->company->institution_type ?? 'School';
        $institutionType = !empty($institutionType) ? $institutionType : 'School';
        // If company is a consultancy, show "Consultancy" instead of institution_type
        if (strtolower($institutionType) === 'consultancy' || strtolower($institutionType) === 'consulting') {
            $displayType = 'Consultancy';
        } else {
            $displayType = $institutionType;
        }
    @endphp
    <span class="jgm-institution-type" style="display: block; margin-top: 5px; font-size: 13px; color: #64748b;">
        <i class="feather-briefcase" style="font-size: 12px;"></i> {{ $displayType }}
    </span>
    <div class="jgm-salary" style="display: block; margin-top: 5px; margin-bottom: 5px; font-size: 15px; font-weight: 700; color: #0073d1;">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
    @if (!empty($job->gender_preference))
        @php
            $genderLabel = ucfirst($job->gender_preference);
            $bgColor = '';
            if ($job->gender_preference == 'male') {
                $genderIcon = '♂';
                $genderLabel = __('Male Preferred');
                $bgColor = 'background-color: #e0f2fe;';
            } elseif ($job->gender_preference == 'female') {
                $genderIcon = '♀';
                $genderLabel = __('Female Preferred');
                $bgColor = 'background-color: #fce7f3;';
            } else {
                $genderIcon = '';
            }
        @endphp
        <span class="jgm-gender-preference" style="display: block; margin-top: 5px; font-size: 13px; color: #64748b; padding: 4px 8px; border-radius: 4px; {{ $bgColor }}">
            @if ($genderIcon){{ $genderIcon }} @endif{{ $genderLabel }}
        </span>
    @endif
    <div class="jgm-bottom">
        <a href="{{ $job->url }}" class="jgm-view">{{ __('View') }} →</a>
    </div>
</div>
