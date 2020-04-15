import jquery from 'jquery';
window.$ = window.jQuery = jquery;
window.FRW = {};
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
