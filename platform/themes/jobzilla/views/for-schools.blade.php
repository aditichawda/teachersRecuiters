@php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner for-schools-page');
@endphp

<style>
.for-schools-section {
    padding: 90px 0 50px;
    background: #f8fafc;
    color: #1e293b;
}
.for-schools-section .container {
    max-width: 1200px;
    padding: 0 15px;
}

/* Hero Section - Left Aligned with Image Placeholder */
.schools-hero {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 80px;
    padding: 40px 0;
}
.schools-hero-content {
    text-align: left;
}
.schools-hero .hero-badge {
    display: inline-block;
    padding: 8px 20px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.schools-hero h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1e293b;
    line-height: 1.2;
}
.schools-hero p {
    font-size: 18px;
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 30px;
}
.schools-hero-image {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.schools-hero-image::before {
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
.schools-hero-image h3 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}
.schools-hero-image p {
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
.schools-features {
    margin-bottom: 80px;
}
.schools-features-header {
    text-align: center;
    margin-bottom: 50px;
}
.schools-features-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.schools-features-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.schools-feature-card {
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
.schools-feature-card:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 30px rgba(0, 115, 209, 0.12);
    border-left-color: #10b981;
}
.schools-feature-icon {
    width: 80px;
    height: 80px;
    min-width: 80px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}
.schools-feature-content {
    flex: 1;
}
.schools-feature-card h3 {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
}
.schools-feature-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* Benefits - Two Column Layout */
.schools-benefits {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 30px;
    padding: 60px 50px;
    margin-bottom: 80px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.schools-benefits::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.3;
}
.schools-benefits-header {
    text-align: center;
    margin-bottom: 50px;
    position: relative;
    z-index: 1;
}
.schools-benefits-header h2 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #fff;
}
.schools-benefits-header p {
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
    background: linear-gradient(180deg, #0073d1 0%, #10b981 100%);
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
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
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
.schools-stats {
    background: #fff;
    border-radius: 30px;
    padding: 60px 50px;
    margin-bottom: 80px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}
.schools-stats-header {
    text-align: center;
    margin-bottom: 50px;
}
.schools-stats-header h2 {
    font-size: 42px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.schools-stats-header p {
    font-size: 18px;
    color: #64748b;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}
.stat-item {
    text-align: center;
    padding: 30px 20px;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}
.stat-item:hover {
    border-color: #10b981;
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.15);
}
.stat-number {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(135deg, #0073d1 0%, #10b981 100%);
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
.schools-cta {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    border-radius: 30px;
    padding: 0;
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
    background: linear-gradient(135deg, #0073d1 0%, #10b981 100%);
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
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
}
.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
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
    .schools-hero {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .schools-hero-content {
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
        flex-direction: row;
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
    .schools-cta {
        grid-template-columns: 1fr;
    }
    .cta-visual {
        padding: 40px 30px;
    }
}
@media(max-width: 768px) {
    .for-schools-section { padding: 70px 0 40px; }
    .schools-hero h1 { font-size: 32px; }
    .schools-hero p { font-size: 16px; }
    .schools-features-header h2 { font-size: 32px; }
    .schools-feature-card {
        flex-direction: column;
        text-align: center;
        padding: 25px 20px;
    }
    .schools-benefits { padding: 40px 30px; }
    .schools-benefits-header h2 { font-size: 32px; }
    .how-it-works-header h2 { font-size: 32px; }
    .step-card { padding: 25px 20px !important; }
    .step-card h3 { font-size: 22px; }
    .schools-stats { padding: 40px 30px; }
    .schools-stats-header h2 { font-size: 32px; }
    .stats-grid { grid-template-columns: 1fr; gap: 20px; }
    .stat-number { font-size: 36px; }
    .cta-content { padding: 40px 30px; }
    .cta-content h2 { font-size: 28px; }
    .cta-buttons { flex-direction: column; }
    .btn-primary-custom, .btn-outline-custom { width: 100%; }
}
</style>

<section class="for-schools-section">
    <div class="container">
        <!-- Hero Section -->
        <div class="schools-hero">
            <div class="schools-hero-content">
                <span class="hero-badge">For Schools & Institutions</span>
                <h1>Hire Quality Teachers Faster</h1>
                <p>
                    Connect with 50,000+ qualified teachers across India. Post jobs, search resumes, and hire the perfect 
                    educators for your institution—all through one trusted platform designed specifically for the education sector.
                </p>
                <div class="hero-cta">
                    <a href="{{ route('public.account.register') }}" class="btn-primary-custom">Register Your School</a>
                    <a href="{{ JobBoardHelper::getJobcompaniesPageURL() }}" class="btn-outline-custom">View Schools</a>
                </div>
            </div>
            <div class="schools-hero-image">
                <h3 style="color: #fff;">5,000+ Schools Trust Us</h3>
                <p style="color: #fff;">Join India's leading education recruitment platform and find the best teachers for your institution</p>
            </div>
        </div>

        <!-- Key Features -->
        <div class="schools-features">
            <div class="schools-features-header">
                <h2>Everything You Need to Hire Great Teachers</h2>
                <p>Powerful tools and features designed for educational institutions</p>
            </div>
            
            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-users"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Access 50,000+ Teacher Profiles</h3>
                    <p>Browse through a vast database of qualified educators with detailed profiles, qualifications, experience, and skills. Find candidates that match your exact requirements.</p>
                </div>
            </div>

            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-briefcase"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Easy Job Posting</h3>
                    <p>Post teaching positions quickly and easily. Our intuitive job posting system allows you to create detailed listings with all necessary information in minutes.</p>
                </div>
            </div>

            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-filter"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Advanced Candidate Search</h3>
                    <p>Filter candidates by subject, experience, qualifications, location, and more. Find the perfect match for your teaching positions with powerful search tools.</p>
                </div>
            </div>

            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-inbox"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Application Management</h3>
                    <p>Manage all job applications in one place. Review resumes, shortlist candidates, and communicate directly with applicants through our secure messaging system.</p>
                </div>
            </div>

            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-shield"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Verified Teacher Profiles</h3>
                    <p>All teacher profiles are verified to ensure authenticity. Access detailed information including qualifications, certifications, and teaching experience.</p>
                </div>
            </div>

            <div class="schools-feature-card">
                <div class="schools-feature-icon">
                    <i class="feather-headphones"></i>
                </div>
                <div class="schools-feature-content">
                    <h3>Dedicated Support</h3>
                    <p>Get personalized assistance from our recruitment experts. We're here to help you find the right teachers and make the hiring process smooth and efficient.</p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="schools-benefits">
            <div class="schools-benefits-header">
                <h2>Why Schools Choose Teachers Recruiter?</h2>
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

        <!-- How It Works -->
        <div class="how-it-works-section">
            <div class="how-it-works-header">
                <h2>How It Works</h2>
                <p>Start hiring quality teachers in four simple steps</p>
            </div>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Register Your School</h3>
                        <p>Create your school profile and verify your institution. Set up your account in minutes with all necessary details.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Post Your Job</h3>
                        <p>Create detailed job postings with requirements, salary, location, and other specifications. Use our AI-powered description generator for help.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Review Applications</h3>
                        <p>Receive applications from qualified teachers. Review profiles, resumes, and qualifications to shortlist the best candidates.</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Hire the Best</h3>
                        <p>Connect with shortlisted candidates, conduct interviews, and hire the perfect teachers for your institution!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="schools-stats">
            <div class="schools-stats-header">
                <h2>Trusted by Thousands of Schools Nationwide</h2>
                <p>Join India's leading education recruitment platform</p>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">5K+</span>
                    <span class="stat-label">Partner Schools</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Active Teachers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Successful Hires</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">28</span>
                    <span class="stat-label">States Covered</span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="schools-cta">
            <div class="cta-content">
                <h2>Ready to Find Your Next Great Teacher?</h2>
                <p>Join thousands of schools that have successfully hired quality educators through Teachers Recruiter. Start your free registration today!</p>
                <div class="cta-buttons">
                    <a href="{{ route('public.account.register') }}" class="btn-primary-custom">Register Your School Now</a>
                    <a href="{{ JobBoardHelper::getJobsPageURL() }}" class="btn-outline-custom">View Job Postings</a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-visual-content">
                    <i class="feather-briefcase"></i>
                    <h3>Start Hiring Today</h3>
                </div>
            </div>
        </div>
    </div>
</section>
