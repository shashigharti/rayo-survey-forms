;
(function ($, FRW, window, document, undefined) {
    'use strict';

    /*
     |--------------------------------------------------------------------------
     | Settings
     |--------------------------------------------------------------------------
     */
    FRW.Form = {
        init: function () {
            $('body').on('keyup keypress', '.dynamic-progress-form :input[type=text]', this.onEnter);
        },
        onEnter: function (evt) {
            var keyCode = evt.keyCode || evt.which;
            if (keyCode == 13) {
                evt.preventDefault();
                return false;
            }
        }
    };
    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        FRW.Form.init();

    });

}(jQuery, FRW, window, document));