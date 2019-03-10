<?php

use Illuminate\Database\Seeder;

/**
 * Class ProjectMenuTableSeeder
 */
class ProjectsMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'display_name' => 'Project',
                'name' => 'forms.group',
                'url' => route('admin.projects.index'),
                'permission' => 'projects.manage',
                'package_name' => 'projects',
                'parent_id' => 0,
                'type' => 'primary',
                'order' => 1,
                'icon' => 'md-folder-outline'
            ]
        ]);
    }
}