'use strict'

function windowScroll() {
    let navbar = document.getElementById('navbar')
    if (navbar) {
        const width = window.innerWidth

        if (
            !!(
                (width > 991 && $(navbar).data('sticky') !== undefined) ||
                (width < 992 && $(navbar).data('mobile-sticky') !== undefined)
            )
        ) {
            if (document.body.scrollTop >= 40 || document.documentElement.scrollTop >= 40) {
                navbar.classList.add('fixed-top')
                navbar.classList.add('sticky')
                navbar.classList.add('nav-sticky')
            } else {
                navbar.classList.remove('fixed-top')
                navbar.classList.remove('sticky')
                navbar.classList.remove('nav-sticky')
            }
        }
    }
}

window.addEventListener('scroll', function (ev) {
    ev.preventDefault()
    windowScroll()
})

/*****************Tooltip Js****************/

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))

tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

//
/********************* scroll top js ************************/
//

let myButton = document.getElementById('back-to-top')

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
    scrollFunction()
}

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        myButton.style.display = 'block'
    } else {
        myButton.style.display = 'none'
    }
}

// When the user clicks on the button, scroll to the top of the document

$('#back-to-top').on('click', function () {
    $('html, body').animate(
        {
            scrollTop: '0px',
        },
        0
    )
})

//
/********************* Page Load js ************************/
//

window.addEventListener('load', function () {
    let preloader = document.getElementById('preloader')

    if (preloader) {
        preloader.style.opacity = '0'
        preloader.style.visibility = 'hidden'
    }
})

// Favourite btn
let favouriteBtn = document.getElementsByClassName('bookmark-btn')
for (let i = 0; i < favouriteBtn.length; i++) {
    let favouriteButtons = favouriteBtn[i]
    favouriteButtons.onclick = function () {
        favouriteButtons.classList.toggle('active')
    }
}

// GLightbox Popup
if (jQuery().GLightbox) {
    GLightbox({
        selector: '.image-popup',
    })
}

$(() => {
    if (typeof Choices != 'undefined') {
        // Fix Choices.js ARIA accessibility issues
        document.addEventListener('DOMContentLoaded', function () {
            // Remove aria-selected from placeholder items as they should not have this attribute
            const observer = new MutationObserver(function (mutations) {
                document.querySelectorAll('.choices__item--selectable.choices__placeholder').forEach(function (el) {
                    el.removeAttribute('aria-selected')
                })
            })
            observer.observe(document.body, { childList: true, subtree: true })

            // Initial cleanup
            setTimeout(function () {
                document.querySelectorAll('.choices__item--selectable.choices__placeholder').forEach(function (el) {
                    el.removeAttribute('aria-selected')
                })
            }, 100)
        })

        if ($('#choices-single-filter-order_by').length) {
            new Choices('#choices-single-filter-order_by')
        }

        if ($('#choices-candidate-page').length) {
            new Choices('#choices-candidate-page')
        }

        const $singleLocation = $('#choices-single-location')
        if ($singleLocation.length) {
            let singleLocation = new Choices($singleLocation[0], {
                searchResultLimit: 5,
                noResultsText: $singleLocation.data('noResultsText') || 'No results found',
                noChoicesText: $singleLocation.data('noChoicesText') || 'No choices to choose from',
                itemSelectText: $singleLocation.data('itemSelectText') || 'Press to select',
                placeholder: true,
                placeholderValue: $singleLocation.data('placeholderValue') || '',
                searchPlaceholderValue: $singleLocation.data('searchPlaceholderValue') || null,
                searchChoices: false,
            })

            let timeout = null

            let ajaxSearchCities = (keyword) => {
                $.ajax({
                    url: $singleLocation.data('url') || window.siteUrl + '/ajax/cities',
                    dataType: 'json',
                    data: {
                        k: keyword,
                    },
                    success: (data) => {
                        singleLocation.setChoices(data.data, 'id', 'label', true)
                    },
                })
            }

            ajaxSearchCities()

            $singleLocation[0].addEventListener('search', function (event) {
                clearTimeout(timeout)

                timeout = setTimeout(function () {
                    ajaxSearchCities(event.detail.value)
                }, 500)
            })
        }

        const $singleCategories = $('#choices-single-categories')
        if ($singleCategories.length) {
            let singleCategories = new Choices($singleCategories[0], {
                searchResultLimit: 10,
                noResultsText: $singleCategories.data('noResultsText') || 'No results found',
                noChoicesText: $singleCategories.data('noChoicesText') || 'No choices to choose from',
                itemSelectText: $singleCategories.data('itemSelectText') || 'Press to select',
                placeholder: true,
                placeholderValue: $singleCategories.data('placeholderValue') || '',
                searchPlaceholderValue: $singleCategories.data('searchPlaceholderValue') || null,
                searchChoices: false,
            })

            let categoryTimeout = null

            let ajaxSearchCategories = (keyword) => {
                $.ajax({
                    url: $singleCategories.data('url') || window.siteUrl + '/ajax/job-categories',
                    dataType: 'json',
                    data: {
                        k: keyword,
                    },
                    success: (data) => {
                        singleCategories.setChoices(data.data, 'value', 'label', true)
                    },
                })
            }

            ajaxSearchCategories()

            $singleCategories[0].addEventListener('search', function (event) {
                clearTimeout(categoryTimeout)

                categoryTimeout = setTimeout(function () {
                    ajaxSearchCategories(event.detail.value)
                }, 500)
            })
        }

        if ($('#choices-text-remove-button').length) {
            new Choices(document.getElementById('choices-text-remove-button'), {
                delimiter: ',',
                editItems: true,
                maxItemCount: 5,
                removeItemButton: true,
            })
        }
    }
})

//
/********************* Counter js ************************/
//

function _toConsumableArray(arr) {
    if (Array.isArray(arr)) {
        let arr2 = []
        for (let i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
            arr2[i] = arr[i]
        }

        return arr2
    }

    return Array.from(arr)
}

let isCounters = document.querySelectorAll('.counter')

isCounters.forEach(function (value) {
    let patt = /(\D+)?(\d+)(\D+)?(\d+)?(\D+)?/
    let time = 1000
    let result = [].concat(_toConsumableArray(patt.exec(value.textContent)))
    let fresh = true
    let ticks

    result.shift()

    result = result.filter(function (res) {
        return res != null
    })

    while (value.firstChild) {
        value.removeChild(value.firstChild)
    }
    result.forEach(function (res) {
        if (isNaN(res)) {
            value.insertAdjacentHTML('beforeend', '<span>' + res + '</span>')
        } else {
            for (let i = 0; i < res.length; i++) {
                value.insertAdjacentHTML(
                    'beforeend',
                    '<span data-value="' +
                        res[i] +
                        '">\n\t\t\t\t\t\t<span>&ndash;</span>\n\t\t\t\t\t\t' +
                        Array(parseInt(res[i]) + 1)
                            .join(0)
                            .split(0)
                            .map(function (x, j) {
                                return '\n\t\t\t\t\t\t\t<span>' + j + '</span>\n\t\t\t\t\t\t'
                            })
                            .join('') +
                        '\n\t\t\t\t\t</span>'
                )
            }
        }
    })

    ticks = [].concat(_toConsumableArray(value.querySelectorAll('span[data-value]')))

    let activate = function () {
        let top = value.getBoundingClientRect().top
        let offset = window.innerHeight * 0.8

        setTimeout(function () {
            fresh = false
        }, time)
        if (top < offset) {
            setTimeout(function () {
                ticks.forEach(
                    function (tick) {
                        let dist = parseInt(tick.getAttribute('data-value')) + 1
                        tick.style.transform = 'translateY(-' + dist * 100 + '%)'
                    },
                    fresh ? time : 0
                )
            })
            window.removeEventListener('scroll', activate)
        }
    }
    window.addEventListener('scroll', activate)
    activate()
})

if (jQuery().Gumshoe) {
    new Gumshoe('#elementsBar a', {
        offset: 90,
    })
}

if (jQuery().SmoothScroll) {
    new SmoothScroll('#elementsBar a', {
        speed: 1000,
        offset: 90,
    })
}

let checkAll = document.getElementById('checkAll')
if (checkAll) {
    checkAll.onclick = function () {
        let checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]')
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.home-slider', {
        slidesPerView: 'auto',
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
    })

    /************** Blog Slider *************/

    new Swiper('.blog-slider', {
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            200: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
        },
    })

    new Swiper('#testimonial-slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            200: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
        },
    })
})

/********************* Area Range Value **********************/

if (jQuery().noUiSlider) {
    let slider1 = document.getElementById('slider1')

    noUiSlider.create(slider1, {
        start: [9],
        step: 1,
        range: {
            min: [1],
            max: [15],
        },
    })

    let slider1Value = document.getElementById('slider1-span')

    slider1.noUiSlider.on('update', function (values, handle) {
        slider1Value.innerHTML = values[handle]
    })
}

/********************* Bar Rating **********************/
function rating() {
    $(document)
        .find('select.rating')
        .each(function () {
            let readOnly
            readOnly = $(this).attr('data-read-only') === 'true'
            $(this).barrating({
                theme: 'css-stars',
                readonly: readOnly,
                emptyValue: '0',
            })
        })
}

/********************* Clickable Toggle **********************/

$(function () {
    $(document).on('click', '[data-toggle="clickable"]', function (e) {
        if ($(e.target).is('a')) return

        window.location.assign($(this).data('url'))
    })

    rating()
})

$(function () {
    const $filterContainer = $('#job-filters-container')

    if (!$filterContainer.length || !$filterContainer.data('loading')) {
        return
    }

    const filterUrl = $filterContainer.data('filter-url')
    const selectedJobExperiences = new URLSearchParams(window.location.search).getAll('job_experiences[]')
    const selectedJobSkills = new URLSearchParams(window.location.search).getAll('job_skills[]')
    const selectedJobType = new URLSearchParams(window.location.search).get('job_type')

    $.ajax({
        url: filterUrl,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.error) {
                console.error('Failed to load filter data:', response.message)
                return
            }

            const data = response.data

            if (data.jobExperiences && data.jobExperiences.length > 0) {
                let experiencesHtml = ''
                data.jobExperiences.forEach(function (experience) {
                    const isChecked = selectedJobExperiences.includes(String(experience.id)) ? 'checked' : ''
                    experiencesHtml += `
                        <div class="form-check mt-2">
                            <input class="form-check-input submit-form-filter" type="checkbox"
                                name="job_experiences[]" value="${experience.id}"
                                id="check-job-experience-${experience.id}" form="jobs-filter-form"
                                ${isChecked}>
                            <label class="form-check-label ms-2 text-muted" for="check-job-experience-${experience.id}">
                                ${experience.name}
                            </label>
                        </div>
                    `
                })
                $('#job-experiences-list').html(experiencesHtml)
            } else {
                $('#job-experiences-list').html('<p class="text-muted">' + 'No experiences available' + '</p>')
            }

            if (data.jobTypes && data.jobTypes.length > 0) {
                let typesHtml = `
                    <div class="form-check">
                        <input class="form-check-input submit-form-filter" type="radio" name="job_type"
                            id="job_type-all" value="" form="jobs-filter-form" ${!selectedJobType ? 'checked' : ''} />
                        <label class="form-check-label ms-2 text-muted" for="job_type-all">
                            All
                        </label>
                    </div>
                `
                data.jobTypes.forEach(function (type) {
                    const isChecked = selectedJobType === String(type.id) ? 'checked' : ''
                    typesHtml += `
                        <div class="form-check mt-2">
                            <input class="form-check-input submit-form-filter" value="${type.id}"
                                type="radio" name="job_type" id="check-job-type-${type.id}"
                                form="jobs-filter-form" ${isChecked}>
                            <label class="form-check-label ms-2 text-muted" for="check-job-type-${type.id}">
                                ${type.name}
                            </label>
                        </div>
                    `
                })
                $('#job-types-list').html(typesHtml)
            } else {
                $('#job-types-list').html('<p class="text-muted">' + 'No job types available' + '</p>')
            }

            if (data.jobSkills && data.jobSkills.length > 0) {
                let skillsHtml = ''
                data.jobSkills.forEach(function (skill) {
                    const isChecked = selectedJobSkills.includes(String(skill.id)) ? 'checked' : ''
                    skillsHtml += `
                        <span class="d-inline-block me-1">
                            <input type="checkbox" class="btn-check submit-form-filter" name="job_skills[]"
                                id="btn-check-outlined-${skill.id}" autocomplete="off"
                                form="jobs-filter-form" value="${skill.id}" ${isChecked}>
                            <label class="badge tag-cloud fs-13 mt-2 btn btn-outline-primary"
                                for="btn-check-outlined-${skill.id}">${skill.name}</label>
                        </span>
                    `
                })
                $('#job-skills-list').html(skillsHtml)
                $('#job-skills-accordion').show()
            } else {
                $('#job-skills-accordion').hide()
            }

            $filterContainer.data('loading', false)
        },
        error: function (xhr, status, error) {
            console.error('AJAX error loading filters:', error)
            $('#job-experiences-list').html('<p class="text-danger">' + 'Failed to load filters' + '</p>')
            $('#job-types-list').html('<p class="text-danger">' + 'Failed to load filters' + '</p>')
            $('#job-skills-list').html('<p class="text-danger">' + 'Failed to load filters' + '</p>')
        },
    })
})
