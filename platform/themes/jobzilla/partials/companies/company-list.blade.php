<div class="twm-employer-list-wrap">
    <ul>
        @forelse($companies as $company)
            <li>
                <div class="twm-employer-list-style1 mb-5">
                    <div class="twm-media">
                        <img src="{{ RvMedia::getImageUrl($company->logo) }}" alt={{ $company->name }}>
                    </div>
                    <div class="twm-mid-content">
                        <a href="{{ $company->url }}" class="twm-job-title">
                            <h4>{!! BaseHelper::clean($company->name) !!}</h4>
                        </a>
                        <p class="twm-job-address">{!! BaseHelper::clean($company->address) !!}</p>
                    </div>
                    <div class="twm-right-content">
                        <div class="twm-jobs-vacancies">
                            <a class="btn-open-job-company" href="{{ $company->url }}">
                                {!! Theme::partial('job-count', compact('company')) !!}
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <p class="text-center">{{ __('No data available') }}</p>
        @endforelse
    </ul>
</div>
