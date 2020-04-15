;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DynamicAttr = {
        init: function () {
            $(document.body).on('change', '.dynamic-attr_type', function () {
                const attr = $(this).val();
                const template =  $('.select-reload-on-change').val();
                let url = $(this).data("url-to-reload");
                url = `${url}?template=${template}&attribute=${attr}`;
                window.location = url;
            });
        }
    };

    $(document).ready(function ($) {
        let selectObj = $('.dynamic-attr_type');
        if (selectObj.length <= 0) {
            return;
        }
        console.log("Dynamic Attribute Type");

        FRW.DynamicAttr.init();
    });

}(jQuery, FRW, window, document));
