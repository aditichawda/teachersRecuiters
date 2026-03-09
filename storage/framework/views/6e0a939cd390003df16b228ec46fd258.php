<?php
    if ($showLabel && empty($options['label'])) {
        $options['label'] = trans('core/base::forms.image');
    }
?>

<?php if (isset($component)) { $__componentOriginal5ee5f78769862fd20bf1abe3e4744d51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5ee5f78769862fd20bf1abe3e4744d51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.field','data' => ['showLabel' => $showLabel,'showField' => $showField,'options' => $options,'name' => $name,'prepend' => $prepend ?? null,'append' => $append ?? null,'showError' => $showError,'nameKey' => $nameKey]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['showLabel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($showLabel),'showField' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($showField),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($options),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'prepend' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prepend ?? null),'append' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($append ?? null),'showError' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($showError),'nameKey' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($nameKey)]); ?>
     <?php $__env->slot('label', null, []); ?> 
        <?php if($showLabel && $options['label'] !== false && $options['label_show']): ?>
            <?php echo Form::customLabel($name, $options['label'], $options['label_attr']); ?>

        <?php endif; ?>
     <?php $__env->endSlot(); ?>

<<<<<<< HEAD:storage/framework/views/0303a9ffd17f8422ebf0fd6f2363e678.php
<<<<<<< HEAD
<<<<<<<< HEAD:storage/framework/views/0303a9ffd17f8422ebf0fd6f2363e678.php
    <?php echo Form::datePicker($name, $options['value'], $options['attr']); ?>
========
    <?php echo Form::editor($name, \Illuminate\Support\Arr::get($options, 'value'), \Illuminate\Support\Arr::get($options, 'attr', [])); ?>
>>>>>>>> 689f01a2 (payment update):storage/framework/views/aea30219928aff8839c25c74bdfb6979.php
=======
    <?php echo Form::datePicker($name, $options['value'], $options['attr']); ?>
>>>>>>> 689f01a2 (payment update)
=======
    <?php echo Form::mediaImage($name, $options['value'] ?? null, $options); ?>
>>>>>>> 7f84a288 (9 march update):storage/framework/views/6e0a939cd390003df16b228ec46fd258.php

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5ee5f78769862fd20bf1abe3e4744d51)): ?>
<?php $attributes = $__attributesOriginal5ee5f78769862fd20bf1abe3e4744d51; ?>
<?php unset($__attributesOriginal5ee5f78769862fd20bf1abe3e4744d51); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5ee5f78769862fd20bf1abe3e4744d51)): ?>
<?php $component = $__componentOriginal5ee5f78769862fd20bf1abe3e4744d51; ?>
<?php unset($__componentOriginal5ee5f78769862fd20bf1abe3e4744d51); ?>
<?php endif; ?>
<<<<<<< HEAD:storage/framework/views/0303a9ffd17f8422ebf0fd6f2363e678.php
<<<<<<< HEAD
<<<<<<<< HEAD:storage/framework/views/0303a9ffd17f8422ebf0fd6f2363e678.php
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/fields/date-picker.blade.php ENDPATH**/ ?>

========
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/fields/editor.blade.php ENDPATH**/ ?>
>>>>>>>> 689f01a2 (payment update):storage/framework/views/aea30219928aff8839c25c74bdfb6979.php
=======
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/fields/date-picker.blade.php ENDPATH**/ ?>
>>>>>>> 689f01a2 (payment update)
=======
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/fields/media-image.blade.php ENDPATH**/ ?>
>>>>>>> 7f84a288 (9 march update):storage/framework/views/6e0a939cd390003df16b228ec46fd258.php
