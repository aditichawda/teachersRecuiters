<?php

namespace Botble\JobBoard\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScreeningQuestion extends BaseModel
{
    protected $table = 'jb_screening_questions';

    protected $fillable = [
        'question',
        'question_type',
        'options',
        'is_required',
        'order',
        'status',
        'correct_answer',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'status' => BaseStatusEnum::class,
        'question' => SafeContent::class,
    ];

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'jb_jobs_screening_questions', 'screening_question_id', 'job_id')
            ->withPivot('order', 'is_required', 'question_override', 'options_override', 'correct_answer')
            ->orderByPivot('order');
    }

    /**
     * Placeholders for question/options templates. Use {placeholder} in admin question text.
     * Resolved from job data when employer adds question.
     */
    public static function placeholders(): array
    {
        return [
            'degree_level' => 'Required qualification (e.g. Bachelor\'s Degree)',
            'job_title' => 'Job title',
            'experience_years' => 'Experience required (e.g. 2 Years)',
            'certification' => 'First certification (e.g. B.Ed)',
            'language' => 'First language (e.g. English)',
            'job_location' => 'Job location/address/city',
            'application_locations' => 'Application locations (e.g. Vijay Nagar, Indore)',
            'company_name' => 'School/company name',
            'institution_type' => 'Institution type (e.g. CBSE)',
        ];
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
