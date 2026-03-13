<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialPromotionRequest extends BaseModel
{
    protected $table = 'jb_social_promotion_requests';

    protected $fillable = [
        'account_id',
        'company_id',
        'title',
        'tag',
        'platform',
        'message',
        'image',
        'status',
        'requested_at',
        'accepted_at',
        'accepted_by',
        'posted_at',
        'notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'accepted_at' => 'datetime',
        'posted_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_POSTED = 'posted';

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
