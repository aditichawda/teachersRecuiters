
<?php echo Theme::partial('hiw-styles'); ?>


<style>
/* Privacy page specific styles */
.privacy-hero {
    padding: 80px 0 60px;
    background: linear-gradient(160deg, #0f172a 0%, #1e3a5f 50%, #1e293b 100%);
    position: relative;
    overflow: hidden;
    color: #fff;
}
.privacy-hero::before {
    content: '';
    position: absolute;
    top: -150px;
    right: -100px;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,.15) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.privacy-hero::after {
    content: '';
    position: absolute;
    bottom: -200px;
    left: -100px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(139,92,246,.1) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.privacy-hero .hiw-label {
    background: rgba(255,255,255,.1);
    color: #93c5fd;
    border-color: rgba(255,255,255,.15);
}
.privacy-hero-title {
    font-size: 46px;
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    margin-bottom: 20px;
    margin-top: 12px;
}
.privacy-hero-desc {
    font-size: 17px;
    color: rgba(255,255,255,.7);
    line-height: 1.8;
    margin-bottom: 15px;
    max-width: 560px;
}
.privacy-hero-meta {
    display: flex;
    gap: 30px;
    margin-top: 30px;
    flex-wrap: wrap;
}
.privacy-hero-meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,.6);
    font-size: 14px;
}
.privacy-hero-meta-item i {
    color: #60a5fa;
    font-size: 18px;
}
.privacy-hero-shield {
    text-align: center;
    position: relative;
}
.privacy-hero-shield-icon {
    width: 220px;
    height: 220px;
    background: linear-gradient(135deg, rgba(59,130,246,.2) 0%, rgba(139,92,246,.15) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 2px solid rgba(255,255,255,.08);
    box-shadow: 0 25px 60px rgba(0,0,0,.3);
}
.privacy-hero-shield-icon i {
    font-size: 90px;
    color: #60a5fa;
    opacity: .9;
}

/* Privacy summary cards */
.privacy-summary-section {
    padding: 70px 0;
    background: #fff;
}
.privacy-summary-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    height: 100%;
    transition: all .3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,.03);
    position: relative;
    overflow: hidden;
}
.privacy-summary-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    border-radius: 20px 20px 0 0;
}
.privacy-summary-card.card-blue::before { background: linear-gradient(90deg, #2563eb, #3b82f6); }
.privacy-summary-card.card-green::before { background: linear-gradient(90deg, #16a34a, #22c55e); }
.privacy-summary-card.card-purple::before { background: linear-gradient(90deg, #7c3aed, #8b5cf6); }
.privacy-summary-card.card-orange::before { background: linear-gradient(90deg, #ea580c, #f97316); }
.privacy-summary-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 40px rgba(0,0,0,.08);
}
.privacy-summary-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #fff;
    margin-bottom: 18px;
}
.card-blue .privacy-summary-icon { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.card-green .privacy-summary-icon { background: linear-gradient(135deg, #16a34a, #22c55e); }
.card-purple .privacy-summary-icon { background: linear-gradient(135deg, #7c3aed, #8b5cf6); }
.card-orange .privacy-summary-icon { background: linear-gradient(135deg, #ea580c, #f97316); }
.privacy-summary-card h4 {
    font-size: 17px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}
.privacy-summary-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
}

/* Privacy content sections */
.privacy-content-section {
    padding: 70px 0;
    background: #f8fafc;
}
.privacy-content-block {
    background: #fff;
    border-radius: 16px;
    padding: 35px;
    margin-bottom: 24px;
    border: 1px solid #e2e8f0;
    transition: all .3s;
    box-shadow: 0 2px 10px rgba(0,0,0,.02);
}
.privacy-content-block:hover {
    box-shadow: 0 6px 25px rgba(0,0,0,.06);
    border-color: #cbd5e1;
}
.privacy-content-block-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 18px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f1f5f9;
}
.privacy-content-block-num {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color, #1967d2), #3b82f6);
    color: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: 800;
    flex-shrink: 0;
}
.privacy-content-block-header h3 {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}
.privacy-content-block p {
    font-size: 15px;
    color: #475569;
    line-height: 1.8;
    margin-bottom: 15px;
}
.privacy-content-block p:last-child {
    margin-bottom: 0;
}
.privacy-content-block ul {
    list-style: none;
    padding: 0;
    margin: 0 0 15px;
}
.privacy-content-block ul li {
    font-size: 15px;
    color: #475569;
    line-height: 1.7;
    padding: 7px 0 7px 28px;
    position: relative;
}
.privacy-content-block ul li::before {
    content: '';
    position: absolute;
    left: 2px;
    top: 15px;
    width: 7px;
    height: 7px;
    border: 2px solid var(--primary-color, #1967d2);
    border-radius: 50%;
    background: transparent;
}

/* Rights grid */
.privacy-rights-section {
    padding: 70px 0;
    background: #fff;
}
.privacy-right-card {
    background: #f8fafc;
    border-radius: 16px;
    padding: 28px;
    height: 100%;
    transition: all .3s;
    border: 1px solid transparent;
}
.privacy-right-card:hover {
    background: #fff;
    border-color: var(--primary-color, #1967d2);
    box-shadow: 0 8px 25px rgba(25,103,210,.1);
    transform: translateY(-4px);
}
.privacy-right-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-color, #1967d2), #3b82f6);
    color: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 15px;
}
.privacy-right-card h5 {
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.privacy-right-card p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Contact strip */
.privacy-contact-strip {
    padding: 50px 0;
    background: linear-gradient(135deg, #f0f5ff 0%, #eef2ff 100%);
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
}
.privacy-contact-item {
    text-align: center;
    padding: 15px;
}
.privacy-contact-item i {
    font-size: 28px;
    color: var(--primary-color, #1967d2);
    margin-bottom: 10px;
    display: block;
}
.privacy-contact-item h6 {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
}
.privacy-contact-item p {
    font-size: 13px;
    color: #64748b;
    margin: 0;
}

@media(max-width:991px) {
    .privacy-hero-title { font-size: 34px; }
    .privacy-hero-shield-icon { width: 160px; height: 160px; }
    .privacy-hero-shield-icon i { font-size: 65px; }
}
@media(max-width:767px) {
    .privacy-hero { padding: 50px 0 40px; }
    .privacy-hero-title { font-size: 28px; }
    .privacy-hero-meta { gap: 15px; }
    .privacy-hero-shield { margin-top: 30px; }
    .privacy-summary-section, .privacy-content-section, .privacy-rights-section { padding: 50px 0; }
}
</style>


<section class="privacy-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="hiw-label">Privacy</span>
                <h1 class="privacy-hero-title">Privacy Policy</h1>
                <p class="privacy-hero-desc">
                    At Teachers Recruiter, your privacy is our priority. This policy explains how we collect, 
                    use, and protect your personal information when you use our platform.
                </p>
                <p class="privacy-hero-desc">
                    We are committed to transparency and ensuring your data is handled responsibly 
                    in compliance with Indian data protection regulations.
                </p>
                <div class="privacy-hero-meta">
                    <div class="privacy-hero-meta-item">
                        <i class="feather-calendar"></i>
                        <span>Last Updated: February 10, 2026</span>
                    </div>
                    <div class="privacy-hero-meta-item">
                        <i class="feather-map-pin"></i>
                        <span>Applicable in India</span>
                    </div>
                    <div class="privacy-hero-meta-item">
                        <i class="feather-shield"></i>
                        <span>DPDP Act Compliant</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="privacy-hero-shield">
                    <div class="privacy-hero-shield-icon">
                        <i class="feather-shield"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="privacy-summary-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">At a Glance</span>
            <h2 class="hiw-section-title">What You Need to Know</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="privacy-summary-card card-blue">
                    <div class="privacy-summary-icon"><i class="feather-database"></i></div>
                    <h4>What We Collect</h4>
                    <p>Name, email, phone, resume, qualifications, and job preferences you provide during registration.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="privacy-summary-card card-green">
                    <div class="privacy-summary-icon"><i class="feather-settings"></i></div>
                    <h4>How We Use It</h4>
                    <p>To match you with jobs, improve our services, send notifications, and provide customer support.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="privacy-summary-card card-purple">
                    <div class="privacy-summary-icon"><i class="feather-share-2"></i></div>
                    <h4>Who We Share With</h4>
                    <p>Only with schools you apply to and trusted service providers. We never sell your personal data.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="privacy-summary-card card-orange">
                    <div class="privacy-summary-icon"><i class="feather-lock"></i></div>
                    <h4>How We Protect It</h4>
                    <p>Industry-standard encryption, secure servers, access controls, and regular security audits.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="privacy-content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">1</span>
                        <h3>Information We Collect</h3>
                    </div>
                    <p>We collect information that you provide directly to us when you create an account, apply for jobs, or interact with our platform:</p>
                    <ul>
                        <li><strong>Personal Information:</strong> Full name, email address, phone number, date of birth, gender, and profile photo</li>
                        <li><strong>Professional Information:</strong> Qualifications, teaching experience, certifications, subjects taught, and resume/CV</li>
                        <li><strong>Job Preferences:</strong> Preferred location, salary expectations, job type (full-time/part-time), and school type</li>
                        <li><strong>Account Data:</strong> Login credentials, communication preferences, and account settings</li>
                        <li><strong>Automatic Data:</strong> IP address, browser type, device information, pages visited, and cookies for analytics</li>
                    </ul>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">2</span>
                        <h3>How We Use Your Information</h3>
                    </div>
                    <p>The information we collect is used for the following purposes:</p>
                    <ul>
                        <li>To create and manage your account on Teachers Recruiter</li>
                        <li>To match teachers with relevant job openings based on qualifications and preferences</li>
                        <li>To enable schools to search, view, and contact suitable candidates</li>
                        <li>To send job alerts, application updates, and important platform notifications</li>
                        <li>To improve our platform features, user experience, and service quality</li>
                        <li>To provide customer support and respond to your enquiries</li>
                        <li>To detect, prevent, and address fraud or security issues</li>
                        <li>To comply with legal obligations and enforce our Terms of Service</li>
                    </ul>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">3</span>
                        <h3>Information Sharing & Disclosure</h3>
                    </div>
                    <p>We do not sell your personal information. We may share your data only in the following circumstances:</p>
                    <ul>
                        <li><strong>With Schools/Employers:</strong> When you apply for a job, your profile and resume are shared with the respective school</li>
                        <li><strong>Service Providers:</strong> Trusted third-party vendors who assist with hosting, analytics, email delivery, and payment processing</li>
                        <li><strong>Legal Requirements:</strong> When required by law, court order, or government authority</li>
                        <li><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, with appropriate notice to users</li>
                        <li><strong>With Your Consent:</strong> In any other case, we will share your information only with your explicit permission</li>
                    </ul>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">4</span>
                        <h3>Cookies & Tracking Technologies</h3>
                    </div>
                    <p>We use cookies and similar technologies to enhance your experience on our platform:</p>
                    <ul>
                        <li><strong>Essential Cookies:</strong> Required for the website to function properly (login sessions, security tokens)</li>
                        <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our platform (Google Analytics)</li>
                        <li><strong>Preference Cookies:</strong> Remember your settings and preferences for a personalized experience</li>
                        <li><strong>Marketing Cookies:</strong> Used to display relevant job recommendations and advertisements</li>
                    </ul>
                    <p>You can manage or disable cookies through your browser settings. Note that disabling certain cookies may affect platform functionality.</p>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">5</span>
                        <h3>Data Security</h3>
                    </div>
                    <p>We take the security of your personal data seriously and implement the following measures:</p>
                    <ul>
                        <li>SSL/TLS encryption for all data transmitted between your browser and our servers</li>
                        <li>Encrypted storage for sensitive information including passwords and personal documents</li>
                        <li>Role-based access controls limiting employee access to personal data on a need-to-know basis</li>
                        <li>Regular security audits and vulnerability assessments of our systems</li>
                        <li>Secure data centres with physical and digital access protections</li>
                    </ul>
                    <p>While we strive to protect your information, no method of transmission over the internet is 100% secure. We encourage you to use strong passwords and keep your login credentials confidential.</p>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">6</span>
                        <h3>Data Retention</h3>
                    </div>
                    <p>We retain your personal information for as long as necessary to fulfil the purposes outlined in this policy:</p>
                    <ul>
                        <li>Active account data is retained as long as your account remains active</li>
                        <li>If you delete your account, we will remove your personal data within 30 days</li>
                        <li>Some data may be retained longer for legal, accounting, or compliance purposes</li>
                        <li>Anonymized and aggregated data may be retained indefinitely for analytics</li>
                        <li>Backup copies are automatically deleted within 90 days of data removal</li>
                    </ul>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">7</span>
                        <h3>Children's Privacy</h3>
                    </div>
                    <p>Teachers Recruiter is not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If we discover that we have inadvertently collected data from a minor, we will promptly delete such information.</p>
                    <p>If you are a parent or guardian and believe your child has provided us with personal data, please contact us immediately at <strong>privacy@teachersrecruiter.com</strong>.</p>
                </div>

                <div class="privacy-content-block">
                    <div class="privacy-content-block-header">
                        <span class="privacy-content-block-num">8</span>
                        <h3>Changes to This Policy</h3>
                    </div>
                    <p>We may update this Privacy Policy from time to time to reflect changes in our practices or applicable laws:</p>
                    <ul>
                        <li>The updated policy will be posted on this page with a revised "Last Updated" date</li>
                        <li>Material changes will be communicated through email or platform notifications</li>
                        <li>Continued use of the platform after changes constitutes your acceptance of the updated policy</li>
                        <li>We encourage you to review this policy periodically to stay informed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="privacy-rights-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">Your Rights</span>
            <h2 class="hiw-section-title">You Are in Control of Your Data</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-eye"></i></div>
                    <h5>Right to Access</h5>
                    <p>Request a copy of the personal data we hold about you at any time.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-edit-3"></i></div>
                    <h5>Right to Correction</h5>
                    <p>Update or correct any inaccurate or incomplete personal information.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-trash-2"></i></div>
                    <h5>Right to Deletion</h5>
                    <p>Request the deletion of your account and associated personal data.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-download"></i></div>
                    <h5>Right to Portability</h5>
                    <p>Request your data in a commonly used, machine-readable format.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-slash"></i></div>
                    <h5>Right to Restrict</h5>
                    <p>Restrict or object to certain types of data processing activities.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="privacy-right-card">
                    <div class="privacy-right-icon"><i class="feather-bell-off"></i></div>
                    <h5>Right to Opt-Out</h5>
                    <p>Unsubscribe from marketing emails and promotional communications anytime.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="privacy-contact-strip">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="privacy-contact-item">
                    <i class="feather-mail"></i>
                    <h6>Email Us</h6>
                    <p>privacy@teachersrecruiter.com</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="privacy-contact-item">
                    <i class="feather-map-pin"></i>
                    <h6>Office Address</h6>
                    <p>Teachers Recruiter, India</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="privacy-contact-item">
                    <i class="feather-clock"></i>
                    <h6>Response Time</h6>
                    <p>Within 48 hours on business days</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="hiw-cta-section">
    <div class="container">
        <div class="hiw-cta-content">
            <h2>Your Privacy Matters to Us</h2>
            <p>Have questions about your data? We're always here to help. Reach out to our privacy team anytime.</p>
            <div class="hiw-cta-buttons">
                <a href="/contact" class="hiw-btn-white">Contact Us</a>
                <a href="/terms-conditions" class="hiw-btn-outline">View Terms & Conditions</a>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/partials/privacy-layout.blade.php ENDPATH**/ ?>