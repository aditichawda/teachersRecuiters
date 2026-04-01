<?php

namespace Botble\Location\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\Location\Forms\StateForm;
use Botble\Location\Http\Requests\StateRequest;
use Botble\Location\Http\Resources\StateResource;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Botble\Location\Tables\StateTable;
use Illuminate\Http\Request;

class StateController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/location::location.name'))
            ->add(trans('plugins/location::state.name'), route('state.index'));
    }

    public function index(StateTable $table)
    {
        $this->pageTitle(trans('plugins/location::state.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/location::state.create'));

        return StateForm::create()->renderForm();
    }

    public function store(StateRequest $request)
    {
        $form = StateForm::create()->setRequest($request);
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('state.index')
            ->setNextRoute('state.edit', $form->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(State $state)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $state->name]));

        return StateForm::createFromModel($state)->renderForm();
    }

    public function update(State $state, StateRequest $request)
    {
        StateForm::createFromModel($state)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('state.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(State $state)
    {
        return DeleteResourceAction::make($state);
    }

    public function getList(Request $request)
    {
        $keyword = BaseHelper::stringify($request->input('q'));

        if (! $keyword) {
            return $this
                ->httpResponse()
                ->setData([]);
        }

        $data = State::query()
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->select(['id', 'name'])
            ->take(10)
            ->oldest('order')
            ->oldest('name')
            ->get();

        $data->prepend(new State(['id' => 0, 'name' => trans('plugins/location::city.select_state')]));

        return $this
            ->httpResponse()
            ->setData(StateResource::collection($data));
    }

    public function ajaxGetStates(Request $request)
    {
        $data = State::query()
            ->select(['id', 'name'])
            ->wherePublished()
            ->orderBy('order')
            ->orderBy('name');

        $countryId = $request->input('country_id');

        if ($countryId && $countryId != 'null') {
            $data = $data
                ->whereHas('country', function ($query) use ($countryId): void {
                    $query
                        ->where('id', $countryId)
                        ->orWhere('code', $countryId);
                });
        }

        $data = $data->get();

        $data->prepend(new State(['id' => 0, 'name' => trans('plugins/location::city.select_state')]));

        return $this
            ->httpResponse()
            ->setData(StateResource::collection($data));
    }

    public function ajaxSearchStates(Request $request)
    {
        try {
            $request->headers->set('Accept', 'application/json');

            $keyword = BaseHelper::stringify($request->query('k') ?: $request->query('keyword'));
            $defaultCountry = $request->query('default_country');

            $query = State::query()
                ->select(['id', 'name', 'country_id'])
                ->where(function ($q) {
                    $q->where('status', BaseStatusEnum::PUBLISHED)
                        ->orWhere('status', 1)
                        ->orWhereNull('status');
                })
                ->with(['country:id,name']);

            $perPage = 10;
            $page = max(1, (int) $request->query('page', 1));

            if (! $keyword || strlen($keyword) < 2) {
                if ($defaultCountry === '1' || $defaultCountry === 'true') {
                    $countryForDefault = Country::query()
                        ->where('is_default', true)
                        ->first();

                    if (! $countryForDefault) {
                        $countryForDefault = Country::query()
                            ->whereRaw('LOWER(TRIM(name)) = ?', ['india'])
                            ->first();
                    }

                    if (! $countryForDefault) {
                        $countryForDefault = Country::query()
                            ->orderByDesc('is_default')
                            ->oldest('order')
                            ->oldest('name')
                            ->first();
                    }

                    if ($countryForDefault) {
                        $query->where('country_id', $countryForDefault->id);

                        $total = $query->count();
                        $states = (clone $query)
                            ->orderBy('name')
                            ->offset(($page - 1) * $perPage)
                            ->limit($perPage)
                            ->get()
                            ->map(function ($state) {
                                return [
                                    'id' => $state->id,
                                    'name' => $state->name,
                                    'country_id' => $state->country_id,
                                    'country_name' => $state->country?->name,
                                ];
                            });

                        return $this->httpResponse()->setData([
                            'states' => $states,
                            'has_more' => ($page * $perPage) < $total,
                            'page' => $page,
                        ]);
                    }
                }

                $query->limit(12);
            } else {
                $keyword = trim($keyword);
                $query->where('name', 'LIKE', '%' . $keyword . '%')->limit(20);
            }

            $query->orderBy('name');

            $states = $query->get()->map(function ($state) {
                return [
                    'id' => $state->id,
                    'name' => $state->name,
                    'country_id' => $state->country_id,
                    'country_name' => $state->country?->name,
                ];
            })->values()->all();

            return $this->httpResponse()->setData($states);
        } catch (\Throwable $e) {
            \Log::error('[LOCATION_PLUGIN] State search error', [
                'keyword' => $keyword ?? 'none',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return $this->httpResponse()->setData([]);
        }
    }
}
