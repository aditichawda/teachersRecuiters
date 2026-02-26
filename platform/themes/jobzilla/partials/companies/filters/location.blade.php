@php
    use Botble\Location\Models\City;
    use Botble\Location\Models\State;
    use Botble\Location\Models\Country;
    use Botble\Base\Enums\BaseStatusEnum;

    $selectedCityId = request()->query('city_id');
    $selectedCityName = '';
    
    if ($selectedCityId && is_plugin_active('location')) {
        $city = City::query()->find($selectedCityId);
        if ($city) {
            $selectedCityName = $city->name;
        }
    }
@endphp

@if (is_plugin_active('location'))
<div class="form-group mb-4">
    <h4 class="section-head-small mb-4">{{ __('Location') }}</h4>
    <div class="company-city-search-wrapper" style="position: relative;">
        <input type="text" name="city_search" id="company_city_search" class="wt-select-bar-large company-city-search-input" placeholder="{{ __('Select Your Location') }}" autocomplete="off" value="{{ request('city_search', $selectedCityName) }}" />
        <input type="hidden" name="city_id" id="company_city_id" value="{{ $selectedCityId }}" />
        <div class="company-city-suggestions" id="company-city-suggestions" style="display: none;"></div>
    </div>
</div>
@endif
