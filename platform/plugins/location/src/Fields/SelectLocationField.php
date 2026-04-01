<?php

namespace Botble\Location\Fields;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\Html;
use Botble\Base\Forms\Form;
use Botble\Base\Forms\FormField;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class SelectLocationField extends FormField
{
    protected array $locationKeys = [];

    public function __construct($name, $type, Form $parent, array $options = [])
    {
        parent::__construct($name, $type, $parent);

        $default = [
            'country' => 'country_id',
            'state' => 'state_id',
            'city' => 'city_id',
        ];

        $this->locationKeys = array_filter(array_merge($default, Arr::get($options, 'locationKeys', [])));

        $this->name = $name;
        $this->type = $type;
        $this->parent = $parent;
        $this->formHelper = $this->parent->getFormHelper();

        $this->setTemplate();
        $this->setDefaultOptions($options);
        $this->setupValue();
        $this->initFilters();

        Assets::addScriptsDirectly('vendor/core/plugins/location/js/location.js');
    }

    protected function getConfig($key = null, $default = null)
    {
        return $this->parent->getConfig($key, $default);
    }

    protected function setTemplate(): void
    {
        $this->template = $this->getConfig($this->getTemplate(), $this->getTemplate());
    }

    protected function setupValue(): void
    {
        $values = $this->getOption($this->valueProperty);
        foreach ($this->locationKeys as $k => $v) {
            $value = Arr::get($values, $k);
            if ($value === null) {
                $value = old($v, $this->getModelValueAttribute($this->parent->getModel(), $v));
            }

            $values[$k] = $value;
        }
        $this->setValue($values);
    }

    public function getCountryOptions(): array
    {
        $countryKey = Arr::get($this->locationKeys, 'country');
        $countries = Country::query()
            ->select('name', 'id', 'is_default')
            ->latest('is_default')
            ->oldest('order')
            ->oldest('name')
            ->latest()
            ->get();

        $value = Arr::get($this->getValue(), 'country');

        if (! $value && $countries->isNotEmpty()) {
            $firstCountry = $countries->first();
            if ($firstCountry->is_default) {
                $value = $firstCountry->getKey();
            }
        }

        $countries = $countries
            ->mapWithKeys(fn ($item) => [$item->getKey() => $item->name])
            ->all();

        $attr = array_merge($this->getOption('attr', []), [
            'id' => $countryKey,
            'class' => 'select-search-full',
            'data-type' => 'country',
        ]);

        return array_merge([
            'label' => trans('plugins/location::city.country'),
            'attr' => $attr,
            'choices' => ['' => trans('plugins/location::city.select_country')] + $countries,
            'selected' => $value,
            'empty_value' => null,
        ], $this->getOption('attrs.country', []));
    }

    public function getStateOptions(): array
    {
        $states = [];
        $isCityFirst = (bool) $this->getOption('cityFirst');
        $stateKey = Arr::get($this->locationKeys, 'state');
        $countryId = Arr::get($this->getValue(), 'country');

        if (! $isCityFirst && ! $countryId) {
            $defaultCountry = Country::query()
                ->select('id')
                ->where('is_default', true)
                ->first();

            if ($defaultCountry) {
                $countryId = $defaultCountry->id;
            }
        }

        $value = Arr::get($this->getValue(), 'state');
        if ($countryId) {
            $statesQuery = State::query()
                ->where('country_id', $countryId)
                ->select('name', 'id', 'is_default')
                ->latest('is_default')
                ->oldest('order')
                ->oldest('name')
                ->latest()
                ->get();

            if (! $value && $statesQuery->isNotEmpty()) {
                $firstState = $statesQuery->first();
                if ($firstState->is_default) {
                    $value = $firstState->getKey();
                }
            }

            $states = $statesQuery
                ->mapWithKeys(fn ($item) => [$item->getKey() => $item->name])
                ->all();
        }

        $attr = array_merge($this->getOption('attr', []), [
            'id' => $stateKey,
            'data-url' => route('ajax.states-by-country'),
            'class' => 'select-search-full',
            'data-type' => 'state',
        ]);

        return array_merge([
            'label' => trans('plugins/location::city.state'),
            'attr' => $attr,
            'choices' => ['' => trans('plugins/location::city.select_state')] + $states,
            'selected' => $value,
            'empty_value' => null,
        ], $this->getOption('attrs.state', []));
    }

    public function getCityOptions(): array
    {
        $cities = [];
        $cityKey = Arr::get($this->locationKeys, 'city');
        $isCityFirst = (bool) $this->getOption('cityFirst');
        $stateId = Arr::get($this->getValue(), 'state');
        $countryId = Arr::get($this->getValue(), 'country');
        $value = Arr::get($this->getValue(), 'city');

        if (! $countryId) {
            $defaultCountry = Country::query()
                ->select('id')
                ->where('is_default', true)
                ->first();

            if ($defaultCountry) {
                $countryId = $defaultCountry->id;
            }
        }

        if (! $isCityFirst && ! $stateId && $countryId) {
            $defaultState = State::query()
                ->select('id')
                ->where('country_id', $countryId)
                ->where('is_default', true)
                ->first();

            if ($defaultState) {
                $stateId = $defaultState->id;
            }
        }

        $citiesQuery = collect();

        if ($isCityFirst) {
            $citiesQuery = City::query()
                ->select('name', 'id', 'is_default')
                ->latest('is_default')
                ->oldest('order')
                ->oldest('name')
                ->limit(1000)
                ->get();
        } elseif ($stateId) {
            $citiesQuery = City::query()
                ->where('state_id', $stateId)
                ->latest('is_default')
                ->oldest('order')
                ->oldest('name')
                ->latest()
                ->select('name', 'id', 'is_default')
                ->get();
        } elseif ($countryId) {
            $citiesQuery = City::query()
                ->where('country_id', $countryId)
                ->select('name', 'id', 'is_default')
                ->latest('is_default')
                ->oldest('order')
                ->oldest('name')
                ->latest()
                ->get();
        }

        if (! $value && $citiesQuery->isNotEmpty()) {
            $firstCity = $citiesQuery->first();
            if ($firstCity->is_default) {
                $value = $firstCity->getKey();
            }
        }

        $cities = $citiesQuery
            ->mapWithKeys(fn ($item) => [$item->getKey() => $item->name])
            ->all();

        $attr = array_merge($this->getOption('attr', []), [
            'id' => $cityKey,
            'data-url' => route('ajax.cities-by-state'),
            'data-search-url' => route('ajax.search-cities'),
            'class' => 'select-search-full',
            'data-type' => 'city',
        ]);

        return array_merge([
            'label' => trans('plugins/location::city.city'),
            'attr' => $attr,
            'choices' => ['' => trans('plugins/location::city.select_city')] + $cities,
            'selected' => $value,
            'empty_value' => null,
        ], $this->getOption('attrs.city', []));
    }

    public function render(
        array $options = [],
        $showLabel = true,
        $showField = true,
        $showError = true
    ): HtmlString|string {
        $html = '';

        $this->prepareOptions($options);

        if ($showField) {
            $this->rendered = true;
        }

        if (! $this->needsLabel()) {
            $showLabel = false;
        }

        if ($showError) {
            $showError = $this->parent->haveErrorsEnabled();
        }

        $data = $this->getRenderData();

        if ($this->getOption('cityFirst')) {
            $html = $this->renderCityFirstLayout();

            if (request()->ajax()) {
                $html .= Html::script('vendor/core/plugins/location/js/location.js');
            }

            return Html::tag(
                'div',
                $html,
                ['class' => ($this->getOption('wrapperClassName') ?: 'mb-3 row') . ' select-location-fields']
            );
        }

        $locationKeys = $this->locationKeys;

        foreach ($locationKeys as $k => $v) {
            $options = [];
            switch ($k) {
                case 'country':
                    $options = $this->getCountryOptions();

                    break;
                case 'state':
                    $options = $this->getStateOptions();

                    break;
                case 'city':
                    $options = $this->getCityOptions();

                    break;
            }

            $options = array_merge($this->options, $options);

            $html .= $this->formHelper->getView()->make(
                $this->getViewTemplate(),
                $data + [
                    'name' => $v,
                    'nameKey' => $v,
                    'type' => $this->type,
                    'options' => $options,
                    'showLabel' => $showLabel,
                    'showField' => $showField,
                    'showError' => $showError,
                    'errorBag' => $this->parent->getErrorBag(),
                    'translationTemplate' => $this->parent->getTranslationTemplate(),
                ]
            )->render();

            if (request()->ajax()) {
                $html .= Html::script('vendor/core/plugins/location/js/location.js');
            }
        }

        return Html::tag(
            'div',
            $html,
            ['class' => ($this->getOption('wrapperClassName') ?: 'mb-3 row') . ' select-location-fields']
        );
    }

    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.custom-select';
    }

    protected function renderCityFirstLayout(): string
    {
        $cityKey = Arr::get($this->locationKeys, 'city', 'city_id');
        $stateKey = Arr::get($this->locationKeys, 'state', 'state_id');
        $countryKey = Arr::get($this->locationKeys, 'country', 'country_id');

        $cityId = (string) (Arr::get($this->getValue(), 'city') ?? '');
        $stateId = (string) (Arr::get($this->getValue(), 'state') ?? '');
        $countryId = (string) (Arr::get($this->getValue(), 'country') ?? '');

        $cityName = '';
        $stateName = '';
        $countryName = '';

        if ($cityId !== '') {
            $city = City::query()->select(['id', 'name', 'state_id', 'country_id'])->find($cityId);
            if ($city) {
                $cityName = (string) $city->name;
                $stateId = $stateId !== '' ? $stateId : (string) ($city->state_id ?? '');
                $countryId = $countryId !== '' ? $countryId : (string) ($city->country_id ?? '');
            }
        }

        if ($stateId !== '') {
            $state = State::query()->select(['id', 'name', 'country_id'])->find($stateId);
            if ($state) {
                $stateName = (string) $state->name;
                $countryId = $countryId !== '' ? $countryId : (string) ($state->country_id ?? '');
            }
        }

        if ($countryId !== '') {
            $countryName = (string) (Country::query()->whereKey($countryId)->value('name') ?? '');
        }

        $cityLabel = e(trans('plugins/location::city.city'));
        $stateLabel = e(trans('plugins/location::city.state'));
        $countryLabel = e(trans('plugins/location::city.country'));
        $cityPlaceholder = e(trans('plugins/location::city.select_city'));
        $statePlaceholder = e(trans('plugins/location::city.select_state'));
        $countryPlaceholder = e(trans('plugins/location::city.select_country'));
        $searchUrl = e(route('ajax.search-cities'));

        return '
            <div class="col-md-4 mb-3 js-location-city-first">
                <label class="form-label" for="' . e($cityKey) . '_search">' . $cityLabel . '</label>
                <div class="position-relative">
                    <input
                        type="text"
                        id="' . e($cityKey) . '_search"
                        class="form-control js-location-city-search"
                        value="' . e($cityName) . '"
                        placeholder="' . $cityPlaceholder . '"
                        data-search-url="' . $searchUrl . '"
                        autocomplete="off"
                    >
                    <div class="js-location-city-suggestions list-group position-absolute w-100 shadow-sm border rounded bg-white" style="display:none; z-index: 2000; max-height: 260px; overflow-y: auto; background-color: #fff !important;"></div>
                </div>
                <input type="hidden" class="js-location-city-id" name="' . e($cityKey) . '" value="' . e($cityId) . '">
            </div>
            <div class="col-md-4 mb-3 js-location-city-first">
                <label class="form-label">' . $stateLabel . '</label>
                <input
                    type="text"
                    class="form-control js-location-state-display"
                    value="' . e($stateName) . '"
                    placeholder="' . $statePlaceholder . '"
                    readonly
                >
                <input type="hidden" class="js-location-state-id" name="' . e($stateKey) . '" value="' . e($stateId) . '">
            </div>
            <div class="col-md-4 mb-3 js-location-city-first">
                <label class="form-label">' . $countryLabel . '</label>
                <input
                    type="text"
                    class="form-control js-location-country-display"
                    value="' . e($countryName) . '"
                    placeholder="' . $countryPlaceholder . '"
                    readonly
                >
                <input type="hidden" class="js-location-country-id" name="' . e($countryKey) . '" value="' . e($countryId) . '">
            </div>
        ';
    }
}
