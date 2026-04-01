@php
    $helpBlock = \Illuminate\Support\Arr::get($options, 'help_block', []);
    $isChild = \Illuminate\Support\Arr::get($options, 'is_child', false);
@endphp
@if (\Illuminate\Support\Arr::get($helpBlock, 'text') && !$isChild)
    <{{ \Illuminate\Support\Arr::get($helpBlock, 'tag', 'p') }} {!! \Illuminate\Support\Arr::get($helpBlock, 'helpBlockAttrs', '') !!}>
        {!! $helpBlock['text'] !!}
    </{{ \Illuminate\Support\Arr::get($helpBlock, 'tag', 'p') }}>
@endif
