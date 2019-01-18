<?php

use Illuminate\Database\Seeder;

class CoreMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'display_name' => 'Settings',
                'name' => 'core.settings',
                'url' => route('admin.settings.edit', ['general-setting']),
                'permission' => 'core.settings.edit',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'secondary',
                'icon' => 'md-settings'

            ],
            [
                'display_name' => 'Media Manager',
                'name' => 'core.medias',
                'url' => route('admin.medias.index'),
                'permission' => 'core.medias.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-image'

            ],
            [
                'display_name' => 'Reports',
                'name' => 'core.reports',
                'url' => route('admin.report-manager.reports.index'),
                'permission' => 'core.report-manager.reports.view',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-collection-item-8'

            ],


        ]);
        DB::table('menus')->insert([
            [
                'display_name' => 'Dashboards',
                'name' => 'core.dashboards',
                'url' => 'javascript:void(0)',
                'permission' => 'core.dashboards.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-apps'

            ]
        ]);
        $id = DB::table('menus')->max('id');
        DB::table('menus')->insert([
            [
                'display_name' => 'Dashboards',
                'name' => 'core.dashboards',
                'url' => route('admin.dashboards.index'),
                'permission' => 'core.dashboards.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'primary',
                'icon' => 'md-settings'
            ],
            [
                'display_name' => 'Widgets',
                'name' => 'core.widgets',
                'url' => route('admin.widgets.index'),
                'permission' => 'core.widgets.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'primary',
                'icon' => 'md-settings'

            ],
        ]);
        DB::table('menus')->insert([
            [
                'display_name' => 'Database Management',
                'name' => 'core.backup',
                'url' => route('admin.backup.index'),
                'permission' => 'core.backup.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-home'
            ],
        ]);
        $id = DB::table('menus')->max('id');
        DB::table('menus')->insert([
            [
                'display_name' => 'Back Up',
                'name' => 'core.backup',
                'url' => route('admin.backup.index'),
                'permission' => 'core.backup.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'primary',
            ],

        ]);
        DB::table('menus')->insert([
            [
                'display_name' => 'Server Management',
                'name' => 'core.commands',
                'url' => route('admin.commands.index'),
                'permission' => 'core.commands.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-home'
            ],
        ]);
        $id = DB::table('menus')->max('id');
        DB::table('menus')->insert([
            [
                'display_name' => 'Commands',
                'name' => 'core.commands',
                'url' => route('admin.commands.index'),
                'permission' => 'core.commands.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'primary',
            ],

        ]);
        DB::table('menus')->insert([

            [
                'display_name' => 'Theme',
                'name' => 'core.themes',
                'package_name' => 'core',
                'url' => 'javascript:void(0)',
                'permission' => 'core.themes.manage',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-collection-item-8'

            ]

        ]);
        DB::table('menus')->insert([
            [
                'display_name' => 'Redirects',
                'name' => 'core.redirects',
                'url' => route('admin.redirects.index'),
                'permission' => 'core.redirects.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-rotate-ccw'
            ],
        ]);

        DB::table('menus')->insert([
            [
                'display_name' => 'Reports Manager',
                'name' => 'core.report-manager',
                'url' => route('admin.report-manager.index'),
                'permission' => 'core.report-manager.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-labels'

            ],
        ]);
        $report_id = DB::table('menus')->max('id');
        $reports = \Robust\Core\Models\Report::all();
        foreach ($reports as $report) {
            \Robust\Core\Models\Menu::create(
                [
                    'display_name' => $report->name,
                    'name' => $report->name,
                    'url' => route('admin.report-manager.reports.show', ['id' => $report->id]),
                    'permission' => 'core.report.view',
                    'package_name' => 'core',
                    'parent_id' => $report_id,
                    'type' => 'primary',
                    'icon' => 'md-labels'

                ]
            );
        }

        DB::table('menus')->insert([
            [
                'display_name' => 'Task Schedules',
                'name' => 'core',
                'url' => route('admin.schedules.index'),
                'permission' => 'core.schedules.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'order' => 7,
                'icon' => 'md-file-text'
            ]
        ]);



        DB::table('menus')->insert([
            [
                'display_name' => 'Email-Settings',
                'name' => 'core.email-settings',
                'url' => route('admin.email-settings.index'),
                'permission' => 'core.email-settings.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'order' => 7,
                'icon' => 'md-settings'
            ]
        ]);
    }
}
