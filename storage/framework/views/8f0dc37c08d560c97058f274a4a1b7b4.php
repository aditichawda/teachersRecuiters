<div class="row">
    <div class="col-lg-12">
        <?php if (isset($component)) { $__componentOriginal30bfea974493fd8d236b3a0412570dd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30bfea974493fd8d236b3a0412570dd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'cbdd3a194c072fbc3f04e785bd9366eb::form-group','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core-setting::form-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php if (isset($component)) { $__componentOriginal50e5e771b30c35423d2b4f118feb7c0c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.label','data' => ['for' => 'media_folders_can_add_watermark','label' => trans('core/setting::setting.media.media_folders_can_add_watermark')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'media_folders_can_add_watermark','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/setting::setting.media.media_folders_can_add_watermark'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c)): ?>
<?php $attributes = $__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c; ?>
<?php unset($__attributesOriginal50e5e771b30c35423d2b4f118feb7c0c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal50e5e771b30c35423d2b4f118feb7c0c)): ?>
<?php $component = $__componentOriginal50e5e771b30c35423d2b4f118feb7c0c; ?>
<?php unset($__componentOriginal50e5e771b30c35423d2b4f118feb7c0c); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal20d878510d8f6b63da7004efc7cea55f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20d878510d8f6b63da7004efc7cea55f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.fieldset','data' => ['class' => 'mt-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.fieldset'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-3']); ?>
                <div class="multi-check-list-wrapper">
                    <?php if (isset($component)) { $__componentOriginal30bfea974493fd8d236b3a0412570dd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30bfea974493fd8d236b3a0412570dd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'cbdd3a194c072fbc3f04e785bd9366eb::form-group','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core-setting::form-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php if (isset($component)) { $__componentOriginal424617256517489644ca6a2e02d16322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal424617256517489644ca6a2e02d16322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.checkbox','data' => ['label' => trans('core/setting::setting.media.all'),'class' => 'check-all','dataSet' => '.media-folder','name' => 'media_folders_can_add_watermark_all','checked' => empty($folderIds) || count($folderIds) === count($folders)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans('core/setting::setting.media.all')),'class' => 'check-all','data-set' => '.media-folder','name' => 'media_folders_can_add_watermark_all','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(empty($folderIds) || count($folderIds) === count($folders))]); ?>
                             <?php $__env->slot('helperText', null, []); ?> 
                                <?php echo e(trans('core/setting::setting.media.all_helper_text')); ?>

                             <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal424617256517489644ca6a2e02d16322)): ?>
<?php $attributes = $__attributesOriginal424617256517489644ca6a2e02d16322; ?>
<?php unset($__attributesOriginal424617256517489644ca6a2e02d16322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal424617256517489644ca6a2e02d16322)): ?>
<?php $component = $__componentOriginal424617256517489644ca6a2e02d16322; ?>
<?php unset($__componentOriginal424617256517489644ca6a2e02d16322); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $attributes = $__attributesOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $component = $__componentOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__componentOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>

                    <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal30bfea974493fd8d236b3a0412570dd4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30bfea974493fd8d236b3a0412570dd4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'cbdd3a194c072fbc3f04e785bd9366eb::form-group','data' => ['class' => \Illuminate\Support\Arr::toCssClasses(['mb-n3' => $loop->last])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core-setting::form-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['mb-n3' => $loop->last]))]); ?>
                            <?php if (isset($component)) { $__componentOriginal424617256517489644ca6a2e02d16322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal424617256517489644ca6a2e02d16322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.checkbox','data' => ['label' => $item,'class' => 'media-folder','name' => 'media_folders_can_add_watermark[]','value' => ''.e($key).'','id' => 'media-folder-item-'.e($key).'','checked' => empty($folderIds) || in_array($key, $folderIds)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item),'class' => 'media-folder','name' => 'media_folders_can_add_watermark[]','value' => ''.e($key).'','id' => 'media-folder-item-'.e($key).'','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(empty($folderIds) || in_array($key, $folderIds))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal424617256517489644ca6a2e02d16322)): ?>
<?php $attributes = $__attributesOriginal424617256517489644ca6a2e02d16322; ?>
<?php unset($__attributesOriginal424617256517489644ca6a2e02d16322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal424617256517489644ca6a2e02d16322)): ?>
<?php $component = $__componentOriginal424617256517489644ca6a2e02d16322; ?>
<?php unset($__componentOriginal424617256517489644ca6a2e02d16322); ?>
<?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $attributes = $__attributesOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $component = $__componentOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__componentOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20d878510d8f6b63da7004efc7cea55f)): ?>
<?php $attributes = $__attributesOriginal20d878510d8f6b63da7004efc7cea55f; ?>
<?php unset($__attributesOriginal20d878510d8f6b63da7004efc7cea55f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20d878510d8f6b63da7004efc7cea55f)): ?>
<?php $component = $__componentOriginal20d878510d8f6b63da7004efc7cea55f; ?>
<?php unset($__componentOriginal20d878510d8f6b63da7004efc7cea55f); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $attributes = $__attributesOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__attributesOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30bfea974493fd8d236b3a0412570dd4)): ?>
<?php $component = $__componentOriginal30bfea974493fd8d236b3a0412570dd4; ?>
<?php unset($__componentOriginal30bfea974493fd8d236b3a0412570dd4); ?>
<?php endif; ?>

    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/setting/resources/views/partials/media/media-folders-can-add-watermark-field.blade.php ENDPATH**/ ?>