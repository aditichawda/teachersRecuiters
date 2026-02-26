@php
    Theme::set('pageTitle', trans('plugins/job-board::dashboard.menu.wallet'));
@endphp
@extends(Theme::getThemeNamespace('views.job-board.account.partials.layout-settings'))

@section('content')
    <style>
    .wallet-js-card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca) !important; border: none !important; border-radius: 12px !important; color: #fff !important; padding: 1rem !important; height: 165px !important; max-height: 165px !important; display: flex !important; flex-direction: column !important; justify-content: space-between !important; overflow: hidden !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
    .wallet-js-card-blue .card-body { padding: 0 !important; border: none !important; background: transparent !important; flex: 1 1 auto; min-height: 0; }
    .wallet-js-card-blue .card-footer { border: none !important; padding: 0.5rem 0 0 !important; background: transparent !important; flex-shrink: 0; }
    .wallet-js-card-blue .wallet-js-coins-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.95; margin-bottom: 0.25rem; }
    .wallet-js-card-blue .wallet-js-coins-value { font-size: 1.35rem; font-weight: 700; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.35rem; }
    .wallet-js-card-blue .wallet-js-coins-row { font-size: 0.75rem; opacity: 0.95; display: flex; align-items: center; gap: 0.35rem; margin-bottom: 0.15rem; }
    .wallet-js-card-blue .btn-warning { background: #f59e0b !important; color: #1a1a2e !important; border: none !important; border-radius: 8px !important; font-weight: 600 !important; }
    .wallet-js-card-orange { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; border: none !important; border-radius: 12px !important; height: 165px !important; max-height: 165px !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 1rem !important; overflow: hidden !important; box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important; }
    .wallet-js-card-orange .card-body { padding: 0 !important; border: none !important; background: transparent !important; display: flex !important; align-items: center !important; justify-content: center !important; }
    .wallet-js-card-orange .wallet-js-graphic { font-size: 3.25rem; color: rgba(0,0,0,0.3); }
    .wallet-js-page .wallet-js-two-cols { display: flex !important; flex-wrap: wrap !important; gap: 0.75rem !important; width: 100% !important; }
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-blue,
    .wallet-js-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; min-width: 140px; max-width: none; }
    @media (min-width: 576px) {
        .wallet-js-page .wallet-js-two-cols .wallet-js-col-blue,
        .wallet-js-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; }
    }
    @media (min-width: 992px) {
        .wallet-js-page .wallet-js-two-cols .wallet-js-col-blue,
        .wallet-js-page .wallet-js-two-cols .wallet-js-col-orange { flex: 1 1 calc(50% - 0.375rem) !important; }
    }
    .wallet-js-page .row { display: flex !important; flex-wrap: wrap !important; }
    .wallet-js-page .row > .col-lg-5, .wallet-js-page .row > .col-xl-4 { flex: 0 0 100%; max-width: 100%; }
    .wallet-js-page .row > .col-lg-7, .wallet-js-page .row > .col-xl-8 { flex: 0 0 100%; max-width: 100%; }
    @media (min-width: 992px) {
        .wallet-js-page .row > .col-lg-5 { flex: 0 0 41.666667% !important; max-width: 41.666667% !important; }
        .wallet-js-page .row > .col-xl-4 { flex: 0 0 33.333333% !important; max-width: 33.333333% !important; }
        .wallet-js-page .row > .col-lg-7 { flex: 0 0 58.333333% !important; max-width: 58.333333% !important; }
        .wallet-js-page .row > .col-xl-8 { flex: 0 0 66.666667% !important; max-width: 66.666667% !important; }
    }
    /* 4 package cards: one row, wider cards, less gap */
    .wallet-js-page .wallet-js-packages-row { display: flex !important; flex-wrap: nowrap !important; gap: 0.5rem !important; margin-left: 0; margin-right: 0; }
    .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 1 1 0 !important; min-width: 0; padding-left: 0.25rem !important; padding-right: 0.25rem !important; }
    .wallet-js-page .wallet-js-packages-row .card { border-radius: 10px !important; box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important; border: 1px solid rgba(0,0,0,0.06) !important; transition: box-shadow 0.2s; }
    .wallet-js-page .wallet-js-packages-row .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.12) !important; }
    .wallet-js-page .wallet-js-packages-row .card-body { padding: 1rem !important; }
    .wallet-js-page .wallet-js-packages-row .btn { border-radius: 8px !important; font-weight: 600 !important; padding: 0.4rem 0.75rem !important; }
    @media (max-width: 1199px) {
        .wallet-js-page .wallet-js-packages-row { flex-wrap: wrap !important; gap: 0.5rem !important; }
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 calc(50% - 0.25rem) !important; }
    }
    @media (max-width: 575px) {
        .wallet-js-page .wallet-js-packages-row > .wallet-js-package-col { flex: 0 0 100% !important; }
    }
    </style>
    <div class="wallet-js-page">
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
                                <x-core::button tag="a" href="#choose-plan" color="warning" size="sm" class="text-dark btn-sm">
                                    <x-core::icon name="ti ti-shopping-cart" class="me-1" />
                                    {{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}
                                </x-core::button>
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
                <div class="row wallet-js-packages-row">
                    @foreach($packages ?? [] as $package)
                        <div class="col wallet-js-package-col">
                            <div @class(['card h-100', 'border-warning' => $package->is_default])>
                                @if($package->percent_save)
                                    <div class="card-header py-1 bg-success text-white small text-center">
                                        {{ $package->percent_save_text }}
                                    </div>
                                @endif
                                <x-core::card.body class="pb-2">
                                    <h6 class="text-uppercase small text-muted">{{ $package->name }}</h6>
                                    <p class="text-muted small mb-1">{{ format_credits_short($package->number_of_listings) }} {{ trans('plugins/job-board::dashboard.credits') }}</p>
                                    <h5 class="mb-2">{{ $package->price_text }}</h5>
                                    <x-core::form :url="route('public.account.package.subscribe.put')" method="put">
                                        <input type="hidden" name="id" value="{{ $package->id }}">
                                        <x-core::button type="submit" class="w-100 btn-sm" color="{{ $package->is_default ? 'warning' : 'primary' }}" :disabled="$package->isPurchased()">
                                            {{ $package->isPurchased() ? trans('plugins/job-board::dashboard.purchased_label') : trans('plugins/job-board::dashboard.wallet_buy_now') }}
                                        </x-core::button>
                                    </x-core::form>
                                </x-core::card.body>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-4 mb-md-0">
                <x-core::card class="h-100">
                    <x-core::card.header>
                        <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_purchase_history') }}</x-core::card.title>
                    </x-core::card.header>
                    <x-core::card.body>
                        @if($invoices->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach($invoices->take(3) as $inv)
                                    <li class="border-bottom pb-2 mb-2 small">#{{ $inv->code }} - {{ $inv->created_at->format('M d, Y') }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">{{ trans('plugins/job-board::dashboard.wallet_no_purchases_yet') }}</p>
                        @endif
                    </x-core::card.body>
                </x-core::card>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <x-core::card class="h-100">
                    <x-core::card.header>
                        <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_billing_details') }}</x-core::card.title>
                    </x-core::card.header>
                    <x-core::card.body>
                        <p class="mb-1">{{ trans('plugins/job-board::dashboard.wallet_billing_name') }}: <strong>{{ $billingName ?? $account->name }}</strong></p>
                        <a href="{{ route('public.account.settings') }}" class="small d-block mb-2">{{ trans('plugins/job-board::dashboard.wallet_add_billing_details') }}</a>
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#wallet-remaining-details" aria-expanded="false">Remaining details</button>
                        <div class="collapse mt-2 small" id="wallet-remaining-details">
                            <div class="border rounded p-2 bg-light">
                                <p class="mb-1"><strong>Name:</strong> {{ $account->name ?? trim(($account->first_name ?? '') . ' ' . ($account->last_name ?? '')) ?: '—' }}</p>
                                <p class="mb-1"><strong>Address:</strong> {{ $account->address ?? '—' }}</p>
                                <p class="mb-1"><strong>Mobile:</strong> {{ $account->phone ? (($account->phone_country_code ?? '') . ' ' . $account->phone) : '—' }}</p>
                                <p class="mb-0"><strong>State:</strong> {{ $account->state_name ?? '—' }}</p>
                            </div>
                        </div>
                    </x-core::card.body>
                </x-core::card>
            </div>
            <div class="col-md-4">
                <x-core::card class="h-100">
                    <x-core::card.header>
                        <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_key_features') }}</x-core::card.title>
                    </x-core::card.header>
                    <x-core::card.body class="pt-0">
                        @php
                            $keyFeatures = trans('plugins/job-board::dashboard.wallet_key_features_jobseeker');
                            $keyFeatures = is_array($keyFeatures) ? $keyFeatures : [];
                            $siteName = $siteName ?? \Botble\Theme\Facades\Theme::getSiteTitle();
                        @endphp
                        <ul class="list-unstyled mb-0 small">
                            @foreach($keyFeatures as $feature)
                                @php $text = is_array($feature) ? ($feature['text'] ?? reset($feature)) : $feature; @endphp
                                <li class="d-flex align-items-start mb-2">
                                    <x-core::icon name="ti ti-check" class="text-success me-2 mt-1 flex-shrink-0" />
                                    <span>{{ str_replace(':site', $siteName, $text) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-core::card.body>
                </x-core::card>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-6">
                <x-core::card class="h-100">
                    <x-core::card.header>
                        <x-core::card.title class="mb-0">{{ trans('plugins/job-board::dashboard.wallet_coins_consumption') }}</x-core::card.title>
                    </x-core::card.header>
                    <x-core::card.body>
                        @php
                            $consumption = trans('plugins/job-board::dashboard.wallet_consumption_jobseeker');
                            $consumption = is_array($consumption) ? $consumption : [];
                        @endphp
                        <ul class="list-unstyled mb-0">
                            @foreach($consumption as $label => $rate)
                                <li class="d-flex justify-content-between align-items-center py-1 border-bottom">
                                    <span>{{ str_replace(':site', $siteName ?? '', $label) }}</span>
                                    <span class="text-muted small">{{ $rate }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-core::card.body>
                </x-core::card>
            </div>
        </div>

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
                        <table class="table table-vcenter table-hover card-table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ trans('plugins/job-board::dashboard.wallet_sl_no') }}</th>
                                    <th>{{ trans('plugins/job-board::dashboard.wallet_date_of_transaction') }}</th>
                                    <th>{{ trans('plugins/job-board::dashboard.wallet_type_of_transaction') }}</th>
                                    <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount_coins') }}</th>
                                    <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_current_balance') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $runningBalance = $account->credits; $sn = 0; @endphp
                                @foreach($transactions as $txn)
                                    @php $sn++; $runningBalance += $txn->isCredit() ? $txn->credits : -$txn->credits; @endphp
                                    <tr>
                                        <td>{{ $sn }}</td>
                                        <td>{{ $txn->created_at->format('M d, Y H:i') }}</td>
                                        <td>{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                        <td class="text-end">
                                            @if($txn->isCredit())
                                                <span class="text-success">+{{ format_credits_short($txn->credits) }}</span>
                                            @else
                                                <span class="text-danger">-{{ format_credits_short($txn->credits) }}</span>
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
    </div>
@endsection
