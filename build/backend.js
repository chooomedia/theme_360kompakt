/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/backend/profil/profile-image.js":
/*!***************************************************!*\
  !*** ./assets/js/backend/profil/profile-image.js ***!
  \***************************************************/
/***/ (function() {

document.addEventListener('DOMContentLoaded', function () {
  var mediaUploader;
  var uploadButton = document.querySelector('#upload_profile_picture_button');
  var profilePictureInput = document.querySelector('#profile_picture');
  uploadButton.addEventListener('click', function (e) {
    e.preventDefault();

    // If the uploader object has already been created, reopen the dialog
    if (mediaUploader) {
      mediaUploader.open();
      return;
    }

    // Create the media uploader object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Upload Profile Picture',
      button: {
        text: 'Upload Picture'
      },
      multiple: false
    });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function () {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      profilePictureInput.value = attachment.url;
    });

    // Open the uploader dialog
    mediaUploader.open();
  });
});

/***/ }),

/***/ "./assets/js/backend/widgets/widgets.js":
/*!**********************************************!*\
  !*** ./assets/js/backend/widgets/widgets.js ***!
  \**********************************************/
/***/ (function() {

const {
  __
} = wp.i18n;
const {
  registerBlockStyle
} = wp.blocks;
registerBlockStyle('core/group', {
  name: 'is-kompakt-slider',
  label: __('As Slider', 'kompakt')
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!**************************************!*\
  !*** ./assets/js/backend/backend.js ***!
  \**************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _widgets_widgets__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./widgets/widgets */ "./assets/js/backend/widgets/widgets.js");
/* harmony import */ var _widgets_widgets__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_widgets_widgets__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _profil_profile_image__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./profil/profile-image */ "./assets/js/backend/profil/profile-image.js");
/* harmony import */ var _profil_profile_image__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_profil_profile_image__WEBPACK_IMPORTED_MODULE_1__);


}();
/******/ })()
;
//# sourceMappingURL=backend.js.map