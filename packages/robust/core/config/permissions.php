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
        'core.settings.edit' => "Edit Settings",
        'core.dashboards.manage' => 'Dashboard',

        'core.medias.manage' => "Manage Images",
        'core.medias.add' => "Add Image",
        'core.medias.edit' => "Image Edit",
        'core.medias.delete' => "Image Delete",

        'core.dashboards.add' => "Add Dashboard",
        'core.dashboards.edit' => "Dashboard Edit",
        'core.dashboards.delete' => "Dashboard Delete",

        'core.services.manage' => "Services",

        'core.commands.manage' => "Manage Command",
        'core.commands.run' => "Run Command",
        'core.commands.edit' => "Command Edit",
        'core.commands.delete' => "Command Delete",

        'core.widgets.manage' => "Manage Widgets",
        'core.widgets.add' => "Add Widget",
        'core.widgets.edit' => "Widget Edit",
        'core.widgets.delete' => "Widget Delete",

        'core.schedules.manage' => 'Manage Schedules',
        'core.email-settings.manage' => 'Manage Email Settings',

        //admin permissions
        'admin.view' => 'View Admin Panel',
        'admin.user.manage' => "Manage Users",
        'admin.user.add' => "Add User",
        'admin.user.edit' => "User Edit",
        'admin.user.delete' => "User Delete",
        'admin.role.manage' => "Manage Roles",
        'admin.role.add' => "Add Role",
        'admin.role.edit' => "Role Edit",
        'admin.role.delete' => "Role Delete",

        //banners
        'core.banners.manage' => "Manage Banners",
        'core.banners.add' => "Add Banner",
        'core.banners.edit' => "Banner Edit",
        'core.banners.delete' => "Banner Delete",

        //pages

        'core.pages.manage' => "Manage Pages",
        'core.pages.add' => "Add Page",
        'core.pages.edit' => "Page Edit",
        'core.pages.delete' => "Page Delete",

        //email templates

        'core.email-templates.manage' => "Manage Email Templates",
        'core.email-templates.add' => "Add Email Template",
        'core.email-templates.edit' => "Email Template Edit",
        'core.email-templates.delete' => "Email Template Delete",
    ]
];
