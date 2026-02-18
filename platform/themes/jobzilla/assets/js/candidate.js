class CandidateFilter {
    searchParams = new URLSearchParams(window.location.search)

    $container = $('.candidates-container')

    $candidatesList = this.$container.find('.candidates-listing')

    $loading = $('#page-loading')

    layout = this.searchParams.get('layout') || 'grid'

    constructor() {
        // Initialize searchParams from current URL
        this.initializeFromUrl()
        this.handleFiltersOnChange()
        this.initCitySelect()

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

    initializeFromUrl() {
        // Update form values from URL parameters
        const $form = this.$container.find('#candidate-filter-form')
        
        // Update text inputs
        this.searchParams.forEach((value, key) => {
            if (key.includes('[]')) {
                // Handle array parameters
                const baseName = key.replace('[]', '')
                const values = this.searchParams.getAll(key)
                values.forEach((val) => {
                    $form.find(`input[name="${baseName}[]"][value="${val}"]`).prop('checked', true)
                })
            } else {
                const $input = $form.find(`[name="${key}"]`)
                if ($input.length) {
                    if ($input.is('select')) {
                        $input.val(value).trigger('change')
                    } else {
                        $input.val(value)
                    }
                }
            }
        })
    }

    initCitySelect() {
        const $citySelect = this.$container.find('.selectpicker-location')
        if ($citySelect.length && typeof $citySelect.select2 === 'function') {
            // Handle select2 change event
            $citySelect.on('change', (e) => {
                this.updateSearchParams(e)
                this.submit()
            })
        }
    }

    submit() {
        const $form = this.$container.find('#candidate-filter-form')
        const formData = $form.serializeArray()
        const searchParams = new URLSearchParams()

        // Process form data
        formData.forEach((item) => {
            if (item.value && item.value !== '') {
                if (item.name.includes('[]')) {
                    // For array parameters, use append to create multiple entries
                    searchParams.append(item.name, item.value)
                } else {
                    searchParams.set(item.name, item.value)
                }
            }
        })

        // Also handle select2 for city (if not in form serialize)
        const $citySelect = $form.find('.selectpicker-location')
        if ($citySelect.length && $citySelect.val()) {
            searchParams.set('city_id', $citySelect.val())
        }

        const ajaxUrl = $form.data('ajax-url') || $form.attr('action')
        const queryString = searchParams.toString()
        const url = queryString ? `${ajaxUrl}?${queryString}` : ajaxUrl

        window.history.pushState({}, '', `${window.location.pathname}${queryString ? '?' + queryString : ''}`)

        $.ajax({
            method: 'GET',
            url,
            beforeSend: () => {
                this.$loading.show()
                this.scrollToTop()
            },
            success: (response) => {
                const {data} = response
                this.$candidatesList.html(data.list)
                this.$container.find('.woocommerce-result-count-left').text(data.total_text)
            },
            complete: () => {
                this.$loading.hide()
            }
        })
    }

    handleFiltersOnChange() {
        // Handle form submit
        this.$container.on('submit', '#candidate-filter-form', (e) => {
            e.preventDefault()
            this.submit()
        })

        // Handle filter changes (auto-submit for some fields, manual submit for others)
        this.$container.on('change', '#candidate-filter-form input[type="checkbox"], #candidate-filter-form input[type="radio"]', (event) => {
            this.updateSearchParams(event)
            this.submit()
        })

        // Handle select2 change for city
        this.$container.on('change', '.selectpicker-location', (event) => {
            this.updateSearchParams(event)
            this.submit()
        })

        // Handle other selects (but not keyword input - that should only submit on button click or enter)
        this.$container.on('change', '#candidate-filter-form select:not(.selectpicker-location)', (event) => {
            this.updateSearchParams(event)
            this.submit()
        })

        // Handle keyword input - submit on Enter key or search button click
        this.$container.on('keypress', '#candidate-filter-form input[name="keyword"]', (e) => {
            if (e.which === 13) { // Enter key
                e.preventDefault()
                this.submit()
            }
        })

        this.$container.on('click', '#candidate-filter-form button[type="submit"]', (e) => {
            e.preventDefault()
            this.submit()
        })

        // Handle sort, per page, layout changes
        this.$container.on('change', '.select-per-page, .select-sort-by, .select-layout', (event) => {
            const $target = $(event.target)
            const name = $target.attr('name')
            const value = $target.val()

            if (name) {
                this.searchParams.set(name, value)
            }

            // Update hidden inputs in form
            const $form = this.$container.find('#candidate-filter-form')
            $form.find(`input[name="${name}"]`).val(value)

            this.submit()
        })

        // Handle pagination
        this.$container.on('click', '.pagination li a, a.pagination-button', (e) => {
            e.preventDefault()

            const url = new URL(e.target.href || $(e.target).attr('href'))
            const page = url.searchParams.get('page') || $(e.target).data('page')

            if (page) {
                this.searchParams.set('page', page)
                const $form = this.$container.find('#candidate-filter-form')
                $form.find('input[name="page"]').val(page)
                this.submit()
            }
        })
    }

    updateSearchParams(event) {
        const $target = $(event.target)
        const name = $target.attr('name')
        const value = $target.val()
        const type = $target.attr('type')

        if (!name) return

        if (name.includes('[]')) {
            const baseName = name.replace('[]', '[]')
            // Remove all existing values for this array
            this.searchParams.delete(baseName)

            // Add all checked values
            $(`input[name="${name}"]:checked`).each((index, item) => {
                this.searchParams.append(baseName, $(item).val())
            })
        } else {
            if (value && value !== '') {
                this.searchParams.set(name, value)
            } else {
                this.searchParams.delete(name)
            }
        }
    }

    scrollToTop() {
        $('html, body').animate({
            scrollTop: this.$container.offset().top - 100
        }, 300)
    }
}

$(document).ready(function() {
    if ($('.candidates-container').length) {
        new CandidateFilter()
    }
})
