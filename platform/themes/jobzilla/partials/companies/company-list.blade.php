@forelse($companies as $company)
    <div class="company-card-list">
        @if ($company->is_featured)
            <span class="ccl-featured">★ {{ __('Featured') }}</span>
        @endif

        <div class="ccl-logo">
            <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
        </div>
        <div class="ccl-info">
            <div class="ccl-name-row">
                <a href="{{ $company->url }}" class="ccl-name">
                    {!! BaseHelper::clean($company->name) !!}
                </a>
                @if ($company->institution_type)
                    <span class="ccl-type">{{ $company->institution_type }}</span>
                @endif
                @if ($company->is_verified)
                    <span class="ccl-verified"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
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
    <div style="text-align:center; padding:50px; color:#94a3b8;">
        <i class="feather-briefcase" style="font-size:44px; margin-bottom:14px; display:block;"></i>
        <p style="font-size:16px; font-weight:600;">{{ __('No companies found') }}</p>
        <p style="font-size:14px;">{{ __('Try adjusting your search filters') }}</p>
    </div>
@endforelse
