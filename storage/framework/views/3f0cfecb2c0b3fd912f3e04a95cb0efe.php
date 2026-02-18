<?php
    Theme::set('pageTitle', $candidate->name);
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
?>

<?php echo Theme::partial('candidate-card-styles'); ?>


<style>
/* ===== Candidate Detail Hero ===== */
.cdt-hero {
    background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 60%, #bae6fd 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}
.cdt-hero::before {
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
.cdt-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
    font-size: 13px;
}
.cdt-breadcrumb a { color: #0073d1; text-decoration: none; font-weight: 500; }
.cdt-breadcrumb a:hover { color: #0c4a6e; }
.cdt-breadcrumb span { color: #94a3b8; }
.cdt-hero-content {
    display: flex;
    align-items: flex-start;
    gap: 24px;
}
.cdt-hero-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.1);
    flex-shrink: 0;
}
.cdt-hero-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cdt-hero-info { flex: 1; }
.cdt-hero-info h1 {
    font-size: 30px;
    font-weight: 800;
    color: #0c1e3c;
    margin-bottom: 6px;
}
.cdt-hero-desc {
    font-size: 14px;
    color: #475569;
    margin-bottom: 14px;
    line-height: 1.6;
}
.cdt-hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.cdt-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    color: #fff;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
    border: none;
    cursor: pointer;
}
.cdt-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,115,209,.3);
    color: #fff;
}
.cdt-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 24px;
    background: #fff;
    color: #0073d1;
    border: 2px solid #0073d1;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all .25s;
}
.cdt-btn-outline:hover {
    background: #f0f9ff;
    transform: translateY(-2px);
    color: #0073d1;
}

/* ===== Main Area ===== */
.cdt-main {
    padding: 40px 0 80px;
    background: #f8fafc;
}
.cdt-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cdt-section-title {
    font-size: 20px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    position: relative;
}
.cdt-section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(135deg, #0073d1, #0073d1);
    border-radius: 2px;
}
.cdt-card .ck-content {
    font-size: 15px;
    line-height: 1.8;
    color: #334155;
}

/* Timeline */
.cdt-timeline { position: relative; padding-left: 24px; }
.cdt-timeline::before {
    content: '';
    position: absolute;
    left: 6px;
    top: 8px;
    bottom: 8px;
    width: 2px;
    background: linear-gradient(180deg, #0073d1, #e2e8f0);
    border-radius: 2px;
}
.cdt-timeline-item {
    position: relative;
    padding-bottom: 24px;
}
.cdt-timeline-item:last-child { padding-bottom: 0; }
.cdt-timeline-item::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 6px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #fff;
    border: 3px solid #0073d1;
    z-index: 1;
}
.cdt-timeline-date {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    color: #0073d1;
    background: #f0f9ff;
    padding: 3px 12px;
    border-radius: 20px;
    margin-bottom: 8px;
}
.cdt-timeline-title {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2px;
}
.cdt-timeline-subtitle {
    font-size: 14px;
    font-weight: 500;
    color: #0073d1;
    margin-bottom: 6px;
}
.cdt-timeline-desc {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
}

/* ===== Sidebar ===== */
.cdt-sidebar-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.cdt-sidebar-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0c1e3c;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}
.cdt-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cdt-info-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.cdt-info-list li:last-child { border-bottom: none; }
.cdt-info-icon {
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
.cdt-info-text { flex: 1; }
.cdt-info-label {
    font-size: 12px;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: .3px;
    font-weight: 600;
    margin-bottom: 2px;
}
.cdt-info-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 600;
}

/* Back Button */
.cdt-back-btn {
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
.cdt-back-btn:hover { color: #0c4a6e; gap: 8px; }

/* ===== Responsive ===== */
@media(max-width: 991px) {
    .cdt-hero { padding: 90px 0 40px; }
    .cdt-hero-info h1 { font-size: 24px; }
    .cdt-card { padding: 24px; }
}
@media(max-width: 767px) {
    .cdt-hero { padding: 80px 15px 30px; }
    .cdt-hero-content { flex-direction: column; align-items: center; text-align: center; gap: 16px; }
    .cdt-hero-avatar { width: 80px; height: 80px; }
    .cdt-hero-info h1 { font-size: 22px; }
    .cdt-hero-actions { justify-content: center; }
    .cdt-card { padding: 20px; border-radius: 12px; }
    .cdt-sidebar-card { padding: 20px; }
    .cdt-main { padding: 25px 0 50px; }
    .cdt-breadcrumb { justify-content: center; }
}
</style>


<section class="cdt-hero">
    <div class="container">
        <div class="cdt-breadcrumb">
            <a href="/"><?php echo e(__('Home')); ?></a>
            <span>→</span>
            <span style="color: #475569;"><?php echo e(Str::limit($candidate->name, 40)); ?></span>
        </div>

        <div class="cdt-hero-content">
            <div class="cdt-hero-avatar">
                <img src="<?php echo e($candidate->avatar_url); ?>" alt="<?php echo e($candidate->name); ?>">
            </div>
            <div class="cdt-hero-info">
                <h1><?php echo e($candidate->name); ?></h1>
                <?php if($candidate->description): ?>
                    <p class="cdt-hero-desc"><?php echo BaseHelper::clean($candidate->description); ?></p>
                <?php endif; ?>
                <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                    <div class="cdt-hero-actions">
                        <?php if($candidate->phone): ?>
                            <a href="tel:<?php echo e($candidate->phone); ?>" class="cdt-btn-primary">
                                <i class="feather-phone"></i> <?php echo e(__('Hire Me Now')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if(!$candidate->hide_cv && $candidate->resume): ?>
                            <a href="<?php echo e($candidate->resume_url); ?>" download class="cdt-btn-outline">
                                <i class="feather-download"></i> <?php echo e(__('Download CV')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<div class="cdt-main">
    <div class="container">
        <a href="javascript:history.back()" class="cdt-back-btn">← <?php echo e(__('Back')); ?></a>

        <div class="row">
            
            <div class="<?php if(JobBoardHelper::canViewCandidateInformation()): ?> col-lg-8 <?php else: ?> col-lg-12 <?php endif; ?> col-md-12">
                
                <?php if($candidate->bio): ?>
                    <div class="cdt-card">
                        <h4 class="cdt-section-title"><?php echo e(__('About Me')); ?></h4>
                        <div class="ck-content">
                            <?php echo BaseHelper::clean($candidate->bio); ?>

                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if($experiences->isNotEmpty()): ?>
                    <div class="cdt-card">
                        <h4 class="cdt-section-title"><?php echo e(__('Work Experience')); ?></h4>
                        <div class="cdt-timeline">
                            <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cdt-timeline-item">
                                    <span class="cdt-timeline-date">
                                        <?php echo e(__(':from to :to', [
                                            'from' => $experience->started_at->format('Y'),
                                            'to' => ($experience->is_current || !$experience->ended_at) ? __('Present') : $experience->ended_at->format('Y'),
                                        ])); ?>

                                    </span>
                                    <div class="cdt-timeline-title"><?php echo e($experience->company); ?></div>
                                    <?php if($experience->position): ?>
                                        <div class="cdt-timeline-subtitle"><?php echo e($experience->position); ?></div>
                                    <?php endif; ?>
                                    <?php if($experience->description): ?>
                                        <div class="cdt-timeline-desc">
                                            <?php echo BaseHelper::clean($experience->description); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if($educations->isNotEmpty()): ?>
                    <div class="cdt-card">
                        <h4 class="cdt-section-title"><?php echo e(__('Education & Training')); ?></h4>
                        <div class="cdt-timeline">
                            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cdt-timeline-item">
                                    <span class="cdt-timeline-date">
                                        <?php echo e(__(':from to :to', [
                                            'from' => $education->started_at->format('Y'),
                                            'to' => ($education->is_current || !$education->ended_at) ? __('Present') : $education->ended_at->format('Y'),
                                        ])); ?>

                                    </span>
                                    <?php if($education->school): ?>
                                        <div class="cdt-timeline-title"><?php echo e($education->school); ?></div>
                                    <?php endif; ?>
                                    <?php if($education->specialized): ?>
                                        <div class="cdt-timeline-subtitle"><?php echo e($education->specialized); ?></div>
                                    <?php endif; ?>
                                    <?php if($education->description): ?>
                                        <div class="cdt-timeline-desc">
                                            <?php echo BaseHelper::clean($education->description); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                <div class="col-lg-4 col-md-12">
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('Profile Info')); ?></h4>
                        <ul class="cdt-info-list">
                            <?php if($candidate->gender): ?>
                                <li>
                                    <span class="cdt-info-icon"><i class="fas fa-venus-mars"></i></span>
                                    <div class="cdt-info-text">
                                        <div class="cdt-info-label"><?php echo e(__('Gender')); ?></div>
                                        <div class="cdt-info-value"><?php echo e(ucfirst($candidate->gender)); ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if($candidate->phone): ?>
                                <li>
                                    <span class="cdt-info-icon"><i class="fas fa-mobile-alt"></i></span>
                                    <div class="cdt-info-text">
                                        <div class="cdt-info-label"><?php echo e(__('Phone')); ?></div>
                                        <div class="cdt-info-value"><?php echo e($candidate->phone); ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if($candidate->email): ?>
                                <li>
                                    <span class="cdt-info-icon"><i class="fas fa-at"></i></span>
                                    <div class="cdt-info-text">
                                        <div class="cdt-info-label"><?php echo e(__('Email')); ?></div>
                                        <div class="cdt-info-value"><?php echo e($candidate->email); ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                            <?php if($candidate->address): ?>
                                <li>
                                    <span class="cdt-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                    <div class="cdt-info-text">
                                        <div class="cdt-info-label"><?php echo e(__('Address')); ?></div>
                                        <div class="cdt-info-value"><?php echo e($candidate->address); ?></div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/candidate.blade.php ENDPATH**/ ?>