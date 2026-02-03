@php
    Theme::set('pageTitle', $candidate->name);
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'))
@endphp

{!! Theme::partial('page-header') !!}

<!-- OUR BLOG START -->
<div class="section-full  p-t120 p-b90 bg-white">
    <div class="container">
        <!-- BLOG SECTION START -->
        <div class="section-content">
            <div class="row d-flex justify-content-center">
                <div class="@if (JobBoardHelper::canViewCandidateInformation()) col-lg-8 @else col-lg-12 @endif col-md-12">
                    <!-- Candidate detail START -->
                    <div class="cabdidate-de-info">
                        <div class="twm-candi-self-wrap overlay-wraper"
                            style="background-image:url({{ Theme::asset()->url('images/candidate-bg.jpg') }});">
                            <div class="overlay-main site-bg-primary opacity-01"></div>
                            <div class="twm-candi-self-info">
                                <div class="twm-candi-self-top">
                                    <div class="twm-media">
                                        <img src="{{ $candidate->avatar_url }}" alt="{{ $candidate->name }}">
                                    </div>
                                    <div class="twm-mid-content">
                                        <h4 class="twm-job-title">{{ $candidate->name }}</h4>
                                        <p>{!! BaseHelper::clean($candidate->description) !!}</p>
                                    </div>
                                </div>
                                @if (JobBoardHelper::canViewCandidateInformation())
                                    <div class="twm-candi-self-bottom">
                                        @if ($candidate->phone)
                                            <a href="tel:{{ $candidate->phone }}" class="site-button outline-white">{{ __('Hire Me Now') }}</a>
                                        @endif
                                        @if (!$candidate->hide_cv && $candidate->resume)
                                            <a href="{{ $candidate->resume_url }}" download class="site-button secondry">{{ __('Download CV') }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h4 class="twm-s-title">{{ __('About Me') }}</h4>

                        <div class="ck-content">
                            {!! BaseHelper::clean($candidate->bio) !!}
                        </div>

                        @if ($experiences->isNotEmpty())
                            <h4 class="twm-s-title">{{ __('Work Experience') }}</h4>
                            <div class="twm-timing-list-wrap">
                                @foreach ($experiences as $experience)
                                    <div class="twm-timing-list">
                                        <div class="twm-time-list-date">{{ __(':from to :to', [
                                            'from' => $experience->started_at->format('Y'),
                                            'to' => $experience->ended_at ? $experience->ended_at->format('Y'): __('Now'),
                                        ]) }}</div>
                                        <div class="twm-time-list-title">{{ $experience->company }}</div>
                                        @if ($experience->position)
                                            <div class="twm-time-list-position">{{ $experience->position }}</div>
                                        @endif
                                        <div class="twm-time-list-discription">
                                            <p>{!! BaseHelper::clean($experience->description) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($educations->isNotEmpty())
                            <h4 class="twm-s-title">{{ __('Education & Training') }}</h4>
                            <div class="twm-timing-list-wrap">
                                @foreach ($educations as $education)
                                    <div class="twm-timing-list">
                                        <div class="twm-time-list-date">{{ __(':from to :to', [
                                                'from' => $education->started_at->format('Y'),
                                                'to' => $education->ended_at ? $education->ended_at->format('Y'): __('Now'),
                                            ]) }}</div>
                                        @if ($education->school)
                                            <div class="twm-time-list-title">{{ $education->school }}</div>
                                        @endif
                                        @if ($education->specialized)
                                            <div class="twm-time-list-position">{{ $education->specialized }}</div>
                                        @endif
                                        <div class="twm-time-list-discription">
                                            <p>{!! BaseHelper::clean($education->description) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                @if (JobBoardHelper::canViewCandidateInformation())
                    <div class="col-lg-4 col-md-12">
                        <div class="side-bar-2">
                            <div class="twm-s-info-wrap mb-5">
                                <h4 class="section-head-small mb-4">{{ __('Profile Info') }}</h4>
                                <div class="twm-s-info">
                                    <ul>
                                        @if ($candidate->gender)
                                            <li>
                                                <div class="twm-s-info-inner">
                                                    <i class="fas fa-venus-mars"></i>
                                                    <span class="twm-title">{{ __('Gender') }}</span>
                                                    <div class="twm-s-info-discription">{{ ucfirst($candidate->gender) }}</div>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($candidate->phone)
                                            <li>
                                                <div class="twm-s-info-inner">
                                                    <i class="fas fa-mobile-alt"></i>
                                                    <span class="twm-title">{{ __('Phone') }}</span>
                                                    <div class="twm-s-info-discription">{{ $candidate->phone }}</div>
                                                </div>
                                            </li>
                                        @endif
                                        @if ($candidate->email)
                                            <li>
                                                <div class="twm-s-info-inner">
                                                    <i class="fas fa-at"></i>
                                                    <span class="twm-title">{{ __('Email') }}</span>
                                                    <div class="twm-s-info-discription">{{ $candidate->email }}</div>
                                                </div>
                                            </li>
                                        @endif

                                        @if ($candidate->address)
                                            <li>
                                                <div class="twm-s-info-inner">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span class="twm-title">{{ __('Address') }}</span>
                                                    <div class="twm-s-info-discription">{{ $candidate->address }}</div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- OUR BLOG END -->
