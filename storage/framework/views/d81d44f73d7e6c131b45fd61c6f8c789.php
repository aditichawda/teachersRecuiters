<?php
    use Botble\Base\Facades\BaseHelper;
    use Botble\Slug\Facades\SlugHelper;
    
    $bgColor = $shortcode->bg_color ?? '#E8F4F8';
?>

<!-- JOBS BY CATEGORIES SECTION START -->
<div class="section-full pt-2 pb-2 site-bg-light" style="background-color: <?php echo e($bgColor); ?>;">
    <div class="container">
        <?php if($shortcode->title || $shortcode->subtitle): ?>
            <div class="section-head center wt-small-separator-outer text-center">
                <?php if($shortcode->title): ?>
                    <div class="wt-small-separator site-text-primary">
                        <div><?php echo BaseHelper::clean($shortcode->title); ?></div>
                    </div>
                <?php endif; ?>
                <?php if($shortcode->subtitle): ?>
                    <h2 class="wt-title"><?php echo BaseHelper::clean($shortcode->subtitle); ?></h2>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row" style="padding: 0 4rem;">
            <!-- Jobs by Location -->
            <div class="col-lg-3 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-map-pin" style="color: #1967D2; margin-right: 8px;"></i>
                            <?php echo e(__('Jobs by Location')); ?>

                        </h4>
                    </div>
                    <?php if($locations->isNotEmpty()): ?>
                        <ul class="jobs-category-list">
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('public.jobs-by-city', $location->slug)); ?>" class="jobs-category-link">
                                        <?php echo e(__('Teacher Jobs in :location', ['location' => $location->name])); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted"><?php echo e(__('No locations available')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Jobs by Job Role -->
            <div class="col-lg-3 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-briefcase" style="color: #1967D2; margin-right: 8px;"></i>
                            <?php echo e(__('Jobs by Designation')); ?>

                        </h4>
                    </div>
                    <?php if($jobRoles->isNotEmpty()): ?>
                        <ul class="jobs-category-list auto-scroll-list" id="jobs-by-designation-list">
                            <?php $__currentLoopData = $jobRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($role->url); ?>" class="jobs-category-link">
                                        <?php echo e($role->name); ?> <?php echo e(__('Jobs')); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted"><?php echo e(__('No job roles available')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Jobs by Teaching Subject -->
            <div class="col-lg-3 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-book" style="color: #1967D2; margin-right: 8px;"></i>
                            <?php echo e(__('Jobs by Teaching Subject')); ?>

                        </h4>
                    </div>
                    <?php if($teachingSubjects->isNotEmpty()): ?>
                        <ul class="jobs-category-list auto-scroll-list" id="jobs-by-teaching-subject-list">
                            <?php $__currentLoopData = $teachingSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($subject->url); ?>" class="jobs-category-link">
                                        <?php echo e($subject->name); ?> <?php echo e(__('Teacher Jobs')); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted"><?php echo e(__('No teaching subjects available')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Jobs by Institution Type -->
            <div class="col-lg-3 col-md-6 col-sm-12 m-b30">
                <div class="jobs-category-box">
                    <div class="jobs-category-header">
                        <h4 class="jobs-category-title">
                            <i class="feather-building" style="color: #1967D2; margin-right: 8px;"></i>
                            <?php echo e(__('Jobs by Institution Type')); ?>

                        </h4>
                    </div>
                    <?php if($institutionTypes->isNotEmpty()): ?>
                        <ul class="jobs-category-list auto-scroll-list" id="jobs-by-institution-type-list">
                            <?php $__currentLoopData = $institutionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($institution->url); ?>" class="jobs-category-link">
                                        <?php echo e($institution->name); ?> <?php echo e(__('Jobs')); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted"><?php echo e(__('No institution types available')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JOBS BY CATEGORIES SECTION END -->

<style>
/* Section Container - Keep content within blue background */
.section-full.site-bg-light {
    overflow: hidden;
    position: relative;
}

.section-full.site-bg-light .container {
    max-width: 100%;
    padding-left: 15px;
    padding-right: 15px;
    overflow: hidden;
}

.section-full.site-bg-light .row {
    margin-left: -15px;
    margin-right: -15px;
    overflow: hidden;
}

.section-full.site-bg-light .row > [class*="col-"] {
    padding-left: 15px;
    padding-right: 15px;
}

.jobs-category-box {
    background: #ffffff;
    border-radius: 8px;
    padding: 30px;
    height: 100%;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    max-width: 100%;
    box-sizing: border-box;
}

.jobs-category-header {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #E8F4F8;
}

.jobs-category-title {
    font-size: 20px;
    font-weight: 600;
    color: #1A1A1A;
    margin: 0;
    display: flex;
    align-items: center;
}

.jobs-category-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 240px;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 12px;
    width: 100%;
    box-sizing: border-box;
    position: relative;
}

.jobs-category-list::-webkit-scrollbar {
    width: 6px;
}

.jobs-category-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.jobs-category-list::-webkit-scrollbar-thumb {
    background: #1967D2;
    border-radius: 10px;
}

.jobs-category-list::-webkit-scrollbar-thumb:hover {
    background: #1557b8;
}

.jobs-category-list li {
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #F0F0F0;
    position: relative;
    z-index: 1;
    clear: both;
    display: block;
    width: 100%;
}

.jobs-category-list li:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.jobs-category-link {
    color: #1A1A1A;
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
    display: block;
    position: relative;
    padding: 4px 0;
    padding-left: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
    line-height: 1.5;
    z-index: 2;
}

.jobs-category-link:hover {
    color: #1967D2;
    text-decoration: underline;
    padding-left: 8px;
}

.jobs-category-link::before {
    content: '';
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 2px;
    background-color: #1967D2;
    transition: width 0.3s ease;
}

.jobs-category-link:hover::before {
    width: 4px;
}

@media (max-width: 768px) {
    .jobs-category-box {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .jobs-category-title {
        font-size: 18px;
    }
    
    .jobs-category-link {
        font-size: 14px;
    }
}

/* Auto-scroll styles */
.auto-scroll-list {
    scroll-behavior: smooth;
    position: relative;
}

.auto-scroll-list.paused {
    scroll-behavior: auto;
}

/* Prevent text overlay during scroll */
.auto-scroll-list li {
    min-height: 40px;
    display: flex;
    align-items: center;
}

.auto-scroll-list .jobs-category-link {
    width: 100%;
    display: block;
    white-space: normal;
    overflow: visible;
}
</style>

<script>
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAutoScroll);
    } else {
        initAutoScroll();
    }
    
    function initAutoScroll() {
        // Get all three scroll lists
        const designationList = document.getElementById('jobs-by-designation-list');
        const teachingSubjectList = document.getElementById('jobs-by-teaching-subject-list');
        const institutionTypeList = document.getElementById('jobs-by-institution-type-list');
        
        // Scroll speed (pixels per scroll) - slow for readability
        const scrollSpeed = 0.4;
        // Scroll interval (milliseconds) - slower interval for smooth reading
        const scrollInterval = 60;
        
        // Function to auto-scroll a list
        function autoScrollList(listElement, listId, startDelay) {
            if (!listElement) return;
            
            // Check if content actually overflows
            const maxScroll = listElement.scrollHeight - listElement.clientHeight;
            if (maxScroll <= 0) return; // No need to scroll if content fits
            
            let scrollPosition = 0;
            let isScrolling = true;
            let scrollDirection = 1; // 1 for down, -1 for up
            let scrollIntervalId = null;
            let pauseAtEnd = false;
            
            // Pause on hover
            listElement.addEventListener('mouseenter', function() {
                isScrolling = false;
                listElement.classList.add('paused');
            });
            
            listElement.addEventListener('mouseleave', function() {
                isScrolling = true;
                listElement.classList.remove('paused');
            });
            
            // Auto-scroll function
            function scroll() {
                if (!isScrolling || maxScroll <= 0) return;
                
                // If paused at end, wait before continuing
                if (pauseAtEnd) {
                    pauseAtEnd = false;
                    return;
                }
                
                scrollPosition += scrollSpeed * scrollDirection;
                
                // Reverse direction when reaching top or bottom
                if (scrollPosition >= maxScroll) {
                    scrollPosition = maxScroll;
                    scrollDirection = -1;
                    pauseAtEnd = true;
                    // Wait 2 seconds at bottom before reversing
                    setTimeout(function() {
                        pauseAtEnd = false;
                    }, 2000);
                } else if (scrollPosition <= 0) {
                    scrollPosition = 0;
                    scrollDirection = 1;
                    pauseAtEnd = true;
                    // Wait 2 seconds at top before reversing
                    setTimeout(function() {
                        pauseAtEnd = false;
                    }, 2000);
                }
                
                listElement.scrollTop = scrollPosition;
            }
            
            // Start scrolling after a delay (let page load first) + individual delay for each list
            setTimeout(function() {
                scrollIntervalId = setInterval(scroll, scrollInterval);
            }, 1500 + (startDelay || 0));
        }
        
        // Initialize auto-scroll for each list separately with different start delays
        // This makes them scroll independently and not in sync
        autoScrollList(designationList, 'designation', 0);
        autoScrollList(teachingSubjectList, 'teaching-subject', 600);
        autoScrollList(institutionTypeList, 'institution-type', 1200);
    }
})();
</script><?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/shortcodes/jobs-by-categories/index.blade.php ENDPATH**/ ?>