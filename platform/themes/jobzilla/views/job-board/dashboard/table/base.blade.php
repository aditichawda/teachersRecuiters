@php
    /** Respect layout passed from controllers (e.g. invoices). Fallback uses theme master when present. */
    $layout = $layout ?? \Botble\JobBoard\Facades\JobBoardHelper::viewPath('dashboard.layouts.master');
@endphp

@extends('core/table::table')

@push('header')
<style>
/* Dashboard table wrapper – clean card UI */
.table-wrapper {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    border: 1px solid #eef2f6;
}
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #eef2f6;
}
.table-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #0f172a;
    margin: 0;
}
/* Table styling */
.table-wrapper .dataTables_wrapper {
    font-size: 0.9375rem;
}
.table-wrapper .table thead th {
    font-weight: 600;
    color: #475569;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    padding: 12px 14px;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}
.table-wrapper .table tbody td {
    padding: 8px 5px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.table-wrapper .table thead th:nth-child(4),
.table-wrapper .table tbody td:nth-child(4) {
    max-width: 110px;
    width: 110px;
    word-break: break-all;
    overflow-wrap: break-word;
}
/* Companies table has logo + name; don't force a narrow 4th column there */
.route-public-account-companies-index .table-wrapper .table thead th:nth-child(4),
.route-public-account-companies-index .table-wrapper .table tbody td:nth-child(4) {
    max-width: none;
    width: auto;
    word-break: normal;
    overflow-wrap: normal;
}
.route-public-account-companies-index .table-wrapper .table thead th.column-key-1,
.route-public-account-companies-index .table-wrapper .table tbody td.column-key-1 {
    width: 78px;
}
.route-public-account-companies-index .table-wrapper .table thead th.column-key-2,
.route-public-account-companies-index .table-wrapper .table tbody td.column-key-2 {
    min-width: 220px;
}
.table-wrapper .table tbody tr:hover {
    background: #fafbfc;
}
.table-wrapper .table .btn-link,
.table-wrapper .table a:not(.btn) {
    color: var(--primary-color, #0073d1);
    text-decoration: none;
    font-size: 14px;
}
.table-wrapper .table .btn-link:hover,
.table-wrapper .table a:not(.btn):hover {
    text-decoration: underline;
}
.table-wrapper .dataTables_filter input,
.table-wrapper .dataTables_length select {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    font-size: 0.875rem;
}
.table-wrapper .btn {
    border-radius: 8px;
    font-weight: 500;
}
.table-wrapper .dataTables_info,
.table-wrapper .dataTables_paginate {
    font-size: 0.875rem;
    color: #64748b;
}

/* Selected row: lighter blue background, white text (name + all columns) */
.table-wrapper .table.dataTable tbody tr.selected td {
    background-color: #6ba3e0 !important;
    color: #fff !important;
}
.table-wrapper .table.dataTable tbody tr.selected td a,
.table-wrapper .table.dataTable tbody tr.selected td a.text-primary,
.table-wrapper .table.dataTable tbody tr.selected td a.text-decoration-none,
.table-wrapper .table.dataTable tbody tr.selected td span,
.table-wrapper .table.dataTable tbody tr.selected td .text-primary {
    color: #fff !important;
}
.table-wrapper .table.dataTable tbody tr.selected td a:hover {
    color: #e8f0f8 !important;
}
.table-wrapper .table.dataTable tbody tr.selected .form-select {
    color: #333;
    background-color: #fff;
}
</style>
@endpush

@section('content')
    @if(request()->route() && request()->route()->getName() === 'public.account.companies.index' && \Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
        @php
            $account = auth('account')->user();
            $additionalProfileCredits = \Botble\JobBoard\Models\CreditConsumption::getCreditsForFeature('employer', \Botble\JobBoard\Models\CreditConsumption::FEATURE_ADDITIONAL_EMPLOYER_PROFILE, 500);
            $companyCount = $account && method_exists($account, 'companies') ? $account->companies()->count() : 0;
            $institutionLocked = $companyCount >= 1 && (int) ($account->credits ?? 0) < $additionalProfileCredits;
        @endphp
        @if($institutionLocked)
            <div class="alert alert-warning mb-3 d-flex align-items-center flex-wrap" role="alert" style="border-radius: 8px;">
                <i class="fa fa-lock me-2"></i>
                <span class="me-2">{{ __('Adding another institution is locked. You need :credits credits per new institution.', ['credits' => $additionalProfileCredits]) }}</span>
                <a href="{{ route('public.account.wallet') }}" class="btn btn-sm btn-primary">{{ __('Get credits / Wallet') }}</a>
            </div>
        @else
            <div class="alert alert-info mb-3" role="alert" style="border-radius: 8px;">
                <i class="fa fa-info-circle me-2"></i>
                {{ trans('plugins/job-board::dashboard.hint_additional_institution_credits', ['credits' => $additionalProfileCredits]) }}
            </div>
            {{-- Modal: deduct credits then redirect to create --}}
            <div class="modal fade" id="additionalInstitutionDeductModal" tabindex="-1" aria-labelledby="additionalInstitutionDeductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="additionalInstitutionDeductModalLabel">{{ __('Add institution') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0">{{ __(':credits credits will be deducted first. Then the Add institution form will open. Continue?', ['credits' => $additionalProfileCredits]) }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button" class="btn btn-primary" id="additionalInstitutionDeductConfirmBtn">{{ __('Continue') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @push('footer')
        <script>
        (function() {
            var companyCount = {{ $companyCount }};
            var institutionLocked = {{ $institutionLocked ? 'true' : 'false' }};
            var walletUrl = {{ json_encode(route('public.account.wallet')) }};
            var createUrl = {{ json_encode(route('public.account.companies.create')) }};
            var deductUrl = {{ json_encode(route('public.account.additional-employer-profile.deduct')) }};
            var insufficientMsg = {{ json_encode(__('Insufficient credits. You need :credits credits to add another institution. Redirecting to Wallet.', ['credits' => $additionalProfileCredits])) }};
            document.addEventListener('click', function(e) {
                var btn = e.target.closest('.action-item');
                if (!btn) return;
                var span = btn.querySelector('span[data-href]');
                if (!span || !span.getAttribute('data-href')) return;
                var href = (span.getAttribute('data-href') || '').toLowerCase();
                if (href.indexOf('companies/create') === -1) return;
                if (companyCount < 1) return;
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                if (institutionLocked) {
                    alert(insufficientMsg);
                    window.location.href = walletUrl;
                    return false;
                }
                var modalEl = document.getElementById('additionalInstitutionDeductModal');
                if (modalEl && typeof bootstrap !== 'undefined') {
                    (new bootstrap.Modal(modalEl)).show();
                }
                return false;
            }, true);
            var confirmBtn = document.getElementById('additionalInstitutionDeductConfirmBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function() {
                    confirmBtn.disabled = true;
                    var token = document.querySelector('meta[name="csrf-token"]');
                    token = token ? token.getAttribute('content') : '';
                    fetch(deductUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    })
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        var ok = data.error === false || (data.data && data.data.error === false);
                        if (ok) {
                            var modalEl = document.getElementById('additionalInstitutionDeductModal');
                            if (modalEl && typeof bootstrap !== 'undefined') {
                                var m = bootstrap.Modal.getInstance(modalEl);
                                if (m) m.hide();
                            }
                            window.location.href = createUrl + '?credits_already_deducted=1';
                        } else {
                            alert(data.message || (data.data && data.data.message) || '{{ __("Request failed.") }}');
                        }
                    })
                    .catch(function() { alert('{{ __("Something went wrong.") }}'); })
                    .finally(function() { confirmBtn.disabled = false; });
                });
            }
        })();
        </script>
        @endpush
    @endif
    <div class="table-wrapper">
        @parent
    </div>
@stop
