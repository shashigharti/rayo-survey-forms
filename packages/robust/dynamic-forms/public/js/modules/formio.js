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
                let slug = $('.design--form').data('slug');
                let title = $('.design--form').data('title');

                fetch('/admin/user/form-json/' + slug)
                    .then(s  => {return s.json()})
                    .then(a => {
                        let components = JSON.parse(a.properties);
                        Formio.builder(formElement, components).then(function (form) {
                            formData['display'] = "form";
                            formData['_method'] = 'PUT';
                            formData['type'] = 'form';
                            formData['_id'] = id;
                            formData['title'] = title;
                            formData['name'] = title.toLowerCase();
                            formData['path'] = title.toLowerCase();
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

                formData["properties"]["settings"] = {
                    'recaptcha': {
                        'isEnabled': 'true',
                        "secretKey": "6LcV_pkUAAAAAHxUK7HsURaS0Pozt97zdUaV0mSy",
                        "siteKey": "6LcV_pkUAAAAAOPyibpztMVOJVad5ePUVSFZurW2"
                    }
                };


                let url = $('.design--form').data("url");
                formData['properties'] = JSON.stringify(formData['properties']);
                $('.dynamic-form__save').html('<i class="fa fa-spinner fa-spin"></i> Saving..');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function (result) {
                        $('.dynamic-form__save').html('<i class="fa fa-check" aria-hidden="true"></i> Form saved');
                    },
                    error: function(e, xhr) {
                        // Temporary resolvement
                        // Executes this because request gives out 302 which resolves into error closure. Need refactoring.
                        let saveElement= '<i aria-hidden="true" class="icon md-book"></i> Save';

                        // Notify that the form was saved for a second and revert back to original element.
                        $('.dynamic-form__save').html('<i class="fa fa-check" aria-hidden="true"></i> Form saved');
                        setTimeout(function() {
                            $('.dynamic-form__save').html(saveElement);
                        }, 1000);
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
        FRW.DynamicForms.FormIO.init();
    });
}(jQuery, FRW, window, document));
