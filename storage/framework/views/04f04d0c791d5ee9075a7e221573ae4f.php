<<<<<<< HEAD:storage/framework/views/04f04d0c791d5ee9075a7e221573ae4f.php
<?php if (! $__env->hasRenderedOnce('b68336cb-b4a7-4166-8784-d784979a7e82')): $__env->markAsRenderedOnce('b68336cb-b4a7-4166-8784-d784979a7e82'); ?>
=======
<?php if (! $__env->hasRenderedOnce('d1b5e026-04c1-49d1-98cb-9e28ded7cea8')): $__env->markAsRenderedOnce('d1b5e026-04c1-49d1-98cb-9e28ded7cea8'); ?>
>>>>>>> main:storage/framework/views/5541c5922c65b1e76b63ded2f6c4d3b2.php
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
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/fronts/toast-notification.blade.php ENDPATH**/ ?>