@php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable']);
@endphp

<div class="row">
    @foreach ($candidates as $candidate)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="cand-card-grid" style="height: 100%; display: flex; flex-direction: column; padding: 15px; border: 1px solid #e5e7eb; border-radius: 12px; background: #fff;">
                @if ($candidate->is_featured)
                    <span class="cg-featured" style="position: absolute; top: 10px; right: 10px; background: #fbbf24; color: #fff; padding: 3px 8px; border-radius: 20px; font-size: 9px; font-weight: 600;">{{ __('Featured') }}</span>
                @endif
                <div class="cg-avatar" style="text-align: center; margin-bottom: 12px;">
                    <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #e5e7eb;">
                </div>
                <a href="{{ $candidate->url }}" class="cg-name" style="font-size: 15px; font-weight: 600; color: #1f2937; text-decoration: none; display: block; text-align: center; margin-bottom: 10px;">{{ $candidate->name }}</a>
                
                <div class="cg-info-section" style="flex: 1; text-align: center;">
                    @if ($candidate->phone)
                        <p class="cg-phone mb-1" style="font-size: 11px; color: #6b7280;">
                            <i class="feather-phone" style="font-size: 10px;"></i> {{ $candidate->phone }}
                        </p>
                    @endif
                    
                    @if ($candidate->city_name || $candidate->state_name)
                        <p class="cg-location mb-1" style="font-size: 11px; color: #6b7280;">
                            <i class="feather-map-pin" style="font-size: 10px;"></i>
                            @if ($candidate->city_name){{ $candidate->city_name }}@endif
                            @if ($candidate->city_name && $candidate->state_name), @endif
                            @if ($candidate->state_name){{ $candidate->state_name }}@endif
                        </p>
                    @endif
                    
                    @if ($candidate->expected_salary)
                        <p class="cg-salary mb-1" style="font-size: 11px; color: #6b7280;">
                            <i class="feather-dollar-sign" style="font-size: 10px;"></i>
                            {{ number_format($candidate->expected_salary) }}
                            @if ($candidate->expected_salary_period)/ {{ ucfirst($candidate->expected_salary_period) }}@endif
                        </p>
                    @endif
                    
                    @if ($candidate->total_experience)
                        <p class="cg-experience mb-2" style="font-size: 11px; color: #6b7280;">
                            <i class="feather-briefcase" style="font-size: 10px;"></i> {{ $candidate->total_experience }}
                        </p>
                    @endif
                    
                    @if ($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0)
                        <div class="cg-skills mb-2" style="display: flex; flex-wrap: wrap; gap: 4px; justify-content: center;">
                            @foreach($candidate->favoriteSkills->take(2) as $skill)
                                <span class="badge bg-secondary" style="font-size: 9px; padding: 2px 6px;">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    @if ($candidate->description)
                        <p class="cg-desc" style="font-size: 11px; color: #6b7280; line-height: 1.4; margin-bottom: 0;">
                            {!! Str::limit(BaseHelper::clean($candidate->description), 60) !!}
                        </p>
                    @endif
                </div>
                
                @if (! JobBoardHelper::isDisabledPublicProfile() && $candidate->url)
                    <a href="{{ $candidate->url }}" class="cg-view-btn" style="margin-top: 12px; background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 12px; display: block; text-align: center;">{{ __('View Profile') }}</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
