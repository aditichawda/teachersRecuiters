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
        <label>{{ __('iOS link') }}</label>
        <input type="text" class="form-control" name="ios_link" value="{{ $config['ios_link'] }}">
    </div>
    
    <div class="form-group">
        <label>{{ __('iOS image') }}</label>
        {!! Form::mediaImage('ios_image', $config['ios_image']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Android link') }}</label>
        <input type="text" class="form-control" name="android_link" value="{{ $config['android_link'] }}">
    </div>
    
    <div class="form-group">
        <label>{{ __('Android image') }}</label>
        {!! Form::mediaImage('android_image', $config['android_image']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Image 1') }}</label>
        {!! Form::mediaImage('image_1', $config['image_1']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Image 2') }}</label>
        {!! Form::mediaImage('image_2', $config['image_2']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Background') }}</label>
        {!! Form::mediaImage('background', $config['background']) !!}
    </div>
    
    <div class="form-group">
        <label>{{ __('Featured') }}</label>
        <textarea name="featured" rows="3" class="form-control">{{ $config['featured'] }}</textarea>
    </div>
</section>
