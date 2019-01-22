import jquery from 'jquery';
import Vue from 'vue/dist/vue.js';

window.$ = window.jQuery = jquery;
window.FRW = {
    fetch: function($params){

    }
};
window.Vue = Vue;

//import("../../../../../node_modules/bootstrap-tokenfield/dist/bootstrap-tokenfield.js");
//import("../../../../../node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */


/*
 Vue.http.interceptors.push((request, next) => {
 request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

 next();
 });
 */

