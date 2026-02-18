<?php $__env->startSection('content'); ?>
    <?php echo $form->renderForm(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
    <?php if (isset($component)) { $__componentOriginal9376784f974ff66f3ff18195ab0a89c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9376784f974ff66f3ff18195ab0a89c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::modal.action','data' => ['id' => 'generate-thumbnails-modal','title' => trans('core/setting::setting.generate_thumbnails'),'description' => trans('core/setting::setting.generate_thumbnails_description'),'type' => 'warning','submitButtonLabel' => trans('core/setting::setting.generate'),'submitButtonAttrs' => ['id' => 'generate-thumbnails-button'],'hasForm' => true,'formAction' => route('settings.media.generate-thumbnails'),'dataTotalFiles' => 0,'dataChunkLimit' => RvMedia::getConfig('generate_thumbnails_chunk_limit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::modal.action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'generate-thumbnails-modal','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/setting::setting.generate_thumbnails')),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/setting::setting.generate_thumbnails_description')),'type' => 'warning','submit-button-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/setting::setting.generate')),'submit-button-attrs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['id' => 'generate-thumbnails-button']),'has-form' => true,'form-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('settings.media.generate-thumbnails')),'data-total-files' => 0,'data-chunk-limit' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(RvMedia::getConfig('generate_thumbnails_chunk_limit'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9376784f974ff66f3ff18195ab0a89c5)): ?>
<?php $attributes = $__attributesOriginal9376784f974ff66f3ff18195ab0a89c5; ?>
<?php unset($__attributesOriginal9376784f974ff66f3ff18195ab0a89c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9376784f974ff66f3ff18195ab0a89c5)): ?>
<?php $component = $__componentOriginal9376784f974ff66f3ff18195ab0a89c5; ?>
<?php unset($__componentOriginal9376784f974ff66f3ff18195ab0a89c5); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/setting/resources/views/media.blade.php ENDPATH**/ ?>