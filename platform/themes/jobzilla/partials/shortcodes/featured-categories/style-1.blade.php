<!-- JOBS CATEGORIES SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right">
                    <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                </div>
            </div>
        </div>

        <div class="twm-job-categories-section">
            <div class="job-categories-style1 m-b30">
                <div class="owl-carousel job-categories-carousel owl-btn-left-bottom">
                    @foreach ($categories as $category)
                        <div class="item ">
                            <div class="job-categories-block">
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
            <div class="text-right job-categories-btn">
                <a href="{{ JobBoardHelper::getJobCategoriesPageURL() }}" class="site-button">{{ __('All Categories') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- JOBS CATEGORIES SECTION END -->
