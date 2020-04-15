<?php

use Illuminate\Database\Seeder;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        $this->call(CoreMenuTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
    }
}
