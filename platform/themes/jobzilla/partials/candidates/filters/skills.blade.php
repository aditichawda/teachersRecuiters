@php
    use Botble\JobBoard\Repositories\Interfaces\JobSkillInterface;
    use Botble\Base\Enums\BaseStatusEnum;

    $skills = app(JobSkillInterface::class)
        ->advancedGet([
            'condition' => [
                'status' => BaseStatusEnum::PUBLISHED,
            ],
        ]);
@endphp

@if ($skills->count())
    <div class="twm-sidebar-ele-filter">
        <div class="widget tw-sidebar-tags-wrap">
            <h4 class="section-head-small mb-4">{{ __('Skills') }}</h4>
            <div class="tagcloud">
                @foreach ($skills as $skill)
                    <span>
                        <input type="checkbox" class="btn-check" name="candidate_skills[]" id="candidate-skills-{{ $skill->id }}" autocomplete="off" value="{{ $skill->id }}" @checked(in_array($skill->id, (array) request()->input('candidate_skills', [])))>
                        <label class="tag-cloud btn" for="candidate-skills-{{ $skill->id }}">{{ $skill->name }}</label>
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endif
