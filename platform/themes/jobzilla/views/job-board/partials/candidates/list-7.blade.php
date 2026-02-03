@php($candidates->loadMissing(['country', 'state']))
<div class="row d-flex justify-content-center m-b30">
    @foreach ($candidates as $candidate)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="twm-candidates-grid-h-page7 m-b30">
                <div class="twm-top-section-content">
                    <div class="twm-media">
                        <div class="twm-media-pic">
                            <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
                        </div>
                    </div>
                    <div class="twm-mid-content">
                        @if ($candidate->is_featured)
                            <div class="twm-candidates-tag"><span>{{ __('Featured') }}</span></div>
                        @endif
                        <a href="{{ $candidate->url }}" class="twm-job-title">
                            <h4>{{ $candidate->name }}</h4>
                        </a>
                        <p>{!! Str::limit(BaseHelper::clean($candidate->description), 45) !!}</p>
                    </div>
                </div>
                <div class="twm-fot-content">
                    <div class="twm-left-info">
                        @if ($candidate->address)
                            <p class="twm-candidate-address">
                                <i class="feather-map-pin"></i>{{ $candidate->state->name ? $candidate->state->name . ', ' : null }}{{ $candidate->country->code }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
