<!-- Recommended Jobs SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-recommended-Jobs-wrap7">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <!-- TITLE START-->
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div>{!! BaseHelper::clean($shortcode->title) !!}</div>
                        </div>
                        <h2 class="wt-title">{!! BaseHelper::clean($shortcode->subtitle) !!}</h2>
                    </div>
                    <!-- TITLE END-->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                    <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="site-button">{!! BaseHelper::clean($shortcode->button_name) !!}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="twm-recommended-Jobs-mid-wrap">
        <div class="twm-recommended-Jobs-mid">
            <div class="container">
                <div class="filter-carousal">
                    <!-- Filter Menu -->
                    <div class="twm-jobs-filter">
                        <ul class="btn-filter-wrap">
                            <li class="btn-filter btn-active" data-filter="*">{{ __('All') }}</li>
                            @foreach ($jobTypes as $type)
                                <li class="btn-filter" data-filter=".{{ $type->id }}">{{ $type->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Filter Menu -->

                    <!-- IMAGE CAROUSEL START -->
                    <div class="section-content ">
                        <div class="owl-carousel owl-carousel-filter mfp-gallery owl-btn-vertical-center">
                            @foreach ($jobs as $job)
                                <div class="item @if ($job->jobTypes) @foreach ($job->jobTypes as $jobType) {{ $jobType->id }} @endforeach @endif">
                                    <div class="hpage-7-featured-block">
                                        <div class="inner-content">
                                            <div class="top-content-wrap">
                                                <div class="top-content">
                                                    <span class="job-time">@if ($job->jobTypes) @foreach ($job->jobTypes as $jobType) {{ $jobType->name }} @endforeach @endif</span>
                                                    <span class="job-post-time">{{ $job->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="mid-content">
                                                    <div class="company-logo">
                                                        <img src="{{ $job->company->logo_thumb }}" alt="{{ $job->company_name }}">
                                                    </div>
                                                    <div class="company-info">
                                                        <a href="{{ $job->company_url }}" class="company-name">{{ $job->company_name }}</a>
                                                        <p class="company-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom-content">
                                                <a href="{{ $job->url }}">
                                                    <h4 class="job-name-title" title="{{ $job->name }}">{{ Str::limit($job->name,30) }}</h4>
                                                </a>
                                                <div class="job-payment">
                                                    {{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}
                                                </div>
                                            </div>
                                            <div class="aply-btn-area">
                                                <a href="{{ $job->url }}" class="aplybtn">
                                                    <i class="fa fa-check"></i>
                                                </a>
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
    </div>
</div>
<!-- Recommended Jobs SECTION END -->
