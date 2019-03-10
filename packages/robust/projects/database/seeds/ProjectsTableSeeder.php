<?php

use Illuminate\Database\Seeder;

/**
 * Class ProjectTableSeeder
 */
class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'Improving Food Security',
                'slug' => 'improving-food-security',
                'type' => 'Food Security',
                'code' => '1234',
                'description' => '<p> Improving Food Security of farmers in terai</p>',
                'status' => 1,
                'created_at' => \Carbon\Carbon::now()

            ],
            [
                'name' => 'Poverty Allevation in Mountain Region',
                'slug' => 'poverty-allevation',
                'type' => 'Poverty Allevation',
                'code' => '1234',
                'description' => '<p> Poverty Allevation in Mountain Region</p>',
                'status' => 1,
                'created_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}