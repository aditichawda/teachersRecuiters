<div>
    <div class="top-bar">
        <div class="container-fluid custom-container">
            <div class="row g-0 align-items-center">
                <div class="col-md-7">
                    <ul class="list-inline mb-0 text-center text-md-start">
                        <?php if($hotline = theme_option('hotline')): ?>
                            <li class="list-inline-item">
                                <p class="fs-13 mb-0">
                                    <i class="mdi mdi-map-marker"></i>
                                    <?php echo e(__('Hotline')); ?>: <a href="tel:<?php echo e($hotline); ?>" class="text-dark">
                                        <?php echo e($hotline); ?>

                                    </a>
                                </p>
                            </li>
                        <?php endif; ?>
                        <?php if($socialLinks = Theme::getSocialLinks()): ?>
                            <li class="list-inline-item">
                                <ul class="topbar-social-menu list-inline mb-0">
                                    <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(! $socialLink->getUrl() || ! $socialLink->getIconHtml()) continue; ?>

                                        <li class="list-inline-item">
                                            <a <?php echo $socialLink->getAttributes(['title' => $socialLink->getName(), 'target' => '_blank', 'class' => 'social-link']); ?>>
                                                <?php echo $socialLink->getIconHtml(); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="list-inline mb-0 text-center text-md-end">
                        <?php if(is_plugin_active('job-board')): ?>
                            <?php if(!auth('account')->check()): ?>
                                <li class="list-inline-item py-2 me-3 align-middle">
                                    <a href="<?php echo e(route('public.account.login')); ?>" class="text-dark fw-medium fs-13">
                                        <i class="uil uil-user"></i> <?php echo e(__('Sign In')); ?>

                                    </a>
                                </li>

                                <?php if(JobBoardHelper::isRegisterEnabled()): ?>
                                    <li class="list-inline-item py-2 me-3 align-middle">
                                        <a href="#signupModal" class="text-dark fw-medium fs-13" data-bs-toggle="modal">
                                            <i class="uil uil-lock"></i> <?php echo e(__('Sign Up')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php elseif($account = auth('account')->user()): ?>
                                <li class="list-inline-item py-2 align-middle me-3 dropdown">
                                    <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                       aria-expanded="false" style="color: #314047;">
                                        <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" width="30" height="30" class="rounded-circle me-1">
                                        <span class="d-none d-md-inline-block fw-medium"><?php echo e(__('Hi, :name', ['name' => Str::limit($account->name, 15)])); ?></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($account->isEmployer()): ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('public.account.dashboard')); ?>"><?php echo e(__('Employer Dashboard')); ?></a></li>
                                        <?php else: ?>
                                            <li><a class="dropdown-item" href="<?php echo e(route('public.account.jobs.saved')); ?>"><?php echo e(__('Saved Jobs')); ?></a></li>
                                            <li><a class="dropdown-item" href="<?php echo e(route('public.account.jobs.applied-jobs')); ?>"><?php echo e(__('Applied Jobs')); ?></a></li>
                                        <?php endif; ?>
                                        <li><a class="dropdown-item" href="<?php echo e(route('public.account.settings')); ?>"><?php echo e(__('Account Settings')); ?></a></li>
                                        <li>
                                            <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#"><?php echo e(__('Logout')); ?></a>
                                            <form id="logout-form" action="<?php echo e(route('public.account.logout')); ?>" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php $currencies = get_all_currencies(); ?>

                            <?php if(count($currencies) > 1): ?>
                                <li class="list-inline-item py-2 align-middle me-3">
                                    <div class="dropdown d-inline-block language-switch">
                                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <?php echo e(get_application_currency()->title); ?>

                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>" class="dropdown-item notify-item language"><span><?php echo e($currency->title); ?></span></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(is_plugin_active('language')): ?>
                            <?php echo Theme::partial('language-switcher'); ?>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="<?php echo \Illuminate\Support\Arr::toCssClasses(['navbar navbar-expand-lg', 'mobile-sticky' => theme_option('sticky_header_mobile_enabled', true), 'no-mobile-sticky' => ! theme_option('sticky_header_mobile_enabled', true)]); ?>" id="navbar"
         role="navigation"
         aria-label="<?php echo e(__('Main navigation')); ?>"
         <?php if(theme_option('sticky_header_enabled', true)): ?>
            data-sticky
         <?php endif; ?>
         <?php if(theme_option('sticky_header_mobile_enabled', true)): ?>
             data-mobile-sticky
        <?php endif; ?>
    >
        <div class="container-fluid custom-container">
            <?php if(Theme::getLogo()): ?>
                <a class="navbar-brand text-dark fw-bold me-auto" href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">
                    <?php echo Theme::getLogoImage(['class' => 'logo-dark'], 'logo', 70); ?>

                </a>
            <?php endif; ?>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <?php echo Menu::renderMenuLocation('main-menu', [
                        'options' => ['class' => 'navbar-nav mx-auto navbar-center'],
                        'view'    => 'main-menu',
                    ]); ?>

                <ul class="navbar-nav mx-auto navbar-center extra-menu-items">
                    <?php if(is_plugin_active('job-board')): ?>
                        <?php if(!auth('account')->check()): ?>
                            <li class="nav-item dropdown dropdown-hover">
                                <a href="<?php echo e(route('public.account.login')); ?>" class="text-dark fw-medium fs-13">
                                    <i class="uil uil-user"></i> <?php echo e(__('Sign In')); ?>

                                </a>
                            </li>

                            <?php if(JobBoardHelper::isRegisterEnabled()): ?>
                                <li class="nav-item dropdown dropdown-hover">
                                    <a href="#signupModal" class="text-dark fw-medium fs-13" data-bs-toggle="modal">
                                        <i class="uil uil-lock"></i> <?php echo e(__('Sign Up')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(count($currencies) > 1): ?>
                            <li class="list-inline-item py-2 align-middle">
                                <div class="dropdown d-inline-block language-switch">
                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <?php echo e(get_application_currency()->title); ?>

                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>" class="dropdown-item notify-item language"><span><?php echo e($currency->title); ?></span></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if(is_plugin_active('language')): ?>
                        <?php echo Theme::partial('language-switcher'); ?>

                    <?php endif; ?>

                    <?php if(is_plugin_active('job-board') && (! auth('account')->check() || auth('account')->user()->isEmployer())): ?>
                        <li class="mt-1 text-center">
                            <a href="<?php echo e(theme_option('post_a_job_url') ?: route('public.account.jobs.create')); ?>" class="btn btn-primary me-2 d-inline-block d-md-none"><i class="mdi mdi-plus"></i> <?php echo e(__('Post a job')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if(is_plugin_active('job-board')): ?>
                <ul class="header-menu list-inline d-flex align-items-center mb-0">
                    <?php echo apply_filters('theme-header-right-nav', null); ?>

                    <?php if(! auth('account')->check() || auth('account')->user()->isEmployer()): ?>
                        <li class="list-inline-item dropdown my-2 d-none d-md-block">
                            <a href="<?php echo e(theme_option('post_a_job_url') ?: route('public.account.jobs.create')); ?>" class="btn btn-primary me-2"><i class="mdi mdi-plus"></i> <?php echo e(__('Post a job')); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth('account')->check() && $account = auth('account')->user()): ?>
                        <li class="list-inline-item dropdown d-block d-md-none">
                            <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" width="35" height="35" class="rounded-circle me-1">
                                <span class="d-none d-md-inline-block fw-medium"><?php echo e(__('Hi, :name', ['name' => Str::limit($account->name, 15)])); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                                <?php if($account->isEmployer()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('public.account.dashboard')); ?>"><?php echo e(__('Employer Dashboard')); ?></a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('public.account.jobs.saved')); ?>"><?php echo e(__('Saved Jobs')); ?></a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('public.account.jobs.applied-jobs')); ?>"><?php echo e(__('Applied Jobs')); ?></a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('public.account.settings')); ?>"><?php echo e(__('Account Settings')); ?></a></li>
                                <li>
                                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#"><?php echo e(__('Logout')); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
            <div>
                <button class="navbar-toggler me-3 align-bottom" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>
        </div>
    </nav>

    <?php if(is_plugin_active('job-board') && !auth('account')->check() && JobBoardHelper::isRegisterEnabled()): ?>
        <link rel="stylesheet" href="<?php echo e(asset('vendor/core/plugins/job-board/css/front-auth.css')); ?>">
        <div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="position-absolute end-0 top-0 p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="auth-content">
                            <div class="w-100">
                                <div class="text-center mb-4">
                                    <h5><?php echo e(__('Sign Up')); ?></h5>
                                    <p class="text-muted"><?php echo e(__('Sign Up and get access to all the features.')); ?></p>
                                </div>
                                <?php echo Botble\JobBoard\Forms\Fronts\Auth\RegisterForm::create()->renderForm(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobcy/partials/navbar.blade.php ENDPATH**/ ?>