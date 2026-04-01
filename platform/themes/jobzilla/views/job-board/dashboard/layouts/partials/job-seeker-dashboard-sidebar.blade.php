{{-- Job seeker sidebar for employer-style dashboard shell (emp-new-layout / enl-*) --}}
@php
    $currentUrl = url()->current();
    $jobSeekerProfileFields = [
        ['field' => 'first_name', 'label' => __('Full Name'), 'filled' => ! empty($account->first_name)],
        ['field' => 'phone', 'label' => __('Mobile Number'), 'filled' => ! empty($account->phone)],
        ['field' => 'avatar', 'label' => __('Profile Photo'), 'filled' => ! empty($account->avatar_id)],
        ['field' => 'bio', 'label' => __('About / Bio'), 'filled' => ! empty($account->bio)],
        ['field' => 'resume', 'label' => __('Resume'), 'filled' => ! empty($account->resume)],
        ['field' => 'address', 'label' => __('Location/Address'), 'filled' => ! empty($account->address)],
    ];
    $filledJs = collect($jobSeekerProfileFields)->where('filled', true)->count();
    $jobSeekerCompletion = count($jobSeekerProfileFields) > 0
        ? round(($filledJs / count($jobSeekerProfileFields)) * 100)
        : 0;
    $myPublicProfileUrl = $account->isJobSeeker() ? $account->url : '';
@endphp
<div class="text-center">
    <div class="enl-avatar-wrap" style="cursor:pointer;" onclick="document.getElementById('enlAvatarModal').style.display='flex'">
        <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="enl-avatar">
        <span class="enl-avatar-cam" title="{{ __('Change Photo') }}">
            <i class="fa fa-camera"></i>
        </span>
    </div>
    <h5 class="enl-name">{{ __('Hello') }}, {{ $account->first_name ?? $account->name }}</h5>
    <p class="enl-date">{{ __('Joined') }} {{ $account->created_at->format('M d, Y') }}</p>
    <p class="enl-updated">{{ __('Last Updated:') }} {{ $account->updated_at->format('M d, Y') }}</p>
    @if($myPublicProfileUrl)
        <a href="{{ $myPublicProfileUrl }}" target="_blank" rel="noopener" class="enl-view-btn" style="display:inline-block;text-decoration:none;">
            <i class="fa fa-external-link-alt"></i> {{ __('View Profile') }}
        </a>
    @else
        <a href="{{ url(route('public.account.settings')) }}" class="enl-view-btn" style="display:inline-block;text-decoration:none;">
            <i class="fa fa-user-edit"></i> {{ __('Complete profile for public link') }}
        </a>
    @endif
</div>

@if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
    <div class="enl-credits" onclick="document.getElementById('enlProfileModal').style.display='flex'" style="cursor:pointer;">
        <i class="fa fa-wallet"></i>
        <span>{{ __('Credits:') }}:</span>
        <span class="enl-credits-val">{{ format_credits_short($account->credits ?? 0) }}</span>
    </div>
@endif

<div class="enl-completion">
    <h6>{{ __('Profile Completion') }}</h6>
    <div class="enl-comp-bar">
        <div class="enl-comp-fill" style="width: {{ $jobSeekerCompletion }}%"></div>
    </div>
    <span class="enl-comp-text" onclick="document.getElementById('enlProfileModal').style.display='flex'">{{ $jobSeekerCompletion }}% {{ __('Complete') }}</span>
</div>

<ul class="enl-nav">
    <li>
        <a href="{{ route('public.account.jobseeker.dashboard') }}" @class(['active' => $currentUrl == route('public.account.jobseeker.dashboard')])>
            <i class="fa fa-home"></i> {{ __('Dashboard') }}
        </a>
    </li>
    <li>
        <a href="{{ url(route('public.account.settings')) }}" @class(['active' => $currentUrl == route('public.account.settings')])>
            <i class="fa fa-user"></i> {{ __('My Profile') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.jobs.saved') }}" @class(['active' => $currentUrl == route('public.account.jobs.saved')])>
            <i class="fa fa-bookmark"></i> {{ __('Saved Jobs') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.jobs.applied-jobs') }}" @class(['active' => $currentUrl == route('public.account.jobs.applied-jobs')])>
            <i class="fa fa-file-alt"></i> {{ __('Applied Jobs') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.experiences.index') }}" @class(['active' => str_contains($currentUrl, 'experience')])>
            <i class="fa fa-briefcase"></i> {{ __('Experience') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.educations.index') }}" @class(['active' => str_contains($currentUrl, 'education')])>
            <i class="fa fa-graduation-cap"></i> {{ __('Education') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.interests-achievements') }}" @class(['active' => str_contains($currentUrl, 'interests-achievements')])>
            <i class="fa fa-star"></i> {{ __('Interests & Achievements') }}
        </a>
    </li>
    <li>
        <a href="{{ url(route('public.account.jobseeker.wallet')) }}" @class(['active' => $currentUrl == url(route('public.account.jobseeker.wallet'))])>
            <i class="fa fa-wallet"></i> {{ __('Wallet') }}
            @if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
                <span style="background:#0073d1;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ format_credits_short($account->credits ?? 0) }}</span>
            @endif
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.invoices.index') }}" @class(['active' => str_contains($currentUrl, '/account/invoices')])>
            <i class="fa fa-file-invoice"></i> {{ __('Invoices') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.resume-builder') }}" @class(['active' => str_contains($currentUrl, 'resume-builder')])>
            <i class="fa fa-file-pdf"></i> {{ __('Resume Builder') }}
        </a>
    </li>
    <li>
        <a href="{{ route('public.account.security') }}" @class(['active' => $currentUrl == route('public.account.security')])>
            <i class="fa fa-lock"></i> {{ __('Security') }}
        </a>
    </li>
</ul>
