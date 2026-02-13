/******/ (() => { // webpackBootstrap
/*!****************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/jobs.js ***!
  \****************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
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
    _defineProperty(this, "$loading", this.$container.find('.overlay'));
    _defineProperty(this, "layout", this.searchParams.get('layout') || 'list');
    _defineProperty(this, "$map", this.$container.find('#map'));
    if (this.layout === 'map') {
      this.initMap();
    } else {
      this.$map.hide();
    }
    this.handleFiltersOnChange();
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
    key: "submit",
    value: function submit() {
      var _this2 = this;
      var $form = this.$container.find('#jobs-filter-form');
      var searchParams = this.searchParams.toString();
      var _$form$get = $form.get(0),
        method = _$form$get.method,
        action = _$form$get.action;
      var ajaxUrl = $form.data('ajax-url');
      var url = searchParams ? "".concat(ajaxUrl, "?").concat(searchParams) : ajaxUrl;
      window.history.pushState({}, '', "".concat(action, "?").concat(searchParams));
      if (!searchParams) {
        window.history.pushState({}, '', action);
      }
      $.ajax({
        method: method,
        url: url,
        beforeSend: function beforeSend() {
          _this2.$loading.show();
          _this2.scrollToTop();
        },
        success: function success(response) {
          var data = response.data,
            message = response.message;
          _this2.$jobsList.html(data);
          _this2.$container.find('.woocommerce-result-count-left').text(message);
        },
        complete: function complete() {
          _this2.$loading.hide();
        }
      });
    }
  }, {
    key: "handleFiltersOnChange",
    value: function handleFiltersOnChange() {
      var _this3 = this;
      this.$container.on('change', function (event) {
        _this3.updateSearchParams(event);
        _this3.submit();
        if (_this3.searchParams.get('layout') === 'map') {
          _this3.initMap();
        } else {
          _this3.$map.hide();
        }
      });
      this.$container.on('click', '.pagination li a', function (e) {
        e.preventDefault();
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