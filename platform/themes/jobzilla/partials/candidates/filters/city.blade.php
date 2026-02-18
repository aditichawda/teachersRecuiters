@if (is_plugin_active('location'))
    @php
        $cityId = (int) request()->query('city_id');
        $cityName = null;
        if ($cityId) {
            $city = \Botble\Location\Models\City::find($cityId);
            $cityName = $city ? $city->name : null;
        }
    @endphp
    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">{{ __('Location') }}</h4>
        <select name="city_id" class="wt-select-bar-large selectpicker-location">
            <option value="">{{ __('Select City') }}</option>
            @if ($cityId && $cityName)
                <option value="{{ $cityId }}" selected>{{ $cityName }}</option>
            @endif
        </select>
    </div>
@endif
