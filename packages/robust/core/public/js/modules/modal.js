;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DeleteForm = {
        confirmDelete: function(modalObj){
            const modal = $(modalObj);
            M.Modal.init(modalObj,{onOpenStart: function (m,trigger) {
                const button = $(trigger);
                const modal = $(m);
                let message = button.data('message');
                modal.find('.modal-body p').text(message);
                let title = button.attr('data-title');
                modal.find('.modal-title').text(title);
                // Pass form reference to modal for submission on yes/ok
                let form = button.closest('form');
                modal.find('.modal-footer #confirm').data('form', form);
            }});
            modal.find('.modal-footer #confirm').on('click', function () {
                $(this).data('form').submit();
            });
        },
    }
    $(document).ready(function ($) {
        if ($('#confirmDelete').length > 0){
            const modal = document.getElementById('confirmDelete');
            FRW.DeleteForm.confirmDelete(modal);
        }
    });
}(jQuery, FRW, window, document));