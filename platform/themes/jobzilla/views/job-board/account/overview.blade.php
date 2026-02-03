@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <div class="container overview-wrap">
        <h3 class="title">{{ __('Overview') }}</h3>
        <div class="cabdidate-de-info">
            @if ($account->bio)
                <h4 class="twm-s-title">{{ __('About Me') }}</h4>

                {!! BaseHelper::clean($account->bio) !!}
            @endif

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

            @if ($account->salary_type || $account->salary_amount)
                <h4 class="twm-s-title">{{ __('Salary Expectations') }}</h4>
                <div class="twm-timing-list">
                    @if ($account->salary_type && $account->salary_amount)
                        <div class="twm-time-list-title">
                            ₹{{ number_format($account->salary_amount, 2) }} / 
                            @if($account->salary_type == 'yearly') {{ __('Yearly') }}
                            @elseif($account->salary_type == 'monthly') {{ __('Monthly') }}
                            @elseif($account->salary_type == 'weekly') {{ __('Weekly') }}
                            @elseif($account->salary_type == 'hourly') {{ __('Hourly') }}
                            @endif
                        </div>
                    @elseif ($account->salary_type)
                        <div class="twm-time-list-title">{{ __('Salary Type') }}: 
                            @if($account->salary_type == 'yearly') {{ __('Yearly') }}
                            @elseif($account->salary_type == 'monthly') {{ __('Monthly') }}
                            @elseif($account->salary_type == 'weekly') {{ __('Weekly') }}
                            @elseif($account->salary_type == 'hourly') {{ __('Hourly') }}
                            @endif
                        </div>
                    @elseif ($account->salary_amount)
                        <div class="twm-time-list-title">{{ __('Salary Amount') }}: ₹{{ number_format($account->salary_amount, 2) }}</div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

