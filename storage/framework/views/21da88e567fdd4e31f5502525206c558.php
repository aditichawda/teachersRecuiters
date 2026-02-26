<div class="alert alert-warning mb-3 d-block">
    <p class="mb-1"><strong><?php echo e(trans('plugins/razorpay::razorpay.webhook_required')); ?></strong></p>
    <p class="mb-0"><?php echo e(trans('plugins/razorpay::razorpay.webhook_required_desc')); ?></p>
</div>

<ol>
    <li>
        <p>
            <a
                href="https://razorpay.com"
                target="_blank"
            >
                <?php echo e(trans('plugins/razorpay::razorpay.register_account', ['name' => 'Razorpay'])); ?>

            </a>
        </p>
    </li>
    <li>
        <p>
            <?php echo e(trans('plugins/razorpay::razorpay.after_registration', ['name' => 'Razorpay'])); ?>

        </p>
    </li>
    <li>
        <p>
            <?php echo e(trans('plugins/razorpay::razorpay.enter_keys')); ?>

        </p>
    </li>
    <li>
        <p>
            <strong class="text-danger"><?php echo e(trans('plugins/razorpay::razorpay.critical_step')); ?></strong>
            <?php echo BaseHelper::clean(trans('plugins/razorpay::razorpay.webhook_instruction')); ?>

        </p>

        <p class="mt-2"><?php echo e(trans('plugins/razorpay::razorpay.webhook_url')); ?></p>
        <code class="d-block p-2 bg-light"><?php echo e(route('payments.razorpay.webhook')); ?></code>

        <p class="mt-3">
            <?php echo BaseHelper::clean(trans('plugins/razorpay::razorpay.select_events')); ?>

        </p>

        <ul class="ps-3 mt-2">
            <li><strong>payment.authorized</strong> - <?php echo e(trans('plugins/razorpay::razorpay.event_authorized')); ?></li>
            <li><strong>payment.captured</strong> - <?php echo e(trans('plugins/razorpay::razorpay.event_captured')); ?></li>
            <li><strong>payment.failed</strong> - <?php echo e(trans('plugins/razorpay::razorpay.event_failed')); ?></li>
            <li><strong>order.paid</strong> - <?php echo e(trans('plugins/razorpay::razorpay.event_order_paid')); ?></li>
        </ul>

        <div class="alert alert-danger mt-3 d-block">
            <p class="mb-1"><strong><?php echo e(trans('plugins/razorpay::razorpay.warning')); ?></strong></p> <?php echo e(trans('plugins/razorpay::razorpay.webhook_skip_warning')); ?>

        </div>

        <p class="mt-3">
            <?php echo BaseHelper::clean(trans('plugins/razorpay::razorpay.webhook_secret_instruction')); ?>

        </p>
    </li>
    <li>
        <p>
            <strong><?php echo e(trans('plugins/razorpay::razorpay.test_integration')); ?></strong>
        </p>
        <ul class="ps-3">
            <li><?php echo e(trans('plugins/razorpay::razorpay.test_payment')); ?></li>
            <li><?php echo e(trans('plugins/razorpay::razorpay.check_status')); ?></li>
            <li><?php echo e(trans('plugins/razorpay::razorpay.verify_webhook')); ?></li>
            <li><?php echo e(trans('plugins/razorpay::razorpay.check_logs')); ?></li>
        </ul>
    </li>
</ol>

<div class="alert alert-info mt-3 d-block">
    <p class="mb-1"><strong><?php echo e(trans('plugins/razorpay::razorpay.troubleshooting')); ?></strong></p>
    <ul class="mb-0 mt-2">
        <li><?php echo e(trans('plugins/razorpay::razorpay.ssl_required')); ?></li>
        <li><?php echo e(trans('plugins/razorpay::razorpay.public_url')); ?></li>
        <li><?php echo e(trans('plugins/razorpay::razorpay.firewall_check')); ?></li>
        <li><?php echo e(trans('plugins/razorpay::razorpay.live_mode')); ?></li>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\razorpay\/resources/views/instructions.blade.php ENDPATH**/ ?>