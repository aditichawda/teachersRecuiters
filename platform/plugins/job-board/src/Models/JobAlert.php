<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobAlert extends BaseModel
{
    protected $table = 'jb_job_alerts';

    protected $fillable = [
        'account_id',
        'name',
        'keywords',
        'job_category_id',
        'job_type_id',
        'country_id',
        'state_id',
        'city_id',
        'salary_from',
        'salary_to',
        'is_active',
        'frequency',
        'last_sent_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'salary_from' => 'decimal:2',
        'salary_to' => 'decimal:2',
        'last_sent_at' => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'job_category_id');
    }

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(\Botble\Location\Models\Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(\Botble\Location\Models\State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(\Botble\Location\Models\City::class);
    }

    public function sentJobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'jb_job_alert_jobs', 'job_alert_id', 'job_id')
            ->withPivot('sent_at')
            ->withTimestamps();
    }
}
