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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
/******/ })
/************************************************************************/
/******/ ({

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(53);


/***/ }),

/***/ 53:
/***/ (function(module, exports) {

jQuery(function ($) {

	var form = $('.contact-form');
	form.submit(function () {
		'use strict', $this = $(this);
		$.post("sendemail.php", $(".contact-form").serialize(), function (result) {
			if (result.type == 'success') {
				$this.prev().text(result.message).fadeIn().delay(3000).fadeOut();
			}
		});
		return false;
	});
});

// Google Map Customization
(function () {

	var map;

	map = new GMaps({
		el: '#gmap',
		lat: 43.1580159,
		lng: -77.6030777,
		scrollwheel: false,
		zoom: 14,
		zoomControl: false,
		panControl: false,
		streetViewControl: false,
		mapTypeControl: false,
		overviewMapControl: false,
		clickable: false
	});

	var image = 'images/map-icon.png';
	map.addMarker({
		lat: 43.1580159,
		lng: -77.6030777,
		// icon: image,
		animation: google.maps.Animation.DROP,
		verticalAlign: 'bottom',
		horizontalAlign: 'center',
		backgroundColor: '#ffffff'
	});

	var styles = [{
		"featureType": "road",
		"stylers": [{ "color": "" }]
	}, {
		"featureType": "water",
		"stylers": [{ "color": "#A2DAF2" }]
	}, {
		"featureType": "landscape",
		"stylers": [{ "color": "#ABCE83" }]
	}, {
		"elementType": "labels.text.fill",
		"stylers": [{ "color": "#000000" }]
	}, {
		"featureType": "poi",
		"stylers": [{ "color": "#2ECC71" }]
	}, {
		"elementType": "labels.text",
		"stylers": [{ "saturation": 1 }, { "weight": 0.1 }, { "color": "#111111" }]
	}];

	map.addStyle({
		styledMapName: "Styled Map",
		styles: styles,
		mapTypeId: "map_style"
	});

	map.setStyle("map_style");
})();

/***/ })

/******/ });