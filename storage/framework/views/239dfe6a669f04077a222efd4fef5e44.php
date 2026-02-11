<?php if (! $__env->hasRenderedOnce('f4e30545-39c6-42ad-92ff-979e68356879')): $__env->markAsRenderedOnce('f4e30545-39c6-42ad-92ff-979e68356879'); ?>
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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/notification/notification.blade.php ENDPATH**/ ?>