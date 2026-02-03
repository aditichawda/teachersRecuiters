@php
    $subtitle = preg_replace('/\{\{(.*)\}\}/', '<span class="text-clr-pink">${1}</span>', $shortcode->subtitle ?: '');
    $title = preg_replace('/\{\{(.*)\}\}/', '<span class="text-clr-pink">${1}</span>', $shortcode->title ?: '');
@endphp
<!--Banner Start-->
<div class="twm-home7-banner-section site-bg-white bg-cover"
     @if ($shortcode->bg_image_1) style="background-image: url({{ RvMedia::getImageUrl($shortcode->bg_image_1) }})" @endif>
    <div class="container">
        <div class="twm-home7-inner-section">
            <div class="twm-bnr-mid-section">
                <div class="twm-bnr-title-large">{!! BaseHelper::clean($title) !!}</div>
                <div class="twm-bnr-title-light">{!! BaseHelper::clean($subtitle) !!}</div>
                @if (is_plugin_active('job-board'))
                    {!! Theme::partial('shortcodes.search-bar.form') !!}
                @endif
                <div class="twm-bnr-discription">{!! BaseHelper::clean($shortcode->description) !!}</div>
            </div>

        </div>
        @if ($shortcode->browse_job)
            <div class="twm-bnr-bottom-section">
                <div class="twm-browse-jobs">{!! BaseHelper::clean($shortcode->browse_job) !!}</div>
            </div>
        @endif
    </div>

    <div class="twm-bnr-h-page7-jobs">
        <div class="twm-hed-title">
            <h4 class="twm-title">{{ __('jobs at a glance') }}</h4>
        </div>
        <div class="twm-bnr-h7-carousal">
            <div class="swiper h-page7-jobs-slider">
                <div class="swiper-wrapper">
                    @foreach ($jobCategories as $jobCategory)
                        <div class="swiper-slide">
                            <div class="job-categories-home-7">
                                <div class="job-categories-home-7-top">
                                    <div class="twm-media cat-bg-clr-3">
                                        <div class="flaticon-hr"></div>
                                    </div>
                                    <div class="twm-content">
                                        <div class="twm-jobs-available">{{ $jobCategory->jobs_count }}</div>
                                    </div>
                                </div>
                                <a href="{{ JobBoardHelper::getJobsPageURL() }}" title="{{ $jobCategory->name }}">{{ Str::limit($jobCategory->name, 17) }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--Banner End-->
