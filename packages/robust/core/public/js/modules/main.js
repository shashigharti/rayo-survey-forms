//stickybar inner
;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DashboardHeadingSection = {
        init: function () {
            if ($('.dashboard-heading').length) {
                var stickyNavTop = $('.dashboard-heading').offset().top;
                var stickyNav = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > stickyNavTop) {
                        $('.dashboard-heading').addClass('sticky');
                    } else {
                        $('.dashboard-heading').removeClass('sticky');
                    }
                };
                stickyNav();
                $(window).scroll(function () {
                    stickyNav();
                });
            }
        }
    },
    FRW.LeftMenuSection = {
        init: function () {
            var url = window.location.href;
            $('.left li .btn-class a[href="'+url+'"]').addClass('active');

            if ($('.left li .btn-class a').hasClass('active')) {
                $(this).parent().addClass('active');
            }
        }
    }

    $(document).ready(function ($) {
        FRW.DashboardHeadingSection.init();
        FRW.LeftMenuSection.init();
    });
}(jQuery, FRW, window, document));

	
