@php
    $orderByParams = JobBoardHelper::getSortByParams();

    $layout = request()->query('layout') ?: $shortcode->layout;
@endphp

<div id="mySidebar" class="sidebar">
    <div class="header-sidebar">
        <a href="javascript:void(0)" class="btn-close-sidebar">
            <i class="feather-x"></i>
        </a>
        <p class="title">{{ __('Option') }}</p>
    </div>
    <div class="body-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <span class="option-title">{{ __('Sort By') }}</span>
                    <select class="wt-select-bar-2 selectpicker select-sort-by" style="width: 100%" data-live-search="true" data-bv-field="size">
                        @foreach($orderByParams as $key => $value)
                            <option @selected(request()->query('sort_by', Arr::first(array_keys($orderByParams)))) value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <span class="option-title">{{ __('Per page') }}</span>
                    <select class="wt-select-bar-2 selectpicker select-per-page" style="width: 100%" name="per-page" data-live-search="true" data-bv-field="size">
                        @foreach(JobBoardHelper::getPerPageParams() as $page)
                            <option @selected(request()->query('per_page') == $page) value="{{ $page }}">{{ __('Show :number', ['number' => $page]) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <span class="option-title">{{ __('Layout') }}</span>
                    <select class="wt-select-bar-2 selectpicker select-layout" style="width: 100%" name="layout" data-live-search="true" data-bv-field="size">
                        <option @selected($layout == 'grid') value="grid">{{ __('Grid') }}</option>
                        <option @selected($layout == 'list') value="list">{{ __('List') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main">
    <button class="btn btn-open-sidebar">
        {{ __('Option') }}
    </button>
</div>
