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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./app/blocks/archive-loop/block.json":
/*!********************************************!*\
  !*** ./app/blocks/archive-loop/block.json ***!
  \********************************************/
/*! exports provided: apiVersion, name, title, category, icon, description, keywords, textdomain, attributes, supports, default */
/***/ (function(module) {

eval("module.exports = JSON.parse(\"{\\\"apiVersion\\\":2,\\\"name\\\":\\\"wbl-theme/archive-loop\\\",\\\"title\\\":\\\"Archive Loop\\\",\\\"category\\\":\\\"layout\\\",\\\"icon\\\":\\\"list-view\\\",\\\"description\\\":\\\"Use this block on archives to determine where the loop will show\\\",\\\"keywords\\\":[\\\"Archive\\\",\\\"Loop\\\",\\\"Query\\\",\\\"Posts\\\"],\\\"textdomain\\\":\\\"wbl-theme\\\",\\\"attributes\\\":{},\\\"supports\\\":{\\\"align\\\":[],\\\"anchor\\\":false,\\\"className\\\":false,\\\"customClassName\\\":false,\\\"defaultStylePicker\\\":false,\\\"html\\\":false}}\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiIuL2FwcC9ibG9ja3MvYXJjaGl2ZS1sb29wL2Jsb2NrLmpzb24uanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/block.json\n");

/***/ }),

/***/ "./app/blocks/archive-loop/edit.js":
/*!*****************************************!*\
  !*** ./app/blocks/archive-loop/edit.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/**\n * WordPress dependencies\n */\nvar useBlockProps = wp.blockEditor.useBlockProps;\nvar __ = wp.i18n.__; // const { withSelect } = wp.data;\n\n/**\n * Internal dependencies\n */\n// import { name } from './';\n\n/**\n * Edit function\n */\n\nfunction edit(_ref) {\n  var attributes = _ref.attributes,\n      setAttributes = _ref.setAttributes,\n      isSelected = _ref.isSelected;\n  // Setup new variables\n  var blockClassName = \"wbl-archive-loop\"; // Setup blockProps\n\n  var blockProps = useBlockProps({\n    className: blockClassName\n  });\n  return /*#__PURE__*/React.createElement(\"div\", blockProps, /*#__PURE__*/React.createElement(\"h2\", {\n    className: \"\".concat(blockClassName, \"__title\")\n  }, __('Archive Loop', 'wbl-theme')), /*#__PURE__*/React.createElement(\"p\", {\n    className: \"\".concat(blockClassName, \"__text\")\n  }, __('This block is a placeholder for the archive loop', 'wbl-theme')));\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (edit);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9lZGl0LmpzPzc2MmYiXSwibmFtZXMiOlsidXNlQmxvY2tQcm9wcyIsIndwIiwiYmxvY2tFZGl0b3IiLCJfXyIsImkxOG4iLCJlZGl0IiwiYXR0cmlidXRlcyIsInNldEF0dHJpYnV0ZXMiLCJpc1NlbGVjdGVkIiwiYmxvY2tDbGFzc05hbWUiLCJibG9ja1Byb3BzIiwiY2xhc3NOYW1lIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBLElBQVFBLGFBQVIsR0FBMEJDLEVBQUUsQ0FBQ0MsV0FBN0IsQ0FBUUYsYUFBUjtBQUNBLElBQVFHLEVBQVIsR0FBZUYsRUFBRSxDQUFDRyxJQUFsQixDQUFRRCxFQUFSLEMsQ0FDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBQ0EsU0FBU0UsSUFBVCxPQUEyRDtBQUFBLE1BQTFDQyxVQUEwQyxRQUExQ0EsVUFBMEM7QUFBQSxNQUE5QkMsYUFBOEIsUUFBOUJBLGFBQThCO0FBQUEsTUFBZkMsVUFBZSxRQUFmQSxVQUFlO0FBRTFEO0FBQ0EsTUFBTUMsY0FBYyxHQUFHLGtCQUF2QixDQUgwRCxDQUsxRDs7QUFDQSxNQUFNQyxVQUFVLEdBQUdWLGFBQWEsQ0FBRTtBQUNqQ1csYUFBUyxFQUFFRjtBQURzQixHQUFGLENBQWhDO0FBSUEsc0JBQ0MsMkJBQVNDLFVBQVQsZUFDVTtBQUFJLGFBQVMsWUFBTUQsY0FBTjtBQUFiLEtBQStDTixFQUFFLENBQUMsY0FBRCxFQUFpQixXQUFqQixDQUFqRCxDQURWLGVBRVU7QUFBRyxhQUFTLFlBQU1NLGNBQU47QUFBWixLQUE2Q04sRUFBRSxDQUFDLGtEQUFELEVBQXFELFdBQXJELENBQS9DLENBRlYsQ0FERDtBQU1BOztBQUVjRSxtRUFBZiIsImZpbGUiOiIuL2FwcC9ibG9ja3MvYXJjaGl2ZS1sb29wL2VkaXQuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIFdvcmRQcmVzcyBkZXBlbmRlbmNpZXNcbiAqL1xuY29uc3Qge1x0dXNlQmxvY2tQcm9wcyB9ID0gd3AuYmxvY2tFZGl0b3I7XG5jb25zdCB7IF9fIH0gPSB3cC5pMThuO1xuLy8gY29uc3QgeyB3aXRoU2VsZWN0IH0gPSB3cC5kYXRhO1xuXG4vKipcbiAqIEludGVybmFsIGRlcGVuZGVuY2llc1xuICovXG4vLyBpbXBvcnQgeyBuYW1lIH0gZnJvbSAnLi8nO1xuXG4vKipcbiAqIEVkaXQgZnVuY3Rpb25cbiAqL1xuZnVuY3Rpb24gZWRpdCggeyBhdHRyaWJ1dGVzLCBzZXRBdHRyaWJ1dGVzLCBpc1NlbGVjdGVkIH0gKSB7XG5cblx0Ly8gU2V0dXAgbmV3IHZhcmlhYmxlc1xuXHRjb25zdCBibG9ja0NsYXNzTmFtZSA9IFwid2JsLWFyY2hpdmUtbG9vcFwiO1xuXG5cdC8vIFNldHVwIGJsb2NrUHJvcHNcblx0Y29uc3QgYmxvY2tQcm9wcyA9IHVzZUJsb2NrUHJvcHMoIHtcblx0XHRjbGFzc05hbWU6IGJsb2NrQ2xhc3NOYW1lXG5cdH0gKTtcblxuXHRyZXR1cm4gKFxuXHRcdDxkaXYgey4uLmJsb2NrUHJvcHMgfT5cbiAgICAgICAgICAgIDxoMiBjbGFzc05hbWU9eyBgJHtibG9ja0NsYXNzTmFtZX1fX3RpdGxlYCB9PnsgX18oJ0FyY2hpdmUgTG9vcCcsICd3YmwtdGhlbWUnICkgfTwvaDI+XG4gICAgICAgICAgICA8cCBjbGFzc05hbWU9eyBgJHtibG9ja0NsYXNzTmFtZX1fX3RleHRgIH0+eyBfXygnVGhpcyBibG9jayBpcyBhIHBsYWNlaG9sZGVyIGZvciB0aGUgYXJjaGl2ZSBsb29wJywgJ3dibC10aGVtZScgKSB9PC9wPlxuXHRcdDwvZGl2PlxuXHQpO1xufVxuXG5leHBvcnQgZGVmYXVsdCBlZGl0O1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/edit.js\n");

/***/ }),

/***/ "./app/blocks/archive-loop/editor.css":
/*!********************************************!*\
  !*** ./app/blocks/archive-loop/editor.css ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9lZGl0b3IuY3NzP2QxMWUiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUEiLCJmaWxlIjoiLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9lZGl0b3IuY3NzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/editor.css\n");

/***/ }),

/***/ "./app/blocks/archive-loop/index.js":
/*!******************************************!*\
  !*** ./app/blocks/archive-loop/index.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./block.json */ \"./app/blocks/archive-loop/block.json\");\nvar _block_json__WEBPACK_IMPORTED_MODULE_0___namespace = /*#__PURE__*/__webpack_require__.t(/*! ./block.json */ \"./app/blocks/archive-loop/block.json\", 1);\n/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./edit */ \"./app/blocks/archive-loop/edit.js\");\n/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./save */ \"./app/blocks/archive-loop/save.js\");\n/**\n * External dependancies\n */\nvar _lodash = lodash,\n    merge = _lodash.merge; // Imports\n\n\n\n // Get name from metadata\n\nvar name = _block_json__WEBPACK_IMPORTED_MODULE_0__.name; // Merge the metadata with the edit and save functions\n\nvar settings = merge(_block_json__WEBPACK_IMPORTED_MODULE_0__, {\n  edit: _edit__WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  save: _save__WEBPACK_IMPORTED_MODULE_2__[\"default\"]\n}); // Register the block\n\nwp.blocks.registerBlockType(name, settings);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9pbmRleC5qcz80ZDY1Il0sIm5hbWVzIjpbImxvZGFzaCIsIm1lcmdlIiwibmFtZSIsIm1ldGFkYXRhIiwic2V0dGluZ3MiLCJlZGl0Iiwic2F2ZSIsIndwIiwiYmxvY2tzIiwicmVnaXN0ZXJCbG9ja1R5cGUiXSwibWFwcGluZ3MiOiJBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQSxjQUFrQkEsTUFBbEI7QUFBQSxJQUFRQyxLQUFSLFdBQVFBLEtBQVIsQyxDQUVBOztBQUNBO0FBQ0E7Q0FHQTs7QUFDQSxJQUFRQyxJQUFSLEdBQWlCQyx3Q0FBakIsQ0FBUUQsSUFBUixDLENBRUE7O0FBQ0EsSUFBTUUsUUFBUSxHQUFHSCxLQUFLLENBQUNFLHdDQUFELEVBQVc7QUFDaENFLE1BQUksRUFBRUEsNkNBRDBCO0FBRWhDQyxNQUFJLEVBQUVBLDZDQUFJQTtBQUZzQixDQUFYLENBQXRCLEMsQ0FLQTs7QUFDQUMsRUFBRSxDQUFDQyxNQUFILENBQVVDLGlCQUFWLENBQTZCUCxJQUE3QixFQUFtQ0UsUUFBbkMiLCJmaWxlIjoiLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9pbmRleC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogRXh0ZXJuYWwgZGVwZW5kYW5jaWVzXG4gKi9cbmNvbnN0IHsgbWVyZ2UgfSA9IGxvZGFzaDtcblxuLy8gSW1wb3J0c1xuaW1wb3J0IG1ldGFkYXRhIGZyb20gJy4vYmxvY2suanNvbic7XG5pbXBvcnQgZWRpdCBmcm9tICcuL2VkaXQnO1xuaW1wb3J0IHNhdmUgZnJvbSAnLi9zYXZlJztcblxuLy8gR2V0IG5hbWUgZnJvbSBtZXRhZGF0YVxuY29uc3QgeyBuYW1lIH0gPSBtZXRhZGF0YTtcblxuLy8gTWVyZ2UgdGhlIG1ldGFkYXRhIHdpdGggdGhlIGVkaXQgYW5kIHNhdmUgZnVuY3Rpb25zXG5jb25zdCBzZXR0aW5ncyA9IG1lcmdlKG1ldGFkYXRhLCB7XG5cdGVkaXQ6IGVkaXQsXG5cdHNhdmU6IHNhdmVcbn0pO1xuXG4vLyBSZWdpc3RlciB0aGUgYmxvY2tcbndwLmJsb2Nrcy5yZWdpc3RlckJsb2NrVHlwZSggbmFtZSwgc2V0dGluZ3MgKTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/index.js\n");

/***/ }),

/***/ "./app/blocks/archive-loop/save.js":
/*!*****************************************!*\
  !*** ./app/blocks/archive-loop/save.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/**\n * Internal dependencies\n */\n\n/**\n * WordPress dependencies\n */\n\n/**\n * Dynamic save function\n */\nfunction save() {\n  return null;\n}\n\n;\n/* harmony default export */ __webpack_exports__[\"default\"] = (save);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9zYXZlLmpzP2YyNjAiXSwibmFtZXMiOlsic2F2ZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFBQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLFNBQVNBLElBQVQsR0FBZ0I7QUFFZixTQUFPLElBQVA7QUFDQTs7QUFBQTtBQUVjQSxtRUFBZiIsImZpbGUiOiIuL2FwcC9ibG9ja3MvYXJjaGl2ZS1sb29wL3NhdmUuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIEludGVybmFsIGRlcGVuZGVuY2llc1xuICovXG5cbi8qKlxuICogV29yZFByZXNzIGRlcGVuZGVuY2llc1xuICovXG5cbi8qKlxuICogRHluYW1pYyBzYXZlIGZ1bmN0aW9uXG4gKi9cbmZ1bmN0aW9uIHNhdmUoKSB7XG5cblx0cmV0dXJuIG51bGw7XG59O1xuXG5leHBvcnQgZGVmYXVsdCBzYXZlO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/save.js\n");

/***/ }),

/***/ "./app/blocks/archive-loop/style.css":
/*!*******************************************!*\
  !*** ./app/blocks/archive-loop/style.css ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hcHAvYmxvY2tzL2FyY2hpdmUtbG9vcC9zdHlsZS5jc3M/YzIxMiJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSIsImZpbGUiOiIuL2FwcC9ibG9ja3MvYXJjaGl2ZS1sb29wL3N0eWxlLmNzcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./app/blocks/archive-loop/style.css\n");

/***/ }),

/***/ 0:
/*!*************************************************************************************************************************!*\
  !*** multi ./app/blocks/archive-loop/index.js ./app/blocks/archive-loop/editor.css ./app/blocks/archive-loop/style.css ***!
  \*************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/erik/Webdev/www/hetweblokaal/public_html/wp-content/themes/wbl-theme-foundation/app/blocks/archive-loop/index.js */"./app/blocks/archive-loop/index.js");
__webpack_require__(/*! /home/erik/Webdev/www/hetweblokaal/public_html/wp-content/themes/wbl-theme-foundation/app/blocks/archive-loop/editor.css */"./app/blocks/archive-loop/editor.css");
module.exports = __webpack_require__(/*! /home/erik/Webdev/www/hetweblokaal/public_html/wp-content/themes/wbl-theme-foundation/app/blocks/archive-loop/style.css */"./app/blocks/archive-loop/style.css");


/***/ })

/******/ });