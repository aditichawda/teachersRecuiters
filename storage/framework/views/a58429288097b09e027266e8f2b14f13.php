<?php
    $fields = Arr::get($options, 'fields', []);
    $attributes = Arr::get($options, 'shortcode_attributes', []);
    $min = Arr::get($options, 'min', 1);
    $max = Arr::get($options, 'max', 20);
    $tabKey = Arr::get($options, 'attr.tab_key');
    $wrapperAttributes = Arr::get($options, 'wrapper', []);
    $label = Arr::get($options, 'label');
    $required = Arr::get($options, 'required', false);
?>

<?php echo shortcode()->fields()->tabs($fields, $attributes, $max, $min, $tabKey, $wrapperAttributes, $label, $required); ?>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/packages/shortcode/resources/views/forms/fields/tabs.blade.php ENDPATH**/ ?>