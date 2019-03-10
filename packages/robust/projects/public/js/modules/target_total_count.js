;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {
        $('#crudModal').on('modal-loaded', function () {

            $('.total-counters').trigger('keyup');

        });
        $(document).on('keyup', '.total-counters', function () {
            var $total = 0;
            $('.total-counters').each(function () {
                var $count = $(this).val();
                if ($count) {
                    $total = $total + parseInt($count);
                }
            });
            $('#total-field').val($total);
        });
    });
}(jQuery, FRW, window, document));

