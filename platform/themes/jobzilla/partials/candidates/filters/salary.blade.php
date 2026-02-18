<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Expected Salary') }}</h4>
    <div class="form-group mb-3">
        <label class="form-label">{{ __('From') }}</label>
        <input type="number" name="expected_salary_from" value="{{ BaseHelper::stringify(request()->query('expected_salary_from')) }}" class="form-control" placeholder="{{ __('Min Salary') }}" min="0" step="1000">
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ __('To') }}</label>
        <input type="number" name="expected_salary_to" value="{{ BaseHelper::stringify(request()->query('expected_salary_to')) }}" class="form-control" placeholder="{{ __('Max Salary') }}" min="0" step="1000">
    </div>
</div>
