;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Text = {
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'label'){
                $dest.find('label').html(value);
            }
            if($elem.attr('name') == 'properties[target]'){

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