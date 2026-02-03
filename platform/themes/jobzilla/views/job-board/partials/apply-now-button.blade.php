@if ($job->canShowApplyJob())
    <div class="twm-job-self-bottom">
        @if ($job->is_applied)
            <a href="{{ $job->url }}" class="site-button disabled">
                <span>{{ __('Applied') }}</span>
            </a>
        @elseif (! auth('account')->check() && ! JobBoardHelper::isGuestApplyEnabled())
            <a href="{{ route('public.account.login') }}" class="site-button">
                <span>{{ __('Apply Now') }}</span>
            </a>
        @else
            @if ($job->apply_url && $job->shouldOpenExternalApplyUrlDirectly())
                <a href="{{ $job->apply_url }}" target="{{ $job->getExternalApplyUrlTarget() }}" class="site-button">
                    <span>{{ __('Apply Now') }}</span>
                </a>
            @else
                <a @if ($job->apply_url) href="#applyExternalJob" @else href="#applyNow" @endif data-bs-toggle="modal"
                    class="site-button"
                    data-job-name="{{ $job->name }}" data-job-id="{{ $job->id }}">
                    <span>{{ __('Apply Now') }}</span>
                </a>
            @endif
        @endif
    </div>
@elseif ($job->is_applied && ! auth('account')->user()->isEmployer())
    <div class="twm-job-self-bottom">
        <a href="#" class="site-button disabled" role="button">
            <span>{{ __('Applied') }}</span>
        </a>
    </div>
@else
    <div class="twm-job-self-bottom">
        <a href="#" class="site-button disabled" role="button">{{ __('Apply Now') }}</a>
    </div>
@endif
