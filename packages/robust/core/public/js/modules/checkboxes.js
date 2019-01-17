;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.CheckBoxes = {
        init: function () {
            $(document).on('change', '.checkbox_check-all', FRW.CheckBoxes.toggleCheck);
        },

        toggleCheck: function () {
            var check_group = $(this).data('group');
            var current_btn = $(this);
            $('input[data-group=' + check_group + ']').not(current_btn).each(function () {
                if (!$(this).is(':disabled'))
                    $(this).prop('checked', current_btn.prop('checked'));
            });

        }
    }
    $(document).ready(function ($) {
        FRW.CheckBoxes.init();
    });

}(jQuery, FRW, window, document));
