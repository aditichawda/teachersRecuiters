@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->add('tagify-css', 'vendor/core/core/base/libraries/tagify/tagify.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    Theme::asset()->container('footer')->add('tagify-js', 'vendor/core/core/base/libraries/tagify/tagify.js');
    Theme::asset()->container('footer')->usePath()->add('tags-js', 'js/tagify-select.js');

    $jobSeekerCtx = null;
    if (auth('account')->check() && ($account ?? null) && $account->isJobSeeker()) {
        try {
            $jobSeekerCtx = \Botble\JobBoard\Supports\JobSeekerPackageContext::forAccount($account);
        } catch (\Throwable $e) {
            // Silently fail if JobSeekerPackageContext fails
            $jobSeekerCtx = null;
        }
    }

    // Profile completion with per-field reward points
    $profileFields = [
        ['field' => 'first_name', 'label' => 'Full Name', 'points' => 10, 'filled' => !empty($account->first_name)],
        ['field' => 'phone', 'label' => 'Mobile Number', 'points' => 10, 'filled' => !empty($account->phone)],
        ['field' => 'avatar', 'label' => 'Profile Photo', 'points' => 15, 'filled' => !empty($account->avatar_id)],
        ['field' => 'bio', 'label' => 'About / Bio', 'points' => 10, 'filled' => !empty($account->bio)],
        ['field' => 'resume', 'label' => 'Resume', 'points' => 20, 'filled' => !empty($account->resume)],
        ['field' => 'address', 'label' => 'Location/Address', 'points' => 10, 'filled' => !empty($account->address)],
        ['field' => 'dob', 'label' => 'Date of Birth', 'points' => 5, 'filled' => !empty($account->dob)],
        ['field' => 'gender', 'label' => 'Gender', 'points' => 5, 'filled' => !empty($account->gender)],
        ['field' => 'total_experience', 'label' => 'Total Experience', 'points' => 10, 'filled' => !empty($account->total_experience)],
        ['field' => 'current_salary', 'label' => 'Salary Details', 'points' => 5, 'filled' => !empty($account->current_salary)],
    ];
    $totalPoints = array_sum(array_column($profileFields, 'points'));
    $earnedPoints = 0;
    foreach ($profileFields as $pf) {
        if ($pf['filled']) $earnedPoints += $pf['points'];
    }
    $completion = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
    $walletPoints = $earnedPoints;
@endphp

<style>
.js-settings-page {
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
    margin-top: 0;
    padding-top: 20px;
}

/* Profile Sidebar */
.js-profile-sidebar {
    background: #fff;
    border-radius: 12px;
    padding: 25px 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.js-profile-avatar-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 15px;
}

.js-profile-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e2e8f0;
    transition: border-color 0.3s;
}

.js-profile-avatar-wrapper:hover .js-profile-avatar {
    border-color: #0073d1;
}

.js-avatar-camera-btn {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 28px;
    height: 28px;
    background: #0073d1;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    border: 2px solid #fff;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
}

.js-avatar-camera-btn:hover {
    background: #005bb5;
    transform: scale(1.1);
    color: #fff;
}

.js-profile-name {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
}

.js-profile-date {
    font-size: 13px;
    color: #888;
    margin: 0 0 3px 0;
}

.js-profile-updated {
    font-size: 12px;
    color: #aaa;
    margin: 0 0 15px 0;
}

.js-view-profile-btn {
    display: inline-block;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff;
    padding: 7px 18px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    margin-bottom: 20px;
    border: none;
    cursor: pointer;
}

.js-view-profile-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,115,209,0.3);
    color: #fff;
}

.js-view-profile-btn.js-view-profile-edit {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
}

.js-view-profile-btn.js-view-profile-edit:hover {
    color: #fff;
    box-shadow: 0 4px 12px rgba(71, 85, 105, 0.3);
}

.js-view-profile-btn i {
    margin-right: 5px;
}

.js-profile-completion {
    margin-bottom: 25px;
}
.js-profile-completion h6 {
    font-size: 13px;
    font-weight: 500;
    color: #666;
    margin: 0 0 8px 0;
}

.js-completion-bar {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
}

.js-completion-fill {
    height: 100%;
    background: #0073d1;
    border-radius: 3px;
}

.js-completion-text {
    font-size: 12px;
    color: #0073d1;
    margin-top: 5px;
}

/* Sidebar Navigation */
.js-sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.js-sidebar-nav li {
    margin-bottom: 5px;
}

.js-sidebar-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.js-sidebar-nav a:hover,
.js-sidebar-nav a.active {
    background: #e8f4fc;
    color: #0073d1;
}

.js-sidebar-nav a.active {
    border-left: 3px solid #0073d1;
}

.js-sidebar-nav i {
    width: 20px;
    text-align: center;
    font-size: 16px;
}

/* Main Content Area – ensure right column always visible */
.js-settings-main-col {
    display: block !important;
    min-width: 280px;
    margin-top: 0;
}
.js-main-content {
    padding: 0 0 40px 0;
    width: 100%;
    display: block !important;
}
/* Wallet page: ensure theme CSS does not hide or clip content */
.js-main-content-wallet {
    overflow: visible !important;
    min-height: 0 !important;
}
.js-main-content-wallet .wallet-js-page,
.js-main-content-wallet .wallet-js-page * {
    visibility: visible !important;
}
.js-main-content-wallet .wallet-js-page .row {
    display: flex !important;
    flex-wrap: wrap !important;
}
.js-main-content-wallet .wallet-js-page .card {
    display: block !important;
}
.js-main-content-wallet .wallet-js-page [class*="col-"] {
    display: block !important;
}
@media (min-width: 768px) {
    .js-main-content-wallet .wallet-js-page .col-md-4 {
        display: block !important;
        width: 33.333333% !important;
    }
}
@media (min-width: 992px) {
    .js-main-content-wallet .wallet-js-page .col-lg-5 { width: 41.666667% !important; flex: 0 0 41.666667% !important; }
}

/* ===== RESPONSIVE STYLES FOR ALL SIDEBARS ===== */
/* Account Sidebar Responsive */
@media (max-width: 991px) {
    .side-bar-st-1 {
        position: fixed;
        left: -280px;
        top: 0;
        height: 100vh;
        z-index: 1000;
        background: #fff;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: left 0.3s ease;
        overflow-y: auto;
        padding: 20px;
        width: 280px;
        max-width: 280px;
    }
    
    .side-bar-st-1.show {
        left: 0;
    }
    
    /* Sidebar Toggle Button */
    .account-sidebar-toggle {
        display: flex;
        position: fixed;
        top: 90px;
        left: 15px;
        z-index: 1001;
        background: #0073d1;
        color: #fff;
        border: none;
        border-radius: 8px;
        width: 45px;
        height: 45px;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transition: all 0.3s ease;
        align-items: center;
        justify-content: center;
    }
    
    .account-sidebar-toggle:hover {
        background: #005bb5;
        transform: scale(1.05);
    }
    
    .account-sidebar-toggle.active {
        left: 265px;
    }
    
    /* Sidebar Overlay */
    .account-sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .account-sidebar-overlay.show {
        display: block;
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .side-bar-st-1 {
        width: 260px;
        max-width: 260px;
        left: -260px;
    }
    
    .account-sidebar-toggle {
        top: 70px;
        left: 10px;
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .account-sidebar-toggle.active {
        left: 250px;
    }
}

@media (max-width: 576px) {
    .side-bar-st-1 {
        width: 100%;
        max-width: 100%;
    }
    
    .account-sidebar-toggle.active {
        left: calc(100% - 50px);
    }
}

.js-page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.js-page-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-page-header a {
    color: #0073d1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

.js-page-header a:hover {
    text-decoration: underline;
}

/* Content Card */
.js-content-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.js-content-card-header {
    padding: 20px;
    border-bottom: 1px solid #f0f0f0;
}

.js-content-card-header h5 {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.js-content-card-body {
    padding: 25px;
}

/* Form Styling */
.js-content-card .form-group {
    margin-bottom: 20px;
}

.js-content-card .form-label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.js-content-card .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 8px 14px;
    height: 40px;
    font-size: 14px;
}

.js-content-card .form-control:focus {
    border-color: #0073d1;
    box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
}

.js-content-card .btn-primary {
    background: #0073d1;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 14px;
    font-weight: 500;
}

.js-content-card .btn-primary:hover {
    background: #005bb5;
}

/* Wallet Badge */
.js-wallet-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #fff;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 15px;
    width: 100%;
    justify-content: center;
}

.js-wallet-badge i { font-size: 16px; }
.js-wallet-points { font-size: 18px; font-weight: 700; }

/* Profile Field Progress */
.js-field-progress { margin-top: 10px; }

.js-field-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 0;
    font-size: 12px;
    border-bottom: 1px solid #f5f5f5;
}
.js-field-item:last-child { border-bottom: none; }

.js-field-item .field-name {
    color: #555;
    display: flex;
    align-items: center;
    gap: 6px;
}
.js-field-item .field-name i { font-size: 10px; }
.js-field-item .field-name i.completed { color: #28a745; }
.js-field-item .field-name i.pending { color: #dc3545; }

.js-field-item .field-points {
    font-weight: 600;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
}
.js-field-item .field-points.earned { background: #e8f5e9; color: #28a745; }
.js-field-item .field-points.available { background: #fff3e0; color: #e65100; }

.js-reward-message {
    background: linear-gradient(135deg, #fff3e0, #ffe0b2);
    border: 1px solid #ffcc80;
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 15px;
    font-size: 13px;
    color: #e65100;
    display: flex;
    align-items: center;
    gap: 8px;
}
.js-reward-message i { font-size: 18px; color: #f57c00; }

/* Responsive */
@media (max-width: 991px) {
    .js-profile-sidebar {
        padding: 20px;
    }
    .js-main-content {
        padding: 20px 0 0 0;
    }

    .js-settings-page {
        padding-top: 10px;
    }
}

@media (max-width: 991px) {
    .js-profile-sidebar {
        position: fixed;
        left: -280px;
        top: 0;
        height: 100vh;
        z-index: 1001;
        background: #fff;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow-y: auto;
        padding: 20px;
        width: 280px;
        max-width: 280px;
        -webkit-overflow-scrolling: touch;
    }
    
    .js-profile-sidebar.show {
        left: 0;
    }
    
    /* Show sidebar toggle on tablet */
    .js-sidebar-toggle {
        display: flex !important;
    }
    
    .js-main-content {
        padding: 20px 0 0 0;
    }
}

@media (max-width: 768px) {
    .js-profile-sidebar {
        width: 260px;
        max-width: 85vw;
        left: -260px;
        z-index: 1001;
        box-shadow: 2px 0 20px rgba(0,0,0,0.15);
    }
    
    .js-profile-sidebar.show {
        left: 0;
    }
    
    .js-sidebar-toggle {
        display: flex !important;
        top: 15px;
        left: 15px;
        width: 44px;
        height: 44px;
        font-size: 18px;
        z-index: 1002;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    
    .js-sidebar-toggle.active {
        /* left: 245px; */
        z-index: 1003;
    }
    
    .js-sidebar-overlay {
        z-index: 1000;
    }
    
    .js-main-content {
        padding: 15px 0;
    }
    
    .js-settings-page {
        padding-top: 8px;
    }
}

@media (max-width: 576px) {
    .js-profile-sidebar {
        width: 100%;
        max-width: 100%;
        left: -100%;
    }
    
    .js-profile-sidebar.show {
        left: 0;
    }
    
    .js-sidebar-toggle {
        top: 45px;
        left: 12px;
        width: 30px;
        height: 30px;
    }
    
    .js-sidebar-toggle.active {
        left: calc(100% - 54px);
    }
}

/* ===== DASHBOARD HEADER ===== */
.enl-header {
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    position: sticky;
    top: 0;
    z-index: 998;
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
    width: 34px !important; 
    height: 34px !important; 
    border-radius: 50% !important; 
    object-fit: cover !important; 
    border: 2px solid #e2e8f0 !important;
    display: block !important;
    flex-shrink: 0 !important;
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

/* Navbar Mobile Toggle Button */
.enl-navbar-toggle {
    display: none;
    background: transparent;
    color: #333;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    width: 40px;
    height: 40px;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1002;
    margin-left: 15px;
}

.enl-navbar-toggle:hover {
    background: #f5f5f5;
    border-color: #d1d5db;
    color: #0073d1;
}

/* Navbar Right Side Drawer */
.enl-navbar-drawer {
    position: fixed;
    top: 0;
    right: -320px;
    width: 320px;
    max-width: 85vw;
    height: 100vh;
    background: #fff;
    box-shadow: -4px 0 20px rgba(0,0,0,0.15);
    z-index: 1001;
    transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 0;
}

.enl-navbar-drawer.show {
    right: 0;
}

.enl-navbar-drawer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-bottom: 1px solid #e2e8f0;
    background: #0073d1;
    color: #fff;
}

.enl-navbar-drawer-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    color: #fff;
}

.enl-navbar-drawer-close {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: background 0.2s;
}

.enl-navbar-drawer-close:hover {
    background: rgba(255,255,255,0.2);
}

.enl-navbar-drawer-body {
    padding: 20px;
}

.enl-navbar-drawer-nav {
    list-style: none;
    margin: 0;
    padding: 0;
}

.enl-navbar-drawer-nav li {
    margin-bottom: 8px;
}

.enl-navbar-drawer-nav a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    color: #333;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.2s;
}

.enl-navbar-drawer-nav a:hover {
    background: #f0f7ff;
    color: #0073d1;
}

.enl-navbar-drawer-nav a i {
    font-size: 20px;
    width: 24px;
    text-align: center;
}

.enl-navbar-drawer-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(2px);
}

.enl-navbar-drawer-overlay.show {
    display: block;
    opacity: 1;
}

/* Sidebar Toggle Button */
.js-sidebar-toggle {
    display: none;
    position: fixed;
    top: 70px;
    left: 15px;
    z-index: 1002;
    background: #0073d1;
    color: #fff;
    border: none;
    border-radius: 8px;
    width: 45px;
    height: 45px;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    align-items: center;
    justify-content: center;
}

.js-sidebar-toggle:hover {
    background: #005bb5;
    transform: scale(1.05);
}

.js-sidebar-toggle.active {
    /* left: 265px; */
    z-index: 1003;
}

/* Sidebar Overlay */
.js-sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(2px);
}

.js-sidebar-overlay.show {
    display: block;
    opacity: 1;
}

@media (max-width: 768px) {
    .enl-header-nav { display: none; }
    .enl-header-user-btn span { display: none; }
    .enl-navbar-toggle { display: flex; }
    .enl-header {
        z-index: 997;
    }
    .enl-header-inner {
        padding: 0 10px;
        height: 60px;
    }
}
</style>

@stack('header')

<!-- Dashboard Header (Same as Employer Dashboard) -->
<div class="enl-header">
    <div class="enl-header-inner">
        <!-- Logo -->
        <div class="enl-header-logo" style="display: flex; align-items: center; gap: 15px;">
            @if (Theme::getLogo())
                <a href="{{ BaseHelper::getHomepageUrl() }}">
                    {!! Theme::getLogoImage([], 'logo_light', 44) !!}
                </a>
            @endif
            <!-- Navbar Toggle Button (Mobile Only) -->
            <button class="enl-navbar-toggle" id="navbar-toggle-btn" aria-label="Toggle navigation menu">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <!-- Right -->
        <div class="enl-header-right" style="display: flex; align-items: center; gap: 20px;">
            <!-- Nav Items Next to User (Desktop Only) -->
            <ul class="enl-header-nav" style="margin: 0; padding: 0;">
                <!-- Home Icon -->
                <li class="nav-item">
                    <a class="nav-link" style="color: black; font-size: 20px !important; padding: 8px 12px;" href="{{ BaseHelper::getHomepageUrl() }}" title="{{ __('Home') }}">
                        <i class="feather-home" style="font-size: 20px !important;"></i>
                    </a>
                </li>
                
                <!-- FAQ -->
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="{{ route('public.faq') }}">
                        <span>{{ __('FAQ') }}</span>
                    </a>
                </li>

                <!-- Plans -->
                <li class="nav-item">
                    <a class="nav-link" style="color: black;" href="{{ route('public.premium-service') }}">
                        <span>{{ __('Plans') }}</span>
                    </a>
                </li>

                <!-- Notifications -->
                <li class="nav-item">
                    <a class="nav-link" style="color: black; font-size: 20px !important;" href="{{ route('public.notifications') }}" title="{{ __('Notifications') }}">
                        <i class="feather-bell" style="font-size: 20px !important;"></i>
                    </a>
                </li>
            </ul>

            @auth('account')
            <div class="enl-header-user">
                <button class="enl-header-user-btn" onclick="document.getElementById('jsUserDropdown').classList.toggle('show')">
                    <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}">
                    <span>{{ $account->first_name ?? $account->name }}</span>
                    <i class="fa fa-chevron-down enl-chevron"></i>
                </button>
                <div class="enl-header-dropdown" id="jsUserDropdown">
                    <a href="{{ route('public.account.jobseeker.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                    <a href="{{ route('public.account.settings') }}"><i class="fa fa-cog"></i> Account Settings</a>
                    <hr>
                    <a href="{{ route('public.account.logout') }}" id="logout-link-js" onclick="event.preventDefault(); if (typeof handleLogoutClick === 'function') { handleLogoutClick(event); } else { if (confirm('Are you sure you want to logout?')) { var f = document.getElementById('logout-form-js'); if (f) f.submit(); } } return false;"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>

<form id="logout-form-js" style="display:none;" action="{{ route('public.account.logout') }}" method="POST">@csrf</form>

<!-- Navbar Right Side Drawer (Mobile) -->
<div class="enl-navbar-drawer-overlay" id="navbar-drawer-overlay"></div>
<div class="enl-navbar-drawer" id="navbar-drawer">
    <div class="enl-navbar-drawer-header">
        <h3>{{ __('Menu') }}</h3>
        <button class="enl-navbar-drawer-close" id="navbar-drawer-close" aria-label="Close menu">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="enl-navbar-drawer-body">
        <ul class="enl-navbar-drawer-nav">
            <!-- Home -->
            <li>
                <a href="{{ BaseHelper::getHomepageUrl() }}">
                    <i class="feather-home"></i>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <!-- FAQ -->
            <li>
                <a href="{{ route('public.faq') }}">
                    <i class="fa fa-question-circle"></i>
                    <span>{{ __('FAQ') }}</span>
                </a>
            </li>
            <!-- Plans -->
            <li>
                <a href="{{ route('public.premium-service') }}">
                    <i class="fa fa-crown"></i>
                    <span>{{ __('Plans') }}</span>
                </a>
            </li>
            <!-- Notifications -->
            <li>
                <a href="{{ route('public.notifications') }}">
                    <i class="feather-bell"></i>
                    <span>{{ __('Notifications') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="js-settings-page crop-avatar">
    <!-- Mobile Sidebar Toggle Button -->
    <button class="js-sidebar-toggle" id="js-sidebar-toggle" aria-label="Toggle sidebar">
        <i class="fa fa-bars"></i>
    </button>
    
    <!-- Mobile Sidebar Overlay -->
    <div class="js-sidebar-overlay" id="js-sidebar-overlay"></div>
    
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4">
                <div class="js-profile-sidebar" id="js-profile-sidebar">
                    <div class="text-center">
                        <div class="js-profile-avatar-wrapper">
                            <img src="{{ $account->avatar_url }}" alt="{{ $account->name }}" class="js-profile-avatar">
                            <a href="#" class="js-avatar-camera-btn" data-bs-toggle="modal" data-bs-target="#avatar-modal" title="{{ __('Change Photo') }}">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <h5 class="js-profile-name">Hello, {{ $account->first_name ?? $account->name }}</h5>
                        <p class="js-profile-date">Joined {{ $account->created_at->format('M d, Y') }}</p>
                        <p class="js-profile-updated">Last Updated: {{ $account->updated_at->format('M d, Y') }}</p>
                        {{-- Profile Completion + View Profile (job seeker) --}}
                        <div class="js-profile-completion">
                            <h6>{{ __('Profile Completion') }}</h6>
                            <div class="js-completion-bar">
                                <div class="js-completion-fill" style="width: {{ $completion }}%;"></div>
                            </div>
                            <div class="js-completion-text">{{ $completion }}% {{ __('complete') }}</div>
                        </div>
                        @php $myPublicProfileUrl = $account->isJobSeeker() ? $account->url : ''; @endphp
                        @if($account->isJobSeeker())
                            @if($myPublicProfileUrl)
                                <a href="{{ $myPublicProfileUrl }}" target="_blank" class="js-view-profile-btn" title="{{ __('View your public profile as others see it') }}">
                                    <i class="fa fa-external-link-alt"></i> {{ __('View Profile') }}
                                </a>
                            @else
                                <a href="{{ url(route('public.account.settings')) }}" target="_self" class="js-view-profile-btn js-view-profile-edit">
                                    <i class="fa fa-user-edit"></i> {{ __('Complete profile for public link') }}
                                </a>
                            @endif
                        @endif
                    </div>
                    
                    <!-- Wallet (click opens Profile Completion popup with Credits) -->
                    @if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
                    <div class="js-wallet-badge js-wallet-open-profile-modal" style="cursor: pointer" onclick="document.getElementById('profileModal').style.display='flex'" title="{{ __('View credits & profile completion') }}">
                        <i class="fa fa-wallet"></i>
                        <span>{{__('Credits:') }}:</span>
                        <span class="js-wallet-points">{{ format_credits_short($account->credits ?? 0) }}</span>
                    </div>
                    @else
                    <div class="js-wallet-badge" onclick="document.getElementById('profileModal').style.display='flex'">
                        <i class="fa fa-wallet"></i>
                        <span>Reward Points:</span>
                        <span class="js-wallet-points">{{ $walletPoints }}</span>
                    </div>
                    @endif

                    <!-- Navigation -->
                    @php
                        $currentUrl = url()->current();
                    @endphp
                    <ul class="js-sidebar-nav">
                        <li><a href="{{ route('public.account.jobseeker.dashboard') }}" @class(['active' => $currentUrl == route('public.account.jobseeker.dashboard')])><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="{{ url(route('public.account.settings')) }}" target="_self" @class(['active' => $currentUrl == route('public.account.settings')])><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="{{ route('public.account.jobs.saved') }}" @class(['active' => $currentUrl == route('public.account.jobs.saved')])><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="{{ route('public.account.jobs.applied-jobs') }}" @class(['active' => $currentUrl == route('public.account.jobs.applied-jobs')])><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="{{ route('public.account.experiences.index') }}" @class(['active' => str_contains($currentUrl, 'experience')])><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="{{ route('public.account.educations.index') }}" @class(['active' => str_contains($currentUrl, 'education')])><i class="fa fa-graduation-cap"></i> Education</a></li>
                        <li><a href="{{ route('public.account.interests-achievements') }}" @class(['active' => str_contains($currentUrl, 'interests-achievements')])><i class="fa fa-star"></i> Interests & Achievements</a></li>
                        <li>@if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())<a href="{{ url(route('public.account.jobseeker.wallet')) }}" target="_self" @class(['active' => $currentUrl == url(route('public.account.jobseeker.wallet'))])><i class="fa fa-wallet"></i> Wallet <span style="background:#0073d1;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ format_credits_short($account->credits ?? 0) }}</span></a>@else<a href="#" @class(['active' => false])><i class="fa fa-wallet"></i> Wallet <span style="background:#0073d1;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;">{{ $walletPoints }}</span></a>@endif</li>
                        <li><a href="{{ route('public.account.invoices.index') }}" @class(['active' => str_contains($currentUrl, '/account/invoices')])><i class="fa fa-file-invoice"></i> Invoices</a></li>
                        <li><a href="{{ route('public.account.resume-builder') }}" @class(['active' => str_contains($currentUrl, 'resume-builder')])><i class="fa fa-file-pdf"></i> Resume Builder</a></li>
                        <li><a href="{{ route('public.account.security') }}" @class(['active' => $currentUrl == route('public.account.security')])><i class="fa fa-lock"></i> Security</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8 js-settings-main-col">
                <div class="js-main-content {{ !empty($is_wallet_page) ? 'js-main-content-wallet' : '' }}">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Avatar Modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="{{ route('public.account.avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label">
                            <strong>{{ __('Profile Image') }}</strong>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                @csrf
                                <label for="avatarInput">{{ __('New image') }}</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <div class="loading" tabindex="-1" role="img" aria-label="{{ __('Loading') }}"></div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                    <div class="error-message text-danger" style="display: none"></div>
                                </div>
                                <div class="col-md-3 avatar-preview-wrapper">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button class="btn btn-outline-primary avatar-save" type="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Profile Completion + Credits Modal (same style as image: Credits header, progress, checklist with Done/Pending) -->
<div id="profileModal" class="pm-overlay" style="display:none;">
    <div class="pm-modal">
        <button type="button" class="pm-close" onclick="document.getElementById('profileModal').style.display='none'">&times;</button>
        
        <!-- Credits / Reward Points Badge (orange bar like image) -->
        @if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
        <div class="pm-reward-badge pm-credits-badge">
            <i class="fa fa-coins"></i>
            <span>{{ __('Credits') }}:</span>
            <span class="pm-reward-points">{{ format_credits_short($account->credits ?? 0) }}</span>
        </div>
        @else
        <div class="pm-reward-badge">
            <i class="fa fa-wallet"></i>
            <span>{{ __('Reward Points') }}:</span>
            <span class="pm-reward-points">{{ $walletPoints }}</span>
        </div>
        @endif

        <!-- Profile Completion -->
        <div class="pm-completion-section">
            <h6 class="pm-completion-title">{{ __('Profile Completion') }}</h6>
            <div class="pm-progress-bar">
                <div class="pm-progress-fill" style="width: {{ $completion }}%"></div>
            </div>
            <span class="pm-completion-text">{{ $completion }}% {{ __('Complete') }}</span>
        </div>

        <!-- Per-field checklist (Done / Pending like image) -->
        <div class="pm-field-list">
            @foreach($profileFields as $pf)
                <div class="pm-field-item">
                    <span class="pm-field-name">
                        <i class="fa {{ $pf['filled'] ? 'fa-check-circle' : 'fa-times-circle' }}" style="color: {{ $pf['filled'] ? '#28a745' : '#dc3545' }}; margin-right: 8px;"></i>
                        {{ $pf['label'] }}
                    </span>
                    <span class="pm-field-points {{ $pf['filled'] ? 'pm-earned' : 'pm-pending' }}">
                        {{ $pf['filled'] ? __('Done') : __('Pending') }}
                    </span>
                </div>
            @endforeach
        </div>

        @if($completion < 100)
            <a href="{{ url(route('public.account.settings')) }}" target="_self" class="pm-complete-btn">
                <i class="fa fa-user-edit"></i> {{ __('Complete Your Profile') }}
            </a>
        @else
            <div class="pm-congrats">
                <i class="fa fa-trophy" style="color: #f59e0b; font-size: 20px;"></i>
                <span>{{ __('Congratulations! Your profile is 100% complete.') }}</span>
            </div>
        @endif

        @if(\Botble\JobBoard\Facades\JobBoardHelper::isEnabledCreditsSystem())
        <a href="{{ url(route('public.account.jobseeker.wallet')) }}" target="_self" class="pm-wallet-link mt-2 d-block text-center small">
            <i class="fa fa-wallet"></i> {{ __('Go to Wallet') }}
        </a>
        @endif
    </div>
</div>

<style>
.pm-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: pmFadeIn 0.25s ease;
}
@keyframes pmFadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes pmSlideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
.pm-modal {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 400px;
    max-height: 85vh;
    overflow-y: auto;
    padding: 25px 20px;
    position: relative;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    animation: pmSlideUp 0.3s ease;
}
.pm-modal::-webkit-scrollbar { width: 4px; }
.pm-modal::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
.pm-close {
    position: absolute; top: 10px; right: 14px;
    background: none; border: none; font-size: 28px; color: #999; cursor: pointer; line-height: 1; z-index: 10; transition: color 0.2s;
}
.pm-close:hover { color: #333; }
.pm-reward-badge {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: #fff; border-radius: 30px; width: 90%;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    font-size: 14spx; font-weight: 500; margin-bottom: 20px;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
}
.pm-reward-badge i { font-size: 18px; }
.pm-reward-points { font-size: 18px; font-weight: 600; }
.pm-credits-badge { background: linear-gradient(135deg, #f59e0b, #f97316); }
.pm-credits-badge i { font-size: 18px; }
.pm-wallet-link { color: #0073d1 !important; font-weight: 500; text-decoration: none !important; }
.pm-wallet-link:hover { text-decoration: underline !important; color: #005bb5 !important; }
.pm-completion-section { margin-bottom: 18px; }
.pm-completion-title { font-size: 15px; font-weight: 700; color: #333; margin-bottom: 8px; }
.pm-progress-bar { height: 10px; background: #e9ecef; border-radius: 10px; overflow: hidden; margin-bottom: 6px; }
.pm-progress-fill { height: 100%; background: linear-gradient(90deg, #0073d1, #00b4d8); border-radius: 10px; transition: width 0.6s ease; }
.pm-completion-text { font-size: 13px; font-weight: 600; color: #0073d1; text-decoration: underline; }
.pm-field-list { margin-top: 15px; }
.pm-field-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 10px 12px; border-radius: 8px; margin-bottom: 6px; background: #f8f9fa; transition: background 0.2s;
}
.pm-field-item:hover { background: #f0f4f8; }
.pm-field-name { display: flex; align-items: center; font-size: 14px; font-weight: 500; color: #333; }
.pm-field-points { font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 12px; white-space: nowrap; }
.pm-field-points.pm-earned { background: #d4edda; color: #28a745; }
.pm-field-points.pm-pending { background: #fff3cd; color: #856404; }
.pm-complete-btn {
    display: block; text-align: center; margin-top: 18px; padding: 12px;
    background: linear-gradient(135deg, #0073d1, #00b4d8); color: #fff !important;
    border-radius: 10px; font-weight: 600; font-size: 14px; text-decoration: none !important;
    transition: transform 0.2s, box-shadow 0.2s; box-shadow: 0 4px 15px rgba(0, 115, 209, 0.3);
}
.pm-complete-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 115, 209, 0.4); color: #fff !important; }
.pm-complete-btn i { margin-right: 6px; }
.pm-congrats {
    display: flex; align-items: center; gap: 10px; padding: 14px;
    background: #fff8e1; border-radius: 10px; margin-top: 18px; font-size: 13px; font-weight: 600; color: #333;
}
@media (max-width: 480px) {
    .pm-modal { padding: 20px 15px; max-height: 90vh; border-radius: 12px; }
    .pm-reward-badge { font-size: 14px; padding: 10px 18px; }
    .pm-reward-points { font-size: 20px; }
}
</style>

<script>
document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) this.style.display = 'none';
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.getElementById('profileModal').style.display = 'none';
});

// User dropdown close on outside click
document.addEventListener('click', function(e) {
    var dropdown = document.getElementById('jsUserDropdown');
    var btn = e.target.closest('.enl-header-user-btn');
    if (!btn && dropdown) {
        dropdown.classList.remove('show');
    }
});

// Job Seeker Sidebar Toggle Functionality
(function() {
    function initJobSeekerSidebar() {
        const toggleBtn = document.getElementById('js-sidebar-toggle');
        const sidebar = document.getElementById('js-profile-sidebar');
        const overlay = document.getElementById('js-sidebar-overlay');
        
        if (toggleBtn && sidebar && overlay) {
            toggleBtn.addEventListener('click', function() {
                const isOpen = sidebar.classList.contains('show');
                
                if (isOpen) {
                    // Close sidebar
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    toggleBtn.classList.remove('active');
                    document.body.style.overflow = '';
                } else {
                    // Open sidebar
                    sidebar.classList.add('show');
                    overlay.classList.add('show');
                    toggleBtn.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
            
            // Close on overlay click
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                toggleBtn.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Close on sidebar link click (mobile/tablet)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                        toggleBtn.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
            });
            
            // Close on window resize if desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    toggleBtn.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initJobSeekerSidebar);
    } else {
        initJobSeekerSidebar();
    }
})();

// Navbar Toggle Drawer Functionality
(function() {
    function initNavbarDrawer() {
        const toggleBtn = document.getElementById('navbar-toggle-btn');
        const drawer = document.getElementById('navbar-drawer');
        const overlay = document.getElementById('navbar-drawer-overlay');
        const closeBtn = document.getElementById('navbar-drawer-close');
        
        if (!toggleBtn || !drawer || !overlay) return;
        
        function openDrawer() {
            drawer.classList.add('show');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        
        function closeDrawer() {
            drawer.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
        
        // Toggle button click
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (drawer.classList.contains('show')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });
        
        // Close button click
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeDrawer();
            });
        }
        
        // Overlay click
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeDrawer();
            }
        });
        
        // Close on drawer link click
        const drawerLinks = drawer.querySelectorAll('.enl-navbar-drawer-nav a');
        drawerLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                setTimeout(function() {
                    closeDrawer();
                }, 100);
            });
        });
        
        // Close on window resize (if desktop)
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeDrawer();
            }
        });
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavbarDrawer);
    } else {
        initNavbarDrawer();
    }
})();

// Logout Handler Function - Enhanced
function handleLogoutClick(event) {
    if (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    const logoutForm = document.getElementById('logout-form-js');
    if (!logoutForm) {
        console.error('Logout form not found');
        return false;
    }
    
    // Prevent form submission
    let allowSubmit = false;
    const submitHandler = function(e) {
        if (!allowSubmit) {
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        }
    };
    logoutForm.addEventListener('submit', submitHandler, true);
    
    // Function to wait for dialog system
    function waitForDialogSystem(callback, maxAttempts) {
        maxAttempts = maxAttempts || 50;
        let attempts = 0;
        
        function check() {
            attempts++;
            if (typeof window.showDialogConfirm === 'function' && typeof jQuery !== 'undefined') {
                callback(false);
            } else if (attempts < maxAttempts) {
                setTimeout(check, 100);
            } else {
                callback(true); // Fallback
            }
        }
        check();
    }
    
    // Use native alert for now (except employer dashboard)
    if (confirm('Do you want to logout?')) {
        allowSubmit = true;
        logoutForm.removeEventListener('submit', submitHandler, true);
        logoutForm.submit();
    }
    
    return false;
}
</script>

@push('footer')
    <script>
        'use strict';

        var RV_MEDIA_URL = {
            base: '{{ url('') }}',
            filebrowserImageBrowseUrl: false,
            media_upload_from_editor: '{{ route('public.account.upload-from-editor') }}'
        }

        function setImageValue(file) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(file);
        }
    </script>
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="tinymce_form" action="{{ route('public.account.upload-from-editor') }}" target="form_target" method="post" enctype="multipart/form-data"
          style="width:0; height:0; overflow:hidden; display: none;">
        @csrf
        <input name="upload" id="upload_file" type="file" onchange="$('#tinymce_form').submit();this.value='';">
        <input type="hidden" value="tinymce" name="upload_type">
    </form>
@endpush