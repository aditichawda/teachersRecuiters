@php
    $companies->loadMissing(['country', 'state']);
@endphp

<div class="row">
    @forelse($companies as $company)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="company-card-grid">
                @if ($company->effective_is_featured)
                    <span class="ccg-featured">★ {{ __('Featured') }}</span>
                @endif
                @if ($company->is_verified)
                    <span class="ccg-verified"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
                @endif

                {{-- Top Section --}}
                <div class="ccg-top">
                    <div class="ccg-logo">
                        <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
                    </div>
                    <a href="{{ $company->url }}" class="ccg-name">
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
                        <span class="ccg-type">{{ implode(', ', $labels) }}</span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="ccg-body">
                    @if ($company->description)
                        <p class="ccg-desc">{{ Str::limit(strip_tags($company->description), 90) }}</p>
                    @endif

                    <div class="ccg-details">
                        @if ($company->address || $company->state_name)
                            <div class="ccg-detail">
                                <i class="feather-map-pin"></i>
                                <span>{{ Str::limit($company->address ?: ($company->state->name ?? '') . ', ' . ($company->country->code ?? ''), 30) }}</span>
                            </div>
                        @endif
                        @if ($company->year_founded)
                            <div class="ccg-detail">
                                <i class="feather-calendar"></i>
                                <span>{{ __('Est. :year', ['year' => $company->year_founded]) }}</span>
                            </div>
                        @endif
                        @if ($company->number_of_employees || $company->total_staff)
                            <div class="ccg-detail">
                                <i class="feather-users"></i>
                                <span>{{ $company->total_staff ?: $company->number_of_employees }} {{ __('Employees') }}</span>
                            </div>
                        @endif
                       
                    </div>
                </div>

                {{-- Footer --}}
                <div class="ccg-footer">
                    <span class="ccg-jobs-count">
                        {!! Theme::partial('job-count', compact('company')) !!}
                    </span>
                    <a href="{{ $company->url }}" class="ccg-view-btn">{{ __('View') }} →</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="no-schools-message" style="text-align: center; padding: 60px 20px; color: #64748b;">
                <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5; display: block;"></i>
                <h4 style="color: #334155; margin-bottom: 10px;">{{ __('No schools available currently') }}</h4>
                <p style="color: #94a3b8; font-size: 14px;">{{ __('Please try another category or check back later.') }}</p>
            </div>
        </div>
    @endforelse
</div>
