<!-- Popular category SECTION START -->
<div class="section-full p-t120 p-b0 site-bg-white twm-jobatglance-wrap8">
    <div class="container">

        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <!-- TITLE START-->
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
                        </div>
                        <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
                    </div>
                    <!-- TITLE END-->
                </div>
                <?php if($shortcode->button_action_label || $shortcode->button_action_url): ?>
                    <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                        <a href="<?php echo e($shortcode->button_action_url ?: JobBoardHelper::getJobsPageURL()); ?>" class="site-button"><?php echo e($shortcode->button_action_label ?: __('View All Jobs')); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="twm-jobatglance-h8">
            <div class="owl-carousel h-page8-jobs-slider">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="job-categories-home-8">
                            <div class="twm-media cat-bg-clr-3">
                                <div class="flaticon-hr"></div>
                            </div>
                            <a href="<?php echo e($category->url); ?>"><?php echo e($category->name); ?></a>
                            <div class="twm-content">
                                <div class="twm-jobs-available"><?php echo e(__(':count Jobs', ['count' => number_format($category->active_jobs_count)])); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>

</div>
<!-- Popular category SECTION END -->
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/featured-categories/style-6.blade.php ENDPATH**/ ?>