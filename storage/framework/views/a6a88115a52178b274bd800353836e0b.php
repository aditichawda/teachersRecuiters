<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::alert','data' => ['type' => 'warning']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'warning']); ?>
        <p class="mb-0">
            <?php echo e(trans('plugins/translation::translation.theme_translations_instruction')); ?>

        </p>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c)): ?>
<?php $attributes = $__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c; ?>
<?php unset($__attributesOriginalecda78b9fe8916cbd83b85e55a8b7a1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c)): ?>
<?php $component = $__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c; ?>
<?php unset($__componentOriginalecda78b9fe8916cbd83b85e55a8b7a1c); ?>
<?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <?php if($locale['locale'] !== 'en'): ?>
                <p><?php echo e(trans('plugins/translation::translation.translate_from')); ?>

                    <strong class="text-info"><?php echo e($defaultLanguage ? $defaultLanguage['name'] : 'en'); ?></strong>
                    <?php echo e(trans('plugins/translation::translation.to')); ?>

                    <strong class="text-info"><?php echo e($locale['name']); ?></strong>
                </p>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="text-end">
                <?php echo $__env->make('plugins/translation::partials.list-theme-languages-to-translate', [
                    'groups' => $locales,
                    'group' => $locale,
                    'route' => 'translations.index',
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>

    <div class="translations-table">
        <?php echo e($translationTable->renderTable()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\translation\/resources/views/index.blade.php ENDPATH**/ ?>