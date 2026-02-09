@php
    Theme::layout('without-navbar');
@endphp

<style>
    .jobseeker-register-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f4fc 50%, #dbeafe 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .jobseeker-register-container {
        width: 100%;
        max-width: 800px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .jobseeker-register-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 30px 40px;
        text-align: center;
    }

    .jobseeker-register-header h2 {
        color: #ffffff;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .jobseeker-register-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 16px;
        margin: 0;
    }

    /* Step Wizard Progress */
    .step-wizard {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 25px 40px;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .step-item {
        display: flex;
        align-items: center;
        position: relative;
    }

    .step-item:not(:last-child) {
        margin-right: 60px;
    }

    .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: -40px;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 3px;
        background: #e0e0e0;
        border-radius: 2px;
    }

    .step-item.completed:not(:last-child)::after {
        background: #0073d1;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e0e0e0;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        margin-right: 12px;
        transition: all 0.3s ease;
    }

    .step-item.active .step-number {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 115, 209, 0.4);
    }

    .step-item.completed .step-number {
        background: #10b981;
        color: #fff;
    }

    .step-item.completed .step-number::before {
        content: '\2713';
    }

    .step-item.completed .step-number span {
        display: none;
    }

    .step-label {
        font-weight: 600;
        color: #9ca3af;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .step-item.active .step-label,
    .step-item.completed .step-label {
        color: #434343;
    }

    .jobseeker-register-body {
        padding: 40px;
    }

    .jobseeker-logo {
        text-align: center;
        margin-bottom: 25px;
    }

    .jobseeker-logo a {
        font-size: 26px;
        font-weight: 700;
        color: #434343;
        text-decoration: none;
    }

    .jobseeker-logo a span {
        color: #0073d1;
    }

    .jobseeker-register-body .form-group {
        margin-bottom: 20px;
    }

    .jobseeker-register-body .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 8px;
    }

    .jobseeker-register-body .form-control,
    .jobseeker-register-body .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 15px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .jobseeker-register-body .form-control:focus,
    .jobseeker-register-body .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .jobseeker-register-body .btn-primary,
    .jobseeker-register-body button[type="submit"] {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%) !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 15px 30px !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        width: 100% !important;
        margin-top: 20px !important;
        color: #fff !important;
        transition: all 0.3s ease !important;
    }

    .jobseeker-register-body .btn-primary:hover,
    .jobseeker-register-body button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 115, 209, 0.3);
        background: linear-gradient(135deg, #005bb5 0%, #004a94 100%) !important;
    }

    .jobseeker-register-body .text-center a {
        color: #0073d1;
        font-weight: 600;
    }

    .jobseeker-register-body .text-center a:hover {
        color: #005bb5;
        text-decoration: underline;
    }

    /* Step Navigation Buttons */
    .step-navigation {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .btn-step-prev {
        flex: 1;
        background: #f3f4f6 !important;
        color: #434343 !important;
        border: 2px solid #e0e0e0 !important;
        border-radius: 10px !important;
        padding: 14px 25px !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .btn-step-prev:hover {
        background: #e5e7eb !important;
        border-color: #d1d5db !important;
    }

    .btn-step-next {
        flex: 1;
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 10px !important;
        padding: 14px 25px !important;
        font-size: 15px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .btn-step-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 115, 209, 0.3);
    }

    /* Form Row Styling */
    .jobseeker-register-body .row {
        margin-left: -10px;
        margin-right: -10px;
    }

    .jobseeker-register-body .row > [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }

    /* On-Off Toggle Styling */
    .jobseeker-register-body .form-switch {
        margin-top: 10px;
    }

    /* File Input Styling */
    .jobseeker-register-body input[type="file"] {
        padding: 10px 15px;
    }

    /* Alert Styling */
    .jobseeker-register-body .alert {
        border-radius: 10px;
        margin-bottom: 20px;
    }

    /* Account Type Selection Styling */
    .account-type-selection {
        margin-bottom: 25px;
    }

    .account-type-selection .form-check {
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .account-type-selection .form-check:hover {
        border-color: #0073d1;
        background: #f0f7ff;
    }

    .account-type-selection .form-check-input:checked + .form-check-label {
        color: #0073d1;
    }

    .account-type-selection .form-check:has(.form-check-input:checked) {
        border-color: #0073d1;
        background: #f0f7ff;
    }

    @media (max-width: 768px) {
        .jobseeker-register-container {
            margin: 20px;
            max-width: 100%;
        }

        .jobseeker-register-header {
            padding: 25px 20px;
        }

        .jobseeker-register-body {
            padding: 25px 20px;
        }

        .step-wizard {
            padding: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .step-item:not(:last-child) {
            margin-right: 0;
        }

        .step-item:not(:last-child)::after {
            display: none;
        }

        .step-label {
            display: none;
        }

        .step-navigation {
            flex-direction: column;
        }
    }
</style>

<div class="jobseeker-register-wrapper">
    <div class="jobseeker-register-container">
        <div class="jobseeker-register-header">
            <h2><i class="ti ti-user-plus me-2"></i>{{ __("Job Seeker Registration") }}</h2>
            <p>{{ __('Find your dream teaching job today') }}</p>
        </div>

        <!-- Step Wizard Progress -->
        <div class="step-wizard">
            <div class="step-item active" data-step="1">
                <div class="step-number"><span>1</span></div>
                <div class="step-label">{{ __('Basic Info') }}</div>
            </div>
            <div class="step-item" data-step="2">
                <div class="step-number"><span>2</span></div>
                <div class="step-label">{{ __('Institution') }}</div>
            </div>
            <div class="step-item" data-step="3">
                <div class="step-number"><span>3</span></div>
                <div class="step-label">{{ __('Preferences') }}</div>
            </div>
        </div>
        
        <div class="jobseeker-register-body">
            <div class="jobseeker-logo">
                <a href="{{ BaseHelper::getHomepageUrl() }}">
                    @if (Theme::getLogo())
                        {!! Theme::getLogoImage(['class' => 'logo-dark'], 'logo', 70) !!}
                    @else
                        <span>Teachers</span>Recruiter
                    @endif
                </a>
            </div>

            @if (session()->has('status'))
                <div role="alert" class="alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif (session()->has('auth_error_message'))
                <div role="alert" class="alert alert-danger">
                    {{ session('auth_error_message') }}
                </div>
            @elseif (session()->has('auth_success_message'))
                <div role="alert" class="alert alert-success">
                    {{ session('auth_success_message') }}
                </div>
            @elseif (session()->has('auth_warning_message'))
                <div role="alert" class="alert alert-warning">
                    {{ session('auth_warning_message') }}
                </div>
            @endif

            {!! $form->renderForm() !!}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const form = document.querySelector('form');
    const submitBtn = form?.querySelector('button[type="submit"]');
    
    // Get all step content divs
    const stepContents = document.querySelectorAll('.step-content');
    const stepWizardItems = document.querySelectorAll('.step-wizard .step-item');
    
    // Hide submit button initially (show only on last step)
    if (submitBtn) {
        submitBtn.style.display = 'none';
    }
    
    // Create navigation buttons container
    const navContainer = document.createElement('div');
    navContainer.className = 'step-navigation';
    navContainer.innerHTML = `
        <button type="button" class="btn btn-step-prev" style="display: none;">
            <i class="ti ti-arrow-left me-2"></i>{{ __('Previous') }}
        </button>
        <button type="button" class="btn btn-step-next">
            {{ __('Next') }}<i class="ti ti-arrow-right ms-2"></i>
        </button>
    `;
    
    // Insert navigation after form
    if (form) {
        form.appendChild(navContainer);
    }
    
    const prevBtn = navContainer.querySelector('.btn-step-prev');
    const nextBtn = navContainer.querySelector('.btn-step-next');
    
    function updateStepDisplay() {
        // Update step content visibility
        stepContents.forEach(content => {
            const stepNum = content.getAttribute('data-step');
            if (stepNum == currentStep) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        });
        
        // Update wizard progress
        stepWizardItems.forEach((item, index) => {
            const stepNum = index + 1;
            item.classList.remove('active', 'completed');
            
            if (stepNum < currentStep) {
                item.classList.add('completed');
            } else if (stepNum == currentStep) {
                item.classList.add('active');
            }
        });
        
        // Update navigation buttons
        prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
        
        if (currentStep === totalSteps) {
            nextBtn.style.display = 'none';
            if (submitBtn) {
                submitBtn.style.display = 'block';
            }
        } else {
            nextBtn.style.display = 'block';
            if (submitBtn) {
                submitBtn.style.display = 'none';
            }
        }
    }
    
    function validateCurrentStep() {
        const currentStepContent = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        if (!currentStepContent) return true;
        
        const requiredFields = currentStepContent.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value || field.value.trim() === '') {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        return isValid;
    }
    
    // Next button click
    nextBtn?.addEventListener('click', function() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepDisplay();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    });
    
    // Previous button click
    prevBtn?.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
    
    // Form submission handler
    if (form) {
        form.addEventListener('submit', function(e) {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ti ti-loader me-2"></i>{{ __("Registering...") }}';
            }
        });
    }
    
    // Initialize display
    updateStepDisplay();
});
</script>
