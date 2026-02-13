/******/ (() => { // webpackBootstrap
/*!******************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/script.js ***!
  \******************************************************/
(function ($) {
  'use strict';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var showError = function showError(message) {
    window.showAlert('text-danger', message);
  };
  var showSuccess = function showSuccess(message) {
    window.showAlert('text-success', message);
  };
  var handleError = function handleError(data) {
    if (typeof data.errors !== 'undefined' && data.errors.length) {
      handleValidationError(data.errors);
    } else if (typeof data.responseJSON !== 'undefined') {
      if (typeof data.responseJSON.errors !== 'undefined') {
        if (data.status === 422) {
          handleValidationError(data.responseJSON.errors);
        }
      } else if (typeof data.responseJSON.message !== 'undefined') {
        showError(data.responseJSON.message);
      } else {
        $.each(data.responseJSON, function (index, el) {
          $.each(el, function (key, item) {
            showError(item);
          });
        });
      }
    } else {
      showError(data.statusText);
    }
  };
  var handleValidationError = function handleValidationError(errors) {
    var message = '';
    $.each(errors, function (index, item) {
      if (message !== '') {
        message += '<br />';
      }
      message += item;
    });
    showError(message);
  };
  window.showAlert = function (messageType, message) {
    if (messageType && message !== '') {
      var alertId = 'toast-' + Math.floor(Math.random() * 1000);
      var html = "<div class=\"toast align-items-center ".concat(messageType, "\" id=\"").concat(alertId, "\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\">\n                <div class=\"d-flex\">\n                    <div class=\"toast-body\">\n                        <i class=\"").concat(messageType === 'text-success' ? 'feather-check-circle' : 'feather-alert-triangle', " message-icon\"></i>\n                        <span>").concat(message, "</span>\n                    </div>\n                    <button type=\"button\" class=\"btn-close me-2 m-auto\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>\n                </div>\n            </div>");
      $('#alert-container').append(html);
      var toastLive = document.getElementById(alertId);
      var toast = new bootstrap.Toast(toastLive);
      toast.show();
      toastLive.addEventListener('hidden.bs.toast', function () {
        toastLive.remove();
      });
    }
  };
  $(document).on('click', '.job-bookmark-action', function (e) {
    e.preventDefault();
    var $this = $(e.currentTarget);
    $.ajax({
      type: $this.prop('method') || 'POST',
      url: $this.prop('href'),
      data: {
        job_id: $this.data('job-id')
      },
      beforeSend: function beforeSend() {
        $this.addClass('button-loading');
      },
      success: function success(res) {
        if (res.error) {
          showError(res.message);
          return false;
        }
        showSuccess(res.message);
        if (res.data.is_saved) {
          $this.closest('.favorite-icon').addClass('bookmark-post');
        } else {
          $this.closest('.favorite-icon').removeClass('bookmark-post');
        }
      },
      error: function error(res) {
        handleError(res);
      },
      complete: function complete() {
        $this.removeClass('button-loading');
      }
    });
  });
  $(document).on('submit', '.newsletter-form', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var $form = $(this);
    var $button = $form.find('button[type=submit]');
    $.ajax({
      type: 'POST',
      cache: false,
      url: $form.prop('action'),
      data: new FormData($form[0]),
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        $button.addClass('button-loading');
      },
      success: function success(res) {
        if (!res.error) {
          $form.find('input[type=email]').val('');
          showSuccess(res.message);
        } else {
          showError(res.message);
        }
      },
      error: function error(res) {
        handleError(res);
      },
      complete: function complete() {
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        $button.removeClass('button-loading');
      }
    });
  });
  function reloadReviewList(page) {
    var companyId = $('input[name=company_id]').val();
    $('.half-circle-spinner').toggle();
    $('.spinner-overflow').toggle();
    $.ajax({
      url: window.siteUrl + "/review/load-more?page=".concat(page, "&company_id=").concat(companyId),
      success: function success(data) {
        $('.review-list').html(data);
        $('.half-circle-spinner').toggle();
        $('.spinner-overflow').toggle();
      }
    });
  }
  $(document).on('submit', '.company-review-form', function (event) {
    event.preventDefault();
    event.stopPropagation();
    var $form = $(this);
    var $button = $form.find('button[type=submit]');
    $.ajax({
      type: 'POST',
      cache: false,
      url: $form.prop('action'),
      data: new FormData($form[0]),
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        $button.addClass('button-loading');
      },
      success: function success(res) {
        if (!res.error) {
          $form.find('textarea').val('');
          showSuccess(res.message);
          var page = $('.review-pagination').data('review-last-page');
          reloadReviewList(page);
        } else {
          showError(res.message);
        }
      },
      error: function error(res) {
        handleError(res);
      },
      complete: function complete() {
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        $button.removeClass('button-loading');
      }
    });
  });
  var $applyNow = $('#applyNow');
  $applyNow.on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var jobName = button.data('job-name');
    var jobId = button.data('job-id');
    $applyNow.find('.modal-job-name').text(jobName);
    $applyNow.find('.modal-job-id').val(jobId);
  });
  $applyNow.on('hide.bs.modal', function () {
    $applyNow.find('.modal-job-name').text('');
    $applyNow.find('.modal-job-id').val('');
  });
  var $applyExternalJob = $('#applyExternalJob');
  $applyExternalJob.on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var jobName = button.data('job-name');
    var jobId = button.data('job-id');
    $applyExternalJob.find('.modal-job-name').text(jobName);
    $applyExternalJob.find('.modal-job-id').val(jobId);
  });
  $applyExternalJob.on('hide.bs.modal', function () {
    $applyExternalJob.find('.modal-job-name').text('');
    $applyExternalJob.find('.modal-job-id').val('');
  });
  $(document).on('click', '.review-pagination a', function (e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    reloadReviewList(page);
  });
})(jQuery);
/******/ })()
;