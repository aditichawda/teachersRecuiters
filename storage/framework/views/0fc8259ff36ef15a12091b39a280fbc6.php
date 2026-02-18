<footer>
    <?php
        $currencies = get_all_currencies();
    ?>

    <?php if($currencies->count() > 1): ?>
        <p class="d-inline-block mb-0"><?php echo e(trans('plugins/job-board::dashboard.currencies_label')); ?>:
            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a
                    href="<?php echo e(route('public.change-currency', $currency->title)); ?>"
                    <?php if(get_application_currency_id() == $currency->id): ?> class="active" <?php endif; ?>
                ><span><?php echo e($currency->title); ?></span></a>
                <?php if(!$loop->last): ?>
                    -
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
    <?php endif; ?>
</footer>

<script src="<?php echo e(asset('vendor/core/plugins/job-board/js/app.js')); ?>"></script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/themes/dashboard/layouts/footer.blade.php ENDPATH**/ ?>