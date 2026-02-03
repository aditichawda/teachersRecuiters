@php
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $categories = app(CategoryInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
@endphp

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Industry') }}</h4>
    <ul>
        @foreach($categories as $category)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="job_categories[]" id="job-categories-{{ $category->id }}" value="{{ $category->id }}" @checked(in_array($category->id, (array) request()->input('job_type', [])))>
                    <label class="form-check-label" for="job-categories-{{ $category->id }}">{{ $category->name }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
