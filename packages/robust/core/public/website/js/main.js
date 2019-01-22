import jquery from 'jquery';
window.$ = window.jQuery = jquery;
import 'slick-carousel';

window.FRW = {};
window.FRW.Website = {};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
