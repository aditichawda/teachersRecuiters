{!! Theme::partial('header') !!}

<main class="main-content" id="main-content">
    <div class="page-content" id="app">
        @if (Theme::get('withPageHeader', true))
            {!! Theme::partial('page-header') !!}
        @endif
        {!! Theme::content() !!}
    </div>
</main>

{!! Theme::partial('footer') !!}
