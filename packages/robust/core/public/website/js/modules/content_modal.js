;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.ContentModal = {
        init: function () {
            $(document).on('click', 'a[data-modal="contentModal"]', function () {
                $('#contentModal').data('url', $(this).data('url'));
                $('#contentModal').data('title', $(this).data('title'));
                $('#contentModal').modal('show');
            });

            $(document).on('shown.bs.modal', '#contentModal', function () {
                var $title = $(this).data('title');
                $(this).find('.modal-title').text($title);

                var $url = $(this).data('url');
                var $this = $(this);
                $.ajax({
                    url: $url
                }).done(function (data) {
                    $this.find('.modal-body').empty().html(data.view);
                    $('.carousel').carousel({
                        interval: false
                    })
                    ;
                    FRW.Editor.init();
                    $this.trigger('modal-loaded');
                });
            });

        }
    };
    $(function () {
        FRW.ContentModal.init();
    });
}(jQuery, FRW, window, document));

