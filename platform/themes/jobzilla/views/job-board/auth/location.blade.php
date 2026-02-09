@php
    Theme::layout('without-navbar');
@endphp

<style>
    .location-wrapper {
        min-height: 100vh;
        background: #f5f7fa;
        background-image: 
            radial-gradient(at 20% 30%, rgba(0, 115, 209, 0.08) 0%, transparent 50%),
            radial-gradient(at 80% 70%, rgba(67, 67, 67, 0.06) 0%, transparent 50%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .location-container {
        width: 100%;
        max-width: 500px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .location-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 24px 30px;
        text-align: center;
    }

    .location-header h2 {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .location-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        margin: 0;
    }

    .location-body {
        padding: 30px;
    }

    /* Step Indicator */
    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #999;
        font-size: 12px;
        white-space: nowrap;
    }

    .step.active {
        color: #0073d1;
        font-weight: 600;
    }

    .step.completed {
        color: #10b981;
    }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        color: #666;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #10b981;
        color: #fff;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label .required {
        color: #dc3545;
    }

    .form-label .optional {
        color: #94a3b8;
        font-weight: 400;
        font-size: 13px;
    }

    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        background: #fff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23666' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .form-select:focus {
        border-color: #0073d1;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .form-select:disabled {
        background-color: #f8fafc;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Complete Button */
    .complete-btn {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 15px;
    }

    .complete-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .complete-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Back Link */
    .back-link {
        text-align: center;
    }

    .back-link a {
        color: #0073d1;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s;
    }

    .back-link a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .location-wrapper {
            padding: 20px 15px;
        }

        .location-container {
            border-radius: 12px;
        }

        .location-header {
            padding: 20px;
        }

        .location-header h2 {
            font-size: 20px;
        }

        .location-body {
            padding: 24px 20px;
        }

        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }
</style>

<div class="location-wrapper">
    <div class="location-container">
        <div class="location-header">
            <h2>Location</h2>
            <p>Step 4 of 4 - Select your location</p>
        </div>
        
        <div class="location-body">
            <!-- Step Indicator - 4 Steps -->
            <div class="step-indicator">
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Basic Details</span>
                </div>
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Verification</span>
                </div>
                <div class="step completed">
                    <span class="step-number">✓</span>
                    <span>Add Preferences & Resume</span>
                </div>
                <div class="step active">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <form id="location-form" onsubmit="return false;">
                @csrf
                <input type="hidden" name="email" id="location_email" value="" />
                
                @if (is_plugin_active('location'))
                    <!-- Country -->
                    <div class="form-group">
                        <label class="form-label">Country <span class="required">*</span></label>
                        <select name="country_id" id="country_id" class="form-select" required>
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

                    <!-- State -->
                    <div class="form-group">
                        <label class="form-label">State <span class="optional">(Optional)</span></label>
                        <select name="state_id" id="state_id" class="form-select" disabled>
                            <option value="">Select State</option>
                        </select>
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label class="form-label">City <span class="optional">(Optional)</span></label>
                        <select name="city_id" id="city_id" class="form-select" disabled>
                            <option value="">Select City</option>
                        </select>
                    </div>
                @endif

                <!-- Complete Button -->
                <button type="button" class="complete-btn" id="submit-btn">Complete Registration</button>
                
                <!-- Back Link -->
                <div class="back-link">
                    <a href="{{ route('public.account.register.institutionTypePage') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Load email from API
        $.ajax({
            url: '{{ route("public.account.register.getVerificationData") }}',
            type: 'GET',
            success: function(response) {
                if (response.data?.email) {
                    $('#location_email').val(response.data.email);
                    
                    if (response.data.country_id) {
                        $('#country_id').val(response.data.country_id).trigger('change');
                    }
                }
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
            
            if (!countryId) {
                alert('Please select a country');
                return;
            }
            
            const btn = $(this);
            const originalText = btn.html();
            btn.html('Completing...').prop('disabled', true);
            
            const csrfToken = $('input[name="_token"]').val();
            
            const formData = new FormData();
            formData.append('email', email);
            formData.append('location', '');
            formData.append('country_id', countryId || '');
            formData.append('state_id', stateId || '');
            formData.append('city_id', cityId || '');
            
            $.ajax({
                url: '{{ route("public.account.register.saveLocation") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    sessionStorage.setItem('regStep', 'complete');
                    localStorage.removeItem('registrationFormData');
                    
                    window.location.href = '{{ route("public.account.jobseeker.dashboard") }}';
                },
                error: function(xhr) {
                    alert('Failed to save. Please try again.');
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    });
})(jQuery);
</script>
