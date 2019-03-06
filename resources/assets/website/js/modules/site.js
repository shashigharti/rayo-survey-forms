;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.SiteHeadingSection = {
        init: function () {
            if ($('.site-heading').length) {
                var stickyNavTop = $('.site-heading').offset().top;
                var stickyNav = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > stickyNavTop) {
                        $('.site-heading').addClass('sticky');
                    } else {
                        $('.site-heading').removeClass('sticky');
                    }
                };
                stickyNav();
                $(window).scroll(function () {
                    stickyNav();
                });
            }
        }
    },
    FRW.FlexSlider = {
        init:function (){
            $(window).on('load', function () {
                $('.text-flexslider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    directionNav: false
                });
            });
        }
    },
    FRW.NavigationSection = {
        init:function (){
            $(window).on('load', function () {
                $("nav").find("a").click(function (e) {
                    e.preventDefault();
                    var section = $(this).attr("href");
                    $("html, body").animate({
                        scrollTop: $(section).offset().top
                    });
                });

            });
        }
    }

    $(document).ready(function ($) {
        FRW.SiteHeadingSection.init();
        FRW.FlexSlider.init();
        FRW.NavigationSection.init();
    });
}(jQuery, FRW, window, document));
