;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {

        $(".btn-class").on("click", function(){
            $(this).find($(".fa")).toggleClass('fa-plus fa-minus');
        });

        $(".left-menu-bar").click(function(){
            $("#theMenu").toggleClass("left-change left-fix");
            $(this).toggleClass("menu-open menu-close");
            $('.arrow').toggleClass("fa-chevron-left fa-chevron-right")
            $(".dashboard-content").toggleClass("page page-slide");
            $('.sub-menu').removeClass('in');
            $(".left .btn-class .fa").removeClass('fa-minus');
            $(".left .btn-class .fa").addClass('fa-plus');
        });
        $(".left-smallmenu-bar").click(function(){
            $("#theMenu").toggleClass("left-change left-fix");
            $('.sub-menu').removeClass('in');
            $(".left .btn-class .fa").removeClass('fa-minus');
            $(".left .btn-class .fa").addClass('fa-plus');
        });
    });
}(jQuery, FRW, window, document));
