<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Forms\CreditConsumptionForm;
use Botble\JobBoard\Http\Requests\CreditConsumptionRequest;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Tables\CreditConsumptionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CreditConsumptionController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::credit-consumption.name'), route('credit-consumption.index'));
    }

    public function index(CreditConsumptionTable $table)
    {
        $this->pageTitle(trans('plugins/job-board::credit-consumption.name'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::credit-consumption.create'));

        return CreditConsumptionForm::create()->renderForm();
    }

    public function store(CreditConsumptionRequest $request)
    {
        $features = $request->input('features');
        $isBulk = is_array($features) && ! empty($features);

        if ($isBulk) {
            $accountType = $request->input('account_type');
            $status = $request->input('status', 'published');
            $order = 0;
            $created = [];

            foreach ($features as $row) {
                $label = $this->getRepeaterValueFromRow($row, 'feature_label');
                $credits = (int) $this->getRepeaterValueFromRow($row, 'credits');

                if ($label === '' && $credits === 0) {
                    continue;
                }
                if ($label === '') {
                    continue;
                }

                $key = $this->generateFeatureKeyFromLabel($label);

                $item = CreditConsumption::query()->create([
                    'account_type' => $accountType,
                    'feature_key' => $key,
                    'feature_label' => $label,
                    'credits' => $credits,
                    'order' => $order,
                    'status' => $status,
                ]);
                $created[] = $item;
                $order++;
            }

            foreach ($created as $item) {
                event(new CreatedContentEvent(CREDIT_CONSUMPTION_MODULE_SCREEN_NAME, $request, $item));
            }

            $count = count($created);

            return $this
                ->httpResponse()
                ->setPreviousUrl(route('credit-consumption.index'))
                ->setNextUrl(route('credit-consumption.index'))
                ->setMessage($count > 0
                    ? trans('plugins/job-board::credit-consumption.bulk_created', ['count' => $count])
                    : trans('core/base::notices.no_select'));
        }

        $input = $request->input();
        if (empty($input['feature_key']) && ! empty($input['feature_label'])) {
            $input['feature_key'] = $this->generateFeatureKeyFromLabel($input['feature_label']);
        }
        $item = CreditConsumption::query()->create($input);

        event(new CreatedContentEvent(CREDIT_CONSUMPTION_MODULE_SCREEN_NAME, $request, $item));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('credit-consumption.index'))
            ->setNextUrl(route('credit-consumption.edit', $item->id))
            ->withCreatedSuccessMessage();
    }

    /**
     * Generate a feature key from label (e.g. "Job Posting" → job_posting).
     */
    private function generateFeatureKeyFromLabel(string $label): string
    {
        $key = Str::slug(Str::lower($label), '_');
        return $key !== '' ? $key : 'feature_' . uniqid();
    }

    /**
     * Repeater sends features[i][j][key]=name & [value]=val (j = 0,1,2 for field index).
     * Support both: row by name (row['feature_key']) and by inner 'key' (row[0]['key']=='feature_key').
     */
    private function getRepeaterValueFromRow(array $row, string $name): string
    {
        if (isset($row[$name])) {
            $field = $row[$name];
            if (is_array($field) && array_key_exists('value', $field)) {
                return (string) $field['value'];
            }
            return is_string($field) ? $field : '';
        }
        foreach ($row as $cell) {
            if (is_array($cell) && ($cell['key'] ?? '') === $name && array_key_exists('value', $cell)) {
                return (string) $cell['value'];
            }
        }
        return '';
    }

    public function edit(CreditConsumption $creditConsumption, Request $request)
    {
        event(new BeforeEditContentEvent($request, $creditConsumption));

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $creditConsumption->feature_label]));

        return CreditConsumptionForm::createFromModel($creditConsumption)->renderForm();
    }

    public function update(CreditConsumption $creditConsumption, CreditConsumptionRequest $request)
    {
        $input = $request->input();
        $label = $input['feature_label'] ?? $creditConsumption->feature_label;
        if (empty($input['feature_key'])) {
            $input['feature_key'] = (string) $creditConsumption->feature_key !== ''
                ? $creditConsumption->feature_key
                : $this->generateFeatureKeyFromLabel((string) $label);
        }
        $creditConsumption->fill($input);
        $creditConsumption->save();

        event(new UpdatedContentEvent(CREDIT_CONSUMPTION_MODULE_SCREEN_NAME, $request, $creditConsumption));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('credit-consumption.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(CreditConsumption $creditConsumption)
    {
        return DeleteResourceAction::make($creditConsumption);
    }
}
