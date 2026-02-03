<div class="row row-cols-md-3 row-cols-1">
    @foreach ($candidates as $candidate)
        <div class="col">
            <div class="twm-candidates-grid-style1 mb-5">
                <div class="twm-media">
                    <div class="twm-media-pic">
                        <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
                    </div>
                    @if ($candidate->is_featured)
                        <div class="twm-candidates-tag"><span>{{ __('Featured') }}</span></div>
                    @endif
                </div>
                <div class="twm-mid-content">
                    <a href="{{ $candidate->url }}" class="twm-job-title">
                        <h4>{{ $candidate->name }}</h4>
                    </a>
                    <p>{!! Str::limit(BaseHelper::clean($candidate->description), 80) !!}</p>
                    @if (! JobBoardHelper::isDisabledPublicProfile())
                        <a href="{{ $candidate->url }}"
                            class="twm-view-prifile site-text-primary">{{ __('View Profile') }}</a>
                    @endif
                    <div class="twm-fot-content">
                        <div class="twm-left-info">
                            @if ($candidate->address)
                                <p class="twm-candidate-address">
                                    <i class="feather-map-pin"></i>{{ Str::limit($candidate->address, 35) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
