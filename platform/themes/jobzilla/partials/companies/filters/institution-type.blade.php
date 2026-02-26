@php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique institution types from companies
    $institutionTypes = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('institution_type')
        ->where('institution_type', '!=', '')
        ->distinct()
        ->pluck('institution_type')
        ->filter()
        ->unique()
        ->sort()
        ->values();
@endphp

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Institution Type') }}</h4>
    <ul>
        @foreach($institutionTypes as $institutionType)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="institution_type[]" id="company-institution-type-{{ md5($institutionType) }}" value="{{ $institutionType }}" @checked(in_array($institutionType, (array) request()->query('institution_type', [])))>
                    <label class="form-check-label" for="company-institution-type-{{ md5($institutionType) }}">{{ $institutionType }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
