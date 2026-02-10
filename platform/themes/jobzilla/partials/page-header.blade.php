<div
    class="wt-bnr-inr overlay-wraper bg-center"
    @if (Theme::get('pageCoverImage'))
        style="background-image:url('{{ RvMedia::getImageUrl(Theme::get('pageCoverImage')) }}');"
    @endif
>
    <div class="overlay-main site-bg-white opacity-01"></div>
    <div class="container">
        <div class="wt-bnr-inr-entry">
            <div class="banner-title-outer">
                <div class="banner-title-name">
                    <h2 class="wt-title">{{ Theme::get('pageTitle') ?: SeoHelper::getTitle() }}</h2>
                </div>
            </div>

            {!! Theme::partial('breadcrumbs') !!}
        </div>
    </div>
</div>
