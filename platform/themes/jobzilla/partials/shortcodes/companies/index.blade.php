@php
    Theme::asset()->container('footer')->usePath()->add('company-js', 'js/company.js');
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->style;
@endphp
<div class="section-full p-t120  p-b90 site-bg-white">
    <div class="container companies">
        <div class="row">
            <div class="product-filter-wrap company-option-wrap d-flex justify-content-between align-items-center m-b30">
                <div>
                    <span class="woocommerce-result-count-left">
                        {{
                            __('Showing :from – :to of :total job(s)', [
                                'from' => $companies->firstItem(),
                                'to' => $companies->lastItem(),
                                'total' => $companies->total(),
                            ])
                        }}
                    </span>
                </div>
                <div class="option-company-mobile" style="display: none;">
                    {!! Theme::partial('companies.option-company-mobile', compact('shortcode')) !!}
                </div>
                <form class="woocommerce-ordering twm-filter-select option-company" method="get">
                    <span class="woocommerce-result-count">{{ __('Sort By') }}</span>
                    <select class="wt-select-bar-2 selectpicker select-sort-by"  data-live-search="true" data-bv-field="size">
                        @foreach($orderByParams as $key => $value)
                            <option @selected(request()->query('sort_by', Arr::first(array_keys($orderByParams)))) value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>

                    <select class="wt-select-bar-2 selectpicker select-per-page" name="per-page" data-live-search="true" data-bv-field="size">
                        @foreach(JobBoardHelper::getPerPageParams() as $page)
                            <option @selected(request()->query('per_page') == $page) value="{{ $page }}">{{ __('Show :number', ['number' => $page]) }}</option>
                        @endforeach
                    </select>

                    <select class="wt-select-bar-2 selectpicker select-layout" name="layout" data-live-search="true" data-bv-field="size">
                            <option @selected($layout == 'grid') value="grid">{{ __('Grid') }}</option>
                            <option @selected($layout == 'list') value="list">{{ __('List') }}</option>
                    </select>
                </form>

            </div>
            <div class="companies-wrap">
                <div id="page-loading" style="display: none">
                    <div class="page-backdrop"></div>
                    <div class="page-loading"><div></div><div></div><div></div><div></div></div>
                </div>
                <div class="companies-content">
                    @switch($layout)
                        @case('list')
                            {!! Theme::partial('companies.company-list', compact('companies')) !!}
                        @break
                        @default
                            {!! Theme::partial('companies.company-grid', compact('companies')) !!}
                    @endswitch
                    {{ $companies->links(Theme::getThemeNamespace('partials.pagination')) }}
                </div>
            </div>

            {!! Form::open(['url' => route('public.ajax.companies'), 'method' => 'GET', 'id' => 'company-filter-form']) !!}
            <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page')) }}">
            <input type="hidden" name="page" value="{{ BaseHelper::stringify(request()->query('page')) }}">
            <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->style ?: 'grid') }}">
            <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
            {!! Form::close() !!}
        </div>
    </div>
</div>
