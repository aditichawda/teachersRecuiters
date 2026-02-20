<div class="section-full p-t5 p-b6 site-bg-gray twm-testimonial-2-area">
    <div class="section-head center wt-small-separator-outer">
        <div class="wt-small-separator site-text-primary">
            <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
        </div>
        <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
    </div>
    <div class="container">
        <div class="section-content">
            <div class="owl-carousel twm-testimonial-2-carousel owl-btn-bottom-center">
                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="twm-testimonial-2">
                            <div class="twm-testimonial-2-content">
                                <div class="twm-testi-media">
                                    <img src="<?php echo e(RvMedia::getImageUrl($testimonial->image)); ?>" alt="<?php echo e($testimonial->name); ?>">
                                </div>
                                <div class="twm-testi-content">
                                    <div class="twm-quote">
                                        <img src="<?php echo e(Theme::asset()->url('/images/quote-dark.png')); ?>" alt="<?php echo e($testimonial->name); ?>">
                                    </div>
                                    <div class="twm-testi-info"><?php echo BaseHelper::clean($testimonial->content); ?></div>
                                    <div class="twm-testi-detail">
                                        <div class="twm-testi-name"><?php echo e($testimonial->name); ?></div>
                                        <div class="twm-testi-position"><?php echo e($testimonial->company); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/testimonials/style-2.blade.php ENDPATH**/ ?>