<?php

use Illuminate\Database\Seeder;

class DynamicFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dynform_forms')->insert([
            [
                'title' => 'Test Form 1',
                'slug' => 'test-form-1',
                'pages' => '1',
                'field_for_user_email' => '',
                'notify_to_user' => 0,
                'form_group_id' => 1,
                'status' => 1,
                'notify_to_admin' => 0
            ],
            [
                'title' => 'Test Form 2',
                'slug' => 'test-form-2',
                'pages' => '1',
                'field_for_user_email' => '',
                'notify_to_user' => 0,
                'form_group_id' => 2,
                'status' => 1,
                'notify_to_admin' => 0
            ]
        ]);
    }
}
