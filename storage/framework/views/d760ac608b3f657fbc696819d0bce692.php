<!DOCTYPE html>
<html <?php echo Theme::htmlAttributes(); ?>>
    <head>
        <?php echo Theme::partial('header-meta'); ?>

        
        <link rel="stylesheet" href="<?php echo e(asset('themes/jobzilla/css/dialog-alert.css')); ?>?v=2.0.<?php echo e(time()); ?>">
        
        <script>
        (function() {
            'use strict';
            if (!window._dialogOverridesInstalled) {
                window._dialogOverridesInstalled = true;
                window.originalAlert = window.alert;
                window.originalConfirm = window.confirm;
                
                window.alert = function(message) {
                    if (typeof window.showDialogAlert === 'function') {
                        window.showDialogAlert('info', message, 'Alert');
                    } else {
                        if (!window._pendingAlerts) window._pendingAlerts = [];
                        window._pendingAlerts.push({type: 'alert', message: message});
                        window.originalAlert(message);
                    }
                };
                
                window.confirm = function(message) {
                    if (typeof window.showDialogConfirm === 'function') {
                        var result = null;
                        var resolved = false;
                        window.showDialogConfirm(message, 'Confirm').then(function(confirmed) {
                            result = confirmed;
                            resolved = true;
                        });
                        var start = Date.now();
                        while (!resolved && (Date.now() - start) < 60000) {}
                        return result === true;
                    } else {
                        if (!window._pendingConfirms) window._pendingConfirms = [];
                        window._pendingConfirms.push({message: message});
                        return window.originalConfirm(message);
                    }
                };
            }
        })();
        </script>
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
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/header.blade.php ENDPATH**/ ?>