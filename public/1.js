(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_0__);

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      list1: [],
      list2: []
    };
  },
  created: function created() {
    this.get();
  },
  methods: {
    get: function get() {
      var _this = this;
      axios__WEBPACK_IMPORTED_MODULE_0___default.a.get("posts/latest").then(function (res) {
        _this.list1 = res.data.slice(0, 2);
        _this.list2 = res.data.slice(2, 4);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true":
/*!***************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true ***!
  \***************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col col-sm-12 col-md-8 col-lg-8"
  }, [_vm.list1.length > 0 ? _c("b-card-group", {
    attrs: {
      deck: ""
    }
  }, _vm._l(_vm.list1, function (p, index) {
    return _c("b-card", {
      key: index,
      staticClass: "text-left",
      staticStyle: {
        "max-width": "21rem"
      },
      attrs: {
        title: p.service.name,
        "img-src": "/images/home/tiling-wall.png",
        "img-alt": "Image",
        "img-top": ""
      }
    }, [_c("b-card-text", [_vm._v("\n                  " + _vm._s(p.note) + "\n                ")])], 1);
  }), 1) : _vm._e(), _vm._v(" "), _c("br"), _vm._v(" "), _vm.list2.length > 0 ? _c("b-card-group", {
    attrs: {
      deck: ""
    }
  }, _vm._l(_vm.list1, function (p, index) {
    return _c("b-card", {
      key: index,
      staticClass: "text-left",
      staticStyle: {
        "max-width": "21rem"
      },
      attrs: {
        title: p.service.name,
        "img-src": "/images/home/cleaning-floor-man.png",
        "img-alt": "Image",
        "img-top": ""
      }
    }, [_c("b-card-text", [_vm._v("\n                  " + _vm._s(p.note) + "\n                ")])], 1);
  }), 1) : _vm._e()], 1), _vm._v(" "), _vm._m(0)])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col col-sm-12 col-md-4 col-lg-4 text-container"
  }, [_c("div", {
    staticClass: "mb-5 see-job"
  }, [_c("strong", [_vm._v("See more jobs")])]), _vm._v(" "), _c("div", {
    staticClass: "p-3 text-center"
  }, [_c("p", [_vm._v("\n                Unlock the perfect solution for your projects, from timely and professional completion to connecting\nwith top-notch experts, your search stops here. No task is too small or too big—post any job, repair, or\nproject, and let Exptradies link you with pros perfectly tailored to your needs. Experience exceptional\nresults in every task you entrust to us.\n              ")]), _vm._v(" "), _c("div", {
    staticClass: "post-job"
  }, [_c("a", {
    attrs: {
      href: "#post-a-job"
    }
  }, [_c("strong", [_vm._v("Post a Job")])])])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".text-container[data-v-25884132] {\n  display: flex;\n  flex-direction: column;\n  justify-content: space-between;\n}\n.text-container .see-job[data-v-25884132] {\n  padding: 20px;\n  border: solid 1px #ddd;\n  height: 100px;\n  width: 100%;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  cursor: pointer;\n}\n.text-container .text-center[data-v-25884132] {\n  display: flex;\n  flex-direction: column;\n  justify-content: space-between;\n  background: #fff;\n  padding: 10px;\n}\n.text-container .post-job[data-v-25884132] {\n  background: blue;\n  color: #ddd;\n  width: 100%;\n  height: 100px;\n  display: flex;\n  justify-content: center;\n  align-items: center;\n  cursor: pointer;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./resources/js/components/web/sub/LatestPosts.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/web/sub/LatestPosts.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LatestPosts.vue?vue&type=template&id=25884132&scoped=true */ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true");
/* harmony import */ var _LatestPosts_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LatestPosts.vue?vue&type=script&lang=js */ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js");
/* empty/unused harmony star reexport *//* harmony import */ var _LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss */ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _LatestPosts_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"],
  _LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__["render"],
  _LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "25884132",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/web/sub/LatestPosts.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LatestPosts.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=script&lang=js");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss":
/*!******************************************************************************************************************!*\
  !*** ./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss ***!
  \******************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=style&index=0&id=25884132&scoped=true&lang=scss");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_style_index_0_id_25884132_scoped_true_lang_scss__WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true":
/*!***************************************************************************************************!*\
  !*** ./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./LatestPosts.vue?vue&type=template&id=25884132&scoped=true */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/web/sub/LatestPosts.vue?vue&type=template&id=25884132&scoped=true");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_LatestPosts_vue_vue_type_template_id_25884132_scoped_true__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);