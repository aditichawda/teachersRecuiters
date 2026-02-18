@php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable']);
@endphp

<div class="row">
    @foreach ($candidates as $candidate)
        <div class="col-md-6 mb-4">
            <div class="cand-card-list" style="display: flex; align-items: flex-start; gap: 15px; padding: 18px; border: 1px solid #e5e7eb; border-radius: 12px; background: #fff; height: 100%;">
                @if ($candidate->is_featured)
                    <span class="cl-featured" style="position: absolute; top: 12px; right: 12px; background: #fbbf24; color: #fff; padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 600;">{{ __('Featured') }}</span>
                @endif
                <div class="cl-avatar" style="flex-shrink: 0;">
                    <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}" style="width: 90px; height: 90px; border-radius: 10px; object-fit: cover; border: 2px solid #e5e7eb;">
                </div>
                <div class="cl-info" style="flex: 1; min-width: 0;">
                    <a href="{{ $candidate->url }}" class="cl-name" style="font-size: 16px; font-weight: 600; color: #1f2937; text-decoration: none; display: block; margin-bottom: 6px;">{{ $candidate->name }}</a>
                    
                    <div class="cl-details" style="display: flex; flex-direction: column; gap: 6px; margin-bottom: 10px;">
                        @if ($candidate->phone)
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #6b7280;">
                                <i class="feather-phone" style="font-size: 12px; color: #9ca3af;"></i>
                                <span>{{ $candidate->phone }}</span>
                            </div>
                        @endif
                        
                        @if ($candidate->city_name || $candidate->state_name)
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #6b7280;">
                                <i class="feather-map-pin" style="font-size: 12px; color: #9ca3af;"></i>
                                <span>
                                    @if ($candidate->city_name){{ $candidate->city_name }}@endif
                                    @if ($candidate->city_name && $candidate->state_name), @endif
                                    @if ($candidate->state_name){{ $candidate->state_name }}@endif
                                </span>
                            </div>
                        @endif
                        
                        @if ($candidate->expected_salary)
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #6b7280;">
                                <i class="feather-dollar-sign" style="font-size: 12px; color: #9ca3af;"></i>
                                <span>{{ number_format($candidate->expected_salary) }} 
                                    @if ($candidate->expected_salary_period)/ {{ ucfirst($candidate->expected_salary_period) }}@endif
                                </span>
                            </div>
                        @endif
                        
                        @if ($candidate->total_experience)
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #6b7280;">
                                <i class="feather-briefcase" style="font-size: 12px; color: #9ca3af;"></i>
                                <span>{{ $candidate->total_experience }}</span>
                            </div>
                        @endif
                    </div>
                    
                    @if ($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0)
                        <div class="cl-skills" style="margin-bottom: 8px; display: flex; flex-wrap: wrap; gap: 4px;">
                            @foreach($candidate->favoriteSkills->take(3) as $skill)
                                <span class="badge bg-secondary" style="font-size: 10px; padding: 2px 8px;">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    @if ($candidate->description)
                        <p class="cl-desc" style="font-size: 12px; color: #6b7280; line-height: 1.5; margin-bottom: 0;">
                            {!! Str::limit(BaseHelper::clean($candidate->description), 100) !!}
                        </p>
                    @endif
                </div>
                @if (! JobBoardHelper::isDisabledPublicProfile() && $candidate->url)
                    <div class="cl-right" style="flex-shrink: 0; display: flex; align-items: center;">
                        <a href="{{ $candidate->url }}" class="cl-view-btn" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; white-space: nowrap;">{{ __('View') }} →</a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
