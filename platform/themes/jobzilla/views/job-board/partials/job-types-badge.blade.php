@if ($jobTypes->isNotEmpty())
    <div class="twm-jobs-category">
        @foreach ($job->jobTypes->loadMissing('metadata') as $jobType)
            @php
                $jobType->background_color = $jobType->getMetaData('background_color', true);
            @endphp
            <span @if ($jobType->background_color) style="background-color: {{ $jobType->background_color }}" @else class="twm-bg-green" @endif>{{ $jobType->name }}</span>
        @endforeach
    </div>
@endif
