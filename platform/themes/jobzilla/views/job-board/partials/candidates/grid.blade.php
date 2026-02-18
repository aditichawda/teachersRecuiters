@php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable']);
@endphp

<div class="row">
    @foreach ($candidates as $candidate)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cand-card-grid" style="height: 100%; display: flex; flex-direction: column;">
                @if ($candidate->is_featured)
                    <span class="cg-featured">{{ __('Featured') }}</span>
                @endif
                <div class="cg-avatar">
                    <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
                </div>
                <a href="{{ $candidate->url }}" class="cg-name">{{ $candidate->name }}</a>
                
                @php
                    $cgLabels = ['cbse_school'=>'CBSE','icse_school'=>'ICSE','cambridge_school'=>'Cambridge','ib_school'=>'IB','state_board_school'=>'State Board','play_school'=>'Play School','engineering_college'=>'Engineering','medical_college'=>'Medical','nursing_college'=>'Nursing','edtech_company'=>'EdTech','coaching_institute'=>'Coaching','university'=>'University'];
                    $cgInst = $candidate->institution_types ?? [];
                    if (empty($cgInst) && !empty($candidate->institution_type)) $cgInst = [$candidate->institution_type];
                    $cgInst = is_array($cgInst) ? array_slice(array_filter($cgInst), 0, 3) : [];
                @endphp
                
                <div class="cg-info-section" style="flex: 1; padding: 0 15px;">
                    @if (!empty($cgInst))
                        <p class="cg-tags mb-2">
                            @foreach($cgInst as $it)
                                <span class="badge bg-light text-primary" style="font-size:10px; margin-right: 4px;">{{ $cgLabels[$it] ?? ucwords(str_replace('_',' ', $it)) }}</span>
                            @endforeach
                        </p>
                    @endif
                    
                    @if ($candidate->phone)
                        <p class="cg-phone mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-phone" style="font-size: 12px;"></i>
                            <span>{{ $candidate->phone }}</span>
                        </p>
                    @endif
                    
                    @if ($candidate->city_name || $candidate->state_name)
                        <p class="cg-location mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-map-pin" style="font-size: 12px;"></i>
                            <span>
                                @if ($candidate->city_name)
                                    {{ $candidate->city_name }}
                                @endif
                                @if ($candidate->city_name && $candidate->state_name), @endif
                                @if ($candidate->state_name)
                                    {{ $candidate->state_name }}
                                @endif
                            </span>
                        </p>
                    @elseif ($candidate->address)
                        <p class="cg-location mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-map-pin" style="font-size: 12px;"></i>
                            <span>{{ Str::limit($candidate->address, 40) }}</span>
                        </p>
                    @endif
                    
                    @if ($candidate->expected_salary)
                        <p class="cg-salary mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-dollar-sign" style="font-size: 12px;"></i>
                            <span>{{ number_format($candidate->expected_salary) }} 
                                @if ($candidate->expected_salary_period)
                                    / {{ ucfirst($candidate->expected_salary_period) }}
                                @endif
                            </span>
                        </p>
                    @endif
                    
                    @if ($candidate->total_experience)
                        <p class="cg-experience mb-1" style="font-size: 13px; color: #666; display: flex; align-items: center; gap: 6px;">
                            <i class="feather-briefcase" style="font-size: 12px;"></i>
                            <span>{{ $candidate->total_experience }} {{ __('Experience') }}</span>
                        </p>
                    @endif
                    
                    @if ($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0)
                        <div class="cg-skills mb-2" style="display: flex; flex-wrap: wrap; gap: 4px; margin-top: 8px;">
                            @foreach($candidate->favoriteSkills->take(3) as $skill)
                                <span class="badge bg-secondary" style="font-size: 10px; padding: 3px 8px;">{{ $skill->name }}</span>
                            @endforeach
                            @if ($candidate->favoriteSkills->count() > 3)
                                <span class="badge bg-light text-muted" style="font-size: 10px; padding: 3px 8px;">+{{ $candidate->favoriteSkills->count() - 3 }}</span>
                            @endif
                        </div>
                    @endif
                    
                    @if ($candidate->teaching_subjects)
                        @php
                            $subjects = is_array($candidate->teaching_subjects) ? $candidate->teaching_subjects : json_decode($candidate->teaching_subjects, true);
                            $subjects = is_array($subjects) ? array_slice(array_filter($subjects), 0, 2) : [];
                        @endphp
                        @if (!empty($subjects))
                            <p class="cg-subjects mb-1" style="font-size: 12px; color: #555;">
                                <i class="feather-book" style="font-size: 11px; margin-right: 4px;"></i>
                                <span>{{ implode(', ', $subjects) }}</span>
                            </p>
                        @endif
                    @endif
                    
                    @if ($candidate->description)
                        <p class="cg-desc mt-2" style="font-size: 12px; color: #777; line-height: 1.4;">
                            {!! Str::limit(BaseHelper::clean($candidate->description), 100) !!}
                        </p>
                    @endif
                </div>
                
                @if (! JobBoardHelper::isDisabledPublicProfile() && $candidate->url)
                    <a href="{{ $candidate->url }}" class="cg-view-btn" style="margin-top: auto;">{{ __('View Profile') }} →</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
