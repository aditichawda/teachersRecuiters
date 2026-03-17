<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobInvite extends BaseModel
{
    protected $table = 'jb_job_invites';

    protected $fillable = [
        'job_id',
        'account_id',
        'candidate_id',
        'email',
        'status',
        'invited_at',
    ];

    protected $casts = [
        'invited_at' => 'datetime',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'candidate_id');
    }
}
