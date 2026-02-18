@php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner careers-page');
@endphp

<style>
.careers-section {
    padding: 90px 0 50px;
    background: #ffffff;
    color: #1e293b;
}
.careers-section .container {
    max-width: 1200px;
    padding: 0 15px;
}

/* Hero Section */
.careers-hero {
    text-align: center;
    margin-bottom: 80px;
    padding: 60px 0;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 30px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.careers-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.5;
}
.careers-hero::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}
@keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(-20px, -20px) scale(1.1); }
}
.careers-hero-content {
    position: relative;
    z-index: 1;
}
.careers-hero h1 {
    font-size: 56px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
    line-height: 1.2;
}
.careers-hero p {
    font-size: 20px;
    opacity: 0.95;
    max-width: 700px;
    margin: 0 auto 35px;
    line-height: 1.7;
}
.hero-cta {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Why Join Us */
.why-join-section {
    margin-bottom: 80px;
}
.section-header {
    text-align: center;
    margin-bottom: 60px;
}
.section-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.section-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}
.value-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid #f1f5f9;
    position: relative;
    overflow: hidden;
}
.value-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 20px 20px 0 0;
    transform: scaleX(0);
    transition: transform 0.3s ease;
    z-index: 1;
}
.value-card::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 115, 209, 0.05) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.value-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 115, 209, 0.2);
    border-color: #0073d1;
}
.value-card:hover::before {
    transform: scaleX(1);
}
.value-card:hover::after {
    opacity: 1;
}
.value-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}
.value-card:hover .value-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 30px rgba(0, 115, 209, 0.4);
}
.value-card h3 {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
}
.value-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* Benefits Section */
.benefits-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 30px;
    padding: 80px 50px;
    margin-bottom: 80px;
}
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}
.benefit-item {
    background: #fff;
    border-radius: 16px;
    padding: 25px;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}
.benefit-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 115, 209, 0.15);
}
.benefit-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    transition: all 0.3s ease;
}
.benefit-item:hover .benefit-icon {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
}
.benefit-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}
.benefit-content p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Open Positions */
.open-positions-section {
    margin-bottom: 80px;
}
.positions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
}
.position-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid #f1f5f9;
    position: relative;
    overflow: hidden;
}
.position-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
    z-index: 1;
}
.position-card::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 115, 209, 0.05) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
}
.position-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 115, 209, 0.2);
    border-color: #0073d1;
}
.position-card:hover::before {
    transform: scaleX(1);
}
.position-card:hover::after {
    opacity: 1;
}
.position-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 20px;
}
.position-title {
    flex: 1;
}
.position-title h3 {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 8px;
}
.position-title .position-type {
    display: inline-block;
    padding: 4px 12px;
    background: #f0f7ff;
    color: #0073d1;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 10px;
}
.position-badge {
    padding: 6px 14px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.position-details {
    margin-bottom: 25px;
}
.position-detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    color: #64748b;
    font-size: 15px;
}
.position-detail-item i {
    color: #0073d1;
    font-size: 18px;
}
.position-description {
    color: #64748b;
    line-height: 1.7;
    margin-bottom: 25px;
    font-size: 15px;
}
.position-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}
.position-salary {
    font-size: 18px;
    font-weight: 600;
    color: #1e293b;
}

/* Culture Section */
.culture-section {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: 30px;
    padding: 80px 50px;
    margin-bottom: 80px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.culture-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(0, 115, 209, 0.1) 0%, transparent 70%);
    border-radius: 50%;
}
.culture-content {
    position: relative;
    z-index: 1;
}
.culture-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 50px;
}
.culture-item {
    text-align: center;
}
.culture-item i {
    font-size: 48px;
    color: #0073d1;
    margin-bottom: 20px;
    display: block;
}
.culture-item h3 {
    font-size: 24px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 15px;
}
.culture-item p {
    font-size: 16px;
    opacity: 0.9;
    line-height: 1.7;
    margin: 0;
}

/* Application Process */
.process-section {
    margin-bottom: 80px;
}
.process-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}
.process-step {
    text-align: center;
    position: relative;
}
.process-step::after {
    content: '→';
    position: absolute;
    right: -20px;
    top: 40px;
    font-size: 32px;
    color: #0073d1;
    font-weight: 300;
}
.process-step:last-child::after {
    display: none;
}
.step-circle {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
    transition: all 0.3s ease;
}
.process-step:hover .step-circle {
    transform: scale(1.1);
    box-shadow: 0 12px 30px rgba(0, 115, 209, 0.4);
}
.process-step h3 {
    font-size: 20px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 12px;
}
.process-step p {
    font-size: 15px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* CTA Section */
.careers-cta {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    border-radius: 30px;
    padding: 60px 50px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.careers-cta::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}
.careers-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}
.careers-cta-content {
    position: relative;
    z-index: 1;
}
.careers-cta h2 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
}
.careers-cta p {
    font-size: 20px;
    opacity: 0.95;
    margin-bottom: 35px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Buttons */
.btn-primary-custom {
    display: inline-block;
    padding: 16px 40px;
    background: #fff;
    color: #0073d1;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
}
.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(255, 255, 255, 0.3);
    background: #f8fafc;
    color: black;
}
.btn-outline-custom {
    display: inline-block;
    padding: 16px 40px;
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-outline-custom:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    transform: translateY(-2px);
}
.btn-apply {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 50%, #004a94 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}
.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
    color: #fff;
}

/* Responsive */
@media(max-width: 992px) {
    .process-step::after {
        display: none;
    }
    .positions-grid {
        grid-template-columns: 1fr;
    }
}
@media(max-width: 768px) {
    .careers-section { padding: 70px 0 40px; }
    .careers-hero { padding: 40px 30px; }
    .careers-hero h1 { font-size: 36px; }
    .careers-hero p { font-size: 18px; }
    .section-header h2 { font-size: 32px; }
    .values-grid { grid-template-columns: 1fr; gap: 20px; }
    .value-card { padding: 30px 25px; }
    .benefits-section { padding: 50px 30px; }
    .benefits-grid { grid-template-columns: 1fr; gap: 20px; }
    .culture-section { padding: 50px 30px; }
    .culture-grid { grid-template-columns: 1fr; gap: 30px; }
    .process-steps { grid-template-columns: 1fr; gap: 30px; }
    .careers-cta { padding: 40px 30px; }
    .careers-cta h2 { font-size: 32px; }
    .cta-buttons { flex-direction: column; }
    .btn-primary-custom, .btn-outline-custom { width: 100%; }
    .position-footer { flex-direction: column; align-items: flex-start; }
    .btn-apply { width: 100%; }
}
</style>

<section class="careers-section">
    <div class="container">
        <!-- Hero Section -->
        <div class="careers-hero">
            <div class="careers-hero-content">
                <h1>Join Our Mission to Transform Education</h1>
                <p>
                    Be part of India's leading education recruitment platform. Help us connect passionate teachers 
                    with the right schools and shape the future of education across the country.
                </p>
                <div class="hero-cta">
                    <a href="#open-positions" class="btn-primary-custom">View Open Positions</a>
                    <a href="/contact" class="btn-outline-custom">Get in Touch</a>
                </div>
            </div>
        </div>

        <!-- Why Join Us -->
        <div class="why-join-section">
            <div class="section-header">
                <h2>Why Join Teachers Recruiter?</h2>
                <p>We're building the future of education recruitment in India</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-target"></i>
                    </div>
                    <h3>Meaningful Impact</h3>
                    <p>Make a real difference by connecting teachers with schools and helping shape the future of education in India.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-trending-up"></i>
                    </div>
                    <h3>Growth Opportunities</h3>
                    <p>Join a fast-growing company with ample opportunities for career advancement and professional development.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-users"></i>
                    </div>
                    <h3>Collaborative Culture</h3>
                    <p>Work with a passionate team that values collaboration, innovation, and continuous learning.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-zap"></i>
                    </div>
                    <h3>Innovation Focus</h3>
                    <p>Be part of a team that's constantly innovating and improving the recruitment experience for teachers and schools.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-globe"></i>
                    </div>
                    <h3>Pan-India Reach</h3>
                    <p>Work on projects that impact thousands of schools and teachers across all 28 states of India.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="feather-award"></i>
                    </div>
                    <h3>Recognition & Rewards</h3>
                    <p>Your contributions are recognized and rewarded. We celebrate achievements and support your career growth.</p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="benefits-section">
            <div class="section-header">
                <h2>Benefits & Perks</h2>
                <p>We take care of our team with comprehensive benefits</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-dollar-sign"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Competitive Salary</h4>
                        <p>Attractive compensation packages that reflect your skills and experience</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-heart"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Health Insurance</h4>
                        <p>Comprehensive health insurance coverage for you and your family</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-calendar"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Flexible Work Hours</h4>
                        <p>Work-life balance with flexible scheduling options</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-book"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Learning & Development</h4>
                        <p>Access to training programs, workshops, and skill development opportunities</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-home"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Remote Work Options</h4>
                        <p>Work from home or hybrid work arrangements available for eligible positions</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-gift"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Performance Bonuses</h4>
                        <p>Reward and recognition programs for outstanding performance</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-coffee"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Team Events</h4>
                        <p>Regular team building activities, celebrations, and company outings</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-smartphone"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Modern Tools</h4>
                        <p>Access to the latest technology and tools to help you do your best work</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open Positions -->
        <div class="open-positions-section" id="open-positions">
            <div class="section-header">
                <h2>Open Positions</h2>
                <p>Explore current job opportunities at Teachers Recruiter</p>
            </div>
            <div class="positions-grid">
                <div class="position-card">
                    <div class="position-header">
                        <div class="position-title">
                            <span class="position-type">Full-time</span>
                            <h3>Senior Software Developer</h3>
                        </div>
                        <span class="position-badge">Hiring</span>
                    </div>
                    <div class="position-details">
                        <div class="position-detail-item">
                            <i class="feather-map-pin"></i>
                            <span>Remote / Mumbai, India</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-briefcase"></i>
                            <span>3-5 years experience</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-clock"></i>
                            <span>Full-time</span>
                        </div>
                    </div>
                    <p class="position-description">
                        We're looking for an experienced software developer to join our tech team. You'll work on building 
                        and improving our recruitment platform using modern technologies.
                    </p>
                    <div class="position-footer">
                        <span class="position-salary">Competitive</span>
                        <a href="/contact" class="btn-apply">Apply Now</a>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-header">
                        <div class="position-title">
                            <span class="position-type">Full-time</span>
                            <h3>Recruitment Specialist</h3>
                        </div>
                        <span class="position-badge">Hiring</span>
                    </div>
                    <div class="position-details">
                        <div class="position-detail-item">
                            <i class="feather-map-pin"></i>
                            <span>Delhi, India</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-briefcase"></i>
                            <span>2-4 years experience</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-clock"></i>
                            <span>Full-time</span>
                        </div>
                    </div>
                    <p class="position-description">
                        Join our recruitment team to help connect teachers with schools. You'll work directly with 
                        educational institutions and candidates to facilitate successful placements.
                    </p>
                    <div class="position-footer">
                        <span class="position-salary">Competitive</span>
                        <a href="/contact" class="btn-apply">Apply Now</a>
                    </div>
                </div>

                <div class="position-card">
                    <div class="position-header">
                        <div class="position-title">
                            <span class="position-type">Full-time</span>
                            <h3>Marketing Manager</h3>
                        </div>
                        <span class="position-badge">Hiring</span>
                    </div>
                    <div class="position-details">
                        <div class="position-detail-item">
                            <i class="feather-map-pin"></i>
                            <span>Bangalore, India</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-briefcase"></i>
                            <span>4-6 years experience</span>
                        </div>
                        <div class="position-detail-item">
                            <i class="feather-clock"></i>
                            <span>Full-time</span>
                        </div>
                    </div>
                    <p class="position-description">
                        Lead our marketing efforts to grow our community of teachers and schools. You'll develop and 
                        execute marketing strategies across digital channels.
                    </p>
                    <div class="position-footer">
                        <span class="position-salary">Competitive</span>
                        <a href="/contact" class="btn-apply">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Culture Section -->
        <div class="culture-section">
            <div class="culture-content">
                <div class="section-header" style="color: #fff;">
                    <h2 style="color: #fff;">Our Culture</h2>
                    <p style="color: rgba(255,255,255,0.9);">What makes Teachers Recruiter a great place to work</p>
                </div>
                <div class="culture-grid">
                    <div class="culture-item">
                        <i class="feather-heart"></i>
                        <h3>Passion for Education</h3>
                        <p>We're driven by our mission to improve education in India by connecting the right people with the right opportunities.</p>
                    </div>
                    <div class="culture-item">
                        <i class="feather-lightbulb"></i>
                        <h3>Innovation First</h3>
                        <p>We encourage creative thinking and embrace new ideas that can improve our platform and services.</p>
                    </div>
                    <div class="culture-item">
                        <i class="feather-users"></i>
                        <h3>Team Collaboration</h3>
                        <p>We believe in working together, sharing knowledge, and supporting each other to achieve common goals.</p>
                    </div>
                    <div class="culture-item">
                        <i class="feather-check-circle"></i>
                        <h3>Excellence</h3>
                        <p>We strive for excellence in everything we do, from product development to customer service.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Process -->
        <div class="process-section">
            <div class="section-header">
                <h2>Application Process</h2>
                <p>Simple and straightforward—here's how it works</p>
            </div>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-circle">1</div>
                    <h3>Apply Online</h3>
                    <p>Submit your application through our contact form or email us your resume and cover letter.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle">2</div>
                    <h3>Initial Review</h3>
                    <p>Our team reviews your application and qualifications to ensure a good fit for the role.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle">3</div>
                    <h3>Interview</h3>
                    <p>If selected, you'll be invited for an interview to discuss your experience and learn more about the role.</p>
                </div>
                <div class="process-step">
                    <div class="step-circle">4</div>
                    <h3>Join Our Team</h3>
                    <p>Successful candidates receive an offer and join our team to start making an impact!</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="careers-cta">
            <div class="careers-cta-content">
                <h2>Ready to Join Our Team?</h2>
                <p>If you don't see a position that matches your skills, we'd still love to hear from you. Send us your resume and we'll keep you in mind for future opportunities.</p>
                <div class="cta-buttons">
                    <a href="/contact" class="btn-primary-custom">Contact Us</a>
                    <a href="#open-positions" class="btn-outline-custom">View All Positions</a>
                </div>
            </div>
        </div>
    </div>
</section>
