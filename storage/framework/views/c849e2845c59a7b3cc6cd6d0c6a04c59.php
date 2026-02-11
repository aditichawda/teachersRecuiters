<?php $__env->startSection('content'); ?>
    <div
        data-upload-service-account-url="<?php echo e(route('api.upload-service-account')); ?>"
        data-remove-service-account-url="<?php echo e(route('api.remove-service-account')); ?>"
        data-send-notification-url="<?php echo e(route('api.send-notification')); ?>"
        data-device-tokens-stats-url="<?php echo e(route('api.device-tokens-stats')); ?>"
        id="api-settings-container"
    >
        <?php echo $form->renderForm(); ?>

    </div>

    <?php if(ApiHelper::enabled() && auth()->user()->hasPermission('api.sanctum-token.index')): ?>
        <div class="mt-5">
            <?php if (isset($component)) { $__componentOriginal0a39fdd16f40824788edeed4e460894f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a39fdd16f40824788edeed4e460894f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'cbdd3a194c072fbc3f04e785bd9366eb::section','data' => ['card' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core-setting::section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['card' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                <?php echo $sanctumTokenTable->renderTable(); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a39fdd16f40824788edeed4e460894f)): ?>
<?php $attributes = $__attributesOriginal0a39fdd16f40824788edeed4e460894f; ?>
<?php unset($__attributesOriginal0a39fdd16f40824788edeed4e460894f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a39fdd16f40824788edeed4e460894f)): ?>
<?php $component = $__componentOriginal0a39fdd16f40824788edeed4e460894f; ?>
<?php unset($__componentOriginal0a39fdd16f40824788edeed4e460894f); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer'); ?>
    <script>
        'use strict';

        window.trans = window.trans || {};
        window.trans.api = <?php echo json_encode($translations, JSON_HEX_APOS); ?>;
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(BaseHelper::getAdminMasterLayoutTemplate(), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\vendor\botble\api\src\Providers/../../resources/views/settings.blade.php ENDPATH**/ ?>