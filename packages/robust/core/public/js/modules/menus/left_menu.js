;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
 
       $(".left").click(function(){
            $(".left").addClass("left-change");
        });
        $(".page").on('click', function() {
            $('#theMenu').removeClass('left-change');
            $('.sub-menu').removeClass('in');
            $(".left .fa").removeClass('md-minus');
            $(".left .fa").addClass('md-plus');
        }); 
        $(".btn-class").on("click", function(){
            $(this).find($(".fa")).toggleClass('md-plus md-minus');
        });

    });
}(jQuery, FRW, window, document));
