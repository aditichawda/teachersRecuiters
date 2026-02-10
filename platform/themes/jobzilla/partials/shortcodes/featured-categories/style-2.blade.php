<div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area2">
    <!-- TITLE START-->
    <div class="section-head center wt-small-separator-outer">
        <div class="wt-small-separator site-text-primary">
            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
        </div>
        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
    </div>
    <!-- TITLE END-->

    <div class="container">
        <div class="twm-job-categories-section-2">
            <div class="job-categories-style1 m-b30">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-3 col-md-6">
                            <div class="job-categories-block-2 m-b30">
                                <div class="twm-media">
                                    @if ($iconImage = $category->getMetaData('icon_image', true))
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $category->name }}" width="64" height="64">
                                    @elseif ($icon = $category->getMetaData('icon', true))
                                        {!! BaseHelper::renderIcon($icon) !!}
                                    @endif
                                </div>
                                <div class="twm-content">
                                    <div class="twm-jobs-available">{{ __(':count Jobs', ['count' => number_format($category->active_jobs_count)]) }}</div>
                                    <a href="{{ $category->url }}">{{ $category->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center job-categories-btn">
                <a href="{{ JobBoardHelper::getJobCategoriesPageURL() }}" class="site-button">{{ __('All Categories') }}</a>
            </div>
        </div>
    </div>
</div>
