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
        max-width: 536px;
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

    /* City Autocomplete */
    .city-search-wrapper {
        position: relative;
    }

    .city-search-input {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        color: #374151;
        background: #fff;
        transition: all 0.3s;
    }

    .city-search-input:focus {
        border-color: #0073d1;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 115, 209, 0.1);
    }

    .city-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 220px;
        overflow-y: auto;
        z-index: 100;
        display: none;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .city-suggestions.show {
        display: block;
    }

    .city-suggestion-item {
        padding: 10px 16px;
        cursor: pointer;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s;
    }

    .city-suggestion-item:last-child {
        border-bottom: none;
    }

    .city-suggestion-item:hover,
    .city-suggestion-item.active {
        background: #eff6ff;
        color: #0073d1;
    }

    .city-suggestion-item .city-name {
        font-weight: 600;
    }

    .city-suggestion-item .city-location {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 2px;
    }

    .city-no-results {
        padding: 12px 16px;
        font-size: 13px;
        color: #94a3b8;
        text-align: center;
    }

    .city-loading {
        padding: 12px 16px;
        font-size: 13px;
        color: #94a3b8;
        text-align: center;
    }

    .auto-filled-field {
        background-color: #f0fdf4 !important;
        border-color: #86efac !important;
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
            <p>Step 4 of 4 - What is your current location?</p>
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
                <input type="hidden" name="city_id" id="city_id" value="" />
                
                @if (is_plugin_active('location'))
                    <!-- City (Primary - Search) -->
                    <div class="form-group">
                        <label class="form-label">City <span class="required">*</span></label>
                        <div class="city-search-wrapper">
                            <input type="text" id="city_search" class="city-search-input" placeholder="Type your city name..." autocomplete="off" />
                            <div class="city-suggestions" id="city-suggestions"></div>
                        </div>
                    </div>

                    <!-- State (Auto-filled) -->
                    <div class="form-group">
                        <label class="form-label">State <span class="optional">(Auto-filled)</span></label>
                        <select name="state_id" id="state_id" class="form-select" disabled>
                            <option value="">Select State</option>
                        </select>
                    </div>

                    <!-- Country (Auto-filled) -->
                    <div class="form-group">
                        <label class="form-label">Country <span class="optional">(Auto-filled)</span></label>
                        <select name="country_id" id="country_id" class="form-select" disabled>
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
        let searchTimeout = null;
        let activeSuggestionIndex = -1;

        // Load email from API
        $.ajax({
            url: '{{ route("public.account.register.getVerificationData") }}',
            type: 'GET',
            success: function(response) {
                if (response.data?.email) {
                    $('#location_email').val(response.data.email);
                }
            }
        });

        function renderCityItems(cities) {
            let html = '';
            cities.forEach(function(city) {
                const locationParts = [];
                if (city.state_name) locationParts.push(city.state_name);
                if (city.country_name) locationParts.push(city.country_name);
                html += '<div class="city-suggestion-item" ' +
                    'data-id="' + city.id + '" ' +
                    'data-name="' + city.name + '" ' +
                    'data-state-id="' + (city.state_id || '') + '" ' +
                    'data-state-name="' + (city.state_name || '') + '" ' +
                    'data-country-id="' + (city.country_id || '') + '" ' +
                    'data-country-name="' + (city.country_name || '') + '">' +
                    '<div class="city-name">' + city.name + '</div>' +
                    (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') +
                    '</div>';
            });
            return html;
        }

        let indiaLoading = false;
        function loadIndiaCities(page, append) {
            const $suggestions = $('#city-suggestions');
            if (indiaLoading) return;
            indiaLoading = true;
            if (!append) {
                $suggestions.html('<div class="city-loading">Loading...</div>').addClass('show');
            } else {
                $('#city-loading-more').remove();
                $suggestions.append('<div class="city-loading city-loading-more" id="city-loading-more">Loading...</div>');
            }
            $.ajax({
                url: '{{ route("ajax.search-cities") }}',
                type: 'GET',
                data: { default_country: '1', page: page },
                success: function(response) {
                    const data = response.data || {};
                    const cities = data.cities || [];
                    const hasMore = data.has_more || false;
                    if (!append) $suggestions.empty();
                    if (cities.length === 0 && !append) {
                        $suggestions.html('<div class="city-no-results">No cities found</div>');
                        indiaLoading = false;
                        return;
                    }
                    $('#city-loading-more').remove();
                    $suggestions.append(renderCityItems(cities));
                    $suggestions.data('india-page', page);
                    $suggestions.data('india-has-more', hasMore);
                },
                error: function() {
                    if (!append) $suggestions.html('<div class="city-no-results">Error loading cities</div>');
                    $('#city-loading-more').remove();
                },
                complete: function() { indiaLoading = false; }
            });
        }

        $('#city_search').on('focus', function() {
            const keyword = $(this).val().trim();
            if (keyword.length < 2) {
                loadIndiaCities(1, false);
            }
        });

        $('#city-suggestions').on('scroll', function() {
            const el = this;
            const $suggestions = $(el);
            if (!$suggestions.data('india-has-more') || indiaLoading) return;
            if (el.scrollTop + el.clientHeight >= el.scrollHeight - 20) {
                const nextPage = ($suggestions.data('india-page') || 1) + 1;
                loadIndiaCities(nextPage, true);
            }
        });

        // City search autocomplete
        $('#city_search').on('input', function() {
            const keyword = $(this).val().trim();
            const $suggestions = $('#city-suggestions');
            activeSuggestionIndex = -1;

            // Clear city selection when user types
            $('#city_id').val('');
            resetStateCountry();

            if (searchTimeout) clearTimeout(searchTimeout);

            if (keyword.length < 2) {
                $suggestions.removeClass('show').empty();
                return;
            }

            $suggestions.html('<div class="city-loading">Searching...</div>').addClass('show');

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: '{{ route("ajax.search-cities") }}',
                    type: 'GET',
                    data: { k: keyword },
                    success: function(response) {
                        const cities = response.data || [];
                        
                        if (cities.length === 0) {
                            $suggestions.html('<div class="city-no-results">No cities found</div>');
                            return;
                        }

                        let html = '';
                        cities.forEach(function(city) {
                            const locationParts = [];
                            if (city.state_name) locationParts.push(city.state_name);
                            if (city.country_name) locationParts.push(city.country_name);
                            
                            html += '<div class="city-suggestion-item" ' +
                                'data-id="' + city.id + '" ' +
                                'data-name="' + city.name + '" ' +
                                'data-state-id="' + (city.state_id || '') + '" ' +
                                'data-state-name="' + (city.state_name || '') + '" ' +
                                'data-country-id="' + (city.country_id || '') + '" ' +
                                'data-country-name="' + (city.country_name || '') + '">' +
                                '<div class="city-name">' + city.name + '</div>' +
                                (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') +
                                '</div>';
                        });

                        $suggestions.html(html);
                    },
                    error: function() {
                        $suggestions.html('<div class="city-no-results">Error searching cities</div>');
                    }
                });
            }, 300);
        });

        // Keyboard navigation for suggestions
        $('#city_search').on('keydown', function(e) {
            const $suggestions = $('#city-suggestions');
            const $items = $suggestions.find('.city-suggestion-item');

            if (!$suggestions.hasClass('show') || $items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
                $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, 0);
                $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (activeSuggestionIndex >= 0) {
                    $items.eq(activeSuggestionIndex).trigger('click');
                }
            } else if (e.key === 'Escape') {
                $suggestions.removeClass('show');
            }
        });

        // Select city from suggestions
        $(document).on('click', '.city-suggestion-item', function() {
            const $item = $(this);
            const cityId = $item.data('id');
            const cityName = $item.data('name');
            const stateId = $item.data('state-id');
            const stateName = $item.data('state-name');
            const countryId = $item.data('country-id');
            const countryName = $item.data('country-name');

            // Set city
            $('#city_search').val(cityName);
            $('#city_id').val(cityId);
            $('#city-suggestions').removeClass('show');

            // Auto-fill State
            if (stateId) {
                $('#state_id').html('<option value="' + stateId + '" selected>' + stateName + '</option>')
                    .addClass('auto-filled-field');
            } else {
                $('#state_id').html('<option value="">N/A</option>');
            }

            // Auto-fill Country
            if (countryId) {
                $('#country_id').val(countryId).addClass('auto-filled-field');
                // If country option doesn't exist, add it
                if ($('#country_id').val() != countryId) {
                    $('#country_id').html('<option value="' + countryId + '" selected>' + countryName + '</option>')
                        .addClass('auto-filled-field');
                }
            }
        });

        // Close suggestions on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.city-search-wrapper').length) {
                $('#city-suggestions').removeClass('show');
            }
        });

        function resetStateCountry() {
            $('#state_id').html('<option value="">Select State</option>').removeClass('auto-filled-field');
            $('#country_id').val('').removeClass('auto-filled-field');
        }
        
        // Submit button handler
        $('#submit-btn').on('click', function(e) {
            e.preventDefault();
            
            const email = $('#location_email').val();
            const countryId = $('#country_id').val();
            const stateId = $('#state_id').val();
            const cityId = $('#city_id').val();
            
            if (!cityId) {
                if (typeof window.showDialogAlert === 'function') {
                    window.showDialogAlert('error', 'Please search and select a city', 'Validation Error');
                } else {
                    alert('Please search and select a city');
                }
                $('#city_search').focus();
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
                    if (typeof window.showDialogAlert === 'function') {
                        window.showDialogAlert('error', 'Failed to save. Please try again.', 'Error');
                    } else {
                        alert('Failed to save. Please try again.');
                    }
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    });
})(jQuery);
</script>
