<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobScreeningQuestion extends BaseModel
{
    protected $table = 'jb_job_screening_questions';

    protected $fillable = [
        'job_id',
        'question',
        'question_type',
        'options',
        'is_required',
        'correct_answer',
        'order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'question' => SafeContent::class,
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    protected function options(): Attribute
    {
        return Attribute::make(
            get: function (?string $value): ?string {
                if (empty($value)) {
                    return null;
                }
                if (str_starts_with(trim($value), '[')) {
                    $arr = json_decode($value, true);

                    return is_array($arr) ? implode("\n", $arr) : $value;
                }

                return $value;
            },
            set: function (?string $value): ?string {
                if (empty($value)) {
                    return null;
                }
                if (! str_starts_with(trim($value), '[')) {
                    $lines = array_filter(array_map('trim', preg_split('/[\r\n,]+/', $value)));

                    return json_encode(array_values($lines));
                }

                return $value;
            }
        );
    }

    public function getOptionsArrayAttribute(): array
    {
        $raw = $this->getRawOriginal('options');
        if (empty($raw)) {
            return [];
        }
        $decoded = json_decode($raw, true);

        return is_array($decoded) ? $decoded : [];
    }
}
