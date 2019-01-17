<?php

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminMenuTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
    }
}
