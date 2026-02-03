@if (is_plugin_active('location'))
    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">{{ __('Location') }}</h4>
        <select name="city_id" class="wt-select-bar-large selectpicker-location">
            <option value="">{{ __('Select City') }}</option>
        </select>
    </div>
@endif
