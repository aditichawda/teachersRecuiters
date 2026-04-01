@php
    Theme::set('pageTitle', $tag->name);
@endphp

@if ($tag->description)
    <div class="container-xl">
        <div class="page-description">{!! BaseHelper::clean(nl2br($tag->description)) !!}</div>
    </div>
@endif


@include(Theme::getThemeNamespace('views.job-board.jobs'), [
    'jobs' => $jobs,
    'pageTitle' => $tag->name,
    'formUrl' => $tag->url,
    'formAjaxUrl' => route('public.ajax.jobs', ['job_tags' => [$tag->id]]),
])
