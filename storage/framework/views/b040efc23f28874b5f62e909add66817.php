<form action="<?php echo e($action); ?>" method="post">
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_array($value)): ?>
            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valueKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="<?php echo e($key); ?>[<?php echo e($valueKey); ?>]" value="<?php echo e($item); ?>"/>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>"/>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <button type="submit" style="display: none"><?php echo e(trans('plugins/razorpay::razorpay.submit')); ?></button>
</form>

<p><?php echo e(trans('plugins/razorpay::razorpay.redirecting')); ?></p>

<script>
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('form').submit();
    });
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/razorpay/resources/views/form.blade.php ENDPATH**/ ?>