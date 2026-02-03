<div class="form-group">
    <label>{{ trans('core/base::forms.name') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $config['name'] }}">
</div>

<div class="form-group">
    <label>{{ __('Logo') }}</label>
    {!! Form::mediaImage('logo', $config['logo']) !!}
</div>

<div class="form-group">
    <label>{{ __('Description') }}</label>
    <input type="text" class="form-control" name="description" value="{{ $config['description'] }}">
</div>

<div class="form-group">
    <label>{{ __('Address') }}</label>
    <input type="text" class="form-control" name="address" value="{{ $config['address'] }}">
</div>

<div class="form-group">
    <label>{{ __('Phone') }}</label>
    <input type="text" class="form-control" name="phone" value="{{ $config['phone'] }}">
</div>

<div class="form-group">
    <label>{{ __('Email') }}</label>
    <input type="text" class="form-control" name="email" value="{{ $config['email'] }}">
</div>
