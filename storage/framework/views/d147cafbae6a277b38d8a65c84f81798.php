<!-- TOP COMPANIES START -->
<div class="section-full p-t5 p-b6 site-bg-white twm-companies-wrap">
    <!-- TITLE START-->
    <div class="section-head center wt-small-separator-outer">
        <div class="wt-small-separator site-text-primary">
            <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
        </div>
        <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
    </div>
    <!-- TITLE END-->
    <div class="container">
        <div class="section-content">
            <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center" style="background-color: aliceblue;">
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                                <a href="<?php echo e($company->url); ?>">
                                    <img src="<?php echo e(RvMedia::getImageUrl($company->logo_thumb)); ?>" alt="<?php echo e($company->name); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php if(count($tabs)): ?>
            <div class="twm-company-approch2-outer">
                <div class="twm-company-approch2">
                    <div class="row">
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="counter-outer-two">
                                    <div class="icon-content">
                                        <div class="tw-count-number site-text-black">
                                            <span class="counter"><?php echo e(Arr::get($tab, 'count')); ?></span><?php echo e(Arr::get($tab, 'extra')); ?>

                                        </div>
                                        <p class="icon-content-info"><?php echo e(Arr::get($tab, 'title')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- TOP COMPANIES END -->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/featured-companies/style-2.blade.php ENDPATH**/ ?>
<!-- TOP COMPANIES START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-companies-wrap">
    <!-- TITLE START-->
    <div class="section-head center wt-small-separator-outer">
        <div class="wt-small-separator site-text-primary">
            <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
        </div>
        <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
    </div>
    <!-- TITLE END-->
    <div class="container">
        <div class="section-content">
            <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                                <a href="<?php echo e($company->url); ?>">
                                    <img src="<?php echo e(RvMedia::getImageUrl($company->logo_thumb)); ?>" alt="<?php echo e($company->name); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php if(count($tabs)): ?>
            <div class="twm-company-approch2-outer">
                <div class="twm-company-approch2">
                    <div class="row">
                        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="counter-outer-two">
                                    <div class="icon-content">
                                        <div class="tw-count-number site-text-black">
                                            <span class="counter"><?php echo e(Arr::get($tab, 'count')); ?></span><?php echo e(Arr::get($tab, 'extra')); ?>

                                        </div>
                                        <p class="icon-content-info"><?php echo e(Arr::get($tab, 'title')); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- TOP COMPANIES END -->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/featured-companies/style-2.blade.php ENDPATH**/ ?>