
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
/******/ 	return __webpack_require__(__webpack_require__.s = 92);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/ktdatatable/base/html-table.js":
/*!*************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/ktdatatable/base/html-table.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

  "use strict";
  // Class definition
 
 var KTDatatableHtmlTableDemo = function () {
   // Private functions
   // demo initializer
   var userManagement = function userManagement() {
     var datatable = $('#user_management').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Name',
         title: 'Name'
       }, {
         field: 'Email',
         title: 'Email'
       }, {
         field: 'Role',
         title: 'Role',
         template: function(row) {
           var role = {
             1: {'roleName': 'Admin'},
             2: {'roleName': 'Staff'},
             3: {'roleName': 'Viewer'}
           };
           return role[row.Role].roleName;
         },
       }, {
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#user_management_search_role').on('change', function () {
       datatable.search($(this).val().toLowerCase(), 'Role');
     });
     $('#user_management_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Email');
     });
     $('#user_management_search_role').selectpicker();
   };
 
   var storeManagement = function storeManagement() {
     var datatable = $('#store_management').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Name',
         title: 'Name'
       }, {
         field: 'Address',
         title: 'Address'
       }, {
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#store_management_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Name');
     });
   };
 
   var registerNewPartner = function registerNewPartner() {
     var datatable = $('#register_new_partner').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Name',
         title: 'Name'
       }, {
         field: 'Address',
         title: 'Address'
       }, {
         field: 'PIC',
         title: 'PIC',
       }, {
         field: 'Contact Person',
         title: 'Contact Person',
       }, {
         field: 'Partner Key',
         title: 'Partner Key',
       }, {
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#register_new_partner_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Partner Key');
     });
   };
 
   var registerNewPartnerDetailInActive = function registerNewPartnerDetailInActive() {
     var datatable = $('#register_new_partner_detail_in_active').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Voucher Key',
         title: 'Voucher Key'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       },{
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#register_new_partner_detail_in_active_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   };
 
   var registerNewPartnerDetailSold = function registerNewPartnerDetailSold() {
     var datatable = $('#register_new_partner_detail_sold').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Voucher Key',
         title: 'Voucher Key'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#register_new_partner_detail_sold_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   }; 
 
   var registerNewPartnerDetailActive = function registerNewPartnerDetailActive() {
     var datatable = $('#register_new_partner_detail_active').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Voucher Key',
         title: 'Voucher Key'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#register_new_partner_detail_active_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   }; 
 
   var listVoucherInActive = function listVoucherInActive() {
     var datatable = $('#list_voucher_in_active').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#list_voucher_in_active_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   };
 
   var listVoucherSold = function listVoucherSold() {
     var datatable = $('#list_voucher_sold').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#list_voucher_sold_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   }; 
 
   var listVoucherActive = function listVoucherActive() {
     var datatable = $('#list_voucher_active').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Serial Number',
         title: 'Serial Number'
       }, {
         field: 'Type',
         title: 'Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#list_voucher_active_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Serial Number');
     });
   }; 
 
   var generateVoucher = function generateVoucher() {
     var datatable = $('#generate_voucher').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
        field: 'Date',
        title: 'Date'
       }, {
         field: 'Name',
         title: 'Name'
       }, {
         field: 'Amount',
         title: 'Amount'
       }, {
         field: 'Type',
         title: 'Type',
       }, {
         field: 'Duration',
         title: 'Duration'
       }, {
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#generate_voucher_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'Name');
     });
   };
 
   var notCompleted = function notCompleted() {
    var datatable = $('#not_completed').KTDatatable({
      data: {
        saveState: {
          cookie: false
        }
      },
      columns: [{
        field: '#',
        title: '#'
      }, {
        field: 'IMEI',
        title: 'IMEI'
      }, {
        field: 'Customer Name',
        title: 'Customer Name'
      }, {
        field: 'Customer Email',
        title: 'Customer Email'
      }, {
        field: 'Customer Contact',
        title: 'Customer Contact'
      }, {
        field: 'Lokasi Beli Voucher',
        title: 'Lokasi Beli Voucher'
      }, {
        field: 'Serial Number Voucher',
        title: 'Serial Number Voucher'
      }, {
        field: 'Link Melanjutkan Aktivasi',
        title: 'Link Melanjutkan Aktivasi'
      }]
    });
    $('#not_completed_search_query').on('input', function () {
      datatable.search($(this).val().toLowerCase(), 'IMEI');
    });
  };

   var allProcess = function allProcess() {
     var datatable = $('#all_process').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }, {
         field: 'Status',
         title: 'Status',
         template: function(row) {
           var status = {
             'Queue': {'title': 'Queue', 'class': ' badge-warning'},
             'Approved': {'title': 'Approved', 'class': ' badge-success'},
             'Rejected': {'title': 'Rejected', 'class': ' badge-danger'},
             'Expired': {'title': 'Expired', 'class': ' badge-secondary'},
             'Request for Claim': {'title': 'Request for Claim', 'class': ' badge-info'},
             'Claimed': {'title': 'Claimed', 'class': ' badge-primary'},
             'Rejected Claim': {'title': 'Rejected Claim', 'class': ' badge-dark'},
           };
           return '<span class="badge ' + status[row.Status].class + '">' + status[row.Status].title + '</span>';
         }
       }]
     });
     $('#all_process_search_status').on('change', function () {
       datatable.search($(this).val().toLowerCase(), 'Status');
     });
     $('#all_process_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
     $('#all_process_search_status').selectpicker();
   };
 
   var queue = function queue() {
     var datatable = $('#queue').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }, {
         field: 'Request Activation Date',
         title: 'Request Activation Date'
       }, {
         field: 'Action',
         title: 'Action',
         sortable: false
       }]
     });
     $('#queue_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   var rejected = function rejected() {
     var datatable = $('#rejected').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#rejected_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   var expired = function expired() {
     var datatable = $('#expired').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Activation Date',
         title: 'Activation Date'
       }, {
         field: 'Expiration Date',
         title: 'Expiration Date'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#expired_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   var approved = function approved() {
     var datatable = $('#approved').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Activation Date',
         title: 'Activation Date'
       }, {
         field: 'Expiration Date',
         title: 'Expiration Date'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#approved_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   var requestForClaim = function requestForClaim() {
     var datatable = $('#request_for_claim').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#request_for_claim_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   var claimed = function claimed() {
     var datatable = $('#claimed').KTDatatable({
       data: {
         saveState: {
           cookie: false
         }
       },
       columns: [{
         field: '#',
         title: '#'
       }, {
         field: 'Customer Type',
         title: 'Customer Type'
       }, {
         field: 'IMEI',
         title: 'IMEI'
       }, {
         field: 'Customer Name',
         title: 'Customer Name'
       }, {
         field: 'Customer Email',
         title: 'Customer Email'
       }, {
         field: 'Voucher Type',
         title: 'Voucher Type'
       }, {
         field: 'Duration',
         title: 'Duration'
       }]
     });
     $('#claimed_search_query').on('input', function () {
       datatable.search($(this).val().toLowerCase(), 'IMEI');
     });
   };
 
   return {
     // Public functions
     init: function init() {
       // init dmeo
       userManagement();
       storeManagement();
       registerNewPartner();
       registerNewPartnerDetailInActive();
       registerNewPartnerDetailSold();
       registerNewPartnerDetailActive();
       listVoucherInActive();
       listVoucherSold();
       listVoucherActive();
       generateVoucher();
       notCompleted();
       allProcess();
       queue();
       rejected();
       expired();
       approved();
       requestForClaim();
       claimed();
     }
   };
 }();
 
 jQuery(document).ready(function () {
   KTDatatableHtmlTableDemo.init();
 });
 
 /***/ }),
 
 /***/ 92:
 /*!*******************************************************************************!*\
   !*** multi ./resources/metronic/js/pages/crud/ktdatatable/base/html-table.js ***!
   \*******************************************************************************/
 /*! no static exports found */
 /***/ (function(module, exports, __webpack_require__) {
 
 module.exports = __webpack_require__(/*! C:\laragon\www\zfix\resources\metronic\js\pages\crud\ktdatatable\base\html-table.js */"./resources/metronic/js/pages/crud/ktdatatable/base/html-table.js");
 
 
 /***/ })
 
 /******/ });