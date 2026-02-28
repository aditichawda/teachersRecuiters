<div class="swatches-container">
    <div class="header">
        <div class="swatch-item">
            <?php echo e(trans('plugins/job-board::settings.currency.code')); ?>

        </div>
        <div class="swatch-item">
            <?php echo e(trans('plugins/job-board::settings.currency.symbol')); ?>

        </div>
        <div class="swatch-item swatch-exchange-rate">
            <?php echo e(trans('plugins/job-board::settings.currency.exchange_rate')); ?>

        </div>
        <div class="swatch-is-default">
            <?php echo e(trans('plugins/job-board::settings.currency.is_default')); ?>

        </div>
        <div class="swatch-advanced">
            <?php echo e(trans('plugins/job-board::settings.currency.advanced')); ?>

        </div>
        <div class="remove-item"><?php echo e(trans('plugins/job-board::settings.currency.remove')); ?></div>
    </div>

    <ul class="swatches-list"></ul>

    <div class="d-flex justify-content-between w-100 align-items-center">
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
            <?php echo e(trans('plugins/job-board::settings.currency.instruction')); ?>

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

        <a class="js-add-new-attribute" href="javascript:void(0)">
            <?php echo e(trans('plugins/job-board::settings.currency.new_currency')); ?>

        </a>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/settings/partials/currency-table.blade.php ENDPATH**/ ?>