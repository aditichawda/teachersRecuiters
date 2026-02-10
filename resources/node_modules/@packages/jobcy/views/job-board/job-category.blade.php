@php
    Theme::set('pageTitle', $category->name);
@endphp

@if ($category->description)
    <div class="container-xl">
        <div class="page-description">{!! BaseHelper::clean(nl2br($category->description)) !!}</div>
    </div>
@endif

@include(Theme::getThemeNamespace('views.job-board.jobs'), [
    'jobs' => $jobs,
    'pageTitle' => $category->name,
    'withCategories' => false,
    'formUrl' => $category->url,
    'formAjaxUrl' => $category->url,
    'enableLazyLoading' => true,
])
