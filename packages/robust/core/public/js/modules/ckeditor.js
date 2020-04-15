;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.CKEditor = {
        init: function (editors) {
            let id = 'editor';
            $.each(editors, function (index, editor) {
                id = $(editor).attr('id');
                CKEDITOR.replace(id);
            });
        }
    };

    $(document).ready(function ($) {
        let editors = $('.editor textarea');
        if (editors.length <= 0) {
            return;
        }

        FRW.CKEditor.init(editors);
    });

}(jQuery, FRW, window, document));
