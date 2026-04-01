@forelse($companies as $company)
    <div class="company-card-list">
        <div class="ccl-logo">
            <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
        </div>
        <div class="ccl-info">
            <div class="ccl-name-row">
                <a href="{{ $company->url }}" class="ccl-name">
                    {!! BaseHelper::clean($company->name) !!}
                </a>
                @if ($company->institution_type)
                    @php
                        $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
                        $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
                        $institutionTypeGroups = file_exists($pluginGroupsPath)
                            ? include $pluginGroupsPath
                            : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
                        $instLabelMap = [];
                        foreach ($institutionTypeGroups as $g) {
                            $instLabelMap = array_merge($instLabelMap, $g['options'] ?? []);
                        }
                        $raw = $company->institution_type;
                        $values = is_array($raw) ? $raw : (is_string($raw) ? preg_split('/\s*,\s*/', $raw, -1, PREG_SPLIT_NO_EMPTY) : [$raw]);
                        $values = array_values(array_filter(array_map(function ($v) {
                            $v = str_replace('_', '-', trim((string) $v));
                            return $v === 'icse-school' ? 'cicse-school' : $v;
                        }, (array) $values)));
                        $labels = array_values(array_filter(array_map(function ($v) use ($instLabelMap) {
                            if ($v === '') return null;
                            return $instLabelMap[$v] ?? ucfirst(str_replace('-', ' ', $v));
                        }, $values)));
                    @endphp
                    <span class="ccl-type">{{ implode(', ', $labels) }}</span>
                @endif
                @if ($company->is_verified)
                    <span class="ccl-verified"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
                @endif
                @if ($company->is_featured)
                    <span class="ccl-featured-inline">★ {{ __('Featured') }}</span>
                @endif
            </div>
            @if ($company->description)
                <p class="ccl-desc">{{ Str::limit(strip_tags($company->description), 100) }}</p>
            @endif
            <div class="ccl-meta">
                @if ($company->address)
                    <span class="ccl-meta-item">
                        <i class="feather-map-pin"></i> {{ Str::limit($company->address, 30) }}
                    </span>
                @endif
                @if ($company->year_founded)
                    <span class="ccl-meta-item">
                        <i class="feather-calendar"></i> {{ __('Est. :year', ['year' => $company->year_founded]) }}
                    </span>
                @endif
                @if ($company->number_of_employees || $company->total_staff)
                    <span class="ccl-meta-item">
                        <i class="feather-users"></i> {{ $company->total_staff ?: $company->number_of_employees }} {{ __('Staff') }}
                    </span>
                @endif
                @if ($company->phone)
                    <span class="ccl-meta-item">
                        <i class="feather-phone"></i> {{ $company->phone }}
                    </span>
                @endif
            </div>
        </div>
        <div class="ccl-right">
            <span class="ccl-jobs-count">
                {!! Theme::partial('job-count', compact('company')) !!}
            </span>
            <a href="{{ $company->url }}" class="ccl-view-btn">{{ __('View Details') }} →</a>
        </div>
    </div>
@empty
    <div class="no-schools-message" style="text-align: center; padding: 60px 20px; color: #64748b;">
        <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5; display: block;"></i>
        <h4 style="color: #334155; margin-bottom: 10px;">{{ __('No schools available currently') }}</h4>
        <p style="color: #94a3b8; font-size: 14px;">{{ __('Please try another category or check back later.') }}</p>
    </div>
@endforelse
