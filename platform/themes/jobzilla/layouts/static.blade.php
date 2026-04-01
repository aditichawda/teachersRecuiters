{!! Theme::partial('header') !!}

@if (Theme::get('withPageHeader', true))
    {!! Theme::partial('page-header') !!}
@endif

{!! Theme::content() !!}

{!! Theme::partial('footer') !!}
