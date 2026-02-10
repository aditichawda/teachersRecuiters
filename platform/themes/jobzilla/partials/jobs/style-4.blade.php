<div class="hpage-6-featured-block">
    <div class="inner-content">
        <div class="top-content">
            <span class="job-time">
                @if ($job->jobTypes->count() > 0)
                    @foreach($job->jobTypes as $jobType)
                        {{ $jobType->name }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </span>
            <span class="job-post-time">{{ $job->created_at->diffForHumans() }}</span>
        </div>
        <div class="mid-content">
            <div class="company-logo">
                <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->company_name }}">
            </div>
            <div class="company-info">
                <a href="{{ $job->url }}" class="company-name">{{ $job->company->name }} {!! $job->company->badge !!}</a>
                <p class="company-address"><i class="feather-map-pin"></i> {{ $job->location ?: 'India' }}</p>
            </div>
        </div>
        <div class="bottom-content">
            <h4 class="job-name-title">{{ $job->name }}</h4>
            <div class="job-payment">
                {{ JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text }}
            </div>
        </div>
        <div class="aply-btn-area">
            <a href="{{ $job->url }}" class="aplybtn">
                <i class="fa fa-check"></i>
            </a>
        </div>
    </div>
</div>
