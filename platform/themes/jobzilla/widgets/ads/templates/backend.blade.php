<section style="max-height: 400px; overflow: auto">
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
        <input type="text" class="form-control" name="subtitle" value="{{ $config['subtitle'] }}">
    </div>
    
    <div class="form-group">
        <label>{{ __('Background') }}</label>
        {!! Form::mediaImage('background', $config['background']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Button name') }}</label>
        <input type="text" class="form-control" name="button_name" value="{{ $config['button_name'] }}">
    </div>

    <div class="form-group">
        <label>{{ __('Button URL') }}</label>
        <input type="text" class="form-control" name="button_url" value="{{ $config['button_url'] }}">
    </div>
</section>
