<div class="col-lg-4 col-md-6">
    <div class="card text-center mb-4">
        <div class="card-body px-4 py-5">
            @if ($company->is_featured)
                <div class="featured-label">
                    <span class="featured">{{ __('featured') }}</span>
                </div>
            @endif
            <img src="{{ RvMedia::getImageUrl($company->logo_thumb) }}" height="55" alt="logo" class="rounded-3">
            <div class="mt-4">
                <a href="{{ $company->url }}" class="primary-link">
                    <h6 class="fs-18 mb-2">{{ $company->name }} {!! $company->badge !!}</h6>
                </a>
                <div class="rating_wrap d-inline-block">
                    <div class="rating">
                        <div class="company_rate" style="width: {{ $company->reviews_avg * 20 }}%"></div>
                    </div>
                </div>
                <span>({{ __(':count reviews', ['count' => $company->reviews_count]) }})</span>
            @if ($company->state_name) <p class="text-muted mb-4">{{ $company->state_name }}</p> @endif
                <a href="{{ $company->url }}" class="btn btn-outline-primary">{{ __(':total Job Openings', ['total' => $company->jobs_count]) }}</a>
            </div>
        </div>
    </div>
</div><!--end col-->
