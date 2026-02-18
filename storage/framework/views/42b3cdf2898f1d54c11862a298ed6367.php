<script type="text/javascript">
    // Immediately override alert() and confirm() before any other scripts load
    (function() {
        if (!window._dialogOverridesInstalled) {
            window._dialogOverridesInstalled = true;
            window.originalAlert = window.alert;
            window.originalConfirm = window.confirm;
            
            window.alert = function(message) {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('info', message, 'Alert');
                } else {
                    // Queue for later
                    if (!window._pendingAlerts) window._pendingAlerts = [];
                    window._pendingAlerts.push({type: 'alert', message: message});
                    window.originalAlert(message);
                }
            };
            
            window.confirm = function(message) {
                if (typeof window.showDialogConfirm === 'function') {
                    let result = null;
                    let resolved = false;
                    window.showDialogConfirm(message, 'Confirm').then((confirmed) => {
                        result = confirmed;
                        resolved = true;
                    });
                    // Block until resolved (with timeout to prevent infinite loop)
                    const start = Date.now();
                    const maxWait = 60000; // 60 seconds
                    while (!resolved && (Date.now() - start) < maxWait) {
                        // Busy wait - needed for synchronous compatibility
                    }
                    return result === true;
                } else {
                    // Fallback to original - dialog system not ready yet
                    return window.originalConfirm(message);
                }
            };
        }
    })();
    
    var BotbleVariables = BotbleVariables || {};

    <?php if(Auth::guard()->check()): ?>
        BotbleVariables.languages = {
            tables: <?php echo e(Js::from(trans('core/base::tables'))); ?>,
            notices_msg: <?php echo e(Js::from(trans('core/base::notices'))); ?>,
            pagination: <?php echo e(Js::from(trans('pagination'))); ?>,
        };
        BotbleVariables.authorized =
            "<?php echo e(setting('membership_authorization_at') && Carbon\Carbon::now()->diffInDays(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', setting('membership_authorization_at'))) <= 7 ? 1 : 0); ?>";
        BotbleVariables.authorize_url = "<?php echo e(route('membership.authorize')); ?>";

        BotbleVariables.menu_item_count_url = "<?php echo e(route('menu-items-count')); ?>";
    <?php else: ?>
        BotbleVariables.languages = {
            notices_msg: <?php echo e(Js::from(trans('core/base::notices'))); ?>,
        };
    <?php endif; ?>
</script>

<?php $__env->startPush('footer'); ?>
    <?php if(Session::has('success_msg') || Session::has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg)): ?>
        <script type="text/javascript">
            $(function() {
                <?php if(Session::has('success_msg')): ?>
                    Botble.showSuccess('<?php echo BaseHelper::cleanToastMessage(session('success_msg')); ?>');
                <?php endif; ?>
                <?php if(Session::has('error_msg')): ?>
                    Botble.showError('<?php echo BaseHelper::cleanToastMessage(session('error_msg')); ?>');
                <?php endif; ?>
                <?php if(isset($error_msg)): ?>
                    Botble.showError('<?php echo BaseHelper::cleanToastMessage($error_msg); ?>');
                <?php endif; ?>
                <?php if(isset($errors)): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        Botble.showError('<?php echo BaseHelper::cleanToastMessage($error); ?>');
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            })
        </script>
    <?php endif; ?>
    
    
    <?php if(Session::has('job_created_console_data')): ?>
        <?php
            $consoleData = session('job_created_console_data');
            session()->forget('job_created_console_data');
        ?>
        <script type="text/javascript">
            $(function() {
                console.log('%c✅ Job Created Successfully!', 'color: #10b981; font-size: 16px; font-weight: bold;');
                console.log('%cJob Details:', 'color: #3b82f6; font-size: 14px; font-weight: bold;');
                console.log('  Job ID: <?php echo e($consoleData['job_id']); ?>');
                console.log('  Job Name: <?php echo e($consoleData['job_name']); ?>');
                console.log('');
                
                <?php if($consoleData['email_count'] > 0): ?>
                    console.log('%c📧 Email sent to <?php echo e($consoleData['email_count']); ?> job seeker(s):', 'color: #8b5cf6; font-size: 14px; font-weight: bold;');
                    <?php $__currentLoopData = $consoleData['job_seekers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jobSeeker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        console.log('  <?php echo e($index + 1); ?>. <?php echo e($jobSeeker['name']); ?> (<?php echo e($jobSeeker['email']); ?>)');
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    console.log('%c⚠️ No job seekers found to send emails.', 'color: #f59e0b; font-size: 14px; font-weight: bold;');
                    <?php if(isset($consoleData['debug_info'])): ?>
                        console.log('%cDebug Info: <?php echo e($consoleData['debug_info']); ?>', 'color: #6b7280; font-size: 12px;');
                    <?php endif; ?>
                    console.log('%c💡 Tip: Check PHP error logs for detailed debugging information.', 'color: #6b7280; font-size: 12px; font-style: italic;');
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/core/base/resources/views/elements/common.blade.php ENDPATH**/ ?>