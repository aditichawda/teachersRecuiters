<?php
    Theme::set('pageTitle', $candidate->name ?? 'Candidate');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    Theme::layout('default');
    $formatLabel = function($v) { return ucwords(str_replace('_', ' ', (string)$v)); };
?>

<?php echo Theme::partial('candidate-card-styles'); ?>


<style>
/* Candidate profile — Indeed / Jobs in Education inspired */
.cdt-hero {
    background: linear-gradient(165deg, #e8f4fc 0%, #d4ebf7 35%, #b8dff0 100%);
    padding: 100px 0 56px;
    position: relative;
    overflow: hidden;
}
.cdt-hero::before {
    content: '';
    position: absolute;
    top: -120px;
    right: -80px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(0, 102, 204, .08) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
}
.cdt-hero::after {
    content: '';
    position: absolute;
    bottom: -60px;
    left: -60px;
    width: 280px;
    height: 280px;
    background: radial-gradient(circle, rgba(0, 102, 204, .06) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.cdt-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 13px;
    color: #5c6b7a;
}
.cdt-breadcrumb a {
    color: #0066cc;
    text-decoration: none;
    font-weight: 500;
}
.cdt-breadcrumb a:hover { text-decoration: underline; }
.cdt-breadcrumb span { color: #8b99a6; }
.cdt-hero-content {
    display: flex;
    align-items: flex-start;
    gap: 28px;
}
.cdt-hero-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #fff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
    flex-shrink: 0;
}
.cdt-hero-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cdt-hero-info { flex: 1; }
.cdt-hero-info h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
    letter-spacing: -0.02em;
}
.cdt-hero-desc {
    font-size: 15px;
    color: #4a5568;
    margin-bottom: 18px;
    line-height: 1.65;
    max-width: 640px;
}
.cdt-hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
.cdt-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: #0066cc;
    color: #fff !important;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background .2s, box-shadow .2s;
}
.cdt-btn-primary:hover {
    background: #0052a3;
    box-shadow: 0 4px 12px rgba(0, 102, 204, .35);
    color: #fff !important;
}
.cdt-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: #fff;
    color: #0066cc !important;
    border: 2px solid #0066cc;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.cdt-btn-outline:hover {
    background: #eef6fc;
    color: #0052a3 !important;
}
.cdt-main {
    padding: 36px 0 80px;
    background: #f3f2ef;
}
.cdt-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #0066cc;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 20px;
    transition: color .2s;
}
.cdt-back-btn:hover { color: #004080; }
.cdt-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 28px 32px;
    margin-bottom: 20px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    transition: box-shadow .2s, border-color .2s;
    border-left: 4px solid #0066cc;
}
.cdt-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, .06);
    border-color: #d1d5db;
    border-left-color: #0066cc;
}
.cdt-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    position: relative;
}
.cdt-section-title::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 48px;
    height: 2px;
    background: #0066cc;
    border-radius: 1px;
}
.cdt-card .ck-content {
    font-size: 15px;
    line-height: 1.75;
    color: #374151;
}
.cdt-timeline {
    position: relative;
    padding-left: 24px;
}
.cdt-timeline::before {
    content: '';
    position: absolute;
    left: 6px;
    top: 8px;
    bottom: 8px;
    width: 2px;
    background: linear-gradient(180deg, #0066cc, #e5e7eb);
    border-radius: 2px;
}
.cdt-timeline-item {
    position: relative;
    padding-bottom: 22px;
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
    border: 3px solid #0066cc;
    z-index: 1;
}
.cdt-timeline-date {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    color: #0066cc;
    background: #eef6fc;
    padding: 4px 12px;
    border-radius: 6px;
    margin-bottom: 8px;
}
.cdt-timeline-title {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 2px;
}
.cdt-timeline-subtitle {
    font-size: 14px;
    font-weight: 500;
    color: #0066cc;
    margin-bottom: 6px;
}
.cdt-timeline-desc {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}
.cdt-detail-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 16px;
    padding: 14px 0;
    border-bottom: 1px solid #f3f4f6;
}
.cdt-detail-row:last-child { border-bottom: none; }
.cdt-detail-label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    min-width: 160px;
}
.cdt-detail-value {
    font-size: 14px;
    color: #1f2937;
    flex: 1;
}
.cdt-simple-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cdt-simple-list li {
    padding: 10px 0;
    border-bottom: 1px solid #f3f4f6;
    font-size: 14px;
    color: #374151;
}
.cdt-simple-list li:last-child { border-bottom: none; }
.cdt-empty-msg {
    color: #9ca3af;
    font-size: 14px;
    margin: 0;
    padding: 8px 0;
}
.cdt-sidebar-wrap {
    position: sticky;
    top: 100px;
}
.cdt-sidebar-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 24px 26px;
    margin-bottom: 20px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
}
.cdt-sidebar-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    position: relative;
}
.cdt-sidebar-card h4::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 36px;
    height: 2px;
    background: #0066cc;
    border-radius: 1px;
}
.cdt-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.cdt-info-list li {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}
.cdt-info-list li:last-child { border-bottom: none; }
.cdt-info-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #eef6fc;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0066cc;
    font-size: 14px;
    flex-shrink: 0;
}
.cdt-info-text { flex: 1; min-width: 0; }
.cdt-info-label {
    font-size: 11px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .4px;
    font-weight: 600;
    margin-bottom: 2px;
}
.cdt-info-value {
    font-size: 14px;
    color: #1f2937;
    font-weight: 600;
    word-break: break-word;
}
.cdt-info-value-block {
    font-weight: 500;
    line-height: 1.5;
    white-space: pre-line;
}
.cdt-sidebar-card .cdt-info-value a {
    color: #0066cc;
    font-weight: 600;
}
.cdt-sidebar-card .cdt-info-value a:hover {
    text-decoration: underline;
}
@media (max-width: 991px) {
    .cdt-hero { padding: 90px 0 44px; }
    .cdt-hero-info h1 { font-size: 24px; }
    .cdt-hero-avatar { width: 100px; height: 100px; }
    .cdt-card { padding: 22px 24px; }
    .cdt-sidebar-wrap { position: static; }
}
/* Candidate Details reference UI: section headings, tabs, numbered timeline, tags, footer */
.cdt-block-heading {
    font-size: 1rem;
    font-weight: 700;
    color: #0066cc;
    margin-bottom: 1rem;
    padding-bottom: 0.35rem;
}
.cdt-card-inner { padding: 0; }
.cdt-personal-card {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    flex-wrap: wrap;
}
.cdt-text-block { font-size: 0.9375rem; color: #374151; line-height: 1.7; white-space: pre-line; }
.cdt-link-yt {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    background: #fef2f2;
    color: #b91c1c;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9375rem;
    transition: background .2s, color .2s;
}
.cdt-link-yt:hover { background: #fee2e2; color: #991b1b; }
.cdt-personal-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #e5e7eb;
    flex-shrink: 0;
}
.cdt-personal-avatar img { width: 100%; height: 100%; object-fit: cover; }
.cdt-personal-info { flex: 1; min-width: 0; }
.cdt-personal-name { font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.25rem; }
.cdt-personal-role { font-size: 0.875rem; color: #0066cc; font-weight: 600; margin-bottom: 0.5rem; }
.cdt-skill-tags { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.75rem; }
.cdt-skill-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.6rem;
    background: #fef3c7;
    color: #92400e;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
}
.cdt-skill-tag .tag-label { color: #78716c; font-weight: 500; }
.cdt-tabs-wrap { margin-top: 0.5rem; }
.cdt-tabs-nav {
    display: flex;
    gap: 0;
    border-bottom: 2px solid #e5e7eb;
    margin-bottom: 0;
}
.cdt-tab-btn {
    padding: 0.75rem 1.5rem;
    font-size: 0.9375rem;
    font-weight: 600;
    color: #6b7280;
    background: #f9fafb;
    border: none;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    cursor: pointer;
    transition: color .2s, background .2s;
}
.cdt-tab-btn:hover { color: #0066cc; background: #eef6fc; }
.cdt-tab-btn.active {
    color: #fff;
    background: #0066cc;
    border-bottom-color: #0066cc;
}
.cdt-tab-pane { display: none; padding: 1.5rem 0 0; }
.cdt-tab-pane.active { display: block; }
.cdt-timeline-num {
    display: flex;
    gap: 1rem;
    padding-bottom: 1.5rem;
}
.cdt-timeline-num:last-child { padding-bottom: 0; }
.cdt-timeline-num-circle {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 50%;
    background: #0066cc;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cdt-timeline-num-body { flex: 1; min-width: 0; }
.cdt-timeline-num-period { font-size: 0.8125rem; color: #6b7280; margin-bottom: 0.25rem; }
.cdt-timeline-num-title { font-size: 1rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.15rem; }
.cdt-timeline-num-sub { font-size: 0.875rem; color: #0066cc; font-weight: 600; margin-bottom: 0.35rem; }
.cdt-timeline-num-desc { font-size: 0.875rem; color: #4b5563; line-height: 1.5; }
.cdt-footer-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}
.cdt-footer-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 0.9375rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: background .2s, color .2s;
}
.cdt-footer-btn-resume {
    background: #dbeafe;
    color: #0066cc;
}
.cdt-footer-btn-resume:hover { background: #bfdbfe; color: #0052a3; }
.cdt-footer-btn-profile {
    background: #0066cc;
    color: #fff;
}
.cdt-footer-btn-profile:hover { background: #0052a3; color: #fff; }
@media (max-width: 767px) {
    .cdt-hero { padding: 80px 16px 32px; }
    .cdt-hero-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 18px;
    }
    .cdt-hero-avatar { width: 96px; height: 96px; }
    .cdt-hero-info h1 { font-size: 22px; }
    .cdt-hero-desc { margin-left: auto; margin-right: auto; }
    .cdt-hero-actions { justify-content: center; }
    .cdt-card { padding: 20px; }
    .cdt-main { padding: 24px 0 56px; }
    .cdt-breadcrumb { justify-content: center; }
    .cdt-tabs-nav { flex-wrap: wrap; }
    .cdt-tab-btn { flex: 1; min-width: 120px; }
}
</style>


<section class="cdt-hero">
    <div class="container">
        <div class="cdt-breadcrumb">
            <a href="/"><?php echo e(__('Home')); ?></a>
            <span>→</span>
            <span style="color: #475569;"><?php echo e(Str::limit($candidate->name ?? 'Candidate', 40)); ?></span>
        </div>
        <div class="cdt-hero-content">
            <div class="cdt-hero-avatar">
                <img src="<?php echo e($candidate->avatar_url ?? ''); ?>" alt="<?php echo e($candidate->name ?? 'Candidate'); ?>">
            </div>
            <div class="cdt-hero-info">
                <h1><?php echo e($candidate->name ?? 'Candidate'); ?></h1>
                <?php if($candidate->description ?? null): ?>
                    <p class="cdt-hero-desc"><?php echo BaseHelper::clean($candidate->description); ?></p>
                <?php endif; ?>
                <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                    <div class="cdt-hero-actions">
                        <?php if($candidate->phone ?? null): ?>
                            <a href="tel:<?php echo e($candidate->phone); ?>" class="cdt-btn-primary"><i class="feather-phone"></i> <?php echo e(__('Hire Me Now')); ?></a>
                        <?php endif; ?>
                        <?php if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false)): ?>
                            <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-btn-outline"><i class="feather-download"></i> <?php echo e(__('Download CV')); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
                    $posType = $candidate->position_type ?? null;
                    $positionTypeStr = is_array($posType) ? implode(', ', $posType) : (string)$posType;
                    $jobTypeLabels = ['full_time' => 'Full Time', 'part_time' => 'Part Time', 'contract' => 'Contract', 'temporary' => 'Temporary', 'visiting_faculty' => 'Visiting Faculty', 'ad_hoc' => 'Ad-Hoc'];
                    $instTypes = $candidate->institution_types ?? null;
                    $instTypesDisplay = (is_array($instTypes) && !empty($instTypes)) ? implode(', ', array_map($formatLabel, $instTypes)) : '—';
                    $teachSubjects = $candidate->teaching_subjects ?? null;
                    $teachSubjectsDisplay = (is_array($teachSubjects) && !empty($teachSubjects)) ? implode(', ', array_map($formatLabel, $teachSubjects)) : '—';
                    $nonTeach = $candidate->non_teaching_positions ?? null;
                    $nonTeachDisplay = (is_array($nonTeach) && !empty($nonTeach)) ? implode(', ', array_map($formatLabel, $nonTeach)) : '—';
                    $jobPrefs = $candidate->job_type_preferences ?? null;
                    $jobTypeDisplay = '—';
                    if (is_array($jobPrefs) && !empty($jobPrefs)) {
                        $jobTypeDisplay = implode(', ', array_map(function($k) use ($jobTypeLabels) { return $jobTypeLabels[$k] ?? ucwords(str_replace('_', ' ', $k)); }, $jobPrefs));
                    }
                    $noticeDisplay = $candidate->notice_period ?? null;
                    $noticeDisplay = $noticeDisplay !== null && $noticeDisplay !== '' ? $formatLabel($noticeDisplay) : '—';
                    $totalExp = $candidate->total_experience ?? null;
                    $totalExpDisplay = ($totalExp !== null && $totalExp !== '') ? $formatLabel($totalExp) : '—';
                    $curParts = array_filter(array_map('strval', [$candidate->address ?? '', $candidate->locality ?? '', $candidate->city_name ?? '', $candidate->state_name ?? '', $candidate->country_name ?? '']));
                    $currentLocStr = implode(', ', $curParts) . (($candidate->pin_code ?? null) ? ' - ' . $candidate->pin_code : '');
                    $nativeLocStr = '—';
                    if ($candidate->native_same_as_current ?? false) { $nativeLocStr = __('Same as current location'); }
                    elseif ($candidate->native_address ?? $candidate->native_city_name ?? $candidate->native_state_name ?? $candidate->native_country_name ?? $candidate->native_locality ?? null) {
                        $np = array_filter(array_map('strval', [$candidate->native_address ?? '', $candidate->native_locality ?? '', $candidate->native_city_name ?? '', $candidate->native_state_name ?? '', $candidate->native_country_name ?? '']));
                        $nativeLocStr = implode(', ', $np) . (($candidate->native_pin_code ?? null) ? ' ' . $candidate->native_pin_code : '');
                    }
                    $workPrefLabel = '—';
                    if (($candidate->work_location_preference_type ?? '') === 'current_only') $workPrefLabel = __('Open to work only at Current Location');
                    elseif (($candidate->work_location_preference_type ?? '') === 'relocation_india') $workPrefLabel = __('Open for relocation across India');
                    elseif (($candidate->work_location_preference_type ?? '') === 'other') $workPrefLabel = __('Other work location preferences');
                    $firstRole = (isset($experiences) && $experiences->isNotEmpty() && !empty($experiences->first()->position)) ? ucwords($experiences->first()->position) : __('Teaching Professional');
                    $socialLinks = is_array($candidate->social_links ?? null) ? $candidate->social_links : [];
                    $youtubeUrl = $socialLinks['youtube'] ?? $candidate->introductory_video_url ?? null;
                ?>


<div class="cdt-main">
    <div class="container">
        <a href="javascript:history.back()" class="cdt-back-btn">← <?php echo e(__('Back')); ?></a>
        <div class="row">
            <div class="<?php if(JobBoardHelper::canViewCandidateInformation()): ?> col-lg-8 <?php else: ?> col-lg-12 <?php endif; ?> col-md-12">
                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('Personal Details')); ?></h4>
                    <div class="cdt-personal-card">
                        <div class="cdt-personal-avatar">
                            <img src="<?php echo e($candidate->avatar_url ?? ''); ?>" alt="<?php echo e($candidate->name ?? 'Candidate'); ?>">
                        </div>
                        <div class="cdt-personal-info">
                            <div class="cdt-personal-name"><?php echo e($candidate->name ?? 'Candidate'); ?></div>
                            <div class="cdt-personal-role"><?php echo e($firstRole); ?></div>
                            <?php if($candidate->gender ?? null): ?><div class="text-muted small"><?php echo e(__('Gender')); ?>: <?php echo e(ucfirst($candidate->gender)); ?></div><?php endif; ?>
                            <?php if(is_array($teachSubjects) && !empty($teachSubjects)): ?>
                                <div class="cdt-skill-tags">
                                    <?php $__currentLoopData = array_slice($teachSubjects, 0, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="cdt-skill-tag"><?php echo e($formatLabel($sub)); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('Description About Me')); ?></h4>
                    <?php if($candidate->bio ?? null): ?>
                        <div class="ck-content"><?php echo BaseHelper::clean($candidate->bio); ?></div>
                    <?php else: ?>
                        <p class="cdt-empty-msg">— <?php echo e(__('No description added')); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('Interests')); ?></h4>
                    <?php if(!empty(trim($candidate->interests ?? ''))): ?>
                        <div class="cdt-text-block"><?php echo nl2br(e($candidate->interests)); ?></div>
                    <?php else: ?>
                        <p class="cdt-empty-msg">— <?php echo e(__('No interests added')); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('Achievements')); ?></h4>
                    <?php if(!empty(trim($candidate->achievements ?? ''))): ?>
                        <div class="cdt-text-block"><?php echo nl2br(e($candidate->achievements)); ?></div>
                    <?php else: ?>
                        <p class="cdt-empty-msg">— <?php echo e(__('No achievements added')); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('Activities')); ?></h4>
                    <?php if(!empty(trim($candidate->activities ?? ''))): ?>
                        <div class="cdt-text-block"><?php echo nl2br(e($candidate->activities)); ?></div>
                    <?php else: ?>
                        <p class="cdt-empty-msg">— <?php echo e(__('No activities added')); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><?php echo e(__('YouTube Link')); ?></h4>
                    <?php if(!empty($youtubeUrl)): ?>
                        <a href="<?php echo e($youtubeUrl); ?>" target="_blank" rel="noopener noreferrer" class="cdt-link-yt"><i class="fab fa-youtube"></i> <?php echo e(__('Watch on YouTube')); ?></a>
                    <?php else: ?>
                        <p class="cdt-empty-msg">— <?php echo e(__('No YouTube link added')); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="cdt-card">
                    <div class="cdt-tabs-wrap">
                        <div class="cdt-tabs-nav" role="tablist">
                            <button type="button" class="cdt-tab-btn active" data-cdt-tab="work" role="tab"><?php echo e(__('Work Experience')); ?></button>
                            <button type="button" class="cdt-tab-btn" data-cdt-tab="education" role="tab"><?php echo e(__('Education Details')); ?></button>
                            <button type="button" class="cdt-tab-btn" data-cdt-tab="other" role="tab"><?php echo e(__('Other Details')); ?></button>
                        </div>

                        <div id="cdt-pane-work" class="cdt-tab-pane active" role="tabpanel">
                            <?php if(isset($experiences) && $experiences->isNotEmpty()): ?>
                                <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cdt-timeline-num">
                                        <div class="cdt-timeline-num-circle"><?php echo e(str_pad($idx + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                                        <div class="cdt-timeline-num-body">
                                            <div class="cdt-timeline-num-period">
                                                <?php echo e(($experience->started_at ? $experience->started_at->format('Y-m-d') : '')); ?> <?php echo e(__('to')); ?> <?php echo e(($experience->is_current || !$experience->ended_at) ? __('Till Now') : ($experience->ended_at ? $experience->ended_at->format('Y-m-d') : '')); ?>

                                            </div>
                                            <div class="cdt-timeline-num-title"><?php echo e($experience->company ?? ''); ?></div>
                                            <?php if($experience->position ?? null): ?><div class="cdt-timeline-num-sub"><?php echo e(ucwords($experience->position)); ?></div><?php endif; ?>
                                            <?php if($experience->description ?? null): ?><div class="cdt-timeline-num-desc"><?php echo BaseHelper::clean($experience->description); ?></div><?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p class="cdt-empty-msg">— <?php echo e(__('No work experience added')); ?></p>
                            <?php endif; ?>
                        </div>

                        <div id="cdt-pane-education" class="cdt-tab-pane" role="tabpanel">
                            <?php if(isset($educations) && $educations->isNotEmpty()): ?>
                                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cdt-timeline-num">
                                        <div class="cdt-timeline-num-circle"><?php echo e(str_pad($idx + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                                        <div class="cdt-timeline-num-body">
                                            <div class="cdt-timeline-num-period">
                                                <?php echo e(($education->started_at ? $education->started_at->format('Y-m-d') : '')); ?> <?php echo e(__('to')); ?> <?php echo e(($education->is_current || !$education->ended_at) ? __('Till Now') : ($education->ended_at ? $education->ended_at->format('Y-m-d') : '')); ?>

                                            </div>
                                            <?php if($education->school ?? null): ?><div class="cdt-timeline-num-title"><?php echo e(ucwords($education->school)); ?></div><?php endif; ?>
                                            <?php if($education->specialized ?? null): ?><div class="cdt-timeline-num-sub"><?php echo e(ucwords($education->specialized)); ?></div><?php endif; ?>
                                            <?php if($education->description ?? null): ?><div class="cdt-timeline-num-desc"><?php echo BaseHelper::clean($education->description); ?></div><?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p class="cdt-empty-msg">— <?php echo e(__('No education added')); ?></p>
                            <?php endif; ?>
                        </div>

                        <div id="cdt-pane-other" class="cdt-tab-pane" role="tabpanel">
                            <?php if(!empty(trim($candidate->interests ?? ''))): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-2"><?php echo e(__('Interests')); ?></div>
                                    <div class="cdt-text-block"><?php echo nl2br(e($candidate->interests)); ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty(trim($candidate->achievements ?? ''))): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-2"><?php echo e(__('Achievements')); ?></div>
                                    <div class="cdt-text-block"><?php echo nl2br(e($candidate->achievements)); ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty(trim($candidate->activities ?? ''))): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-2"><?php echo e(__('Activities')); ?></div>
                                    <div class="cdt-text-block"><?php echo nl2br(e($candidate->activities)); ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($youtubeUrl ?? null)): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-2"><?php echo e(__('YouTube Link')); ?></div>
                                    <a href="<?php echo e($youtubeUrl); ?>" target="_blank" rel="noopener noreferrer" class="cdt-link-yt"><i class="fab fa-youtube"></i> <?php echo e(__('Watch on YouTube')); ?></a>
                                </div>
                            <?php endif; ?>
                            <div class="cdt-detail-list mb-4">
                                <div class="cdt-section-title mb-3"><?php echo e(__('Job Preferences')); ?></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Preferred Institution Type')); ?></span><span class="cdt-detail-value"><?php echo e($instTypesDisplay); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Position Type')); ?></span><span class="cdt-detail-value"><?php echo e($positionTypeStr ? str_replace(['teaching', 'non_teaching'], [__('Teaching'), __('Non-Teaching')], $positionTypeStr) : '—'); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Teaching Subjects')); ?></span><span class="cdt-detail-value"><?php echo e($teachSubjectsDisplay); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Job Type')); ?></span><span class="cdt-detail-value"><?php echo e($jobTypeDisplay); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Notice Period')); ?></span><span class="cdt-detail-value"><?php echo e($noticeDisplay); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Total Experience')); ?></span><span class="cdt-detail-value"><?php echo e($totalExpDisplay); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Expected Salary')); ?></span><span class="cdt-detail-value"><?php echo e($candidate->expected_salary ?? '—'); ?><?php echo ($candidate->expected_salary_period ?? null) ? ' / ' . e($candidate->expected_salary_period) : ''; ?></span></div>
                            </div>
                            <div class="cdt-detail-list mb-4">
                                <div class="cdt-section-title mb-3"><?php echo e(__('Location')); ?></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Current Location')); ?></span><span class="cdt-detail-value"><?php echo e($currentLocStr ?: '—'); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Native Location')); ?></span><span class="cdt-detail-value"><?php echo e($nativeLocStr); ?></span></div>
                                <div class="cdt-detail-row"><span class="cdt-detail-label"><?php echo e(__('Work Location Preference')); ?></span><span class="cdt-detail-value"><?php echo e($workPrefLabel); ?></span></div>
                            </div>
                            <?php if(is_array($candidate->qualifications ?? null) && !empty($candidate->qualifications)): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-3"><?php echo e(__('Qualifications')); ?></div>
                                    <ul class="cdt-simple-list">
                                        <?php $__currentLoopData = $candidate->qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $level = $q['level'] ?? ''; $spec = $q['specialization'] ?? ''; $level = $level ? ucwords(str_replace('_', ' ', $level)) : ''; $spec = $spec ? ucwords(str_replace('_', ' ', $spec)) : ''; ?>
                                            <li><strong><?php echo e($level); ?></strong><?php if($spec): ?> — <?php echo e($spec); ?><?php endif; ?> <?php if(!empty($q['institution'])): ?> (<?php echo e($q['institution']); ?>)<?php endif; ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if(is_array($candidate->teaching_certifications ?? null) && !empty($candidate->teaching_certifications)): ?>
                                <div class="mb-4">
                                    <div class="cdt-section-title mb-3"><?php echo e(__('Teaching Certifications')); ?></div>
                                    <ul class="cdt-simple-list">
                                        <?php $__currentLoopData = $candidate->teaching_certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $certName = is_array($cert) ? ($cert['name'] ?? implode(', ', $cert)) : (string)$cert; $certName = $certName ? ucwords(str_replace('_', ' ', $certName)) : $certName; ?>
                                            <li><?php echo e($certName); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if(is_array($candidate->languages ?? null) && !empty($candidate->languages)): ?>
                                <div>
                                    <div class="cdt-section-title mb-3"><?php echo e(__('Languages')); ?></div>
                                    <ul class="cdt-simple-list">
                                        <?php $__currentLoopData = $candidate->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $langName = is_array($lang) ? ($lang['language'] ?? '') : (string)$lang; $prof = is_array($lang) ? ($lang['proficiency'] ?? '') : ''; $langName = $langName ? ucwords(str_replace('_', ' ', $langName)) : $langName; $prof = $prof ? ucwords(str_replace('_', ' ', $prof)) : $prof; ?>
                                            <li><?php echo e($langName); ?><?php echo $prof ? ' – ' . e($prof) : ''; ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <?php if(JobBoardHelper::canViewCandidateInformation() && ($candidate->resume ?? null) && !($candidate->hide_cv ?? false)): ?>
                    <div class="cdt-footer-actions">
                        <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-footer-btn cdt-footer-btn-resume"><i class="feather-download"></i> <?php echo e(__('Download Resume')); ?></a>
                        <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-footer-btn cdt-footer-btn-profile"><i class="feather-download"></i> <?php echo e(__('Download Profile')); ?></a>
                    </div>
                <?php endif; ?>
            </div>

            
            <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                <div class="col-lg-4 col-md-12">
                    <div class="cdt-sidebar-wrap">
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('Profile Info')); ?></h4>
                        <ul class="cdt-info-list">
                            <?php if($candidate->gender ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-venus-mars"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Gender')); ?></div><div class="cdt-info-value"><?php echo e(ucfirst($candidate->gender)); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->dob ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-birthday-cake"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Date of Birth')); ?></div><div class="cdt-info-value"><?php echo e(is_object($candidate->dob) ? $candidate->dob->format('M d, Y') : $candidate->dob); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->marital_status ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-heart"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Marital Status')); ?></div><div class="cdt-info-value"><?php echo e(ucfirst(str_replace('_', ' ', $candidate->marital_status))); ?></div></div></li><?php endif; ?>
                            <?php if(($candidate->total_experience ?? null) !== null && $candidate->total_experience !== ''): ?><li><span class="cdt-info-icon"><i class="fas fa-briefcase"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Experience')); ?></div><div class="cdt-info-value"><?php echo e($formatLabel($candidate->total_experience)); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->current_work_status ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-user-tie"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Work Status')); ?></div><div class="cdt-info-value"><?php echo e($formatLabel($candidate->current_work_status)); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->notice_period ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-calendar-alt"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Notice Period')); ?></div><div class="cdt-info-value"><?php echo e($formatLabel($candidate->notice_period)); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->expected_salary ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-rupee-sign"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Expected Salary')); ?></div><div class="cdt-info-value"><?php echo e($candidate->expected_salary); ?><?php echo ($candidate->expected_salary_period ?? null) ? ' / ' . e($candidate->expected_salary_period) : ''; ?></div></div></li><?php endif; ?>
                            <?php if($candidate->phone ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-mobile-alt"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Phone')); ?></div><div class="cdt-info-value"><?php echo e($candidate->phone); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->email ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-at"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Email')); ?></div><div class="cdt-info-value"><?php echo e($candidate->email); ?></div></div></li><?php endif; ?>
                            <?php if($candidate->address ?? $candidate->city_name ?? $candidate->state_name ?? null): ?><li><span class="cdt-info-icon"><i class="fas fa-map-marker-alt"></i></span><div class="cdt-info-text"><div class="cdt-info-label"><?php echo e(__('Location')); ?></div><div class="cdt-info-value"><?php echo e($candidate->address ?? ''); ?><?php echo e(($candidate->city_name ?? null) ? ', ' . $candidate->city_name : ''); ?><?php echo e(($candidate->state_name ?? null) ? ', ' . $candidate->state_name : ''); ?><?php echo e(($candidate->country_name ?? null) ? ', ' . $candidate->country_name : ''); ?></div></div></li><?php endif; ?>
                        </ul>
                    </div>

                    
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('Interests')); ?></h4>
                        <ul class="cdt-info-list">
                            <li>
                                <span class="cdt-info-icon"><i class="fas fa-star"></i></span>
                                <div class="cdt-info-text">
                                    <div class="cdt-info-label"><?php echo e(__('Interests')); ?></div>
                                    <div class="cdt-info-value cdt-info-value-block"><?php echo e(!empty(trim($candidate->interests ?? '')) ? Str::limit(strip_tags($candidate->interests), 120) : '—'); ?></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('Achievements')); ?></h4>
                        <ul class="cdt-info-list">
                            <li>
                                <span class="cdt-info-icon"><i class="fas fa-trophy"></i></span>
                                <div class="cdt-info-text">
                                    <div class="cdt-info-label"><?php echo e(__('Achievements')); ?></div>
                                    <div class="cdt-info-value cdt-info-value-block"><?php echo e(!empty(trim($candidate->achievements ?? '')) ? Str::limit(strip_tags($candidate->achievements), 120) : '—'); ?></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('Activities')); ?></h4>
                        <ul class="cdt-info-list">
                            <li>
                                <span class="cdt-info-icon"><i class="fas fa-tasks"></i></span>
                                <div class="cdt-info-text">
                                    <div class="cdt-info-label"><?php echo e(__('Activities')); ?></div>
                                    <div class="cdt-info-value cdt-info-value-block"><?php echo e(!empty(trim($candidate->activities ?? '')) ? Str::limit(strip_tags($candidate->activities), 120) : '—'); ?></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="cdt-sidebar-card">
                        <h4><?php echo e(__('YouTube Link')); ?></h4>
                        <ul class="cdt-info-list">
                            <li>
                                <span class="cdt-info-icon"><i class="fab fa-youtube"></i></span>
                                <div class="cdt-info-text">
                                    <div class="cdt-info-label"><?php echo e(__('YouTube')); ?></div>
                                    <div class="cdt-info-value">
                                        <?php if(!empty($youtubeUrl)): ?>
                                            <a href="<?php echo e($youtubeUrl); ?>" target="_blank" rel="noopener noreferrer" class="text-decoration-none"><?php echo e(__('Watch on YouTube')); ?></a>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
(function() {
    var nav = document.querySelector('.cdt-tabs-nav');
    if (!nav) return;
    nav.addEventListener('click', function(e) {
        var btn = e.target.closest('.cdt-tab-btn');
        if (!btn) return;
        var tab = btn.getAttribute('data-cdt-tab');
        if (!tab) return;
        nav.querySelectorAll('.cdt-tab-btn').forEach(function(b) { b.classList.remove('active'); });
        document.querySelectorAll('.cdt-tab-pane').forEach(function(p) { p.classList.remove('active'); });
        btn.classList.add('active');
        var pane = document.getElementById('cdt-pane-' + tab);
        if (pane) pane.classList.add('active');
    });
})();
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/candidate.blade.php ENDPATH**/ ?>