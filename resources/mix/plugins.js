//
// 3rd-Party Plugins JavaScript Includes
//

module.exports = [

//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
////  Mandatory Plugins Includes(do not remove or change order!)  ////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

    // Jquery - jQuery is a popular and feature-rich JavaScript library. Learn more: https://jquery.com/
    'node_modules/jquery/dist/jquery.js',

    // Popper.js - Tooltip & Popover Positioning Engine used by Bootstrap. Learn more: https://popper.js.org
    'node_modules/@popperjs/core/dist/umd/popper.js',

    // Bootstrap - The most popular framework uses as the foundation. Learn more: http://getbootstrap.com
    'node_modules/bootstrap/dist/js/bootstrap.min.js',

    // Moment - Parse, validate, manipulate, and display dates and times in JavaScript. Learn more: https://momentjs.com/
    'node_modules/moment/min/moment-with-locales.min.js',

    // Wnumb - Number & Money formatting. Learn more: https://refreshless.com/wnumb/
    'node_modules/wnumb/wNumb.js',

    // ES6-Shim - ECMAScript 6 compatibility shims for legacy JS engines.  Learn more: https://github.com/paulmillr/es6-shim
    'node_modules/es6-shim/es6-shim.js',

//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
///  Optional Plugins Includes(you can remove or add)  ///////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

    // FormValidation - Best premium validation library for JavaScript. Zero dependencies. Learn more: https://formvalidation.io/
    "resources/plugins/@form-validation/umd/bundle/popular.min.js",
    "resources/plugins/@form-validation/umd/bundle/full.min.js",
    "resources/plugins/@form-validation/umd/plugin-bootstrap5/index.min.js",

    // Bootstrap Maxlength - This plugin integrates by default with Twitter bootstrap using badges to display the maximum length of the field where the user is inserting text: https://github.com/mimo84/bootstrap-maxlength
    'node_modules/bootstrap-maxlength/src/bootstrap-maxlength.js',

    // Date Range Picker - A JavaScript component for choosing date ranges, dates and times: https://www.daterangepicker.com/
    'node_modules/bootstrap-daterangepicker/daterangepicker.js',


    // noUiSlider - is a lightweight range slider with multi-touch support and a ton of features. It supports non-linear ranges, requires no external dependencies: https://refreshless.com/nouislider/
    'node_modules/nouislider/dist/nouislider.min.js',

    // The autosize - function accepts a single textarea element, or an array or array-like object (such as a NodeList or jQuery collection) of textarea elements: https://www.jacklmoore.com/autosize/
    'node_modules/autosize/dist/autosize.min.js',


    // Toastr - is a Javascript library for non-blocking notifications. jQuery is required. The goal is to create a simple core library that can be customized and extended: https://github.com/CodeSeven/toastr
    'resources/plugins/toastr/build/toastr.min.js',

    // ES6 Promise Polyfill - This is a polyfill of the ES6 Promise: https://github.com/lahmatiy/es6-promise-polyfill
    'node_modules/es6-promise-polyfill/promise.min.js',

    // Sweetalert2 - a beautiful, responsive, customizable and accessible (WAI-ARIA) replacement for JavaScript's popup boxes: https://sweetalert2.github.io/
    'node_modules/sweetalert2/dist/sweetalert2.min.js',
    'resources/js/vendors/plugins/sweetalert2.init.js',


    // Tempus Dominus is the successor to the very popular Eonasdan/bootstrap-datetimepicker. The plugin provide a robust date and time picker designed to integrate into your Bootstrap project.
    'node_modules/@eonasdan/tempus-dominus/dist/js/tempus-dominus.min.js',
    'node_modules/@eonasdan/tempus-dominus/dist/plugins/customDateFormat.js',
];

// window.axios.defaults.headers.common = {
// 'X-Requested-With': 'XMLHttpRequest',
// 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
// };
