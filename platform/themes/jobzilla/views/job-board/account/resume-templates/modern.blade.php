@php
    $displayEducations = $educations->isNotEmpty() ? $educations : collect([
        (object)['school' => __('Your School / University'), 'specialized' => __('Degree e.g. B.Ed, M.A'), 'description' => null, 'started_at' => null, 'ended_at' => null],
    ]);
    $displayExperiences = $experiences->isNotEmpty() ? $experiences : collect([
        (object)['company' => __('School / Institution Name'), 'position' => __('Position e.g. Teacher'), 'description' => null, 'started_at' => null, 'ended_at' => null],
    ]);
    $displaySkills = !empty($skills) ? $skills : [__('Teaching'), __('Communication'), __('Classroom Management'), __('Add your skills in profile')];
    $summaryText = $account->career_aspiration ? strip_tags($account->career_aspiration) : ($account->description ? strip_tags($account->description) : ($account->bio ? strip_tags($account->bio) : __('Passionate educator committed to student growth. Complete your profile to personalize this summary.')));
    $displayName = $account->name ?: __('Your Name');
    $displayEmail = $account->email ?: 'your.email@example.com';
    $displayPhone = $account->phone ?: __('Your Phone');
    $displayLocation = $account->address ?: (($account->city_name || $account->state_name) ? implode(', ', array_filter([$account->city_name, $account->state_name])) : __('Your City, State'));
    $displayInterests = $account->interests ?: __('e.g. Reading, Educational workshops, Student mentoring');
    $displayActivities = $account->activities ?: __('e.g. School club coordinator, Annual day organizer');
    $displayAchievements = $account->achievements ?: __('e.g. Best Teacher Award, Workshop presenter');
@endphp
<div style="font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; max-width: 900px; margin: 0 auto; display: flex; background: #fff; min-height: 920px; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
    <!-- Left Sidebar -->
    <div style="width: 280px; min-width: 280px; background: linear-gradient(180deg, #0d47a1 0%, #1565c0 50%, #1976d2 100%); color: #fff; padding: 40px 24px;">
        <!-- Avatar & Name -->
        <div style="text-align: center; margin-bottom: 28px;">
            <div style="width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: 700; color: #fff; border: 3px solid rgba(255,255,255,0.4); overflow: hidden;">
                @if($account->avatar_url && !str_contains($account->avatar_url, 'default'))
                    <img src="{{ $account->avatar_url }}" alt="{{ $displayName }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr($displayName, 0, 1)) }}
                @endif
            </div>
            <h1 style="font-size: 20px;color:white; font-weight: 700; margin: 0 0 6px 0; letter-spacing: 0.5px; line-height: 1.3;">
                {{ $displayName }}
            </h1>
            @if($account->designation)
                <p style="font-size: 12px; opacity: 0.9; margin: 0;">{{ $account->designation }}</p>
            @elseif($account->total_experience)
                <p style="font-size: 11px; opacity: 0.85; margin: 0;">{{ $account->total_experience }} {{ __('Experience') }}</p>
            @endif
        </div>

        <!-- Contact -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px;color:white; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                {{ __('Contact') }}
            </h3>
            <div style="font-size: 12px; line-height: 2.2;">
                <div>📧 {{ $displayEmail }}</div>
                <div>📞 {{ $displayPhone }}</div>
                <div>📍 {{ $displayLocation }}</div>
            </div>
        </div>

        <!-- Skills -->
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px;color:white; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                {{ __('Skills') }}
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                @foreach($displaySkills as $skill)
                <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 14px; font-size: 11px;">{{ is_string($skill) ? $skill : ($skill->name ?? '') }}</span>
                @endforeach
            </div>
        </div>

        <!-- Languages -->
        @if($account->languages && count($account->languages) > 0)
        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                {{ __('Languages') }}
            </h3>
            @foreach($account->languages as $lang)
                @if(!empty($lang['language']))
                <div style="margin-bottom: 8px;">
                    <div style="font-size: 12px; margin-bottom: 4px;">{{ $lang['language'] }}</div>
                    @if(!empty($lang['proficiency']))
                    <div style="background: rgba(255,255,255,0.15); border-radius: 10px; height: 6px; overflow: hidden;">
                        @php
                            $profPercent = match($lang['proficiency'] ?? '') {
                                'beginner' => 25, 'elementary' => 40, 'intermediate' => 60, 'advanced' => 80, 'native' => 100, default => 50
                            };
                        @endphp
                        <div style="background: #64b5f6; height: 100%; width: {{ $profPercent }}%; border-radius: 10px;"></div>
                    </div>
                    @endif
                </div>
                @endif
            @endforeach
        </div>
        @endif

        <!-- Certifications -->
        @if($account->teaching_certifications && count($account->teaching_certifications) > 0)
        <div>
            <h3 style="font-size: 11px; text-transform: uppercase; letter-spacing: 2.5px; border-bottom: 1px solid rgba(255,255,255,0.35); padding-bottom: 8px; margin: 0 0 12px 0; opacity: 0.95;">
                {{ __('Certifications') }}
            </h3>
            @foreach($account->teaching_certifications as $cert)
                <div style="font-size: 11px; margin-bottom: 6px; padding-left: 14px; position: relative;">
                    <span style="position: absolute; left: 0;">•</span> {{ $cert }}
                </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Right Content -->
    <div style="flex: 1; padding: 40px 36px;">
        <!-- Professional Summary -->
        @if($summaryText)
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 12px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('About Me') }}
            </h2>
            <p style="font-size: 13px; line-height: 1.75; color: #555; margin: 0;">
                {{ $summaryText }}
            </p>
        </div>
        @endif

        <!-- Experience -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('Experience') }}
            </h2>
            @foreach($displayExperiences as $exp)
            <div style="margin-bottom: 18px; padding-left: 18px; border-left: 3px solid #1976d2;">
                <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $exp->position }}</h3>
                    <span style="font-size: 11px; color: #999; background: #f5f5f5; padding: 3px 10px; border-radius: 12px;">
                        {{ $exp->started_at ? $exp->started_at->format('M Y') : '—' }} – {{ $exp->ended_at ? $exp->ended_at->format('M Y') : __('Present') }}
                    </span>
                </div>
                <p style="font-size: 13px; color: #1565c0; margin: 4px 0 8px 0; font-weight: 500;">{{ $exp->company }}</p>
                @if(!empty($exp->description))
                <p style="font-size: 12px; color: #666; line-height: 1.65; margin: 0;">
                    {{ Str::limit(strip_tags($exp->description), 220) }}
                </p>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Education -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 14px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('Education') }}
            </h2>
            @foreach($displayEducations as $edu)
            <div style="margin-bottom: 14px; padding-left: 18px; border-left: 3px solid #42a5f5;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $edu->specialized ?? $edu->description ?? __('Degree') }}</h3>
                <p style="font-size: 13px; color: #1565c0; margin: 2px 0 0 0; font-weight: 500;">{{ $edu->school }}</p>
                <span style="font-size: 11px; color: #999;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '—' }} – {{ $edu->ended_at ? $edu->ended_at->format('Y') : __('Present') }}
                </span>
            </div>
            @endforeach
        </div>

        <!-- Interests -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 12px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('Interests') }}
            </h2>
            <p style="font-size: 13px; line-height: 1.65; color: #555; margin: 0;">{{ $displayInterests }}</p>
        </div>

        <!-- Activities -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 12px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('Activities') }}
            </h2>
            <p style="font-size: 13px; line-height: 1.65; color: #555; margin: 0;">{{ $displayActivities }}</p>
        </div>

        <!-- Achievements -->
        <div style="margin-bottom: 28px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1.2px; margin: 0 0 12px 0; padding-bottom: 8px; border-bottom: 2px solid #e3f2fd;">
                {{ __('Achievements') }}
            </h2>
            <p style="font-size: 13px; line-height: 1.65; color: #555; margin: 0;">{{ $displayAchievements }}</p>
        </div>
    </div>
</div>
