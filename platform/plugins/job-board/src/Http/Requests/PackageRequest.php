<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class PackageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:400'],
            'price' => ['numeric', 'required', 'min:0'],
            'percent_save' => ['numeric', 'required', 'min:0'],
            'currency_id' => ['required', 'numeric', 'min:1'],
            'number_of_listings' => ['numeric', 'required', 'min:0'],
            'account_limit' => ['nullable', 'integer', 'min:0'],
            'order' => ['required', 'integer', 'min:0', 'max:127'],
            'features' => ['nullable', 'array'],
            'features.*.text' => ['nullable', 'string', 'max:255'],
            'features.*.value' => ['nullable', 'string', 'max:255'],
            'features.*.text' => ['nullable', 'string', 'max:255'],
            'features.*.value' => ['nullable', 'string', 'max:255'],
            'status' => Rule::in(BaseStatusEnum::values()),
            'package_type' => ['required', 'string', 'in:employer,job-seeker'],
            'show_for_school_institution' => ['nullable', 'boolean'],
            'show_for_consultancy' => ['nullable', 'boolean'],
            'visible_for_account_ids' => ['nullable', 'array'],
            'visible_for_account_ids.*' => ['integer', 'min:1'],
            'show_for_school_institution' => ['nullable', 'boolean'],
            'show_for_consultancy' => ['nullable', 'boolean'],
            'visible_for_account_ids' => ['nullable', 'array'],
            'visible_for_account_ids.*' => ['integer', 'min:1'],
            'validity_days' => ['nullable', 'integer', 'min:0'],
            'job_validity_days' => ['nullable', 'integer', 'min:0'],
            'job_validity_days' => ['nullable', 'integer', 'min:0'],
            'credits_included' => ['nullable', 'integer', 'min:0'],
            'profile_views_allowed' => ['nullable', 'integer', 'min:0'],
            'job_apply_limit' => ['nullable', 'integer', 'min:0'],
            'job_apply_limit' => ['nullable', 'integer', 'min:0'],
            'worth' => ['nullable', 'numeric', 'min:0'],
            'feature_featured_profile' => ['nullable', 'boolean'],
            'feature_admission_form_on_profile' => ['nullable', 'boolean'],
            'feature_resume_builder' => ['nullable', 'boolean'],
            'feature_basic_cv' => ['nullable', 'boolean'],
            'feature_advance_cv' => ['nullable', 'boolean'],
            'feature_view_school_contact_info' => ['nullable', 'boolean'],
            'feature_job_alerts_whatsapp' => ['nullable', 'boolean'],
            'feature_featured_profile_js' => ['nullable', 'boolean'],
            'feature_featured_profile' => ['nullable', 'boolean'],
            'feature_admission_form_on_profile' => ['nullable', 'boolean'],
            'feature_resume_builder' => ['nullable', 'boolean'],
            'feature_basic_cv' => ['nullable', 'boolean'],
            'feature_advance_cv' => ['nullable', 'boolean'],
            'feature_view_school_contact_info' => ['nullable', 'boolean'],
            'feature_job_alerts_whatsapp' => ['nullable', 'boolean'],
            'feature_featured_profile_js' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $features = $this->input('features');

        if (in_array($features, ['', '[]', 'null', null], true) || empty($features)) {
            $this->merge(['features' => null]);
        }

        $visibleFor = $this->input('visible_for_account_ids');
        if (is_string($visibleFor)) {
            $visibleFor = trim($visibleFor);
            if ($visibleFor === '') {
                $this->merge(['visible_for_account_ids' => null]);
            } else {
                $ids = preg_split('/\s*,\s*/', $visibleFor);
                $ids = array_values(array_unique(array_filter(array_map(static function ($v) {
                    $v = trim((string) $v);
                    return ctype_digit($v) ? (int) $v : null;
                }, $ids))));

                $this->merge(['visible_for_account_ids' => $ids ?: []]);
            }
        } elseif (is_array($visibleFor)) {
            // From multi-select: normalize empty array to null (= visible for all)
            $ids = array_values(array_unique(array_filter(array_map(static function ($v) {
                if (is_int($v)) {
                    return $v;
                }

                // Some autocomplete widgets may submit objects/arrays like ['id' => 12, 'text' => 'Name']
                if (is_array($v)) {
                    $candidate = $v['id'] ?? $v['value'] ?? $v['key'] ?? null;
                    if (is_int($candidate)) {
                        return $candidate;
                    }
                    $candidate = trim((string) $candidate);
                    return ctype_digit($candidate) ? (int) $candidate : null;
                }

                $v = trim((string) $v);
                return ctype_digit($v) ? (int) $v : null;
            }, $visibleFor))));

            $this->merge(['visible_for_account_ids' => $ids ? array_values($ids) : null]);
        }
    }

    public function attributes(): array
    {
        return [
            'features.*.text' => trans('plugins/job-board::package.feature_title'),
            'features.*.text' => trans('plugins/job-board::package.feature_title'),
        ];
    }
}
