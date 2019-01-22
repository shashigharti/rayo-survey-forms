;
(function ($, FRW, window, document, undefined) {
    'use strict';

    $(document).ready(function ($) {
        $(document).on('click', '#add_to_destination', function () {
            $('#select_source option:selected').remove().appendTo('#select_destination');

        });
        $(document).on('click', '#remove_from_destination', function () {
            $('#select_destination option:selected').remove().appendTo('#select_source');

        });
    });
}(jQuery, FRW, window, document));