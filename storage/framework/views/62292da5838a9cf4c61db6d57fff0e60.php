<?php if (! $__env->hasRenderedOnce('62ad3658-7e43-48d2-b4df-1f783b3c3f78')): $__env->markAsRenderedOnce('62ad3658-7e43-48d2-b4df-1f783b3c3f78'); ?>
    <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="notification-sidebar"
        aria-labelledby="notification-sidebar-label"
        data-url="<?php echo e(route('notifications.index')); ?>"
        data-count-url="<?php echo e(route('notifications.count-unread')); ?>"
    >
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>

        <div class="notification-content"></div>
    </div>

    <script src="<?php echo e(asset('vendor/core/core/base/js/notification.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\core\base\/resources/views/notification/notification.blade.php ENDPATH**/ ?>