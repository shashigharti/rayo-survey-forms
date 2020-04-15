<?php
use Robust\Core\Models\Role;
use Robust\Core\Models\User;
use Robust\Core\Models\Admin;
use Robust\Core\Models\Permission;
use Robust\Core\Helpers\PermissionHelper;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        //Get all user actions
        $all_permissions = (new PermissionHelper)->get_all_permissions();

        //Create a new role
        $role = Role::updateOrCreate(['name'=>'Administrator'],[
            'name' => 'Administrator'
        ]);

        foreach ($all_permissions as $package_name => $permissions) {

            if (is_null($permissions)) {
                continue;
            }

            foreach ($permissions as $action => $display_name) {
                $permission = Permission::updateOrCreate(['name' => $action],[
                    "name" => $action,
                    "display_name" => $display_name,
                    "package_name" => $package_name
                ]);
                if($permission->wasRecentlyCreated){
                    $role->permissions()->attach($permission->id);
                }

            }
        }

        $admins = [
            [
                'id' => 1,
                'email' => 'info@robustitconcepts.com',
                'password' => Hash::make('12345678'),
                'first_name' => 'Super',
                'last_name' => ' User',
                'user_name' => 'super_user',
                'created_at' => Carbon\Carbon::now()
            ]
        ];


        foreach ($admins as $admin){
            $created = Admin::updateOrCreate(['id' => 1],[
                'first_name' => $admin['first_name'],
                'last_name' => $admin['last_name'],
            ]);
            $user = User::updateOrCreate(['id' =>1],[
                'first_name' => $admin['first_name'],
                'last_name' => $admin['last_name'],
                'memberable_id' => $created->id,
                'memberable_type' => 'Robust\Core\Models\Admin',
                'email' => $admin['email'],
                'password' => $admin['password'],
            ]);
            if($user->wasRecentlyCreated){
                $user->roles()->attach($role->id);
            }

        }

        Role::updateOrCreate(['name'=>'User'],['name' => 'User']);
    }
}
