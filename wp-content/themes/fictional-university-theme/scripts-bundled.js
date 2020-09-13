/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./public/wp-content/themes/fictional-university-theme/js/scripts.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./public/wp-content/themes/fictional-university-theme/css/style.css":
/*!***************************************************************************!*\
  !*** ./public/wp-content/themes/fictional-university-theme/css/style.css ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("throw new Error(\"Module parse failed: Unexpected character '@' (2:0)\\nYou may need an appropriate loader to handle this file type, currently no loaders are configured to process this file. See https://webpack.js.org/concepts#loaders\\n| /* 3rd party packages */\\n> @import \\\"normalize.css\\\";\\n| @import \\\"../node_modules/@glidejs/glide/dist/css/glide.core.min.css\\\";\\n| \");\n\n//# sourceURL=webpack:///./public/wp-content/themes/fictional-university-theme/css/style.css?");

/***/ }),

/***/ "./public/wp-content/themes/fictional-university-theme/js/modules/GoogleMap.js":
/*!*************************************************************************************!*\
  !*** ./public/wp-content/themes/fictional-university-theme/js/modules/GoogleMap.js ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\nvar GMap = /*#__PURE__*/function () {\n  function GMap() {\n    var _this = this;\n\n    _classCallCheck(this, GMap);\n\n    document.querySelectorAll(\".acf-map\").forEach(function (el) {\n      _this.new_map(el);\n    });\n  }\n\n  _createClass(GMap, [{\n    key: \"new_map\",\n    value: function new_map($el) {\n      var $markers = $el.querySelectorAll(\".marker\");\n      var args = {\n        zoom: 16,\n        center: new google.maps.LatLng(0, 0),\n        mapTypeId: google.maps.MapTypeId.ROADMAP\n      };\n      var map = new google.maps.Map($el, args);\n      map.markers = [];\n      var that = this; // add markers\n\n      $markers.forEach(function (x) {\n        that.add_marker(x, map);\n      }); // center map\n\n      this.center_map(map);\n    } // end new_map\n\n  }, {\n    key: \"add_marker\",\n    value: function add_marker($marker, map) {\n      var latlng = new google.maps.LatLng($marker.getAttribute(\"data-lat\"), $marker.getAttribute(\"data-lng\"));\n      var marker = new google.maps.Marker({\n        position: latlng,\n        map: map\n      });\n      map.markers.push(marker); // if marker contains HTML, add it to an infoWindow\n\n      if ($marker.innerHTML) {\n        // create info window\n        var infowindow = new google.maps.InfoWindow({\n          content: $marker.innerHTML\n        }); // show info window when marker is clicked\n\n        google.maps.event.addListener(marker, \"click\", function () {\n          infowindow.open(map, marker);\n        });\n      }\n    } // end add_marker\n\n  }, {\n    key: \"center_map\",\n    value: function center_map(map) {\n      var bounds = new google.maps.LatLngBounds(); // loop through all markers and create bounds\n\n      map.markers.forEach(function (marker) {\n        var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());\n        bounds.extend(latlng);\n      }); // only 1 marker?\n\n      if (map.markers.length == 1) {\n        // set center of map\n        map.setCenter(bounds.getCenter());\n        map.setZoom(16);\n      } else {\n        // fit to bounds\n        map.fitBounds(bounds);\n      }\n    } // end center_map\n\n  }]);\n\n  return GMap;\n}();\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (GMap);\n\n//# sourceURL=webpack:///./public/wp-content/themes/fictional-university-theme/js/modules/GoogleMap.js?");

/***/ }),

/***/ "./public/wp-content/themes/fictional-university-theme/js/modules/HeroSlider.js":
/*!**************************************************************************************!*\
  !*** ./public/wp-content/themes/fictional-university-theme/js/modules/HeroSlider.js ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n!(function webpackMissingModule() { var e = new Error(\"Cannot find module '@glidejs/glide'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }());\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\n\n\nvar HeroSlider = function HeroSlider() {\n  _classCallCheck(this, HeroSlider);\n\n  if (document.querySelector(\".hero-slider\")) {\n    // count how many slides there are\n    var dotCount = document.querySelectorAll(\".hero-slider__slide\").length; // Generate the HTML for the navigation dots\n\n    var dotHTML = \"\";\n\n    for (var i = 0; i < dotCount; i++) {\n      dotHTML += \"<button class=\\\"slider__bullet glide__bullet\\\" data-glide-dir=\\\"=\".concat(i, \"\\\"></button>\");\n    } // Add the dots HTML to the DOM\n\n\n    document.querySelector(\".glide__bullets\").insertAdjacentHTML(\"beforeend\", dotHTML); // Actually initialize the glide / slider script\n\n    var glide = new !(function webpackMissingModule() { var e = new Error(\"Cannot find module '@glidejs/glide'\"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(\".hero-slider\", {\n      type: \"carousel\",\n      perView: 1,\n      autoplay: 3000\n    });\n    glide.mount();\n  }\n};\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (HeroSlider);\n\n//# sourceURL=webpack:///./public/wp-content/themes/fictional-university-theme/js/modules/HeroSlider.js?");

/***/ }),

/***/ "./public/wp-content/themes/fictional-university-theme/js/modules/MobileMenu.js":
/*!**************************************************************************************!*\
  !*** ./public/wp-content/themes/fictional-university-theme/js/modules/MobileMenu.js ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\nvar MobileMenu = /*#__PURE__*/function () {\n  function MobileMenu() {\n    _classCallCheck(this, MobileMenu);\n\n    this.menu = document.querySelector(\".site-header__menu\");\n    this.openButton = document.querySelector(\".site-header__menu-trigger\");\n    this.events();\n  }\n\n  _createClass(MobileMenu, [{\n    key: \"events\",\n    value: function events() {\n      var _this = this;\n\n      this.openButton.addEventListener(\"click\", function () {\n        return _this.openMenu();\n      });\n    }\n  }, {\n    key: \"openMenu\",\n    value: function openMenu() {\n      this.openButton.classList.toggle(\"fa-bars\");\n      this.openButton.classList.toggle(\"fa-window-close\");\n      this.menu.classList.toggle(\"site-header__menu--active\");\n    }\n  }]);\n\n  return MobileMenu;\n}();\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (MobileMenu);\n\n//# sourceURL=webpack:///./public/wp-content/themes/fictional-university-theme/js/modules/MobileMenu.js?");

/***/ }),

/***/ "./public/wp-content/themes/fictional-university-theme/js/scripts.js":
/*!***************************************************************************!*\
  !*** ./public/wp-content/themes/fictional-university-theme/js/scripts.js ***!
  \***************************************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _css_style_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../css/style.css */ \"./public/wp-content/themes/fictional-university-theme/css/style.css\");\n/* harmony import */ var _css_style_css__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_css_style_css__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _modules_MobileMenu__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/MobileMenu */ \"./public/wp-content/themes/fictional-university-theme/js/modules/MobileMenu.js\");\n/* harmony import */ var _modules_HeroSlider__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/HeroSlider */ \"./public/wp-content/themes/fictional-university-theme/js/modules/HeroSlider.js\");\n/* harmony import */ var _modules_GoogleMap__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/GoogleMap */ \"./public/wp-content/themes/fictional-university-theme/js/modules/GoogleMap.js\");\n // Our modules / classes\n\n\n\n // Instantiate a new object using our modules/classes\n\nvar mobileMenu = new _modules_MobileMenu__WEBPACK_IMPORTED_MODULE_1__[\"default\"]();\nvar heroSlider = new _modules_HeroSlider__WEBPACK_IMPORTED_MODULE_2__[\"default\"]();\nvar googleMap = new _modules_GoogleMap__WEBPACK_IMPORTED_MODULE_3__[\"default\"](); // Allow new JS and CSS to load in browser without a traditional page refresh\n\nif (false) {}\n\n//# sourceURL=webpack:///./public/wp-content/themes/fictional-university-theme/js/scripts.js?");

/***/ })

/******/ });