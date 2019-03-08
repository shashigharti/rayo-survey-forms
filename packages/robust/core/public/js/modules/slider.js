;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {        
        
        $('.form--slider:first-child').slick({
		      slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  autoPlay:true
		  });
        });
}(jQuery, FRW, window, document));
