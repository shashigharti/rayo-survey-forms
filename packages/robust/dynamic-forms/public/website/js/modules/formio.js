;
(function ($, FRW, window, document, undefined) {
    'use strict';


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        alert('testing');
        if ($('#form__content--display').length > 0) {
            Formio.createForm(document.getElementById('form__content--display'),
                'https://examples.form.io/example');
        }
    });
}(jQuery, FRW, window, document));
