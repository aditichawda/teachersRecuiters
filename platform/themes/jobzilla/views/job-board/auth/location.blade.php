@php
    Theme::layout('without-navbar');
@endphp

<style>
/* ===== Location Page Styles ===== */
.location-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4f8 0%, #e8f4fc 50%, #f5f7fa 100%);
    margin: 0;
    padding: 0;
}

.tr-auth-left-panel {
    background: #0073d1 !important;
    position: relative;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    padding: 40px;
    overflow: hidden;
    min-height: 100vh;
}

.tr-auth-curve {
    position: absolute;
    right: -1px;
    top: 0;
    height: 100%;
    width: 150px;
    z-index: 10;
}

.tr-auth-left-content {
    position: relative;
    z-index: 5;
    color: #fff;
    padding-right: 80px;
}

.tr-auth-logo {
    margin-bottom: 30px;
}

.tr-auth-logo img {
    max-width: 180px;
    filter: brightness(0) invert(1);
}

.tr-auth-illustration {
    margin: 30px 0;
}

.tr-auth-illustration svg {
    width: 100%;
    max-width: 300px;
}

.tr-auth-step-info {
    margin-top: 30px;
}

.tr-auth-step-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 15px;
    color: #fff;
}

.tr-auth-step-info h3 {
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 10px 0;
    color: #fff;
}

.tr-auth-step-info p {
    font-size: 14px;
    opacity: 0.85;
    margin: 0;
    line-height: 1.6;
    color: #fff;
}

.tr-auth-right-panel {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 60px;
    background: #fff !important;
    min-height: 100vh;
}

.tr-auth-form-container {
    width: 100%;
    max-width: 450px;
}

.tr-auth-form-header {
    text-align: center;
    margin-bottom: 30px;
}

.tr-auth-form-header h1 {
    color: #0073d1;
    font-size: 28px;
    font-weight: 700;
    margin: 0 0 8px 0;
}

.tr-auth-form-header p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Form Elements */
.tr-form-group {
    margin-bottom: 20px;
}

.tr-form-label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.tr-select-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.tr-input-icon {
    position: absolute;
    left: 15px;
    color: #0073d1;
    font-size: 18px;
    z-index: 2;
}

.tr-form-select {
    width: 100%;
    padding: 14px 15px 14px 45px;
    border: 2px solid #e8f4fc;
    border-radius: 10px;
    font-size: 14px;
    background: #f8fbfd;
    transition: all 0.3s;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23666' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
}

.tr-form-select:focus {
    border-color: #0073d1;
    background-color: #fff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,115,209,0.1);
}

.tr-form-select:disabled {
    background: #f5f5f5;
    cursor: not-allowed;
    opacity: 0.7;
}

.tr-error-text {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

.tr-error-text.show {
    display: block;
}

/* Buttons */
.tr-form-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-top: 30px;
}

.tr-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 25px;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    color: #666;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s;
    background: #fff;
}

.tr-btn-outline:hover {
    border-color: #0073d1;
    color: #0073d1;
    text-decoration: none;
}

.tr-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 30px;
    background: #0073d1;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
}

.tr-btn-primary:hover {
    background: #005ba8;
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0,115,209,0.3);
}

.tr-btn-primary:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.tr-form-footer {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: #666;
}

.tr-form-footer a {
    color: #0073d1;
    font-weight: 600;
    text-decoration: none;
}

.tr-form-footer a:hover {
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 991px) {
    .tr-auth-right-panel {
        padding: 30px 20px;
    }
}

@media (max-width: 767px) {
    .tr-auth-form-header h1 {
        font-size: 24px;
    }
    
    .tr-form-buttons {
        flex-direction: column;
    }
    
    .tr-btn-outline, .tr-btn-primary {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="section-full tr-auth-page location-page" style="margin:0;padding:0;">
    <div class="container-fluid" style="padding:0;margin:0;">
        <div class="row g-0" style="min-height:100vh;">
            <!-- Left Panel - Blue with illustration -->
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-flex tr-auth-left-panel" style="background:#0073d1 !important;">
                <!-- Curve SVG -->
                <svg class="tr-auth-curve" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M100,0 L100,100 L30,100 Q-30,50 30,0 Z" fill="#ffffff"/>
                </svg>
                
                <!-- Content -->
                <div class="tr-auth-left-content">
                    @if (Theme::getLogo())
                        <div class="tr-auth-logo">
                            {!! Theme::getLogoImage(['class' => 'logo-light'], 'logo', 150) !!}
                        </div>
                    @endif
                    
                    <div class="tr-auth-illustration">
                        <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Map/Location illustration -->
                            <circle cx="200" cy="150" r="100" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
                            <circle cx="200" cy="150" r="70" fill="rgba(255,255,255,0.1)" stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
                            <circle cx="200" cy="150" r="40" fill="rgba(255,255,255,0.15)"/>
                            <!-- Location Pin -->
                            <path d="M200 100 C170 100 150 125 150 150 C150 190 200 230 200 230 C200 230 250 190 250 150 C250 125 230 100 200 100Z" fill="rgba(255,255,255,0.4)" stroke="rgba(255,255,255,0.6)" stroke-width="2"/>
                            <circle cx="200" cy="145" r="20" fill="rgba(255,255,255,0.6)"/>
                        </svg>
                    </div>
                    
                    <div class="tr-auth-step-info">
                        <span class="tr-auth-step-badge">Step 3 of 3</span>
                        <h3>Select Your Location</h3>
                        <p>Help us find the best opportunities near you by selecting your preferred location</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Panel - Form -->
            <div class="col-xl-7 col-lg-7 col-md-7 tr-auth-right-panel" style="background:#fff !important;">
                <div class="tr-auth-form-container">
                    <div class="tr-auth-form-header">
                        <h1>Select Location</h1>
                        <p>Choose your preferred work location</p>
                    </div>
                    
                    <form id="location-form" onsubmit="return false;">
                        @csrf
                        <input type="hidden" name="email" id="location_email" value="" />
                        
                        @if (is_plugin_active('location'))
                            <!-- Country -->
                            <div class="tr-form-group">
                                <label class="tr-form-label">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <div class="tr-select-wrapper">
                                    <span class="tr-input-icon">🌍</span>
                                    <select name="country_id" id="country_id" class="tr-form-select" required>
                                        <option value="">Select Country</option>
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
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="country_id_error" class="tr-error-text"></div>
                            </div>

                            <!-- State -->
                            <div class="tr-form-group">
                                <label class="tr-form-label">
                                    State
                                </label>
                                <div class="tr-select-wrapper">
                                    <span class="tr-input-icon">📍</span>
                                    <select name="state_id" id="state_id" class="tr-form-select" disabled>
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div id="state_id_error" class="tr-error-text"></div>
                            </div>

                            <!-- City -->
                            <div class="tr-form-group">
                                <label class="tr-form-label">
                                    City
                                </label>
                                <div class="tr-select-wrapper">
                                    <span class="tr-input-icon">🏙️</span>
                                    <select name="city_id" id="city_id" class="tr-form-select" disabled>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <div id="city_id_error" class="tr-error-text"></div>
                            </div>
                        @endif
                        
                        <!-- Buttons -->
                        <div class="tr-form-buttons">
                            <a href="{{ route('public.account.register.institutionTypePage') }}" class="tr-btn-outline">
                                ← Back
                            </a>
                            <button type="button" class="tr-btn-primary" id="submit-btn">
                                Complete Registration ✓
                            </button>
                        </div>
                        
                        <div class="tr-form-footer">
                            Already have an account? <a href="{{ route('public.account.login') }}">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
(function($) {
    'use strict';
    
    $(document).ready(function() {
        console.log('Location Page Loaded');
        
        // Load email from API
        $.ajax({
            url: '{{ route("public.account.register.getVerificationData") }}',
            type: 'GET',
            success: function(response) {
                if (response.data?.email) {
                    $('#location_email').val(response.data.email);
                    console.log('Email loaded:', response.data.email);
                    
                    // Pre-fill country if exists
                    if (response.data.country_id) {
                        $('#country_id').val(response.data.country_id).trigger('change');
                    }
                }
            },
            error: function(xhr) {
                console.error('Failed to load email:', xhr);
            }
        });
        
        // Load states when country changes
        $('#country_id').on('change', function() {
            const countryId = $(this).val();
            const $stateField = $('#state_id');
            const $cityField = $('#city_id');
            
            if (countryId) {
                $stateField.prop('disabled', false).html('<option value="">Loading...</option>');
                $cityField.prop('disabled', true).html('<option value="">Select City</option>');
                
                $.ajax({
                    url: '{{ route("ajax.states-by-country") }}',
                    type: 'GET',
                    data: { country_id: countryId },
                    success: function(response) {
                        let options = '<option value="">Select State</option>';
                        if (response.data?.length > 0) {
                            response.data.forEach(function(state) {
                                if (state.id && state.id != 0) {
                                    options += '<option value="' + state.id + '">' + state.name + '</option>';
                                }
                            });
                        }
                        $stateField.html(options);
                    },
                    error: function() {
                        $stateField.html('<option value="">Select State</option>');
                    }
                });
            } else {
                $stateField.prop('disabled', true).html('<option value="">Select State</option>');
                $cityField.prop('disabled', true).html('<option value="">Select City</option>');
            }
        });

        // Load cities when state changes
        $('#state_id').on('change', function() {
            const stateId = $(this).val();
            const $cityField = $('#city_id');
            
            if (stateId) {
                $cityField.prop('disabled', false).html('<option value="">Loading...</option>');
                
                $.ajax({
                    url: '{{ route("ajax.cities-by-state") }}',
                    type: 'GET',
                    data: { state_id: stateId },
                    success: function(response) {
                        let options = '<option value="">Select City</option>';
                        if (response.data?.length > 0) {
                            response.data.forEach(function(city) {
                                if (city.id && city.id != 0) {
                                    options += '<option value="' + city.id + '">' + city.name + '</option>';
                                }
                            });
                        }
                        $cityField.html(options);
                    },
                    error: function() {
                        $cityField.html('<option value="">Select City</option>');
                    }
                });
            } else {
                $cityField.prop('disabled', true).html('<option value="">Select City</option>');
            }
        });
        
        // Submit button handler
        $('#submit-btn').on('click', function(e) {
            e.preventDefault();
            
            const email = $('#location_email').val();
            const countryId = $('#country_id').val();
            const stateId = $('#state_id').val();
            const cityId = $('#city_id').val();
            
            // Validation - only country is required
            if (!countryId) {
                alert('Please select a country');
                return;
            }
            
            // Show loading
            const btn = $(this);
            const originalText = btn.html();
            btn.html('Completing...').prop('disabled', true);
            
            const csrfToken = $('input[name="_token"]').val();
            
            // Save to server
            $.ajax({
                url: '{{ route("public.account.register.saveLocation") }}',
                type: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: JSON.stringify({
                    email: email,
                    location: '',
                    country_id: countryId || null,
                    state_id: stateId || null,
                    city_id: cityId || null
                }),
                success: function(data) {
                    console.log('Save response:', data);
                    
                    // Clear registration data
                    sessionStorage.setItem('regStep', 'complete');
                    localStorage.removeItem('registrationFormData');
                    
                    // Redirect to job seeker dashboard
                    window.location.href = '{{ route("public.account.jobseeker.dashboard") }}';
                },
                error: function(xhr) {
                    console.error('Save error:', xhr);
                    alert('Failed to save. Please try again.');
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    });
})(jQuery);
</script>
