<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\SpecializationForm;
use Botble\JobBoard\Http\Requests\SpecializationRequest;
use Botble\JobBoard\Models\Specialization;
use Botble\JobBoard\Tables\SpecializationTable;
use Illuminate\Http\Request;

class SpecializationController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::specialization.name'), route('specializations.index'));
    }

    public function index(SpecializationTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::specialization.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::specialization.create'));

        return SpecializationForm::create()->renderForm();
    }

    public function store(SpecializationRequest $request)
    {
        if ($request->input('is_default')) {
            Specialization::query()->where('id', '>', 0)->update(['is_default' => 0]);
        }

        $specialization = Specialization::query()->create($request->input());

        event(new CreatedContentEvent(SPECIALIZATION_MODULE_SCREEN_NAME, $request, $specialization));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('specializations.index'))
            ->setNextUrl(route('specializations.edit', $specialization->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(Specialization $specialization, Request $request)
    {
        event(new BeforeEditContentEvent($request, $specialization));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $specialization->name]));

        return SpecializationForm::createFromModel($specialization)->renderForm();
    }

    public function update(Specialization $specialization, SpecializationRequest $request)
    {
        if ($request->input('is_default')) {
            Specialization::query()->where('id', '!=', $specialization->getKey())->update(['is_default' => 0]);
        }

        $specialization->fill($request->input());
        $specialization->save();

        event(new UpdatedContentEvent(SPECIALIZATION_MODULE_SCREEN_NAME, $request, $specialization));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('specializations.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Specialization $specialization)
    {
        return DeleteResourceAction::make($specialization);
    }

    public function getAllSpecializations()
    {
        return Specialization::query()->pluck('name')->all();
    }
}
