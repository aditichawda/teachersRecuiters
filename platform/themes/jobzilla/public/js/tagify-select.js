/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!*************************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/tagify-select.js ***!
  \*************************************************************/


function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
var tagifySelect = function tagifySelect() {
  var element = document.querySelectorAll('.list-tagify');
  _toConsumableArray(element).forEach(function (inputElm) {
    var dataList = JSON.parse(inputElm.dataset.list);
    var whiteList = [];
    var _iterator = _createForOfIteratorHelper(dataList),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var data = _step.value;
        whiteList.push({
          value: data.id,
          name: data.name
        });
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    var list = String(inputElm.value).split(',');
    var arrayChosen = whiteList.filter(function (obj) {
      if (list.includes(String(obj.value))) {
        return {
          value: obj.id,
          name: obj.name
        };
      }
    });
    function tagTemplate(tagData) {
      return "\n            <tag title=\"".concat(tagData.title || tagData.name, "\"\n                    contenteditable='false'\n                    spellcheck='false'\n                    tabIndex=\"-1\"\n                    class=\"").concat(this.settings.classNames.tag, " ").concat(tagData["class"] ? tagData["class"] : '', "\"\n                    ").concat(this.getAttributes(tagData), ">\n                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>\n                <div class=\"d-flex align-items-center\">\n                    <span class='tagify__tag-text'>").concat(tagData.name, "</span>\n                </div>\n            </tag>\n        ");
    }
    function suggestionItemTemplate(tagData) {
      return "\n            <div ".concat(this.getAttributes(tagData), "\n                class=\"tagify__dropdown__item d-flex align-items-center ").concat(tagData["class"] ? tagData["class"] : '', "\"\n                tabindex=\"0\"\n                role=\"option\">\n\n                <div class=\"d-flex flex-column\">\n                    <strong>").concat(tagData.name, "</strong>\n                </div>\n            </div>\n        ");
    }

    // initialize Tagify on the above input node reference
    var tagify = new Tagify(inputElm, {
      tagTextProp: 'name',
      // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
      enforceWhitelist: true,
      skipInvalid: true,
      // do not temporarily add invalid tags
      dropdown: {
        closeOnSelect: false,
        enabled: 0,
        classname: 'users-list',
        searchKeys: ['id', 'name'] // very important to set by which keys to search for suggestions when typing
      },
      templates: {
        tag: tagTemplate,
        dropdownItem: suggestionItemTemplate
      },
      whitelist: whiteList,
      originalInputValueFormat: function originalInputValueFormat(valuesArr) {
        return valuesArr.map(function (item) {
          return item.value;
        }).join(',');
      }
    });
    tagify.loadOriginalValues(arrayChosen);
  });
};
$(document).ready(function () {
  tagifySelect();
});
/******/ })()
;