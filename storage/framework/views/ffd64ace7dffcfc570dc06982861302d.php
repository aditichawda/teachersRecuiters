<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=<?php echo e($redirectUrl); ?>">
    <title><?php echo e(trans('plugins/payment::payment.checkout_success')); ?></title>
    <style>
        body { font-family: system-ui, sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; background: #f5f5f5; }
        .box { text-align: center; padding: 2rem; }
        .spinner { width: 40px; height: 40px; border: 3px solid #e0e0e0; border-top-color: #0d6efd; border-radius: 50%; animation: spin 0.8s linear infinite; margin: 0 auto 1rem; }
        @keyframes spin { to { transform: rotate(360deg); } }
        a { color: #0d6efd; }
    </style>
</head>
<body>
    <div class="box">
        <div class="spinner"></div>
        <p><?php echo e($message ?? trans('plugins/payment::payment.checkout_success')); ?></p>
        <p><a href="<?php echo e($redirectUrl); ?>"><?php echo e(__('Click here if you are not redirected.')); ?></a></p>
    </div>
    <script>
        window.top.location.href = <?php echo json_encode($redirectUrl); ?>;
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\razorpay\/resources/views/redirect.blade.php ENDPATH**/ ?>