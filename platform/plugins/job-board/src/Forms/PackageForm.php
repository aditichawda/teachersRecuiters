<?php

namespace Botble\JobBoard\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\IsDefaultFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\RepeaterField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Http\Requests\PackageRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Currency;
use Botble\JobBoard\Models\Package;

class PackageForm extends FormAbstract
{
    public function setup(): void
    {
        Assets::addScripts(['input-mask']);

        $currencies = Currency::query()->pluck('title', 'id')->all();

        $model = $this->getModel();
        if (! $model || ! $model->getKey()) {
            $this->setupModel(new Package());
        }
        $model = $this->getModel();

        $this
            ->setValidatorClass(PackageRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required())
            ->add('description', TextareaField::class, DescriptionFieldOption::make())
            ->add('rowOpen1', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('price', 'text', [
                'label' => trans('plugins/job-board::package.price'),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'attr' => [
                    'id' => 'price-number',
                    'placeholder' => trans('plugins/job-board::package.price'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('currency_id', 'customSelect', [
                'label' => trans('plugins/job-board::package.currency'),
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'choices' => $currencies,
            ])
            ->add('rowClose1', 'html', [
                'html' => '</div>',
            ])
            ->add('rowOpen2', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('percent_save', 'text', [
                'label' => trans('plugins/job-board::package.percent_save'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'id' => 'percent-save-number',
                    'placeholder' => trans('plugins/job-board::package.percent_save'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('number_of_listings', 'text', [
                'label' => trans('plugins/job-board::package.number_of_listings'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'id' => 'price-number',
                    'placeholder' => trans('plugins/job-board::package.number_of_listings'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('account_limit', 'text', [
                'label' => trans('plugins/job-board::package.account_limit'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'id' => 'percent-save-number',
                    'placeholder' => trans('plugins/job-board::package.account_limit_placeholder'),
                    'class' => 'form-control input-mask-number',
                ],
            ])
            ->add('rowClose2', 'html', [
                'html' => '</div>',
            ])
            ->add('package_type', 'customSelect', [
                'label' => trans('plugins/job-board::package.package_type'),
                'choices' => [
                    'employer' => trans('plugins/job-board::package.package_type_employer'),
                    'job-seeker' => trans('plugins/job-board::package.package_type_job_seeker'),
                ],
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
                'attr' => ['id' => 'package_type_select', 'class' => 'form-control package-type-select'],
            ])
            ->add('employer_visibility_wrap_open', 'html', [
                'html' => '<div id="employer_visibility_section" class="col-12" style="display:none;"><div class="row"><div class="col-12"><h6 class="mb-2">' . trans('plugins/job-board::package.employer_package_visibility') . '</h6><p class="text-muted small mb-2">' . trans('plugins/job-board::package.employer_package_visibility_helper') . '</p></div>',
            ])
            ->add('show_for_school_institution', OnOffField::class, [
                'label' => trans('plugins/job-board::package.show_for_school_institution'),
                'wrapper' => ['class' => 'form-group col-md-6'],
                'value' => $model?->getAttribute('show_for_school_institution') ?? true,
            ])
            ->add('show_for_consultancy', OnOffField::class, [
                'label' => trans('plugins/job-board::package.show_for_consultancy'),
                'wrapper' => ['class' => 'form-group col-md-6'],
                'value' => $model?->getAttribute('show_for_consultancy') ?? true,
            ])
            ->add('visible_for_account_ids', 'autocomplete', [
                'label' => trans('plugins/job-board::package.visible_for_account_ids'),
                'wrapper' => ['class' => 'form-group col-md-12'],
                'attr' => [
                    'id' => 'visible_for_account_ids',
                    'data-url' => route('accounts.list'),
                    'multiple' => 'multiple',
                    'data-placeholder' => trans('plugins/job-board::package.visible_for_account_ids_placeholder'),
                ],
                'choices' => (function () use ($model) {
                    $ids = $model && is_array($model->visible_for_account_ids) ? $model->visible_for_account_ids : [];
                    $ids = array_values(array_filter(array_map('intval', $ids)));

                    if (! $ids) {
                        return ['' => trans('plugins/job-board::package.visible_for_account_ids_search_hint')];
                    }

                    return Account::query()
                        ->whereIn('id', $ids)
                        ->get()
                        ->mapWithKeys(fn (Account $a) => [$a->getKey() => $a->name])
                        ->all();
                })(),
                'selected' => $model && is_array($model->visible_for_account_ids)
                    ? array_values(array_filter(array_map('intval', $model->visible_for_account_ids)))
                    : null,
                'help_block' => [
                    'text' => trans('plugins/job-board::package.visible_for_account_ids_helper'),
                ],
            ])
            ->add('employer_visibility_wrap_close', 'html', [
                'html' => '</div></div>',
            ])
            ->add('package_feature_options_heading', 'html', [
                'html' => '<div class="col-12 mt-3"><h6 class="mb-2">' . trans('plugins/job-board::package.package_feature_options') . '</h6></div>',
            ])
            ->add('employer_features_wrap_open', 'html', [
                'html' => '<div id="employer_features_section" class="col-12" style="display:none;"><p class="text-muted small mb-2">' . trans('plugins/job-board::package.employer_features') . '</p><div class="row">',
            ])
            ->add('feature_featured_profile', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_featured_profile'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_admission_form_on_profile', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_admission_form_on_profile'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('employer_features_wrap_close', 'html', [
                'html' => '</div></div>',
            ])
            ->add('jobseeker_features_wrap_open', 'html', [
                'html' => '<div id="jobseeker_features_section" class="col-12" style="display:none;"><p class="text-muted small mb-2">' . trans('plugins/job-board::package.job_seeker_features') . '</p><div class="row">',
            ])
            ->add('job_apply_limit', NumberField::class, [
                'label' => trans('plugins/job-board::package.job_apply_limit'),
                'wrapper' => ['class' => 'form-group col-md-12'],
                'attr' => ['placeholder' => trans('plugins/job-board::package.job_apply_limit_placeholder'), 'min' => 0],
            ])
            ->add('feature_featured_profile_js', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_featured_profile'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_resume_builder', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_resume_builder'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_basic_cv', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_basic_cv'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_advance_cv', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_advance_cv'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_view_school_contact_info', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_view_school_contact_info'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('feature_job_alerts_whatsapp', OnOffField::class, [
                'label' => trans('plugins/job-board::package.feature_job_alerts_whatsapp'),
                'wrapper' => ['class' => 'form-group col-md-6'],
            ])
            ->add('jobseeker_features_wrap_close', 'html', [
                'html' => '</div></div>',
            ])
            ->add('package_feature_toggle_script', 'html', [
                'html' => '<script>
document.addEventListener("DOMContentLoaded", function() {
    var sel = document.getElementById("package_type_select") || document.querySelector(".package-type-select");
    var empSec = document.getElementById("employer_features_section");
    var empVisSec = document.getElementById("employer_visibility_section");
    var jsSec = document.getElementById("jobseeker_features_section");
    function toggle() {
        var v = (sel && sel.value) ? sel.value : "";
        if (empSec) empSec.style.display = (v === "employer") ? "block" : "none";
        if (empVisSec) empVisSec.style.display = (v === "employer") ? "block" : "none";
        if (jsSec) jsSec.style.display = (v === "job-seeker") ? "block" : "none";
    }
    if (sel) { sel.addEventListener("change", toggle); toggle(); }
});
</script>',
            ])
            ->add('rowOpen3', 'html', [
                'html' => '<div class="row">',
            ])
            ->add('validity_days', 'number', [
                'label' => trans('plugins/job-board::package.validity_days'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'placeholder' => 'e.g. 90',
                    'min' => 0,
                ],
            ])
            ->add('job_validity_days', 'number', [
                'label' => trans('plugins/job-board::package.job_validity_days'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'placeholder' => 'e.g. 45',
                    'min' => 0,
                ],
            ])
            ->add('credits_included', 'number', [
                'label' => trans('plugins/job-board::package.credits_included'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'placeholder' => 'e.g. 2500',
                    'min' => 0,
                ],
            ])
            ->add('profile_views_allowed', 'number', [
                'label' => trans('plugins/job-board::package.profile_views_allowed'),
                'wrapper' => [
                    'class' => 'form-group col-md-4',
                ],
                'attr' => [
                    'placeholder' => 'e.g. 100',
                    'min' => 0,
                ],
            ])
            ->add('worth', 'text', [
                'label' => trans('plugins/job-board::package.worth'),
                'wrapper' => [
                    'class' => 'form-group col-md-12',
                ],
                'attr' => [
                    'class' => 'form-control input-mask-number',
                    'placeholder' => 'Display value e.g. 11000',
                ],
            ])
            ->add('rowClose3', 'html', [
                'html' => '</div>',
            ])
            ->add('is_default', OnOffField::class, IsDefaultFieldOption::make())
            ->add('features', RepeaterField::class, [
                'label' => trans('plugins/job-board::package.features'),
                'fields' => [
                    [
                        'type' => 'text',
                        'label' => trans('plugins/job-board::package.title'),
                        'attributes' => [
                            'name' => 'text',
                            'value' => null,
                            'options' => [
                                'class' => 'form-control',
                                'data-counter' => 255,
                                'placeholder' => trans('plugins/job-board::package.feature_helper_text'),
                            ],
                        ],
                    ],
                ],
            ])
            ->add('order', NumberField::class, SortOrderFieldOption::make())
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status');

        if ($model && $model->getKey()) {
            $this->setUrl(route('packages.update', $model));
            $this->setMethod('PUT');
        } else {
            $this->setUrl(route('packages.store'));
        }
    }
}
