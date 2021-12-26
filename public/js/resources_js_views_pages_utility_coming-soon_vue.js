"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_pages_utility_coming-soon_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      start: "",
      end: "",
      interval: "",
      days: "",
      minutes: "",
      hours: "",
      seconds: "",
      starttime: "Nov 5, 2018 15:37:25",
      endtime: "Dec 31, 2020 16:37:25"
    };
  },
  created: function created() {
    document.body.classList.add("auth-body-bg");
  },
  mounted: function mounted() {
    var _this = this;

    this.start = new Date(this.starttime).getTime();
    this.end = new Date(this.endtime).getTime(); // Update the count down every 1 second

    this.timerCount(this.start, this.end);
    this.interval = setInterval(function () {
      _this.timerCount(_this.start, _this.end);
    }, 1000);
  },
  methods: {
    timerCount: function timerCount(start, end) {
      // Get todays date and time
      var now = new Date().getTime(); // Find the distance between now an the count down date

      var distance = start - now;
      var passTime = end - now;

      if (distance < 0 && passTime < 0) {
        clearInterval(this.interval);
        return;
      } else if (distance < 0 && passTime > 0) {
        this.calcTime(passTime);
      } else if (distance > 0 && passTime > 0) {
        this.calcTime(distance);
      }
    },
    calcTime: function calcTime(dist) {
      // Time calculations for days, hours, minutes and seconds
      this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
      this.hours = Math.floor(dist % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
      this.minutes = Math.floor(dist % (1000 * 60 * 60) / (1000 * 60));
      this.seconds = Math.floor(dist % (1000 * 60) / 1000);
    }
  }
});

/***/ }),

/***/ "./resources/js/assets/images/logo-dark.png":
/*!**************************************************!*\
  !*** ./resources/js/assets/images/logo-dark.png ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ("/images/logo-dark.png?06470a30625bc00ba4a3795f16be56b8");

/***/ }),

/***/ "./resources/js/views/pages/utility/coming-soon.vue":
/*!**********************************************************!*\
  !*** ./resources/js/views/pages/utility/coming-soon.vue ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./coming-soon.vue?vue&type=template&id=5161952c& */ "./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c&");
/* harmony import */ var _coming_soon_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./coming-soon.vue?vue&type=script&lang=js& */ "./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _coming_soon_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__.render,
  _coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pages/utility/coming-soon.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_coming_soon_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./coming-soon.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_coming_soon_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_coming_soon_vue_vue_type_template_id_5161952c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./coming-soon.vue?vue&type=template&id=5161952c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pages/utility/coming-soon.vue?vue&type=template&id=5161952c& ***!
  \********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm._m(0),
    _vm._v(" "),
    _c("div", [
      _c("div", { staticClass: "container-fluid p-0" }, [
        _c("div", { staticClass: "row no-gutters" }, [
          _c("div", { staticClass: "col-lg-4" }, [
            _c(
              "div",
              {
                staticClass:
                  "authentication-page-content p-4 d-flex align-items-center min-vh-100",
              },
              [
                _c("div", { staticClass: "w-100 py-4" }, [
                  _c("div", { staticClass: "row justify-content-center" }, [
                    _c("div", { staticClass: "col-lg-9" }, [
                      _c("div", [
                        _vm._m(1),
                        _vm._v(" "),
                        _c("div", { staticClass: "p-2 mt-5" }, [
                          _c(
                            "div",
                            {
                              staticClass: "counter-number",
                              attrs: { "data-countdown": "2020/12/31" },
                            },
                            [
                              _c("div", { staticClass: "coming-box" }, [
                                _vm._v(
                                  "\n                          " +
                                    _vm._s(_vm.days) +
                                    "\n                          "
                                ),
                                _c("span", [_vm._v("Days")]),
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "coming-box" }, [
                                _vm._v(
                                  "\n                          " +
                                    _vm._s(_vm.hours) +
                                    "\n                          "
                                ),
                                _c("span", [_vm._v("Hours")]),
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "coming-box" }, [
                                _vm._v(
                                  "\n                          " +
                                    _vm._s(_vm.minutes) +
                                    "\n                          "
                                ),
                                _c("span", [_vm._v("Minutes")]),
                              ]),
                              _vm._v(" "),
                              _c("div", { staticClass: "coming-box" }, [
                                _vm._v(
                                  "\n                          " +
                                    _vm._s(_vm.seconds) +
                                    "\n                          "
                                ),
                                _c("span", [_vm._v("Seconds")]),
                              ]),
                            ]
                          ),
                        ]),
                        _vm._v(" "),
                        _vm._m(2),
                      ]),
                    ]),
                  ]),
                ]),
              ]
            ),
          ]),
          _vm._v(" "),
          _vm._m(3),
        ]),
      ]),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "home-btn d-none d-sm-block" }, [
      _c("a", { attrs: { href: "index.html" } }, [
        _c("i", { staticClass: "mdi mdi-home-variant h2 text-white" }),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "text-center" }, [
      _c("div", [
        _c("a", { staticClass: "logo", attrs: { href: "index.html" } }, [
          _c("img", {
            attrs: {
              src: __webpack_require__(/*! @/assets/images/logo-dark.png */ "./resources/js/assets/images/logo-dark.png"),
              height: "20",
              alt: "logo",
            },
          }),
        ]),
      ]),
      _vm._v(" "),
      _c("h4", { staticClass: "font-size-18 mt-4" }, [
        _vm._v("Let's get started with Nazox"),
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "text-muted" }, [
        _vm._v(
          "It will be as simple as Occidental in fact it will be Occidental."
        ),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "input-section mt-5" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col" }, [
          _c("div", { staticClass: "position-relative" }, [
            _c("input", {
              staticClass: "form-control",
              attrs: { type: "email", placeholder: "Enter email address..." },
            }),
          ]),
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-auto" }, [
          _c(
            "button",
            {
              staticClass: "btn btn-primary w-md waves-effect waves-light",
              attrs: { type: "submit" },
            },
            [_vm._v("Subscribe")]
          ),
        ]),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-lg-8" }, [
      _c("div", { staticClass: "authentication-bg comingsoon-bg" }, [
        _c("div", { staticClass: "bg-overlay" }),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);