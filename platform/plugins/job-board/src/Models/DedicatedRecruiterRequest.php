<?php

namespace Botble\JobBoard\Models;

use Botble\ACL\Models\User;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DedicatedRecruiterRequest extends BaseModel
{
    protected $table = 'jb_dedicated_recruiter_requests';

    protected $fillable = [
        'account_id',
        'duration_months',
        'company_id',
        'start_date',
        'end_date',
        'valid_till',
        'note',
        'status',
        'requested_at',
        'accepted_at',
        'accepted_by',
        'staff_id',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'accepted_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
        'valid_till' => 'date',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
