<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;

class WalletRecharge extends BaseModel
{
    protected $table = 'jb_wallet_recharges';

    protected $fillable = [
        'account_id',
        'token',
        'amount_inr',
        'credits',
        'currency',
        'gateway',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'status',
    ];
}

