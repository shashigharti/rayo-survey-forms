;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DatePicker = {
        init: function () {
            $("body").delegate(".datepicker", "focusin", function () {
                $(this).datepicker({dateFormat: 'd/m/Y'});
            });

            $('.date-range').daterangepicker({
                timePicker: true,
                timePickerIncrement: 1,
                locale: {
                    format: 'YYYY-MM-DD h:mm A'
                }
            });
        }
    };
    $(function () {
        FRW.DatePicker.init();
    });
}(jQuery, FRW, window, document));


