;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.CRUDModal = {
        init: function () {
            $(document).on('click', 'a[data-modal="crudModal"]', function () {
                $('#crudModal').data('url', $(this).data('url'));
                $('#crudModal').data('numbering-url', $(this).data('numbering-url'));
                $('#crudModal').data('title', $(this).data('title'));
                $('#crudModal').modal('show');
            });

            $('#crudModal').on('shown.bs.modal', function () {
                var $title = $(this).data('title');
                $(this).find('.modal-title').text($title);

                var $url = $(this).data('url');
                var $this = $(this);
                $.ajax({
                    url: $url
                }).done(function (data) {
                    $this.find('.modal-body').empty().append(data.view);
                    FRW.Editor.init();
                    $this.trigger('modal-loaded');
                });
            });
        }
    };
    $(function () {
        FRW.CRUDModal.init();
    });
}(jQuery, FRW, window, document));

