/******/ (() => { // webpackBootstrap
/*!****************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/jobs.js ***!
  \****************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var JobFilter = /*#__PURE__*/function () {
  function JobFilter() {
    var _this = this;
    _classCallCheck(this, JobFilter);
    _defineProperty(this, "searchParams", new URLSearchParams(window.location.search));
    _defineProperty(this, "$container", $('.jobs-container'));
    _defineProperty(this, "$jobsList", this.$container.find('.jobs-listing'));
    _defineProperty(this, "$loading", this.$container.find('#jobs-loader-overlay'));
    _defineProperty(this, "layout", this.searchParams.get('layout') || 'list');
    _defineProperty(this, "$map", this.$container.find('#map'));
    if (this.layout === 'map') {
      this.initMap();
    } else {
      this.$map.hide();
    }
    this.handleFiltersOnChange();
    this.initJobCitySearch();
    this.initJobRoleSearch();
    this.initJobLocationSearch();
    this.$container.on('click', '.side-bar-filter .backdrop', function (e) {
      e.preventDefault();
      $(this).parent().removeClass('active');
    }).on('click', '.btn-open-filter', function () {
      _this.$container.find('.side-bar-filter').addClass('active');
    }).on('click', '.btn-close-filter', function () {
      _this.$container.find('.side-bar-filter').removeClass('active');
    });
  }
  return _createClass(JobFilter, [{
    key: "initJobCitySearch",
    value: function initJobCitySearch() {
      var $cityInput = $('#job_city_search');
      var $cityId = $('#job_city_id');
      var $suggestions = $('#job-city-suggestions');
      var searchTimeout = null;
      var activeSuggestionIndex = -1;
      if (!$cityInput.length) return;

      // City search autocomplete
      $cityInput.on('input', function () {
        var keyword = $(this).val().trim();
        activeSuggestionIndex = -1;

        // Clear city selection when user types
        $cityId.val('');
        if (searchTimeout) clearTimeout(searchTimeout);
        if (keyword.length < 2) {
          $suggestions.hide().empty();
          return;
        }
        $suggestions.html('<div class="job-city-loading">Searching...</div>').show();
        searchTimeout = setTimeout(function () {
          var apiUrl = (window.siteUrl || window.location.origin) + '/ajax/search-cities';
          $.ajax({
            url: apiUrl,
            type: 'GET',
            data: {
              k: keyword
            },
            success: function success(response) {
              var cities = response.data || [];
              if (cities.length === 0) {
                $suggestions.html('<div class="job-city-no-results">No cities found</div>').show();
                return;
              }
              var html = '';
              cities.forEach(function (city) {
                var locationParts = [];
                if (city.state_name) locationParts.push(city.state_name);
                if (city.country_name) locationParts.push(city.country_name);
                html += '<div class="job-city-suggestion-item" ' + 'data-id="' + city.id + '" ' + 'data-name="' + city.name + '">' + '<div class="city-name">' + city.name + '</div>' + (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') + '</div>';
              });
              $suggestions.html(html).show();
            },
            error: function error(xhr, status, _error) {
              console.error('City search error:', _error);
              $suggestions.html('<div class="job-city-no-results">Error searching cities</div>').show();
            }
          });
        }, 300);
      });

      // Keyboard navigation for suggestions
      $cityInput.on('keydown', function (e) {
        var $items = $suggestions.find('.job-city-suggestion-item');
        if (!$suggestions.is(':visible') || $items.length === 0) return;
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
          $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, -1);
          $items.removeClass('active');
          if (activeSuggestionIndex >= 0) {
            $items.eq(activeSuggestionIndex).addClass('active');
          }
        } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
          e.preventDefault();
          $items.eq(activeSuggestionIndex).click();
        } else if (e.key === 'Escape') {
          $suggestions.hide();
        }
      });

      // Click on suggestion
      $(document).on('click', '.job-city-suggestion-item', function () {
        var cityId = $(this).data('id');
        var cityName = $(this).data('name');
        $cityId.val(cityId);
        $cityInput.val(cityName);
        $suggestions.hide();

        // Trigger filter update
        var event = new Event('change', {
          bubbles: true
        });
        $cityId[0].dispatchEvent(event);
      });

      // Hide suggestions when clicking outside
      $(document).on('click', function (e) {
        if (!$(e.target).closest('.job-city-search-wrapper').length) {
          $suggestions.hide();
        }
      });
    }
  }, {
    key: "initJobRoleSearch",
    value: function initJobRoleSearch() {
      var $roleInput = $('#job_role_search');
      var $roleId = $('#job_role_id');
      var $suggestions = $('#job-role-suggestions');
      var activeSuggestionIndex = -1;
      var rolesLoaded = false;
      if (!$roleInput.length) return;

      // Load all job roles on click
      $roleInput.on('click focus', function () {
        if (rolesLoaded && $suggestions.children().length > 0) {
          $suggestions.show();
          return;
        }
        $suggestions.html('<div class="job-role-loading">Loading...</div>').show();
        var apiUrl = (window.siteUrl || window.location.origin) + '/ajax/job-roles';
        $.ajax({
          url: apiUrl,
          type: 'GET',
          data: {
            k: ''
          },
          // Empty keyword to get all roles
          success: function success(response) {
            var roles = response.data || [];
            if (roles.length === 0) {
              $suggestions.html('<div class="job-role-no-results">No job roles found</div>').show();
              return;
            }
            var html = '';
            roles.forEach(function (role) {
              html += '<div class="job-role-suggestion-item" ' + 'data-id="' + role.id + '" ' + 'data-name="' + role.name + '">' + '<div class="role-name">' + role.name + '</div>' + '</div>';
            });
            $suggestions.html(html).show();
            rolesLoaded = true;
          },
          error: function error(xhr, status, _error2) {
            console.error('Job role search error:', _error2);
            $suggestions.html('<div class="job-role-no-results">Error loading job roles</div>').show();
          }
        });
      });

      // Filter roles on input
      $roleInput.on('input', function () {
        var keyword = $(this).val().toLowerCase().trim();
        activeSuggestionIndex = -1;
        if (!rolesLoaded) return;
        var $items = $suggestions.find('.job-role-suggestion-item');
        if (keyword.length === 0) {
          $items.show();
          return;
        }
        $items.each(function () {
          var roleName = $(this).find('.role-name').text().toLowerCase();
          if (roleName.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
        if ($items.filter(':visible').length === 0) {
          $suggestions.html('<div class="job-role-no-results">No matching job roles</div>');
        } else {
          // Reset active index when filtering
          activeSuggestionIndex = -1;
        }
      });

      // Keyboard navigation for suggestions
      $roleInput.on('keydown', function (e) {
        var $items = $suggestions.find('.job-role-suggestion-item:visible');
        if (!$suggestions.is(':visible') || $items.length === 0) {
          // If dropdown not visible, trigger click to load
          if (e.key !== 'Escape' && e.key !== 'Tab') {
            $roleInput.trigger('click');
          }
          return;
        }
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
          $items.removeClass('active');
          $items.eq(activeSuggestionIndex).addClass('active');
          // Scroll into view
          var $active = $items.eq(activeSuggestionIndex);
          if ($active.length) {
            $active[0].scrollIntoView({
              block: 'nearest',
              behavior: 'smooth'
            });
          }
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, -1);
          $items.removeClass('active');
          if (activeSuggestionIndex >= 0) {
            $items.eq(activeSuggestionIndex).addClass('active');
            var _$active = $items.eq(activeSuggestionIndex);
            if (_$active.length) {
              _$active[0].scrollIntoView({
                block: 'nearest',
                behavior: 'smooth'
              });
            }
          }
        } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
          e.preventDefault();
          $items.eq(activeSuggestionIndex).click();
        } else if (e.key === 'Escape') {
          $suggestions.hide();
        }
      });

      // Click on suggestion
      $(document).on('click', '.job-role-suggestion-item', function () {
        var roleId = $(this).data('id');
        var roleName = $(this).data('name');
        $roleId.val(roleId);
        $roleInput.val(roleName);
        $suggestions.hide();
        rolesLoaded = false; // Reset so it reloads on next click
      });

      // Hide suggestions when clicking outside
      $(document).on('click', function (e) {
        if (!$(e.target).closest('.job-role-search-wrapper').length) {
          $suggestions.hide();
        }
      });
    }
  }, {
    key: "initJobLocationSearch",
    value: function initJobLocationSearch() {
      var $locationInput = $('#job_location_search');
      var $cityId = $('#job_location_city_id');
      var $suggestions = $('#job-location-suggestions');
      var searchTimeout = null;
      var activeSuggestionIndex = -1;
      if (!$locationInput.length) return;

      // City search autocomplete (same as signin/login)
      $locationInput.on('input', function () {
        var keyword = $(this).val().trim();
        activeSuggestionIndex = -1;

        // Clear city selection when user types
        $cityId.val('');
        if (searchTimeout) clearTimeout(searchTimeout);
        if (keyword.length < 2) {
          $suggestions.hide().empty();
          return;
        }
        $suggestions.html('<div class="job-location-loading">Searching...</div>').show();
        searchTimeout = setTimeout(function () {
          var apiUrl = (window.siteUrl || window.location.origin) + '/ajax/search-cities';
          $.ajax({
            url: apiUrl,
            type: 'GET',
            data: {
              k: keyword
            },
            success: function success(response) {
              var cities = response.data || [];
              if (cities.length === 0) {
                $suggestions.html('<div class="job-location-no-results">No cities found</div>').show();
                return;
              }
              var html = '';
              cities.forEach(function (city) {
                var locationParts = [];
                if (city.state_name) locationParts.push(city.state_name);
                if (city.country_name) locationParts.push(city.country_name);
                html += '<div class="job-location-suggestion-item" ' + 'data-id="' + city.id + '" ' + 'data-name="' + city.name + '">' + '<div class="city-name">' + city.name + '</div>' + (locationParts.length ? '<div class="city-location">' + locationParts.join(', ') + '</div>' : '') + '</div>';
              });
              $suggestions.html(html).show();
            },
            error: function error(xhr, status, _error3) {
              console.error('City search error:', _error3);
              $suggestions.html('<div class="job-location-no-results">Error searching cities</div>').show();
            }
          });
        }, 300);
      });

      // Keyboard navigation for suggestions
      $locationInput.on('keydown', function (e) {
        var $items = $suggestions.find('.job-location-suggestion-item');
        if (!$suggestions.is(':visible') || $items.length === 0) return;
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          activeSuggestionIndex = Math.min(activeSuggestionIndex + 1, $items.length - 1);
          $items.removeClass('active').eq(activeSuggestionIndex).addClass('active');
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          activeSuggestionIndex = Math.max(activeSuggestionIndex - 1, -1);
          $items.removeClass('active');
          if (activeSuggestionIndex >= 0) {
            $items.eq(activeSuggestionIndex).addClass('active');
          }
        } else if (e.key === 'Enter' && activeSuggestionIndex >= 0) {
          e.preventDefault();
          $items.eq(activeSuggestionIndex).click();
        } else if (e.key === 'Escape') {
          $suggestions.hide();
        }
      });

      // Click on suggestion
      $(document).on('click', '.job-location-suggestion-item', function () {
        var cityId = $(this).data('id');
        var cityName = $(this).data('name');
        $cityId.val(cityId);
        $locationInput.val(cityName);
        $suggestions.hide();
      });

      // Hide suggestions when clicking outside
      $(document).on('click', function (e) {
        if (!$(e.target).closest('.job-location-search-wrapper').length) {
          $suggestions.hide();
        }
      });
    }
  }, {
    key: "submit",
    value: function submit() {
      var _this2 = this;
      // Try to find sidebar form first, then top form
      var $form = this.$container.find('#jobs-filter-form');
      if (!$form.length) {
        $form = this.$container.find('#jobs-top-filter-form');
      }
      var searchParams = this.searchParams.toString();

      // Get AJAX URL - try from form data attribute, or use route
      var ajaxUrl = $form.data('ajax-url');
      if (!ajaxUrl) {
        // Fallback: use the route directly (for top form which might not have data-ajax-url)
        ajaxUrl = window.location.origin + '/ajax/jobs';
      }
      var url = searchParams ? "".concat(ajaxUrl, "?").concat(searchParams) : ajaxUrl;

      // Get action URL for history update
      var action = $form.length ? $form.attr('action') : window.location.pathname;
      window.history.pushState({}, '', searchParams ? "".concat(action, "?").concat(searchParams) : action);

      // Ensure loader is visible (might already be shown by handler, but ensure it's visible)
      this.showLoader();
      this.scrollToTop();

      // Make AJAX request - loader will stay visible during entire request
      $.ajax({
        method: 'GET',
        url: url,
        beforeSend: function beforeSend() {
          // Ensure loader is visible before request starts
          _this2.showLoader();
        },
        success: function success(response) {
          var data = response.data,
            message = response.message;

          // Update jobs list
          _this2.$jobsList.html(data);
          _this2.$container.find('.woocommerce-result-count-left').text(message);

          // Re-add loader component if not present after HTML update
          if (!_this2.$jobsList.find('#jobs-loader-overlay').length) {
            var loaderHtml = '<div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: none;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading jobs...</p></div></div>';
            _this2.$jobsList.prepend(loaderHtml);
          }
          _this2.$loading = _this2.$container.find('#jobs-loader-overlay');
        },
        error: function error() {
          // Hide loader on error
          _this2.hideLoader();
        },
        complete: function complete() {
          // Hide loader ONLY after everything is complete
          // Wait a bit to ensure content is fully rendered
          setTimeout(function () {
            _this2.hideLoader();
          }, 300);
        }
      });
    }
  }, {
    key: "handleFiltersOnChange",
    value: function handleFiltersOnChange() {
      var _this3 = this;
      // Helper function to collect form data and update search params
      var collectFormData = function collectFormData($form) {
        var formData = new FormData($form[0]);

        // Clear existing params
        _this3.searchParams = new URLSearchParams();

        // Add all form fields to search params
        var _iterator = _createForOfIteratorHelper(formData.entries()),
          _step;
        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var _step$value = _slicedToArray(_step.value, 2),
              key = _step$value[0],
              value = _step$value[1];
            if (value) {
              if (key.includes('[]')) {
                _this3.searchParams.append(key, value);
              } else {
                _this3.searchParams.set(key, value);
              }
            }
          }

          // Also handle selectpicker values (they might not be in FormData)
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
        $form.find('select.selectpicker').each(function (index, select) {
          var $select = $(select);
          var name = $select.attr('name');
          var value = $select.val();
          if (name && value) {
            if (name.includes('[]')) {
              // Multiple select - remove all existing, then add selected
              _this3.searchParams["delete"](name);
              if (Array.isArray(value)) {
                value.forEach(function (v) {
                  if (v) _this3.searchParams.append(name, v);
                });
              } else if (value) {
                _this3.searchParams.append(name, value);
              }
            } else {
              // Single select
              if (value) {
                _this3.searchParams.set(name, value);
              } else {
                _this3.searchParams["delete"](name);
              }
            }
          } else if (name && !value) {
            // Clear empty selects
            _this3.searchParams["delete"](name);
          }
        });
      };

      // Handle sidebar form submit (for Apply Filter button)
      this.$container.on('submit', '#jobs-filter-form', function (e) {
        e.preventDefault();
        var $form = $(e.target);

        // Show loader IMMEDIATELY when button is clicked
        _this3.showLoader();
        collectFormData($form);
        _this3.submit();
        if (_this3.searchParams.get('layout') === 'map') {
          _this3.initMap();
        } else {
          _this3.$map.hide();
        }
      });

      // Handle top filter form submit (for Find Job button)
      this.$container.on('submit', '#jobs-top-filter-form', function (e) {
        e.preventDefault();
        var $form = $(e.target);

        // Show loader IMMEDIATELY when button is clicked
        _this3.showLoader();
        collectFormData($form);
        _this3.submit();
        if (_this3.searchParams.get('layout') === 'map') {
          _this3.initMap();
        } else {
          _this3.$map.hide();
        }
      });

      // Handle individual field changes (for auto-submit on change)
      this.$container.on('change', function (event) {
        // Skip if it's a selectpicker - those are handled by form submit
        if ($(event.target).hasClass('selectpicker')) {
          return;
        }

        // Show loader IMMEDIATELY when filter changes
        _this3.showLoader();
        _this3.updateSearchParams(event);
        _this3.submit();
        if (_this3.searchParams.get('layout') === 'map') {
          _this3.initMap();
        } else {
          _this3.$map.hide();
        }
      });

      // Handle selectpicker changes (Bootstrap Select)
      this.$container.on('changed.bs.select', 'select.selectpicker', function (event) {
        // Show loader IMMEDIATELY when selectpicker changes
        _this3.showLoader();
        var $select = $(event.target);
        var name = $select.attr('name');
        var value = $select.val();

        // Update search params
        if (name) {
          if (name.includes('[]')) {
            // Multiple select - remove all existing, then add selected
            _this3.searchParams["delete"](name);
            if (Array.isArray(value)) {
              value.forEach(function (v) {
                if (v) _this3.searchParams.append(name, v);
              });
            } else if (value) {
              _this3.searchParams.append(name, value);
            }
          } else {
            // Single select
            if (value) {
              _this3.searchParams.set(name, value);
            } else {
              _this3.searchParams["delete"](name);
            }
          }
        }
        _this3.submit();
        if (_this3.searchParams.get('layout') === 'map') {
          _this3.initMap();
        } else {
          _this3.$map.hide();
        }
      });
      this.$container.on('click', '.pagination li a', function (e) {
        e.preventDefault();

        // Show loader IMMEDIATELY when pagination is clicked
        _this3.showLoader();
        var url = new URL(e.target.href);
        _this3.searchParams.set('page', url.searchParams.get('page'));
        _this3.submit();
      });
    }
  }, {
    key: "updateSearchParams",
    value: function updateSearchParams(event) {
      var _this4 = this;
      var _event$target = event.target,
        name = _event$target.name,
        value = _event$target.value;
      if (name.includes('[]')) {
        this.searchParams["delete"](name);
        $.each($("input[name=\"".concat(name, "\"]")), function (index, item) {
          if ($(item).prop('checked')) {
            _this4.searchParams.append(name, $(item).val());
          }
        });
      } else {
        this.searchParams.set(name, value);
      }
    }
  }, {
    key: "showLoader",
    value: function showLoader() {
      // Show blue loader - force show with inline style
      // Use z-index: 100 (lower than navbar 999 and WhatsApp 9998) so it doesn't cover them
      if (this.$loading.length) {
        this.$loading.attr('style', 'display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;').addClass('show');
      } else {
        // Create loader if it doesn't exist
        var loaderHtml = '<div class="blue-loader-overlay" id="jobs-loader-overlay" style="display: flex !important; visibility: visible !important; opacity: 1 !important; z-index: 100 !important;"><div class="blue-loader-wrapper"><div class="blue-loader large"></div><p class="blue-loader-text">Loading jobs...</p></div></div>';
        this.$jobsList.prepend(loaderHtml);
        this.$loading = this.$container.find('#jobs-loader-overlay');
      }
    }
  }, {
    key: "hideLoader",
    value: function hideLoader() {
      // Hide loader smoothly
      if (this.$loading.length) {
        this.$loading.css({
          'display': 'none',
          'visibility': 'hidden',
          'opacity': '0'
        }).removeClass('show');
      }
    }
  }, {
    key: "scrollToTop",
    value: function scrollToTop() {
      $('html, body').animate({
        scrollTop: this.$container.offset().top - 130
      }, 0);
    }
  }, {
    key: "initMap",
    value: function initMap() {
      if (!this.$map.length) {
        return;
      }
      this.$map.show();
      if (window.currentMap) {
        window.currentMap.off();
        window.currentMap.remove();
      }
      var map = L.map('map', {
        zoomControl: true,
        scrollWheelZoom: true,
        dragging: true
      }).setView(this.$map.data('center'), 13);
      var langCode = $('html').prop('lang') || 'en';
      L.tileLayer("https://mt0.google.com/vt/lyrs=m&hl=".concat(langCode, "&x={x}&y={y}&z={z}"), {
        maxZoom: 19
      }).addTo(map);
      var markers = L.markerClusterGroup();
      var markersList = [];
      this.$container.find('.job-board-street-map').map(function (index, item) {
        var $item = $(item);
        var job = $item.data('job');
        if (!job || !job.latitude || !job.longitude) {
          return;
        }
        var icon = L.divIcon({
          iconSize: L.point(50, 20),
          html: $item.data('map-icon')
        });
        var marker = L.marker([job.latitude, job.longitude], {
          icon: icon
        }).bindPopup("\n                    <div class=\"job-map-item\">\n                        <img src=\"".concat($item.data('company-logo'), "\" alt=\"").concat(job.company.name, "\">\n                        <div>\n                            <h4>").concat(job.company.name, "</h4>\n                            <a href=\"").concat($item.data('url'), "\">\n                                <h5>").concat(job.name, "</h5>\n                            </a>\n                            <span>").concat($item.data('full-address'), "</span>\n                        </div>\n                    </div>\n                "));
        markersList.push(marker);
        markers.addLayer(marker);
        map.flyToBounds(L.latLngBounds(markersList.map(function (marker) {
          return marker.getLatLng();
        })));
      });
      map.addLayer(markers);
      window.currentMap = map;
    }
  }]);
}();
$(function () {
  return new JobFilter();
});
/******/ })()
;