<<<<<<< HEAD:storage/framework/views/04f04d0c791d5ee9075a7e221573ae4f.php
<?php if (! $__env->hasRenderedOnce('4d7dfcff-891b-4b11-9c37-ceec396ee32c')): $__env->markAsRenderedOnce('4d7dfcff-891b-4b11-9c37-ceec396ee32c'); ?>
=======
<?php if (! $__env->hasRenderedOnce('76fbd958-2ac9-4f76-ad37-e25aaf37ed85')): $__env->markAsRenderedOnce('76fbd958-2ac9-4f76-ad37-e25aaf37ed85'); ?>
>>>>>>> 810cf0467926987b37ae45c63e2ce44bee46c8b4:storage/framework/views/5541c5922c65b1e76b63ded2f6c4d3b2.php
    <script src="<?php echo e(asset('vendor/core/packages/theme/js/toast.js')); ?>?v=<?php echo e(get_cms_version()); ?>"></script>

    <?php if(session()->has('success_msg') ||
            session()->has('error_msg') ||
            (isset($errors) && $errors->count() > 0) ||
            isset($error_msg)): ?>
        <script type="text/javascript">
            window.addEventListener('load', function() {
                <?php if(session()->has('success_msg')): ?>
                Theme.showSuccess('<?php echo BaseHelper::cleanToastMessage(session('success_msg')); ?>');
                <?php endif; ?>

                <?php if(session()->has('error_msg')): ?>
                Theme.showError('<?php echo BaseHelper::cleanToastMessage(session('error_msg')); ?>');
                <?php endif; ?>

                <?php if(isset($error_msg)): ?>
                Theme.showError('<?php echo BaseHelper::cleanToastMessage($error_msg); ?>');
                <?php endif; ?>

                <?php if(isset($errors)): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                Theme.showError('<?php echo BaseHelper::cleanToastMessage($error); ?>');
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/packages/theme/resources/views/fronts/toast-notification.blade.php ENDPATH**/ ?>