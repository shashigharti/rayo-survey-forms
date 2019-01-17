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
        'admin.view' => 'View Admin Panel',
        'admin.user.manage' => "Manage Users",
        'admin.user.add' => "Add User",
        'admin.user.edit' => "User Edit",
        'admin.user.delete' => "User Delete",
        'admin.role.manage' => "Manage Roles",
        'admin.role.add' => "Add Role",
        'admin.role.edit' => "Role Edit",
        'admin.role.delete' => "Role Delete"
    ]
];
