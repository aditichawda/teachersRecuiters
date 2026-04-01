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
<div style="font-family: 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 40px; background: #fff; color: #333;">
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; font-weight: 300; color: #222; margin: 0 0 8px 0; letter-spacing: -0.5px;">{{ $displayName }}</h1>
        @if($account->designation)
            <p style="font-size: 13px; color: #666; margin: 0 0 8px 0;">{{ $account->designation }}</p>
        @endif
        <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 13px; color: #777;">
            <span>{{ $displayEmail }}</span><span>·</span><span>{{ $displayPhone }}</span><span>·</span><span>{{ $displayLocation }}</span>
        </div>
    </div>

    <hr style="border: none; border-top: 1px solid #eee; margin: 0 0 25px 0;">

    @if($summaryText)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">{{ __('Professional Summary') }}</h2>
        <p style="font-size: 14px; line-height: 1.7; color: #555; margin: 0; font-weight: 300;">{{ $summaryText }}</p>
    </div>
    @endif

    <!-- Work Experience (same order as classic, always show with placeholder) -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">
            {{ __('Work Experience') }}
        </h2>
        @foreach($displayExperiences as $exp)
        <div style="margin-bottom: 18px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 15px; font-weight: 500; color: #222; margin: 0; display: inline;">{{ $exp->position }}</h3>
                    <span style="font-size: 14px; color: #888; margin-left: 8px;">at {{ $exp->company }}</span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    {{ $exp->started_at ? $exp->started_at->format('M Y') : '—' }} – {{ $exp->ended_at ? $exp->ended_at->format('M Y') : __('Present') }}
                </span>
            </div>
            @if(!empty($exp->description))
            <p style="font-size: 13px; color: #666; line-height: 1.6; margin: 6px 0 0 0; font-weight: 300;">
                {{ strip_tags($exp->description) }}
            </p>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Education -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">{{ __('Education') }}</h2>
        @foreach($displayEducations as $edu)
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 14px; font-weight: 500; color: #222; margin: 0; display: inline;">{{ $edu->specialized ?? $edu->description ?? __('Degree') }}</h3>
                    <span style="font-size: 13px; color: #888; margin-left: 8px;">{{ $edu->school }}</span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '—' }} – {{ $edu->ended_at ? $edu->ended_at->format('Y') : __('Present') }}
                </span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Skills -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">{{ __('Skills') }}</h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">{{ implode('  ·  ', array_map(fn($s) => is_string($s) ? $s : ($s->name ?? ''), $displaySkills)) }}</p>
    </div>

    <!-- Interests (same as classic) -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">{{ __('Interests') }}</h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">{{ $displayInterests }}</p>
    </div>

    <!-- Activities (same as classic) -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">{{ __('Activities') }}</h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">{{ $displayActivities }}</p>
    </div>

    <!-- Achievements (same as classic) -->
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">{{ __('Achievements') }}</h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">{{ $displayAchievements }}</p>
    </div>

    <!-- Languages -->
    @if($account->languages && count($account->languages) > 0)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            {{ __('Languages') }}
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            @php
                $langList = [];
                foreach($account->languages as $lang) {
                    if (!empty($lang['language'])) {
                        $entry = $lang['language'];
                        if (!empty($lang['proficiency'])) $entry .= ' (' . ucfirst($lang['proficiency']) . ')';
                        $langList[] = $entry;
                    }
                }
            @endphp
            {{ implode('  ·  ', $langList) }}
        </p>
    </div>
    @endif

    <!-- Certifications -->
    @if($account->teaching_certifications && count($account->teaching_certifications) > 0)
    <div>
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            {{ __('Certifications') }}
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            {{ implode('  ·  ', $account->teaching_certifications) }}
        </p>
    </div>
    @endif
</div>
