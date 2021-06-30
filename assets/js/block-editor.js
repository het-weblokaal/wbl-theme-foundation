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

/***/ "./src/js/block-editor.js":
/*!********************************!*\
  !*** ./src/js/block-editor.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * Block Control\n *\n */\nwp.domReady(function () {\n  var __ = wp.i18n.__;\n  /* ==================== CLEANUP ==================== */\n\n  /**\n   * Remove panels\n   *\n   * These should be re-enabled if blog module is active\n   */\n\n  var _wp$data$dispatch = wp.data.dispatch('core/edit-post'),\n      removeEditorPanel = _wp$data$dispatch.removeEditorPanel; // // Excerpt panel\n  // removeEditorPanel( 'post-excerpt' );\n  // Discussion panel\n\n\n  removeEditorPanel('discussion-panel');\n  /**\n   * Disable inline images\n   */\n\n  wp.richText.unregisterFormatType('core/image');\n  /**\n   * Remove Style variants\n   */\n  // Quote\n\n  wp.blocks.unregisterBlockStyle('core/quote', 'default');\n  wp.blocks.unregisterBlockStyle('core/quote', 'large'); // Table\n\n  wp.blocks.unregisterBlockStyle('core/table', 'regular');\n  wp.blocks.unregisterBlockStyle('core/table', 'stripes'); // Separator\n\n  wp.blocks.unregisterBlockStyle('core/separator', 'default');\n  wp.blocks.unregisterBlockStyle('core/separator', 'wide');\n  wp.blocks.unregisterBlockStyle('core/separator', 'dots'); // Buttons\n\n  wp.blocks.unregisterBlockStyle('core/button', 'fill');\n  wp.blocks.unregisterBlockStyle('core/button', 'outline'); // Image\n\n  wp.blocks.unregisterBlockStyle('core/image', 'default');\n  wp.blocks.unregisterBlockStyle('core/image', 'circle-mask');\n  /* ==================== ADDITIONS ==================== */\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9zcmMvanMvYmxvY2stZWRpdG9yLmpzP2FmMTgiXSwibmFtZXMiOlsid3AiLCJkb21SZWFkeSIsIl9fIiwiaTE4biIsImRhdGEiLCJkaXNwYXRjaCIsInJlbW92ZUVkaXRvclBhbmVsIiwicmljaFRleHQiLCJ1bnJlZ2lzdGVyRm9ybWF0VHlwZSIsImJsb2NrcyIsInVucmVnaXN0ZXJCbG9ja1N0eWxlIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUVBQSxFQUFFLENBQUNDLFFBQUgsQ0FBYSxZQUFXO0FBRXZCLE1BQVFDLEVBQVIsR0FBZUYsRUFBRSxDQUFDRyxJQUFsQixDQUFRRCxFQUFSO0FBRUE7O0FBRUE7QUFDRDtBQUNBO0FBQ0E7QUFDQTs7QUFDQywwQkFBOEJGLEVBQUUsQ0FBQ0ksSUFBSCxDQUFRQyxRQUFSLENBQWtCLGdCQUFsQixDQUE5QjtBQUFBLE1BQVFDLGlCQUFSLHFCQUFRQSxpQkFBUixDQVh1QixDQWF2QjtBQUNBO0FBRUE7OztBQUNBQSxtQkFBaUIsQ0FBRSxrQkFBRixDQUFqQjtBQUVBO0FBQ0Q7QUFDQTs7QUFDRU4sSUFBRSxDQUFDTyxRQUFILENBQVlDLG9CQUFaLENBQWtDLFlBQWxDO0FBRUQ7QUFDRDtBQUNBO0FBRUM7O0FBQ0FSLElBQUUsQ0FBQ1MsTUFBSCxDQUFVQyxvQkFBVixDQUFnQyxZQUFoQyxFQUE4QyxTQUE5QztBQUNBVixJQUFFLENBQUNTLE1BQUgsQ0FBVUMsb0JBQVYsQ0FBZ0MsWUFBaEMsRUFBOEMsT0FBOUMsRUE5QnVCLENBZ0N2Qjs7QUFDQVYsSUFBRSxDQUFDUyxNQUFILENBQVVDLG9CQUFWLENBQWdDLFlBQWhDLEVBQThDLFNBQTlDO0FBQ0FWLElBQUUsQ0FBQ1MsTUFBSCxDQUFVQyxvQkFBVixDQUFnQyxZQUFoQyxFQUE4QyxTQUE5QyxFQWxDdUIsQ0FvQ3ZCOztBQUNBVixJQUFFLENBQUNTLE1BQUgsQ0FBVUMsb0JBQVYsQ0FBZ0MsZ0JBQWhDLEVBQWtELFNBQWxEO0FBQ0FWLElBQUUsQ0FBQ1MsTUFBSCxDQUFVQyxvQkFBVixDQUFnQyxnQkFBaEMsRUFBa0QsTUFBbEQ7QUFDQVYsSUFBRSxDQUFDUyxNQUFILENBQVVDLG9CQUFWLENBQWdDLGdCQUFoQyxFQUFrRCxNQUFsRCxFQXZDdUIsQ0F5Q3ZCOztBQUNBVixJQUFFLENBQUNTLE1BQUgsQ0FBVUMsb0JBQVYsQ0FBZ0MsYUFBaEMsRUFBK0MsTUFBL0M7QUFDQVYsSUFBRSxDQUFDUyxNQUFILENBQVVDLG9CQUFWLENBQWdDLGFBQWhDLEVBQStDLFNBQS9DLEVBM0N1QixDQTZDdkI7O0FBQ0FWLElBQUUsQ0FBQ1MsTUFBSCxDQUFVQyxvQkFBVixDQUFnQyxZQUFoQyxFQUE4QyxTQUE5QztBQUNBVixJQUFFLENBQUNTLE1BQUgsQ0FBVUMsb0JBQVYsQ0FBZ0MsWUFBaEMsRUFBOEMsYUFBOUM7QUFHQTtBQUVBLENBcEREIiwiZmlsZSI6Ii4vc3JjL2pzL2Jsb2NrLWVkaXRvci5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQmxvY2sgQ29udHJvbFxuICpcbiAqL1xuXG53cC5kb21SZWFkeSggZnVuY3Rpb24oKSB7XG5cblx0Y29uc3QgeyBfXyB9ID0gd3AuaTE4bjtcblxuXHQvKiA9PT09PT09PT09PT09PT09PT09PSBDTEVBTlVQID09PT09PT09PT09PT09PT09PT09ICovXG5cblx0LyoqXG5cdCAqIFJlbW92ZSBwYW5lbHNcblx0ICpcblx0ICogVGhlc2Ugc2hvdWxkIGJlIHJlLWVuYWJsZWQgaWYgYmxvZyBtb2R1bGUgaXMgYWN0aXZlXG5cdCAqL1xuXHRjb25zdCB7IHJlbW92ZUVkaXRvclBhbmVsIH0gPSB3cC5kYXRhLmRpc3BhdGNoKCAnY29yZS9lZGl0LXBvc3QnICk7XG5cblx0Ly8gLy8gRXhjZXJwdCBwYW5lbFxuXHQvLyByZW1vdmVFZGl0b3JQYW5lbCggJ3Bvc3QtZXhjZXJwdCcgKTtcblxuXHQvLyBEaXNjdXNzaW9uIHBhbmVsXG5cdHJlbW92ZUVkaXRvclBhbmVsKCAnZGlzY3Vzc2lvbi1wYW5lbCcgKTtcblxuXHQvKipcblx0ICogRGlzYWJsZSBpbmxpbmUgaW1hZ2VzXG5cdCAqL1xuXHQgd3AucmljaFRleHQudW5yZWdpc3RlckZvcm1hdFR5cGUoICdjb3JlL2ltYWdlJyApO1xuXG5cdC8qKlxuXHQgKiBSZW1vdmUgU3R5bGUgdmFyaWFudHNcblx0ICovXG5cblx0Ly8gUXVvdGVcblx0d3AuYmxvY2tzLnVucmVnaXN0ZXJCbG9ja1N0eWxlKCAnY29yZS9xdW90ZScsICdkZWZhdWx0JyApO1xuXHR3cC5ibG9ja3MudW5yZWdpc3RlckJsb2NrU3R5bGUoICdjb3JlL3F1b3RlJywgJ2xhcmdlJyApO1xuXG5cdC8vIFRhYmxlXG5cdHdwLmJsb2Nrcy51bnJlZ2lzdGVyQmxvY2tTdHlsZSggJ2NvcmUvdGFibGUnLCAncmVndWxhcicgKTtcblx0d3AuYmxvY2tzLnVucmVnaXN0ZXJCbG9ja1N0eWxlKCAnY29yZS90YWJsZScsICdzdHJpcGVzJyApO1xuXG5cdC8vIFNlcGFyYXRvclxuXHR3cC5ibG9ja3MudW5yZWdpc3RlckJsb2NrU3R5bGUoICdjb3JlL3NlcGFyYXRvcicsICdkZWZhdWx0JyApO1xuXHR3cC5ibG9ja3MudW5yZWdpc3RlckJsb2NrU3R5bGUoICdjb3JlL3NlcGFyYXRvcicsICd3aWRlJyApO1xuXHR3cC5ibG9ja3MudW5yZWdpc3RlckJsb2NrU3R5bGUoICdjb3JlL3NlcGFyYXRvcicsICdkb3RzJyApO1xuXG5cdC8vIEJ1dHRvbnNcblx0d3AuYmxvY2tzLnVucmVnaXN0ZXJCbG9ja1N0eWxlKCAnY29yZS9idXR0b24nLCAnZmlsbCcgKTtcblx0d3AuYmxvY2tzLnVucmVnaXN0ZXJCbG9ja1N0eWxlKCAnY29yZS9idXR0b24nLCAnb3V0bGluZScgKTtcblxuXHQvLyBJbWFnZVxuXHR3cC5ibG9ja3MudW5yZWdpc3RlckJsb2NrU3R5bGUoICdjb3JlL2ltYWdlJywgJ2RlZmF1bHQnICk7XG5cdHdwLmJsb2Nrcy51bnJlZ2lzdGVyQmxvY2tTdHlsZSggJ2NvcmUvaW1hZ2UnLCAnY2lyY2xlLW1hc2snICk7XG5cblxuXHQvKiA9PT09PT09PT09PT09PT09PT09PSBBRERJVElPTlMgPT09PT09PT09PT09PT09PT09PT0gKi9cblxufSApO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/js/block-editor.js\n");

/***/ }),

/***/ 0:
/*!**************************************!*\
  !*** multi ./src/js/block-editor.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/erik/Webdev/www/hetweblokaal/public_html/wp-content/themes/wbl-theme-foundation/src/js/block-editor.js */"./src/js/block-editor.js");


/***/ })

/******/ });