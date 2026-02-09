{!! Theme::partial('header') !!}

<main class="main-content" id="main-content">
    <div class="page-content" id="app">
        @if (Theme::get('withPageHeader', true))
            {!! Theme::partial('page-header') !!}
        @endif
        <section class="section static-layout-page py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="static-page-content card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-body p-4 p-md-5">
                                {!! Theme::content() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

{!! Theme::partial('footer') !!}
