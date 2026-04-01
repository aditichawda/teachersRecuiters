<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;

class AccountEducation extends BaseModel
{
    protected $table = 'jb_account_educations';

    protected $fillable = [
        'school',
        'account_id',
        'level',
        'specialized',
        'description',
        'started_at',
        'ended_at',
        'is_current',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'is_current' => 'boolean',
        'school' => SafeContent::class,
        'description' => SafeContent::class,
        'specialized' => SafeContent::class,
    ];
}
