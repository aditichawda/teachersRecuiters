<?php

namespace Botble\JobBoard\Models;

use Botble\ACL\Models\User;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Facades\Html;
use Botble\Base\Models\BaseModel;
use Botble\Payment\Models\Payment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends BaseModel
{
    protected $table = 'jb_transactions';

    protected $fillable = [
        'credits',
        'description',
        'type',
        'user_id',
        'account_id',
        'payment_id',
    ];

    public const TYPE_CREDIT = 'add';
    public const TYPE_DEBIT = 'deduct';

    protected $casts = [
        'description' => SafeContent::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    public function getDescription(): string
    {
        $time = Html::tag('span', $this->created_at->diffForHumans(), ['class' => 'small italic']);

        if ($this->type === self::TYPE_DEBIT) {
            $description = $this->description
                ?: trans('plugins/job-board::messages.credits_used', ['credits' => $this->credits]);
            return $description . ' - ' . $time;
        }

        if ($this->user_id) {
            return trans('plugins/job-board::messages.added_credits_by_admin', ['credits' => $this->credits, 'name' => $this->user->name]);
        }

        $description = trans('plugins/job-board::messages.purchased_credits', ['credits' => $this->credits]);
        if ($this->payment_id) {
            $description .= trans('plugins/job-board::messages.via_payment', ['payment' => $this->payment->payment_channel->label()]);
            $description .= ': ' . number_format($this->payment->amount, 2) . $this->payment->currency;
        }

        return $description . ' - ' . $time;
    }

    public function isCredit(): bool
    {
        return ($this->type ?: self::TYPE_CREDIT) === self::TYPE_CREDIT;
    }

    public function isDebit(): bool
    {
        return $this->type === self::TYPE_DEBIT;
    }
}
