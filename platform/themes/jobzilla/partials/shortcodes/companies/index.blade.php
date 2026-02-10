@php
    Theme::asset()->container('footer')->usePath()->add('company-js', 'js/company.js');
    $orderByParams = JobBoardHelper::getSortByParams();
    $layout = request()->query('layout') ?: $shortcode->style;
@endphp

{!! Theme::partial('company-card-styles') !!}

<style>
.companies-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.companies-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
    display: inline-block;
}
.companies-heading h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    border-radius: 4px;
    margin: 10px auto 0;
}
.companies-heading p {
    font-size: 15px;
    color: #64748b;
}
.companies-toolbar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 20px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.companies-toolbar .woocommerce-result-count-left {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}
.companies-toolbar select {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 7px 12px;
    font-size: 13px;
    color: #475569;
    background: #f8fafc;
    cursor: pointer;
    transition: all .2s;
    -webkit-appearance: auto;
}
.companies-toolbar select:focus {
    border-color: #0ea5e9;
    outline: none;
    box-shadow: 0 0 0 3px rgba(14,165,233,.1);
}
@media(max-width: 767px) {
    .companies-heading h2 { font-size: 24px; }
    .companies-toolbar { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container companies">
        <div class="companies-heading">
            <h2>{{ __('Companies') }}</h2>
            <p>{{ __('Explore top schools and institutions hiring teachers') }}</p>
        </div>

        <div class="row">
            <div class="companies-toolbar product-filter-wrap company-option-wrap">
                <div>
                    <span class="woocommerce-result-count-left">
                        {{ __('Showing :from – :to of :total results', [
                            'from' => $companies->firstItem(),
                            'to' => $companies->lastItem(),
                            'total' => $companies->total(),
                        ]) }}
                    </span>
                </div>
                <div class="option-company-mobile" style="display: none;">
                    {!! Theme::partial('companies.option-company-mobile', compact('shortcode')) !!}
                </div>
                <form class="woocommerce-ordering twm-filter-select option-company d-flex gap-2 align-items-center" method="get">
                    <select class="wt-select-bar-2 selectpicker select-sort-by" data-live-search="true" data-bv-field="size">
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
