@php
    use Botble\JobBoard\Models\Company;
    use Botble\Base\Enums\BaseStatusEnum;

    // Get unique standard levels from standard_level (which is an array field)
    $allStandardLevels = Company::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->whereNotNull('standard_level')
        ->get()
        ->pluck('standard_level')
        ->flatten()
        ->filter()
        ->unique()
        ->sort()
        ->values();
@endphp

@if($allStandardLevels->count() > 0)
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Standard Level') }}</h4>
    <ul>
        @foreach($allStandardLevels as $level)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="standard_level[]" id="standard-level-{{ md5($level) }}" value="{{ $level }}" @checked(in_array($level, (array) request()->query('standard_level', [])))>
                    <label class="form-check-label" for="standard-level-{{ md5($level) }}">{{ $level }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endif
