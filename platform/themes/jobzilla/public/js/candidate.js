/******/ (() => { // webpackBootstrap
/*!*********************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/candidate.js ***!
  \*********************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var CandidateFilter = /*#__PURE__*/function () {
  function CandidateFilter() {
    var _this = this;
    _classCallCheck(this, CandidateFilter);
    _defineProperty(this, "searchParams", new URLSearchParams(window.location.search));
    _defineProperty(this, "$container", $('.candidates-container'));
    _defineProperty(this, "$candidatesList", this.$container.find('.candidates-listing'));
    _defineProperty(this, "$loading", $('#page-loading'));
    _defineProperty(this, "layout", this.searchParams.get('layout') || 'grid');
    // Initialize searchParams from current URL
    this.initializeFromUrl();
    this.handleFiltersOnChange();
    this.initCitySelect();
    this.$container.on('click', '.side-bar-filter .backdrop', function (e) {
      e.preventDefault();
      $(this).parent().removeClass('active');
    }).on('click', '.btn-open-filter', function () {
      _this.$container.find('.side-bar-filter').addClass('active');
    }).on('click', '.btn-close-filter', function () {
      _this.$container.find('.side-bar-filter').removeClass('active');
    });
  }
  return _createClass(CandidateFilter, [{
    key: "initializeFromUrl",
    value: function initializeFromUrl() {
      var _this2 = this;
      // Update form values from URL parameters
      var $form = this.$container.find('#candidate-filter-form');

      // Update text inputs
      this.searchParams.forEach(function (value, key) {
        if (key.includes('[]')) {
          // Handle array parameters
          var baseName = key.replace('[]', '');
          var values = _this2.searchParams.getAll(key);
          values.forEach(function (val) {
            $form.find("input[name=\"".concat(baseName, "[]\"][value=\"").concat(val, "\"]")).prop('checked', true);
          });
        } else {
          var $input = $form.find("[name=\"".concat(key, "\"]"));
          if ($input.length) {
            if ($input.is('select')) {
              $input.val(value).trigger('change');
            } else {
              $input.val(value);
            }
          }
        }
      });
    }
  }, {
    key: "initCitySelect",
    value: function initCitySelect() {
      var _this3 = this;
      var $citySelect = this.$container.find('.selectpicker-location');
      if ($citySelect.length && typeof $citySelect.select2 === 'function') {
        // Handle select2 change event
        $citySelect.on('change', function (e) {
          _this3.updateSearchParams(e);
          _this3.submit();
        });
      }
    }
  }, {
    key: "submit",
    value: function submit() {
      var _this4 = this;
      var $form = this.$container.find('#candidate-filter-form');
      var formData = $form.serializeArray();
      var searchParams = new URLSearchParams();

      // Process form data
      formData.forEach(function (item) {
        if (item.value && item.value !== '') {
          if (item.name.includes('[]')) {
            // For array parameters, use append to create multiple entries
            searchParams.append(item.name, item.value);
          } else {
            searchParams.set(item.name, item.value);
          }
        }
      });

      // Also handle select2 for city (if not in form serialize)
      var $citySelect = $form.find('.selectpicker-location');
      if ($citySelect.length && $citySelect.val()) {
        searchParams.set('city_id', $citySelect.val());
      }
      var ajaxUrl = $form.data('ajax-url') || $form.attr('action');
      var queryString = searchParams.toString();
      var url = queryString ? "".concat(ajaxUrl, "?").concat(queryString) : ajaxUrl;
      window.history.pushState({}, '', "".concat(window.location.pathname).concat(queryString ? '?' + queryString : ''));
      $.ajax({
        method: 'GET',
        url: url,
        beforeSend: function beforeSend() {
          _this4.$loading.show();
          _this4.scrollToTop();
        },
        success: function success(response) {
          var data = response.data;
          _this4.$candidatesList.html(data.list);
          _this4.$container.find('.woocommerce-result-count-left').text(data.total_text);
        },
        complete: function complete() {
          _this4.$loading.hide();
        }
      });
    }
  }, {
    key: "handleFiltersOnChange",
    value: function handleFiltersOnChange() {
      var _this5 = this;
      // Handle form submit
      this.$container.on('submit', '#candidate-filter-form', function (e) {
        e.preventDefault();
        _this5.submit();
      });

      // Handle filter changes (auto-submit for some fields, manual submit for others)
      this.$container.on('change', '#candidate-filter-form input[type="checkbox"], #candidate-filter-form input[type="radio"]', function (event) {
        _this5.updateSearchParams(event);
        _this5.submit();
      });

      // Handle select2 change for city
      this.$container.on('change', '.selectpicker-location', function (event) {
        _this5.updateSearchParams(event);
        _this5.submit();
      });

      // Handle other selects (but not keyword input - that should only submit on button click or enter)
      this.$container.on('change', '#candidate-filter-form select:not(.selectpicker-location)', function (event) {
        _this5.updateSearchParams(event);
        _this5.submit();
      });

      // Handle keyword input - submit on Enter key or search button click
      this.$container.on('keypress', '#candidate-filter-form input[name="keyword"]', function (e) {
        if (e.which === 13) {
          // Enter key
          e.preventDefault();
          _this5.submit();
        }
      });
      this.$container.on('click', '#candidate-filter-form button[type="submit"]', function (e) {
        e.preventDefault();
        _this5.submit();
      });

      // Handle sort, per page, layout changes
      this.$container.on('change', '.select-per-page, .select-sort-by, .select-layout', function (event) {
        var $target = $(event.target);
        var name = $target.attr('name');
        var value = $target.val();
        if (name) {
          _this5.searchParams.set(name, value);
        }

        // Update hidden inputs in form
        var $form = _this5.$container.find('#candidate-filter-form');
        $form.find("input[name=\"".concat(name, "\"]")).val(value);
        _this5.submit();
      });

      // Handle pagination
      this.$container.on('click', '.pagination li a, a.pagination-button', function (e) {
        e.preventDefault();
        var url = new URL(e.target.href || $(e.target).attr('href'));
        var page = url.searchParams.get('page') || $(e.target).data('page');
        if (page) {
          _this5.searchParams.set('page', page);
          var $form = _this5.$container.find('#candidate-filter-form');
          $form.find('input[name="page"]').val(page);
          _this5.submit();
        }
      });
    }
  }, {
    key: "updateSearchParams",
    value: function updateSearchParams(event) {
      var _this6 = this;
      var $target = $(event.target);
      var name = $target.attr('name');
      var value = $target.val();
      var type = $target.attr('type');
      if (!name) return;
      if (name.includes('[]')) {
        var baseName = name.replace('[]', '[]');
        // Remove all existing values for this array
        this.searchParams["delete"](baseName);

        // Add all checked values
        $("input[name=\"".concat(name, "\"]:checked")).each(function (index, item) {
          _this6.searchParams.append(baseName, $(item).val());
        });
      } else {
        if (value && value !== '') {
          this.searchParams.set(name, value);
        } else {
          this.searchParams["delete"](name);
        }
      }
    }
  }, {
    key: "scrollToTop",
    value: function scrollToTop() {
      $('html, body').animate({
        scrollTop: this.$container.offset().top - 100
      }, 300);
    }
  }]);
}();
$(document).ready(function () {
  if ($('.candidates-container').length) {
    new CandidateFilter();
  }
});
/******/ })()
;