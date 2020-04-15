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
                'display_name' => 'Dashboard',
                'name' => 'core.dashboard',
                'url' => route('admin.home'),
                'permission' => 'core.dashboards.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'settings_input_svideo'
            ],
            [
                'display_name' => 'Pages',
                'name' => 'core.pages',
                'url' => route('admin.pages.index'),
                'permission' => 'core.pages.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'pages'
            ],
            [
                'display_name' => 'Banners',
                'name' => 'core.banners',
                'url' => route('admin.banners.index'),
                'permission' => 'core.banners.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'art_track'
            ],
            [
                'display_name' => 'Email Templates',
                'name' => 'core.email-templates',
                'url' => route('admin.email-templates.index'),
                'permission' => 'core.email-templates.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'email'
            ]
            // [
            //     'display_name' => 'Media Manager',
            //     'name' => 'core.medias',
            //     'url' => route('admin.medias.index'),
            //     'permission' => 'core.medias.manage',
            //     'package_name' => 'core',
            //     'parent_id' => 0,
            //     'type' => 'primary',
            //     'icon' => 'image'
            // ]

        ]);

        DB::table('menus')->insert([
            [
                'display_name' => 'Services',
                'name' => 'core.services',
                'url' => route('admin.commands.index'),
                'permission' => 'core.services.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'graphic_eq'
            ],
        ]);
        $id = DB::table('menus')->max('id');
        DB::table('menus')->insert([
            [
                'display_name' => 'Jobs',
                'name' => 'core.commands',
                'url' => route('admin.commands.index'),
                'permission' => 'core.commands.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'child',
                'icon' => 'flash_on'
            ],

        ]);

        DB::table('menus')->insert([
            [
                'display_name' => 'User Management',
                'name' => 'user-management',
                'url' => 'javascript:void(0)',
                'permission' => 'admin.user.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'people_outline'
            ]
        ]);
        $id = DB::table('menus')->max('id');

        DB::table('menus')->insert([
            [
                'display_name' => 'Users',
                'name' => 'user-management.users',
                'url' => route('admin.users.index'),
                'permission' => 'admin.user.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'child',
                'icon' => 'person_add'
            ],
            [
                'display_name' => 'Roles',
                'name' => 'user-management.roles',
                'url' => route('admin.roles.index'),
                'permission' => 'admin.user.manage',
                'package_name' => 'core',
                'parent_id' => $id,
                'type' => 'child',
                'icon' => 'nature_people'

            ]
        ]);
    }
}
