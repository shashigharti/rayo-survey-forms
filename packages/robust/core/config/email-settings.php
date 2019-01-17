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
    ['setting_name' => 'user_created', 'display_name' => 'User Created', 'permission' => 'core.email-settings.manage', 'event' => 'user-created'],
    ['setting_name' => 'contact', 'display_name' => 'Contact', 'permission' => 'core.email-settings.manage', 'event' => 'contact'],

];
