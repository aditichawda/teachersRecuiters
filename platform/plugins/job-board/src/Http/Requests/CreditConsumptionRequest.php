<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CreditConsumptionRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'account_type' => ['required', 'string', 'in:employer,job-seeker'],
            'status' => [Rule::in(BaseStatusEnum::values())],
        ];

        $features = $this->input('features');
        $isBulk = is_array($features) && ! empty($features);

        if ($isBulk) {
            $rules['features'] = ['required', 'array', 'min:1'];
            // Repeater can send by name (feature_key) or by index (0,1,2) - allow both
            $rules['features.*.feature_key.value'] = ['nullable', 'string', 'max:100'];
            $rules['features.*.feature_label.value'] = ['nullable', 'string', 'max:255'];
            $rules['features.*.credits.value'] = ['nullable', 'integer', 'min:0'];
            $rules['features.*.0.value'] = ['nullable', 'string', 'max:100'];
            $rules['features.*.1.value'] = ['nullable', 'string', 'max:255'];
            $rules['features.*.2.value'] = ['nullable', 'integer', 'min:0'];
        } else {
            $rules['feature_key'] = ['nullable', 'string', 'max:100'];
            $rules['feature_label'] = ['required', 'string', 'max:255'];
            $rules['credits'] = ['required', 'integer', 'min:0'];
            $rules['order'] = ['nullable', 'integer', 'min:0', 'max:127'];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $features = $this->input('features');
        if (in_array($features, ['', '[]', 'null', null], true) || (is_array($features) && empty($features))) {
            $this->merge(['features' => null]);
        }
    }
}
