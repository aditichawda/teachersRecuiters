<header class="site-header {{ Theme::get('header_css_class') ?: 'header-style-3' }} mobile-sider-drawer-menu">
    {!! Theme::partial('header-top') !!}
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar">
            <div class="container-fluid clearfix">
                @if (Theme::getLogo())
                    <div class="logo-header">
                        <div class="logo-header-inner logo-header-one">
                            <a href="{{ BaseHelper::getHomepageUrl()  }}">
                                @if (Theme::get('header_css_class') == 'header-style-light')
                                    {!! Theme::getLogoImage(['class' => 'default-scroll-show'], 'logo_light', 44) ?: Theme::getLogoImage(['class' => 'default-scroll-show'], 'logo', 44) !!}
                                    {!! Theme::getLogoImage(['class' => 'on-scroll-show'], 'logo', 44) !!}
                                @else
                                    {!! Theme::getLogoImage([], 'logo', 44) !!}
                                @endif

                            </a>
                        </div>
                    </div>
                @endif

                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button"
                    class="navbar-toggler collapsed">
                    <span class="sr-only">{{ __('Toggle navigation') }}</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>

                <!-- MAIN Vav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-end">
                    {!! Menu::renderMenuLocation('main-menu', [
                        'view' => 'menu',
                        'options' => ['class' => 'nav navbar-nav'],
                    ]) !!}
                </div>

                @if (is_plugin_active('job-board'))
                    <!-- Header Right Section-->
                    <div class="extra-nav header-2-nav">
                        <div class="extra-cell">
                            {{-- <div class="header-search">
                                <a href="#search" class="header-search-icon">
                                    <i class="feather-search"></i>
                                </a>
                            </div> --}}
                        </div>
                        <div class="extra-cell">
                            <div class="header-nav-btn-section">
                                @if (auth('account')->check() && $account = auth('account')->user())
                                    <div>
                                        <div class="twm-nav-btn-left dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle" role="button" id="account-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" width="35" height="35" class="rounded-circle me-1">
                                                <span class="d-none d-md-inline-block fw-medium">{{ Str::limit($account->name, 9) }}</span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="account-dropdown">
                                                @if ($account->isEmployer())
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('public.account.dashboard') }}">
                                                            <i class="feather-home"></i>
                                                            <span>{{ __('Employer Dashboard') }}</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('public.account.jobs.saved') }}">
                                                            <i class="feather-bookmark"></i>
                                                            <span>{{ __('Saved Jobs') }}</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('public.account.jobs.applied-jobs') }}">
                                                            <i class="feather-check-square"></i>
                                                            <span>{{ __('Applied Jobs') }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('public.account.settings') }}">
                                                        <i class="feather-settings"></i>
                                                        <span>{{ __('Account Settings') }}</span>
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    {!! Form::open([
                                                        'route' => 'public.account.logout',
                                                        'id' => 'logout-form',
                                                        'onsubmit' => 'return confirm("' . __('Do you want to logout?') . '");']) !!}
                                                        <button class="dropdown-item">
                                                            <i class="feather-log-out"></i>
                                                            <span>{{ __('Logout') }}</span>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <div class="twm-nav-btn-left">
                                            <a class="twm-nav-sign-up d-inline-block" href="{{ route('public.account.register') }}">
                                                <i class="feather-log-in"></i>
                                                <span>{{ __('Sign Up') }}</span>
                                            </a>
                                        </div>
                                        <div class="twm-nav-btn-right">
                                            <a href="{{ auth('account')->check() ? route('public.account.jobs.create') : route('public.account.register', ['account_type' => 'employer']) }}" class="twm-nav-post-a-job">
                                                <i class="feather-briefcase"></i>
                                                <span>{{ __('Post a job') }}</span>
                                            </a>
                                        </div>
                                        {{-- <div class="twm-nav-btn-right d-none d-sm-block">
                                            <a href="#" class="twm-nav-post-a-job twm-nav-btn-offcanvas" data-bs-toggle="offcanvas" data-bs-target="#sidebar-offcanvas" aria-controls="sidebar-offcanvas">
                                                <i class="feather-menu"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (is_plugin_active('job-board'))
            <!-- SITE Search -->
            <div id="search">
                <span class="close"></span>
                <form role="search" id="searchform" action="{{ JobBoardHelper::getJobsPageURL() }}" method="GET" class="radius-xl">
                    <input class="form-control" value="{{ request()->input('q') }}" name="q" type="search" placeholder="{{ __('Type to search') }}" />
                    <span class="input-group-append">
                        <button type="submit" class="search-btn">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </span>
                </form>
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
</header>
