<div style="font-family: 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 40px; background: #fff; color: #333;">
    <!-- Header -->
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; font-weight: 300; color: #222; margin: 0 0 8px 0; letter-spacing: -0.5px;">
            {{ $account->name ?: 'Your Name' }}
        </h1>
        <div style="display: flex; flex-wrap: wrap; gap: 16px; font-size: 13px; color: #777;">
            @if($account->email)
                <span>{{ $account->email }}</span>
            @endif
            @if($account->phone)
                <span>·</span>
                <span>{{ $account->phone }}</span>
            @endif
            @if($account->address)
                <span>·</span>
                <span>{{ $account->address }}</span>
            @elseif($account->state_name || $account->city_name)
                <span>·</span>
                <span>{{ implode(', ', array_filter([$account->city_name, $account->state_name])) }}</span>
            @endif
        </div>
    </div>

    <hr style="border: none; border-top: 1px solid #eee; margin: 0 0 25px 0;">

    <!-- Summary -->
    @if($account->career_aspiration)
    <div style="margin-bottom: 28px;">
        <p style="font-size: 14px; line-height: 1.7; color: #555; margin: 0; font-weight: 300;">
            {{ strip_tags($account->career_aspiration) }}
        </p>
    </div>
    @endif

    <!-- Experience -->
    @if($experiences->count() > 0)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">
            Experience
        </h2>
        @foreach($experiences as $exp)
        <div style="margin-bottom: 18px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 15px; font-weight: 500; color: #222; margin: 0; display: inline;">{{ $exp->position }}</h3>
                    <span style="font-size: 14px; color: #888; margin-left: 8px;">at {{ $exp->company }}</span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    {{ $exp->started_at ? $exp->started_at->format('M Y') : '' }} – {{ $exp->ended_at ? $exp->ended_at->format('M Y') : 'Present' }}
                </span>
            </div>
            @if($exp->description)
            <p style="font-size: 13px; color: #666; line-height: 1.6; margin: 6px 0 0 0; font-weight: 300;">
                {{ strip_tags($exp->description) }}
            </p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- Education -->
    @if($educations->count() > 0)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 16px 0;">
            Education
        </h2>
        @foreach($educations as $edu)
        <div style="margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                <div>
                    <h3 style="font-size: 14px; font-weight: 500; color: #222; margin: 0; display: inline;">{{ $edu->specialized ?? $edu->description }}</h3>
                    <span style="font-size: 13px; color: #888; margin-left: 8px;">{{ $edu->school }}</span>
                </div>
                <span style="font-size: 12px; color: #aaa;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '' }} – {{ $edu->ended_at ? $edu->ended_at->format('Y') : 'Present' }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Skills -->
    @if(count($skills) > 0)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            Skills
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            {{ implode('  ·  ', $skills) }}
        </p>
    </div>
    @endif

    <!-- Languages -->
    @if($account->languages && count($account->languages) > 0)
    <div style="margin-bottom: 28px;">
        <h2 style="font-size: 11px; font-weight: 600; color: #999; text-transform: uppercase; letter-spacing: 3px; margin: 0 0 12px 0;">
            Languages
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
            Certifications
        </h2>
        <p style="font-size: 13px; color: #555; line-height: 1.8; margin: 0; font-weight: 300;">
            {{ implode('  ·  ', $account->teaching_certifications) }}
        </p>
    </div>
    @endif
</div>
