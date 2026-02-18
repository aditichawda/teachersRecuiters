@php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable']);
@endphp

@foreach ($candidates as $candidate)
    <div class="cand-card-list" style="display: flex; align-items: flex-start; gap: 20px; padding: 20px; border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 20px; background: #fff; transition: all 0.3s;">
        @if ($candidate->is_featured)
            <span class="cl-featured" style="position: absolute; top: 15px; right: 15px; background: #fbbf24; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">{{ __('Featured') }}</span>
        @endif
        
        <div class="cl-avatar" style="flex-shrink: 0;">
            <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}" style="width: 100px; height: 100px; border-radius: 12px; object-fit: cover; border: 2px solid #e5e7eb;">
        </div>
        
        <div class="cl-info" style="flex: 1; min-width: 0;">
            <a href="{{ $candidate->url }}" class="cl-name" style="font-size: 18px; font-weight: 600; color: #1f2937; text-decoration: none; display: block; margin-bottom: 8px;">{{ $candidate->name }}</a>
            
            <div class="cl-details" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 12px;">
                @if ($candidate->phone)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="feather-phone" style="font-size: 14px; color: #9ca3af;"></i>
                        <span>{{ $candidate->phone }}</span>
                    </div>
                @endif
                
                @if ($candidate->city_name || $candidate->state_name)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="feather-map-pin" style="font-size: 14px; color: #9ca3af;"></i>
                        <span>
                            @if ($candidate->city_name)
                                {{ $candidate->city_name }}
                            @endif
                            @if ($candidate->city_name && $candidate->state_name), @endif
                            @if ($candidate->state_name)
                                {{ $candidate->state_name }}
                            @endif
                        </span>
                    </div>
                @elseif ($candidate->address)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="feather-map-pin" style="font-size: 14px; color: #9ca3af;"></i>
                        <span>{{ Str::limit($candidate->address, 50) }}</span>
                    </div>
                @endif
                
                @if ($candidate->expected_salary)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="feather-dollar-sign" style="font-size: 14px; color: #9ca3af;"></i>
                        <span>{{ number_format($candidate->expected_salary) }} 
                            @if ($candidate->expected_salary_period)
                                / {{ ucfirst($candidate->expected_salary_period) }}
                            @endif
                        </span>
                    </div>
                @endif
                
                @if ($candidate->total_experience)
                    <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #6b7280;">
                        <i class="feather-briefcase" style="font-size: 14px; color: #9ca3af;"></i>
                        <span>{{ $candidate->total_experience }} {{ __('Experience') }}</span>
                    </div>
                @endif
            </div>
            
            @php
                $cgLabels = ['cbse_school'=>'CBSE','icse_school'=>'ICSE','cambridge_school'=>'Cambridge','ib_school'=>'IB','state_board_school'=>'State Board','play_school'=>'Play School','engineering_college'=>'Engineering','medical_college'=>'Medical','nursing_college'=>'Nursing','edtech_company'=>'EdTech','coaching_institute'=>'Coaching','university'=>'University'];
                $cgInst = $candidate->institution_types ?? [];
                if (empty($cgInst) && !empty($candidate->institution_type)) $cgInst = [$candidate->institution_type];
                $cgInst = is_array($cgInst) ? array_filter($cgInst) : [];
            @endphp
            
            @if (!empty($cgInst))
                <div class="cl-institution-tags" style="margin-bottom: 10px;">
                    @foreach(array_slice($cgInst, 0, 4) as $it)
                        <span class="badge bg-primary" style="font-size: 11px; padding: 4px 10px; margin-right: 6px; border-radius: 6px;">{{ $cgLabels[$it] ?? ucwords(str_replace('_',' ', $it)) }}</span>
                    @endforeach
                </div>
            @endif
            
            @if ($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0)
                <div class="cl-skills" style="margin-bottom: 10px; display: flex; flex-wrap: wrap; gap: 6px;">
                    @foreach($candidate->favoriteSkills->take(5) as $skill)
                        <span class="badge bg-secondary" style="font-size: 11px; padding: 4px 10px; border-radius: 6px;">{{ $skill->name }}</span>
                    @endforeach
                    @if ($candidate->favoriteSkills->count() > 5)
                        <span class="badge bg-light text-muted" style="font-size: 11px; padding: 4px 10px; border-radius: 6px;">+{{ $candidate->favoriteSkills->count() - 5 }} {{ __('more') }}</span>
                    @endif
                </div>
            @endif
            
            @if ($candidate->teaching_subjects)
                @php
                    $subjects = is_array($candidate->teaching_subjects) ? $candidate->teaching_subjects : json_decode($candidate->teaching_subjects, true);
                    $subjects = is_array($subjects) ? array_slice(array_filter($subjects), 0, 3) : [];
                @endphp
                @if (!empty($subjects))
                    <div class="cl-subjects" style="margin-bottom: 10px; font-size: 13px; color: #4b5563;">
                        <i class="feather-book" style="font-size: 12px; margin-right: 6px; color: #9ca3af;"></i>
                        <strong>{{ __('Subjects') }}:</strong> {{ implode(', ', $subjects) }}
                    </div>
                @endif
            @endif
            
            @if ($candidate->description)
                <p class="cl-desc" style="font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 0;">
                    {!! Str::limit(BaseHelper::clean($candidate->description), 150) !!}
                </p>
            @endif
        </div>
        
        @if (! JobBoardHelper::isDisabledPublicProfile() && $candidate->url)
            <div class="cl-right" style="flex-shrink: 0; display: flex; align-items: center;">
                <a href="{{ $candidate->url }}" class="cl-view-btn" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; white-space: nowrap;">{{ __('View Profile') }} →</a>
            </div>
        @endif
    </div>
@endforeach
