<div class="section-full p-t120 p-b90 site-bg-white pos-relative twm-bdr-bottom-1">
    <div class="container">
        <div class="section-head center wt-small-separator-outer">
            @if($title = $shortcode->title)
                <div class="wt-small-separator site-text-primary">
                    <div>{!! BaseHelper::clean($title) !!}</div>
                </div>
            @endif

            @if($subtitle = $shortcode->subtitle)
                <h2 class="wt-title">{!! BaseHelper::clean($subtitle) !!}</h2>
            @endif

        </div>
        <div class="section-content">
            <div class="twm-jobs-grid-h5-wrap">
                <div class="row">
                    @foreach($jobs as $job)
                        <div class="col-lg-4 col-md-6">
                        <div class="twm-jobs-st5  m-b30">
                            <div class="twm-jobs-amount">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                            <div class="twm-job-st5-top">
                                <div class="twm-media">
                                    <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->company_name ?: $job->name }}">
                                </div>
                                <div class="twm-com-info">
                                    @if ($job->location)
                                        <p class="twm-job-address">{{ $job->location }}</p>
                                    @endif
                                    @if ($job->has_company)
                                        <a href="{{ $job->company_url }}" class="twm-job-com-name site-text-primary">
                                            {{ $job->company_name }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="twm-mid-content">
                                <a href="{{ $job->url }}" class="twm-job-title">
                                    <h4>{{ $job->name }}</h4>
                                </a>
                                <div class="twm-job-duration">
                                    <ul>
                                        <li>
                                            <span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i>
                                             @if($job->jobTypes->isNotEmpty())
                                                @foreach($job->jobTypes as $jobType)
                                                    {{ $jobType->name }}@if (!$loop->last), @endif
                                                @endforeach
                                            @endif
                                            </span>
                                        </li>
                                        <li>
                                            <span class="twm-job-post-duration"><i class="far fa-clock"></i>{{ $job->created_at->diffForHumans() }}</span>
                                        </li>
                                    </ul>
                                </div>
                                @if ($description = $job->description)
                                    <p title="{{ $description }}">{{ Str::limit($description) }}</p>
                                @endif
                            </div>

                            <div class="twm-right-content">
                                @if($job->applicants->isNotEmpty())
                                    <div class="twm-candi-thum-content">
                                        <div class="twm-pics">
                                            @foreach($job->applicants as $applicant)
                                                <span><img src="{{ $applicant->account->avatar_url }}" alt="{{$applicant->name}}"></span>
                                            @endforeach
                                            <div class="tot-view"><b>{{ $job->applicants->count() }}<i>+</i></b></div>
                                        </div>
                                    </div>
                                @endif
                                <a href="{{ $job->url }}" class="twm-jobs-browse site-text-primary">{{ __('Apply Job') }}</a>
                            </div>

                            @if ($job->tags)
                                <div class="twm-jobs-category outline">
                                    @foreach($job->tags as $tag)
                                        <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="twm-bg-shape5-left"></div>
</div>
