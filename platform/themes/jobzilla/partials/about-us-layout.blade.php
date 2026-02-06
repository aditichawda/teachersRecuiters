{{-- About Us - Professional Corporate Layout (Like How It Works) --}}

{{-- SECTION 1: Hero Section - Title + Description left, Image right --}}
<section class="hiw-hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hiw-hero-content">
                    <span class="hiw-label">About Teachers Recruiter</span>
                    <h2 class="hiw-hero-title">Connecting Teachers with Top Schools Across India</h2>
                    <p class="hiw-hero-desc">
                        Founded in June 2015, Teachers Recruiter began as an offline recruitment consultancy 
                        catering to schools and JEE-NEET coaching institutions across Pan India. Our focus has 
                        always been on helping institutions find the right educators and enabling teachers to 
                        find the right opportunities where they can thrive.
                    </p>
                    <p class="hiw-hero-desc">
                        From 2015 to 2020, our efforts resulted in over 1,000+ successful teacher placements 
                        in reputed schools and educational organizations across the country.
                    </p>
                    <ul class="hiw-hero-highlights">
                        <li><i class="feather-check-circle"></i> Trusted by 5,000+ schools nationwide</li>
                        <li><i class="feather-check-circle"></i> 50,000+ registered teachers</li>
                        <li><i class="feather-check-circle"></i> Pan-India presence across 28 states</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hiw-hero-images">
                    <img src="/themes/jobzilla/images/about-hero.png" alt="Teachers Recruiter" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 2: Our Journey Cards --}}
<section class="hiw-info-boxes-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="hiw-info-box">
                    <h3 class="hiw-info-title"><i class="feather-clock"></i> Our Journey</h3>
                    <p style="color: #64748b; line-height: 1.8; margin-bottom: 15px;">
                        When the COVID-19 pandemic disrupted the education sector, we adapted quickly—supporting 
                        online teaching platforms and ensuring that learning continued. This challenging time 
                        inspired us to take our services online.
                    </p>
                    <p style="color: #64748b; line-height: 1.8; margin-bottom: 0;">
                        This led to the creation of the Teachers Recruiter job portal, a dedicated platform 
                        for the education sector in India, making recruitment accessible to all.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hiw-info-box">
                    <h3 class="hiw-info-title"><i class="feather-globe"></i> Our Reach</h3>
                    <p style="color: #64748b; line-height: 1.8; margin-bottom: 15px;">
                        Along with our portal, we have built a strong presence on social media, with a community 
                        of 600K+ followers across platforms, led by our rapidly growing LinkedIn network.
                    </p>
                    <p style="color: #64748b; line-height: 1.8; margin-bottom: 0;">
                        This reach allows us to connect schools with a wider pool of educators and share 
                        authentic opportunities with teachers nationwide through multiple channels.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 3: Mission & Vision --}}
<section class="hiw-process-section" style="background: #ffffff;">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">What Drives Us</span>
            <h2 class="hiw-section-title">Our Mission & Vision</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="about-mv-card">
                    <div class="d-flex">
                        <div class="about-mv-icon m-2"><i class="feather-target"></i></div>
                        <h3 class="about-mv-card-title">Our Mission</h3>
                    </div>
                    
                    <p class="about-mv-card-desc">
                        To connect passionate educators with the right institutions, enabling quality education 
                        to reach every corner of India. We aim to simplify and speed up the recruitment process 
                        for schools while opening doors to genuine career opportunities for teachers.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-mv-card">
                    <div class="d-flex">
                        <div class="about-mv-icon m-2"><i class="feather-eye"></i></div>
                        <h3 class="about-mv-card-title">Our Vision</h3>
                    </div>
                    <p class="about-mv-card-desc">
                        To be India's most trusted and preferred recruitment platform for the education sector—empowering 
                        schools with the best talent and helping educators find fulfilling careers that shape the 
                        future of learning.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 4: What We Do - Alternating --}}
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
                    <h3 class="hiw-alt-title">Empowering Teachers</h3>
                    <p>Today, our portal bridges the gap between schools seeking quality educators and teachers looking for the right career opportunities. Educators can access genuine openings across India in one place.</p>
                    <ul class="hiw-alt-list">
                        <li><i class="feather-check"></i> 100% free registration for teachers</li>
                        <li><i class="feather-check"></i> Verified & genuine job postings</li>
                        <li><i class="feather-check"></i> Direct communication with schools</li>
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
                    <h3 class="hiw-alt-title">Supporting Schools</h3>
                    <p>Schools can post jobs, search resumes, and manage applications with ease. With our experience, network, and passion for education recruitment, Teachers Recruiter is proud to be a trusted recruitment partner shaping the future of learning.</p>
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

{{-- SECTION 5: Our Values --}}
<section class="hiw-features-section">
    <div class="container">
        <div class="hiw-section-header">
            <span class="hiw-label">What We Stand For</span>
            <h2 class="hiw-section-title">Our Core Values</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-blue">
                    <div class="hiw-feature-icon"><i class="feather-heart"></i></div>
                    <h4>Teachers First</h4>
                    <p>We put teachers at the center of everything we do. Their success is our success.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-green">
                    <div class="hiw-feature-icon"><i class="feather-shield"></i></div>
                    <h4>Trust & Transparency</h4>
                    <p>We believe in honest, transparent processes with verified listings only.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card hiw-feature-purple">
                    <div class="hiw-feature-icon"><i class="feather-trending-up"></i></div>
                    <h4>Continuous Growth</h4>
                    <p>We're always improving to serve the education community better.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card" style="border-top: 4px solid #f97316;">
                    <div class="hiw-feature-icon" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);"><i class="feather-users"></i></div>
                    <h4>Community Building</h4>
                    <p>Creating a supportive network for educators across India.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card" style="border-top: 4px solid #06b6d4;">
                    <div class="hiw-feature-icon" style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);"><i class="feather-award"></i></div>
                    <h4>Excellence</h4>
                    <p>Striving to deliver the best experience for both teachers and schools.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="hiw-feature-card" style="border-top: 4px solid #ec4899;">
                    <div class="hiw-feature-icon" style="background: linear-gradient(135deg, #db2777 0%, #ec4899 100%);"><i class="feather-globe"></i></div>
                    <h4>Pan-India Reach</h4>
                    <p>Connecting talent across all states and cities of India.</p>
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
                    <span class="hiw-stat-number">2015</span>
                    <span class="hiw-stat-label">Founded</span>
                </div>
            </div>
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
                    <span class="hiw-stat-number">600K+</span>
                    <span class="hiw-stat-label">Social Media Followers</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECTION 7: CTA Section --}}
<section class="hiw-cta-section">
    <div class="container">
        <div class="hiw-cta-content">
            <h2>Ready to Join Our Community?</h2>
            <p>Whether you're a teacher looking for opportunities or a school seeking talented educators, we're here to help.</p>
            <div class="hiw-cta-buttons">
                <a href="{{ route('public.account.register') }}" class="hiw-btn-white">Get Started Free</a>
                <a href="/jobs" class="hiw-btn-outline">Browse Jobs</a>
            </div>
        </div>
    </div>
</section>
