;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Radio = {
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'label'){
                $dest.find('label').html(value);
            }
        },
        onChange:  function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'properties[options]'){
                var arr = value.split(',');
                $dest.find('.radio__options').empty();
                for (var i = 0; i < arr.length; i++) {
                    $dest.find('.radio__options').append("<input type='radio'>" + arr[i]);
                }
            }
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