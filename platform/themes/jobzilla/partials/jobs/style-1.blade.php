<div class="job-card-modern">
    @if ($job->is_featured)
        <span class="job-featured-badge">★ {{ __('Featured') }}</span>
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
        
        @php
            // Location: always prefer showing City, State, Country
            $cityName = $job->city_name ?: optional($job->city)->name;
            $displayLocation = $job->location ?: 'India';
            if ($cityName && !\Illuminate\Support\Str::contains($displayLocation, $cityName)) {
                $displayLocation = $cityName . ', ' . $displayLocation;
            }

            // Institution type: show labels (not slugs)
            $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
            $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
            $institutionTypeGroups = file_exists($pluginGroupsPath)
                ? include $pluginGroupsPath
                : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
            $instLabelMap = [];
            foreach ($institutionTypeGroups as $g) {
                $instLabelMap = array_merge($instLabelMap, $g['options'] ?? []);
            }

            $institutionTypeRaw = $job->company->institution_type ?? 'School';
            $institutionTypeRaw = !empty($institutionTypeRaw) ? $institutionTypeRaw : 'School';

            // Check if job is from a consultancy
            $isConsultancy = false;
            if (is_string($institutionTypeRaw) && (strtolower($institutionTypeRaw) === 'consultancy' || strtolower($institutionTypeRaw) === 'consulting')) {
                $isConsultancy = true;
            }
            if (!$isConsultancy && $job->author && method_exists($job->author, 'registration_type')) {
                $authorRegistrationType = $job->author->registration_type ?? '';
                if (strtolower($authorRegistrationType) === 'consultancy') {
                    $isConsultancy = true;
                }
            }

            if ($isConsultancy) {
                $displayType = 'Consultancy';
            } else {
                $values = is_array($institutionTypeRaw) ? $institutionTypeRaw : (is_string($institutionTypeRaw) ? preg_split('/\s*,\s*/', $institutionTypeRaw, -1, PREG_SPLIT_NO_EMPTY) : [$institutionTypeRaw]);
                $values = array_values(array_filter(array_map(function ($v) {
                    $v = str_replace('_', '-', trim((string) $v));
                    return $v === 'icse-school' ? 'cicse-school' : $v;
                }, (array) $values)));
                $labels = array_values(array_filter(array_map(function ($v) use ($instLabelMap) {
                    if ($v === '') return null;
                    return $instLabelMap[$v] ?? ucfirst(str_replace('-', ' ', $v));
                }, $values)));
                $displayType = !empty($labels) ? implode(', ', $labels) : 'School';
            }
        @endphp
        
        <div class="jcm-institution-details" style="display: flex; align-items: center; gap: 8px; margin-top: 5px; font-size: 13px; color: #64748b; flex-wrap: wrap;">
            @if ($job->has_company)
                <span><a href="{{ $job->company_url }}" style="color: #64748b; text-decoration: none; font-weight: 400;">{{ $job->company_name }} {!! $job->company->badge !!}</a></span>
                <span style="color: #cbd5e1;">|</span>
            @endif
            <span>{{ $displayType }}</span>
            <span style="color: #cbd5e1;">|</span>
            <span><i class="feather-map-pin" style="font-size: 12px;"></i> {{ $displayLocation }}</span>
        </div>

        <div class="jcm-tags" style="margin-top: 8px;">
            @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
                @php
                    $jobType->background_color = $jobType->getMetaData('background_color', true);
                @endphp
                <span class="jcm-tag" @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}20; color: {{ $jobType->background_color }}; border-color: {{ $jobType->background_color }}40;" @endif>{{ $jobType->name }}</span>
            @endforeach
        </div>

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
            <span class="jcm-gender-preference" style="display: inline-block; margin-top: 5px; font-size: 13px; color: #64748b; padding: 4px 8px; border-radius: 4px; {{ $bgColor }}">
                @if ($genderIcon){{ $genderIcon }} @endif{{ $genderLabel }}
            </span>
        @endif

        <span class="jcm-time" style="display: block; margin-top: 8px; font-size: 12px; color: #94a3b8;">{{ $job->created_at->diffForHumans() }}</span>

        <span class="jcm-salary-mobile">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</span>
    </div>
    <div class="jcm-right">
        <div class="jcm-salary">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
        <a href="{{ $job->url }}" class="jcm-apply">{{ __('View Job') }} & {{ __('Apply') }}</a>
    </div>
</div>
