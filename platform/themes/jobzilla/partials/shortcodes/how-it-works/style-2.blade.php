{!! Theme::partial('hiw-styles') !!}

{{-- HOW IT WORK SECTION - HOME PAGE USING SAME LAYOUT AS /how-it-works --}}
<section class="hiw-process-section">
    <div class="container">
        <div class="hiw-section-header">
            <h2 class="hiw-section-title">How It Works</h2>
        </div>

        {{-- Toggle Buttons --}}
        <div class="hiw-toggle-buttons">
            <button class="hiw-toggle-btn active" data-target="educators" onclick="toggleHowItWorksHomeSection('educators', this)">
                For Educators
            </button>
            <button class="hiw-toggle-btn" data-target="institutions" onclick="toggleHowItWorksHomeSection('institutions', this)">
                For Institutions
            </button>
        </div>

        {{-- For Educators Content (Default) --}}
        <div id="educators-content-home-section" class="hiw-content-section active">
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
        <div id="institutions-content-home-section" class="hiw-content-section">
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

{{-- Video Section --}}
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

<style>
.hiw-video-wrapper-large {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    background: #000;
}
.hiw-video-wrapper-large iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}
</style>

<script>
function toggleHowItWorksHomeSection(target, element) {
    // Hide sections
    document.querySelectorAll('#educators-content-home-section, #institutions-content-home-section').forEach(section => {
        section.classList.remove('active');
    });

    // Toggle buttons only inside this block
    const container = element.closest('.hiw-process-section');
    if (container) {
        container.querySelectorAll('.hiw-toggle-btn').forEach(btn => btn.classList.remove('active'));
    }

    // Show selected
    const contentSection = document.getElementById(target + '-content-home-section');
    if (contentSection) {
        contentSection.classList.add('active');
    }

    if (element) {
        element.classList.add('active');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const educatorsContent = document.getElementById('educators-content-home-section');
    const educatorsBtn = document.querySelector('.hiw-process-section .hiw-toggle-btn[data-target="educators"]');

    if (educatorsContent && educatorsBtn) {
        educatorsContent.classList.add('active');
        educatorsBtn.classList.add('active');
    }
    });
    </script>
