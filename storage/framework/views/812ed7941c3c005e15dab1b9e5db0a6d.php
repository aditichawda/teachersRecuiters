<?php
    $currencies = get_all_currencies();
?>

<div class="dropdown d-inline-block currency-switch">
    <a type="button" class="btn-currency dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
       aria-expanded="false">
        <?php echo e(get_application_currency()->title); ?>

        <i class="mdi mdi-chevron-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>" class="dropdown-item notify-item language"><span><?php echo e($currency->title); ?></span></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/currency-switcher.blade.php ENDPATH**/ ?>