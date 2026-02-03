(function ($) {
    const candidates = $('.candidates')

    const Loading = $('#page-loading')

    let filterAjax = null

    function getCandidates() {
        const form = $('form#candidate-filter-form');
        const formData = form.serialize();
        const action = form.attr('action');
        const currentUrl = location.origin + location.pathname;

        if (filterAjax) {
            filterAjax.abort();
        }

        filterAjax = $.ajax({
            url: action,
            method: 'GET',
            data: formData,
            beforeSend: () => {
                Loading.show()
                window.history.pushState(
                    formData,
                    null,
                    `${currentUrl}?${formData}`
                )
            },
            success: (response) => {
                $('.candidates-content').html(response.data.list)
                $('.woocommerce-result-count-left').text(response.data.total_text)
            },
            complete: function () {
                Loading.hide()
            }
        })
    }

    function setCurrentPage(page) {
        candidates.find('input[name="page"]').val(page);
    }

    candidates.on('change', '.select-per-page', function (e) {
        e.preventDefault();
        candidates.find('input[name="per_page"]').val($(this).val());
        setCurrentPage(1)
        getCandidates();
    })

    candidates.on('change', '.select-sort-by', function (e) {
        e.preventDefault();
        candidates.find('input[name="sort_by"]').val($(this).val());
        getCandidates();
    })

    candidates.on('change', '.select-layout', function (e) {
        e.preventDefault();
        candidates.find('input[name="layout"]').val($(this).val());
        getCandidates();
    })

    candidates.on('click', 'a.pagination-button', function (e) {
        e.preventDefault();
        setCurrentPage($(this).data('page'))
        getCandidates();
    })

    candidates.on('click', '.btn-open-sidebar', function () {
        candidates.find('#mySidebar').css('width', '300px')
        candidates.find('#main').css('marginLeft', '300px')
    })

    candidates.on('click', '.btn-close-sidebar', function () {
        candidates.find('#mySidebar').css('width', '0')
        candidates.find('#main').css('marginLeft', '0')
    })

    $(document).on("click", function (event) {
        if ($(event.target).closest(".option-candidate-mobile").length === 0) {
            candidates.find('#mySidebar').css('width', '0')
            candidates.find('#main').css('marginLeft', '0')
        }
    });

    $(document).scroll(function () {
        if ($('.sticky-wrapper').find('.is-fixed').length > 0) {
            $('.option-candidate-mobile').find('.sidebar').css('marginTop', '40px')
        } else {
            $('.option-candidate-mobile').find('.sidebar').css('marginTop', '90px')
        }
    });
})(jQuery)
