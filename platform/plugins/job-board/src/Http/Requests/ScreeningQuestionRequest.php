<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ScreeningQuestionRequest extends Request
{
    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:1000'],
            'question_type' => ['required', 'string', Rule::in(['text', 'textarea', 'dropdown', 'checkbox'])],
            'options' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'status' => Rule::in(BaseStatusEnum::values()),
            'correct_answer' => ['nullable', 'string', 'max:500'],
        ];
    }
}
