<div class="col-lg-4 col-md-12">
    <div class="side-bar mb-4">
        <div class="twm-s-info2-wrap mb-5">
            <div class="twm-s-info2">
                <h4 class="section-head-small mb-4">{{ __('Job Information') }}</h4>
                <ul class="twm-job-hilites">
                    <li>
                        <i class="fas fa-eye"></i>
                        <span class="twm-title">{{ __(':view Views', ['view' => number_format($job->views)])}}</span>
                    </li>
                    <li>
                        <i class="fas fa-file-signature"></i>
                        <span class="twm-title">{{ __(':number Applicants', ['number' => $job->number_of_positions])}}</span>
                    </li>
                </ul>
                <ul class="twm-job-hilites2">
                    <li>
                        <div class="twm-s-info-inner">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="twm-title">{{ __('Date Posted') }}</span>
                            <div class="twm-s-info-discription">{{ Theme::formatDate($job->created_at) }}</div>
                        </div>
                    </li>
                    @if ($job->full_address)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="twm-title">{{ __('Location') }}</span>
                                <div class="twm-s-info-discription">{{ $job->full_address }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($job->categories->count())
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-user-tie"></i>
                                <span class="twm-title">{{ __('Industry') }}</span>
                                <div class="twm-s-info-discription">
                                    @foreach ($job->categories as $category)
                                        <span class="mb-0">{{ $category->name }}@if (!$loop->last), @endif</span>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endif
                    @if ($job->jobExperience->name)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-clock"></i>
                                <span class="twm-title">{{ __('Experience') }}</span>
                                <div class="twm-s-info-discription">{{ $job->jobExperience->name }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($job->careerLevel->name)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-suitcase"></i>
                                <span class="twm-title">{{ __('Qualification') }}</span>
                                <div class="twm-s-info-discription">{{ $job->careerLevel->name }}</div>
                            </div>
                        </li>
                    @endif
                    <li>
                        <div class="twm-s-info-inner">
                            <i class="fas fa-money-bill-wave"></i>
                            <span class="twm-title">{{ __('Offered Salary') }}</span>
                            <div class="twm-s-info-discription">{{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}</div>
                        </div>
                    </li>
                    @foreach ($job->customFields as $customField)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-check-circle"></i>
                                <span class="twm-title">{!! BaseHelper::clean($customField->name) !!}</span>
                                <div class="twm-s-info-discription">{!! BaseHelper::clean($customField->value) !!}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @if ($job->skills->count() > 0)
            <div class="widget job-tags tw-sidebar-tags-wrap">
                <h4 class="section-head-small mb-4">{{ __('Job Skills') }}</h4>
                <div class="tagcloud">
                    @foreach ($job->skills as $skill)
                       <span>{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($job->tags->count() > 0)
            <div class="widget tw-sidebar-tags-wrap">
                <h4 class="section-head-small mb-4">{{ __('Job Tags') }}</h4>
                <div class="tagcloud">
                    @foreach ($job->tags as $tag)
                        <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @if (! $job->hide_company && $company->id)
        <div class="twm-s-info3-wrap mb-5">
            <div class="twm-s-info3">
                <div class="twm-s-info-logo-section">
                    <div class="twm-media">
                        <img src="{{ $company->logo_thumb }}" alt="{{ $company->name }}">
                    </div>
                    <h4 class="twm-title">{{ $company->name }}</h4>
                </div>
                <ul>
                    @if ($company->year_founded)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-building"></i>
                                <span class="twm-title">{{ __('Year founded') }}</span>
                                <div class="twm-s-info-discription">{{ $company->year_founded }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($company->phone)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-mobile-alt"></i>
                                <span class="twm-title">{{ __('Phone') }}</span>
                                <div class="twm-s-info-discription">{{ $company->phone }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($company->email)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-at"></i>
                                <span class="twm-title">{{ __('Email') }}</span>
                                <div class="twm-s-info-discription">{{ $company->email }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($company->website)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-desktop"></i>
                                <span class="twm-title">{{ __('Website') }}</span>
                                <div class="twm-s-info-discription">{{ $company->website }}</div>
                            </div>
                        </li>
                    @endif
                    @if ($company->full_address)
                        <li>
                            <div class="twm-s-info-inner">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="twm-title">{{ __('Address') }}</span>
                                <div class="twm-s-info-discription">{{ $company->full_address }}</div>
                            </div>
                        </li>
                    @endif
                </ul>
                <a href="{{ $company->url }}" class="site-button">{{ __('View Profile') }}</a>
            </div>
        </div>
    @endif

    {!! dynamic_sidebar('job_board_sidebar') !!}
</div>
