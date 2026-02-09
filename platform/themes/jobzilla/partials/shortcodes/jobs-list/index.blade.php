@php
    $style = (int)$shortcode->style;
    $perRow = (int)$shortcode->per_row ?: 3;
@endphp

<div @class(['section-full p-t0 p-b90', 'site-bg-light-purple twm-bg-ring-wrap' => $style === 1, 'site-bg-gray twm-bg-ring-wrap2' => $style === 2])>
    <div class="twm-bg-ring-right"></div>
    <div class="twm-bg-ring-left"></div>
    <div class="container">
        @switch((int)$shortcode->style)
            @case(1)
                <div class="section-head center wt-small-separator-outer">
                    <div class="wt-small-separator site-text-primary">
                        <div>{!! BaseHelper::clean($shortcode->subtitle) !!}</div>
                    </div>
                    <h2 class="wt-title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>

                <div class="section-content">
                    <div class="twm-jobs-list-wrap">
                        {!! Theme::partial('jobs.list', compact('jobs')) !!}
                        <div class="text-center m-b30">
                            <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="site-button">{{ __('Browse All Jobs') }}</a>
                        </div>
                    </div>
                </div>
                @break
            @case(2 || 3)
                <div class="wt-separator-two-part">
                    <div class="row wt-separator-two-part-row">
                        <div class="col-xl-8 col-lg-6 col-md-12 wt-separator-two-part-left">
                            <div class="section-head left wt-small-separator-outer">
                                <div class="wt-small-separator site-text-primary">
                                    <div>{!! BaseHelper::clean($shortcode->subtitle) !!}</div>
                                </div>
                                <h2 class="wt-title">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                            <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="site-button">{{ __('Vew More') }}</a>
                        </div>
                    </div>
                </div>

                <div class="section-content">
                    <div class="twm-jobs-grid-wrap">
                        {!! Theme::partial('jobs.grid', ['jobs' => $jobs, 'style' => $style, 'class' => 'col-lg-' . (12 / $perRow)]) !!}
                    </div>
                </div>
                @break
        @endswitch
    </div>
</div>

