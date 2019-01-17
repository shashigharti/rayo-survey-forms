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
    }
}
