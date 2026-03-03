@if($showPayerInfo)
    @if($payerName)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/payment::payment.payer_name') }}</x-slot:title>
            {{ $payerName }}
        </x-core::datagrid.item>
    @endif
    @if($payerEmail)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/payment::payment.email') }}</x-slot:title>
            {{ $payerEmail }}
        </x-core::datagrid.item>
    @endif
    @if($payerPhone)
        <x-core::datagrid.item>
            <x-slot:title>{{ trans('plugins/payment::payment.phone') }}</x-slot:title>
            {{ $payerPhone }}
        </x-core::datagrid.item>
    @endif
@endif
@if($accountType || $institutionName || $packageName)
    @if($accountType)
        <x-core::datagrid.item>
            <x-slot:title>{{ __('Account Type') }}</x-slot:title>
            {{ $accountType }}
        </x-core::datagrid.item>
    @endif
    @if($institutionName)
        <x-core::datagrid.item>
            <x-slot:title>{{ __('Institution / Company') }}</x-slot:title>
            {{ $institutionName }}
        </x-core::datagrid.item>
    @endif
    @if($packageName)
        <x-core::datagrid.item>
            <x-slot:title>{{ __('Package') }}</x-slot:title>
            {{ $packageName }}
        </x-core::datagrid.item>
    @endif
@endif
@if(!empty($couponCode))
    <x-core::datagrid.item>
        <x-slot:title>{{ trans('plugins/job-board::coupon.coupon_code') }}</x-slot:title>
        {{ $couponCode }}
    </x-core::datagrid.item>
@endif
