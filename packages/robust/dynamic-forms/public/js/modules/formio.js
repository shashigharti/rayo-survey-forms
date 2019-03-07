;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DynamicForms.FormIO = {
        init: function(){
            let display = 'form';
            let builder = null;
            let frm = null;
            let formData = {};

            if ($('#designer').length > 0) {
                let formElement = document.getElementById('designer');
                let id = $('.design--form').data('form-id');

                builder = Formio.builder(formElement, {}, {
                    readOnly: false
                }).then(function (form) {
                    formData['display'] = "form";
                    formData['_method'] = 'PUT';
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
                    $('.dynamic-form__save').html('<i class="fa fa-check" aria-hidden="true"></i> Form saved');
                },
                error: function(e, xhr) {
                    $('.dynamic-form__save').html('<i class="fa fa-check" aria-hidden="true"></i> Form saved');
                }

            });

        });

            if ($('#form__show').length > 0) {
                let formComponents = $('#form__show').data('form-components');
                Formio.createForm(document.getElementById('form__show'), formComponents, {
                    readOnly: true
                });
            }
        }

    };


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        let base_url = $('.design--form').data("base-url");
        FRW.DynamicForms.FormIO.init();
        Formio.setProjectUrl(base_url + '/api/forms');
    });
}(jQuery, FRW, window, document));
