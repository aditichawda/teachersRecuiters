@props([
    'showLabel' => true,
    'showField' => true,
    'options' => [],
    'name',
    'nameKey' => null,
    'prepend' => null,
    'append' => null,
    'showError' => true,
])

@php
    $options = is_array($options) ? $options : (method_exists($options, 'toArray') ? $options->toArray() : []);
    $wrapper = Arr::get($options, 'wrapper', true);
    $wrapperAttrs = Arr::get($options, 'wrapperAttrs', '');
    $labelOpt = Arr::get($options, 'label', '');
    $labelShow = Arr::get($options, 'label_show', true);
    $labelAttr = Arr::get($options, 'label_attr', []);
@endphp

@if ($showLabel && $showField)
    @if ($wrapper !== false)
        <div {!! $wrapperAttrs !!}>
    @endif
@endif

@if ($showLabel && $labelOpt !== false && $labelShow)
    @if (isset($label))
        {!! $label !!}
    @else
        <x-core::form.label
            :for="$name"
            :label="$labelOpt"
            :attributes="new Illuminate\View\ComponentAttributeBag($labelAttr)"
        />
    @endif
@endif

@if ($showField)
    @if ($prepend = Arr::get($options, 'prepend'))
        {!! $prepend !!}
    @endif

    {!! $slot !!}

    @if ($append = Arr::get($options, 'append'))
        {!! $append !!}
    @endif

    @include('core/base::forms.partials.help-block')
@endif

@include('core/base::forms.partials.errors')

@if ($showLabel && $showField)
    @if ($wrapper !== false)
        </div>
    @endif
@endif
