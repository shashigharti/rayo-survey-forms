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
            builder = Formio.builder(formElement, 'https://examples.form.io/example', {
                readOnly: false
            }).then(function (form) {
                formData['title'] = 'Test Form';
                formData['slug'] = 'test-form';
                formData['display'] = "form";
                formData['_method'] = 'PUT';
                formData['slug'] = 'test-form';
                formData['id'] = $('.design--form :input[name="id"]').val();
                formData['properties'] = form.component.components;


                form.on('change', (elem) => {
                    if (elem.components) {
                        formData['components'] = elem.components;
                    }
                });
                $(".dynamic--form__type").change(function () {
                    display = $(this).val();
                    formData['display'] = display;
                    form.display = display;
                    Formio.builder(document.getElementById('designer'), form);
                });
            });
        }
        $('.dynamic-form__save').on('click', function () {
            let url = $('.design--form').data("url");
            formData['properties'] = JSON.stringify(formData['properties']);
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (result) {
                    console.log(result);
                }
            });
        });
        if ($('#preview--container__form').length > 0) {
            let formComponents = $('#preview--container__form').data('form-components');
            Formio.createForm(document.getElementById('preview--container__form'), formComponents, {
                readOnly: true
            });
        }

        if ($('#form__show').length > 0) {
            let formComponents = $('#form__show').data('form-components');
            Formio.createForm(document.getElementById('form__show'), formComponents, {
                readOnly: true
            });
        }
    });
}(jQuery, FRW, window, document));
