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
        padding: 8px 12px;
        height: 40px;
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

    /* City Autocomplete */
    .city-search-wrapper {
        position: relative;
    }

    .city-search-input {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px;
        height: 40px;
        font-size: 14px;
        color: #434343;
        background: #fff;
        transition: all 0.3s ease;
    }

    .city-search-input:focus {
        border-color: #0073d1;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 115, 209, 0.1);
    }

    .city-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #e0e0e0;
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
        padding: 10px 14px;
        cursor: pointer;
        font-size: 14px;
        color: #434343;
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

    .city-no-results,
    .city-loading {
        padding: 12px 14px;
        font-size: 13px;
        color: #94a3b8;
        text-align: center;
    }

    .auto-filled-field {
        background-color: #f0fdf4 !important;
        border-color: #86efac !important;
    }
</style>

<div class="employer-location-wrapper">
    <div class="employer-location-container">
        <div class="employer-location-header">
            <h2><i class="ti ti-map-pin me-2"></i>Location</h2>
            <p>Step 4 of 4 – Where your institution is located?</p>
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
                    <span>Add school/institution</span>
                </div>
                <div class="step active">
                    <span class="step-number">4</span>
                    <span>Location</span>
                </div>
            </div>

         
         

            <form id="location-form">
                @csrf
                <input type="hidden" name="city_id" id="city_id" value="" />
                
                <!-- City (Primary - Search) -->
                <div class="mb-3">
                    <label class="form-label">City <span class="text-danger">*</span></label>
                    <div class="city-search-wrapper">
                        <input type="text" id="city_search" class="city-search-input" placeholder="Type your city name..." autocomplete="off" />
                        <div class="city-suggestions" id="city-suggestions"></div>
                    </div>
                </div>

                <!-- State (Auto-filled) -->
                <div class="mb-3">
                    <label class="form-label">State <span class="text-muted">(Auto-filled)</span></label>
                    <select name="state_id" id="state_id" class="form-select" disabled>
                        <option value="">Select State</option>
                    </select>
                </div>

                <!-- Country (Auto-filled) -->
                <div class="mb-3">
                    <label class="form-label">Country <span class="text-muted">(Auto-filled)</span></label>
                    <select name="country_id" id="country_id" class="form-select" disabled>
                        <option value="">Select Country</option>
                        @foreach($countries as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
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
    let searchTimeout = null;
    let activeSuggestionIndex = -1;

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

    // Form submission
    $('#location-form').on('submit', function(e) {
        e.preventDefault();

        const countryId = $('#country_id').val();
        const stateId = $('#state_id').val();
        const cityId = $('#city_id').val();

        if (!cityId) {
            showError('Please search and select a city');
            $('#city_search').focus();
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
