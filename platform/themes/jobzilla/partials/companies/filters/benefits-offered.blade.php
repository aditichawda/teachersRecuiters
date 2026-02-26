@php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique benefits from staff_facilities (which is an array field)
    $allBenefits = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('staff_facilities')
        ->get()
        ->pluck('staff_facilities')
        ->flatten()
        ->filter()
        ->unique()
        ->sort()
        ->values();
@endphp

@if($allBenefits->count() > 0)
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Benefits Offered') }}</h4>
    <ul>
        @foreach($allBenefits as $benefit)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="benefits[]" id="benefit-{{ md5($benefit) }}" value="{{ $benefit }}" @checked(in_array($benefit, (array) request()->query('benefits', [])))>
                    <label class="form-check-label" for="benefit-{{ md5($benefit) }}">{{ $benefit }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endif
