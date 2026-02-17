<input
    name="language"
    type="hidden"
    value="<?php echo e($currentLanguage?->lang_code); ?>"
>
<div id="list-others-language">
    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!$currentLanguage || $language->lang_code === $currentLanguage->lang_code) continue; ?>
        <a
            class="gap-2 d-flex align-items-center text-decoration-none"
            href="<?php echo e(Route::has($route['edit']) ? Request::url() . ($language->lang_code != Language::getDefaultLocaleCode() ? '?' . Language::refLangKey() . '=' . $language->lang_code : null) : '#'); ?>"
            target="_blank"
        >
            <?php echo language_flag($language->lang_flag, $language->lang_name); ?>

            <span><?php echo e($language->lang_name); ?> <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-external-link'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?></span>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/language-advanced/resources/views/language-box.blade.php ENDPATH**/ ?>