;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.TextArea = {
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'label'){
                $dest.find('label').html(value);
            }
        },
        onChange:  function ($elem, $dest, frm_property_box, value) {

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