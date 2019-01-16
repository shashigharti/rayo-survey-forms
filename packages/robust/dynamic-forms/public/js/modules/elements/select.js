;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Select = {
        onPropertyChange: function (object, frm_property_box, value) {
           object.find('label').html(value);
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