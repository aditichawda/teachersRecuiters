<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\PackageForm;
use Botble\JobBoard\Http\Requests\PackageRequest;
use Botble\JobBoard\Models\Package;
use Botble\JobBoard\Tables\PackageTable;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PackageController extends BaseController
{
    /**
     * Merge package feature checkboxes into features array for save.
     */
    private function mergePackageFeatures(PackageRequest $request): array
    {
        $type = (string) $request->input('package_type', 'employer');
        $type = trim($type);

        // Normalize common variants so feature toggles always work.
        if (in_array($type, ['job_seeker', 'jobseeker', 'job seeker', 'jobseeker-package'], true)) {
            $type = 'job-seeker';
        }
        if (! in_array($type, ['employer', 'job-seeker'], true)) {
            $type = 'employer';
        }

        // Map of standard feature labels to their toggle booleans
        $standardMap = [];

        // Even if package_type is mis-submitted, if these fields exist in the request
        // we should still persist their values into `features`.
        $hasEmployerToggles = $request->hasAny(['feature_featured_profile', 'feature_admission_form_on_profile']);
        $hasJobSeekerToggles = $request->hasAny([
            'feature_featured_profile_js',
            'feature_resume_builder',
            'feature_basic_cv',
            'feature_advance_cv',
            'feature_view_school_contact_info',
            'feature_job_alerts_whatsapp',
        ]);

        if ($type === 'employer' || $hasEmployerToggles) {
            $standardMap['Featured Profile'] = $request->boolean('feature_featured_profile');
            $standardMap['Admission Form on Profile'] = $request->boolean('feature_admission_form_on_profile');
        }

        if ($type === 'job-seeker' || $hasJobSeekerToggles) {
            $standardMap['Featured Profile'] = $request->boolean('feature_featured_profile_js');
            $standardMap['Resume Builder'] = $request->boolean('feature_resume_builder');
            $standardMap['Basic CV'] = $request->boolean('feature_basic_cv');
            $standardMap['Advance CV'] = $request->boolean('feature_advance_cv');
            $standardMap['View School Contact Info'] = $request->boolean('feature_view_school_contact_info');
            $standardMap['Job Alerts on WhatsApp'] = $request->boolean('feature_job_alerts_whatsapp');
        }

        $enabledStandard = [];
        $disabledStandard = [];
        foreach ($standardMap as $label => $enabled) {
            if ($enabled) {
                $enabledStandard[] = $label;
            } else {
                $disabledStandard[] = $label;
            }
        }

        $repeater = $request->input('features');
        $repeaterItems = [];
        if (is_array($repeater)) {
            foreach ($repeater as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $text = $row['text'] ?? $row['title'] ?? $row['value'] ?? $row['key'] ?? null;
                if (! is_string($text)) {
                    continue;
                }
                $text = trim($text);
                if ($text === '') {
                    continue;
                }

                // If this text is one of the standard labels whose toggle is OFF, skip it
                if (in_array($text, $disabledStandard, true)) {
                    continue;
                }

                $repeaterItems[] = ['text' => $text];
            }
        }

        $allTexts = array_unique(array_merge($enabledStandard, array_column($repeaterItems, 'text')));

        return array_values(array_map(fn ($t) => ['text' => $t], $allTexts));
    }
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::package.name'), route('packages.index'));
    }

    public function index(PackageTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::package.name'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::package.create'));

        return PackageForm::create()->renderForm();
    }

    public function store(PackageRequest $request)
    {
        if (! $request->input('price')) {
            $request->merge(['price' => 0]);
        }

        $input = $request->input();
        $input['features'] = $this->mergePackageFeatures($request);
        $input['job_apply_limit'] = $request->input('job_apply_limit');

        $package = Package::query()->create($input);

        // Ensure package name is editable/persisted even when translations table is used
        if (Schema::hasTable('jb_packages_translations')) {
            $langCode = function_exists('is_plugin_active') && is_plugin_active('language')
                ? \Botble\Language\Facades\Language::getCurrentAdminLocaleCode()
                : app()->getLocale();

            $langCode = $langCode ?: app()->getLocale();

            DB::table('jb_packages_translations')->updateOrInsert(
                ['lang_code' => $langCode, 'jb_packages_id' => $package->getKey()],
                [
                    'name' => $package->getAttribute('name'),
                    'description' => $package->getAttribute('description'),
                ]
            );
        }

        // Persist translatable fields on create (language-advanced), otherwise admin edit may show old/blank values.
        if (is_plugin_active('language-advanced') && LanguageAdvancedManager::isSupported($package)) {
            if (! $request->has('language')) {
                $request->merge(['language' => \Botble\Language\Facades\Language::getCurrentAdminLocaleCode() ?: \Botble\Language\Facades\Language::getDefaultLocaleCode()]);
            }
            $request->merge([
                'name' => $package->name,
                'description' => $package->description,
            ]);
            LanguageAdvancedManager::save($package, $request);
        }

        event(new CreatedContentEvent(PACKAGE_MODULE_SCREEN_NAME, $request, $package));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('packages.index'))
            ->setNextUrl(route('packages.edit', $package->id))
            ->withCreatedSuccessMessage();
    }

    public function edit(Package $package, Request $request)
    {
        event(new BeforeEditContentEvent($request, $package));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $package->name]));

        return PackageForm::createFromModel($package)->renderForm();
    }

    public function update(Package $package, PackageRequest $request)
    {
        if (! $request->input('price')) {
            $request->merge(['price' => 0]);
        }

        $package->fill($request->input());
        $package->features = $this->mergePackageFeatures($request);
        $package->job_apply_limit = $request->input('job_apply_limit');
        $package->save();

        event(new UpdatedContentEvent(PACKAGE_MODULE_SCREEN_NAME, $request, $package));

        $response = $this
            ->httpResponse()
            ->setPreviousUrl(route('packages.index'))
            ->withUpdatedSuccessMessage();

        // When "Save and continue" is used, redirect to the correct edit URL (packages/{id}/edit)
        // so we never redirect to a wrong URL like packages/edit/{id} which would 404.
        if ($request->input('submitter') === 'apply') {
            $response->setNextUrl(route('packages.edit', $package));
        }

        return $response;
    }

    public function destroy(Package $package)
    {
        return DeleteResourceAction::make($package);
    }
}
