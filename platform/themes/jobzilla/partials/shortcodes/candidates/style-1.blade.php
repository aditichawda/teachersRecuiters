@php
    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();
    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

{!! Theme::partial('candidate-card-styles') !!}

<style>
.cand-heading {
    text-align: center;
    padding: 30px 0 10px;
}
.cand-heading h2 {
    font-size: 32px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
    display: inline-block;
}
.cand-heading h2::after {
    content: '';
    display: block;
    width: 50px;
    height: 4px;
    background: linear-gradient(135deg, #0369a1, #0ea5e9);
    border-radius: 4px;
    margin: 10px auto 0;
}
.cand-heading p {
    font-size: 15px;
    color: #64748b;
}
.cand-toolbar {
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
.cand-toolbar .woocommerce-result-count-left {
    font-size: 14px;
    color: #64748b;
    font-weight: 500;
}
.cand-toolbar select {
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
.cand-toolbar select:focus {
    border-color: #0ea5e9;
    outline: none;
    box-shadow: 0 0 0 3px rgba(14,165,233,.1);
}
@media(max-width: 767px) {
    .cand-heading h2 { font-size: 24px; }
    .cand-toolbar { flex-direction: column; align-items: flex-start; }
}
</style>

<div class="section-full p-t120 p-b90 site-bg-white">
    <div class="container">
        <div class="cand-heading">
            @if ($shortcode->title || $shortcode->subtitle)
                @if ($shortcode->subtitle)
                    <h2>{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                @endif
                @if ($shortcode->title)
                    <p>{!! BaseHelper::clean($shortcode->title) !!}</p>
                @endif
            @else
                <h2>{{ __('Candidates') }}</h2>
                <p>{{ __('Find talented teachers ready to make a difference') }}</p>
            @endif
        </div>

        <div class="section-content">
            <div class="candidates">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="cand-toolbar product-filter-wrap">
                            <span class="woocommerce-result-count-left">
                                @if ($candidates->total())
                                    {{ __('Showing :from – :to of :total results', [
                                        'from'  => $candidates->firstItem(),
                                        'to'    => $candidates->lastItem(),
                                        'total' => $candidates->total(),
                                    ]) }}
                                @endif
                            </span>
                            <div class="option-candidate-mobile" style="display: none;">
                                {!! Theme::partial('candidates.option-candidate-mobile', compact('shortcode')) !!}
                            </div>
                            <form class="woocommerce-ordering twm-filter-select option-candidate d-flex gap-2 align-items-center">
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

                        @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => $shortcode->layout ])

                        {!! Form::open(['url' => route('public.ajax.candidates'), 'method' => 'GET', 'id' => 'candidate-filter-form']) !!}
                        <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page')) }}">
                        <input type="hidden" name="page" value="{{ BaseHelper::stringify(request()->query('page')) }}">
                        <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->style ?: 'grid') }}">
                        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
