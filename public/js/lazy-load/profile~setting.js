(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["profile~setting"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractForm.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AbstractForm.vue?vue&type=script&lang=js& ***!
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
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "AbstractForm",
  data: function data() {
    return {
      themeInfo: null,
      params: {},
      pathNames: {
        list: '/api/auth/me',
        get: '/api/auth/me',
        save: '/api/auth/profile'
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])(["row", "event", "loading", "rows"])),
  created: function created() {
    this.path(this.pathNames);
    this.loadResource();
  },
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])(["get", "list", "save", "path"]), {
    setValue: function setValue(event) {
      console.log(event);
    },
    loadResource: function loadResource() {
      this.get(this.params);
    },
    formSubmit: function formSubmit() {
      var _this = this;

      var data = new FormData();
      Object.keys(this.row).map(function (v) {
        if (undefined === _this.row[v].value) {
          data.append(v, '');
        } else {
          data.append(v, _this.row[v].value);
        }
      });
      this.saveResource(data);
    },
    saveResource: function saveResource(data) {
      this.save(data);
    }
  }),
  watch: {
    toast: function toast(errors) {
      if (errors != null) {
        var error = JSON.parse(errors);
        this.$bvToast.toast(error.msg, {
          title: error.title || "OPS!!",
          variant: error.variant,
          solid: error.solid
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true& ***!
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
                { staticClass: "col-lg-8 col-md-12 m-auto" },
                [
                  _c("ValidationObserver", {
                    ref: "form",
                    scopedSlots: _vm._u(
                      [
                        {
                          key: "default",
                          fn: function(ref) {
                            var passes = ref.passes
                            return [
                              _c(
                                "form",
                                {
                                  on: {
                                    submit: function($event) {
                                      $event.preventDefault()
                                      return passes(_vm.formSubmit)
                                    }
                                  }
                                },
                                [
                                  _vm._l(_vm.row, function(element, index) {
                                    return [
                                      element.type
                                        ? [
                                            element.type == "textarea"
                                              ? [
                                                  _c("ValidationProvider", {
                                                    attrs: {
                                                      vid: element.name,
                                                      name:
                                                        element.label ||
                                                        element.name
                                                    },
                                                    scopedSlots: _vm._u(
                                                      [
                                                        {
                                                          key: "default",
                                                          fn: function(ref) {
                                                            var errors =
                                                              ref.errors
                                                            return [
                                                              _c(
                                                                "b-form-group",
                                                                {
                                                                  attrs: {
                                                                    label:
                                                                      element.label ||
                                                                      element.name
                                                                  }
                                                                },
                                                                [
                                                                  _c(
                                                                    "g-textarea",
                                                                    {
                                                                      attrs: {
                                                                        errors: errors,
                                                                        attributes: element
                                                                      },
                                                                      on: {
                                                                        inputBY: function(
                                                                          $event
                                                                        ) {
                                                                          element.value = $event
                                                                        }
                                                                      }
                                                                    }
                                                                  )
                                                                ],
                                                                1
                                                              )
                                                            ]
                                                          }
                                                        }
                                                      ],
                                                      null,
                                                      true
                                                    )
                                                  })
                                                ]
                                              : element.type == "hidden"
                                              ? [
                                                  _c("input", {
                                                    directives: [
                                                      {
                                                        name: "model",
                                                        rawName: "v-model",
                                                        value: element.value,
                                                        expression:
                                                          "element.value"
                                                      }
                                                    ],
                                                    attrs: { type: "hidden" },
                                                    domProps: {
                                                      value: element.value
                                                    },
                                                    on: {
                                                      input: function($event) {
                                                        if (
                                                          $event.target
                                                            .composing
                                                        ) {
                                                          return
                                                        }
                                                        _vm.$set(
                                                          element,
                                                          "value",
                                                          $event.target.value
                                                        )
                                                      }
                                                    }
                                                  })
                                                ]
                                              : element.type == "radio"
                                              ? [
                                                  _c("ValidationProvider", {
                                                    attrs: {
                                                      vid: element.name,
                                                      name:
                                                        element.label ||
                                                        element.name
                                                    },
                                                    scopedSlots: _vm._u(
                                                      [
                                                        {
                                                          key: "default",
                                                          fn: function(ref) {
                                                            var errors =
                                                              ref.errors
                                                            return [
                                                              _c(
                                                                "b-form-group",
                                                                {
                                                                  attrs: {
                                                                    label:
                                                                      element.label ||
                                                                      element.name
                                                                  }
                                                                },
                                                                [
                                                                  _c(
                                                                    "g-radio",
                                                                    {
                                                                      attrs: {
                                                                        errors: errors,
                                                                        attributes: element
                                                                      },
                                                                      on: {
                                                                        inputBY: function(
                                                                          $event
                                                                        ) {
                                                                          element.value = $event
                                                                        }
                                                                      }
                                                                    }
                                                                  )
                                                                ],
                                                                1
                                                              )
                                                            ]
                                                          }
                                                        }
                                                      ],
                                                      null,
                                                      true
                                                    )
                                                  })
                                                ]
                                              : element.type == "file"
                                              ? [
                                                  _c("ValidationProvider", {
                                                    attrs: {
                                                      vid: element.name,
                                                      name:
                                                        element.label ||
                                                        element.name
                                                    },
                                                    scopedSlots: _vm._u(
                                                      [
                                                        {
                                                          key: "default",
                                                          fn: function(ref) {
                                                            var errors =
                                                              ref.errors
                                                            return [
                                                              _c(
                                                                "b-form-group",
                                                                {
                                                                  attrs: {
                                                                    label:
                                                                      element.label ||
                                                                      element.name
                                                                  }
                                                                },
                                                                [
                                                                  _c("g-file", {
                                                                    attrs: {
                                                                      errors: errors,
                                                                      attributes: element
                                                                    },
                                                                    on: {
                                                                      inputBY: function(
                                                                        $event
                                                                      ) {
                                                                        element.value = $event
                                                                      }
                                                                    }
                                                                  })
                                                                ],
                                                                1
                                                              )
                                                            ]
                                                          }
                                                        }
                                                      ],
                                                      null,
                                                      true
                                                    )
                                                  })
                                                ]
                                              : element.type == "editor"
                                              ? [
                                                  _c("ValidationProvider", {
                                                    attrs: {
                                                      vid: element.name,
                                                      name:
                                                        element.label ||
                                                        element.name
                                                    },
                                                    scopedSlots: _vm._u(
                                                      [
                                                        {
                                                          key: "default",
                                                          fn: function(ref) {
                                                            var errors =
                                                              ref.errors
                                                            return [
                                                              _c(
                                                                "b-form-group",
                                                                {
                                                                  attrs: {
                                                                    label:
                                                                      element.label ||
                                                                      element.name
                                                                  }
                                                                },
                                                                [
                                                                  _c(
                                                                    "g-editor",
                                                                    {
                                                                      attrs: {
                                                                        errors: errors,
                                                                        attributes: element
                                                                      },
                                                                      on: {
                                                                        inputBY: function(
                                                                          $event
                                                                        ) {
                                                                          element.value = $event
                                                                        }
                                                                      }
                                                                    }
                                                                  )
                                                                ],
                                                                1
                                                              )
                                                            ]
                                                          }
                                                        }
                                                      ],
                                                      null,
                                                      true
                                                    )
                                                  })
                                                ]
                                              : element.type == "separator"
                                              ? [
                                                  _c(
                                                    "label",
                                                    {
                                                      staticClass:
                                                        "footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center"
                                                    },
                                                    [
                                                      _vm._v(
                                                        _vm._s(element.label)
                                                      )
                                                    ]
                                                  )
                                                ]
                                              : [
                                                  _c("ValidationProvider", {
                                                    attrs: {
                                                      vid: element.name,
                                                      name:
                                                        element.label ||
                                                        element.name
                                                    },
                                                    scopedSlots: _vm._u(
                                                      [
                                                        {
                                                          key: "default",
                                                          fn: function(ref) {
                                                            var errors =
                                                              ref.errors
                                                            return [
                                                              _c(
                                                                "b-form-group",
                                                                {
                                                                  attrs: {
                                                                    label:
                                                                      element.label ||
                                                                      element.name
                                                                  }
                                                                },
                                                                [
                                                                  _c(
                                                                    "g-input",
                                                                    {
                                                                      attrs: {
                                                                        errors: errors,
                                                                        attributes: element
                                                                      },
                                                                      on: {
                                                                        inputBY: function(
                                                                          $event
                                                                        ) {
                                                                          element.value = $event
                                                                        }
                                                                      }
                                                                    }
                                                                  )
                                                                ],
                                                                1
                                                              )
                                                            ]
                                                          }
                                                        }
                                                      ],
                                                      null,
                                                      true
                                                    )
                                                  })
                                                ]
                                          ]
                                        : _vm._e()
                                    ]
                                  }),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "col-md-12" }, [
                                    _c(
                                      "button",
                                      {
                                        staticClass:
                                          "btn btn-primary btn-block",
                                        attrs: { type: "submit" }
                                      },
                                      [_vm._v("Salvar Dados")]
                                    )
                                  ])
                                ],
                                2
                              )
                            ]
                          }
                        }
                      ],
                      null,
                      false,
                      2600484756
                    )
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

/***/ "./resources/js/components/AbstractForm.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/AbstractForm.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AbstractForm.vue?vue&type=template&id=725290f1&scoped=true& */ "./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true&");
/* harmony import */ var _AbstractForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AbstractForm.vue?vue&type=script&lang=js& */ "./resources/js/components/AbstractForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AbstractForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "725290f1",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/AbstractForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/AbstractForm.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/components/AbstractForm.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./AbstractForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./AbstractForm.vue?vue&type=template&id=725290f1&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/AbstractForm.vue?vue&type=template&id=725290f1&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AbstractForm_vue_vue_type_template_id_725290f1_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);