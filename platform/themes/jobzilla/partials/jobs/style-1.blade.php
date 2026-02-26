<div class="job-card-modern">
    @if ($job->is_featured)
        <span class="job-featured-badge">★ {{ __('Featured') }}</span>
    @endif
    @if ($job->gender_preference == 'female')
        <span class="job-female-preferred-badge">♀ {{ __('Female Preferred') }}</span>
    @endif
    <div class="jcm-location-logo">
        <div class="jcm-logo">
            <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
        </div>
    </div>
    <div class="jcm-info">
        <a href="{{ $job->url }}" class="jcm-title" title="{{ $job->name }}" style="display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
            @php
                $jobName = BaseHelper::clean($job->name);
                $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
            @endphp
            {!! $truncatedName !!}
        </a>
        <div class="jcm-meta">
            @if ($job->has_company)
                <a href="{{ $job->company_url }}">{{ $job->company_name }} {!! $job->company->badge !!}</a>
            @endif
        </div>

        @php
            $institutionType = $job->company->institution_type ?? 'School';
            $institutionType = !empty($institutionType) ? $institutionType : 'School';
            
            // Check if job is from a consultancy
            $isConsultancy = false;
            // Check company's institution_type
            if (strtolower($institutionType) === 'consultancy' || strtolower($institutionType) === 'consulting') {
                $isConsultancy = true;
            }
            // Also check author's registration_type as fallback
            if (!$isConsultancy && $job->author && method_exists($job->author, 'registration_type')) {
                $authorRegistrationType = $job->author->registration_type ?? '';
                if (strtolower($authorRegistrationType) === 'consultancy') {
                    $isConsultancy = true;
                }
            }
            
            $displayType = $isConsultancy ? 'Consultancy' : $institutionType;
        @endphp
        <span class="jcm-institution-type" style="display: inline-block; margin-top: 5px; font-size: 13px; color: #64748b;">
            <i class="feather-briefcase" style="font-size: 12px;"></i> {{ $displayType }}
        </span>

        @if (!empty($job->gender_preference))
            @php
                $genderLabel = ucfirst($job->gender_preference);
                if ($job->gender_preference == 'male') {
                    $genderIcon = '♂';
                    $genderLabel = __('Male Preferred');
                } elseif ($job->gender_preference == 'female') {
                    $genderIcon = '♀';
                    $genderLabel = __('Female Preferred');
                } else {
                    $genderIcon = '';
                }
            @endphp
            <span class="jcm-gender-preference" style="display: inline-block; margin-top: 5px; margin-left: 10px; font-size: 13px; color: #64748b;">
                @if ($genderIcon){{ $genderIcon }} @endif{{ $genderLabel }}
            </span>
        @endif

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
