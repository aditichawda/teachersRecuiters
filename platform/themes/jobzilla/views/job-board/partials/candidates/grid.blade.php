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
