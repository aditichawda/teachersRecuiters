<?php if (isset($component)) { $__componentOriginalbebf22e2ca96656cef629606ef6bb458 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbebf22e2ca96656cef629606ef6bb458 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::copy','data' => ['copyableState' => $copyableState,'copyableAction' => $copyableAction,'copyableMessage' => $copyableMessage,'copyablePositionClass' => $copyablePositionClass]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::copy'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['copyableState' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($copyableState),'copyableAction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($copyableAction),'copyableMessage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($copyableMessage),'copyablePositionClass' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($copyablePositionClass)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbebf22e2ca96656cef629606ef6bb458)): ?>
<?php $attributes = $__attributesOriginalbebf22e2ca96656cef629606ef6bb458; ?>
<?php unset($__attributesOriginalbebf22e2ca96656cef629606ef6bb458); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbebf22e2ca96656cef629606ef6bb458)): ?>
<?php $component = $__componentOriginalbebf22e2ca96656cef629606ef6bb458; ?>
<?php unset($__componentOriginalbebf22e2ca96656cef629606ef6bb458); ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/table/resources/views/cells/copyable.blade.php ENDPATH**/ ?>