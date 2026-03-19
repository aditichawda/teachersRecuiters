@php
    Theme::set('pageTitle', $candidate->name ?? 'Candidate');
    Theme::set('pageCoverImage', theme_option('background_breadcrumb_default'));
    Theme::set('withPageHeader', false);
    Theme::layout('default');
    $formatLabel = function($v) { return ucwords(str_replace('_', ' ', (string)$v)); };
    $profileLocked = $profileLocked ?? false;
    $candidateIsFeatured = $candidateIsFeatured ?? false;
    $candidateIsFeatured = $candidateIsFeatured ?? false;
@endphp

{!! Theme::partial('candidate-card-styles') !!}

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
    background: #ffffff;
}
.cdt-summary-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    padding: 22px 22px;
    margin-bottom: 18px;
}
.cdt-summary-card:hover { box-shadow: 0 8px 24px rgba(15, 23, 42, .06); border-color: #dbe4f0; }
.cdt-summary-top {
    display: grid;
    grid-template-columns: 86px 1fr;
    gap: 16px;
    align-items: center;
}
.cdt-summary-avatar {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #f1f5f9;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cdt-summary-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cdt-summary-name {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}
.cdt-summary-subtitle {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}
.cdt-summary-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 12px;
}
.cdt-summary-actions .cdt-btn-primary,
.cdt-summary-actions .cdt-btn-outline {
    padding: 10px 18px;
    border-radius: 10px;
}
.cdt-btn-outline { background: #fff; }
.cdt-btn-outline:hover { background: #f1f7ff; }
.cdt-btn-soft {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #0f172a !important;
    font-weight: 700;
    text-decoration: none;
}
.cdt-btn-soft:hover { background: #eef2f7; color: #0b1220 !important; }
.cdt-summary-meta {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-top: 18px;
}
.cdt-meta-item {
    border: 1px solid #eef2f7;
    border-radius: 12px;
    padding: 14px 14px;
    background: #fff;
}
.cdt-meta-label {
    font-size: 11px;
    letter-spacing: .02em;
    text-transform: uppercase;
    color: #94a3b8;
    font-weight: 700;
    margin-bottom: 6px;
}
.cdt-meta-value {
    font-size: 14px;
    color: #0f172a;
    font-weight: 700;
    line-height: 1.35;
    word-break: break-word;
}
@media (max-width: 991px) {
    .cdt-summary-meta { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 575px) {
    .cdt-summary-top { grid-template-columns: 70px 1fr; }
    .cdt-summary-avatar { width: 70px; height: 70px; }
    .cdt-summary-meta { grid-template-columns: 1fr; }
    background: #ffffff;
}
.cdt-summary-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
    padding: 22px 22px;
    margin-bottom: 18px;
}
.cdt-summary-card:hover { box-shadow: 0 8px 24px rgba(15, 23, 42, .06); border-color: #dbe4f0; }
.cdt-summary-top {
    display: grid;
    grid-template-columns: 86px 1fr;
    gap: 16px;
    align-items: center;
}
.cdt-summary-avatar {
    width: 86px;
    height: 86px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #f1f5f9;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cdt-summary-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.cdt-summary-name {
    font-size: 22px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}
.cdt-summary-subtitle {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}
.cdt-summary-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 12px;
}
.cdt-summary-actions .cdt-btn-primary,
.cdt-summary-actions .cdt-btn-outline {
    padding: 10px 18px;
    border-radius: 10px;
}
.cdt-btn-outline { background: #fff; }
.cdt-btn-outline:hover { background: #f1f7ff; }
.cdt-btn-soft {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #0f172a !important;
    font-weight: 700;
    text-decoration: none;
}
.cdt-btn-soft:hover { background: #eef2f7; color: #0b1220 !important; }
.cdt-summary-meta {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-top: 18px;
}
.cdt-meta-item {
    border: 1px solid #eef2f7;
    border-radius: 12px;
    padding: 14px 14px;
    background: #fff;
}
.cdt-meta-label {
    font-size: 11px;
    letter-spacing: .02em;
    text-transform: uppercase;
    color: #94a3b8;
    font-weight: 700;
    margin-bottom: 6px;
}
.cdt-meta-value {
    font-size: 14px;
    color: #0f172a;
    font-weight: 700;
    line-height: 1.35;
    word-break: break-word;
}
@media (max-width: 991px) {
    .cdt-summary-meta { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 575px) {
    .cdt-summary-top { grid-template-columns: 70px 1fr; }
    .cdt-summary-avatar { width: 70px; height: 70px; }
    .cdt-summary-meta { grid-template-columns: 1fr; }
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
.cdt-card { padding: 24px 26px; }
.cdt-card .cdt-block-heading { margin-bottom: 12px; }
.cdt-card .cdt-block-heading i { opacity: .9; }
.cdt-empty-msg { color: #94a3b8; }
.cdt-detail-row { padding: 12px 0; }
.cdt-detail-label { min-width: 180px; }

.cdt-subcard {
    border: 1px solid #eef2f7;
    border-radius: 14px;
    padding: 18px 18px;
    background: #fff;
    margin-top: 12px;
}
.cdt-subcard + .cdt-subcard { margin-top: 14px; }
.cdt-subcard-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.cdt-subrow {
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.cdt-subrow:last-child { border-bottom: none; padding-bottom: 0; }
.cdt-subrow .title { font-weight: 800; color: #0f172a; }
.cdt-subrow .meta { color: #64748b; font-weight: 700; margin-top: 2px; }
.cdt-card { padding: 24px 26px; }
.cdt-card .cdt-block-heading { margin-bottom: 12px; }
.cdt-card .cdt-block-heading i { opacity: .9; }
.cdt-empty-msg { color: #94a3b8; }
.cdt-detail-row { padding: 12px 0; }
.cdt-detail-label { min-width: 180px; }

.cdt-subcard {
    border: 1px solid #eef2f7;
    border-radius: 14px;
    padding: 18px 18px;
    background: #fff;
    margin-top: 12px;
}
.cdt-subcard + .cdt-subcard { margin-top: 14px; }
.cdt-subcard-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.cdt-subrow {
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}
.cdt-subrow:last-child { border-bottom: none; padding-bottom: 0; }
.cdt-subrow .title { font-weight: 800; color: #0f172a; }
.cdt-subrow .meta { color: #64748b; font-weight: 700; margin-top: 2px; }
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
/* Locked profile: blur overlay on content */
.cdt-profile-locked-wrap {
    position: relative;
}
.cdt-profile-locked-wrap .cdt-profile-blur-overlay {
    position: absolute;
    inset: 0;
    z-index: 10;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.75);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    padding: 24px;
}
.cdt-profile-blur-overlay .cdt-unlock-box {
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 16px;
    padding: 32px 40px;
    max-width: 420px;
    text-align: center;
    box-shadow: 0 12px 40px rgba(0, 0, 0, .12);
}
.cdt-profile-blur-overlay .cdt-unlock-box .cdt-unlock-icon {
    font-size: 48px;
    color: #0066cc;
    margin-bottom: 16px;
}
.cdt-profile-blur-overlay .cdt-unlock-box h4 {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 10px;
}
.cdt-profile-blur-overlay .cdt-unlock-box p {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 20px;
    line-height: 1.5;
}
</style>

{{-- Candidate Detail Top Ads --}}
@if (is_plugin_active('ads') && function_exists('render_page_ads'))
    @php $topAds = render_page_ads('candidate-detail', 'top'); @endphp
    @if (!empty($topAds))
        <div class="candidate-detail-ads-top" style="margin: 20px auto; max-width: 1200px; padding: 0 15px;">
            {!! $topAds !!}
        </div>
    @endif
@endif

{{-- Candidate Header (updated layout) --}}
<div style="height: 18px;"></div>
{{-- Candidate Header (updated layout) --}}
<div style="height: 18px;"></div>

@if(!$profileLocked)
@php
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
                @endphp

{{-- Main --}}
<div class="cdt-main">
    <div class="container">
        <a href="javascript:history.back()" class="cdt-back-btn">← {{ __('Back') }}</a>

        {{-- Summary card (matches updated screenshots) --}}
        <div class="cdt-summary-card">
            <div class="cdt-summary-top">
                <div class="cdt-summary-avatar">
                    <img src="{{ $candidate->avatar_url ?? '' }}" alt="{{ $candidate->name ?? 'Candidate' }}">
                </div>
                <div>
                    <h1 class="cdt-summary-name">
                        <span>{{ $candidate->name ?? 'Candidate' }}</span>
                        @if($candidateIsFeatured)
                            <span class="badge bg-warning text-dark" style="font-size: 12px; font-weight: 700;">{{ __('Featured') }}</span>
                        @endif
                    </h1>
                    @if(!$profileLocked && ($candidate->description ?? null))
                        <p class="cdt-summary-subtitle">{!! BaseHelper::clean($candidate->description) !!}</p>
                    @elseif($profileLocked)
                        <p class="cdt-summary-subtitle">{{ trans('plugins/job-board::messages.candidate_profile_locked') }}</p>
                    @endif

                    @if(!$profileLocked && JobBoardHelper::canViewCandidateInformation())
                        <div class="cdt-summary-actions">
                            @if(isset($account) && $account && $account->isEmployer() && ($employerJobs ?? collect())->isNotEmpty())
                                <button type="button" class="cdt-btn-primary" data-bs-toggle="modal" data-bs-target="#cdtInviteToApplyModal" title="{{ __('25 credits per invite') }}"><i class="feather-send"></i> {{ __('Invite to Apply') }}</button>
                            @endif
                            @if($candidate->email ?? null)
                                <a href="mailto:{{ $candidate->email }}" class="cdt-btn-primary"><i class="feather-mail"></i> {{ __('Send Email') }}</a>
                            @endif
                            @if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false))
                                <a href="{{ $candidate->resume_url ?? '#' }}" download class="cdt-btn-outline"><i class="feather-download"></i> {{ __('Download Resume') }}</a>
                            @endif
                            @if($candidate->phone ?? null)
                                <a href="tel:{{ $candidate->phone }}" class="cdt-btn-soft"><i class="feather-phone"></i> {{ __('Call') }}</a>
                            @endif
                        </div>

        {{-- Summary card (matches updated screenshots) --}}
        <div class="cdt-summary-card">
            <div class="cdt-summary-top">
                <div class="cdt-summary-avatar">
                    <img src="{{ $candidate->avatar_url ?? '' }}" alt="{{ $candidate->name ?? 'Candidate' }}">
                </div>
                <div>
                    <h1 class="cdt-summary-name">
                        <span>{{ $candidate->name ?? 'Candidate' }}</span>
                        @if($candidateIsFeatured)
                            <span class="badge bg-warning text-dark" style="font-size: 12px; font-weight: 700;">{{ __('Featured') }}</span>
                        @endif
                    </h1>
                    @if(!$profileLocked && ($candidate->description ?? null))
                        <p class="cdt-summary-subtitle">{!! BaseHelper::clean($candidate->description) !!}</p>
                    @elseif($profileLocked)
                        <p class="cdt-summary-subtitle">{{ trans('plugins/job-board::messages.candidate_profile_locked') }}</p>
                    @endif

                    @if(!$profileLocked && JobBoardHelper::canViewCandidateInformation())
                        <div class="cdt-summary-actions">
                            @if(isset($account) && $account && $account->isEmployer() && ($employerJobs ?? collect())->isNotEmpty())
                                <button type="button" class="cdt-btn-primary" data-bs-toggle="modal" data-bs-target="#cdtInviteToApplyModal" title="{{ __('25 credits per invite') }}"><i class="feather-send"></i> {{ __('Invite to Apply') }}</button>
                            @endif
                            @if($candidate->email ?? null)
                                <a href="mailto:{{ $candidate->email }}" class="cdt-btn-primary"><i class="feather-mail"></i> {{ __('Send Email') }}</a>
                            @endif
                            @if(($candidate->resume ?? null) && !($candidate->hide_cv ?? false))
                                <a href="{{ $candidate->resume_url ?? '#' }}" download class="cdt-btn-outline"><i class="feather-download"></i> {{ __('Download Resume') }}</a>
                            @endif
                            @if($candidate->phone ?? null)
                                <a href="tel:{{ $candidate->phone }}" class="cdt-btn-soft"><i class="feather-phone"></i> {{ __('Call') }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
                </div>
            </div>

            <div class="cdt-summary-meta">
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Current Location') }}</div>
                    <div class="cdt-meta-value">{{ $currentLocStr ?: '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Date of Birth') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->dob ? $candidate->dob->format('M d, Y') : '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Profile Created') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->created_at ? $candidate->created_at->format('M d, Y') : '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Last Updated') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->updated_at ? $candidate->updated_at->diffForHumans() : '—' }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- Availability and Location Preferences --}}
            <div class="cdt-summary-meta">
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Current Location') }}</div>
                    <div class="cdt-meta-value">{{ $currentLocStr ?: '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Date of Birth') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->dob ? $candidate->dob->format('M d, Y') : '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Profile Created') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->created_at ? $candidate->created_at->format('M d, Y') : '—' }}</div>
                </div>
                <div class="cdt-meta-item">
                    <div class="cdt-meta-label">{{ __('Last Updated') }}</div>
                    <div class="cdt-meta-value">{{ $candidate->updated_at ? $candidate->updated_at->diffForHumans() : '—' }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- Availability and Location Preferences --}}
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><i class="ti ti-map-pin me-2"></i>{{ __('Availability and Location Preferences') }}</h4>
                    <div class="cdt-detail-row">
                        <span class="cdt-detail-label">{{ __('Current Location') }}</span>
                        <span class="cdt-detail-value">{{ $currentLocStr ?: '—' }}</span>
                    </div>
                    <h4 class="cdt-block-heading"><i class="ti ti-map-pin me-2"></i>{{ __('Availability and Location Preferences') }}</h4>
                    <div class="cdt-detail-row">
                        <span class="cdt-detail-label">{{ __('Current Location') }}</span>
                        <span class="cdt-detail-value">{{ $currentLocStr ?: '—' }}</span>
                    </div>
                </div>

                {{-- About --}}
                {{-- About --}}
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><i class="ti ti-info-circle me-2"></i>{{ __('About') }}</h4>
                    @if($candidate->bio ?? null)
                        <div class="ck-content">{!! BaseHelper::clean($candidate->bio) !!}</div>
                    @elseif($candidate->description ?? null)
                        <div class="ck-content">{!! BaseHelper::clean($candidate->description) !!}</div>
                    <h4 class="cdt-block-heading"><i class="ti ti-info-circle me-2"></i>{{ __('About') }}</h4>
                    @if($candidate->bio ?? null)
                        <div class="ck-content">{!! BaseHelper::clean($candidate->bio) !!}</div>
                    @elseif($candidate->description ?? null)
                        <div class="ck-content">{!! BaseHelper::clean($candidate->description) !!}</div>
                    @else
                        <p class="cdt-empty-msg">— {{ __('No description added') }}</p>
                        <p class="cdt-empty-msg">— {{ __('No description added') }}</p>
                    @endif
                </div>

                {{-- Professional Information --}}
                {{-- Professional Information --}}
                <div class="cdt-card">
                    <h4 class="cdt-block-heading"><i class="ti ti-briefcase me-2"></i>{{ __('Professional Information') }}</h4>

                    {{-- Experience --}}
                    <div class="cdt-subcard">
                        <div class="cdt-subcard-title"><i class="ti ti-building-skyscraper"></i>{{ __('Experience') }}</div>
                        @if(isset($experiences) && $experiences->isNotEmpty())
                            @foreach($experiences as $experience)
                                <div class="cdt-subrow">
                                    <div class="title">{{ $experience->company ?? '—' }}</div>
                                    <div class="meta">
                                        {{ $experience->position ? ucwords($experience->position) : '—' }}
                                        @if($experience->started_at)
                                            <span style="font-weight:700;"> ({{ $experience->started_at->format('Y') }}{{ ($experience->is_current || ! $experience->ended_at) ? ' - ' . __('Present') : ' - ' . $experience->ended_at?->format('Y') }})</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="cdt-empty-msg">— {{ __('No work experience added') }}</p>
                        @endif
                    </div>
                    <h4 class="cdt-block-heading"><i class="ti ti-briefcase me-2"></i>{{ __('Professional Information') }}</h4>

                    {{-- Experience --}}
                    <div class="cdt-subcard">
                        <div class="cdt-subcard-title"><i class="ti ti-building-skyscraper"></i>{{ __('Experience') }}</div>
                        @if(isset($experiences) && $experiences->isNotEmpty())
                            @foreach($experiences as $experience)
                                <div class="cdt-subrow">
                                    <div class="title">{{ $experience->company ?? '—' }}</div>
                                    <div class="meta">
                                        {{ $experience->position ? ucwords($experience->position) : '—' }}
                                        @if($experience->started_at)
                                            <span style="font-weight:700;"> ({{ $experience->started_at->format('Y') }}{{ ($experience->is_current || ! $experience->ended_at) ? ' - ' . __('Present') : ' - ' . $experience->ended_at?->format('Y') }})</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="cdt-empty-msg">— {{ __('No work experience added') }}</p>
                        @endif
                    </div>

                    {{-- Education --}}
                    <div class="cdt-subcard">
                        <div class="cdt-subcard-title"><i class="ti ti-school"></i>{{ __('Education') }}</div>
                        @if(isset($educations) && $educations->isNotEmpty())
                            @foreach($educations as $education)
                                <div class="cdt-subrow">
                                    <div class="title">{{ $education->school ? ucwords($education->school) : '—' }}</div>
                                    <div class="meta">
                                        {{ $education->specialized ? ucwords($education->specialized) : '—' }}
                                        @if($education->started_at)
                                            <span style="font-weight:700;"> ({{ $education->started_at->format('Y') }}{{ ($education->is_current || ! $education->ended_at) ? ' - ' . __('Present') : ' - ' . $education->ended_at?->format('Y') }})</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="cdt-empty-msg">— {{ __('No education added') }}</p>
                        @endif
                    {{-- Education --}}
                    <div class="cdt-subcard">
                        <div class="cdt-subcard-title"><i class="ti ti-school"></i>{{ __('Education') }}</div>
                        @if(isset($educations) && $educations->isNotEmpty())
                            @foreach($educations as $education)
                                <div class="cdt-subrow">
                                    <div class="title">{{ $education->school ? ucwords($education->school) : '—' }}</div>
                                    <div class="meta">
                                        {{ $education->specialized ? ucwords($education->specialized) : '—' }}
                                        @if($education->started_at)
                                            <span style="font-weight:700;"> ({{ $education->started_at->format('Y') }}{{ ($education->is_current || ! $education->ended_at) ? ' - ' . __('Present') : ' - ' . $education->ended_at?->format('Y') }})</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="cdt-empty-msg">— {{ __('No education added') }}</p>
                        @endif
                    </div>
                </div>

                {{-- Footer actions --}}
                {{-- Footer actions --}}
                @if(JobBoardHelper::canViewCandidateInformation() && ($candidate->resume ?? null) && !($candidate->hide_cv ?? false))
                    <div class="cdt-footer-actions">
                        <a href="{{ $candidate->resume_url ?? '#' }}" download class="cdt-footer-btn cdt-footer-btn-resume"><i class="feather-download"></i> {{ __('Download Resume') }}</a>
                        <a href="{{ $candidate->resume_url ?? '#' }}" download class="cdt-footer-btn cdt-footer-btn-profile"><i class="feather-download"></i> {{ __('Download Profile') }}</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Candidate Detail Bottom Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $bottomAds = render_page_ads('candidate-detail', 'bottom'); @endphp
            @if (!empty($bottomAds))
                <div class="candidate-detail-ads-bottom" style="margin: 30px 0;">
                    {!! $bottomAds !!}
                </div>
            @endif
        @endif
    </div>
</div>
@else
{{-- Locked profile: blurred content area with unlock box --}}
<div class="cdt-main">
    <div class="container">
        <a href="javascript:history.back()" class="cdt-back-btn">← {{ __('Back') }}</a>
        <div class="cdt-profile-locked-wrap" style="position: relative;">
            {{-- Fake blurred background (looks like locked content) --}}
            <div style="filter: blur(14px); opacity: 0.5; pointer-events: none; user-select: none;">
                <div class="cdt-card"><div class="cdt-section-title" style="border: none;">—</div><p class="cdt-empty-msg">—</p><p class="cdt-empty-msg">—</p><p class="cdt-empty-msg">—</p></div>
                <div class="cdt-card"><div class="cdt-section-title" style="border: none;">—</div><p class="cdt-empty-msg">—</p><p class="cdt-empty-msg">—</p></div>
                <div class="cdt-card"><div class="cdt-section-title" style="border: none;">—</div><p class="cdt-empty-msg">—</p></div>
            </div>
            <div class="cdt-profile-blur-overlay">
                <div class="cdt-unlock-box">
                    <div class="cdt-unlock-icon"><i class="ti ti-lock"></i></div>
                    <h4>{{ trans('plugins/job-board::messages.candidate_profile_locked') }}</h4>
                    <p>{{ trans('plugins/job-board::messages.candidate_profile_view_limit_reached') }}</p>
                    @if(auth('account')->check())
                        <a href="{{ route('public.account.wallet') }}" class="cdt-btn-primary"><i class="ti ti-wallet"></i> {{ trans('plugins/job-board::messages.candidate_profile_upgrade_cta') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Invite to Apply modal (employer: select job, 25 credits per invite) --}}
@if(isset($account) && $account && $account->isEmployer() && ($employerJobs ?? collect())->isNotEmpty())
<div class="modal fade" id="cdtInviteToApplyModal" tabindex="-1" aria-labelledby="cdtInviteToApplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cdtInviteToApplyModalLabel">{{ __('Invite to Apply') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cdtInviteToApplyForm">
                @csrf
                <div class="modal-body">
                    <p class="small text-muted mb-3">{{ __('25 credits will be deducted. An email will be sent to the candidate.') }}</p>
                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                    <div class="mb-2">
                        <label for="cdt_invite_job_id" class="form-label">{{ __('Select Job') }} <span class="text-danger">*</span></label>
                        <select name="job_id" id="cdt_invite_job_id" class="form-select form-select-sm" required>
                            <option value="">{{ __('— Select job —') }}</option>
                            @foreach($employerJobs as $job)
                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="cdtInviteToApplySubmitBtn">{{ __('Send Invite') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Invite to Apply modal (employer: select job, 25 credits per invite) --}}
@if(isset($account) && $account && $account->isEmployer() && ($employerJobs ?? collect())->isNotEmpty())
<div class="modal fade" id="cdtInviteToApplyModal" tabindex="-1" aria-labelledby="cdtInviteToApplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cdtInviteToApplyModalLabel">{{ __('Invite to Apply') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cdtInviteToApplyForm">
                @csrf
                <div class="modal-body">
                    <p class="small text-muted mb-3">{{ __('25 credits will be deducted. An email will be sent to the candidate.') }}</p>
                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                    <div class="mb-2">
                        <label for="cdt_invite_job_id" class="form-label">{{ __('Select Job') }} <span class="text-danger">*</span></label>
                        <select name="job_id" id="cdt_invite_job_id" class="form-select form-select-sm" required>
                            <option value="">{{ __('— Select job —') }}</option>
                            @foreach($employerJobs as $job)
                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="cdtInviteToApplySubmitBtn">{{ __('Send Invite') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
(function() {
    var form = document.getElementById('cdtInviteToApplyForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('cdtInviteToApplySubmitBtn');
        if (btn) btn.disabled = true;
        var body = {
            job_id: parseInt(document.getElementById('cdt_invite_job_id').value, 10),
            candidate_id: parseInt(form.querySelector('input[name="candidate_id"]').value, 10)
        };
        fetch('{{ route('public.account.invite-candidate.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(body)
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var ok = data.error === false || (data.data && data.data.error === false);
            if (ok) {
                var modal = document.getElementById('cdtInviteToApplyModal');
                if (modal && typeof bootstrap !== 'undefined') {
                    var m = bootstrap.Modal.getInstance(modal);
                    if (m) m.hide();
                }
                alert(data.message || (data.data && data.data.message) || '{{ __('Invite sent.') }}');
                if (typeof window.location !== 'undefined') window.location.reload();
            } else {
                alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
            }
        })
        .catch(function() { alert('{{ __('Something went wrong.') }}'); })
        .finally(function() { if (btn) btn.disabled = false; });
    var form = document.getElementById('cdtInviteToApplyForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var btn = document.getElementById('cdtInviteToApplySubmitBtn');
        if (btn) btn.disabled = true;
        var body = {
            job_id: parseInt(document.getElementById('cdt_invite_job_id').value, 10),
            candidate_id: parseInt(form.querySelector('input[name="candidate_id"]').value, 10)
        };
        fetch('{{ route('public.account.invite-candidate.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]') ? document.querySelector('input[name="_token"]').value : '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(body)
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var ok = data.error === false || (data.data && data.data.error === false);
            if (ok) {
                var modal = document.getElementById('cdtInviteToApplyModal');
                if (modal && typeof bootstrap !== 'undefined') {
                    var m = bootstrap.Modal.getInstance(modal);
                    if (m) m.hide();
                }
                alert(data.message || (data.data && data.data.message) || '{{ __('Invite sent.') }}');
                if (typeof window.location !== 'undefined') window.location.reload();
            } else {
                alert(data.message || (data.data && data.data.message) || '{{ __('Request failed.') }}');
            }
        })
        .catch(function() { alert('{{ __('Something went wrong.') }}'); })
        .finally(function() { if (btn) btn.disabled = false; });
    });
})();
</script>
@endif

<script>
(function() {
    // Tabs removed in updated UI; keep script as a no-op for safety.
})();
</script>