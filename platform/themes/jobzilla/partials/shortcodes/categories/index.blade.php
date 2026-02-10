<div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                        </div>
                        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right">
                    <p>{!! BaseHelper::clean($shortcode->description) !!}</p>
                </div>
            </div>
        </div>

        <div class="twm-job-categories-section">
            <div class="owl-btn-left-bottom">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="item col-xl-4 col-md-6 px-4 py-4">
                            <div class="job-categories-block">
                                <div class="twm-media">
                                    @if ($iconImage = $category->getMetaData('icon_image', true))
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $category->name }}" width="64" height="64">
                                    @elseif ($icon = $category->getMetaData('icon', true))
                                        <i class="{{ $icon }}"></i>
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
                {!! $categories->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
        </div>
    </div>
</div>
