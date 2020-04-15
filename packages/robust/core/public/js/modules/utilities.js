;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.Utility = {
        // https://gist.github.com/mathewbyrne/1280286
        slugify: function (text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        },
        confirmDelete: function(modalObj){
            modalObj.on('show.bs.modal', function (e) {
                let message = $(e.relatedTarget).attr('data-message');
                $(this).find('.modal-body p').text(message);
                let title = $(e.relatedTarget).attr('data-title');
                $(this).find('.modal-title').text(title);

                // Pass form reference to modal for submission on yes/ok
                let form = $(e.relatedTarget).closest('form');
                $(this).find('.modal-footer #confirm').data('form', form);
            });


            modalObj.find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
        },
        modal:function(){

        }
    }
    $(document).ready(function ($) {
        if ($('[data-slug]').length > 0){
            $('[data-slug]').on('blur', function (e) {
                $('[name=slug]').val(FRW.Utility.slugify($(this).val()));
            });
        }

        if ($('#confirmDelete').length > 0){
            let modalObj = $('#confirmDelete');
            FRW.Utility.confirmDelete(modalObj);
        }

        FRW.Utility.modal();
    });

}(jQuery, FRW, window, document));
