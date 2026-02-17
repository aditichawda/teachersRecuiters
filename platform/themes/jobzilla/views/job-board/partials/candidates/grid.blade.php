<div class="row">
    @foreach ($candidates as $candidate)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="cand-card-grid">
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
                    $cgInst = is_array($cgInst) ? array_slice(array_filter($cgInst), 0, 2) : [];
                @endphp
                @if (!empty($cgInst))
                    <p class="cg-tags mb-1">
                        @foreach($cgInst as $it)
                            <span class="badge bg-light text-primary" style="font-size:10px;">{{ $cgLabels[$it] ?? ucwords(str_replace('_',' ', $it)) }}</span>
                        @endforeach
                    </p>
                @endif
                <p class="cg-desc">{!! Str::limit(BaseHelper::clean($candidate->description), 80) !!}</p>
                @if ($candidate->address)
                    <p class="cg-location">
                        <i class="feather-map-pin"></i> {{ Str::limit($candidate->address, 35) }}
                    </p>
                @endif
                @if (! JobBoardHelper::isDisabledPublicProfile())
                    <a href="{{ $candidate->url }}" class="cg-view-btn">{{ __('View Profile') }} →</a>
                @endif
            </div>
        </div>
    @endforeach
</div>
