<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <?php if(theme_option('favicon')): ?>
            <link href="<?php echo e(RvMedia::getImageUrl(theme_option('favicon'))); ?>" rel="shortcut icon">
        <?php endif; ?>

        <title><?php echo e(PageTitle::getTitle(false)); ?></title>

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php echo $__env->yieldContent('header', view(JobBoardHelper::viewPath('dashboard.layouts.header'))); ?>

        <script type="text/javascript">
            'use strict';
            window.trans = Object.assign(window.trans || {}, JSON.parse('<?php echo addslashes(json_encode(trans('plugins/job-board::job-board.themes'))); ?>'));

            var BotbleVariables = BotbleVariables || {};
            BotbleVariables.languages = {
                tables: <?php echo json_encode(trans('core/base::tables'), JSON_HEX_APOS); ?>,
                notices_msg: <?php echo json_encode(trans('core/base::notices'), JSON_HEX_APOS); ?>,
                pagination: <?php echo json_encode(trans('pagination'), JSON_HEX_APOS); ?>,
                system: {
                    character_remain: '<?php echo e(trans('plugins/job-board::job-board.character_remain')); ?>'
                }
            };

            window.siteEditorLocale = "<?php echo e(apply_filters('cms_site_editor_locale', App::getLocale())); ?>";
        </script>
    </head>

    <body <?php if(session('locale_direction', 'ltr') == 'rtl'): ?> dir="rtl" <?php endif; ?>>
        <?php echo $__env->yieldContent('body', view(JobBoardHelper::viewPath('dashboard.layouts.body'))); ?>

        <?php echo $__env->make('plugins/job-board::themes.dashboard.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo Assets::renderFooter(); ?>

        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->yieldPushContent('footer'); ?>
        <?php echo apply_filters(THEME_FRONT_FOOTER, null); ?>


        <?php if(Session::has('success_msg') || Session::has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg)): ?>
            <script type="text/javascript">
                $(function() {
                    <?php if(Session::has('success_msg')): ?>
                        Botble.showSuccess('<?php echo e(session('success_msg')); ?>');
                    <?php endif; ?>
                    <?php if(Session::has('error_msg')): ?>
                        Botble.showError('<?php echo e(session('error_msg')); ?>');
                    <?php endif; ?>
                    <?php if(isset($error_msg)): ?>
                        Botble.showError('<?php echo e($error_msg); ?>');
                    <?php endif; ?>
                    <?php if(isset($errors)): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            Botble.showError('<?php echo e($error); ?>');
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                });
            </script>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/themes/dashboard/layouts/master.blade.php ENDPATH**/ ?>