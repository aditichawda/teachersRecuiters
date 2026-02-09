@php
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Facades\JobBoardHelper;
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    
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
@endphp

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

                <!-- MAIN Nav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-end">
                    <ul class="nav navbar-nav">
                        <!-- How it Works -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/how-it-works') }}">
                                <span>{{ __('How it Works') }}</span>
                            </a>
                        </li>

                        <!-- Jobs Mega Menu Dropdown -->
                        <li class="nav-item dropdown mega-menu-dropdown" onmouseenter="showMegaMenu()" onmouseleave="hideMegaMenu()">
                            <a class="nav-link dropdown-toggle" href="{{ JobBoardHelper::getJobsPageURL() }}" role="button" id="jobs-dropdown" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleMegaMenu(event)">
                                <span>{{ __('Jobs') }}</span>
                                <i class="feather-chevron-down ms-1"></i>
                            </a>
                            <div class="dropdown-menu mega-menu" id="jobs-mega-menu" aria-labelledby="jobs-dropdown">
                                <div class="mega-menu-wrapper">
                                    <!-- Tabs Navigation -->
                                    <div class="mega-menu-tabs-wrapper">
                                        <button class="mega-menu-tab-btn active" onclick="switchMegaMenuTab('categories')" data-tab="categories">
                                            {{ __('JOBS BY CATEGORIES') }}
                                            <i class="feather-chevron-down"></i>
                                        </button>
                                        <button class="mega-menu-tab-btn" onclick="switchMegaMenuTab('location')" data-tab="location">
                                            {{ __('JOBS BY LOCATIONS') }}
                                            <i class="feather-chevron-down"></i>
                                        </button>
                                        <button class="mega-menu-tab-btn" onclick="switchMegaMenuTab('institution')" data-tab="institution">
                                            {{ __('JOBS BY INSTITUTION TYPE') }}
                                            <i class="feather-chevron-down"></i>
                                        </button>
                                    </div>

                                    <!-- Tab Content -->
                                    <div class="mega-menu-content-wrapper">
                                        <!-- Jobs by Categories Content -->
                                        <div class="mega-menu-tab-content active" id="content-categories">
                                            <div class="mega-menu-grid">
                                                @php
                                                    $categories = $featuredCategories->chunk(ceil($featuredCategories->count() / 2));
                                                @endphp
                                                @foreach($categories as $chunk)
                                                    <div class="mega-menu-column">
                                                        @foreach($chunk as $category)
                                                            <a href="{{ $category->url }}" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    @if($category->icon)
                                                                        <i class="{{ $category->icon }}"></i>
                                                                    @else
                                                                        <i class="feather-briefcase"></i>
                                                                    @endif
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name">{{ $category->name }}</span>
                                                                    <span class="mega-menu-grid-count">{{ number_format($category->active_jobs_count ?? 0) }} Jobs</span>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                @if($featuredCategories->isEmpty())
                                                    <div class="mega-menu-empty">No categories available</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Jobs by Location Content -->
                                        <div class="mega-menu-tab-content" id="content-location">
                                            <div class="mega-menu-grid">
                                                @php
                                                    $locations = $topLocations->chunk(ceil($topLocations->count() / 2));
                                                @endphp
                                                @foreach($locations as $chunk)
                                                    <div class="mega-menu-column">
                                                        @foreach($chunk as $location)
                                                            <a href="{{ route('public.jobs-by-city', $location->slug) }}" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    <i class="feather-map-pin"></i>
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name">Teacher jobs in {{ $location->name }}</span>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                @if($topLocations->isEmpty())
                                                    <div class="mega-menu-empty">No locations available</div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Jobs by Institution Type Content -->
                                        <div class="mega-menu-tab-content" id="content-institution">
                                            <div class="mega-menu-grid">
                                                @php
                                                    $institutions = $institutionTypes->chunk(ceil($institutionTypes->count() / 2));
                                                @endphp
                                                @foreach($institutions as $chunk)
                                                    <div class="mega-menu-column">
                                                        @foreach($chunk as $institution)
                                                            <a href="{{ $institution->url }}" class="mega-menu-grid-item">
                                                                <div class="mega-menu-grid-icon">
                                                                    <i class="feather-building"></i>
                                                                </div>
                                                                <div class="mega-menu-grid-text">
                                                                    <span class="mega-menu-grid-name">{{ $institution->name }}</span>
                                                                    <span class="mega-menu-grid-count">{{ number_format($institution->active_jobs_count ?? 0) }} Jobs</span>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                @if($institutionTypes->isEmpty())
                                                    <div class="mega-menu-empty">No institution types available</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- For Schools / Start Hiring -->
                                     <li class="nav-item">
                            <a class="nav-link" href="{{ url('/start-hiring') }}">
                                <span>{{ __('Start Hiring') }}</span>
                            </a>
                        </li>
                    </ul>
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
                                                            <span>{{ __('Dashboard') }}</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('public.account.jobseeker.dashboard') }}">
                                                            <i class="feather-home"></i>
                                                            <span>{{ __('Dashboard') }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    @if ($account->isEmployer())
                                                        <a class="dropdown-item" href="{{ route('public.account.employer.settings.edit') }}">
                                                            <i class="feather-settings"></i>
                                                            <span>{{ __('Account Settings') }}</span>
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item" href="{{ route('public.account.settings') }}">
                                                            <i class="feather-settings"></i>
                                                            <span>{{ __('Account Settings') }}</span>
                                                        </a>
                                                    @endif
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
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Login Button -->
                                        <div class="twm-nav-btn-left">
                                            <a class="twm-nav-sign-up d-inline-block" href="{{ route('public.account.login') }}">
                                                <i class="feather-log-in"></i>
                                                <span>{{ __('Login') }}</span>
                                            </a>
                                        </div>
                                        <!-- Post a Job Button -->
                                        <div class="twm-nav-btn-right">
                                            <a href="{{ auth('account')->check() ? route('public.account.jobs.create') : route('public.account.register.employer') }}" class="twm-nav-post-a-job">
                                                <i class="feather-briefcase"></i>
                                                <span>{{ __('Post a Job') }}</span>
                                            </a>
                                        </div>
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

<style>
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

/* Mobile Responsive */
@media (max-width: 991px) {
    .mega-menu {
        position: static !important;
        transform: none !important;
        left: auto !important;
        width: 100%;
        max-width: 100%;
        margin-top: 10px;
    }
    
    .mega-menu-tabs-wrapper {
        flex-wrap: wrap;
        padding: 12px 15px;
        gap: 8px;
    }
    
    .mega-menu-tab-btn {
        padding: 6px 12px;
        font-size: 11px;
    }
    
    .mega-menu-content-wrapper {
        padding: 15px;
        max-height: 350px;
    }
    
    .mega-menu-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .mega-menu-grid-item {
        padding: 10px;
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

.mega-menu-dropdown.show .dropdown-menu,
.mega-menu-dropdown[aria-expanded="true"] .dropdown-menu,
#jobs-mega-menu[style*="display: block"] {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}
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
</script>
