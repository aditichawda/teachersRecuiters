@php
    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

{{-- Main Content --}}
<div class="candidates-main-section candidates-container">
    <div class="container">
        <div class="row">
            {{-- Sidebar Filters --}}
            <div class="col-lg-4 col-md-12 candidates-sidebar-modern">
                <div class="side-bar-filter">
                    <div class="backdrop"></div>
                    <div class="side-bar">
                        <div class="sidebar-elements search-bx">
                            <button class="d-md-none position-absolute btn btn-link btn-close-filter">
                                <i class="feather-x"></i>
                            </button>
                            <form action="{{ route('public.ajax.candidates') }}" method="get" id="candidate-filter-form" data-ajax-url="{{ route('public.ajax.candidates') }}">
                                {!! Theme::partial('candidates.filters.keyword') !!}
                                {!! Theme::partial('candidates.filters.city') !!}
                                {!! Theme::partial('candidates.filters.salary') !!}
                                {!! Theme::partial('candidates.filters.skills') !!}
                                {!! Theme::partial('candidates.filters.experiences') !!}
                                
                                <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page', 12)) }}">
                                <input type="hidden" name="page" value="1">
                                <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->layout ?: 'grid') }}">
                                <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                                
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); border: none; padding: 12px; border-radius: 8px; font-weight: 600;">
                                        <i class="feather-filter" style="margin-right: 6px;"></i>
                                        {{ __('Apply Filters') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Candidates Listings --}}
            <div class="col-lg-8 col-md-12 position-relative candidates-listing-modern">
                <div class="candidates-toolbar product-filter-wrap">
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button type="button" class="d-block d-md-none btn btn-open-filter">
                            <i class="feather-filter"></i>
                        </button>
                        <span class="woocommerce-result-count-left">
                            @if ($candidates->total())
                                {{ __('Showing :from – :to of :total results', [
                                    'from' => $candidates->firstItem(),
                                    'to' => $candidates->lastItem(),
                                    'total' => $candidates->total(),
                                ]) }}
                            @endif
                        </span>
                    </div>

                    <div class="woocommerce-ordering twm-filter-select gap-1">
                        <select class="wt-select-bar-2 selectpicker select-sort-by" name="sort_by">
                            @foreach($orderByParams as $key => $value)
                                <option value="{{ $key }}" @selected(request()->query('sort_by') == $key)>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker select-per-page" name="per_page">
                            @foreach(JobBoardHelper::getPerPageParams() as $item)
                                <option value="{{ $item }}" @selected(request()->query('per_page', 12) == $item)>{{ __('Show :number', ['number' => $item]) }}</option>
                            @endforeach
                        </select>
                        <select class="wt-select-bar-2 selectpicker select-layout" name="layout">
                            <option value="grid" @selected($layout == 'grid')>{{ __('Grid') }}</option>
                            <option value="list" @selected($layout == 'list')>{{ __('List') }}</option>
                        </select>
                    </div>
                </div>

                <div class="twm-candidates-list-wrap candidates-listing">
                    @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => $layout])
                </div>

                @if ($candidates instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="row">
                        <div class="col-lg-12 mt-4 pt-2">
                            {!! $candidates->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
