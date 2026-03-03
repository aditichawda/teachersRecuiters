@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    @php
        do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, request(), $payment);
    @endphp

    <x-core::form :url="route('payment.update', $payment->id)" method="post">
        @method('PUT')

        <div class="row">
            <div class="col-md-9">
                <x-core::card>
                    <x-core::card.header>
                        <h4 class="card-title">{{ trans('plugins/payment::payment.information') }}</h4>

                        <div class="card-actions">
                            {!! apply_filters('payment-transaction-card-actions', null, $payment) !!}
                        </div>
                    </x-core::card.header>

                    <x-core::card.body>
                        <x-core::datagrid>
                            @if($payment->charge_id)
                                <x-core::datagrid.item>
                                    <x-slot:title>{{ trans('plugins/payment::payment.charge_id') }}</x-slot:title>
                                    {{ $payment->charge_id }}
                                </x-core::datagrid.item>
                            @endif

                            @if ($payment->customer_id && $payment->customer_type && $payment->customer && class_exists($payment->customer_type))
                                <x-core::datagrid.item>
                                    <x-slot:title>{{ trans('plugins/payment::payment.payer_name') }}</x-slot:title>
                                    <div class="d-flex align-items-center">
                                        @if($payment->customer->avatar_url)
                                            <span class="avatar avatar-xs me-2 rounded" style="background-image: url({{ $payment->customer->avatar_url }})"></span>
                                        @endif
                                        {{ $payment->customer->name }}
                                    </div>
                                </x-core::datagrid.item>

                                <x-core::datagrid.item>
                                    <x-slot:title>{{ trans('plugins/payment::payment.email') }}</x-slot:title>
                                    {{ $payment->customer->email }}
                                </x-core::datagrid.item>

                                @if ($payment->customer->phone)
                                    <x-core::datagrid.item>
                                        <x-slot:title>{{ trans('plugins/payment::payment.phone') }}</x-slot:title>
                                        {{ $payment->customer->phone }}
                                    </x-core::datagrid.item>
                                @endif
                            @endif

                            {!! apply_filters('payment_detail_extra_info', '', $payment) !!}

                            <x-core::datagrid.item>
                                <x-slot:title>{{ __('Payment Method') }}</x-slot:title>
                                {{ $payment->payment_channel ? $payment->payment_channel->displayName() : '—' }}
                            </x-core::datagrid.item>

                            @php
                                $methodDetailFromResponse = '';
                                $paymentTypeLabel = '';
                                $cardDisplay = null;
                                $descriptionFromLog = null;
                                $logsForDetail = $payment->getPaymentLogs();
                                $findEntityInArray = function ($arr, $chargeId = null) use (&$findEntityInArray) {
                                    if (!is_array($arr)) {
                                        return null;
                                    }
                                    if (isset($arr['method']) && (isset($arr['card_id']) || isset($arr['description']) || isset($arr['id']) || isset($arr['entity']))) {
                                        $id = $arr['id'] ?? ($arr['entity'] ?? null);
                                        if ($chargeId === null || $id === $chargeId) {
                                            return $arr;
                                        }
                                    }
                                    foreach ($arr as $v) {
                                        if (is_array($v)) {
                                            $found = $findEntityInArray($v, $chargeId);
                                            if ($found !== null) {
                                                return $found;
                                            }
                                        }
                                    }
                                    return null;
                                };
                                foreach ($logsForDetail as $log) {
                                    $resp = $log->response ?? [];
                                    $req = $log->request ?? [];
                                    $entity = $resp['payload']['payment']['entity'] ?? $req['payload']['payment']['entity'] ?? $resp['payload']['payment'] ?? $resp['payment']['entity'] ?? $resp['payment'] ?? [];
                                    if (empty($entity) || !is_array($entity)) {
                                        if (is_array($resp) && (isset($resp['method']) || isset($resp['card_id']) || isset($resp['description']))) {
                                            $entity = $resp;
                                        } elseif (is_array($req) && (isset($req['method']) || isset($req['card_id']) || isset($req['description']))) {
                                            $entity = $req;
                                        } else {
                                            $entity = $findEntityInArray($resp, $payment->charge_id) ?? $findEntityInArray($req, $payment->charge_id);
                                            if ($entity === null) {
                                                continue;
                                            }
                                        }
                                    }
                                    $method = $entity['method'] ?? '';
                                    $card = $entity['card'] ?? [];
                                    $cardId = $entity['card_id'] ?? ($card['id'] ?? null);
                                    $last4 = $card['last4'] ?? $entity['last4'] ?? null;
                                    $network = $card['network'] ?? $entity['network'] ?? null;
                                    $bank = $entity['bank'] ?? ($card['issuer'] ?? null);
                                    $wallet = $entity['wallet'] ?? null;
                                    $vpa = $entity['vpa'] ?? null;
                                    if ($descriptionFromLog === null && !empty($entity['description'])) {
                                        $descriptionFromLog = $entity['description'];
                                    }
                                    $parts = [];
                                    if ($method) {
                                        $parts[] = ucfirst($method);
                                    }
                                    if ($network) {
                                        $parts[] = $network;
                                    }
                                    if ($last4) {
                                        $parts[] = '**** ' . $last4;
                                    }
                                    if ($cardId) {
                                        $parts[] = $cardId;
                                    }
                                    if ($bank) {
                                        $parts[] = is_string($bank) ? $bank : ($bank['name'] ?? '');
                                    }
                                    if ($wallet) {
                                        $parts[] = is_string($wallet) ? $wallet : ($wallet['name'] ?? '');
                                    }
                                    if ($vpa) {
                                        $parts[] = $vpa;
                                    }
                                    if (!empty($parts)) {
                                        $methodDetailFromResponse = implode(' · ', array_filter($parts));
                                        $cardDisplay = $cardDisplay ?? $methodDetailFromResponse;
                                    }
                                    if ($paymentTypeLabel === '' && $method) {
                                        $paymentTypeLabel = match(strtolower($method)) {
                                            'card' => __('Card'),
                                            'upi' => __('UPI') . ($vpa ? ' (' . $vpa . ')' : ''),
                                            'netbanking' => __('Net Banking') . ($bank ? ' (' . (is_string($bank) ? $bank : ($bank['name'] ?? '')) . ')' : ''),
                                            'wallet' => __('Wallet') . ($wallet ? ' (' . (is_string($wallet) ? $wallet : ($wallet['name'] ?? '')) . ')' : ''),
                                            default => ucfirst($method),
                                        };
                                    }
                                    if ($cardDisplay === null && ($cardId || $last4)) {
                                        $cardDisplay = $cardId ?: ('**** **** **** ' . $last4);
                                    }
                                    if ($methodDetailFromResponse || $cardDisplay || $paymentTypeLabel || $descriptionFromLog !== null) {
                                        break;
                                    }
                                }
                                if (!$cardDisplay) {
                                    $meta = $payment->metadata ?? [];
                                    $cardDisplay = $meta['card_id'] ?? $meta['cardId'] ?? null;
                                    if (!$cardDisplay && !empty($meta['card_last4'])) {
                                        $cardDisplay = '**** **** **** ' . $meta['card_last4'];
                                    }
                                    if (!$cardDisplay && !empty($meta['last4'])) {
                                        $cardDisplay = '**** **** **** ' . $meta['last4'];
                                    }
                                    if (!$cardDisplay) {
                                        $cardDisplay = apply_filters('payment_detail_card_info', null, $payment);
                                    }
                                }
                                $entityFromGateway = apply_filters('payment_detail_entity_from_gateway', null, $payment);
                                if ($entityFromGateway && is_array($entityFromGateway)) {
                                    if ($descriptionFromLog === null && !empty($entityFromGateway['description'])) {
                                        $descriptionFromLog = $entityFromGateway['description'];
                                    }
                                    if ($paymentTypeLabel === '' && !empty($entityFromGateway['method'])) {
                                        $m = $entityFromGateway['method'];
                                        $vpa = $entityFromGateway['vpa'] ?? null;
                                        $bank = $entityFromGateway['bank'] ?? null;
                                        $wallet = $entityFromGateway['wallet'] ?? null;
                                        $paymentTypeLabel = match(strtolower($m)) {
                                            'card' => __('Card'),
                                            'upi' => __('UPI') . ($vpa ? ' (' . $vpa . ')' : ''),
                                            'netbanking' => __('Net Banking') . ($bank ? ' (' . (is_string($bank) ? $bank : ($bank['name'] ?? '')) . ')' : ''),
                                            'wallet' => __('Wallet') . ($wallet ? ' (' . (is_string($wallet) ? $wallet : ($wallet['name'] ?? '')) . ')' : ''),
                                            default => ucfirst($m),
                                        };
                                    }
                                    if (!$cardDisplay) {
                                        $cardId = $entityFromGateway['card_id'] ?? ($entityFromGateway['card']['id'] ?? null);
                                        $last4 = $entityFromGateway['card']['last4'] ?? $entityFromGateway['last4'] ?? null;
                                        $cardDisplay = $cardId ?: ($last4 ? '**** **** **** ' . $last4 : null);
                                    }
                                    if (!$methodDetailFromResponse && !empty($entityFromGateway['method'])) {
                                        $methodDetailFromResponse = ucfirst($entityFromGateway['method']);
                                        if (!empty($entityFromGateway['card_id'])) {
                                            $methodDetailFromResponse .= ' · ' . $entityFromGateway['card_id'];
                                        }
                                        if (!empty($entityFromGateway['vpa'])) {
                                            $methodDetailFromResponse .= ' · ' . $entityFromGateway['vpa'];
                                        }
                                    }
                                }
                                $displayDescription = !empty($payment->description) ? $payment->description : ($descriptionFromLog ?? '—');
                            @endphp

                            @if($paymentTypeLabel)
                                <x-core::datagrid.item>
                                    <x-slot:title>{{ __('Payment type (Card / UPI / Net Banking)') }}</x-slot:title>
                                    {{ $paymentTypeLabel }}
                                </x-core::datagrid.item>
                            @endif

                            @if($methodDetailFromResponse)
                                <x-core::datagrid.item>
                                    <x-slot:title>{{ __('How paid (from response)') }}</x-slot:title>
                                    {{ $methodDetailFromResponse }}
                                </x-core::datagrid.item>
                            @endif

                            <x-core::datagrid.item>
                                <x-slot:title>{{ __('Description') }}</x-slot:title>
                                {{ $displayDescription }}
                            </x-core::datagrid.item>

                            <x-core::datagrid.item>
                                <x-slot:title>{{ __('Card ID / Card') }}</x-slot:title>
                                {{ $cardDisplay ? (is_string($cardDisplay) ? $cardDisplay : (string) $cardDisplay) : '—' }}
                            </x-core::datagrid.item>

                            <x-core::datagrid.item>
                                <x-slot:title>{{ trans('plugins/payment::payment.total') }}</x-slot:title>
                                {{ $payment->amount }} {{ $payment->currency }}
                            </x-core::datagrid.item>

                            @if ($payment->payment_fee > 0)
                            <x-core::datagrid.item>
                                <x-slot:title>{{ trans('plugins/payment::payment.payment_fee') }}</x-slot:title>
                                {{ $payment->payment_fee }} {{ $payment->currency }}
                            </x-core::datagrid.item>
                            @endif

                            <x-core::datagrid.item>
                                <x-slot:title>{{ trans('plugins/payment::payment.created_at') }}</x-slot:title>
                                {{ BaseHelper::formatDateTime($payment->created_at) }}
                            </x-core::datagrid.item>

                            <x-core::datagrid.item>
                                <x-slot:title>{{ trans('plugins/payment::payment.status') }}</x-slot:title>
                                {!! BaseHelper::clean($payment->status->toHtml()) !!}
                            </x-core::datagrid.item>
                        </x-core::datagrid>

                        {!! $detail !!}
                    </x-core::card.body>
                </x-core::card>

                @include('plugins/payment::partials.payment-logs', ['payment' => $payment])

                @php
                    do_action(BASE_ACTION_META_BOXES, 'advanced', $payment);
                @endphp
            </div>

            <div class="col-md-3">
                @include('core/base::forms.partials.form-actions', [
                    'title' => trans('plugins/payment::payment.action'),
                ])

                <x-core::card class="meta-boxes mt-3">
                    <x-core::card.header>
                        <h4 class="card-title">
                            <label class="form-label required" for="status">
                                {{ trans('core/base::tables.status') }}
                            </label>
                        </h4>
                    </x-core::card.header>

                    <x-core::card.body>
                        {!! Form::customSelect('status', $paymentStatuses, $payment->status) !!}
                    </x-core::card.body>
                </x-core::card>

                @php
                    do_action(BASE_ACTION_META_BOXES, 'side', $payment);
                @endphp
            </div>
        </div>
    </x-core::form>
@endsection
