;(function ($) {
    'use strict'

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    const showError = (message) => {
        window.showAlert('alert-danger', message)
    }

    const showSuccess = (message) => {
        window.showAlert('alert-success', message)
    }

    const handleError = (data) => {
        if (typeof data.errors !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors)
        } else if (typeof data.responseJSON !== 'undefined') {
            if (typeof data.responseJSON.errors !== 'undefined') {
                if (data.status === 422) {
                    handleValidationError(data.responseJSON.errors)
                }
            } else if (typeof data.responseJSON.message !== 'undefined') {
                showError(data.responseJSON.message)
            } else {
                $.each(data.responseJSON, (index, el) => {
                    $.each(el, (key, item) => {
                        showError(item)
                    })
                })
            }
        } else {
            showError(data.statusText)
        }
    }

    const handleValidationError = (errors) => {
        let message = ''
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />'
            }
            message += item
        })
        showError(message)
    }

    window.showAlert = (messageType, message) => {
        if (messageType && message !== '') {
            let alertId = Math.floor(Math.random() * 1000)

            let html =
                `<div class="alert ${messageType} alert-dismissible" id="${alertId}">
                            <span class="close mdi mdi-close-box" data-dismiss="alert" aria-label="close"></span>
                            <i class="` +
                (messageType === 'alert-success' ? 'mdi mdi-check' : 'mdi mdi-close') +
                ` message-icon"></i>
                            ${message}
                        </div>`

            $('#alert-container')
                .append(html)
                .ready(() => {
                    window.setTimeout(() => {
                        $(`#alert-container #${alertId}`).remove()
                    }, 6000)
                })
        }
    }

    $(document).on('click', '.newsletter-form button[type=submit]', function (event) {
        event.preventDefault()
        event.stopPropagation()

        let _self = $(this)
        $.ajax({
            type: 'POST',
            cache: false,
            url: _self.closest('form').prop('action'),
            data: new FormData(_self.closest('form')[0]),
            contentType: false,
            processData: false,
            beforeSend: () => {
                _self.addClass('button-loading')
            },
            success: (res) => {
                if (!res.error) {
                    _self.closest('form').find('input[type=email]').val('')
                    showSuccess(res.message)
                } else {
                    showError(res.message)
                }
            },
            error: (res) => {
                handleError(res)
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }
                _self.removeClass('button-loading')
            },
        })
    })

    function reloadReviewList(page) {
        const reviewableId = $('input[name=reviewable_id]').val()
        const reviewableType = $('input[name=reviewable_type]').val()
        $('.half-circle-spinner').toggle()
        $('.spinner-overflow').toggle()

        page = page || 1

        $.ajax({
            url: window.siteUrl + `/review/load-more?page=${page}&reviewable_id=${reviewableId}&reviewable_type=${reviewableType}`,
            success: function (data) {
                $('.review-list').html(data)
                $('.half-circle-spinner').toggle()
                $('.spinner-overflow').toggle()
            },
        })
    }

    $(document).on('click', '.company-review-form button[type=submit]', function (event) {
        event.preventDefault()
        event.stopPropagation()

        let _self = $(this)
        $.ajax({
            type: 'POST',
            cache: false,
            url: _self.closest('form').prop('action'),
            data: new FormData(_self.closest('form')[0]),
            contentType: false,
            processData: false,
            beforeSend: () => {
                _self.addClass('button-loading')
            },
            success: (res) => {
                if (!res.error) {
                    _self.closest('form').find('textarea').val('')
                    showSuccess(res.message)
                    let page = $('.review-pagination').data('review-last-page')
                    reloadReviewList(page)
                } else {
                    showError(res.message)
                }
            },
            error: (res) => {
                handleError(res)
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }
                _self.removeClass('button-loading')
            },
        })
    })

    let $applyNow = $('#applyNow')

    $applyNow.on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget)
        const jobName = button.data('job-name')
        const jobId = button.data('job-id')

        $applyNow.find('.modal-job-name').text(jobName)
        $applyNow.find('.modal-job-id').val(jobId)
    })

    $applyNow.on('hide.bs.modal', function () {
        $applyNow.find('.modal-job-name').text('')
        $applyNow.find('.modal-job-id').val('')
    })

    let $applyExternalJob = $('#applyExternalJob')

    $applyExternalJob.on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget)
        const jobName = button.data('job-name')
        const jobId = button.data('job-id')

        $applyExternalJob.find('.modal-job-name').text(jobName)
        $applyExternalJob.find('.modal-job-id').val(jobId)
    })

    $applyExternalJob.on('hide.bs.modal', function () {
        $applyExternalJob.find('.modal-job-name').text('')
        $applyExternalJob.find('.modal-job-id').val('')
    })

    $(() => {
        if (window.noticeMessages) {
            window.noticeMessages.forEach((message) => {
                window.showAlert(message.type === 'error' ? 'alert-danger' : 'alert-success', message.message)
            })
        }

        window.jobBoardMaps = {}

        function setJobBoardMap($el) {
            let uid = $el.data('uid')
            if (!uid) {
                uid = (Math.random() + 1).toString(36).substring(7) + new Date().getTime()
                $el.data('uid', uid)
            }
            if (jobBoardMaps[uid]) {
                jobBoardMaps[uid].off()
                jobBoardMaps[uid].remove()
            }

            jobBoardMaps[uid] = L.map($el[0], {
                zoomControl: false,
                scrollWheelZoom: true,
                dragging: true,
                maxZoom: $el.data('max-zoom') || 20,
            }).setView($el.data('center'), $el.data('zoom') || 14)

            let myIcon = L.divIcon({
                className: 'boxmarker',
                iconSize: L.point(50, 20),
                html: $el.data('map-icon'),
            })

            L.tileLayer(
                $el.data('tile-layer')
                    ? $el.data('tile-layer')
                    : 'https://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}'
            ).addTo(jobBoardMaps[uid])

            L.marker($el.data('center'), { icon: myIcon })
                .addTo(jobBoardMaps[uid])
                .bindPopup($($el.data('popup-id')).html())
                .openPopup()
        }

        let $jobMaps = $('.job-board-street-map')
        if ($jobMaps.length) {
            $jobMaps.each(function (i, e) {
                setJobBoardMap($(e))
            })
        }

        $(document).on('click', '.job-bookmark-action', function (e) {
            e.preventDefault()

            const $this = $(e.currentTarget)
            const $parent = $this.closest('.job-box.card')

            $.ajax({
                type: $this.prop('method') || 'POST',
                url: $this.prop('href'),
                data: {
                    job_id: $this.data('job-id'),
                },
                beforeSend: () => {
                    $this.addClass('loading')
                },
                success: (res) => {
                    if (res.error) {
                        showError(res.message)
                        return false
                    }

                    showSuccess(res.message)

                    if (res.data.is_saved) {
                        if ($parent.length) {
                            $parent.addClass('bookmark-post')
                        } else {
                            $this.closest('.favorite-icon').parent().addClass('bookmark-post')
                        }
                    } else {
                        if ($parent.length) {
                            $parent.removeClass('bookmark-post')
                        } else {
                            $this.closest('.favorite-icon').parent().removeClass('bookmark-post')
                        }
                    }
                },
                error: (res) => {
                    if (res.status === 401) {
                        $('#signupModal').modal('show')
                    } else {
                        handleError(res)
                    }
                },
                complete: () => {
                    $this.removeClass('loading')
                },
            })
        })

        $(document).on('submit', '.job-apply-form', function (e) {
            e.preventDefault()

            const $this = $(e.currentTarget)
            let _self = $this.find('button[type=submit]')

            $.ajax({
                type: 'POST',
                cache: false,
                url: $this.prop('action'),
                data: new FormData($this[0]),
                contentType: false,
                processData: false,
                beforeSend: () => {
                    _self.prop('disabled', true).addClass('button-loading')
                },
                success: (res) => {
                    if (!res.error) {
                        if (res.data && res.data.url) {
                            // For external job applications, redirect immediately
                            showSuccess(res.message)
                            window.location.replace(res.data.url)
                        } else {
                            // For internal applications, show success and reload
                            showSuccess(res.message)
                            setTimeout(function () {
                                window.location.reload()
                            }, 1000)
                        }
                    } else {
                        showError(res.message)
                    }
                },
                error: (res) => {
                    handleError(res)
                },
                complete: () => {
                    if (typeof refreshRecaptcha !== 'undefined') {
                        refreshRecaptcha()
                    }
                    _self.prop('disabled', false).removeClass('button-loading')
                },
            })
        })

        let JobBoardApp = {}

        JobBoardApp.$formSearch = $('#jobs-filter-form')
        JobBoardApp.jobListing = '.jobs-listing'
        JobBoardApp.$jobListing = $(JobBoardApp.jobListing)
        JobBoardApp.parseParamsSearch = function (query, includeArray = false) {
            let pairs = query || window.location.search.substring(1)
            let re = /([^&=]+)=?([^&]*)/g
            let decodeRE = /\+/g // Regex for replacing addition symbol with a space
            let decode = function (str) {
                return decodeURIComponent(str.replace(decodeRE, ' '))
            }
            let params = {},
                e
            while ((e = re.exec(pairs))) {
                let k = decode(e[1]),
                    v = decode(e[2])
                if (k.substring(k.length - 2) == '[]') {
                    if (includeArray) {
                        k = k.substring(0, k.length - 2)
                    }
                    ;(params[k] || (params[k] = [])).push(v)
                } else params[k] = v
            }
            return params
        }

        JobBoardApp.changeInputInSearchForm = function (parseParams) {
            JobBoardApp.$formSearch.find('input, select, textarea').each(function (e, i) {
                JobBoardApp.changeInputInSearchFormDetail($(i), parseParams)
            })

            $(':input[form=jobs-filter-form]').each(function (e, i) {
                JobBoardApp.changeInputInSearchFormDetail($(i), parseParams)
            })
        }

        JobBoardApp.changeInputInSearchFormDetail = function ($el, parseParams) {
            const name = $el.attr('name')
            let value = parseParams[name] || null
            const type = $el.attr('type')
            switch (type) {
                case 'checkbox':
                case 'radio':
                    $el.prop('checked', false)
                    if (Array.isArray(value)) {
                        $el.prop('checked', value.includes($el.val()))
                    } else {
                        $el.prop('checked', !!value)
                    }
                    break
                default:
                    if ($el.is('[name=max_price]')) {
                        $el.val(value || $el.data('max'))
                    } else if ($el.is('[name=min_price]')) {
                        $el.val(value || $el.data('min'))
                    } else if ($el.val() != value) {
                        $el.val(value)
                    }
                    break
            }
        }

        JobBoardApp.convertFromDataToArray = function (formData) {
            let data = []
            formData.forEach(function (obj) {
                if (obj.value) {
                    // break with price
                    if (['min_price', 'max_price'].includes(obj.name)) {
                        const dataValue = JobBoardApp.$formSearch
                            .find('input[name=' + obj.name + ']')
                            .data(obj.name.substring(0, 3))
                        if (dataValue == parseInt(obj.value)) {
                            return
                        }
                    }
                    data.push(obj)
                }
            })
            return data
        }

        JobBoardApp.jobsFilter = function () {
            let ajaxSending = null
            $(document).on('submit', '#jobs-filter-form', function (e) {
                e.preventDefault()

                if (ajaxSending) {
                    ajaxSending.abort()
                }

                const $form = $(e.currentTarget)
                const formData = $form.serializeArray()
                let data = JobBoardApp.convertFromDataToArray(formData)
                let uriData = []

                // Paginate
                const $elPage = JobBoardApp.$jobListing.find('input[name=page]')
                if ($elPage.val()) {
                    data.push({ name: 'page', value: $elPage.val() })
                }

                data.map(function (obj) {
                    uriData.push(encodeURIComponent(obj.name) + '=' + obj.value)
                })

                let nextHref = $form.attr('action')
                if (uriData && uriData.length) {
                    nextHref += '?' + uriData.join('&')
                }

                // add to params get to popstate not show json
                data.push({ name: '_', value: +new Date() })

                ajaxSending = $.ajax({
                    url: $form.data('ajax-url'),
                    type: 'GET',
                    data: data,
                    beforeSend: function () {
                        // Show loading before sending
                        JobBoardApp.$jobListing.find('.loading').show()
                        // Animation scroll to filter button
                        $('html, body').animate({ scrollTop: JobBoardApp.$jobListing.offset().top - 200 }, 500)
                    },
                    success: function (res) {
                        if (!res.error) {
                            JobBoardApp.$jobListing.html(res.data)
                            if (res.additional?.message) {
                                JobBoardApp.$jobListing
                                    .closest('.jobs-listing-container')
                                    .find('.showing-of-results')
                                    .html(res.additional.message)
                            }
                            if (nextHref != window.location.href) {
                                window.history.pushState(data, res.message, nextHref)
                            }
                            $('.jobs-list-map.active').map(function (i, e) {
                                JobBoardApp.initMaps($(e))
                            })
                        } else {
                            showError(res.message || 'Opp!')
                        }
                    },
                    error: function (res) {
                        if (res.statusText === 'abort') {
                            return // ignore abort
                        }
                        handleError(res)
                    },
                    complete: function () {
                        JobBoardApp.$jobListing.find('.loading').hide()
                    },
                })
            })

            window.addEventListener(
                'popstate',
                function () {
                    let url = window.location.origin + window.location.pathname
                    if (JobBoardApp.$formSearch.length) {
                        JobBoardApp.$formSearch.attr('action', url)
                        const parseParams = JobBoardApp.parseParamsSearch()
                        JobBoardApp.changeInputInSearchForm(parseParams)
                        JobBoardApp.$formSearch.trigger('submit')
                    } else {
                        history.back()
                    }
                },
                false
            )

            $(document).on('click', JobBoardApp.jobListing + ' .pagination a', function (e) {
                e.preventDefault()
                let aLink = $(e.currentTarget).attr('href')

                if (!aLink.includes(window.location.protocol)) {
                    aLink = window.location.protocol + aLink
                }

                let url = new URL(aLink)
                let page = url.searchParams.get('page')
                JobBoardApp.$jobListing.find('input[name=page]').val(page)
                JobBoardApp.$formSearch.trigger('submit')
            })
        }

        JobBoardApp.jobsFilter()

        $('body').on('change, click', '.submit-form-filter', function (e) {
            const $this = $(e.currentTarget)
            let $form = $this.closest('form')
            if (!$form.length && $this.prop('form')) {
                $form = $($this.prop('form'))
            }

            if ($form.length) {
                $form.trigger('submit')
            }
        })

        JobBoardApp.interpolate = function (string, params) {
            const names = Object.keys(params)
            const vals = Object.values(params)
            return new Function(...names, `return \`${string}\`;`)(...vals)
        }
        let $templatePopup = $('#traffic-popup-map-template').html()

        JobBoardApp.initMaps = function ($map, force = false) {
            if (!$map.length) {
                return false
            }

            let center = $map.data('center') || []
            const $jobBoxes = $('.jobs-listing .job-box[data-latitude][data-longitude]')
            const centerFirst = $jobBoxes.filter(function () {
                return $(this).data('latitude') && $(this).data('longitude')
            })

            if (centerFirst && centerFirst.length) {
                center = [centerFirst.data('latitude'), centerFirst.data('longitude')]
            }

            let uid = $map.data('uid')
            if (!uid) {
                uid = (Math.random() + 1).toString(36).substring(7) + new Date().getTime()
                $map.data('uid', uid)
            }

            let map
            if (window.jobBoardMaps && window.jobBoardMaps[uid]) {
                if (force) {
                    window.jobBoardMaps[uid].off()
                    window.jobBoardMaps[uid].remove()
                } else {
                    map = window.jobBoardMaps[uid]
                    map.eachLayer((layer) => {
                        layer.remove()
                    })
                }
            }

            const data = []
            $jobBoxes.map(function (i, e) {
                const $el = $(e)
                data.push($el.data())
            })

            if (!map) {
                let zoom = $map.data('zoom') || 14
                if (!data.length) {
                    zoom = $map.data('zoom-empty') || 12
                }
                map = L.map($map[0], {
                    zoomControl: true,
                    scrollWheelZoom: true,
                    dragging: true,
                    maxZoom: 18,
                }).setView(center, zoom)
            }

            L.tileLayer(
                $map.data('tile-layer')
                    ? $map.data('tile-layer')
                    : 'https://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z}'
            ).addTo(map)

            let markers = new L.MarkerClusterGroup()
            let markersList = []

            data.forEach((item) => {
                if (item.latitude && item.longitude) {
                    const divIcon = L.divIcon({
                        className: 'boxmarker',
                        iconSize: L.point(50, 20),
                        html: item.map_icon,
                    })
                    let popup = JobBoardApp.interpolate($templatePopup, { item })

                    let m = new L.Marker(new L.LatLng(item.latitude, item.longitude), { icon: divIcon })
                        .bindPopup(popup)
                        .addTo(map)
                    markersList.push(m)
                    markers.addLayer(m)

                    map.flyToBounds(L.latLngBounds(markersList.map((marker) => marker.getLatLng())))
                }
            })

            map.addLayer(markers)

            $map.addClass('active')
            window.jobBoardMaps[uid] = map
        }

        if ($('.jobs-list-sidebar').length) {
            const $sidebar = $('.jobs-list-sidebar')
            const $map = $sidebar.find('.jobs-list-map')

            // Initialize immediately if visible to prevent flickering
            if ($sidebar.is(':visible') && $map.length) {
                // Use requestAnimationFrame to ensure smooth rendering
                requestAnimationFrame(() => {
                    JobBoardApp.initMaps($map)
                })
            }

            $(window).on('resize', function () {
                if ($sidebar.is(':visible') && $map.length) {
                    JobBoardApp.initMaps($map)
                }
            })
        }

        JobBoardApp.setCookie = function (cname, cvalue, exdays) {
            let d = new Date()
            let siteUrl = window.siteUrl

            if (!siteUrl.includes(window.location.protocol)) {
                siteUrl = window.location.protocol + siteUrl
            }

            let url = new URL(siteUrl)
            d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000)
            let expires = 'expires=' + d.toUTCString()
            document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/' + '; domain=' + url.hostname
        }

        $(document).on('click', '.btn-toggle-map', function () {
            let hasActive = $(this).hasClass('active')
            $(this).toggleClass('active')
            const $sidebar = $('.jobs-list-sidebar')

            if (!hasActive) {
                $sidebar.removeClass('d-lg-none')
                const $map = $sidebar.find('.jobs-list-map')
                if (!$map.hasClass('active')) {
                    JobBoardApp.initMaps($map)
                }
            } else {
                $sidebar.addClass('d-lg-none')
            }
            JobBoardApp.setCookie('show_map_on_jobs_page', hasActive ? 0 : 1, 60)
        })

        $('#offcanvas-jobs-map')
            .on('show.bs.offcanvas', function (e) {
                $('[data-bs-target="#offcanvas-jobs-map"]').addClass('active')
                const $this = $(e.currentTarget)
                const $map = $this.find('.jobs-list-map')
                if (!$map.hasClass('active')) {
                    JobBoardApp.initMaps($map)
                }
            })
            .on('hide.bs.offcanvas', function () {
                $('[data-bs-target="#offcanvas-jobs-map"]').removeClass('active')
            })
    })

    $(document).on('click', '.review-pagination a', function (e) {
        e.preventDefault()
        let page = $(this).attr('href').split('page=')[1]
        reloadReviewList(page)
    })

    $(document).on('click', '.navbar .navbar-collapse > .navbar-nav .nav-item > .nav-link', function (e) {
        e.preventDefault()
        const $self = $(e.currentTarget);

        if ($self.prop('target') === '_blank') {
            window.open($self.prop('href'), '_blank');
        } else {
            window.location.href = $self.prop('href')
        }
    })

    $(() => {
        const $tabButtons = $('[data-tab-type]')
        const ajaxUrlTemplate = $tabButtons.first().data('ajax-url')

        if (!ajaxUrlTemplate) {
            return
        }

        const loadJobTab = function ($tabPane, tabType) {
            if ($tabPane.data('loaded') === 'true') {
                return
            }

            const ajaxUrl = ajaxUrlTemplate.replace('__TYPE__', tabType)

            $.ajax({
                url: ajaxUrl,
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                success: function (response) {
                    $tabPane.find('.skeleton-loading').remove()

                    if (response.error === false && response.data && response.data.html) {
                        const viewMoreBtn = `
                            <div class="text-center mt-4 pt-2">
                                <a class="btn btn-primary" href="${$tabPane.data('jobs-url')}">
                                    ${$tabPane.data('view-more-text')} <i class="mdi mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        `
                        $tabPane.html(response.data.html + viewMoreBtn)
                        $tabPane.data('loaded', 'true')
                    }
                },
                error: function (xhr) {
                    console.error('Error loading tab:', xhr)
                },
            })
        }

        $tabButtons.on('shown.bs.tab', function (event) {
            const $button = $(event.currentTarget)
            const tabType = $button.data('tab-type')
            const targetId = $button.data('bs-target')
            const $tabPane = $(targetId)

            loadJobTab($tabPane, tabType)
        })

        const $featuredTab = $('#featured-jobs')
        if ($featuredTab.length && $featuredTab.data('loaded') !== 'true') {
            const tabType = $featuredTab.data('tab-type')
            if (tabType) {
                loadJobTab($featuredTab, tabType)
            }
        }
    })

    $(() => {
        const $categoriesContainer = $('.job-categories-container')
        if ($categoriesContainer.length && $categoriesContainer.data('loaded') !== 'true') {
            const ajaxUrl = $categoriesContainer.data('ajax-url')
            const showJobsCount = $categoriesContainer.data('show-jobs-count')

            if (!ajaxUrl) {
                return
            }

            $.ajax({
                url: ajaxUrl,
                method: 'GET',
                dataType: 'json',
                data: {
                    show_jobs_count: showJobsCount,
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                success: function (response) {
                    $categoriesContainer.find('.skeleton-loading').remove()

                    if (response.error === false && response.data && response.data.html) {
                        $categoriesContainer.html(response.data.html)
                        $categoriesContainer.data('loaded', 'true')
                    }
                },
                error: function (xhr) {
                    console.error('Error loading categories:', xhr)
                },
            })
        }
    })

    $(() => {
        const $featuredCategoriesContainer = $('.featured-job-categories-container')
        if ($featuredCategoriesContainer.length && $featuredCategoriesContainer.data('loaded') !== 'true') {
            const ajaxUrl = $featuredCategoriesContainer.data('ajax-url')
            const showJobsCount = $featuredCategoriesContainer.data('show-jobs-count')
            const limit = $featuredCategoriesContainer.data('limit')

            if (!ajaxUrl) {
                return
            }

            $.ajax({
                url: ajaxUrl,
                method: 'GET',
                dataType: 'json',
                data: {
                    show_jobs_count: showJobsCount,
                    limit: limit,
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                success: function (response) {
                    $featuredCategoriesContainer.find('.skeleton-loading').remove()

                    if (response.error === false && response.data && response.data.html) {
                        $featuredCategoriesContainer.html(response.data.html)
                        $featuredCategoriesContainer.data('loaded', 'true')
                    }
                },
                error: function (xhr) {
                    console.error('Error loading featured categories:', xhr)
                },
            })
        }
    })
})(jQuery)
