<?php echo $__env->make('plugins/payment::partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="checkout-wrapper">
    <div>
        <?php if (isset($component)) { $__componentOriginald83dae5750a07af1a413e54a0071b325 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald83dae5750a07af1a413e54a0071b325 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::form.index','data' => ['url' => $action,'class' => 'payment-checkout-form','method' => 'post']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action),'class' => 'payment-checkout-form','method' => 'post']); ?>
            <input name="name" type="hidden" value="<?php echo e($name); ?>">
            <input name="amount" type="hidden" value="<?php echo e($amount); ?>">
            <input name="currency" type="hidden" value="<?php echo e($currency); ?>">
            <?php if(isset($returnUrl)): ?>
                <input name="return_url" type="hidden" value="<?php echo e($returnUrl); ?>">
            <?php endif; ?>
            <?php if(isset($callbackUrl)): ?>
                <input name="callback_url" type="hidden" value="<?php echo e($callbackUrl); ?>">
            <?php endif; ?>

            <?php echo apply_filters(PAYMENT_FILTER_PAYMENT_PARAMETERS, null); ?>


            <?php echo $__env->make('plugins/payment::partials.payment-methods', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php echo apply_filters(PAYMENT_FILTER_AFTER_PAYMENT_METHOD, null); ?>


            <?php if (isset($component)) { $__componentOriginal922f7d3260a518f4cf606eecf9669dcb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => '8def1252668913628243c4d363bee1ef::button','data' => ['class' => 'payment-checkout-btn','color' => 'primary w-100','dataProcessingText' => ''.e(trans('plugins/payment::payment.processing_please_wait')).'','dataErrorHeader' => ''.e(trans('plugins/payment::payment.error')).'','icon' => 'ti ti-credit-card']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'payment-checkout-btn','color' => 'primary w-100','data-processing-text' => ''.e(trans('plugins/payment::payment.processing_please_wait')).'','data-error-header' => ''.e(trans('plugins/payment::payment.error')).'','icon' => 'ti ti-credit-card']); ?>
                <?php echo e(trans('plugins/payment::payment.checkout')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $attributes = $__attributesOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__attributesOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb)): ?>
<?php $component = $__componentOriginal922f7d3260a518f4cf606eecf9669dcb; ?>
<?php unset($__componentOriginal922f7d3260a518f4cf606eecf9669dcb); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald83dae5750a07af1a413e54a0071b325)): ?>
<?php $attributes = $__attributesOriginald83dae5750a07af1a413e54a0071b325; ?>
<?php unset($__attributesOriginald83dae5750a07af1a413e54a0071b325); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald83dae5750a07af1a413e54a0071b325)): ?>
<?php $component = $__componentOriginald83dae5750a07af1a413e54a0071b325; ?>
<?php unset($__componentOriginald83dae5750a07af1a413e54a0071b325); ?>
<?php endif; ?>
    </div>
</div>

<?php echo $__env->make('plugins/payment::partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/payment/resources/views/partials/form.blade.php ENDPATH**/ ?>