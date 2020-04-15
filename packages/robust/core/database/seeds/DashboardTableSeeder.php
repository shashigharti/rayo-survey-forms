<?php

use Illuminate\Database\Seeder;

class DashboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \Robust\Core\Models\User::all();
        foreach($users as $user){
            \Robust\Core\Models\Dashboard::create([
                'name' => "{$user->first_name} Dashboard",
                'slug' => str_slug("{$user->first_name} Dashboard"),
                'description' => 'Main Dashboard',
                'is_default' => true,
                'user_id' => $user->id
            ]);
        }
    }
}
