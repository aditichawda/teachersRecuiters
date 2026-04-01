@if ($showError && isset($errors))
    @foreach ($errors->get($nameKey) as $err)
        <div {!! \Illuminate\Support\Arr::get($options ?? [], 'errorAttrs', '') !!}>{{ $err }}</div>
    @endforeach
@endif
