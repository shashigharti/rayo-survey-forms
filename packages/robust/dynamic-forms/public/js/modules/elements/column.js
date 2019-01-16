;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Column = {
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            var section = $dest
            var url = frm_property_box.data('url');
            $.ajax({
                method: 'POST',
                url: url,
                data: {grid_no: value},
                success: function ($result) {
                    section.find('.dynamic-form__column').remove();
                    section.append($result.ui_view);
                }
            });
        }
    }

    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
    });

}(jQuery, FRW, window, document));