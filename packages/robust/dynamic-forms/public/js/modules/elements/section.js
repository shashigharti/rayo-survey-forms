;
(function ($, FRW, window, document, undefined) {
    'use strict';
    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Section = {
        init: function(){
            this.obj = $('.dynamic-form__section.dynamic-form__property-box');
        },
        onChange:  function ($elem, $dest, frm_property_box, value) {
            if($elem.attr('name') == 'properties[type]'){
                var url = frm_property_box.data('url');

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {grid_no: value},
                    success: function ($result) {
                        $dest.find('.dynamic-form__column').remove();
                        $dest.append($result.ui_view);

                        $dest.trigger('click');
                    }
                });
            }
            if($elem.hasClass('property__column')){
                $dest.removeClass('table list');
                $dest.addClass(value);
            }
        },
    }

    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
    });

}(jQuery, FRW, window, document));