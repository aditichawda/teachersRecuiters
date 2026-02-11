<div class="card mb-3">
    <div class="card-header">
        <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.setup_instructions')); ?></strong>
    </div>
    <div class="card-body">
        <p class="mb-2">
            <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.popular_services')); ?></strong></p>
        <ul class="mb-3">
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.matomo')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.matomo_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.plausible')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.plausible_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.fathom')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.fathom_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.facebook_pixel')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.facebook_pixel_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.hotjar')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.hotjar_instructions')); ?>

            </li>
        </ul>
        <div class="alert alert-info mb-0 d-block">
            <p><strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.best_practices')); ?></strong></p>
            <ul class="mb-0 mt-2">
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.practice_two_part')); ?></li>
                <li><?php echo BaseHelper::clean(trans('packages/theme::theme.settings.website_tracking.custom.practice_complete_code')); ?></li>
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.practice_test_incognito')); ?></li>
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.practice_check_console')); ?></li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/partials/website-tracking/custom-setup-guide.blade.php ENDPATH**/ ?>