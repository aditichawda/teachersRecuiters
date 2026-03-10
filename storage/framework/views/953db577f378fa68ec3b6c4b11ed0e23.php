<?php
    $account = auth('account')->user();
?>

<?php echo SeoHelper::render(); ?>


<?php echo $__env->make('plugins/job-board::themes.dashboard.layouts.header-meta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<link href="<?php echo e(asset('vendor/core/plugins/job-board/css/dashboard/style.css')); ?>" rel="stylesheet">

<?php if(session('locale_direction', 'ltr') == 'rtl'): ?>
    <link href="<?php echo e(asset('vendor/core/core/base/css/core.rtl.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('vendor/core/plugins/job-board/css/dashboard/style-rtl.css')); ?>" rel="stylesheet">
<?php endif; ?>

<?php if(File::exists($styleIntegration = Theme::getStyleIntegrationPath())): ?>
    <?php echo Html::style(Theme::asset()->url('css/style.integration.css?v=' . filectime($styleIntegration))); ?>

<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/plugins/job-board/resources/views/themes/dashboard/layouts/header.blade.php ENDPATH**/ ?>