@php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique campus types from companies
    $campusTypes = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('campus_type')
        ->where('campus_type', '!=', '')
        ->distinct()
        ->pluck('campus_type')
        ->filter()
        ->unique()
        ->sort()
        ->values();
@endphp

@if($campusTypes->count() > 0)
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Campus Type') }}</h4>
    <ul>
        @foreach($campusTypes as $campusType)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="campus_type[]" id="campus-type-{{ md5($campusType) }}" value="{{ $campusType }}" @checked(in_array($campusType, (array) request()->query('campus_type', [])))>
                    <label class="form-check-label" for="campus-type-{{ md5($campusType) }}">{{ $campusType }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endif
