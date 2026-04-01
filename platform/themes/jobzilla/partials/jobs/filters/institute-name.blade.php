@php
    use Botble\JobBoard\Repositories\Interfaces\CompanyInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $companies = app(CompanyInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
            'order_by' => ['name' => 'ASC'],
        ]);
@endphp

<div class="form-group mb-4">
    <h4 class="section-head-small mb-4">{{ __('Institute Name') }}</h4>
    <select name="company_id" class="wt-select-bar-large selectpicker" data-live-search="true" data-size="8">
        <option value="">{{ __('All Institutes') }}</option>
        @foreach($companies as $company)
            <option value="{{ $company->id }}" @selected($company->id == request()->query('company_id'))>{{ $company->name }}</option>
        @endforeach
    </select>
</div>
