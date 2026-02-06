@php
    $url = url()->current();
@endphp

<div class="side-bar-st-1">
    <div class="twm-candidate-profile-pic avatar-view">
        <div class="image-profile">
            <img src="{{ $account->avatar_url }}" id="profile-img" alt="{{ $account->name }}">
        </div>
        <div class="upload-btn-wrapper">
            <div id="upload-image-grid"></div>
            <button class="site-button button-sm">{{ __('Upload Avatar') }}</button>
        </div>
    </div>
    <div class="twm-mid-content text-center">
        <a href="{{ route('public.account.settings') }}" class="twm-job-title">
            <h4>{!! BaseHelper::clean($account->name) !!}</h4>
        </a>
        @if ($description = $account->description)
            <p>{!! BaseHelper::clean($description) !!}</p>
        @endif
    </div>

    <div class="twm-nav-list-1">
        <ul>
            @if ($account->isJobSeeker())
                <li @class(['active' => $url === route('public.account.jobseeker.dashboard')])><a href="{{ route('public.account.jobseeker.dashboard') }}"><i class="fa fa-home"></i>{{ __('Dashboard') }}</a></li>
            @endif
            <li @class(['active' => $url === route('public.account.settings')])><a href="{{ route('public.account.settings') }}"><i class="fa fa-user"></i>{{ __('My Profile') }}</a></li>
            <li @class(['active' => $url === route('public.account.overview')])><a href="{{ route('public.account.overview') }}"><i class="fa fa-eye"></i>{{ __('Overview') }}</a></li>
            <li @class(['active' => $url === route('public.account.security')])><a href="{{ route('public.account.security') }}"><i class="fa fa-fingerprint"></i>{{ __('Change Password') }}</a></li>
            @if ($account->isJobSeeker())
                <li @class(['active' => $url === route('public.account.jobs.applied-jobs')])><a href="{{ route('public.account.jobs.applied-jobs') }}"><i class="fa fa-suitcase"></i>{{ __('Applied Jobs') }}</a></li>
                <li @class(['active' => $url === route('public.account.jobs.saved')])><a href="{{ route('public.account.jobs.saved') }}"><i class="fa fa-file-download"></i>{{ __('Saved Jobs') }}</a></li>
                <li @class(['active' => $url === route('public.account.experiences.index')])><a href="{{ route('public.account.experiences.index') }}"><i class="fa fa-suitcase"></i>{{ __('Experiences') }}</a></li>
                <li @class(['active' => $url === route('public.account.educations.index')])><a href="{{ route('public.account.educations.index') }}"><i class="fa fa-graduation-cap"></i>{{ __('Educations') }}</a></li>
            @endif
        </ul>
    </div>
</div>
