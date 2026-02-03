@php
    $applicationCount = $applications->count();
@endphp

@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <div class="twm-right-section-panel candidate-save-job site-bg-gray">
        <div class="product-filter-wrap d-flex justify-content-between align-items-center">
            <span class="woocommerce-result-count-left">{{ __('Applied :number :unit', ['number' => $applicationCount, 'unit' => $applicationCount > 0 ? 'jobs' : 'job']) }}</span>
            <form class="woocommerce-ordering twm-filter-select apply-job-option" action="{{ URL::current() }}" method="GET">
                <select class="wt-select-bar-2 selectpicker option-order-by" name="order_by"  data-live-search="true" data-bv-field="size">
                    <option value="default">{{ __('Default') }}</option>
                    <option value="newest">{{ __('Newest') }}</option>
                    <option value="oldest">{{ __('Oldest') }}</option>
                    <option value="random">{{ __('Random') }}</option>
                </select>
            </form>
        </div>

        <div class="twm-jobs-list-wrap">
            <ul>
                @forelse ($applications as $application)
                    <li>
                        {!! Theme::partial('jobs.style-1', ['job' => $application->job]) !!}
                    </li>
                @empty
                    <p class="text-center">{{ __('No data available') }}</p>
                @endforelse
            </ul>
            {{ $applications->links(Theme::getThemeNamespace('partials.pagination')) }}
        </div>

    </div>
@endsection
