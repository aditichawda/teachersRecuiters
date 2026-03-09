<?php
    $options['attr']['label'] = $options['label'];
    $options['attr']['label_attr'] = Arr::get($options, 'label_attr');
    $isShowLabel = $showLabel && $options['label'] && $options['label_show'];

    if (!$isShowLabel) {
        unset($options['attr']['label']);
    }

    $options['label'] = false;
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
<<<<<<< HEAD:storage/framework/views/61302a0aaaadeb9812227760bbf7b2b2.php
     <?php $__env->slot('label', null, []); ?> 
        <?php if($showLabel && $options['label'] !== false && $options['label_show']): ?>
            <?php echo Form::customLabel($name, $options['label'], $options['label_attr']); ?>

        <?php endif; ?>
     <?php $__env->endSlot(); ?>

<<<<<<< HEAD
<<<<<<< HEAD
    <?php echo Form::repeater($name, $options['value'] ?? Arr::get($options, 'selected'), Arr::get($options, 'fields', [])); ?>
=======
    <?php echo Form::repeater($name, $options['value'] ?: Arr::get($options, 'selected'), $options['fields'] ?: []); ?>
>>>>>>> 689f01a2 (payment update)
=======
    <?php echo Form::repeater($name, $options['value'] ?? Arr::get($options, 'selected'), Arr::get($options, 'fields', [])); ?>
>>>>>>> 62ab1307 (3 feb update)
=======
    <?php echo Form::onOffCheckbox($name, $options['value'], $options['attr']); ?>
>>>>>>> 7f84a288 (9 march update):storage/framework/views/33db65ad56d3da596a15d0e48cffd466.php

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
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/forms/fields/on-off-checkbox.blade.php ENDPATH**/ ?>