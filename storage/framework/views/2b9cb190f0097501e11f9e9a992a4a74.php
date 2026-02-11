<div class="card mb-3">
    <div class="card-header">
        <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.setup_instructions')); ?></strong>
    </div>
    <div class="card-body">
        <ol class="mb-0">
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.create_property')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.go_to')); ?>

                <a
                    href="https://analytics.google.com"
                    target="_blank"
                ><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.google_analytics')); ?></a>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.create_new_property')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.find_measurement_id')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.navigate_to_streams')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.paste_id_below')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.enter_measurement_id')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.verify_setup')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.check_realtime')); ?>

            </li>
        </ol>
        <div class="alert alert-warning mt-3 mb-0 d-block">
            <p><strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.common_mistakes')); ?></strong></p>
            <ul class="mb-0 mt-2">
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.mistake_property_id')); ?></li>
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.mistake_ua_id')); ?></li>
                <li><?php echo e(trans('packages/theme::theme.settings.website_tracking.ga.mistake_data_delay')); ?></li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/partials/website-tracking/ga-setup-guide.blade.php ENDPATH**/ ?>