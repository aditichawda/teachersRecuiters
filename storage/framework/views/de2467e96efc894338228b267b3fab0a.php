<?php if($payment): ?>
    <br>
    <p><?php echo e(trans('plugins/payment::payment.amount')); ?>: <?php echo e($payment->amount / 100); ?> <?php echo e($payment->currency); ?></p>
    <p><?php echo e(trans('plugins/payment::payment.email')); ?>: <?php echo e($payment->email); ?></p>
    <p><?php echo e(trans('plugins/payment::payment.phone')); ?>: <?php echo e($payment->contact); ?></p>
    <hr>

    <?php if($payment->amount_refunded): ?>
        <h6 class="alert-heading"><?php echo e(trans('plugins/payment::payment.amount_refunded')); ?>:
            <?php echo e($payment->amount_refunded / 100); ?> <?php echo e($payment->currency); ?>

        </h6>
    <?php endif; ?>

    <?php if($refunds = Arr::get($paymentModel->metadata, 'refunds', [])): ?>
        <?php $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="<?php echo e(Arr::get($refund, 'data.id')); ?>">
                <?php echo $__env->make('plugins/razorpay::refund-detail', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php echo $__env->make('plugins/payment::partials.view-payment-source', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\razorpay\/resources/views/detail.blade.php ENDPATH**/ ?>