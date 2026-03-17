<?php
    Theme::asset()->container('footer')->usePath()->add('swiper-js', 'libraries/js/swiper.bundle.min');
    Theme::asset()->usePath()->add('swiper-css', 'libraries/css/swiper.bundle.min.css');
?>

<style>
.twm-testimonial-v-area {
    padding-top: 60px !important;
    padding-bottom: 60px !important;
}
.twm-testimonial-v-area .container {
    max-width: 100% !important;
    padding: 0px 80px !important;
}
/* .twm-testimonial-v-section {
    /* max-width: 900px; */
    /* margin: 0 auto;
} */
.testimonial-wrapper {
    display: flex;
    flex-direction: column;
    gap: 30px;
}
.twm-explore-top-section {
    margin-bottom: 20px;
}
.v-testimonial-wrap {
    position: relative;
<<<<<<< HEAD
    padding: 15px 0;
=======
    padding: 20px 0;
>>>>>>> fb5c60a2 (evening updates)
    display: flex;
    flex-direction: column;
    align-items: center;
}
.v-testimonial-slider {
    width: 100%;
}
.v-testimonial-slider .swiper-wrapper {
    display: flex;
    align-items: stretch;
}
.v-testimonial-slider .swiper-slide {
    height: auto;
    display: flex;
    align-items: stretch;
}
.v-testimonial-slider .swiper-slide > div {
    width: 100%;
    display: flex;
    height: 100%;
}
.testimonials-v {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 30px 20px;
    background: #e7f2f9;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    /* min-height: 400px; */
    height: 100%;
    width: 100%;
    justify-content: flex-start;
}
.testimonials-v:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.twm-testi-media {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
    flex-shrink: 0;
}
.twm-testi-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #e2e8f0;
}
.testimonial-v-content {
    width: 100%;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 0;
}
.t-testimonial-top {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
    flex-shrink: 0;
}
.t-quote {
    font-size: 32px;
    color: #3b82f6;
    opacity: 0.3;
}
.t-rating {
    display: flex;
    gap: 3px;
    justify-content: center;
    margin-bottom: 10px;
    flex-shrink: 0;
}
.t-rating span {
    color: #fbbf24;
    font-size: 16px;
}
.t-discription {
    font-size: 15px;
    line-height: 1.6;
    color: #475569;
    margin-bottom: 20px;
    flex: 1;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    min-height: 0;
}
.twm-testi-detail {
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #e2e8f0;
    flex-shrink: 0;
}
.twm-testi-name {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
}
.twm-testi-position {
    font-size: 14px;
    color: #64748b;
}
/* .v-testimonial-slider {
    padding-bottom: 40px;
} */
.v-testimonial-slider .swiper-pagination {
    position: relative !important;
    bottom: auto !important;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    width: 100% !important;
    margin-top: 2rem !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 8px !important;
    flex-direction: row !important;
    transform: none !important;
}
.v-testimonial-slider .swiper-pagination-bullet {
    width: 10px !important;
    height: 10px !important;
    background: #cbd5e1 !important;
    opacity: 1 !important;
    margin: 0 !important;
    display: inline-block !important;
    border-radius: 50% !important;
}
.v-testimonial-slider .swiper-pagination-bullet-active {
    background: #3b82f6 !important;
}
@media (max-width: 768px) {
    .twm-testimonial-v-area {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }
    .testimonials-v {
        padding: 20px 15px;
        min-height: 350px;
    }
    .twm-testi-media {
        width: 70px;
        height: 70px;
        margin-bottom: 15px;
    }
    .t-discription {
        font-size: 14px;
        -webkit-line-clamp: 3;
    }
}
</style>

<div class="section-full site-bg-white twm-testimonial-v-area">
    <div class="container">
        <div class="section-content">
            <div class="twm-testimonial-v-section">
                <div class="testimonial-wrapper">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <div class="section-head left wt-small-separator-outer">
                                    <?php if($title = $shortcode->title): ?>
                                        <div class="wt-small-separator site-text-primary">
                                            <div><?php echo BaseHelper::clean($title); ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($subtitle = $shortcode->subtitle): ?>
                                        <h2><?php echo BaseHelper::clean($subtitle); ?></h2>
                                    <?php endif; ?>
                                    <?php if($description = $shortcode->description): ?>
                                        <p><?php echo BaseHelper::clean($description); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if($shortcode->link || $shortcode->text_link): ?>
                                    <div class="twm-read-more">
                                        <a href="<?php echo e($shortcode->link ?: '#'); ?>" class="site-button"><?php echo e($shortcode->text_link ?: __('Show All Quotes')); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="v-testimonial-wrap">
                            <?php if($iconImage = $shortcode->icon_image): ?>
                                <div class="v-testi-dotted-pic">
                                    <img src="<?php echo e(RvMedia::getImageUrl($iconImage)); ?>" alt="<?php echo e(__('Testimonial')); ?>">
                                </div>
                            <?php endif; ?>
                            <div class="swiper-container v-testimonial-slider">
                                <div class="swiper-wrapper">
                                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide">
                                        <div class="testimonials-v">
                                            <div class="twm-testi-media">
                                                <img src="<?php echo e(RvMedia::getImageUrl($testimonial->image)); ?>" alt="<?php echo e($testimonial->name); ?>">
                                            </div>
                                            <div class="testimonial-v-content">
                                                <div class="t-testimonial-top">
                                                    <div class="t-quote"></div>
                                                </div>

                                                <div class="t-discription"><?php echo BaseHelper::clean($testimonial->content); ?></div>

                                                <div class="twm-testi-detail">
                                                    <div class="t-rating">
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                    </div>
                                                    <div class="twm-testi-name"><?php echo e($testimonial->name); ?></div>
                                                    <div class="twm-testi-position"><?php echo e($testimonial->company); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/testimonials/style-3.blade.php ENDPATH**/ ?>