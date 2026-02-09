<div style="font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; display: flex; background: #fff; min-height: 900px;">
    <!-- Left Sidebar -->
    <div style="width: 260px; min-width: 260px; background: linear-gradient(180deg, #0d47a1, #1967d2); color: #fff; padding: 35px 22px;">
        <!-- Avatar & Name -->
        <div style="text-align: center; margin-bottom: 25px;">
            <div style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; font-size: 36px; font-weight: 700; color: #fff; border: 3px solid rgba(255,255,255,0.4); overflow: hidden;">
                @if($account->avatar_url && !str_contains($account->avatar_url, 'default'))
                    <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr($account->name ?: 'U', 0, 1)) }}
                @endif
            </div>
            <h1 style="font-size: 18px; font-weight: 700; margin: 0 0 4px 0; letter-spacing: 0.5px;">
                {{ $account->name ?: 'Your Name' }}
            </h1>
            @if($account->total_experience)
                <p style="font-size: 11px; opacity: 0.8; margin: 0;">{{ $account->total_experience }} Experience</p>
            @endif
        </div>

        <!-- Contact -->
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Contact
            </h3>
            <div style="font-size: 12px; line-height: 2;">
                @if($account->email)
                    <div>📧 {{ $account->email }}</div>
                @endif
                @if($account->phone)
                    <div>📞 {{ $account->phone }}</div>
                @endif
                @if($account->address)
                    <div>📍 {{ $account->address }}</div>
                @elseif($account->state_name || $account->city_name)
                    <div>📍 {{ implode(', ', array_filter([$account->city_name, $account->state_name])) }}</div>
                @endif
            </div>
        </div>

        <!-- Skills -->
        @if(count($skills) > 0)
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Skills
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                @foreach($skills as $skill)
                <span style="background: rgba(255,255,255,0.15); padding: 3px 10px; border-radius: 12px; font-size: 11px;">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Languages -->
        @if($account->languages && count($account->languages) > 0)
        <div style="margin-bottom: 22px;">
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Languages
            </h3>
            @foreach($account->languages as $lang)
                @if(!empty($lang['language']))
                <div style="margin-bottom: 6px;">
                    <div style="font-size: 12px; margin-bottom: 3px;">{{ $lang['language'] }}</div>
                    @if(!empty($lang['proficiency']))
                    <div style="background: rgba(255,255,255,0.2); border-radius: 10px; height: 6px; overflow: hidden;">
                        @php
                            $profPercent = match($lang['proficiency'] ?? '') {
                                'beginner' => 25,
                                'elementary' => 40,
                                'intermediate' => 60,
                                'advanced' => 80,
                                'native' => 100,
                                default => 50
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
            <h3 style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 6px; margin: 0 0 10px 0; opacity: 0.9;">
                Certifications
            </h3>
            @foreach($account->teaching_certifications as $cert)
                <div style="font-size: 11px; margin-bottom: 4px; padding-left: 12px; position: relative;">
                    <span style="position: absolute; left: 0;">•</span> {{ $cert }}
                </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Right Content -->
    <div style="flex: 1; padding: 35px 30px;">
        <!-- Professional Summary -->
        @if($account->career_aspiration)
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                About Me
            </h2>
            <p style="font-size: 13px; line-height: 1.7; color: #555; margin: 0;">
                {{ strip_tags($account->career_aspiration) }}
            </p>
        </div>
        @endif

        <!-- Experience -->
        @if($experiences->count() > 0)
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                Experience
            </h2>
            @foreach($experiences as $exp)
            <div style="margin-bottom: 16px; padding-left: 16px; border-left: 3px solid #1967d2;">
                <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $exp->position }}</h3>
                    <span style="font-size: 11px; color: #999; background: #f5f5f5; padding: 2px 8px; border-radius: 10px;">
                        {{ $exp->started_at ? $exp->started_at->format('M Y') : '' }} – {{ $exp->ended_at ? $exp->ended_at->format('M Y') : 'Present' }}
                    </span>
                </div>
                <p style="font-size: 13px; color: #1967d2; margin: 3px 0 6px 0;">{{ $exp->company }}</p>
                @if($exp->description)
                <p style="font-size: 12px; color: #666; line-height: 1.6; margin: 0;">
                    {{ Str::limit(strip_tags($exp->description), 200) }}
                </p>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <!-- Education -->
        @if($educations->count() > 0)
        <div style="margin-bottom: 25px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #0d47a1; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0; padding-bottom: 6px; border-bottom: 2px solid #e3f2fd;">
                Education
            </h2>
            @foreach($educations as $edu)
            <div style="margin-bottom: 12px; padding-left: 16px; border-left: 3px solid #64b5f6;">
                <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $edu->specialized ?? $edu->description }}</h3>
                <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0;">{{ $edu->school }}</p>
                <span style="font-size: 11px; color: #999;">
                    {{ $edu->started_at ? $edu->started_at->format('Y') : '' }} – {{ $edu->ended_at ? $edu->ended_at->format('Y') : 'Present' }}
                </span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
