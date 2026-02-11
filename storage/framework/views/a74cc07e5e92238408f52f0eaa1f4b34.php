<div class="mt-3">
    <div class="card border-0 bg-white">
        <div class="card-body">
            <h6 class="mb-3">
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-info-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-2']); ?>
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
                <?php echo e(trans('packages/api::api.fcm_setup_title')); ?>

            </h6>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary"><?php echo e(trans('packages/api::api.fcm_step_1_title')); ?></h6>
                    <ul class="small mb-3">
                        <li><?php echo e(trans('packages/api::api.fcm_step_1_1')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_1_2')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_1_3')); ?></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary"><?php echo e(trans('packages/api::api.fcm_step_2_title')); ?></h6>
                    <ul class="small mb-3">
                        <li><?php echo e(trans('packages/api::api.fcm_step_2_1')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_2_2')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_2_3')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_2_4')); ?></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary"><?php echo e(trans('packages/api::api.fcm_step_3_title')); ?></h6>
                    <ul class="small mb-3">
                        <li><?php echo e(trans('packages/api::api.fcm_step_3_1')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_3_2')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_3_3')); ?></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary"><?php echo e(trans('packages/api::api.fcm_step_4_title')); ?></h6>
                    <ul class="small mb-3">
                        <li><?php echo e(trans('packages/api::api.fcm_step_4_1')); ?></li>
                        <li><?php echo e(trans('packages/api::api.fcm_step_4_2')); ?></li>
                    </ul>
                </div>
            </div>

            <div class="alert alert-info mb-0">
                <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-bulb'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-2']); ?>
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
                <p class="mb-0">
                    <strong><?php echo e(trans('packages/api::api.fcm_security_note_title')); ?></strong>
                    <?php echo e(trans('packages/api::api.fcm_security_note')); ?>

                </p>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\vendor\botble\api\src\Providers/../../resources/views/settings/partials/fcm-setup-instructions.blade.php ENDPATH**/ ?>