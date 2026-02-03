@php
    use Botble\JobBoard\Repositories\Interfaces\JobTypeInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $jobTypes = app(JobTypeInterface::class)
        ->advancedGet([
            'withCount' => ['jobs' => function ($query) {
                $query->where(JobBoardHelper::getJobDisplayQueryConditions());
            }],
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
@endphp

<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Type of employment') }}</h4>
    <ul>
        @foreach($jobTypes as $jobType)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="job_types[]" id="job-types-{{ $jobType->id }}" value="{{ $jobType->id }}" @checked(in_array($jobType->id, (array) request()->input('job_type', [])))>
                    <label class="form-check-label" for="job-types-{{ $jobType->id }}">{{ $jobType->name }}</label>
                </div>
                <span class="twm-job-type-count">{{ $jobType->jobs_count }}</span>
            </li>
        @endforeach
    </ul>
</div>
