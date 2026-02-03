{!! Theme::partial('header') !!}

<main class="main-content" id="main-content">
    <div class="page-content" id="app">
        @if (Theme::get('withPageHeader', true))
            {!! Theme::partial('page-header') !!}
        @endif
        <section class="section static-layout-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        {!! Theme::content() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

{!! Theme::partial('footer') !!}
