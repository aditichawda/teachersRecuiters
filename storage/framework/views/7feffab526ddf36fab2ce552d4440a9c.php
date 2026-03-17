<?php
    $account = auth('account')->user();
    $dashboardCssPath = public_path('vendor/core/plugins/job-board/css/dashboard/style.css');
    $dashboardCssVersion = file_exists($dashboardCssPath) ? filemtime($dashboardCssPath) : time();
    $dashboardRtlCssPath = public_path('vendor/core/plugins/job-board/css/dashboard/style-rtl.css');
    $dashboardRtlCssVersion = file_exists($dashboardRtlCssPath) ? filemtime($dashboardRtlCssPath) : time();
?>

<?php echo SeoHelper::render(); ?>


<?php echo $__env->make('plugins/job-board::themes.dashboard.layouts.header-meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<link data-dashboard-css="1" href="<?php echo e(asset('vendor/core/plugins/job-board/css/dashboard/style.css')); ?>?v=<?php echo e($dashboardCssVersion); ?>" rel="stylesheet">

<?php if(session('locale_direction', 'ltr') == 'rtl'): ?>
    <link href="<?php echo e(asset('vendor/core/core/base/css/core.rtl.css')); ?>" rel="stylesheet">
    <link data-dashboard-css-rtl="1" href="<?php echo e(asset('vendor/core/plugins/job-board/css/dashboard/style-rtl.css')); ?>?v=<?php echo e($dashboardRtlCssVersion); ?>" rel="stylesheet">
<?php endif; ?>

<?php if(File::exists($styleIntegration = Theme::getStyleIntegrationPath())): ?>
    <?php echo Html::style(Theme::asset()->url('css/style.integration.css?v=' . filectime($styleIntegration))); ?>

<?php endif; ?>

<script>
    (function () {
        function logCss(label, linkEl) {
            if (!linkEl) return;
            setTimeout(function () {
                var loaded = !!linkEl.sheet;
                console.log('[DASHBOARD_CSS_DEBUG]', label, {
                    href: linkEl.href,
                    loaded: loaded
                });
            }, 0);

            linkEl.addEventListener('load', function () {
                console.log('[DASHBOARD_CSS_DEBUG]', label, 'load', linkEl.href);
            });
            linkEl.addEventListener('error', function () {
                console.error('[DASHBOARD_CSS_DEBUG]', label, 'error', linkEl.href);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            logCss('style.css', document.querySelector('link[data-dashboard-css="1"]'));
            logCss('style-rtl.css', document.querySelector('link[data-dashboard-css-rtl="1"]'));
        });
    })();
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/layouts/header.blade.php ENDPATH**/ ?>