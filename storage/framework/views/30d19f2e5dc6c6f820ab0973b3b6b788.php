</div>
<?php
    $hideFooterOnRoutes = ['public.account.login', 'public.account.register'];
    $shouldHideFooter = in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $hideFooterOnRoutes, true);
?>

<?php if (! ($shouldHideFooter)): ?>
    <!-- FOOTER START (screenshot style: dark, 5 columns, partners, bottom bar) -->
    <footer class="footer-dark footer-screenshot-style"
        <?php if(theme_option('footer_background')): ?> style="background-image: url(<?php echo e(RvMedia::getImageUrl(theme_option('footer_background'))); ?>);"
        <?php else: ?> style="background-color: #1a1d21;" <?php endif; ?>>
        <div class="container">
            <!-- Section 1: Top – 5 columns -->
            <div class="footer-top">
                <div class="row g-4">
                    <!-- Col 1: Brand -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h3 class="footer-title">TeachersRecruiter™</h3>
                            <p class="footer-desc">
                                Connecting educators and schools across India since 2015. With thousands of teacher
                                placements and a dedicated education job portal, we make hiring and job searching simple,
                                fast, and reliable.
                            </p>
                            <a href="/about-us" class="footer-read-more">read more →</a>
                        </div>
                    </div>
                    <!-- Col 2: Discover -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Discover</h4>
                            <ul class="footer-links">
                                <li><a href="/">Home</a></li>
                                <li><a href="/jobs">Jobs</a></li>
                                <li><a href="/companies">Companies</a></li>
                                <li><a href="/candidates">Candidates</a></li>
                                <li><a href="/contact">Help & Support</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 3: About -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">About</h4>
                            <ul class="footer-links">
                                <li><a href="/about-us">About Us</a></li>
                                <li><a href="/contact">Contact Us</a></li>
                                <li><a href="/how-it-works">How it works</a></li>
                                <li><a href="/blogs">Blog</a></li>
                                <li><a href="/faq">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 4: Resources -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Resources</h4>
                            <ul class="footer-links">
                                <li><a href="/privacy-policy">Privacy</a></li>
                                <li><a href="/terms-conditions">Terms & Refund</a></li>
                                <li><a href="/fraud-alert">Fraud Alert</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Col 5: Social -->
                    <div class="col-lg col-md-4 col-6">
                        <div class="footer-widget">
                            <h4 class="footer-title">Social</h4>
                            <?php ($socialLinks = Theme::getSocialLinks()); ?>
                            <?php if($socialLinks): ?>
                                <ul class="footer-links footer-social-links">
                                    <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!$socialLink->getUrl() || !$socialLink->getIconHtml()) continue; ?>
                                        <li>
                                            <a href="<?php echo e($socialLink->getUrl()); ?>" target="_blank" rel="noopener"><?php echo $socialLink->getIconHtml(); ?> <?php echo e($socialLink->getName()); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php else: ?>
                                <ul class="footer-links footer-social-links">
                                    <li><a href="https://www.linkedin.com/company/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i> LinkedIn</a></li>
                                    <li><a href="https://www.instagram.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-instagram"></i> Instagram</a></li>
                                    <li><a href="https://www.google.com/search?q=teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-google"></i> Google</a></li>
                                    <li><a href="https://www.facebook.com/teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                    <li><a href="https://www.youtube.com/@teachersrecruiter" target="_blank" rel="noopener"><i class="fab fa-youtube"></i> YouTube</a></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Partners -->
            <div class="footer-partners">
                <div class="footer-partners-inner">
                    <span class="footer-partners-label">Our Partner:</span>
                    <div class="footer-partners-list">
                        <a href="/companies" class="footer-partner-item">Featured Institutions</a>
                        <a href="/jobs" class="footer-partner-item">Jobs</a>
                        <a href="/about-us" class="footer-partner-item">About</a>
                    </div>
                    <a href="/companies" class="footer-see-all">See All →</a>
                </div>
            </div>

            <!-- Section 3: Bottom – Copyright + Legal -->
            <div class="footer-bottom">
                <div class="footer-bottom-inner">
                    <div class="footer-copy-right">
                        <?php echo Theme::getSiteCopyright() ?: 'Copyright ©' . date('Y') . ' All rights reserved | This template is made with ❤️ by <a href="https://teachersrecruiter.in" class="footer-accent">TeachersRecruiter™</a>'; ?>

                    </div>
                    <div class="footer-legal">
                        <a href="/terms-conditions">Terms</a>
                        <a href="/privacy-policy">Privacy</a>
                        <a href="/fraud-alert">Compliances</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="whatsapp-float"
        style="position: fixed; width: 60px; height: 60px; bottom: 20px; right: 20px; background-color: #25D366; color: #FFF; border-radius: 50px; text-align: center; font-size: 30px; box-shadow: 2px 2px 10px rgba(0,0,0,0.3); z-index: 1000; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.3s;">
        <i class="fab fa-whatsapp" style="color: #fff;"></i>
    </a>
    <style>
        .whatsapp-float:hover {
            transform: scale(1.1);
        }
    </style>
<?php endif; ?>

<?php if(is_plugin_active('job-board')): ?>
    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.apply-modal'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script id="traffic-popup-map-template" type="text/x-jquery-tmpl">
            <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.map'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </script>
<?php endif; ?>

<?php echo Theme::footer(); ?>


<?php if(session()->has('status') ||
        session()->has('success_msg') ||
        session()->has('error_msg') ||
        (isset($errors) && $errors->count() > 0) ||
        isset($error_msg)): ?>
    <script type="text/javascript">
        'use strict';
        window.onload = function() {
            <?php if(session()->has('success_msg')): ?>
                window.showAlert('text-success', "<?php echo addslashes(session('success_msg')); ?>");
            <?php endif; ?>
            <?php if(session()->has('status')): ?>
                window.showAlert('text-success', "<?php echo addslashes(session('status')); ?>");
            <?php endif; ?>
            <?php if(session()->has('error_msg')): ?>
                window.showAlert('text-danger', "<?php echo addslashes(session('error_msg')); ?>");
            <?php endif; ?>
            <?php if(isset($error_msg)): ?>
                window.showAlert('text-danger', "<?php echo addslashes($error_msg); ?>");
            <?php endif; ?>
            <?php if(isset($errors)): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    window.showAlert('text-danger', "<?php echo addslashes($error); ?>");
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        };
    </script>
<?php endif; ?>
</body>

</html>

<!-- </div>
   
    <footer class="footer-dark"
        <?php if(theme_option('footer_background')): ?> style="background-image: url(<?php echo e(RvMedia::getImageUrl(theme_option('footer_background'))); ?>);"
        <?php else: ?>
            style="background-image: url(<?php echo e(Theme::asset()->url('/images/f-bg.jpg')); ?>);" <?php endif; ?>>
        <div class="container">

            <div class="ftr-nw-content">
                <?php echo dynamic_sidebar('pre_footer_sidebar'); ?>

            </div>

           
            <div class="footer-top">
                <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1">
                    <?php echo dynamic_sidebar('footer_sidebar'); ?>

                </div>
            </div>
           
            <div class="footer-bottom">
                <div class="footer-bottom-info">
                    <div class="footer-copy-right">
                        <span class="copyrights-text"><?php echo Theme::getSiteCopyright(); ?></span>
                    </div>
                    <?php if($socialLinks = Theme::getSocialLinks()): ?>
                        <ul class="social-icons">
                            <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!$socialLink->getUrl() || !$socialLink->getIconHtml()) continue; ?>

                                <a <?php echo $socialLink->getAttributes(['class' => 'text-white ms-2 me-2']); ?>><?php echo e($socialLink->getIconHtml()); ?></a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>
   

    <?php if(is_plugin_active('job-board')): ?>
<?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.apply-modal'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <script id="traffic-popup-map-template" type="text/x-jquery-tmpl">
            <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.map'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </script>
<?php endif; ?>

    <?php echo Theme::footer(); ?>


    <?php if(session()->has('status') ||
            session()->has('success_msg') ||
            session()->has('error_msg') ||
            (isset($errors) && $errors->count() > 0) ||
            isset($error_msg)): ?>
<script type="text/javascript">
    'use strict';
    window.onload = function() {
        <?php if(session()->has('success_msg')): ?>
            window.showAlert('text-success', "<?php echo addslashes(session('success_msg')); ?>");
        <?php endif; ?>
        <?php if(session()->has('status')): ?>
            window.showAlert('text-success', "<?php echo addslashes(session('status')); ?>");
        <?php endif; ?>
        <?php if(session()->has('error_msg')): ?>
            window.showAlert('text-danger', "<?php echo addslashes(session('error_msg')); ?>");
        <?php endif; ?>
        <?php if(isset($error_msg)): ?>
            window.showAlert('text-danger', "<?php echo addslashes($error_msg); ?>");
        <?php endif; ?>
        <?php if(isset($errors)): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                window.showAlert('text-danger', "<?php echo addslashes($error); ?>");
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    };
</script>
<?php endif; ?>
</body>
</html> --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/footer.blade.php ENDPATH**/ ?>