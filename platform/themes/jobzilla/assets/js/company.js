(function ($) {
    const companies = $('.companies')

    // Blue Loader System (same as jobs page)
    const $companiesContainer = $('.companies-container');
    const $companiesList = $companiesContainer.find('.companies-content');
    let $companiesLoader = $companiesContainer.find('#companies-loader-overlay');

    // Create loader if it doesn't exist
    if (!$companiesLoader.length && $companiesList.length) {
        const loaderHtml = '<div class="blue-loader-overlay" id="companies-loader-overlay" style="display: none !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading companies...</p></div></div>';
        $companiesList.before(loaderHtml);
        $companiesLoader = $('#companies-loader-overlay');
    }

    function showCompaniesLoader() {
        if ($companiesLoader.length) {
            $companiesLoader.attr('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;').addClass('show');
        } else {
            // Create loader if it doesn't exist
            const loaderHtml = '<div class="blue-loader-overlay" id="companies-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading companies...</p></div></div>';
            $companiesList.before(loaderHtml);
            $companiesLoader = $('#companies-loader-overlay');
        }
    }

    function hideCompaniesLoader() {
        if ($companiesLoader.length) {
            setTimeout(() => {
                $companiesLoader.css({
                    'display': 'none',
                    'visibility': 'hidden',
                    'opacity': '0'
                }).removeClass('show');
            }, 300);
        }
    }

    let filterAjax = null

    function getcompanies() {
        const form = $('form#company-filter-form');
        const formData = form.serialize();
        const action = form.attr('action');
        const currentUrl = location.origin + location.pathname;

        if (filterAjax) {
            filterAjax.abort();
        }

        // Show loader IMMEDIATELY
        showCompaniesLoader();

        filterAjax = $.ajax({
            url: action,
            method: 'GET',
            data: formData,
            beforeSend: () => {
                // Ensure loader is visible
                showCompaniesLoader();
                window.history.pushState(
                    formData,
                    null,
                    `${currentUrl}?${formData}`
                )
            },
            success: (response) => {
                $('.companies-content').html(response.data)
                $('.woocommerce-result-count-left').text($('.info-pagination').text())
                
                // Re-add loader component if not present after HTML update
                if (!$companiesList.find('#companies-loader-overlay').length) {
                    const loaderHtml = '<div class="blue-loader-overlay" id="companies-loader-overlay" style="display: none !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading companies...</p></div></div>';
                    $companiesList.before(loaderHtml);
                }
                $companiesLoader = $('#companies-loader-overlay');
                
                // Reinitialize city search after AJAX update
                setTimeout(function() {
                    initCompanyCitySearch();
                }, 100);
            },
            error: () => {
                hideCompaniesLoader();
            },
            complete: function () {
                hideCompaniesLoader();
            }
        })
    }

    function setCurrentPage(page) {
        companies.find('input[name="page"]').val(page);
    }

    companies.on('change', '.select-per-page', function (e) {
        e.preventDefault();
        showCompaniesLoader();
        companies.find('input[name="per_page"]').val($(this).val());
        setCurrentPage(1)
        getcompanies();
    })

    companies.on('change', '.select-sort-by', function (e) {
        e.preventDefault();
        showCompaniesLoader();
        companies.find('input[name="sort_by"]').val($(this).val());
        getcompanies();
    })

    companies.on('change', '.select-layout', function (e) {
        e.preventDefault();
        showCompaniesLoader();
        companies.find('input[name="layout"]').val($(this).val());
        getcompanies();
    })

    // Handle filter form submission
    companies.on('submit', '#companies-filter-form', function (e) {
        e.preventDefault();
        
        // Show loader IMMEDIATELY when button is clicked
        showCompaniesLoader();
        
        const form = $('form#company-filter-form');
        const filterForm = $(this);
        
        // Clear existing filter inputs
        form.find('input[name^="institution_type"], input[name^="campus_type"], input[name^="benefits"], input[name^="standard_level"], input[name="company_id"], input[name="country_id"], input[name="state_id"], input[name="city_id"], input[name="currently_hiring"]').remove();
        
        // Update hidden form with filter data
        form.find('input[name="per_page"]').val($('#company-per-page').val() || form.find('input[name="per_page"]').val());
        form.find('input[name="layout"]').val($('#company-layout').val() || form.find('input[name="layout"]').val());
        form.find('input[name="sort_by"]').val($('#company-sort-by').val() || form.find('input[name="sort_by"]').val());
        form.find('input[name="page"]').val(1);
        
        // Add filter parameters to hidden form
        filterForm.find('input[type="checkbox"]:checked').each(function() {
            const name = $(this).attr('name');
            const value = $(this).val();
            if (name && value) {
                if (name.endsWith('[]')) {
                    form.append(`<input type="hidden" name="${name}" value="${value}">`);
                } else {
                    form.append(`<input type="hidden" name="${name}" value="${value}">`);
                }
            }
        });
        
        filterForm.find('select, input[type="text"], input[type="hidden"]').each(function() {
            const name = $(this).attr('name');
            const value = $(this).val();
            if (name && value && !$(this).is(':checkbox')) {
                // Handle city_id and city_search
                if (name === 'city_id') {
                    const existing = form.find(`input[name="city_id"]`);
                    if (existing.length) {
                        existing.val(value);
                    } else {
                        form.append(`<input type="hidden" name="city_id" value="${value}">`);
                    }
                } else if (name === 'city_search') {
                    // Don't add city_search to form, only city_id
                } else {
                    const existing = form.find(`input[name="${name}"]`);
                    if (existing.length) {
                        existing.val(value);
                    } else {
                        form.append(`<input type="hidden" name="${name}" value="${value}">`);
                    }
                }
            }
        });
        
        setCurrentPage(1);
        getcompanies();
        
        // Close mobile filter on submit
        $('.side-bar-filter').removeClass('active');
        $('body').removeClass('filter-open');
    })

    // Handle location cascading
    companies.on('change', '.location-filter[data-target="state"]', function() {
        const countryId = $(this).val();
        const stateSelect = $('.location-filter[data-target="city"]').closest('.form-group').prev().find('.location-filter[data-target="state"]');
        const citySelect = $('.location-filter[data-target="city"]');
        
        if (countryId) {
            $.ajax({
                url: '/ajax/location/states',
                data: { country_id: countryId },
                success: function(states) {
                    stateSelect.html('<option value="">{{ __("All States") }}</option>');
                    citySelect.html('<option value="">{{ __("All Cities") }}</option>').prop('disabled', true);
                    if (states && states.length) {
                        stateSelect.prop('disabled', false);
                        states.forEach(function(state) {
                            stateSelect.append(`<option value="${state.id}">${state.name}</option>`);
                        });
                        stateSelect.selectpicker('refresh');
                    }
                }
            });
        } else {
            stateSelect.html('<option value="">{{ __("All States") }}</option>').prop('disabled', true);
            citySelect.html('<option value="">{{ __("All Cities") }}</option>').prop('disabled', true);
            stateSelect.selectpicker('refresh');
            citySelect.selectpicker('refresh');
        }
    });

    companies.on('change', '.location-filter[data-target="city"]', function() {
        const stateId = $(this).val();
        const citySelect = $('.location-filter[data-target="city"]');
        
        if (stateId) {
            $.ajax({
                url: '/ajax/location/cities',
                data: { state_id: stateId },
                success: function(cities) {
                    citySelect.html('<option value="">{{ __("All Cities") }}</option>');
                    if (cities && cities.length) {
                        citySelect.prop('disabled', false);
                        cities.forEach(function(city) {
                            citySelect.append(`<option value="${city.id}">${city.name}</option>`);
                        });
                        citySelect.selectpicker('refresh');
                    }
                }
            });
        } else {
            citySelect.html('<option value="">{{ __("All Cities") }}</option>').prop('disabled', true);
            citySelect.selectpicker('refresh');
        }
    });

    // Handle sort, per page, and layout changes
    companies.on('change', '#company-sort-by, #company-per-page, #company-layout', function() {
        showCompaniesLoader();
        const form = $('form#company-filter-form');
        form.find('input[name="sort_by"]').val($('#company-sort-by').val());
        form.find('input[name="per_page"]').val($('#company-per-page').val());
        form.find('input[name="layout"]').val($('#company-layout').val());
        setCurrentPage(1);
        getcompanies();
    });

    companies.on('click', 'a.pagination-button', function (e) {
        e.preventDefault();
        showCompaniesLoader();
        setCurrentPage($(this).data('page'))
        getcompanies();
    })

    // Mobile filter toggle
    companies.on('click', '.btn-open-filter', function (e) {
        e.preventDefault();
        $('.side-bar-filter').addClass('active');
        $('body').addClass('filter-open');
    });

    companies.on('click', '.btn-close-filter, .backdrop', function (e) {
        e.preventDefault();
        $('.side-bar-filter').removeClass('active');
        $('body').removeClass('filter-open');
    });

    companies.on('click', '.btn-open-sidebar', function () {
        $('#mySidebar').css('width', '300px')
        $('#main').css('marginLeft', '300px')
    })

    companies.on('click', '.btn-close-sidebar', function () {
        $('#mySidebar').css('width', '0')
        $('#main').css('marginLeft', '0')
    })

    $(document).on("click", function (event) {
        if ($(event.target).closest(".option-company-mobile").length === 0) {
            $('#mySidebar').css('width', '0')
            $('#main').css('marginLeft', '0')
        }
    });

    $(document).scroll(function () {
        if ($('.sticky-wrapper').find('.is-fixed').length > 0) {
            $('.option-company-mobile').find('.sidebar').css('marginTop', '40px')
        } else {
            $('.option-company-mobile').find('.sidebar').css('marginTop', '90px')
        }
    });

    // City Search Autocomplete for Companies Page
    function initCompanyCitySearch() {
        const $cityInput = $('#company_city_search');
        const $cityId = $('#company_city_id');
        const $suggestions = $('#company-city-suggestions');
        let searchTimeout = null;
        let activeSuggestionIndex = -1;

        if (!$cityInput.length) {
            console.log('Company city search input not found');
            return;
        }

        // Unbind previous handlers to avoid duplicates
        $cityInput.off('input keydown');

        // City search autocomplete
        $cityInput.on('input', function() {
            const keyword = $(this).val().trim();
            activeSuggestionIndex = -1;

            // Clear city selection when user types
            $cityId.val('');

            if (searchTimeout) clearTimeout(searchTimeout);

            if (keyword.length < 2) {
                $suggestions.hide().empty();
                return;
            }

            console.log('Searching for cities with keyword:', keyword);
            $suggestions.html('<div class="company-city-loading">Searching...</div>').show();

            searchTimeout = setTimeout(function() {
                const apiUrl = (window.siteUrl || window.location.origin) + '/ajax/search-cities';
                
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    data: { k: keyword },
                    success: function(response) {
                        const cities = response.data || [];
                        
                        if (cities.length === 0) {
                            $suggestions.html('<div class="company-city-no-results">No cities found</div>').show();
                            return;
                        }

                        let html = '';
                        cities.forEach(function(city) {
                            const locationParts = [];
                            if (city.state_name) locationParts.push(city.state_name);
                            if (city.country_name) locationParts.push(city.country_name);
                            
                            html += '<div class="company-city-suggestion-item" ' +
                                'data-id="' + city.id + '" ' +
                                'data-name="' + city.name + '">' +
                                '<div class="city-name">' + city.name + '</div>' +
                                (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') +
                                '</div>';
                        });

                        $suggestions.html(html).show();
                    },
                    error: function(xhr, status, error) {
                        console.error('City search error:', error);
                        $suggestions.html('<div class="company-city-no-results">Error searching cities</div>').show();
                    }
                });
            }, 300);
        });

        // Keyboard navigation for suggestions
        $cityInput.on('keydown', function(e) {
            const $items = $suggestions.find('.company-city-suggestion-item');
            
            if (!$suggestions.is(':visible') || $items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
                $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, -1);
                $items.removeClass('active');
                if (activeSuggestionIndex >= 0) {
                    $items.eq(activeSuggestionIndex).addClass('active');
                }
            } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
                e.preventDefault();
                $items.eq(activeSuggestionIndex).click();
            } else if (e.key === 'Escape') {
                $suggestions.hide();
            }
        });

        // Click on suggestion
        $(document).on('click', '.company-city-suggestion-item', function() {
            const cityId = $(this).data('id');
            const cityName = $(this).data('name');
            
            $cityId.val(cityId);
            $cityInput.val(cityName);
            $suggestions.hide();
            
            // Trigger filter update
            showCompaniesLoader();
            setCurrentPage(1);
            getcompanies();
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.company-city-search-wrapper').length) {
                $suggestions.hide();
            }
        });
    }

    // Initialize city search when document is ready
    $(document).ready(function() {
        initCompanyCitySearch();
    });

    // Also initialize after a short delay to ensure DOM is ready
    setTimeout(function() {
        initCompanyCitySearch();
    }, 500);
})(jQuery)
