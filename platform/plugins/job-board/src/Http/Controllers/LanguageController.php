<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\LanguageForm;
use Botble\JobBoard\Http\Requests\LanguageRequest;
use Botble\JobBoard\Models\Language;
use Botble\JobBoard\Tables\LanguageTable;
use Illuminate\Http\Request;

class LanguageController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::language.name'), route('languages.index'));
    }

    public function index(LanguageTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::language.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::language.create'));

        return LanguageForm::create()->renderForm();
    }

    public function store(LanguageRequest $request)
    {
        if ($request->input('is_default')) {
            Language::query()->where('id', '>', 0)->update(['is_default' => 0]);
        }

        $language = Language::query()->create($request->input());

        event(new CreatedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('languages.index'))
            ->setNextUrl(route('languages.edit', $language->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(Language $language, Request $request)
    {
        event(new BeforeEditContentEvent($request, $language));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $language->name]));

        return LanguageForm::createFromModel($language)->renderForm();
    }

    public function update(Language $language, LanguageRequest $request)
    {
        if ($request->input('is_default')) {
            Language::query()->where('id', '!=', $language->getKey())->update(['is_default' => 0]);
        }

        $language->fill($request->input());
        $language->save();

        event(new UpdatedContentEvent(LANGUAGE_MODULE_SCREEN_NAME, $request, $language));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('languages.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Language $language)
    {
        return DeleteResourceAction::make($language);
    }

    public function getAllLanguages()
    {
        return Language::query()->pluck('name')->all();
    }
}
