<<<<<<<< HEAD:storage/framework/views/b92b95fe3f66f04fadc09aa568fdb508.php
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'label' => null,
    'name' => null,
    'choices' => [],
    'selected' => null,
    'wrapperClass' => null,
    'helperText' => null,
    'required' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id' => null,
    'label' => null,
    'name' => null,
    'choices' => [],
    'selected' => null,
    'wrapperClass' => null,
    'helperText' => null,
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $id ??= $name ?? Str::random(8);
========
<?php
    if ($field['type'] === 'select') {
        $field['type'] = 'customSelect';
    }

    $hiddenField = Form::hidden($name . '[' . $index . '][' . $key . '][key]', $field['attributes']['name']);
    $field['attributes']['name'] = $name . '[' . $index . '][' . $key . '][value]';
    $field['attributes']['value'] = Arr::get($values, $index . '.' . $key . '.value');
    $field['attributes']['options']['id'] = $id = 'repeater_field_' . md5($field['attributes']['name']) . uniqid('_');
    $field['attributes']['id'] = $id;
    $field['attributes']['label_attr']['for'] = $id;
>>>>>>>> d8be432e (himanshi 19 20 21 23 feb updates 1):storage/framework/views/ff2146198ea69cf21633af80f715469c.php
?>

<?php if (isset($component)) { $__componentOriginala0a922bb70d8e2bee74cdab0a323562a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala0a922bb70d8e2bee74cdab0a323562a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form-group','data' => ['class' => $wrapperClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<<<<<<<< HEAD:storage/framework/views/b92b95fe3f66f04fadc09aa568fdb508.php
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wrapperClass)]); ?>
    <?php if($label): ?>
        <?php if (isset($component)) { $__componentOriginal50e5e771b30c35423d2b4f118feb7c0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.label','data' => ['label' => $label,'for' => $id,'class' => \Illuminate\Support\Arr::toCssClasses(['required' => $required])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
========
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginal50e5e771b30c35423d2b4f118feb7c0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.label','data' => ['attributes' => new Illuminate\View\ComponentAttributeBag(Arr::get($field, 'label_attr', []))]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
>>>>>>>> d8be432e (himanshi 19 20 21 23 feb updates 1):storage/framework/views/ff2146198ea69cf21633af80f715469c.php
<?php $component->withName('core::form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<<<<<<<< HEAD:storage/framework/views/b92b95fe3f66f04fadc09aa568fdb508.php
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($id),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['required' => $required]))]); ?>
<?php echo $__env->renderComponent(); ?>
========
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(new Illuminate\View\ComponentAttributeBag(Arr::get($field, 'label_attr', [])))]); ?>
        <?php echo e($field['label']); ?>

     <?php echo $__env->renderComponent(); ?>
>>>>>>>> d8be432e (himanshi 19 20 21 23 feb updates 1):storage/framework/views/ff2146198ea69cf21633af80f715469c.php
<?php endif; ?>
<?php if (isset($__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c)): ?>
<?php $attributes = $__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c; ?>
<?php unset($__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal50e5e771b30c35423d2b4f118feb7c0c)): ?>
<?php $component = $__componentOriginal50e5e771b30c35423d2b4f118feb7c0c; ?>
<?php unset($__componentOriginal50e5e771b30c35423d2b4f118feb7c0c); ?>
<?php endif; ?>

<<<<<<<< HEAD:storage/framework/views/b92b95fe3f66f04fadc09aa568fdb508.php
    <div class="row g-2">
        <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-auto">
                <label class="form-colorinput form-colorinput-light">
                    <?php
                        $checkboxValue = is_string($key) && strlen($key) > 1 ? $key : $item;
                    ?>
                    <input
                        name="<?php echo e($name); ?>"
                        type="radio"
                        value="<?php echo e($checkboxValue); ?>"
                        class="form-colorinput-input"
                        <?php if($checkboxValue == $selected): echo 'checked'; endif; ?>
                    >
                    <span
                        class="form-colorinput-color"
                        style="background-color:<?php echo e($item); ?>;"
                    ></span>
                </label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
========
    <?php echo e($hiddenField); ?>
>>>>>>>> d8be432e (himanshi 19 20 21 23 feb updates 1):storage/framework/views/ff2146198ea69cf21633af80f715469c.php


    <?php echo call_user_func_array([Form::class, $field['type']], array_values($field['attributes'])); ?>


    <?php if(!empty($field['helper'])): ?>
        <?php if (isset($component)) { $__componentOriginal1844d57dc6206b688bd5adc7dea47e7d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1844d57dc6206b688bd5adc7dea47e7d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.helper-text','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.helper-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php echo BaseHelper::clean($field['helper']); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1844d57dc6206b688bd5adc7dea47e7d)): ?>
<?php $attributes = $__attributesOriginal1844d57dc6206b688bd5adc7dea47e7d; ?>
<?php unset($__attributesOriginal1844d57dc6206b688bd5adc7dea47e7d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1844d57dc6206b688bd5adc7dea47e7d)): ?>
<?php $component = $__componentOriginal1844d57dc6206b688bd5adc7dea47e7d; ?>
<?php unset($__componentOriginal1844d57dc6206b688bd5adc7dea47e7d); ?>
<?php endif; ?>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala0a922bb70d8e2bee74cdab0a323562a)): ?>
<?php $attributes = $__attributesOriginala0a922bb70d8e2bee74cdab0a323562a; ?>
<?php unset($__attributesOriginala0a922bb70d8e2bee74cdab0a323562a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala0a922bb70d8e2bee74cdab0a323562a)): ?>
<?php $component = $__componentOriginala0a922bb70d8e2bee74cdab0a323562a; ?>
<?php unset($__componentOriginala0a922bb70d8e2bee74cdab0a323562a); ?>
<?php endif; ?>
<<<<<<<< HEAD:storage/framework/views/b92b95fe3f66f04fadc09aa568fdb508.php
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/components/form/color-selector.blade.php ENDPATH**/ ?>
========
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/forms/partials/repeater-item.blade.php ENDPATH**/ ?>
>>>>>>>> d8be432e (himanshi 19 20 21 23 feb updates 1):storage/framework/views/ff2146198ea69cf21633af80f715469c.php
