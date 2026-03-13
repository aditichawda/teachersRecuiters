<?php
    Theme::asset()->usePath()->add('leaflet-css', 'plugins/leaflet/leaflet.css');
    Theme::asset()->container('footer')->usePath()->add('leaflet-js', 'plugins/leaflet/leaflet.js');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('pageTitle', $company->name);
    Theme::set('withPageHeader', false);
?>

<?php echo Theme::partial('company-card-styles'); ?>

<?php echo Theme::partial('jobs-card-styles'); ?>


<style>
/* ===== Company Detail Hero ===== */
.cd-hero {
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 60%, #bae6fd 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}
.cd-hero::before {
    content: '';
    position: absolute;
    top: -80px;
    right: -100px;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(0,115,209,.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.cd-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 13px;
}
.cd-breadcrumb a { color: #0073d1; text-decoration: none; font-weight: 500; }
.cd-breadcrumb a:hover { color: #0c4a6e; }
.cd-breadcrumb span { color: #94a3b8; }
.cd-hero-content {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.cd-hero-logo {
    width: 80px;
    height: 80px;
    border-radius: 18px;
    background: #fff;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}
.cd-hero-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 10px;
}
.cd-hero-info { flex: 1; }
.cd-hero-info h1 {
    font-size: 30px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 8px;
}
.cd-hero-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.cd-hero-meta span, .cd-hero-meta a {
    font-size: 14px;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 5px;
}
.cd-hero-meta a { color: #0073d1; text-decoration: none; font-weight: 500; }
.cd-hero-meta a:hover { color: #0073d1; }
.cd-hero-meta i { color: #94a3b8; font-size: 14px; }
.cd-hero-desc {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 0;
    max-width: 600px;
}

/* ===== Main Area ===== */
.cd-main {
    padding: 40px 0 80px;
    background: #f8fafc;
}
.cd-content-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cd-content-card h4.cd-section-title {
    font-size: 20px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    position: relative;
}
.cd-content-card h4.cd-section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 2px;
}
.cd-content-card .ck-content {
    font-size: 15px;
    line-height: 1.8;
    color: #334155;
}

/* Social Links */
.cd-social-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.cd-social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: #f1f5f9;
    color: #475569;
    text-decoration: none;
    font-size: 16px;
    transition: all .2s;
}
.cd-social-link:hover {
    transform: translateY(-2px);
    color: #fff;
}
.cd-social-link.fb:hover { background: #1877f2; }
.cd-social-link.tw:hover { background: #1da1f2; }
.cd-social-link.li:hover { background: #0a66c2; }
.cd-social-link.ig:hover { background: #e4405f; }

/* ===== Sidebar ===== */
.cd-sidebar-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cd-sidebar-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}
.cd-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cd-info-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.cd-info-list li:last-child { border-bottom: none; }
.cd-info-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: #f0f9ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0073d1;
    font-size: 14px;
    flex-shrink: 0;
}
.cd-info-text { flex: 1; }
.cd-info-label {
    font-size: 12px;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: .3px;
    font-weight: 600;
    margin-bottom: 2px;
}
.cd-info-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
}

/* Back Button */
.cd-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #0073d1;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 20px;
    transition: all .2s;
}
.cd-back-btn:hover { color: #0c4a6e; gap: 8px; }

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .cd-hero { padding: 90px 0 40px; }
    .cd-hero-info h1 { font-size: 24px; }
    .cd-content-card { padding: 24px; }
}
@media(max-width: 767px) {
    .cd-hero { padding: 80px 15px 30px; }
    .cd-hero-content { flex-direction: column; gap: 14px; }
    .cd-hero-logo { width: 60px; height: 60px; }
    .cd-hero-info h1 { font-size: 22px; }
    .cd-content-card { padding: 20px; border-radius: 12px; }
    .cd-sidebar-card { padding: 20px; }
    .cd-main { padding: 25px 0 50px; }
}

/* Review Avatar Size */
.review-item .avatar-md,
.review-item .rounded-circle.avatar-md {
    width: 48px !important;
    height: 48px !important;
    max-width: 48px !important;
    max-height: 48px !important;
    object-fit: cover;
}
.review-listing .review-item .flex-shrink-0 {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
}
</style>


<?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
    <?php $topAds = render_page_ads('company-detail', 'top'); ?>
    <?php if(!empty($topAds)): ?>
        <div class="company-detail-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            <?php echo $topAds; ?>

        </div>
    <?php endif; ?>
<?php endif; ?>


<section class="cd-hero">
    <div class="container">
        <div class="cd-breadcrumb">
            <a href="/"><?php echo e(__('Home')); ?></a>
            <span>→</span>
            <a href="<?php echo e(JobBoardHelper::getJobcompaniesPageURL()); ?>"><?php echo e(__('companies')); ?></a>
            <span>→</span>
            <span style="color: #475569;"><?php echo e(Str::limit($company->name, 40)); ?></span>
        </div>

        <div class="cd-hero-content">
            <div class="cd-hero-logo">
                <img src="<?php echo e($company->logo_thumb); ?>" alt="<?php echo e($company->name); ?>">
            </div>
            <div class="cd-hero-info">
                <h1><?php echo e($company->name); ?> <?php echo $company->badge; ?></h1>
                <div class="cd-hero-meta">
<<<<<<< HEAD
                    <?php if($company->address): ?>
                        <span><i class="feather-map-pin"></i> <?php echo e($company->address); ?></span>
                    <?php endif; ?>
                    <?php if($company->website): ?>
                        <a href="<?php echo e($company->website); ?>" target="_blank"><i class="feather-globe"></i> <?php echo e($company->website); ?></a>
                    <?php endif; ?>
                </div>
                <?php if($company->description): ?>
                    <p class="cd-hero-desc"><?php echo e(Str::limit($company->description, 200)); ?></p>
                <?php endif; ?>
                <?php
                    $admissionOpen = $company->admission && $company->admission->status === 'published' && trim($company->admission->content ?? '') !== '' && $company->admission->admission_deadline && !\Carbon\Carbon::parse($company->admission->admission_deadline)->endOfDay()->isPast();
=======
                    <?php if($company->full_address): ?>
                        <span><i class="feather-map-pin"></i> <?php echo e($company->full_address); ?></span>
                    <?php elseif($company->address): ?>
                        <span><i class="feather-map-pin"></i> <?php echo e($company->address); ?></span>
                    <?php endif; ?>
                    <?php if($company->website && !empty(trim($company->website))): ?>
                        <a href="<?php echo e($company->website); ?>" target="_blank" rel="noopener"><i class="feather-globe"></i> <?php echo e(Str::limit($company->website, 50)); ?></a>
                    <?php endif; ?>
                </div>
                <?php if($company->description && !empty(trim($company->description))): ?>
                    <p class="cd-hero-desc"><?php echo e(Str::limit($company->description, 200)); ?></p>
                <?php endif; ?>
<<<<<<< HEAD
                <?php
                    $admissionOpen = false;
                    if ($company->admission && isset($company->admission->status) && $company->admission->status === 'published') {
                        $content = $company->admission->content ?? '';
                        $deadline = $company->admission->admission_deadline ?? null;
                        if (trim($content) !== '' && $deadline) {
                            try {
                                $admissionOpen = !\Carbon\Carbon::parse($deadline)->endOfDay()->isPast();
                            } catch (\Exception $e) {
                                $admissionOpen = false;
                            }
                        }
                    }
>>>>>>> 7f84a288 (9 march update)
                ?>
                <?php if($admissionOpen): ?>
=======
                <?php if(!empty($showAdmissionOnProfile) && $company->admission): ?>
>>>>>>> 4bffcdd8 (13 marh update)
                <div class="mt-3">
                    <button type="button" class="btn btn-primary px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#admissionEnquiryModal" style="background: linear-gradient(135deg, #059669, #047857); border: none;">
                        <i class="fas fa-graduation-cap me-2"></i><?php echo e(__('Admission Enquiry')); ?>

                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<div class="cd-main">
    <div class="container">
        <?php if(session('success_msg')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert"><?php echo e(session('success_msg')); ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php endif; ?>
        <?php if(session('error_msg')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert"><?php echo e(session('error_msg')); ?><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
        <?php endif; ?>
        <a href="<?php echo e(JobBoardHelper::getJobcompaniesPageURL()); ?>" class="cd-back-btn">← <?php echo e(__('Back to companies')); ?></a>

        <div class="row">
            
            <div class="col-lg-8 col-md-12">
                
                <?php if($company->content): ?>
                    <div class="cd-content-card">
                        <h4 class="cd-section-title"><?php echo e(__('About Company')); ?></h4>
                        <div class="ck-content" style="word-break: break-word">
                            <?php echo BaseHelper::clean($company->content); ?>

                        </div>
                    </div>
                <?php endif; ?>

                
<<<<<<< HEAD
=======
                <div class="cd-content-card">
                    <h4 class="cd-section-title"><?php echo e(__('Company Details')); ?></h4>
                    
                    
                    <div class="company-details-list" style="display: grid; gap: 20px;">
                        <?php if($company->institution_type): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Institution Type')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e(ucfirst(str_replace('-', ' ', $company->institution_type))); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->campus_type): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Campus Type')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $campusTypes = is_array($company->campus_type) 
                                            ? $company->campus_type 
                                            : (is_string($company->campus_type) ? json_decode($company->campus_type, true) : [$company->campus_type]);
                                        $campusTypes = array_filter((array)$campusTypes);
                                    ?>
                                    <?php if(!empty($campusTypes)): ?>
                                        <?php echo e(implode(', ', array_map('ucfirst', array_map('trim', $campusTypes)))); ?>

                                    <?php else: ?>
                                        <?php echo e(ucfirst($company->campus_type)); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->email): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Email')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->email); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->phone): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Phone')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->phone); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->website): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Website')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <a href="<?php echo e($company->website); ?>" target="_blank" rel="noopener" style="color: #0ea5e9; text-decoration: none;"><?php echo e($company->website); ?></a>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->year_founded): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Year Founded')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->year_founded); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->ceo): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('CEO')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->ceo); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->number_of_offices): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Number of Offices')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->number_of_offices); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->number_of_employees): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Number of Employees')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->number_of_employees); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->total_staff): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Total Staff')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->total_staff); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->annual_revenue): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Annual Revenue')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->annual_revenue); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->full_address): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Full Address')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->full_address); ?></span>
                            </div>
                        <?php elseif($company->address): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Address')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->address); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if(is_plugin_active('location')): ?>
                            <?php if($company->city && $company->city->name): ?>
                                <div class="company-detail-item">
                                    <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('City')); ?>:</strong>
                                    <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->city->name); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($company->state && $company->state->name): ?>
                                <div class="company-detail-item">
                                    <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('State')); ?>:</strong>
                                    <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->state->name); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($company->country && $company->country->name): ?>
                                <div class="company-detail-item">
                                    <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Country')); ?>:</strong>
                                    <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->country->name); ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($company->postal_code): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Postal Code')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->postal_code); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->tax_id): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Tax ID')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->tax_id); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->working_days): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Working Days')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $workingDays = is_array($company->working_days) 
                                            ? $company->working_days 
                                            : (is_string($company->working_days) ? json_decode($company->working_days, true) : [$company->working_days]);
                                        $workingDays = array_filter((array)$workingDays);
                                    ?>
                                    <?php if(!empty($workingDays)): ?>
                                        <?php echo e(implode(', ', array_map('ucfirst', array_map('trim', $workingDays)))); ?>

                                    <?php else: ?>
                                        <?php echo e($company->working_days); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->working_hours_start && $company->working_hours_end): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Working Hours')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;"><?php echo e($company->working_hours_start); ?> - <?php echo e($company->working_hours_end); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->staff_facilities): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Staff Facilities')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $facilities = is_array($company->staff_facilities) 
                                            ? $company->staff_facilities 
                                            : (is_string($company->staff_facilities) ? json_decode($company->staff_facilities, true) : [$company->staff_facilities]);
                                        $facilities = array_filter((array)$facilities);
                                    ?>
                                    <?php if(!empty($facilities)): ?>
                                        <?php echo e(implode(', ', array_map('ucfirst', array_map('trim', $facilities)))); ?>

                                    <?php else: ?>
                                        <?php echo e($company->staff_facilities); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->standard_level): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Standard Level')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $levels = is_array($company->standard_level) 
                                            ? $company->standard_level 
                                            : (is_string($company->standard_level) ? json_decode($company->standard_level, true) : [$company->standard_level]);
                                        $levels = array_filter((array)$levels);
                                    ?>
                                    <?php if(!empty($levels)): ?>
                                        <?php echo e(implode(', ', array_map('ucfirst', array_map('trim', $levels)))); ?>

                                    <?php else: ?>
                                        <?php echo e($company->standard_level); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->awards): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Awards')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $awards = is_array($company->awards) 
                                            ? $company->awards 
                                            : (is_string($company->awards) ? json_decode($company->awards, true) : [$company->awards]);
                                        $awards = array_filter((array)$awards);
                                    ?>
                                    <?php if(!empty($awards)): ?>
                                        <?php echo e(implode(', ', array_map('trim', $awards))); ?>

                                    <?php else: ?>
                                        <?php echo e($company->awards); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->affiliations): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Affiliations')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <?php
                                        $affiliations = is_array($company->affiliations) 
                                            ? $company->affiliations 
                                            : (is_string($company->affiliations) ? json_decode($company->affiliations, true) : [$company->affiliations]);
                                        $affiliations = array_filter((array)$affiliations);
                                    ?>
                                    <?php if(!empty($affiliations)): ?>
                                        <?php echo e(implode(', ', array_map('trim', $affiliations))); ?>

                                    <?php else: ?>
                                        <?php echo e($company->affiliations); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->youtube_video): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('YouTube Video')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <a href="<?php echo e($company->youtube_video); ?>" target="_blank" rel="noopener" style="color: #0ea5e9; text-decoration: none;"><?php echo e(__('Watch Video')); ?></a>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->google): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Google')); ?>:</strong>
                                <span style="color: #475569; font-size: 15px; margin-left: 10px;">
                                    <a href="<?php echo e($company->google); ?>" target="_blank" rel="noopener" style="color: #0ea5e9; text-decoration: none;"><?php echo e(__('View on Google')); ?></a>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if($company->is_verified): ?>
                            <div class="company-detail-item">
                                <strong style="color: #0c1e3c; font-size: 15px;"><?php echo e(__('Verification Status')); ?>:</strong>
                                <span style="color: #16a34a; font-size: 15px; margin-left: 10px;">
                                    <i class="fas fa-check-circle"></i> <?php echo e(__('Verified')); ?>

                                    <?php if($company->verified_at): ?>
                                        (<?php echo e(Theme::formatDate($company->verified_at)); ?>)
                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
>>>>>>> 7f84a288 (9 march update)
                <?php if($company->facebook || $company->twitter || $company->linkedin || $company->instagram): ?>
                    <div class="cd-content-card">
                        <h4 class="cd-section-title"><?php echo e(__('Social Links')); ?></h4>
                        <div class="cd-social-links">
                            <?php if($company->facebook): ?>
                                <a href="<?php echo e($company->facebook); ?>" class="cd-social-link fb" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php if($company->twitter): ?>
                                <a href="<?php echo e($company->twitter); ?>" class="cd-social-link tw" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if($company->linkedin): ?>
                                <a href="<?php echo e($company->linkedin); ?>" class="cd-social-link li" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if($company->instagram): ?>
                                <a href="<?php echo e($company->instagram); ?>" class="cd-social-link ig" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                
<<<<<<< HEAD
                <?php if($jobs->isNotEmpty()): ?>
=======
                <?php if(isset($jobs) && $jobs && method_exists($jobs, 'isNotEmpty') && $jobs->isNotEmpty()): ?>
>>>>>>> 7f84a288 (9 march update)
                    <div class="cd-content-card">
                        <h4 class="cd-section-title"><?php echo e(__('Available Jobs')); ?> (<?php echo e($jobs->count()); ?>)</h4>
                        <div class="twm-jobs-list-wrap">
                            <ul style="list-style:none; padding:0; margin:0;">
<<<<<<< HEAD
                                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.job-items'), ['job' => $jobs, 'layout'=> 'list'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
=======
                                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.job-items'), ['jobs' => $jobs, 'layout'=> 'list'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
>>>>>>> 7f84a288 (9 march update)
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if(JobBoardHelper::isEnabledReview()): ?>
                    <div class="cd-content-card">
                        <?php echo Theme::partial('companies.reviews', compact('company', 'canReviewCompany')); ?>

                    </div>
                <?php endif; ?>

                
<<<<<<< HEAD
<<<<<<< HEAD
                <?php if($admissionOpen): ?>
=======
                <?php if(isset($admissionOpen) && $admissionOpen && $company->admission): ?>
>>>>>>> 7f84a288 (9 march update)
=======
                <?php if(!empty($showAdmissionOnProfile) && $company->admission): ?>
>>>>>>> 4bffcdd8 (13 marh update)
                <div class="cd-content-card">
                    <h4 class="cd-section-title"><?php echo e(__('Get Admission with :name', ['name' => $company->name])); ?></h4>
                    <h5 class="mb-2" style="font-size: 1.1rem; font-weight: 600; color: #0c1e3c;"><?php echo e(__('About School / Institution')); ?></h5>
                    <p class="text-muted small mb-2" style="font-size: 0.85rem;"><?php echo e(__('Details added by the institution for admission.')); ?></p>
<<<<<<< HEAD
                    <div class="mb-4" style="color: #475569; line-height: 1.6;"><?php echo BaseHelper::clean($company->admission->content); ?></div>
=======
                    <?php if($company->admission->content): ?>
                        <div class="mb-4" style="color: #475569; line-height: 1.6;"><?php echo BaseHelper::clean($company->admission->content); ?></div>
                    <?php endif; ?>
>>>>>>> 7f84a288 (9 march update)
                    <h5 class="mb-3" style="font-size: 1rem; font-weight: 600;"><?php echo e(__('Enquiry Form')); ?></h5>
                    <p class="text-muted small mb-3"><?php echo e(__('Submit your admission enquiry using the form below or use the button above.')); ?></p>
                    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <?php elseif(!empty($admissionFormLocked)): ?>
                
                <div class="cd-content-card" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                    <h4 class="cd-section-title mb-3">
                        <i class="fas fa-lock text-secondary me-2"></i><?php echo e(__('Admission Form on Profile')); ?> – <?php echo e(__('Locked')); ?>

                    </h4>
                    <p class="text-muted mb-3"><?php echo e(__('This feature is not included in your current package. Add "Admission Form on Profile" to your package or unlock it with credits to show the admission enquiry form on your institution profile.')); ?></p>
                    <?php if(!empty($isOwner)): ?>
                        <?php if(!empty($canUnlockAdmission)): ?>
                            <form action="<?php echo e(route('public.account.wallet.unlock_admission_form')); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="redirect_url" value="<?php echo e($company->url); ?>">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                                    <i class="fas fa-coins me-2"></i><?php echo e(__('Unlock with :credits credits', ['credits' => $admissionUnlockCredits])); ?>

                                </button>
                            </form>
                        <?php elseif(isset($admissionUnlockCredits) && $admissionUnlockCredits > 0): ?>
                            <p class="mb-0">
                                <a href="<?php echo e(route('public.account.wallet')); ?>" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                                    <i class="fas fa-wallet me-2"></i><?php echo e(__('Add credits to unlock')); ?> (<?php echo e(__(':credits credits required', ['credits' => $admissionUnlockCredits])); ?>)
                                </a>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="col-lg-4 col-md-12">
                
                <?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
                    <?php $sidebarAds = render_page_ads('company-detail', 'sidebar-right'); ?>
                    <?php if(!empty($sidebarAds)): ?>
                        <div class="cd-sidebar-card" style="margin-bottom: 20px;">
                            <?php echo $sidebarAds; ?>

                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                
<<<<<<< HEAD
                <div class="cd-sidebar-card">
                    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.company-map'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
=======
                <?php if($company->latitude && $company->longitude): ?>
                    <div class="cd-sidebar-card">
                        <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.company-map'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                <?php endif; ?>
>>>>>>> 7f84a288 (9 march update)

                
                <?php if(! JobBoardHelper::hideCompanyEmailEnabled()): ?>
                    <?php if($company->annual_revenue || $company->year_founded || $company->ceo || $company->phone || $company->number_of_offices || $company->number_of_employees): ?>
                        <div class="cd-sidebar-card">
                            <h4><?php echo e(__('Company Info')); ?></h4>
                            <ul class="cd-info-list">
                                <?php if($company->annual_revenue): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-money-bill-wave"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('Annual Revenue')); ?></div>
                                            <div class="cd-info-value">$ <?php echo e($company->annual_revenue); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if($company->year_founded): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-clock"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('Year founded')); ?></div>
                                            <div class="cd-info-value"><?php echo e($company->year_founded); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if($company->ceo): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-user-tie"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('CEO')); ?></div>
                                            <div class="cd-info-value"><?php echo e($company->ceo); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if($company->phone): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-mobile-alt"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('Phone')); ?></div>
                                            <div class="cd-info-value"><?php echo e($company->phone); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if($company->number_of_offices): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-building"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('Number of offices')); ?></div>
                                            <div class="cd-info-value"><?php echo e($company->number_of_offices); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php if($company->number_of_employees): ?>
                                    <li>
                                        <span class="cd-info-icon"><i class="fas fa-users"></i></span>
                                        <div class="cd-info-text">
                                            <div class="cd-info-label"><?php echo e(__('Number of employees')); ?></div>
                                            <div class="cd-info-value"><?php echo e($company->number_of_employees); ?></div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        
        <?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
            <?php $bottomAds = render_page_ads('company-detail', 'bottom'); ?>
            <?php if(!empty($bottomAds)): ?>
                <div class="company-detail-ads-bottom" style="margin: 30px 0;">
                    <?php echo $bottomAds; ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>


<?php if(!empty($showAdmissionOnProfile) && $company->admission): ?>
<style>
#admissionEnquiryModal .modal-dialog { max-width: 520px; }
#admissionEnquiryModal .modal-body { padding: 1rem 1.25rem 1.5rem; }
#admissionEnquiryModal .admission-enquiry-form .form-label { font-weight: 600; color: #334155; margin-bottom: 6px; font-size: 0.9rem; }
#admissionEnquiryModal .admission-enquiry-form .form-control,
#admissionEnquiryModal .admission-enquiry-form .form-select { border-radius: 8px; border: 1px solid #e2e8f0; padding: 8px 12px; font-size: 0.95rem; }
#admissionEnquiryModal .admission-enquiry-form .btn-primary { border-radius: 8px; padding: 10px 20px; font-weight: 600; }
</style>
<div class="modal fade" id="admissionEnquiryModal" tabindex="-1" aria-labelledby="admissionEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="modal-title" id="admissionEnquiryModalLabel">
                    <i class="fas fa-graduation-cap me-2 text-success"></i><?php echo e(__('Admission Enquiry')); ?> - <?php echo e($company->name); ?>

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.admission.partials.enquiry-form'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/company.blade.php ENDPATH**/ ?>