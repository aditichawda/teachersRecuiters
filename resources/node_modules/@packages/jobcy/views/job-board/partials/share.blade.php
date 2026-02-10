<div class="mt-4 pt-3">
    <ul class="list-inline mb-0">
        <li class="list-inline-item mt-1">
            <span>{{ __('Share this job:') }}</span>
        </li>
        {!! Theme::renderSocialSharing($job->url, SeoHelper::getDescription(), $job->image) !!}
    </ul>
</div>
