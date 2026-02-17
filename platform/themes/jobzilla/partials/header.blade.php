<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        {!! Theme::partial('header-meta') !!}
        {{-- Dialog Alert CSS - Load in header for immediate availability --}}
        <link rel="stylesheet" href="{{ asset('themes/jobzilla/css/dialog-alert.css') }}?v={{ time() }}">
        {{-- Immediately override alert() and confirm() before any scripts load --}}
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
    <body data-anm=".anm" {!! Theme::bodyAttributes() !!}>
        {!! apply_filters(THEME_FRONT_BODY, null) !!}

        <div class="toast-container" id="alert-container"></div>

        @if (theme_option('preloader_enabled', 'yes') == 'yes')
            {!! Theme::partial('preloader') !!}
        @endif

        <div class="page-wraper">
            @if (empty($withoutNavbar))
                {!! Theme::partial('navbar') !!}
            @endif

            <!-- CONTENT START -->
            <div class="page-content">
