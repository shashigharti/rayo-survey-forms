;
(function ($, FRW, window, document, undefined) {
    'use strict';
    FRW.DynamicForms.FormIO = {
        init: function () {
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
                    .then(s => {
                        return s.json()
                    })
                    .then(a => {
                        let components = {"components":[{"tabindex":"6","conditional":{"show":""},"tags":[],"input":true,"label":"Submit","tableView":false,"key":"submit","disableOnInvalid":true,"theme":"primary","type":"button"}]}
                        if(a.properties !== null) {
                            components = JSON.parse(a.properties);
                        }
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

                                    // Save form on each component change
                                    FRW.DynamicForms.FormIO.saveForm(formData);
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

            if ($('#form__show').length > 0) {
                let formComponents = $('#form__show').data('form-components');
                Formio.createForm(document.getElementById('form__show'), formComponents, {
                    readOnly: true
                });
            }
        },
        saveForm: function (formData) {
            // Show loading status
            $('.dynamic-form__save').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Saving');

            formData["properties"] = {};
            // Save pressed
            // Adjust form data properties column
            for (let keys in formData) {
                if (keys !== "properties") {
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
                async: true,
                success: function (result) {
                    $('.dynamic-form__save').html('<i class="fa fa-check" aria-hidden="true"></i> Form saved');
                },
                error: function (e, xhr) {
                    // Temporary 302 fallback resolvement
                    // Executes this because request gives out 302 which resolves into error closure. Need refactoring.
                    let saveElement = '<i class="fa fa-check" aria-hidden="true"></i> Up to date';
                    // Revert back to original element.
                    setTimeout(function () {
                        $('.dynamic-form__save').html(saveElement);
                    }, 1000);
                }

            });
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
