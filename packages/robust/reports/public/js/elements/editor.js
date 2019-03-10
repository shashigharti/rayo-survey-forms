;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Reports.Editor = {
        onKeyUp: function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'content'){
                $dest.html(value);
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