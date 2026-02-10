<div class="twm-jobs-featured-style1 m-b30">
    <div class="twm-media">
        <img src="{{ $job->company_logo_thumb }}" alt="{{ $job->name }}">
    </div>

    <div class="twm-jobs-category green">
        @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
            @php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            @endphp
            <span @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}" @else class="twm-bg-sky" @endif>{{ $jobType->name }}</span>
        @endforeach
    </div>
    <div class="twm-mid-content">
        <a href="{{ $job->url }}" class="twm-job-title" title="{{ $job->name }}">
            <h4 class="twm-job-title text-truncate">{!! BaseHelper::clean($job->name) !!}</h4>
        </a>
    </div>
    <div class="twm-bot-content">
        <p class="twm-job-address"><i class="feather-map-pin"></i>{{ $job->location }}</p>
        <span class="twm-job-post-duration">{{ $job->created_at->diffForHumans() }}</span>
    </div>
</div>
