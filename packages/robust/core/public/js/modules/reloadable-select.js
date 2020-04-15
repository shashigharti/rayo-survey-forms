;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.ReloadableSelect = {
        init: function (selectObj) {
            selectObj.on('change', function(e){
                let url = $(this).data("url-to-reload");
                url = url + '?template=' + $(this).val();
                console.log(url);
                window.location = url;
            });
        }
    };

    $(document).ready(function ($) {
        let selectObj = $('.select-reload-on-change');
        if(selectObj.length <= 0){
            return;
        }

        FRW.ReloadableSelect.init(selectObj);
    });

}(jQuery, FRW, window, document));
