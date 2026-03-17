<?php
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Facades\JobBoardHelper;
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    use Botble\JobBoard\Models\UserNotification;
    use Illuminate\Support\Facades\Schema;
    
    // Get unread notification count
    $notificationCount = 0;
    if (auth('account')->check()) {
        try {
            if (Schema::hasTable('jb_user_notifications')) {
                $notificationCount = UserNotification::where('account_id', auth('account')->id())
                    ->whereNull('read_at')
                    ->count();
            }
        } catch (\Exception $e) {
            // Silently fail
        }
    }
    
    // Format count: show "9+" if more than 9
    $notificationBadge = $notificationCount > 9 ? '9+' : ($notificationCount > 0 ? $notificationCount : '');
    
    // Get featured categories with job counts
    $featuredCategories = collect();
    try {
        if (is_plugin_active('job-board')) {
            $featuredCategories = app(CategoryInterface::class)->getFeaturedCategories(6);
        }
    } catch (\Exception $e) {
        // Silently fail if there's an error
        $featuredCategories = collect();
    }
    
    // Get locations (cities) with job counts
    $topLocations = collect();
    try {
        if (is_plugin_active('location') && is_plugin_active('job-board')) {
            $topLocations = \Botble\Location\Models\City::query()
                ->where('status', BaseStatusEnum::PUBLISHED)
                ->select('cities.*')
                ->selectRaw('COUNT(DISTINCT jb_jobs.id) as jobs_count')
                ->leftJoin('jb_jobs', function($join) {
                    $join->on('jb_jobs.city_id', '=', 'cities.id')
                        ->where('jb_jobs.status', \Botble\JobBoard\Enums\JobStatusEnum::PUBLISHED)
                        ->where('jb_jobs.expire_date', '>=', now());
                })
                ->groupBy('cities.id')
                ->having('jobs_count', '>', 0)
                ->orderBy('jobs_count', 'desc')
                ->limit(6)
                ->get();
        }
    } catch (\Exception $e) {
        // Silently fail if there's an error
        $topLocations = collect();
    }
    
    // Get institution types (categories with parent_id = 0 or specific parent)
    $institutionTypes = collect();
    try {
        if (is_plugin_active('job-board')) {
            $institutionTypes = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'parent_id' => 0, // Root categories - adjust parent_id as needed
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'take' => 6,
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);
        }
    } catch (\Exception $e) {
        // Silently fail if there's an error
        $institutionTypes = collect();
    }
?>

<header class="site-header <?php echo e(Theme::get('header_css_class') ?: 'header-style-3'); ?> mobile-sider-drawer-menu">
    <?php echo Theme::partial('header-top'); ?>

    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar">
            <div class="container-fluid clearfix">
               <?php if(Theme::getLogo()): ?>
                    <div class="logo-header">
                        <div class="logo-header-inner logo-header-one">
                            <a href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">
                                <?php if(Theme::get('header_css_class') == 'header-style-light'): ?>
                                    <?php echo Theme::getLogoImage(['class' => 'default-scroll-show'], 'logo_light', 44) ?: Theme::getLogoImage(['class' => 'default-scroll-show'], 'logo', 44); ?>

                                    <?php echo Theme::getLogoImage(['class' => 'on-scroll-show'], 'logo_light', 44); ?>

                                <?php else: ?>
                                    <?php echo Theme::getLogoImage([], 'logo_light', 44); ?>

                                <?php endif; ?>

                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" type="button"
                    class="navbar-toggler collapsed mobile-menu-toggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span class="sr-only"><?php echo e(__('Toggle navigation')); ?></span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>

                <!-- MAIN Nav -->
                <div class="nav-animation header-nav navbar-collapse d-flex justify-content-end" id="main-navbar-menu">
                    <!-- Mobile Menu Close Button -->
                    <button
                        type="button"
                        class="mobile-menu-close"
                        id="mobile-menu-close-btn"
                        aria-label="Close menu"
                        style="display: none;"
                        onclick="var t = document.getElementById('mobile-side-drawer'); if (t) { t.click(); }">
                        <i class="feather-x"></i>
                    </button>
                    <ul class="nav navbar-nav">
                        <?php
                            $isJobSeeker = auth('account')->check() && auth('account')->user()->isJobSeeker();
                            $isEmployer = auth('account')->check() && auth('account')->user()->isEmployer();
                        ?>

                        <!-- Home Icon - Visible for All Users -->
                        <li class="nav-item">
                            <a class="nav-link" style="color: black; font-size: 20px !important; padding: 8px 12px;" href="<?php echo e(BaseHelper::getHomepageUrl()); ?>" title="<?php echo e(__('Home')); ?>">
                                <i class="feather-home" style="font-size: 20px !important;"></i>
                                <span><?php echo e(__('Home')); ?></span>
                            </a>
                        </li>

                        <?php if($isJobSeeker): ?>
                            <!-- Job Seeker Menu -->
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>">
                                    <span><?php echo e(__('Jobs')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(JobBoardHelper::getJobcompaniesPageURL()); ?>">
                                    <span><?php echo e(__('Schools/Institutions')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.faq')); ?>">
                                    <span><?php echo e(__('FAQ')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.premium-service')); ?>">
                                    <span><?php echo e(__('Premium Service')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item" style="position: relative;">
                                <a class="nav-link" style="color: black; font-size: 20px; !important" href="<?php echo e(route('public.notifications')); ?>" title="<?php echo e(__('Notifications')); ?>">
                                    
                                    <i class="feather-bell notification-icon-desktop" style="font-size: 20px !important"></i>

                                    
                                    <span class="notification-text-mobile"><?php echo e(__('Notifications')); ?></span>

                                    <?php if($notificationBadge): ?>
                                        <span class="notification-badge" style="position: absolute; top: 2px; right: 2px; background: #dc3545; color: white; border-radius: 10px; min-width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; line-height: 1; padding: 0 4px; white-space: nowrap;"><?php echo e($notificationBadge); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php elseif($isEmployer): ?>
                            <!-- Employer Menu -->
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.faq')); ?>">
                                    <span><?php echo e(__('FAQ')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.premium-service')); ?>">
                                    <span><?php echo e(__('Plans')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item" style="position: relative;">
                                <a class="nav-link" style="color: black; font-size: 20px; !important" href="<?php echo e(route('public.notifications')); ?>" title="<?php echo e(__('Notifications')); ?>">
                                    <i class="feather-bell" style="font-size: 20px !important"></i>
                                    <?php if($notificationBadge): ?>
                                        <span class="notification-badge" style="position: absolute; top: 2px; right: 2px; background: #dc3545; color: white; border-radius: 10px; min-width: 18px; height: 18px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; line-height: 1; padding: 0 4px; white-space: nowrap;"><?php echo e($notificationBadge); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <!-- Default Menu for Non-logged-in Users Only -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="<?php echo e(url('/')); ?>">
                                <span><?php echo e(__('Home')); ?></span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="<?php echo e(url('/how-it-works')); ?>">
                                <span><?php echo e(__('How it Works')); ?></span>
                            </a>
                        </li>

                        <!-- Jobs Mega Menu Dropdown -->
                        <li class="nav-item dropdown mega-menu-dropdown" onmouseenter="showMegaMenu()" onmouseleave="hideMegaMenu()">
                            <a class="nav-link dropdown-toggle" style="color: black;" href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" role="button" id="jobs-dropdown" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleMegaMenu(event)">
                                <span><?php echo e(__('Jobs')); ?></span>
                            </a>
                            <div class="dropdown-menu mega-menu" id="jobs-mega-menu" aria-labelledby="jobs-dropdown">
                                <div class="mega-menu-wrapper">
                                    <!-- Tabs Navigation -->
                                    <div class="mega-menu-tabs-wrapper">
                                        <button class="mega-menu-tab-btn active" onclick="switchMegaMenuTab('categories')" data-tab="categories">
                                            <?php echo e(__('JOBS BY CATEGORIES')); ?>

                                            <i class="feather-chevron-down"></i>
                                        </button>
                                        <button class="mega-menu-tab-btn" onclick="switchMegaMenuTab('location')" data-tab="location">
                                            <?php echo e(__('JOBS BY LOCATIONS')); ?>

                                            <i class="feather-chevron-down"></i>
                                        </button>
                                        <button class="mega-menu-tab-btn" onclick="switchMegaMenuTab('institution')" data-tab="institution">
                                            <?php echo e(__('JOBS BY INSTITUTION TYPE')); ?>

                                            <i class="feather-chevron-down"></i>
                                        </button>
                                    </div>

                                    <!-- Tab Content -->
                                    <div class="mega-menu-content-wrapper">
                                        <!-- Jobs by Categories Content -->
                                        <div class="mega-menu-tab-content active" id="content-categories">
                                            <div class="mega-menu-grid">
                                                <?php
                                                    $categories = $featuredCategories->chunk(ceil($featuredCategories->count() / 2));
                                                ?>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mega-menu-column">
                                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e($category->url); ?>" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    <?php if($category->icon): ?>
                                                                        <i class="<?php echo e($category->icon); ?>"></i>
                                                                    <?php else: ?>
                                                                        <i class="feather-briefcase"></i>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name"><?php echo e($category->name); ?></span>
                                                                    <span class="mega-menu-grid-count"><?php echo e(number_format($category->active_jobs_count ?? 0)); ?> Jobs</span>
                                                                </div>
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($featuredCategories->isEmpty()): ?>
                                                    <div class="mega-menu-empty">No categories available</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Jobs by Location Content -->
                                        <div class="mega-menu-tab-content" id="content-location">
                                            <div class="mega-menu-grid">
                                                <?php
                                                    $locations = $topLocations->chunk(ceil($topLocations->count() / 2));
                                                ?>
                                                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mega-menu-column">
                                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e(route('public.jobs-by-city', $location->slug)); ?>" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    <i class="feather-map-pin"></i>
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name">Teacher jobs in <?php echo e($location->name); ?></span>
                                                                </div>
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($topLocations->isEmpty()): ?>
                                                    <div class="mega-menu-empty">No locations available</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Jobs by Institution Type Content -->
                                        <div class="mega-menu-tab-content" id="content-institution">
                                            <div class="mega-menu-grid">
                                                <?php
                                                    $institutions = $institutionTypes->chunk(ceil($institutionTypes->count() / 2));
                                                ?>
                                                <?php $__currentLoopData = $institutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="mega-menu-column">
                                                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e($institution->url); ?>" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    <i class="feather-building"></i>
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name"><?php echo e($institution->name); ?></span>
                                                                    <span class="mega-menu-grid-count"><?php echo e(number_format($institution->active_jobs_count ?? 0)); ?> Jobs</span>
                                                                </div>
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($institutionTypes->isEmpty()): ?>
                                                    <div class="mega-menu-empty">No institution types available</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- For Schools / Start Hiring -->
                                     <li class="nav-item">
                            <a class="nav-link" style="color: black;" href="<?php echo e(url('/start-hiring')); ?>">
                                <span><?php echo e(__('Start Hiring')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if(is_plugin_active('job-board')): ?>
                    <!-- Header Right Section-->
                    <div class="extra-nav header-2-nav">
                        <div class="extra-cell">
                            
                        </div>
                        <div class="extra-cell">
                            <style>
                            /* Fix button alignment */
                            .header-nav-btn-section {
                                display: flex !important;
                                align-items: center !important;
                            }
                            .twm-nav-btn-left,
                            .twm-nav-btn-right {
                                display: flex !important;
                                align-items: center !important;
                            }
                            .twm-nav-sign-up,
                            .twm-nav-post-a-job {
                                display: flex !important;
                                align-items: center !important;
                                vertical-align: middle !important;
                            }
                            .twm-nav-sign-up i,
                            .twm-nav-post-a-job i {
                                display: flex !important;
                                align-items: center !important;
                            }
                            </style>
                            <div class="header-nav-btn-section">
                                <?php if(auth('account')->check() && $account = auth('account')->user()): ?>
                                    <div>
                                        <div class="twm-nav-btn-left dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle" role="button" id="account-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" width="35" height="35" class="rounded-circle me-1">
                                                <span class="d-none d-md-inline-block fw-medium"><?php echo e($account->first_name ?? $account->name); ?></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                                <?php if($account->isEmployer()): ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo e(route('public.account.dashboard')); ?>">
                                                            <i class="feather-home"></i>
                                                            <span><?php echo e(__('Dashboard')); ?></span>
                                                        </a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo e(route('public.account.jobseeker.dashboard')); ?>">
                                                            <i class="feather-home"></i>
                                                            <span><?php echo e(__('Dashboard')); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <?php if($account->isEmployer()): ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('public.account.employer.settings.edit')); ?>">
                                                            <i class="feather-settings"></i>
                                                            <span><?php echo e(__('Account Settings')); ?></span>
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('public.account.settings')); ?>">
                                                            <i class="feather-settings"></i>
                                                            <span><?php echo e(__('Account Settings')); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <?php echo Form::open([
                                                        'route' => 'public.account.logout',
                                                        'id' => 'logout-form']); ?>

                                                        <button type="button" class="dropdown-item" id="logout-btn" onclick="event.preventDefault(); if (confirm('Are you sure you want to logout?')) { var f = document.getElementById('logout-form'); if (f) f.submit(); }">
                                                            <i class="feather-log-out"></i>
                                                            <span><?php echo e(__('Logout')); ?></span>
                                                        </button>
                                                    <?php echo Form::close(); ?>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Login Button -->
                                        <div class="twm-nav-btn-left">
                                            <a class="twm-nav-sign-up" href="<?php echo e(route('public.account.login')); ?>">
                                                <i class="feather-log-in"></i>
                                                <span><?php echo e(__('Login')); ?></span>
                                            </a>
                                        </div>
                                        <!-- Post a Job Button -->
                                        <div class="twm-nav-btn-right">
                                            <a href="<?php echo e(auth('account')->check() ? route('public.account.jobs.create') : route('public.account.register.employer')); ?>" class="twm-nav-post-a-job">
                                                <i class="feather-briefcase"></i>
                                                <span><?php echo e(__('Post a Job')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(is_plugin_active('job-board')): ?>
            <!-- SITE Search -->
            <div id="search">
                <span class="close"></span>
                <form role="search" id="searchform" action="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" method="GET" class="radius-xl">
                    <input class="form-control" value="<?php echo e(request()->input('q')); ?>" name="q" type="search" placeholder="<?php echo e(__('Type to search')); ?>" />
                    <span class="input-group-append">
                        <button type="submit" class="search-btn">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </span>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
</header>

<style>
/* Navbar Fixed Position Fix - Hide on Scroll Up, Show on Scroll Down */
.site-header {
    position: relative;
    z-index: 999;
    width: 100%;
}
.sticky-header {
    position: relative;
    z-index: 999;
    width: 100%;
}
.main-bar {
    position: relative;
    z-index: 999;
    width: 100%;
    background: #fff !important;
    background-color: #fff !important;
    transition: transform 0.3s ease, opacity 0.3s ease;
}
/* Fixed navbar styling */
.is-fixed .main-bar,
.is-fixed .main-bar.color-fill,
.header-fixed .main-bar,
.sticky-wrapper.is-stuck .main-bar,
.sticky-wrapper.is-stuck .sticky-header .main-bar,
.main-bar.color-fill,
.main-bar[class*="bg-"],
.main-bar[style*="background"] {
    position: fixed !important;
    /* top: 40px !important; */
    left: 0 !important;
    right: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
    background: #fff !important;
    background-color: #fff !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}
/* Ensure header-top doesn't interfere */
.is-fixed ~ .page-content,
.header-fixed ~ .page-content {
    margin-top: 0;
}

/* Force white background on navbar in all states */
.main-bar,
.sticky-header .main-bar,
.site-header .main-bar {
    background: #fff !important;
    background-color: #fff !important;
}

/* Override any theme colors or gradients */
.main-bar.color-fill,
.main-bar[class*="bg-"],
.main-bar[style*="background"] {
    background: #fff !important;
    background-color: #fff !important;
    background-image: none !important;
}
/* Mega Menu Styles */
.mega-menu-dropdown {
    position: static !important;
}

.mega-menu-dropdown .dropdown-menu {
    position: absolute !important;
    top: 100% !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    z-index: 1050 !important;
}

.mega-menu {
    width: 100%;
    max-width: 900px;
    left: 50% !important;
    transform: translateX(-50%);
    margin-top: 0;
    padding: 0 !important;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border-radius: 12px;
    position: absolute !important;
    top: 100% !important;
    z-index: 1050 !important;
    background: #fff !important;
    overflow: hidden;
}

.mega-menu .container-fluid {
    padding: 0;
}

/* Tabs Styling */
.mega-menu-wrapper {
    padding: 0;
}

.mega-menu-tabs-wrapper {
    display: flex;
    gap: 10px;
    padding: 15px 20px;
    border-bottom: 1px solid #E8F4F8;
    background: #F8F9FA;
}

.mega-menu-tab-btn {
    background: transparent;
    border: none;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.mega-menu-tab-btn i {
    font-size: 12px;
    transition: transform 0.3s ease;
}

.mega-menu-tab-btn:hover {
    background: #E8F4F8;
    color: #1967D2;
}

.mega-menu-tab-btn.active {
    background: #1967D2;
    color: #fff;
}

.mega-menu-tab-btn.active i {
    transform: rotate(180deg);
}

.mega-menu-content-wrapper {
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
}

/* Grid Layout for Content */
.mega-menu-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.mega-menu-column {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.mega-menu-grid-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #F8F9FA;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.mega-menu-grid-item:hover {
    background: #E8F4F8;
    border-color: #1967D2;
    transform: translateX(3px);
    text-decoration: none;
}

.mega-menu-grid-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 8px;
    flex-shrink: 0;
}

.mega-menu-grid-icon i {
    font-size: 20px;
    color: #FF6B35;
}

.mega-menu-grid-text {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.mega-menu-grid-name {
    font-size: 14px;
    font-weight: 500;
    color: #1A1A1A;
    margin-bottom: 4px;
}

.mega-menu-grid-count {
    font-size: 12px;
    color: #666;
    font-weight: 400;
}

.mega-menu-tab-content {
    display: none;
}

.mega-menu-tab-content.active {
    display: block;
}

.mega-menu-empty {
    text-align: center;
    padding: 40px 20px;
    color: #999;
    font-size: 14px;
}

.mega-menu-section {
    padding: 0;
}

.mega-menu-title {
    font-size: 18px;
    font-weight: 600;
    color: #1A1A1A;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #E8F4F8;
    display: flex;
    align-items: center;
}

.mega-menu-title i {
    color: #1967D2;
    font-size: 20px;
}

.mega-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mega-menu-list {
    max-height: 320px;
    overflow-y: auto;
}

.mega-menu-list li {
    margin-bottom: 10px;
}

.mega-menu-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: #F8F9FA;
}

.mega-menu-item:hover {
    background: #E8F4F8;
    transform: translateX(5px);
    text-decoration: none;
}

.mega-menu-item-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    border-radius: 8px;
    margin-right: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.mega-menu-item-icon i {
    font-size: 18px;
    color: #1967D2;
}

.mega-menu-item-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.mega-menu-item-name {
    font-size: 15px;
    font-weight: 500;
    color: #1A1A1A;
    margin-bottom: 4px;
}

.mega-menu-item-count {
    font-size: 13px;
    color: #666;
    font-weight: 400;
}

.mega-menu-view-all {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #E8F4F8;
}

.mega-menu-view-all-link {
    color: #1967D2;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.mega-menu-view-all-link:hover {
    color: #0d4a9e;
    text-decoration: none;
}

.mega-menu-view-all-link i {
    transition: transform 0.3s ease;
}

.mega-menu-view-all-link:hover i {
    transform: translateX(5px);
}

/* Notification Badge Styles */
.nav-item[style*="position: relative"] .nav-link {
    position: relative;
}

.notification-badge {
    position: absolute !important;
    top: 2px !important;
    right: 2px !important;
    background: #dc3545 !important;
    color: white !important;
    border-radius: 10px !important;
    min-width: 18px !important;
    height: 18px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 11px !important;
    font-weight: bold !important;
    line-height: 1 !important;
    padding: 0 4px !important;
    white-space: nowrap !important;
    z-index: 10 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
}

/* Notifications text/icon responsive behaviour */
/* Desktop / large screens: show only icon, hide text */
.header-nav .nav-link .notification-text-mobile {
    display: none;
}

/* Mobile: show text, hide icon */
@media (max-width: 991px) {
    .header-nav .nav-link .notification-text-mobile {
        display: inline-block;
        margin-left: 0;
        font-size: 15px;
    }

    .header-nav .nav-link .notification-icon-desktop {
        display: none !important;
    }
}

/* ===== MOBILE MENU TOGGLE STYLES ===== */
.mobile-menu-toggle {
    display: none;
    background: transparent;
    border: 2px solid #000000; /* black border for better visibility */
    border-radius: 6px;
    padding: 8px 10px;
    cursor: pointer;
    z-index: 10001;
    position: relative;
}

/* Desktop: Ensure menu is visible */
@media (min-width: 992px) {
    .header-nav {
        display: flex !important;
        position: relative !important;
        left: auto !important;
        width: auto !important;
        height: auto !important;
        background: transparent !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    
    .header-style-3 .header-nav .nav li i {
        float:inhert !important;
}
}

.mobile-menu-toggle .icon-bar {
    display: block;
    width: 25px;
    height: 3px;
    background: #000000; /* black bars for better visibility */
    margin: 4px 0;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.mobile-menu-toggle:not(.collapsed) .icon-bar-first {
    transform: rotate(45deg) translate(6px, 6px);
}

.mobile-menu-toggle:not(.collapsed) .icon-bar-two {
    opacity: 0;
}

.mobile-menu-toggle:not(.collapsed) .icon-bar-three {
    transform: rotate(-45deg) translate(6px, -6px);
}

/* Mobile Responsive */
@media (max-width: 991px) {
    /* Show mobile toggle */
    .mobile-menu-toggle {
        display: block !important;
        order: 2;
    }
    
    /* Base mobile nav (we'll override theme defaults to use RIGHT SIDE DRAWER) */
    .header-nav {
        position: fixed !important;
        top: 0;
        width: 300px !important;
        max-width: 85vw !important;
        height: 100vh !important;
        background: #ffffff !important;
        z-index: 10001 !important;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 0;
        margin: 0;
        flex-direction: column !important;
        align-items: flex-start !important;
        display: block !important;
    }

    /* Force RIGHT-SIDE drawer for mobile header, override SCSS left-side rules */
    .mobile-sider-drawer-menu .header-nav {
        right: -340px !important;  /* off-screen to the right */
        left: auto !important;
        box-shadow: -4px 0 20px rgba(0,0,0,0.15);
        transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    
    .mobile-sider-drawer-menu.active .header-nav,
    .mobile-sider-drawer-menu .header-nav.show {
        right: 0 !important;       /* slide in from right */
        left: auto !important;
        box-shadow: -4px 0 25px rgba(0,0,0,0.2);
    }
    
    /* Mobile menu header with close button */
    .header-nav::before {
        content: '';
        display: block;
        height: 60px;
        background: linear-gradient(135deg, #0073d1 0%, #0056b3 100%);
        width: 100%;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    /* Ensure sidebar content is above overlay */
    .header-nav * {
        position: relative;
        z-index: 1;
    }
    
    /* Close button in mobile menu */
    .mobile-menu-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 36px;
        margin: 0px 12px;
        height: 36px;
        background: rgba(255,255,255,0.25);
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        display: flex !important;
        align-items: center;
        justify-content: center;
        z-index: 11;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    
    .mobile-menu-close:hover,
    .mobile-menu-close:active {
        background: rgba(255,255,255,0.4);
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    /* Hide close button on desktop */
    @media (min-width: 992px) {
        .mobile-menu-close {
            display: none !important;
        }
    }
    
    /* Show menu when active class is on header or show class is on nav (RIGHT SIDE) */
    .mobile-sider-drawer-menu.active .header-nav,
    .mobile-sider-drawer-menu .header-nav.show {
        right: 0 !important;
        left: auto !important;
        box-shadow: -4px 0 25px rgba(0,0,0,0.2);
    }
    
    .header-nav .navbar-nav {
        flex-direction: column !important;
        width: 100%;
        gap: 0;
        padding: 0;
        margin: 0;
        margin-top: 60px;
        position: relative;
        z-index: 10002 !important;
    }
    
    .header-nav .nav-item {
        width: 100%;
        border-bottom: 1px solid #f1f5f9;
        margin: 0;
        position: relative;
        z-index: 10002 !important;
    }
    
    .header-nav .nav-item:last-child {
        border-bottom: none;
    }
    
    .header-nav .nav-link {
        padding: 16px 20px !important;
        width: 100%;
        justify-content: flex-start;
        color: #1e293b !important;
        font-size: 15px !important;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        position: relative;
        z-index: 10003 !important;
        cursor: pointer;
    }
    
    .header-nav .nav-link:visited {
        color: #1e293b !important;
    }
    
    .header-nav .nav-link i {
        font-size: 20px !important;
        width: 24px;
        text-align: center;
        color: #0073d1;
        flex-shrink: 0;
        position: relative;
        z-index: 10004 !important;
        display: none !important; /* hide icons on mobile (responsive) */
    }
    
    /* Home icon specific styling */
    .header-nav .nav-link:has(.feather-home) {
        padding: 16px 20px !important;
    }
    
    .header-nav .nav-link:has(.feather-home) i {
        margin-right: 0;
    }
    
    .header-nav .nav-link:hover,
    .header-nav .nav-link:active {
        background: linear-gradient(90deg, #f0f9ff 0%, #e0f2fe 100%);
        color: #0073d1 !important;
        padding-left: 24px !important;
    }
    
    .header-nav .nav-link span {
        flex: 1;
    }
    
    /* Mobile overlay */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        /* z-index: 10000; */
        transition: opacity 0.3s ease;
    }
    
    .mobile-menu-overlay.show {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Extra nav section mobile */
    .extra-nav {
        order: 3;
        margin-left: auto;
    }
    
    .logo-header {
        order: 1;
    }
    
    .mega-menu {
        position: static !important;
        transform: none !important;
        left: auto !important;
        width: 100%;
        max-width: 100%;
        margin-top: 0;
        margin-left: 0;
        margin-right: 0;
        box-shadow: none;
        border-radius: 0;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }
    
    .mega-menu-tabs-wrapper {
        flex-wrap: wrap;
        padding: 15px;
        gap: 10px;
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .mega-menu-tab-btn {
        padding: 10px 16px;
        font-size: 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .mega-menu-content-wrapper {
        padding: 15px;
        max-height: 400px;
        overflow-y: auto;
    }
    
    .mega-menu-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .mega-menu-grid-item {
        padding: 14px;
        border-radius: 8px;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .mega-menu-grid-icon {
        width: 40px;
        height: 40px;
    }
    
    .mega-menu-grid-icon i {
        font-size: 18px;
    }
    
    .mega-menu-grid-name {
        font-size: 13px;
    }
    
    .mega-menu-grid-count {
        font-size: 11px;
    }
    
    /* Header buttons mobile */
    .header-nav-btn-section {
        flex-direction: column;
        gap: 10px;
        width: 100%;
        padding: 15px 0;
    }
    
    .twm-nav-sign-up,
    .twm-nav-post-a-job {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .main-bar {
        padding: 10px 15px;
    }
    
    .logo-header img {
        max-height: 36px;
    }
    
    .header-nav {
        width: 260px;
    }
}

/* Dropdown Animation */
.mega-menu-dropdown .dropdown-menu {
    display: none !important;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.mega-menu-dropdown.show .dropdown-menu,
.mega-menu-dropdown:hover .dropdown-menu,
.mega-menu-dropdown .dropdown-menu[style*="display: block"] {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Ensure dropdown works on hover and click */
.mega-menu-dropdown {
    position: relative;
}

.mega-menu-dropdown .dropdown-toggle {
    cursor: pointer;
}

/* Bootstrap 5 compatibility */
.mega-menu-dropdown[data-bs-toggle="dropdown"] .dropdown-menu {
    display: none;
}

/* Owl Stage Padding and Styling */
.owl-stage {
    padding: 1rem !important;
    display: flex !important;
    align-items: center !important;
}

/* Navbar Icon and Text Alignment */
.header-nav .nav-item {
    display: flex;
    align-items: center;
}

.header-nav .nav-link {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 16px;
    line-height: 1.5;
    transition: all 0.3s;
}

.header-nav .nav-link.home-icon-link,
.header-nav .nav-link.icon-link {
    padding: 15px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-nav .nav-link.home-icon-link i,
.header-nav .nav-link.icon-link i {
    font-size: 20px;
    line-height: 1;
    vertical-align: middle;
    display: inline-block;
}

.header-nav .nav-link span {
    display: inline-block;
    vertical-align: middle;
    line-height: 1.5;
    font-size: 16px;
}

/* Ensure consistent alignment for all nav items */
.header-nav .nav > li {
    display: flex;
    align-items: center;
}

.header-nav .nav > li > a {
    display: flex;
    align-items: center;
    white-space: nowrap;
}

@media (max-width: 1199px) {
    .header-nav .nav-link {
        padding: 12px 12px;
    }
    
    .header-nav .nav-link.home-icon-link,
    .header-nav .nav-link.icon-link {
        padding: 12px 12px;
    }
}

/* Home Client Carousel 3 Improvements */
.home-client-carousel3 {
    padding: 15px 0 !important;
}

.home-client-carousel3 .owl-stage-outer {
    padding: 0 !important;
    overflow: hidden !important;
}

.home-client-carousel3 .ow-client-logo {
    height: auto !important;
    min-height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* padding: 12px; */
    /* background: #fff; */
    /* border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06); */
    /* transition: all 0.3s ease; */
}

/* .home-client-carousel3 .ow-client-logo:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    transform: translateY(-3px);
} */

.home-client-carousel3 .client-logo {
    max-width: 100% !important;
    width: 100%;
}

.home-client-carousel3 .client-logo a {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 8px;
}

.home-client-carousel3 .client-logo a img {
    max-width: 100%;
    max-height: 70px;
    width: auto;
    height: auto;
    object-fit: contain;
}

/* Reduce Section Background Height */
.section-full.site-bg-gray {
<<<<<<< HEAD
    padding-top: 60px !important;
    padding-bottom: 50px !important;
}

.section-full.p-t120.p-b90 {
    padding-top: 100px !important;
    padding-bottom: 50px !important;
=======
    padding-top: 6px !important;
    padding-bottom: 5px !important;
}

.section-full.p-t120.p-b90 {
    padding-top: 20px !important;
    padding-bottom: 1-px !important;
>>>>>>> fb5c60a2 (evening updates)
}

/* Section Content Spacing */
.section-content {
    padding: 0 15px;
}

/* Top Schools Section Specific */
.twm-companies-wrap {
    padding-top: 50px !important;
    padding-bottom: 40px !important;
}

.mega-menu-dropdown.show .dropdown-menu,
.mega-menu-dropdown[aria-expanded="true"] .dropdown-menu,
#jobs-mega-menu[style*="display: block"] {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* ===== LOGOUT MODAL (Same as Employer Dashboard) ===== */
.enl-logout-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.35);
    z-index: 99999;
    align-items: center;
    justify-content: center;
    padding: 24px;
}
.enl-logout-modal-box {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.04);
    max-width: 400px;
    width: 100%;
    overflow: hidden;
    text-align: center;
}
.enl-logout-modal-body { padding: 36px 28px 20px; }
.enl-logout-modal-icon-wrap {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #93c5fd;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.enl-logout-modal-icon { color: #fff; }
.enl-logout-modal-title {
    margin: 0 0 8px;
    font-size: 22px;
    font-weight: 700;
    color: #111827;
}
.enl-logout-modal-text {
    margin: 0;
    font-size: 15px;
    color: #6b7280;
    line-height: 1.5;
}
.enl-logout-modal-actions {
    padding: 0 32px 32px 32px;
    display: flex;
    justify-content: space-between;
    gap: 12px;
    position: relative;
    z-index: 2;
}
.enl-logout-btn-secondary {
    background: transparent;
    border: none;
    color: #3b82f6;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 8px;
    order: 1;
}
.enl-logout-btn-secondary:hover { color: #2563eb; background: #eff6ff; }
.enl-logout-btn-primary {
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    padding: 10px 24px;
    order: 2;
}
.enl-logout-btn-primary:hover { background: #2563eb; }
</style>

<script>
// Mega Menu Dropdown Functions
let megaMenuTimeout;

function showMegaMenu() {
    clearTimeout(megaMenuTimeout);
    const menu = document.getElementById('jobs-mega-menu');
    const dropdown = document.querySelector('.mega-menu-dropdown');
    const toggle = document.getElementById('jobs-dropdown');
    
    if (menu && dropdown && toggle) {
        menu.style.display = 'block';
        menu.style.opacity = '1';
        menu.style.visibility = 'visible';
        dropdown.classList.add('show');
        toggle.setAttribute('aria-expanded', 'true');
    }
}

function hideMegaMenu() {
    const menu = document.getElementById('jobs-mega-menu');
    const dropdown = document.querySelector('.mega-menu-dropdown');
    const toggle = document.getElementById('jobs-dropdown');
    
    if (menu && dropdown && toggle) {
        megaMenuTimeout = setTimeout(() => {
            menu.style.display = 'none';
            menu.style.opacity = '0';
            menu.style.visibility = 'hidden';
            dropdown.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        }, 200);
    }
}

function toggleMegaMenu(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }
    
    const menu = document.getElementById('jobs-mega-menu');
    const dropdown = document.querySelector('.mega-menu-dropdown');
    const toggle = document.getElementById('jobs-dropdown');
    const isExpanded = toggle && toggle.getAttribute('aria-expanded') === 'true';
    
    if (isExpanded) {
        hideMegaMenu();
    } else {
        showMegaMenu();
    }
}

// Tab Switching Function
function switchMegaMenuTab(tabName) {
    // Hide all tab content
    const tabContents = document.querySelectorAll('.mega-menu-tab-content');
    tabContents.forEach(content => {
        content.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.mega-menu-tab-btn');
    tabButtons.forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab content
    const selectedContent = document.getElementById('content-' + tabName);
    const selectedButton = document.querySelector(`.mega-menu-tab-btn[data-tab="${tabName}"]`);
    
    if (selectedContent) {
        selectedContent.classList.add('active');
    }
    
    if (selectedButton) {
        selectedButton.classList.add('active');
    }
}

// Mobile Menu Toggle Functionality - Enhanced to work with existing system
(function() {
    function initMobileMenu() {
        const toggleBtn = document.getElementById('mobile-side-drawer');
        const header = document.querySelector('.mobile-sider-drawer-menu');
        const navMenu = document.getElementById('main-navbar-menu');
        
        // Check if overlay already exists
        let overlay = document.querySelector('.mobile-menu-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        document.body.appendChild(overlay);
        }
        
        // Get close button
        const closeBtn = document.getElementById('mobile-menu-close-btn');
        
        // Function to close menu
        function closeMobileMenu() {
            header.classList.remove('active');
            toggleBtn.classList.add('collapsed');
            toggleBtn.setAttribute('aria-expanded', 'false');
            navMenu.classList.remove('show');
            if (overlay) {
                overlay.classList.remove('show');
            }
            document.body.style.overflow = '';
            // Hide close button
            if (closeBtn) {
                closeBtn.style.display = 'none';
            }
        }
        
        // Function to open menu
        function openMobileMenu() {
            header.classList.add('active');
                    toggleBtn.classList.remove('collapsed');
            toggleBtn.setAttribute('aria-expanded', 'true');
                    navMenu.classList.add('show');
            if (overlay) {
                    overlay.classList.add('show');
            }
                    document.body.style.overflow = 'hidden';
            // Show close button on mobile
            if (closeBtn && window.innerWidth <= 991) {
                closeBtn.style.display = 'flex';
            }
        }
        
        if (toggleBtn && header) {
            // Prevent multiple event listeners
            if (toggleBtn.dataset.initialized === 'true') {
                return;
            }
            toggleBtn.dataset.initialized = 'true';
            
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = header.classList.contains('active');
                const isCollapsed = toggleBtn.classList.contains('collapsed');
                
                if (isActive || !isCollapsed) {
                    closeMobileMenu();
                } else {
                    openMobileMenu();
                }
            });
            
            // Close button functionality
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('navbar closed'); // for debugging in console
                    closeMobileMenu();
                });
            }
            
            // Close on overlay click - but NOT if clicking inside sidebar
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    // Only close if clicking directly on overlay, not on sidebar
                    if (e.target === overlay) {
                        closeMobileMenu();
                    }
                });
            }
            
            // Close on menu item click (mobile) - but only for actual navigation links, not dropdowns
            if (navMenu) {
                // Prevent clicks inside sidebar from bubbling to overlay (but allow navigation)
                navMenu.addEventListener('click', function(e) {
                    const target = e.target;
                    const link = target.closest('a');
                    
                    // Only stop propagation if it's NOT a navigation link
                    // This allows navigation links to work normally
                    if (!link || !link.getAttribute('href') || link.getAttribute('href') === '#' || link.getAttribute('href') === 'javascript:void(0)') {
                        e.stopPropagation(); // Prevent overlay click handler from firing
                    }
                    // For navigation links, let the event bubble so navigation can happen
                }, true); // Use capture phase to run before overlay handler
                
                // Use event delegation for better performance and to handle dynamically added elements
                navMenu.addEventListener('click', function(e) {
                    if (window.innerWidth > 991) {
                        return; // Not mobile view
                    }
                    
                    // Get the clicked element
                    const target = e.target;
                    const link = target.closest('a');
                    
                    // Don't close if clicking on buttons (like mega menu tab buttons)
                    if (target.tagName === 'BUTTON' || target.closest('button')) {
                        return; // Don't close menu for buttons
                    }
                    
                    // Only handle clicks on actual navigation links
                    if (link) {
                        // Don't close if it's the mega menu dropdown toggle (Jobs link)
                        if (link.id === 'jobs-dropdown') {
                            return; // Don't close menu for mega menu toggle
                        }
                        
                        // Don't close if it's any other dropdown toggle
                        if (link.hasAttribute('data-bs-toggle') && link.getAttribute('data-bs-toggle') === 'dropdown') {
                            return; // Don't close menu for dropdown toggles
                        }
                        
                        // Don't close if it's a dropdown toggle without a real href
                        if (link.classList.contains('dropdown-toggle') && 
                            (!link.getAttribute('href') || link.getAttribute('href') === '#')) {
                            return; // Don't close menu for dropdown toggles
                        }
                        
                        // Close menu for actual navigation links (including mega menu grid items)
                        const href = link.getAttribute('href');
                        if (href && href !== '#' && href !== 'javascript:void(0)') {
                            // Allow navigation to happen first, then close menu
                            // Don't prevent default - let browser handle navigation
                            setTimeout(function() {
                                closeMobileMenu();
                            }, 50); // Small delay to allow navigation to start
                        }
                    } else {
                        // Don't close if clicking inside mega menu structure (but not on a link)
                        if (target.closest('.mega-menu')) {
                            return; // Don't close menu when clicking on mega menu structure
                        }
                    }
                }, false); // Use bubble phase instead of capture to allow toggleMegaMenu to work first
            }
            
            // Close on window resize if menu is open and window becomes larger
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991 && header.classList.contains('active')) {
                    closeMobileMenu();
                }
                // Hide/show close button based on screen size
                if (closeBtn) {
                    if (window.innerWidth <= 991 && header.classList.contains('active')) {
                        closeBtn.style.display = 'flex';
                    } else {
                        closeBtn.style.display = 'none';
                    }
                }
            });
        }
    }
    
    // Wait for DOM and ensure it runs after other scripts
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initMobileMenu, 100);
        });
    } else {
        setTimeout(initMobileMenu, 100);
    }
    
    // Also run after a delay to ensure other scripts have loaded
    setTimeout(initMobileMenu, 500);
})();

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('.mega-menu-dropdown');
    const menu = document.getElementById('jobs-mega-menu');
    const toggle = document.getElementById('jobs-dropdown');
    
    if (!dropdown || !menu || !toggle) return;
    
    // Set default tab to categories on load
    const defaultTab = document.getElementById('content-categories');
    if (defaultTab) {
        defaultTab.classList.add('active');
    }
    const defaultBtn = document.querySelector('.mega-menu-tab-btn[data-tab="categories"]');
    if (defaultBtn) {
        defaultBtn.classList.add('active');
    }
    
    // Hover events
    dropdown.addEventListener('mouseenter', function() {
        clearTimeout(megaMenuTimeout);
        showMegaMenu();
    });
    
    dropdown.addEventListener('mouseleave', function() {
        hideMegaMenu();
    });
    
    // Click event
    toggle.addEventListener('click', toggleMegaMenu);
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            hideMegaMenu();
        }
    });
    
    // Try to initialize Bootstrap dropdown if available
    if (typeof bootstrap !== 'undefined' && bootstrap.Dropdown) {
        try {
            new bootstrap.Dropdown(toggle, {
                popperConfig: {
                    placement: 'bottom-start',
                    modifiers: [{
                        name: 'offset',
                        options: {
                            offset: [0, 10]
                        }
                    }]
                }
            });
        } catch (e) {
            console.log('Bootstrap dropdown initialization skipped:', e);
        }
    }
});

// Navbar Hide/Show on Scroll - Hide on scroll up, Show on scroll down
(function() {
    'use strict';
    
    // Wait for DOM and ensure it runs after Waypoint
    function initNavbarScroll() {
        const mainBar = document.querySelector('.main-bar');
        const stickyHeader = document.querySelector('.sticky-header');
        
        if (!mainBar) return;
        
        let lastScrollTop = 0;
        let isNavbarVisible = true;
        const scrollThreshold = 50; // Minimum scroll before hiding
        
        // Disable Waypoint.Sticky if it exists
        if (typeof Waypoint !== 'undefined' && stickyHeader) {
            try {
                const waypointInstance = Waypoint.all('sticky-header');
                if (waypointInstance && waypointInstance.length > 0) {
                    waypointInstance.forEach(function(wp) {
                        wp.destroy();
                    });
                }
            } catch(e) {
                console.log('Waypoint cleanup:', e);
            }
        }
        
        function handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
            
            // At the very top, always show navbar
            if (scrollTop < 10) {
                if (!isNavbarVisible) {
                    showNavbar();
                    isNavbarVisible = true;
                }
                lastScrollTop = scrollTop;
                return;
            }
            
            // Determine scroll direction
            const scrollDifference = scrollTop - lastScrollTop;
            
            if (scrollDifference > 0) {
                // Scrolling DOWN - Hide navbar
                if (scrollTop > scrollThreshold && isNavbarVisible) {
                    hideNavbar();
                    isNavbarVisible = false;
                }
            } else if (scrollDifference < 0) {
                // Scrolling UP - Show navbar
                if (!isNavbarVisible) {
                    showNavbar();
                    isNavbarVisible = true;
                }
            }
            
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }
        
        function showNavbar() {
            if (mainBar) {
                // Remove any classes that might interfere
                mainBar.classList.remove('is-fixed');
                stickyHeader.classList.remove('is-fixed', 'header-fixed');
                
                // Apply styles
                mainBar.style.transform = 'translateY(0)';
                mainBar.style.opacity = '1';
                mainBar.style.visibility = 'visible';
                mainBar.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
                
                // Make it fixed when scrolled
                if (window.scrollY > 50) {
                    mainBar.style.position = 'fixed';
                    // mainBar.style.top = '40px';
                    mainBar.style.left = '0';
                    mainBar.style.right = '0';
                    mainBar.style.width = '100%';
                    mainBar.style.zIndex = '9999';
                    mainBar.style.background = '#fff';
                    mainBar.style.backgroundColor = '#fff';
                    mainBar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                } else {
                    mainBar.style.position = 'relative';
                    // mainBar.style.top = 'auto';
                    mainBar.style.left = 'auto';
                    mainBar.style.right = 'auto';
                    mainBar.style.width = '100%';
                    mainBar.style.zIndex = '999';
                    mainBar.style.background = '#fff';
                    mainBar.style.backgroundColor = '#fff';
                    mainBar.style.boxShadow = 'none';
                }
            }
        }
        
        function hideNavbar() {
            if (mainBar && window.scrollY > scrollThreshold) {
                // mainBar.style.transform = 'translateY(-100%)';
                // mainBar.style.opacity = '0';
                // mainBar.style.visibility = 'hidden';
                mainBar.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
                // Keep it fixed even when hidden
                mainBar.style.position = 'fixed';
                // mainBar.style.top = '40px';
                mainBar.style.left = '0';
                mainBar.style.right = '0';
                mainBar.style.width = '100%';
                mainBar.style.zIndex = '9999';
                mainBar.style.background = '#fff';
                mainBar.style.backgroundColor = '#fff';
            }
        }
        
        // Throttle scroll events for better performance
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
        
        // Initial state - show navbar at top
        showNavbar();
        isNavbarVisible = true;
    }
    
    // Run after DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavbarScroll);
    } else {
        // DOM already loaded
        setTimeout(initNavbarScroll, 100);
    }
    
    // Also run after a short delay to ensure Waypoint has initialized
    setTimeout(initNavbarScroll, 500);
})();

// Logout Button Handler - Enhanced with better dialog system detection
(function() {
    function waitForDialogSystem(callback, maxAttempts) {
        maxAttempts = maxAttempts || 150; // 15 seconds max (150 * 100ms)
        let attempts = 0;
        
        function check() {
            attempts++;
            // Check if jQuery is loaded first (dialog system depends on it)
            if (typeof jQuery === 'undefined' && attempts < 50) {
                // Wait for jQuery to load first
                setTimeout(check, 100);
                return;
            }
            
            // Check if showDialogConfirm function exists
            if (typeof window.showDialogConfirm === 'function') {
                // Also ensure dialog container exists
                if (typeof jQuery !== 'undefined' && jQuery('#dialog-alert-container').length === 0) {
                    jQuery('body').append('<div id="dialog-alert-container"></div>');
                } else if (typeof jQuery === 'undefined' && !document.getElementById('dialog-alert-container')) {
                    const container = document.createElement('div');
                    container.id = 'dialog-alert-container';
                    document.body.appendChild(container);
                }
                callback(false); // Pass false to indicate dialog system is ready
            } else if (attempts < maxAttempts) {
                setTimeout(check, 100);
            } else {
                // Fallback after max attempts
                console.warn('Dialog system not loaded, using native confirm');
                callback(true); // Pass true to indicate fallback
            }
        }
        check();
    }
    
    function initLogoutHandler() {
        const logoutBtn = document.getElementById('logout-btn');
        const logoutForm = document.getElementById('logout-form');
        
        if (logoutBtn && logoutForm) {
            // Check if already initialized
            if (logoutBtn.dataset.dialogInitialized === 'true') {
                return; // Already initialized
            }
            logoutBtn.dataset.dialogInitialized = 'true';
            
            // Remove any existing listeners by cloning
            const newBtn = logoutBtn.cloneNode(true);
            newBtn.dataset.dialogInitialized = 'true';
            logoutBtn.parentNode.replaceChild(newBtn, logoutBtn);
            
            // Store allowSubmit flag
            let allowSubmit = false;
            
            // Prevent form submission unless allowed
            const submitHandler = function(e) {
                if (!allowSubmit) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
            };
            logoutForm.addEventListener('submit', submitHandler, true);
            
            newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                // Use showDialogConfirm if available, otherwise fallback to native confirm
                function performLogout() {
                    allowSubmit = true;
                    logoutForm.removeEventListener('submit', submitHandler, true);
                    logoutForm.submit();
                }
                
                // Use the same logout modal as employer dashboard
                if (typeof window.showNavbarLogoutModal === 'function') {
                    window.showNavbarLogoutModal();
                } else {
                    // Fallback to native confirm if modal not ready
                    if (confirm('Do you want to logout?')) {
                        performLogout();
                    }
                }
                
                return false;
            }, true); // Use capture phase
        } else if (!logoutBtn || !logoutForm) {
            // Retry if elements not found yet
            setTimeout(initLogoutHandler, 200);
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initLogoutHandler, 500);
        });
    } else {
        // DOM already loaded
        setTimeout(initLogoutHandler, 500);
    }
    
    // Also try after longer delays to ensure all scripts are loaded
    setTimeout(initLogoutHandler, 1500);
    setTimeout(initLogoutHandler, 3000);
})();
</script>


<div id="dialog-alert-container" style="display: none;"></div>

<!-- Logout confirmation modal (Same as Employer Dashboard) -->
<div id="navbar-logout-modal-overlay" class="enl-logout-overlay">
    <div id="navbar-logout-modal-box" class="enl-logout-modal-box">
        <div class="enl-logout-modal-body">
            <div class="enl-logout-modal-icon-wrap">
                <svg class="enl-logout-modal-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            </div>
            <h4 class="enl-logout-modal-title">Logout</h4>
            <p class="enl-logout-modal-text">Are you sure you want to logout?</p>
        </div>
        <div class="enl-logout-modal-actions">
            <button type="button" id="navbar-logout-modal-confirm" class="enl-logout-btn-secondary">Logout</button>
            <button type="button" id="navbar-logout-modal-cancel" class="enl-logout-btn-primary">Cancel</button>
        </div>
    </div>
</div>
<script>
// Navbar Logout Modal Handler (Same as Employer Dashboard)
(function() {
    function showNavbarLogoutModal() {
        var overlay = document.getElementById('navbar-logout-modal-overlay');
        if (overlay) {
            overlay.style.display = 'flex';
        }
    }
    function hideNavbarLogoutModal() {
        var overlay = document.getElementById('navbar-logout-modal-overlay');
        if (overlay) overlay.style.display = 'none';
    }
    
    // Initialize modal handlers when DOM is ready
    function initNavbarLogoutModal() {
        var cancelBtn = document.getElementById('navbar-logout-modal-cancel');
        var confirmBtn = document.getElementById('navbar-logout-modal-confirm');
        var overlay = document.getElementById('navbar-logout-modal-overlay');
        var logoutForm = document.getElementById('logout-form');
        
        if (cancelBtn && confirmBtn && overlay && logoutForm) {
            cancelBtn.onclick = hideNavbarLogoutModal;
            confirmBtn.onclick = function() {
                hideNavbarLogoutModal();
                logoutForm.submit();
            };
            overlay.onclick = function(e) {
                if (e.target === this) hideNavbarLogoutModal();
            };
            window.showNavbarLogoutModal = showNavbarLogoutModal;
        } else {
            setTimeout(initNavbarLogoutModal, 100);
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initNavbarLogoutModal, 100);
        });
    } else {
        setTimeout(initNavbarLogoutModal, 100);
    }
})();
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/partials/navbar.blade.php ENDPATH**/ ?>