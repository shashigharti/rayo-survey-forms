;
(function ($, FRW, window, document, undefined) {
    'use strict';


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        let display = 'form';
        let builder = null;
        let frm = null;
        let formData = {};

        if ($('#designer').length > 0) {
            let formElement = document.getElementById('designer');

            builder = Formio.builder(formElement, 'https://examples.form.io/example').
            then(function (form) {
                formData['components'] = form.component.components;
                formData['display'] = display;

                form.on('change', (elem) => {
                    if(elem.components){
                        formData['components'] = elem.components;
                    }
                });
                $(".dynamic--form__type").change(function () {
                    display = $(this).val();
                    formData['display'] = display;
                    form.display = display;
                    Formio.builder(document.getElementById('designer'),form);
                });
            });
        }
        $('.dynamic-form__save').on('click', function(type){
            console.log(formData);
        });
        if ($('#preview--container__form').length > 0) {
            Formio.createForm(document.getElementById('preview--container__form'), 'https://examples.form.io/example', {
                readOnly: true
            });
        }
    });
}(jQuery, FRW, window, document));
