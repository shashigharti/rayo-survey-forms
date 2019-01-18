<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \Robust\Admin\Models\User::all();
        foreach($users as $user){
            \Robust\Core\Models\Dashboard::create([
                'name' => "{$user->name}-dashboard",
                'slug' => str_slug("{$user->name}-dashboard"),
                'description' => 'Main Dashboard',
                'is_default' => true,
                'user_id' => $user->id
            ]);
        }


        \Robust\Core\Models\Setting::create([
            'slug' => "general-setting",
            'display_name' => 'General',
            'package_name' => 'core',
        ]);
        \Robust\Core\Models\Setting::create([
            'slug' => "email-setting",
            'display_name' => 'Email',
            'package_name' => 'core',
        ]);
        \Robust\Core\Models\Setting::create([
            'slug' => "app-setting",
            'display_name' => 'Application',
            'package_name' => 'core',
        ]);
        \Robust\Core\Models\Setting::create([
            'slug' => "contact-setting",
            'display_name' => 'Contact',
            'package_name' => 'core',
        ]);
        \Robust\Core\Models\Setting::create([
            'slug' => "ga-analytics",
            'display_name' => 'G-Analytics',
            'package_name' => 'core',
        ]);
        \Robust\Core\Models\Setting::create([
            'slug' => "fb-analytics",
            'display_name' => 'FB-Analytics',
            'package_name' => 'core',
        ]);
    }
}
