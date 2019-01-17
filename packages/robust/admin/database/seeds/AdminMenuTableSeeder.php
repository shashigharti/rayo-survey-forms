<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
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
                'display_name' => 'Contacts',
                'name' => 'contacts',
                'url' => route('admin.contacts.index'),
                'permission' => 'admin.contacts.manage',
                'package_name' => 'core',
                'parent_id' => 0,
                'type' => 'secondary',
                'icon' => 'md-account-box-phone'
            ]
        ]);

        DB::table('menus')->insert([
            [
                'display_name' => 'User Management',
                'name' => 'user-management',
                'url' => 'javascript:void(0)',
                'permission' => 'admin.user.manage',
                'package_name' => 'admin',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-accounts-add',
                'order' => '20'
            ]
        ]);
        $id = DB::table('menus')->max('id');

        DB::table('menus')->insert([
            [
                'display_name' => 'Users',
                'name' => 'user-management.users',
                'url' => route('admin.users.index'),
                'permission' => 'admin.user.manage',
                'package_name' => 'admin',
                'parent_id' => $id,
                'type' => 'child'
            ],
            [
                'display_name' => 'Roles',
                'name' => 'user-management.roles',
                'url' => route('admin.roles.index'),
                'permission' => 'admin.user.manage',
                'package_name' => 'admin',
                'parent_id' => $id,
                'type' => 'child'

            ]
        ]);
    }
}
