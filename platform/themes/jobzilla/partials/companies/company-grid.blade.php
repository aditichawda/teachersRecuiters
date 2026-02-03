@php($companies->loadMissing(['country', 'state']))

<div class="twm-employer-list-wrap">
    <div class="row">
        @forelse($companies as $company)
            <div class="col-lg-4 col-md-4">
                <div class="twm-employer-grid-style1 mb-5">
                    <div class="twm-media">
                        <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt="{{ $company->name }}">
                    </div>
                    <div class="twm-mid-content">
                        <a href="{{ $company->url }}" class="twm-job-title">
                            <h4>{!! BaseHelper::clean($company->name) !!}</h4>
                        </a>
                        <p class="twm-job-address">{{ $company->state->name ? $company->state->name . ', ' : null }}{{ $company->country->code }}</p>
                    </div>
                    <div class="twm-right-content">
                        <div class="twm-jobs-vacancies">
                            <a class="btn-open-job-company" href="{{ $company->url }}">
                                {!! Theme::partial('job-count', compact('company')) !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">{{ __('No data available') }}</p>
        @endforelse
    </div>
</div>
