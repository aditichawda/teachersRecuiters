@extends($layout ?? JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')
    @php
        $invoice->loadMissing(['payment', 'items']);
        $payment = $invoice->payment;
        $currency = $payment && !empty($payment->currency)
            ? \Botble\JobBoard\Models\Currency::query()->where('title', strtoupper($payment->currency))->first()
            : null;
        $paymentMethodLabel = $payment && $payment->payment_channel ? $payment->payment_channel->label() : '-';
        $transactionId = $payment && $payment->charge_id ? $payment->charge_id : '-';
        $paymentStatusLabel = $payment && $payment->status ? $payment->status->label() : '-';
        $isPaid = $payment && $payment->status && $payment->status->getValue() === 'completed';

        $companyLogo = setting('job_board_company_logo_for_invoicing') ?: theme_option('logo');
        $companyName = setting('job_board_company_name_for_invoicing') ?: theme_option('site_title');
        $companyAddress = setting('job_board_company_address_for_invoicing');
        $companyPhone = setting('job_board_company_phone_for_invoicing');
        $companyEmail = setting('job_board_company_email_for_invoicing');
        $companyGst = setting('job_board_company_gst_for_invoicing');
        $bankAccountNumber = setting('job_board_bank_account_number', '3566282988');
        $bankAccountName = setting('job_board_bank_account_name', 'Teachers Recruiter');
        $bankIfsc = setting('job_board_bank_ifsc', 'CBIN0281043');
        $bankName = setting('job_board_bank_name', 'Central Bank of India');
    @endphp

    @if (session('error_msg'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error_msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-core::card size="lg">
        <x-core::card.body>
            {{-- Teachers Recruiter / Company Logo --}}
            @if ($companyLogo)
                <div class="mb-4">
                    <img src="{{ RvMedia::getImageUrl($companyLogo) }}" alt="{{ $companyName ?? 'Company' }}" style="max-height: 40px;">
                </div>
            @endif

            <h2 class="text-center fw-bold mb-4">Tax Invoice</h2>

            {{-- Invoice Number, Date, Payment Method, Transaction ID --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Invoice Number:</strong> #{{ $invoice->code }}</p>
                    <p class="mb-1"><strong>Invoice Date:</strong> {{ $invoice->created_at->translatedFormat('d M Y') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Payment Method:</strong> {{ $paymentMethodLabel }}</p>
                    <p class="mb-1"><strong>Transaction ID:</strong> {{ $transactionId }}</p>
                </div>
            </div>

            {{-- Paid / Unpaid badge --}}
            <div class="text-end mb-3">
                @if ($isPaid)
                    <x-core::badge color="success" class="px-3 py-2">PAID</x-core::badge>
                @else
                    <x-core::badge color="warning" class="px-3 py-2">UNPAID</x-core::badge>
                @endif
            </div>

            {{-- Details of Employer + Our Company Details --}}
            <div class="row mb-4">
          
            <div class="col-md-6">
                    <div class="border-bottom border-2 border-dark pb-2 mb-2">
                        <strong>Details of Employer on Invoice</strong>
                    </div>
                    <p class="mb-1"><strong>Institution Name:</strong> {{ $invoice->company_name ?: '-' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $invoice->customer_address ?: '-' }}</p>
                    @php
                        $employerGst = $invoice->customer_gst_number ?? $invoice->tax_id;
                    @endphp
                    @if($employerGst && trim((string)$employerGst) !== '')
                        <p class="mb-1"><strong>GST No:</strong> {{ $employerGst }}</p>
                    @endif
                    <p class="mb-1"><strong>Phone:</strong> {{ $invoice->customer_phone ?: '-' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $invoice->customer_email ?: '-' }}</p>
                </div>
                <div class="col-md-6">
                    <div class="border-bottom border-2 border-dark pb-2 mb-2">
                        <strong>Our Company Details on Invoice</strong>
                    </div>
                    <p class="mb-1"><strong>Company Name:</strong> {{ $companyName ?: '-' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $companyAddress ?: '-' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $companyPhone ?: '-' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $companyEmail ?: '-' }}</p>
                    @isset($companyGst)
                        @if(trim($companyGst) !== '')
                            <p class="mb-1"><strong>GST No :</strong> {{ $companyGst }}</p>
                        @endif
                    @endisset
                </div>
            </div>

            {{-- Plan/Service table: Plan Name, Validity, Plan Features, Qty, Plan Cost, GST 18%, Total Amount --}}
            <x-core::table class="table-bordered" :striped="false">
                <x-core::table.header>
                    <x-core::table.header.cell>Plan Name</x-core::table.header.cell>
                    <x-core::table.header.cell class="text-center">Validity</x-core::table.header.cell>
                    <x-core::table.header.cell>Plan Features</x-core::table.header.cell>
                    <x-core::table.header.cell class="text-center">Qty</x-core::table.header.cell>
                    <x-core::table.header.cell class="text-end">Plan Cost</x-core::table.header.cell>
                    <x-core::table.header.cell class="text-end">GST (CGST/SGST) 18%</x-core::table.header.cell>
                    <x-core::table.header.cell class="text-end">Total Amount</x-core::table.header.cell>
                </x-core::table.header>
                <x-core::table.body>
                    @foreach ($invoice->items ?? [] as $item)
                        @php
                            $itemValidity = data_get($item->metadata, 'validity');
                            if (empty($itemValidity) && $item->reference_type === \Botble\JobBoard\Models\Package::class && $item->reference_id) {
                                $pkg = \Botble\JobBoard\Models\Package::query()->find($item->reference_id);
                                $itemValidity = $pkg && !empty($pkg->validity_days) ? trans('plugins/job-board::dashboard.package_validity_days', ['days' => $pkg->validity_days]) : '-';
                            }
                            $itemValidity = $itemValidity ?? '-';
                        @endphp
                        <x-core::table.body.row>
                            <x-core::table.body.cell>{{ $item->name ?: '-' }}</x-core::table.body.cell>
                            <x-core::table.body.cell class="text-center">{{ $itemValidity }}</x-core::table.body.cell>
                            <x-core::table.body.cell>{{ $item->description ?: '-' }}</x-core::table.body.cell>
                            <x-core::table.body.cell class="text-center">{{ $item->qty }}</x-core::table.body.cell>
                            <x-core::table.body.cell class="text-end">{{ format_price($item->amount, $currency) }}</x-core::table.body.cell>
                            <x-core::table.body.cell class="text-end">
                                @if ($item->tax_amount && $item->tax_amount > 0)
                                    {{ format_price($item->tax_amount, $currency) }}
                                @else
                                    -
                                @endif
                            </x-core::table.body.cell>
                            <x-core::table.body.cell class="text-end">{{ format_price($item->amount * $item->qty, $currency) }}</x-core::table.body.cell>
                        </x-core::table.body.row>
                    @endforeach
                </x-core::table.body>
            </x-core::table>

            {{-- Totals --}}
            <div class="row justify-content-end mt-3">
                <div class="col-md-5">
                    @if ($invoice->tax_amount > 0)
                        <div class="d-flex justify-content-between mb-1">
                            <span>GST (CGST/SGST) Amount (18%):</span>
                            <strong>{{ format_price($invoice->tax_amount, $currency) }}</strong>
                        </div>
                    @endif
                    @if ($invoice->discount_amount > 0)
                        <div class="d-flex justify-content-between mb-1">
                            <span>Discount:</span>
                            <strong>{{ format_price($invoice->discount_amount, $currency) }}</strong>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                        <strong>Total Amount:</strong>
                        <strong class="text-danger">{{ format_price($invoice->amount, $currency) }}</strong>
                    </div>
                </div>
            </div>

            {{-- Footer: Bank Details + Thanks + Disclaimer --}}
            <div class="mt-5 pt-4 border-top">
                <div class="border-bottom pb-2 mb-2">
                    <strong>Bank Details</strong>
                </div>
                <p class="mb-1"><strong>Account Number:</strong> {{ $bankAccountNumber }}</p>
                <p class="mb-1"><strong>Account Name:</strong> {{ $bankAccountName }}</p>
                <p class="mb-1"><strong>IFSC:</strong> {{ $bankIfsc }}</p>
                <p class="mb-1"><strong>Bank Name:</strong> {{ $bankName }}</p>
                <p class="mt-3 mb-1"><strong>Thanks for using teachersrecruiter.in!</strong></p>
                <p class="small text-muted mb-0">
                    This invoice serves as proof of payment for the services provided by Teachers Recruiter. The payment is non-refundable. Please use the order no. for future inquiries. This document is electronically generated and does not require a signature.
                </p>
            </div>
        </x-core::card.body>

        <x-core::card.footer>
            <div class="btn-list justify-content-end">
                <a href="{{ route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'print']) }}"
                   target="_blank"
                   rel="noopener"
                   class="btn btn-outline-primary">
                    <x-core::icon name="ti ti-printer" class="icon-left" />
                    {{ trans('plugins/job-board::invoice.print') }}
                </x-core::button>
                <x-core::button
                    tag="a"
                    :href="route('public.account.invoices.generate_invoice', ['invoice' => $invoice->id, 'type' => 'download'])"
                    icon="ti ti-download"
                    target="_blank"
                    rel="noopener"
                >
                    {{ trans('plugins/job-board::invoice.download') }}
                </a>
            </div>
        </x-core::card.footer>
    </x-core::card>
@endsection
