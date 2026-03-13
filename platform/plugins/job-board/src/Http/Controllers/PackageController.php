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
use Illuminate\Http\Request;

class PackageController extends BaseController
{
    /**
     * Merge package feature checkboxes into features array for save.
     */
    private function mergePackageFeatures(PackageRequest $request): array
    {
        $type = $request->input('package_type', 'employer');
        $standardTexts = [];

        if ($type === 'employer') {
            if ($request->boolean('feature_featured_profile')) {
                $standardTexts[] = 'Featured Profile';
            }
            if ($request->boolean('feature_admission_form_on_profile')) {
                $standardTexts[] = 'Admission Form on Profile';
            }
        }

        if ($type === 'job-seeker') {
            if ($request->boolean('feature_featured_profile_js')) {
                $standardTexts[] = 'Featured Profile';
            }
            if ($request->boolean('feature_resume_builder')) {
                $standardTexts[] = 'Resume Builder';
            }
            if ($request->boolean('feature_basic_cv')) {
                $standardTexts[] = 'Basic CV';
            }
            if ($request->boolean('feature_advance_cv')) {
                $standardTexts[] = 'Advance CV';
            }
            if ($request->boolean('feature_view_school_contact_info')) {
                $standardTexts[] = 'View School Contact Info';
            }
            if ($request->boolean('feature_job_alerts_whatsapp')) {
                $standardTexts[] = 'Job Alerts on WhatsApp';
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
                if (is_string($text) && trim($text) !== '') {
                    $repeaterItems[] = ['text' => trim($text)];
                }
            }
        }

        $allTexts = array_unique(array_merge($standardTexts, array_column($repeaterItems, 'text')));

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

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('packages.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Package $package)
    {
        return DeleteResourceAction::make($package);
    }
}
