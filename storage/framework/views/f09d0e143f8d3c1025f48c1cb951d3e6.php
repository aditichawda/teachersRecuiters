<div class="mt-4 send-notification-section">
    <h6 class="mb-3"><?php echo e(trans('packages/api::api.send_custom_notification')); ?></h6>

    <div class="card border-0 bg-white">
        <div class="card-body">
            <div id="send-notification-form">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="notification-title" class="form-label">
                                <?php echo e(trans('packages/api::api.notification_title')); ?>

                                <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="notification-title"
                                name="title"
                                placeholder="<?php echo e(trans('packages/api::api.notification_title_placeholder')); ?>"
                                required
                                maxlength="100"
                            >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="notification-target" class="form-label">
                                <?php echo e(trans('packages/api::api.notification_target')); ?>

                            </label>
                            <select class="form-select" id="notification-target" name="target">
                                <option value="all"><?php echo e(trans('packages/api::api.all_devices')); ?></option>
                                <option value="android"><?php echo e(trans('packages/api::api.android_devices')); ?></option>
                                <option value="ios"><?php echo e(trans('packages/api::api.ios_devices')); ?></option>
                                <option value="customers"><?php echo e(trans('packages/api::api.customer_devices')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="notification-message" class="form-label">
                        <?php echo e(trans('packages/api::api.notification_message')); ?>

                        <span class="text-danger">*</span>
                    </label>
                    <textarea
                        class="form-control"
                        id="notification-message"
                        name="message"
                        rows="3"
                        placeholder="<?php echo e(trans('packages/api::api.notification_message_placeholder')); ?>"
                        required
                        maxlength="500"
                    ></textarea>
                    <div class="form-text">
                        <?php echo e(trans('packages/api::api.notification_message_help')); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="notification-action-url" class="form-label">
                                <?php echo e(trans('packages/api::api.notification_action_url')); ?>

                            </label>
                            <input
                                type="url"
                                class="form-control"
                                id="notification-action-url"
                                name="action_url"
                                placeholder="<?php echo e(trans('packages/api::api.notification_action_url_placeholder')); ?>"
                            >
                            <div class="form-text">
                                <?php echo e(trans('packages/api::api.notification_action_url_help')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="notification-image-url" class="form-label">
                                <?php echo e(trans('packages/api::api.notification_image_url')); ?>

                            </label>
                            <input
                                type="url"
                                class="form-control"
                                id="notification-image-url"
                                name="image_url"
                                placeholder="<?php echo e(trans('packages/api::api.notification_image_url_placeholder')); ?>"
                            >
                            <div class="form-text">
                                <?php echo e(trans('packages/api::api.notification_image_url_help')); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <small id="notification-send-info">
                            <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-info-circle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-1']); ?>
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
                            <?php echo e(trans('packages/api::api.notification_send_info')); ?>

                        </small>
                    </div>
                    <button type="button" class="btn btn-primary" id="send-notification-btn">
                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => 'ti ti-send'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'me-1']); ?>
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
                        <span><?php echo e(trans('packages/api::api.send_notification')); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="notification-result" class="mt-3" style="display: none;"></div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\vendor\botble\api\src\Providers/../../resources/views/settings/partials/send-notification-form.blade.php ENDPATH**/ ?>