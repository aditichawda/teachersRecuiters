@php
    $map_title = preg_replace('/\{\{(.*)\}\}/', '<span class="site-text-primary">${1}</span>', $shortcode->map_title ?: '');

    Theme::asset()->container('footer')->usePath()->add('candidate-js', 'js/candidate.js');
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

<div class="section-full p-t60 p-b90 site-bg-white twm-candidate-h-page7-wrap pos-relative ">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
            </div>
            <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>

        </div>
        <!-- TITLE END-->
    </div>

    <div class="container-fluid">
        <div class="section-content">
            <div class="twm-candidate-h-page7">
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

    <div class="twm-bg-candi-pattern" @if ($shortcode->bg_image) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image) }});" @endif></div>

    @if ($shortcode->map_title)
        <div class="container">
            <div class="twm-j-ofr-wrap">
                <div class="twm-j-ofr-content" @if ($shortcode->bg_map_image) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_map_image) }});" @endif>
                    <div class="row">
                        <div class="col-lg-7 col-md-12">

                            <div class="twm-j-ofr-map-content">
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <h2 class="wt-title">{!! BaseHelper::clean($map_title) !!}</h2>
                                </div>
                                <!-- TITLE END-->

                                <div class="twm-j-ofr-map-list">
                                    <ul>
                                        @foreach ($tabs as $tab)
                                            <li>
                                                <div class="flag-list">
                                                    @if (Arr::get($tab, 'image'))
                                                        <span><img src="{{ RvMedia::getImageUrl(Arr::get($tab, 'image')) }}" alt="{{ Arr::get($tab, 'title') }}"></span>
                                                    @endif
                                                    <h4 class="flat-name">{{ Arr::get($tab, 'title') }}</h4>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="twm-read-more">
                                    <a href="{{ JobBoardHelper::getJobCandidatesPageURL() }}" class="site-button">{{ __('More Offers') }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="twm-j-ofr-map">
                                <div class="twm-media">
                                    @if ($shortcode->map_image)
                                        <img src="{{ RvMedia::getImageUrl($shortcode->map_image) }}" alt="{{ __('Map Images') }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
