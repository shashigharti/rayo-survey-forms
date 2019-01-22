;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $('#confirmDelete').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text(message);
            var title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text(title);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });


        $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
            $(this).data('form').submit();
        });

    });
}(jQuery, FRW, window, document));
