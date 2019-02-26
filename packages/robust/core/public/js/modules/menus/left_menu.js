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
            $(".left .fa").removeClass('fa-minus');
            $(".left .fa").addClass('fa-plus');
        }); 
        $(".btn-class").on("click", function(){
            $(this).find($(".fa")).toggleClass('fa-plus fa-minus');
        });
        $(".left-smallmenu-bar").click(function(){
            $("#theMenu").toggleClass("left left-change"); 
            $('.sub-menu').removeClass('in');
            $(".left .fa").removeClass('fa-minus');
            $(".left .fa").addClass('fa-plus');          
        });

    });
}(jQuery, FRW, window, document));
