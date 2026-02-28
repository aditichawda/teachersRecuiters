{!! Theme::partial('hiw-styles') !!}

<section class="hiw-process-section" style="background: #ffffff;">
    <div class="container">
        <div class="hiw-section-header">
            <h2 class="hiw-section-title">{!! BaseHelper::clean($shortcode->title ?: 'How It Works') !!}</h2>
        </div>
        
        {{-- Toggle Buttons --}}
        <div class="hiw-toggle-buttons">
            <button class="hiw-toggle-btn active" data-target="educators" onclick="toggleHowItWorksHome('educators', this)">
                For Educators
            </button>
            <button class="hiw-toggle-btn" data-target="institutions" onclick="toggleHowItWorksHome('institutions', this)">
                For Institutions
            </button>
        </div>
        
        {{-- For Educators Content (Default) --}}
        <div id="educators-content-home" class="hiw-content-section active">
            <div class="hiw-content-header">
                <h3 class="hiw-content-title">For Educators</h3>
                <p class="hiw-content-subtitle">Follow the steps and apply for verified school jobs.</p>
            </div>
            <div class="row g-4">
                @php
                    $educatorsTabs = array_slice($tabs, 0, 4);
                    if (count($educatorsTabs) < 4) {
                        // Default content if not enough tabs
                        $educatorsTabs = [
                            ['title' => 'Upload Your Resume', 'subtitle' => 'Sign up, verify your email/mobile, and upload your resume. <strong>100% Free Registration</strong>'],
                            ['title' => 'Search Job & Apply', 'subtitle' => 'Complete your profile, get job suggestions, and apply to unlimited jobs. <strong>No Cost to Apply</strong>'],
                            ['title' => 'Get Noticed by Schools', 'subtitle' => 'Schools can view your profile and contact you directly for opportunities.'],
                            ['title' => 'Interview & Get Hired', 'subtitle' => 'Attend interviews, receive offers, and start your new educator role.'],
                        ];
                    }
                @endphp
                @foreach ($educatorsTabs as $index => $tab)
                    <div class="col-lg-3 col-md-6">
                        <div class="hiw-step-card">
                            <span class="hiw-step-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h4 class="hiw-step-title">{{ Arr::get($tab, 'title') }}</h4>
                            <p class="hiw-step-desc">{!! Arr::get($tab, 'subtitle') !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        {{-- For Institutions Content --}}
        <div id="institutions-content-home" class="hiw-content-section">
            <div class="hiw-content-header">
                <h3 class="hiw-content-title">For Institutions</h3>
                <p class="hiw-content-subtitle">Smart Hiring. Verified Educators. Faster Recruitment.</p>
            </div>
            <div class="row g-4">
                @php
                    $institutionsTabs = array_slice($tabs, 4, 4);
                    if (count($institutionsTabs) < 4) {
                        // Default content if not enough tabs
                        $institutionsTabs = [
                            ['title' => 'Register Your Institution', 'subtitle' => 'Sign up with basic details and verify your email/mobile to activate your account.'],
                            ['title' => 'Post Jobs & Manage Applications', 'subtitle' => 'Publish job openings, receive relevant applications, and track or shortlist candidates from your dashboard.'],
                            ['title' => 'Access Educators Resume', 'subtitle' => 'Search verified teacher profiles using filters like subject, experience, qualification, location, and availability.'],
                            ['title' => 'Interview and Hire Faster', 'subtitle' => 'Connect directly with shortlisted candidates and hire the best talent quickly.'],
                        ];
                    }
                @endphp
                @foreach ($institutionsTabs as $index => $tab)
                    <div class="col-lg-3 col-md-6">
                        <div class="hiw-step-card">
                            <span class="hiw-step-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h4 class="hiw-step-title">{{ Arr::get($tab, 'title') }}</h4>
                            <p class="hiw-step-desc">{!! Arr::get($tab, 'subtitle') !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
function toggleHowItWorksHome(target, element) {
    // Hide all content sections
    document.querySelectorAll('#educators-content-home, #institutions-content-home').forEach(section => {
        section.classList.remove('active');
    });
    
    // Remove active class from all buttons in this section
    const container = element.closest('.hiw-process-section');
    if (container) {
        container.querySelectorAll('.hiw-toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
    }
    
    // Show selected content
    const contentSection = document.getElementById(target + '-content-home');
    if (contentSection) {
        contentSection.classList.add('active');
    }
    
    // Add active class to clicked button
    if (element) {
        element.classList.add('active');
    }
}

// Ensure default view is shown on page load
document.addEventListener('DOMContentLoaded', function() {
    const educatorsContent = document.getElementById('educators-content-home');
    const educatorsBtn = document.querySelector('.hiw-process-section [data-target="educators"]');
    
    if (educatorsContent && educatorsBtn) {
        educatorsContent.classList.add('active');
        educatorsBtn.classList.add('active');
    }
});
</script>