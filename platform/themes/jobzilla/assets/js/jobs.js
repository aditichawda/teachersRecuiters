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
