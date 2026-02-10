<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobScreeningQuestion extends BaseModel
{
    protected $table = 'jb_job_screening_questions';

    protected $fillable = [
        'job_id',
        'question',
        'question_type',
        'options',
        'required_answer',
        'is_required',
        'order',
        'file_types',
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getOptionsArrayAttribute(): array
    {
        if (empty($this->options)) {
            return [];
        }

        $decoded = json_decode($this->options, true);

        return is_array($decoded) ? $decoded : [];
    }
}
