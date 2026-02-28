<div class="twm-jobs-featured-style1 m-b30">
    <div class="twm-media">
        <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
    </div>

    <div class="twm-jobs-category green">
        @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
            @php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            @endphp
            <span @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}" @else class="twm-bg-sky" @endif>{{ $jobType->name }}</span>
        @endforeach
    </div>
    <div class="twm-mid-content">
        <a href="{{ $job->url }}" class="twm-job-title" title="{{ $job->name }}">
            <h4 class="twm-job-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
                @php
                    $jobName = BaseHelper::clean($job->name);
                    $truncatedName = mb_strlen($jobName) > 20 ? mb_substr($jobName, 0, 20) . '...' : $jobName;
                @endphp
                {!! $truncatedName !!}
            </h4>
        </a>
    </div>
    <div class="twm-bot-content">
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
        <p class="twm-job-institution-type" style="font-size: 13px; color: #64748b; margin-bottom: 5px;">
            <i class="feather-briefcase" style="font-size: 12px;"></i> {{ $displayType }}
        </p>
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
            <p class="twm-job-gender-preference" style="font-size: 13px; color: #64748b; margin-bottom: 5px; padding: 4px 8px; border-radius: 4px; {{ $bgColor }}">
                @if ($genderIcon){{ $genderIcon }} @endif{{ $genderLabel }}
            </p>
        @endif
        <p class="twm-job-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
        <span class="twm-job-post-duration">{{ $job->created_at->diffForHumans() }}</span>
    </div>
</div>
