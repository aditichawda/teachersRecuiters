<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('plugins/payment::partials.form', [
        'action' => route('payments.checkout'),
        'currency' => $package->currency->title
            ? strtoupper($package->currency->title)
            : cms_currency()->getDefaultCurrency()->title,
        'amount' => $package->price,
        'name' => $package->name,
<<<<<<< HEAD
        'returnUrl' => url('account/packages/' . $package->id . '/subscribe'),
=======
        'returnUrl' => route('public.account.package.subscribe', $package->id),
>>>>>>> 689f01a2 (payment update)
        'callbackUrl' => route('public.account.package.subscribe.callback', $package->id),
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(JobBoardHelper::viewPath('dashboard.layouts.master'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/checkout.blade.php ENDPATH**/ ?>