<div class="mb-3">
    <label>{{ trans('core/base::forms.name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $config['name'] }}">
</div>

<div class="mb-3">
    <label>{{ trans('core/base::forms.description') }}</label>
    <textarea class="form-control" rows="3" name="about">{{ $config['about'] }}</textarea>
</div>

<div class="mb-3">
    <label>{{ __('Follow us heading') }}</label>
    <input type="text" class="form-control" name="follow_us_heading" value="{{ $config['follow_us_heading'] }}">
</div>

<div class="mb-3">
    <label class="form-check-label" for="show_social_links">
        {!! Form::checkbox('show_social_links', 1, Arr::get($config, 'show_social_links', true), ['class' => 'form-check-input', 'id' => 'show_social_links']) !!}
        {{ __('Show social links') }}
    </label>
    <p class="text-muted small">{{ __('Social links are managed in Theme Options > Social Links.') }}</p>
</div>
