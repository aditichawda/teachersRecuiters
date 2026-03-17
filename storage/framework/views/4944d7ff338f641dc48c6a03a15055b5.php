<!DOCTYPE html>
<html <?php echo Theme::htmlAttributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php echo Theme::partial('theme-meta'); ?>


        <?php echo Theme::header(); ?>


        <style>
            :root {
                --bs-primary: <?php echo e(theme_option('primary_color', '#5749cd')); ?>;
                --bs-primary-rgb: <?php echo e(implode(', ', BaseHelper::hexToRgb(theme_option('primary_color', '#5749cd')))); ?>;
            }
        </style>
    </head>
    <body <?php echo Theme::bodyAttributes(); ?>>
        <?php echo apply_filters(THEME_FRONT_BODY, null); ?>

        <a href="#main-content" class="visually-hidden-focusable position-absolute top-0 start-0 m-2 p-2 bg-primary text-white" style="z-index: 9999;"><?php echo e(__('Skip to main content')); ?></a>
        <div id="alert-container"></div>

        <?php if(empty($withoutNavbar)): ?>
            <?php echo apply_filters('ads_render', null, 'header_before'); ?>


            <?php echo Theme::partial('navbar'); ?>


            <?php echo apply_filters('ads_render', null, 'header_after'); ?>

        <?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobcy/partials/header.blade.php ENDPATH**/ ?>