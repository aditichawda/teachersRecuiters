@php($layout = \Theme\Jobzilla\Supports\ThemeHelper::getCurrentLayout())

{!! Theme::partial("jobs.$layout", ['jobs' => $jobs, 'style' => 2]) !!}
