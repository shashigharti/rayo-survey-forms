<?php

use Illuminate\Database\Seeder;

class DynamicFormsMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Design Menu
        DB::table('menus')->insert([
            [
                'display_name' => 'Forms',
                'name' => 'forms',
                'url' => route('admin.forms.index'),
                'permission' => 'forms.manage',
                'package_name' => 'dynamic-forms',
                'parent_id' => 0,
                'type' => 'primary',
                'order' => 2,
                'icon' => 'md-assignment-o'

            ]
        ]);

    }
}
