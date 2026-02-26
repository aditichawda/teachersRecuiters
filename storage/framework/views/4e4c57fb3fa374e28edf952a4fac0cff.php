<?php if(get_payment_setting('status', PAYSTACK_PAYMENT_METHOD_NAME) == 1): ?>
    <?php if (isset($component)) { $__componentOriginal69057bacd9705b1c669802ff37556f6e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69057bacd9705b1c669802ff37556f6e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'fa081de1c3ee47622336b4eeafa01705::payment-method','data' => ['name' => PAYSTACK_PAYMENT_METHOD_NAME,'paymentName' => 'Paystack','supportedCurrencies' => (new Botble\Paystack\Services\Gateways\PaystackPaymentService)->supportedCurrencyCodes()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('plugins-payment::payment-method'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(PAYSTACK_PAYMENT_METHOD_NAME),'paymentName' => 'Paystack','supportedCurrencies' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((new Botble\Paystack\Services\Gateways\PaystackPaymentService)->supportedCurrencyCodes())]); ?>
         <?php $__env->slot('currencyNotSupportedMessage', null, []); ?> 
            <p class="mt-1 mb-0">
                <?php echo e(trans('plugins/paystack::paystack.learn_more')); ?>:
                <?php echo e(Html::link('https://support.paystack.com/hc/en-us/articles/360009973779', attributes: ['target' => '_blank', 'rel' => 'nofollow'])); ?>.
            </p>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69057bacd9705b1c669802ff37556f6e)): ?>
<?php $attributes = $__attributesOriginal69057bacd9705b1c669802ff37556f6e; ?>
<?php unset($__attributesOriginal69057bacd9705b1c669802ff37556f6e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69057bacd9705b1c669802ff37556f6e)): ?>
<?php $component = $__componentOriginal69057bacd9705b1c669802ff37556f6e; ?>
<?php unset($__componentOriginal69057bacd9705b1c669802ff37556f6e); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\paystack\/resources/views/methods.blade.php ENDPATH**/ ?>