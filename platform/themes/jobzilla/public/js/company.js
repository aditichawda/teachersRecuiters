/******/ (() => { // webpackBootstrap
/*!*******************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/company.js ***!
  \*******************************************************/
(function ($) {
  var companies = $('.companies');
  var Loading = $('#company-loading');
  var filterAjax = null;
  function getcompanies() {
    var form = $('form#company-filter-form');
    var formData = form.serialize();
    var action = form.attr('action');
    var currentUrl = location.origin + location.pathname;
    if (filterAjax) {
      filterAjax.abort();
    }
    filterAjax = $.ajax({
      url: action,
      method: 'GET',
      data: formData,
      beforeSend: function beforeSend() {
        Loading.show();
        window.history.pushState(formData, null, "".concat(currentUrl, "?").concat(formData));
      },
      success: function success(response) {
        $('.companies-content').html(response.data);
        $('.woocommerce-result-count-left').text($('.info-pagination').text());
      },
      complete: function complete() {
        Loading.hide();
      }
    });
  }
  function setCurrentPage(page) {
    companies.find('input[name="page"]').val(page);
  }
  companies.on('change', '.select-per-page', function (e) {
    e.preventDefault();
    companies.find('input[name="per_page"]').val($(this).val());
    setCurrentPage(1);
    getcompanies();
  });
  companies.on('change', '.select-sort-by', function (e) {
    e.preventDefault();
    companies.find('input[name="sort_by"]').val($(this).val());
    getcompanies();
  });
  companies.on('change', '.select-layout', function (e) {
    e.preventDefault();
    companies.find('input[name="layout"]').val($(this).val());
    getcompanies();
  });
  companies.on('click', 'a.pagination-button', function (e) {
    e.preventDefault();
    setCurrentPage($(this).data('page'));
    getcompanies();
  });
  companies.on('click', '.btn-open-sidebar', function () {
    $('#mySidebar').css('width', '300px');
    $('#main').css('marginLeft', '300px');
  });
  companies.on('click', '.btn-close-sidebar', function () {
    $('#mySidebar').css('width', '0');
    $('#main').css('marginLeft', '0');
  });
  $(document).on("click", function (event) {
    if ($(event.target).closest(".option-company-mobile").length === 0) {
      $('#mySidebar').css('width', '0');
      $('#main').css('marginLeft', '0');
    }
  });
  $(document).scroll(function () {
    if ($('.sticky-wrapper').find('.is-fixed').length > 0) {
      $('.option-company-mobile').find('.sidebar').css('marginTop', '40px');
    } else {
      $('.option-company-mobile').find('.sidebar').css('marginTop', '90px');
    }
  });
})(jQuery);
/******/ })()
;