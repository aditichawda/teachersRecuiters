{{-- How It Works - Professional Corporate Layout (Screenshot Style) --}}

{{-- SECTION 1: Hero Section - Title + Description left, Image right --}}
<section class="hiw-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hiw-hero-content">
                    <h2 class="hiw-hero-title">Find Your Dream Teaching Job</h2>
                    <p class="hiw-hero-desc">
                        Teachers Recruiter connects educators with top schools across India. 
                        Whether you're a fresh graduate or an experienced teacher, our platform 
                        makes it simple to discover opportunities that match your skills and aspirations.
                    </p>
                    <p class="hiw-hero-desc">
                        With thousands of verified job listings and a dedicated support team, 
                        we've helped countless teachers find their perfect position.
                    </p>
                    <ul class="hiw-hero-highlights">
                        <li><i class="feather-check-circle"></i> Verified school listings</li>
                        <li><i class="feather-check-circle"></i> Free registration for teachers</li>
                        <li><i class="feather-check-circle"></i> Direct communication with schools</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hiw-hero-image">
                    <img src="{{ Theme::asset()->url('images/gir-large.png') }}" alt="Teaching Career" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: Two-Column Info Boxes --}}
<section class="hiw-info-boxes-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="hiw-info-box">
                    <h3 class="hiw-info-title"><i class="feather-users"></i> For Teachers</h3>
                    <ul class="hiw-info-list">
                        <li>Create your professional profile in minutes</li>
                        <li>Upload resume, certificates and documents</li>
                        <li>Get matched with relevant job openings</li>
                        <li>Apply directly to schools with one click</li>
                        <li>Track your application status in real-time</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hiw-info-box">
                    <h3 class="hiw-info-title"><i class="feather-briefcase"></i> For Schools</h3>
                    <ul class="hiw-info-list">
                        <li>Post unlimited job vacancies</li>
                        <li>Access a pool of verified candidates</li>
                        <li>Filter candidates by experience & location</li>
                        <li>Contact teachers directly through platform</li>
                        <li>Manage all applications from one dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3: Process Steps with Numbers (1-6 Grid) --}}
<section class="hiw-process-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">Simple & Easy</span>
            <h2 class="hiw-section-title">How Teachers Recruiter Works</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">1</span>
                    <h4 class="hiw-step-title">Create an Account</h4>
                    <p class="hiw-step-desc">Sign up for free as a teacher or school. Fill in your basic details to get started.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">2</span>
                    <h4 class="hiw-step-title">Complete Your Profile</h4>
                    <p class="hiw-step-desc">Add your qualifications, experience, preferred subjects and upload your resume.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">3</span>
                    <h4 class="hiw-step-title">Search & Discover</h4>
                    <p class="hiw-step-desc">Browse thousands of teaching jobs. Filter by location, subject, salary and school type.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">4</span>
                    <h4 class="hiw-step-title">Apply to Jobs</h4>
                    <p class="hiw-step-desc">Found a job you like? Apply with one click. Your profile is shared with the school.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">5</span>
                    <h4 class="hiw-step-title">Get Shortlisted</h4>
                    <p class="hiw-step-desc">Schools review applications and shortlist candidates. You'll be notified instantly.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-step-card">
                    <span class="hiw-step-number">6</span>
                    <h4 class="hiw-step-title">Interview & Join</h4>
                    <p class="hiw-step-desc">Attend interviews, receive offers and start your new teaching journey!</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4: Image + Text Alternating --}}
<section class="hiw-alternating-section">
    <div class="container">
        {{-- Row 1: Image Left, Text Right --}}
        <div class="row align-items-center hiw-alt-row">
            <div class="col-lg-6">
                <div class="hiw-alt-image">
                    <img src="{{ Theme::asset()->url('images/gir-large-2.png') }}" alt="For Teachers" class="img-fluid rounded-4">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hiw-alt-content">
                    <span class="hiw-label">For Educators</span>
                    <h3 class="hiw-alt-title">Why Teachers Love Us</h3>
                    <p>Our platform is designed keeping teachers' needs in mind. From easy profile creation to real-time application tracking, we make job hunting stress-free.</p>
                    <ul class="hiw-alt-list">
                        <li><i class="feather-check"></i> 100% free for teachers</li>
                        <li><i class="feather-check"></i> Verified & genuine job postings</li>
                        <li><i class="feather-check"></i> Direct school communication</li>
                        <li><i class="feather-check"></i> Career resources & guidance</li>
                    </ul>
                    <a href="{{ route('public.account.register') }}" class="hiw-btn-primary">Register as Teacher</a>
                </div>
            </div>
        </div>

        {{-- Row 2: Text Left, Image Right --}}
        <div class="row align-items-center hiw-alt-row flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="hiw-alt-image">
                    <img src="{{ Theme::asset()->url('images/boy-large.png') }}" alt="For Schools" class="img-fluid rounded-4">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hiw-alt-content">
                    <span class="hiw-label">For Institutions</span>
                    <h3 class="hiw-alt-title">Hire Quality Teachers Fast</h3>
                    <p>Schools and educational institutions can quickly find qualified teachers through our extensive database of verified candidates.</p>
                    <ul class="hiw-alt-list">
                        <li><i class="feather-check"></i> Access to 50,000+ teacher profiles</li>
                        <li><i class="feather-check"></i> Advanced filtering options</li>
                        <li><i class="feather-check"></i> Dedicated recruitment support</li>
                        <li><i class="feather-check"></i> Affordable hiring packages</li>
                    </ul>
                    <a href="{{ route('public.account.register') }}" class="hiw-btn-primary">Register as School</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 5: Feature Cards --}}
<section class="hiw-features-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">Why Choose Us</span>
            <h2 class="hiw-section-title">What Makes Us Different</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-blue">
                    <div class="hiw-feature-icon"><i class="feather-shield"></i></div>
                    <h4>Verified Listings</h4>
                    <p>All schools and job postings are verified by our team to ensure authenticity.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-green">
                    <div class="hiw-feature-icon"><i class="feather-zap"></i></div>
                    <h4>Fast Hiring</h4>
                    <p>Our streamlined process helps schools hire teachers quickly and efficiently.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-purple">
                    <div class="hiw-feature-icon"><i class="feather-headphones"></i></div>
                    <h4>24/7 Support</h4>
                    <p>Our dedicated support team is always ready to help with any queries.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 6: Stats Counter (Dark Blue Background) --}}
<section class="hiw-stats-section">
    <div class="container">
        <div class="hiw-stats-header">
            <h2 style="color: #ffffff;">Trusted by Thousands of Teachers & Schools</h2>
            <p>Join India's leading education job platform</p>
        </div>
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="hiw-stat-item">
                    <span class="hiw-stat-number">50K+</span>
                    <span class="hiw-stat-label">Registered Teachers</span>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="hiw-stat-item">
                    <span class="hiw-stat-number">5K+</span>
                    <span class="hiw-stat-label">Partner Schools</span>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="hiw-stat-item">
                    <span class="hiw-stat-number">10K+</span>
                    <span class="hiw-stat-label">Jobs Posted</span>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="hiw-stat-item">
                    <span class="hiw-stat-number">25K+</span>
                    <span class="hiw-stat-label">Successful Placements</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7: CTA Section --}}
<section class="hiw-cta-section">
    <div class="container">
        <div class="hiw-cta-content">
            <h2>Ready to Start Your Teaching Journey?</h2>
            <p>Join thousands of educators who have found their dream jobs through Teachers Recruiter.</p>
            <div class="hiw-cta-buttons">
                <a href="{{ route('public.account.register') }}" class="hiw-btn-white">Get Started Free</a>
                <a href="/jobs" class="hiw-btn-outline">Browse Jobs</a>
            </div>
        </div>
    </div>
</section>
