@php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner start-hiring-page');
@endphp

<style>
.start-hiring-section {
    padding: 90px 0 50px;
    background: #f8fafc;
    color: #1e293b;
    overflow-x: hidden;
}
.start-hiring-section .container {
    max-width: 1200px;
    padding: 0 15px;
}
.hiring-hero-subtitle {
    font-size: 1.35rem;
    font-weight: 600;
    color: #334155;
    margin: 0 0 16px;
    line-height: 1.4;
}
.hiring-section-intro {
    text-align: center;
    margin-bottom: 40px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
.hiring-section-intro h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}
.hiring-section-intro p {
    font-size: 18px;
    color: #64748b;
    margin: 0;
}
.hiring-easy-job-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px 30px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border-left: 4px solid #0073d1;
}
.hiring-easy-job-card h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.hiring-easy-job-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}
/* Trusted — checklist */
.hiring-trusted {
    background: #fff;
    border-radius: 30px;
    padding: 50px 45px;
    margin-bottom: 80px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}
.hiring-trusted-header {
    text-align: center;
    margin-bottom: 28px;
}
.hiring-trusted-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.hiring-trusted-header p {
    font-size: 18px;
    color: #64748b;
    margin: 0;
}
.hiring-trusted-checklist {
    list-style: none;
    padding: 0;
    margin: 0;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}
.hiring-trusted-checklist li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    font-size: 17px;
    color: #334155;
    font-weight: 500;
    border-bottom: 1px solid #f1f5f9;
}
.hiring-trusted-checklist li:last-child {
    border-bottom: none;
}
.hiring-trusted-checklist li .check {
    color: #16a34a;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 2px;
}
/* Testimonials placeholder */
.hiring-testimonials {
    background: #fff;
    border-radius: 24px;
    padding: 48px 40px;
    margin-bottom: 48px;
    border: 1px dashed #cbd5e1;
    text-align: center;
}
.hiring-testimonials h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}
.hiring-testimonials p {
    color: #64748b;
    margin: 0;
    font-size: 16px;
}
/* Final conversion strip */
.hiring-final {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border-radius: 20px;
    padding: 36px 28px;
    margin-bottom: 48px;
    text-align: center;
    border: 1px solid #bae6fd;
}
.hiring-final p {
    font-size: 18px;
    color: #0c4a6e;
    line-height: 1.65;
    margin: 0 0 10px;
    font-weight: 500;
}
.hiring-final p:last-child {
    margin-bottom: 0;
    font-weight: 600;
}
.cta-buttons-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    justify-content: flex-start;
}
.cta-content .cta-buttons-row .btn-outline-custom {
    background: transparent;
    color: #fff;
    border-color: rgba(255, 255, 255, 0.9);
    box-shadow: none;
}
.cta-content .cta-buttons-row .btn-outline-custom:hover {
    background: #fff;
    color: #0073d1;
    border-color: #fff;
}

/* Hero Section - Left Aligned with Image Placeholder */
.hiring-hero {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 80px;
    padding: 0px 0;
}
.hiring-hero-content {
    text-align: left;
}
.hiring-hero .hero-badge {
    display: inline-block;
    padding: 8px 20px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.hiring-hero h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1e293b;
    line-height: 1.2;
}
.hiring-hero p {
    font-size: 18px;
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 30px;
}
.hiring-hero-image {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.hiring-hero-image::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}
@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.8; }
}
.hiring-hero-image h3 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}
.hiring-hero-image p {
    font-size: 18px;
    opacity: 0.95;
    position: relative;
    z-index: 1;
}
.hero-cta {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

/* Features - Horizontal Cards */
.hiring-features {
    margin-bottom: 80px;
}
.hiring-features-header {
    text-align: center;
    margin-bottom: 50px;
}
.hiring-features-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.hiring-features-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.hiring-feature-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 30px;
    border-left: 4px solid transparent;
}
.hiring-feature-card:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 30px rgba(0, 115, 209, 0.12);
    border-left-color: #0073d1;
}
.hiring-feature-icon {
    width: 80px;
    height: 80px;
    min-width: 80px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
}
.hiring-feature-content {
    flex: 1;
}
.hiring-feature-card h3 {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.hiring-feature-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}
.hiring-feature-card ul.hiring-feature-list {
    list-style: disc;
    padding-left: 1.35rem;
    margin: 10px 0 0;
    list-style-position: outside;
}
.hiring-feature-card ul.hiring-feature-list li {
    font-size: 15px;
    color: #64748b;
    text-align: left;
    line-height: 1.55;
    margin-bottom: 6px;
    padding-left: 4px;
}
.hiring-feature-card ul.hiring-feature-list li:last-child {
    margin-bottom: 0;
}
@media (max-width: 768px) {
    .hiring-feature-card {
        flex-direction: column;
        align-items: stretch;
        text-align: left;
    }
    .hiring-feature-icon {
        margin-bottom: 14px;
        width: 64px;
        height: 64px;
        min-width: 64px;
        font-size: 28px;
    }
    .hiring-feature-content {
        text-align: left;
        width: 100%;
        min-width: 0;
    }
    .hiring-feature-card h3 {
        font-size: 20px;
    }
    .hiring-feature-card ul.hiring-feature-list {
        padding-left: 1.25rem;
        margin-top: 8px;
    }
    .hiring-feature-card ul.hiring-feature-list li {
        font-size: 14px;
    }
    .hiring-section-intro h2 {
        font-size: 26px;
    }
    .hiring-trusted {
        padding: 32px 18px;
    }
    .hiring-trusted-header h2 {
        font-size: 24px;
    }
    .hiring-hero-subtitle {
        font-size: 1.1rem;
    }
}
/* Benefits - Two Column Layout */
.hiring-benefits {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 30px;
    padding: 60px 50px;
    margin-bottom: 80px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.hiring-benefits::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}
.hiring-benefits-header {
    text-align: center;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}
.hiring-benefits-header h2 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #fff;
}
.hiring-benefits-header p {
    font-size: 18px;
    opacity: 0.95;
    max-width: 600px;
    margin: 0 auto;
}
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    position: relative;
    z-index: 1;
}
.benefit-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}
.benefit-item:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-5px);
}
.benefit-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    margin-bottom: 15px;
}
.benefit-content h4 {
    font-size: 20px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
}
.benefit-content p {
    font-size: 15px;
    opacity: 0.9;
    line-height: 1.7;
    margin: 0;
    color: #fff;
}

/* How It Works - Vertical Timeline Style */
.how-it-works-section {
    margin-bottom: 80px;
}
.how-it-works-header {
    text-align: center;
    margin-bottom: 60px;
}
.how-it-works-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.how-it-works-header p {
    font-size: 18px;
    color: #64748b;
}
.steps-container {
    position: relative;
    max-width: 900px;
    margin: 0 auto;
}
.steps-container::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #0073d1 0%, #005bb5 100%);
    transform: translateX(-50%);
    z-index: 0;
}
.step-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 30px;
}
.step-card:nth-child(odd) {
    margin-right: 50%;
    padding-right: 80px;
}
.step-card:nth-child(even) {
    margin-left: 50%;
    padding-left: 80px;
    flex-direction: row-reverse;
}
.step-number {
    width: 70px;
    height: 70px;
    min-width: 70px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}
.step-card:nth-child(odd) .step-number {
    right: -35px;
    left: auto;
    transform: none;
}
.step-card:nth-child(even) .step-number {
    left: -35px;
    right: auto;
    transform: none;
}
.step-content {
    flex: 1;
}
.step-card h3 {
    font-size: 26px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 12px;
}
.step-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* Stats Section - Card Style */
.hiring-stats {
    background: #fff;
    border-radius: 30px;
    padding: 60px 50px;
    margin-bottom: 80px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}
.hiring-stats-header {
    text-align: center;
    margin-bottom: 50px;
}
.hiring-stats-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.hiring-stats-header p {
    font-size: 18px;
    color: #64748b;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.stat-item {
    text-align: center;
    padding: 20px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}
.stat-item:hover {
    border-color: #0073d1;
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 115, 209, 0.15);
}
.stat-number {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: block;
}
.stat-label {
    font-size: 16px;
    color: #64748b;
    font-weight: 500;
}

/* CTA Section - Split Design */
.hiring-cta {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: 30px;
    padding: 0;
    margin-top: 40px;
    margin-bottom: 80px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}
.cta-content {
    padding: 60px 50px;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.cta-content h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
}
.cta-content p {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 35px;
    line-height: 1.7;
}
.cta-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}
.cta-visual {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
    position: relative;
    overflow: hidden;
}
.cta-visual::before {
    content: '';
    position: absolute;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}
@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.cta-visual-content {
    text-align: center;
    position: relative;
    z-index: 1;
}
.cta-visual-content i {
    font-size: 80px;
    color: #fff;
    opacity: 0.9;
    margin-bottom: 20px;
}
.cta-visual-content h3 {
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    margin: 0;
}

/* Buttons */
.btn-primary-custom {
    display: inline-block;
    padding: 16px 40px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
}
.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0, 115, 209, 0.4);
    color: #fff;
}
.btn-outline-custom {
    display: inline-block;
    padding: 16px 40px;
    background: #fff;
    color: #0073d1;
    border: 2px solid #0073d1;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 115, 209, 0.2);
}
.btn-outline-custom:hover {
    background: #0073d1;
    color: #fff;
    border-color: #0073d1;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 115, 209, 0.3);
}

/* Responsive */
@media(max-width: 992px) {
    .hiring-hero {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .hiring-hero-content {
        text-align: center;
    }
    .hero-cta {
        justify-content: center;
    }
    .steps-container::before {
        display: none;
    }
    .step-card {
        margin-left: 0 !important;
        margin-right: 0 !important;
        padding: 30px !important;
    }
    .step-card:nth-child(even) {
        flex-direction: column;
    }
    .step-card {
        flex-direction: column;
        align-items: flex-start;
    }
    .step-number {
        position: static !important;
        transform: none !important;
        margin-bottom: 20px;
    }
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .hiring-cta {
        grid-template-columns: 1fr;
        margin-bottom: 40px;
       margin-top: 40px;
    }
    .cta-visual {
        padding: 40px 30px;
    }
}
@media(max-width: 768px) {
    .start-hiring-section { padding: 60px 0 40px; }
    .hiring-hero { gap: 30px; margin-bottom: 50px; padding: 0px 0; }
    .hiring-hero h1 { font-size: 24px; line-height: 1.3; }
    .hiring-hero p { font-size: 15px; }
    .hiring-features-header h2 { font-size: 26px; }
    .hiring-benefits { padding: 40px 30px;margin-bottom: 40px; }
    .hiring-benefits-header h2 { font-size: 32px; }
    .how-it-works-header h2 { font-size: 32px; }
    .step-card { padding: 25px 20px !important; }
    .step-card h3 { font-size: 22px; }
    .hiring-stats { padding: 40px 30px; }
    .hiring-stats-header h2 { font-size: 32px; }
    .stats-grid { grid-template-columns: 1fr; gap: 20px; }
    .stat-number { font-size: 36px; }
    .cta-content { padding: 40px 30px; }
    .cta-content h2 { font-size: 28px; }
    .cta-buttons { flex-direction: column; }
    .cta-content .cta-buttons-row .btn-primary-custom,
    .cta-content .cta-buttons-row .btn-outline-custom { width: 100%; text-align: center; justify-content: center; }
    .cta-content .cta-buttons-row { justify-content: stretch; }
    .btn-primary-custom, .btn-outline-custom { width: 100%; }
}

/* ===== Testimonials (style-3) overrides — ONLY Start Hiring page ===== */
body.start-hiring-page .twm-testimonial-v-area {
    padding-top: 24px !important;
    padding-bottom: 24px !important;
    margin-bottom: 80px !important;
    border-radius: 16px !important;
}
body.start-hiring-page .twm-testimonial-v-area .container {
    max-width: 1200px !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
}
body.start-hiring-page .twm-testimonial-v-area .section-head h2 {
    font-size: 34px;
    line-height: 1.2;
}
body.start-hiring-page .twm-testimonial-v-area .testimonials-v {
    border-radius: 16px;
}
body.start-hiring-page .twm-testimonial-v-area .t-discription {
    -webkit-line-clamp: 5;
}
@media (max-width: 768px) {
    body.start-hiring-page .twm-testimonial-v-area {
        padding-top: 18px !important;
        padding-bottom: 18px !important;
        margin-bottom: 40px !important;
    }
    body.start-hiring-page .twm-testimonial-v-area .container {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }
    body.start-hiring-page .twm-testimonial-v-area .section-head h2 {
        font-size: 24px;
    }
    body.start-hiring-page .twm-testimonial-v-area .testimonials-v {
        padding: 18px 14px;
        min-height: auto;
    }
    body.start-hiring-page .twm-testimonial-v-area .twm-testi-media {
        width: 64px;
        height: 64px;
        margin-bottom: 12px;
    }
    body.start-hiring-page .twm-testimonial-v-area .t-discription {
        font-size: 14px;
        line-height: 1.55;
        -webkit-line-clamp: 6;
        margin-bottom: 14px;
    }
    body.start-hiring-page .twm-testimonial-v-area .v-testimonial-slider .swiper-pagination {
        margin-top: 1.25rem !important;
    }
}
</style>

<section class="start-hiring-section">
    <div class="container">
        {{-- Start Hiring Top Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $topAds = render_page_ads('start-hiring', 'top'); @endphp
            @if (!empty($topAds))
                <div class="start-hiring-ads-top" style="margin: 20px 0;">
                    {!! $topAds !!}
                </div>
            @endif
        @endif

        <!-- Hero Section -->
        <div class="hiring-hero">
            <div class="hiring-hero-content">
                <span class="hero-badge">{{ __('Start Hiring Today') }}</span>
                <h1>{{ __('Find the Best Teachers for Your Institution') }}</h1>
                <p class="hiring-hero-subtitle">{{ __("India's dedicated hiring platform for Schools & Educational Institutions") }}</p>
                <p>
                    {{ __("Access 50,000+ verified educators and streamline your recruitment process with powerful hiring tools. Post jobs, connect with qualified teachers, and build your dream team of educators—all through India's most trusted education recruitment platform.") }}
                </p>
                <div class="hero-cta">
                    <a href="{{ route('public.account.register.employer') }}" class="btn-primary-custom">{{ __('Register Your School') }}</a>
                    <a href="{{ url('/contact') }}" class="btn-outline-custom">{{ __('Schedule a Demo') }}</a>
                </div>
            </div>
            <div class="hiring-hero-image">
                <h3 style="color: #fff;">{{ __('Join 2,000+ Schools') }}</h3>
                <p style="color: #fff;">{{ __('Start hiring quality teachers today and transform your institution\'s teaching team.') }}</p>
            </div>
        </div>

        <!-- Trusted -->
        <div class="hiring-stats">
            <div class="hiring-stats-header">
                <h2>Trusted by Thousands of Schools Nationwide</h2>
                <p>Join India's leading education recruitment platform</p>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">2015</span>
                    <span class="stat-label">Working Since</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2000+</span>
                    <span class="stat-label">Verified Educators</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Schools & Institutions</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1M+</span>
                    <span class="stat-label">Social Media Reach</span>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="how-it-works-section">
            <div class="how-it-works-header">
                <h2>{{ __('How to Start Hiring') }}</h2>
                <p>{{ __('Get started in four simple steps') }}</p>
            </div>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>{{ __('Create Your Account') }}</h3>
                        <p>{{ __('Register your school or institution. Set up your profile with all necessary details in just a few minutes.') }}</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>{{ __('Post Your First Job') }}</h3>
                        <p>{{ __('Create detailed job postings with requirements, salary, location, and other specifications. Our system makes it easy.') }}</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>{{ __('Review & Shortlist') }}</h3>
                        <p>{{ __('Receive applications from qualified teachers. Review profiles, resumes, and qualifications to find the best candidates.') }}</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>{{ __('Hire the Best Teachers') }}</h3>
                        <p>{{ __('Connect with shortlisted candidates, conduct interviews, and hire the perfect teachers for your institution!') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Everything You Need -->
        <div class="hiring-features">
            <div class="hiring-section-intro">
                <h2>{{ __('Everything You Need to Start Hiring') }}</h2>
                <p>{{ __('Powerful recruitment tools designed for educational institutions') }}</p>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                 <i class="feather-briefcase"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Easy Job Posting with Smart Screening') }}</h3>
                    <p>{{ __('Post jobs in minutes and add custom screening questions to filter the right candidates.') }}</p>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-bell"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Instant Application Alerts') }}</h3>
                    <p>{{ __('Receive real-time Email & WhatsApp notifications for every application.') }}</p>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-briefcase"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Resume Database Access') }}</h3>
                    <p>{{ __('Search and connect with candidates using filters like:') }}</p>
                    <ul class="hiring-feature-list">
                        <li>{{ __('Subject') }}</li>
                        <li>{{ __('Experience') }}</li>
                        <li>{{ __('Location') }}</li>
                        <li>{{ __('Qualification') }}</li>
                    </ul>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-clipboard"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Application Management System') }}</h3>
                    <p>{{ __('Manage, shortlist, and track all applications from one dashboard.') }}</p>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-message-circle"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Direct Candidate Connection') }}</h3>
                    <p>{{ __('Communicate directly with educators—no middlemen involved.') }}</p>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-calendar"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Advertise Walk-in Drives') }}</h3>
                    <p>{{ __('Boost hiring visibility with:') }}</p>
                    <ul class="hiring-feature-list">
                        <li>{{ __('Walk-in Drive Listings') }}</li>
                        <li>{{ __('Homepage Banners') }}</li>
                        <li>{{ __('Featured Jobs') }}</li>
                    </ul>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-headphones"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Job Posting Assistance') }}</h3>
                    <p>{{ __('We help you create high-performing job listings.') }}</p>
                </div>
            </div>

            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-user-check"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Dedicated Recruiter') }}</h3>
                    <p>{{ __('Get expert support to close positions faster.') }}</p>
                </div>
            </div>
            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-tag"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('School Branding & Promotion') }}</h3>
                    <p>{{ __('Showcase your institution with a featured profile and attract better candidates.') }}</p>
                </div>
            </div>
            <div class="hiring-feature-card">
                <div class="hiring-feature-icon">
                    <i class="feather-check-circle"></i>
                </div>
                <div class="hiring-feature-content">
                    <h3>{{ __('Verified Candidate Profiles Only') }}</h3>
                    <p>{{ __('Access only genuine and relevant educator profiles.') }}</p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="hiring-benefits">
            <div class="hiring-benefits-header">
                <h2>Why Start Hiring with Us?</h2>
                <p>We make teacher recruitment simple, fast, and effective</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-clock"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Save Time & Resources</h4>
                        <p>Reduce hiring time with our streamlined recruitment process and access to pre-screened candidates</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-dollar-sign"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Affordable Packages</h4>
                        <p>Competitive pricing plans designed for schools of all sizes, from small institutions to large educational groups</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-target"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Targeted Reach</h4>
                        <p>Your job postings reach qualified teachers actively looking for opportunities in your location and subject area</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-bar-chart"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Analytics & Insights</h4>
                        <p>Track job performance, view application statistics, and gain insights to improve your hiring strategy</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-globe"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Pan-India Coverage</h4>
                        <p>Access teachers from all 28 states across India. Find candidates willing to relocate or local talent</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-check-circle"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Quality Assurance</h4>
                        <p>All teacher profiles are verified. We ensure you connect with genuine, qualified educators</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schools Testimonials (dynamic from Admin) -->
        @if (function_exists('do_shortcode') && is_plugin_active('testimonial'))
            {!! do_shortcode('[testimonials style="style-3" subtitle="What people are saying:" limit="6"]') !!}
        @endif

        <!-- CTA Section -->
        <div class="hiring-cta">
            <div class="cta-content">
                <h2>{{ __('Start Hiring the Right Talent Today') }}</h2>
                <p>{{ __('Register your school, explore plans, or book a walkthrough with our team.') }}</p>
                <div class="cta-buttons cta-buttons-row">
                    <a href="{{ route('public.account.register.employer') }}" class="btn-primary-custom">{{ __('Register Your School') }}</a>
                    <a href="{{ route('public.premium-service') }}" class="btn-outline-custom">{{ __('View Pricing Plans') }}</a>
                    <a href="{{ url('/contact') }}" class="btn-outline-custom">{{ __('Schedule a Demo') }}</a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-visual-content">
                    <i class="feather-briefcase"></i>
                    <h3>{{ __('Start Hiring Today') }}</h3>
                </div>
            </div>
        </div>

        <!-- Final conversion -->
        <div class="hiring-final">
            <p>{{ __('Stop wasting time on irrelevant applications.') }}</p>
            <p>{{ __('Hire verified educators faster with Teachers Recruiter.') }}</p>
            <p>{{ __('Join 2,000+ schools already hiring with us.') }}</p>
        </div>

        {{-- Start Hiring Bottom Ads --}}
        @if (is_plugin_active('ads') && function_exists('render_page_ads'))
            @php $bottomAds = render_page_ads('start-hiring', 'bottom'); @endphp
            @if (!empty($bottomAds))
                <div class="start-hiring-ads-bottom" style="margin: 30px 0;">
                    {!! $bottomAds !!}
                </div>
            @endif
        @endif
    </div>
</section>
