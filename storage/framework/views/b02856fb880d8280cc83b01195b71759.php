<!DOCTYPE html>
<html <?php echo Theme::htmlAttributes(); ?>>
    <head>
        <?php echo Theme::partial('header-meta'); ?>

    </head>
    <body data-anm=".anm" <?php echo Theme::bodyAttributes(); ?>>
        <?php echo apply_filters(THEME_FRONT_BODY, null); ?>


        <div class="toast-container" id="alert-container"></div>

        <?php if(theme_option('preloader_enabled', 'yes') == 'yes'): ?>
            <?php echo Theme::partial('preloader'); ?>

        <?php endif; ?>

        <div class="page-wraper">
            <?php if(empty($withoutNavbar)): ?>
                <?php echo Theme::partial('navbar'); ?>

            <?php endif; ?>

            <!-- CONTENT START -->
            <div class="page-content">
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/header.blade.php ENDPATH**/ ?>