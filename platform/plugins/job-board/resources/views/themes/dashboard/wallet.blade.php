@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
    {{-- Wallet & Credit/Debit summary --}}
    <div class="row row-cols-1 row-cols-lg-3 mb-4">
        <div class="col">
            <x-core::card class="h-100">
                <x-core::card.body>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <x-core::icon name="ti ti-wallet" class="display-4 text-primary" />
                        </div>
                        <div>
                            <h3 class="mb-0">{{ $account->credits ?? 0 }}</h3>
                            <p class="text-muted mb-0">{{ trans('plugins/job-board::dashboard.wallet_balance') }}</p>
                            <small class="text-muted">{{ trans('plugins/job-board::dashboard.credits') }}</small>
                        </div>
                    </div>
                </x-core::card.body>
                <x-core::card.footer>
                    <x-core::button tag="a" :href="route('public.account.packages')" color="primary" size="sm">
                        <x-core::icon name="ti ti-shopping-cart" class="me-1" />
                        {{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}
                    </x-core::button>
                </x-core::card.footer>
            </x-core::card>
        </div>
        @php
            $totalCredit = $account->transactions()->where(function ($q) {
                $q->whereNull('type')->orWhere('type', '!=', 'deduct');
            })->sum('credits');
            $totalDebit = $account->transactions()->where('type', 'deduct')->sum('credits');
        @endphp
        <div class="col">
            <x-core::card class="h-100">
                <x-core::card.body>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <x-core::icon name="ti ti-arrow-down-right" class="display-4 text-success" />
                        </div>
                        <div>
                            <h3 class="mb-0 text-success">+{{ $totalCredit }}</h3>
                            <p class="text-muted mb-0">{{ trans('plugins/job-board::dashboard.wallet_credit_debit_info') }}</p>
                            <small class="text-muted">{{ trans('plugins/job-board::dashboard.wallet_credit') }}</small>
                        </div>
                    </div>
                </x-core::card.body>
            </x-core::card>
        </div>
        <div class="col">
            <x-core::card class="h-100">
                <x-core::card.body>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <x-core::icon name="ti ti-arrow-up-right" class="display-4 text-danger" />
                        </div>
                        <div>
                            <h3 class="mb-0 text-danger">-{{ $totalDebit }}</h3>
                            <p class="text-muted mb-0">&nbsp;</p>
                            <small class="text-muted">{{ trans('plugins/job-board::dashboard.wallet_debit') }}</small>
                        </div>
                    </div>
                </x-core::card.body>
            </x-core::card>
        </div>
    </div>

    {{-- Transaction details --}}
    <x-core::card class="mb-4">
        <x-core::card.header>
            <x-core::card.title>
                <x-core::icon name="ti ti-list" class="me-2" />
                {{ trans('plugins/job-board::dashboard.wallet_transaction_details') }}
            </x-core::card.title>
        </x-core::card.header>
        <x-core::card.body class="p-0">
            @if($transactions->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-vcenter table-hover card-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_date') }}</th>
                                <th>{{ trans('plugins/job-board::dashboard.wallet_description') }}</th>
                                <th class="text-end">{{ trans('plugins/job-board::dashboard.wallet_amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $txn)
                                <tr>
                                    <td>{{ $txn->created_at->format('M d, Y H:i') }}</td>
                                    <td>{!! BaseHelper::clean($txn->getDescription()) !!}</td>
                                    <td class="text-end">
                                        @if($txn->isCredit())
                                            <span class="text-success">+{{ $txn->credits }}</span>
                                        @else
                                            <span class="text-danger">-{{ $txn->credits }}</span>
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
                    <p class="empty-title mt-2">{{ trans('plugins/job-board::dashboard.wallet_no_transactions') }}</p>
                    <x-core::button tag="a" :href="route('public.account.packages')" color="primary" size="sm">
                        {{ trans('plugins/job-board::dashboard.wallet_buy_credits') }}
                    </x-core::button>
                </div>
            @endif
        </x-core::card.body>
    </x-core::card>

    {{-- Invoice details & download --}}
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
                                    <td>#{{ $invoice->code }}</td>
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
                                        <x-core::button tag="a" :href="route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])" size="sm" color="primary" icon="ti ti-download" target="_blank">
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
@endsection
