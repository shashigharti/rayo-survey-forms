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
            let formComponents = $('.design--form').data('form-components') !== "" ? $('.design--form').data('form-components') : 'https://examples.form.io/example';

            let data = JSON.stringify(formComponents);
            console.log("Parseddata:");
            console.log(JSON.parse(data));
            builder = Formio.builder(formElement, JSON.parse(data), {
                readOnly: false
            }).then(function (form) {
                console.log(formData['components']);
                formData['title'] = 'Test Form';
                formData['name'] = 'Test Form';
                formData['path'] = 'test-form';
                formData['type'] = 'form';
                formData['display'] = "form";
                formData['components'] = form.component.components;

                formData['slug'] = 'test-form';
                formData['id'] = $('.design--form :input[name="id"]').val();
                formData['_method'] = 'PUT';

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
            let type = $('.design--form').data("type");
            console.log(url);
            formData = Object.assign({}, formData);
            console.log(formData);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (result) {
                    console.log(result);
                }
            });
        });
        // if ($('#preview--container__form').length > 0) {
        //     let formComponents = $('#preview--container__form').data('form-components');
        //     Formio.createForm(document.getElementById('preview--container__form'), formComponents, {
        //         readOnly: true
        //     });
        // }

        // if ($('#form__show').length > 0) {
        //     let formComponents = $('#form__show').data('form-components');
        //     Formio.createForm(document.getElementById('form__show'), formComponents, {
        //         readOnly: true
        //     });
        // }
    });
}(jQuery, FRW, window, document));
