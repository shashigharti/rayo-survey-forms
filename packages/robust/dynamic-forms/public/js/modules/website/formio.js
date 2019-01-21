;
(function ($, FRW, window, document, undefined) {
    'use strict';


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        let online = navigator.onLine;
        // Storing offline form data - cannot retrieve from url when offline
        let offlineForm = {
            "_id": "57aa1d2a5b7a477b002717fe",
            "machineName": "examples:example",
            "modified": "2017-05-09T15:55:13.060Z",
            "title": "Example",
            "display": "form",
            "type": "form",
            "name": "example",
            "path": "example",
            "project": "5692b91fd1028f01000407e3",
            "created": "2016-08-09T18:12:58.126Z",
            "components": [{
                "input": false,
                "html": "<h1><a href=\"https://form.io\">Form.io</a> Example Form</h1>\n\n<p>This is a dynamically rendered JSON form&nbsp;built with <a href=\"https://form.io\">Form.io</a>. Using a simple&nbsp;drag-and-drop form builder, you can create any form that includes e-signatures, wysiwyg editors, date fields, layout components, data grids, surveys, etc.</p>\n",
                "type": "content",
                "conditional": {"show": "", "when": null, "eq": ""}
            }, {
                "input": false,
                "columns": [{
                    "components": [{
                        "tabindex": "1",
                        "tags": [],
                        "clearOnHide": true,
                        "hidden": false,
                        "input": true,
                        "tableView": true,
                        "inputType": "text",
                        "inputMask": "",
                        "label": "First Name",
                        "key": "firstName",
                        "placeholder": "Enter your first name",
                        "prefix": "",
                        "suffix": "",
                        "multiple": false,
                        "defaultValue": "",
                        "protected": false,
                        "unique": false,
                        "persistent": true,
                        "validate": {
                            "required": false,
                            "minLength": "",
                            "maxLength": "",
                            "pattern": "",
                            "custom": "",
                            "customPrivate": false
                        },
                        "conditional": {"show": "", "when": null, "eq": ""},
                        "type": "textfield"
                    }, {
                        "tabindex": "3",
                        "tags": [],
                        "clearOnHide": true,
                        "hidden": false,
                        "input": true,
                        "tableView": true,
                        "inputType": "email",
                        "label": "Email",
                        "key": "email",
                        "placeholder": "Enter your email address",
                        "prefix": "",
                        "suffix": "",
                        "defaultValue": "",
                        "protected": false,
                        "unique": false,
                        "persistent": true,
                        "type": "email",
                        "conditional": {"show": "", "when": null, "eq": ""},
                        "kickbox": {"enabled": false}
                    }]
                }, {
                    "components": [{
                        "tabindex": "2",
                        "tags": [],
                        "clearOnHide": true,
                        "hidden": false,
                        "input": true,
                        "tableView": true,
                        "inputType": "text",
                        "inputMask": "",
                        "label": "Last Name",
                        "key": "lastName",
                        "placeholder": "Enter your last name",
                        "prefix": "",
                        "suffix": "",
                        "multiple": false,
                        "defaultValue": "",
                        "protected": false,
                        "unique": false,
                        "persistent": true,
                        "validate": {
                            "required": false,
                            "minLength": "",
                            "maxLength": "",
                            "pattern": "",
                            "custom": "",
                            "customPrivate": false
                        },
                        "conditional": {"show": "", "when": null, "eq": ""},
                        "type": "textfield"
                    }, {
                        "tabindex": "4",
                        "tags": [],
                        "clearOnHide": true,
                        "hidden": false,
                        "input": true,
                        "tableView": true,
                        "inputMask": "(999) 999-9999",
                        "label": "Phone Number",
                        "key": "phoneNumber",
                        "placeholder": "Enter your phone number",
                        "prefix": "",
                        "suffix": "",
                        "multiple": false,
                        "protected": false,
                        "unique": false,
                        "persistent": true,
                        "defaultValue": "",
                        "validate": {"required": false},
                        "type": "phoneNumber",
                        "conditional": {"show": "", "when": null, "eq": ""}
                    }]
                }],
                "type": "columns",
                "conditional": {"show": "", "when": null, "eq": ""}
            }, {
                "tabindex": "5",
                "tags": [],
                "clearOnHide": true,
                "hidden": false,
                "input": true,
                "tableView": true,
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
                "defaultValue": "",
                "protected": false,
                "persistent": true,
                "validate": {"required": false, "custom": "", "customPrivate": false},
                "type": "survey",
                "conditional": {"show": "", "when": null, "eq": ""}
            }, {
                "tags": [],
                "clearOnHide": true,
                "hidden": false,
                "input": true,
                "tableView": true,
                "label": "Signature",
                "key": "signature",
                "placeholder": "",
                "footer": "Sign above",
                "width": "100%",
                "height": "150px",
                "penColor": "black",
                "backgroundColor": "rgb(245,245,235)",
                "minWidth": "0.5",
                "maxWidth": "2.5",
                "protected": false,
                "persistent": true,
                "validate": {"required": false},
                "type": "signature",
                "hideLabel": true,
                "conditional": {"show": "", "when": null, "eq": ""}
            }, {
                "tabindex": "6",
                "conditional": {"eq": "", "when": null, "show": ""},
                "tags": [],
                "input": true,
                "label": "Submit",
                "tableView": false,
                "key": "submit",
                "size": "md",
                "leftIcon": "",
                "rightIcon": "",
                "block": false,
                "action": "submit",
                "disableOnInvalid": true,
                "theme": "primary",
                "type": "button"
            }],
            "owner": "554806425867f4ee203ea861",
            "submissionAccess": [{"type": "create_all", "roles": []}, {
                "type": "read_all",
                "roles": []
            }, {"type": "update_all", "roles": []}, {"type": "delete_all", "roles": []}, {
                "type": "create_own",
                "roles": ["5692b920d1028f01000407e6"]
            }, {"type": "read_own", "roles": []}, {"type": "update_own", "roles": []}, {
                "type": "delete_own",
                "roles": []
            }],
            "access": [{
                "type": "read_all",
                "roles": ["5692b920d1028f01000407e4", "5692b920d1028f01000407e5", "5692b920d1028f01000407e6"]
            }],
            "tags": []
        };
        let form = online ? 'https://examples.form.io/example' : offlineForm;
        if ($('#form__content--display').length > 0) {
            Formio.createForm(document.getElementById('form__content--display'),
                form);
        }
    });
}(jQuery, FRW, window, document));
