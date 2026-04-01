<div class="form-group">
    <label>{{ trans('core/base::forms.name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $config['name'] }}">
</div>

<div class="form-group">
    <label>{{ __('Title') }}</label>
    <input type="text" class="form-control" name="title" value="{{ $config['title'] }}">
</div>

<div class="form-group">
    <label>{{ __('Subtitle') }}</label>
    <textarea name="subtitle"  rows="3" class="form-control">{{ $config['subtitle'] }}</textarea>
</div>

<div class="form-group">
    <label>{{ __('Link') }}</label>
    <input type="text" class="form-control" name="link" value="{{ $config['link'] }}">
</div>

<div class="form-group">
    <label>{{ __('Image') }}</label>
    {!! Form::mediaImage('image', $config['image']) !!}
</div>
