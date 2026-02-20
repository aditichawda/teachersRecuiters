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
<div style="font-family: 'Georgia', 'Times New Roman', serif; max-width: 800px; margin: 0 auto; padding: 44px 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="text-align: center; padding-bottom: 22px; border-bottom: 3px solid #1967d2; margin-bottom: 28px;">
        <h1 style="font-size: 30px; font-weight: 700; color: #1a1a1a; margin: 0 0 8px 0; letter-spacing: 1px;">
            {{ strtoupper($displayName) }}
        </h1>
        @if($account->designation)
            <p style="font-size: 14px; color: #1967d2; font-weight: 600; margin: 0 0 10px 0;">{{ $account->designation }}</p>
        @endif
        @if($summaryText && strlen($summaryText) > 10)
            <p style="font-size: 13px; color: #555; margin: 0 0 14px 0; font-style: italic; max-width: 640px; margin-left: auto; margin-right: auto;">
                {{ Str::limit($summaryText, 140) }}
            </p>
        @endif
        <div style="font-size: 12px; color: #666; display: flex; justify-content: center; flex-wrap: wrap; gap: 14px;">
            <span>📧 {{ $displayEmail }}</span>
            <span>📞 {{ $displayPhone }}</span>
            <span>📍 {{ $displayLocation }}</span>
        </div>
    </div>

    <!-- Professional Summary -->
    @if($summaryText)
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Professional Summary') }}
        </h2>
        <p style="font-size: 13px; line-height: 1.75; color: #444; margin: 0;">
            {{ $summaryText }}
        </p>
    </div>
    @endif

    <!-- Experience -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 14px 0;">
            {{ __('Work Experience') }}
        </h2>
        @foreach($displayExperiences as $exp)
        <div style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $exp->position }}</h3>
                <span style="font-size: 12px; color: #888;">
                    {{ $exp->started_at ? $exp->started_at->format('M Y') : '—' }}
                    –
                    {{ $exp->ended_at ? $exp->ended_at->format('M Y') : __('Present') }}
                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 6px 0; font-weight: 500;">
                {{ $exp->company }}
            </p>
            @if(!empty($exp->description))
            <p style="font-size: 12px; color: #555; line-height: 1.65; margin: 0;">
                {{ strip_tags($exp->description) }}
            </p>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Education -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 14px 0;">
            {{ __('Education') }}
        </h2>
        @foreach($displayEducations as $edu)
        <div style="margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $edu->specialized ?? $edu->description ?? __('Degree') }}</h3>
                <span style="font-size: 12px; color: #888;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '—' }}
                    –
                    {{ $edu->ended_at ? $edu->ended_at->format('Y') : __('Present') }}
                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0; font-weight: 500;">
                {{ $edu->school }}
            </p>
        </div>
        @endforeach
    </div>

    <!-- Skills -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Skills') }}
        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
            @foreach($displaySkills as $skill)
            <span style="background: #f0f4ff; color: #1967d2; padding: 5px 14px; border-radius: 16px; font-size: 12px; font-weight: 500;">{{ is_string($skill) ? $skill : $skill->name ?? '' }}</span>
            @endforeach
        </div>
    </div>

    <!-- Interests -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Interests') }}
        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;">{{ $displayInterests }}</p>
    </div>

    <!-- Activities -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Activities') }}
        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;">{{ $displayActivities }}</p>
    </div>

    <!-- Achievements -->
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Achievements') }}
        </h2>
        <p style="font-size: 13px; line-height: 1.65; color: #444; margin: 0;">{{ $displayAchievements }}</p>
    </div>

    <!-- Languages -->
    @if($account->languages && count($account->languages) > 0)
    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Languages') }}
        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 16px;">
            @foreach($account->languages as $lang)
                @if(!empty($lang['language']))
                <span style="font-size: 13px; color: #444;">
                    {{ $lang['language'] }}
                    @if(!empty($lang['proficiency']))
                        <span style="color: #999;">– {{ ucfirst($lang['proficiency']) }}</span>
                    @endif
                </span>
                @endif
            @endforeach
        </div>
    </div>
    @endif

    <!-- Certifications -->
    @if($account->teaching_certifications && count($account->teaching_certifications) > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            {{ __('Certifications') }}
        </h2>
        <ul style="margin: 0; padding: 0 0 0 18px; font-size: 13px; color: #444; line-height: 1.8;">
            @foreach($account->teaching_certifications as $cert)
                <li>{{ $cert }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Footer -->
    <div style="text-align: center; padding-top: 20px; margin-top: 20px; border-top: 1px solid #eee; font-size: 11px; color: #999;">
        {{ __('Powered by TeachersRecruiters') }}
    </div>
</div>
