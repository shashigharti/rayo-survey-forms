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
        //Form Designer
        DB::table('menus')->insert([
            [
                'display_name' => 'Form Manager',
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

        //User Form Menu
        DB::table('menus')->insert([
            [
                'display_name' => 'Forms',
                'name' => 'forms',
                'url' => route('admin.user.forms.index'),
                'permission' => 'user.form.manage',
                'package_name' => 'dynamic-forms',
                'parent_id' => 0,
                'type' => 'primary',
                'order' => 2,
                'icon' => 'md-assignment-o'

            ]
        ]);

    }
}
