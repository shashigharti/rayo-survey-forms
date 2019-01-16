;
(function ($, FRW, window, document, undefined) {
    'use strict';


    /*
     |--------------------------------------------------------------------------
     | On Ready
     |--------------------------------------------------------------------------
     */
    $(function () {
        if ($('#designer').length > 0) {
            let formElement = document.getElementById('designer');
            let builder = Formio.builder(document.getElementById('designer'), {
                display: "wizard",
                components: [
                    {
                        type: 'textfield',
                        key: 'firstName',
                        label: 'First Name',
                        placeholder: 'Enter your first name.',
                        input: true
                    },
                    {
                        type: 'textfield',
                        key: 'lastName',
                        label: 'Last Name',
                        placeholder: 'Enter your last name',
                        input: true
                    },
                    {
                        type: 'button',
                        action: 'submit',
                        label: 'Submit',
                        theme: 'primary'
                    }
                ]
            }).then(function (form) {
                form.on('submit', (submission) => {
                    console.log(submission);
                    console.log('The form was just submitted!!!');
                });
                form.on('error', (errors) => {
                    console.log('We have errors!');
                })
            });
        }
        if ($('#preview--container__form').length > 0) {
            Formio.createForm(document.getElementById('preview--container__form'), 'https://examples.form.io/example', {
                readOnly: true
            });
        }
    });
}(jQuery, FRW, window, document));
