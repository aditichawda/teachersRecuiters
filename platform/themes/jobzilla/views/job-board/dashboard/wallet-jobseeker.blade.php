@php
    Theme::set('pageTitle', trans('plugins/job-board::dashboard.menu.wallet'));
@endphp
@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <style>
    /* Same blue card & package layout as employer wallet (wallet-em-page) */
    .wallet-js-page .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 0.60rem 1.25rem !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
    .wallet-js-page .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
    .wallet-js-page .wallet-js-card-blue .card-footer { border: none !important; padding: 0.75rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-title {color: #fff !important; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.35rem; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.35rem; }
    .wallet-js-page .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.8rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.2rem; }
    .wallet-js-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-blue,
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
    .wallet-js-page .row.mb-4:first-of-type .col-lg-3 { display: flex !important; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-two-cols { flex: 1 1 100%; display: flex !important; min-height: 0; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-col-blue { display: flex !important; }
    .wallet-js-page .row.mb-4:first-of-type .wallet-js-col-blue .card { flex: 1 1 auto !important; display: flex !important; }
    /* Package cards: same as employer (wallet-em-page) */
    .wallet-js-page .wallet-js-packages-row { display: flex !important; flex-wrap: wrap !important; align-items: stretch !important; }
    .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 1 1 0 !important; min-width: 200px; display: flex !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card { display: flex !important; flex-direction: column !important; flex: 1 1 100% !important; min-height: 200px !important; background: #fff !important; border-radius: 12px !important; box-shadow: 0 1px 4px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; padding: 1rem 1.25rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-package-card-actions { margin-top: auto !important; padding-top: 0.75rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body h6 { font-size: 0.75rem !important; font-weight: 500 !important; color: #212529 !important; margin-bottom: 0.35rem !important; text-transform: uppercase !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-card .card-body .wallet-em-credits-validity { font-size: 0.775rem !important; color: #495057 !important; margin-bottom: 0.5rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-price { font-size: 0.75rem !important; font-weight: 500 !important; color: #1a1a2e !important; margin-bottom: 0.5rem !important; }
    .wallet-js-page .wallet-js-packages-row .wallet-package-main-desc { font-size: 0.77rem !important; color: #6c757d !important; line-height: 1.5 !important; margin-bottom: 0 !important; }
    .wallet-js-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; }
    .wallet-js-page .wallet-package-card-current { border: 2px solid #198754 !important; box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.2); position: relative; }
    .wallet-js-page .wallet-package-card-current .wallet-current-badge { position: absolute; top: 0.5rem; right: 0.5rem; font-size: 0.65rem; font-weight: 600; text-transform: uppercase; background: #198754; color: #fff; padding: 0.2rem 0.5rem; border-radius: 6px; }
    @media (max-width: 991px) {
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 calc(50% - 1rem) !important; min-width: 180px; }
    }
    @media (max-width: 575px) {
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 100% !important; min-width: 0; }
        .wallet-js-page .wallet-js-packages-row .wallet-package-card { min-height: 180px !important; }
    }
    /* Consumption Report & Invoice Details - same UI as employer (shared section) */
    .wallet-consumption-invoice-section .card { background: #fff !important; border-radius: 10px !important; box-shadow: 0 1px 3px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; overflow: hidden; }
    .wallet-consumption-invoice-section .card .card-header {display: flex !important;
        justify-content: space-between !important;  background: #fff !important; border-bottom: 1px solid rgba(0,0,0,0.08) !important; padding: 1rem 1.25rem !important; }
    .wallet-consumption-invoice-section .card .card-title { font-size: 1rem !important; font-weight: 600 !important; color: #1a1a2e !important; margin: 0 !important; display: flex !important; align-items: center !important; }
    .wallet-consumption-invoice-section .table { font-size: 0.9rem; }
    /* Remove all table borders (override .table > :not(:first-child) { border-top: 2px solid currentColor } etc) */
    .wallet-consumption-invoice-section .table > :not(:first-child) { border-top: none !important; }
    .wallet-consumption-invoice-section .table > :not(caption) > * > * { border: none !important; border-top: none !important; }
    .wallet-consumption-invoice-section .table thead th { font-weight: 600 !important; color: #495057 !important; text-transform: uppercase !important; font-size: 0.7rem !important; letter-spacing: 0.03em !important; padding: 0.75rem 1rem !important; background: #f8f9fa !important; border: none !important; border-bottom: 1px solid #dee2e6 !important; text-align: left !important; }
    .wallet-consumption-invoice-section .table tbody tr { border-bottom: none !important; border-top: none !important; background: #fff !important; }
    .wallet-consumption-invoice-section .table tbody td { padding: 0.75rem 1rem !important; vertical-align: middle !important; color: #212529 !important; border: none !important; text-align: left !important; }
    .wallet-consumption-invoice-section .table tbody td.text-end { text-align: right !important; }
    .wallet-consumption-invoice-section .table a.text-primary { color: #0d6efd !important; text-decoration: none !important; font-weight: 500 !important; }
    .wallet-consumption-invoice-section .table a.text-primary:hover { text-decoration: underline !important; }
    .wallet-consumption-invoice-section .card-actions .btn { background: #6c757d !important; border-color: #6c757d !important; color: #fff !important; font-size: 0.875rem !important; border-radius: 6px !important; }
    .wallet-consumption-invoice-section .card-actions .btn:hover { background: #5a6268 !important; border-color: #545b62 !important; color: #fff !important; }
    /* View = outline grey, Download = blue - same as screenshot */
    .wallet-consumption-invoice-section .card-body .text-end .btn { font-size: 0.875rem !important; font-weight: 400 !important; display: inline-flex !important; align-items: center !important; border-radius: 6px !important; padding: 0.35rem 0.65rem !important; }
    .wallet-consumption-invoice-section .card-body .btn-default { background: #fff !important; border: 1px solid #6c757d !important; color: #495057 !important; }
    .wallet-consumption-invoice-section .card-body .btn-primary { background: #007bff !important; border: none !important; color: #fff !important; }
    .wallet-consumption-invoice-section .card-body .text-end .btn + .btn { margin-left: 0.4rem !important; }
    /* Consumption Report: 6 cols - S.No, Date, Type, Package, Coins, Current Balance - clear UI */
    .wallet-consumption-invoice-section .table-responsive { overflow-x: visible !important; }
    .wallet-consumption-invoice-section .wallet-consumption-table { table-layout: fixed !important; width: 100% !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th { background: #f1f5f9 !important; color: #334155 !important; font-weight: 600 !important; font-size: 0.75rem !important; text-transform: uppercase !important; letter-spacing: 0.02em !important; padding: 0.65rem 0.5rem !important; border-bottom: 2px solid #e2e8f0 !important; word-break: break-word !important; overflow-wrap: break-word !important; line-height: 1.25 !important; }
.wallet-consumption-invoice-section .wallet-consumption-table thead th.wallet-th-type { white-space: normal !important; }
.wallet-consumption-invoice-section .wallet-consumption-table tbody td { padding: 0.85rem 0.5rem !important; vertical-align: top !important; border-bottom: 1px solid #f1f5f9 !important; font-size: 0.9rem !important; }
.wallet-consumption-invoice-section .wallet-consumption-table .wallet-txn-description { display: block !important; line-height: 1.5 !important; word-break: break-word !important; white-space: normal !important; }
    /* Recharge: white CTA on blue card + modal (matches package “Buy Now” feel) */
    .wallet-js-card-blue .wallet-recharge-trigger { width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; margin: 0; padding: 0.3rem 0.2rem; font-size: 14px; font-weight: 500; letter-spacing: 0.02em; color: #000; background: #f59e0b; border: none; border-radius: 5px; box-shadow: 0 4px 14px rgba(0,0,0,0.15); cursor: pointer; transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease, color 0.15s ease; }
    .wallet-js-card-blue .wallet-recharge-trigger:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,0.22); background: #f8fbff; color: #0a58ca; }
    .wallet-js-card-blue .wallet-recharge-trigger:active:not(:disabled) { transform: translateY(0); }
    .wallet-js-card-blue .wallet-recharge-trigger:disabled { opacity: 0.55; cursor: not-allowed; box-shadow: none; }
    .wallet-js-card-blue .wallet-recharge-trigger svg, .wallet-js-card-blue .wallet-recharge-trigger .icon { font-size: 1.15rem; flex-shrink: 0; }
    .wallet-js-card-blue .wallet-recharge-hint { font-size: 0.75rem; opacity: 0.9; margin-top: 0.5rem; text-align: center; line-height: 1.35; }
    .wallet-recharge-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(13, 110, 253, 0.15), 0 8px 24px rgba(0,0,0,0.1); }
    .wallet-recharge-modal .modal-header { background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: #fff; border-bottom: none; padding: 1rem 1.25rem; }
    .wallet-recharge-modal .modal-header .modal-title { color: #fff; font-weight: 700; font-size: 1.05rem; }
    .wallet-recharge-modal .modal-header .modal-title .icon, .wallet-recharge-modal .modal-header .modal-title svg { color: #fde047 !important; filter: none; }
    .wallet-recharge-modal .modal-header .btn-close { filter: none; opacity: 0.92; box-shadow: none !important; }
    .wallet-recharge-modal .modal-header .btn-close:hover,
    .wallet-recharge-modal .modal-header .btn-close:focus,
    .wallet-recharge-modal .modal-header .btn-close:focus-visible {color:white; opacity: 0.92; box-shadow: none !important; }
    .wallet-recharge-modal .modal-content { background: #fff !important; color: #212529 !important; }
    .wallet-recharge-modal .modal-body { padding: 1.25rem 1.35rem; background: #fff !important; color: #212529 !important; }
    .wallet-recharge-modal .modal-body .form-label,
    .wallet-recharge-modal .modal-body .text-muted { color: #6c757d !important; }
    .wallet-recharge-modal .wallet-recharge-input { border-radius: 10px; border: 2px solid #e2e8f0; padding: 0.65rem 0.85rem; font-size: 1rem; font-weight: 600; }
    .wallet-recharge-modal .wallet-recharge-input:focus { border-color: #0d6efd; box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15); }
    .wallet-recharge-modal .modal-footer {background: #fff !important;   padding: 1rem 1.25rem; gap: 0.65rem; flex-wrap: wrap; justify-content: flex-end; }
    .wallet-recharge-modal .btn-rc-cancel, .wallet-recharge-modal .btn-rc-pay { display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem; padding: 0.6rem 1.15rem; font-weight: 600; font-size: 0.9rem; border-radius: 10px; transition: transform 0.12s ease, box-shadow 0.12s ease; }
    .wallet-recharge-modal .btn-rc-cancel { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
    .wallet-recharge-modal .btn-rc-cancel:hover { background: #e2e8f0; color: #334155; }
    .wallet-recharge-modal .btn-rc-pay { background: linear-gradient(180deg, #2563eb 0%, #0d6efd 100%); color: #fff !important; border: none; box-shadow: 0 4px 12px rgba(13, 110, 253, 0.35); }
    .wallet-recharge-modal .btn-rc-pay:hover { color: #fff !important; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(13, 110, 253, 0.45); }
    .wallet-recharge-modal .wallet-recharge-err-alert { border-radius: 10px; font-size: 0.875rem; }
   </style>
    <div class="wallet-js-page">
        @php
            $hasActivePackage = isset($jobSeekerCtx) && $jobSeekerCtx && $jobSeekerCtx->hasPackage();

            $defaultFreePackage = null;
            if (! empty($packages)) {
                foreach ($packages as $p) {
                    $isFree = (float) ($p->price ?? 0) == 0;
                    if ($isFree) {
                        $defaultFreePackage = $p;
                        break;
                    }
                }
                if (! $defaultFreePackage) {
                    foreach ($packages as $p) {
                        if (($p->is_default ?? false) && isset($p->id)) {
                            $defaultFreePackage = $p;
                            break;
                        }
                    }
                }
            }

            $effectiveCurrentPackageIds = $currentPackageIds ?? [];
            // If job seeker has NO active purchased package, always highlight the free/basic package as CURRENT.
            if (! $hasActivePackage && $defaultFreePackage && isset($defaultFreePackage->id)) {
                $effectiveCurrentPackageIds = [$defaultFreePackage->id];
            }
        @endphp
        <div class="row mb-4">
            <div class="col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="wallet-js-two-cols">
                    <div class="wallet-js-col-blue">
                        <x-core::card class="border-0 wallet-js-card-blue">
                            <x-core::card.body class="p-0">
                                <h6 class="wallet-js-coins-title mb-0 text-uppercase">{{ trans('plugins/job-board::dashboard.wallet_available_coins') }}</h6>
                                <div class="wallet-js-coins-value">
                                    <x-core::icon name="ti ti-coin" class="d-block" style="font-size:1.25rem;" />
                                    {{ format_credits_short($account->credits ?? 0) }}
                                </div>
                               <div class="wallet-js-coins-row">
                                    <x-core::icon name="ti ti-coin" />
                                    {{ trans('plugins/job-board::dashboard.wallet_purchased') }} {{ format_credits_short($purchasedCredits ?? 0) }}
                                </div>
                                @php
                                    $fallbackPlanName = $defaultFreePackage->name ?? __('Basic (Free)');
                                    if ($defaultFreePackage && (float) ($defaultFreePackage->price ?? 0) == 0 && ! str_contains(strtolower($fallbackPlanName), 'free')) {
                                        $fallbackPlanName .= ' (' . __('Free') . ')';
                                    }
                                    $currentPlanName = $hasActivePackage
                                        ? ($jobSeekerCtx->package->name ?? $fallbackPlanName)
                                        : $fallbackPlanName;
                                    $used = $jobSeekerCtx->jobApplicationsUsed ?? 0;
                                    $limit = $jobSeekerCtx->jobApplyLimit ?? null;
                                @endphp

                                <div class="wallet-js-coins-row">
                                    <span class="small opacity-95">{{ __('Current plan') }}:</span>
                                    <span class="small fw-semibold ms-1">{{ $currentPlanName }}</span>
                                </div>

                                @if($hasActivePackage)
                                    <div class="wallet-js-coins-row">
                                        <span class="small opacity-95">{{ __('Package expires on') }}:</span>
                                        <span class="small ms-1">
                                            @if(isset($packageExpiryAt) && $packageExpiryAt)
                                                {{ $packageExpiryAt->format('M d, Y') }}
                                            @else
                                                {{ __('Unlimited') }}
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                <div class="wallet-js-coins-row">
                                    <span class="small opacity-95">{{ __('Job applications') }}:</span>
                                    <span class="small ms-1">
                                        @if($limit === null)
                                            {{ __('Unlimited') }}
                                        @else
                                            {{ $used }}/{{ $limit }}
                                        @endif
                                    </span>
                                </div>
                            </x-core::card.body>
                            <x-core::card.footer class="py-2">
                               
                                <button type="button" class="wallet-recharge-trigger" data-bs-toggle="modal" data-bs-target="#walletRechargeModal"><x-core::icon name="ti ti-wallet" />{{ __('Recharge Wallet') }}</button>
                                <div class="wallet-recharge-hint text-white">{{ __('Minimum recharge ₹100.') }}</div>
                            </x-core::card.footer>
                        </x-core::card>
                    </div>
                   
                </div>
            </div>
            <div class="col-lg-9 col-xl-9">
                <div class="d-flex justify-content-between align-items-center mb-2" id="choose-plan">
                    <h5 class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_choose_plan_jobseeker') }}</h5>
                    <small class="text-muted">{{ trans('plugins/job-board::dashboard.wallet_all_prices_gst') }}</small>
                </div>
                <div class="row wallet-js-packages-row g-3">
                    @foreach($packages ?? [] as $package)
                        @php $isCurrentPackage = in_array($package->id, $effectiveCurrentPackageIds ?? []); @endphp
                        <div class="col wallet-js-package-col">
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
                                    <p class="wallet-em-credits-validity">{{ format_credits_short($package->credits_included ?? $package->number_of_listings) }} {{ trans('plugins/job-board::dashboard.credits') }}@if($package->validity_days) · {{ trans('plugins/job-board::dashboard.package_validity_days', ['days' => $package->validity_days]) }}@else · {{ __('Unlimited validity') }}@endif</p>
                                    @php
                                        $basePrice = (float) ($package->price ?? 0);
                                        $gstRate = 0.18;
                                        $gstAmount = $basePrice > 0 ? round($basePrice * $gstRate, 2) : 0;
                                        $totalWithGst = $basePrice > 0 ? ($basePrice + $gstAmount) : 0;
                                        $currency = $package->currency ?? null;
                                    @endphp
                                    <div class="wallet-package-price">
                                        @if($basePrice == 0)
                                            <div>{{ __('Free') }}</div>
                                        @else
                                            <div>{{ format_price($totalWithGst, $currency) }} <small class="text-muted">({{ __('incl. GST') }})</small></div>
                                            <div class="small text-muted">{{ __('Base') }}: {{ format_price($basePrice, $currency) }} · {{ __('GST (18%)') }}: {{ format_price($gstAmount, $currency) }}</div>
                                        @endif
                                    </div>
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

        {{-- Recharge Wallet Modal (Job Seeker) --}}
        <div class="modal fade wallet-recharge-modal" id="walletRechargeModal" tabindex="-1" aria-labelledby="walletRechargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center gap-2 mb-0" id="walletRechargeModalLabel"><x-core::icon name="ti ti-wallet" />{{ __('Recharge Wallet') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                    </div>
                    <x-core::form :url="route('public.account.jobseeker.wallet.recharge.start')" method="post" id="walletRechargeForm">
                        <div class="modal-body">
                            <p class="small text-muted mb-3">{{ __('1 INR = 1 Coin. Minimum recharge ₹100.') }}</p>
                            <div class="alert alert-danger py-2 px-3 mb-3 d-none wallet-recharge-err-alert" id="walletRechargeErr" role="alert"></div>
                            <label class="form-label fw-semibold" for="walletRechargeAmount">{{ __('Enter amount (INR)') }}</label>
                            <input type="number" name="amount_inr" id="walletRechargeAmount" class="form-control wallet-recharge-input" min="100" step="1" value="{{ old('amount_inr', 100) }}" placeholder="100" required>
                            <div class="invalid-feedback d-block" id="walletRechargeError" style="min-height:0;"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-rc-cancel" data-bs-dismiss="modal"><x-core::icon name="ti ti-x" />{{ __('Cancel') }}</button>
                            <button type="submit" class="btn-rc-pay"><x-core::icon name="ti ti-credit-card" />{{ __('Proceed to Pay') }}</button>
                        </div>
                    </x-core::form>
                </div>
            </div>
        </div>

        {{-- Row: Billing | Coins Consumption | Key Features (same as employer layout, each 12 col) --}}
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-3 mb-3">
                <x-core::card class="h-100">
                    <x-core::card.header>
                        <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_billing_details') }}</x-core::card.title>
                    </x-core::card.header>
                    <x-core::card.body>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#walletBillingModal">{{ __('Add Remaining Details') }}</button>
                        <div class="mt-2 small" id="wallet-remaining-details">
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
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
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
                                $consumption = trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
                                $consumptionList = is_array($consumption) ? $consumption : [];
                            }
                        @endphp
                        <ul class="list-unstyled mb-0">
                            @if(!empty($creditConsumption))
                                @foreach($consumptionList as $key => $item)
                                    <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                        <span>{{ is_array($item) ? ($item['label'] ?? $key) : $key }}</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="text-muted small">{{ is_array($item) ? ($item['credits'] ?? 0) . ' ' . trans('plugins/job-board::credit-consumption.credits') : $item }}</span>
                                            @if(is_array($item) && isset($item['credits']))
                                            <button type="button" class="btn btn-xs btn-outline-primary js-wallet-feature-btn" data-feature-key="{{ $key }}" data-feature-label="{{ $item['label'] ?? $key }}" data-credits="{{ (int)($item['credits'] ?? 0) }}">{{ __('Use credits') }}</button>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                @foreach($consumptionList as $label => $rate)
                                    <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                        <span>{{ str_replace(':site', $siteName ?? '', $label) }}</span>
                                        <span class="text-muted small">{{ $rate }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </x-core::card.body>
                </x-core::card>
            </div>
            
        </div>

        {{-- Modal: Use credits (jobseeker) – show feature & credits, redirect to Packages to buy --}}
        <div class="modal fade" id="walletJsFeatureModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Features & Coins Consumption') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-1 fw-medium" id="walletJsFeatureModalName"></p>
                        <p class="mb-1 text-danger fw-medium" id="walletJsFeatureModalInsufficient" style="display: none;"></p>
                        <p class="mb-0 text-muted small" id="walletJsFeatureModalMsg"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        {{-- One primary button: balance enough = "Use credits" (deduct + apply); else "Buy credits" (go to packages) – same as employer --}}
                        <button type="button" class="btn btn-primary" id="walletJsFeatureModalConfirmBtn">{{ __('Buy credits') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentBalance = {{ (int)($account->credits ?? 0) }};
            var msgInsufficient = @json(trans('plugins/job-board::dashboard.wallet_insufficient_coins'));
            var msgInsufficientDetail = @json(trans('plugins/job-board::dashboard.wallet_insufficient_coins_message'));
            var creditsLabel = @json(trans('plugins/job-board::credit-consumption.credits'));
            var msgRequiredBuy = @json(__('required for this feature. Buy credits from Packages to use it.'));
            var purchaseUrl = @json(route('public.account.jobseeker.wallet.purchase_feature'));
            var packagesUrl = @json(route('public.account.jobseeker.packages') . '#choose-plan');
            var msgSuccess = @json(__('Credits used successfully. Feature applied.'));
            var msgError = @json(__('Something went wrong. Please try again.'));
            var lblUseCredits = @json(__('Use credits'));
            var lblBuyCredits = @json(__('Buy credits'));

            var modalFeatureKey = '';
            var modalCredits = 0;
            var modalHasEnoughBalance = false;
            var modalInstance = null;

            document.querySelectorAll('.js-wallet-feature-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    modalFeatureKey = btn.getAttribute('data-feature-key') || '';
                    var label = btn.getAttribute('data-feature-label') || '';
                    modalCredits = parseInt(btn.getAttribute('data-credits') || '0', 10) || 0;
                    modalHasEnoughBalance = currentBalance >= modalCredits;
                    var nameEl = document.getElementById('walletJsFeatureModalName');
                    var insufficientEl = document.getElementById('walletJsFeatureModalInsufficient');
                    var msgEl = document.getElementById('walletJsFeatureModalMsg');
                    var confirmBtn = document.getElementById('walletJsFeatureModalConfirmBtn');
                    if (nameEl) nameEl.textContent = label;
                    if (insufficientEl) {
                        insufficientEl.style.display = 'none';
                        insufficientEl.textContent = '';
                    }
                    if (!modalHasEnoughBalance) {
                        if (insufficientEl) {
                            insufficientEl.textContent = msgInsufficient;
                            insufficientEl.style.display = 'block';
                        }
                        if (msgEl) {
                            msgEl.textContent = msgInsufficientDetail
                                .replace(':balance', currentBalance)
                                .replace(':required', modalCredits);
                        }
                        if (confirmBtn) { confirmBtn.textContent = lblBuyCredits; confirmBtn.disabled = false; }
                    } else {
                        if (msgEl) msgEl.textContent = modalCredits + ' ' + creditsLabel + ' ' + msgRequiredBuy;
                        if (confirmBtn) { confirmBtn.textContent = lblUseCredits; confirmBtn.disabled = false; }
                    }
                    var modalEl = document.getElementById('walletJsFeatureModal');
                    if (modalEl && typeof bootstrap !== 'undefined') {
                        modalInstance = new bootstrap.Modal(modalEl);
                        modalInstance.show();
                    }
                });
            });

            var confirmBtn = document.getElementById('walletJsFeatureModalConfirmBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    if (modalHasEnoughBalance && modalFeatureKey) {
                        confirmBtn.disabled = true;
                        var formData = new URLSearchParams();
                        formData.append('feature_key', modalFeatureKey);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
                        fetch(purchaseUrl, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: formData.toString()
                        }).then(function(r) { return r.json(); }).then(function(data) {
                            if (data.success) {
                                if (modalInstance) modalInstance.hide();
                                alert(data.message || msgSuccess);
                                window.location.reload();
                            } else {
                                alert(data.message || msgError);
                                confirmBtn.disabled = false;
                            }
                        }).catch(function() {
                            alert(msgError);
                            confirmBtn.disabled = false;
                        });
                    } else {
                        window.location.href = packagesUrl;
                    }
                });
            }
        });
        </script>

       
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var minAmount = 100;
                var amountInput = document.getElementById('walletRechargeAmount');
                var errorEl = document.getElementById('walletRechargeError');
                var errBanner = document.getElementById('walletRechargeErr');
                var form = document.getElementById('walletRechargeForm');

                function clearRechargeErr() {
                    if (errBanner) {
                        errBanner.textContent = '';
                        errBanner.classList.add('d-none');
                    }
                    if (errorEl) {
                        errorEl.textContent = '';
                    }
                }

                if (form) {
                    form.addEventListener('submit', function (event) {
                        if (!amountInput) return;
                        clearRechargeErr();
                        var val = parseInt(amountInput.value || '0', 10);
                        if (!val || val < minAmount) {
                            event.preventDefault();
                            amountInput.classList.add('is-invalid');
                            var msg = '{{ __('Minimum recharge amount is ₹100.') }}';
                            if (errBanner) {
                                errBanner.textContent = msg;
                                errBanner.classList.remove('d-none');
                            } else if (errorEl) {
                                errorEl.textContent = msg;
                            }
                            amountInput.focus();
                        }
                    });

                    amountInput?.addEventListener('input', function () {
                        clearRechargeErr();
                        if (parseInt(this.value || '0', 10) >= minAmount) {
                            this.classList.remove('is-invalid');
                        }
                    });
                }
            });
        </script>

        {{-- Coin consumption report: 12 col --}}
        <div class="row mb-4">
            <div class="col-12">
        <div class="wallet-consumption-invoice-section">
        <x-core::card class="mb-4">
            <x-core::card.header>
                <x-core::card.title>
                    <x-core::icon name="ti ti-report-money" class="me-2" />
                    {{ trans('plugins/job-board::dashboard.wallet_consumption_report') }}
                </x-core::card.title>
            </x-core::card.header>
            <x-core::card.body class="p-0">
                @if($transactions->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-vcenter table-hover card-table mb-0 wallet-consumption-table" style="table-layout: fixed; width: 100%;">
                            
                            <thead>
                                <tr>
                                    <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                                    <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                                    <th class="wallet-th-type">{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                                    <th>{{ __('Package') }}</th>
                                    <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount_coins') }}</th>
                                    <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_current_balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $runningBalance = $account->credits; $sn = 0; @endphp
                                @foreach($transactions as $txn)
                                    @php
                                        $sn++;
                                        $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits;
                                    @endphp
                                    <tr>
                                        <td>{{ $sn }}</td>
                                        <td class="text-nowrap">{{ $txn->created_at->format('M d, Y H:i') }}</td>
                                        <td class="wallet-txn-description">{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                        <td>{{ $txn->package_name ?? '—' }}</td>
                                        <td class="text-end">
                                            @if($txn->isCredit())
                                                <span class="text-success fw-medium">+{{ format_credits_short($txn->credits) }}</span>
                                            @else
                                                <span class="text-danger fw-medium">-{{ format_credits_short($txn->credits) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">{{ format_credits_short($runningBalance) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($transactions->hasPages())
                        <div class="card-footer d-flex align-items-center">{{ $transactions->links() }}</div>
                    @endif
                @else
                    <div class="empty p-5 text-center">
                        <x-core::icon name="ti ti-receipt-off" class="display-4 text-muted" />
                        <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_consumption_yet') }}</p>
                        <x-core::button tag="a" href="#choose-plan" color="primary" size="sm">{{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}</x-core::button>
                    </div>
                @endif
            </x-core::card.body>
        </x-core::card>

        {{-- Invoice Details (same UI as employer) --}}
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
                                            <x-core::button tag="a" :href="route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])" size="sm" color="primary" icon="ti ti-download" target="_blank" rel="noopener" download="invoice-{{ $invoice->code }}.pdf">
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
            </div>{{-- .col-12 --}}
        </div>{{-- .row --}}
    </div>

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
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : fd.get('_token') }
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
@endsection
