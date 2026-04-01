<x-core::form.toggle
    :id="$attributes['id'] ?? $name"
    :name="$name"
    :checked="$value"
    :attributes="new Illuminate\View\ComponentAttributeBag((array) $attributes)"
/>
