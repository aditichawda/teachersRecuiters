<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\ScreeningQuestionForm;
use Botble\JobBoard\Http\Requests\ScreeningQuestionRequest;
use Botble\JobBoard\Models\ScreeningQuestion;
use Botble\JobBoard\Tables\ScreeningQuestionTable;
use Illuminate\Http\Request;

class ScreeningQuestionController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::screening-question.name'), route('screening-questions.index'));
    }

    public function index(ScreeningQuestionTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::screening-question.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::screening-question.create'));

        return ScreeningQuestionForm::create()->renderForm();
    }

    public function store(ScreeningQuestionRequest $request)
    {
        $screeningQuestion = ScreeningQuestion::query()->create($request->input());

        event(new CreatedContentEvent(SCREENING_QUESTION_MODULE_SCREEN_NAME, $request, $screeningQuestion));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('screening-questions.index'))
            ->setNextUrl(route('screening-questions.edit', $screeningQuestion->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(ScreeningQuestion $screeningQuestion, Request $request)
    {
        event(new BeforeEditContentEvent($request, $screeningQuestion));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $screeningQuestion->question]));

        return ScreeningQuestionForm::createFromModel($screeningQuestion)->renderForm();
    }

    public function update(ScreeningQuestion $screeningQuestion, ScreeningQuestionRequest $request)
    {
        $screeningQuestion->fill($request->input());
        $screeningQuestion->save();

        event(new UpdatedContentEvent(SCREENING_QUESTION_MODULE_SCREEN_NAME, $request, $screeningQuestion));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('screening-questions.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(ScreeningQuestion $screeningQuestion)
    {
        return DeleteResourceAction::make($screeningQuestion);
    }
}
