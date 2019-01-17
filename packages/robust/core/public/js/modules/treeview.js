;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $(document).on('click', '.list-group-item', function () {
            var $expand = $(this).data('expand-icon'), $collapse = $(this).data('expand-down');
            if(!$expand){
                $expand = 'md-chevron-down';
            }

            if(!$collapse){
                $collapse = 'md-chevron-right';
            }
            var $selector = '.' + $collapse + ', .' + $expand;
            var $toggle_class = $expand + ' ' + $collapse;
            
            $(this).parent().children('ul.list-group-item-submenu').toggle(200);
            $(this).find($selector).toggleClass($toggle_class);

        });
        $('.list-group-item').parent().children('ul.list-group-item-submenu').toggle(200);
    });

}(jQuery, FRW, window, document));
