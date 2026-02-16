<?php
    if (BaseHelper::hasIcon($value)) {
        $icon = BaseHelper::renderIcon($value);
    } else {
        $icon = '<i class="' . $value . '"></i>';
    }
?>

<select
    name="<?php echo e($name); ?>"
    data-bb-core-icon
    data-url="<?php echo e(route('core-icons')); ?>"
    data-placeholder="<?php echo e($attributes['placeholder'] ?? ($attributes['data-placeholder'] ?? trans('core/base::forms.select_placeholder'))); ?>"
    <?php echo Html::attributes($attributes); ?>

>
    <?php if($value): ?>
        <option
            value="<?php echo e($value); ?>"
            selected
        ><?php echo e($icon); ?></option>
    <?php endif; ?>
</select>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/partials/core-icon.blade.php ENDPATH**/ ?>