@php($candidates->loadMissing(['country', 'state']))

<div class="row d-flex justify-content-center row-cols-md-2 row-cols-1">
    @foreach ($candidates as $candidate)
        <div class="col">
            <div class="twm-candidates-list-style1">
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
                    <div class="twm-fot-content">
                        <div class="twm-left-info">
                            @if ($candidate->address)
                                <p class="twm-candidate-address">
                                    <i class="feather-map-pin"></i>{{ $candidate->state->name ? $candidate->state->name . ', ' : null }}{{ $candidate->country->code }}
                                </p>
                            @endif
                        </div>
                        @if (! JobBoardHelper::isDisabledPublicProfile())
                            <div class="twm-right-btn">
                                <a href="{{ $candidate->url }}" class="twm-view-prifile site-text-primary">{{ __('View Profile') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
