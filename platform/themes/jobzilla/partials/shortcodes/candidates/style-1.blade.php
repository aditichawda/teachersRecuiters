<div class="section-full p-t60 p-b90 site-bg-white">
    <div class="container">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="section-head center wt-small-separator-outer">
                @if ($shortcode->title)
                <div class="wt-small-separator site-text-primary">
                    <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                </div>
                @endif

                @if ($shortcode->subtitle)
                    <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                @endif
            </div>
        @endif

        <div class="section-content">
            @php
                Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
                $orderByParams = JobBoardHelper::getSortByParams();

                $layout = request()->query('layout') ?: $shortcode->layout;
            @endphp

            <div class="candidates">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
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

                            <form class="woocommerce-ordering twm-filter-select option-candidate">
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
                                    <option @selected($layout == 'gird') value="grid">{{ __('Gird') }}</option>
                                    <option @selected($layout == 'list') value="list">{{ __('List') }}</option>
                                </select>
                            </form>
                        </div>

                        @include(Theme::getThemeNamespace('views.job-board.partials.candidates.index'), ['layout' => $shortcode->layout ])

                        {!! Form::open(['url' => route('public.ajax.candidates'), 'method' => 'GET', 'id' => 'candidate-filter-form']) !!}
                        <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page')) }}">
                        <input type="hidden" name="page" value="{{ BaseHelper::stringify(request()->query('page')) }}">
                        <input type="hidden" name="layout" value="{{ BaseHelper::stringify(request()->query('layout') ?: $shortcode->style ?: 'gird') }}">
                        <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
