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
        'admin.user.settings.edit' => "Edit User Settings",
        'core.contacts.manage' => 'Manage Contacts',

        'core.medias.manage' => "Manage Images",
        'core.medias.add' => "Add Image",
        'core.medias.edit' => "Image Edit",
        'core.medias.delete' => "Image Delete",

        'core.dashboards.manage' => "Manage Dashboard",
        'core.dashboards.add' => "Add Dashboard",
        'core.dashboards.edit' => "Dashboard Edit",
        'core.dashboards.delete' => "Dashboard Delete",


        'core.reports.view' => "View Report",

        'core.report-manager.manage' => "Manage Report Manager",
        'core.report-manager.edit' => "Report Edit",
        'core.report-manager.delete' => "Report Delete",

        'core.widgets.manage' => "Manage Widgets",
        'core.widgets.add' => "Add Widget",
        'core.widgets.edit' => "Widget Edit",
        'core.widgets.delete' => "Widget Delete",

        'core.backup.manage' => 'Manage Backup',
        'core.commands.manage' => 'Manage Command',
        'core.blocks.manage' => 'Manage Blocks',
        'core.themes.manage' => 'Manage Themes',

        'core.redirects.manage' => 'Manage Redirects',
        'core.redirects.add' => 'Add Redirects',
        'core.redirects.edit' => 'Edit Redirects',
        'core.redirects.delete' => 'Delete Redirects',

        'core.data.all' => 'View All Data',
        'core.data.own' => 'View Own Data',

        'core.schedules.manage' => 'Manage Schedules',
        'core.email-settings.manage' => 'Manage Email Settings'

    ]
];
