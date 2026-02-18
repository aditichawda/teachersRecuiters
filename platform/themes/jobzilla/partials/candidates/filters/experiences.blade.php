@php
    use Botble\JobBoard\Repositories\Interfaces\JobExperienceInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $experiences = app(JobExperienceInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
@endphp
<div class="twm-sidebar-ele-filter">
    <h4 class="section-head-small mb-4">{{ __('Work Experience') }}</h4>
    <ul>
        @foreach($experiences as $experience)
            <li>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="candidate_experiences[]" id="candidate-experiences-{{ $experience->id }}" value="{{ $experience->id }}" @checked(in_array($experience->id, (array) request()->input('candidate_experiences', [])))>
                    <label class="form-check-label" for="candidate-experiences-{{ $experience->id }}">{{ $experience->name }}</label>
                </div>
            </li>
        @endforeach
    </ul>
</div>
