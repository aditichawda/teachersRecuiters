<h4 class="twm-s-title">{{ __('Share') }}</h4>

{!! Theme::renderSocialSharing($job->url, SeoHelper::getDescription(), $job->image) !!}
