;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.CheckBox = {
        onPropertyChange: function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'label'){
                $dest.find('label').html(value);
            }
        },
        onChange:  function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'properties[options]'){
                var arr = value.split(',');
                $dest.find('.checkbox__options').empty();
                for (var i = 0; i < arr.length; i++) {
                    $dest.find('.checkbox__options').append("<input type='checkbox'>" + arr[i]);
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