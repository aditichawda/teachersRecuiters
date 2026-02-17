<?php

namespace Botble\Location\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\Location\Forms\CityForm;
use Botble\Location\Http\Requests\CityRequest;
use Botble\Location\Http\Resources\CityResource;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Tables\CityTable;
use Illuminate\Http\Request;

class CityController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/location::location.name'))
            ->add(trans('plugins/location::city.name'), route('city.index'));
    }

    public function index(CityTable $table)
    {
        $this->pageTitle(trans('plugins/location::city.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/location::city.create'));

        return CityForm::create()->renderForm();
    }

    public function store(CityRequest $request)
    {
        $form = CityForm::create()->setRequest($request);
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('city.index')
            ->setNextRoute('city.edit', $form->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(City $city)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $city->name]));

        return CityForm::createFromModel($city)->renderForm();
    }

    public function update(City $city, CityRequest $request)
    {
        CityForm::createFromModel($city)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('city.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(City $city)
    {
        return DeleteResourceAction::make($city);
    }

    public function getList(Request $request)
    {
        $keyword = BaseHelper::stringify($request->input('q'));

        if (! $keyword) {
            return $this
                ->httpResponse()
                ->setData([]);
        }

        $data = City::query()
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->select(['id', 'name'])
            ->take(10)
            ->oldest('order')
            ->oldest('name')
            ->get();

        $data->prepend(new City(['id' => 0, 'name' => trans('plugins/location::city.select_city')]));

        return $this
            ->httpResponse()
            ->setData(CityResource::collection($data));
    }

    public function ajaxGetCities(Request $request)
    {
        $data = City::query()
            ->select(['id', 'name'])
            ->wherePublished()
            ->orderBy('order')
            ->orderBy('name');

        $stateId = $request->input('state_id');

        if ($stateId && $stateId != 'null') {
            $data = $data->where('state_id', $stateId);
        }

        $countryId = $request->input('country_id');

        if ($countryId && $countryId != 'null') {
            $data = $data->where('country_id', $countryId);
        }

        $keyword = BaseHelper::stringify($request->query('k'));

        if ($keyword) {
            $data = $data
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->paginate(10);
        } else {
            $data = $data->get();
        }

        if ($keyword) {
            return $this
                ->httpResponse()
                ->setData([CityResource::collection($data), 'total' => $data->total()]);
        }

        $data->prepend(new City(['id' => 0, 'name' => trans('plugins/location::city.select_city')]));

        return $this
            ->httpResponse()
            ->setData(CityResource::collection($data));
    }

    public function ajaxSearchCities(Request $request)
    {
        try {
            $keyword = BaseHelper::stringify($request->query('k') ?: $request->query('keyword'));
            $defaultCountry = $request->query('default_country');

            $query = City::query()
                ->select(['id', 'name', 'state_id', 'country_id'])
                ->with(['state:id,name,country_id', 'state.country:id,name', 'country:id,name']);

            $perPage = 10;
            $page = max(1, (int) $request->query('page', 1));

            // When no keyword: show India cities by default if default_country=1 (paginated)
            if (! $keyword || strlen($keyword) < 2) {
                if ($defaultCountry === '1' || $defaultCountry === 'true') {
                    $india = Country::query()->where('name', 'India')->first();
                    if ($india) {
                        $query->where(function ($q) use ($india) {
                            $q->where('cities.country_id', $india->id)
                                ->orWhereHas('state', fn ($s) => $s->where('country_id', $india->id));
                        });
                        $total = $query->count();
                        $citiesQuery = (clone $query)->orderBy('order')->orderBy('name')
                            ->offset(($page - 1) * $perPage)
                            ->limit($perPage);
                        $cities = $citiesQuery->get()->map(function ($city) {
                            $countryId = $city->country_id ?: $city->state?->country_id;
                            $countryName = $city->country?->name ?: $city->state?->country?->name;

                            return [
                                'id' => $city->id,
                                'name' => $city->name,
                                'state_id' => $city->state_id,
                                'state_name' => $city->state?->name,
                                'country_id' => $countryId,
                                'country_name' => $countryName,
                            ];
                        });

                        return $this->httpResponse()->setData([
                            'cities' => $cities,
                            'has_more' => ($page * $perPage) < $total,
                            'page' => $page,
                        ]);
                    }
                    $query->limit(12);
                } else {
                    $query->limit(12);
                }
            } else {
                // Keyword search: search across all countries
                $query->where('name', 'LIKE', '%' . $keyword . '%')->limit(15);
            }

            $query->orderBy('order')->orderBy('name');

            $cities = $query->get()->map(function ($city) {
                $countryId = $city->country_id ?: $city->state?->country_id;
                $countryName = $city->country?->name ?: $city->state?->country?->name;

                return [
                    'id' => $city->id,
                    'name' => $city->name,
                    'state_id' => $city->state_id,
                    'state_name' => $city->state?->name,
                    'country_id' => $countryId,
                    'country_name' => $countryName,
                ];
            });

            return $this
                ->httpResponse()
                ->setData($cities);
        } catch (\Throwable $e) {
            return $this
                ->httpResponse()
                ->setData([]);
        }
    }
}
