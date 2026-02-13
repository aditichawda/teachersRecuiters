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
</style>


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
            </div>
        </div>
    </div>
</section>


<div class="cd-main">
    <div class="container">
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

                
                <?php if($jobs->isNotEmpty()): ?>
                    <div class="cd-content-card">
                        <h4 class="cd-section-title"><?php echo e(__('Available Jobs')); ?> (<?php echo e($jobs->count()); ?>)</h4>
                        <div class="twm-jobs-list-wrap">
                            <ul style="list-style:none; padding:0; margin:0;">
                                <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.job-items'), ['job' => $jobs, 'layout'=> 'list'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if(JobBoardHelper::isEnabledReview()): ?>
                    <div class="cd-content-card">
                        <?php echo Theme::partial('companies.reviews', compact('company', 'canReviewCompany')); ?>

                    </div>
                <?php endif; ?>
            </div>

            
            <div class="col-lg-4 col-md-12">
                
                <div class="cd-sidebar-card">
                    <?php echo $__env->make(Theme::getThemeNamespace('views.job-board.partials.company-map'), ['company' => $company], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                
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
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/company.blade.php ENDPATH**/ ?>