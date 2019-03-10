;
(function ($, FRW, window, document, undefined) {
    'use strict';
    $(document).ready(function ($) {

        $('#crudModal').on('modal-loaded', function () {
            $('.indicator-type').trigger('change');

        });

        $(document).on('change', '.indicator-type', function () {
            var $url = $(this).data('url');
            var $type = $('.indicator-type option:selected').val();

            $.ajax({
                method: "GET",
                url: $url,
                data: {'type': $type},
                success: function ($result) {
                    $('.indicator-property_box').remove();
                    $('.indicator-property_area').append($result);
                    $('.indicator-property_area .token-field').tokenfield();
                    //$('.dynamic-form__property-box').trigger('property-loaded');
                }
            });
        });
    });
}(jQuery, FRW, window, document));

