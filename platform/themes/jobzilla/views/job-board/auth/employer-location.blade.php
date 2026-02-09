@php
    Theme::layout('without-navbar');
    
    // Get countries
    $countries = [];
    if (is_plugin_active('location')) {
        $countries = \Botble\Location\Models\Country::query()
            ->where('status', \Botble\Base\Enums\BaseStatusEnum::PUBLISHED)
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
@endphp

<style>
    .employer-location-wrapper {
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

    .employer-location-container {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .employer-location-header {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        padding: 20px 30px;
        text-align: center;
    }

    .employer-location-header h2 {
        color: #ffffff;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .employer-location-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        margin: 0;
    }

    .employer-location-body {
        padding: 25px 30px;
    }

    .form-label {
        font-weight: 600;
        color: #434343;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .form-control, .form-select {
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #434343;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0073d1;
        box-shadow: 0 0 0 2px rgba(0, 115, 209, 0.1);
    }

    .submit-btn {
        background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%);
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-size: 14px;
        font-weight: 600;
        width: 100%;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 15px;
    }

    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 15px rgba(0, 115, 209, 0.25);
    }

    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
        flex-wrap: nowrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #999;
        font-size: 11px;
        white-space: nowrap;
    }

    .step.active {
        color: #0073d1;
        font-weight: 600;
    }

    .step.completed {
        color: #28a745;
    }

    .step-number {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .step.active .step-number {
        background: #0073d1;
        color: #fff;
    }

    .step.completed .step-number {
        background: #28a745;
        color: #fff;
    }

    @media (max-width: 480px) {
        .step-indicator { gap: 6px; }
        .step { font-size: 10px; gap: 3px; }
        .step-number { width: 20px; height: 20px; font-size: 9px; }
    }

    @media (max-width: 360px) {
        .step span:last-child { display: none; }
    }

    .back-link {
        color: #0073d1;
        text-decoration: none;
        font-size: 13px;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="employer-location-wrapper">
    <div class="employer-location-container">
        <div class="employer-location-header">
            <h2><i class="ti ti-map-pin me-2"></i>Location</h2>
            <p>Step 4 of 4 - Where is your institution located?</p>
        </div>
        
        <div class="employer-location-body">
            <!-- Step Indicator -->
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
                    <span>School/Institution</span>
                </div>
                <div class="step active">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

            <!-- Logo -->
            <div style="text-align: center; margin-bottom: 15px;">
                @if (Theme::getLogo())
                    <a href="{{ route('public.index') }}">
                        {!! Theme::getLogoImage(['class' => 'site-logo', 'style' => 'max-width: 150px;'], 'logo', 140) !!}
                    </a>
                @else
                    <a href="{{ route('public.index') }}" style="font-size: 20px; font-weight: 700; color: #434343; text-decoration: none;">
                        <span style="color: #0073d1;">Teachers</span>Recruiter
                    </a>
                @endif
            </div>

            <form id="location-form">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Country <span class="text-danger">*</span></label>
                    <select name="country_id" id="country_id" class="form-select" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">State <span class="text-muted">(Optional)</span></label>
                    <select name="state_id" id="state_id" class="form-select" disabled>
                        <option value="">Select State</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">City <span class="text-muted">(Optional)</span></label>
                    <select name="city_id" id="city_id" class="form-select" disabled>
                        <option value="">Select City</option>
                    </select>
                </div>

                <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    Complete Registration <i class="ti ti-check ms-2"></i>
                </button>
            </form>

            <p class="mt-4 text-center">
                <a href="{{ route('public.account.register.employer.institutionTypePage') }}" class="back-link">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
            </p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const errorMessage = document.getElementById('error-message');

    // Load states when country changes
    $('#country_id').on('change', function() {
        const countryId = $(this).val();
        const $stateField = $('#state_id');
        const $cityField = $('#city_id');

        $stateField.prop('disabled', true).html('<option value="">Loading...</option>');
        $cityField.prop('disabled', true).html('<option value="">Select City</option>');

        if (countryId) {
            $.ajax({
                url: '{{ route("ajax.states-by-country") }}',
                type: 'GET',
                data: { country_id: countryId },
                success: function(response) {
                    let options = '<option value="">Select State</option>';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(state) {
                            options += `<option value="${state.id}">${state.name}</option>`;
                        });
                    }
                    $stateField.html(options).prop('disabled', false);
                },
                error: function() {
                    $stateField.html('<option value="">Select State</option>').prop('disabled', false);
                }
            });
        }
    });

    // Load cities when state changes
    $('#state_id').on('change', function() {
        const stateId = $(this).val();
        const $cityField = $('#city_id');

        $cityField.prop('disabled', true).html('<option value="">Loading...</option>');

        if (stateId) {
            $.ajax({
                url: '{{ route("ajax.cities-by-state") }}',
                type: 'GET',
                data: { state_id: stateId },
                success: function(response) {
                    let options = '<option value="">Select City</option>';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(city) {
                            options += `<option value="${city.id}">${city.name}</option>`;
                        });
                    }
                    $cityField.html(options).prop('disabled', false);
                },
                error: function() {
                    $cityField.html('<option value="">Select City</option>').prop('disabled', false);
                }
            });
        }
    });

    // Form submission
    $('#location-form').on('submit', function(e) {
        e.preventDefault();

        const countryId = $('#country_id').val();
        const stateId = $('#state_id').val();
        const cityId = $('#city_id').val();

        if (!countryId) {
            showError('Please select country');
            return;
        }

        const submitBtn = $('#submit-btn');
        submitBtn.prop('disabled', true).html('Completing Registration...');
        $('#error-message').hide();

        $.ajax({
            url: '{{ route("public.account.register.employer.saveLocation") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            contentType: 'application/json',
            data: JSON.stringify({
                country_id: countryId,
                state_id: stateId,
                city_id: cityId
            }),
            success: function(response) {
                if (response.error) {
                    showError(response.message);
                    submitBtn.prop('disabled', false).html('Complete Registration <i class="ti ti-check ms-2"></i>');
                } else {
                    window.location.href = response.next_url || '{{ route("public.account.dashboard") }}';
                }
            },
            error: function() {
                showError('An error occurred. Please try again.');
                submitBtn.prop('disabled', false).html('Complete Registration <i class="ti ti-check ms-2"></i>');
            }
        });
    });

    function showError(message) {
        $('#error-message').text(message).show();
    }
});
</script>
