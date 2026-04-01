<?php

namespace Botble\JobBoard\Forms;

use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Http\Requests\ScreeningQuestionRequest;
use Botble\JobBoard\Models\ScreeningQuestion;

class ScreeningQuestionForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new ScreeningQuestion())
            ->setValidatorClass(ScreeningQuestionRequest::class)
            ->add('question', TextareaField::class, [
                'label' => trans('plugins/job-board::screening-question.question'),
                'required' => true,
                'attr' => ['rows' => 3, 'placeholder' => 'e.g. Do you have Minimum {degree_level} in the relevant subject?'],
                'helper_text' => trans('plugins/job-board::screening-question.placeholder_helper'),
            ])
            ->add('question_type', SelectField::class, [
                'label' => trans('plugins/job-board::screening-question.question_type'),
                'choices' => [
                    'text' => trans('plugins/job-board::screening-question.type_text'),
                    'textarea' => trans('plugins/job-board::screening-question.type_textarea'),
                    'dropdown' => trans('plugins/job-board::screening-question.type_dropdown'),
                    'checkbox' => trans('plugins/job-board::screening-question.type_checkbox'),
                ],
                'required' => true,
            ])
            ->add('options', TextareaField::class, [
                'label' => trans('plugins/job-board::screening-question.options'),
                'attr' => [
                    'rows' => 3,
                    'placeholder' => trans('plugins/job-board::screening-question.options_placeholder'),
                ],
                'helper_text' => trans('plugins/job-board::screening-question.options_helper'),
            ])
            ->add('correct_answer', TextareaField::class, [
                'label' => trans('plugins/job-board::screening-question.correct_answer'),
                'attr' => [
                    'rows' => 1,
                    'placeholder' => 'e.g. Yes, I have completed',
                ],
                'helper_text' => trans('plugins/job-board::screening-question.correct_answer_admin_helper'),
            ])
            ->add('order', NumberField::class, SortOrderFieldOption::make())
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status');
    }
}
