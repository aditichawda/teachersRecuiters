@php
    $menuItems = DashboardMenu::getAll('account');
    $currentUrl = url()->current();
    $isCreateJobPage = $currentUrl == route('public.account.jobs.create');
    $account = auth('account')->user();
    $packageContext = null;
    $canPost = false;
    try {
        $packageContext = $account ? \Botble\JobBoard\Supports\PackageContext::forAccount($account) : null;
        $hasPurchasedPackage = false;
        if ($account && $account->isEmployer() && \Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem()) {
            $hasPurchasedPackage = \Botble\JobBoard\Models\Transaction::query()
                ->where('account_id', $account->getKey())
                ->where(function ($q): void {
                    $q->whereNull('type')->orWhere('type', '!=', 'deduct');
                })
                ->whereNotNull('payment_id')
                ->whereNotNull('package_id')
                ->exists();
        }
        $canPost = $account && (!$account->isEmployer() || !\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem() || ($hasPurchasedPackage && $packageContext && $packageContext->canPostJob($account)));
    } catch (\Throwable $e) {
        $canPost = false;
    }
@endphp

<style>
.ps-postjob-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    margin: 0 12px 10px 12px;
    background: linear-gradient(135deg, #0073d1, #005bb5);
    color: #fff !important;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none !important;
    transition: all 0.2s;
    justify-content: center;
}
.ps-postjob-btn:hover {
    background: linear-gradient(135deg, #005bb5, #003f8a);
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
}
.ps-postjob-btn i { font-size: 16px; }
.ps-postjob-btn.ps-postjob-locked {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: #fff !important;
}
.ps-postjob-btn.ps-postjob-locked:hover {
    background: linear-gradient(135deg, #c82333, #bd2130);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.35);
}
.ps-postjob-btn.ps-postjob-locked .ps-lock-wrap {
    width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0.2); border-radius: 6px;
}
.ps-postjob-btn.ps-postjob-locked .ps-lock-wrap i { font-size: 13px; }
</style>

{{-- Post Job Button (locked = red + padlock when no package; click goes to wallet) --}}
<a href="{{ $canPost ? route('public.account.jobs.create') : route('public.account.wallet') }}" class="ps-postjob-btn {{ $canPost ? '' : 'ps-postjob-locked' }}" title="{{ $canPost ? '' : trans('plugins/job-board::messages.insufficient_credits') }}">
    @if($canPost)
        <i class="fa fa-plus-circle"></i> {{ __('Post Job') }}
    @else
        <span class="ps-lock-wrap"><i class="fa fa-lock"></i></span> {{ __('Post Job') }}
    @endif
</a>
@if(optional(auth('account')->user())->isEmployer())
{{-- Admission Button (same lock as Post Job when no package/credits) --}}
<a href="{{ $canPost ? route('public.account.admission.edit') : route('public.account.wallet') }}" class="ps-postjob-btn {{ $canPost ? '' : 'ps-postjob-locked' }}" style="{{ $canPost ? 'background: linear-gradient(135deg, #059669, #047857);' : '' }} margin-top: 8px;" title="{{ $canPost ? '' : trans('plugins/job-board::messages.insufficient_credits') }}">
    @if($canPost)
        <i class="fa fa-graduation-cap"></i> {{ __('Admission') }}
    @else
        <span class="ps-lock-wrap"><i class="fa fa-lock"></i></span> {{ __('Admission') }}
    @endif
</a>
@endif

<ul class="menu">
    @foreach ($menuItems as $item)
        @continue(! $item['name'])
        @php
            $employerOnlyIds = ['cms-account-wallet', 'cms-account-packages'];
            if (in_array($item['id'] ?? '', $employerOnlyIds) && !optional(auth('account')->user())->isEmployer()) {
                continue;
            }
        @endphp
        <li>
            <a
                href="{{ $item['url']  }}"
                @class(['active' => $item['active']])
            >
                <x-core::icon :name="$item['icon']" />
                {{ trans($item['name']) }}
            </a>
        </li>
    @endforeach
</ul>
