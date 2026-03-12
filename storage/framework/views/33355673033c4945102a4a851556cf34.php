<?php
    use Botble\Base\Facades\BaseHelper;
    use Botble\JobBoard\Facades\JobBoardHelper;
    use Botble\Slug\Facades\SlugHelper;
    use Botble\JobBoard\Models\Company;
?>

<?php echo Theme::partial('company-card-styles'); ?>


<!-- Featured Schools SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-featured-schools-wrap" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
    <div class="container">
        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row">
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                    <!-- TITLE START-->
                    <div class="section-head left wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                            <div><?php echo BaseHelper::clean($shortcode->title ?: __('Featured Schools')); ?></div>
                        </div>
                        <h2 class="wt-title" style="color: #1e293b; font-weight: 700;"><?php echo BaseHelper::clean($shortcode->subtitle ?: __('Top Educational Institutions')); ?></h2>
                    </div>
                    <!-- TITLE END-->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                    <a href="<?php echo e(url(SlugHelper::getPrefix(Company::class, 'companies'))); ?>" class="site-button" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%); border: none; color: #fff; padding: 12px 28px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;"><?php echo BaseHelper::clean($shortcode->button_name ?: __('View All Schools')); ?></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="twm-featured-schools-content">
        <div class="container">
            <div class="section-content">
                <?php if($companies->count() > 0): ?>
                    <div class="owl-carousel featured-schools-carousel owl-btn-vertical-center">
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="company-card-grid">
                                    <?php if($company->is_featured): ?>
                                        <span class="ccg-featured">★ <?php echo e(__('Featured')); ?></span>
                                    <?php endif; ?>
                                    <?php if($company->is_verified): ?>
                                        <span class="ccg-verified"><i class="fas fa-check-circle"></i> <?php echo e(__('Verified')); ?></span>
                                    <?php endif; ?>

                                    
                                    <div class="ccg-top">
                                        <div class="ccg-logo">
                                            <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($company->name); ?>">
                                        </div>
                                        <a href="<?php echo e($company->url); ?>" class="ccg-name">
                                            <?php echo BaseHelper::clean($company->name); ?>

                                        </a>
                                        <?php if($company->institution_type): ?>
                                            <span class="ccg-type"><?php echo e($company->institution_type); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    
                                    <div class="ccg-body">
                                        <?php if($company->description): ?>
                                            <p class="ccg-desc"><?php echo e(Str::limit(strip_tags($company->description), 90)); ?></p>
                                        <?php endif; ?>

                                        <div class="ccg-details">
                                            <?php if($company->address || $company->state_name): ?>
                                                <div class="ccg-detail">
                                                    <i class="feather-map-pin"></i>
                                                    <span><?php echo e(Str::limit($company->address ?: ($company->state->name ?? '') . ', ' . ($company->country->code ?? ''), 30)); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($company->year_founded): ?>
                                                <div class="ccg-detail">
                                                    <i class="feather-calendar"></i>
                                                    <span><?php echo e(__('Est. :year', ['year' => $company->year_founded])); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($company->number_of_employees || $company->total_staff): ?>
                                                <div class="ccg-detail">
                                                    <i class="feather-users"></i>
                                                    <span><?php echo e($company->total_staff ?: $company->number_of_employees); ?> <?php echo e(__('Employees')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($company->phone): ?>
                                                <div class="ccg-detail">
                                                    <i class="feather-phone"></i>
                                                    <span><?php echo e($company->phone); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    
                                    <div class="ccg-footer">
                                        <span class="ccg-jobs-count">
                                            <?php echo Theme::partial('job-count', compact('company')); ?>

                                        </span>
                                        <a href="<?php echo e($company->url); ?>" class="ccg-view-btn"><?php echo e(__('View')); ?> →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="no-schools-message" style="text-align: center; padding: 60px 20px; color: #64748b;">
                        <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5; display: block;"></i>
                        <h4 style="color: #334155; margin-bottom: 10px;"><?php echo e(__('No schools available currently')); ?></h4>
                        <p style="color: #94a3b8; font-size: 14px;"><?php echo e(__('Please try another category or check back later.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <style>
    /* Featured Schools Section - Enhanced Blue/White Theme with Carousel */
    .twm-featured-schools-wrap {
        position: relative;
    }
    
    .twm-featured-schools-wrap::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e0f2fe, transparent);
    }
    
    .twm-featured-schools-content {
        overflow: hidden;
        position: relative;
        padding: 40px 0 60px;
    }
    
    /* Owl Carousel Customization for Featured Schools */
    .featured-schools-carousel {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        min-height: 400px;
        position: relative;
    }
    
    /* Show items before carousel initializes */
    .featured-schools-carousel:not(.owl-loaded) {
        display: flex !important;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: center;
        padding: 0 15px;
        overflow: hidden;
    }
    
    .featured-schools-carousel:not(.owl-loaded) .item {
        flex: 0 0 calc(33.333% - 16px);
        max-width: calc(33.333% - 16px);
        min-width: 320px;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    @media (max-width: 991px) {
        .featured-schools-carousel:not(.owl-loaded) .item {
            flex: 0 0 calc(50% - 12px);
            max-width: calc(50% - 12px);
        }
    }
    
    @media (max-width: 768px) {
        .featured-schools-carousel:not(.owl-loaded) .item {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    
    /* Hide overflow to prevent partial cards from showing */
    .featured-schools-carousel .owl-stage-outer {
        overflow: hidden !important;
        padding: 0 0;
    }
    
    .featured-schools-carousel .owl-stage {
        display: flex;
        align-items: stretch;
    }
    
    .featured-schools-carousel .owl-item {
        padding: 0 12px;
        display: flex;
    }
    
    .featured-schools-carousel .item {
        height: 100%;
        width: 100%;
    }
    
    .featured-schools-carousel .company-card-grid {
        height: 100%;
        min-height: 420px;
        margin-bottom: 0;
        box-shadow: 0 4px 20px rgba(0, 115, 209, 0.08);
        transition: all 0.3s ease;
        width: 100%;
    }
    
    @media (max-width: 991px) {
        .featured-schools-carousel .company-card-grid {
            min-height: 400px;
        }
    }
    
    @media (max-width: 768px) {
        .featured-schools-carousel .company-card-grid {
            min-height: 380px;
        }
    }
    
    /* Ensure container hides partial items but shows buttons */
    .twm-featured-schools-content .section-content {
        overflow: visible !important;
        position: relative;
        width: 100%;
    }
    
    .twm-featured-schools-content .container {
        overflow: visible !important;
        position: relative;
        max-width: 100%;
        padding-left: 80px;
        padding-right: 80px;
    }
    
    @media (max-width: 1200px) {
        .twm-featured-schools-content .container {
            padding-left: 60px;
            padding-right: 60px;
        }
    }
    
    @media (max-width: 991px) {
        .twm-featured-schools-content .container {
            padding-left: 50px;
            padding-right: 50px;
        }
    }
    
    @media (max-width: 768px) {
        .twm-featured-schools-content .container {
            padding-left: 40px;
            padding-right: 40px;
        }
    }
    
    @media (max-width: 576px) {
        .twm-featured-schools-content .container {
            padding-left: 35px;
            padding-right: 35px;
        }
    }
    
    /* Center the carousel and hide side items */
    .featured-schools-carousel.owl-loaded {
        max-width: 100%;
        margin: 0 auto;
        position: relative;
    }
    
    .featured-schools-carousel .owl-stage-outer {
        overflow: hidden !important;
    }
    
    /* Ensure items outside viewport are hidden */
    .featured-schools-carousel .owl-item {
        opacity: 1;
    }
    
    .featured-schools-carousel .company-card-grid:hover {
        box-shadow: 0 8px 30px rgba(0, 115, 209, 0.15);
        transform: translateY(-4px);
    }
    
    /* Navigation Buttons Styling */
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav {
        margin: 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        pointer-events: none;
        z-index: 20;
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button {
        pointer-events: all;
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev,
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #c1d7ea 0%, #5fb0ff 50%, #052d7f 100%);
        color: #fff;
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 15px rgba(0, 115, 209, 0.3);
        transition: all 0.3s ease;
        z-index: 21;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev {
        left: -60px;
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
        right: -60px;
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev:hover,
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next:hover {
        background: linear-gradient(135deg, #005bb5 0%, #004a94 50%, #003d7a 100%);
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 115, 209, 0.4);
    }
    
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev.disabled,
    .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next.disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    
    /* Enhanced Button Styling */
    .twm-featured-schools-wrap .site-button:hover {
        background: linear-gradient(135deg, #005bb5 0%, #004a94 50%, #003d7a 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 115, 209, 0.3);
    }
    
    /* Section Title Enhancement */
    .twm-featured-schools-wrap .wt-title {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    @media (max-width: 1200px) {
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev {
            left: -40px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            right: -40px;
        }
    }
    
    @media (max-width: 991px) {
        .twm-featured-schools-content {
            padding: 30px 0 50px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev {
            left: -30px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            right: -30px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev,
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }
    }
    
    @media (max-width: 768px) {
        .twm-featured-schools-content {
            padding: 30px 0 40px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev {
            left: -20px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            right: -20px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev,
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            width: 38px;
            height: 38px;
            font-size: 16px;
        }
    }
    
    @media (max-width: 576px) {
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev {
            left: -15px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            right: -15px;
        }
        
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-prev,
        .featured-schools-carousel.owl-btn-vertical-center .owl-nav button.owl-next {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
    }
    </style>
    
    <script>
    (function() {
        function initFeaturedSchoolsCarousel() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initFeaturedSchoolsCarousel, 100);
                return;
            }
            
            var $carousel = jQuery('.featured-schools-carousel');
            if ($carousel.length) {
                // Check if already initialized
                if ($carousel.hasClass('owl-loaded')) {
                    return;
                }
                
                // Check if owlCarousel is available
                if (typeof jQuery.fn.owlCarousel === 'undefined') {
                    setTimeout(initFeaturedSchoolsCarousel, 200);
                    return;
                }
                
                // Initialize carousel
                try {
                    $carousel.owlCarousel({
                        loop: $carousel.find('.item').length > 3,
                        margin: 24,
                        nav: true,
                        dots: false,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        autoplayHoverPause: true,
                        stagePadding: 0,
                        responsive: {
                            0: {
                                items: 1,
                                loop: $carousel.find('.item').length > 1,
                                stagePadding: 0
                            },
                            576: {
                                items: 1,
                                loop: $carousel.find('.item').length > 1,
                                stagePadding: 0
                            },
                            768: {
                                items: 2,
                                loop: $carousel.find('.item').length > 2,
                                stagePadding: 0
                            },
                            992: {
                                items: 3,
                                loop: $carousel.find('.item').length > 3,
                                stagePadding: 0
                            },
                            1200: {
                                items: 3,
                                loop: $carousel.find('.item').length > 3,
                                stagePadding: 0
                            }
                        },
                        navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
                    });
                } catch(e) {
                    console.error('Error initializing featured schools carousel:', e);
                }
            }
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initFeaturedSchoolsCarousel, 300);
            });
        } else {
            setTimeout(initFeaturedSchoolsCarousel, 300);
        }
        
        // Also try with jQuery
        if (typeof jQuery !== 'undefined') {
            jQuery(document).ready(function() {
                setTimeout(initFeaturedSchoolsCarousel, 300);
            });
            jQuery(window).on('load', function() {
                setTimeout(initFeaturedSchoolsCarousel, 100);
            });
        }
    })();
    </script>
</div>
<!-- Featured Schools SECTION END -->
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/shortcodes/featured-schools/index.blade.php ENDPATH**/ ?>