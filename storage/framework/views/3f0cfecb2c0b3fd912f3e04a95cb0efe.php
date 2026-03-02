<?php
    Theme::set('pageTitle', $candidate->name ?? 'Candidate');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    Theme::layout('default');
    $formatLabel = function($v) { return ucwords(str_replace('_', ' ', (string)$v)); };
?>

<?php echo Theme::partial('candidate-card-styles'); ?>


<style>
/* Prevent text cutting */
body {
    overflow-x: hidden;
}
.cdt-hero,
.cdt-main,
.cdt-horizontal-section {
    overflow: visible !important;
}
/* Candidate profile — Compact Design */
.cdt-hero {
    background: #f8fafc;
    padding: 100px 0 40px;
    position: relative;
    border-bottom: 1px solid #e5e7eb;
    margin-top: 0;
    overflow: visible;
}
.cdt-hero .container {
    padding-top: 20px;
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
    padding-top: 10px;
    margin-top: 10px;
}
.cdt-hero-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #fff;
    box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
    flex-shrink: 0;
    margin-top: 5px;
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
    padding: 60px 0 60px;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    overflow: visible;
}
.cdt-main .container {
    padding-top: 30px;
    padding-bottom: 20px;
}
.cdt-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #475569;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 24px;
    padding: 8px 16px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    transition: all .2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.cdt-back-btn:hover { 
    color: #1e293b; 
    background: #f8fafc;
    border-color: #cbd5e1;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transform: translateX(-2px);
}
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
    font-size: 16px;
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
    font-size: 16px;
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
    font-size: 16px;
    font-weight: 500;
    color: #0066cc;
    margin-bottom: 6px;
}
.cdt-timeline-desc {
    font-size: 16px;
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
    font-size: 16px;
    color: #6b7280;
    font-weight: 600;
    min-width: 160px;
}
.cdt-detail-value {
    font-size: 16px;
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
    font-size: 16px;
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


<?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
    <?php $topAds = render_page_ads('candidate-detail', 'top'); ?>
    <?php if(!empty($topAds)): ?>
        <div class="candidate-detail-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            <?php echo $topAds; ?>

        </div>
    <?php endif; ?>
<?php endif; ?>



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
                    $youtubeEmbedUrl = null;
                    if (!empty($youtubeUrl) && is_string($youtubeUrl)) {
                        $yt = trim($youtubeUrl);
                        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $yt, $m)) $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $m[1];
                        elseif (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/watch\?.*&v=)([a-zA-Z0-9_-]{11})/', $yt, $m)) $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $m[1];
                        elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $yt, $m)) $youtubeEmbedUrl = 'https://www.youtube.com/embed/' . $m[1];
                        elseif (strpos($yt, 'youtube.com/embed/') !== false) $youtubeEmbedUrl = $yt;
                    }
                ?>


<style>
.cdt-horizontal-section {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-left: 3px solid #4269c2;
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
    overflow: visible;
    transition: all 0.3s;
}
.cdt-horizontal-section:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
    border-left-color: #4269c2;
}
.cdt-horizontal-section h5 {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 18px;
    margin-top: 0;
    padding-bottom: 12px;
    padding-top: 0;
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 8px;
    overflow: visible;
    background: #f8fafc;
    padding-left: 12px;
    padding-right: 12px;
    margin-left: -12px;
    margin-right: -12px;
    border-radius: 8px 8px 0 0;
}
.cdt-horizontal-section h5 i {
    font-size: 18px;
    color: #64748b;
    overflow: visible;
    background: #f1f5f9;
    padding: 6px;
    border-radius: 6px;
}
.cdt-horizontal-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 14px;
    font-size: 16px;
    padding: 8px 0;
}
.cdt-horizontal-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-height: auto;
    padding: 14px 16px;
    overflow: visible;
    background: #ffffff;
    border-radius: 10px;
    /* border: 1px solid #e5e7eb; */
    transition: all 0.2s;
    /* box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04); */
}
.cdt-horizontal-item:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
}
.cdt-horizontal-item .label-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}
.cdt-horizontal-item i {
    font-size: 16px;
    /* color: #64748b; */
    flex-shrink: 0;
    width: 16px;
    height: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    overflow: visible;
}
.cdt-horizontal-item .label,
.cdt-horizontal-item .value {
    overflow: visible;
    line-height: 1.6;
}
.cdt-horizontal-item .label {
    color: #64748b;
    font-weight: 400;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    flex: 1;
}
.cdt-horizontal-item .value {
    color: #1e293b;
    font-size: 16px;
    font-weight: 500;
    word-break: break-word;
    margin-top: 4px;
}
.cdt-social-links {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.cdt-social-links a {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: #f3f4f6;
    color: #4b5563;
    text-decoration: none;
    transition: all 0.2s;
}
.cdt-social-links a:hover {
    background: #e5e7eb;
    color: #0066cc;
}
.cdt-action-buttons {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}
.cdt-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.cdt-action-btn-primary {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff !important;
}
.cdt-action-btn-primary:hover {
    background: linear-gradient(135deg, #005bb5 0%, #004a94 100%);
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.35);
    transform: translateY(-2px);
    color: #fff !important;
}
.cdt-action-btn-secondary {
    background: #fff;
    color: #0073d1 !important;
    border: 2px solid #0073d1;
}
.cdt-action-btn-secondary:hover {
    background: #f0f7ff;
    border-color: #005bb5;
    color: #005bb5 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 115, 209, 0.2);
}
    cursor: pointer;
    transition: all 0.2s;
}
.cdt-action-btn-primary {
    background: #0073d1;
    color: #fff;
}
.cdt-action-btn-primary:hover {
    background: #005bb5;
    color: #fff;
}
.cdt-action-btn-secondary {
    background: #e0f2fe;
    color: #0073d1;
}
.cdt-action-btn-secondary:hover {
    background: #bae6fd;
    color: #005bb5;
}
.cdt-audio-preview {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f9fafb;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}
.cdt-audio-preview audio {
    flex: 1;
    max-width: 100%;
}
.cdt-video-preview {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 8px;
    background: #000;
}
.cdt-video-preview iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
.cdt-professional-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
}
.cdt-professional-item {
    padding: 16px 18px;
    background: #ffffff;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    /* border-left: 3px solid #64748b; */
    transition: all 0.3s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.cdt-professional-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
    border-left-color: #475569;
}
.cdt-professional-item h6 {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}
.cdt-professional-item h6 i {
    font-size: 18px;
    background: #f1f5f9;
    padding: 6px;
    border-radius: 6px;
    color: #64748b;
}
.cdt-professional-item ul {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 16px;
    color: #4b5563;
    line-height: 1.8;
}
.cdt-professional-item ul li {
    padding: 10px 12px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 16px;
    background: #fff;
    margin-bottom: 6px;
    border-radius: 6px;
    transition: all 0.2s;
}
.cdt-professional-item ul li:hover {
    background: #f8fafc;
    /* border-left: 3px solid #64748b; */
    padding-left: 15px;
}
.cdt-professional-item ul li:last-child {
    border-bottom: none;
    margin-bottom: 0;
}
.cdt-professional-item ul li strong {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    display: block;
    margin-bottom: 4px;
}
.cdt-professional-item p {
    font-size: 16px;
    line-height: 1.8;
    color: #4b5563;
    padding: 12px;
    background: #fff;
    border-radius: 6px;
    margin: 0;
}
.cdt-download-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid #e5e7eb;
}
.cdt-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.cdt-download-btn-primary {
    background: #0073d1;
    color: #fff;
}
.cdt-download-btn-primary:hover {
    background: #005bb5;
    color: #fff;
}
.cdt-download-btn-outline {
    background: #fff;
    color: #0073d1;
    border: 2px solid #0073d1;
}
.cdt-download-btn-outline:hover {
    background: #eef6fc;
    color: #005bb5;
}
@media (max-width: 767px) {
    .cdt-horizontal-grid {
        grid-template-columns: 1fr;
    }
    .cdt-professional-grid {
        grid-template-columns: 1fr;
    }
}
</style>


<div class="cdt-main">
    <div class="container">
        <a href="javascript:history.back()" class="cdt-back-btn" style="margin-top: 10px; margin-bottom: 15px; display: inline-block;">← <?php echo e(__('Back')); ?></a>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="cdt-horizontal-section" style="margin-top: 0; padding-top: 24px; padding-bottom: 24px; overflow: visible; background: #ffffff; ">
                    <div class="cdt-horizontal-grid" style="grid-template-columns: auto repeat(auto-fit, minmax(180px, 1fr)); align-items: start; padding-top: 8px; padding-bottom: 8px;">
                        
                        <div class="cdt-horizontal-item" style="grid-row: 1; align-self: center; padding: 0; background: transparent; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 50%; width: 90px; height: 90px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin: 0 auto;">
                            <img src="<?php echo e($candidate->avatar_url ?? ''); ?>" alt="<?php echo e($candidate->name); ?>" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #e5e7eb; display: block;">
                        </div>
                        
                        
                        <div class="cdt-horizontal-item" style="grid-column: 2 / -1; margin-bottom: 16px; padding: 16px 20px; background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%); border: 2px solid #e5e7eb; border-left: 4px solid #0073d1; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
                            <span class="value" style="font-size: 20px; font-weight: 800; color: #1e293b; display: block; line-height: 1.4; letter-spacing: -0.02em;"><?php echo e($candidate->name ?? '—'); ?></span>
                        </div>
                        
                        
                        <?php if($currentLocStr && $currentLocStr !== '—'): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-map-pin"></i>
                                    <span class="label"><?php echo e(__('Current Location')); ?></span>
                                </div>
                                <span class="value"><?php echo e($currentLocStr); ?></span>
                                </div>
                            <?php endif; ?>
                        
                        
                        <?php if($instTypesDisplay && $instTypesDisplay !== '—'): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-building"></i>
                                    <span class="label"><?php echo e(__('Institution Type')); ?></span>
                        </div>
                                <span class="value"><?php echo e($instTypesDisplay); ?></span>
                    </div>
                        <?php endif; ?>
                        
                        
                        <?php if($positionTypeStr && $positionTypeStr !== '—'): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-briefcase"></i>
                                    <span class="label"><?php echo e(__('Position')); ?></span>
                </div>
                                <span class="value"><?php echo e(str_replace(['teaching', 'non_teaching'], [__('Teaching'), __('Non-Teaching')], $positionTypeStr)); ?></span>
                            </div>
                        <?php endif; ?>

                        
                        <?php
                            $subjectsRoleValue = '—';
                            if($positionTypeStr && (strpos($positionTypeStr, 'teaching') !== false || (is_array($posType) && in_array('teaching', $posType)))) {
                                $subjectsRoleValue = $teachSubjectsDisplay;
                            } elseif($positionTypeStr && (strpos($positionTypeStr, 'non_teaching') !== false || (is_array($posType) && in_array('non_teaching', $posType)))) {
                                $subjectsRoleValue = $nonTeachDisplay;
                            }
                        ?>
                        <?php if($subjectsRoleValue && $subjectsRoleValue !== '—'): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-book"></i>
                                    <span class="label"><?php echo e(__('Subjects/Role')); ?></span>
                                </div>
                                <span class="value"><?php echo e($subjectsRoleValue); ?></span>
                            </div>
                    <?php endif; ?>

                        
                        <?php if($candidate->gender): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-user"></i>
                                    <span class="label"><?php echo e(__('Gender')); ?></span>
                </div>
                                <span class="value"><?php echo e(ucfirst($candidate->gender)); ?></span>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($candidate->marital_status): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-heart"></i>
                                    <span class="label"><?php echo e(__('Marital Status')); ?></span>
                                </div>
                                <span class="value"><?php echo e(ucwords(str_replace('_', ' ', $candidate->marital_status))); ?></span>
                            </div>
                    <?php endif; ?>

                        
                        <?php if($candidate->dob): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-calendar"></i>
                                    <span class="label"><?php echo e(__('Date of Birth')); ?></span>
                </div>
                                <span class="value"><?php echo e(is_object($candidate->dob) ? $candidate->dob->format('M d, Y') : $candidate->dob); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        
                        <?php if($candidate->created_at): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-clock"></i>
                                    <span class="label"><?php echo e(__('Profile Created')); ?></span>
                                </div>
                                <span class="value"><?php echo e($candidate->created_at->format('M d, Y')); ?></span>
                            </div>
                    <?php endif; ?>
                        <?php if($candidate->updated_at): ?>
                            <div class="cdt-horizontal-item">
                                <div class="label-wrapper">
                                    <i class="feather-refresh-cw"></i>
                                    <span class="label"><?php echo e(__('Last Updated')); ?></span>
                </div>
                                <span class="value"><?php echo e($candidate->updated_at->diffForHumans()); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        
                        <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                            <?php if($candidate->phone): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-phone"></i>
                                        <span class="label"><?php echo e(__('Phone')); ?></span>
                                    </div>
                                    <span class="value"><?php echo e($candidate->phone); ?></span>
                                </div>
                <?php endif; ?>
                            <?php if($candidate->alternate_phone): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-phone"></i>
                                        <span class="label"><?php echo e(__('Alternate Phone')); ?></span>
                </div>
                                    <span class="value"><?php echo e($candidate->alternate_phone); ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        
                        <?php if(!empty($socialLinks)): ?>
                            <div class="cdt-horizontal-item" style="grid-column: 1 / -1;">
                                <div class="label-wrapper">
                                    <i class="feather-share-2"></i>
                                    <span class="label"><?php echo e(__('Social Profiles')); ?></span>
                    </div>
                                <div class="cdt-social-links">
                                    <?php if(!empty($socialLinks['linkedin'])): ?>
                                        <a href="<?php echo e($socialLinks['linkedin']); ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty($socialLinks['facebook'])): ?>
                                        <a href="<?php echo e($socialLinks['facebook']); ?>" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty($socialLinks['twitter'])): ?>
                                        <a href="<?php echo e($socialLinks['twitter']); ?>" target="_blank" rel="noopener noreferrer" title="Twitter"><i class="fab fa-twitter"></i></a>
                                    <?php endif; ?>
                                    <?php if(!empty($socialLinks['instagram'])): ?>
                                        <a href="<?php echo e($socialLinks['instagram']); ?>" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
                                    <?php endif; ?>
                </div>
                </div>
                <?php endif; ?>

                        
                        <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                            <div class="cdt-horizontal-item" style="grid-column: 1 / -1;">
                                <div class="cdt-action-buttons">
                                    <?php if($candidate->email): ?>
                                        <a href="mailto:<?php echo e($candidate->email); ?>" class="cdt-action-btn cdt-action-btn-primary">
                                            <i class="feather-mail"></i> <?php echo e(__('Send Email')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if($candidate->phone && $candidate->is_whatsapp_available): ?>
                                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $candidate->phone)); ?>" target="_blank" rel="noopener noreferrer" class="cdt-action-btn cdt-action-btn-secondary">
                                            <i class="fab fa-whatsapp"></i> <?php echo e(__('WhatsApp')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false)): ?>
                                        <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-action-btn cdt-action-btn-primary">
                                            <i class="feather-download"></i> <?php echo e(__('Download Resume')); ?>

                                        </a>
                                    <?php endif; ?>
                                            </div>
                                        </div>
                        <?php endif; ?>
                                </div>
                        </div>

                
                <?php
                    $hasStatusData = $candidate->current_work_status || ($noticeDisplay && $noticeDisplay !== '—') || $candidate->current_salary || $candidate->expected_salary;
                ?>
                <?php if($hasStatusData): ?>
                    <div class="cdt-horizontal-section">
                        <h5><i class="feather-briefcase"></i> <?php echo e(__('Current Status & Salary')); ?></h5>
                        <div class="cdt-horizontal-grid">
                            <?php if($candidate->current_work_status): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-check-circle"></i>
                                        <span class="label"><?php echo e(__('Working Now / Not Working')); ?></span>
                                            </div>
                                    <span class="value"><?php echo e($formatLabel($candidate->current_work_status)); ?></span>
                                        </div>
                            <?php endif; ?>
                            <?php if($noticeDisplay && $noticeDisplay !== '—'): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-calendar"></i>
                                        <span class="label"><?php echo e(__('Notice Period')); ?></span>
                                    </div>
                                    <span class="value"><?php echo e($noticeDisplay); ?></span>
                                </div>
                                    <?php endif; ?>
                            <?php if($candidate->current_salary): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-dollar-sign"></i>
                                        <span class="label"><?php echo e(__('Current Salary')); ?></span>
                        </div>
                                    <span class="value">₹<?php echo e(number_format($candidate->current_salary)); ?><?php echo ($candidate->current_salary_period ?? null) ? ' / ' . e($candidate->current_salary_period) : ''; ?></span>
                                            </div>
                            <?php endif; ?>
                            <?php if($candidate->expected_salary): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-trending-up"></i>
                                        <span class="label"><?php echo e(__('Expected Salary')); ?></span>
                                        </div>
                                    <span class="value">₹<?php echo e(number_format($candidate->expected_salary)); ?><?php echo ($candidate->expected_salary_period ?? null) ? ' / ' . e($candidate->expected_salary_period) : ''; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                                </div>
                            <?php endif; ?>

                
                <?php
                    $hasAvailabilityData = $candidate->remote_only || ($jobTypeDisplay && $jobTypeDisplay !== '—') || ($currentLocStr && $currentLocStr !== '—') || ($nativeLocStr && $nativeLocStr !== '—') || ($workPrefLabel && $workPrefLabel !== '—') || (is_array($candidate->work_location_preferences) && !empty($candidate->work_location_preferences));
                ?>
                <?php if($hasAvailabilityData): ?>
                    <div class="cdt-horizontal-section">
                        <h5><i class="feather-map-pin"></i> <?php echo e(__('Availability and Location Preferences')); ?></h5>
                        <div class="cdt-horizontal-grid">
                            <?php if($candidate->remote_only || ($jobTypeDisplay && $jobTypeDisplay !== '—')): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-clock"></i>
                                        <span class="label"><?php echo e(__('Job Type')); ?></span>
                                </div>
                                    <span class="value">
                                        <?php if($candidate->remote_only): ?>
                                            <?php echo e(__('Available only for Remote Job')); ?>

                                        <?php else: ?>
                                            <?php echo e($jobTypeDisplay); ?>

                            <?php endif; ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php if($currentLocStr && $currentLocStr !== '—'): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-map-pin"></i>
                                        <span class="label"><?php echo e(__('Current Location')); ?></span>
                                    </div>
                                    <span class="value"><?php echo e($currentLocStr); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($nativeLocStr && $nativeLocStr !== '—'): ?>
                                <div class="cdt-horizontal-item">
                                    <div class="label-wrapper">
                                        <i class="feather-home"></i>
                                        <span class="label"><?php echo e(__('Native Location')); ?></span>
                            </div>
                                    <span class="value"><?php echo e($nativeLocStr); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($workPrefLabel && $workPrefLabel !== '—' || (is_array($candidate->work_location_preferences) && !empty($candidate->work_location_preferences))): ?>
                                <div class="cdt-horizontal-item" style="grid-column: 1 / -1;">
                                    <div class="label-wrapper">
                                        <i class="feather-navigation"></i>
                                        <span class="label"><?php echo e(__('Work Location Preference')); ?></span>
                                        </div>
                                    <span class="value"><?php echo e($workPrefLabel); ?></span>
                                    <?php if(is_array($candidate->work_location_preferences) && !empty($candidate->work_location_preferences)): ?>
                                        <div style="margin-top: 8px; font-size: 16px; color: #4b5563;">
                                            <strong><?php echo e(__('Preferred Locations')); ?>:</strong>
                                            <?php $__currentLoopData = $candidate->work_location_preferences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $locParts = array_filter([
                                                        $pref['city_name'] ?? '',
                                                        $pref['state_name'] ?? '',
                                                        $pref['country_name'] ?? ''
                                                    ]);
                                                ?>
                                                <?php if(!empty($locParts)): ?>
                                                    <span style="display: inline-block; margin: 2px 4px; padding: 2px 8px; background: #eef6fc; border-radius: 4px;"><?php echo e(implode(', ', $locParts)); ?></span>
                                    <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if($candidate->bio ?? $candidate->description ?? null): ?>
                    <div class="cdt-horizontal-section">
                        <h5><i class="feather-info"></i> <?php echo e(__('About')); ?></h5>
                        <div style="font-size: 16px; color: #374151; line-height: 1.8; padding: 16px 20px; background: #f8fafc; border-radius: 10px; margin-top: 8px;">
                            <?php echo BaseHelper::clean($candidate->bio ?? $candidate->description); ?>

                </div>
                    </div>
                <?php endif; ?>

                
                <?php if($candidate->introductory_audio || !empty($youtubeEmbedUrl) || !empty($youtubeUrl)): ?>
                    <div class="cdt-horizontal-section">
                        <h5><i class="feather-video"></i> <?php echo e(__('Intro Audio / Video')); ?></h5>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px;">
                            <?php if($candidate->introductory_audio): ?>
                                <div class="cdt-audio-preview">
                                    <i class="feather-music" style="font-size: 20px; color: #0066cc;"></i>
                                    <audio controls style="flex: 1;">
                                        <source src="<?php echo e(RvMedia::getImageUrl($candidate->introductory_audio)); ?>" type="audio/mpeg">
                                        <?php echo e(__('Your browser does not support the audio element.')); ?>

                                    </audio>
                    </div>
                <?php endif; ?>
                            <?php if(!empty($youtubeEmbedUrl)): ?>
                                <div class="cdt-video-preview">
                                    <iframe src="<?php echo e($youtubeEmbedUrl); ?>" allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture" allowfullscreen></iframe>
            </div>
                            <?php elseif(!empty($youtubeUrl)): ?>
                                <div style="padding: 12px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb;">
                                    <a href="<?php echo e($youtubeUrl); ?>" target="_blank" rel="noopener noreferrer" class="cdt-action-btn cdt-action-btn-secondary">
                                        <i class="fab fa-youtube"></i> <?php echo e(__('Watch on YouTube')); ?>

                                    </a>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                
                <?php
                    $hasQualification = is_array($candidate->qualifications) && !empty($candidate->qualifications);
                    $hasExperience = isset($experiences) && $experiences->isNotEmpty();
                    $hasLanguages = is_array($candidate->languages) && !empty($candidate->languages);
                    $hasSkills = ($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0) || (is_array($candidate->skills) && !empty($candidate->skills));
                    $hasInterest = !empty(trim($candidate->interests ?? ''));
                    $hasAchievement = !empty(trim($candidate->achievements ?? ''));
                    $hasProfessionalData = $hasQualification || $hasExperience || $hasLanguages || $hasSkills || $hasInterest || $hasAchievement;
                ?>
                <?php if($hasProfessionalData): ?>
                    <div class="cdt-horizontal-section">
                        <h5><i class="feather-briefcase"></i> <?php echo e(__('Professional Information')); ?></h5>
                        <div class="cdt-professional-grid">
                            
                            <?php if($hasQualification): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-graduation-cap"></i> <?php echo e(__('Qualification')); ?></h6>
                                    <ul>
                                        <?php $__currentLoopData = $candidate->qualifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $level = $q['level'] ?? '';
                                                $spec = $q['specialization'] ?? '';
                                                $inst = $q['institution'] ?? '';
                                                $level = $level ? ucwords(str_replace('_', ' ', $level)) : '';
                                                $spec = $spec ? ucwords(str_replace('_', ' ', $spec)) : '';
                                            ?>
                                            <li>
                                                <strong><?php echo e($level); ?></strong>
                                                <?php if($spec): ?> — <?php echo e($spec); ?><?php endif; ?>
                                                <?php if($inst): ?> (<?php echo e($inst); ?>)<?php endif; ?>
                                </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                            <?php endif; ?>

                            
                            <?php if($hasExperience): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-briefcase"></i> <?php echo e(__('Experience')); ?></h6>
                                    <ul>
                                        <?php $__currentLoopData = $experiences->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <strong><?php echo e($exp->company ?? '—'); ?></strong><br>
                                                <?php echo e($exp->position ?? ''); ?>

                                                <?php if($exp->started_at): ?>
                                                    (<?php echo e($exp->started_at->format('Y')); ?> - <?php echo e(($exp->is_current || !$exp->ended_at) ? __('Present') : ($exp->ended_at ? $exp->ended_at->format('Y') : '')); ?>)
                                                <?php endif; ?>
                                </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                            <?php endif; ?>

                            
                            <?php if($hasLanguages): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-globe"></i> <?php echo e(__('Languages')); ?></h6>
                                    <ul>
                                        <?php $__currentLoopData = $candidate->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $langName = is_array($lang) ? ($lang['language'] ?? '') : (string)$lang;
                                                $prof = is_array($lang) ? ($lang['proficiency'] ?? '') : '';
                                                $langName = $langName ? ucwords(str_replace('_', ' ', $langName)) : $langName;
                                                $prof = $prof ? ucwords(str_replace('_', ' ', $prof)) : $prof;
                                            ?>
                                            <li><?php echo e($langName); ?><?php echo $prof ? ' – ' . e($prof) : ''; ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    </div>
                            <?php endif; ?>

                            
                            <?php if($hasSkills): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-star"></i> <?php echo e(__('Skills')); ?></h6>
                                    <?php if($candidate->favoriteSkills && $candidate->favoriteSkills->count() > 0): ?>
                                        <ul>
                                            <?php $__currentLoopData = $candidate->favoriteSkills->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($skill->name); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                                    <?php elseif(is_array($candidate->skills) && !empty($candidate->skills)): ?>
                                        <ul>
                                            <?php $__currentLoopData = array_slice($candidate->skills, 0, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e(is_array($skill) ? ($skill['skill'] ?? '') : $skill); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                    </div>
                            <?php endif; ?>

                            
                            <?php if($hasInterest): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-heart"></i> <?php echo e(__('Interest')); ?></h6>
                                    <p style="font-size: 16px; color: #4b5563; margin: 0; white-space: pre-line;"><?php echo nl2br(e(Str::limit($candidate->interests, 200))); ?></p>
                                </div>
                                        <?php endif; ?>

                            
                            <?php if($hasAchievement): ?>
                                <div class="cdt-professional-item">
                                    <h6><i class="feather-award"></i> <?php echo e(__('Achievement')); ?></h6>
                                    <p style="font-size: 16px; color: #4b5563; margin: 0; white-space: pre-line;"><?php echo nl2br(e(Str::limit($candidate->achievements, 200))); ?></p>
                                    </div>
                            <?php endif; ?>
                                    </div>
                    </div>
                <?php endif; ?>

                
                <?php if(JobBoardHelper::canViewCandidateInformation()): ?>
                    <div class="cdt-horizontal-section">
                        <div class="cdt-download-buttons">
                            <?php if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false)): ?>
                                <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-download-btn cdt-download-btn-primary">
                                    <i class="feather-download"></i> <?php echo e(__('Download Resume')); ?>

                                </a>
                            <?php endif; ?>
                            <?php if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false)): ?>
                                <a href="<?php echo e($candidate->resume_url ?? '#'); ?>" download class="cdt-download-btn cdt-download-btn-outline">
                                    <i class="feather-download"></i> <?php echo e(__('Download Profile')); ?>

                                </a>
                            <?php endif; ?>
                            <?php if($candidate->cover_letter ?? null): ?>
                                <a href="<?php echo e(RvMedia::getImageUrl($candidate->cover_letter)); ?>" download class="cdt-download-btn cdt-download-btn-outline">
                                    <i class="feather-download"></i> <?php echo e(__('Download Cover Letter')); ?>

                                </a>
                            <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>

        
        <?php if(is_plugin_active('ads') && function_exists('render_page_ads')): ?>
            <?php $bottomAds = render_page_ads('candidate-detail', 'bottom'); ?>
            <?php if(!empty($bottomAds)): ?>
                <div class="candidate-detail-ads-bottom" style="margin: 30px 0;">
                    <?php echo $bottomAds; ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/job-board/candidate.blade.php ENDPATH**/ ?>