<div style="font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; max-width: 800px; margin: 0 auto; background: #fff; color: #333;">
    <!-- Header -->
    <div style="background: linear-gradient(135deg, #1a237e 0%, #0d47a1 50%, #1967d2 100%); color: #fff; padding: 35px 40px; position: relative;">
        <div style="display: flex; align-items: center; gap: 24px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; border: 2px solid rgba(255,255,255,0.3); overflow: hidden; flex-shrink: 0;">
                @if($account->avatar_url && !str_contains($account->avatar_url, 'default'))
                    <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{ strtoupper(substr($account->name ?: 'U', 0, 1)) }}
                @endif
            </div>
            <div>
                <h1 style="font-size: 26px; font-weight: 700; margin: 0 0 6px 0; letter-spacing: 0.5px;">
                    {{ $account->name ?: 'Your Name' }}
                </h1>
                @if($account->total_experience)
                    <p style="font-size: 13px; opacity: 0.85; margin: 0;">{{ $account->total_experience }} of Experience</p>
                @endif
            </div>
        </div>
        <!-- Contact Bar -->
        <div style="display: flex; flex-wrap: wrap; gap: 18px; margin-top: 18px; font-size: 12px; opacity: 0.9;">
            @if($account->email)
                <span>✉ {{ $account->email }}</span>
            @endif
            @if($account->phone)
                <span>☎ {{ $account->phone }}</span>
            @endif
            @if($account->address)
                <span>⌂ {{ $account->address }}</span>
            @elseif($account->state_name || $account->city_name)
                <span>⌂ {{ implode(', ', array_filter([$account->city_name, $account->state_name])) }}</span>
            @endif
        </div>
    </div>

    <div style="padding: 30px 40px;">
        <!-- Professional Summary -->
        @if($account->career_aspiration)
        <div style="margin-bottom: 28px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                    👤
                </div>
                <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Professional Summary</h2>
            </div>
            <p style="font-size: 13px; line-height: 1.75; color: #555; margin: 0; padding-left: 42px;">
                {{ strip_tags($account->career_aspiration) }}
            </p>
        </div>
        @endif

        <!-- Experience Timeline -->
        @if($experiences->count() > 0)
        <div style="margin-bottom: 28px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                    💼
                </div>
                <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Work Experience</h2>
            </div>
            <div style="padding-left: 42px;">
                @foreach($experiences as $index => $exp)
                <div style="position: relative; padding-left: 24px; padding-bottom: {{ $index < $experiences->count() - 1 ? '20px' : '0' }}; border-left: 2px solid #e3f2fd; margin-left: 6px;">
                    <div style="position: absolute; left: -7px; top: 3px; width: 12px; height: 12px; background: #1967d2; border-radius: 50; border: 2px solid #fff;"></div>
                    <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;">
                        <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $exp->position }}</h3>
                        <span style="font-size: 11px; color: #888; background: #f8f8f8; padding: 2px 10px; border-radius: 12px;">
                            {{ $exp->started_at ? $exp->started_at->format('M Y') : '' }} – {{ $exp->ended_at ? $exp->ended_at->format('M Y') : 'Present' }}
                        </span>
                    </div>
                    <p style="font-size: 13px; color: #1967d2; margin: 3px 0 6px 0; font-weight: 500;">
                        {{ $exp->company }}
                    </p>
                    @if($exp->description)
                    <p style="font-size: 12px; color: #666; line-height: 1.6; margin: 0;">
                        {{ strip_tags($exp->description) }}
                    </p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Education Timeline -->
        @if($educations->count() > 0)
        <div style="margin-bottom: 28px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                    🎓
                </div>
                <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Education</h2>
            </div>
            <div style="padding-left: 42px;">
                @foreach($educations as $index => $edu)
                <div style="position: relative; padding-left: 24px; padding-bottom: {{ $index < $educations->count() - 1 ? '14px' : '0' }}; border-left: 2px solid #e3f2fd; margin-left: 6px;">
                    <div style="position: absolute; left: -7px; top: 3px; width: 12px; height: 12px; background: #64b5f6; border-radius: 50%; border: 2px solid #fff;"></div>
                    <h3 style="font-size: 14px; font-weight: 600; color: #222; margin: 0;">{{ $edu->specialized ?? $edu->description }}</h3>
                    <p style="font-size: 13px; color: #1967d2; margin: 2px 0 0 0;">{{ $edu->school }}</p>
                    <span style="font-size: 11px; color: #999;">
                        {{ $edu->started_at ? $edu->started_at->format('Y') : '' }} – {{ $edu->ended_at ? $edu->ended_at->format('Y') : 'Present' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Two-column footer: Skills + Languages -->
        <div style="display: flex; gap: 30px; flex-wrap: wrap;">
            <!-- Skills -->
            @if(count($skills) > 0)
            <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                        ⚡
                    </div>
                    <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Skills</h2>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 6px; padding-left: 42px;">
                    @foreach($skills as $skill)
                    <span style="background: linear-gradient(135deg, #e3f2fd, #f0f4ff); color: #1967d2; padding: 4px 12px; border-radius: 14px; font-size: 11px; font-weight: 500; border: 1px solid #d0e3f7;">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Languages & Certifications -->
            <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                @if($account->languages && count($account->languages) > 0)
                <div style="margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                            🌐
                        </div>
                        <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Languages</h2>
                    </div>
                    <div style="padding-left: 42px; font-size: 13px; color: #555; line-height: 1.8;">
                        @foreach($account->languages as $lang)
                            @if(!empty($lang['language']))
                                {{ $lang['language'] }}@if(!empty($lang['proficiency'])) <span style="color: #999;">({{ ucfirst($lang['proficiency']) }})</span>@endif<br>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @if($account->teaching_certifications && count($account->teaching_certifications) > 0)
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <div style="width: 32px; height: 32px; background: #e3f2fd; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #1967d2; font-size: 14px; flex-shrink: 0;">
                            📜
                        </div>
                        <h2 style="font-size: 16px; font-weight: 600; color: #1a237e; margin: 0;">Certifications</h2>
                    </div>
                    <div style="padding-left: 42px; font-size: 13px; color: #555; line-height: 1.8;">
                        @foreach($account->teaching_certifications as $cert)
                            {{ $cert }}<br>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
