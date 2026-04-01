<!-- @php
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
    <h4 class="section-head-small mb-4">{{ __('Institute Type') }}</h4>
    <ul>
        @foreach($institutionTypes as $institutionType)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="institution_type[]" id="institution-type-{{ md5($institutionType) }}" value="{{ $institutionType }}" @checked(in_array($institutionType, (array) request()->query('institution_type', [])))>
                    <label class="form-check-label" for="institution-type-{{ md5($institutionType) }}">{{ $institutionType }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div> -->
@php
    $pluginGroupsPath = base_path('platform/plugins/job-board/resources/data/institution-type-groups.php');
    $themeGroupsPath = base_path('platform/themes/jobzilla/partials/institution-type-groups.php');
    $institutionTypeGroups = file_exists($pluginGroupsPath)
        ? include $pluginGroupsPath
        : (file_exists($themeGroupsPath) ? include $themeGroupsPath : []);
@endphp

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Institute Type') }}</h4>
    <ul>
        @foreach($institutionTypeGroups as $group)
            @foreach($group['options'] as $value => $label)
                <li>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="institution_type[]" id="institution-type-{{ md5($value) }}" value="{{ $value }}" @checked(in_array($value, (array) request()->query('institution_type', [])))>
                        <label class="form-check-label" for="institution-type-{{ md5($value) }}">{{ $label }}</label>
                    </div>
                </li>
            @endforeach
        @endforeach
    </ul>
</div>

