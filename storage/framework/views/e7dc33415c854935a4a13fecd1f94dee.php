<input
    name="language"
    type="hidden"
    value="<?php echo e($currentLanguage?->lang_code); ?>"
>
<style>
    #list-others-language {
        max-height: 200px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f1f5f9;
    }
    
    #list-others-language::-webkit-scrollbar {
        width: 6px;
    }
    
    #list-others-language::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    #list-others-language::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    #list-others-language::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    #list-others-language .dropdown-item {
        padding: 10px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.2s ease;
    }
    
    #list-others-language .dropdown-item:hover {
        background: var(--bb-bg-surface-secondary, #f8f9fa);
        color: var(--bb-body-color, #212529);
    }
    
    #list-others-language .dropdown-item .flag {
        width: 20px;
        height: 15px;
        flex-shrink: 0;
    }
    
    #list-others-language .dropdown-item span {
        flex: 1;
        font-size: 14px;
    }
    
    #list-others-language .dropdown-item .ms-auto {
        margin-left: auto;
        opacity: 0.6;
        font-size: 14px;
    }
</style>
<?php if (isset($component)) { $__componentOriginalf8303636a16ac3e808e27fabe59149a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8303636a16ac3e808e27fabe59149a5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::dropdown.index','data' => ['label' => 'Languages','wrapperClass' => 'w-100']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Languages','wrapper-class' => 'w-100']); ?>
<div id="list-others-language">
    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$currentLanguage || $language->lang_code === $currentLanguage->lang_code) continue; ?>
            <?php if (isset($component)) { $__componentOriginal7681c9e8cd9d4250104639dd6412633f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7681c9e8cd9d4250104639dd6412633f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::dropdown.item','data' => ['href' => Route::has($route['edit']) ? Request::url() . ($language->lang_code != Language::getDefaultLocaleCode() ? '?' . Language::refLangKey() . '=' . $language->lang_code : null) : '#','target' => '_blank']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::dropdown.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Route::has($route['edit']) ? Request::url() . ($language->lang_code != Language::getDefaultLocaleCode() ? '?' . Language::refLangKey() . '=' . $language->lang_code : null) : '#'),'target' => '_blank']); ?>
                <?php echo language_flag($language->lang_flag, $language->lang_name, 20); ?>

                <span><?php echo e($language->lang_name); ?></span>
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ms-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7681c9e8cd9d4250104639dd6412633f)): ?>
<?php $attributes = $__attributesOriginal7681c9e8cd9d4250104639dd6412633f; ?>
<?php unset($__attributesOriginal7681c9e8cd9d4250104639dd6412633f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7681c9e8cd9d4250104639dd6412633f)): ?>
<?php $component = $__componentOriginal7681c9e8cd9d4250104639dd6412633f; ?>
<?php unset($__componentOriginal7681c9e8cd9d4250104639dd6412633f); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8303636a16ac3e808e27fabe59149a5)): ?>
<?php $attributes = $__attributesOriginalf8303636a16ac3e808e27fabe59149a5; ?>
<?php unset($__attributesOriginalf8303636a16ac3e808e27fabe59149a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8303636a16ac3e808e27fabe59149a5)): ?>
<?php $component = $__componentOriginalf8303636a16ac3e808e27fabe59149a5; ?>
<?php unset($__componentOriginalf8303636a16ac3e808e27fabe59149a5); ?>
<?php endif; ?>

<?php $__env->startPush('header'); ?>
    <meta
        name="<?php echo e(Language::refFromKey()); ?>"
        content="<?php echo e(!empty($args[0]) && $args[0]->id ? $args[0]->id : 0); ?>"
    >
    <meta
        name="<?php echo e(Language::refLangKey()); ?>"
        content="<?php echo e($currentLanguage?->lang_code); ?>"
    >
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\language-advanced\/resources/views/language-box.blade.php ENDPATH**/ ?>