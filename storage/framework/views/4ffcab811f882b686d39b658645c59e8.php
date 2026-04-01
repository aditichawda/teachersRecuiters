<!-- Recommended Jobs SECTION START -->
<div class="section-full p-t120 p-b90 site-bg-white twm-recommended-Jobs-wrap7">
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
                <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                    <a href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" class="site-button"><?php echo BaseHelper::clean($shortcode->button_name); ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="twm-recommended-Jobs-mid-wrap">
        <div class="twm-recommended-Jobs-mid">
            <div class="container">
                <div class="filter-carousal">
                    <!-- Filter Menu -->
                    <!-- <div class="twm-jobs-filter">
                        <ul class="btn-filter-wrap">
                            <li class="btn-filter btn-active" data-filter="*"><?php echo e(__('All')); ?></li>
                            <?php $__currentLoopData = $jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="btn-filter" data-filter=".<?php echo e($type->id); ?>"><?php echo e($type->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div> -->
                    <!-- Filter Menu -->
                   
                    <!-- IMAGE CAROUSEL START -->
                    <div class="section-content ">
                        <div class="owl-carousel owl-carousel-filter mfp-gallery owl-btn-vertical-center">
                            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item <?php if($job->jobTypes): ?> <?php $__currentLoopData = $job->jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($jobType->id); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>">
                                    <div class="hpage-7-featured-block">
                                        <div class="inner-content">
                                            <div class="top-content-wrap">
                                                <div class="top-content">
                                                    <span class="job-time"><?php if($job->jobTypes): ?> <?php $__currentLoopData = $job->jobTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($jobType->name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?></span>
                                                    <span class="job-post-time"><?php echo e($job->created_at->diffForHumans()); ?></span>
                                                </div>
                                                <div class="mid-content">
                                                    <div class="company-logo">
                                                        <img src="<?php echo e($job->company->logo_thumb); ?>" alt="<?php echo e($job->company_name); ?>">
                                                    </div>
                                                    <div class="company-info">
                                                        <a href="<?php echo e($job->company_url); ?>" class="company-name"><?php echo e($job->company_name); ?></a>
                                                        <?php
                                                            $cityName = $job->city_name ?: optional($job->city)->name;
                                                            $displayLocation = $job->location ?: 'India';
                                                            if ($cityName && !\Illuminate\Support\Str::contains($displayLocation, $cityName)) {
                                                                $displayLocation = $cityName . ', ' . $displayLocation;
                                                            }
                                                        ?>
                                                        <p class="company-address"><i class="feather-map-pin"></i> <?php echo e($displayLocation); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bottom-content">
                                                <a href="<?php echo e($job->url); ?>">
                                                    <h4 class="job-name-title" title="<?php echo e($job->name); ?>"><?php echo e(Str::limit($job->name,30)); ?></h4>
                                                </a>
                                                <div class="job-payment">
                                                    <?php echo e(JobBoardHelper::isSalaryHiddenForGuests() ? __('Sign in to view salary') : $job->salary_text); ?>

                                                </div>
                                            </div>
                                            <div class="aply-btn-area">
                                                <a href="<?php echo e($job->url); ?>" class="aplybtn">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <!-- No Jobs Available Message -->
                        <div class="no-jobs-message" style="display: none; text-align: center; padding: 60px 20px; color: #64748b;">
                            <i class="feather-briefcase" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                            <h4 style="color: #334155; margin-bottom: 10px;"><?php echo e(__('No jobs available currently')); ?></h4>
                            <p style="color: #94a3b8; font-size: 14px;"><?php echo e(__('Please try another category or check back later.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recommended Jobs SECTION END -->

<script>
// Initialize no jobs message check on page load
$(document).ready(function() {
    const $carousel = $('.owl-carousel-filter');
    if ($carousel.length) {
        const $sectionContent = $carousel.closest('.section-content');
        const $noJobsMessage = $sectionContent.find('.no-jobs-message');
        
        // Check initial state - if no jobs at all
        setTimeout(function() {
            const totalItems = $carousel.find('.item').length;
            if (totalItems === 0) {
                $carousel.hide();
                $noJobsMessage.show();
            }
        }, 500);
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/recommend/index.blade.php ENDPATH**/ ?>