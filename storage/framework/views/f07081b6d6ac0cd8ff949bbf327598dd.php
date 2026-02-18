<?php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner for-teachers-page');
?>

<style>
.for-teachers-section {
    padding: 90px 0 50px;
    background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
    color: #1e293b;
}
.for-teachers-section .container {
    max-width: 1200px;
    padding: 0 15px;
}

/* Hero Section */
.teachers-hero {
    text-align: center;
    margin-bottom: 60px;
    padding: 40px 0;
}
.teachers-hero h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #1e293b;
    line-height: 1.2;
}
.teachers-hero .hero-subtitle {
    font-size: 22px;
    color: #0073d1;
    font-weight: 600;
    margin-bottom: 15px;
}
.teachers-hero p {
    font-size: 18px;
    color: #64748b;
    max-width: 700px;
    margin: 0 auto 30px;
    line-height: 1.7;
}
.hero-cta {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Features Grid */
.teachers-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}
.teachers-feature-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}
.teachers-feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}
.teachers-feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 115, 209, 0.15);
    border-color: #0073d1;
}
.teachers-feature-card:hover::before {
    transform: scaleX(1);
}
.teachers-feature-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 25px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
}
.teachers-feature-card h3 {
    font-size: 24px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
}
.teachers-feature-card p {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* Benefits Section */
.teachers-benefits {
    background: #fff;
    border-radius: 25px;
    padding: 50px 40px;
    margin-bottom: 60px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}
.teachers-benefits-header {
    text-align: center;
    margin-bottom: 40px;
}
.teachers-benefits-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.teachers-benefits-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}
.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 12px;
    transition: all 0.3s ease;
}
.benefit-item:hover {
    background: #f0f7ff;
    transform: translateX(5px);
}
.benefit-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
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

/* How It Works */
.how-it-works-section {
    margin-bottom: 60px;
}
.how-it-works-header {
    text-align: center;
    margin-bottom: 50px;
}
.how-it-works-header h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.how-it-works-header p {
    font-size: 18px;
    color: #64748b;
}
.steps-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    position: relative;
}
.step-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    position: relative;
    transition: all 0.3s ease;
}
.step-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 115, 209, 0.15);
}
.step-number {
    width: 60px;
    height: 60px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 115, 209, 0.3);
}
.step-card h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
}
.step-card p {
    font-size: 15px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* Stats Section */
.teachers-stats {
    background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
    border-radius: 25px;
    padding: 60px 40px;
    margin-bottom: 60px;
    color: #fff;
    text-align: center;
}
.teachers-stats h2 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #fff;
}
.teachers-stats p {
    font-size: 18px;
    margin-bottom: 40px;
    opacity: 0.95;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
}
.stat-item {
    padding: 20px;
}
.stat-number {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #fff;
    display: block;
}
.stat-label {
    font-size: 16px;
    opacity: 0.9;
    color: #fff;
}

/* CTA Section */
.teachers-cta {
    background: #fff;
    border-radius: 25px;
    padding: 60px 40px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}
.teachers-cta h2 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}
.teachers-cta p {
    font-size: 18px;
    color: #64748b;
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
    background: transparent;
    color: #0073d1;
    border: 2px solid #0073d1;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-outline-custom:hover {
    background: #0073d1;
    color: #fff;
    transform: translateY(-2px);
}

/* Responsive */
@media(max-width: 768px) {
    .for-teachers-section { padding: 70px 0 40px; }
    .teachers-hero h1 { font-size: 32px; }
    .teachers-hero .hero-subtitle { font-size: 18px; }
    .teachers-hero p { font-size: 16px; }
    .teachers-features { grid-template-columns: 1fr; gap: 20px; margin-bottom: 40px; }
    .teachers-feature-card { padding: 25px 20px; }
    .teachers-benefits { padding: 35px 25px; }
    .benefits-grid { grid-template-columns: 1fr; gap: 15px; }
    .steps-container { grid-template-columns: 1fr; gap: 20px; }
    .teachers-stats { padding: 40px 25px; }
    .teachers-stats h2 { font-size: 28px; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .stat-number { font-size: 36px; }
    .teachers-cta { padding: 40px 25px; }
    .teachers-cta h2 { font-size: 28px; }
    .cta-buttons { flex-direction: column; }
    .btn-primary-custom, .btn-outline-custom { width: 100%; }
}
</style>

<section class="for-teachers-section">
    <div class="container">
        <!-- Hero Section -->
        <div class="teachers-hero">
            <span class="hero-subtitle">For Teachers</span>
            <h1>Find Your Dream Teaching Job in India</h1>
            <p>
                Join thousands of educators who have found their perfect teaching positions through Teachers Recruiter. 
                Access verified job opportunities from top schools and educational institutions across India—all in one place, completely free.
            </p>
            <div class="hero-cta">
                <a href="<?php echo e(route('public.account.register')); ?>" class="btn-primary-custom">Get Started Free</a>
                <a href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" class="btn-outline-custom">Browse Jobs</a>
            </div>
        </div>

        <!-- Key Features -->
        <div class="teachers-features">
            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-search"></i>
                </div>
                <h3>Verified Job Postings</h3>
                <p>Browse through thousands of genuine teaching opportunities from verified schools and educational institutions across India. Every job posting is verified for authenticity.</p>
            </div>

            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-user-plus"></i>
                </div>
                <h3>100% Free Registration</h3>
                <p>Create your profile completely free of charge. No hidden fees, no subscription costs. Start applying to jobs immediately after registration.</p>
            </div>

            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-file-text"></i>
                </div>
                <h3>Professional Resume Builder</h3>
                <p>Create an impressive resume using our professional templates. Showcase your qualifications, experience, and achievements in a format that stands out to employers.</p>
            </div>

            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-bell"></i>
                </div>
                <h3>Job Alerts & Notifications</h3>
                <p>Never miss an opportunity! Get instant notifications about new job postings that match your preferences, qualifications, and location.</p>
            </div>

            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-message-circle"></i>
                </div>
                <h3>Direct Communication</h3>
                <p>Connect directly with schools and institutions. Apply to jobs and communicate with potential employers through our secure messaging system.</p>
            </div>

            <div class="teachers-feature-card">
                <div class="teachers-feature-icon">
                    <i class="feather-map-pin"></i>
                </div>
                <h3>Pan-India Opportunities</h3>
                <p>Access teaching jobs from all 28 states across India. Filter by location, subject, grade level, and institution type to find your perfect match.</p>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="teachers-benefits">
            <div class="teachers-benefits-header">
                <h2>Why Choose Teachers Recruiter?</h2>
                <p>We're dedicated to making your job search easier and more successful</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-shield"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Trusted Platform</h4>
                        <p>Join 50,000+ registered teachers who trust us for their career growth</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-check-circle"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Verified Listings</h4>
                        <p>All job postings are verified to ensure authenticity and prevent fraud</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-zap"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Quick Application</h4>
                        <p>Apply to multiple jobs with just a few clicks using your saved profile</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-book-open"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Career Resources</h4>
                        <p>Access helpful articles, tips, and guidance to advance your teaching career</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-users"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Community Support</h4>
                        <p>Join a supportive community of educators sharing experiences and opportunities</p>
                    </div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="feather-smartphone"></i>
                    </div>
                    <div class="benefit-content">
                        <h4>Mobile Friendly</h4>
                        <p>Search and apply for jobs on-the-go with our mobile-optimized platform</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="how-it-works-section">
            <div class="how-it-works-header">
                <h2>How It Works</h2>
                <p>Get started in just a few simple steps</p>
            </div>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3>Create Your Profile</h3>
                    <p>Sign up for free and create a comprehensive profile with your qualifications, experience, and preferences.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3>Build Your Resume</h3>
                    <p>Use our professional resume builder to create an impressive CV that highlights your teaching expertise.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Search & Apply</h3>
                    <p>Browse through verified job postings, filter by your preferences, and apply to positions that match your skills.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3>Get Hired</h3>
                    <p>Connect with schools directly, attend interviews, and land your dream teaching position!</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="teachers-stats">
            <h2>Join India's Leading Education Job Platform</h2>
            <p>Trusted by thousands of teachers and schools nationwide</p>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Registered Teachers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">5K+</span>
                    <span class="stat-label">Partner Schools</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">28</span>
                    <span class="stat-label">States Covered</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">1000+</span>
                    <span class="stat-label">Successful Placements</span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="teachers-cta">
            <h2>Ready to Start Your Teaching Career Journey?</h2>
            <p>Join thousands of educators who have found their perfect teaching positions. Start your free registration today!</p>
            <div class="cta-buttons">
                <a href="<?php echo e(route('public.account.register')); ?>" class="btn-primary-custom">Register Now - It's Free</a>
                <a href="<?php echo e(JobBoardHelper::getJobsPageURL()); ?>" class="btn-outline-custom">Explore Job Opportunities</a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/for-teachers.blade.php ENDPATH**/ ?>