<?php

namespace Botble\JobBoard\Forms;

use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\RepeaterField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Http\Requests\CreditConsumptionRequest;
use Botble\JobBoard\Models\CreditConsumption;

class CreditConsumptionForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new CreditConsumption())
            ->setValidatorClass(CreditConsumptionRequest::class);

        $isEdit = $this->getModel()->exists;

        if (! $isEdit) {
            // Create: one form to add multiple features (credits) at once (e.g. for Employer)
            $this
                ->add('account_type', SelectField::class, [
                    'label' => trans('plugins/job-board::credit-consumption.account_type'),
                    'default_value' => 'employer',
                    'choices' => [
                        'employer' => trans('plugins/job-board::package.package_type_employer'),
                        'job-seeker' => trans('plugins/job-board::package.package_type_job_seeker'),
                    ],
                ])
                ->add('features', RepeaterField::class, [
                    'label' => trans('plugins/job-board::credit-consumption.multiple_features'),
                    'helper_text' => trans('plugins/job-board::credit-consumption.multiple_features_help'),
                    'fields' => [
                        [
                            'type' => 'text',
                            'label' => trans('plugins/job-board::credit-consumption.feature_label'),
                            'attributes' => [
                                'name' => 'feature_label',
                                'value' => null,
                                'options' => [
                                    'class' => 'form-control',
                                    'data-counter' => 255,
                                    'placeholder' => 'e.g. Job Posting',
                                ],
                            ],
                        ],
                        [
                            'type' => 'number',
                            'label' => trans('plugins/job-board::credit-consumption.credits'),
                            'attributes' => [
                                'name' => 'credits',
                                'value' => null,
                                'options' => [
                                    'class' => 'form-control',
                                    'min' => 0,
                                    'placeholder' => '0',
                                ],
                            ],
                        ],
                    ],
                ])
                ->add('status', SelectField::class, StatusFieldOption::make())
                ->setBreakFieldPoint('status');
        } else {
            // Edit: single record
            $this
                ->add('account_type', SelectField::class, [
                    'label' => trans('plugins/job-board::credit-consumption.account_type'),
                    'choices' => [
                        'employer' => trans('plugins/job-board::package.package_type_employer'),
                        'job-seeker' => trans('plugins/job-board::package.package_type_job_seeker'),
                    ],
                ])
                ->add('feature_label', TextField::class, [
                    'label' => trans('plugins/job-board::credit-consumption.feature_label'),
                    'helper_text' => trans('plugins/job-board::credit-consumption.feature_key_auto_help'),
                    'attr' => ['placeholder' => 'e.g. Featured Job (highlighted + WhatsApp)'],
                ])
                ->add('credits', NumberField::class, [
                    'label' => trans('plugins/job-board::credit-consumption.credits'),
                    'attr' => ['min' => 0],
                ])
                ->add('order', NumberField::class, SortOrderFieldOption::make())
                ->add('status', SelectField::class, StatusFieldOption::make())
                ->setBreakFieldPoint('status');
        }
    }
}
