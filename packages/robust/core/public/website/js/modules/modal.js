;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text(message);

            var title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text(title);

            var confirm_text = $(e.relatedTarget).data('confirm-text');
            if (confirm_text) {
                $(this).find('.btn-confirm').text(confirm_text);
            }

            var cancel_text = $(e.relatedTarget).data('cancel-text');
            if (cancel_text) {
                $(this).find('.btn-cancel').text(cancel_text);
            }

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        $('#confirm-delete').find('.modal-footer #confirm').on('click', function () {
            $(this).data('form').submit();
        });

    });
}(jQuery, FRW, window, document));
