<?php

use Illuminate\Database\Seeder;

class ReportsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReportsMenuTableSeeder::class);
    }
}
