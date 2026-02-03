<!-- JOBS CATEGORIES SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-job-categories-area3">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                        </div>
                        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                    <a href="{{ JobBoardHelper::getJobCategoriesPageURL() }}" class="site-button">{{ __('All Categories') }}</a>
                </div>
            </div>
        </div>
        <div class="twm-job-categories-section-3 m-b30">
            <div class="job-categories-style3">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 m-b30">
                            <div class="job-categories-3-wrap">
                                <div class="job-categories-3">
                                    <div class="twm-media">
                                        @if ($iconImage = $category->getMetaData('icon_image', true))
                                            <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $category->name }}" width="64" height="64">
                                        @elseif ($icon = $category->getMetaData('icon', true))
                                            {!! BaseHelper::renderIcon($icon) !!}
                                        @endif
                                    </div>
                                    <div class="twm-content">
                                        <div class="twm-jobs-available">{{ __(':count Jobs', ['count' => number_format($category->active_jobs_count)]) }}</div>
                                        <a href="{{ $category->url }}">{!! Str::limit(BaseHelper::clean($category->name), 12) !!}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
