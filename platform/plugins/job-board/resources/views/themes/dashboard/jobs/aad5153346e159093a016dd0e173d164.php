<?php if(is_plugin_active('location')): ?>
<div class="form-group mb-3" data-step="3" data-account-type="job-seeker">
    <label class="form-label">City <span class="text-danger">*</span></label>
    <div class="city-search-wrapper" style="position:relative;">
        <input type="text" id="register_city_search" name="city_search" class="form-control city-search-input" placeholder="Type your city name..." autocomplete="off" data-step="3" data-account-type="job-seeker">
        <div class="city-suggestions" id="register-city-suggestions" style="display:none; position:absolute; left:0; right:0; top:100%; z-index:100; background:#fff; border:1px solid #dee2e6; border-radius:8px; max-height:220px; overflow-y:auto; box-shadow:0 4px 12px rgba(0,0,0,0.15);"></div>
    </div>
    <small class="text-muted">Type and select city; State and Country will auto-fill</small>
    <input type="hidden" name="city_id" id="register_city_id" value="">
    <input type="hidden" name="state_id" id="register_state_id" value="">
    <input type="hidden" name="country_id" id="register_country_id" value="">
    
    <!-- State (Auto-filled, readonly) -->
    <div class="form-group mt-2" style="display:none;" id="register-state-display-wrapper">
        <label class="form-label">State <span class="text-muted">(Auto-filled)</span></label>
        <input type="text" id="register_state_display" class="form-control" readonly placeholder="Select city first" style="background:#f8f9fa;">
    </div>
    
    <!-- Country (Auto-filled, readonly) -->
    <div class="form-group mt-2" style="display:none;" id="register-country-display-wrapper">
        <label class="form-label">Country <span class="text-muted">(Auto-filled)</span></label>
        <input type="text" id="register_country_display" class="form-control" readonly placeholder="Select city first" style="background:#f8f9fa;">
    </div>
</div>

<style>
.city-search-input {
    width: 100%;
    padding: 8px 12px;
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
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 8px 8px;
    max-height: 220px;
    overflow-y: auto;
    z-index: 100;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
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
</style>

<script>
(function($) {
    'use strict';
    
    $(document).ready(function() {
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

        // City search autocomplete
        $('#register_city_search').on('input', function() {
            const keyword = $(this).val().trim();
            const $suggestions = $('#register-city-suggestions');
            activeSuggestionIndex = -1;

            // Clear city selection when user types
            $('#register_city_id').val('');
            $('#register_state_id').val('');
            $('#register_country_id').val('');
            $('#register_state_display').val('');
            $('#register_country_display').val('');
            $('#register-state-display-wrapper, #register-country-display-wrapper').hide();

            if (searchTimeout) clearTimeout(searchTimeout);

            if (keyword.length < 2) {
                $suggestions.hide().empty();
                return;
            }

            $suggestions.html('<div class="city-loading">Searching...</div>').show();

            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: '<?php echo e(route("ajax.search-cities")); ?>',
                    type: 'GET',
                    data: { k: keyword },
                    success: function(response) {
                        const cities = response.data || [];
                        
                        if (cities.length === 0) {
                            $suggestions.html('<div class="city-no-results">No cities found</div>');
                            return;
                        }

                        $suggestions.html(renderCityItems(cities));
                    },
                    error: function() {
                        $suggestions.html('<div class="city-no-results">Error searching cities</div>');
                    }
                });
            }, 300);
        });

        // Keyboard navigation
        $('#register_city_search').on('keydown', function(e) {
            const $suggestions = $('#register-city-suggestions');
            const $items = $suggestions.find('.city-suggestion-item');

            if (!$suggestions.is(':visible') || $items.length === 0) return;

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
                $suggestions.hide();
            }
        });

        // Select city from suggestions
        $(document).on('click', '#register-city-suggestions .city-suggestion-item', function() {
            const $item = $(this);
            const cityId = $item.data('id');
            const cityName = $item.data('name');
            const stateId = $item.data('state-id');
            const stateName = $item.data('state-name');
            const countryId = $item.data('country-id');
            const countryName = $item.data('country-name');

            // Set city
            $('#register_city_search').val(cityName);
            $('#register_city_id').val(cityId);
            $('#register-city-suggestions').hide();

            // Auto-fill State
            if (stateId && stateName) {
                $('#register_state_id').val(stateId);
                $('#register_state_display').val(stateName);
                $('#register-state-display-wrapper').show();
            }

            // Auto-fill Country
            if (countryId && countryName) {
                $('#register_country_id').val(countryId);
                $('#register_country_display').val(countryName);
                $('#register-country-display-wrapper').show();
            }
        });

        // Close suggestions on outside click
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.city-search-wrapper').length) {
                $('#register-city-suggestions').hide();
            }
        });
    });
})(jQuery);
</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/auth/partials/city-search-field.blade.php ENDPATH**/ ?>