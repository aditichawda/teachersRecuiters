@foreach ($candidates as $candidate)
    <div class="cand-card-list">
        @if ($candidate->is_featured)
            <span class="cl-featured">{{ __('Featured') }}</span>
        @endif
        <div class="cl-avatar">
            <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
        </div>
        <div class="cl-info">
            <a href="{{ $candidate->url }}" class="cl-name">{{ $candidate->name }}</a>
            <p class="cl-desc">{!! Str::limit(BaseHelper::clean($candidate->description), 80) !!}</p>
            @if ($candidate->address)
                <p class="cl-location">
                    <i class="feather-map-pin"></i> {{ Str::limit($candidate->address, 35) }}
                </p>
            @endif
        </div>
        @if (! JobBoardHelper::isDisabledPublicProfile())
            <div class="cl-right">
                <a href="{{ $candidate->url }}" class="cl-view-btn">{{ __('View Profile') }} →</a>
            </div>
        @endif
    </div>
@endforeach
