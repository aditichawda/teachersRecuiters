<?php

namespace Botble\JobBoard\Forms\Fronts;

use Botble\Base\Forms\FormAbstract;
use Botble\JobBoard\Facades\JobBoardHelper;
use Botble\JobBoard\Forms\Fields\CustomEditorField;
use Botble\JobBoard\Forms\JobForm as FormsJobForm;
use Botble\JobBoard\Http\Requests\AccountJobRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\Job;
use Botble\JobBoard\Models\ScreeningQuestion;

class JobForm extends FormsJobForm
{
    public function setup(): void
    {
        parent::setup();

        /**
         * @var Account $account
         */
        $account = auth('account')->user();
        $companies = $account->companies->pluck('name', 'id')->all();

        $this
            ->template(JobBoardHelper::viewPath('dashboard.forms.base'))
            ->hasFiles()
            ->setValidatorClass(AccountJobRequest::class)
            ->remove('is_featured')
            ->remove('moderation_status')
            ->remove('content')
            ->remove('company_id')
            ->remove('never_expired')
            ->removeMetaBox('image')
            ->when(JobBoardHelper::isUniqueIdFieldHiddenInFrontForm(), function (FormAbstract $form): void {
                $form->remove('unique_id');
            })
            ->modify('auto_renew', 'onOff', [
                'label' => trans(
                    'plugins/job-board::forms.auto_renew_label',
                    ['days' => JobBoardHelper::jobExpiredDays()]
                ),
                'default_value' => false,
            ], true)
            ->addAfter('description', 'content', CustomEditorField::class, [
                'label' => trans('core/base::forms.content'),
                'attr' => [
                    'model' => Job::class,
                ],
            ])
            ->modify('tag', 'tags', [
                'attr' => [
                    'placeholder' => trans('plugins/job-board::job.write_some_tags'),
                    'data-url' => route('public.account.jobs.tags.all'),
                ],
            ])
            ->addAfter('apply_url', 'external_apply_behavior', 'customRadio', [
                'label' => trans('plugins/job-board::forms.external_apply_url_behavior'),
                'choices' => [
                    '' => trans('plugins/job-board::forms.use_default_setting'),
                    'disabled' => trans('plugins/job-board::forms.show_modal'),
                    'new_tab' => trans('plugins/job-board::forms.open_new_tab'),
                    'current_tab' => trans('plugins/job-board::forms.open_current_tab'),
                ],
                'help_block' => [
                    'text' => trans('plugins/job-board::forms.external_apply_url_behavior_helper_text'),
                ],
            ]);

        $screeningQuestions = ScreeningQuestion::query()
            ->wherePublished()
            ->oldest('order')
            ->oldest('id')
            ->get();

        $sqChoices = $screeningQuestions->mapWithKeys(fn ($q) => [$q->id => $q->question])->all();

        $selectedSq = [];
        $selectedRequired = [];
        $model = $this->getModel();
        if ($model && $model->exists) {
            $pivots = $model->screeningQuestions()->get();
            $selectedSq = $pivots->pluck('id')->all();
            $selectedRequired = $pivots->filter(fn ($q) => (bool) ($q->pivot->is_required ?? false))->pluck('id')->all();
        }

        if ($sqChoices) {
            $this->addBefore('number_of_positions', 'screening_question_ids[]', 'multiCheckList', [
                'label' => trans('plugins/job-board::messages.job_screening_questions'),
                'choices' => $sqChoices,
                'value' => old('screening_question_ids', $selectedSq),
                'wrapper' => ['class' => 'form-group col-12'],
                'help_block' => ['text' => trans('plugins/job-board::screening-question.name') . ' - ' . __('Select which questions candidates will answer when applying')],
            ]);
            $this->addBefore('number_of_positions', 'screening_question_required[]', 'multiCheckList', [
                'label' => __('Required for this job'),
                'choices' => $sqChoices,
                'value' => old('screening_question_required', $selectedRequired),
                'wrapper' => ['class' => 'form-group col-12'],
                'help_block' => ['text' => __('Mark which selected questions are required when candidates apply')],
            ]);
        }

        if (count($companies) === 1) {
            $this->addBefore('number_of_positions', 'company_id', 'hidden', [
                'default_value' => array_key_first($companies),
            ]);
        } else {
            $this->addBefore('number_of_positions', 'company_id', 'customSelect', [
                'label' => trans('plugins/job-board::messages.company'),
                'required' => true,
                'wrapper' => [
                    'class' => 'form-group col-md-6',
                ],
                'choices' => $companies,
            ]);
        }
    }
}
