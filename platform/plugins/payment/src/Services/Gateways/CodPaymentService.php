<?php

namespace Botble\Payment\Services\Gateways;

use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Enums\PaymentStatusEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CodPaymentService
{
    public function execute(array $data): string
    {
        $chargeId = Str::upper(Str::random(10));

        $orderIds = Arr::get($data, 'order_id');
        $orderIds = is_array($orderIds) ? $orderIds : (array) $orderIds;

        do_action(PAYMENT_ACTION_PAYMENT_PROCESSED, [
            'amount' => Arr::get($data, 'amount', 0),
            'currency' => Arr::get($data, 'currency', config('plugins.payment.payment.currency', 'USD')),
            'charge_id' => $chargeId,
            'order_id' => $orderIds,
            'customer_id' => Arr::get($data, 'customer_id'),
            'customer_type' => Arr::get($data, 'customer_type'),
            'payment_channel' => PaymentMethodEnum::COD,
            'status' => PaymentStatusEnum::PENDING,
        ]);

        return $chargeId;
    }
}
