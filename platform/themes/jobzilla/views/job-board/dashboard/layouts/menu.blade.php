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
    // Admission: separate from Post Job; lock only when admission enquiry access is missing
    $canAccessAdmission = true;
    if ($account && $account->isEmployer() && \Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem()) {
        try {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('jb_transactions', 'feature_key')) {
                $canAccessAdmission = false;
            } else {
                $admissionDebit = \Botble\JobBoard\Models\Transaction::query()
                    ->where('account_id', $account->getKey())
                    ->where('type', \Botble\JobBoard\Models\Transaction::TYPE_DEBIT)
                    ->where('feature_key', \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY)
                    ->latest()
                    ->first();
                if (!$admissionDebit || !$admissionDebit->created_at) {
                    $canAccessAdmission = false;
                } else {
                    $lastPurchase = \Botble\JobBoard\Models\Transaction::query()
                        ->where('account_id', $account->getKey())
                        ->where(function ($q): void {
                            $q->whereNull('type')->orWhere('type', '!=', 'deduct');
                        })
                        ->whereNotNull('payment_id')
                        ->whereNotNull('package_id')
                        ->with('package')
                        ->latest()
                        ->first();
                    if ($lastPurchase && $lastPurchase->package && $lastPurchase->package->validity_days && $lastPurchase->created_at) {
                        $packageExpiryAt = \Carbon\Carbon::parse($lastPurchase->created_at)->addDays($lastPurchase->package->validity_days);
                        $canAccessAdmission = \Carbon\Carbon::now()->lte($packageExpiryAt);
                    } else {
                        $debitDate = $admissionDebit->created_at instanceof \DateTimeInterface
                            ? \Carbon\Carbon::parse($admissionDebit->created_at)
                            : \Carbon\Carbon::parse((string) $admissionDebit->created_at);
                        $canAccessAdmission = $debitDate->gte(\Carbon\Carbon::now()->subDays(365));
                    }
                }
            }
        } catch (\Throwable $e) {
            $canAccessAdmission = false;
        }
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
{{-- Admission Button (lock only when admission enquiry access missing; independent of Post Job) --}}
<a href="{{ $canAccessAdmission ? route('public.account.admission.edit') : route('public.account.wallet') }}" class="ps-postjob-btn {{ $canAccessAdmission ? '' : 'ps-postjob-locked' }}" style="{{ $canAccessAdmission ? 'background: linear-gradient(135deg, #059669, #047857);' : '' }} margin-top: 8px;" title="{{ $canAccessAdmission ? '' : trans('plugins/job-board::messages.insufficient_credits') }}">
    @if($canAccessAdmission)
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
            $employerOnlyIds = ['cms-account-wallet', 'cms-account-packages', 'cms-account-staff'];
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
