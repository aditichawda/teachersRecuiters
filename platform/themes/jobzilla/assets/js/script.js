(function ($) {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const showError = message => {
        window.showAlert('text-danger', message);
    }

    const showSuccess = message => {
        window.showAlert('text-success', message);
    }

    const handleError = data => {
        if (typeof (data.errors) !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors);
        } else if (typeof (data.responseJSON) !== 'undefined') {
            if (typeof (data.responseJSON.errors) !== 'undefined') {
                if (data.status === 422) {
                    handleValidationError(data.responseJSON.errors);
                }
            } else if (typeof (data.responseJSON.message) !== 'undefined') {
                showError(data.responseJSON.message);
            } else {
                $.each(data.responseJSON, (index, el) => {
                    $.each(el, (key, item) => {
                        showError(item);
                    });
                });
            }
        } else {
            showError(data.statusText);
        }
    }

    const handleValidationError = errors => {
        let message = '';
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />';
            }
            message += item;
        });
        showError(message);
    }

    window.showAlert = (messageType, message) => {
        if (messageType && message !== '') {
            let alertId = 'toast-' + Math.floor(Math.random() * 1000);

            let html = `<div class="toast align-items-center ${messageType}" id="${alertId}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="${(messageType === 'text-success' ? 'feather-check-circle' : 'feather-alert-triangle')} message-icon"></i>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`

            $('#alert-container').append(html);

            const toastLive = document.getElementById(alertId)
            const toast = new bootstrap.Toast(toastLive)
            toast.show();
            toastLive.addEventListener('hidden.bs.toast', () => {
                toastLive.remove();
            })
        }
    }

    $(document).on('click', '.job-bookmark-action', function (e) {
        e.preventDefault()

        const $this = $(e.currentTarget)

        $.ajax({
            type: $this.prop('method') || 'POST',
            url: $this.prop('href'),
            data: {
                job_id: $this.data('job-id'),
            },
            beforeSend: () => {
                $this.addClass('button-loading')
            },
            success: (res) => {
                if (res.error) {
                    showError(res.message)
                    return false
                }

                showSuccess(res.message)

                if (res.data.is_saved) {
                    $this.closest('.favorite-icon').addClass('bookmark-post')
                } else {
                    $this.closest('.favorite-icon').removeClass('bookmark-post')
                }
            },
            error: (res) => {
                handleError(res)
            },
            complete: () => {
                $this.removeClass('button-loading')
            },
        })
    })

    $(document).on('submit', '.newsletter-form', function (event) {
        event.preventDefault();
        event.stopPropagation();

        let $form = $(this);
        let $button = $form.find('button[type=submit]');

        $.ajax({
            type: 'POST',
            cache: false,
            url: $form.prop('action'),
            data: new FormData($form[0]),
            contentType: false,
            processData: false,
            beforeSend: () => {
                $button.addClass('button-loading');
            },
            success: res => {
                if (!res.error) {
                    $form.find('input[type=email]').val('');
                    showSuccess(res.message);
                } else {
                    showError(res.message);
                }
            },
            error: res => {
                handleError(res);
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha();
                }
                $button.removeClass('button-loading');
            },
        });
    });

    function reloadReviewList(page) {
        let companyId = $('input[name=company_id]').val();
        $('.half-circle-spinner').toggle();
        $('.spinner-overflow').toggle();

        $.ajax({
            url: window.siteUrl + `/review/load-more?page=${page}&company_id=${companyId}`,
            success: function (data) {
                $('.review-list').html(data)
                $('.half-circle-spinner').toggle()
                $('.spinner-overflow').toggle()
            }
        });
    }

    $(document).on('submit', '.company-review-form', function (event) {
        event.preventDefault();
        event.stopPropagation();

        let $form = $(this);
        let $button = $form.find('button[type=submit]');

        $.ajax({
            type: 'POST',
            cache: false,
            url: $form.prop('action'),
            data: new FormData($form[0]),
            contentType: false,
            processData: false,
            beforeSend: () => {
                $button.addClass('button-loading');
            },
            success: res => {
                if (!res.error) {
                    $form.find('textarea').val('');
                    showSuccess(res.message);
                    let page = $('.review-pagination').data('review-last-page')
                    reloadReviewList(page)
                } else {
                    showError(res.message);
                }
            },
            error: res => {
                handleError(res);
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha();
                }
                $button.removeClass('button-loading');
            },
        });
    });

    let $applyNow = $('#applyNow');

    $applyNow.on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const jobName = button.data('job-name');
        const jobId = button.data('job-id');

        $applyNow.find('.modal-job-name').text(jobName);
        $applyNow.find('.modal-job-id').val(jobId);
    });

    $applyNow.on('hide.bs.modal', function () {
        $applyNow.find('.modal-job-name').text('');
        $applyNow.find('.modal-job-id').val('');
    });

    let $applyExternalJob = $('#applyExternalJob');

    $applyExternalJob.on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const jobName = button.data('job-name');
        const jobId = button.data('job-id');

        $applyExternalJob.find('.modal-job-name').text(jobName);
        $applyExternalJob.find('.modal-job-id').val(jobId);
    });

    $applyExternalJob.on('hide.bs.modal', function () {
        $applyExternalJob.find('.modal-job-name').text('');
        $applyExternalJob.find('.modal-job-id').val('');
    });

    $(document).on('submit', '.job-apply-form', function (e) {
        e.preventDefault();

        const $form = $(e.currentTarget);
        const $button = $form.find('button[type=submit]');

        $.ajax({
            type: 'POST',
            cache: false,
            url: $form.prop('action'),
            data: new FormData($form[0]),
            contentType: false,
            processData: false,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: () => {
                $button.prop('disabled', true).addClass('button-loading');
            },
            success: (res) => {
                if (!res.error) {
                    const applyModal = document.getElementById('applyNow');
                    const extModal = document.getElementById('applyExternalJob');
                    if (applyModal) {
                        const bsModal = bootstrap.Modal.getInstance(applyModal);
                        if (bsModal) bsModal.hide();
                    }
                    if (extModal) {
                        const bsModal = bootstrap.Modal.getInstance(extModal);
                        if (bsModal) bsModal.hide();
                    }
                    showSuccess(res.message);
                    if (res.data && res.data.url) {
                        window.location.replace(res.data.url);
                    } else {
                        window.location.reload();
                    }
                } else {
                    showError(res.message);
                }
            },
            error: (res) => {
                handleError(res);
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha();
                }
                $button.prop('disabled', false).removeClass('button-loading');
            }
        });
    });

    $(document).on('click', '.review-pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        reloadReviewList(page);
    });
})(jQuery);
