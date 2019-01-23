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
            // let formComponents = $('.design--form').data('form-components');
            let formComponents = {
                "title": "Test Form",
                "name": "Test Form",
                "path": "test-form",
                "type": "form",
                "display": "form",
                "components": [{
                    "input": "false",
                    "html": "<p><a href=\"https:\/\/form.io\">Form.io<\/a> Example Form<\/p><p>This is a dynamically rendered JSON form&nbsp;built with <a href=\"https:\/\/form.io\">Form.io<\/a>. Using a simple&nbsp;drag-and-drop form builder, you can create any form that includes e-signatures, wysiwyg editors, date fields, layout components, data grids, surveys, etc.<\/p>",
                    "type": "content",
                    "conditional": {"show": null, "when": null, "eq": null},
                    "key": "content",
                    "placeholder": null,
                    "prefix": null,
                    "customClass": null,
                    "suffix": null,
                    "multiple": "false",
                    "defaultValue": null,
                    "protected": "false",
                    "unique": "false",
                    "persistent": "true",
                    "hidden": "false",
                    "clearOnHide": "true",
                    "tableView": "true",
                    "dataGridLabel": "false",
                    "label": "Content",
                    "labelPosition": "top",
                    "labelWidth": "30",
                    "labelMargin": "3",
                    "description": null,
                    "errorLabel": null,
                    "tooltip": null,
                    "hideLabel": "false",
                    "tabindex": null,
                    "disabled": "false",
                    "autofocus": "false",
                    "dbIndex": "false",
                    "customDefaultValue": null,
                    "calculateValue": null,
                    "allowCalculateOverride": "false",
                    "widget": null,
                    "refreshOn": null,
                    "clearOnRefresh": "false",
                    "validateOn": "change",
                    "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                    "id": "e4sf3a"
                }, {
                    "input": "false",
                    "columns": [{
                        "components": [{
                            "tabindex": "1",
                            "clearOnHide": "true",
                            "hidden": "false",
                            "input": "true",
                            "tableView": "true",
                            "inputType": "text",
                            "inputMask": null,
                            "label": "First Name",
                            "key": "firstName",
                            "placeholder": "Enter your first name",
                            "prefix": null,
                            "suffix": null,
                            "multiple": "false",
                            "defaultValue": null,
                            "protected": "false",
                            "unique": "false",
                            "persistent": "true",
                            "validate": {
                                "required": "false",
                                "minLength": null,
                                "maxLength": null,
                                "pattern": null,
                                "custom": null,
                                "customPrivate": "false",
                                "minWords": null,
                                "maxWords": null
                            },
                            "conditional": {"show": null, "when": null, "eq": null},
                            "type": "textfield",
                            "customClass": null,
                            "dataGridLabel": "false",
                            "labelPosition": "top",
                            "labelWidth": "30",
                            "labelMargin": "3",
                            "description": null,
                            "errorLabel": null,
                            "tooltip": null,
                            "hideLabel": "false",
                            "disabled": "false",
                            "autofocus": "false",
                            "dbIndex": "false",
                            "customDefaultValue": null,
                            "calculateValue": null,
                            "allowCalculateOverride": "false",
                            "widget": {
                                "format": "yyyy-MM-dd hh:mm a",
                                "dateFormat": "yyyy-MM-dd hh:mm a",
                                "saveAs": "text"
                            },
                            "refreshOn": null,
                            "clearOnRefresh": "false",
                            "validateOn": "change",
                            "mask": "false",
                            "id": "endhm8h"
                        }, {
                            "tabindex": "3",
                            "clearOnHide": "true",
                            "hidden": "false",
                            "input": "true",
                            "tableView": "true",
                            "inputType": "email",
                            "label": "Email",
                            "key": "email",
                            "placeholder": "Enter your email address",
                            "prefix": null,
                            "suffix": null,
                            "defaultValue": null,
                            "protected": "false",
                            "unique": "false",
                            "persistent": "true",
                            "type": "email",
                            "conditional": {"show": null, "when": null, "eq": null},
                            "kickbox": {"enabled": "false"},
                            "customClass": null,
                            "multiple": "false",
                            "dataGridLabel": "false",
                            "labelPosition": "top",
                            "labelWidth": "30",
                            "labelMargin": "3",
                            "description": null,
                            "errorLabel": null,
                            "tooltip": null,
                            "hideLabel": "false",
                            "disabled": "false",
                            "autofocus": "false",
                            "dbIndex": "false",
                            "customDefaultValue": null,
                            "calculateValue": null,
                            "allowCalculateOverride": "false",
                            "widget": {
                                "format": "yyyy-MM-dd hh:mm a",
                                "dateFormat": "yyyy-MM-dd hh:mm a",
                                "saveAs": "text"
                            },
                            "refreshOn": null,
                            "clearOnRefresh": "false",
                            "validateOn": "change",
                            "validate": {
                                "required": "false",
                                "custom": null,
                                "customPrivate": "false",
                                "minLength": null,
                                "maxLength": null,
                                "minWords": null,
                                "maxWords": null,
                                "pattern": null
                            },
                            "mask": "false",
                            "inputMask": null,
                            "id": "erc35pp"
                        }],
                        "width": "6",
                        "offset": "0",
                        "push": "0",
                        "pull": "0",
                        "type": "column",
                        "hideOnChildrenHidden": "false",
                        "input": "true",
                        "key": null,
                        "placeholder": null,
                        "prefix": null,
                        "customClass": null,
                        "suffix": null,
                        "multiple": "false",
                        "defaultValue": null,
                        "protected": "false",
                        "unique": "false",
                        "persistent": "true",
                        "hidden": "false",
                        "clearOnHide": "true",
                        "tableView": "true",
                        "dataGridLabel": "false",
                        "label": null,
                        "labelPosition": "top",
                        "labelWidth": "30",
                        "labelMargin": "3",
                        "description": null,
                        "errorLabel": null,
                        "tooltip": null,
                        "hideLabel": "false",
                        "tabindex": null,
                        "disabled": "false",
                        "autofocus": "false",
                        "dbIndex": "false",
                        "customDefaultValue": null,
                        "calculateValue": null,
                        "allowCalculateOverride": "false",
                        "widget": null,
                        "refreshOn": null,
                        "clearOnRefresh": "false",
                        "validateOn": "change",
                        "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                        "conditional": {"show": null, "when": null, "eq": null},
                        "id": "ejh68ej"
                    }, {
                        "components": [{
                            "tabindex": "2",
                            "clearOnHide": "true",
                            "hidden": "false",
                            "input": "true",
                            "tableView": "true",
                            "inputType": "text",
                            "inputMask": null,
                            "label": "Last Name",
                            "key": "lastName",
                            "placeholder": "Enter your last name",
                            "prefix": null,
                            "suffix": null,
                            "multiple": "false",
                            "defaultValue": null,
                            "protected": "false",
                            "unique": "false",
                            "persistent": "true",
                            "validate": {
                                "required": "false",
                                "minLength": null,
                                "maxLength": null,
                                "pattern": null,
                                "custom": null,
                                "customPrivate": "false",
                                "minWords": null,
                                "maxWords": null
                            },
                            "conditional": {"show": null, "when": null, "eq": null},
                            "type": "textfield",
                            "customClass": null,
                            "dataGridLabel": "false",
                            "labelPosition": "top",
                            "labelWidth": "30",
                            "labelMargin": "3",
                            "description": null,
                            "errorLabel": null,
                            "tooltip": null,
                            "hideLabel": "false",
                            "disabled": "false",
                            "autofocus": "false",
                            "dbIndex": "false",
                            "customDefaultValue": null,
                            "calculateValue": null,
                            "allowCalculateOverride": "false",
                            "widget": {
                                "format": "yyyy-MM-dd hh:mm a",
                                "dateFormat": "yyyy-MM-dd hh:mm a",
                                "saveAs": "text"
                            },
                            "refreshOn": null,
                            "clearOnRefresh": "false",
                            "validateOn": "change",
                            "mask": "false",
                            "id": "esiwc6"
                        }, {
                            "tabindex": "4",
                            "clearOnHide": "true",
                            "hidden": "false",
                            "input": "true",
                            "tableView": "true",
                            "inputMask": "(999) 999-9999",
                            "label": "Phone Number",
                            "key": "phoneNumber",
                            "placeholder": "Enter your phone number",
                            "prefix": null,
                            "suffix": null,
                            "multiple": "false",
                            "protected": "false",
                            "unique": "false",
                            "persistent": "true",
                            "defaultValue": null,
                            "validate": {
                                "required": "false",
                                "custom": null,
                                "customPrivate": "false",
                                "minLength": null,
                                "maxLength": null,
                                "minWords": null,
                                "maxWords": null,
                                "pattern": null
                            },
                            "type": "phoneNumber",
                            "conditional": {"show": null, "when": null, "eq": null},
                            "customClass": null,
                            "dataGridLabel": "false",
                            "labelPosition": "top",
                            "labelWidth": "30",
                            "labelMargin": "3",
                            "description": null,
                            "errorLabel": null,
                            "tooltip": null,
                            "hideLabel": "false",
                            "disabled": "false",
                            "autofocus": "false",
                            "dbIndex": "false",
                            "customDefaultValue": null,
                            "calculateValue": null,
                            "allowCalculateOverride": "false",
                            "widget": {
                                "format": "yyyy-MM-dd hh:mm a",
                                "dateFormat": "yyyy-MM-dd hh:mm a",
                                "saveAs": "text"
                            },
                            "refreshOn": null,
                            "clearOnRefresh": "false",
                            "validateOn": "change",
                            "mask": "false",
                            "inputType": "tel",
                            "id": "eqbaoqs"
                        }],
                        "width": "6",
                        "offset": "0",
                        "push": "0",
                        "pull": "0",
                        "type": "column",
                        "hideOnChildrenHidden": "false",
                        "input": "true",
                        "key": null,
                        "placeholder": null,
                        "prefix": null,
                        "customClass": null,
                        "suffix": null,
                        "multiple": "false",
                        "defaultValue": null,
                        "protected": "false",
                        "unique": "false",
                        "persistent": "true",
                        "hidden": "false",
                        "clearOnHide": "true",
                        "tableView": "true",
                        "dataGridLabel": "false",
                        "label": null,
                        "labelPosition": "top",
                        "labelWidth": "30",
                        "labelMargin": "3",
                        "description": null,
                        "errorLabel": null,
                        "tooltip": null,
                        "hideLabel": "false",
                        "tabindex": null,
                        "disabled": "false",
                        "autofocus": "false",
                        "dbIndex": "false",
                        "customDefaultValue": null,
                        "calculateValue": null,
                        "allowCalculateOverride": "false",
                        "widget": null,
                        "refreshOn": null,
                        "clearOnRefresh": "false",
                        "validateOn": "change",
                        "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                        "conditional": {"show": null, "when": null, "eq": null},
                        "id": "eq132ox"
                    }],
                    "type": "columns",
                    "conditional": {"show": null, "when": null, "eq": null},
                    "key": "columns",
                    "placeholder": null,
                    "prefix": null,
                    "customClass": null,
                    "suffix": null,
                    "multiple": "false",
                    "defaultValue": null,
                    "protected": "false",
                    "unique": "false",
                    "persistent": "false",
                    "hidden": "false",
                    "clearOnHide": "false",
                    "tableView": "false",
                    "dataGridLabel": "false",
                    "label": "Columns",
                    "labelPosition": "top",
                    "labelWidth": "30",
                    "labelMargin": "3",
                    "description": null,
                    "errorLabel": null,
                    "tooltip": null,
                    "hideLabel": "false",
                    "tabindex": null,
                    "disabled": "false",
                    "autofocus": "false",
                    "dbIndex": "false",
                    "customDefaultValue": null,
                    "calculateValue": null,
                    "allowCalculateOverride": "false",
                    "widget": null,
                    "refreshOn": null,
                    "clearOnRefresh": "false",
                    "validateOn": "change",
                    "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                    "autoAdjust": "false",
                    "hideOnChildrenHidden": "false",
                    "id": "en1ihm"
                }, {
                    "tabindex": "5",
                    "clearOnHide": "true",
                    "hidden": "false",
                    "input": "true",
                    "tableView": "true",
                    "label": "Survey",
                    "key": "survey",
                    "questions": [{
                        "value": "howWouldYouRateTheFormIoPlatform",
                        "label": "How would you rate the Form.io platform?"
                    }, {
                        "value": "howWasCustomerSupport",
                        "label": "How was Customer Support?"
                    }, {"value": "overallExperience", "label": "Overall Experience?"}],
                    "values": [{"value": "excellent", "label": "Excellent"}, {
                        "value": "great",
                        "label": "Great"
                    }, {"value": "good", "label": "Good"}, {"value": "average", "label": "Average"}, {
                        "value": "poor",
                        "label": "Poor"
                    }],
                    "defaultValue": null,
                    "protected": "false",
                    "persistent": "true",
                    "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                    "type": "survey",
                    "conditional": {"show": null, "when": null, "eq": null},
                    "placeholder": null,
                    "prefix": null,
                    "customClass": null,
                    "suffix": null,
                    "multiple": "false",
                    "unique": "false",
                    "dataGridLabel": "false",
                    "labelPosition": "top",
                    "labelWidth": "30",
                    "labelMargin": "3",
                    "description": null,
                    "errorLabel": null,
                    "tooltip": null,
                    "hideLabel": "false",
                    "disabled": "false",
                    "autofocus": "false",
                    "dbIndex": "false",
                    "customDefaultValue": null,
                    "calculateValue": null,
                    "allowCalculateOverride": "false",
                    "widget": null,
                    "refreshOn": null,
                    "clearOnRefresh": "false",
                    "validateOn": "change",
                    "id": "eyuqxxu"
                }, {
                    "clearOnHide": "true",
                    "hidden": "false",
                    "input": "true",
                    "tableView": "true",
                    "label": "Signature",
                    "key": "signature",
                    "placeholder": null,
                    "footer": "Sign above",
                    "width": "100%",
                    "height": "150px",
                    "penColor": "black",
                    "backgroundColor": "rgb(245,245,235)",
                    "minWidth": "0.5",
                    "maxWidth": "2.5",
                    "protected": "false",
                    "persistent": "true",
                    "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                    "type": "signature",
                    "hideLabel": "true",
                    "conditional": {"show": null, "when": null, "eq": null},
                    "prefix": null,
                    "customClass": null,
                    "suffix": null,
                    "multiple": "false",
                    "defaultValue": null,
                    "unique": "false",
                    "dataGridLabel": "false",
                    "labelPosition": "top",
                    "labelWidth": "30",
                    "labelMargin": "3",
                    "description": null,
                    "errorLabel": null,
                    "tooltip": null,
                    "tabindex": null,
                    "disabled": "false",
                    "autofocus": "false",
                    "dbIndex": "false",
                    "customDefaultValue": null,
                    "calculateValue": null,
                    "allowCalculateOverride": "false",
                    "widget": null,
                    "refreshOn": null,
                    "clearOnRefresh": "false",
                    "validateOn": "change",
                    "id": "eedsu1"
                }, {
                    "tabindex": "6",
                    "conditional": {"eq": null, "when": null, "show": null},
                    "input": "true",
                    "label": "Submit",
                    "tableView": "false",
                    "key": "submit",
                    "size": "md",
                    "leftIcon": null,
                    "rightIcon": null,
                    "block": "false",
                    "action": "submit",
                    "disableOnInvalid": "true",
                    "theme": "primary",
                    "type": "button",
                    "placeholder": null,
                    "prefix": null,
                    "customClass": null,
                    "suffix": null,
                    "multiple": "false",
                    "defaultValue": null,
                    "protected": "false",
                    "unique": "false",
                    "persistent": "false",
                    "hidden": "false",
                    "clearOnHide": "true",
                    "dataGridLabel": "true",
                    "labelPosition": "top",
                    "labelWidth": "30",
                    "labelMargin": "3",
                    "description": null,
                    "errorLabel": null,
                    "tooltip": null,
                    "hideLabel": "false",
                    "disabled": "false",
                    "autofocus": "false",
                    "dbIndex": "false",
                    "customDefaultValue": null,
                    "calculateValue": null,
                    "allowCalculateOverride": "false",
                    "widget": null,
                    "refreshOn": null,
                    "clearOnRefresh": "false",
                    "validateOn": "change",
                    "validate": {"required": "false", "custom": null, "customPrivate": "false"},
                    "id": "ec7vas"
                }],
                "slug": "test-form",
                "id": "2}"
            };

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
            console.log("Saving");
            formData = Object.assign({}, formData);
            formData.test = true;
            $.ajax({
                url: url,
                dataType: "json",
                type: 'POST',
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
