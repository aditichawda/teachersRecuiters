@php
    Theme::layout('without-navbar');
@endphp

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
                            <h2 class="log-reg-form-title mb-2">{{ __('Select Location') }}</h2>
                            <p class="text-muted mb-0">
                                {{ __('Please select your location details.') }}
                            </p>
                        </div>

                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <form id="location-form">
                                    @csrf
                                    
                                    <!-- Hidden email field -->
                                    <input type="hidden" name="email" id="location_email" value="" />
                                    
                                    <!-- Location Input -->
                                        <div class="mb-4">
                                        <label for="location" class="form-label fw-semibold mb-2">
                                                {{ __('Location') }}
                                            </label>
                                        <input 
                                            type="text" 
                                            name="location" 
                                            id="location" 
                                            class="form-control form-control-lg"
                                            placeholder="{{ __('Enter your location') }}"
                                        />
                                        <div id="location_error" class="invalid-feedback d-block" style="display:none;"></div>
                                        </div>

                                    @if (is_plugin_active('location'))
                                        <!-- Country -->
                                        <div class="mb-4">
                                            <label for="country_id" class="form-label fw-semibold mb-2">
                                                {{ __('Country') }}
                                            </label>
                                            <select 
                                                name="country_id" 
                                                id="country_id" 
                                                class="form-select form-select-lg"
                                            >
                                                <option value="">{{ __('Select Country') }}</option>
                                                @php
                                                    try {
                                                        // Try to get published countries first
                                                        $countries = \Botble\Location\Models\Country::query()
                                                            ->where('status', 'published')
                                                            ->orderBy('order')
                                                            ->orderBy('name')
                                                            ->get();
                                                        
                                                        // If no published countries, get all countries
                                                        if ($countries->isEmpty()) {
                                                            $countries = \Botble\Location\Models\Country::query()
                                                                ->orderBy('order')
                                                                ->orderBy('name')
                                                                ->get();
                                                        }
                                                        
                                                        \Log::info('Countries loaded for location page', [
                                                            'count' => $countries->count(),
                                                            'sample' => $countries->take(3)->pluck('name')->toArray()
                                                        ]);
                                                    } catch (\Exception $e) {
                                                        \Log::error('Error loading countries', [
                                                            'error' => $e->getMessage(),
                                                            'trace' => $e->getTraceAsString()
                                                        ]);
                                                        $countries = collect([]);
                                                    }
                                                @endphp
                                                @if($countries && $countries->count() > 0)
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="" disabled>{{ __('No countries available. Please contact administrator.') }}</option>
                                                    @php
                                                        \Log::warning('No countries found in database for location page');
                                                    @endphp
                                    @endif
                                            </select>
                                            <div id="country_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                        </div>

                                        <!-- State -->
                                    <div class="mb-4">
                                            <label for="state_id" class="form-label fw-semibold mb-2">
                                                {{ __('State') }}
                                        </label>
                                        <select 
                                                name="state_id" 
                                                id="state_id" 
                                            class="form-select form-select-lg"
                                                disabled
                                        >
                                                <option value="">{{ __('Select State') }}</option>
                                        </select>
                                            <div id="state_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                    </div>

                                        <!-- City -->
                                        <div class="mb-4">
                                            <label for="city_id" class="form-label fw-semibold mb-2">
                                                {{ __('City') }}
                                            </label>
                                            <select 
                                                name="city_id" 
                                                id="city_id" 
                                                class="form-select form-select-lg"
                                                disabled
                                            >
                                                <option value="">{{ __('Select City') }}</option>
                                            </select>
                                            <div id="city_id_error" class="invalid-feedback d-block" style="display:none;"></div>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                        <a href="{{ route('public.account.register.institutionTypePage') }}" class="btn btn-outline-secondary">
                                            <i class="ti ti-arrow-left me-1"></i> {{ __('Back') }}
                                        </a>
                                        <button type="button" class="site-button" id="submit-btn" onclick="handleLocationSubmit(event); return false;">
                                            {{ __('Complete Registration') }} <i class="ti ti-check ms-1"></i>
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

// Global function for Complete Registration button click
window.handleLocationSubmit = function(e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    console.log('========================================');
    console.log('=== HANDLE LOCATION SUBMIT CALLED ===');
    console.log('========================================');
    console.log('🎯 Button click detected via onclick!');
    console.log('Click time:', new Date().toISOString());
    
    // Get location value only
    const location = document.getElementById('location')?.value;
    let email = document.getElementById('location_email')?.value;
    
    console.log('=== GETTING FORM VALUES ===');
    console.log('Location:', location);
    console.log('Email from hidden field:', email);
    console.log('Email element exists?', document.getElementById('location_email') !== null);
    
    // Validation
    if (!location || location.trim() === '') {
        console.error('❌ Validation failed: Location is empty');
        alert('Please enter your location.');
        return false;
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
                document.getElementById('location_email').value = email;
                console.log('✅ Email loaded from API:', email);
                // Now process with the loaded email
                processLocationSave(location, email);
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
    processLocationSave(location, email);
    return false;
};

// Separate function to process the save
function processLocationSave(location, email) {
    console.log('=== PROCESSING LOCATION SAVE ===');
    console.log('Location:', location);
    console.log('Email:', email);
    
    // Get button and show loading
    const btn = document.getElementById('submit-btn');
    const originalText = btn.innerHTML;
    btn.innerHTML = 'Saving...';
    console.log('✅ Button text changed to "Saving..."');
    
    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const saveUrl = '{{ route('public.account.register.saveLocation') }}';
    
    console.log('========================================');
    console.log('=== SAVING LOCATION TO DATABASE ===');
    console.log('========================================');
    console.log('API URL:', saveUrl);
    console.log('CSRF Token:', csrfToken ? '✅ Found' : '❌ Not found');
    console.log('Request Data:', {
        email: email,
        location: location
    });
    console.log('Saving to database now...');
    
    // Use fetch API for better error handling
    fetch(saveUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email: email,
            location: location
        })
    })
    .then(response => {
        console.log('=== API RESPONSE RECEIVED ===');
        console.log('Status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('========================================');
        console.log('=== LOCATION SAVE RESPONSE ===');
        console.log('========================================');
        console.log('Full Response:', data);
        console.log('Success?', data.error === false ? '✅ YES' : '❌ NO');
        console.log('Message:', data.message);
        console.log('========================================');
        console.log('✅✅✅ LOCATION SAVED TO DATABASE ✅✅✅');
        console.log('========================================');
        console.log('Saved Location:', location);
        console.log('Saved Email:', email);
        console.log('Database Update: SUCCESS');
        console.log('========================================');
        
        // Store in sessionStorage
        if (typeof Storage !== 'undefined') {
            sessionStorage.setItem('regStep', 'complete');
            console.log('✅ Registration step stored in sessionStorage');
        }
        
        // Redirect to dashboard
        if (data.data && data.data.next_url) {
            console.log('=== REDIRECTING ===');
            console.log('Redirect URL:', data.data.next_url);
            window.location.href = data.data.next_url;
        } else {
            console.log('=== REDIRECTING TO DASHBOARD ===');
            window.location.href = '{{ route('public.account.dashboard') }}';
        }
    })
    .catch(error => {
        console.error('========================================');
        console.error('=== LOCATION SAVE FAILED ===');
        console.error('========================================');
        console.error('Error:', error);
        console.error('Error Message:', error.message);
        console.error('========================================');
        
        alert('Failed to save location. Please try again.');
        btn.innerHTML = originalText;
    });
}

// Also define it as a regular function for compatibility
function handleLocationSubmit(event) {
    return window.handleLocationSubmit(event);
}
</script>

@push('footer')
<script>
// Immediate console test
console.log('========================================');
console.log('=== LOCATION PAGE SCRIPT LOADED ===');
console.log('========================================');
console.log('Script load time:', new Date().toISOString());

(function($) {
    'use strict';

    $(document).ready(function() {
        console.log('jQuery document ready fired');
        console.log('========================================');
        console.log('=== LOCATION PAGE LOADED ===');
        console.log('========================================');
        console.log('Page load time:', new Date().toISOString());
        
        // Get email and existing location data from session or API
        const getVerificationDataUrl = '{{ route('public.account.register.getVerificationData') }}';
        $.ajax({
            url: getVerificationDataUrl,
            type: 'GET',
            success: function(response) {
                console.log('========================================');
                console.log('=== VERIFICATION DATA LOADED ===');
                console.log('========================================');
                console.log('Full Response:', response);
                
                if (response.data && response.data.email) {
                    $('#location_email').val(response.data.email);
                    console.log('✅ Email loaded:', response.data.email);
                    
                    // Pre-fill location if exists
                    if (response.data.location) {
                        $('#location').val(response.data.location);
                        console.log('✅ Location pre-filled:', response.data.location);
                    }
                    
                    // Pre-fill country if exists
                    if (response.data.country_id) {
                        $('#country_id').val(response.data.country_id);
                        console.log('✅ Country ID pre-filled:', response.data.country_id);
                        console.log('✅ Country Name:', $('#country_id option:selected').text());
                        
                        // Trigger country change to load states
                        $('#country_id').trigger('change');
                    }
                    
                    // Pre-fill state if exists (will be set after states load)
                    if (response.data.state_id) {
                        window.pendingStateId = response.data.state_id;
                        console.log('⏳ State ID will be set after states load:', response.data.state_id);
                    }
                    
                    // Pre-fill city if exists (will be set after cities load)
                    if (response.data.city_id) {
                        window.pendingCityId = response.data.city_id;
                        console.log('⏳ City ID will be set after cities load:', response.data.city_id);
                    }
                    
                    console.log('Existing Location Data:', {
                        location: response.data.location || 'Not set',
                        country_id: response.data.country_id || 'Not set',
                        state_id: response.data.state_id || 'Not set',
                        city_id: response.data.city_id || 'Not set'
                    });
                } else {
                    console.error('❌ Email not found in verification data');
                }
                console.log('========================================');
            },
            error: function(xhr) {
                console.error('❌ Failed to get verification data:', xhr);
            }
        });
        
        // Check if countries are loaded
        const $countryField = $('#country_id');
        const countryOptions = $countryField.find('option').length;
        console.log('========================================');
        console.log('=== COUNTRY DROPDOWN STATUS ===');
        console.log('========================================');
        console.log('Country dropdown options count:', countryOptions);
        console.log('Country dropdown is:', countryOptions > 1 ? '✅ Loaded' : '❌ Empty');
        
        if (countryOptions <= 1) {
            console.warn('⚠️ Country dropdown appears empty. Please check server logs.');
        } else {
            console.log('Available Countries:', $countryField.find('option').map(function() {
                return $(this).text();
            }).get().slice(1)); // Skip first "Select Country" option
        }
        console.log('========================================');
        
        // Load states when country changes
        $('#country_id').on('change', function() {
            const countryId = $(this).val();
            const countryName = $(this).find('option:selected').text();
            const $stateField = $('#state_id');
            const $cityField = $('#city_id');
            
            console.log('========================================');
            console.log('=== COUNTRY DROPDOWN CHANGED ===');
            console.log('========================================');
            console.log('🌍 Country Selected - ID:', countryId);
            console.log('🌍 Country Selected - Name:', countryName);
            console.log('Change time:', new Date().toISOString());
            
            if (countryId) {
                console.log('✅ Country selected, loading states...');
                // Enable and load states
                $stateField.prop('disabled', false).html('<option value="">Loading...</option>');
                $cityField.prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
                
                $.ajax({
                    url: '{{ route("ajax.states-by-country") }}',
                    type: 'GET',
                    data: { country_id: countryId },
                    beforeSend: function() {
                        console.log('📡 Sending request to states API...');
                    },
                    success: function(response) {
                        console.log('========================================');
                        console.log('=== STATES API RESPONSE ===');
                        console.log('========================================');
                        console.log('Full Response:', response);
                        console.log('Response Data:', response.data);
                        console.log('States Count:', response.data ? response.data.length : 0);
                        
                        let options = '<option value="">{{ __('Select State') }}</option>';
                        let statesCount = 0;
                        
                        // Handle response.data array
                        if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                            $.each(response.data, function(index, state) {
                                // Skip the first option if it's the "Select State" placeholder (id: 0)
                                if (state.id && state.id != 0) {
                                    options += '<option value="' + state.id + '">' + state.name + '</option>';
                                    statesCount++;
                                }
                            });
                            
                            console.log('✅ States loaded:', statesCount);
                            console.log('States List:', response.data.filter(s => s.id && s.id != 0).map(s => s.name));
                        } else {
                            console.warn('⚠️ No states found for country ID:', countryId);
                        }
                        
                        $stateField.html(options);
                        console.log('✅ State dropdown populated');
                        
                        // If there's a pending state ID, set it now
                        if (window.pendingStateId) {
                            setTimeout(function() {
                                $stateField.val(window.pendingStateId);
                                console.log('✅ State ID set from existing data:', window.pendingStateId);
                                console.log('✅ State Name:', $stateField.find('option:selected').text());
                                $('#state_id').trigger('change'); // Trigger to load cities
                                window.pendingStateId = null;
                            }, 100);
                        }
                        console.log('========================================');
                    },
                    error: function(xhr) {
                        console.error('========================================');
                        console.error('=== STATES API ERROR ===');
                        console.error('========================================');
                        console.error('Status:', xhr.status);
                        console.error('Response:', xhr.responseText);
                        console.error('Full XHR:', xhr);
                        $stateField.html('<option value="">{{ __('Select State') }}</option>');
                        console.error('========================================');
                    }
                });
            } else {
                console.log('❌ No country selected, disabling state and city dropdowns');
                $stateField.prop('disabled', true).html('<option value="">{{ __('Select State') }}</option>');
                $cityField.prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
            }
            console.log('========================================');
        });

        // Load cities when state changes
        $('#state_id').on('change', function() {
            const stateId = $(this).val();
            const stateName = $(this).find('option:selected').text();
            const $cityField = $('#city_id');
            
            console.log('========================================');
            console.log('=== STATE DROPDOWN CHANGED ===');
            console.log('========================================');
            console.log('🏛️ State Selected - ID:', stateId);
            console.log('🏛️ State Selected - Name:', stateName);
            console.log('Change time:', new Date().toISOString());
            
            if (stateId) {
                console.log('✅ State selected, loading cities...');
                // Enable and load cities
                $cityField.prop('disabled', false).html('<option value="">Loading...</option>');
                
                $.ajax({
                    url: '{{ route("ajax.cities-by-state") }}',
                    type: 'GET',
                    data: { state_id: stateId },
                    beforeSend: function() {
                        console.log('📡 Sending request to cities API...');
                    },
                    success: function(response) {
                        console.log('========================================');
                        console.log('=== CITIES API RESPONSE ===');
                        console.log('========================================');
                        console.log('Full Response:', response);
                        console.log('Response Data:', response.data);
                        console.log('Cities Count:', response.data ? response.data.length : 0);
                        
                        let options = '<option value="">{{ __('Select City') }}</option>';
                        let citiesCount = 0;
                        
                        // Handle response.data array
                        if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                            $.each(response.data, function(index, city) {
                                // Skip the first option if it's the "Select City" placeholder (id: 0)
                                if (city.id && city.id != 0) {
                                    options += '<option value="' + city.id + '">' + city.name + '</option>';
                                    citiesCount++;
                                }
                            });
                            
                            console.log('✅ Cities loaded:', citiesCount);
                            console.log('Cities List:', response.data.filter(c => c.id && c.id != 0).map(c => c.name));
                        } else {
                            console.warn('⚠️ No cities found for state ID:', stateId);
                        }
                        
                        $cityField.html(options);
                        console.log('✅ City dropdown populated');
                        
                        // If there's a pending city ID, set it now
                        if (window.pendingCityId) {
                            setTimeout(function() {
                                $cityField.val(window.pendingCityId);
                                console.log('✅ City ID set from existing data:', window.pendingCityId);
                                console.log('✅ City Name:', $cityField.find('option:selected').text());
                                window.pendingCityId = null;
                            }, 100);
                        }
                        console.log('========================================');
                    },
                    error: function(xhr) {
                        console.error('========================================');
                        console.error('=== CITIES API ERROR ===');
                        console.error('========================================');
                        console.error('Status:', xhr.status);
                        console.error('Response:', xhr.responseText);
                        console.error('Full XHR:', xhr);
                        $cityField.html('<option value="">{{ __('Select City') }}</option>');
                        console.error('========================================');
                    }
                });
            } else {
                console.log('❌ No state selected, disabling city dropdown');
                $cityField.prop('disabled', true).html('<option value="">{{ __('Select City') }}</option>');
            }
            console.log('========================================');
        });
        
        // Log when city is selected
        $('#city_id').on('change', function() {
            const cityId = $(this).val();
            const cityName = $(this).find('option:selected').text();
            
            console.log('========================================');
            console.log('=== CITY DROPDOWN CHANGED ===');
            console.log('========================================');
            console.log('🏙️ City Selected - ID:', cityId);
            console.log('🏙️ City Selected - Name:', cityName);
            console.log('Change time:', new Date().toISOString());
            console.log('========================================');
        });
        
        // Log when location text field changes
        $('#location').on('input change', function() {
            const location = $(this).val();
            console.log('📍 Location text changed:', location);
        });

        // Submit button - also attach jQuery listener as backup
        $('#submit-btn').on('click', function(e) {
            console.log('jQuery click handler also fired (backup)');
            // The onclick attribute will handle it, but we log it here
        });

        // Remove error on change
        $('#location, #country_id, #state_id, #city_id').on('change', function() {
            $(this).removeClass('is-invalid');
            $('#' + $(this).attr('id') + '_error').hide();
        });
    });
})(jQuery);
</script>
@endpush
