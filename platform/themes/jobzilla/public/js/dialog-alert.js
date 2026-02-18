/**
 * Dialog Alert Component - v2.0
 * Replaces all toast/alert notifications with beautiful dialog boxes
 * Exact match to screenshot (2nd image - Logout Dialog)
 * Updated: v2.0 - Screenshot match with logout icon and proper button styling
 */

// Immediately override alert() and confirm() before jQuery loads
(function() {
    'use strict';
    
    // Store original functions
    if (!window.originalAlert) {
        window.originalAlert = window.alert;
    }
    if (!window.originalConfirm) {
        window.originalConfirm = window.confirm;
    }
    
    // Temporary override that will be replaced when jQuery loads
    window.alert = function(message) {
        // If dialog system is ready, use it, otherwise fallback
        if (typeof window.showDialogAlert === 'function') {
            window.showDialogAlert('info', message, 'Alert');
        } else {
            // Queue the alert to show when dialog system is ready
            if (!window._pendingAlerts) {
                window._pendingAlerts = [];
            }
            window._pendingAlerts.push({type: 'alert', message: message});
            // Fallback to original for now
            window.originalAlert(message);
        }
    };
    
    window.confirm = function(message) {
        // If dialog system is ready, use it
        if (typeof window.showDialogConfirm === 'function') {
            let result = null;
            let resolved = false;
            
            window.showDialogConfirm(message, 'Confirm').then(function(confirmed) {
                result = confirmed;
                resolved = true;
            });

            // Block until resolved
            const start = Date.now();
            const maxWait = 60000;
            while (!resolved && (Date.now() - start) < maxWait) {
                // Busy wait
            }
            
            return result === true;
        } else {
            // Queue the confirm
            if (!window._pendingConfirms) {
                window._pendingConfirms = [];
            }
            window._pendingConfirms.push({message: message});
            // Fallback to original
            return window.originalConfirm(message);
        }
    };
})();

// Now initialize with jQuery
(function() {
    'use strict';

    // Wait for DOM and jQuery
    function initDialogSystem() {
        if (typeof jQuery === 'undefined' || !jQuery) {
            setTimeout(initDialogSystem, 50);
            return;
        }

        const $ = jQuery;

        // Create dialog container if it doesn't exist
        if ($('#dialog-alert-container').length === 0) {
            $('body').append('<div id="dialog-alert-container"></div>');
        }

        /**
         * Show Dialog Alert
         * @param {string} type - 'success', 'error', or 'info'
         * @param {string} message - Message to display
         * @param {string} title - Optional title
         */
        window.showDialogAlert = function(type, message, title) {
            const container = $('#dialog-alert-container');
            const dialogId = 'dialog-alert-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
            
            // Set default title if not provided
            if (!title) {
                if (type === 'success') {
                    title = 'Success';
                } else if (type === 'info') {
                    title = 'Information';
                } else {
                    title = 'Error';
                }
            }

            // Set icon and colors based on type
            let icon, iconColor, borderColor, bgColor;
            if (type === 'success') {
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
                iconColor = '#10b981';
                borderColor = '#10b981';
                bgColor = '#f0fdf4';
            } else if (type === 'info') {
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>';
                iconColor = '#3b82f6';
                borderColor = '#3b82f6';
                bgColor = '#eff6ff';
            } else {
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
                iconColor = '#ef4444';
                borderColor = '#ef4444';
                bgColor = '#fef2f2';
            }

            // Create dialog HTML with screenshot-style structure (icon at top center)
            const dialogHtml = '<div class="dialog-alert-overlay" id="' + dialogId + '-overlay">' +
                '<div class="dialog-alert-box" id="' + dialogId + '" data-type="' + type + '">' +
                '<div class="dialog-alert-icon-container">' +
                '<div class="dialog-alert-icon" data-type="' + type + '">' +
                icon +
                '</div>' +
                '</div>' +
                '<div class="dialog-alert-content">' +
                '<h4 class="dialog-alert-title">' + (title || '') + '</h4>' +
                '<p class="dialog-alert-message">' + (message || '') + '</p>' +
                '</div>' +
                '<div class="dialog-alert-footer">' +
                '<button type="button" class="dialog-alert-btn dialog-alert-btn-confirm" onclick="closeDialogAlert(\'' + dialogId + '\')">' +
                'OK' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>';

            // Append to container
            container.append(dialogHtml);

            // Show with animation
            setTimeout(function() {
                $('#' + dialogId + '-overlay').addClass('show');
                $('#' + dialogId).addClass('show');
            }, 10);

            // Auto close after 5 seconds
            setTimeout(function() {
                closeDialogAlert(dialogId);
            }, 5000);
        };

        /**
         * Close Dialog Alert
         * @param {string} dialogId - Dialog ID to close
         */
        window.closeDialogAlert = function(dialogId) {
            const overlay = $('#' + dialogId + '-overlay');
            const dialog = $('#' + dialogId);

            overlay.removeClass('show');
            dialog.removeClass('show');

            setTimeout(function() {
                overlay.remove();
            }, 300);
        };

        // Close on overlay click (only for alert dialogs, not confirm dialogs)
        $(document).on('click', '.dialog-alert-overlay', function(e) {
            if ($(e.target).hasClass('dialog-alert-overlay')) {
                const dialogId = $(this).find('.dialog-alert-box').attr('id');
                if (dialogId && dialogId.indexOf('dialog-confirm-') !== 0) {
                    // Only close alert dialogs on overlay click, not confirm dialogs
                    closeDialogAlert(dialogId);
                }
            }
        });

        // Close on Escape key (only for alert dialogs, not confirm dialogs)
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                $('.dialog-alert-overlay.show').each(function() {
                    const dialogId = $(this).find('.dialog-alert-box').attr('id');
                    if (dialogId && dialogId.indexOf('dialog-confirm-') !== 0) {
                        // Only close alert dialogs on Escape, not confirm dialogs
                        closeDialogAlert(dialogId);
                    } else if (dialogId && dialogId.indexOf('dialog-confirm-') === 0) {
                        // For confirm dialogs, Escape = Cancel
                        closeDialogConfirm(dialogId, false);
                    }
                });
            }
        });

        /**
         * Show Dialog Confirm (replaces confirm())
         * @param {string} message - Message to display
         * @param {string} title - Optional title
         * @returns {Promise<boolean>} - Returns true if confirmed, false if cancelled
         */
        window.showDialogConfirm = function(message, title) {
            return new Promise(function(resolve) {
                const container = $('#dialog-alert-container');
                const dialogId = 'dialog-confirm-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                
                // Set default title if not provided
                if (!title) {
                    title = 'Confirm';
                }

                // Create confirm dialog HTML - Exact match to 2nd screenshot (Logout dialog)
                // Detect if it's a logout dialog
                const isLogout = (message && message.toLowerCase().includes('logout')) || 
                                (title && title.toLowerCase().includes('logout'));
                
                // Use logout icon for logout dialogs, info icon for others
                let iconHtml;
                if (isLogout) {
                    iconHtml = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>';
                } else {
                    iconHtml = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>';
                }
                
                // Set title - use "Logout" for logout dialogs
                const dialogTitle = isLogout ? 'Logout' : (title || 'Confirm');
                
                // Set button labels
                const actionButtonLabel = isLogout ? 'Logout' : (title && title.toLowerCase().includes('delete') ? 'Delete' : 'OK');
                
                const dialogHtml = '<div class="dialog-alert-overlay" id="' + dialogId + '-overlay">' +
                    '<div class="dialog-alert-box" id="' + dialogId + '" data-type="info">' +
                    '<div class="dialog-alert-icon-container">' +
                    '<div class="dialog-alert-icon" data-type="info">' +
                    iconHtml +
                    '</div>' +
                    '</div>' +
                    '<div class="dialog-alert-content">' +
                    '<h4 class="dialog-alert-title">' + dialogTitle + '</h4>' +
                    '<p class="dialog-alert-message">' + (message || '') + '</p>' +
                    '</div>' +
                    '<div class="dialog-alert-footer">' +
                    '<button type="button" class="dialog-alert-btn dialog-alert-btn-confirm" onclick="closeDialogConfirm(\'' + dialogId + '\', true)">' +
                    actionButtonLabel +
                    '</button>' +
                    '<button type="button" class="dialog-alert-btn dialog-alert-btn-primary" onclick="closeDialogConfirm(\'' + dialogId + '\', false)">' +
                    'Cancel' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                // Append to container
                container.append(dialogHtml);

                // Store resolve function
                window['__dialog_confirm_' + dialogId] = resolve;

                // Show with animation
                setTimeout(function() {
                    $('#' + dialogId + '-overlay').addClass('show');
                    $('#' + dialogId).addClass('show');
                }, 10);
            });
        };

        /**
         * Close Dialog Confirm
         * @param {string} dialogId - Dialog ID to close
         * @param {boolean} result - true if confirmed, false if cancelled
         */
        window.closeDialogConfirm = function(dialogId, result) {
            const overlay = $('#' + dialogId + '-overlay');
            const dialog = $('#' + dialogId);

            overlay.removeClass('show');
            dialog.removeClass('show');

            // Resolve promise
            const resolve = window['__dialog_confirm_' + dialogId];
            if (resolve) {
                resolve(result);
                delete window['__dialog_confirm_' + dialogId];
            }

            setTimeout(function() {
                overlay.remove();
            }, 300);
        };

        // Override native alert() function (update the override)
        window.alert = function(message) {
            if (typeof window.showDialogAlert === 'function') {
                window.showDialogAlert('info', message, 'Alert');
            } else {
                // Fallback to original alert
                window.originalAlert(message);
            }
        };

        // Override native confirm() function (update the override)
        window.confirm = function(message) {
            if (typeof window.showDialogConfirm === 'function') {
                let result = null;
                let resolved = false;
                
                window.showDialogConfirm(message, 'Confirm').then(function(confirmed) {
                    result = confirmed;
                    resolved = true;
                });

                // Block until resolved (with timeout)
                const start = Date.now();
                const maxWait = 60000; // 60 seconds max
                while (!resolved && (Date.now() - start) < maxWait) {
                    // Busy wait - not ideal but needed for synchronous compatibility
                }
                
                return result === true;
            } else {
                // Fallback to original confirm
                return window.originalConfirm(message);
            }
        };

        // Process any pending alerts/confirms
        if (window._pendingAlerts && window._pendingAlerts.length > 0) {
            window._pendingAlerts.forEach(function(item) {
                window.showDialogAlert('info', item.message, 'Alert');
            });
            window._pendingAlerts = [];
        }

        // Better approach: Intercept form submissions with confirm() in onsubmit
        function interceptFormSubmits() {
            // Find all forms with onsubmit containing confirm()
            $('form[onsubmit*="confirm"]').each(function() {
                const form = $(this);
                if (form.data('dialog-intercepted')) {
                    return; // Already intercepted
                }
                form.data('dialog-intercepted', true);
                
                const originalOnsubmit = form.attr('onsubmit');
                
                // Remove onsubmit and add event handler
                form.removeAttr('onsubmit');
                
                form.on('submit.dialog-intercept', function(e) {
                    // Extract message from original onsubmit
                    const match = originalOnsubmit.match(/confirm\(['"](.*?)['"]\)/);
                    if (match && match[1]) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        const message = match[1].replace(/\\"/g, '"').replace(/\\'/g, "'");
                        
                        window.showDialogConfirm(message, 'Confirm').then(function(confirmed) {
                            if (confirmed) {
                                // Remove this handler and submit
                                form.off('submit.dialog-intercept');
                                form[0].submit();
                            }
                        });
                        return false;
                    }
                });
            });
        }

        $(document).ready(function() {
            // Intercept existing forms
            interceptFormSubmits();
            
            // Use MutationObserver to intercept dynamically added forms
            if (typeof MutationObserver !== 'undefined') {
                const observer = new MutationObserver(function(mutations) {
                    let shouldIntercept = false;
                    mutations.forEach(function(mutation) {
                        if (mutation.addedNodes) {
                            for (let i = 0; i < mutation.addedNodes.length; i++) {
                                const node = mutation.addedNodes[i];
                                if (node.nodeType === 1) { // Element node
                                    if (node.tagName === 'FORM' || (node.querySelector && node.querySelector('form[onsubmit*="confirm"]'))) {
                                        shouldIntercept = true;
                                        break;
                                    }
                                }
                            }
                        }
                    });
                    if (shouldIntercept) {
                        setTimeout(interceptFormSubmits, 10);
                    }
                });
                
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }

            // Also handle onclick with confirm()
            $(document).on('click', '[onclick*="confirm"]', function(e) {
                const onclick = $(this).attr('onclick');
                if (onclick && onclick.indexOf('confirm(') !== -1) {
                    const match = onclick.match(/confirm\(['"](.*?)['"]\)/);
                    if (match && match[1]) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        const message = match[1].replace(/\\"/g, '"').replace(/\\'/g, "'");
                        
                        window.showDialogConfirm(message, 'Confirm').then(function(confirmed) {
                            if (confirmed) {
                                // Execute the rest of onclick after confirm
                                const restOfOnclick = onclick.replace(/return\s+confirm\([^)]+\)\s*;?\s*/i, '').replace(/confirm\([^)]+\)\s*;?\s*/i, '');
                                if (restOfOnclick.trim()) {
                                    try {
                                        eval(restOfOnclick);
                                    } catch (err) {
                                        console.error('Error executing onclick:', err);
                                    }
                                }
                            }
                        });
                        return false;
                    }
                }
            });
        });
    }

    // Start initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDialogSystem);
    } else {
        initDialogSystem();
    }
})();
