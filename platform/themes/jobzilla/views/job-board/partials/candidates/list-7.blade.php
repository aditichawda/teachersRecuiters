@php($candidates->loadMissing(['country', 'state']))

<div class="row">
    @foreach ($candidates as $candidate)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="cand-card-grid">
                @if ($candidate->is_featured)
                    <span class="cg-featured">{{ __('Featured') }}</span>
                @endif
                <div class="cg-avatar">
                    <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
                </div>
                <a href="{{ $candidate->url }}" class="cg-name">{{ $candidate->name }}</a>
                <p class="cg-desc">{!! Str::limit(BaseHelper::clean($candidate->description), 45) !!}</p>
                @if ($candidate->address)
                    <p class="cg-location">
                        <i class="feather-map-pin"></i> {{ $candidate->state->name ? $candidate->state->name . ', ' : '' }}{{ $candidate->country->code ?? '' }}
                    </p>
                @endif
            </div>
        </div>
    @endforeach
</div>
