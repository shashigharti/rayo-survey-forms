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
            let id = $('.design--form').data('form-id');

            getForm(id).then(function(fData) {
                builder = Formio.builder(formElement, fData, {
                    readOnly: false
                }).then(function (form) {
                    formData['title'] = 'Test Form';
                    formData['slug'] = 'test-form';
                    formData['display'] = "form";
                    formData['_method'] = 'PUT';
                    formData['slug'] = 'test-form';
                    formData['type'] = 'form';
                    formData['id'] = $('.design--form :input[name="id"]').val();
                    formData['components'] = form.component.components;

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
            }).catch(function(err) {
                console.log(err);
            });
        }
        $('.dynamic-form__save').on('click', function () {
            formData["properties"] = {};
            // Save pressed
            // Adjust form data properties column
            for(let keys in formData) {
                if(keys !== "properties") {
                    formData["properties"][keys] = formData[keys];
                }
            }


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

        function getForm(id) {
            return new Promise(function (resolve, reject) {
                // Temp fix for testing
                fetch('/admin/user/get-form/' + id).then(function (data) {
                    return data.json();
                }).then(function (form) {
                    form.properties !== "" ? resolve(JSON.parse(form.properties)) : resolve('https://examples.form.io/example');
                }).catch(function (err) {
                    reject(err);
                });
            })
        }

    });
}(jQuery, FRW, window, document));
