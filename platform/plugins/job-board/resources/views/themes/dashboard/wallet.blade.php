@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@push('header')
<style>
/* Employer wallet – 2nd image: simple card UI */
.wallet-em-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 0.60rem 1.25rem !important; min-height: 220px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
.wallet-em-page .wallet-js-card-blue .card-footer { border: none !important; padding: 0.75rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem; }
.wallet-em-page .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.8rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem; }
.wallet-em-page .wallet-js-card-blue .btn-warning { background: #f59e0b !important; color: #000 !important; border: none !important; border-radius: 8px !important; font-weight: 500 !important; }
.wallet-em-page .wallet-js-card-orange { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; border: none !important; border-radius: 12px !important; min-height: 200px !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 1.5rem !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
.wallet-em-page .wallet-js-card-orange .card-body { padding: 0 !important; border: none !important; background: transparent !important; display: flex !important; align-items: center !important; justify-content: center !important; }
.wallet-em-page .wallet-js-card-orange .wallet-js-graphic { font-size: 4rem; color: rgba(0,0,0,0.3); }
.wallet-em-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
.wallet-em-page .wallet-js-two-cols .wallet-js-col-blue,
.wallet-em-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
.wallet-em-page .wallet-js-packages-row { align-items: stretch !important; }
.wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { display: flex !important; }
.wallet-em-page .wallet-js-packages-row { align-items: stretch !important; }
.wallet-em-page .wallet-js-packages-row > .wallet-js-package-col { display: flex !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card { display: flex !important; flex-direction: column !important; flex: 1 1 100% !important; min-height: 200px !important; background: #fff !important; border-radius: 12px !important; box-shadow: 0 1px 4px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; padding: 1rem 1.25rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-package-card-actions { margin-top: auto !important; padding-top: 0.75rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body h6 { font-size: 0.75rem !important; font-weight: 500 !important; color: #212529 !important; margin-bottom: 0.35rem !important; text-transform: uppercase !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-em-credits-validity { font-size: 0.775rem !important; color: #495057 !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-price { font-size: 0.75rem !important; font-weight: 500 !important; color: #1a1a2e !important; margin-bottom: 0.5rem !important; }
.wallet-em-page .wallet-js-packages-row .wallet-package-main-desc { font-size: 0.77rem !important; color: #6c757d !important; line-height: 1.5 !important; margin-bottom: 0 !important; }
.wallet-em-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; }
@media (max-width: 575px) {
    .wallet-em-page .wallet-js-packages-row .wallet-package-card { min-height: 180px !important; }
}
.wallet-em-page .wallet-package-card-current { border: 2px solid #198754 !important; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2); position: relative; }
.wallet-em-page .wallet-package-card-current .wallet-current-badge { position: absolute; top: 0.5rem; right: 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; background: #198754; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; }
/* Consumption report table – narrow columns, date only */
.wallet-consumption-invoice-section .wallet-consumption-table { table-layout: fixed !important; width: 100% !important; font-size: 0.85rem !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th { padding: 0.5rem 0.4rem !important; white-space: normal !important; }
.wallet-consumption-invoice-section .wallet-consumption-table tbody td { padding: 0.5rem 0.4rem !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(1),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(1) { width: 4% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(2),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(2) { width: 9% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(3),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(3) { width: 22% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(4),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(4) { width: 12% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(5),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(5) { width: 10% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(6),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(6) { width: 10% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th:nth-child(7),
.wallet-consumption-invoice-section .wallet-consumption-table tbody td:nth-child(7) { width: 10% !important; }
/* Status badges: admin se aane wala status (Pending/Approved) clearly white text */
.wallet-consumption-invoice-section .wallet-consumption-table .badge.bg-success { color: #fff !important; font-weight: 600 !important; }
.wallet-consumption-invoice-section .wallet-consumption-table .badge.bg-warning { color: #fff !important; font-weight: 600 !important; background-color: #f59e0b !important; }
.wallet-consumption-invoice-section .wallet-consumption-table .badge.bg-danger { color: #fff !important; font-weight: 600 !important; }
/* Wallet page buttons: text white */
.wallet-em-page .btn-outline-primary { color: #fff !important; background: #0d6efd !important; border-color: #0d6efd !important; }
.wallet-em-page .btn-outline-primary:hover { color: #fff !important; background: #0b5ed7 !important; border-color: #0a58ca !important; }
.wallet-em-page .btn-outline-warning { color: #fff !important; background: #ffc107 !important; border-color: #ffc107 !important; }
.wallet-em-page .btn-outline-info { color: #fff !important; background: #0dcaf0 !important; border-color: #0dcaf0 !important; }
.wallet-em-page .btn-outline-success { color: #fff !important; background: #198754 !important; border-color: #198754 !important; }
/* Recharge: same CTA + modal as job seeker wallet */
.wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger { width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin: 0;
    padding: 0.3rem 0.2rem;
    font-size: 14px;
    /* font-weight: 500; */
    letter-spacing: 0.02em;
    color: #fff;
    background: #f59e0b;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease, color 0.15s ease; }
.wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,0.22); background: #f8fbff; color: #0a58ca; }
.wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger:active:not(:disabled) { transform: translateY(0); }
.wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger:disabled { opacity: 0.55; cursor: not-allowed; box-shadow: none; }
.wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger svg, .wallet-em-page .wallet-js-card-blue .wallet-recharge-trigger .icon { font-size: 1.15rem; flex-shrink: 0; }
.wallet-em-page .wallet-js-card-blue .wallet-recharge-hint { font-size: 0.75rem; opacity: 0.9; margin-top: 0.5rem; text-align: center; line-height: 1.35; color: #fff !important; }
.wallet-recharge-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(13, 110, 253, 0.15), 0 8px 24px rgba(0,0,0,0.1); }
.wallet-recharge-modal .modal-header { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: #fff; border-bottom: none; padding: 1rem 1.25rem; }
.wallet-recharge-modal .modal-header .modal-title { color: #fff; font-weight: 700; font-size: 1.05rem; }
.wallet-recharge-modal .modal-header .modal-title .icon, .wallet-recharge-modal .modal-header .modal-title svg { color: #fde047 !important; }
.wallet-recharge-modal .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.92; }
.wallet-recharge-modal .modal-body { padding: 1.25rem 1.35rem; }
.wallet-recharge-modal .wallet-recharge-input { border-radius: 10px; border: 2px solid #e2e8f0; padding: 0.65rem 0.85rem; font-size: 1rem; font-weight: 600; }
.wallet-recharge-modal .wallet-recharge-input:focus { border-color: #0d6efd; box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15); }
.wallet-recharge-modal .modal-footer { border-top: 1px solid #eef2f6; padding: 1rem 1.25rem; gap: 0.65rem; flex-wrap: wrap; justify-content: flex-end; }
.wallet-recharge-modal .btn-rc-cancel, .wallet-recharge-modal .btn-rc-pay { display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem; padding: 0.6rem 1.15rem; font-weight: 600; font-size: 0.9rem; border-radius: 10px; transition: transform 0.12s ease, box-shadow 0.12s ease; }
.wallet-recharge-modal .btn-rc-cancel { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
.wallet-recharge-modal .btn-rc-cancel:hover { background: #e2e8f0; color: #334155; }
.wallet-recharge-modal .btn-rc-pay { background: linear-gradient(180deg, #2563eb 0%, #0d6efd 100%); color: #fff !important; border: none; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35); }
.wallet-recharge-modal .btn-rc-pay:hover { color: #fff !important; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(13, 110, 253, 0.45); }
.wallet-recharge-modal .wallet-recharge-err-alert { border-radius: 10px; font-size: 0.875rem; }
</style>
@endpush

@section('content')
    {{-- Employer wallet page (same card layout as job seeker) --}}
    <div class="wallet-em-page">
    @php
        $packagesList = $packages ?? collect();
        $packagesCount = is_countable($packagesList) ? count($packagesList) : 0;
        $packagesRight = $packagesList;
        $packageLeft = null;
        if ($packagesCount === 4) {
            $packagesRight = $packagesList->take(3);
            $packageLeft = $packagesList->skip(3)->first();
        }
    @endphp
    @php
        $packagesList = $packages ?? collect();
        $packagesCount = is_countable($packagesList) ? count($packagesList) : 0;
        $packagesRight = $packagesList;
        $packageLeft = null;
        if ($packagesCount === 4) {
            $packagesRight = $packagesList->take(3);
            $packageLeft = $packagesList->skip(3)->first();
        }
    @endphp
    <div class="row mb-4">
        <div class="col-lg-3 col-xl-3 mb-4 mb-lg-0">
            <div class="wallet-js-two-cols">
                <div class="wallet-js-col-blue">
                    <x-core::card class="border-0 wallet-js-card-blue">
                        <x-core::card.body class="p-0">
                            <h6 class="wallet-js-coins-title mb-0">{{ trans('plugins/job-board::dashboard.wallet_available_coins') }}</h6>
                            <div class="wallet-js-coins-value">
                                <x-core::icon name="ti ti-coin" class="d-block" style="font-size:1.25rem;" />
                                {{ format_credits_short($account->credits ?? 0) }}
                            </div>
                            <div class="wallet-js-coins-row">
                                <x-core::icon name="ti ti-coin" />
                                {{ trans('plugins/job-board::dashboard.wallet_bonus') }} {{ format_credits_short($bonusCredits ?? 0) }}
                            </div>
                            <div class="wallet-js-coins-row">
                                <x-core::icon name="ti ti-coin" />
                                {{ trans('plugins/job-board::dashboard.wallet_purchased') }} {{ format_credits_short($purchasedCredits ?? 0) }}
                            </div>
                        </x-core::card.body>
                        <x-core::card.footer class="py-2">
                            @if(isset($packageExpiryAt) && $packageExpiryAt)
                                <p class="small text-white mb-2 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_package_expires') }}: <strong>{{ $packageExpiryAt->format('M d, Y') }}</strong></p>
                            @endif
                            @if(isset($jobPostsAllowed) && $jobPostsAllowed > 0)
                                <p class="small text-white mb-1 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_job_posts_used_allowed', ['used' => $jobPostsUsed ?? 0, 'allowed' => $jobPostsAllowed]) }}</p>
                            @endif
                            @if(isset($profileViewsAllowed) && $profileViewsAllowed > 0)
                                <p class="small text-white mb-2 opacity-90">{{ trans('plugins/job-board::dashboard.wallet_profile_views_used_allowed', ['used' => $profileViewsUsed ?? 0, 'allowed' => $profileViewsAllowed]) }}</p>
                            @endif

                            {{-- Recharge Wallet (Employer) - Hide for consultancy --}}
                            @if(empty($isConsultancy))
                                <div class="mt-2">
                                    <button type="button" class="wallet-recharge-trigger" data-bs-toggle="modal" data-bs-target="#walletRechargeModal" @disabled(empty($canRechargeWallet))>
                                        <x-core::icon name="ti ti-wallet" />{{ __('Recharge Wallet') }}
                                    </button>
                                    @if(empty($canRechargeWallet))
                                        <div class="wallet-recharge-hint">{{ __('Recharge is available after you purchase at least one package.') }}</div>
                                    @else
                                        <div class="wallet-recharge-hint">{{ __('Minimum recharge ₹1000.') }}</div>
                                    @endif
                                </div>
                            @endif
                        </x-core::card.footer>
                    </x-core::card>
                </div>
            </div>

            {{-- Recharge Wallet Modal (hidden for consultancy) --}}
            @if(empty($isConsultancy))
                <div class="modal fade wallet-recharge-modal" id="walletRechargeModal" tabindex="-1" aria-labelledby="walletRechargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title d-flex align-items-center gap-2 mb-0" id="walletRechargeModalLabel"><x-core::icon name="ti ti-wallet" />{{ __('Recharge Wallet') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                            </div>
                            <x-core::form :url="route('public.account.wallet.recharge.start')" method="post" id="walletRechargeForm">
                                <div class="modal-body">
                                    <p class="small text-muted mb-3">{{ __('1 INR = 1 Coin. Minimum recharge ₹1000.') }}</p>
                                    <div class="alert alert-danger py-2 px-3 mb-3 d-none wallet-recharge-err-alert" id="walletRechargeErr" role="alert"></div>
                                    <label class="form-label fw-semibold" for="walletRechargeAmount">{{ __('Enter amount (INR)') }}</label>
                                    <input type="number" name="amount_inr" id="walletRechargeAmount" class="form-control wallet-recharge-input" min="1000" step="1" value="{{ old('amount_inr', 1000) }}" placeholder="1000" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-rc-cancel" data-bs-dismiss="modal"><x-core::icon name="ti ti-x" />{{ __('Cancel') }}</button>
                                    <button type="submit" class="btn-rc-pay"><x-core::icon name="ti ti-credit-card" />{{ __('Proceed to Pay') }}</button>
                                </div>
                            </x-core::form>
                        </div>
                    </div>
                </div>
            @endif

            @if($packageLeft)
                @php $isCurrentPackage = in_array($packageLeft->id, $currentPackageIds ?? []); @endphp
                <div class="row wallet-js-packages-row g-3 mt-0 pt-2">
                    <div class="col-12 wallet-js-package-col">
                        <div @class(['card wallet-package-card', 'border-warning' => $packageLeft->is_default, 'wallet-package-card-current' => $isCurrentPackage])>
                            @if($isCurrentPackage)
                                <span class="wallet-current-badge">{{ __('Current') }}</span>
                            @endif
                            @if($packageLeft->percent_save)
                                <div class="card-header py-1 bg-success text-white small text-center">
                                    {{ $packageLeft->percent_save_text }}
                                </div>
                            @endif
                            <x-core::card.body class="pb-2">
                                <h6 class="text-uppercase">{{ $packageLeft->name }}</h6>
                                <p class="wallet-em-credits-validity">{{ format_credits_short($packageLeft->credits_included ?? $packageLeft->number_of_listings) }} {{ trans('plugins/job-board::dashboard.credits') }}@if($packageLeft->validity_days) · {{ trans('plugins/job-board::dashboard.package_validity_days', ['days' => $packageLeft->validity_days]) }}@endif</p>
                                <p class="wallet-package-price">{{ $packageLeft->price_text }}</p>
                                @if(trim((string) $packageLeft->description) !== '')
                                    <p class="wallet-package-main-desc">{{ $packageLeft->description }}</p>
                                @elseif($packageFeatures = $packageLeft->formatted_features)
                                    <p class="wallet-package-main-desc">{{ is_array($packageFeatures) ? implode(' ', $packageFeatures) : $packageFeatures }}</p>
                                @endif
                                <div class="wallet-package-card-actions">
                                    <x-core::form :url="route('public.account.package.subscribe.put')" method="put">
                                        <input type="hidden" name="id" value="{{ $packageLeft->id }}">
                                        <x-core::button type="submit" class="w-100 btn-sm" color="{{ $packageLeft->is_default ? 'warning' : 'primary' }}" :disabled="$packageLeft->isPurchased()">
                                            {{ $packageLeft->isPurchased() ? trans('plugins/job-board::dashboard.purchased_label') : trans('plugins/job-board::dashboard.wallet_buy_now') }}
                                        </x-core::button>
                                    </x-core::form>
                                </div>
                            </x-core::card.body>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-9 col-xl-9">
            <div class="d-flex justify-content-between align-items-center mb-2" id="choose-plan">
                <h5 class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_choose_plan') }}</h5>
                <small class="text-muted">{{ trans('plugins/job-board::dashboard.wallet_all_prices_gst') }}</small>
            </div>
            <div class="row wallet-js-packages-row g-3">
                @foreach($packagesRight ?? [] as $package)
                @foreach($packagesRight ?? [] as $package)
                    @php $isCurrentPackage = in_array($package->id, $currentPackageIds ?? []); @endphp
                    <div class="col-12 col-md-6 col-lg-4 wallet-js-package-col">
                    <div class="col-12 col-md-6 col-lg-4 wallet-js-package-col">
                        <div @class(['card wallet-package-card', 'border-warning' => $package->is_default, 'wallet-package-card-current' => $isCurrentPackage])>
                            @if($isCurrentPackage)
                                <span class="wallet-current-badge">{{ __('Current') }}</span>
                            @endif
                            @if($package->percent_save)
                                <div class="card-header py-1 bg-success text-white small text-center">
                                    {{ $package->percent_save_text }}
                                </div>
                            @endif
                            <x-core::card.body class="pb-2">
                                <h6 class="text-uppercase">{{ $package->name }}</h6>
                                <p class="wallet-em-credits-validity">{{ format_credits_short($package->credits_included ?? $package->number_of_listings) }} {{ trans('plugins/job-board::dashboard.credits') }}@if($package->validity_days) · {{ trans('plugins/job-board::dashboard.package_validity_days', ['days' => $package->validity_days]) }}@endif</p>
                                <p class="wallet-package-price">{{ $package->price_text }}</p>
                                @if(trim((string) $package->description) !== '')
                                    <p class="wallet-package-main-desc">{{ $package->description }}</p>
                                @elseif($packageFeatures = $package->formatted_features)
                                    <p class="wallet-package-main-desc">{{ is_array($packageFeatures) ? implode(' ', $packageFeatures) : $packageFeatures }}</p>
                                @endif
                                <div class="wallet-package-card-actions">
                                <x-core::form :url="route('public.account.package.subscribe.put')" method="put">
                                    <input type="hidden" name="id" value="{{ $package->id }}">
                                    <x-core::button type="submit" class="w-100 btn-sm" color="{{ $package->is_default ? 'warning' : 'primary' }}" :disabled="$package->isPurchased()">
                                        {{ $package->isPurchased() ? trans('plugins/job-board::dashboard.purchased_label') : trans('plugins/job-board::dashboard.wallet_buy_now') }}
                                    </x-core::button>
                                </x-core::form>
                                </div>
                            </x-core::card.body>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Row 2: Billing Details (3 col) | Coin Consumption (9 col) --}}
    <div class="row mb-4">
        <div class="col-lg-12 col-md-12 mb-4 mb-lg-3 mb-3" > 
            <x-core::card class="h-100">
                <x-core::card.header>
                    <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_billing_details') }}</x-core::card.title>
                </x-core::card.header>
                <x-core::card.body>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#walletBillingModal">{{ __('Add Remaining Details') }}</button>
                    <div class="mt-2 small" id="wallet-em-remaining-details">
                        <div class="border rounded p-2 bg-light mt-2">
                            <p class="mb-1"><strong>Name:</strong> {{ $account->name ?? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: '—' }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $account->address ?? '—' }}</p>
                            <p class="mb-1"><strong>Mobile:</strong> {{ $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : '—' }}</p>
                            <p class="mb-1"><strong>State:</strong> {{ $account->state_name ?? '—' }}</p>
                            <p class="mb-0"><strong>GST No:</strong> {{ $account->billing_gst_number ?? '—' }}</p>
                        </div>
                    </div>
                </x-core::card.body>
            </x-core::card>
        </div>
        @php $isConsultancy = $isConsultancy ?? ($account && method_exists($account, 'isConsultancy') && $account->isConsultancy()); @endphp
        @unless($isConsultancy)
        @php $isConsultancy = $isConsultancy ?? ($account && method_exists($account, 'isConsultancy') && $account->isConsultancy()); @endphp
        @unless($isConsultancy)
        <div class="col-lg-12 col-md-12">
            <x-core::card class="h-100">
                <x-core::card.header>
                    <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_coins_consumption') }}</x-core::card.title>
                </x-core::card.header>
                <x-core::card.body>
                    @php
                        $siteName = $siteName ?? \Botble\Theme\Facades\Theme::getSiteTitle();
                        if (!empty($creditConsumption)) {
                            $consumptionList = $creditConsumption;
                        } else {
                            $consumption = $account->isEmployer()
                                ? trans('plugins/job-board::dashboard.wallet_consumption_employer')
                                : trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
                            $consumptionList = is_array($consumption) ? $consumption : [];
                        }
                    @endphp
                    <ul class="list-unstyled mb-0">
                        @if(!empty($creditConsumption))
                            @foreach($consumptionList as $key => $item)
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span>{{ is_array($item) ? ($item['label'] ?? $key) : $key }}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-muted small">@if($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY) {{ __('Paid') }} @else{{ is_array($item) ? ($item['credits'] ?? 0) . ' ' . trans('plugins/job-board::credit-consumption.credits') : $item }} @endif</span>
                                        @if($account->isEmployer() && is_array($item) && !empty($item['credits']))
                                            @php $featureActiveWithPackage = in_array($key, $activePackageFeatureKeys ?? []); @endphp
                                            @if($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
                                                <button type="button" class="btn btn-xs btn-outline-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal" title="{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_CANDIDATE_PROFILE_VIEW && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0)
                                                @if(isset($profileViewCreditsBalance))
                                                    <span class="text-muted small me-1">{{ trans('plugins/job-board::dashboard.wallet_profile_view_slot_balance', ['count' => $profileViewCreditsBalance]) }}</span>
                                                @endif
                                                <button type="button" class="btn btn-xs btn-outline-info" data-bs-toggle="modal" data-bs-target="#walletProfileViewSlotModal" title="{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}">
                                                    {{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_SOCIAL_PROMOTION)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletSocialPromotionBtn" title="{{ __('First credits will be deducted, then fill the form.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER)
                                                @if(isset($dedicatedRecruiterValidTill) && $dedicatedRecruiterValidTill)
                                                    <span class="badge bg-success me-1">{{ __('Valid till') }} {{ $dedicatedRecruiterValidTill->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('Active until :date', ['date' => $dedicatedRecruiterValidTill->format('M d, Y')]) }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-outline-primary" id="walletDedicatedRecruiterBtn" title="{{ __('First credits deducted, then form. Valid 1 month.') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE)
                                                @if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt)
                                                    <span class="badge bg-success" title="{{ trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')]) }}">{{ __('Valid till') }} {{ $packageExpiryAt->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('Included in package until :date', ['date' => $packageExpiryAt->format('M d, Y')]) }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-xs btn-outline-primary" data-bs-toggle="modal" data-bs-target="#walletJobPostingAssistanceModal" title="{{ __('Request job posting assistance. 250 credits deducted. Admin will approve and can create job.') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_WALKIN_DRIVE_AD)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletWalkinDriveAdBtn" title="{{ __('First credits deducted, then form (banner + placement).') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_MULTIPLE_LOGIN)
                                                <button type="button" class="btn btn-xs btn-outline-primary" id="walletMultipleLoginBtn" title="{{ __('First 250 credits will be deducted, then fill form to add sub-account.') }}">
                                                    {{ __('Use credits') }}
                                                </button>
                                            @elseif($key === \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY)
                                                @if(!empty($admissionViaPackage))
                                                    <span class="badge bg-success">{{ __('Unlocked') }}</span>
                                                    @if(isset($packageExpiryAt) && $packageExpiryAt)
                                                        <span class="text-muted small">{{ __('Included in package until') }} {{ $packageExpiryAt->format('M d, Y') }}</span>
                                                    @else
                                                        <span class="text-muted small">{{ __('Included in your package') }}</span>
                                                    @endif
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('No coins needed — included in your plan') }}">{{ __('Use credits') }}</button>
                                                @elseif(!empty($admissionEnquiryAccess))
                                                    <span class="badge bg-success">{{ __('Unlocked') }}</span>
                                                    <span class="text-muted small">{{ __('Active via coins / plan') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary" disabled title="{{ __('Already unlocked') }}">{{ __('Use credits') }}</button>
                                                @else
                                                    <button
                                                        type="button"
                                                        class="btn btn-xs btn-outline-primary wallet-feature-use-credits-btn"
                                                        data-feature-key="{{ $key }}"
                                                        data-feature-label="{{ $item['label'] ?? $key }}"
                                                        data-credits="{{ (int) ($item['credits'] ?? 0) }}"
                                                        title="{{ __('Deduct coins to unlock Admission Enquiry Form for your profile') }}"
                                                    >{{ __('Use credits') }}</button>
                                                @endif
                                            @elseif($key !== \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING)
                                                @if($featureActiveWithPackage && isset($packageExpiryAt) && $packageExpiryAt)
                                                    <span class="badge bg-success" title="{{ trans('plugins/job-board::dashboard.wallet_valid_till_package', ['date' => $packageExpiryAt->format('M d, Y')]) }}">{{ __('Valid till') }} {{ $packageExpiryAt->format('M d, Y') }}</span>
                                                    <button type="button" class="btn btn-xs btn-outline-secondary wallet-feature-use-credits-btn" disabled title="{{ __('Valid with package until expiry') }}">
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @else
                                                    <button
                                                        type="button"
                                                        class="btn btn-xs btn-outline-primary wallet-feature-use-credits-btn"
                                                        data-feature-key="{{ $key }}"
                                                        data-feature-label="{{ $item['label'] ?? $key }}"
                                                        data-credits="{{ (int) ($item['credits'] ?? 0) }}"
                                                    >
                                                        {{ __('Use credits') }}
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @else
                            @foreach($consumptionList as $label => $rate)
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span>{{ str_replace(':site', $siteName, $label) }}</span>
                                    <span class="text-muted small">{{ $rate }}</span>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- @if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
                        <div class="mt-3 pt-3 border-top">
                            @if(isset($jobPostCreditsBalance))
                                <p class="small text-muted mb-2">{{ trans('plugins/job-board::dashboard.wallet_job_post_slot_balance', ['count' => $jobPostCreditsBalance]) }}</p>
                            @endif
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#walletJobPostSlotModal">
                                <x-core::icon name="ti ti-plus" class="me-1" />
                                {{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}
                            </button>
                        </div>
                    @endif -->
                </x-core::card.body>
            </x-core::card>
        </div>
        @endunless
        @endunless
    </div>

    {{-- Modal: Use credits for a feature (generic) – like Features & Coins list, confirm before deduct --}}
    @if($account->isEmployer() && !(method_exists($account, 'isConsultancy') && $account->isConsultancy()))
    {{-- Modal: Use credits for a feature (generic) – like Features & Coins list, confirm before deduct --}}
    @if($account->isEmployer() && !(method_exists($account, 'isConsultancy') && $account->isConsultancy()))
        <div class="modal fade" id="walletFeaturePurchaseModal" tabindex="-1" aria-labelledby="walletFeaturePurchaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="walletFeaturePurchaseModalLabel">{{ __('Features & Coins Consumption') }}</h5>
                        <h5 class="modal-title" id="walletFeaturePurchaseModalLabel">{{ __('Features & Coins Consumption') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1 fw-medium" id="walletFeaturePurchaseModalFeatureName"></p>
                        <p class="mb-0 text-muted small" id="walletFeaturePurchaseModalMsg"></p>
                        <p class="mb-1 fw-medium" id="walletFeaturePurchaseModalFeatureName"></p>
                        <p class="mb-0 text-muted small" id="walletFeaturePurchaseModalMsg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-primary" id="walletFeaturePurchaseConfirmBtn">{{ __('Use credits') }}</button>
                        <button type="button" class="btn btn-primary" id="walletFeaturePurchaseConfirmBtn">{{ __('Use credits') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal: Use credits for 1 Job Post --}}
    @if($account->isEmployer() && isset($jobPostCreditsRequired) && $jobPostCreditsRequired > 0)
    <div class="modal fade" id="walletJobPostSlotModal" tabindex="-1" aria-labelledby="walletJobPostSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletJobPostSlotModalLabel">{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_job_post') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_job_post_confirm_message', ['credits' => $jobPostCreditsRequired]) }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletJobPostSlotConfirmBtn">{{ __('OK') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($account->isEmployer() && isset($profileViewCreditsRequired) && $profileViewCreditsRequired > 0)
    <div class="modal fade" id="walletProfileViewSlotModal" tabindex="-1" aria-labelledby="walletProfileViewSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletProfileViewSlotModalLabel">{{ trans('plugins/job-board::dashboard.wallet_use_credits_for_profile_view') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_profile_view_confirm_message', ['credits' => $profileViewCreditsRequired]) }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletProfileViewSlotConfirmBtn">{{ __('OK') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Social Promotion – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletSocialPromotionConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Post/Promote on LinkedIn') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('3000 credits will be deducted first. Then the form will open. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletSocialPromotionConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Social Promotion request form (open after deduct) --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletSocialPromotionModal" tabindex="-1" aria-labelledby="walletSocialPromotionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletSocialPromotionModalLabel">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletSocialPromotionForm">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="social_promotion_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Fill the form and submit.') }}</p>
                        <div class="mb-2">
                            <label for="social_promotion_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="social_promotion_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="social_promotion_title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="social_promotion_title" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Title') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="social_promotion_tag" class="form-label">{{ __('Tag') }}</label>
                                <input type="text" name="tag" id="social_promotion_tag" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Tag') }}">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="social_promotion_platform" class="form-label">{{ __('Platform') }} <span class="text-danger">*</span></label>
                            <select name="platform" id="social_promotion_platform" class="form-select form-select-sm" required>
                                <option value="">{{ __('— Select —') }}</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="social_promotion_message" class="form-control form-control-sm" rows="3" maxlength="2000" placeholder="{{ __('Message / Description') }}"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_image" class="form-label">{{ __('Image') }}</label>
                            <input type="file" name="image" id="social_promotion_image" class="form-control form-control-sm" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                            <small class="text-muted">{{ __('Optional. JPG, PNG, GIF, WebP. Max 5MB.') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletSocialPromotionSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Job Posting Assistance – 250 credits deducted, request to admin --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletJobPostingAssistanceModal" tabindex="-1" aria-labelledby="walletJobPostingAssistanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletJobPostingAssistanceModalLabel">{{ __('Job Posting Assistance') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletJobPostingAssistanceForm">
                    @csrf
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('250 credits will be deducted. Request will go to admin. After approval, admin can create job for your institution.') }}</p>
                        <div class="mb-2">
                            <label for="jpa_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="jpa_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jpa_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="jpa_message" class="form-control form-control-sm" rows="3" maxlength="2000" placeholder="{{ __('Optional note for admin') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletJobPostingAssistanceSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Walk-in Drive Ad – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletWalkinDriveAdConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Walk-in Drive Ad Space') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('2500 credits will be deducted first. Then the form will open. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletWalkinDriveAdConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Walk-in Drive Ad Space – form (open after deduct) --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletWalkinDriveAdModal" tabindex="-1" aria-labelledby="walletWalkinDriveAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletWalkinDriveAdModalLabel">{{ __('Walk-in Drive Ad Space (Home & Job Listing Page)') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletWalkinDriveAdForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="walkin_drive_ad_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Upload banner and choose where to show (Home page, Job Listing page, or both). Admin will approve to display.') }}</p>
                        <div class="mb-2">
                            <label for="wda_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="wda_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="wda_banner_image" class="form-label">{{ __('Banner image') }} <span class="text-danger">*</span></label>
                            <input type="file" name="banner_image" id="wda_banner_image" class="form-control form-control-sm" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" required>
                            <small class="text-muted">{{ __('JPEG, PNG, GIF or WebP. Max 5MB.') }}</small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">{{ __('Show ad on') }} <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_home" value="home" class="form-check-input" required>
                                <label for="wda_placement_home" class="form-check-label">{{ __('Home page') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_job_listing" value="job_listing" class="form-check-input">
                                <label for="wda_placement_job_listing" class="form-check-label">{{ __('Job Listing page') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_both" value="both" class="form-check-input">
                                <label for="wda_placement_both" class="form-check-label">{{ __('Both (Home & Job Listing)') }}</label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="wda_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="wda_message" class="form-control form-control-sm" rows="2" maxlength="2000" placeholder="{{ __('Optional note for admin') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletWalkinDriveAdSubmitBtn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Dedicated Recruiter – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletDedicatedRecruiterConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Dedicated Recruiter') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('2500 credits will be deducted first. Then the form will open. Valid for 1 month. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletDedicatedRecruiterConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Dedicated Recruiter request form (open after deduct) --}}
    <div class="modal fade" id="walletDedicatedRecruiterModal" tabindex="-1" aria-labelledby="walletDedicatedRecruiterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletDedicatedRecruiterModalLabel">{{ __('Dedicated Recruiter / Personal Account Manager') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletDedicatedRecruiterForm">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="dedicated_recruiter_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Fill the form. Valid for 1 month from start date.') }}</p>
                        <div class="mb-2">
                            <label for="dr_duration_months" class="form-label">{{ __('Duration (months)') }} <span class="text-danger">*</span></label>
                            <select name="duration_months" id="dr_duration_months" class="form-select form-select-sm" required>
                                @for($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? __('month') : __('months') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="dr_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="dr_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label for="dr_start_date" class="form-label">{{ __('Start date') }}</label>
                                <input type="date" name="start_date" id="dr_start_date" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label for="dr_end_date" class="form-label">{{ __('End date') }}</label>
                                <input type="date" name="end_date" id="dr_end_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="dr_note" class="form-label">{{ __('Note') }}</label>
                            <textarea name="note" id="dr_note" class="form-control form-control-sm" rows="2" maxlength="1000" placeholder="{{ __('e.g. Need assistance for bulk teacher hiring') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletDedicatedRecruiterSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Multiple Login – Step 1: Deduct 250 credits, Step 2: Fill form --}}
    <div class="modal fade" id="walletMultipleLoginModal" tabindex="-1" aria-labelledby="walletMultipleLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletMultipleLoginModalLabel">{{ __('Multiple Login / Add Sub-Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="walletMultipleLoginStep1" class="modal-body">
                    <p class="mb-3">{{ __('250 credits will be deducted first. Then you can fill the form to add a sub-account.') }}</p>
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-primary" id="walletMultipleLoginDeductBtn">{{ __('Continue') }}</button>
                    </div>
                </div>
                <div id="walletMultipleLoginStep2" class="modal-body" style="display:none;">
                <form id="walletMultipleLoginForm">
                    @csrf
                        <input type="hidden" name="credits_already_deducted" value="1">
                        <p class="small text-muted mb-3">{{ __('Credits deducted. Add sub-account details.') }}</p>
                        <div class="mb-2">
                            <label for="ml_email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="ml_email" class="form-control form-control-sm" required placeholder="hr@school.com">
                        </div>
                        <div class="mb-2">
                            <label for="ml_name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="ml_name" class="form-control form-control-sm" required maxlength="255" placeholder="{{ __('e.g. HR Manager') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_role" class="form-label">{{ __('Role') }}</label>
                            <input type="text" name="role" id="ml_role" class="form-control form-control-sm" maxlength="60" placeholder="{{ __('e.g. Recruiter') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="ml_password" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="ml_password_confirmation" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                        <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletMultipleLoginSubmitBtn">{{ __('Add Sub-Account') }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Social Promotion – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletSocialPromotionConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Post/Promote on LinkedIn') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('3000 credits will be deducted first. Then the form will open. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletSocialPromotionConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Social Promotion request form (open after deduct) --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletSocialPromotionModal" tabindex="-1" aria-labelledby="walletSocialPromotionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletSocialPromotionModalLabel">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletSocialPromotionForm">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="social_promotion_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Fill the form and submit.') }}</p>
                        <div class="mb-2">
                            <label for="social_promotion_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="social_promotion_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="social_promotion_title" class="form-label">{{ __('Title') }}</label>
                                <input type="text" name="title" id="social_promotion_title" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Title') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="social_promotion_tag" class="form-label">{{ __('Tag') }}</label>
                                <input type="text" name="tag" id="social_promotion_tag" class="form-control form-control-sm" maxlength="255" placeholder="{{ __('Tag') }}">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="social_promotion_platform" class="form-label">{{ __('Platform') }} <span class="text-danger">*</span></label>
                            <select name="platform" id="social_promotion_platform" class="form-select form-select-sm" required>
                                <option value="">{{ __('— Select —') }}</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Twitter">Twitter</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="social_promotion_message" class="form-control form-control-sm" rows="3" maxlength="2000" placeholder="{{ __('Message / Description') }}"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="social_promotion_image" class="form-label">{{ __('Image') }}</label>
                            <input type="file" name="image" id="social_promotion_image" class="form-control form-control-sm" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                            <small class="text-muted">{{ __('Optional. JPG, PNG, GIF, WebP. Max 5MB.') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletSocialPromotionSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Job Posting Assistance – 250 credits deducted, request to admin --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletJobPostingAssistanceModal" tabindex="-1" aria-labelledby="walletJobPostingAssistanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletJobPostingAssistanceModalLabel">{{ __('Job Posting Assistance') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletJobPostingAssistanceForm">
                    @csrf
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('250 credits will be deducted. Request will go to admin. After approval, admin can create job for your institution.') }}</p>
                        <div class="mb-2">
                            <label for="jpa_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="jpa_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="jpa_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="jpa_message" class="form-control form-control-sm" rows="3" maxlength="2000" placeholder="{{ __('Optional note for admin') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletJobPostingAssistanceSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Walk-in Drive Ad – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletWalkinDriveAdConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Walk-in Drive Ad Space') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('2500 credits will be deducted first. Then the form will open. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletWalkinDriveAdConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Walk-in Drive Ad Space – form (open after deduct) --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletWalkinDriveAdModal" tabindex="-1" aria-labelledby="walletWalkinDriveAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletWalkinDriveAdModalLabel">{{ __('Walk-in Drive Ad Space (Home & Job Listing Page)') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletWalkinDriveAdForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="walkin_drive_ad_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Upload banner and choose where to show (Home page, Job Listing page, or both). Admin will approve to display.') }}</p>
                        <div class="mb-2">
                            <label for="wda_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="wda_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="wda_banner_image" class="form-label">{{ __('Banner image') }} <span class="text-danger">*</span></label>
                            <input type="file" name="banner_image" id="wda_banner_image" class="form-control form-control-sm" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" required>
                            <small class="text-muted">{{ __('JPEG, PNG, GIF or WebP. Max 5MB.') }}</small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">{{ __('Show ad on') }} <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_home" value="home" class="form-check-input" required>
                                <label for="wda_placement_home" class="form-check-label">{{ __('Home page') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_job_listing" value="job_listing" class="form-check-input">
                                <label for="wda_placement_job_listing" class="form-check-label">{{ __('Job Listing page') }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="placement" id="wda_placement_both" value="both" class="form-check-input">
                                <label for="wda_placement_both" class="form-check-label">{{ __('Both (Home & Job Listing)') }}</label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="wda_message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="wda_message" class="form-control form-control-sm" rows="2" maxlength="2000" placeholder="{{ __('Optional note for admin') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletWalkinDriveAdSubmitBtn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Dedicated Recruiter – confirm deduct first --}}
    @if($account->isEmployer())
    <div class="modal fade" id="walletDedicatedRecruiterConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Dedicated Recruiter') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{ __('2500 credits will be deducted first. Then the form will open. Valid for 1 month. Continue?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" class="btn btn-primary" id="walletDedicatedRecruiterConfirmBtn">{{ __('Continue') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal: Dedicated Recruiter request form (open after deduct) --}}
    <div class="modal fade" id="walletDedicatedRecruiterModal" tabindex="-1" aria-labelledby="walletDedicatedRecruiterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletDedicatedRecruiterModalLabel">{{ __('Dedicated Recruiter / Personal Account Manager') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletDedicatedRecruiterForm">
                    @csrf
                    <input type="hidden" name="credits_already_deducted" id="dedicated_recruiter_credits_deducted" value="0">
                    <div class="modal-body">
                        <p class="small text-muted mb-3">{{ __('Credits already deducted. Fill the form. Valid for 1 month from start date.') }}</p>
                        <div class="mb-2">
                            <label for="dr_duration_months" class="form-label">{{ __('Duration (months)') }} <span class="text-danger">*</span></label>
                            <select name="duration_months" id="dr_duration_months" class="form-select form-select-sm" required>
                                @for($i = 1; $i <= 24; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? __('month') : __('months') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="dr_company_id" class="form-label">{{ __('Institution') }}</label>
                            <select name="company_id" id="dr_company_id" class="form-select form-select-sm">
                                <option value="">{{ __('— Select —') }}</option>
                                @foreach($companies ?? [] as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label for="dr_start_date" class="form-label">{{ __('Start date') }}</label>
                                <input type="date" name="start_date" id="dr_start_date" class="form-control form-control-sm">
                            </div>
                            <div class="col-6">
                                <label for="dr_end_date" class="form-label">{{ __('End date') }}</label>
                                <input type="date" name="end_date" id="dr_end_date" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="dr_note" class="form-label">{{ __('Note') }}</label>
                            <textarea name="note" id="dr_note" class="form-control form-control-sm" rows="2" maxlength="1000" placeholder="{{ __('e.g. Need assistance for bulk teacher hiring') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletDedicatedRecruiterSubmitBtn">{{ __('Submit request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Multiple Login – Step 1: Deduct 250 credits, Step 2: Fill form --}}
    <div class="modal fade" id="walletMultipleLoginModal" tabindex="-1" aria-labelledby="walletMultipleLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletMultipleLoginModalLabel">{{ __('Multiple Login / Add Sub-Account') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="walletMultipleLoginStep1" class="modal-body">
                    <p class="mb-3">{{ __('250 credits will be deducted first. Then you can fill the form to add a sub-account.') }}</p>
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button" class="btn btn-primary" id="walletMultipleLoginDeductBtn">{{ __('Continue') }}</button>
                    </div>
                </div>
                <div id="walletMultipleLoginStep2" class="modal-body" style="display:none;">
                <form id="walletMultipleLoginForm">
                    @csrf
                        <input type="hidden" name="credits_already_deducted" value="1">
                        <p class="small text-muted mb-3">{{ __('Credits deducted. Add sub-account details.') }}</p>
                        <div class="mb-2">
                            <label for="ml_email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="ml_email" class="form-control form-control-sm" required placeholder="hr@school.com">
                        </div>
                        <div class="mb-2">
                            <label for="ml_name" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="ml_name" class="form-control form-control-sm" required maxlength="255" placeholder="{{ __('e.g. HR Manager') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_role" class="form-label">{{ __('Role') }}</label>
                            <input type="text" name="role" id="ml_role" class="form-control form-control-sm" maxlength="60" placeholder="{{ __('e.g. Recruiter') }}">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="ml_password" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                        <div class="mb-2">
                            <label for="ml_password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="ml_password_confirmation" class="form-control form-control-sm" required minlength="6" placeholder="••••••">
                        </div>
                        <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletMultipleLoginSubmitBtn">{{ __('Add Sub-Account') }}</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('footer')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generic feature purchase modal
        var featureModalEl = document.getElementById('walletFeaturePurchaseModal');
        var featureConfirmBtn = document.getElementById('walletFeaturePurchaseConfirmBtn');
        var featureMsg = document.getElementById('walletFeaturePurchaseModalMsg');
        var activeFeatureKey = null;
        var activeCredits = 0;
        var activeLabel = '';

        document.querySelectorAll('.wallet-feature-use-credits-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                activeFeatureKey = btn.getAttribute('data-feature-key') || '';
                activeLabel = btn.getAttribute('data-feature-label') || activeFeatureKey;
                activeCredits = parseInt(btn.getAttribute('data-credits') || '0', 10) || 0;
                var featureNameEl = document.getElementById('walletFeaturePurchaseModalFeatureName');
                if (featureNameEl) {
                    featureNameEl.textContent = activeLabel;
                }
                var featureNameEl = document.getElementById('walletFeaturePurchaseModalFeatureName');
                if (featureNameEl) {
                    featureNameEl.textContent = activeLabel;
                }
                if (featureMsg) {
                    featureMsg.textContent = activeCredits + ' {{ trans('plugins/job-board::credit-consumption.credits') }} {{ __('will be deducted. Continue?') }}';
                    featureMsg.textContent = activeCredits + ' {{ trans('plugins/job-board::credit-consumption.credits') }} {{ __('will be deducted. Continue?') }}';
                }
                if (featureModalEl && window.bootstrap) {
                    (new bootstrap.Modal(featureModalEl)).show();
                }
            });
        });

        if (featureConfirmBtn) {
            featureConfirmBtn.addEventListener('click', function() {
                if (!activeFeatureKey) return;
                featureConfirmBtn.disabled = true;
                fetch('{{ route('public.account.wallet.purchase_feature') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ feature_key: activeFeatureKey })
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        if (featureModalEl && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(featureModalEl);
                            if (m) m.hide();
                        }
                        window.location.reload();
                    } else {
                        alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { featureConfirmBtn.disabled = false; });
            });
        }

        var btn = document.getElementById('walletJobPostSlotConfirmBtn');
        if (!btn) return;
        btn.addEventListener('click', function() {
            btn.disabled = true;
            fetch('{{ route('public.account.wallet.purchase_job_post_slot') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    var modal = document.getElementById('walletJobPostSlotModal');
                    if (modal && window.bootstrap) {
                        var m = bootstrap.Modal.getInstance(modal);
                        if (m) m.hide();
                    }
                    if (typeof window.location !== 'undefined') window.location.reload();
                } else {
                    alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                }
            })
            .catch(function() {
                alert('{{ __('Something went wrong.') }}');
            })
            .finally(function() { btn.disabled = false; });
        });

        var profileViewBtn = document.getElementById('walletProfileViewSlotConfirmBtn');
        if (profileViewBtn) {
            profileViewBtn.addEventListener('click', function() {
                profileViewBtn.disabled = true;
                fetch('{{ route('public.account.wallet.purchase_profile_view_slot') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        var modal = document.getElementById('walletProfileViewSlotModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || '{{ trans('plugins/job-board::messages.insufficient_credits') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { profileViewBtn.disabled = false; });
            });
        }

        var walletSocialPromotionBtn = document.getElementById('walletSocialPromotionBtn');
        var walletSocialPromotionConfirmModal = document.getElementById('walletSocialPromotionConfirmModal');
        if (walletSocialPromotionBtn && walletSocialPromotionConfirmModal && window.bootstrap) {
            walletSocialPromotionBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletSocialPromotionConfirmModal)).show();
            });
        }
        var walletSocialPromotionConfirmBtn = document.getElementById('walletSocialPromotionConfirmBtn');
        if (walletSocialPromotionConfirmBtn) {
            walletSocialPromotionConfirmBtn.addEventListener('click', function() {
                walletSocialPromotionConfirmBtn.disabled = true;
                fetch('{{ route('public.account.social-promotion.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletSocialPromotionConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('social_promotion_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletSocialPromotionModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletSocialPromotionConfirmBtn.disabled = false; });
            });
        }

        var socialPromotionForm = document.getElementById('walletSocialPromotionForm');
        if (socialPromotionForm) {
            socialPromotionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletSocialPromotionSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(socialPromotionForm);
                fetch('{{ route('public.account.social-promotion-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletSocialPromotionModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletDedicatedRecruiterBtn = document.getElementById('walletDedicatedRecruiterBtn');
        var walletDedicatedRecruiterConfirmModal = document.getElementById('walletDedicatedRecruiterConfirmModal');
        if (walletDedicatedRecruiterBtn && walletDedicatedRecruiterConfirmModal && window.bootstrap) {
            walletDedicatedRecruiterBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletDedicatedRecruiterConfirmModal)).show();
            });
        }
        var walletDedicatedRecruiterConfirmBtn = document.getElementById('walletDedicatedRecruiterConfirmBtn');
        if (walletDedicatedRecruiterConfirmBtn) {
            walletDedicatedRecruiterConfirmBtn.addEventListener('click', function() {
                walletDedicatedRecruiterConfirmBtn.disabled = true;
                fetch('{{ route('public.account.dedicated-recruiter.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletDedicatedRecruiterConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('dedicated_recruiter_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletDedicatedRecruiterModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletDedicatedRecruiterConfirmBtn.disabled = false; });
            });
        }

        var dedicatedRecruiterForm = document.getElementById('walletDedicatedRecruiterForm');
        if (dedicatedRecruiterForm) {
            dedicatedRecruiterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletDedicatedRecruiterSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(dedicatedRecruiterForm);
                fetch('{{ route('public.account.dedicated-recruiter-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletDedicatedRecruiterModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var jobPostingAssistanceForm = document.getElementById('walletJobPostingAssistanceForm');
        if (jobPostingAssistanceForm) {
            jobPostingAssistanceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletJobPostingAssistanceSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(jobPostingAssistanceForm);
                fetch('{{ route('public.account.job-posting-assistance-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletJobPostingAssistanceModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletWalkinDriveAdBtn = document.getElementById('walletWalkinDriveAdBtn');
        var walletWalkinDriveAdConfirmModal = document.getElementById('walletWalkinDriveAdConfirmModal');
        if (walletWalkinDriveAdBtn && walletWalkinDriveAdConfirmModal && window.bootstrap) {
            walletWalkinDriveAdBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletWalkinDriveAdConfirmModal)).show();
            });
        }
        var walletWalkinDriveAdConfirmBtn = document.getElementById('walletWalkinDriveAdConfirmBtn');
        if (walletWalkinDriveAdConfirmBtn) {
            walletWalkinDriveAdConfirmBtn.addEventListener('click', function() {
                walletWalkinDriveAdConfirmBtn.disabled = true;
                fetch('{{ route('public.account.walkin-drive-ad.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletWalkinDriveAdConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('walkin_drive_ad_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletWalkinDriveAdModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletWalkinDriveAdConfirmBtn.disabled = false; });
            });
        }

        var walletWalkinDriveAdForm = document.getElementById('walletWalkinDriveAdForm');
        if (walletWalkinDriveAdForm) {
            walletWalkinDriveAdForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletWalkinDriveAdSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(walletWalkinDriveAdForm);
                var csrf = document.querySelector('#walletWalkinDriveAdForm input[name="_token"]');
                if (csrf) formData.set('_token', csrf.value);
                fetch('{{ route('public.account.walkin-drive-ad-request.store') }}', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletWalkinDriveAdModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletMultipleLoginBtn = document.getElementById('walletMultipleLoginBtn');
        var walletMultipleLoginModal = document.getElementById('walletMultipleLoginModal');
        if (walletMultipleLoginBtn && walletMultipleLoginModal && window.bootstrap) {
            walletMultipleLoginModal.addEventListener('show.bs.modal', function() {
                var s1 = document.getElementById('walletMultipleLoginStep1');
                var s2 = document.getElementById('walletMultipleLoginStep2');
                if (s1) s1.style.display = 'block';
                if (s2) s2.style.display = 'none';
            });
            walletMultipleLoginBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletMultipleLoginModal)).show();
            });
        }
        var walletMultipleLoginDeductBtn = document.getElementById('walletMultipleLoginDeductBtn');
        if (walletMultipleLoginDeductBtn) {
            walletMultipleLoginDeductBtn.addEventListener('click', function() {
                walletMultipleLoginDeductBtn.disabled = true;
                fetch('{{ route('public.account.wallet.deduct_multiple_login') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        document.getElementById('walletMultipleLoginStep1').style.display = 'none';
                        document.getElementById('walletMultipleLoginStep2').style.display = 'block';
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletMultipleLoginDeductBtn.disabled = false; });
            });
        }

        var multipleLoginForm = document.getElementById('walletMultipleLoginForm');
        if (multipleLoginForm) {
            multipleLoginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletMultipleLoginSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(multipleLoginForm);
                var body = {};
                formData.forEach(function(v, k) { body[k] = v; });
                fetch('{{ route('public.account.team-members.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(body)
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletMultipleLoginModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Sub-account created.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletSocialPromotionBtn = document.getElementById('walletSocialPromotionBtn');
        var walletSocialPromotionConfirmModal = document.getElementById('walletSocialPromotionConfirmModal');
        if (walletSocialPromotionBtn && walletSocialPromotionConfirmModal && window.bootstrap) {
            walletSocialPromotionBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletSocialPromotionConfirmModal)).show();
            });
        }
        var walletSocialPromotionConfirmBtn = document.getElementById('walletSocialPromotionConfirmBtn');
        if (walletSocialPromotionConfirmBtn) {
            walletSocialPromotionConfirmBtn.addEventListener('click', function() {
                walletSocialPromotionConfirmBtn.disabled = true;
                fetch('{{ route('public.account.social-promotion.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletSocialPromotionConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('social_promotion_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletSocialPromotionModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletSocialPromotionConfirmBtn.disabled = false; });
            });
        }

        var socialPromotionForm = document.getElementById('walletSocialPromotionForm');
        if (socialPromotionForm) {
            socialPromotionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletSocialPromotionSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(socialPromotionForm);
                fetch('{{ route('public.account.social-promotion-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletSocialPromotionModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletDedicatedRecruiterBtn = document.getElementById('walletDedicatedRecruiterBtn');
        var walletDedicatedRecruiterConfirmModal = document.getElementById('walletDedicatedRecruiterConfirmModal');
        if (walletDedicatedRecruiterBtn && walletDedicatedRecruiterConfirmModal && window.bootstrap) {
            walletDedicatedRecruiterBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletDedicatedRecruiterConfirmModal)).show();
            });
        }
        var walletDedicatedRecruiterConfirmBtn = document.getElementById('walletDedicatedRecruiterConfirmBtn');
        if (walletDedicatedRecruiterConfirmBtn) {
            walletDedicatedRecruiterConfirmBtn.addEventListener('click', function() {
                walletDedicatedRecruiterConfirmBtn.disabled = true;
                fetch('{{ route('public.account.dedicated-recruiter.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletDedicatedRecruiterConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('dedicated_recruiter_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletDedicatedRecruiterModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletDedicatedRecruiterConfirmBtn.disabled = false; });
            });
        }

        var dedicatedRecruiterForm = document.getElementById('walletDedicatedRecruiterForm');
        if (dedicatedRecruiterForm) {
            dedicatedRecruiterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletDedicatedRecruiterSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(dedicatedRecruiterForm);
                fetch('{{ route('public.account.dedicated-recruiter-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletDedicatedRecruiterModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var jobPostingAssistanceForm = document.getElementById('walletJobPostingAssistanceForm');
        if (jobPostingAssistanceForm) {
            jobPostingAssistanceForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletJobPostingAssistanceSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(jobPostingAssistanceForm);
                fetch('{{ route('public.account.job-posting-assistance-request.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletJobPostingAssistanceModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletWalkinDriveAdBtn = document.getElementById('walletWalkinDriveAdBtn');
        var walletWalkinDriveAdConfirmModal = document.getElementById('walletWalkinDriveAdConfirmModal');
        if (walletWalkinDriveAdBtn && walletWalkinDriveAdConfirmModal && window.bootstrap) {
            walletWalkinDriveAdBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletWalkinDriveAdConfirmModal)).show();
            });
        }
        var walletWalkinDriveAdConfirmBtn = document.getElementById('walletWalkinDriveAdConfirmBtn');
        if (walletWalkinDriveAdConfirmBtn) {
            walletWalkinDriveAdConfirmBtn.addEventListener('click', function() {
                walletWalkinDriveAdConfirmBtn.disabled = true;
                fetch('{{ route('public.account.walkin-drive-ad.deduct') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var confirmModal = document.getElementById('walletWalkinDriveAdConfirmModal');
                        if (confirmModal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(confirmModal);
                            if (m) m.hide();
                        }
                        var hid = document.getElementById('walkin_drive_ad_credits_deducted');
                        if (hid) hid.value = '1';
                        alert(data.message || (data.data && data.data.message) || '{{ __('Credits deducted.') }}');
                        var formModal = document.getElementById('walletWalkinDriveAdModal');
                        if (formModal && window.bootstrap) {
                            (new bootstrap.Modal(formModal)).show();
                        }
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletWalkinDriveAdConfirmBtn.disabled = false; });
            });
        }

        var walletWalkinDriveAdForm = document.getElementById('walletWalkinDriveAdForm');
        if (walletWalkinDriveAdForm) {
            walletWalkinDriveAdForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletWalkinDriveAdSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(walletWalkinDriveAdForm);
                var csrf = document.querySelector('#walletWalkinDriveAdForm input[name="_token"]');
                if (csrf) formData.set('_token', csrf.value);
                fetch('{{ route('public.account.walkin-drive-ad-request.store') }}', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletWalkinDriveAdModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request submitted.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }

        var walletMultipleLoginBtn = document.getElementById('walletMultipleLoginBtn');
        var walletMultipleLoginModal = document.getElementById('walletMultipleLoginModal');
        if (walletMultipleLoginBtn && walletMultipleLoginModal && window.bootstrap) {
            walletMultipleLoginModal.addEventListener('show.bs.modal', function() {
                var s1 = document.getElementById('walletMultipleLoginStep1');
                var s2 = document.getElementById('walletMultipleLoginStep2');
                if (s1) s1.style.display = 'block';
                if (s2) s2.style.display = 'none';
            });
            walletMultipleLoginBtn.addEventListener('click', function() {
                (new bootstrap.Modal(walletMultipleLoginModal)).show();
            });
        }
        var walletMultipleLoginDeductBtn = document.getElementById('walletMultipleLoginDeductBtn');
        if (walletMultipleLoginDeductBtn) {
            walletMultipleLoginDeductBtn.addEventListener('click', function() {
                walletMultipleLoginDeductBtn.disabled = true;
                fetch('{{ route('public.account.wallet.deduct_multiple_login') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        document.getElementById('walletMultipleLoginStep1').style.display = 'none';
                        document.getElementById('walletMultipleLoginStep2').style.display = 'block';
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() { alert('{{ __('Something went wrong.') }}'); })
                .finally(function() { walletMultipleLoginDeductBtn.disabled = false; });
            });
        }

        var multipleLoginForm = document.getElementById('walletMultipleLoginForm');
        if (multipleLoginForm) {
            multipleLoginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var submitBtn = document.getElementById('walletMultipleLoginSubmitBtn');
                if (submitBtn) submitBtn.disabled = true;
                var formData = new FormData(multipleLoginForm);
                var body = {};
                formData.forEach(function(v, k) { body[k] = v; });
                fetch('{{ route('public.account.team-members.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(body)
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    var ok = data.error === false || (data.data && data.data.error === false);
                    if (ok) {
                        var modal = document.getElementById('walletMultipleLoginModal');
                        if (modal && window.bootstrap) {
                            var m = bootstrap.Modal.getInstance(modal);
                            if (m) m.hide();
                        }
                        alert(data.message || (data.data && data.data.message) || '{{ __('Sub-account created.') }}');
                        if (typeof window.location !== 'undefined') window.location.reload();
                    } else {
                        alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
                    }
                })
                .catch(function() {
                    alert('{{ __('Something went wrong.') }}');
                })
                .finally(function() { if (submitBtn) submitBtn.disabled = false; });
            });
        }
    });
    </script>
    @endpush

    {{-- Pending credit requests (Social Promotion + Dedicated Recruiter: credits deducted when admin approves) --}}
    @php
        $hasPendingSocial = $account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests->where('status', 'pending')->isNotEmpty();
        $hasPendingDR = $account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests->where('status', 'pending')->isNotEmpty();
        $hasAnyPending = $hasPendingSocial || $hasPendingDR;
    @endphp
    @if($hasAnyPending)
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-clock" class="me-2" />
                {{ __('Pending requests') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            <p class="small text-muted px-3 pt-2 mb-0">{{ __('Credits will be deducted when admin approves.') }}</p>
            <ul class="list-group list-group-flush">
                @foreach(($socialPromotionRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Social Promotion') }} – {{ $req->platform ?: __('Social') }}
                            @if($req->title)<span class="text-muted">({{ \Illuminate\Support\Str::limit($req->title, 40) }})</span>@endif
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
                @foreach(($dedicatedRecruiterRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
            </ul>
        </x-core::card.body>
    </x-core::card>
    @endif

    {{-- Pending credit requests (Social Promotion + Dedicated Recruiter: credits deducted when admin approves) --}}
    @php
        $hasPendingSocial = $account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests->where('status', 'pending')->isNotEmpty();
        $hasPendingDR = $account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests->where('status', 'pending')->isNotEmpty();
        $hasAnyPending = $hasPendingSocial || $hasPendingDR;
    @endphp
    @if($hasAnyPending)
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-clock" class="me-2" />
                {{ __('Pending requests') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            <p class="small text-muted px-3 pt-2 mb-0">{{ __('Credits will be deducted when admin approves.') }}</p>
            <ul class="list-group list-group-flush">
                @foreach(($socialPromotionRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Social Promotion') }} – {{ $req->platform ?: __('Social') }}
                            @if($req->title)<span class="text-muted">({{ \Illuminate\Support\Str::limit($req->title, 40) }})</span>@endif
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
                @foreach(($dedicatedRecruiterRequests ?? collect())->where('status', 'pending') as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            {{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}
                            <br><small class="text-muted">{{ __('Requested') }}: {{ $req->requested_at ? $req->requested_at->format('M d, Y H:i') : '—' }}</small>
                        </span>
                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                    </li>
                @endforeach
            </ul>
        </x-core::card.body>
    </x-core::card>
    @endif

    <div class="wallet-consumption-invoice-section">
    {{-- Consumption Report (includes pending requests) – hidden for consultancy --}}
    @unless($isConsultancy)
    @php
        $transactionStatusMap = $transactionStatusMap ?? [];
        $allSocialRequests = ($account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests) ? $socialPromotionRequests : collect();
        $allDRRequests = ($account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests) ? $dedicatedRecruiterRequests : collect();
        $hasRequestRows = $allSocialRequests->isNotEmpty() || $allDRRequests->isNotEmpty();
        $hasTransactions = $transactions->isNotEmpty();
        $showConsumptionTable = $hasTransactions || $hasRequestRows;
    @endphp
    {{-- Consumption Report (includes pending requests) – hidden for consultancy --}}
    @unless($isConsultancy)
    @php
        $transactionStatusMap = $transactionStatusMap ?? [];
        $allSocialRequests = ($account->isEmployer() && isset($socialPromotionRequests) && $socialPromotionRequests) ? $socialPromotionRequests : collect();
        $allDRRequests = ($account->isEmployer() && isset($dedicatedRecruiterRequests) && $dedicatedRecruiterRequests) ? $dedicatedRecruiterRequests : collect();
        $hasRequestRows = $allSocialRequests->isNotEmpty() || $allDRRequests->isNotEmpty();
        $hasTransactions = $transactions->isNotEmpty();
        $showConsumptionTable = $hasTransactions || $hasRequestRows;
    @endphp
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-report-money" class="me-2" />
                {{ trans('plugins/job-board::dashboard.wallet_consumption_report') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            @if($showConsumptionTable)
            @if($showConsumptionTable)
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0 wallet-consumption-table" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                                <th class="wallet-th-type">{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                                <th>{{ __('Package') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_valid_till') }}</th>
                                <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount_coins') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_status') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $runningBalance = $account->credits;
                                $sn = 0;
                                $packageValidFeatures = [\Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_JOB, \Botble\JobBoard\Models\CreditConsumption::FEATURE_FEATURED_PROFILE_EMPLOYER, \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADMISSION_ENQUIRY, \Botble\JobBoard\Models\CreditConsumption::FEATURE_JOB_POSTING_ASSISTANCE];
                                $socialPromotionCredits = 3000;
                                $dedicatedRecruiterCredits = 2500;
                                $socialPromotionCredits = 3000;
                                $dedicatedRecruiterCredits = 2500;
                            @endphp
                            {{-- Social Promotion & Dedicated Recruiter: sab dikhao – Pending / Approved / Rejected --}}
                            @foreach($allSocialRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}@if($req->title) – {{ \Illuminate\Support\Str::limit($req->title, 30) }}@endif</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($socialPromotionCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($allDRRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($dedicatedRecruiterCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            {{-- Social Promotion & Dedicated Recruiter: sab dikhao – Pending / Approved / Rejected --}}
                            @foreach($allSocialRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Post/Promote on LinkedIn/Other Social Pages') }}@if($req->title) – {{ \Illuminate\Support\Str::limit($req->title, 30) }}@endif</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($socialPromotionCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($allDRRequests as $req)
                                @php
                                    $sn++;
                                    $reqStatus = $req->status ?? 'pending';
                                    $statusBadge = $reqStatus === 'accepted' ? 'bg-success' : ($reqStatus === 'rejected' ? 'bg-danger' : 'bg-warning');
                                    $statusLabel = $reqStatus === 'accepted' ? __('Approved') : ($reqStatus === 'rejected' ? __('Rejected') : __('Pending'));
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $req->requested_at ? $req->requested_at->format('M d, Y') : '—' }}</td>
                                    <td class="wallet-txn-description">{{ __('Dedicated Recruiter / Personal Account Manager') }} – {{ $req->duration_months }} {{ __('month(s)') }}</td>
                                    <td>—</td>
                                    <td class="text-nowrap small">—</td>
                                    <td class="text-end"><span class="text-warning fw-medium">-{{ format_credits_short($dedicatedRecruiterCredits) }}</span></td>
                                    <td><span class="badge {{ $statusBadge }} text-white">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                            @foreach($transactions as $txn)
                                @php
                                    $skipTxn = !$txn->isCredit() && in_array($txn->feature_key ?? '', [\Botble\JobBoard\Models\CreditConsumption::FEATURE_SOCIAL_PROMOTION, \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER], true);
                                @endphp
                                @if($skipTxn)
                                    @continue
                                @endif
                                @php
                                    $skipTxn = !$txn->isCredit() && in_array($txn->feature_key ?? '', [\Botble\JobBoard\Models\CreditConsumption::FEATURE_SOCIAL_PROMOTION, \Botble\JobBoard\Models\CreditConsumption::FEATURE_DEDICATED_RECRUITER], true);
                                @endphp
                                @if($skipTxn)
                                    @continue
                                @endif
                                @php
                                    $sn++;
                                    $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    $showValidTill = !$txn->isCredit() && isset($packageExpiryAt) && $packageExpiryAt && in_array($txn->feature_key ?? '', $packageValidFeatures);
                                @endphp
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td class="text-nowrap">{{ $txn->created_at->format('M d, Y') }}</td>
                                    <td class="text-nowrap">{{ $txn->created_at->format('M d, Y') }}</td>
                                    <td class="wallet-txn-description">{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                    <td>{{ $txn->package_name ?? '—' }}</td>
                                    <td class="text-nowrap small">
                                        @if($showValidTill)
                                            <span class="text-success">{{ $packageExpiryAt->format('M d, Y') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($txn->isCredit())
                                            <span class="text-success fw-medium">+{{ format_credits_short($txn->credits) }}</span>
                                        @else
                                            <span class="text-danger fw-medium">-{{ format_credits_short($txn->credits) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $txnStatus = $transactionStatusMap[$txn->id] ?? null;
                                        @endphp
                                        @if($txnStatus === 'approved')
                                            <span class="badge bg-success text-white">{{ __('Approved') }}</span>
                                        @elseif($txnStatus === 'rejected')
                                            <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                        @elseif($txnStatus === 'pending')
                                            <span class="badge bg-warning text-white">{{ __('Pending') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $txnStatus = $transactionStatusMap[$txn->id] ?? null;
                                        @endphp
                                        @if($txnStatus === 'approved')
                                            <span class="badge bg-success text-white">{{ __('Approved') }}</span>
                                        @elseif($txnStatus === 'rejected')
                                            <span class="badge bg-danger text-white">{{ __('Rejected') }}</span>
                                        @elseif($txnStatus === 'pending')
                                            <span class="badge bg-warning text-white">{{ __('Pending') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($transactions->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        {{ $transactions->links() }}
                    </div>
                @endif
            @else
                <div class="empty p-5 text-center">
                    <x-core::icon name="ti ti-receipt-off" class="display-4 text-muted" />
                    <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_consumption_yet') }}</p>
                    <x-core::button tag="a" :href="route('public.account.packages')" color="primary" size="sm">
                        {{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}
                    </x-core::button>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>
    @endunless
    @endunless

    {{-- Invoice details (employer only) --}}
    <x-core::card>
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-file-invoice" class="me-2" />
                {{ trans('plugins/job-board::dashboard.wallet_invoice_details') }}
            </x-core::card.title>
            <x-core::card.actions>
                <x-core::button tag="a" :href="route('public.account.invoices.index')" size="sm">
                    {{ trans('plugins/job-board::messages.view') }} {{ trans('plugins/job-board::messages.invoices') }}
                </x-core::button>
            </x-core::card.actions>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            @if($invoices->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_code') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_amount') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_status') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_invoice_date') }}</th>
                                <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                @php
                                    $invoice->loadMissing('payment');
                                    $payment = $invoice->payment;
                                    $currency = $payment ? \Botble\JobBoard\Models\Currency::query()->where('title', strtoupper($payment->currency))->first() : null;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('public.account.invoices.show', $invoice) }}" class="text-primary text-decoration-none fw-medium">#{{ $invoice->code }}</a>
                                    </td>
                                    <td>{{ format_price($invoice->amount, $currency) }}</td>
                                    <td>
                                        <x-core::badge :color="$invoice->status->getValue() === 'completed' ? 'success' : 'warning'">
                                            {{ $invoice->status->label() }}
                                        </x-core::badge>
                                    </td>
                                    <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <x-core::button tag="a" :href="route('public.account.invoices.show', $invoice)" size="sm" color="default" icon="ti ti-eye">
                                            {{ trans('plugins/job-board::dashboard.wallet_view_invoice') }}
                                        </x-core::button>
                                        <x-core::button tag="a" :href="route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])" size="sm" color="primary" icon="ti ti-download" target="_blank" rel="noopener" download>
                                            {{ trans('plugins/job-board::dashboard.wallet_download_invoice') }}
                                        </x-core::button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($invoices->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        {{ $invoices->withQueryString()->links() }}
                    </div>
                @endif
            @else
                <div class="empty p-5 text-center">
                    <x-core::icon name="ti ti-file-off" class="display-4 text-muted" />
                    <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_invoices') }}</p>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>
    </div>{{-- .wallet-consumption-invoice-section --}}
    </div>{{-- .wallet-em-page --}}

    {{-- Billing Details Modal --}}
    <div class="modal fade" id="walletBillingModal" tabindex="-1" aria-labelledby="walletBillingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="walletBillingModalLabel">{{ __('Billing Details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="walletBillingForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="billing_name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="billing_name" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_address">{{ __('Address') }}</label>
                            <textarea class="form-control" id="billing_address" name="address" rows="2" placeholder="{{ __('Address with City, State, Pin Code') }}"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_mobile">{{ __('Mobile No') }}</label>
                            <input type="text" class="form-control" id="billing_mobile" name="mobile" placeholder="{{ __('Mobile No') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="billing_state">{{ __('State') }}</label>
                            <input type="text" class="form-control" id="billing_state" name="state" placeholder="{{ __('State') }}">
                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="billing_gst">{{ __('GST No') }}</label>
                            <input type="text" class="form-control" id="billing_gst" name="gst_number" placeholder="{{ __('GST No (if available)') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary" id="walletBillingSubmit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Package expiring / expired popup --}}
    @if(isset($packageExpiryAt) && $packageExpiryAt && isset($packageExpiryName))
        @php
            $now = \Carbon\Carbon::now();
            $isExpired = $packageExpiryAt->isPast();
            $daysUntilExpiry = (int) $now->diffInDays($packageExpiryAt, true);
            $expiringSoon = !$isExpired && $daysUntilExpiry <= 7;
        @endphp
        @if($isExpired || $expiringSoon)
            <div class="modal fade" id="walletPackageExpiryModal" tabindex="-1" aria-labelledby="walletPackageExpiryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header {{ $isExpired ? 'bg-danger text-white' : 'bg-warning' }}">
                            <h5 class="modal-title" id="walletPackageExpiryModalLabel">{{ $isExpired ? __('Package Expired') : __('Package Expiring Soon') }}</h5>
                            <button type="button" class="btn-close {{ $isExpired ? 'btn-close-white' : '' }}" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if($isExpired)
                                <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_package_expired', ['name' => $packageExpiryName]) }}</p>
                            @else
                                <p class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_package_expiring_soon', ['name' => $packageExpiryName, 'date' => $packageExpiryAt->format('M d, Y')]) }}</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <a href="#choose-plan" class="btn btn-primary" data-bs-dismiss="modal">{{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@push('footer')
<script>
(function () {
    var modalEl = document.getElementById('walletRechargeModal');
    var formEl = document.getElementById('walletRechargeForm');
    var amountEl = document.getElementById('walletRechargeAmount');
    var errEl = document.getElementById('walletRechargeErr');

    // Modal is not rendered for consultancy accounts.
    if (!modalEl || !formEl || !amountEl) {
        return;
    }

    if (modalEl) {
        modalEl.addEventListener('shown.bs.modal', function () {
            if (amountEl) {
                amountEl.focus();
                amountEl.select();
            }
        });
    }

    function showErr(msg) {
        if (!errEl) return;
        errEl.textContent = msg;
        errEl.classList.remove('d-none');
    }
    function clearErr() {
        if (!errEl) return;
        errEl.textContent = '';
        errEl.classList.add('d-none');
    }

    if (amountEl) {
        amountEl.addEventListener('input', clearErr);
    }

    if (formEl) {
        formEl.addEventListener('submit', function (e) {
            clearErr();
            var v = parseInt((amountEl && amountEl.value) ? amountEl.value : '0', 10);
            if (!v || isNaN(v) || v < 1000) {
                e.preventDefault();
                showErr('Minimum recharge amount is ₹1000.');
            }
        });
    }
})();
</script>
@endpush

@push('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var expiryModal = document.getElementById('walletPackageExpiryModal');
    if (expiryModal && typeof bootstrap !== 'undefined') {
        var m = new bootstrap.Modal(expiryModal);
        m.show();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('walletBillingModal');
    var form = document.getElementById('walletBillingForm');
    var submitBtn = document.getElementById('walletBillingSubmit');
    if (!modal || !form) return;
    var billingDetailsUrl = '{{ route("public.account.billing-details") }}';
    var billingUpdateUrl = '{{ route("public.account.billing-details.update") }}';

    modal.addEventListener('show.bs.modal', function() {
        fetch(billingDetailsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.data) {
                    document.getElementById('billing_name').value = data.data.name || '';
                    document.getElementById('billing_address').value = data.data.address || '';
                    document.getElementById('billing_mobile').value = data.data.mobile || '';
                    document.getElementById('billing_state').value = data.data.state || '';
                    document.getElementById('billing_gst').value = data.data.gst_number || '';
                }
            })
            .catch(function() {});
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        var fd = new FormData(form);
        fetch(billingUpdateUrl, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || fd.get('_token') }
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error === false) {
                window.location.reload();
            } else {
                submitBtn.disabled = false;
                alert(res.message || 'Something went wrong.');
            }
        })
        .catch(function() { submitBtn.disabled = false; });
    });
});
</script>
@endpush
