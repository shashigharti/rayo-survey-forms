<?php

use Illuminate\Database\Seeder;

class DynamicFormsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DynamicFormsMenuTableSeeder::class);
    }
}
