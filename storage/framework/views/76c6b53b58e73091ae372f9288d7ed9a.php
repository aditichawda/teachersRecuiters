<div class="card">
    <div class="card-header">
        <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.verification_title')); ?></strong>
    </div>
    <div class="card-body">
        <ol class="mb-0">
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.save_config')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.click_save_button')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.visit_website')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.open_incognito')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.check_console')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.console_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.verify_network')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.network_instructions')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.check_dashboard')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.dashboard_instructions')); ?>

            </li>
        </ol>
        <div class="alert alert-danger mt-3 mb-0 d-block">
            <p>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.common_issues')); ?></strong>
            </p>
            <ul class="mb-0 mt-2">
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_js_errors')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_js_errors_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_missing_tags')); ?></strong>
                    <?php echo BaseHelper::clean(
                        trans('packages/theme::theme.settings.website_tracking.custom.issue_missing_tags_solution'),
                    ); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_incomplete_code')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_incomplete_code_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_wrong_placement')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_wrong_placement_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_quotes')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.custom.issue_quotes_solution')); ?>

                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/partials/website-tracking/custom-verification-guide.blade.php ENDPATH**/ ?>