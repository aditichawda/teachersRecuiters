<?php
    use Botble\Base\Enums\BaseStatusEnum;
    use Botble\JobBoard\Facades\JobBoardHelper;
    use Botble\JobBoard\Repositories\Interfaces\CategoryInterface;
    
    $account = auth('account')->user();
    $company = $account->companies()->with('slugable')->first();
    $employerPublicProfileUrl = null;
    if ($account->isEmployer() && $company) {
        $companySlugKey = $company->slugable?->key ?? null;
        if (!$companySlugKey) {
            try {
                $slugModel = \Botble\Slug\Facades\SlugHelper::getSlug(null, \Botble\Slug\Facades\SlugHelper::getPrefix(\Botble\JobBoard\Models\Company::class), \Botble\JobBoard\Models\Company::class, $company->id);
                $companySlugKey = $slugModel?->key ?? null;
            } catch (\Throwable $e) {
                $companySlugKey = null;
            }
        }
        $employerPublicProfileUrl = $companySlugKey ? route('public.company', $companySlugKey) : route('public.account.companies.index');
    }
    
    // Profile completion
    $profileFields = [
        ['field' => 'name', 'label' => 'Institution Name', 'filled' => !empty($company->name)],
        ['field' => 'email', 'label' => 'Institution Email', 'filled' => !empty($company->email)],
        ['field' => 'phone', 'label' => 'Institution Phone', 'filled' => !empty($company->phone)],
        ['field' => 'logo', 'label' => 'Institution Logo', 'filled' => !empty($company->logo)],
        ['field' => 'description', 'label' => 'About Us', 'filled' => !empty($company->description)],
        ['field' => 'address', 'label' => 'Address', 'filled' => !empty($company->address)],
        ['field' => 'institution_type', 'label' => 'Institution Type', 'filled' => !empty($company->institution_type)],
        ['field' => 'year_founded', 'label' => 'Established Year', 'filled' => !empty($company->year_founded)],
        ['field' => 'campus_type', 'label' => 'Campus Type', 'filled' => !empty($company->campus_type)],
        ['field' => 'standard_level', 'label' => 'Standard Level', 'filled' => !empty($company->standard_level)],
        ['field' => 'staff_facilities', 'label' => 'Staff Facilities', 'filled' => !empty($company->staff_facilities)],
    ];
    $filledCount = collect($profileFields)->where('filled', true)->count();
    $empCompletion = count($profileFields) > 0 ? round(($filledCount / count($profileFields)) * 100) : 0;
    
    $currentUrl = url()->current();
    $menuItems = DashboardMenu::getAll('account');
    
    // Get featured categories with job counts
    $featuredCategories = collect();
    try {
        if (is_plugin_active('job-board')) {
            $featuredCategories = app(CategoryInterface::class)->getFeaturedCategories(6);
        }
    } catch (\Exception $e) {
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
        $topLocations = collect();
    }
    
    // Get institution types (categories with parent_id = 0 or specific parent)
    $institutionTypes = collect();
    try {
        if (is_plugin_active('job-board')) {
            $institutionTypes = app(CategoryInterface::class)->advancedGet([
                'condition' => [
                    'status' => BaseStatusEnum::PUBLISHED,
                    'parent_id' => 0,
                ],
                'order_by' => ['order' => 'ASC', 'created_at' => 'DESC'],
                'take' => 6,
                'with' => ['slugable'],
                'withCount' => ['activeJobs'],
            ]);
        }
    } catch (\Exception $e) {
        $institutionTypes = collect();
    }
?>

<style>
/* ===== DASHBOARD HEADER ===== */
.enl-header {
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    position: sticky;
    top: 0;
    z-index: 1000;
}
.enl-header-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 82px;
}

.enl-header-logo {
    display: flex;
    align-items: center;
}

.enl-header-right {
    display: flex;
    align-items: center;
    gap: 20px;
}
.enl-header-logo {
    display: flex;
    align-items: center;
}
.enl-header-logo a {
    display: flex;
    align-items: center;
    text-decoration: none;
}
.enl-header-logo img {
    max-height: 44px;
    width: auto;
}
.enl-header-nav {
    display: flex;
    align-items: center;
    gap: 6px;
    list-style: none;
    margin: 0;
    padding: 0;
}
.enl-header-nav {
    list-style: none;
    margin: 0;
    padding: 0;
}

.enl-header-nav li {
    display: inline-block;
}

.enl-header-nav a,
.enl-header-nav .nav-link {
    padding: 8px 14px;
    color: #555;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}
.enl-header-nav a:hover,
.enl-header-nav .nav-link:hover { background: #f0f7ff; color: #0073d1; }
.enl-header-nav a.enl-h-active,
.enl-header-nav .nav-link.active { color: #0073d1; background: #e8f4fc; }

.enl-header-right {
    display: flex;
    align-items: center;
    gap: 12px;
}
.enl-header-home {
    padding: 8px 16px;
    color: #0073d1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    border: 1.5px solid #0073d1;
    border-radius: 6px;
    transition: all 0.2s;
}
.enl-header-home:hover { background: #0073d1; color: #fff; }

.enl-header-user {
    position: relative;
}
.enl-header-user-btn {
    display: flex; align-items: center; gap: 8px;
    background: none; border: none; cursor: pointer;
    padding: 6px 10px; border-radius: 8px; transition: background 0.2s;
}
.enl-header-user-btn:hover { background: #f5f5f5; }
.enl-header-user-btn img {
    width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;
}
.enl-header-user-btn span { font-size: 13px; font-weight: 500; color: #333; }
.enl-header-user-btn i { font-size: 12px; color: #888; }

.enl-header-dropdown {
    position: absolute; top: 100%; right: 0;
    background: #fff; border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    min-width: 200px; padding: 8px 0;
    display: none; z-index: 1001;
}
.enl-header-dropdown.show { display: block; }
.enl-header-dropdown a {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 16px; color: #333; text-decoration: none;
    font-size: 14px; transition: background 0.15s;
}
.enl-header-dropdown a:hover { background: #f5f7fa; color: #0073d1; }
.enl-header-dropdown a i { width: 18px; text-align: center; color: #888; }
.enl-header-dropdown hr { margin: 4px 0; border: none; border-top: 1px solid #f0f0f0; }

@media (max-width: 768px) {
    .enl-header-nav { display: none; }
    .enl-header-user-btn span { display: none; }
}

/* ===== MEGA MENU STYLES ===== */
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
    display: none;
}

.mega-menu.show {
    display: block;
}

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

.mega-menu-tab-btn:hover {
    background: #E8F4F8;
    color: #1967D2;
}

.mega-menu-tab-btn.active {
    background: #1967D2;
    color: #fff;
}

.mega-menu-content-wrapper {
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
}

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

/* ===== NEW EMPLOYER DASHBOARD LAYOUT ===== */
.emp-new-layout {
    background: #f8f9fa;
    min-height: calc(100vh - 64px);
    padding-top: 0;
}

.emp-new-layout .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px 15px;
}

/* Hide old plugin layout */
.ps-main, .header--mobile, .ps-drawer--mobile, .ps-site-overlay { display: none !important; }

/* Profile Sidebar */
.enl-sidebar {
    background: #fff;
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
    position: sticky;
    top: 20px;
}

.enl-avatar-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.enl-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    transition: border-color 0.3s;
}

.enl-avatar-wrap:hover .enl-avatar {
    border-color: #0073d1;
}

.enl-avatar-cam {
    position: absolute;
    bottom: 0; right: 0;
    width: 28px; height: 28px;
    background: #0073d1;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 12px;
    border: 2px solid #fff;
    cursor: pointer; transition: all 0.2s;
    text-decoration: none;
}
.enl-avatar-cam:hover { background: #005bb5; transform: scale(1.1); color: #fff; }

.enl-name { font-size: 16px; font-weight: 600; color: #333; margin: 0 0 5px 0; }
.enl-date { font-size: 13px; color: #888; margin: 0 0 3px 0; }
.enl-updated { font-size: 12px; color: #aaa; margin: 0 0 15px 0; }

.enl-view-btn {
    display: inline-block;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff; padding: 7px 18px; border-radius: 6px;
    font-size: 13px; font-weight: 500; text-decoration: none;
    transition: all 0.2s; margin-bottom: 20px; border: none; cursor: pointer;
}
.enl-view-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,115,209,0.3); color: #fff; }
.enl-view-btn i { margin-right: 5px; }

/* Credits Badge */
.enl-credits {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #fff; padding: 8px 16px; border-radius: 8px;
    font-size: 13px; font-weight: 600; margin-bottom: 15px;
    width: 100%; justify-content: center;
}
.enl-credits i { font-size: 16px; }
.enl-credits-val { font-size: 18px; font-weight: 700; }

/* Completion */
.enl-completion { margin-bottom: 20px; }
.enl-completion h6 { font-size: 13px; font-weight: 500; color: #666; margin: 0 0 8px 0; }
.enl-comp-bar { height: 6px; background: #e9ecef; border-radius: 3px; overflow: hidden; }
.enl-comp-fill { height: 100%; background: #0073d1; border-radius: 3px; transition: width 0.4s ease; }
.enl-comp-text { font-size: 12px; color: #0073d1; margin-top: 5px; cursor: pointer; }

/* Post Job Button */
.enl-postjob {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 11px 16px; margin-bottom: 12px;
    background: linear-gradient(135deg, #0073d1, #005bb5);
    color: #fff !important; border-radius: 8px;
    font-size: 14px; font-weight: 600;
    text-decoration: none !important; transition: all 0.2s;
}
.enl-postjob:hover {
    background: linear-gradient(135deg, #005bb5, #003f8a);
    color: #fff !important; transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
}
.enl-postjob i { font-size: 16px; }

/* Sidebar Navigation */
.enl-nav { list-style: none; padding: 0; margin: 0; }
.enl-nav li { margin-bottom: 4px; }
.enl-nav li a {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 15px; border-radius: 8px;
    color: #333; font-size: 14px;
    text-decoration: none; transition: all 0.2s;
}
.enl-nav li a:hover, .enl-nav li a.active {
    background: #e8f4fc; color: #0073d1;
}
.enl-nav li a.active {
    border-left: 3px solid #0073d1;
}
.enl-nav li a i, .enl-nav li a svg {
    width: 20px; text-align: center; font-size: 16px;
    flex-shrink: 0;
}
.enl-nav li a svg { width: 18px; height: 18px; }

/* Main Content */
.enl-main { padding: 0 0 40px 0; }

/* Mobile header */
.enl-mobile-header {
    display: none;
    background: #fff;
    padding: 12px 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    border-radius: 0 0 12px 12px;
}
.enl-mobile-header .enl-menu-toggle {
    background: none; border: none; font-size: 22px; color: #333; cursor: pointer;
}
.enl-mobile-header .enl-logo img { max-height: 35px; }

/* Profile Modal */
.enl-pm-overlay {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5); z-index: 99999;
    display: flex; align-items: center; justify-content: center;
    padding: 20px; animation: enlFadeIn 0.25s ease;
}
@keyframes enlFadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes enlSlideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
.enl-pm-modal {
    background: #fff; border-radius: 16px; width: 100%; max-width: 400px;
    max-height: 85vh; overflow-y: auto; padding: 25px 20px;
    position: relative; box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: enlSlideUp 0.3s ease;
}
.enl-pm-close {
    position: absolute; top: 10px; right: 14px;
    background: none; border: none; font-size: 28px; color: #999;
    cursor: pointer; line-height: 1; z-index: 10;
}
.enl-pm-close:hover { color: #333; }
.enl-pm-badge {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: #fff; border-radius: 30px; padding: 12px 22px;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    font-size: 15px; font-weight: 600; margin-bottom: 20px;
}
.enl-pm-badge i { font-size: 18px; }
.enl-pm-badge-val { font-size: 22px; font-weight: 800; }
.enl-pm-comp { margin-bottom: 18px; }
.enl-pm-comp-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 8px; }
.enl-pm-bar { height: 10px; background: #e9ecef; border-radius: 10px; overflow: hidden; margin-bottom: 6px; }
.enl-pm-bar-fill { height: 100%; background: linear-gradient(90deg, #0073d1, #00b4d8); border-radius: 10px; }
.enl-pm-comp-text { font-size: 13px; font-weight: 600; color: #0073d1; }
.enl-pm-field {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 12px; border-radius: 8px; margin-bottom: 6px; background: #f8f9fa;
}
.enl-pm-field:hover { background: #f0f4f8; }
.enl-pm-field-name { display: flex; align-items: center; font-size: 14px; font-weight: 500; color: #333; }
.enl-pm-field-status { font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 12px; }
.enl-pm-field-status.done { background: #d4edda; color: #28a745; }
.enl-pm-field-status.pending { background: #fff3cd; color: #856404; }
.enl-pm-complete-btn {
    display: block; text-align: center; margin-top: 18px; padding: 12px;
    background: linear-gradient(135deg, #0073d1, #00b4d8); color: #fff !important;
    border-radius: 10px; font-weight: 600; font-size: 14px; text-decoration: none !important;
}
.enl-pm-complete-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,115,209,0.4); color: #fff !important; }
.enl-pm-congrats {
    display: flex; align-items: center; gap: 10px; padding: 14px;
    background: #fff8e1; border-radius: 10px; margin-top: 18px;
    font-size: 13px; font-weight: 600; color: #333;
}

/* Layout Grid */
.enl-row {
    display: flex;
    gap: 15px;
}
.enl-sidebar-col {
    flex: 0 0 280px;
    max-width: 280px;
}
.enl-main-col {
    flex: 1;
    min-width: 0;
}

/* Responsive */
@media (max-width: 991px) {
    .enl-sidebar { padding: 20px; }
    .enl-main { padding: 20px 0 0 0; }
    .enl-sidebar-col { flex: 0 0 250px; max-width: 250px; }
}
@media (max-width: 768px) {
    .enl-row { flex-direction: column; }
    .enl-sidebar-col { display: none; }
    .enl-mobile-header { display: flex; }
    .enl-main { padding: 15px 0; }
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Dashboard Header -->
<div class="enl-header">
    <div class="enl-header-inner">
        <!-- Logo -->
        <div class="enl-header-logo">
        <?php if(Theme::getLogo()): ?>
                <a href="<?php echo e(BaseHelper::getHomepageUrl()); ?>">
                                    <?php echo Theme::getLogoImage([], 'logo_light', 44); ?>

                            </a>
                <?php endif; ?>
        </div>

        <!-- Right -->
        <div class="enl-header-right" style="display: flex; align-items: center; gap: 20px;">
            <!-- Nav Items Next to User -->
            <ul class="enl-header-nav" style="margin: 0; padding: 0;">
            <!-- Home Icon - Visible for Employers -->
            <li class="nav-item">
                <a class="nav-link" style="color: black; font-size: 20px !important; padding: 8px 12px;" href="<?php echo e(BaseHelper::getHomepageUrl()); ?>" title="<?php echo e(__('Home')); ?>">
                    <i class="feather-home" style="font-size: 20px !important;"></i>
                            </a>
                        </li>
            
            <!-- FAQ -->
                        <li class="nav-item">
                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.faq')); ?>">
                    <span><?php echo e(__('FAQ')); ?></span>
                            </a>
                        </li>

            <!-- Plans -->
            <li class="nav-item">
                <a class="nav-link" style="color: black;" href="<?php echo e(route('public.premium-service')); ?>">
                    <span><?php echo e(__('Plans')); ?></span>
                                                            </a>
                        </li>

            <!-- Notifications -->
                                     <li class="nav-item">
                <a class="nav-link" style="color: black; font-size: 20px !important;" href="<?php echo e(route('public.notifications')); ?>" title="<?php echo e(__('Notifications')); ?>">
                    <i class="feather-bell" style="font-size: 20px !important;"></i>
                            </a>
                        </li>
        </ul>

            <div class="enl-header-user">
                <button class="enl-header-user-btn" onclick="document.getElementById('enlUserDropdown').classList.toggle('show')">
                    <?php if($company && $company->logo): ?>
                        <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($account->name); ?>">
                    <?php else: ?>
                        <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>">
                    <?php endif; ?>
                    <span><?php echo e($account->first_name ?? $account->name); ?></span>
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="enl-header-dropdown" id="enlUserDropdown">
                    <a href="<?php echo e(route('public.account.dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a>
                    <a href="<?php echo e(route('public.account.employer.settings.edit')); ?>"><i class="fa fa-cog"></i> Account Settings</a>
                    <hr>
                    <a href="<?php echo e(route('public.account.logout')); ?>" id="logout-link-enl" onclick="event.preventDefault(); var f = document.getElementById('logout-form-enl'); if (!f) return false; if (typeof window.showDialogConfirm === 'function') { window.showDialogConfirm('Are you sure you want to logout?', 'Logout').then(function(ok) { if (ok) f.submit(); }).catch(function() { if (confirm('Do you want to logout?')) f.submit(); }); } else { if (confirm('Do you want to logout?')) f.submit(); } return false;"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form-enl" style="display:none;" action="<?php echo e(route('public.account.logout')); ?>" method="POST"><?php echo csrf_field(); ?></form>

<!-- Dialog Alert Container - Required for logout dialog -->
<div id="dialog-alert-container"></div>

<!-- Ensure Dialog System is Loaded -->
<?php if(!isset($dialogSystemLoaded)): ?>
    <?php
        Theme::asset()->usePath()->add('dialog-alert-css', 'css/dialog-alert.css', [], [], '1.0');
        Theme::asset()->container('footer')->usePath()->add('dialog-alert-js', 'js/dialog-alert.js', ['jquery'], [], '1.0');
        $dialogSystemLoaded = true;
    ?>
<?php endif; ?>

<!-- Ensure jQuery is loaded before dialog system -->
<script>
    // Ensure jQuery is available
    if (typeof jQuery === 'undefined' && typeof $ === 'undefined') {
        console.warn('jQuery not found, loading from CDN');
        var script = document.createElement('script');
        script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        script.onload = function() {
            console.log('jQuery loaded from CDN');
        };
        document.head.appendChild(script);
    }
</script>

<div class="emp-new-layout">
    <div class="container">
        <div class="enl-row">
            <!-- Sidebar -->
            <div class="enl-sidebar-col">
                <div class="enl-sidebar">
                    <div class="text-center">
                        <div class="enl-avatar-wrap" style="cursor:pointer;" onclick="document.getElementById('enlAvatarModal').style.display='flex'">
                            <?php if($company && $company->logo): ?>
                                <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="<?php echo e($company->name ?? $account->name); ?>" class="enl-avatar">
                            <?php else: ?>
                                <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" class="enl-avatar">
                            <?php endif; ?>
                            <span class="enl-avatar-cam" title="Change Photo">
                                <i class="fa fa-camera"></i>
                            </span>
                        </div>
                        <h5 class="enl-name">Hello, <?php echo e($company->name ?? $account->name); ?></h5>
                        <p class="enl-date">Joined <?php echo e($account->created_at->format('M d, Y')); ?></p>
                        <p class="enl-updated">Last Updated: <?php echo e($account->updated_at->format('M d, Y')); ?></p>
                        <?php if($account->isEmployer()): ?>
                        <a href="<?php echo e($employerPublicProfileUrl ?? route('public.account.companies.index')); ?>" class="enl-view-btn" style="display:inline-block;text-decoration:none;" <?php echo e(($employerPublicProfileUrl && $employerPublicProfileUrl !== route('public.account.companies.index')) ? 'target="_blank" rel="noopener"' : ''); ?>>
                            <i class="fa fa-eye"></i> View Profile
                        </a>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Credits (click opens profile completion modal) -->
                    <div class="enl-credits" onclick="document.getElementById('enlProfileModal').style.display='flex'" style="cursor:pointer;">
                        <i class="fa fa-coins"></i>
                        <span>Credits:</span>
                        <span class="enl-credits-val"><?php echo e($account->credits ?? 0); ?></span>
                    </div>

                    <!-- Profile Completion -->
                    <div class="enl-completion">
                        <h6>Profile Completion</h6>
                        <div class="enl-comp-bar">
                            <div class="enl-comp-fill" style="width: <?php echo e($empCompletion); ?>%"></div>
                        </div>
                        <span class="enl-comp-text" onclick="document.getElementById('enlProfileModal').style.display='flex'"><?php echo e($empCompletion); ?>% Complete</span>
                    </div>
                    
                    <!-- Post Job Button -->
                    <a href="<?php echo e(route('public.account.jobs.create')); ?>" class="enl-postjob">
                        <i class="fa fa-plus-circle"></i> Post Job
                    </a>

                    <!-- Admission Button (employer only) -->
                    <a href="<?php echo e(route('public.account.admission.edit')); ?>" class="enl-postjob" style="background: linear-gradient(135deg, #059669, #047857); margin-top: 8px;">
                        <i class="fa fa-graduation-cap"></i> <?php echo e(__('Admission')); ?>

                    </a>
                    
                    <!-- Navigation -->
                    <ul class="enl-nav">
                        <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(! $item['name']) continue; ?>
                            <?php
                                $employerOnlyIds = ['cms-account-wallet', 'cms-account-packages', 'cms-account-invoices'];
                                if (in_array($item['id'] ?? '', $employerOnlyIds) && !optional(auth('account')->user())->isEmployer()) {
                                    continue;
                                }
                            ?>
                            <li>
                                <a href="<?php echo e($item['url']); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $item['active']]); ?>">
                                    <?php if(str_contains($item['icon'] ?? '', 'ti ')): ?>
                                        <?php if (isset($component)) { $__componentOriginal73995948b3bd877b76251b40caf28170 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal73995948b3bd877b76251b40caf28170 = $attributes; } ?>
<?php $component = Botble\Icon\View\Components\Icon::resolve(['name' => $item['icon']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('core::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Botble\Icon\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $attributes = $__attributesOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__attributesOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal73995948b3bd877b76251b40caf28170)): ?>
<?php $component = $__componentOriginal73995948b3bd877b76251b40caf28170; ?>
<?php unset($__componentOriginal73995948b3bd877b76251b40caf28170); ?>
<?php endif; ?>
                                    <?php else: ?>
                                        <i class="<?php echo e($item['icon'] ?? 'fa fa-circle'); ?>"></i>
                                    <?php endif; ?>
                                    <?php if(($item['id'] ?? '') === 'cms-account-change-password' || $item['url'] === route('public.account.security')): ?>
                                        <?php echo e(trans('plugins/job-board::dashboard.menu.change_password')); ?>

                                    <?php else: ?>
                                        <?php echo e(trans($item['name'])); ?>

                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="enl-main-col">
                <div class="enl-main">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Completion Modal -->
<div id="enlProfileModal" class="enl-pm-overlay" style="display:none;">
    <div class="enl-pm-modal">
        <button type="button" class="enl-pm-close" onclick="document.getElementById('enlProfileModal').style.display='none'">&times;</button>
        
        <div class="enl-pm-badge">
            <i class="fa fa-coins"></i>
            <span>Credits:</span>
            <span class="enl-pm-badge-val"><?php echo e($account->credits ?? 0); ?></span>
        </div>

        <div class="enl-pm-comp">
            <h6 class="enl-pm-comp-title">Profile Completion</h6>
            <div class="enl-pm-bar">
                <div class="enl-pm-bar-fill" style="width: <?php echo e($empCompletion); ?>%"></div>
            </div>
            <span class="enl-pm-comp-text"><?php echo e($empCompletion); ?>% Complete</span>
        </div>

        <div>
            <?php $__currentLoopData = $profileFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="enl-pm-field">
                    <span class="enl-pm-field-name">
                        <i class="fa <?php echo e($pf['filled'] ? 'fa-check-circle' : 'fa-times-circle'); ?>" style="color: <?php echo e($pf['filled'] ? '#28a745' : '#dc3545'); ?>; margin-right: 8px;"></i>
                        <?php echo e($pf['label']); ?>

                    </span>
                    <span class="enl-pm-field-status <?php echo e($pf['filled'] ? 'done' : 'pending'); ?>">
                        <?php echo e($pf['filled'] ? 'Done' : 'Pending'); ?>

                    </span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($empCompletion < 100): ?>
            <a href="<?php echo e(route('public.account.settings')); ?>" class="enl-pm-complete-btn">
                <i class="fa fa-building"></i> Complete Your Profile
            </a>
        <?php else: ?>
            <div class="enl-pm-congrats">
                <i class="fa fa-trophy" style="color: #f59e0b; font-size: 20px;"></i>
                <span>Congratulations! Your profile is 100% complete.</span>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Avatar Change Modal -->
<div id="enlAvatarModal" class="enl-pm-overlay" style="display:none;">
    <div class="enl-pm-modal" style="max-width:450px;">
        <button type="button" class="enl-pm-close" onclick="document.getElementById('enlAvatarModal').style.display='none'">&times;</button>
        
        <h5 style="font-size:18px;font-weight:700;color:#333;margin-bottom:20px;text-align:center;">
            <i class="fa fa-camera" style="color:#0073d1;margin-right:8px;"></i> Change Profile Photo
        </h5>

        <!-- Current Photo -->
        <div style="text-align:center;margin-bottom:20px;">
            <?php if($company && $company->logo): ?>
                <img src="<?php echo e(RvMedia::getImageUrl($company->logo)); ?>" alt="" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;">
            <?php else: ?>
                <img src="<?php echo e($account->avatar_url); ?>" alt="" id="enlCurrentAvatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;">
            <?php endif; ?>
        </div>

        <!-- Upload Form -->
        <form id="enlAvatarForm" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="avatar_src" value="">
            <input type="hidden" name="avatar_data" id="enlAvatarData" value="">
            
            <div style="margin-bottom:16px;">
                <label for="enlAvatarInput" style="display:block;padding:14px;border:2px dashed #d0d5dd;border-radius:10px;text-align:center;cursor:pointer;transition:all 0.2s;background:#fafbfc;">
                    <i class="fa fa-cloud-upload-alt" style="font-size:24px;color:#0073d1;display:block;margin-bottom:8px;"></i>
                    <span style="font-size:14px;color:#555;font-weight:500;">Click to choose a photo</span>
                    <br><small style="color:#999;">JPG, PNG, GIF (Max 2MB)</small>
                </label>
                <input type="file" id="enlAvatarInput" name="avatar_file" accept="image/*" style="display:none;" onchange="enlPreviewAvatar(this)">
            </div>

            <!-- Preview -->
            <div id="enlAvatarPreview" style="display:none;text-align:center;margin-bottom:16px;">
                <img id="enlPreviewImg" src="" alt="Preview" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #0073d1;">
                <p style="font-size:13px;color:#28a745;margin-top:8px;"><i class="fa fa-check-circle"></i> Photo selected</p>
            </div>

            <!-- Status message -->
            <div id="enlAvatarStatus" style="display:none;text-align:center;margin-bottom:12px;padding:10px;border-radius:8px;font-size:13px;font-weight:500;"></div>

            <div style="display:flex;gap:10px;justify-content:center;">
                <button type="button" onclick="document.getElementById('enlAvatarModal').style.display='none'" style="padding:10px 24px;border:1.5px solid #ddd;border-radius:8px;background:#fff;color:#555;font-size:14px;font-weight:500;cursor:pointer;">Cancel</button>
                <button type="button" id="enlAvatarSaveBtn" disabled onclick="enlUploadAvatar()" style="padding:10px 24px;border:none;border-radius:8px;background:linear-gradient(135deg,#0073d1,#005bb5);color:#fff;font-size:14px;font-weight:600;cursor:pointer;opacity:0.5;">
                    <i class="fa fa-check"></i> Save Photo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
var enlSelectedFile = null;

function enlPreviewAvatar(input) {
    if (input.files && input.files[0]) {
        enlSelectedFile = input.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('enlPreviewImg').src = e.target.result;
            document.getElementById('enlAvatarPreview').style.display = 'block';
            document.getElementById('enlAvatarStatus').style.display = 'none';
            var btn = document.getElementById('enlAvatarSaveBtn');
            btn.disabled = false;
            btn.style.opacity = '1';

            // Get image dimensions for avatar_data
            var img = new Image();
            img.onload = function() {
                var size = Math.min(img.width, img.height);
                var cropData = JSON.stringify({
                    x: 0, y: 0,
                    width: size, height: size,
                    rotate: 0, scaleX: 1, scaleY: 1
                });
                document.getElementById('enlAvatarData').value = cropData;
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function enlUploadAvatar() {
    var btn = document.getElementById('enlAvatarSaveBtn');
    var status = document.getElementById('enlAvatarStatus');
    var fileInput = document.getElementById('enlAvatarInput');

    if (!fileInput.files || !fileInput.files[0]) {
        status.style.display = 'block';
        status.style.background = '#fff3cd';
        status.style.color = '#856404';
        status.textContent = 'Please select a photo first.';
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Uploading...';

    var formData = new FormData();
    formData.append('avatar_file', fileInput.files[0]);
    formData.append('avatar_data', document.getElementById('enlAvatarData').value);
    formData.append('avatar_src', '');
    formData.append('_token', '<?php echo e(csrf_token()); ?>');

    fetch('<?php echo e(route("public.account.avatar")); ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
            'Accept': 'application/json'
        }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.error === false || data.error === 0) {
            status.style.display = 'block';
            status.style.background = '#d4edda';
            status.style.color = '#155724';
            status.textContent = 'Photo updated successfully! Refreshing...';
            setTimeout(function() { window.location.reload(); }, 1000);
        } else {
            status.style.display = 'block';
            status.style.background = '#f8d7da';
            status.style.color = '#721c24';
            status.textContent = data.message || 'Failed to upload photo.';
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-check"></i> Save Photo';
        }
    })
    .catch(function(err) {
        status.style.display = 'block';
        status.style.background = '#f8d7da';
        status.style.color = '#721c24';
        status.textContent = 'Upload failed. Please try again.';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-check"></i> Save Photo';
    });
}
</script>

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
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mega menu
    const dropdown = document.querySelector('.mega-menu-dropdown');
    const menu = document.getElementById('jobs-mega-menu');
    const toggle = document.getElementById('jobs-dropdown');
    
    if (dropdown && menu && toggle) {
        // Set default tab to categories on load
        const defaultTab = document.getElementById('content-categories');
        if (defaultTab) {
            defaultTab.classList.add('active');
        }
        const defaultBtn = document.querySelector('.mega-menu-tab-btn[data-tab="categories"]');
        if (defaultBtn) {
            defaultBtn.classList.add('active');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target)) {
                hideMegaMenu();
            }
        });
    }
    
    // Profile modal
    var modal = document.getElementById('enlProfileModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) this.style.display = 'none';
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (modal) modal.style.display = 'none';
            if (avatarModal) avatarModal.style.display = 'none';
        }
    });

    // Avatar modal
    var avatarModal = document.getElementById('enlAvatarModal');
    if (avatarModal) {
        avatarModal.addEventListener('click', function(e) {
            if (e.target === this) this.style.display = 'none';
        });
    }

    // User dropdown close on outside click
    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('enlUserDropdown');
        var btn = e.target.closest('.enl-header-user-btn');
        var logoutLink = e.target.closest('#logout-link-enl');
        
        // Don't close dropdown if clicking logout link (it will handle its own click)
        if (logoutLink) {
            return;
        }
        
        if (!btn && dropdown) {
            dropdown.classList.remove('show');
        }
    });

    // Smooth navigation for sidebar menu - load content without full page reload
    // Use event delegation to catch all clicks, including dynamically added links
    const mainContent = document.querySelector('.enl-main');
    
    // Attach to document to catch all clicks
    document.addEventListener('click', function(e) {
        // Find the closest link
        const link = e.target.closest('.enl-nav a');
        if (!link) return;
        
        const href = link.getAttribute('href');
        
        // Skip if it's an external link, logout, or special action
        if (!href || 
            href.startsWith('#') || 
            href.startsWith('javascript:') ||
            link.hasAttribute('onclick') ||
            href.includes('logout') ||
            href.includes('create') ||
            href.includes('edit')) {
            return; // Let default behavior happen
        }
        
        // Skip AJAX for candidates - let it do normal navigation
        // Check for candidates in href (case insensitive)
        if (href && (href.toLowerCase().includes('candidates') || href.includes('/candidates'))) {
            // Normal page navigation for candidates - don't intercept
            return;
        }
        
        // Check if it's a dashboard route
        if (href.includes('/account/')) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            // Show loader
            const loader = document.getElementById('page-loading');
            if (loader) {
                loader.classList.add('show');
            }
            if (mainContent) {
                mainContent.style.opacity = '0.5';
                mainContent.style.pointerEvents = 'none';
            }
            
            // Update active state
            document.querySelectorAll('.enl-nav a').forEach(function(l) {
                l.classList.remove('active');
            });
            link.classList.add('active');
            
            // Load content via AJAX - same as companies page
            fetch(href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                },
                credentials: 'same-origin'
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(function(html) {
                if (!html || !html.trim()) {
                    throw new Error('Empty response');
                }
                
                // Parse HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                // Find .enl-main in response
                const responseMain = doc.querySelector('.enl-main');
                
                if (!responseMain || !mainContent) {
                    // Fallback to normal navigation
                    window.location.href = href;
                    return;
                }
                
                // Get the innerHTML of .enl-main
                const contentHTML = responseMain.innerHTML;
                
                if (!contentHTML || contentHTML.trim().length < 10) {
                    // Content too short, reload page
                    window.location.href = href;
                    return;
                }
                
                // Update content
                mainContent.innerHTML = contentHTML;
                
                // Update URL
                window.history.pushState({}, '', href);
                
                // Re-run scripts
                const scripts = mainContent.querySelectorAll('script');
                scripts.forEach(function(oldScript) {
                    const newScript = document.createElement('script');
                    Array.from(oldScript.attributes).forEach(function(attr) {
                        newScript.setAttribute(attr.name, attr.value);
                    });
                    newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                    oldScript.parentNode.replaceChild(newScript, oldScript);
                });
                
                // Reinitialize jQuery
                if (typeof $ !== 'undefined') {
                    $(document).ready(function() {
                        $(document).trigger('contentLoaded');
                    });
                }
            })
            .catch(function(error) {
                // On any error, do normal navigation
                window.location.href = href;
            })
            .finally(function() {
                // Hide loader
                const loader = document.getElementById('page-loading');
                if (loader) {
                    loader.classList.remove('show');
                }
                if (mainContent) {
                    mainContent.style.opacity = '1';
                    mainContent.style.pointerEvents = 'auto';
                }
            });
        }
        }
    });
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        if (e.state) {
            window.location.reload();
        }
    });
});

// Logout Button Handler for Employer Dashboard
(function() {
    function showLogoutDialog() {
        const logoutForm = document.getElementById('logout-form-enl');
        if (!logoutForm) {
            console.error('Logout form not found');
            return;
        }

        // Wait for dialog system to be available
        function tryShowDialog(attempts) {
            attempts = attempts || 0;
            
            if (typeof window.showDialogConfirm === 'function') {
                // Use custom dialog
                window.showDialogConfirm('Are you sure you want to logout?', 'Logout').then(function(confirmed) {
                    if (confirmed) {
                        logoutForm.submit();
                    }
                }).catch(function(error) {
                    console.error('Dialog error:', error);
                    // Fallback to native confirm
                    if (confirm('Do you want to logout?')) {
                        logoutForm.submit();
                    }
                });
            } else if (attempts < 50) {
                // Retry after 100ms
                setTimeout(function() {
                    tryShowDialog(attempts + 1);
                }, 100);
            } else {
                // Fallback to native confirm after max attempts
                if (confirm('Do you want to logout?')) {
                    logoutForm.submit();
                }
            }
        }
        
        tryShowDialog();
    }
    
    function initLogoutHandler() {
        const logoutLink = document.getElementById('logout-link-enl');
        
        if (logoutLink) {
            // Remove any existing listeners by cloning
            const newLogoutLink = logoutLink.cloneNode(true);
            logoutLink.parentNode.replaceChild(newLogoutLink, logoutLink);
            
            // Add click handler
            newLogoutLink.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showLogoutDialog();
                return false;
            });
            
            console.log('Employer dashboard logout handler initialized');
        } else {
            // Retry if element not found
            setTimeout(initLogoutHandler, 200);
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(initLogoutHandler, 500);
        });
    } else {
        setTimeout(initLogoutHandler, 500);
    }
    
    // Also try after window load
    window.addEventListener('load', function() {
        setTimeout(initLogoutHandler, 500);
    });
})();
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/dashboard/layouts/body.blade.php ENDPATH**/ ?>