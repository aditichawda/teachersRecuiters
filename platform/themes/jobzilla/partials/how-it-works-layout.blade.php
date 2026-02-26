{{-- How It Works - Professional Corporate Layout (Like About Us) --}}
{!! Theme::partial('hiw-styles') !!}

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
                    <img src="/themes/jobzilla/images/Find-your-dream-teaching-job.png" alt="Teaching Career" class="img-fluid rounded-4">
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

{{-- SECTION 3: How It Works - Toggleable For Educators / For Institutions --}}
<section class="hiw-process-section">
    <div class="container">
        <div class="hiw-section-header">
            <h2 class="hiw-section-title">How It Works</h2>
        </div>
        
        {{-- Toggle Buttons --}}
        <div class="hiw-toggle-buttons">
            <button class="hiw-toggle-btn active" data-target="educators" onclick="toggleHowItWorks('educators')">
                For Educators
            </button>
            <button class="hiw-toggle-btn" data-target="institutions" onclick="toggleHowItWorks('institutions')">
                For Institutions
            </button>
        </div>
        
        {{-- For Educators Content (Default) --}}
        <div id="educators-content" class="hiw-content-section active">
            <div class="hiw-content-header">
                <h3 class="hiw-content-title">For Educators</h3>
                <p class="hiw-content-subtitle">Follow the steps and apply for verified school jobs.</p>
        </div>
        <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                <div class="hiw-step-card">
                        <span class="hiw-step-number">01</span>
                        <h4 class="hiw-step-title">Upload Your Resume</h4>
                        <p class="hiw-step-desc">Sign up, verify your email/mobile, and upload your resume. <strong>100% Free Registration</strong></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hiw-step-card">
                        <span class="hiw-step-number">02</span>
                        <h4 class="hiw-step-title">Search Job & Apply</h4>
                        <p class="hiw-step-desc">Complete your profile, get job suggestions, and apply to unlimited jobs. <strong>No Cost to Apply</strong></p>
                </div>
            </div>
                <div class="col-lg-3 col-md-6">
                <div class="hiw-step-card">
                        <span class="hiw-step-number">03</span>
                        <h4 class="hiw-step-title">Get Noticed by Schools</h4>
                        <p class="hiw-step-desc">Schools can view your profile and contact you directly for opportunities.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hiw-step-card">
                        <span class="hiw-step-number">04</span>
                        <h4 class="hiw-step-title">Interview & Get Hired</h4>
                        <p class="hiw-step-desc">Attend interviews, receive offers, and start your new educator role.</p>
            </div>
                </div>
            </div>
        </div>
        
        {{-- For Institutions Content --}}
        <div id="institutions-content" class="hiw-content-section">
            <div class="hiw-content-header">
                <h3 class="hiw-content-title">For Institutions</h3>
                <p class="hiw-content-subtitle">Smart Hiring. Verified Educators. Faster Recruitment.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                <div class="hiw-step-card">
                        <span class="hiw-step-number">01</span>
                        <h4 class="hiw-step-title">Register Your Institution</h4>
                        <p class="hiw-step-desc">Sign up with basic details and verify your email/mobile to activate your account.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hiw-step-card">
                        <span class="hiw-step-number">02</span>
                        <h4 class="hiw-step-title">Post Jobs & Manage Applications</h4>
                        <p class="hiw-step-desc">Publish job openings, receive relevant applications, and track or shortlist candidates from your dashboard.</p>
                </div>
            </div>
                <div class="col-lg-3 col-md-6">
                <div class="hiw-step-card">
                        <span class="hiw-step-number">03</span>
                        <h4 class="hiw-step-title">Access Educators Resume</h4>
                        <p class="hiw-step-desc">Search verified teacher profiles using filters like subject, experience, qualification, location, and availability.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hiw-step-card">
                        <span class="hiw-step-number">04</span>
                        <h4 class="hiw-step-title">Interview and Hire Faster</h4>
                        <p class="hiw-step-desc">Connect directly with shortlisted candidates and hire the best talent quickly.</p>
            </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleHowItWorks(target) {
    // Hide all content sections
    document.querySelectorAll('.hiw-content-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.hiw-toggle-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected content
    const contentSection = document.getElementById(target + '-content');
    if (contentSection) {
        contentSection.classList.add('active');
    }
    
    // Add active class to clicked button
    const clickedBtn = event.target;
    if (clickedBtn) {
        clickedBtn.classList.add('active');
    }
}

// Ensure default view is shown on page load
document.addEventListener('DOMContentLoaded', function() {
    const educatorsContent = document.getElementById('educators-content');
    const educatorsBtn = document.querySelector('[data-target="educators"]');
    
    if (educatorsContent && educatorsBtn) {
        educatorsContent.classList.add('active');
        educatorsBtn.classList.add('active');
    }
});
</script>

{{-- SECTION 3.5: Watch How It Works - Video --}}
<section class="hiw-video-section">
    <div class="container">
        <div class="hiw-section-header">
            <h2 class="hiw-section-title">See How It Works</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="hiw-video-wrapper-large">
                    <iframe 
                        src="https://www.youtube.com/embed/r4PevhrJA_A?si=oVH36shDIgdaL5D4" 
                        title="Teachers Recruiter - How It Works" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
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
                    <img src="/themes/jobzilla/images/Why-teachers-love-us.png" alt="For Teachers" class="img-fluid rounded-4">
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
                    <img src="/themes/jobzilla/images/Hire-quality-teachers-fast.png" alt="For Schools" class="img-fluid rounded-4">
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
                <a href="/jobs" class="hiw-btn-outline">View Jobs</a>
            </div>
        </div>
    </div>
</section>