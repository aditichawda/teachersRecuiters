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
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.check_preview_mode')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.enable_preview')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.verify_tag_assistant')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.install_tag_assistant_prefix')); ?>

                <a
                    href="https://chrome.google.com/webstore/detail/tag-assistant-legacy-by-g/kejbdjndbnbjgmefkgdddjlbokphdefk"
                    target="_blank"
                ><?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.google_tag_assistant')); ?></a>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.install_tag_assistant_suffix')); ?>

            </li>
            <li>
                <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.verification.check_console')); ?></strong>
                <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.console_instructions')); ?>

            </li>
        </ol>
        <div class="alert alert-danger mt-3 mb-0 d-block">
            <p><strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.common_issues')); ?></strong></p>
            <ul class="mb-0 mt-2">
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.issue_tags_not_firing')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.issue_tags_not_firing_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.issue_wrong_container')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.gtm.issue_wrong_container_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.issue_ad_blocker')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.issue_ad_blocker_solution')); ?>

                </li>
                <li>
                    <strong><?php echo e(trans('packages/theme::theme.settings.website_tracking.issue_caching')); ?></strong>
                    <?php echo e(trans('packages/theme::theme.settings.website_tracking.issue_caching_solution')); ?>

                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\packages\theme\/resources/views/partials/website-tracking/gtm-verification-guide.blade.php ENDPATH**/ ?>