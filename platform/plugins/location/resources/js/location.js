class Location {
    // Show error message - works on both admin and frontend
    static showError(message) {
        if (typeof Botble !== 'undefined' && Botble.showError) {
            Botble.showError(message)
        } else if (typeof Theme !== 'undefined' && Theme.showError) {
            Theme.showError(message)
        } else if (typeof toastr !== 'undefined') {
            toastr.error(message)
        } else {
            console.error(message)
        }
    }

    // Refresh Select2 instance after options update
    static refreshSelect2($el) {
        if (
            jQuery().select2 &&
            ($el.hasClass('select-search-location') || $el.hasClass('select-search-full')) &&
            $el.hasClass('select2-hidden-accessible')
        ) {
            // Destroy and reinitialize to refresh options
            $el.select2('destroy')
            Location.initSelect2($el)
        }
    }

    // Initialize Select2 on a single element
    static initSelect2($el) {
        if (
            !jQuery().select2 ||
            (!$el.hasClass('select-search-location') && !$el.hasClass('select-search-full'))
        ) {
            return
        }

        // Skip if already initialized
        if ($el.hasClass('select2-hidden-accessible')) {
            return
        }

        const placeholder = $el.find('option:first').text() || 'Select...'

        let options = {
            width: '100%',
            placeholder: placeholder,
            allowClear: false,
            minimumResultsForSearch: 0, // Always show search box
        }

        // Find parent for dropdown positioning
        let parent = $el.closest('div[data-select2-dropdown-parent]') || $el.closest('.modal')
        if (parent.length) {
            options.dropdownParent = parent
        }

        $el.select2(options)
    }

    static getStates($el, countryId, $button = null) {
        return $.ajax({
            url: $el.data('url'),
            data: {
                country_id: countryId,
            },
            type: 'GET',
            beforeSend: () => {
                $button && $button.prop('disabled', true)
            },
            success: (res) => {
                if (res.error) {
                    Location.showError(res.message)
                } else {
                    let options = ''
                    $.each(res.data, (index, item) => {
                        options += '<option value="' + (item.id || '') + '">' + item.name + '</option>'
                    })

                    $el.html(options)
                    Location.refreshSelect2($el)
                }
            },
            complete: () => {
                $button && $button.prop('disabled', false)
            },
        })
    }

    static getCities($el, stateId, $button = null, countryId = null) {
        return $.ajax({
            url: $el.data('url'),
            data: {
                state_id: stateId,
                country_id: countryId,
            },
            type: 'GET',
            beforeSend: () => {
                $button && $button.prop('disabled', true)
            },
            success: (res) => {
                if (res.error) {
                    Location.showError(res.message)
                } else {
                    let options = ''
                    $.each(res.data, (index, item) => {
                        options +=
                            '<option value="' +
                            (item.id || '') +
                            '" data-state-id="' +
                            (item.state_id || '') +
                            '" data-country-id="' +
                            (item.country_id || '') +
                            '">' +
                            item.name +
                            '</option>'
                    })

                    $el.html(options)
                    Location.refreshSelect2($el)
                }
            },
            complete: () => {
                $button && $button.prop('disabled', false)
            },
        })
    }

    init() {
        const country = 'select[data-type="country"]'
        const state = 'select[data-type="state"]'
        const city = 'select[data-type="city"]'

        function initCityFirstSearch() {
            $(document).find('.js-location-city-search').each(function () {
                const $search = $(this)
                if ($search.data('city-first-init')) {
                    return
                }
                $search.data('city-first-init', 1)

                const $group = $search.closest('.select-location-fields').length
                    ? $search.closest('.select-location-fields')
                    : $search.closest('.js-location-city-first').parent()
                const $cityId = $group.find('.js-location-city-id')
                const $stateId = $group.find('.js-location-state-id')
                const $countryId = $group.find('.js-location-country-id')
                const $stateDisplay = $group.find('.js-location-state-display')
                const $countryDisplay = $group.find('.js-location-country-display')
                const $suggestions = $search.siblings('.js-location-city-suggestions')
                const searchUrl =
                    $search.attr('data-search-url') || $search.data('searchUrl') || $search.data('search-url')
                let timer = null

                const render = (rows) => {
                    if (!Array.isArray(rows) || rows.length === 0) {
                        $suggestions.html('<div class="list-group-item text-muted small">No cities found</div>').show()
                        return
                    }

                    let html = ''
                    rows.forEach((item) => {
                        const stateName = item.state_name || ''
                        const countryName = item.country_name || ''
                        const meta = [stateName, countryName].filter(Boolean).join(', ')
                        html +=
                            '<button type="button" class="list-group-item list-group-item-action js-location-city-item" ' +
                            'data-id="' + (item.id || '') + '" ' +
                            'data-name="' + (item.name || '') + '" ' +
                            'data-state-id="' + (item.state_id || '') + '" ' +
                            'data-state-name="' + stateName.replace(/"/g, '&quot;') + '" ' +
                            'data-country-id="' + (item.country_id || '') + '" ' +
                            'data-country-name="' + countryName.replace(/"/g, '&quot;') + '">' +
                            '<div><strong>' + (item.name || '') + '</strong>' +
                            (meta ? ' <span class="text-muted small">(' + meta + ')</span>' : '') +
                            '</div></button>'
                    })

                    $suggestions.html(html).show()
                }

                const extractCityRows = (res) => {
                    const d = res && res.data
                    if (d == null) {
                        return []
                    }
                    if (Array.isArray(d)) {
                        return d
                    }
                    if (Array.isArray(d.cities)) {
                        return d.cities
                    }
                    if (Array.isArray(d.data)) {
                        return d.data
                    }

                    return []
                }

                const loadCities = (keyword) => {
                    if (!searchUrl) return
                    const k = String(keyword || '').trim()
                    const url = k.length >= 2
                        ? searchUrl + '?k=' + encodeURIComponent(k)
                        : searchUrl + '?default_country=1'

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: (res) => {
                            render(extractCityRows(res))
                        },
                        error: () => {
                            $suggestions.html('<div class="list-group-item text-danger small">Could not load cities</div>').show()
                        },
                    })
                }

                // Open suggestions on focus or click so users always see sample cities without typing.
                $search.on('focus click', function () {
                    loadCities($search.val())
                })

                $search.on('input', function () {
                    if (timer) clearTimeout(timer)
                    $cityId.val('')
                    $stateId.val('')
                    $countryId.val('')
                    $stateDisplay.val('')
                    $countryDisplay.val('')
                    timer = setTimeout(() => {
                        loadCities($search.val())
                    }, 250)
                })

                $suggestions.on('click', '.js-location-city-item', function () {
                    const $item = $(this)
                    // Use .attr() for data-* so values are reliable across jQuery versions (admin vs theme).
                    $search.val($item.attr('data-name') || '')
                    $cityId.val($item.attr('data-id') || '')
                    $stateId.val($item.attr('data-state-id') || '')
                    $countryId.val($item.attr('data-country-id') || '')
                    $stateDisplay.val($item.attr('data-state-name') || '')
                    $countryDisplay.val($item.attr('data-country-name') || '')
                    $suggestions.hide()
                })

                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.js-location-city-first').length) {
                        $suggestions.hide()
                    }
                })
            })
        }

        // Initialize Select2 on all location selects with select-search-location class
        function initLocationSelect2() {
            if (!jQuery().select2) {
                return
            }

            $(document).find('select[data-type].select-search-location, select[data-type].select-search-full').each(function (index, el) {
                Location.initSelect2($(el))
            })
        }

        // Initialize on page load
        initLocationSelect2()
        initCityFirstSearch()

        $(document).on('change', country, function (e) {
            e.preventDefault()

            const $parent = getParent($(e.currentTarget))

            const $state = $parent.find(state)
            const $city = $parent.find(city)

            $state.find('option:not([value=""]):not([value="0"])').remove()
            $city.find('option:not([value=""]):not([value="0"])').remove()

            // Refresh Select2 for cleared dropdowns
            Location.refreshSelect2($state)
            Location.refreshSelect2($city)

            const $button = $(e.currentTarget).closest('form').find('button[type=submit], input[type=submit]')
            const countryId = $(e.currentTarget).val()

            if (countryId) {
                if ($state.length) {
                    Location.getStates($state, countryId, $button)
                    Location.getCities($city, null, $button, countryId)
                } else {
                    Location.getCities($city, null, $button, countryId)
                }
            }
        })

        $(document).on('change', state, function (e) {
            e.preventDefault()

            const $parent = getParent($(e.currentTarget))
            const $city = $parent.find(city)

            if ($city.length) {
                $city.find('option:not([value=""]):not([value="0"])').remove()
                Location.refreshSelect2($city)

                const stateId = $(e.currentTarget).val()
                const $button = $(e.currentTarget).closest('form').find('button[type=submit], input[type=submit]')

                if (stateId) {
                    Location.getCities($city, stateId, $button)
                } else {
                    const countryId = $parent.find(country).val()

                    Location.getCities($city, null, $button, countryId)
                }
            }
        })

        // City-first selection: auto-select state and country from selected city
        $(document).on('change', city, function (e) {
            e.preventDefault()

            const $city = $(e.currentTarget)

            if ($city.data('auto-selecting-location')) {
                $city.removeData('auto-selecting-location')
                return
            }

            const $selected = $city.find('option:selected')
            let stateId = String($selected.data('state-id') || '')
            let countryId = String($selected.data('country-id') || '')

            const $parent = getParent($city)
            const $state = $parent.find(state)
            const $country = $parent.find(country)
            const cityId = $city.val()
            const $button = $city.closest('form').find('button[type=submit], input[type=submit]')

            const selectCityBack = () => {
                if (!cityId || !$city.length) {
                    return
                }

                if ($city.find('option[value="' + cityId + '"]').length) {
                    $city.val(cityId)
                    Location.refreshSelect2($city)
                }
            }

            const applyStateAndCity = () => {
                if (!$state.length || !stateId) {
                    return
                }

                const applyLoadedState = () => {
                    if (!$state.find('option[value="' + stateId + '"]').length) {
                        return
                    }

                    $state.val(stateId)
                    Location.refreshSelect2($state)

                    Location.getCities($city, stateId, $button)
                        .always(() => {
                            selectCityBack()
                        })
                }

                if ($state.find('option[value="' + stateId + '"]').length) {
                    applyLoadedState()
                } else if (countryId) {
                    Location.getStates($state, countryId, $button)
                        .always(() => {
                            applyLoadedState()
                        })
                }
            }

            const applyDetectedLocation = () => {
                if ($country.length && countryId) {
                    if (String($country.val() || '') !== countryId) {
                        $country.val(countryId)
                        Location.refreshSelect2($country)
                    }
                }

                applyStateAndCity()
            }

            // If city option doesn't carry state/country attributes, resolve using city search endpoint.
            if ((!stateId || !countryId) && cityId) {
                const cityName = String($selected.text() || '').trim()
                const searchUrl = $city.data('search-url')

                if (searchUrl && cityName.length >= 2) {
                    $.ajax({
                        url: searchUrl,
                        type: 'GET',
                        data: {
                            k: cityName,
                        },
                        success: (res) => {
                            const rows = Array.isArray(res?.data) ? res.data : []
                            const exact = rows.find((item) => String(item.id || '') === String(cityId))

                            if (exact) {
                                stateId = String(exact.state_id || stateId || '')
                                countryId = String(exact.country_id || countryId || '')
                            }

                            applyDetectedLocation()
                        },
                        error: () => {
                            applyDetectedLocation()
                        },
                    })

                    return
                }
            }

            applyDetectedLocation()
        })

        function getParent($el) {
            let $parent = $(document)
            let formParent = $el.data('form-parent')
            if (formParent && $(formParent).length) {
                $parent = $(formParent)
            }

            return $parent
        }
    }
}

$(() => {
    new Location().init()
})
