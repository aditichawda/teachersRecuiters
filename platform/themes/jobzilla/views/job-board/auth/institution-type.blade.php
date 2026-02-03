@php
    Theme::layout('without-navbar');
@endphp

@push('header')
<style>
/* Force show institution name field for employer */
#institution_name_field_wrapper.show-fields,
#institution_name_field_wrapper[style*="display: block"],
#institution_name_field_wrapper[style*="display:block"] {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    height: auto !important;
    overflow: visible !important;
}

/* Make sure field is visible when shown */
#institution_name_field_wrapper {
    transition: all 0.3s ease;
}

/* Override any inline styles that might hide it */
body #institution_name_field_wrapper.show-fields {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
</style>
@endpush

<div class="section-full site-bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="twm-log-reg-form-wrap">
                    <div class="twm-log-reg-inner">
                        <div class="twm-log-reg-head text-center mb-4">
                            <div class="twm-log-reg-logo mb-3">
                                @if (Theme::getLogo())
                                    {!! Theme::getLogoImage(['class' => 'logo'], 'logo', 80) !!}
                                @endif
                            </div>
                            <h2 class="log-reg-form-title mb-2">{{ __('Select Institution Type') }}</h2>
                            <p class="text-muted mb-0">
                                {{ __('Please select the type of institution you are associated with.') }}
                            </p>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <form id="institution-type-form" onsubmit="return false;">
                                    @csrf
                                    
                                    <!-- Hidden email field -->
                                    <input type="hidden" name="email" id="institution_email" value="" />
                                    
                                    <!-- Institution Name Field - For Employer Only (SHOWN FIRST/ABOVE) -->
                                    <div id="institution_name_field_wrapper" class="mb-4" style="display:content !important;">
                                        <label for="institution_name" class="form-label fw-semibold mb-2">
                                            {{ __('Institution Name') }} <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            name="institution_name" 
                                            id="institution_name" 
                                            class="form-control form-control-lg"
                                            placeholder="{{ __('Enter your institution full name') }}"
                                            required
                                        />
                                        <small class="text-muted d-block mt-1">
                                            {{ __('Please enter the complete name of your institution') }}
                                        </small>
                                        <div id="institution_name_error" class="invalid-feedback d-block" style="display:none;"></div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="institution_type" class="form-label fw-semibold mb-3">
                                            {{ __('Institution Type') }} <span class="text-danger">*</span>
                                        </label>
                                        
                                        <select 
                                            name="institution_type" 
                                            id="institution_type" 
                                            class="form-select form-select-lg"
                                            required
                                        >
                                            <option value="">{{ __('Select Institution Type') }}</option>
                                            <optgroup label="SCHOOL">
                                                <option value="school" data-subtype="cbse-school">CBSE School</option>
                                                <option value="school" data-subtype="icse-school">ICSE School</option>
                                                <option value="school" data-subtype="cambridge-school">Cambridge School</option>
                                                <option value="school" data-subtype="ib-school">IB School</option>
                                                <option value="school" data-subtype="igcse-school">IGCSE School</option>
                                                <option value="school" data-subtype="primary-school">Primary School</option>
                                                <option value="school" data-subtype="play-school">Play School</option>
                                                <option value="school" data-subtype="pre-school">Pre School</option>
                                                <option value="school" data-subtype="state-board-school">State Board School</option>
                                            </optgroup>
                                            <optgroup label="EDTECH COMPANY">
                                                <option value="edtech-company">Edtech Company</option>
                                            </optgroup>
                                            <optgroup label="ONLINE EDUCATION PLATFORM">
                                                <option value="online-education-platform">Online Education Platform</option>
                                            </optgroup>
                                            <optgroup label="COACHING INSTITUTES">
                                                <option value="coaching-institute" data-subtype="animation-institute">Animation Institute</option>
                                                <option value="coaching-institute" data-subtype="civil-services-institute">Civil Services Institute</option>
                                                <option value="coaching-institute" data-subtype="banking-institute">Banking Institute</option>
                                                <option value="coaching-institute" data-subtype="design-institute">Design Institute</option>
                                                <option value="coaching-institute" data-subtype="english-learning-institute">English Learning Institute</option>
                                                <option value="coaching-institute" data-subtype="foreign-language-institute">Foreign Language Institute</option>
                                                <option value="coaching-institute" data-subtype="it-training-institute">IT Training Institute</option>
                                                <option value="coaching-institute" data-subtype="jee-neet-institute">JEE and NEET Institute</option>
                                                <option value="coaching-institute" data-subtype="music-institute">Music Institute</option>
                                                <option value="coaching-institute" data-subtype="nda-institute">NDA Institute</option>
                                                <option value="coaching-institute" data-subtype="vocational-training-institute">Vocational Training Institute</option>
                                                <option value="coaching-institute" data-subtype="private-institute">Private Institute</option>
                                            </optgroup>
                                            <optgroup label="COLLEGE">
                                                <option value="college" data-subtype="agriculture-college">Agriculture College</option>
                                                <option value="college" data-subtype="engineering-college">Engineering College</option>
                                                <option value="college" data-subtype="medical-college">Medical College</option>
                                                <option value="college" data-subtype="nursing-college">Nursing College</option>
                                                <option value="college" data-subtype="pharmacy-college">Pharmacy College</option>
                                                <option value="college" data-subtype="science-college">Science College</option>
                                                <option value="college" data-subtype="management-college">Management College</option>
                                                <option value="college" data-subtype="degree-college">Degree College</option>
                                            </optgroup>
                                            <optgroup label="NON-PROFIT ORGANIZATION">
                                                <option value="non-profit-organization">Non-Profit Organization</option>
                                            </optgroup>
                                            <optgroup label="ACADEMIES">
                                                <option value="academy" data-subtype="sport-academy">Sport Academy</option>
                                                <option value="academy" data-subtype="music-academy">Music Academy</option>
                                                <option value="academy" data-subtype="distance-learning-academy">Distance Learning Academy</option>
                                            </optgroup>
                                            <optgroup label="UNIVERSITY">
                                                <option value="university">University</option>
                                            </optgroup>
                                        </select>
                                        
                                        <div id="institution_type_error" class="invalid-feedback d-block" style="display:none;"></div>
                                    </div>

                                    <!-- Employer Additional Fields -->
                                    <div id="employer-additional-fields" style="display:none;" class="employer-fields-container">

                                        <!-- Location Input -->
                                        <div class="mb-4">
                                            <label for="employer_location" class="form-label fw-semibold mb-2">
                                                {{ __('Location') }}
                                            </label>
                                            <input 
                                                type="text" 
                                                name="employer_location" 
                                                id="employer_location" 
                                                class="form-control form-control-lg"
                                                placeholder="{{ __('Enter location') }}"
                                            />
                                            <div id="employer_location_error" class="invalid-feedback d-block" style="display:none;"></div>
                                        </div>

                                        @if (is_plugin_active('location'))
                                            <!-- Country -->
                                            <div class="mb-4">
                                                <label for="employer_country_id" class="form-label fw-semibold mb-2">
                                                    {{ __('Country') }}
                                                </label>
                                                <select 
                                                    name="employer_country_id" 
                                                    id="employer_country_id" 
                                                    class="form-select form-select-lg"
                                                >
                                                    <option value="">{{ __('Select Country') }}</option>
                                                    @php
                                                        try {
                                                            $countries = \Botble\Location\Models\Country::query()
                                                                ->where('status', 'published')
                                                                ->orderBy('order')
                                                                ->orderBy('name')
                                                                ->get();
                                                            
                                                            if ($countries->isEmpty()) {
                                                                $countries = \Botble\Location\Models\Country::query()
                                                                    ->orderBy('order')
                                                                    ->orderBy('name')
                                                                    ->get();
                                                            }
                                                        } catch (\Exception $e) {
                                                            $countries = collect([]);
                                                        }
                                                    @endphp
                                                    @if($countries && $countries->count() > 0)
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <div id="employer_country_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                            </div>

                                            <!-- State -->
                                            <div class="mb-4">
                                                <label for="employer_state_id" class="form-label fw-semibold mb-2">
                                                    {{ __('State') }}
                                                </label>
                                                <select 
                                                    name="employer_state_id" 
                                                    id="employer_state_id" 
                                                    class="form-select form-select-lg"
                                                    disabled
                                                >
                                                    <option value="">{{ __('Select State') }}</option>
                                                </select>
                                                <div id="employer_state_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                            </div>

                                            <!-- City -->
                                            <div class="mb-4">
                                                <label for="employer_city_id" class="form-label fw-semibold mb-2">
                                                    {{ __('City') }}
                                                </label>
                                                <select 
                                                    name="employer_city_id" 
                                                    id="employer_city_id" 
                                                    class="form-select form-select-lg"
                                                    disabled
                                                >
                                                    <option value="">{{ __('Select City') }}</option>
                                                </select>
                                                <div id="employer_city_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <a href="{{ route('public.account.register') }}" class="btn btn-outline-secondary">
                                            <i class="ti ti-arrow-left me-1"></i> {{ __('Back') }}
                                        </a>
                                        <button type="button" class="site-button" id="continue-btn" onclick="handleContinueButtonClick(event); return false;">
                                            {{ __('Continue') }} <i class="ti ti-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Immediate inline script test -->
<script>
console.log('=== IMMEDIATE SCRIPT TEST ===');
console.log('This should show immediately when page loads');
console.log('Time:', new Date().toISOString());
console.log('Page URL:', window.location.href);

// Test if console is working
if (typeof console !== 'undefined') {
    console.log('✅ Console is available');
} else {
    alert('Console is not available!');
}

// IMMEDIATE: Check for employer and show fields - Multiple attempts
(function() {
    function showEmployerFields() {
        let accountType = null;
        
        // Check localStorage
        if (typeof Storage !== 'undefined') {
            const savedData = localStorage.getItem('registrationFormData');
            if (savedData) {
                try {
                    const formData = JSON.parse(savedData);
                    accountType = formData.account_type;
                    console.log('=== IMMEDIATE EMPLOYER CHECK ===');
                    console.log('Account type from localStorage:', accountType);
                } catch (e) {
                    console.error('Error parsing localStorage:', e);
                }
            }
        }
        
        if (accountType === 'employer') {
            console.log('=== EMPLOYER DETECTED - SHOWING FIELDS ===');
            
            // Show Institution Name field wrapper (MOST IMPORTANT)
            const nameFieldWrapper = document.getElementById('institution_name_field_wrapper');
            console.log('Institution Name wrapper found?', nameFieldWrapper !== null);
            
            if (nameFieldWrapper) {
                // Force show with multiple methods
                nameFieldWrapper.removeAttribute('style');
                nameFieldWrapper.setAttribute('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                nameFieldWrapper.style.setProperty('display', 'block', 'important');
                nameFieldWrapper.style.setProperty('visibility', 'visible', 'important');
                nameFieldWrapper.style.setProperty('opacity', '1', 'important');
                nameFieldWrapper.classList.add('show-fields');
                console.log('✅✅✅ INSTITUTION NAME FIELD SHOWN ✅✅✅');
                console.log('Field display:', nameFieldWrapper.style.display);
                console.log('Field computed display:', window.getComputedStyle(nameFieldWrapper).display);
            } else {
                console.error('❌ Institution Name wrapper NOT FOUND in DOM!');
                console.error('Trying to find all elements with id containing institution_name...');
                const allElements = document.querySelectorAll('[id*="institution_name"]');
                console.log('Found elements:', allElements);
            }
            
            const fieldsDiv = document.getElementById('employer-additional-fields');
            const nameField = document.getElementById('institution_name');
            
            console.log('Fields div found?', fieldsDiv !== null);
            console.log('Name field found?', nameField !== null);
            
            if (fieldsDiv) {
                fieldsDiv.style.display = 'block';
                fieldsDiv.style.visibility = 'visible';
                console.log('✅ Additional fields div shown');
            }
            
            if (nameField) {
                nameField.required = true;
                console.log('✅ Name field required set');
            }
            
            // Also try jQuery if available
            if (typeof jQuery !== 'undefined') {
                const $wrapper = jQuery('#institution_name_field_wrapper');
                if ($wrapper.length) {
                    $wrapper.show();
                    $wrapper.css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                    $wrapper.attr('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                    $wrapper.addClass('show-fields');
                    console.log('✅ Institution Name field shown (jQuery - immediate check)');
                    console.log('Field is visible?', $wrapper.is(':visible'));
                    console.log('Field height:', $wrapper.height());
                } else {
                    console.error('❌ jQuery: Institution Name wrapper NOT FOUND in immediate check!');
                }
                
                jQuery('#employer-additional-fields').show().css('display', 'block');
                jQuery('#institution_name').prop('required', true);
                console.log('✅✅✅ EMPLOYER FIELDS SHOWN (jQuery) ✅✅✅');
            } else {
                console.log('✅✅✅ EMPLOYER FIELDS SHOWN (Vanilla JS) ✅✅✅');
            }
        } else {
            console.log('Not employer, account type:', accountType);
            // Only hide if accountType is explicitly not 'employer' (not null/undefined)
            if (accountType !== null && accountType !== undefined && accountType !== 'employer') {
                const nameFieldWrapper = document.getElementById('institution_name_field_wrapper');
                if (nameFieldWrapper) {
                    nameFieldWrapper.style.display = 'none';
                }
            } else {
                console.log('Account type is null/undefined - keeping field hidden for now');
            }
        }
    }
    
    // Try immediately
    showEmployerFields();
    
    // Try after DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', showEmployerFields);
    }
    
    // Try after a delay (in case elements load late)
    setTimeout(showEmployerFields, 200);
    setTimeout(showEmployerFields, 500);
    setTimeout(showEmployerFields, 1000);
})();

// Global function for Continue button click
window.handleContinueButtonClick = function(e) {
    console.log('========================================');
    console.log('=== CONTINUE BUTTON CLICKED (GLOBAL FUNCTION) ===');
    console.log('========================================');
    console.log('🎯🎯🎯 BUTTON CLICK DETECTED! 🎯🎯🎯');
    console.log('✅✅✅ Continue button click ho gaya hai! ✅✅✅');
    console.log('Click time:', new Date().toISOString());
    
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Get form values
    const institutionType = document.getElementById('institution_type')?.value;
    let email = document.getElementById('institution_email')?.value;
    
    console.log('=== GETTING FORM VALUES ===');
    console.log('Institution Type:', institutionType);
    console.log('Email from hidden field:', email);
    console.log('Email element exists?', document.getElementById('institution_email') !== null);
    
        // Validation
        if (!institutionType) {
            console.error('❌ Validation failed: Institution type is empty');
            alert('Please select an institution type');
            return false;
        }
        
        // Check if employer fields are visible and validate institution_name
        const employerFieldsVisible = $('#employer-additional-fields').is(':visible');
        if (employerFieldsVisible) {
            const institutionName = $('#institution_name').val()?.trim();
            if (!institutionName) {
                console.error('❌ Validation failed: Institution name is required for employer');
                alert('Please enter institution name');
                $('#institution_name').focus();
                return false;
            }
        }
    
    // If email is not found, try to load it from API
    if (!email) {
        console.log('⚠️ Email not found in hidden field, loading from API...');
        const getEmailUrl = '{{ route('public.account.register.getVerificationData') }}';
        
        fetch(getEmailUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Email API Response:', data);
            if (data.data && data.data.email) {
                email = data.data.email;
                document.getElementById('institution_email').value = email;
                console.log('✅ Email loaded from API:', email);
                // Now process with the loaded email
                processInstitutionTypeSave(institutionType, email);
            } else {
                console.error('❌ Email not found in API response');
                console.error('Response data:', data);
                alert('Email not found. Please go back to registration.');
            }
        })
        .catch(error => {
            console.error('❌ Failed to load email:', error);
            alert('Email not found. Please go back to registration.');
        });
        
        return false;
    }
    
    // If email is found, process directly
    processInstitutionTypeSave(institutionType, email);
    return false;
}

// Separate function to process the save
function processInstitutionTypeSave(institutionType, email) {
    console.log('=== PROCESSING INSTITUTION TYPE SAVE ===');
    console.log('Institution Type:', institutionType);
    console.log('Email:', email);
    
    // Get button and show loading
    const btn = document.getElementById('continue-btn');
    const originalText = btn.innerHTML;
    btn.innerHTML = 'Saving...';
    console.log('✅ Button text changed to "Saving..."');
    
    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]')?.value;
    console.log('CSRF Token:', csrfToken ? '✅ Found' : '❌ Not found');
    
    if (!csrfToken) {
        console.error('❌ CSRF token not found!');
        alert('Security token missing. Please refresh the page.');
        btn.innerHTML = originalText;
        return false;
    }
    
    // Check if employer fields are visible
    const employerFieldsVisible = $('#employer-additional-fields').is(':visible');
    console.log('Employer fields visible:', employerFieldsVisible);
    
    // Prepare API request
    console.log('========================================');
    console.log('=== SAVING INSTITUTION TYPE TO DATABASE ===');
    console.log('========================================');
    const apiUrl = '{{ route('public.account.register.saveInstitutionType') }}';
    console.log('API URL:', apiUrl);
    
    const requestData = {
        email: email,
        institution_type: institutionType
    };
    
    // ALWAYS check for institution_name field (regardless of visibility)
    const institutionNameField = document.getElementById('institution_name');
    const institutionNameFieldVisible = $('#institution_name_field_wrapper').is(':visible');
    
    console.log('========================================');
    console.log('=== CHECKING INSTITUTION NAME FIELD ===');
    console.log('========================================');
    console.log('🔍 Institution Name field element exists?', institutionNameField !== null);
    console.log('👁️ Institution Name field visible?', institutionNameFieldVisible);
    
    // Get institution_name value using multiple methods
    let institutionName = '';
    if (institutionNameField) {
        institutionName = institutionNameField.value?.trim() || '';
        console.log('📝 Institution Name value (Vanilla JS):', institutionName);
    }
    
    // Also try jQuery
    const jqInstitutionName = $('#institution_name').val()?.trim() || '';
    console.log('📝 Institution Name value (jQuery):', jqInstitutionName);
    
    // Use whichever has value
    const finalInstitutionName = institutionName || jqInstitutionName;
    console.log('📝📝📝 FINAL Institution Name:', finalInstitutionName || '❌ EMPTY');
    console.log('📝📝📝 FINAL Institution Name Length:', finalInstitutionName ? finalInstitutionName.length : 0);
    console.log('========================================');
    
    // ALWAYS add institution_name if it has a value (regardless of visibility)
    if (finalInstitutionName && finalInstitutionName.length > 0) {
        requestData.institution_name = finalInstitutionName;
        console.log('✅✅✅ Institution Name added to request:', finalInstitutionName);
    } else {
        console.warn('⚠️ Institution Name is EMPTY - will not be saved');
    }
    
    // Add other employer fields if visible
    if (employerFieldsVisible) {
        requestData.location = $('#employer_location').val() || '';
        requestData.country_id = $('#employer_country_id').val() || '';
        requestData.state_id = $('#employer_state_id').val() || '';
        requestData.city_id = $('#employer_city_id').val() || '';
        
        console.log('=== EMPLOYER FIELDS COLLECTED ===');
        console.log('Location:', requestData.location);
        console.log('Country ID:', requestData.country_id);
        console.log('State ID:', requestData.state_id);
        console.log('City ID:', requestData.city_id);
    }
    
    console.log('========================================');
    console.log('=== DATA TO BE SAVED TO DATABASE ===');
    console.log('========================================');
    console.log('📧 Email:', email);
    console.log('🏢 Institution Type:', institutionType);
    console.log('📝📝📝 INSTITUTION NAME:', requestData.institution_name || '❌ NOT PROVIDED ❌');
    console.log('📝📝📝 INSTITUTION NAME LENGTH:', requestData.institution_name ? requestData.institution_name.length : 0);
    console.log('📍 Location:', requestData.location || 'Not provided');
    console.log('🌍 Country ID:', requestData.country_id || 'Not provided');
    console.log('🗺️ State ID:', requestData.state_id || 'Not provided');
    console.log('🏙️ City ID:', requestData.city_id || 'Not provided');
    console.log('========================================');
    console.log('📦 Full Request Data Object:');
    console.log(JSON.stringify(requestData, null, 2));
    console.log('📦 Request Data (raw):');
    console.log(requestData);
    console.log('========================================');
    console.log('💾 Saving to database now...');
    console.log('========================================');
    
    // Make API call
    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        console.log('=== API RESPONSE RECEIVED ===');
        console.log('Response Status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('========================================');
        console.log('=== DATABASE SAVE RESPONSE ===');
        console.log('========================================');
        console.log('Full Response:', data);
        console.log('Institution type stored?', data.error === false ? '✅ YES' : '❌ NO');
        
        if (data.error === false) {
            console.log('========================================');
            console.log('✅✅✅ INSTITUTION TYPE SAVED TO DATABASE ✅✅✅');
            console.log('========================================');
            console.log('Saved Email:', email);
            console.log('Saved Institution Type:', institutionType);
            console.log('Database Update: SUCCESS');
            console.log('========================================');
            // Check if employer - if yes, skip location page and go to dashboard
            const isEmployer = employerFieldsVisible;
            if (isEmployer) {
                console.log('=== EMPLOYER DETECTED - REDIRECTING TO DASHBOARD ===');
                const dashboardUrl = '{{ route('public.account.dashboard') }}';
                console.log('Dashboard URL:', dashboardUrl);
                
                setTimeout(function() {
                    console.log('🚀 Redirecting to dashboard...');
                    window.location.href = dashboardUrl;
                }, 500);
            } else {
                console.log('=== REDIRECTING TO LOCATION PAGE ===');
                const locationUrl = '{{ route('public.account.register.locationPage') }}';
                console.log('Redirect URL:', locationUrl);
                
                setTimeout(function() {
                    console.log('🚀 Redirecting now...');
                    window.location.href = locationUrl;
                }, 500);
            }
        } else {
            console.error('========================================');
            console.error('❌❌❌ DATABASE SAVE FAILED ❌❌❌');
            console.error('Error Message:', data.message);
            alert(data.message || 'Failed to save institution type');
            btn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('========================================');
        console.error('=== API CALL FAILED ===');
        console.error('Error:', error);
        alert('Error: ' + error.message);
        btn.innerHTML = originalText;
    });
    
    return false;
};

// Test dropdown immediately and check institution name field
window.addEventListener('load', function() {
    console.log('=== PAGE FULLY LOADED ===');
    const dropdown = document.getElementById('institution_type');
    console.log('Dropdown found?', dropdown !== null);
    
    // Check institution name field
    const nameFieldWrapper = document.getElementById('institution_name_field_wrapper');
    const nameField = document.getElementById('institution_name');
    console.log('=== INSTITUTION NAME FIELD CHECK ===');
    console.log('Institution Name wrapper found?', nameFieldWrapper !== null);
    console.log('Institution Name input found?', nameField !== null);
    
    if (nameFieldWrapper) {
        console.log('Wrapper element:', nameFieldWrapper);
        console.log('Wrapper display style:', nameFieldWrapper.style.display);
        console.log('Wrapper computed display:', window.getComputedStyle(nameFieldWrapper).display);
    }
    
    // Final check for employer and force show if needed
    if (typeof Storage !== 'undefined') {
        const savedData = localStorage.getItem('registrationFormData');
        if (savedData) {
            try {
                const formData = JSON.parse(savedData);
                const accountType = formData.account_type;
                console.log('Final check - Account type:', accountType);
                
                if (accountType === 'employer' && nameFieldWrapper) {
                    console.log('=== FORCE SHOWING INSTITUTION NAME FIELD (FINAL CHECK) ===');
                    nameFieldWrapper.removeAttribute('style');
                    nameFieldWrapper.setAttribute('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                    nameFieldWrapper.style.setProperty('display', 'block', 'important');
                    nameFieldWrapper.style.setProperty('visibility', 'visible', 'important');
                    
                    if (typeof jQuery !== 'undefined') {
                        jQuery(nameFieldWrapper).show().css({
                            'display': 'block',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }
                    console.log('✅✅✅ FIELD FORCE SHOWN ✅✅✅');
                }
            } catch (e) {
                console.error('Error in final check:', e);
            }
        }
    }
    
    if (dropdown) {
        console.log('✅ Dropdown element found');
        // Add immediate change listener
        dropdown.onchange = function() {
            console.log('=== DROPDOWN CHANGED (IMMEDIATE) ===');
            console.log('Selected Value:', this.value);
            console.log('Selected Text:', this.options[this.selectedIndex].text);
        };
        console.log('✅ Immediate dropdown listener attached');
    }
    
    // Add global function to manually show field (for testing)
    window.showInstitutionNameField = function() {
        const wrapper = document.getElementById('institution_name_field_wrapper');
        if (wrapper) {
            wrapper.style.display = 'block';
            wrapper.style.visibility = 'visible';
            wrapper.style.opacity = '1';
            if (typeof jQuery !== 'undefined') {
                jQuery(wrapper).show();
            }
            console.log('✅ Institution Name field manually shown');
            return true;
        } else {
            console.error('❌ Institution Name wrapper not found');
            return false;
        }
    };
    console.log('✅ Manual show function available: window.showInstitutionNameField()');
});
</script>

@push('footer')
<script>
// ============================================
// STEP 1: Script Loading
// ============================================
console.log('=== FOOTER SCRIPT STARTED ===');
console.log('Time:', new Date().toISOString());
console.log('Page URL:', window.location.href);

// Test if script is in footer
console.log('✅ Footer script is loading');

// ============================================
// STEP 2: Wait for DOM to Load
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DOM CONTENT LOADED ===');
    console.log('All HTML elements are now available');
    
    // ============================================
    // STEP 2.5: Immediate Employer Check from localStorage
    // ============================================
    console.log('=== CHECKING FOR EMPLOYER IN LOCALSTORAGE ===');
    if (typeof Storage !== 'undefined') {
        const savedData = localStorage.getItem('registrationFormData');
        if (savedData) {
            try {
                const formData = JSON.parse(savedData);
                const accountType = formData.account_type;
                console.log('Account type from localStorage (immediate):', accountType);
                
                if (accountType === 'employer') {
                    // Show Institution Name field first (most important)
                    const nameFieldWrapper = document.getElementById('institution_name_field_wrapper');
                    if (nameFieldWrapper) {
                        // Force show with multiple methods
                        nameFieldWrapper.removeAttribute('style');
                        nameFieldWrapper.setAttribute('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                        nameFieldWrapper.style.setProperty('display', 'block', 'important');
                        nameFieldWrapper.style.setProperty('visibility', 'visible', 'important');
                        nameFieldWrapper.style.setProperty('opacity', '1', 'important');
                        nameFieldWrapper.classList.add('show-fields');
                        console.log('✅ Institution Name field shown (vanilla JS - aggressive)');
                        console.log('Field display:', nameFieldWrapper.style.display);
                        console.log('Field computed display:', window.getComputedStyle(nameFieldWrapper).display);
                    } else {
                        console.error('❌ Institution Name wrapper NOT FOUND in DOM!');
                    }
                    
                    // Force show with vanilla JS first
                    const fieldsDiv = document.getElementById('employer-additional-fields');
                    if (fieldsDiv) {
                        fieldsDiv.style.display = 'block';
                        fieldsDiv.style.visibility = 'visible';
                        fieldsDiv.classList.add('show-fields');
                        console.log('✅ Fields div shown (vanilla JS)');
                    }
                    
                    // Then use jQuery - More aggressive
                    if (typeof jQuery !== 'undefined') {
                        const $wrapper = jQuery('#institution_name_field_wrapper');
                        if ($wrapper.length) {
                            $wrapper.show();
                            $wrapper.css({
                                'display': 'block',
                                'visibility': 'visible',
                                'opacity': '1'
                            });
                            $wrapper.attr('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                            $wrapper.addClass('show-fields');
                            console.log('✅ Institution Name field shown (jQuery - aggressive)');
                            console.log('Field is visible?', $wrapper.is(':visible'));
                            console.log('Field height:', $wrapper.height());
                        } else {
                            console.error('❌ jQuery: Institution Name wrapper NOT FOUND!');
                        }
                        
                        jQuery('#employer-additional-fields').show().addClass('show-fields').css({
                            'display': 'block !important',
                            'visibility': 'visible'
                        });
                        jQuery('#institution_name').prop('required', true);
                    }
                    
                    console.log('✅✅✅ EMPLOYER DETECTED IMMEDIATELY - FIELDS SHOWN ✅✅✅');
                    console.log('Institution Name field visible?', nameFieldWrapper ? nameFieldWrapper.style.display : 'div not found');
                    console.log('Fields visible?', fieldsDiv ? fieldsDiv.style.display : 'div not found');
                }
            } catch (e) {
                console.error('Error parsing localStorage:', e);
            }
        }
    }
    
    // ============================================
    // STEP 3: Load Email from Session/API
    // ============================================
    console.log('=== LOADING EMAIL ===');
    const getEmailUrl = '{{ route('public.account.register.getVerificationData') }}';
    console.log('Email API URL:', getEmailUrl);
    
    fetch(getEmailUrl, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Email API Response:', data);
        if (data.data && data.data.email) {
            document.getElementById('institution_email').value = data.data.email;
            console.log('✅ Email loaded successfully:', data.data.email);
        } else {
            console.error('❌ Email not found in response');
        }
        
        // Check if account type is employer - Multiple sources
        let accountType = null;
        
        if (data.data && data.data.temp_account) {
            accountType = data.data.temp_account.type;
            console.log('Account type from temp_account:', accountType);
        }
        
        if (!accountType && data.data && data.data.form_data) {
            accountType = data.data.form_data.account_type;
            console.log('Account type from form_data:', accountType);
        }
        
        // Also check localStorage for account_type
        if (!accountType && typeof Storage !== 'undefined') {
            const savedData = localStorage.getItem('registrationFormData');
            if (savedData) {
                try {
                    const formData = JSON.parse(savedData);
                    accountType = formData.account_type;
                    console.log('Account type from localStorage:', accountType);
                } catch (e) {
                    console.error('Error parsing localStorage:', e);
                }
            }
        }
        
        console.log('=== FINAL ACCOUNT TYPE DETECTED ===', accountType);
        
        if (accountType === 'employer') {
            console.log('=== EMPLOYER DETECTED FROM API - SHOWING FIELDS ===');
            
            // Show Institution Name field first (most important) - AGGRESSIVE
            const nameFieldWrapper = document.getElementById('institution_name_field_wrapper');
            if (nameFieldWrapper) {
                // Remove inline style completely and set with !important
                nameFieldWrapper.removeAttribute('style');
                nameFieldWrapper.setAttribute('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                nameFieldWrapper.style.setProperty('display', 'block', 'important');
                nameFieldWrapper.style.setProperty('visibility', 'visible', 'important');
                nameFieldWrapper.style.setProperty('opacity', '1', 'important');
                nameFieldWrapper.classList.add('show-fields');
                console.log('✅ Institution Name field shown (vanilla JS - aggressive)');
                console.log('Field display:', nameFieldWrapper.style.display);
                console.log('Field computed display:', window.getComputedStyle(nameFieldWrapper).display);
            } else {
                console.error('❌ Institution Name wrapper NOT FOUND!');
            }
            
            // Force show with multiple methods
            const fieldsDiv = document.getElementById('employer-additional-fields');
            if (fieldsDiv) {
                fieldsDiv.style.display = 'block';
                fieldsDiv.style.visibility = 'visible';
                console.log('✅ Fields div shown (vanilla JS)');
            }
            
            // jQuery method - AGGRESSIVE
            if (typeof jQuery !== 'undefined') {
                const $wrapper = jQuery('#institution_name_field_wrapper');
                if ($wrapper.length) {
                    $wrapper.show();
                    $wrapper.css({
                        'display': 'block',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                    $wrapper.attr('style', 'display: block !important; visibility: visible !important; opacity: 1 !important;');
                    $wrapper.addClass('show-fields');
                    console.log('✅ Institution Name field shown (jQuery - aggressive)');
                    console.log('Field is visible?', $wrapper.is(':visible'));
                    console.log('Field height:', $wrapper.height());
                }
                
                jQuery('#employer-additional-fields').show().css({
                    'display': 'block !important',
                    'visibility': 'visible'
                });
                jQuery('#institution_name').prop('required', true);
            }
            
            console.log('✅✅✅ EMPLOYER DETECTED - FIELDS SHOWN ✅✅✅');
            console.log('Institution Name field visible?', nameFieldWrapper ? window.getComputedStyle(nameFieldWrapper).display : 'div not found');
            console.log('Fields div visible?', fieldsDiv ? fieldsDiv.style.display : 'div not found');
        } else {
            // Only hide if accountType is explicitly not 'employer'
            if (accountType !== null && accountType !== undefined && accountType !== 'employer') {
                $('#institution_name_field_wrapper').hide();
                $('#employer-additional-fields').hide();
                $('#institution_name').prop('required', false);
                console.log('✅ Employer fields hidden (job-seeker)');
            } else {
                console.log('⚠️ Account type is null/undefined - keeping fields hidden for now');
            }
        }
    })
    .catch(error => {
        console.error('❌ Failed to load email:', error);
    });
    
    // Setup employer country/state/city dropdowns
    $(document).on('change', '#employer_country_id', function() {
        const countryId = $(this).val();
        console.log('Employer Country selected:', countryId);
        
        if (countryId) {
            $('#employer_state_id').prop('disabled', false).html('<option value="">Loading...</option>');
            
            $.ajax({
                url: '{{ route('ajax.states-by-country') }}',
                type: 'GET',
                data: { country_id: countryId },
                success: function(response) {
                    let options = '<option value="">{{ __('Select State') }}</option>';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(state) {
                            options += '<option value="' + state.id + '">' + state.name + '</option>';
                        });
                    }
                    $('#employer_state_id').html(options);
                    $('#employer_city_id').prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
                },
                error: function() {
                    $('#employer_state_id').html('<option value="">{{ __('Error loading states') }}</option>');
                }
            });
        } else {
            $('#employer_state_id').prop('disabled', true).html('<option value="">{{ __('Select State') }}</option>');
            $('#employer_city_id').prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
        }
    });
    
    $(document).on('change', '#employer_state_id', function() {
        const stateId = $(this).val();
        const countryId = $('#employer_country_id').val();
        console.log('Employer State selected:', stateId);
        
        if (stateId && countryId) {
            $('#employer_city_id').prop('disabled', false).html('<option value="">Loading...</option>');
            
            $.ajax({
                url: '{{ route('ajax.cities-by-state') }}',
                type: 'GET',
                data: { state_id: stateId, country_id: countryId },
                success: function(response) {
                    let options = '<option value="">{{ __('Select City') }}</option>';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(city) {
                            options += '<option value="' + city.id + '">' + city.name + '</option>';
                        });
                    }
                    $('#employer_city_id').html(options);
                },
                error: function() {
                    $('#employer_city_id').html('<option value="">{{ __('Error loading cities') }}</option>');
                }
            });
        } else {
            $('#employer_city_id').prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
        }
    });
    
    // ============================================
    // STEP 3.5: Add Dropdown Change Listener & Save to Database
    // ============================================
    console.log('=== SETTING UP DROPDOWN LISTENER ===');
    const institutionTypeDropdown = document.getElementById('institution_type');
    
    if (institutionTypeDropdown) {
        console.log('✅ Institution type dropdown found');
        
        institutionTypeDropdown.addEventListener('change', function(e) {
            console.log('========================================');
            console.log('=== DROPDOWN OPTION SELECTED ===');
            console.log('========================================');
            
            const selectedValue = this.value;
            const selectedOption = this.options[this.selectedIndex];
            const selectedText = selectedOption.text;
            
            console.log('Selected Value:', selectedValue);
            console.log('Selected Text:', selectedText);
            console.log('Selected Index:', this.selectedIndex);
            console.log('Option Data Attributes:', selectedOption.dataset);
            
            // Get all option details
            console.log('Option Details:', {
                value: selectedOption.value,
                text: selectedOption.text,
                label: selectedOption.label || 'No label',
                dataSubtype: selectedOption.dataset.subtype || 'No subtype',
                optgroup: selectedOption.parentElement.label || 'No group'
            });
            
            // Print in a readable format
            console.log('📋 SELECTED OPTION SUMMARY:');
            console.log('   Value:', selectedValue);
            console.log('   Text:', selectedText);
            console.log('   Group:', selectedOption.parentElement.label || 'No group');
            console.log('   Subtype:', selectedOption.dataset.subtype || 'No subtype');
            console.log('ℹ️ Note: Will be saved to database when Continue button is clicked');
        });
        
        console.log('✅ Dropdown change listener attached');
        console.log('ℹ️ Institution type will be saved when Continue button is clicked');
    } else {
        console.error('❌ Institution type dropdown NOT found!');
    }
    
    // ============================================
    // STEP 4: Find Continue Button
    // ============================================
    console.log('=== FINDING CONTINUE BUTTON ===');
    const continueBtn = document.getElementById('continue-btn');
    console.log('Button element:', continueBtn);
    console.log('Button found?', continueBtn !== null);
    
    if (!continueBtn) {
        console.error('❌ Continue button NOT FOUND!');
        return;
    }
    
    console.log('✅ Continue button FOUND');
    console.log('Button type:', continueBtn.type);
    console.log('Button disabled?', continueBtn.disabled);
    
    // Force enable button
    continueBtn.disabled = false;
    console.log('✅ Continue button force enabled');
    
    // ============================================
    // STEP 5: Attach Click Event Handler
    // ============================================
    console.log('=== ATTACHING CLICK HANDLER ===');
    
    // Remove any existing listeners by cloning
    const newBtn = continueBtn.cloneNode(true);
    continueBtn.parentNode.replaceChild(newBtn, continueBtn);
    console.log('✅ Button cloned to remove old listeners');
    
    // Attach onclick handler (direct method)
    newBtn.onclick = function(e) {
        console.log('🔥🔥🔥 DIRECT ONCLICK HANDLER FIRED 🔥🔥🔥');
        e = e || window.event;
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        // Will be handled by addEventListener below
    };
    
    // Attach addEventListener handler (modern method)
    newBtn.addEventListener('click', function(e) {
        console.log('========================================');
        console.log('=== CONTINUE BUTTON CLICKED ===');
        console.log('========================================');
        console.log('🎯🎯🎯 BUTTON CLICK DETECTED! 🎯🎯🎯');
        console.log('✅✅✅ Continue button click ho gaya hai! ✅✅✅');
        console.log('Click time:', new Date().toISOString());
        console.log('Event type:', e.type);
        console.log('Event target:', e.target);
        
        // Prevent default form submission
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        console.log('✅ Default form submission prevented');
        
        // ============================================
        // STEP 6: Get Form Values
        // ============================================
        console.log('=== GETTING FORM VALUES ===');
        const institutionType = document.getElementById('institution_type')?.value;
        const email = document.getElementById('institution_email')?.value;
        
        console.log('Institution Type:', institutionType);
        console.log('Email:', email);
        
        // Validation
        if (!institutionType) {
            console.error('❌ Validation failed: Institution type is empty');
            alert('Please select an institution type');
            // Button remains enabled
            return;
        }
        
        if (!email) {
            console.error('❌ Validation failed: Email is empty');
            alert('Email not found. Please go back to registration.');
            // Button remains enabled
            return;
        }
        
        // Check if institution_name field is visible and validate it
        const institutionNameField = document.getElementById('institution_name');
        const institutionNameFieldVisible = $('#institution_name_field_wrapper').is(':visible');
        const employerFieldsVisible = $('#employer-additional-fields').is(':visible');
        
        console.log('=== VALIDATING INSTITUTION NAME ===');
        console.log('Institution Name field element exists?', institutionNameField !== null);
        console.log('Institution Name field visible?', institutionNameFieldVisible);
        console.log('Employer additional fields visible?', employerFieldsVisible);
        
        // If institution_name field is visible, it must have a value
        if (institutionNameFieldVisible) {
            const institutionName = institutionNameField ? institutionNameField.value?.trim() : '';
            console.log('Institution Name value:', institutionName);
            console.log('Institution Name value length:', institutionName ? institutionName.length : 0);
            
            if (!institutionName || institutionName.length === 0) {
                console.error('❌ Validation failed: Institution name is required');
                alert('Please enter institution name');
                if (institutionNameField) {
                    institutionNameField.focus();
                }
                // Button remains enabled
                return;
            } else {
                console.log('✅ Institution Name validation passed:', institutionName);
            }
        } else if (employerFieldsVisible) {
            // Fallback: check if employer fields are visible
            const institutionName = $('#institution_name').val()?.trim();
            if (!institutionName) {
                console.error('❌ Validation failed: Institution name is required for employer');
                alert('Please enter institution name');
                $('#institution_name').focus();
                // Button remains enabled
                return;
            }
        }
        
        console.log('✅ All validations passed');
        
        // ============================================
        // STEP 7: Show Loading (Button stays enabled)
        // ============================================
        console.log('=== SHOWING LOADING STATE ===');
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = 'Saving...';
        console.log('✅ Button text changed to "Saving..." (button remains enabled)');
        
        // ============================================
        // STEP 8: Get CSRF Token
        // ============================================
        console.log('=== GETTING CSRF TOKEN ===');
        const csrfToken = document.querySelector('input[name="_token"]')?.value;
        console.log('CSRF Token:', csrfToken ? '✅ Found' : '❌ Not found');
        
        if (!csrfToken) {
            console.error('❌ CSRF token not found!');
            alert('Security token missing. Please refresh the page.');
            btn.innerHTML = originalText;
            // Button remains enabled
            return;
        }
        
        // ============================================
        // STEP 9: Prepare API Request & Save to Database
        // ============================================
        console.log('========================================');
        console.log('=== SAVING INSTITUTION TYPE TO DATABASE ===');
        console.log('========================================');
        const apiUrl = '{{ route('public.account.register.saveInstitutionType') }}';
        console.log('API URL:', apiUrl);
        
        const requestData = {
            email: email,
            institution_type: institutionType
        };
        
        // Check if institution_name field exists and has value (regardless of visibility)
        const institutionNameField = document.getElementById('institution_name');
        const institutionName = institutionNameField ? institutionNameField.value?.trim() : '';
        
        // Also check via jQuery
        const institutionNameFieldVisible = $('#institution_name_field_wrapper').is(':visible');
        const employerFieldsVisible = $('#employer-additional-fields').is(':visible');
        
        console.log('=== CHECKING INSTITUTION NAME FIELD ===');
        console.log('Institution Name field element exists?', institutionNameField !== null);
        console.log('Institution Name field visible?', institutionNameFieldVisible);
        console.log('Institution Name value:', institutionName);
        console.log('Institution Name value length:', institutionName ? institutionName.length : 0);
        console.log('Employer additional fields visible?', employerFieldsVisible);
        
        // If institution_name has a value, ALWAYS add it to request (even if field is not visible)
        let finalInstitutionName = '';
        
        if (institutionName && institutionName.length > 0) {
            finalInstitutionName = institutionName;
            requestData.institution_name = finalInstitutionName;
            console.log('✅✅✅ Institution Name added to request (Vanilla JS):', finalInstitutionName);
            console.log('✅ Institution Name will be saved to database');
        } else {
            // Also try jQuery method as fallback
            const jqInstitutionName = $('#institution_name').val()?.trim();
            console.log('🔄 Trying jQuery method...');
            console.log('📝 jQuery Institution Name value:', jqInstitutionName);
            
            if (jqInstitutionName && jqInstitutionName.length > 0) {
                finalInstitutionName = jqInstitutionName;
                requestData.institution_name = finalInstitutionName;
                console.log('✅✅✅ Institution Name added to request (jQuery fallback):', finalInstitutionName);
                console.log('✅ Institution Name will be saved to database');
            } else {
                console.error('❌❌❌ Institution Name is EMPTY or NOT FOUND! ❌❌❌');
                console.error('❌ Vanilla JS value:', institutionName);
                console.error('❌ jQuery value:', jqInstitutionName);
                console.error('❌ Field element:', institutionNameField);
                console.error('❌ Field HTML:', institutionNameField ? institutionNameField.outerHTML : 'NOT FOUND');
            }
        }
        
        console.log('========================================');
        console.log('📝 FINAL Institution Name to be saved:', finalInstitutionName || '❌ EMPTY');
        console.log('📝 Request Data institution_name:', requestData.institution_name || '❌ NOT SET');
        console.log('========================================');
        
        // Add other employer fields if visible
        if (employerFieldsVisible) {
            requestData.location = $('#employer_location').val() || '';
            requestData.country_id = $('#employer_country_id').val() || '';
            requestData.state_id = $('#employer_state_id').val() || '';
            requestData.city_id = $('#employer_city_id').val() || '';
            console.log('✅ Additional employer fields added');
        }
        
        console.log('========================================');
        console.log('=== DATA TO BE SAVED TO DATABASE ===');
        console.log('========================================');
        console.log('📧 Email:', email);
        console.log('🏢 Institution Type:', institutionType);
        console.log('📝 Institution Name:', requestData.institution_name || '❌ NOT PROVIDED');
        console.log('📍 Location:', requestData.location || 'Not provided');
        console.log('🌍 Country ID:', requestData.country_id || 'Not provided');
        console.log('🗺️ State ID:', requestData.state_id || 'Not provided');
        console.log('🏙️ City ID:', requestData.city_id || 'Not provided');
        console.log('========================================');
        console.log('📦 Full Request Data Object:');
        console.log(requestData);
        console.log('========================================');
        console.log('💾 Saving to database now...');
        console.log('========================================');
        
        // ============================================
        // STEP 10: Make API Call (Fetch)
        // ============================================
        console.log('=== MAKING API CALL ===');
        console.log('Method: POST');
        console.log('URL:', apiUrl);
        console.log('Headers:', {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        });
        console.log('Body:', JSON.stringify(requestData));
        
        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => {
            console.log('=== API RESPONSE RECEIVED ===');
            console.log('Response Status:', response.status);
            console.log('Response OK?', response.ok);
            return response.json();
        })
        .then(data => {
            console.log('========================================');
            console.log('=== DATABASE SAVE RESPONSE RECEIVED ===');
            console.log('========================================');
            console.log('📥 Full Response Object:');
            console.log(data);
            console.log('❌ Error?', data.error);
            console.log('💬 Message:', data.message);
            console.log('✅ Success?', data.error === false ? 'YES ✅' : 'NO ❌');
            console.log('========================================');
            
            if (data.error === false) {
                console.log('========================================');
                console.log('✅✅✅ DATA SUCCESSFULLY SAVED TO DATABASE ✅✅✅');
                console.log('========================================');
                console.log('📧 Saved Email:', email);
                console.log('🏢 Saved Institution Type:', institutionType);
                console.log('📝 Saved Institution Name:', requestData.institution_name || 'Not provided');
                console.log('📍 Saved Location:', requestData.location || 'Not provided');
                console.log('🌍 Saved Country ID:', requestData.country_id || 'Not provided');
                console.log('🗺️ Saved State ID:', requestData.state_id || 'Not provided');
                console.log('🏙️ Saved City ID:', requestData.city_id || 'Not provided');
                console.log('========================================');
                console.log('💾 Database Update Status: SUCCESS ✅');
                console.log('📊 All data has been stored in jb_accounts table');
                console.log('📋 Column: institution_name');
                console.log('💾 Value stored:', requestData.institution_name || 'NULL');
                console.log('========================================');
                console.log('=== REDIRECTING TO LOCATION PAGE ===');
                const locationUrl = '{{ route('public.account.register.locationPage') }}';
                console.log('🔗 Redirect URL:', locationUrl);
                console.log('⏱️ Redirecting in 500ms...');
                console.log('========================================');
                
                // Small delay to ensure database save is complete
                setTimeout(function() {
                    console.log('🚀 Redirecting now...');
                    window.location.href = locationUrl;
                }, 500);
            } else {
                console.error('========================================');
                console.error('❌❌❌ DATABASE SAVE FAILED ❌❌❌');
                console.error('========================================');
                console.error('💬 Error Message:', data.message);
                console.error('📧 Email:', email);
                console.error('🏢 Institution Type:', institutionType);
                console.error('📝 Institution Name:', requestData.institution_name || 'Not provided');
                console.error('========================================');
                alert(data.message || 'Failed to save institution type');
                btn.innerHTML = originalText;
                // Button remains enabled
            }
        })
        .catch(error => {
            console.error('========================================');
            console.error('=== API CALL FAILED ===');
            console.error('========================================');
            console.error('Error Type:', error.name);
            console.error('Error Message:', error.message);
            console.error('Full Error:', error);
            alert('Error: ' + error.message);
            btn.innerHTML = originalText;
            // Button remains enabled
        });
    }, false); // Use bubble phase, not capture
    
    console.log('✅ Click handler attached successfully');
    console.log('=== SETUP COMPLETE - READY FOR USER INTERACTION ===');
    
    // Test click programmatically after 1 second
    setTimeout(function() {
        console.log('=== TESTING BUTTON CLICK ===');
        const testBtn = document.getElementById('continue-btn');
        if (testBtn) {
            console.log('✅ Button exists for testing');
            console.log('Button HTML:', testBtn.outerHTML.substring(0, 100));
        } else {
            console.error('❌ Button not found for testing');
        }
    }, 1000);
});
</script>
@endpush
