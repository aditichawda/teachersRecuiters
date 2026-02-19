<?php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->add('tagify-css', 'vendor/core/core/base/libraries/tagify/tagify.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    Theme::asset()->container('footer')->add('tagify-js', 'vendor/core/core/base/libraries/tagify/tagify.js');
    Theme::asset()->container('footer')->usePath()->add('tags-js', 'js/tagify-select.js');
    
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
?>

<style>
.js-settings-page {
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
    margin-top: 20px;
    padding-top: 75px;
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

/* Main Content Area */
.js-main-content {
    padding: 0 0 40px 0px;
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
}

@media (max-width: 768px) {
    .js-profile-sidebar {
        display: none;
    }
    .js-main-content {
        padding: 15px 0;
    }
}
</style>

<div class="js-settings-page crop-avatar">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="js-profile-sidebar">
                    <div class="text-center">
                        <div class="js-profile-avatar-wrapper">
                            <img src="<?php echo e($account->avatar_url); ?>" alt="<?php echo e($account->name); ?>" class="js-profile-avatar">
                            <a href="#" class="js-avatar-camera-btn" data-bs-toggle="modal" data-bs-target="#avatar-modal" title="<?php echo e(__('Change Photo')); ?>">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <h5 class="js-profile-name">Hello, <?php echo e($account->first_name ?? $account->name); ?></h5>
                        <p class="js-profile-date">Joined <?php echo e($account->created_at->format('M d, Y')); ?></p>
                        <p class="js-profile-updated">Last Updated: <?php echo e($account->updated_at->format('M d, Y')); ?></p>
                        
                        <div class="js-profile-completion">
                            <h6><?php echo e(__('Profile Completion')); ?></h6>
                            <div class="js-completion-bar">
                                <div class="js-completion-fill" style="width: <?php echo e($completion); ?>%;"></div>
                            </div>
                            <div class="js-completion-text"><?php echo e($completion); ?>% <?php echo e(__('complete')); ?></div>
                        </div>
                        <?php $myPublicProfileUrl = $account->isJobSeeker() ? $account->url : ''; ?>
                        <?php if($account->isJobSeeker()): ?>
                            <?php if($myPublicProfileUrl): ?>
                                <a href="<?php echo e($myPublicProfileUrl); ?>" target="_blank" class="js-view-profile-btn" title="<?php echo e(__('View your public profile as others see it')); ?>">
                                    <i class="fa fa-external-link-alt"></i> <?php echo e(__('View Profile')); ?>

                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('public.account.settings')); ?>" class="js-view-profile-btn js-view-profile-edit">
                                    <i class="fa fa-user-edit"></i> <?php echo e(__('Complete profile for public link')); ?>

                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Wallet -->
                    <div class="js-wallet-badge" onclick="document.getElementById('profileModal').style.display='flex'">
                        <i class="fa fa-wallet"></i>
                        <span>Reward Points:</span>
                        <span class="js-wallet-points"><?php echo e($walletPoints); ?></span>
                    </div>

                    <!-- Navigation -->
                    <?php
                        $currentUrl = url()->current();
                    ?>
                    <ul class="js-sidebar-nav">
                        <li><a href="<?php echo e(route('public.account.jobseeker.dashboard')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $currentUrl == route('public.account.jobseeker.dashboard')]); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a href="<?php echo e(route('public.account.settings')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $currentUrl == route('public.account.settings')]); ?>"><i class="fa fa-user"></i> My Profile</a></li>
                        <li><a href="<?php echo e(route('public.account.jobs.saved')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $currentUrl == route('public.account.jobs.saved')]); ?>"><i class="fa fa-bookmark"></i> Saved Jobs</a></li>
                        <li><a href="<?php echo e(route('public.account.jobs.applied-jobs')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $currentUrl == route('public.account.jobs.applied-jobs')]); ?>"><i class="fa fa-file-alt"></i> Applied Jobs</a></li>
                        <li><a href="<?php echo e(route('public.account.experiences.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => str_contains($currentUrl, 'experience')]); ?>"><i class="fa fa-briefcase"></i> Experience</a></li>
                        <li><a href="<?php echo e(route('public.account.educations.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => str_contains($currentUrl, 'education')]); ?>"><i class="fa fa-graduation-cap"></i> Education</a></li>
                        <li><a href="<?php echo e(route('public.account.interests-achievements')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => str_contains($currentUrl, 'interests-achievements')]); ?>"><i class="fa fa-star"></i> Interests & Achievements</a></li>
                        <li><a href="#" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => false]); ?>"><i class="fa fa-wallet"></i> Wallet <span style="background:#f59e0b;color:#fff;padding:1px 8px;border-radius:10px;font-size:11px;margin-left:auto;"><?php echo e($walletPoints); ?></span></a></li>
                        <li><a href="<?php echo e(route('public.account.resume-builder')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => str_contains($currentUrl, 'resume-builder')]); ?>"><i class="fa fa-file-pdf"></i> Resume Builder</a></li>
                        <li><a href="<?php echo e(route('public.account.security')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => $currentUrl == route('public.account.security')]); ?>"><i class="fa fa-lock"></i> Security</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-9 col-md-8">
                <div class="js-main-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Avatar Modal -->
    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="<?php echo e(route('public.account.avatar')); ?>" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label">
                            <strong><?php echo e(__('Profile Image')); ?></strong>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <?php echo csrf_field(); ?>
                                <label for="avatarInput"><?php echo e(__('New image')); ?></label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <div class="loading" tabindex="-1" role="img" aria-label="<?php echo e(__('Loading')); ?>"></div>
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
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <button class="btn btn-outline-primary avatar-save" type="submit"><?php echo e(__('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div id="profileModal" class="pm-overlay" style="display:none;">
    <div class="pm-modal">
        <button type="button" class="pm-close" onclick="document.getElementById('profileModal').style.display='none'">&times;</button>
        
        <!-- Reward Points Badge -->
        <div class="pm-reward-badge">
            <i class="fa fa-wallet"></i>
            <span>Reward Points:</span>
            <span class="pm-reward-points"><?php echo e($walletPoints); ?></span>
        </div>

        <!-- Profile Completion -->
        <div class="pm-completion-section">
            <h6 class="pm-completion-title">Profile Completion</h6>
            <div class="pm-progress-bar">
                <div class="pm-progress-fill" style="width: <?php echo e($completion); ?>%"></div>
            </div>
            <span class="pm-completion-text"><?php echo e($completion); ?>% Complete</span>
        </div>

        <!-- Per-field Progress -->
        <div class="pm-field-list">
            <?php $__currentLoopData = $profileFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pm-field-item">
                    <span class="pm-field-name">
                        <i class="fa <?php echo e($pf['filled'] ? 'fa-check-circle' : 'fa-times-circle'); ?>" style="color: <?php echo e($pf['filled'] ? '#28a745' : '#dc3545'); ?>; margin-right: 8px;"></i>
                        <?php echo e($pf['label']); ?>

                    </span>
                    <span class="pm-field-points <?php echo e($pf['filled'] ? 'pm-earned' : 'pm-pending'); ?>">
                        +<?php echo e($pf['points']); ?> pts
                    </span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($completion < 100): ?>
            <a href="<?php echo e(route('public.account.settings')); ?>" class="pm-complete-btn">
                <i class="fa fa-user-edit"></i> Complete Your Profile
            </a>
        <?php else: ?>
            <div class="pm-congrats">
                <i class="fa fa-trophy" style="color: #f59e0b; font-size: 20px;"></i>
                <span>Congratulations! Your profile is 100% complete.</span>
            </div>
        <?php endif; ?>
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
</script>

<?php $__env->startPush('footer'); ?>
    <script>
        'use strict';

        var RV_MEDIA_URL = {
            base: '<?php echo e(url('')); ?>',
            filebrowserImageBrowseUrl: false,
            media_upload_from_editor: '<?php echo e(route('public.account.upload-from-editor')); ?>'
        }

        function setImageValue(file) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(file);
        }
    </script>
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="tinymce_form" action="<?php echo e(route('public.account.upload-from-editor')); ?>" target="form_target" method="post" enctype="multipart/form-data"
          style="width:0; height:0; overflow:hidden; display: none;">
        <?php echo csrf_field(); ?>
        <input name="upload" id="upload_file" type="file" onchange="$('#tinymce_form').submit();this.value='';">
        <input type="hidden" value="tinymce" name="upload_type">
    </form>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/account/partials/layout-settings.blade.php ENDPATH**/ ?>