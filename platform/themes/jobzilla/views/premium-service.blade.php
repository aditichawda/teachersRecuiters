@php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner premium-service-page');
@endphp

<style>
.premium-service-section {
    padding: 90px 0 50px;
    background: linear-gradient(135deg, #ffffff 0%, var(--primary-color, #1967d2) 100%);
    color: #1e293b;
}
.premium-service-section .container {
    max-width: 1200px;
    padding: 0 15px;
}
.premium-header {
    text-align: center;
    margin-bottom: 40px;
}
.premium-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #1e293b;
}
.premium-header p {
    font-size: 18px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.premium-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}
.premium-feature-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.premium-feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}
.premium-feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, var(--primary-color, #1967d2) 0%, #005bb5 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: #fff;
}
.premium-feature-card h3 {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 12px;
}
.premium-feature-card p {
    font-size: 15px;
    color: #64748b;
    line-height: 1.6;
}
.premium-pricing {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    max-width: 1000px;
    margin: 0 auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}
.premium-pricing h2 {
    text-align: center;
    font-size: 32px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 30px;
}
.pricing-plans {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}
.pricing-plan {
    border: 2px solid #e2e8f0;
    border-radius: 15px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s ease;
}
.pricing-plan:hover {
    border-color: var(--primary-color, #1967d2);
    transform: translateY(-5px);
}
.pricing-plan.featured {
    border-color: var(--primary-color, #1967d2);
    background: linear-gradient(135deg, var(--primary-color, #1967d2) 0%, #005bb5 100%);
    color: #fff;
}
.pricing-plan h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #1e293b;
}
.pricing-plan.featured h3 {
    color: #fff;
}
.pricing-amount {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #1e293b;
}
.pricing-plan.featured .pricing-amount {
    color: #fff;
}
.pricing-period {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 25px;
}
.pricing-plan.featured .pricing-period {
    color: rgba(255, 255, 255, 0.9);
}
.pricing-features {
    list-style: none;
    padding: 0;
    margin: 0 0 25px;
    text-align: left;
}
.pricing-features li {
    padding: 10px 0;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #f1f5f9;
}
.pricing-plan.featured .pricing-features li {
    color: rgba(255, 255, 255, 0.9);
    border-bottom-color: rgba(255, 255, 255, 0.2);
}
.pricing-features li:before {
    content: "✓";
    color: #10b981;
    font-weight: bold;
    margin-right: 10px;
}
.pricing-plan.featured .pricing-features li:before {
    color: #fff;
}
.pricing-btn {
    display: inline-block;
    padding: 12px 30px;
    background: var(--primary-color, #1967d2);
    color: #fff;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color, #1967d2);
}
.pricing-btn:hover {
    background: transparent;
    color: var(--primary-color, #1967d2);
}
.pricing-plan.featured .pricing-btn {
    background: #fff;
    color: var(--primary-color, #1967d2);
    border-color: #fff;
}
.pricing-plan.featured .pricing-btn:hover {
    background: transparent;
    color: #fff;
}
@media(max-width: 768px) {
    .premium-service-section { padding: 70px 0 40px; }
    .premium-service-section .container { padding: 0 15px; }
    .premium-header { margin-bottom: 30px; }
    .premium-header h1 { font-size: 28px; }
    .premium-header p { font-size: 16px; }
    .premium-features { grid-template-columns: 1fr; gap: 15px; margin-bottom: 30px; }
    .premium-feature-card { padding: 20px 15px; }
    .premium-pricing { padding: 25px 15px; }
    .pricing-plans { grid-template-columns: 1fr; gap: 15px; }
    .pricing-plan { padding: 20px 15px; }
}
</style>

<section class="premium-service-section">
    <div class="container">
        <div class="premium-header">
            <h1>{{ __('Premium Service') }}</h1>
            <p>{{ __('Unlock exclusive features and get priority access to the best job opportunities') }}</p>
        </div>

        <div class="premium-features">
            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-zap"></i>
                </div>
                <h3>{{ __('Priority Job Access') }}</h3>
                <p>{{ __('Get first access to new job postings before they go public. Apply early and increase your chances.') }}</p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-star"></i>
                </div>
                <h3>{{ __('Featured Profile') }}</h3>
                <p>{{ __('Your profile will be highlighted to employers, making you stand out from other candidates.') }}</p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-bell"></i>
                </div>
                <h3>{{ __('Job Alerts') }}</h3>
                <p>{{ __('Receive instant notifications about jobs matching your preferences and skills.') }}</p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-file-text"></i>
                </div>
                <h3>{{ __('Resume Builder') }}</h3>
                <p>{{ __('Access professional resume templates and tools to create an impressive CV.') }}</p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-users"></i>
                </div>
                <h3>{{ __('Career Coaching') }}</h3>
                <p>{{ __('Get expert advice and guidance from career coaches to advance your career.') }}</p>
            </div>

            <div class="premium-feature-card">
                <div class="premium-feature-icon">
                    <i class="feather-shield"></i>
                </div>
                <h3>{{ __('Verified Badge') }}</h3>
                <p>{{ __('Get a verified badge on your profile to show employers you\'re a trusted professional.') }}</p>
            </div>
        </div>

        <div class="premium-pricing">
            <h2>{{ __('Choose Your Plan') }}</h2>
            <div class="pricing-plans">
                <div class="pricing-plan">
                    <h3>{{ __('Basic') }}</h3>
                    <div class="pricing-amount">$9<span style="font-size: 18px;">/month</span></div>
                    <div class="pricing-period">{{ __('Perfect for getting started') }}</div>
                    <ul class="pricing-features">
                        <li>{{ __('Priority job access') }}</li>
                        <li>{{ __('Job alerts') }}</li>
                        <li>{{ __('Basic resume builder') }}</li>
                        <li>{{ __('Email support') }}</li>
                    </ul>
                    <a href="#" class="pricing-btn">{{ __('Get Started') }}</a>
                </div>

                <div class="pricing-plan featured">
                    <h3>{{ __('Premium') }}</h3>
                    <div class="pricing-amount">$19<span style="font-size: 18px;">/month</span></div>
                    <div class="pricing-period">{{ __('Most popular choice') }}</div>
                    <ul class="pricing-features">
                        <li>{{ __('All Basic features') }}</li>
                        <li>{{ __('Featured profile') }}</li>
                        <li>{{ __('Advanced resume builder') }}</li>
                        <li>{{ __('Career coaching sessions') }}</li>
                        <li>{{ __('Priority support') }}</li>
                    </ul>
                    <a href="#" class="pricing-btn">{{ __('Get Started') }}</a>
                </div>

                <div class="pricing-plan">
                    <h3>{{ __('Enterprise') }}</h3>
                    <div class="pricing-amount">$39<span style="font-size: 18px;">/month</span></div>
                    <div class="pricing-period">{{ __('For professionals') }}</div>
                    <ul class="pricing-features">
                        <li>{{ __('All Premium features') }}</li>
                        <li>{{ __('Verified badge') }}</li>
                        <li>{{ __('Unlimited coaching') }}</li>
                        <li>{{ __('Dedicated support') }}</li>
                        <li>{{ __('Custom profile design') }}</li>
                    </ul>
                    <a href="#" class="pricing-btn">{{ __('Get Started') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
