class JobFilter {
    searchParams = new URLSearchParams(window.location.search)

    $container = $('.jobs-container')

    $jobsList = this.$container.find('.jobs-listing')

    $loading = this.$container.find('.overlay')

    layout = this.searchParams.get('layout') || 'list'

    $map = this.$container.find('#map')

    constructor() {
        if (this.layout === 'map') {
            this.initMap()
        } else {
            this.$map.hide()
        }

        this.handleFiltersOnChange()
        this.initJobCitySearch()
        this.initJobRoleSearch()
        this.initJobLocationSearch()

        this.$container
            .on('click', '.side-bar-filter .backdrop', function (e) {
                e.preventDefault()
                $(this).parent().removeClass('active')
            })
            .on('click', '.btn-open-filter', () => {
                this.$container.find('.side-bar-filter').addClass('active')
            })
            .on('click', '.btn-close-filter', () => {
                this.$container.find('.side-bar-filter').removeClass('active')
            })
    }

    initJobCitySearch() {
        const $cityInput = $('#job_city_search');
        const $cityId = $('#job_city_id');
        const $suggestions = $('#job-city-suggestions');
        let searchTimeout = null;
        let activeSuggestionIndex = -1;

        if (!$cityInput.length) return;

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

            $suggestions.html('<div class="job-city-loading">Searching...</div>').show();

            searchTimeout = setTimeout(() => {
                const apiUrl = (window.siteUrl || window.location.origin) + '/ajax/search-cities';
                
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    data: { k: keyword },
                    success: (response) => {
                        const cities = response.data || [];
                        
                        if (cities.length === 0) {
                            $suggestions.html('<div class="job-city-no-results">No cities found</div>').show();
                            return;
                        }

                        let html = '';
                        cities.forEach(function(city) {
                            const locationParts = [];
                            if (city.state_name) locationParts.push(city.state_name);
                            if (city.country_name) locationParts.push(city.country_name);
                            
                            html += '<div class="job-city-suggestion-item" ' +
                                'data-id="' + city.id + '" ' +
                                'data-name="' + city.name + '">' +
                                '<div class="city-name">' + city.name + '</div>' +
                                (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') +
                                '</div>';
                        });

                        $suggestions.html(html).show();
                    },
                    error: (xhr, status, error) => {
                        console.error('City search error:', error);
                        $suggestions.html('<div class="job-city-no-results">Error searching cities</div>').show();
                    }
                });
            }, 300);
        });

        // Keyboard navigation for suggestions
        $cityInput.on('keydown', function(e) {
            const $items = $suggestions.find('.job-city-suggestion-item');
            
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
        $(document).on('click', '.job-city-suggestion-item', function() {
            const cityId = $(this).data('id');
            const cityName = $(this).data('name');
            
            $cityId.val(cityId);
            $cityInput.val(cityName);
            $suggestions.hide();
            
            // Trigger filter update
            const event = new Event('change', { bubbles: true });
            $cityId[0].dispatchEvent(event);
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.job-city-search-wrapper').length) {
                $suggestions.hide();
            }
        });
    }

    initJobRoleSearch() {
        const $roleInput = $('#job_role_search');
        const $roleId = $('#job_role_id');
        const $suggestions = $('#job-role-suggestions');
        let activeSuggestionIndex = -1;
        let rolesLoaded = false;

        if (!$roleInput.length) return;

        // Load all job roles on click
        $roleInput.on('click focus', function() {
            if (rolesLoaded && $suggestions.children().length > 0) {
                $suggestions.show();
                return;
            }

            $suggestions.html('<div class="job-role-loading">Loading...</div>').show();

            const apiUrl = (window.siteUrl || window.location.origin) + '/ajax/job-roles';
            
            $.ajax({
                url: apiUrl,
                type: 'GET',
                data: { k: '' }, // Empty keyword to get all roles
                success: (response) => {
                    const roles = response.data || [];
                    
                    if (roles.length === 0) {
                        $suggestions.html('<div class="job-role-no-results">No job roles found</div>').show();
                        return;
                    }

                    let html = '';
                    roles.forEach(function(role) {
                        html += '<div class="job-role-suggestion-item" ' +
                            'data-id="' + role.id + '" ' +
                            'data-name="' + role.name + '">' +
                            '<div class="role-name">' + role.name + '</div>' +
                            '</div>';
                    });

                    $suggestions.html(html).show();
                    rolesLoaded = true;
                },
                error: (xhr, status, error) => {
                    console.error('Job role search error:', error);
                    $suggestions.html('<div class="job-role-no-results">Error loading job roles</div>').show();
                }
            });
        });

        // Filter roles on input
        $roleInput.on('input', function() {
            const keyword = $(this).val().toLowerCase().trim();
            activeSuggestionIndex = -1;

            if (!rolesLoaded) return;

            const $items = $suggestions.find('.job-role-suggestion-item');
            
            if (keyword.length === 0) {
                $items.show();
                return;
            }

            $items.each(function() {
                const roleName = $(this).find('.role-name').text().toLowerCase();
                if (roleName.includes(keyword)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($items.filter(':visible').length === 0) {
                $suggestions.html('<div class="job-role-no-results">No matching job roles</div>');
            } else {
                // Reset active index when filtering
                activeSuggestionIndex = -1;
            }
        });

        // Keyboard navigation for suggestions
        $roleInput.on('keydown', function(e) {
            const $items = $suggestions.find('.job-role-suggestion-item:visible');
            
            if (!$suggestions.is(':visible') || $items.length === 0) {
                // If dropdown not visible, trigger click to load
                if (e.key !== 'Escape' && e.key !== 'Tab') {
                    $roleInput.trigger('click');
                }
                return;
            }

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
                $items.removeClass('active');
                $items.eq(activeSuggestionIndex).addClass('active');
                // Scroll into view
                const $active = $items.eq(activeSuggestionIndex);
                if ($active.length) {
                    $active[0].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, -1);
                $items.removeClass('active');
                if (activeSuggestionIndex >= 0) {
                    $items.eq(activeSuggestionIndex).addClass('active');
                    const $active = $items.eq(activeSuggestionIndex);
                    if ($active.length) {
                        $active[0].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                    }
                }
            } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
                e.preventDefault();
                $items.eq(activeSuggestionIndex).click();
            } else if (e.key === 'Escape') {
                $suggestions.hide();
            }
        });

        // Click on suggestion
        $(document).on('click', '.job-role-suggestion-item', function() {
            const roleId = $(this).data('id');
            const roleName = $(this).data('name');
            
            $roleId.val(roleId);
            $roleInput.val(roleName);
            $suggestions.hide();
            rolesLoaded = false; // Reset so it reloads on next click
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.job-role-search-wrapper').length) {
                $suggestions.hide();
            }
        });
    }

    initJobLocationSearch() {
        const $locationInput = $('#job_location_search');
        const $cityId = $('#job_location_city_id');
        const $suggestions = $('#job-location-suggestions');
        let searchTimeout = null;
        let activeSuggestionIndex = -1;

        if (!$locationInput.length) return;

        // City search autocomplete (same as signin/login)
        $locationInput.on('input', function() {
            const keyword = $(this).val().trim();
            activeSuggestionIndex = -1;

            // Clear city selection when user types
            $cityId.val('');

            if (searchTimeout) clearTimeout(searchTimeout);

            if (keyword.length < 2) {
                $suggestions.hide().empty();
                return;
            }

            $suggestions.html('<div class="job-location-loading">Searching...</div>').show();

            searchTimeout = setTimeout(() => {
                const apiUrl = (window.siteUrl || window.location.origin) + '/ajax/search-cities';
                
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    data: { k: keyword },
                    success: (response) => {
                        const cities = response.data || [];
                        
                        if (cities.length === 0) {
                            $suggestions.html('<div class="job-location-no-results">No cities found</div>').show();
                            return;
                        }

                        let html = '';
                        cities.forEach(function(city) {
                            const locationParts = [];
                            if (city.state_name) locationParts.push(city.state_name);
                            if (city.country_name) locationParts.push(city.country_name);
                            
                            html += '<div class="job-location-suggestion-item" ' +
                                'data-id="' + city.id + '" ' +
                                'data-name="' + city.name + '">' +
                                '<div class="city-name">' + city.name + '</div>' +
                                (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') +
                                '</div>';
                        });

                        $suggestions.html(html).show();
                    },
                    error: (xhr, status, error) => {
                        console.error('City search error:', error);
                        $suggestions.html('<div class="job-location-no-results">Error searching cities</div>').show();
                    }
                });
            }, 300);
        });

        // Keyboard navigation for suggestions
        $locationInput.on('keydown', function(e) {
            const $items = $suggestions.find('.job-location-suggestion-item');
            
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
        $(document).on('click', '.job-location-suggestion-item', function() {
            const cityId = $(this).data('id');
            const cityName = $(this).data('name');
            
            $cityId.val(cityId);
            $locationInput.val(cityName);
            $suggestions.hide();
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.job-location-search-wrapper').length) {
                $suggestions.hide();
            }
        });
    }

    submit() {
        const $form = this.$container.find('#jobs-filter-form')
        const searchParams = this.searchParams.toString()

        const {method, action} = $form.get(0);
        const ajaxUrl = $form.data('ajax-url')
        const url = searchParams ? `${ajaxUrl}?${searchParams}` : ajaxUrl;

        window.history.pushState({}, '', `${action}?${searchParams}`)

        if (!searchParams) {
            window.history.pushState({}, '', action)
        }

        $.ajax({
            method,
            url,
            beforeSend: () => {
                this.$loading.show()
                this.scrollToTop()
            },
            success: (response) => {
                const {data, message} = response

                this.$jobsList.html(data)
                this.$container.find('.woocommerce-result-count-left').text(message)
            },
            complete: () => {
                this.$loading.hide()
            }
        })
    }

    handleFiltersOnChange() {
        this.$container.on('change', (event) => {
            this.updateSearchParams(event)

            this.submit()

            if (this.searchParams.get('layout') === 'map') {
                this.initMap()
            } else {
                this.$map.hide()
            }
        })

        this.$container.on('click', '.pagination li a', (e) => {
            e.preventDefault()

            const url = new URL(e.target.href)

            this.searchParams.set('page', url.searchParams.get('page'))

            this.submit()
        })
    }

    updateSearchParams(event) {
        const {name, value} = event.target

        if (name.includes('[]')) {
            this.searchParams.delete(name)

            $.each($(`input[name="${name}"]`), (index, item) => {
                if ($(item).prop('checked')) {
                    this.searchParams.append(name, $(item).val())
                }
            })
        } else {
            this.searchParams.set(name, value)
        }
    }

    scrollToTop() {
        $('html, body').animate({
            scrollTop: this.$container.offset().top - 130
        }, 0)
    }

    initMap() {
        if (! this.$map.length) {
            return
        }

        this.$map.show()

        if (window.currentMap) {
            window.currentMap.off()
            window.currentMap.remove()
        }

        const map = L.map('map', {
            zoomControl: true,
            scrollWheelZoom: true,
            dragging: true,
        }).setView(this.$map.data('center'), 13)

        const langCode = $('html').prop('lang') || 'en'

        L.tileLayer(`https://mt0.google.com/vt/lyrs=m&hl=${langCode}&x={x}&y={y}&z={z}`, {
            maxZoom: 19,
        }).addTo(map)

        const markers = L.markerClusterGroup()

        let markersList = []

        this.$container.find('.job-board-street-map').map((index, item) => {
            const $item = $(item)
            const job = $item.data('job')

            if (! job || ! job.latitude || ! job.longitude) {
                return
            }

            const icon = L.divIcon({
                iconSize: L.point(50, 20),
                html: $item.data('map-icon')
            });

            const marker = L.marker([job.latitude, job.longitude], {icon: icon})
                .bindPopup(`
                    <div class="job-map-item">
                        <img src="${$item.data('company-logo')}" alt="${job.company.name}">
                        <div>
                            <h4>${job.company.name}</h4>
                            <a href="${$item.data('url')}">
                                <h5>${job.name}</h5>
                            </a>
                            <span>${$item.data('full-address')}</span>
                        </div>
                    </div>
                `)

            markersList.push(marker)
            markers.addLayer(marker)

            map.flyToBounds(L.latLngBounds(markersList.map(marker => marker.getLatLng())))
        })

        map.addLayer(markers)

        window.currentMap = map
    }
}

$(() => new JobFilter())
