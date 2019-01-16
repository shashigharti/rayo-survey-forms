<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */
    /* {package-name}.{model or object}.{action}*/
    'actions' => [
        'forms.manage' => 'Forms',
        'forms.form.add' => 'Add Form and Design',
        'forms.form.edit' => 'Edit Form',
        'forms.form.delete' => 'Delete Form',
        'forms.form.duplicate' => 'Duplicate Form',
        'forms.form.show' => 'Show Form',

        'forms.data.edit' => 'Edit Data',
        'forms.data.print' => 'Print Data',
        'forms.data.delete' => 'Delete Data',
        'forms.data.export' => 'Export Data',

        'forms.report.advance' => 'Advance Report',
        'forms.report.individual' => 'Advance Report'
    ]
];
