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
            $cityName = $job->city_name ?: optional($job->city)->name;
            $displayLocation = $job->location ?: 'India';
            if ($cityName && !\Illuminate\Support\Str::contains($displayLocation, $cityName)) {
                $displayLocation = $cityName . ', ' . $displayLocation;
            }

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
            // Also check author's registration_type as fallback
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
        <p class="twm-job-address"><i class="feather-map-pin"></i> {{ $displayLocation }}</p>
        <span class="twm-job-post-duration">{{ $job->created_at->diffForHumans() }}</span>
    </div>
</div>
