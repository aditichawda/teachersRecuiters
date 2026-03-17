        <?php if(empty($withoutNavbar)): ?>
            <?php echo apply_filters('ads_render', null, 'footer_before'); ?>


            <?php if(is_plugin_active('job-board')): ?>
                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.apply-modal'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>

            <?php echo dynamic_sidebar('pre_footer_sidebar'); ?>


            <!-- START FOOTER -->
            <footer class="bg-footer" role="contentinfo" aria-label="<?php echo e(__('Site footer')); ?>">
                <div class="container">
                    <div class="row">
                        <?php echo dynamic_sidebar('footer_sidebar'); ?>

                    </div>
                </div>
            </footer>
            <!-- END FOOTER -->

            <!-- START FOOTER-ALT -->
            <div class="footer-alt">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-white-50 text-center mb-0">
                                <?php echo Theme::getSiteCopyright(); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FOOTER -->

            <?php echo apply_filters('ads_render', null, 'footer_after'); ?>

        <?php endif; ?>

        <!--start back-to-top-->
        <button id="back-to-top">
            <i class="mdi mdi-arrow-up"></i>
        </button>
        <!--end back-to-top-->
        <!-- END layout-wrapper -->

        <?php echo Theme::footer(); ?>


        <?php if(session()->has('status') || session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->any()) || isset($error_msg)): ?>
            <script type="text/javascript">
                'use strict';
                window.noticeMessages = window.noticeMessages || [];
                <?php if(session()->has('success_msg')): ?>
                noticeMessages.push({'type': 'success', 'message': "<?php echo addslashes(session('success_msg')); ?>"});
                <?php endif; ?>
                <?php if(session()->has('status')): ?>
                noticeMessages.push({'type': 'success', 'message': "<?php echo addslashes(session('status')); ?>"});
                <?php endif; ?>
                <?php if(session()->has('error_msg')): ?>
                noticeMessages.push({'type': 'error', 'message': "<?php echo addslashes(session('error_msg')); ?>"});
                <?php endif; ?>
                <?php if(isset($error_msg)): ?>
                noticeMessages.push({'type': 'error', 'message': "<?php echo addslashes($error_msg); ?>"});
                <?php endif; ?>
                <?php if(isset($errors)): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                noticeMessages.push({'type': 'error', 'message': "<?php echo addslashes($error); ?>"});
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </script>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobcy/partials/footer.blade.php ENDPATH**/ ?>