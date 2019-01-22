;
(function ($, FRW, window, document, undefined) {
    'use strict';


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        if ($('#form__show').length > 0) {
            Formio.createForm(document.getElementById('form__show'), 'https://examples.form.io/example', {
                readOnly: true
            });
        }
    });
}(jQuery, FRW, window, document));
