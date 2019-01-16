;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $('#file_field').change(function () {
            var types = $(this).data('allowed');
            var ext = $(this).val().split('.').pop().toLowerCase();
            var message_handler = $('#file_error');
            var exts_message = '';

            var types_arr = types.split(", ");
            for (var i = 0; i < types_arr.length; i++) {
                exts_message = exts_message + ' .' + types_arr[i];
            }

            if ($.inArray(ext, types_arr) == -1) {
                message_handler.html(
                    '<div class="animated rotateIn alert alert-danger">' +
                    '<strong> ' + 'Only files of extension ' + exts_message + ' are allowed' + ' </strong>' +
                    '</div> '
                );

                $(this).val('');
            }
            else {
                message_handler.html('');
            }

        });
    });

}(jQuery, FRW, window, document));