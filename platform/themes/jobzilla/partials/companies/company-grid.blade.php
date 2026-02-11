@php($companies->loadMissing(['country', 'state']))

<div class="row">
    @forelse($companies as $company)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="company-card-grid">
                @if ($company->is_featured)
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
                        <span class="ccg-type">{{ $company->institution_type }}</span>
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
                        @if ($company->phone)
                            <div class="ccg-detail">
                                <i class="feather-phone"></i>
                                <span>{{ $company->phone }}</span>
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
            <div style="text-align:center; padding:50px; color:#94a3b8;">
                <i class="feather-briefcase" style="font-size:44px; margin-bottom:14px; display:block;"></i>
                <p style="font-size:16px; font-weight:600;">{{ __('No companies found') }}</p>
                <p style="font-size:14px;">{{ __('Try adjusting your search filters') }}</p>
            </div>
        </div>
    @endforelse
</div>
