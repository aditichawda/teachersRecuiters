<div style="font-family: 'Georgia', 'Times New Roman', serif; max-width: 800px; margin: 0 auto; padding: 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="text-align: center; padding-bottom: 20px; border-bottom: 3px solid #1967d2; margin-bottom: 25px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin: 0 0 6px 0; letter-spacing: 1px;">
            {{ strtoupper($account->name ?: 'Your Name') }}
        </h1>
        @if($account->career_aspiration)
            <p style="font-size: 14px; color: #555; margin: 0 0 12px 0; font-style: italic;">
                {{ Str::limit(strip_tags($account->career_aspiration), 120) }}
            </p>
        @endif
        <div style="font-size: 12px; color: #666; display: flex; justify-content: center; flex-wrap: wrap; gap: 12px;">
            @if($account->email)
                <span>📧 {{ $account->email }}</span>
            @endif
            @if($account->phone)
                <span>📞 {{ $account->phone }}</span>
            @endif
            @if($account->address)
                <span>📍 {{ $account->address }}</span>
            @elseif($account->state_name || $account->city_name)
                <span>📍 {{ implode(', ', array_filter([$account->city_name, $account->state_name])) }}</span>
            @endif
        </div>
    </div>

    <!-- About / Career Aspiration -->
    @if($account->career_aspiration)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Professional Summary
        </h2>
        <p style="font-size: 13px; line-height: 1.7; color: #444; margin: 0;">
            {{ strip_tags($account->career_aspiration) }}
        </p>
    </div>
    @endif

    <!-- Experience -->
    @if($experiences->count() > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            Work Experience
        </h2>
        @foreach($experiences as $exp)
        <div style="margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $exp->position }}</h3>
                <span style="font-size: 12px; color: #888;">
                    {{ $exp->started_at ? $exp->started_at->format('M Y') : '' }}
                    –
                    {{ $exp->ended_at ? $exp->ended_at->format('M Y') : 'Present' }}
                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 6px 0; font-weight: 500;">
                {{ $exp->company }}
            </p>
            @if($exp->description)
            <p style="font-size: 12px; color: #555; line-height: 1.6; margin: 0;">
                {{ strip_tags($exp->description) }}
            </p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- Education -->
    @if($educations->count() > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 12px 0;">
            Education
        </h2>
        @foreach($educations as $edu)
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $edu->specialized ?? $edu->description }}</h3>
                <span style="font-size: 12px; color: #888;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '' }}
                    –
                    {{ $edu->ended_at ? $edu->ended_at->format('Y') : 'Present' }}
                </span>
            </div>
            <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0; font-weight: 500;">
                {{ $edu->school }}
            </p>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Skills -->
    @if(count($skills) > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Skills
        </h2>
        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
            @foreach($skills as $skill)
            <span style="background: #f0f4ff; color: #1967d2; padding: 4px 12px; border-radius: 14px; font-size: 12px; font-weight: 500;">{{ $skill }}</span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Languages -->
    @if($account->languages && count($account->languages) > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Languages
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

    <!-- Teaching Certifications -->
    @if($account->teaching_certifications && count($account->teaching_certifications) > 0)
    <div style="margin-bottom: 22px;">
        <h2 style="font-size: 15px; font-weight: 700; color: #1967d2; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #ddd; padding-bottom: 6px; margin: 0 0 10px 0;">
            Certifications
        </h2>
        <ul style="margin: 0; padding: 0 0 0 18px; font-size: 13px; color: #444; line-height: 1.8;">
            @foreach($account->teaching_certifications as $cert)
                <li>{{ $cert }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
