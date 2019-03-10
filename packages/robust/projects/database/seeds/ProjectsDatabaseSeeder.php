<?php

use Illuminate\Database\Seeder;

class ProjectsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectsMenuTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(LogFrameTableSeeder::class);
        $this->call(ProjectSettingTableSeeder::class);
    }
}
