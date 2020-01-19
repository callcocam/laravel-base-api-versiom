(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["middlewares~permissions~profile~roles~translations"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractList.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AbstractList.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "AbstractList",
  data: function data() {
    return {
      selectMode: 'multi',
      selected: [],
      sortBy: 'age',
      sortDesc: false,
      themeInfo: null,
      params: {},
      pathNames: {
        list: '/api/auth/me',
        get: '/api/auth/me',
        "delete": '/api/auth/id',
        save: '/api/auth/profile'
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])(["row", "event", "loading", "rows", "toast"])),
  created: function created() {
    this.path(this.pathNames);
    this.loadResource();
  },
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])(["get", "list", "save", "path", "delete"]), {
    setValue: function setValue(event) {
      console.log(event);
    },
    loadResource: function loadResource() {
      this.list(this.params);
    },
    deleteResource: function deleteResource(id) {
      this.pathNames["delete"] = this.pathNames["delete"].replace('id', id);
      this.path(this.pathNames);
      this["delete"](this.params);
      this.pathNames["delete"] = this.pathNames["delete"].replace(id, 'id');
      this.path(this.pathNames);
    },
    onRowSelected: function onRowSelected(items) {
      this.selected = items;
    },
    selectAllRows: function selectAllRows(event) {
      if (event) {
        this.$refs.selectableTable.selectAllRows();
      } else {
        this.$refs.selectableTable.clearSelected();
      }
    }
  }),
  watch: {
    selected: function selected(newVal, oldVal) {
      // Handle changes in individual flavour checkboxes
      if (newVal.length === 0) {
        this.allSelected = false;
      } else if (newVal.length === this.rows.items.itemPerPage) {
        this.allSelected = true;
      } else {
        this.allSelected = false;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "card user-profile o-hidden mb-4" },
    [
      _vm.themeInfo ? _c(_vm.themeInfo, { tag: "component" }) : _vm._e(),
      _vm._v(" "),
      !_vm.loading
        ? _c("div", { staticClass: "card-body" }, [
            _c("div", { staticClass: "row" }, [
              _c(
                "div",
                { staticClass: "col-md-12 m-auto" },
                [
                  _c("b-table", {
                    ref: "selectableTable",
                    attrs: {
                      striped: "",
                      hover: "",
                      items: _vm.rows.items,
                      fields: _vm.rows.headers,
                      "sort-by": _vm.sortBy,
                      "sort-desc": _vm.sortDesc,
                      "select-mode": _vm.selectMode,
                      busy: _vm.loading,
                      responsive: "sm",
                      "sort-icon-left": "",
                      selectable: ""
                    },
                    on: {
                      "update:sortBy": function($event) {
                        _vm.sortBy = $event
                      },
                      "update:sort-by": function($event) {
                        _vm.sortBy = $event
                      },
                      "update:sortDesc": function($event) {
                        _vm.sortDesc = $event
                      },
                      "update:sort-desc": function($event) {
                        _vm.sortDesc = $event
                      },
                      "row-selected": _vm.onRowSelected
                    },
                    scopedSlots: _vm._u(
                      [
                        {
                          key: "head(id)",
                          fn: function(data) {
                            return [
                              _c(
                                "b-form-checkbox",
                                { on: { change: _vm.selectAllRows } },
                                [_vm._v(" Select All")]
                              )
                            ]
                          }
                        },
                        {
                          key: "cell(id)",
                          fn: function(ref) {
                            var rowSelected = ref.rowSelected
                            return [
                              rowSelected
                                ? [
                                    _c(
                                      "span",
                                      { attrs: { "aria-hidden": "true" } },
                                      [_vm._v("✓")]
                                    ),
                                    _vm._v(" "),
                                    _c("span", { staticClass: "sr-only" }, [
                                      _vm._v("Selected")
                                    ])
                                  ]
                                : [
                                    _c(
                                      "span",
                                      { attrs: { "aria-hidden": "true" } },
                                      [_vm._v(" ")]
                                    ),
                                    _vm._v(" "),
                                    _c("span", { staticClass: "sr-only" }, [
                                      _vm._v("Not selected")
                                    ])
                                  ]
                            ]
                          }
                        },
                        {
                          key: "cell(name)",
                          fn: function(data) {
                            return [
                              _vm._v(
                                "\n                        " +
                                  _vm._s(data.item.name) +
                                  "\n                    "
                              )
                            ]
                          }
                        },
                        {
                          key: "cell(status)",
                          fn: function(data) {
                            return [
                              data.item.status == "published"
                                ? _c(
                                    "b-badge",
                                    {
                                      attrs: { href: "#", variant: "success" }
                                    },
                                    [_vm._v("Success")]
                                  )
                                : _c(
                                    "b-badge",
                                    { attrs: { href: "#", variant: "danger" } },
                                    [_vm._v("Danger")]
                                  )
                            ]
                          }
                        },
                        {
                          key: "cell(actions)",
                          fn: function(data) {
                            return [
                              _c(
                                "b-button-group",
                                { attrs: { size: "sm" } },
                                [
                                  _c(
                                    "b-button",
                                    {
                                      attrs: {
                                        pill: "",
                                        variant: "outline-success"
                                      }
                                    },
                                    [_vm._v("Edit")]
                                  ),
                                  _vm._v(" "),
                                  _c(
                                    "b-button",
                                    {
                                      attrs: {
                                        pill: "",
                                        variant: "outline-danger"
                                      }
                                    },
                                    [_vm._v("Delete")]
                                  )
                                ],
                                1
                              )
                            ]
                          }
                        },
                        {
                          key: "table-busy",
                          fn: function() {
                            return [
                              _c(
                                "div",
                                { staticClass: "text-center text-danger my-2" },
                                [
                                  _c("b-spinner", {
                                    staticClass: "align-middle"
                                  }),
                                  _vm._v(" "),
                                  _c("strong", [_vm._v("Loading...")])
                                ],
                                1
                              )
                            ]
                          },
                          proxy: true
                        }
                      ],
                      null,
                      false,
                      2292610815
                    )
                  }),
                  _vm._v(" "),
                  _c("div", [
                    _vm._v("\n                    Sorting By: "),
                    _c("b", [_vm._v(_vm._s(_vm.sortBy))]),
                    _vm._v(", Sort Direction:\n                    "),
                    _c("b", [
                      _vm._v(_vm._s(_vm.sortDesc ? "Descending" : "Ascending"))
                    ])
                  ]),
                  _vm._v(" "),
                  _c("b-pagination", {
                    staticClass: "mt-4",
                    attrs: {
                      "total-rows": _vm.rows.options.total,
                      "per-page": _vm.rows.options.itemPerPage
                    },
                    model: {
                      value: _vm.rows.options.currentPage,
                      callback: function($$v) {
                        _vm.$set(_vm.rows.options, "currentPage", $$v)
                      },
                      expression: "rows.options.currentPage"
                    }
                  })
                ],
                1
              )
            ])
          ])
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/AbstractList.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/AbstractList.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AbstractList.vue?vue&type=template&id=b368906a&scoped=true& */ "./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true&");
/* harmony import */ var _AbstractList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AbstractList.vue?vue&type=script&lang=js& */ "./resources/js/components/AbstractList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AbstractList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "b368906a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/AbstractList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/AbstractList.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/AbstractList.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./AbstractList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./AbstractList.vue?vue&type=template&id=b368906a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractList.vue?vue&type=template&id=b368906a&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractList_vue_vue_type_template_id_b368906a_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);