import jquery from 'jquery';
window.$ = window.jQuery = jquery;
window.FRW = {
    fetch: function($params){

    }
};

//import("../../../../../../node_modules/bootstrap-tokenfield/dist/bootstrap-tokenfield.js");
//import("../../../../../../node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js");

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
