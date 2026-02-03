@php
    foreach (range(1, 3) as $style) {
        $styles[$style] = __('Style :number', ['number' => $style]);
    }
@endphp

<div class="form-group">
    <label class="control-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('Subtitle') }}</label>
    <input type="text" name="subtitle" value="{{ Arr::get($attributes, 'subtitle') }}" class="form-control" placeholder="{{ __('Subtitle') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('Number of displays') }}</label>
    <input type="text" name="limit" value="{{ Arr::get($attributes, 'limit') }}" class="form-control" placeholder="{{ __('Number of displays') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('Type') }}</label>
    {!! Form::customSelect('type', [
        'default' => __('Default'),
        'featured' => __('Featured'),
    ], Arr::get($attributes, 'type')) !!}
</div>

<div class="form-group">
    <label class="control-label">{{ __('Style') }}</label>
    {!! Form::customSelect('style', $styles, Arr::get($attributes, 'style')) !!}
</div>

<div class="form-group">
    <label class="control-label">{{ __('Items per row') }}</label>
    <input type="number" name="per_row" value="{{ Arr::get($attributes, 'per_row') }}" class="form-control" placeholder="{{ __('Items per row') }}">
</div>
